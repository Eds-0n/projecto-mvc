<?php

namespace App\Http;

class Request
{

    /**
     * Método http da requisição
     * @var string
     */
    private $httpMethod;

    /**
     * URI d página
     * @var string
     */
    private $uri;

    /**
     * Parametros da URL($_GET)
     * @var array
     */
    private $queryParams = [];

    /**
     * VAriáveis recebidas no Post da Página($_POST)
     * @var array
     */
    private $postVars = [];

    /**
     * Cabeçalho da Requisição
     * @var array
     */
    private $headers = [];

    /**
     * Constructor da classe
     */
    public function __construct()
    {
        // $this
    }
}
