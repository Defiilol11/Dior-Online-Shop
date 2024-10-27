@extends('layouts.app')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Cristian Dior</title>
    <!-- Incluimos SweetAlert2 para las alertas personalizadas -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Incluimos el archivo CSS personalizado -->
    <link rel="stylesheet" href="/css/custom-register.css">
</head>
<body class="bg-light-gray">

    <div class="login-container">
        <div class="logo-container">
            <img src="https://companieslogo.com/img/orig/CDI.PA_BIG-0bd74bba.png?t=1720244491" alt="Meat Pack Logo" class="logo">
        </div>

        <div class="form-container">
            <form method="POST" action="{{ route('register') }}" onsubmit="return checkRegister(event)">
                @csrf

                <!-- Name -->
                <div class="form-group">
                    <label for="name" class="form-label">Nombre</label>
                    <input id="name" class="form-input" type="text" name="name" :value="old('name')" required autofocus>
                </div>

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" class="form-input" type="email" name="email" :value="old('email')" required>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="form-label">Contraseña</label>
                    <input id="password" class="form-input" type="password" name="password" required>
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                    <input id="password_confirmation" class="form-input" type="password" name="password_confirmation" required>
                </div>

                <div class="form-group">
                    <span class="text">
                        ¿Ya estás registrado? 
                        <a href="{{ route('login') }}" class="link">Inicia sesión</a>
                    </span>

                    <button type="submit" class="btn btn-submit">
                        Registrarse
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function checkRegister(event) {
            // Simulación de éxito o error
            const registerSuccess = true; // Cambia esto a true si el registro es exitoso

            if (!registerSuccess) {
                event.preventDefault(); // Evita que se envíe el formulario si falla

                // Mostrar alerta de error con SweetAlert2
                Swal.fire({
                    icon: 'error',
                    title: 'Error en el registro',
                    text: 'El registro ha fallado. Verifica tus datos.',
                    confirmButtonText: 'Aceptar',
                    background: '#f8d7da',
                    customClass: {
                        popup: 'rounded-lg',
                        confirmButton: 'btn-black'
                    },
                    allowOutsideClick: false, // Evitar cerrar el modal fuera del alerta
                    allowEscapeKey: false
                });
            } else {
                // Si el registro es exitoso, muestra una alerta de éxito
                Swal.fire({
                    icon: 'success',
                    title: '¡Registro exitoso!',
                    text: 'Tu cuenta ha sido creada correctamente.',
                    confirmButtonText: 'Continuar',
                    background: '#d4edda',
                    customClass: {
                        popup: 'rounded-lg',
                        confirmButton: 'btn-black'
                    },
                    allowOutsideClick: false, // Evitar cerrar el modal fuera del alerta
                    allowEscapeKey: false
                }).then(() => {
                    // Redirigir al index después de presionar el botón
                    window.location.href = '/index';
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
                    popup: 'rounded-lg',
                    confirmButton: 'btn-black'
                }
            });
        </script>
    @endif

</body>
</html>
