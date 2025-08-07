<!DOCTYPE html>
<html>
    <head>
        <title>Peta GeoJSON Tulang Bawang</title>
        <meta charset="utf-8" />
        <style>
            #map {
                height: 100vh;
                width: 100%;
            }
        </style>
    </head>
    <body>
        <h3>Peta GeoJSON Tulang Bawang</h3>
        <div id="map"></div>

        <script>
            function initMap() {
                const map = new google.maps.Map(
                    document.getElementById("map"),
                    {
                       center: { lat: -4.2165, lng: 105.235 },
                    zoom: 12,
                    }
                );

                map.data.loadGeoJson("{{ asset('id1808_tulangbawang.geojson') }}");

                map.data.setStyle(function(feature) {
                    return {
                        fillColor: '#A3D3A1',      // Warna isi (hijau terang, bisa diganti)
                        fillOpacity: 0.3,          // Transparansi isi
                        strokeColor: '#000000',    // Warna garis batas wilayah (hitam)
                        strokeWeight: 2,           // Ketebalan garis batas
                        strokeOpacity: 1
                    };
                    });


                map.data.addListener("click", function (event) {
                    const name = event.feature.getProperty("village") || "Wilayah";
                    const infoWindow = new google.maps.InfoWindow({
                        content: `<strong>${name}</strong>`,
                        position: event.latLng,
                    });
                    infoWindow.open(map);
                });
            }
        </script>

        <!-- Ganti `YOUR_API_KEY` dengan API Key Google Maps kamu -->
        <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1ciH1POERPcBC50HdxVN3h1Ts2bIWSOQ&callback=initMap"
            async
            defer
        ></script>
    </body>
</html>
