<?php

namespace App\Utils;

class View {

    /**
     * Variáveis padrões da View
     * @var array
     */
    private static $vars = [];

    /**
     * Método responsável por definir os dados iniciais da classe
     * @param array
     */
    public static function init($vars = []) {
        self::$vars = $vars;
    }

    /**
     * Método responsável por retornar o conteúdo de uma view
     * @param string $view
     * @return string
     */
    public static function getContentView ($view) {
        $file = __DIR__ . '/../../resources/view/' . $view . '.html';
        return file_exists($file) ? file_get_contents($file) : '';
    }

    /**
     * Método responsável por retornar o conteúdo renderizado de uma View
     * @param string $view
     * @param array $vars
     * @return string
     */
    public static function render ($view, $vars = []) {
        // CONTEÚDO DA VIEW
        $contentView = self::getContentView($view);

        // MERGE DAS VARIÁVEIS DA VIEW
        $vars = array_merge(self::$vars, $vars);

        // CHAVES DO ARRAY DE VARIÁVEIS 
        $keys = array_keys($vars);
        $keys = array_map(function($item) {
            return '{{' . $item . '}}';
        }, $keys);

        // RETORNA O CONTEUDO RENDERIZADO
        return str_replace($keys, array_values($vars), $contentView);

    }
}