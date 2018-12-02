<div class="sidebar" data-color="white" data-active-color="danger">
    <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
    <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img src="<?php echo $path ?>assets/img/logo-small.png">
            </div>
        </a>
        <a href="http://www.creative-tim.com" class="simple-text logo-normal">
            Mylo
            <!-- <div class="logo-image-big">
            <img src="../assets/img/logo-big.png">
          </div> -->
        </a>
    </div>
    <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="<?php echo $path ?>assets/img/faces/ayo-ogunseinde-2.jpg" />
            </div>
            <div class="info">
                <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                    <span>
                        <?php echo $customer->getName() ?>
                        <b class="caret"></b>
                    </span>
                </a>
                <div class="clearfix"></div>
                <div class="collapse" id="collapseExample">
                    <ul class="nav">
                        <li>
                            <a href="profile.php">
                                <span class="sidebar-mini-icon">S</span>
                                <span class="sidebar-normal">Settings</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <ul class="nav">
            <?php if($current_url == 'index.php') : ?>
            <li class='active'>
                <?php else : ?>
                <li>
                    <?php endif; ?>
                    <a href="<?php echo $path ?>src/index.php">
                        <i class="nc-icon nc-bank"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <?php if($current_url == 'clients.php') : ?>
                <li class='active'>
                    <?php else : ?>
                    <li>
                        <?php endif; ?>
                        <a href="<?php echo $path ?>src/clients.php">
                            <i class="nc-icon nc-single-02"></i>
                            <p>Clients</p>
                        </a>
                    </li>
                    <?php if($current_url == 'galleries.php') : ?>
                    <li class='active'>
                        <?php else : ?>
                        <li>
                            <?php endif; ?>
                            <a href="<?php echo $path ?>src/galleries.php">
                                <i class="nc-icon nc-image"></i>
                                <p>Galleries</p>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $path ?>src/logout.php">
                                <i class="nc-icon nc-user-run"></i>
                                <p>Logout</p>
                            </a>
                        </li>
        </ul>
    </div>
</div>