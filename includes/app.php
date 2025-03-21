<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Utils\View;
use App\Db\Database;
use App\Common\Environment;
use App\Http\Middleware\Queue as MiddlewareQueue;

// CARREGA AS VARIÁVEIS DE AMBIENTE DO PROJECTO
Environment::load(__DIR__ . '/../');

// DEFINE AS CONFIGURAÇÕES DO BANCO DE DADOS
Database::config(
    getenv('DB_HOST'),
    getenv('DB_NAME'),
    getenv('DB_USER'),
    getenv('DB_PASS'),
    getenv('DB_PORT')
);

// DEFINE A CONSTANTE DE URL DO PROJECTO
define('URL', getenv('URL'));

// DEFINE O VALOR PADRÃO DAS VARIÁVEIS
View::init([
    'URL' => URL
]);

// DEFINE O MAPEAMENTO DE MIDDLEWARES
MiddlewareQueue::setMap([
    'maintenance' => \App\Http\Middleware\Maintenance::class,
    'require-admin-logout' => \App\Http\Middleware\RequireAdminLogout::class,
    'require-admin-login' => \App\Http\Middleware\RequireAdminLogin::class
]);

// DEFINE O MAPEAMENTO DE MIDDLEWARES PADRÕES
MiddlewareQueue::setDefault([
    'maintenance'
]);
