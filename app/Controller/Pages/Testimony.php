<?php

namespace App\Controller\Pages;

use \App\Utils\View;

class Testimony extends Page
{

    /**
     * Método responsável por retornar o conteudo de Depoimentos
     * @return string
     */
    public static function getTestimonies()
    {

        // VIEW DE DEPOIMENTOS
        $content = View::render('pages/testimonies', [

        ]);

        // RETORNA A VIEW DA PAGINA
        return parent::getPage('DEPOIMENTOS - Driver Labs', $content);
    }
}
