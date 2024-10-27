@extends('layouts.app')

@section('content')
<div class="hero-container">
    <div class="image-wrapper">
        <a href="{{ url('/fashion') }}">
            <video src="{{ asset('videos/Fashion-CristianDior.mp4') }}" type="video/mp4" poster="https://www.dior.com/couture/var/dior/storage/images/pushs-editos/folder-fw24-women/folder-push-edito_1850-x-2000/m1286zezdm993/44223121-1-eng-GB/m1286zezdm993_1440_1200.jpg" alt="Moda y Accesorios" class="responsive-image video" controls autoplay muted loop>
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
            <video src="{{ asset('videos/Beauty-CristianDior.mp4') }}" type="video/mp4" class="responsive-image video" controls autoplay muted loop poster="https://www.dior.com/couture/var/dior/storage/images/pushs-editos/folder-fw24-women/folder-push-edito_1850-x-2000/e3445womrsd307/44222003-1-eng-GB/e3445womrsd307_1440_1200.jpg">
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

<script>
    const videoContainer = document.querySelector('.image-wrapper');
    const video = document.querySelector('.video');

    if ('ontouchstart' in window || navigator.maxTouchPoints) {
        videoContainer.addEventListener('touchstart', function() {
            video.paused ? video.play() : video.pause();
        });
    } else {
        videoContainer.addEventListener('mouseenter', function() {
            video.play();
        });
        videoContainer.addEventListener('mouseleave', function() {
            video.pause();
            video.currentTime = 0;
        });
    }
</script>
