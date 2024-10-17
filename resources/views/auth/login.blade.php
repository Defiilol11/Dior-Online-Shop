@extends('layouts.app')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - DIOR</title>
    <!-- Incluimos Tailwind CSS para los estilos -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Función para mostrar alerta en caso de error
        function showAlert() {
            alert('No se ha iniciado sesión correctamente.');
        }
    </script>
</head>
<body class="bg-white flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md">
        <div class="flex justify-center mb-6">
            <img src="https://companieslogo.com/img/orig/CDI.PA_BIG-0bd74bba.png?t=1720244491" alt="DIOR Logo" class="h-20">
        </div>

        <div class="bg-white border border-gray-300 rounded-md shadow-lg p-8">
            <form method="POST" action="{{ route('login') }}" onsubmit="return checkLogin(event)">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block font-bold text-black mb-2">Email</label>
                    <input id="email" class="block w-full p-2 border border-black rounded" type="email" name="email" required autofocus>
                </div>

                <div class="mb-4">
                    <label for="password" class="block font-bold text-black mb-2">Password</label>
                    <input id="password" class="block w-full p-2 border border-black rounded" type="password" name="password" required>
                </div>

                <div class="mb-6">
                    <button class="w-full p-2 border border-black text-black font-bold uppercase rounded transition duration-150 ease-in-out hover:bg-black hover:text-white">
                        Iniciar Sesión
                    </button>
                </div>
            </form>

            <div class="text-center">
                <a href="{{ route('register') }}" class="text-black border border-black p-2 rounded hover:bg-black hover:text-white transition duration-150 ease-in-out">
                    Registrarse
                </a>
            </div>
        </div>
    </div>

    <script>
        function checkLogin(event) {
            // Aquí podrías implementar una verificación de estado en caso de que se produzca un error
            // Pero para este caso, asumiremos que el inicio de sesión puede fallar
            // Esto es solo un ejemplo, puedes implementar lógica para verificar el resultado
            const loginSuccess = true; // Cambia esto a true si el login es exitoso

            if (!loginSuccess) {
                event.preventDefault(); // Evita que se envíe el formulario
                showAlert(); // Muestra la alerta
            }
        }
    </script>
</body>
</html>
@if(session('alert'))
    <script>
        alert('{{ session('alert') }}');
    </script>
@endif
