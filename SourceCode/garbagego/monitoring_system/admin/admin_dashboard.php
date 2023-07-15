<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name']) && isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
    // Regenerate the session ID
    session_regenerate_id(true);

    // Include the necessary files and establish database connection
    include('../includes/header.php');
    include('../includes/navbar_admin.php');
    require '../db_conn.php';
?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet-control-geocoder/1.13.1/Control.Geocoder.min.css" />

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin="" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
<style>
body {
    margin: 0;
    padding: 0;
}

#map {
    width: 100%;
    height: 60vh;
}
.fa-icon {
    font-size: 10px;
    color: #026601;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 220px;
  padding: 10px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content p {
  margin: 5px 0;
}

.dropdown:hover .dropdown-content {
  display: block;
}

.forecast-container {
  display: flex;
  overflow-x: auto;
  white-space: nowrap;
}
.forecast-card {
  flex: 0 0 auto;
  width: 300px;
  margin-right: 10px;
}
</style>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row mb-4">
        <div class="col-xl-12 col-md-12">
            <div class="card shadow py-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <img id="slideshow" class="card-img-top img-fluid mx-auto d-none d-md-block" alt="..." style="max-width: 50%; height: 100px;">
                            <script>
                                var images = ["../images/image1.jpg", "../images/image2.jpg"];
                                var currentIndex = 0;
                                var slideshowElement = document.getElementById("slideshow");

                                function startSlideshow() {
                                    changeImage(); // Change the image immediately
                                    setInterval(changeImage, 5000); // Change image every 3 seconds
                                }

                                function changeImage() {
                                    slideshowElement.src = images[currentIndex];
                                    currentIndex = (currentIndex + 1) % images.length;
                                }

                                startSlideshow(); // Start the slideshow
                            </script>
                        </div>
                        <div class="col-xl-9 col-md-6">
                            <h6 class="h6 text-gray-800 mb-1">
                                <script>
                                    var date = new Date();
                                    var hour = date.getHours();
                                    var greeting;

                                    if (hour < 12) {
                                        greeting = "Good Morning";
                                    } else if (hour < 18) {
                                        greeting = "Good Afternoon";
                                    } else {
                                        greeting = "Good Evening";
                                    }

                                    document.write(greeting);
                                </script>
                            </h6>
                            <h6 class="h4 text-info font-weight-bold mb-3">
                                John Paulo Bascuguin,
                            </h6>
                            <h6 class="small text-gray-800">
                                At MENRO LIAN, we preserve beauty and create a greener future. Join us in environmental conservation. Together, towards a harmonious world.
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h5 mb-0 text-gray-800">
            <i class="fa fa-tachometer-alt fa-1x text-gray-600 mr-1"></i>
            Dashboard
        </h1>
        <div>
            <input type="date" class="form-control">
        </div>
    </div>

<!-- first row  -->  
<div class="row">
  <div class="col-md-9">
                <!-- Total row start-->
                <div class="row">
                    <!-- Total Drivers -->
                    <div class="col-xl-4 col-md-4 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            Total Drivers</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">10</div>
                                    </div>
                                    <div class="col-auto">
                                        <img src="../images/drivers.png" class="card-img-top img-fluid mx-auto d-block image-animated" alt="..." style="max-width: 100%; height: 40px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Crew Members -->
                    <div class="col-xl-4 col-md-4 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            Total Crew Members</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">25</div>
                                    </div>
                                    <div class="col-auto">
                                        <img src="../images/collector.png" class="card-img-top img-fluid mx-auto d-block image-animated" alt="..." style="max-width: 100%; height: 40px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Garbage Trucks -->
                    <div class="col-xl-4 col-md-4 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            Total Garbage Trucks
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">10</div>
                                    </div>
                                    <div class="col-auto">
                                        <img src="../images/truck.png" class="card-img-top img-fluid mx-auto d-block image-animated" alt="..." style="max-width: 100%; height: 40px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 <!-- Total row end-->
                </div>
                <!-- Ongoing/ Outgoing row start-->
                <div class="row">
                  <div class="col">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title text-gray-800">Ongoing/ Outgoing Garbage Trucks</h5>
                        <div id="map"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Ongoing/ Outgoing row end-->
             </div>
          <!-- weather api start-->
            <div class="col-md-3">
              <form id="weatherForm">
              </form>
              <div id="weatherResults">
              </div>
            </div>
          </div>
          <!-- weather api end -->

</div>
</div>
<!-- /.container-fluid -->

  <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
  function fetchWeatherData(latitude, longitude) {
    var apiKey = '540720102d186a9630ecdce3b3068a26'; // Replace with your OpenWeatherMap API key

    // Make API request for current weather
    $.get('https://api.openweathermap.org/data/2.5/weather', {
      lat: latitude,
      lon: longitude,
      APPID: apiKey,
      units: 'metric' // Request temperature in Celsius
    })
    .done(function(response) {
      // Display current weather results
      var weatherHTML = `
       <div class="card shadow">
        <div class="card-body">
          <h6 class="mt-2 text-gray-800">${response.name}, ${response.sys.country} <span class="float-right" id="current-time">${new Date().toLocaleTimeString()}</span></h6>
          <div class="text-center px-0">
            <p>
              <img src="http://openweathermap.org/img/wn/${response.weather[0].icon}.png" alt="Weather Icon">
              <span class="small font-weight-bold text-capitalize text-gray-800">${response.weather[0].description}</span>
            </p>
          </div>
          <p class="text-center h6"></i></i><span class="text-gray-900">${response.main.temp} °C </span></p>
          <div class="dropdown small">
            <a onclick="toggleDetails()" id="see-more-btn" class="text-info">See More</a>
            <div id="see-more-details" class="dropdown-content">
              <p><i class="fas fa-tint"></i> Humidity: <span class="font-weight-bold">${response.main.humidity} %</span></p>
              <p><i class="fas fa-wind"></i> Wind Speed: <span class="font-weight-bold">${response.wind.speed} m/s </span></p>
              <p><i class="fas fa-thermometer-empty"></i> Min Temperature: <span class="font-weight-bold">${response.main.temp_min} °C </span></p>
              <p><i class="fas fa-thermometer-full"></i> Max Temperature: <span class="font-weight-bold">${response.main.temp_max} °C </span></p>
              <p><i class="fas fa-sun"></i> Sunrise: <span class="font-weight-bold">${new Date(response.sys.sunrise * 1000).toLocaleTimeString()} </span></p>
              <p><i class="fas fa-moon"></i> Sunset: <span class="font-weight-bold">${new Date(response.sys.sunset * 1000).toLocaleTimeString()} </span></p>
              <p><i class="fas fa-cloud"></i> Cloudiness: <span class="font-weight-bold">${response.clouds.all} % </span></p>
              <p><i class="fas fa-temperature-low"></i> Feels Like: <span class="font-weight-bold">${response.main.feels_like} °C </span></p>
              <p><i class="fas fa-compass"></i> Wind Direction: <span class="font-weight-bold">${response.wind.deg}° </span></p>
              <p><i class="fas fa-sun"></i> UV Index: <span class="font-weight-bold">${response.uvi} </span></p>
            </div>
          </div>
        </div>
      </div>
      `;

      // Make API request for weather forecast
      $.get('https://api.openweathermap.org/data/2.5/forecast', {
        lat: latitude,
        lon: longitude,
        APPID: apiKey,
        units: 'metric' // Request temperature in Celsius
      })
      .done(function(forecastResponse) {
        // Display weather forecast results
        var forecastHTML = '<div class="forecast-container">';
        var forecastData = forecastResponse.list;
        var daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        var currentDay = new Date().getDay() + 1;

        for (var i = 0; i < 7; i++) {
          var forecast = forecastData.find(function(item) {
            var forecastDate = new Date(item.dt * 1000);
            return forecastDate.getDay() === (currentDay + i) % 7;
          });

          if (forecast) {
            var forecastDate = new Date(forecast.dt * 1000);
            var dayOfWeek = daysOfWeek[(currentDay + i) % 7];
            forecastHTML += `
              <div class="forecast-card card  mt-2" style="max-width: 200px; max-height: 150px;">
                <div class="card-body">
                  <h6 class=" small text-gray-800 text-center">${dayOfWeek}</h6>
                  <p><img src="http://openweathermap.org/img/wn/${forecast.weather[0].icon}.png" alt="Weather Icon"> <span class="font-weight-bold text-capitalize text-gray-800 small">${forecast.weather[0].description}</span></p>
                  <p class="text-center h5><i class="fas fa-thermometer-half mr-2 text-gray-800"></i> <span class="text-gray-800">${forecast.main.temp} °C </span></p>
                </div>
              </div>
            `;
          }
        }

        forecastHTML += '</div>';

        // Display current weather and forecast results
        $('#weatherResults').html(weatherHTML + forecastHTML);
      })
      .fail(function() {
        // Display error message
        $('#weatherResults').html('<p>Failed to fetch weather forecast. Please try again.</p>');
      });
    })
    .fail(function() {
      // Display error message
      $('#weatherResults').html('<p>Failed to fetch current weather. Please try again.</p>');
    });
  }

  // Submit form and fetch weather data
  $('#weatherForm').submit(function(event) {
    event.preventDefault();

    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;

        fetchWeatherData(latitude, longitude);
      });
    } else {
      $('#weatherResults').html('<p>Geolocation is not supported by your browser.</p>');
    }
  });

  // Trigger form submission automatically on page load
  $('#weatherForm').submit();
});
</script>
<script>setInterval(() => document.getElementById('current-time').textContent = new Date().toLocaleTimeString(), 1000);</script>
<script>
function toggleDetails() {
  var detailsElement = document.getElementById("see-more-details");
  var btnElement = document.getElementById("see-more-btn");

  if (detailsElement.style.display === "none") {
    detailsElement.style.display = "block";
    btnElement.innerHTML = "See Less";
  } else {
    detailsElement.style.display = "none";
    btnElement.innerHTML = "See More";
  }
}
</script>


<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <script>
        var map_init = L.map('map', {
            center: [9.0820, 8.6753],
            zoom: 8
        });
        var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map_init);
        L.Control.geocoder().addTo(map_init);
        if (!navigator.geolocation) {
            console.log("Your browser doesn't support geolocation feature!")
        } else {
            setInterval(() => {
                navigator.geolocation.getCurrentPosition(getPosition)
            }, 5000);
        };
        var marker, circle, lat, long, accuracy;

        function getPosition(position) {
            // console.log(position)
            lat = position.coords.latitude
            long = position.coords.longitude
            accuracy = position.coords.accuracy

            if (marker) {
                map_init.removeLayer(marker)
            }

            if (circle) {
                map_init.removeLayer(circle)
            }

            marker = L.marker([lat, long])
            circle = L.circle([lat, long], { radius: accuracy })

            var featureGroup = L.featureGroup([marker, circle]).addTo(map_init)

            map_init.fitBounds(featureGroup.getBounds())

            console.log("Your coordinate is: Lat: " + lat + " Long: " + long + " Accuracy: " + accuracy)
        }
    </script>

<?php
    // Include the necessary files and establish database connection
    include('../includes/footer.php');
    include('../includes/scripts.php');
} else {
    header("Location: ../admin_login.php");
    exit();
}
?>
