<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dior Online Shop</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <!-- Ícono del menú (tres líneas) -->
    <div class="menu-icon" onclick="toggleMenu()">
        <div></div>
        <div></div>
        <div></div>
    </div>

    <!-- Menú lateral -->
    <div class="menu-overlay" id="menuOverlay" onclick="toggleMenu()"></div>
    <div class="side-menu" id="sideMenu">
        <div class="menu-content">
            <div class='menu-return'>
                <a href="{{ url('/') }}">
                    <img class='menu-minilogo' src='https://companieslogo.com/img/orig/CDI.PA_BIG-0bd74bba.png?t=1720244491'>
                </a>
            </div>
            <div class="tab-selector">
                <button class="tab-button active" onclick="selectMenu('accessories')">Moda y Accesorios</button>
                <button class="tab-button" onclick="selectMenu('beauty')">Perfume y Belleza</button>
                <div class="tab-underline" id="tabUnderline"></div>
            </div>
            <ul id="menuList">
                <li class="accessories"><a href="#">Novedades</a></li>
                <li class="accessories"><a href="#">Regalos & Personalización</a></li>
                <li class="accessories"><a href="#">Moda Mujer</a></li>
                <li class="accessories"><a href="#">Moda Hombre</a></li>
                <li class="accessories"><a href="#">Bolsos</a></li>
                <li class="accessories"><a href="#">Joyería y Relojería</a></li>
                <li class="accessories"><a href="#">Alta Costura</a></li>
                <li class="accessories"><a href="#">Desfiles</a></li>
                <li class="accessories"><a href="#">Dior World</a></li>
                <li class="beauty" style="display: none;"><a href="#">Qué Hay de Nuevo</a></li>
                <li class="beauty" style="display: none;"><a href="#">Perfumes</a></li>
                <li class="beauty" style="display: none;"><a href="#">Maquillaje</a></li>
                <li class="beauty" style="display: none;"><a href="#">Tratamiento</a></li>
                <li class="beauty" style="display: none;"><a href="#">Spa Dior</a></li>
                <li class="beauty" style="display: none;"><a href="#">El Arte de Regalar</a></li>
                <li class="beauty" style="display: none;"><a href="#">Nuestros Compromisos</a></li>

                @if(Auth::check())
                <!-- Si el usuario está autenticado -->
                <li>Bienvenido, {{ Auth::user()->name }}</li>
                <li><a href="{{ route('cart.show') }}" class="btn-cart">Ver Carrito</a></li>
                <li><a href="{{ route('contact') }}" class="btn-cart">Contacto</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <li>
                    <button class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</button>
                </li>
                @else
                <!-- Si el usuario no está autenticado -->
                <li>
                    <button class="login-btn" onclick="window.location.href='{{ route('login') }}'">Iniciar sesión</button>
                </li>
                @endif
            </ul>
        </div>
    </div>

    <!-- Contenido principal de la página -->
    <div id="app">
        @yield('content')
    </div>

    <script>
        // Función para abrir y cerrar el menú
        function toggleMenu() {
            const sideMenu = document.getElementById('sideMenu');
            const menuOverlay = document.getElementById('menuOverlay');
            const app = document.getElementById('app');

            sideMenu.classList.toggle('active');
            menuOverlay.classList.toggle('active');
            app.classList.toggle('blur'); // Añadir o quitar la clase de desenfoque
        }

        // Función para seleccionar menú
        function selectMenu(type) {
            const accessoriesItems = document.querySelectorAll('.accessories');
            const beautyItems = document.querySelectorAll('.beauty');
            const tabs = document.querySelectorAll('.tab-button');
            const underline = document.getElementById('tabUnderline');

            if (type === 'accessories') {
                accessoriesItems.forEach(item => item.style.display = 'list-item');
                beautyItems.forEach(item => item.style.display = 'none');
                tabs[0].classList.add('active');
                tabs[1].classList.remove('active');
                underline.style.transform = 'translateX(0)';
            } else {
                accessoriesItems.forEach(item => item.style.display = 'none');
                beautyItems.forEach(item => item.style.display = 'list-item');
                tabs[0].classList.remove('active');
                tabs[1].classList.add('active');
                underline.style.transform = 'translateX(110%)';
            }
        }
    </script>
</body>
    <!-- Footer -->
    <footer class='footer' style="background-color: #000; color: #fff; padding: 20px; text-align: center; margin-top: 50px;">
        <p>&copy; 2024 Dior. Todos los derechos reservados.</p>
        <p>Todo el crédito es de Carlos Taracena (Desarrollador Junior Web).</p>
        <p>Contacto: <a href="mailto:carlitostaracenacoronado@gmail.com" style="color: #fff;">carlitostaracenacoronado@gmail.com</a></p>
        <div style="margin: 10px 0;">
            <!-- Instagram -->
            <a href="https://www.instagram.com/defii.ct/" target="_blank" style="margin: 0 10px;">
                <img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png" alt="Instagram" style="width: 30px;">
            </a>
            <!-- LinkedIn -->
            <a href="https://www.linkedin.com/in/carlos-taracena-836512217/" target="_blank" style="margin: 0 10px;">
                <img src="https://upload.wikimedia.org/wikipedia/commons/c/ca/LinkedIn_logo_initials.png" alt="LinkedIn" style="width: 30px;">
            </a>
        </div>
    </footer>

</html>