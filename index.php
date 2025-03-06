<?php

require __DIR__ . '/vendor/autoload.php';

use App\Http\Router;
use App\Utils\View;

define('URL', 'http://localhost/projecto-mvc');

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