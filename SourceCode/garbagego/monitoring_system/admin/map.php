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

    var map = L.map('map').setView([28.2380, 83.9956], 11);
    mapLink = "<a href='http://openstreetmap.org'>OpenStreetMap</a>";
    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', { attribution: 'Leaflet &copy; ' + mapLink + ', contribution', maxZoom: 18 }).addTo(map);

    var taxiIcon = L.icon({
      iconUrl: 'img/taxi.png',
      iconSize: [70, 70]
    })

    var marker = L.marker([28.2380, 83.9956], { icon: taxiIcon }).addTo(map);

    map.on('click', function (e) {
      console.log(e)
      var newMarker = L.marker([e.latlng.lat, e.latlng.lng]).addTo(map);
      L.Routing.control({
        waypoints: [
          L.latLng(28.2380, 83.9956),
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


<!-- <html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.css" />
    <link rel="stylesheet" href="css/style.css">
    <style>
        #map {
            height: 100vh;
            width: 100%;
            position: relative;
        }

        .formBlock {
            max-width: 300px;
            background-color: #FFF;
            border: 1px solid #ddd;
            position: absolute;
            top: 10px;
            left: 10px;
            padding: 10px;
            z-index: 999;
            box-shadow: 0 1px 5px rgba(0,0,0,0.65);
            border-radius: 5px;
            width: 100%;
        }

        .leaflet-top .leaflet-control {
            margin-top: 180px;
        }

        .input {
            padding: 10px;
            width: 100%;
            border: 1px solid #ddd;
            font-size: 15px;
            border-radius: 3px;
        }

        #form {
            padding: 0;
            margin: 0;
        }

        input:nth-child(1) {
            margin-bottom: 10px;
        }
    </style>
</head>
<body style='border:0; margin: 0'>
    <div id='map'></div>
    <div class="formBlock">
        <form id="form">
            <input type="text" name="start" class="input" id="start" placeholder="Choose starting point" />
            <input type="text" name="end" class="input" id="destination" placeholder="Choose starting point" />
            <button style="display: none;" type="submit">Get Directions</button>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.js"></script>
    <script src="https://www.mapquestapi.com/sdk/leaflet/v2.2/mq-map.js?key=TDRRaX9wx0hftJTBnmvKUO0MCId12FP8"></script>
    <script src="https://www.mapquestapi.com/sdk/leaflet/v2.2/mq-routing.js?key=TDRRaX9wx0hftJTBnmvKUO0MCId12FP8"></script>
    <script>
        // default map layer
        let map = L.map('map', {
            layers: MQ.mapLayer(),
            center: [13.9011, 120.6196],
            zoom: 12
        });

        // traffic layer
        const trafficLayer = L.tileLayer('https://tiles.mapquestapi.com/traffic/v2/flow?key=TDRRaX9wx0hftJTBnmvKUO0MCId12FP8&mapSize=512,512,1', {
            attribution: 'Traffic data &copy; MapQuest',
            tileSize: 512,
            zoomOffset: -1,
            opacity: 0.5
        });

        // function to show traffic
        function showTraffic() {
            if (document.getElementById('trafficCheckbox').checked) {
                map.addLayer(trafficLayer);
            } else {
                map.removeLayer(trafficLayer);
            }
        }

        // event listener for traffic checkbox
        const trafficCheckbox = document.getElementById('trafficCheckbox');
        trafficCheckbox.addEventListener('change', showTraffic);

        function runDirection(start, end) {

            // recreating new map layer after removal
            map = L.map('map', {
                layers: MQ.mapLayer(),
                center: [13.9011, 120.6196],
                zoom: 12
            });

            // add traffic layer if checkbox is checked
            if (document.getElementById('trafficCheckbox').checked) {
                map.addLayer(trafficLayer);
            }

            var dir = MQ.routing.directions();

            dir.route({
                locations: [
                    start,
                    end
                ]
            });

            CustomRouteLayer = MQ.Routing.RouteLayer.extend({
                createStartMarker: (location) => {
                    var custom_icon;
                    var marker;

                    custom_icon = L.icon({
                        iconUrl: 'img/red.png',
                        iconSize: [20, 29],
                        iconAnchor: [10, 29],
                        popupAnchor: [0, -29]
                    });

                    marker = L.marker(location.latLng, { icon: custom_icon }).addTo(map);

                    return marker;
                },

                createEndMarker: (location) => {
                    var custom_icon;
                    var marker;

                    custom_icon = L.icon({
                        iconUrl: 'img/blue.png',
                        iconSize: [20, 29],
                        iconAnchor: [10, 29],
                        popupAnchor: [0, -29]
                    });

                    marker = L.marker(location.latLng, { icon: custom_icon }).addTo(map);

                    return marker;
                }
            });

            map.addLayer(new CustomRouteLayer({
                directions: dir,
                fitBounds: true
            }));
        }


        // function that runs when form submitted
        function submitForm(event) {
            event.preventDefault();

            // delete current map layer
            map.remove();

            // getting form data
            start = document.getElementById("start").value;
            end = document.getElementById("destination").value;

            // run directions function
            runDirection(start, end);

            // reset form
            document.getElementById("form").reset();
        }

        // assign the form to form variable
        const form = document.getElementById('form');

        // call the submitForm() function when submitting the form
        form.addEventListener('submit', submitForm);
    </script>
</body>
</html>
 -->

<!DOCTYPE html>
<html>
<head>
  <title>Traffic API Demo</title>
  <!-- Include Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <!-- Include Leaflet CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css">
  <!-- Include SweetAlert CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
  <style>
    .legend {
      background-color: white;
      border: 1px solid #ccc;
      padding: 10px;
      max-width: 200px;
    }
    .legend-item {
      display: flex;
      align-items: center;
      margin-bottom: 5px;
    }
    .legend-item i {
      display: inline-block;
      width: 20px;
      height: 29px; /* Adjust the height to match the icon size */
      margin-right: 5px;
      background-size: contain;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Traffic API Demo</h1>
    <div id="map" style="height: 500px;"></div>
    <select id="barangaySelect" class="form-control mt-3">
      <option value="14.5243,120.9345,14.6507,121.0552">Manila, Philippines</option>
      <option value="13.859,120.575,13.930,120.645">Lian, Batangas</option>
      <option value="13.8619,120.5878,13.8847,120.6047">Bagong Pook</option>
      <option value="13.8877,120.6081,13.9047,120.6253">Balibago</option>
      <option value="13.9066,120.5709,13.9236,120.5889">Binubusan</option>
      <option value="13.9071,120.6314,13.9241,120.6484">Bungahan</option>
      <option value="13.8831,120.5562,13.9001,120.5733">Cumba</option>
      <option value="13.9071,120.6176,13.9241,120.6346">Humayingan</option>
      <option value="13.9165,120.6518,13.9335,120.6688">Kapito</option>
      <option value="13.9105,120.5733,13.9275,120.5904">Lumaniag</option>
      <option value="13.8845,120.5818,13.9015,120.5989">Luyahan</option>
      <option value="13.9044,120.6072,13.9214,120.6242">Malaruhatan</option>
      <option value="13.9007,120.6154,13.9177,120.6325">Matabungkay</option>
      <option value="13.9035,120.6061,13.9205,120.6232">Barangay 1 or Bonbon(Pob.)</option>
      <option value="13.9064,120.6128,13.9234,120.6299">Barangay 2 (Pob.)</option>
      <option value="13.9108,120.6105,13.9278,120.6276">Barangay 3 (Pob.)</option>
      <option value="13.9096,120.6093,13.9266,120.6263">Barangay 4 (Pob.)</option>
      <option value="13.9158,120.6188,13.9328,120.6358">Barangay 5 or Tabok City (Pob.)</option>
      <option value="13.9174,120.6379,13.9344,120.6549">Prenza</option>
      <option value="13.8993,120.5914,13.9163,120.6084">Puting-Kahoy</option>
      <option value="13.9000,120.6299,13.9170,120.6469">San Diego</option>
    </select>

    <div class="legend mt-3">
      <h5>Legend</h5>
      <div class="legend-item">
        <i style="background-image: url('https://cdn.mapquestapi.com/icons/v1/red_low_sm.png');"></i> Construction (Low Severity, Small Size)
      </div>
      <div class="legend-item">
        <i style="background-image: url('https://cdn.mapquestapi.com/icons/v1/red_medium_lg.png');"></i> Construction (Medium Severity, Large Size)
      </div>
      <div class="legend-item">
        <i style="background-image: url('https://cdn.mapquestapi.com/icons/v1/red_high_md.png');"></i> Construction (High Severity, Medium Size)
      </div>
      <div class="legend-item">
        <i style="background-image: url('https://cdn.mapquestapi.com/icons/v1/blue_low_sm.png');"></i> Incident (Low Severity, Small Size)
      </div>
      <div class="legend-item">
        <i style="background-image: url('https://cdn.mapquestapi.com/icons/v1/blue_medium_lg.png');"></i> Incident (Medium Severity, Large Size)
      </div>
      <div class="legend-item">
        <i style="background-image: url('https://cdn.mapquestapi.com/icons/v1/blue_high_md.png');"></i> Incident (High Severity, Medium Size)
      </div>
    </div>
  </div>

  <!-- Include Bootstrap JS and Leaflet JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
  <!-- Include SweetAlert JS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.js"></script>

  <script>
    var map = L.map('map').setView([13.924, 120.625], 13); // Initial map center and zoom level
    var markers = [];

    // Add the base map layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Fetch traffic data from MapQuest API endpoint
    function fetchTrafficData(boundingBox) {
      clearMarkers();

      fetch('https://www.mapquestapi.com/traffic/v2/incidents?key=TDRRaX9wx0hftJTBnmvKUO0MCId12FP8&boundingBox=' + boundingBox + '&filters=construction,incidents')
        .then(response => response.json())
        .then(data => {
          // Process the traffic data
          var incidents = data.incidents;
          if (incidents.length === 0) {
            // Display a message using SweetAlert if there are no traffic incidents
            Swal.fire({
              icon: 'info',
              title: 'No Traffic Incidents',
              text: 'There are no traffic incidents found.'
            });
          } else {
            incidents.forEach(incident => {
              // Extract incident coordinates
              var coordinates = incident.parameterizedDescription.coordinates.split(',');

              // Determine the icon color and size based on incident type and severity
              var iconColor = 'blue';
              var iconSize = [20, 29];

              if (incident.type === 'construction') {
                iconColor = 'red';
              }

              if (incident.severity) {
                if (incident.severity === 'low') {
                  iconSize = [15, 22];
                } else if (incident.severity === 'medium') {
                  iconSize = [25, 36];
                } else if (incident.severity === 'high') {
                  iconSize = [35, 50];
                }
              }

              // Create a marker on the map for each incident
              var marker = L.marker([parseFloat(coordinates[1]), parseFloat(coordinates[0])], {
                icon: L.icon({
                  iconUrl: 'https://cdn.mapquestapi.com/icons/v1/' + iconColor + '_' + incident.severity + '_' + incident.size + '.png',
                  iconSize: iconSize,
                  iconAnchor: [iconSize[0] / 2, iconSize[1]],
                  popupAnchor: [0, -iconSize[1]]
                })
              })
                .addTo(map)
                .bindPopup(incident.fullDesc);

              markers.push(marker);
            });
          }
        });
    }

    // Clear all markers from the map
    function clearMarkers() {
      markers.forEach(marker => {
        marker.remove();
      });
      markers = [];
    }

    // Handle barangay selection change event
    document.getElementById('barangaySelect').addEventListener('change', function(event) {
      var selectedOption = event.target.value;
      if (selectedOption) {
        var boundingBox = selectedOption.split(",");
        map.panTo(new L.LatLng((parseFloat(boundingBox[0]) + parseFloat(boundingBox[2])) / 2, (parseFloat(boundingBox[1]) + parseFloat(boundingBox[3])) / 2));
        fetchTrafficData(selectedOption);
      } else {
        clearMarkers();
        Swal.fire({
          icon: 'info',
          title: 'No Barangay Selected',
          text: 'Please select a barangay.'
        });
      }
    });

    // Initialize SweetAlert library
    Swal.fire();

    // Set the default value to Lian, Batangas bounding box
    var defaultOption = document.querySelector('option[value="13.859,120.575,13.930,120.645"]');
    defaultOption.selected = true;
    var defaultBoundingBox = defaultOption.value;
    fetchTrafficData(defaultBoundingBox);
  </script>
</body>
</html>





