<?php
//------------------------------------------
// Application Web Routes.
//------------------------------------------
use Illuminate\Http\Request;

//------------------------------------------
// Routes.
//------------------------------------------
$router->get('/', function() {
    return 'ola';
});

//------------------------------------------
// Routes.
//------------------------------------------
$router->get('/teste/{id}', function() {
    $args = func_get_args();
    return 'teste';
});