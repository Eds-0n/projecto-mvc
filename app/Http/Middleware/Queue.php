<?php

namespace App\Http\Middleware;

class Queue
{
    /**
     * Mapeamento dde middlewares
     * @var array
     */
    private static $map = [];

    /**
     * Mapeamento de middlewares que serão carregados em todas as rotas
     * @var array
     */
    private static $default = [];

    /**
     * Fila de middlewares a serem executados
     * @var array
     */
    private $middlewares = [];

    /**
     * Função de execução do controlador
     * @var Closure
     */
    private $controller;

    /**
     * Argumentos da funçao do controlador
     * @var array
     */
    private $controllerArgs = [];

    public function __construct($middlewares, $controller, $controllerArgs)
    {
        $this->middlewares = array_merge(self::$default, $middlewares);
        $this->controller = $controller;
        $this->controllerArgs = $controllerArgs;
    }

    /**
     * Método responsável por definir o mapeamento de middlewares
     * @param array $map
     */
    public static function setMap($map)
    {
        self::$map = $map;
    }

    /**
     * Método responsável por definir o mapeamento de middlewares padrões
     * @param array $default
     */
    public static function setDefault($default)
    {
        self::$default = $default;
    }

    /**
     * Método responsável por executar o próximo nível da fila de middlewares
     * @param Request $request
     * @return Response
     */
    public function next($request)
    {
        // VERIFICA SE A FILA ESTÁ VAZIA
        if (empty($this->middlewares)) return call_user_func_array($this->controller, $this->controllerArgs);

        // MIDDLEWARE
        $middleware = array_shift($this->middlewares);

        // VERIFICA O MAPEAMENTO
        if (!isset(self::$map[$middleware])) {
            throw new \Exception('Problemas ao processar o middleware da requisiçao.', 500);
        }

        // NEXT - FUNÇAO ANÓNIMA QUE CHAMA O PROXIMO NÍVEL DO MIDLEWARE
        $queue = $this;
        $next = function ($request) use ($queue) {
            return $queue->next($request);
        };

        // EXECUTA O MIDDLEWARE
        return (new self::$map[$middleware])->handle($request, $next);
    }
}
