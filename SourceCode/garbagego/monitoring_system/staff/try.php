<!DOCTYPE html>
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
