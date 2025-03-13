document.addEventListener('DOMContentLoaded', function () {
    (function (g) {
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
        });

    // Map initialization function
    let map;

    async function initMap() {
        const position = {
            lat: -6.920546885515135,
            lng: 107.6108261373316
        };
        // Request needed libraries.
        //@ts-ignore
        const {
            Map
        } = await google.maps.importLibrary("maps");
        const {
            AdvancedMarkerElement
        } = await google.maps.importLibrary("marker");

        // Initialize the map
        map = new Map(document.getElementById("map"), {
            zoom: 19,
            center: position,
            mapId: "e7408814fc35d686",
            mapTypeId: "terrain",
        });

        var markers = [];
        var infoWindows = [];
        var contents = [];

        const towerImg = document.createElement("img");

        towerImg.src =
            "https://svgsilh.com/svg_v2/310252.svg";
        towerImg.width = 50;
        towerImg.height = 50;

        towers.forEach((item, i) => {
            markers[i] = new AdvancedMarkerElement({
                map: map,
                position: new google.maps.LatLng(parseFloat(item.latitude), parseFloat(item.longitude)),
                gmpClickable: true,
                content: towerImg,
            });

            contents[i] = `
                <div class="p-2">
                    <h1 class="text-lg uppercase font-bold mb-3">${item.name}</h1>
                    <p class="text-md mb-3">Tower no. ${item.no}</h1>
                    <div>${item.alamat}</div>
                    <div class="w-full mt-3">
                       
                    </div>
                </div>
            `;

            infoWindows[i] = new google.maps.InfoWindow({
                content: contents[i],
                maxWidth: 500,
            })

            markers[i].addListener('click', (e) => {
                for (let x = 0; x < markers.length; x++) {
                    infoWindows[x].close()
                }

                infoWindows[i].open({
                    anchor: markers[i],
                    map
                })
            })
        });
    }

    initMap();
});