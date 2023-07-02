<!DOCTYPE html>
<html>
<head>
  <title>Account Registration</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <style>
    .password-strength {
      margin-top: 5px;
      font-size: 12px;
    }
    .weak {
      color: red;
    }
    .medium {
      color: orange;
    }
    .strong {
      color: green;
    }
  </style>
  <script>
    function checkPasswordStrength() {
  var password = document.getElementById("password").value;
  var passwordStrength = document.getElementById("password-strength");

  // Define the criteria for weak, medium, and strong passwords
  var weakRegex = /^.{0,5}$/; // Less than 6 characters
  var mediumRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/; // At least 6 characters with lowercase, uppercase, and numeric characters
  var strongRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&_]).{6,}$/;

  if (strongRegex.test(password)) {
    passwordStrength.textContent = "Strong password";
    passwordStrength.className = "password-strength strong";
  } else if (mediumRegex.test(password)) {
    passwordStrength.textContent = "Medium password";
    passwordStrength.className = "password-strength medium";
  } else if (weakRegex.test(password)) {
    passwordStrength.textContent = "Weak password";
    passwordStrength.className = "password-strength weak";
  } else {
    passwordStrength.textContent = "Password is too short";
    passwordStrength.className = "password-strength";
  }
}
  </script>
</head>
<body>
  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#registrationModal">
    Register
  </button>

  <div class="modal fade" id="registrationModal" tabindex="-1" role="dialog" aria-labelledby="registrationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="registrationModalLabel">Account Registration</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="firstName" class="small text-info">First Name</label>
                <input type="text" class="small form-control" id="firstName" placeholder="Enter your first name">
              </div>
              <div class="form-group col-md-4">
                <label for="middleName" class="small text-info">Middle Name</label>
                <input type="text" class="form-control" id="middleName" placeholder="Enter your middle name">
              </div>
              <div class="form-group col-md-4">
                <label for="lastName" class="small text-info">Last Name</label>
                <input type="text" class="form-control" id="lastName" placeholder="Enter your last name">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="email" class="small text-info">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Enter your email address">
              </div>
              <div class="form-group col-md-6">
                <label for="phone" class="small text-info">Phone</label>
                <input type="text" class="form-control" id="phone" placeholder="Enter your phone number">
              </div>
            </div>
            <div class="form-group">
              <label for="userName" class="small text-info">Username</label>
              <input type="text" class="form-control" id="userName" placeholder="Enter a username">
            </div>
            <div class="form-group">
              <label for="password" class="small text-info">Password</label>
              <input type="password" class="form-control" id="password" placeholder="Enter a password" onkeyup="checkPasswordStrength()">
              <div id="password-strength" class="password-strength"></div>
            </div>
            <div class="form-group">
              <label for="repeatPassword" class="small text-info">Repeat Password</label>
              <input type="password" class="form-control" id="repeatPassword" placeholder="Repeat your password">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-info">Register</button>
        </div>
      </div>
    </div>
  </div>
  
</body>
</html>
