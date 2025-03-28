<?php

namespace App\Controller\Pages;

use \App\Utils\View;

class Page
{

    /**
     * Método responsável por retornar o cabeçalho da página
     */
    private static function getHeader()
    {
        return View::render('pages/header');
    }

    /**
     * Método responsável por retornar o rodapé da página
     */
    private static function getFooter()
    {
        return View::render('pages/footer');
    }

    /**
     * Método responsável por renderizar o layout de paginação
     *
     * @param Request $request
     * @param Pagination $obPagination
     * @return string
     */
    public static function getPagination($request, $obPagination)
    {
        // PÁGINAS
        $pages = $obPagination->getPages();

        // VERIFICA A QUANTIDADE DE PÁGINAS
        if (count($pages) <= 1) return '';

        // LINKS
        $links = '';

        // URL ATCUAL (SEM GETS)
        $url = $request->getRouter()->getCurrentUrl();

        // GET
        $queryParams = $request->getQueryParams();

        // RENDERIZA OS LINKS
        foreach ($pages as $page) {
            // ALTERA  A PÁGINA
            $queryParams['page'] = $page['page'];

            // LINK
            $link = $url . '?' . http_build_query($queryParams);

            // VIEW
            $links .= View::render('pages/pagination/link', [
                'page' => $page['page'],
                'link' => $link,
                'active' => $page['current'] ? 'active' : ''
            ]);
        }

        // RENDERIZA A BOX  DE PAGINAÇÃO
        return View::render('pages/pagination/box', [
            'links' => $links
        ]);
    }

    /**
     * Método responsável por retornar o conteudo (View) da Página Genérica
     * @return string
     */
    public static function getPage($title, $content)
    {
        return View::render('pages/page', [
            'title' => $title,
            'header' => self::getHeader(),
            'content' => $content,
            'footer' => self::getFooter()
        ]);
    }
}
