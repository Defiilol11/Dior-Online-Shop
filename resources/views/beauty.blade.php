@extends('layouts.app')

@section('content')
    <h1>{{ $category->name }}</h1>
    <!-- Contenedor de la cuadrícula de productos -->
    <div class="product-grid">
        @if($products->isEmpty())
            <p>No hay productos disponibles en esta categoría.</p>
        @else
            <div class="grid-container">
                @foreach($products as $product)
                    <!-- Enlazamos todo el contenedor del producto -->
                    <a href="{{ route('products.show', $product->id) }}" class="product-link">
                        <div class="product-item">
                            <!-- Mostrar la imagen del producto -->
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="product-image">
                            
                            <!-- Información del producto -->
                            <div class="product-info">
                                <h2>{{ $product->name }}</h2>
                                <p>{{ $product->description }}</p>
                                <p>Precio: ${{ $product->price }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
@endsection
