@extends('layouts.app')

@section('content')
    <div class="checkout-page">
        <h1>Selecciona tu Dirección de Envío</h1>

        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf

            <div class="map-container">
                <input id="searchBox" class="controls" type="text" placeholder="Buscar ubicación" />
                <div id="map"></div>
            </div>

            <input type="hidden" id="latitude" name="latitude">
            <input type="hidden" id="longitude" name="longitude">
            <input type="hidden" id="address" name="address">

            <label for="sucursal">Selecciona una Sucursal:</label>
            <select name="sucursal" id="sucursal" required>
                <option value="Sucursal 1">Zona 10</option>
                <option value="Sucursal 2">Sucursal 2</option>
                <option value="Sucursal 3">Sucursal 3</option>
            </select>

            <button type="submit" class="btn btn-primary">Procesar Orden</button>
        </form>
    </div>

    <script>
        let map, marker, searchBox;

        function initMap() {
            const initialPosition = { lat: 14.634915, lng: -90.506882 }; // Posición inicial de ejemplo

            map = new google.maps.Map(document.getElementById('map'), {
                center: initialPosition,
                zoom: 15,
            });

            marker = new google.maps.Marker({
                position: initialPosition,
                map: map,
                draggable: true,
            });

            searchBox = new google.maps.places.SearchBox(document.getElementById('searchBox'));
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(document.getElementById('searchBox'));

            // Actualizar la posición del marcador cuando el usuario selecciona una ubicación
            searchBox.addListener('places_changed', () => {
                const places = searchBox.getPlaces();
                if (places.length === 0) {
                    return;
                }

                const place = places[0];
                if (!place.geometry || !place.geometry.location) {
                    return;
                }

                marker.setPosition(place.geometry.location);
                map.setCenter(place.geometry.location);

                document.getElementById('latitude').value = place.geometry.location.lat();
                document.getElementById('longitude').value = place.geometry.location.lng();
                document.getElementById('address').value = place.formatted_address;
            });

            // Actualizar los campos cuando el marcador es arrastrado
            marker.addListener('dragend', () => {
                const position = marker.getPosition();
                document.getElementById('latitude').value = position.lat();
                document.getElementById('longitude').value = position.lng();
            });
        }
    </script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBMznw6Z7nd2ODWJv8WnYuE_MiAujSmLUc&libraries=places&callback=initMap"></script>
@endsection
