<?php

// Create and include a configuration file with the database connection
include('config.php');

$search_action = "";

$searchTerm = '';
if(isset($_GET['search']))
{
	$searchTerm = $_GET['search'];
    $sql = file_get_contents('sql/getGalleriesSearch.sql');
    $params = array(
        'customerid' => $customer->getId(),
        'name' => $searchTerm ."%"
    );
    $statement = $database->prepare($sql);
    $statement->execute($params);
    $galleries = $statement->fetchAll(PDO::FETCH_ASSOC);
}else{
    $sql = file_get_contents('sql/getGalleries.sql');
    $params = array(
        'customerid' => $customer->getId()
    );
    $statement = $database->prepare($sql);
    $statement->execute($params);
    $galleries = $statement->fetchAll(PDO::FETCH_ASSOC);
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
        <!-- Header -->

        <!-- Page content -->
        <div class="content">
            <!-- Table -->
            <div class="row">

                <div style="padding-right: 15px;padding-left: 15px;">
                    <a href="./createGallery.php" class="btn btn-success" role="button">
                        <span class="btn-label">
                            <i class="nc-icon nc-simple-add"></i>
                        </span>
                        Create Gallery
                    </a>

                </div>
            </div>


            <div class="row">
                <?php foreach ($galleries as $gallery): ?>
                <div class="col-3">
                    <a href="./gallery.php?id=<?php echo $gallery['galleryid'] ?>">
                        <div class="card">
                            <img class="card-img-top" src="<?php echo $gallery['feature_url'] ?>" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?php echo $gallery['name'] ?>
                                </h5>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>

            </div>

        </div>
    </div>
    <?php include('includes/jsimports.php'); ?>
</body>

</html>