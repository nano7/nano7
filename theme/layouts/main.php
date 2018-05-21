<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="NetForce Sistemas">
    <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
    <!-- <meta name="web-base" content="{{ url('') }}"> -->
    <!-- <meta name="api-base" content="{{ t_route('api.base.uri') }}"> -->
    <!-- <meta name="locale" content="{{ app()->getLocale() }}"> -->

    <title>{{ (isset($title) ? $title . ' - ' : '') }}{{ config('app.name', 'NetForce') }}</title>

    <link rel="icon" href="{{ url('img/favicon.png') }}">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Main styles -->
    <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ url('css/animate.css') }}" rel="stylesheet">
    <link href="{{ url('css/fonts.css') }}" rel="stylesheet">

    <!-- Plugins Styles -->
    <link href="{{ url('css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">

    <!-- NetForce Styles -->
    <link href="{{ url('css/style.css') }}?build={{ env('APP_BUILD') }}" rel="stylesheet">
</head>

@yield('body')

</html>