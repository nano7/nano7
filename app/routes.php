<?php
//------------------------------------------
// Application Web Routes.
//------------------------------------------
use Illuminate\Http\Request;

//------------------------------------------
// Routes.
//------------------------------------------
$router->get('/', function() {

    $x = auth()->check();

    return view('hello');
});

//------------------------------------------
// Routes.
//------------------------------------------
$router->get('/teste/{id}', function(Request $request, $id = null) {
    return 'teste';
});