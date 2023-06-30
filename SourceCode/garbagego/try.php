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


<!-- <!DOCTYPE html>
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
</html> -->



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


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Map Example</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css">
  <style>
    #map {
      height: 400px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Map Example</h1>
    <div class="form-group">
      <label for="start">Start Point:</label>
      <input type="text" id="start" class="form-control" placeholder="Enter start point">
    </div>
    <div class="form-group">
      <label for="end">End Point:</label>
      <input type="text" id="end" class="form-control" placeholder="Enter end point">
    </div>
    <button id="submit" class="btn btn-primary">Get Route</button>
    <div id="map"></div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>
  <script>$(document).ready(function() {
  var startInput = $('#start');
  var endInput = $('#end');
  var submitButton = $('#submit');
  var map = L.map('map').setView([0, 0], 2);
  var markersLayer = new L.LayerGroup().addTo(map);

  // Add tile layer to the map
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
    maxZoom: 18,
  }).addTo(map);

  // Handle form submission
  submitButton.click(function() {
    var start = startInput.val();
    var end = endInput.val();

    // Clear previous markers and routes
    markersLayer.clearLayers();

    // Get route from start to end
    var url = 'https://api.mapbox.com/directions/v5/mapbox/driving/' + start + ';' + end + '?access_token=YOUR_MAPBOX_ACCESS_TOKEN';
    $.getJSON(url, function(data) {
      var coordinates = data.routes[0].geometry.coordinates;

      // Create markers for start and end points
      var startMarker = L.marker([coordinates[0][1], coordinates[0][0]]).addTo(markersLayer);
      var endMarker = L.marker([coordinates[coordinates.length - 1][1], coordinates[coordinates.length - 1][0]]).addTo(markersLayer);

      // Create polyline for the route
      var route = L.polyline(coordinates.map(function(coord) {
        return [coord[1], coord[0]];
      })).addTo(map);

      // Fit the map to show all markers and the route
      map.fitBounds(markersLayer.getBounds());
    });

    return false;
  });
});
</script>
</body>
</html>















