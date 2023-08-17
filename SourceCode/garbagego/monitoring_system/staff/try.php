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

















<!DOCTYPE html>
<html>
<head>
  <title>MapQuest API Example</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" /> <!-- Replace the integrity and crossorigin with the actual Font Awesome CSS link -->
  <style>
    #map {
      height: 500px;
    }
  </style>
</head>
<body>
  <div id="map"></div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
  <script>
$(document).ready(function() {
  // Initialize the map
  var map = L.map('map').setView([39.74, -104.99], 12);

  // Add the tile layer (replace 'your-mapbox-access-token' with your actual Mapbox access token)
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors',
    maxZoom: 18,
  }).addTo(map);

  // Make the API request
  $.getJSON('https://www.mapquestapi.com/traffic/v2/incidents', {
    outFormat: 'json',
    boundingBox: '39.80932724630671,-104.82776641845703,39.67046353361311,-105.1559829711914',
    key: 'TDRRaX9wx0hftJTBnmvKUO0MCId12FP8'
  }).done(function(data) {
    // Process the response
    var incidents = data.incidents;
    for (var i = 0; i < incidents.length; i++) {
      var incident = incidents[i];
      var lat = incident.lat;
      var lng = incident.lng;
      var severity = incident.severity;
      var type = incident.type;

      // Determine the icon and marker color based on severity
      var iconClass = '';
      var markerColor = '';
      if (severity === 1) {
        iconClass = 'fas fa-exclamation-circle text-success';
        markerColor = 'green';
      } else if (severity === 2) {
        iconClass = 'fas fa-exclamation-triangle text-warning';
        markerColor = 'orange';
      } else if (severity === 3) {
        iconClass = 'fas fa-exclamation-triangle text-danger';
        markerColor = 'red';
      } else {
        iconClass = 'fas fa-exclamation-circle';
        markerColor = 'gray';
      }

      // Create a marker with the appropriate icon and marker color for each incident and add it to the map
      L.marker([lat, lng], {
        icon: L.divIcon({ className: iconClass }),
        // Set the marker color
        riseOnHover: true,
        riseOffset: 250,
        fillColor: markerColor,
        fillOpacity: 0.8,
        stroke: false,
        radius: 8
      }).addTo(map);
    }

    // Add the legend
    var legend = L.control({ position: 'bottomright' });

    legend.onAdd = function(map) {
      var div = L.DomUtil.create('div', 'legend');
      div.style.backgroundColor = 'white'; // Set the background color to white
      div.style.padding = '10px'; // Add padding to the legend
      div.innerHTML += '<h4>Legend</h4>';
      div.innerHTML += '<div><i class="fas fa-exclamation-circle text-success"></i> Construction</div>';
      div.innerHTML += '<div><i class="fas fa-exclamation-triangle text-warning"></i> Low Severity Incident</div>';
      div.innerHTML += '<div><i class="fas fa-exclamation-triangle text-danger"></i> High Severity Incident</div>';
      div.innerHTML += '<div><i class="fas fa-exclamation-circle"></i> Unknown</div>';
      return div;
    };

    legend.addTo(map);
  }).fail(function(jqxhr, textStatus, error) {
    // Handle the error
    console.log('Request failed: ' + textStatus + ', ' + error);
  });
});

  </script>
</body>
</html>

















<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name']) && isset($_SESSION['role']) && $_SESSION['role'] == 'staff') {

include('../includes/header.php');
include('../includes/navbar_staff.php');
require '../db_conn.php';
?>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>

<style>
    .fc-title {
        color: #000; /* Set the text color to black */
    }
</style>
    <script>
        $(document).ready(function() {
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay,list'
                },
                defaultDate: moment().format('YYYY-MM-DD'),

                events: function(start, end, timezone, callback) {
                    var events = [];

                    // Calculate the start and end of the current week
                    var startDate = moment().startOf('week').format('YYYY-MM-DD');
                    var endDate = moment().endOf('week').format('YYYY-MM-DD');

                    // Generate events dynamically for the current week
                    var currentDate = moment(startDate);
                    while (currentDate.isSameOrBefore(endDate)) {
                        var dayOfWeek = currentDate.format('dddd');
                        var event = {
                            title: '', // Empty title
                            start: currentDate.format('YYYY-MM-DD'),
                            day: dayOfWeek,
                            location: 'Main Street', // Location instead of title
                            driver: 'John Doe'
                        };
                        events.push(event);
                        currentDate.add(1, 'day');
                    }

                    callback(events);
                },
                eventRender: function(event, element) {
                    // Customize event rendering
                    element.css('background-color', getColor(event.day));
                    element.find('.fc-title').text(event.location); // Display location

                    // Example: Display day, location, and driver as tooltip
                    var tooltip = "Day: " + event.day + "<br>" +
                                  "Location: " + event.location + "<br>" +
                                  "Driver: " + event.driver;
                    element.attr('title', tooltip);
                }
            });

            // Function to assign pastel colors to each day
            function getColor(day) {
                switch (day) {
                    case 'Monday':
                        return '#FFC8C8'; // Light Red
                    case 'Tuesday':
                        return '#C8FFC8'; // Light Green
                    case 'Wednesday':
                        return '#C8C8FF'; // Light Blue
                    case 'Thursday':
                        return '#FFFFC8'; // Light Yellow
                    case 'Friday':
                        return '#FFC8FF'; // Light Magenta
                    case 'Saturday':
                        return '#C8FFFF'; // Light Cyan
                    case 'Sunday':
                        return '#FFD8A5'; // Light Orange
                    default:
                        return '#EEEEEE'; // Light Grey (fallback)
                }
            }
        });
    </script>

<!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-1 mt-1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0">
                    <li class="breadcrumb-item"><a href="staff_dashboard.php" class="text-secondary" style="color: #026601; text-decoration: none;">Dashboard</a></li>
                    <li class="breadcrumb-item"><span class="text-gray-700">Waste Collections</span></li>
                    <li class="breadcrumb-item active text-gray-900" aria-current="page">Schedules</li>
                </ol>
            </nav>
            <a href="" class="btn btn-sm btn-info shadow-sm mb-3"><i class="fas fa-download fa-sm text-white"></i> Generate Report</a>
        </div>

        <script>
            <?php
            // Check if the session message exists and show it as a SweetAlert
            if (isset($_SESSION['message'])) {
                echo "Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: '{$_SESSION['message']}',
                        showConfirmButton: false,
                        timer: 2000,
                        customClass: {
                            popup: 'my-sweetalert',
                        }
                    });";
                unset($_SESSION['message']); // Clear the session message after displaying it
            }

            if (isset($_SESSION['message_danger'])) {
                echo "Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: '{$_SESSION['message_danger']}',
                        showConfirmButton: false,
                        timer: 2000,
                        customClass: {
                            popup: 'my-sweetalert',
                        }
                    });";
                unset($_SESSION['message_danger']); // Clear the session message after displaying it
            }
            ?>
        </script>

        <div class="row">
            <div class="col-md-6">
                <!-- DataTables Start-->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-sm-flex align-items-center justify-content-between py-2">
                    <h6 class="m-0 font-weight-bold text-info">Garbage Collection Schedule</h6>
                    <a href="#add_driver" data-toggle="modal" class="btn btn-sm btn-info shadow-sm"><i class="fa fa-plus fa-sm text-white mr-1"></i>Add Schedule</a>
                </div>
            </div>
            <div class="card-body">
               <form action="save_schedule.php" method="POST" id="schedule-form">
                    <div class="form-row mt-2">
                    <input type="hidden" name="id" value="">
                    <div class="form-group col-md-12 mt-2">
                        <select class="form-control" id="day_of_week" name="day_of_week" required>
                            <option value=""></option>
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                            <option value="Saturday">Saturday</option>
                            <option value="Sunday">Sunday</option>
                        </select>
                        <label for="day_of_week" class="text-gray">Day</label>
                    </div>
                    <div class="form-group mt-2 col-md-12">
                        <select class="form-control" id="location_id" name="location_id" required>
                            <option value=""></option>
                            <?php
                            // Fetch driver data from the "drivers" table
                            $query_loc = "SELECT * FROM locations";
                            $query_run_loc = mysqli_query($conn, $query_loc);

                            if (mysqli_num_rows($query_run_loc) > 0) {
                                foreach ($query_run_loc as $driver) {
                                   
                                    echo '<option value="' . $driver['id'] . '">' . $driver['location'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                        <label for="location_id" class="text-gray">Location</label>
                    </div>
                    <div class="form-group mt-2 col-md-12">
                        <select class="form-control" id="driver_id" name="driver_id" required>
                            <option value=""></option>
                            <?php
                            // Fetch driver data from the "drivers" table
                            $query_drivers = "SELECT * FROM drivers";
                            $query_run_drivers = mysqli_query($conn, $query_drivers);

                            if (mysqli_num_rows($query_run_drivers) > 0) {
                                foreach ($query_run_drivers as $driver) {
                                    $fullName = $driver['firstName'] . ' ';
                                    if (!empty($driver['middleName'])) {
                                        $fullName .= substr($driver['middleName'], 0, 1) . '. ';
                                    }
                                    $fullName .= $driver['lastName'];

                                    echo '<option value="' . $driver['id'] . '">' . $fullName . '</option>';
                                }
                            }
                            ?>
                        </select>
                        <label for="driver_id" class="text-gray">Driver</label>
                    </div>
                </div>
                    <div class="form-footer">
                        <div class="text-center">
                            <button class="btn btn-primary btn-md rounded-0" type="submit" form="schedule-form">Save</button>
                            <button class="btn btn-secondary border btn-md rounded-0" type="reset" form="schedule-form">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-dark">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>

<?php
include('../includes/footer.php');
include('../includes/scripts.php');
} else {
header("Location: ../login.php");
exit();
}
?>













