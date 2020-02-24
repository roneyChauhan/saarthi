<!--<div class="container-min-full-height justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="text-center mb-4 login_logo">
        <a href="javascript:void(0);">
            <img src="<?php echo front_asset_url() ?>img/logo.png" class="logo" alt="">
            <h3>Admin panel</h3>
        </a>
    </div>
    <div class="login-center">
        <form class="form-signin forgot_password" id="forgot_password" method="POST">
            <p class="text-center text-muted">Enter your email address and we'll send you an email with instructions to reset your password.</p>
            <div class="form-group">
                <label for="example-email" class="col-md-12 mb-1">Email</label>
                <input type="email" placeholder="johndoe@site.com" class="form-control form-control-line" name="email" id="email">
                
            </div>
            <span class="mail-error"></span>
            <div class="form-group mb-5">
                <button class="btn btn-block btn-lg btn-primary text-uppercase fs-12 fw-600" type="submit">Submit</button>
            </div>
        </form>
        <footer class="col-sm-12 text-center">
            <p>Back to <a href="<?php echo base_url(); ?>admin" class="text-primary m-l-5"><b>Login</b></a>
            </p>
        </footer>
    </div>
</div>-->
<section class="flexbox-container">
    <div class="col-12 d-flex align-items-center justify-content-center">
        <div class="col-lg-4 col-md-6 col-10 box-shadow-2 p-0">
            <div class="card border-grey border-lighten-3 px-2 py-2 m-0">               
                <div class="card-header border-0">
                    <div class="text-center mb-1">
                        <img src="<?php echo asset_url(); ?>images/logo.png" alt="branding logo">
                    </div>
                    <div class="font-large-1  text-center">
                        Recover Password
                    </div>
                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                        <span>We will send you a link to reset password.</span>
                    </h6>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form-horizontal" action="<?php echo admin_url(); ?>forgot-password" id="forgot_password" method="POST" >
                            <fieldset class="form-group position-relative has-icon-left">
                                <input type="email" name="email" class="form-control round" id="user-email" placeholder="Your Email Address" required="">
                                <div class="form-control-position">
                                    <i class="ft-mail"></i>
                                </div>
                            </fieldset>                            
                            <div class="form-group text-center">
                                <button type="submit" class="btn round btn-block btn-glow btn-bg-gradient-x-purple-blue col-12 mr-1 mb-1">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-footer border-0 p-0">
                    <p class="float-sm-center text-center">
                        <a href="<?php echo admin_url(); ?>login" class="card-link">Click here to Login</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>