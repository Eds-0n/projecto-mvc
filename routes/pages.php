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
    function() {
        return new Response(200, Pages\Testimony::getTestimonies());
    }
]);

// ROTA DEPOIMENTOS (INSERT)
$obRouter->post('/depoimentos', [
    function($request) {
        // O video da parte 3 parou em 19:50 mins
        echo '<pre>';
        print_r($request);
        echo '</pre>';exit;
        return new Response(200, Pages\Testimony::getTestimonies());
    }
]);
