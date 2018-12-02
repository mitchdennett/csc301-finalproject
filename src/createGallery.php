<?php

// Create and include a configuration file with the database connection
include('config.php');


// If form submitted:
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get username and password from the form as variables
    $galleryname = $_POST['galleryname'];
    $date = $_POST['date'];
    $client_id = $_POST['clientid'];

    $sql = file_get_contents('sql/insertGallery.sql');
    $params = array(
        'name' => $galleryname,
        'date' => $date,
        'clientid' => $client_id,
        'customerid' => $customer->getId()
    );
    $statement = $database->prepare($sql);
    $statement->execute($params);

    $id = $database->lastInsertId();

    // Redirect to the index.php file
    header('location: gallery.php?id='.$id);
    die();
}else{
  $sql = file_get_contents('sql/getClients.sql');
  $params = array(
      'customerid' => $customer->getId()
  );
  $statement = $database->prepare($sql);
  $statement->execute($params);
  $clients = $statement->fetchAll(PDO::FETCH_ASSOC);
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
            <div class="row">
                <div style="padding-right: 15px;padding-left: 15px;">
                    <a href="./galleries.php" class=" btn btn-success" role="button">
                        <span class="btn-label">
                            <i class="nc-icon nc-minimal-left"></i>
                        </span>
                        Back
                    </a>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-6">
                    <div class="card ">
                        <div class="card-body">
                            <div class="text-center text-muted mb-4">
                                <h4>Create Gallery</h4>
                            </div>
                            <form role="form" action="" method="POST">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="nc-icon nc-image"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Gallery Name" type="text" name="galleryname">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="nc-icon nc-calendar-60"></i></span>
                                        </div>
                                        <input class="form-control datetimepicker" name="date" placeholder="Select date of event"
                                            type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="nc-icon nc-single-02"></i></span>
                                        </div>
                                        <select class="form-control" name="clientid">
                                            <?php foreach ($clients as $client) : ?>
                                            <option value="<?php echo $client['clientid'] ?>">
                                                <?php echo $client['name'] ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary mt-4">Create Gallery</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer -->
            <footer class="footer">

            </footer>
        </div>
    </div>

    <?php include('includes/jsimports.php');?>
    <script>
        <!-- javascript for init -->
        $('.datetimepicker').datetimepicker({
            format: 'DD/MM/YYYY',
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-screenshot',
                clear: 'fa fa-trash',
                close: 'fa fa-remove'
            }
        });
    </script>

</body>

</html>