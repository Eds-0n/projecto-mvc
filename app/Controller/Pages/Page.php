<?php

namespace App\Controller\Pages;

use \App\Utils\View;

class Page {

    /**
     * Método responsável por retornar o cabeçalho da página
     */
    private static function getHeader() {
        return View::render('pages/header');
    }

    /**
     * Método responsável por retornar o rodapé da página
     */
    private static function getFooter() {
        return View::render('pages/footer');
    }

    /**
     * Método responsável por retornar o conteudo (View) da Página Genérica
     * @return string
     */
    public static function getPage($title, $content) {
        return View::render('pages/page', [
            'title' => $title,
            'header' => self::getHeader(),
            'content' => $content,
            'footer' => self::getFooter()
        ]);
    }
}