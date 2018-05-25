<?php namespace App;

use Nano7\Database\Model\Model;

class Dependente extends Model
{
    protected $collection = 'dependentes';

    public function cliente()
    {
        return $this->foreignOne('\App\Cliente');
    }
}