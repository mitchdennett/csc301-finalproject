<?php

// Create and include a configuration file with the database connection
include('config.php');

include('functions.php');

$client_id = get('id');


if(!empty($client_id)) {
	$sql = file_get_contents('sql/getClient.sql');
	$params = array(
        'clientid' => $client_id,
        'customerid' => $customer->getId()
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
    $clients = $statement->fetchAll(PDO::FETCH_ASSOC);
    

	if(count($clients) > 0){
        $client = $clients[0];
    }else{
        header("Location: clients.php");
        die();
    }
}

// If form submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get username and password from the form as variables
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];

    // Query records that have usernames and passwords that match those in the customers table
    if(!isset($client)){
        $sql = file_get_contents('sql/insertClient.sql');
        $params = array(
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'city' => $city,
            'customerid' => $customer->getId()
        );
        $statement = $database->prepare($sql);
        $statement->execute($params);
    }else{
        $sql = file_get_contents('sql/updateClient.sql');
        $params = array(
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'city' => $city,
            'clientid' => $client_id,
            'customerid' => $customer->getId()
        );
        $statement = $database->prepare($sql);
        $statement->execute($params);
        
    }

    // Redirect to the index.php file
    header('location: clients.php');
    die();
}


?>
<!DOCTYPE html>
<html>

<head>
    <?php include("includes/head.php");?>
</head>

<body class="sidebar-mini">
    <?php include("includes/sidenav.php");?>
    <!-- Main content -->
    <div class="main-panel">
        <!-- Top navbar -->
        <?php include("includes/topnav.php");?>
        <!-- Page content -->
        <div class="content">
            <!-- Table -->
            <div class="row justify-content-md-center">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center text-muted mb-4">
                                <?php if(!isset($client)) : ?>
                                <h4>New Client</h4>
                                <?php else : ?>
                                <h4>Edit Client</h4>
                                <?php endif; ?>

                            </div>
                            <form role="form" action="" method="POST">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="nc-icon nc-single-02"></i></span>
                                        </div>
                                        <?php if(!isset($client)) : ?>
                                        <input class="form-control" placeholder="Name" type="text" name="name">
                                        <?php else : ?>
                                        <input readonly class="form-control" placeholder="Name" type="text" name="name"
                                            value="<?php echo $client['name'] ?>">
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="nc-icon nc-email-85"></i></span>
                                        </div>
                                        <?php if(!isset($client)) : ?>
                                        <input class="form-control" placeholder="Email" type="email" name="email">
                                        <?php else : ?>
                                        <input class="form-control" placeholder="Email" type="email" name="email" value="<?php echo $client['email'] ?>">
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="nc-icon nc-mobile"></i></span>
                                        </div>
                                        <?php if(!isset($client)) : ?>
                                        <input class="form-control" placeholder="Phone" type="phone" name="phone">
                                        <?php else : ?>
                                        <input class="form-control" placeholder="Phone" type="phone" name="phone" value="<?php echo $client['phone'] ?>">
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="nc-icon nc-shop"></i></span>
                                        </div>
                                        <?php if(!isset($client)) : ?>
                                        <input class="form-control" placeholder="Address" type="text" name="address">
                                        <?php else : ?>
                                        <input class="form-control" placeholder="Address" type="text" name="address"
                                            value="<?php echo $client['address'] ?>">
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="nc-icon nc-shop"></i></span>
                                        </div>
                                        <?php if(!isset($client)) : ?>
                                        <input class="form-control" placeholder="City" type="text" name="city">
                                        <?php else : ?>
                                        <input class="form-control" placeholder="City" type="text" name="city" value="<?php echo $client['city'] ?>">
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <?php if(!isset($client)) : ?>
                                    <button type="submit" class="btn btn-primary mt-4">Add Client</button>
                                    <?php else : ?>
                                    <button type="submit" class="btn btn-primary mt-4">Edit Client</button>
                                    <?php endif; ?>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer -->
            <footer class="footer footer-black  footer-white ">
                <div class="container-fluid">
                    <div class="row">
                        <nav class="footer-nav">
                            <ul>
                                <li>
                                    <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>
                                </li>
                                <li>
                                    <a href="http://blog.creative-tim.com/" target="_blank">Blog</a>
                                </li>
                                <li>
                                    <a href="https://www.creative-tim.com/license" target="_blank">Licenses</a>
                                </li>
                            </ul>
                        </nav>
                        <div class="credits ml-auto">
                            <span class="copyright">
                                ©
                                <script>
                                    document.write(new Date().getFullYear())
                                </script>, made with <i class="fa fa-heart heart"></i> by Creative Tim
                            </span>
                        </div>
                    </div>
                </div>
            </footer>
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
</body>

</html>