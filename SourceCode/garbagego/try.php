<!-- <!DOCTYPE html>
<html>

<head>
  <title>Geolocation</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />

  <style>
    body {
      margin: 0;
      padding: 0;
    }
  </style>

</head>

<body>
  <div id="map" style="width:100%; height: 100vh"></div>
  <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"></script>
  <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>


  <script>

    var map = L.map('map').setView([13.9416, 120.6270], 11);
    mapLink = "<a href='http://openstreetmap.org'>OpenStreetMap</a>";
    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', { attribution: 'Leaflet &copy; ' + mapLink + ', contribution', maxZoom: 18 }).addTo(map);

    var taxiIcon = L.icon({
      iconUrl: 'img/taxi.png',
      iconSize: [70, 70]
    })

    var marker = L.marker([13.9416, 120.6270], { icon: taxiIcon }).addTo(map);

    map.on('click', function (e) {
      console.log(e)
      var newMarker = L.marker([e.latlng.lat, e.latlng.lng]).addTo(map);
      L.Routing.control({
        waypoints: [
          L.latLng(13.9416, 120.6270),
          L.latLng(e.latlng.lat, e.latlng.lng)
        ]
      }).on('routesfound', function (e) {
        var routes = e.routes;
        console.log(routes);

        e.routes[0].coordinates.forEach(function (coord, index) {
          setTimeout(function () {
            marker.setLatLng([coord.lat, coord.lng]);
          }, 100 * index)
        })

      }).addTo(map);
    });


  </script>


</body>

</html> -->


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realtime location tracker</title>


    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

    <style>
        body {
            margin: 0;
            padding: 0;
        }

        #map {
            width: 100%;
            height: 100vh;
        }
    </style>
</head>

<body>
    <div id="map"></div>


<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script>
    
    var map = L.map('map').setView([14.0860746, 100.608406], 6);

    var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    });
    osm.addTo(map);

    if(!navigator.geolocation) {
        console.log("Your browser doesn't support geolocation feature!")
    } else {
        setInterval(() => {
            navigator.geolocation.getCurrentPosition(getPosition)
        }, 5000);
    }

    var marker, circle;

    function getPosition(position){
      
        var lat = position.coords.latitude
        var long = position.coords.longitude
        var accuracy = position.coords.accuracy

        if(marker) {
            map.removeLayer(marker)
        }

        if(circle) {
            map.removeLayer(circle)
        }

        marker = L.marker([lat, long])
        circle = L.circle([lat, long], {radius: accuracy})

        var featureGroup = L.featureGroup([marker, circle]).addTo(map)

        map.fitBounds(featureGroup.getBounds())

        console.log("Your coordinate is: Lat: "+ lat +" Long: "+ long+ " Accuracy: "+ accuracy)
    }

</script>
</body>
</html>



<!-- <!DOCTYPE html>
<html>
<head>
  <title>Theme Changer</title>
  <style id="theme">
    /* Default theme styles */
    body {
      background-color: #f2f2f2;
      color: #333;
    }
  </style>
</head>
<body>
  <h1>Theme Changer</h1>

  <label for="color-picker">Select a theme color:</label>
  <input type="color" id="color-picker">

  <script>
    // Retrieve the color picker element
    const colorPicker = document.getElementById('color-picker');
    
    // Add an event listener to the color picker
    colorPicker.addEventListener('change', function(event) {
      const color = event.target.value;

      // Update the theme styles with the selected color
      const themeStyle = document.getElementById('theme');
      themeStyle.innerHTML = `
        body {
          background-color: ${color};
          color: ${getContrastColor(color)};
        }
      `;
    });

    // Function to determine the contrast color based on the selected background color
    function getContrastColor(color) {
      // Convert the hexadecimal color to RGB values
      const hexToRGB = (hex) => hex.match(/[A-Za-z0-9]{2}/g).map((v) => parseInt(v, 16));
      const [r, g, b] = hexToRGB(color);

      // Calculate the relative luminance of the color
      const luminance = (0.299 * r + 0.587 * g + 0.114 * b) / 255;

      // Choose black or white as the contrast color depending on the luminance
      return luminance > 0.5 ? '#000' : '#fff';
    }
  </script>
</body>
</html> -->














