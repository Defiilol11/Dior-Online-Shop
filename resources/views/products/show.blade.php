@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/productshow.css') }}">
    <h1>{{ $product->name }}</h1>

    <div class="product-detail">
        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="product-image">
        <div class="product-info">
            <p>{{ $product->description }}</p>
            <p>Precio: Q{{ $product->price }}</p>
            <p>Disponibles: {{ $product->stock }}</p>
            <form method="POST" action="{{ route('cart.add', $product->id) }}">
            @csrf
            <div>
                <label for="quantity">Cantidad:</label>
                <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $product->stock }}" required>
            </div>
                <button type="submit" class="add-to-cart-btn">Agregar al Carrito</button>
            </form>
        </div>
    </div>
@endsection
