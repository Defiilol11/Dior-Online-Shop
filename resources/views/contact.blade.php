@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
    <div class="contact-container">
        <h1 class="contact-title">Formulario de Contacto</h1>
        <form action="{{ route('contact.send') }}" method="POST" class="contact-form">
            @csrf
            <div class="contact-form-group">
                <label for="title" class="contact-label">Título</label>
                <input type="text" name="title" id="title" class="contact-input" required>
            </div>
            <div class="contact-form-group">
                <label for="message" class="contact-label">Mensaje</label>
                <textarea name="message" id="message" class="contact-textarea" rows="4" required></textarea>
            </div>
            <button type="submit" class="contact-btn">Enviar</button>
        </form>
    </div>
@endsection
