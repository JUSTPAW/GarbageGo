<?php
function calculateTankBalance($initialBalance, $kilometersDriven, $fuelEfficiency) {
    // Calculate fuel consumption
    $fuelConsumption = $kilometersDriven / $fuelEfficiency;

    // Subtract fuel consumption from initial balance
    $updatedBalance = $initialBalance - $fuelConsumption;

    // Return the updated tank balance
    return $updatedBalance;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Fuel Tank Balance Calculator for Garbage Trucks</title>
    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Fuel Tank Balance Calculator for Garbage Trucks</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="initialBalance">Initial Tank Balance (liters)</label>
                <input type="number" class="form-control" id="initialBalance" name="initialBalance" required>
            </div>
            <div class="form-group">
                <label for="kilometersDriven">Kilometers Driven</label>
                <input type="number" class="form-control" id="kilometersDriven" name="kilometersDriven" required>
            </div>
            <div class="form-group">
                <label for="fuelEfficiency">Fuel Efficiency (L/km) for Garbage Trucks</label>
                <input type="number" step="0.01" class="form-control" id="fuelEfficiency" name="fuelEfficiency" required>
            </div>
            <button type="submit" class="btn btn-primary">Calculate</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve form inputs
            $initialBalance = $_POST['initialBalance'];
            $kilometersDriven = $_POST['kilometersDriven'];
            $fuelEfficiency = $_POST['fuelEfficiency'];

            // Calculate tank balance using the function
            $updatedBalance = calculateTankBalance($initialBalance, $kilometersDriven, $fuelEfficiency);

            // Calculate the percentage of tank balance remaining
            $percentageRemaining = ($updatedBalance / $initialBalance) * 100;

            // Display the updated tank balance with progress bar
            echo "<h3>Updated Tank Balance: {$updatedBalance} liters</h3>";
            echo '<div class="progress">';
            echo '<div class="progress-bar" role="progressbar" style="width: ' . $percentageRemaining . '%" aria-valuenow="' . $percentageRemaining . '" aria-valuemin="0" aria-valuemax="100">' . $percentageRemaining . '%</div>';
            echo '</div>';
        }
        ?>
    </div>
</body>
</html>
