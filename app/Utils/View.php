<?php

namespace App\Utils;

class View {

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

        // CHAVES DO ARRAY DE VARIÁVEIS 
        $keys = array_keys($vars);
        $keys = array_map(function($item) {
            return '{{' . $item . '}}';
        }, $keys);

        // RETORNA O CONTEUDO RENDERIZADO
        return str_replace($keys, array_values($vars), $contentView);

    }
}