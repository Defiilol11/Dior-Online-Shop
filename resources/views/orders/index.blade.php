@extends('layouts.app')

@section('content')
    <div class="orders-page">
        <h1>Mis Órdenes</h1>

        @if($orders->isEmpty())
            <p>No tienes órdenes.</p>
        @else
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>ID de la Orden</th>
                        <th>Dirección de Envío</th>
                        <th>Sucursal</th>
                        <th>Estado</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->shippingAddress->address_line }}</td>
                            <td>{{ $order->branch->name }}</td>
                            <td>{{ $order->status }}</td>
                            <td>{{ $order->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
