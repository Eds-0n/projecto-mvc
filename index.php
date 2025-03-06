<?php

require __DIR__ . '/vendor/autoload.php';

use App\Http\Router;
use App\Utils\View;
use App\Common\Environment;

// CARREGA AS VARIÁVEIS DE AMBIENTE DO PROJECTO
Environment::load(__DIR__);

// DEFINE A CONSTANTE DE URL DO PROJECTO
define('URL', getenv('URL'));

// DEFINE O VALOR PADRÃO DAS VARIÁVEIS
View::init([
    'URL' => URL
]);

// INICIA O ROUTER
$obRouter = new Router(URL);

// INCLUI AS ROTAS DE PAGINAS
include __DIR__ . '/routes/pages.php';

// IMPRIME O RESPONSE DA ROTA
$obRouter->run()->sendResponse();