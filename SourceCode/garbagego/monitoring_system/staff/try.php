<!-- <!DOCTYPE html>
<html>
<head>
  <title>Animated Label Input</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <style>
    .form-group {
      position: relative;
    }
    .form-group input,
    .form-group select,
    .form-group textarea {
      padding-top: 0.620rem; /* Reduced padding on the top */
    }
    .form-group label {
      position: absolute;
      top: 0.5rem; /* Added top padding */
      left: 1.3rem; /* Added left padding */
      pointer-events: none;
      transition: all 0.3s;
      transform-origin: 0 0;
    }
    .form-group input:focus + label,
    .form-group input:not(:placeholder-shown) + label,
    .form-group select:focus + label,
    .form-group select:valid + label,
    .form-group textarea:focus + label,
    .form-group textarea:not(:placeholder-shown) + label {
      transform: translateY(-100%) scale(0.75);
      font-size: 0.9em; /* Increase font size */
      opacity: 0.75;
      left: 0; /* Remove left margin */
      bottom: 1.0rem
    }
  </style>
</head>
<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <form>
          <div class="form-group">
            <input type="text" class="form-control" id="exampleInput" placeholder=" " required>
            <label for="exampleInput">Type something</label>
          </div>
          <div class="form-group">
            <input type="date" class="form-control" id="exampleDate" required>
            <label for="exampleDate">Enter a date</label>
          </div>
          <div class="form-group">
            <select class="form-control" id="exampleSelect" required>
              <option value="" selected disabled> </option>
              <option value="1">Option 1</option>
              <option value="2">Option 2</option>
              <option value="3">Option 3</option>
            </select>
            <label for="exampleSelect">Gender</label>
          </div>
          <div class="form-group">
            <input type="number" class="form-control" id="exampleNumber" required>
            <label for="exampleNumber">Enter a number</label>
          </div>
          <div class="form-group">
            <input type="password" class="form-control" id="examplePassword" required>
            <label for="examplePassword">Enter a password</label>
          </div>
          <div class="form-group">
            <input type="email" class="form-control" id="exampleEmail" required>
            <label for="exampleEmail">Enter an email</label>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script>
    $(document).ready(function() {
      // Handle label animation for select input
      $('.form-group select').on('change', function() {
        if ($(this).val()) {
          $(this).addClass('filled');
        } else {
          $(this).removeClass('filled');
        }
      });

      // Handle label animation for date input
      $('#exampleDate').on('input focus', function() {
        if ($(this).val()) {
          $('label[for="exampleDate"]').addClass('filled');
        } else {
          $('label[for="exampleDate"]').removeClass('filled');
        }
      });
    });
  </script>
</body>
</html>
 -->

<html>
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
