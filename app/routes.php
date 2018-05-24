<?php
//------------------------------------------
// Application Web Routes.
//------------------------------------------
use Illuminate\Http\Request;

//------------------------------------------
// Routes.
//------------------------------------------
$router->get('/', function() {

    //$model = new \App\Teste();
    $model = \App\Teste::query()->where('sexo', 'M')->first();
    $model->nome = 'Bruno';
    //$model->sexo = 'M';
    $model->save();

    return view('hello');
});

//------------------------------------------
// Routes.
//------------------------------------------
$router->get('/teste/{id}', function(Request $request, $id = null) {
    return 'teste';
});