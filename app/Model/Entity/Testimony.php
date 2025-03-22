<?php

namespace App\Model\Entity;

use \App\Db\Database;

class Testimony 
{
    /**
     * ID do depoimento
     * @var integer
     */
    public $id;

    /**
     * Nome do usuário que fez o depoimento
     * @var string
     */
    public $nome;

    /**
     * Mensagem do depoimento
     * @var string
     */
    public $mensagem;

    /**
     * Data de publicação do depoimento
     * @var string
     */
    public $data;

    /**
     * Método responsável por cadastrar a instância actual no banco de dados
     * @return boolean
     */
    public function cadastrar() 
    {
        // DEFINE A DATA
        $this->data = date('Y-m-d H:i:s');

        // INSERE O DEPOIMENTO NO BANCO DE DADOS
        $this->id = (new Database('depoimentos'))->insert([
            'nome' => $this->nome,
            'mensagem' => $this->mensagem,
            'data' => $this->data
        ]);

        // SUCESSO
        return true;
    }
    
    /**
     * Método responsável por actualizar os dados do banco com os dados da instância actual
     * @return boolean
     */
    public function actualizar() 
    {
        // ACTUALIZA O DEPOIMENTO NO BANCO DE DADOS
        return (new Database('depoimentos'))->update('id =' . $this->id, [
            'nome' => $this->nome,
            'mensagem' => $this->mensagem,
        ]);
    }
    
    /**
     * Método responsável por excluir um depoimento do banco de dados
     *  @return boolean
     */
    public function excluir() 
    {
        // EXCLUI O DEPOIMENTO DO BANCO DE DADOS
        return (new Database('depoimentos'))->delete('id =' . $this->id);
    }

    /**
     * método responsável por retornar um depoimento com base no seu id
     * @param integer $id
     * @return Testimony
     */
    public static function getTestimonyById($id)
    {
        return self::getTestimonies('id = ' . $id)->fetchObject(self::class);
    }

    /**
     * Método responsável por retornar depoimentos
     * @param string $where
     * @param string $order
     * @param string $limit
     * @param string $fields
     * @return PDOStatement
     */
    public static function getTestimonies($where = null, $order = null, $limit = null, $fields = '*')
    {
        return (new Database('depoimentos'))->select($where, $order, $limit, $fields);
    }

}