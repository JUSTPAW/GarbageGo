<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name']) && isset($_SESSION['role']) && $_SESSION['role'] == 'driver') {
    include('../includes/header.php');
    include('../includes/navbar_driver.php');
    require '../db_conn.php';

    // Fetch data from the database
    $driver_id = $_SESSION['id'];
    $query = "SELECT fuelType, SUM(fuelAmount) AS totalFuel FROM fuel_slips WHERE driver_id = $driver_id GROUP BY fuelType";
    $result = mysqli_query($conn, $query);
    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-body">
                <div id="chartdiv" style="width: 100%; height: 500px;"></div>
            </div>
        </div>
    </div>
</div>
</div>

<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
<script src="https://cdn.amcharts.com/lib/4/plugins/export/export.js"></script>
<script src="https://cdn.amcharts.com/lib/4/plugins/scrollbar/scrollbar.js"></script>
<script>
am4core.ready(function() {
    am4core.options.commercialLicense = true;
    // Create the chart instance
    var chart = am4core.create("chartdiv", am4charts.XYChart);

    // Add data to the chart
    chart.data = <?php echo json_encode($data); ?>;

    // Create axes
    let categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "fuelType";
    categoryAxis.renderer.minGridDistance = 30; // Set minimum grid distance to avoid overlapping labels
    categoryAxis.renderer.labels.template.wrap = true; // Wrap labels to fit into available space

    let valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

    // Create series
    var series = chart.series.push(new am4charts.ColumnSeries());
    series.dataFields.valueY = "totalFuel";
    series.dataFields.categoryX = "fuelType";
    series.name = "Fuel Consumption";

    // Enable export
    chart.exporting.menu = new am4core.ExportMenu();
    chart.exporting.menu.container = document.getElementById("chartdiv");
    chart.exporting.filePrefix = "chart";

    // Style export menu buttons as Bootstrap "info" buttons
    chart.exporting.menu.items.forEach(function(item) {
        if (item.menu) {
            item.menu.forEach(function(subItem) {
                subItem.className = "btn btn-info"; // Change the class to "btn btn-info"
            });
        } else {
            item.className = "btn btn-info"; // Change the class to "btn btn-info"
        }
    });

    // Add X and Y scrollbar
    chart.scrollbarX = new am4core.Scrollbar();
    chart.scrollbarX.parent = chart.bottomAxesContainer; // Horizontal scrollbar at the bottom
    chart.scrollbarX.align = "center";

    chart.scrollbarY = new am4core.Scrollbar();
    chart.scrollbarY.parent = chart.leftAxesContainer; // Vertical scrollbar on the left side
    chart.scrollbarY.align = "left";
    chart.scrollbarY.valign = "middle";
});
</script>

<!-- End of Page Content -->
<?php
include('../includes/scripts.php');
include('../includes/footer.php');
} else {
    header("Location: ../login.php");
    exit();
}
?>
