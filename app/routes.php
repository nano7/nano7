<?php
//------------------------------------------
// Application Web Routes.
//------------------------------------------
use Illuminate\Http\Request;

//------------------------------------------
// Routes.
//------------------------------------------
$router->get('/', function() {

    //$id = db()->insert('testes', ['nome' => 'Bruno']);
    //$x = db()->collection('testes')->where('nome', 'like', 'Bru%')->get();
    //$x = db()->collection('testes')->where('nome', 'like', 'Bru%')->first();

    //$x = db()->collection('testes')->where('nome', 'like', 'Bru%')->update(['sexo' => 'M']);
    //$x = db()->collection('testes')->where('nome', 'like', 'Bru%')->delete();



    return view('hello');
    //return 'ola';
});

//------------------------------------------
// Routes.
//------------------------------------------
$router->get('/teste/{id}', function(Request $request, $id = null) {
    $args = func_get_args();
    return 'teste';
});