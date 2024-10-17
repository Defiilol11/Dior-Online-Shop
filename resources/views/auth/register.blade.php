@extends('layouts.app')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">"
    <title>Register - DIOR</title>
    <!-- Incluimos Tailwind CSS para los estilos -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md">
        <div class="flex justify-center mb-6">
            <img src="https://companieslogo.com/img/orig/CDI.PA_BIG-0bd74bba.png?t=1720244491" alt="DIOR Logo" class="h-20">
        </div>

        <div class="bg-white border border-gray-300 rounded-md shadow-lg p-8">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block font-bold text-black mb-2">Nombre</label>
                    <input id="name" class="block w-full p-2 border border-black rounded" type="text" name="name" :value="old('name')" required autofocus>
                </div>

                <!-- Email Address -->
                <div class="mb-4">
                    <label for="email" class="block font-bold text-black mb-2">Email</label>
                    <input id="email" class="block w-full p-2 border border-black rounded" type="email" name="email" :value="old('email')" required>
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block font-bold text-black mb-2">Contraseña</label>
                    <input id="password" class="block w-full p-2 border border-black rounded" type="password" name="password" required>
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label for="password_confirmation" class="block font-bold text-black mb-2">Confirmar Contraseña</label>
                    <input id="password_confirmation" class="block w-full p-2 border border-black rounded" type="password" name="password_confirmation" required>
                </div>

                <div class="flex items-center justify-between mt-6">
                    <span class="text-black">
                        Ya estás registrado? 
                        <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Inicia sesión</a>
                    </span>

                    <button type="submit" class="w-full p-2 border border-black text-black font-bold uppercase rounded transition duration-150 ease-in-out hover:bg-black hover:text-white">
                        Registrarse
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
