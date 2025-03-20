document.addEventListener('DOMContentLoaded', function() {
    (function(g) {
        var h, a, k, p = "The Google Maps JavaScript API",
            c = "google",
            l = "importLibrary",
            q = "__ib__",
            m = document,
            b = window;
        b = b[c] || (b[c] = {});
        var d = b.maps || (b.maps = {}),
            r = new Set,
            e = new URLSearchParams,
            u = () => h || (h = new Promise(async (f, n) => {
                await (a = m.createElement("script"));
                e.set("libraries", [...r] + "");
                for (k in g) e.set(k.replace(/[A-Z]/g, t => "_" + t[0].toLowerCase()), g[
                    k]);
                e.set("callback", c + ".maps." + q);
                a.src = `https://maps.${c}apis.com/maps/api/js?` + e;
                d[q] = f;
                a.onerror = () => h = n(Error(p + " could not load."));
                a.nonce = m.querySelector("script[nonce]")?.nonce || "";
                m.head.append(a)
            }));
        d[l] ? console.warn(p + " only loads once. Ignoring:", g) : d[l] = (f, ...n) => r.add(f) && u()
            .then(() =>
                d[l](f, ...n))
    })
    ({
        key: "AIzaSyBuFhpW6QCgQnxjTzBgjDjnrobuFsH5JPg",
        v: "weekly",
        libraries: "places"
    });

    // Map initialization function
    let map, map2, marker, marker2, geocoder, geocoder2;

    async function initMap(center = {
        lat: -3.2442949,
        lng: 125.3647324
    }) {
        // Request needed libraries.                
        const {
            Map
        } = await google.maps.importLibrary("maps");
        const {
            AdvancedMarkerElement
        } = await google.maps.importLibrary("marker");

        // Initialize the map
        map = new Map(document.body.querySelector('#map'), {
            zoom: 5,
            center: center,
            mapId: "e7408814fc35d686"
        });

        map2 = new Map(document.body.querySelector('#map2'), {
            zoom: 5,
            center: center,
            mapId: "e7408814fc35d686"
        });

        marker = new AdvancedMarkerElement({
            position: center,
            map: map,
            gmpDraggable: true,
        });

        marker2 = new AdvancedMarkerElement({
            position: center,
            map: map2,
            gmpDraggable: true,
        });

        marker.addListener('dragend', () => {
            const newPosition = marker.position;
            getAddress(newPosition, map);
        });

        marker2.addListener('dragend', () => {
            const newPosition = marker2.position;
            getAddress2(newPosition, map2);
        });

        geocoder = new google.maps.Geocoder();

        geocoder2 = new google.maps.Geocoder();

        const {
            Autocomplete
        } = await google.maps.importLibrary("places");
        const autocompleteInput = document.getElementById('alamat');
        const autocompleteInput2 = document.getElementById('alamat2');

        const autocomplete = new Autocomplete(autocompleteInput);
        const autocomplete2 = new Autocomplete(autocompleteInput2);

        autocomplete.addListener('place_changed', () => {
            marker.map = null;

            const place = autocomplete.getPlace();

            if (!place.geometry || !place.geometry.location) {
                alert("No details available for input: '" + place.name + "'");
                return;
            }

            if (place.geometry.viewport) {
                const location = place.geometry.location;

                map.panTo(location);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }

            marker.position = {
                lat: place.geometry.location.lat(),
                lng: place.geometry.location.lng()
            };
            marker.map = map;

            changePlace(place, map)
        });

        autocomplete2.addListener('place_changed', () => {
            marker2.map = null;

            const place = autocomplete2.getPlace();

            if (!place.geometry || !place.geometry.location) {
                alert("No details available for input: '" + place.name + "'");
                return;
            }

            if (place.geometry.viewport) {
                const location = place.geometry.location;

                map2.panTo(location);
            } else {
                map2.setCenter(place.geometry.location);
                map2.setZoom(17);
            }

            marker2.position = {
                lat: place.geometry.location.lat(),
                lng: place.geometry.location.lng()
            };
            marker2.map = map2;

            changePlace(place, map2)
        });
    }

    function getAddress(location, map) {
        geocoder.geocode({
            location: location
        }, (results, status) => {
            if (status === "OK") {
                if (results[0]) {
                    changePlace(results[0], map)
                } else {
                    alert("No results found");
                }
            } else {
                alert("Geocoder failed due to: " + status);
            }
        });
    }

    function getAddress2(location, map) {
        geocoder2.geocode({
            location: location
        }, (results, status) => {
            if (status === "OK") {
                if (results[0]) {
                    changePlace(results[0], map)
                } else {
                    alert("No results found");
                }
            } else {
                alert("Geocoder failed due to: " + status);
            }
        });
    }

    function changePlace(data, map) {
        Livewire.dispatch("placeChanged", [
            data.formatted_address,
            data.geometry.location.lat(),
            data.geometry.location.lng()
        ])

        map.setCenter(data.geometry.location);
        map.setZoom(17);
    }

    Livewire.on('modalOpened', () => {
        initMap();
    });

    Livewire.on('editModalOpened', () => {
        setTimeout(() => {     
            var editLatitude = document.getElementById('editLatitude').value;
            var editLongitude = document.getElementById('editLongitude').value;
    
            var center = {
                lat: parseFloat(editLatitude),
                lng: parseFloat(editLongitude)
            }
    
            initMap(center);
        }, 100);
    })
});