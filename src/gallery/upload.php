<?php

// Create and include a configuration file with the database connection

include('../config.php');

include('../functions.php');

$gallery_id = get('id');

?>
<!DOCTYPE html>
<html>

<head>
    <?php include("../includes/head.php");?>
    <link type="text/css" href="<?php echo $path ?>assets/css/dropzone.css" rel="stylesheet">
</head>

<body class="sidebar-mini">
    <?php include("../includes/sidenav.php");?>
    <!-- Main content -->
    <div class="main-panel">
        <!-- Top navbar -->
        <?php include("../includes/topnav.php");?>
        <!-- Page content -->
        <div class="content">
            <!-- Table -->
            <div class="card">
                <div class="card-body">
                    <form action="../upload/uploader.php?id=<?php echo $gallery_id ?>" class="dropzone" id="my-awesome-dropzone"></form>
                </div>
                <div class="col-1">
                    <a href="../gallery.php?id=<?php echo $gallery_id ?>" class="btn btn-success" role="button">
                        <span class="btn-label">
                            <i class="nc-icon nc-simple-add"></i>
                        </span>
                        Done
                    </a>

                </div>
                <!-- Footer -->
                <footer class="footer">

                </footer>
            </div>
        </div>
        <?php include('../includes/jsimports.php'); ?>
        <script src="../../assets/js/dropzone.js">
        </script>

</body>

</html>