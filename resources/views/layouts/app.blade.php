<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,600">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@3.6.9/dist/css/splide.min.css">

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/list-cocktails.css') }}" rel="stylesheet">
        <link href="{{ asset('css/stored-cocktails.css') }}" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@3.6.9/dist/js/splide.min.js"></script>
        
        <!-- Custom Styles -->
        <style>
            body {
                background-color: rgba(17, 24, 39, var(--tw-bg-opacity, 1)); /* Color de fondo */
                color: white; /* Color del texto para mejor visibilidad */
            }
        </style>
        @yield('styles')
    </head>
    <body class="antialiased">
        @auth
            @include('layouts.navigation')
        @endauth
        <div class="container mt-5">
            @yield('content')
        </div>
    </body>
</html>
