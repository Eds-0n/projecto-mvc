<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Organization;

class Home extends Page {
    /**
     * Metodo responsavel por retornar o conteudo (view) da home
     * @return  string
     */
    public static function getHome() {

        // INSTANCIA DA CLASSE ORGANIZATIO
        $objOrganization = new Organization;
        // echo '<pre>';
        // print_r($objOrganization);
        // echo '</pre>';exit;

        // VIEW DA HOME
        $content = View::render('pages/home', [
            'name' => $objOrganization->name,
            'description' => $objOrganization->description,
            'site' => $objOrganization->site
        ]);

        // RETORNA A VIEW DA PAGINA
        return parent::getPage('WDEV - Canal - HOME', $content);
    }
}