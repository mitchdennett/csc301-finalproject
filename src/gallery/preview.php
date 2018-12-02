<?php
    include('../config.php');
    
    include('../functions.php');
    
    $gallery_id = get('id');
    
    if(isset($_SESSION['loggedIn'.$gallery_id])){
        $auth = true;
    }else{
        $auth = false;
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get username and password from the form as variables
        $password = $_POST['password'];
        
        // Query records that have usernames and passwords that match those in the customers table
        $sql = file_get_contents('../sql/attemptPreviewLogin.sql');
        $params = array(
          'password' => $password,
          'galleryid' => $gallery_id
        );
        $statement = $database->prepare($sql);
        $statement->execute($params);
        $items = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        // If $users is not empty
        if(!empty($items)) {
          // Set a session variable with a key of customerID equal to the customerID returned
          $_SESSION['loggedIn'.$gallery_id] = TRUE;
          $auth = TRUE;

          
        }

        header('Location:'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
        die();
    }

    $cart = &$_SESSION['cart'];

    $sql = file_get_contents('../sql/previewGalleryItems.sql');
    $params = array(
        'galleryid' => $gallery_id
    );
    $statement = $database->prepare($sql);
    $statement->execute($params);
    $galleryItems = $statement->fetchAll(PDO::FETCH_ASSOC);
    $passwordprotected = false;

    if(count($galleryItems) > 0){
        $firstItem = $galleryItems[0];

        $passwordprotected = $firstItem['passwordprotected'];
        $feature_url = $firstItem['feature_url'];
        $gallery_name = $firstItem['gallery_name'];
        $gallery_date = $firstItem['date'];
        $logo = $firstItem['logo'];
    }else{

    }
?>
<!DOCTYPE html>
<html>

<head>

    <!-- Include jQuery -->
    <script src="//code.jquery.com/jquery-1.11.2.min.js">
    </script>

    <!-- Include Final Tiles Gallery script -->
    <script src="../../assets/vendor/finaltilesgallery/js/jquery.finaltilesgallery.js">
    </script>

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <!-- Include Final Tiles Gallery stylesheet -->
    <link rel="stylesheet" href="../../assets/vendor/finaltilesgallery/css/finaltilesgallery.css">

    <link rel="stylesheet" href="../../assets/vendor/lightGallery-master/dist/css/lightgallery.min.css">

    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">

    <!-- CSS Files -->
    <link href="<?php echo $path ?>assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo $path ?>assets/css/main.css" rel="stylesheet" />
    <link href="<?php echo $path ?>assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />

</head>

<?php if(($passwordprotected && $auth) || !$passwordprotected ): ?>

<body style="">
    <div class="gallery-cover" style="background-image: url(<?php echo $firstItem['feature_url']?>);height:100vh;">
        <div class="gallery-detail">
            <h2>
                <?php echo $gallery_name ?>
            </h2>
            <div>
                <h3>
                    <?php echo $gallery_date ?>
                </h3>

            </div>
        </div>
    </div>
    <nav class="navbar sticky-top navbar-expand-lg bg-white shadow-sm" style="max-height:80px;">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img style="max-height:80px;" src="<?php echo $logo ?>" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-bar navbar-kebab"></span>
                <span class="navbar-toggler-bar navbar-kebab"></span>
                <span class="navbar-toggler-bar navbar-kebab"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Order Prints</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Download</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Share</a>
                    </li>
                </ul>
            </div>
            <div style="cursor:pointer">
                <span id="cartNumber" class="badge badge-pill badge-primary">
                    <?php echo $cart->getItemCount() ?></span>
                <i style="font-size:1.5rem;vertical-align: middle;" class="nc-icon nc-cart-simple"></i>
            </div>
        </div>
    </nav>


    <!-- All CSS classes in this snippet are mandatory! -->
    <div class="container-fluid" style="margin-top:15px;">
        <div class="final-tiles-gallery social-icons-right social-icons-none">
            <div class="ftg-items">
                <?php foreach ($galleryItems as $item) : ?>
                <div class="tile" data-src="<?php echo $item['s3_url'] ?>">
                    <a class="tile-inner">
                        <img class="item" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                            data-src="<?php echo $item['s3_url'] ?>" data-id="<?php echo $item['itemid'] ?>" />
                    </a>
                    <div class="ftg-social">
                        <a href="#" data-social="twitter"><i class="fa fa-twitter"></i></a>
                        <a href="#" data-social="facebook"><i class="fa fa-facebook"></i></a>
                        <a href="#" data-social="google-plus"><i class="fa fa-google"></i></a>
                        <a href="#" data-social="pinterest"><i class="fa fa-pinterest"></i></a>
                        <a href="#" class="addtocard"><i class="nc-icon nc-cart-simple"></i></a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <script src="<?php echo $path ?>assets/js/core/bootstrap.min.js">
    </script>
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="<?php echo $path ?>assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript">
    </script>

    <script src="<?php echo $path ?>assets/vendor/lightGallery-master/dist/js/lightgallery.min.js">
    </script>

    <!-- lightgallery plugins -->
    <script src="<?php echo $path ?>assets/vendor/lightGallery-master/modules/lg-thumbnail.min.js">
    </script>
    <script src="<?php echo $path ?>assets/vendor/lightGallery-master/modules/lg-addcart.js">
    </script>
    <script src="<?php echo $path ?>assets/js/preview.js" type="module"></script>
</body>
<?php else: ?>

<body style="background:whitesmoke">
    <div class="content" style="height:100vh;justify-content: center;display: flex;flex-direction: column;">
        <div class="container align-middle">
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
                                        <i class="nc-icon nc-email-85"></i>
                                    </span>
                                </div>
                                <input type="password" name="password" placeholder="Password" class="form-control">
                            </div>
                            <br />
                        </div>
                        <div class="card-footer ">
                            <input type="submit" value="Login" class="btn btn-warning btn-round btn-block mb-3">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="<?php echo $path ?>assets/js/core/bootstrap.min.js">
    </script>
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="<?php echo $path ?>assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript">
    </script>

</body>
<?php endif;?>

</html>