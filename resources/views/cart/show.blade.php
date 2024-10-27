@extends('layouts.app')

@section('content')
<div class="cart-page">
    <h1 class="cart-title">CARRITO</h1>
    <p class="breadcrumb"><a href="{{ url('/') }}">Inicio</a> / Carrito</p>

    @if($cartItems->isEmpty())
        <div class="empty-cart">
            <p>No tienes productos en tu carrito.</p>
        </div>
    @else
        <div class="cart-container">
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>PRODUCTOS</th>
                        <th>PRECIO</th>
                        <th>CANTIDAD</th>
                        <th>TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $item)
                        <tr class="cart-item">
                            <td class="product-details-cart">
                                <button class="remove-btn" onclick="removeItem('{{ $item->id }}')">×</button>
                                <div class="product-thumbnail">
                                    <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="product-image-cart">
                                </div>
                                <div class="product-info-cart">
                                    <h2>{{ $item->product->name }}</h2>
                                    <p>{{ $item->product->description }}</p>
                                </div>
                            </td>
                            <td class="price">Q{{ number_format($item->product->price, 2) }}</td>
                            <td class="quantity">
                                <input type="number" value="{{ $item->quantity }}" min="1" class="quantity-input" onchange="updateQuantity('{{ $item->id }}', this.value)">
                            </td>
                            <td class="total">Q{{ number_format($item->product->price * $item->quantity, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="cart-summary">
                <h3>Total: Q{{ number_format($cartItems->sum(fn($item) => $item->product->price * $item->quantity), 2) }}</h3>
                <button class="checkout-btn" onclick="location.href='{{ route('checkout.show') }}'">COMPRA</button>
            </div>
        </div>
    @endif
</div>

<script>
    function removeItem(itemId) {
        if (confirm('¿Estás seguro de que deseas eliminar este producto del carrito?')) {
            fetch(`/cart/${itemId}/remove`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(response => {
                if (response.ok) location.reload();
            });
        }
    }

    function updateQuantity(itemId, quantity) {
        if (quantity <= 0) {
            alert('La cantidad debe ser al menos 1');
            return;
        }

        fetch(`/cart/${itemId}/update`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ quantity })
        }).then(response => {
            if (response.ok) location.reload();
        });
    }
</script>
@endsection
