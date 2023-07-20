<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>MENRO LIAN - GARBAGEGO</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/icon.jpg" rel="icon">
  <link href="assets/img/icon.jpg" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

   <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet-control-geocoder/1.13.1/Control.Geocoder.min.css" />

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin="" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

<style>
#map {
    width: 100%;
    height: 50vh;
}

.legend-color {
      display: inline-block;
      width: 20px;
      height: 20px;
      margin-right: 5px;
    }
</style>
</head>

<body>

  <!-- ======= Top Bar ======= -->
  <div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex align-items-center justify-content-center justify-content-md-between">
      <div class="align-items-center">
        <i class="bi bi-clock"></i> Monday - Friday | 8:00 am - 5:00 pm
      </div>
      <div class="align-items-center d-none d-md-flex">
        <i class="bi bi-phone"></i> Call us now +1 5589 55488 55
      </div>
    </div>
  </div>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <a href="index.php" class="logo me-auto"><img src="assets/img/menro-logo.png" alt="MENRO-Lian GARBAGEGO logo"></a>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <h1 class="logo me-auto"><a href="index.html">MENRO - Lian</a></h1> -->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto" href="#featured-services">Services</a></li>
          <li class="dropdown"><a ><span>Resources</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a class="nav-link scrollto" href="#history">History</a></li>
              <li><a class="nav-link scrollto" href="#gallery">Gallery</a></li>
              <li><a class="nav-link scrollto" href="#collection">Collection Schedules</a></li>
              <li><a class="nav-link scrollto" href="#location">Garbage Truck Location</a></li>
            </ul>
          </li>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <a href="monitoring_system/login.php" class="appointment-btn scrollto"><span class="d-none d-md-inline"></span>Login</a>

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

      <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

      <div class="carousel-inner" role="listbox">

        <!-- Slide 1 -->
        <div class="carousel-item active" style="background-image: url(assets/img/slide/slide_2.jpg)">
          <div class="container">
            <h3>Welcome to <span>MENRO LIAN</span></h3>
            <p>With sustainable innovation, community engagement, and unwavering commitment, we lead in environmental conservation. Join us in building a harmonious world for humans and nature. Together, towards a greener tomorrow.</p>
            <a href="#about" class="btn-get-started scrollto">Read More</a>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item" style="background-image: url(assets/img/slide/slide_1.jpg)">
          <div class="container">
            <h3> Hassle-free waste collection schedule</h3>
            <p>Stay in the loop and keep your community clean with our convenient waste collection schedule, ensuring a seamless and eco-friendly disposal process for a greener tomorrow.</p>
            <a href="#collection" class="btn-get-started scrollto">Read More</a>
          </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item" style="background-image: url(assets/img/slide/slide_4.jpg)">
          <div class="container">
            <h3>Track our garbage trucks</h3>
            <p>Track our garbage trucks in real-time and witness the incredible journey they embark on, as they diligently collect and transport waste to promote a cleaner and greener community.</p>
            <a href="#about" class="btn-get-started scrollto">Read More</a>
          </div>
        </div>

      </div>

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
      </a>

    </div>
  </section><!-- End Hero -->

  <main id="main">

     <!-- ======= Collection Section ======= -->
    <section id="collection" class="collection section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Garbage Collection Schedules</h2>
          <p>Keep your surroundings clean and organized with our convenient Garbage Collection Schedules, ensuring timely disposal and a clutter-free environment for a hassle-free lifestyle.</p>
        </div>


            <div class="row justify-content-end" data-aos="fade-right">
              <div class="col-md-6 text-left mt-2">
                <h4>Garbage Collection Schedules</h4>
              </div>
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-6 mt-1">
                    <select id="area-dropdown" class="form-control rounded-pill" onchange="searchArea()">
                      <option value="">Select Area</option>
                      <option value="Barangay">Barangay</option>
                      <option value="Binubusan">Binubusan</option>
                      <option value="Luyahan">Luyahan</option>
                      <option value="Balibago">Balibago</option>
                      <option value="Malaruhatan">Malaruhatan</option>
                      <option value="Bagong Pook">Bagong Pook</option>
                      <option value="Bungahan">Bungahan</option>
                      <option value="San Diego">San Diego</option>
                      <option value="Kapito">Kapito</option>
                      <option value="Humayingan">Humayingan</option>
                    </select>
                  </div>
                  <div class="col-md-6 mt-1">
                    <div class="input-group">
                      <input id="search-input" type="text" class="form-control rounded-pill" placeholder="Search...">
                      <div class="input-group-append d-none d-md-block"> <!-- Hide the button on phones -->
                        <button class="btn rounded-pill custom-button" type="button">
                          <i class="fas fa-search" style="color: #026601;"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>


          <div class="table-responsive">
          <table id="garbage-table" class="table table-hover left-border text-center animated-table mt-1" data-aos="fade-left">
            <thead class="table-success">
              <tr>
                <th>Day</th>
                <th>Assigned Person</th>
                <th>Area</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Monday</td>
                <td>John Doe</td>
                <td>Barangay 1, Barangay 2, Barangay 3, Barangay 4, Barangay 5</td>
              </tr>
              <tr>
                <td>Tuesday</td>
                <td>Jane Smith</td>
                <td>Binubusan, Luyahan, Balibago, Matabungkay</td>
              </tr>
              <tr>
                <td>Wednesday</td>
                <td>Michael Johnson</td>
                <td>Malaruhatan, Bagong Pook</td>
              </tr>
              <tr>
                <td>Thursday</td>
                <td>Michael Johnson</td>
                <td>Bungahan, San Diego</td>
              </tr>
              <tr>
                <td>Friday</td>
                <td>Michael Johnson</td>
                <td>Kapito, Humayingan</td>
              </tr>
              <!-- Add more rows as needed -->
            </tbody>
          </table>
        </div>

        </div>

        <script>

          function searchTable() {
            var input = document.getElementById('search-input');
            var filter = input.value.toUpperCase();

            var table = document.getElementById('garbage-table');
            var tbody = table.getElementsByTagName('tbody')[0];
            var rows = tbody.getElementsByTagName('tr');

            for (var i = 0; i < rows.length; i++) {
              var tdDay = rows[i].getElementsByTagName('td')[0];
              var tdPerson = rows[i].getElementsByTagName('td')[1];
              var tdArea = rows[i].getElementsByTagName('td')[2];
              if (tdDay || tdPerson || tdArea) {
                var dayText = tdDay.textContent || tdDay.innerText;
                var personText = tdPerson.textContent || tdPerson.innerText;
                var areaText = tdArea.textContent || tdArea.innerText;

                if (
                  dayText.toUpperCase().indexOf(filter) > -1 ||
                  personText.toUpperCase().indexOf(filter) > -1 ||
                  areaText.toUpperCase().indexOf(filter) > -1
                ) {
                  rows[i].style.display = '';
                } else {
                  rows[i].style.display = 'none';
                }
              }
            }
          }

          var searchInput = document.getElementById('search-input');
          searchInput.addEventListener('input', searchTable);


            function searchArea() {
            var input = document.getElementById('search-input');
            var filter = input.value.toUpperCase();
            
            var dropdown = document.getElementById('area-dropdown');
            var selectedArea = dropdown.value.toUpperCase();

            var table = document.getElementById('garbage-table');
            var tbody = table.getElementsByTagName('tbody')[0];
            var rows = tbody.getElementsByTagName('tr');

            for (var i = 0; i < rows.length; i++) {
              var tdDay = rows[i].getElementsByTagName('td')[0];
              var tdPerson = rows[i].getElementsByTagName('td')[1];
              var tdArea = rows[i].getElementsByTagName('td')[2];
              if (tdDay || tdPerson || tdArea) {
                var dayText = tdDay.textContent || tdDay.innerText;
                var personText = tdPerson.textContent || tdPerson.innerText;
                var areaText = tdArea.textContent || tdArea.innerText;

                if (
                  (selectedArea === '' || areaText.toUpperCase().indexOf(selectedArea) > -1) &&
                  (dayText.toUpperCase().indexOf(filter) > -1 || personText.toUpperCase().indexOf(filter) > -1)
                ) {
                  rows[i].style.display = '';
                } else {
                  rows[i].style.display = 'none';
                }
              }
            }
          }
        </script>
        </div>
    </div>

      </div>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
    </section><!-- End Collection Section -->

        <!-- ======= Pricing Section ======= -->
    <section id="location" class="pricing">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Garbage Truck Location</h2>
          <p>Track the dynamic whereabouts of our diligent garbage trucks as they navigate the city's bustling streets, ensuring timely waste collection and promoting a cleaner, greener environment for all.</p>
        </div>

        <div class="row">

          <div class="col-lg-4 col-md-12">
          <div class="box" data-aos="fade-right" data-aos-delay="100">
            <h3>Garbage Trucks</h3>
            <ul>
              <li>
                <label>
                  <input type="checkbox" name="truck" value="Truck A"> Truck A
                </label>
              </li>
              <li>
                <label>
                  <input type="checkbox" name="truck" value="Truck B"> Truck B
                </label>
              </li>
              <li>
                <label>
                  <input type="checkbox" name="truck" value="Truck C"> Truck C
                </label>
              </li>
              <!-- Add more truck selections as needed -->
            </ul>
          </div>
          
          <div class="legend mt-4" data-aos="fade-right" data-aos-delay="200">
           <div class="box" data-aos="fade-right" data-aos-delay="100">
                <h6>Legend:</h6>
                <ul class="legend-list mt-4">
                  <li><span class="legend-color" style="background-color: #ff0000;"></span> Truck A</li>
                  <li><span class="legend-color" style="background-color: #00ff00;"></span> Truck B</li>
                  <li><span class="legend-color" style="background-color: #0000ff;"></span> Truck C</li>
                  <!-- Add more truck colors and names as needed -->
                </ul>
            </div>
          </div>
        </div>



          <div class="col-lg-8 col-md-12 mt-4 mt-md-0">
            <div class="box featured" data-aos="fade-left" data-aos-delay="200">
              <!-- <div class="card">
                <div class="card-body"> -->
                  <h5 class="card-title text-gray-800 mb-4">Garbage Trucks Location</h5>
                  <div id="map"></div>
               <!--  </div>
              </div> -->
            </div>
          </div>

        </div>

      </div>
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

    </section><!-- End Pricing Section -->

    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta">
      <div class="container" data-aos="zoom-in">
        <div class="text-center">
          <h3>Do you have any questions or concerns?</h3>
          <p>If you have any questions or need assistance, we are here to help. Please don't hesitate to reach out to us.</p>
          <a class="cta-btn scrollto" href="#contact-form">Send a message</a>
        </div>
      </div>
    </section><!-- End Cta Section -->

    

    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>About Us</h2>
          <p>Welcome to MENRO Lian, where we strive to harmonize progress and environmental preservation. Our dedicated team works towards sustainable development, protecting nature's wonders for generations to come.</p>
        </div>

        <div class="row mt-2">
          <div class="col-lg-6" data-aos="fade-right">
            <div style="display: flex; justify-content: center;">
              <img src="assets/img/try.jpg" class="img-fluid" alt="" style="max-width: 100%; height: 300px; margin-left: auto; margin-right: auto;">
            </div>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 content" data-aos="fade-left">
            <h3>Welcome to Municipal Environment and Natural Resources Office of Lian, Batangas</h3>
            <p class="fst-italic">
              Where passion for the planet meets sustainable innovation. As a team of dedicated environmental enthusiasts, we are on a mission to preserve our natural wonders and create a greener future. Through our unwavering commitment to conservation, education, and innovative solutions, we are driving positive change and shaping a sustainable world for generations to come. Join us in our journey towards a thriving planet, where harmony between humans and nature is not just a dream, but a remarkable reality.

              Here, we believe that a harmonious coexistence between humans and nature is not only possible but essential for a thriving community. Our tireless efforts encompass a diverse range of initiatives, from promoting eco-friendly practices to ensuring the efficient management of waste and pollution control.
            </p>
          </div>
        </div>
        <div class="row mt-2">
          <div class="col-lg-12 fst-italic" data-aos="fade-right">
              As you navigate through our website, you'll discover a wealth of information about our services, projects, and ongoing initiatives. From waste management and recycling programs to environmental impact assessments, we are here to assist you every step of the way. We invite you to explore our resources, engage with our knowledgeable staff, and join us in our mission to preserve the natural wonders that make Lian, Batangas, truly special.

              Together, let us foster a community where sustainability thrives, and where the beauty of nature is cherished and protected for generations to come. Welcome to the Municipal Environment and Natural Resources Office of Lian, Batangas – where environmental preservation is our shared responsibility and our collective legacy.
          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->

    <!-- ======= Staff Members Section ======= -->
    <section id="staff" class="staff section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Staff Members</h2>
          <p>Meet our exceptional team of dedicated individuals at MENRO Lian, working passionately towards environmental preservation and sustainable development. Together, we strive to make a positive impact, inspiring change and nurturing a greener future for our community.</p>
        </div>

        <div class="row">

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="100">
              <div class="member-img">
                <img src="assets/img/doctors/doctors-1.jpg" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Walter White</h4>
                <span>Chief Medical Officer</span>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="200">
              <div class="member-img">
                <img src="assets/img/doctors/doctors-2.jpg" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Sarah Jhonson</h4>
                <span>Anesthesiologist</span>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="300">
              <div class="member-img">
                <img src="assets/img/doctors/doctors-3.jpg" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>William Anderson</h4>
                <span>Cardiology</span>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="400">
              <div class="member-img">
                <img src="assets/img/doctors/doctors-4.jpg" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Amanda Jepson</h4>
                <span>Neurosurgeon</span>
              </div>
            </div>
          </div>

        </div>
         

      </div>
    </section><!-- End Staff Members Section -->

    <!-- ======= History Section ======= -->
    <section id="history" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>History</h2>
        </div>

        <div class="row">
          <div class="col-lg-12" data-aos="fade-right">
           <div class="row">
            <div class="col-lg-12" data-aos="zoom-out" data-aos-delay="100">
              <div class="card shadow" style="border-color: #026601;">
                <div class="card-body">
                  <h3 class="text-center mb-3">Municipal Environment and Natural Resources Office of Lian, Batangas</h3>
                  <div class="scrollable-content" style="max-height: 450px; overflow-y: auto;">
                    <p style="text-indent: 2em; text-align: justify;">
                      The Municipal Environment and Natural Resources Office (MENRO) of Lian has a rich history rooted in the town's commitment to environmental conservation and sustainable development. Lian, a municipality located in the province of Batangas, Philippines, is blessed with abundant natural resources, including pristine beaches, lush forests, and diverse marine ecosystems. Recognizing the importance of preserving and protecting these valuable assets, the local government established the MENRO to spearhead environmental initiatives and promote responsible resource management.
                    </p>
                    <p style="text-indent: 2em; text-align: justify;">
                      Since its inception, the MENRO has played a pivotal role in implementing various environmental programs and initiatives aimed at conserving natural resources, preserving biodiversity, and promoting sustainable practices within the community. The office has been involved in initiatives such as coastal clean-ups, reforestation projects, and the establishment of protected areas to safeguard critical habitats.
                    </p>
                    <p style="text-indent: 2em; text-align: justify;">
                      Over the years, the MENRO of Lian has collaborated with various stakeholders, including local communities, non-governmental organizations, and government agencies, to achieve its environmental objectives. These partnerships have been instrumental in creating awareness, fostering community engagement, and mobilizing resources for environmental conservation projects.
                    </p>
                    <p style="text-indent: 2em; text-align: justify;">
                      One of the notable achievements of the MENRO is its focus on coastal resource management. Given Lian's proximity to the sea and its reliance on marine resources, the office has implemented programs to promote sustainable fishing practices, protect coral reefs, and manage coastal ecosystems. These efforts have not only contributed to the preservation of marine biodiversity but also supported the livelihoods of local fisherfolk.
                    </p>
                    <p style="text-indent: 2em; text-align: justify;">
                      In recent years, the MENRO has also embraced the integration of climate change adaptation and mitigation strategies into its work. Recognizing the vulnerability of Lian to the impacts of climate change, the office has actively promoted initiatives such as the adoption of renewable energy sources, the implementation of waste management programs, and the establishment of climate-resilient infrastructure.
                    </p>
                    <p style="text-indent: 2em; text-align: justify;">
                      The MENRO of Lian continues to evolve and adapt to emerging environmental challenges. With the ever-increasing threats posed by climate change, unsustainable development, and environmental degradation, the office remains committed to its mandate of safeguarding Lian's natural resources for present and future generations. Through its dedicated efforts and collaborations, the MENRO strives to create a sustainable and resilient community that cherishes its environment and thrives in harmony with nature.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <script>
          document.addEventListener("DOMContentLoaded", function() {
            var scrollableContent = document.querySelector(".scrollable-content");
            
            scrollableContent.addEventListener("mouseenter", function() {
              this.style.overflowY = "auto";
            });
            
            scrollableContent.addEventListener("mouseleave", function() {
              this.style.overflowY = "hidden";
            });
          });
          </script>

    </section><!-- End History Section -->

    <!-- ======= Services Section ======= -->
    <section id="featured-services" class="featured-services">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Services</h2>
          <p>Discover a world of sustainable solutions as our dedicated team at the Municipal Environment and Natural Resources Office offers a wide array of services to protect and preserve our precious environment for future generations.</p>
        </div>

        <div class="row">
          <div class="col-md-6 col-lg-4 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
              <div class="icon"><i class="fas fa-leaf"></i></div>
              <h4 class="title"><a >Conservation</a></h4>
              <p class="description">Safeguarding nature's treasures, ensuring a thriving legacy for generations to come.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
              <div class="icon"><i class="fas fa-seedling"></i></div>
              <h4 class="title"><a >Sustainable Practices</a></h4>
              <p class="description">Embracing eco-friendly solutions, paving the way towards a greener footprint.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
              <div class="icon"><i class="fas fa-book-open"></i></div>
              <h4 class="title"><a >Education & Awareness</a></h4>
              <p class="description">Inspiring minds, empowering actions for a planet in need.</p>
            </div>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-6 col-lg-4 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
              <div class="icon"><i class="fas fa-hands-helping"></i></div>
              <h4 class="title"><a >Community Engagement</a></h4>
              <p class="description">Uniting communities, igniting the power of collaboration for impactful change.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
              <div class="icon"><i class="fas fa-heart"></i></div>
              <h4 class="title"><a >Advocacy</a></h4>
              <p class="description">Shaping policies, championing sustainability on a global scale.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
              <div class="icon"><i class="fas fa-lightbulb"></i></div>
              <h4 class="title"><a >Innovation</a></h4>
              <p class="description">Pioneering new frontiers, revolutionizing environmental solutions for a brighter future.</p>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Services Section -->

    <!-- ======= Gallery Section ======= -->
    <section id="gallery" class="gallery">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Gallery</h2>
          <p>Step into a captivating visual journey through the pristine landscapes and breathtaking beauty of our city's environment, showcased in our mesmerizing gallery section, brought to you by the Municipal Environment and Natural Resources Office.</p>
        </div>

        <div class="gallery-slider swiper">
          <div class="swiper-wrapper align-items-center">
            <div class="swiper-slide"><a class="gallery-lightbox" href="assets/img/gallery/gallery-01.jpg"><img src="assets/img/gallery/gallery-01.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="gallery-lightbox" href="assets/img/gallery/gallery-02.jpg"><img src="assets/img/gallery/gallery-02.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="gallery-lightbox" href="assets/img/gallery/gallery-03.jpg"><img src="assets/img/gallery/gallery-03.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="gallery-lightbox" href="assets/img/gallery/gallery-04.jpg"><img src="assets/img/gallery/gallery-04.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="gallery-lightbox" href="assets/img/gallery/gallery-05.jpg"><img src="assets/img/gallery/gallery-05.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="gallery-lightbox" href="assets/img/gallery/gallery-06.jpg"><img src="assets/img/gallery/gallery-06.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="gallery-lightbox" href="assets/img/gallery/gallery-07.jpg"><img src="assets/img/gallery/gallery-07.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="gallery-lightbox" href="assets/img/gallery/gallery-08.jpg"><img src="assets/img/gallery/gallery-08.jpg" class="img-fluid" alt=""></a></div>
          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
      <br>
      <br>
      <br>
      <br>
    </section><!-- End Gallery Section -->

    <!-- ======= Frequently Asked Questioins Section ======= -->
    <section id="faq" class="faq section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Frequently Asked Questioins</h2>
          <p>Our team of experts has compiled a list of common queries to provide guidance on various environmental and natural resources topics. Find answers to all your questions related to the environment, conservation, and sustainable practices.</p>
        </div>

        <ul class="faq-list">

          <li>
            <div data-bs-toggle="collapse" class="collapsed question" href="#faq1">How can I report illegal logging activities or deforestation in Lian, Batangas?<i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq1" class="collapse" data-bs-parent=".faq-list">
              <p>
                To report illegal logging activities or deforestation, you can contact the MENRO office directly at <a href="URL#collection">Contacts Section</a> or visit our office in person. Please provide as much information as possible, such as the location, date, and any relevant details, to help us take appropriate action.
              </p>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq2" class="collapsed question">What permits or clearances do I need for tree cutting or land development projects in Lian, Batangas?<i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq2" class="collapse" data-bs-parent=".faq-list">
              <p>
                Prior to tree cutting or land development projects, you are required to secure the necessary permits and clearances. Please visit the MENRO office to inquire about the specific requirements and application process. Our staff will guide you through the necessary steps to ensure compliance with environmental regulations.
              </p>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq3" class="collapsed question">How can I apply for a permit to operate a business that may have an impact on the environment in Lian, Batangas?<i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq3" class="collapse" data-bs-parent=".faq-list">
              <p>
                To apply for a permit to operate a business that may have an impact on the environment, you must submit an application to the MENRO office. The application should include relevant details about your business operations, potential environmental impacts, and mitigation measures. Our team will review your application and guide you through the necessary procedures.
              </p>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq4" class="collapsed question">What are the regulations for waste management in Lian, Batangas?<i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq4" class="collapse" data-bs-parent=".faq-list">
              <p>
                Waste management regulations in Lian, Batangas require proper segregation, disposal, and treatment of waste. You should separate your waste into recyclable, biodegradable, and non-biodegradable categories. The MENRO office can provide you with guidelines on waste segregation and collection schedules. It is important to follow these regulations to promote a clean and sustainable environment.
              </p>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq5" class="collapsed question">How can I participate in environmental conservation activities or join programs organized by MENRO in Lian, Batangas? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq5" class="collapse" data-bs-parent=".faq-list">
              <p>
                MENRO regularly organizes environmental conservation activities and programs. You can express your interest in participating by contacting our office or checking our website for upcoming events. We welcome volunteers and community involvement in our initiatives. Stay updated on our announcements and join us in protecting and preserving the environment of Lian, Batangas.
              </p>
            </div>
          </li>
          <li>
            <div data-bs-toggle="collapse" href="#faq6" class="collapsed question">What is the waste collection schedule in Lian, Batangas, and how can I ensure proper waste disposal?<i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq6" class="collapse" data-bs-parent=".faq-list">
              <p>
                Waste collection in Lian, Batangas follows a specific schedule that varies depending on your barangay (neighborhood). To find out the exact collection days for your area, you can click on this page section <a href="URL#collection">Collection Schedules Section</a>. On this page, you will find the waste collection schedules for each barangay in Lian, Batangas. It is recommended to regularly check this section for any updates or changes to the collection schedule. Additionally, you can also visit the MENRO office or get in touch with your barangay officials for more information regarding waste collection in your specific area.
              </p>
            </div>
          </li>
        </ul>

      </div>
      <br>
    </section><!-- End Frequently Asked Questioins Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
          <h2>Contact</h2>
          <p>Reach out to us, the guardians of Lian's environment! Whether you have a query, suggestion, or concern, we're here to nurture our nature and serve our community.</p>
        </div>

      </div>
      <div class="icon-box" data-aos="zoom-in" data-aos-delay="100">
        <div>
          <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3870.6814994712945!2d120.64794477154786!3d14.036884160563734!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd965876db9f9f%3A0x51e9d5852e54372!2sLian%20Municipal%20Hall!5e0!3m2!1sen!2sph!4v1686568237854!5m2!1sen!2sph" frameborder="0" allowfullscreen></iframe>
        </div>
      </div>

      <div class="container">

        <div class="row mt-5">

          <div class="col-lg-12">

          <div class="row">
            <div class="col-md-4">
              <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                <div class="info-box">
                  <i class="bx bx-map"></i>
                  <h3>Our Address</h3>
                  <p>J. P. Rizal St, Lian, Batangas</p>
                  <br>
                </div>
               </div>
            </div>
            <div class="col-md-4">
              <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
                <div class="info-box">
                  <i class="bx bx-envelope"></i>
                  <h3>Email Us</h3>
                  <p>info@example.com<br>contact@example.com</p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
                <div class="info-box">
                  <i class="bx bx-phone-call"></i>
                  <h3>Call Us</h3>
                  <p>+1 5589 55488 55<br>+1 6678 254445 41</p>
                </div>
              </div>
            </div>
          </div>
          <!-- Contact Form Section -->
          <section id="contact-form">
            <div class="container">
              <div class="row">
                <div class="col-lg-12">
                  <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                    <div class="row">
                      <div class="col-md-6 form-group">
                        <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required="">
                      </div>
                      <div class="col-md-6 form-group mt-3 mt-md-0">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required="">
                      </div>
                    </div>
                    <div class="form-group mt-3">
                      <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required="">
                    </div>
                    <div class="form-group mt-3">
                      <textarea class="form-control" name="message" rows="7" placeholder="Message" required=""></textarea>
                    </div>
                    <div class="my-3">
                      <div class="loading">Loading</div>
                      <div class="error-message"></div>
                      <div class="sent-message">Your message has been sent. Thank you!</div>
                    </div>
                    <div class="text-center"><button type="submit">Send Message</button></div>
                  </form>
                </div>
              </div>
            </div>
          </section><!-- End Contact Form Section -->


        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6">
            <div class="footer-info">
              <h3>MENRO LIAN</h3>
              <p>
                J. P. Rizal St <br>
                Lian, Batangas<br><br>
                <strong>Phone:</strong> +1 5589 55488 55<br>
                <strong>Email:</strong> info@example.com<br>
              </p>
              <div class="social-links mt-3">
                <a href="" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="" class="google-plus"><i class="bx bxl-skype"></i></a>
                <a href="" class="linkedin"><i class="bx bxl-linkedin"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a class="scrollto" href="#hero">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a class="scrollto" href="#about">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a class="scrollto" href="#featured-services">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a class="scrollto" href="#collection">Collection Schedules</a></li>
              <li><i class="bx bx-chevron-right"></i> <a class="scrollto" href="#location">Garbage Truck Location</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a class="scrollto" href="#history">History</a></li>
              <li><i class="bx bx-chevron-right"></i> <a class="scrollto" href="#staff">Office Staffs</a></li>
              <li><i class="bx bx-chevron-right"></i> <a class="scrollto" href="#faq">FAQ'S</a></li>
              <li><i class="bx bx-chevron-right"></i> <a class="scrollto" href="#gallery">Gallery</a></li>
              <li><i class="bx bx-chevron-right"></i> <a class="scrollto" href="#contact">Contacts</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter mt-5">
            <div class="row">
              <div class="col-sm-12">
                <div class="d-flex  justify-content-center align-items-center">
                  <img src="assets/img/lian_logo.png" class="img-fluid mx-2" alt="" style="max-width: 110px; height: auto;">
                  <img src="assets/img/menro_logo.png" class="img-fluid mx-2" alt="" style="max-width: 120px; height: auto;">
                  <img src="assets/img/batangas_logo.png" class="img-fluid mx-2" alt="" style="max-width: 100px; height: auto;">
                </div>
              </div>
            </div>
          </div>


        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>MENRO LIAN - GARBAGEGO</span></strong>. All Rights Reserved
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>