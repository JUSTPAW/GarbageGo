<!DOCTYPE html>
<html>
<head>
  <title>Garbage Truck Collection Schedule</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <h2>Garbage Truck Collection Schedule</h2>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Day</th>
          <th>Collection Time</th>
        </tr>
      </thead>
      <tbody>
        <?php
          // Replace this section with your own code to retrieve the schedule from a database or any other source
          $schedule = array(
            array('Monday', '8:00 AM'),
            array('Tuesday', '9:30 AM'),
            array('Wednesday', '11:15 AM'),
            array('Thursday', '10:45 AM'),
            array('Friday', '9:00 AM')
          );

          // Iterate over the schedule array and generate table rows dynamically
          foreach ($schedule as $entry) {
            echo '<tr>';
            echo '<td>' . $entry[0] . '</td>';
            echo '<td>' . $entry[1] . '</td>';
            echo '</tr>';
          }
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>
