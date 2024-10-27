@extends('layouts.app')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Cristian Dior</title>
    <!-- Incluimos SweetAlert2 para las alertas personalizadas -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Vinculamos el archivo CSS personalizado -->
    <link rel="stylesheet" href="/css/custom-login.css">
</head>
<body class="bg-light-gray">

    <div class="login-container">
        <div class="logo-container">
            <img src="https://companieslogo.com/img/orig/CDI.PA_BIG-0bd74bba.png?t=1720244491" alt="Meat Pack Logo" class="logo">
        </div>

        <div class="form-container">
            <form method="POST" action="{{ route('login') }}" onsubmit="return checkLogin(event)">
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" class="form-input" type="email" name="email" required autofocus>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" class="form-input" type="password" name="password" required>
                </div>

                <div class="form-group">
                    <button class="btn btn-submit">
                        Iniciar Sesión
                    </button>
                </div>
            </form>

            <div class="text-center">
                <a href="{{ route('register') }}" class="btn btn-register">
                    Registrarse
                </a>
            </div>
        </div>
    </div>

    <script>
        function checkLogin(event) {
            // Simulación de éxito o error
            const loginSuccess = true; // Cambia esto a true si el login es exitoso

            if (!loginSuccess) {
                event.preventDefault(); // Evita que se envíe el formulario si falla

                // Mostrar alerta de error con SweetAlert2
                Swal.fire({
                    icon: 'error',
                    title: 'Error de inicio de sesión',
                    text: 'No se ha podido iniciar sesión. Verifica tus credenciales.',
                    confirmButtonText: 'Aceptar',
                    background: '#f8d7da',
                    customClass: {
                        popup: 'rounded-lg'
                    }
                });
            } else {
                // Si el login es exitoso, muestra una alerta de éxito (opcional)
                Swal.fire({
                    icon: 'success',
                    title: '¡Bienvenido!',
                    text: 'Has iniciado sesión correctamente.',
                    confirmButtonText: 'Continuar',
                    background: '#d4edda',
                    customClass: {
                        popup: 'rounded-lg'
                    }
                });
            }
        }
    </script>

    <!-- Aquí puedes manejar las alertas basadas en la sesión -->
    @if(session('alert'))
        <script>
            Swal.fire({
                icon: '{{ session('alert_type') }}', // Usa session para determinar el tipo de alerta (success, error, etc.)
                title: '{{ session('alert_title') }}',
                text: '{{ session('alert') }}',
                confirmButtonText: 'Aceptar',
                background: '#f8d7da',
                customClass: {
                    popup: 'rounded-lg'
                }
            });
        </script>
    @endif

</body>
</html>
