<?php namespace App;


use Nano7\Auth\UserInterface;
use Nano7\Database\Model\Model;

class Teste extends Model implements UserInterface
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $collection = 'testes';

    /**
     * Retorna o ID do usuario.
     *
     * @return string
     */
    public function getAuthId()
    {
        return $this->getId();
    }

    /**
     * Retorna o nome do usuario.
     *
     * @return string
     */
    public function getAuthName()
    {
        return $this->nome;
    }

    /**
     * Retorna a senha do usuario.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->senha;
    }

    public function getRememberToken()
    {
        return '';
    }
}