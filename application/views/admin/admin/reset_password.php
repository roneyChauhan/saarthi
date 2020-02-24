<section class="flexbox-container">
    <div class="col-12 d-flex align-items-center justify-content-center">
        <div class="col-lg-4 col-md-6 col-10 box-shadow-2 p-0">
            <div class="card border-grey border-lighten-3 px-2 py-2 m-0">               
                <div class="card-header border-0">
                    <div class="text-center mb-1">
                        <img src="<?php echo asset_url(); ?>images/logo.png" alt="branding logo">
                    </div>
                    <div class="font-large-1  text-center">
                        Reset Password
                    </div>
                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                        <span>Please reset password here.</span>
                    </h6>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form-horizontal" action="<?php echo admin_url() . 'reset-password/' . $token; ?>" id="reset_password" method="POST" >
                            <fieldset class="form-group position-relative has-icon-left">
                                <input type="password" name="password" class="form-control round" id="password" placeholder="Enter Password" required="">
                                <div class="form-control-position">
                                    <i class="ft-lock"></i>
                                </div>
                            </fieldset>
                            <fieldset class="form-group position-relative has-icon-left">
                                <input type="password" name="cpassword" class="form-control round" id="cpassword" placeholder="Confirm Password" required="">
                                <div class="form-control-position">
                                    <i class="ft-lock"></i>
                                </div>
                            </fieldset>                            
                            <div class="form-group text-center">
                                <button type="submit" class="btn round btn-block btn-glow btn-bg-gradient-x-purple-blue col-12 mr-1 mb-1">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>