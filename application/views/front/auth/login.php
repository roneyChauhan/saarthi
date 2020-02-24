<div class="tj-inner-banner">
    <div class="container">
        <h2>Login</h2>
    </div>
</div>
<div class="tj-breadcrumb">
    <div class="container">	
        <ul class="breadcrumb-list">
            <li><a href="home-1.html">Home</a></li>
            <li class="active">Login</li>
        </ul>	
    </div>
</div>
<section class="tj-login">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="tj-tabs">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="active"><a href="#login" data-toggle="tab">Login</a></li>
                        <li><a href="#register" data-toggle="tab">Register</a></li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="login">
                        <div class="col-md-6 col-sm-6">
                            <div class="login-cta">
                                <ul class="cta-list">
                                    <li>
                                        <span class="icon-mail-envelope icomoon"></span>
                                        <div class="cta-info">
                                            <strong>30 Days Money Back Guarantee</strong>
                                            <p>A more recently with desktop softy like aldus pages maker still versions have evolved.</p>
                                        </div>
                                    </li>
                                    <li>
                                        <span class="icon icon-Headset"></span>
                                        <div class="cta-info">
                                            <strong>24/7 Customer Support</strong>
                                            <p>A more recently with desktop softy like aldus pages maker still versions have evolved.</p>
                                        </div>
                                    </li>
                                    <li>
                                        <span class="icon-lock icomoon"></span>
                                        <div class="cta-info">
                                            <strong>100% Secure Payment</strong>
                                            <p>A more recently with desktop softy like aldus pages maker still versions have evolved.</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <form method="post" class="login-frm" name="login_form" id="login_form" action="" autocomplete="off" >
                                <div class="field-holder">
                                    <span class="far fa-envelope"></span>
                                    <input type="text" name="username" placeholder="Enter Phone or Email Id" autocomplete="asfsaf">
                                </div>
                                <div class="field-holder">
                                    <span class="fas fa-lock"></span>
                                    <input type="password" name="password" placeholder="Password" autocomplete="sdfsdf" >
                                </div>
                                <a href="<?php echo base_url().'auth/forgot_password' ?>" class="forget-pass">Forget Password?</a>
                                <button type="submit" class="reg-btn">Login 
                                    <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane" id="register">
                        <div class="col-md-6 col-sm-6">
                            <div class="reg-cta">
                                <ul class="cta-list">
                                    <li>
                                        <span class="icon-mail-envelope icomoon"></span>
                                        <div class="cta-info">
                                            <strong>30 Days Money Back Guarantee</strong>
                                            <p>A more recently with desktop softy like aldus pages maker still versions have evolved.</p>
                                        </div>
                                    </li>
                                    <li>
                                        <span class="icon icon-Headset"></span>
                                        <div class="cta-info">
                                            <strong>24/7 Customer Support</strong>
                                            <p>A more recently with desktop softy like aldus pages maker still versions have evolved.</p>
                                        </div>
                                    </li>
                                    <li>
                                        <span class="icon-lock icomoon"></span>
                                        <div class="cta-info">
                                            <strong>100% Secure Payment</strong>
                                            <p>A more recently with desktop softy like aldus pages maker still versions have evolved.</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <form method="post" name="register_form" id="register_form" class="reg-frm" action="" autocomplete="off">
                                <div class="field-holder">
                                    <span class="far fa-user"></span>
                                    <input type="text" name="first_name" id="first_name" placeholder="Fast Name">
                                </div>
                                <div class="field-holder">
                                    <span class="far fa-user"></span>
                                    <input type="text" name="last_name" id="last_name" placeholder="Last Name">
                                </div>
                                <div class="field-holder">
                                    <span class="far fa-envelope"></span>
                                    <input type="text" name="email" placeholder="Enter your Email Address">
                                </div>
                                <div class="field-holder">
                                    <span class="far fa-envelope"></span>
                                    <input type="text" name="mobile_no" id="mobile_no" placeholder="Enter your Mobile No">
                                </div>
                                <div class="field-holder">
                                    <span class="fas fa-lock"></span>
                                    <input type="password" name="password" id="password" placeholder="Password">
                                </div>
                                <div class="field-holder">
                                    <span class="fas fa-lock"></span>
                                    <input type="password" name="cpassword" id="cpassword" placeholder="Confirm Password">
                                </div>
                                <div class="field-holder">
                                    <label for="terms">
                                        <input type="checkbox" name="terms" id="terms">
                                    </label>
                                    I accept <a href="<?php echo base_url(). "terms" ?>" target="_blank" >terms & conditions </a>
                                    <div class="tearms-error"></div>
                                </div>
                                <button type="submit" class="reg-btn">Signup <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
<!--                                <button type="submit" class="facebook-btn">Login with Facebook <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
                                <button type="submit" class="google-btn">Login with Google <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>-->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="tj-cal-to-action">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="cta-box">
                    <img src="<?php echo front_asset_url() ?>images/offer-icon1.png" alt=""/>
                    <div class="cta-text">
                        <strong>Best Price Guaranteed</strong>
                        <p>We assure you for the best & competitive price for your journey which suits your pocket as well.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="cta-box">
                    <img src="<?php echo front_asset_url() ?>images/offer-icon2.png" alt=""/>
                    <div class="cta-text">
                        <strong>24/7 Customer Care</strong>
                        <p>Don't worry while your journey we are with you everytime and everywhere just call us!</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="cta-box">
                    <img src="<?php echo front_asset_url() ?>images/offer-icon3.png" alt=""/>
                    <div class="cta-text">
                        <strong>Home Pickups</strong>
                        <p>We are the best in class and provide world class Home pickups services to our beloved clients.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="cta-box">
                    <img src="<?php echo front_asset_url() ?>images/offer-icon4.png" alt=""/>
                    <div class="cta-text">
                        <strong>Easy Bookings</strong>
                        <p>We have Developed Easy and smooth booking systems which takes you for only 3 Easy steps to book your journey with Saarthi.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--<section class="section sign-in">
    <div class="container">
        <div class="row">

            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 text-md-center text-lg-left">
                <h2 class="head-title">Sign In</h2>
                <p class="head-sub mb-0">to continue for The Arya Samaj eLibrary Account</p>

                <div class="e_form_div form-wrapper">
                    <form method="post" class="e_form form" name="login_form" id="login_form" action="" autocomplete="off" >
                        <div class="textfield_gorup form-group">
                            <label class="form-label" for="email">Email</label>
                            <input type="text" name="email" class="custom_textbox" id="email" autocomplete="nope">
                            <span class="error">Please enter a valid email address</span>
                        </div>
                        <div class="textfield_gorup form-group">
                            <label class="form-label" for="pass">Password</label>
                            <input type="Password" name="password" class="custom_textbox" id="Password" autocomplete="nopesaa">
                        </div>
                        <div class="textfield_gorup text-right">
                            <a href="<?php echo base_url()."auth/forgot_password" ?>">Forgot password?</a>
                        </div>
                        <div class="textfield_gorup ">
                            <button type="submit" class="signin_button signin_btn ">Sign In</button>
                        </div>
                        <div class="textfield_gorup">
                            <p>Don't you have an Account? <a href="<?php echo base_url(); ?>auth/register" class="exterlink">Create new account Now! </a></p>
                        </div>

                    </form>
                </div>



            </div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                <div class="formright_img">
                    <img src="<?php echo front_asset_url() ?>images/elibrary-img.png" alt="eLibrary" title="eLibrary">
                </div>
            </div>

        </div>
    </div>
</div>
</section>-->