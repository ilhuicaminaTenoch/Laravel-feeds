<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema Generador de Feeds">
    <meta name="author" content="Televisa">
    <meta name="keyword" content="Sistema Generador de Feeds">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="img/favicon.png">
    <title>Sistema Generador de Feeds.</title>
    <link href="css/plantilla.css" rel="stylesheet">
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
<div id="app">
    <div class="app-body">
    <!-- Contenido Principal -->
    @yield('contenido')
    <!-- /Fin del contenido principal -->
    </div>
</div>

<script src="js/app.js"></script>
<script src="js/plantilla.js"></script>

</body>

</html>

