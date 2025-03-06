<?php

namespace App\Common;

class Environment {

    /**
     * Método responsável por carregar as variáveis de ambiente do projecto
     * @param string $dir - Caminho absoluto da pasta onde encontra-se o arquivo .env
     */
    public static function load($dir) {
        // VERIFICA SE O ARQUIVO .ENV EXISTE
        if(!file_exists($dir . '/.env')) {
            return false;
        }

        // DDEFINE AS VARIÁVEIS DE AMBIENTE
        $lines = file($dir . '/.env');
        foreach($lines as $line) {
            putenv(trim($line));
        }

    }

}