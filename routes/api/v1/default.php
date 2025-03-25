<?php

use \App\Http\Response;

// ROTA RAIZ DA API
$obRouter->get('/api/v1', [
    function ($request) {
        return new Response(200, 'API :)');
    }
]);
