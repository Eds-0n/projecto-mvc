<?php

namespace App\Http;

use \Closure;
use \Exception;
use \ReflectionFunction;

class Router
{

    /**
     * URL completa do Projecto (raiz)
     * @var string
     */
    private $url = '';

    /**
     * Prefixo de todas as roas
     * @var string
     */
    private $prefix = '';

    /**
     * Indice de rotas
     * @var array
     */
    private $routes = [];

    /**
     * Instancia de Request
     * @var Request
     */
    private $request;

    /**
     * Método responsável por iniciar a classe
     * @param string $Url
     */
    public function __construct($url)
    {
        $this->request = new Request($this);
        $this->url = $url;
        $this->setPrefix();
    }

    /**
     * Método responsável por definir o prefixo das rotas
     */
    private function setPrefix()
    {
        // INFORMAÇÕES DA URL ACTUAL
        $parseUrl = parse_url($this->url);

        // DEFINE O PREFIXO
        $this->prefix = $parseUrl['path'] ?? '';
    }

    /**
     * Método responsável por adicionar uma rota na classe
     * @param string $method
     * @param string $route
     * @param array $params
     */
    private function addRoute($method, $route, $params)
    {
        // VALIDAÇÃO DOS PARAMETROS
        foreach ($params as $key => $value) {
            if ($value instanceof Closure) {
                $params['controller'] = $value;
                unset($params[$key]);
                continue;
            }
        }

        // VARIÁVEIS DA ROTA
        $params['variables'] = [];

        // PADRÃO DE VALIDAÇÃO DAS VARIÁVEIS DAS ROTAS
        $patternVariable = '/{(.*?)}/';
        if (preg_match_all($patternVariable, $route, $matches)) {
            $route = preg_replace($patternVariable, '(.*?)', $route);
            $params['variables'] = $matches[1];
        }

        // PADRÃO DE VALIDÇÃO DA URL
        $patternRoute = '/^' . str_replace('/', '\/', $route) . '$/';

        // ADICIONA A ROTA DENTRO DA CLASSE
        $this->routes[$patternRoute][$method] = $params;
    }

    /**
     * Método responsável por definir uma rota de GET
     * @param string $route
     * @param array $params 
     */
    public function get($route, $params)
    {
        $this->addRoute('GET', $route, $params);
    }

    /**
     * Método responsável por definir uma rota de POST
     * @param string $route
     * @param array $params 
     */
    public function post($route, $params)
    {
        $this->addRoute('POST', $route, $params);
    }

    /**
     * Método responsável por definir uma rota de PUT
     * @param string $route
     * @param array $params 
     */
    public function put($route, $params)
    {
        $this->addRoute('PUT', $route, $params);
    }

    /**
     * Método responsável por definir uma rota de DELETE
     * @param string $route
     * @param array $params 
     */
    public function delete($route, $params)
    {
        $this->addRoute('DELETE', $route, $params);
    }

    /**
     * Método responsável por retornar a URI desconsiderendo o prefixo
     * @return string
     */
    private function getUri()
    {
        // URI DA REQUEST
        $uri = $this->request->getUri();

        // FATIA A URI COM O PREFIXO
        $xUri = strlen($this->prefix) ? explode($this->prefix, $uri) : [$uri];

        // RETORN A URI SEM O PREFIXO
        return end($xUri);
    }

    /**
     * Método responsável por retornar os dados da rota actual
     * @return array
     */
    private function getRoute()
    {
        $uri = $this->getUri();

        //MÉTODO DA REQUISIÇÃO
        $httpMethod = $this->request->getHttpMethod();

        // VALIDA AS ROTAS
        foreach ($this->routes as $patternRoute => $methods) {
            //VERIFICA SE A URI BATE COM O PADRÃO
            if (preg_match($patternRoute, $uri, $matches)) {
                // VERIFICA O MÉTODO
                if (isset($methods[$httpMethod])) {
                    // REMOVE A PRIEMEIRA POSIÇÃO
                    unset($matches[0]);

                    // VARIÁVEIS PROCESSADAS
                    $keys = $methods[$httpMethod]['variables'];
                    $methods[$httpMethod]['variables'] = array_combine($keys, $matches);
                    $methods[$httpMethod]['variables']['request'] = $this->request;

                    // RETORNO DOS PARAMETROS DA ROTA
                    return $methods[$httpMethod];
                }

                // MÉTODO NÃO PERMITIDO
                throw new Exception('Método não permitido', 405);
            }
        }

        // URL NÃO ENCONTRADA
        throw new Exception('URL não encontrada', 404);
    }

    /**
     * Método responsável por executar a rota actual
     * @return Response
     */
    public function run()
    {
        try {
            // OBTÉM A ROTA ACTUAL
            $route = $this->getRoute();

            // VERIFICA O CONTROLER
            if (!isset($route['controller'])) {
                throw new Exception('A URL nao pôde ser processada.', 500);
            }

            // ARGUMENTOS DA FUNÇÃO
            $args = [];

            // REFLECTION
            $reflection = new ReflectionFunction($route['controller']);
            foreach ($reflection->getParameters() as $parameter) {
                $name = $parameter->getName();
                $args[$name] = $route['variables'][$name] ?? '';
            }

            // RETORNA A EXECUÇÃO DA FUNÇÃO
            return call_user_func_array($route['controller'], $args);
        } catch (Exception $e) {
            return new Response($e->getCode(), $e->getMessage());
        }
    }

    /**
     * Método responsável por retornar a URL acual
     * @return string
     */
    public function getCurrentUrl()
    {
        return $this->url . $this->getUri();
    }
}
