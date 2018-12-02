<?php

// Create and include a configuration file with the database connection
include('config.php');

// If form submitted:
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get username and password from the form as variables
    $username = $_POST['email'];
    $password = $_POST['password'];
    
    // Query records that have usernames and passwords that match those in the customers table
    $sql = file_get_contents('sql/attemptLogin.sql');
    $params = array(
      'username' => $username,
      'password' => $password
    );
    $statement = $database->prepare($sql);
    $statement->execute($params);
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    // If $users is not empty
    if(!empty($users)) {
      // Set $user equal to the first result of $users
      $user = $users[0];
      
      // Set a session variable with a key of customerID equal to the customerID returned
      $_SESSION['customerID'] = $user['customerid'];
      
      // Redirect to the index.php file
      header('location: index.php');
    }
  }

  if (isset($_SESSION["customerID"])) {
    header("Location: index.php");
    die();
  }

?>
<!DOCTYPE html>
<html style="height:100vh;">

<head>
    <?php include("includes/head.php");?>
</head>

<body class="login-page login-bg">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container">
            <div class="navbar-wrapper">
                <div class="navbar-toggle">
                    <button type="button" class="navbar-toggler">
                        <span class="navbar-toggler-bar bar1"></span>
                        <span class="navbar-toggler-bar bar2"></span>
                        <span class="navbar-toggler-bar bar3"></span>
                    </button>
                </div>
                <a class="navbar-brand" href="#pablo">Mylo Galleries</a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-bar navbar-kebab"></span>
                <span class="navbar-toggler-bar navbar-kebab"></span>
                <span class="navbar-toggler-bar navbar-kebab"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navigation">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link">
                            <i class="nc-icon nc-layout-11"></i> Home
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="register.php" class="nav-link">
                            <i class="nc-icon nc-book-bookmark"></i> Register
                        </a>
                    </li>
                    <li class="nav-item  active ">
                        <a href="login.php" class="nav-link">
                            <i class="nc-icon nc-tap-01"></i> Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="wrapper wrapper-full-page">
        <div class="full-page section-image ">
            <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
            <div class="content">
                <div class="container">
                    <div class="col-lg-4 col-md-6 ml-auto mr-auto">
                        <form class="form" method="POST" action="">
                            <div class="card card-login">
                                <div class="card-header ">
                                    <div class="card-header ">
                                        <h3 class="header text-center">Login</h3>
                                    </div>
                                </div>
                                <div class="card-body ">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="nc-icon nc-single-02"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="email" class="form-control" placeholder="Email...">
                                    </div>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="nc-icon nc-email-85"></i>
                                            </span>
                                        </div>
                                        <input type="password" name="password" placeholder="Password" class="form-control">
                                    </div>
                                    <br />
                                    <div class="form-group">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="" checked="">
                                                <span class="form-check-sign"></span>
                                                Subscribe to newsletter
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer ">
                                    <input type="submit" class="btn btn-warning btn-round btn-block mb-3">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="<?php echo $path ?>assets/js/core/jquery.min.js">
    </script>
    <script src="<?php echo $path ?>assets/js/core/popper.min.js">
    </script>
    <script src="<?php echo $path ?>assets/js/core/bootstrap.min.js">
    </script>
    <script src="<?php echo $path ?>assets/js/plugins/perfect-scrollbar.jquery.min.js">
    </script>
    <script src="<?php echo $path ?>assets/js/plugins/moment.min.js">
    </script>
    <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
    <script src="<?php echo $path ?>assets/js/plugins/bootstrap-switch.js">
    </script>
    <!--  Plugin for Sweet Alert -->
    <script src="<?php echo $path ?>assets/js/plugins/sweetalert2.min.js">
    </script>
    <!-- Forms Validations Plugin -->
    <script src="<?php echo $path ?>assets/js/plugins/jquery.validate.min.js">
    </script>
    <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
    <script src="<?php echo $path ?>assets/js/plugins/jquery.bootstrap-wizard.js">
    </script>
    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="<?php echo $path ?>assets/js/plugins/bootstrap-selectpicker.js">
    </script>
    <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
    <script src="<?php echo $path ?>assets/js/plugins/bootstrap-datetimepicker.js">
    </script>
    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
    <script src="<?php echo $path ?>assets/js/plugins/jquery.dataTables.min.js">
    </script>
    <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
    <script src="<?php echo $path ?>assets/js/plugins/bootstrap-tagsinput.js">
    </script>
    <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
    <script src="<?php echo $path ?>assets/js/plugins/jasny-bootstrap.min.js">
    </script>
    <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
    <script src="<?php echo $path ?>assets/js/plugins/fullcalendar.min.js">
    </script>
    <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
    <script src="<?php echo $path ?>assets/js/plugins/jquery-jvectormap.js">
    </script>
    <!--  Plugin for the Bootstrap Table -->
    <script src="<?php echo $path ?>assets/js/plugins/nouislider.min.js">
    </script>
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE">
    </script>
    <!-- Chart JS -->
    <script src="<?php echo $path ?>assets/js/plugins/chartjs.min.js">
    </script>
    <!--  Notifications Plugin    -->
    <script src="<?php echo $path ?>assets/js/plugins/bootstrap-notify.js">
    </script>
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="<?php echo $path ?>assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript">
    </script>
    <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
    <script src="<?php echo $path ?>assets/demo/demo.js">
    </script>
    <script>
        $(document).ready(function() {
            demo.checkFullPageBackgroundImage();
        });
    </script>
</body>

</html>