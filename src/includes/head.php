<meta charset="utf-8">
<link rel="apple-touch-icon" sizes="76x76" href="<?php echo $path ?>assets/img/apple-icon.png">
<?php if(!isset($customer)) : ?>
<link rel="icon" type="image/png" href="<?php echo $path ?>assets/img/favicon.png">
<?php else : ?>

<link rel="icon" type="image/png" href="<?php echo $customer->getFavIcon() ?>">
<?php endif ;?>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title>
    Paper Dashboard 2 PRO by Creative Tim
</title>
<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
<!--     Fonts and icons     -->
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">

<!-- CSS Files -->
<link href="<?php echo $path ?>assets/css/bootstrap.min.css" rel="stylesheet" />
<link href="<?php echo $path ?>assets/css/main.css" rel="stylesheet" />
<link href="<?php echo $path ?>assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
<!-- CSS Just for demo purpose, don't include it in your project -->
<link href="<?php echo $path ?>assets/demo/demo.css" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo $path ?>assets/vendor/jquery-ui/jquery-ui.css">
<style>
    #sortable {
        list-style-type: none;
        margin: 0;
        padding: 0;
    }

    #sortable li {
        margin: 3px 20px 3px 0;
        padding: 1px;
        float: left;
        width: 120px;
        height: 165px;
        font-size: 4em;
        text-align: center;
        vertical-align: middle;
        line-height: 2.5;
        position: relative;
    }
</style>