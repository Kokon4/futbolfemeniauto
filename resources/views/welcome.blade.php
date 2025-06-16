<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Si tienes CSS -->
    @vite(['resources/css/equips.css'])
</head>
<body class="bg-gray-800 text-white">
    @include('partials.menu')

    <div class="container mx-auto mt-4">
        <h1 class="text-3xl font-bold">Bienvenido a la página principal</h1>
        <p class="mt-2">Explora las secciones usando el menú superior.</p>
    </div>
    <p>&copy; 2024 Guia de Futbol Femení</p>
</body>
</html>
