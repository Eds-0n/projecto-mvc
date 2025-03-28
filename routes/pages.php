<?php

use \App\Http\Response;
use \App\Controller\Pages;


// ROTA HOME
$obRouter->get('/', [
    function() {
        return new Response(200, Pages\Home::getHome());
    }
]);

// ROTA SOBRE
$obRouter->get('/sobre', [
    function() {
        return new Response(200, Pages\About::getAbout());
    }
]);

// ROTA DEPOIMENTOS
$obRouter->get('/depoimentos', [
    function($request) {
        return new Response(200, Pages\Testimony::getTestimonies($request));
    }
]);

// ROTA DEPOIMENTOS (INSERT)
$obRouter->post('/depoimentos', [
    function($request) {
        return new Response(200, Pages\Testimony::insertTestimony($request));
    }
]);
