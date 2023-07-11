<!DOCTYPE html>
<html>
<head>
  <title>Gasoline Management - Garbage Trucks</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <h1>Gasoline Management - Garbage Trucks</h1>
    <form method="POST" action="process.php">
      <div class="form-group">
        <label for="truck_id">Truck ID:</label>
        <input type="text" class="form-control" id="truck_id" name="truck_id" required>
      </div>
      <div class="form-group">
        <label for="gasoline_quantity">Gasoline Quantity (in liters):</label>
        <input type="number" class="form-control" id="gasoline_quantity" name="gasoline_quantity" required>
      </div>
      <div class="form-group">
        <label for="date">Date:</label>
        <input type="date" class="form-control" id="date" name="date" required>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
