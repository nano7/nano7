<?php
//------------------------------------------
// Application Web Routes.
//------------------------------------------
use Illuminate\Http\Request;

//------------------------------------------
// Routes.
//------------------------------------------
$router->get('/', function() {
    //auth()->loginUsingId('5b07f08bbd600306b00032c2');

    $x = auth()->check();

    return view('hello');
});

//------------------------------------------
// Routes.
//------------------------------------------
$router->get('/teste/{id}', function(Request $request, $id = null) {
    return 'teste';
});