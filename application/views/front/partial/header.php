<header class="tj-header">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-4 col-xs-12">
                <div class="tj-logo">
                    <a href="<?php echo base_url(); ?>">
                        <img src="<?php echo front_asset_url() ?>images/logo.png" alt="Saarthi Rent & Ride"/>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-12">
                <div class="info_box">
                    <i class="fa fa-home"></i>
                    <div class="info_text">
                        <span class="info_title">Address</span>
                        <span>Saarthi Rent & Ride, Rajkot</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-12">
                <div class="info_box">
                    <i class="fa fa-envelope"></i>
                    <div class="info_text">
                        <span class="info_title">Email Us</span>
                        <span><a href="mailto:inquiry@saarthicab.com">inquiry@saarthicab.com</a></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-xs-12">
                <div class="phone_info">
                    <div class="phone_icon">
                        <i class="fas fa-phone-volume"></i>
                    </div>
                    <div class="phone_text">
                        <span><a href="tel:+918200451795">+91 82004 51795</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="tj-nav-row">
        <div class="container">
            <div class="row">
                <div class="tj-nav-holder">
                    <nav class="navbar navbar-default"> 
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#tj-navbar-collapse" aria-expanded="false"> 
                                <span class="sr-only">Menu</span>
                                <span class="icon-bar"></span> 
                                <span class="icon-bar"></span> 
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="collapse navbar-collapse" id="tj-navbar-collapse">
                            <ul class="nav navbar-nav">
                                <li>
                                    <a href="<?php echo base_url() ?>">Home</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url() . "about-us" ?>">About Us</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url() . "our-services" ?>">Services</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url() . "car/search" ?>">Our Fleets</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url() . "contact-us" ?>">Contact Us</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <div class="book_btn">
                        <?php 
                            $btn_url    = base_url().'auth/login'; 
                            $btn_text   = "Login/SignUp";
                            if(isset($is_login) && $is_login) {
                                $btn_url    = base_url().'user'; 
                                $btn_text   = "My Account";
                            }
                        ?>
                        <a href="<?php echo $btn_url; ?>"><?php echo $btn_text; ?> <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>