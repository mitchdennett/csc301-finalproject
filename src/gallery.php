<?php

// Create and include a configuration file with the database connection

include('config.php');

include('functions.php');

$gallery_id = get('id');


if(!empty($gallery_id)) {
    $sql = file_get_contents('sql/getGallery.sql');
    $params = array(
        'galleryid' => $gallery_id,
        'customerid' => $customer->getId()
    );
    $statement = $database->prepare($sql);
    $statement->execute($params);
    $galleries = $statement->fetchAll(PDO::FETCH_ASSOC);

    if(count($galleries) > 0){
        $gallery = $galleries[0];
    }else{
        header("Location: galleries.php");
        die();
    }

    $sql = file_get_contents('sql/getGalleryItems.sql');
    $params = array(
        'galleryid' => $gallery_id,
        'customerid' => $customer->getId()
    );
    $statement = $database->prepare($sql);
    $statement->execute($params);
    $galleryItems = $statement->fetchAll(PDO::FETCH_ASSOC);
    if(count($galleryItems) > 0){
        $hasGalleryItems = True;
    } else {
        $hasGalleryItems = False;
    }
}

?>
<!DOCTYPE html>
<html class="h-100">

<head>
    <?php include("includes/head.php");?>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
        #feedback { font-size: 1.4em; }
  #sortable .ui-selecting { background: #FECA40; }
  #sortable .ui-selected { background: #F39814; color: white; }
  /* #sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
  #sortable li { margin: 3px; padding: 0.4em; font-size: 1.4em; height: 18px; } */
  </style>
</head>

<body class="sidebar-mini h-100">
    <?php include("includes/sidenav.php");?>
    <!-- Main content -->
    <div class="main-panel h-100">
        <!-- Top navbar -->
        <?php include("includes/topnav.php");?>
        <!-- Page content -->
        <div class="content" style="height: calc(100vh - 93px) !important;">
            <!-- Table -->
            <div class="row">
                <div style="padding-right: 15px;padding-left: 15px;">
                    <a href="./galleries.php" class=" btn btn-success" role="button">
                        <span class="btn-label">
                            <i class="nc-icon nc-minimal-left"></i>
                        </span>
                        Back
                    </a>
                    <a href="./gallery/upload.php?id=<?php echo $gallery_id ?>" class="btn btn-success" role="button">
                        <span class="btn-label">
                            <i class="nc-icon nc-simple-add"></i>
                        </span>
                        Add Photos
                    </a>
                    <a href="./gallery/preview.php?id=<?php echo $gallery_id ?>" class=" btn btn-success" role="button">
                        <span class="btn-label">
                            <i class="nc-icon nc-zoom-split"></i>
                        </span>
                        Preview
                    </a>

                    <span class="dropdown">
                        <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            More
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Share</a>
                            <a class="dropdown-item" href="#">Delete</a>
                            <a class="dropdown-item" href="#">Generate App</a>
                            <a class="dropdown-item" href="#">Settings</a>
                        </div>
                    </span>
                </div>
            </div>
            <div class="row" style="height: calc(100% - 30px);">
                <div class="col-sm-12 h-100" style="max-width:350px;">
                    <div class="card" style="height:calc(100% - 20px)">
                        <div class="card-body justify-content-center h-100">
                            <div id="featuredImage" class="featured-img" style="background-image:url(<?php echo $gallery['feature_url'] ?>);">
                                <a>
                                    <i class="nc-icon nc-image"></i>
                                    Cover Image
                                </a>
                            </div>

                        </div>
                        <!-- Footer -->
                        <footer class="footer">

                        </footer>
                    </div>
                </div>
                <div class="col h-100">
                    <div class="card" style="height:calc(100% - 20px)">
                        <div class="card-body justify-content-center h-100">
                            <div class="h-100" style="overflow-y:auto;">
                                <?php if ($hasGalleryItems) : ?>


                                <ul id="sortable">
                                    <?php foreach ($galleryItems as $item) : ?>
                                    <li class="ui-state-default ui-corner-all" id="item_<?php echo $item['itemid'] ?>">
                                        <img style="max-width: 100px;max-height:120px;vertical-align: middle;" class="card-img-top"
                                            src="<?php echo $item['s3_url'] ?>" alt="Card image cap">
                                        <div class="gallery-buttons">
                                            <?php if($item['s3_url'] == $gallery['feature_url']): ?>
                                            <i class="nc-icon nc-album-2 featured" title="Make Cover Photo" data-key="<?php echo $item['itemid'] ?>"></i>
                                            <?php else : ?>
                                            <i class="nc-icon nc-album-2" title="Make Cover Photo" data-key="<?php echo $item['itemid'] ?>"></i>
                                            <?php endif;?>

                                        </div>
                                    </li>

                                    <?php endforeach; ?>
                                </ul>

                                <?php else : ?>
                                <h2 class="text-center">No photos</h2>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('includes/jsimports.php');?>
        <script src="../assets/vendor/jquery-ui/jquery-ui.min.js">
        </script>
        <script>
            $(function() {
                $("#sortable").sortable({
                    update: function(event, ui) {
                        $.post('updateSort.php', $(this).sortable('serialize'));
                    }
                });

                $('.gallery-buttons i').click(function(event, ui) {
                    var currentElement = $(this);
                    var url = $('#item_' + currentElement.attr('data-key') + ' img').attr('src');
                    var obj = {
                        galleryid: <?php echo $gallery_id ?>,
                        feature_url: url
                    };

                    $.post('api.php?request=galleries', {
                            data: JSON.stringify(obj)
                        })
                        .done(function(data) {
                            $('.gallery-buttons i.featured').removeClass('featured');
                            currentElement.addClass('featured');
                            $("#featuredImage").css('background-image', 'url(' + url + ')');
                        });
                })
            });
        </script>
</body>

</html>