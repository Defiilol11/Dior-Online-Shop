@extends('layouts.app')

@section('content')
    <div class="checkout-page">
        <h1>Seleccionar dirección de envío</h1>
        <p class="breadcrumb"><a href="{{ url('/') }}">Inicio</a> / Checkout</p>

        <!-- Input de búsqueda de dirección -->
        <div class="location-container">
            <label for="address-input">Buscar dirección:</label>
            <input id="address-input" type="text" placeholder="Escribe tu dirección" />

            <!-- Input para mostrar la latitud y longitud obtenidas -->
            <input type="hidden" id="latitude" name="latitude">
            <input type="hidden" id="longitude" name="longitude">
        </div>

        <!-- Mapa de Google -->
        <div id="map" style="height: 400px; width: 100%;"></div>

        <!-- Seleccionar sucursal -->
        <div class="branch-selection">
            <label for="branch">Seleccionar sucursal:</label>
            <select id="branch" name="branch">
                @foreach($branches as $branch)
                    <option value="{{ $branch->id }}" data-lat="{{ $branch->latitude }}" data-lng="{{ $branch->longitude }}">
                        {{ $branch->name }} - {{ $branch->address }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="payment-method-section">
                <h3>Selecciona tu método de pago</h3>
                <label>
                    <input type="radio" name="payment_method" value="tarjeta" required>
                    Tarjeta de Crédito/Débito
                </label>
                <label>
                    <input type="radio" name="payment_method" value="transferencia" required>
                    Transferencia Bancaria
                </label>
                <label>
                    <input type="radio" name="payment_method" value="efectivo" required>
                    Pago en Efectivo en la Entrega
                </label>
            </div>

        <!-- Botón para confirmar y guardar la dirección -->
        <button id="confirm-order-btn">Confirmar Orden</button>
    </div>

    <script>
        let map;
        let marker;
        let autocomplete;

        function initMap() {
            const defaultPosition = { lat: 14.6349, lng: -90.5069 };  // Posición por defecto (Guatemala)

            map = new google.maps.Map(document.getElementById('map'), {
                center: defaultPosition,
                zoom: 15
            });

            marker = new google.maps.Marker({
                map: map,
                position: defaultPosition,
                draggable: true
            });

            // Autocompletado de Google Places
            autocomplete = new google.maps.places.Autocomplete(document.getElementById('address-input'));
            autocomplete.bindTo('bounds', map);

            autocomplete.addListener('place_changed', function () {
                const place = autocomplete.getPlace();

                if (!place.geometry) {
                    alert("No se encontró la ubicación.");
                    return;
                }

                // Mover el mapa y el marcador a la ubicación seleccionada
                map.setCenter(place.geometry.location);
                map.setZoom(15);
                marker.setPosition(place.geometry.location);

                // Actualizar los inputs de latitud y longitud
                document.getElementById('latitude').value = place.geometry.location.lat();
                document.getElementById('longitude').value = place.geometry.location.lng();
            });

            // Evento para actualizar latitud y longitud cuando el marcador es arrastrado
            google.maps.event.addListener(marker, 'dragend', function () {
                const position = marker.getPosition();
                document.getElementById('latitude').value = position.lat();
                document.getElementById('longitude').value = position.lng();
            });
        }

        // Confirmar la orden
        document.getElementById('confirm-order-btn').addEventListener('click', function () {
            const address = document.getElementById('address-input').value;
            const latitude = document.getElementById('latitude').value;
            const longitude = document.getElementById('longitude').value;
            const branchId = document.getElementById('branch').value;

            if (!address || !latitude || !longitude) {
                alert('Debes seleccionar una dirección válida.');
                return;
            }

            // Enviar los datos al servidor
            fetch("{{ route('checkout.store') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    address: address,
                    latitude: latitude,
                    longitude: longitude,
                    branch_id: branchId
                })
            }).then(response => {
                if (response.ok) {
                    alert('Orden confirmada');
                    window.location.href = '{{ route("index") }}';
                }
            });
        });
    </script>

    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBMznw6Z7nd2ODWJv8WnYuE_MiAujSmLUc&libraries=places&callback=initMap">
    </script>
@endsection
