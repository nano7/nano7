<?php namespace App;

use Nano7\Database\Model\Model;

class Teste extends Model
{
    protected $collection = 'testes';


    public function interno()
    {
        return $this->embedTo('\App\Interno');
    }

    public function lista()
    {
        return $this->embedMany('\App\Interno');
    }

    public function cliente()
    {
        return $this->foreignOne('\App\Cliente');
    }
}