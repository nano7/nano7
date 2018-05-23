<?php
//------------------------------------------
// Application Web Routes.
//------------------------------------------
use Illuminate\Http\Request;

//------------------------------------------
// Routes.
//------------------------------------------
$router->get('/', function() {

    $id = db()->insert('testes', ['nome' => 'Bruno']);

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