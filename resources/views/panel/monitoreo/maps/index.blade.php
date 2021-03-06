@extends('adminlte::page')

@section('title', 'Municipio VC')

@section('content_header')
    <h1>Ubicaciones de cámaras</h1>
@stop

@section('content')

    <div id="map"></div>

@stop

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />

    <style>
        #map {
            clear: both;
            position: relative;
            width: 100%;
            height: 100vh;
        }

    </style>

@stop

@section('js')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>

    <script>
        const api_url = 'http://smartvc.intranet.villaconstitucion.gob.ar/api/monitoreo/camaras';

        var domos = L.layerGroup();
        var fijas = L.layerGroup();

        async function getISS() {
            const response = await fetch(api_url)
            const data = await response.json();
            console.log(response)
            console.log(data)

            var markers = [];

            for (const camera of data) {
                markers.push([camera.name, camera.lat, camera.lng, camera.type, camera.status])
            }

            const domeIcon = L.icon({
                iconUrl: "{{ asset('img/dome.png') }}",
                iconSize: [32, 32],
                iconAnchor: [25, 25]
            });

            const domeOutIcon = L.icon({
                iconUrl: "{{ asset('img/domeOut.png') }}",
                iconSize: [32, 32],
                iconAnchor: [25, 25]
            });

            const fixedIcon = L.icon({
                iconUrl: "{{ asset('img/cctv.png') }}",
                iconSize: [32, 32],
                iconAnchor: [25, 25]
            });

            const fixedOutIcon = L.icon({
                iconUrl: "{{ asset('img/cctvOut.png') }}",
                iconSize: [32, 32],
                iconAnchor: [25, 25]
            });


            for (var i = 0; i < markers.length; i++) {

                let icon = ""

                if (markers[i][4] === 1) {
                    if (markers[i][3] === 1) {
                        icon = fixedIcon
                        var marker = L.marker([markers[i][1], markers[i][2]], {
                            icon: icon
                        }).bindPopup("Nombre: " + markers[i][0]).addTo(fijas);
                    } else {
                        icon = domeIcon
                        var marker = L.marker([markers[i][1], markers[i][2]], {
                            icon: icon
                        }).bindPopup("Nombre: " + markers[i][0]).addTo(domos);
                    }
                } else {
                    if (markers[i][3] === 1) {
                        icon = fixedOutIcon
                        var marker = L.marker([markers[i][1], markers[i][2]], {
                                icon: icon
                            })
                            .bindPopup("Nombre: " + markers[i][0]).addTo(fijas);
                    } else {
                        icon = domeOutIcon
                        var marker = L.marker([markers[i][1], markers[i][2]], {
                            icon: icon
                        }).bindPopup("Nombre: " + markers[i][0]).addTo(domos);

                    }
                }

            }

        }

        getISS();

        var mbAttr =
            'Dirección de Tecnología y Sistemas - Municipio de Villa Constitución';
        var mbUrl =
            'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';

        var grayscale = L.tileLayer(mbUrl, {
            id: 'mapbox/light-v9',
            tileSize: 512,
            zoomOffset: -1,
            attribution: mbAttr
        });
        var streets = L.tileLayer(mbUrl, {
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            attribution: mbAttr
        });

        var map = L.map('map', {
            center: [-33.233425, -60.324238],
            zoom: 14,
            layers: [grayscale, domos, fijas]
        });

        var baseLayers = {
            'Grises': grayscale,
            'Color': streets
        };

        var overlays = {
            'Domos': domos,
            'Fijas': fijas
        };

        var layerControl = L.control.layers(baseLayers, overlays).addTo(map);

        function rechargeMap() {
            domos.clearLayers();
            fijas.clearLayers();
            getISS();
        }
    </script>



@stop
