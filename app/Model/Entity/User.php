<?php

namespace App\Model\Entity;

use \App\Db\Database;

class User
{
    /**
     * ID do Usuário
     * @var integer
     */
    public $id;

    /**
     * Nome do usuário
     * @var string
     */
    public $nome;

    /**
     * E-mail do usuário
     * @var string
     */
    public $email;

    /**
     * Senha do usuário
     * @var string
     */
    public $senha;

    /**
     * Método responsável por cadastrar a um usuário no banco de dados
     * @return boolean
     */
    public function cadastrar()
    {
        // INSERE A INSTÂNCIA ACTUAL NO BANCO DE DADOS
        $this->id = (new Database('usuarios'))->insert([
            'nome' => $this->nome,
            'email' => $this->email,
            'senha' => $this->senha
        ]);

        // SUCESSO
        return true;
    }

    /**
     * étodo responsável por actualizar os dados do usuário no banco de dados
     * @return boolean
     */
    public function actualizar()
    {
        return (new Database('usuarios'))->update('id = ' . $this->id, [
            'nome' => $this->nome,
            'email' => $this->email,
            'senha' => $this->senha
        ]);
    }

    /**
     * étodo responsável por excluir o usuário no banco de dados
     * @return boolean
     */
    public function excluir()
    {
        return (new Database('usuarios'))->delete('id = ' . $this->id);
    }

    /**
     * Método responsável por retornar uma instância com base no ID
     * @param integer $id
     * @return User
     */
    public static function getUserById($id)
    {
        return self::getUsers('id =' . $id)->fetchObject(self::class);
    }

    /**
     * Método responsável por retornar um usuário com base em seu e-mail
     * @param string $email
     * @return User
     */
    public static function getUserByEmail($email)
    {
        return self::getUsers('email ="' . $email . '"')->fetchObject(self::class);
    }

    /**
     * Método responsável por retornar depoimentos
     * @param string $where
     * @param string $order
     * @param string $limit
     * @param string $fields
     * @return PDOStatement
     */
    public static function getUsers($where = null, $order = null, $limit = null, $fields = '*')
    {
        return (new Database('usuarios'))->select($where, $order, $limit, $fields);
    }
}
