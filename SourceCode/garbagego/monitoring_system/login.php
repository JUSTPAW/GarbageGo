<?php
include('includes/header.php');
?>
<script type="text/javascript">
    window.history.forward();
    function noBack() {
        window.history.forward();
    }
</script>
<body>
    <style type="text/css">
        body {
            background-image: url('images/1.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            min-height: 100vh;
            width: 100%;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.3) 50%, rgba(0, 0, 0, 0.3)), url(images/1.jpg);
            background-position: top;
            background-size: cover;
            position: relative;
        }

        .role-option {
            position: relative;
            display: inline-block;
            cursor: pointer;
            margin: 10px;
        }

        .role-option img:hover {
            border: 2px solid #026601;
        }

        .role-option input[type="radio"]:checked+img+.role-text {
            color: #026601;
            font-weight: bold;
        }

        .role-text {
            display: block;
            margin-top: 5px;
            font-size: 13px;
            color: #000000;
        }

       .role-option input[type="radio"]:checked+img {
            border: 0.5px solid #026601;
            animation: glowing 1s infinite;
        }

        @keyframes glowing {
            0% { box-shadow: 0 0 5px #026601; }
            50% { box-shadow: 0 0 10px #026601; }
            100% { box-shadow: 0 0 5px #026601; }
        }

    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-12 col-md-12 col-sm-12">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <a href="../account.php" type="button" class="btn btn-md btn-outline-default mt-2 mr-2" style="float: right;">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </a>
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h2 text-gray-900">Hello! Welcome back.</h1>

                                        <form class="user" method="post" id="login-form">
                                            <?php if (isset($_GET['error'])) { ?>
                                                <p class="error"><?php echo $_GET['error']; ?></p>
                                            <?php } ?>

                                            <?php if (isset($_GET['success'])) { ?>
                                                <p class="success"><?php echo $_GET['success']; ?></p>
                                            <?php } ?>

                                            <div class="form-group text-center">
                                                <label for="role" class="small text-gray-900">Choose Account Type</label><br>
                                                <label class="role-option">
                                                    <input type="radio" id="admin" name="role" value="admin" style="opacity: 0; position: absolute; width: 1px; height: 1px; overflow: hidden;">
                                                    <img src="images/admin.png" class="img-fluid mx-auto d-block" alt="Admin" style="max-width: 100%; height: 60px;">
                                                    <span class="role-text">Admin</span>
                                                </label>

                                                <label class="role-option">
                                                    <input type="radio" id="staff" name="role" value="staff" style="opacity: 0; position: absolute; width: 1px; height: 1px; overflow: hidden;">
                                                    <img src="images/staff.png" class="img-fluid mx-auto d-block" alt="Staff" style="max-width: 100%; height: 60px;">
                                                    <span class="role-text">Staff</span>
                                                </label>

                                                <label class="role-option">
                                                    <input type="radio" id="driver" name="role" value="driver" style="opacity: 0; position: absolute; width: 1px; height: 1px; overflow: hidden;" required>
                                                    <img src="images/driver.png" class="img-fluid mx-auto d-block" alt="Driver" style="max-width: 100%; height: 60px;">
                                                    <span class="role-text">Driver</span>
                                                </label>
                                            </div>

                                            <div class="form-group">
                                                <input type="text" name="uname" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Username">
                                            </div>

                                            <div class="form-group">
                                                <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                            </div>

                                            <button type="submit" class="btn btn-info btn-user btn-block mt-2">Login</button>
                                        </form>
                                        <hr>
                                        <div class="text-center">
                                            <a class="small text-info text-center" href="forgot_password.php">Forgot Password?</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include('includes/scripts.php');
    ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const loginForm = document.getElementById('login-form');
        const roleOptions = document.querySelectorAll('.role-option input[type="radio"]');
        const errorMessage = document.querySelector('.error');
        const successMessage = document.querySelector('.success');

        loginForm.addEventListener('submit', function(event) {
            const selectedRole = document.querySelector('.role-option input[type="radio"]:checked');

            if (!selectedRole) {
                event.preventDefault(); // Prevent form submission
                errorMessage.style.display = 'block';
            } else {
                loginForm.action = selectedRole.value + '_login.php';

                // Show the error or success message if they exist
                if (errorMessage) {
                    errorMessage.style.display = 'block';
                }
                if (successMessage) {
                    successMessage.style.display = 'block';
                }
            }
        });
    });
</script>

</body>