@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/categories.css') }}">
<h1 class="category-title">{{ $category->name }}</h1>

<div class="product-grid">
    @if($products->isEmpty())
        <p>No hay productos disponibles en esta categoría.</p>
    @else
        <div class="grid-container">
            @foreach($products as $product)
                <a href="{{ route('products.show', $product->id) }}" class="product-link">
                    <div class="product-item">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="product-image">
                        <div class="product-info">
                            <h2>{{ $product->name }}</h2>
                            <p>Precio: ${{ $product->price }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</div>
@endsection
