<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Organization;

class Home extends Page
{

    /**
     * Método responsável por retornar o conteudo (View) da Home
     * @return string
     */
    public static function getHome()
    {
        // ORGANIZAÇÃO
        $obOrganization = new Organization();

        // VIEW DA HOME
        $content = View::render('pages/home', [
            "name" => $obOrganization->name,
            "description" => $obOrganization->description,
            "site" => $obOrganization->site
        ]);

        // RETORNA A VIEW DA PAGINA
        return parent::getPage('HOME - Driver Labs', $content);
    }
}
