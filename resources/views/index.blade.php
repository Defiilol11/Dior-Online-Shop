@extends('layouts.app')

@section('content')
    <div class="hero-container">
        <div class="image-wrapper">
            <a href="{{ url('/fashion') }}">
                <img src="https://www.dior.com/couture/var/dior/storage/images/pushs-editos/folder-fw24-women/folder-push-edito_1850-x-2000/m1286zezdm993/44223121-1-eng-GB/m1286zezdm993_1440_1200.jpg" alt="Moda y Accesorios" class="responsive-image">
            </a>
            <div class="overlay">
                    <div class="text-content">
                        <h2>Moda Y Accesorios</h2>
                        <a href="{{ url('/fashion') }}" class="discover-link">Descubrir</a>
                    </div>
                </div>
        </div>

        <div class="logo">
            <img src="https://www.pngall.com/wp-content/uploads/13/Dior-Logo.png" alt="Logo Dior">
        </div>

        <div class="image-wrapper">
            <a href="{{ url('/beauty') }}">
                <img src="https://www.dior.com/couture/var/dior/storage/images/pushs-editos/folder-fw24-women/folder-push-edito_1850-x-2000/e3445womrsd307/44222003-1-eng-GB/e3445womrsd307_1440_1200.jpg" alt="Perfume y Belleza" class="responsive-image">
            </a>
            <div class="overlay">
                    <div class="text-content">
                        <h2>Perfume Y Belleza</h2>
                        <a href="{{ url('/beauty') }}" class="discover-link">Descubrir</a>
                    </div>
                </div>
        </div>
    </div>
@endsection