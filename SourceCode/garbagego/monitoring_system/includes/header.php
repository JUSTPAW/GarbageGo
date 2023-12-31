<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MENRO LIAN - GARBAGEGO</title>

    <!-- for FF, Chrome, Opera -->
    <link href="../images/icon.jpg" rel="icon">
    <link href="../images/icon.jpg" rel="apple-touch-icon">

    <!-- for IE -->
    <link rel="icon" type="image/x-icon" href="images/favicon.jpg" >
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.jpg"/>

    <!-- Custom fonts for this template -->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/style2.css" rel="stylesheet">
    <link href="../css/style1.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    
    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css" rel="stylesheet">

    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.css' rel='stylesheet' />
    <link rel="preload" href="https://fonts.gstatic.com/s/nunito/v25/XRXV3I6Li01BKofINeaB.woff2" as="font" type="font/woff2" crossorigin="anonymous">

    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder@1.13.0/dist/Control.Geocoder.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />


<style>
div.dt-button-collection {
    width: auto;
}

div.dt-button-collection button.dt-button {
    display: inline-block;
    width: auto;
}

div.dt-button-collection button.buttons-colvis {
    display: inline-block;
    width: auto;
}
div.dt-button-collection h3 {
    margin-top: 5px;
    margin-bottom: 5px;
    font-weight: 100;
    border-bottom: 1px solid rgba(150, 150, 150, 0.5);
    font-size: 1em;
    padding: 0 1em;
    color: #026601;
}

div.dt-button-collection h3.not-top-heading {
    margin-top: 10px;
}

.form-group {
  position: relative;
}
.form-group input,
.form-group textarea {
  padding-top: 1.10rem; /* Reduced padding on the top */
}
.form-group select{
  padding-top: 0.7rem;
  padding-left: 0.5rem;
}
.form-group input[type="file"]{
  padding-top: 0.3rem;
  padding-left: 0.5rem;
}
.form-group label {
  position: absolute;
  top: 0.5rem; /* Added top padding */
  left: 1.3rem; /* Added left padding */
  pointer-events: none;
  transition: all 0.3s;
  transform-origin: 0 0;
  margin-bottom: 0.5rem; /* Added margin-bottom */
}
.form-group input:focus + label,
.form-group input:not(:placeholder-shown):not(:focus) + label,
.form-group select:focus + label,
.form-group select:valid + label,
.form-group select:disabled + label,
.form-group textarea:focus + label,
.form-group input[type="file"] + label,
.form-group textarea:not(:placeholder-shown):not(:focus) + label {
  transform: translateY(-100%) scale(0.75);
  font-size: 0.95rem; /* Increase font size */
  opacity: 0.75;
  color: green;
  left: 1.15rem;
  bottom: 0.99rem; /* Remove left margin */
}

.my-sweetalert {
    padding-bottom: 40px; /* You can adjust the padding value as needed */
}
</style>


<!--     <script src=”//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js”></script>

    
    <script src="//code.jquery.com/jquery-1.9.1.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script> -->


</head>
<body id="page-top" >





    <!-- Page Wrapper -->
    <div id="wrapper">