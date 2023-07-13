<!-- <!DOCTYPE html>
<html>
<head>
  <title>Weather App</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <h1 class="text-center mb-4">Weather App</h1>
        <form id="weatherForm">
          <div class="form-group">
            <label for="city">City</label>
            <input type="text" class="form-control" id="city" placeholder="Enter city name" required>
          </div>
          <div class="form-group">
            <label for="country">Country Code</label>
            <input type="text" class="form-control" id="country" placeholder="Enter country code (e.g., UK)" required>
          </div>
          <button type="submit" class="btn btn-primary btn-block">Get Weather</button>
        </form>

        <div id="weatherResults" class="mt-4">
        </div>
      </div>
    </div>
  </div>


  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
    $(document).ready(function() {

  $('#weatherForm').submit(function(event) {
    event.preventDefault();

    var city = $('#city').val();
    var countryCode = $('#country').val();
    var apiKey = '540720102d186a9630ecdce3b3068a26'; 

    $.get('https://api.openweathermap.org/data/2.5/weather', {
      q: city + ',' + countryCode,
      APPID: apiKey,
      units: 'metric'
    })
    .done(function(response) {
      var weatherHTML = `
        <h2>${response.name}, ${response.sys.country}</h2>
        <p>Temperature: ${response.main.temp} °C</p>
        <p>Humidity: ${response.main.humidity} %</p>
        <p>Weather: ${response.weather[0].description}</p>
      `;
      $('#weatherResults').html(weatherHTML);
    })
    .fail(function() {

      $('#weatherResults').html('<p>Failed to fetch weather data. Please try again.</p>');
    });
  });
});

  </script>

</body>
</html>
 -->


<!-- 
<!DOCTYPE html>
<html>
<head>
  <title>Weather App</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <h1 class="text-center mb-4">Weather App</h1>
        <form id="weatherForm">
        </form>

        <div id="weatherResults" class="mt-4">
         
        </div>
      </div>
    </div>
  </div>

  
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
    $(document).ready(function() {
      
      $('#weatherForm').submit(function(event) {
        event.preventDefault();

        var apiKey = '540720102d186a9630ecdce3b3068a26'; 

       
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;

            
            $.get('https://api.openweathermap.org/data/2.5/weather', {
              lat: latitude,
              lon: longitude,
              APPID: apiKey,
              units: 'metric' 
            })
            .done(function(response) {
              
              var weatherHTML = `
                <div class="card">
                  <div class="card-body">
                    <h2>${response.name}, ${response.sys.country}</h2>
                <p><img src="http://openweathermap.org/img/wn/${response.weather[0].icon}.png" alt="Weather Icon"></p>
                <p>Temperature: ${response.main.temp} °C</p>
                <p>Humidity: ${response.main.humidity} %</p>
                <p>Weather: ${response.weather[0].description}</p>
                <p>Wind Speed: ${response.wind.speed} m/s</p>
                <p>Min Temperature: ${response.main.temp_min} °C</p>
                <p>Max Temperature: ${response.main.temp_max} °C</p>
                <p>Sunrise: ${new Date(response.sys.sunrise * 1000).toLocaleTimeString()}</p>
                <p>Sunset: ${new Date(response.sys.sunset * 1000).toLocaleTimeString()}</p>
                <p>Pressure: ${response.main.pressure} hPa</p>
                <p>Visibility: ${response.visibility / 1000} km</p>
                <p>Cloudiness: ${response.clouds.all} %</p>
                <p>Feels Like: ${response.main.feels_like} °C</p>
                <p>Dew Point: ${response.main.dew_point} °C</p>
                <p>Wind Direction: ${response.wind.deg}°</p>
                <p>Wind Gust: ${response.wind.gust} m/s</p>
                <p>Additional Description: ${response.weather[0].main}</p>
                <p>UV Index: ${response.uvi}</p>
                <p>Pressure: ${response.main.pressure} hPa</p>
                <p>Rainfall: ${response.rain ? response.rain['1h'] : 0} mm</p>

                  </div>
                </div>
              `;
              $('#weatherResults').html(weatherHTML);
            })
            .fail(function() {
              
              $('#weatherResults').html('<p>Failed to fetch weather data. Please try again.</p>');
            });
          });
        } else {
          $('#weatherResults').html('<p>Geolocation is not supported by your browser.</p>');
        }
      });

      
      $('#weatherForm').submit();
    });
  </script>

</body>
</html>
 -->

<!DOCTYPE html>
<html>
<head>
  <title>Weather App</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
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
</head>
<body>

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <h1 class="text-center mb-4">Weather App</h1>
        <form id="weatherForm">

        </form>

        <div id="weatherResults" class="mt-4">
         
        </div>
      </div>
    </div>
  </div>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
    $(document).ready(function() {
      function fetchWeatherData(latitude, longitude) {
        var apiKey = '540720102d186a9630ecdce3b3068a26'; 


        $.get('https://api.openweathermap.org/data/2.5/weather', {
          lat: latitude,
          lon: longitude,
          APPID: apiKey,
          units: 'metric' // Request temperature in Celsius
        })
        .done(function(response) {
          // Display current weather results
          var weatherHTML = `
            <div class="card">
              <div class="card-body">
                <h3><i class="fa fa-globe"></i> ${response.name}, ${response.sys.country}</h3>
                <p><img src="http://openweathermap.org/img/wn/${response.weather[0].icon}.png" alt="Weather Icon" width="80px"> <span class="h4">${response.weather[0].description}</span></p>
                <p><i class="fas fa-thermometer-half"></i> Temperature: ${response.main.temp} °C</p>
                <p><i class="fas fa-tint"></i> Humidity: ${response.main.humidity} %</p>
                <p><i class="fas fa-wind"></i> Wind Speed: ${response.wind.speed} m/s</p>
                <div id="see-more-details" style="display: none;">
                  <p><i class="fas fa-thermometer-empty"></i> Min Temperature: ${response.main.temp_min} °C</p>
                  <p><i class="fas fa-thermometer-full"></i> Max Temperature: ${response.main.temp_max} °C</p>
                  <p><i class="fas fa-sun"></i> Sunrise: ${new Date(response.sys.sunrise * 1000).toLocaleTimeString()}</p>
                  <p><i class="fas fa-moon"></i> Sunset: ${new Date(response.sys.sunset * 1000).toLocaleTimeString()}</p>
                  <p><i class="fas fa-cloud"></i> Cloudiness: ${response.clouds.all} %</p>
                  <p><i class="fas fa-temperature-low"></i> Feels Like: ${response.main.feels_like} °C</p>
                  <p><i class="fas fa-compass"></i> Wind Direction: ${response.wind.deg}°</p>
                  <p><i class="fas fa-sun"></i> UV Index: ${response.uvi}</p>
                </div>
                <button onclick="toggleDetails()" id="see-more-btn">See More</button>
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
                  <div class="forecast-card card mb-2">
                    <div class="card-body">
                      <h5>${dayOfWeek}</h5>
                      <p><img src="http://openweathermap.org/img/wn/${forecast.weather[0].icon}.png" alt="Weather Icon"> ${forecast.weather[0].description}</p>
                      <p><i class="fas fa-thermometer-half"></i> Temperature: ${forecast.main.temp} °C</p>
                      <p><i class="fas fa-tint"></i> Humidity: ${forecast.main.humidity} %</p>
                      <p><i class="fas fa-wind"></i> Wind Speed: ${forecast.wind.speed} m/s</p>
                      <!-- Add more forecast details here -->
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

</body>
</html>




