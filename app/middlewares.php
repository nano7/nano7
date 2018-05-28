<?php
//------------------------------------------
// Application Web Middlewares.
//------------------------------------------
use Illuminate\Http\Request;

//------------------------------------------
// Add middlewares.
//------------------------------------------
/*$web->middleware('session.start', function(Request $request, Closure $next) {

    session()->setName(config('session.cookie', 'nano_session'));
    session()->start();

    return $next($request);
});/**/

//------------------------------------------
// Add global alias middleware.
//------------------------------------------
//$web->alias('session.start');