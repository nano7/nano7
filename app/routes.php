<?php
//------------------------------------------
// Application Web Routes.
//------------------------------------------
use Illuminate\Http\Request;

//------------------------------------------
// Routes.
//------------------------------------------
$router->get('/', function() {

    $model = \App\Teste::query()->find('5b07f08bbd600306b00032c2');

    //$model = new \App\Teste();
    //$model->nome = 'Bruno';
     $l = $model->lista()->add();
    $l->logradouro = 'Herval do Oeste';
    $l->numero = 293;
    $l->complemento = 'Casa 1';
    //if (isset($model->interno[0]))
    //{
    //    $model->interno[0]->delete();
    //}

    //$model->interno->logradouro = '1';
    //$model->interno->numero = 2;
    //$model->interno->complemento = '3';

    $model->save();

    return view('hello');
});

//------------------------------------------
// Routes.
//------------------------------------------
$router->get('/teste/{id}', function(Request $request, $id = null) {
    return 'teste';
});