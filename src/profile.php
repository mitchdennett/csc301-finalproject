<?php 
    include('config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('includes/head.php');?>
</head>

<body class="sidebar-mini">
    <script src="https://js.stripe.com/v3/"></script>
    <div class="wrapper ">
        <?php include('includes/sidenav.php');?>
        <div class="main-panel">
            <?php include('includes/topnav.php');?>
            <!-- End Navbar -->
            <!-- <div class="panel-header panel-header-sm">
  
  
</div> -->
            <div class="content">
                <div class="row row-eq-height">
                    <div class="col-md-4">
                        <div class="card card-user card-100">
                            <div class="card-header">
                                <?php if (!is_null($customer->getLogo())): ?>
                                <div class="image logo-profile" style="background-image: url(<?php echo $customer->getLogo()?>)">

                                </div>

                                <?php else : ?>
                                <div class="image logo-profile" style="background-image: url(../assets/img/image_placeholder.jpg)">

                                </div>
                                <?php endif; ?>
                                <hr>
                            </div>
                            <div class="card-body">
                                <div class="author">
                                    <a href="#">
                                        <img style="visibility:hidden" class="avatar border-gray" src="../assets/img/image_placeholder.jpg"
                                            alt="...">

                                        <h5 class="title">
                                            <?php echo $customer->getName();?>
                                        </h5>
                                    </a>
                                    <p class="description">

                                    </p>
                                </div>
                                <p class="description text-center" style="font-weight:normal;">
                                    <strong>Plan:</strong>
                                    <span>
                                        <?php echo $customer->getPlan() ?>
                                    </span>
                                </p>
                            </div>
                            <div class="card-footer">
                                <hr>
                                <div class="button-container">
                                    <!-- <div class="row">
                                        <div class="col-lg-3 col-md-6 col-6 ml-auto">
                                            <h5>12
                                                <br>
                                                <small>Files</small>
                                            </h5>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-6 ml-auto mr-auto">
                                            <h5>2GB
                                                <br>
                                                <small>Used</small>
                                            </h5>
                                        </div>
                                        <div class="col-lg-3 mr-auto">
                                            <h5>24,6$
                                                <br>
                                                <small>Spent</small>
                                            </h5>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card card-100">
                            <div class="card-header">
                                <h5 class="title">Edit Profile</h5>
                            </div>
                            <div class="card-body">
                                <form id="profileForm" method="POST" action="./api.php?request=customers">
                                    <div class="row">
                                        <div class="col-md-5 pr-1">
                                            <div class="form-group">
                                                <label>Company</label>
                                                <input type="text" class="form-control" name="company" placeholder="Company"
                                                    value="<?php echo $customer->getCompany();?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4 pl-1">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input disabled type="email" name="email" class="form-control"
                                                    placeholder="Email" value="<?php echo $customer->getEmail();?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 pr-1">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" name="firstname" class="form-control" placeholder="First Name"
                                                    value="<?php echo $customer->getFirstName();?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6 pl-1">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" name="lastname" class="form-control" placeholder="Last Name"
                                                    value="<?php echo $customer->getLastName();?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" name="address" name="address" class="form-control"
                                                    placeholder="Address" value="<?php echo $customer->getAddress();?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 pr-1">
                                            <div class="form-group">
                                                <label>City</label>
                                                <input type="text" name="city" name="city" class="form-control"
                                                    placeholder="City" value="<?php echo $customer->getCity();?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4 px-1">
                                            <div class="form-group">
                                                <label>Country</label>
                                                <input type="text" name="country" class="form-control" placeholder="Country"
                                                    value="<?php echo $customer->getCountry();?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4 pl-1">
                                            <div class="form-group">
                                                <label>Postal Code</label>
                                                <input type="number" name="zip" class="form-control" placeholder="ZIP Code"
                                                    value="<?php echo $customer->getZip();?>">
                                            </div>
                                        </div>
                                    </div>
                                    <button id="profileSaveBtn" type="submit" class="btn btn-warning btn-round mb-3"
                                        data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing Order">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-eq-height">
                    <div class="col-lg-7">
                        <div class="card card-100">
                            <div class="card-header">
                                <h5 class="title">Custom Branding</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4">
                                        <h4 class="card-title">Logo</h4>
                                        <div class="fileinput text-center fileinput-new">
                                            <div class="fileinput-new thumbnail branding-thumbnail">
                                                <?php if(!is_null($customer->getLogo())):?>
                                                <img id="logoImg" src="<?php echo $customer->getLogo();?>" alt="...">
                                                <?php else : ?>
                                                <img id="logoImg" src="../assets/img/image_placeholder.jpg" alt="...">

                                                <?php endif;?>
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style=""></div>
                                            <div>
                                                <form id="isform" method="POST" action="./upload/uploader.php?islogo=true&customerid=<?php echo $customer->getId() ?>"
                                                    enctype="multipart/form-data">
                                                    <span class="btn btn-rose btn-round btn-file">
                                                        <span class="fileinput-new">Upload New</span>

                                                        <input type="hidden" value="" name="hidden"><input id="logoInput"
                                                            type="file" name="file">
                                                    </span>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <h4 class="card-title">Favicon</h4>
                                        <div class="fileinput text-center fileinput-new">
                                            <div class="fileinput-new thumbnail branding-thumbnail">
                                                <?php if(!is_null($customer->getFavIcon())):?>
                                                <img id="faviconImg" src="<?php echo $customer->getFavIcon();?>" alt="...">
                                                <?php else : ?>
                                                <img id="faviconImg" src="../assets/img/image_placeholder.jpg" alt="...">

                                                <?php endif;?>
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style=""></div>
                                            <div>
                                                <form id="isFavIconForm" method="POST" action="./upload/uploader.php?isfavicon=true&customerid=<?php echo $customer->getId() ?>"
                                                    enctype="multipart/form-data">
                                                    <span class="btn btn-rose btn-round btn-file">
                                                        <span class="fileinput-new">Upload New</span>

                                                        <input type="hidden" value="" name="hidden"><input id="faviconInput"
                                                            type="file" name="file">
                                                    </span>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 disabled ">
                                        <h4 class="card-title">Watermark</h4>
                                        <div class="fileinput text-center fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail">
                                                <img src="../assets/img/image_placeholder.jpg" alt="...">
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style=""></div>
                                            <div>
                                                <span class="btn btn-rose btn-round btn-file">
                                                    <span class="fileinput-new">Select image</span>
                                                    <span class="fileinput-exists">Change</span>
                                                    <input type="hidden" value="" name="..."><input type="file" name="">
                                                </span>
                                                <a href="#pablo" class="btn btn-danger btn-round fileinput-exists"
                                                    data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                            </div>
                                        </div>
                                        <div> Coming Soon </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="card card-100">
                            <div class="card-header">
                                <h5 class="title">Payment Info</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Current Card</label>
                                            <?php if (!empty($customer->getLastFour())) : ?>
                                            <div class="StripeElement">
                                                <span class="CardBrandIcon-container"><i class="nc-icon nc-credit-card"></i></span>
                                                <span id="card-display" style="text-transform:uppercase;">
                                                    <?php echo $customer->getCardBrand() ?> -
                                                    **** ****
                                                    ****
                                                    <?php echo $customer->getLastFour() ?>
                                                </span>
                                            </div>
                                            <?php else : ?>
                                            <div class="StripeElement">
                                                <span class="CardBrandIcon-container"><i class="nc-icon nc-credit-card"></i></span>
                                                <span id="card-display" style="text-transform:uppercase;">
                                                    None
                                                </span>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <form action="/api.php?request=card" method="post" id="payment-form">
                                    <div class="row">
                                        <div class="col-md-12 pr-1">
                                            <div class="form-group">
                                                <label>Name On Card</label>
                                                <input type="text" name="card_name" class="form-control" placeholder="Name On Card">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 pr-1">
                                            <div class="form-group">
                                                <label>Billing Address</label>
                                                <input type="text" class="form-control" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 pr-1">
                                            <div class="form-group">
                                                <label>City</label>
                                                <input type="text" class="form-control" placeholder="" name="billingcity">
                                            </div>
                                        </div>
                                        <div class="col-md-4 px-1">
                                            <div class="form-group">
                                                <label>State</label>
                                                <input type="text" class="form-control" name="billingstate" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-md-4 pl-1">
                                            <div class="form-group">
                                                <label>Zip</label>
                                                <input type="text" class="form-control" placeholder="" name="billingzip">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="">
                                        <label for="card-element">
                                            Credit or debit card
                                        </label>
                                        <div id="card-element">
                                            <!-- A Stripe Element will be inserted here. -->
                                        </div>

                                        <!-- Used to display form errors. -->
                                        <div id="card-errors" role="alert"></div>
                                    </div>
                                    <?php if (!empty($customer->getLastFour())) : ?>
                                    <input id="addCardBtn" type="submit" value="Change Card" class="btn btn-warning btn-round btn-block mb-3">
                                    <?php else : ?>
                                    <input id="addCardBtn" type="submit" value="Add Card" class="btn btn-warning btn-round btn-block mb-3">
                                    <?php endif ; ?>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
    <?php include('includes/jsimports.php');?>
    <script>
        $('#isform').bind('ajax:complete', function(response) {

        });

        $('#logoInput').change(function() {
            $("#isform").on('submit', (function(e) {
                e.preventDefault();
                $.ajax({
                    url: "./upload/uploader.php?islogo=true&customerid=<?php echo $customer->getId() ?>",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        if (data == 'invalid') {
                            // invalid file format.
                            // $("#err").html("Invalid File !").fadeIn();
                        } else {
                            $("#logoImg").attr('src', data);
                        }
                    },
                    error: function(e) {
                        // $("#err").html(e).fadeIn();
                    }
                });
            }));
            $("#isform").submit();
        });

        $('#isform').bind('ajax:complete', function(response) {

        });

        $('#faviconInput').change(function() {
            $("#isFavIconForm").on('submit', (function(e) {
                e.preventDefault();
                $.ajax({
                    url: "./upload/uploader.php?isfavicon=true&customerid=<?php echo $customer->getId() ?>",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        if (data == 'invalid') {
                            // invalid file format.
                            // $("#err").html("Invalid File !").fadeIn();
                        } else {
                            $("#faviconImg").attr('src', data);
                        }
                    },
                    error: function(e) {
                        // $("#err").html(e).fadeIn();
                    }
                });
            }));
            $("#isFavIconForm").submit();
        });

        $("#profileForm").on('submit', (function(e) {
            e.preventDefault();
            $('#profileSaveBtn').html("<i class='fa fa-spinner fa-spin '></i> Saving...");
            $('#profileSaveBtn').attr("disabled", "true");


            var formData = new FormData(this)

            var object = {};
            formData.forEach(function(value, key) {
                object[key] = value;
            });

            $.post("./api.php?request=customers", {
                data: JSON.stringify(object)
            }).done(function() {
                $('#profileSaveBtn').html("Save");
                $('#profileSaveBtn').attr("disabled", null);
                $.notify({
                    // options
                    message: 'Saved!'
                }, {
                    // settings
                    type: 'success'
                });
            });
        }));
    </script>

    <script>
        // Create a Stripe client.
        var stripe = Stripe('pk_test_0qbY4YHy7lQfJ9QvaazhRvJB');

        // Create an instance of Elements.
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
            base: {
                color: '#32325d',
                lineHeight: '18px',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {
            style: style
        });

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {

            event.preventDefault();
            var formData = new FormData(this);
            $('#addCardBtn').html("<i class='fa fa-spinner fa-spin '></i> Adding...");
            $('#addCardBtn').attr("disabled", "true");

            stripe.createToken(card, {
                name: formData.get("card_name")
            }).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        });

        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);



            var formData = new FormData(form)

            var object = {};
            formData.forEach(function(value, key) {
                object[key] = value;
            });

            $.post("./api.php?request=card", {
                data: JSON.stringify(object)
            }).done(function(data) {
                form.reset();
                card.clear();
                $('#card-display').html(data['cardbrand'] + " - **** **** **** " + data['lastfour']);
                $('#addCardBtn').html("Change Card");
                $('#addCardBtn').attr("disabled", null);
                $.notify({
                    // options
                    message: 'Added Card'
                }, {
                    // settings
                    type: 'success'
                });
            });
        }
    </script>
</body>

</html>