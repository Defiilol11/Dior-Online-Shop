@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/payment.css') }}">
<div class="checkout-page">
    <h1>Seleccionar dirección de envío</h1>
    <p class="breadcrumb"><a href="{{ url('/') }}">Inicio</a> / Checkout</p>

    <div id="new-address-section">
        <label for="address-input" class="checkout-label">Buscar dirección:</label>
        <input id="address-input" type="text" class="checkout-input-field" placeholder="Escribe tu dirección" />
        <input type="hidden" id="latitude" name="latitude">
        <input type="hidden" id="longitude" name="longitude">
    </div>

    <div id="map" style="height: 400px; width: 100%; margin-top: 20px;"></div>

    <div class="branch-map-section">
        <h3>Sucursales disponibles</h3>
        <div id="branch-map" style="height: 400px; width: 100%;"></div>
    </div>

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
            <input type="radio" name="payment_method" value="tarjeta" required onclick="showPaymentForm('card')">
            Tarjeta de Crédito/Débito
        </label>
        <label>
            <input type="radio" name="payment_method" value="transferencia" required onclick="showPaymentForm('transfer')">
            Transferencia Bancaria
        </label>
        <label>
            <input type="radio" name="payment_method" value="efectivo" required onclick="showPaymentForm('cash')">
            Pago en Efectivo en la Entrega
        </label>
    </div>

    <div id="payment-details" style="margin-top: 20px;">
        <div id="card-form" class="checkout-payment-form" style="display: none;">
            <h4>Datos de la Tarjeta</h4>
            <div class="checkout-form-group">
                <label for="card-name">Nombre en la tarjeta:</label>
                <input type="text" id="card-name" class="checkout-input-field" placeholder="Nombre completo en la tarjeta">
            </div>
            <div class="checkout-form-group">
                <label for="card-number">Número de la tarjeta:</label>
                <input type="text" id="card-number" class="checkout-input-field" placeholder="1234 5678 9101 1121">
            </div>
            <div class="checkout-form-group">
                <label for="card-expiration">Fecha de expiración:</label>
                <input type="text" id="card-expiration" class="checkout-input-field" placeholder="MM/AA">
            </div>
            <div class="checkout-form-group">
                <label for="card-cvc">CVC:</label>
                <input type="text" id="card-cvc" class="checkout-input-field" placeholder="CVC">
            </div>
        </div>

        <div id="transfer-form" class="checkout-payment-form" style="display: none;">
            <h4>Selecciona tu banco</h4>
            <label for="bank-select" class="checkout-label">Banco:</label>
            <select id="bank-select" class="checkout-select-field">
                <option value="banrural">Banrural</option>
                <option value="bi">Banco Industrial</option>
                <option value="gyt">G&T Continental</option>
                <option value="bac">BAC Credomatic</option>
                <option value="bam">Banco Agromercantil (BAM)</option>
            </select>
        </div>

        <div id="cash-message" class="checkout-payment-form" style="display: none;">
            <h4>Pago en efectivo</h4>
            <p>Los repartidores llevan sencillo/vuelto, no te preocupes por el monto de los billetes.</p>
        </div>
    </div>

    <button id="confirm-order-btn" class="checkout-btn">Confirmar Orden</button>
</div>

<script>
    let map, branchMap, marker, autocomplete;

    function initMaps() {
        const defaultPosition = { lat: 14.6349, lng: -90.5069 };

        map = new google.maps.Map(document.getElementById('map'), {
            center: defaultPosition,
            zoom: 15
        });

        marker = new google.maps.Marker({
            map: map,
            position: defaultPosition,
            draggable: true
        });

        autocomplete = new google.maps.places.Autocomplete(document.getElementById('address-input'));
        autocomplete.bindTo('bounds', map);

        autocomplete.addListener('place_changed', function () {
            const place = autocomplete.getPlace();
            if (!place.geometry) {
                alert("No se encontró la ubicación.");
                return;
            }
            map.setCenter(place.geometry.location);
            map.setZoom(15);
            marker.setPosition(place.geometry.location);
            document.getElementById('latitude').value = place.geometry.location.lat();
            document.getElementById('longitude').value = place.geometry.location.lng();
        });

        google.maps.event.addListener(marker, 'dragend', function () {
            const position = marker.getPosition();
            document.getElementById('latitude').value = position.lat();
            document.getElementById('longitude').value = position.lng();
        });

        branchMap = new google.maps.Map(document.getElementById('branch-map'), {
            center: defaultPosition,
            zoom: 12
        });

        const branches = @json($branches);
        const infoWindow = new google.maps.InfoWindow();

        branches.forEach(branch => {
            const branchPosition = { lat: parseFloat(branch.latitude), lng: parseFloat(branch.longitude) };
            const branchMarker = new google.maps.Marker({
                map: branchMap,
                position: branchPosition,
                title: branch.name
            });

            branchMarker.addListener('click', function() {
                infoWindow.setContent(branch.name);
                infoWindow.open(branchMap, branchMarker);
            });
        });
    }

    function showPaymentForm(paymentMethod) {
        document.getElementById('card-form').style.display = 'none';
        document.getElementById('transfer-form').style.display = 'none';
        document.getElementById('cash-message').style.display = 'none';

        if (paymentMethod === 'card') {
            document.getElementById('card-form').style.display = 'block';
        } else if (paymentMethod === 'transfer') {
            document.getElementById('transfer-form').style.display = 'block';
        } else if (paymentMethod === 'cash') {
            document.getElementById('cash-message').style.display = 'block';
        }
    }

    document.getElementById('confirm-order-btn').addEventListener('click', function () {
        const address = document.getElementById('address-input').value;
        const latitude = document.getElementById('latitude').value;
        const longitude = document.getElementById('longitude').value;
        const branchId = document.getElementById('branch').value;

        if (!address || !latitude || !longitude) {
            alert('Debes ingresar una dirección válida.');
            return;
        }

        const paymentMethod = document.querySelector('input[name="payment_method"]:checked');
        if (!paymentMethod) {
            alert('Por favor, selecciona un método de pago.');
            return;
        }

        let paymentData = {};
        if (paymentMethod.value === 'tarjeta') {
            const cardName = document.getElementById('card-name').value;
            const cardNumber = document.getElementById('card-number').value;
            const cardExpiration = document.getElementById('card-expiration').value;
            const cardCVC = document.getElementById('card-cvc').value;

            if (!cardName || !cardNumber || !cardExpiration || !cardCVC) {
                alert('Por favor, completa todos los campos de la tarjeta.');
                return;
            }

            paymentData = {
                card_name: cardName,
                card_number: cardNumber,
                card_expiration: cardExpiration,
                card_cvc: cardCVC
            };
        } else if (paymentMethod.value === 'transferencia') {
            const bank = document.getElementById('bank-select').value;
            paymentData = { bank: bank };
        }

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
                branch_id: branchId,
                payment_method: paymentMethod.value,
                payment_data: paymentData
            })
        }).then(response => {
            if (response.ok) {
                alert('Orden confirmada');
                window.location.href = '{{ route("index") }}';
            } else {
                alert('Hubo un problema al confirmar tu orden.');
            }
        }).catch(error => {
            console.error('Error:', error);
            alert('Hubo un error en el servidor.');
        });
    });
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBMznw6Z7nd2ODWJv8WnYuE_MiAujSmLUc&libraries=places&callback=initMaps"></script>
@endsection
