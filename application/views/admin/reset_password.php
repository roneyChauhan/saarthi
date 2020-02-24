
<div class="container-min-full-height justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="text-center mb-4 login_logo">
        <a href="javascript:void(0);">
            <img src="<?php echo front_asset_url() ?>img/logo.png" class="logo" alt="">
            <h3>Admin panel</h3>
        </a>
    </div>
    <div class="login-center">
        <form class="form-material reset_password" id="reset_password" method="POST">
            <div class="form-group no-gutters">
                <input type="password" class="form-control form-control-line" name="password" id="password">
                <label for="password" class="col-md-12 mb-1">Enter new password</label>
            </div>
            <span class="password-error"></span>
            <div class="form-group no-gutters">
                <input type="password" class="form-control form-control-line" name="cpassword" id="cpassword">
                <label for="cpassword" class="col-md-12 mb-1">Enter confirm password</label>
            </div>
            <span class="cpassword-error"></span>
            <div class="form-group mb-5">
                <button class="btn btn-block btn-lg btn-primary text-uppercase fs-12 fw-600" type="submit">Submit</button>
            </div>
            <input type="hidden" name="csrf_direct" value="<?php echo $this->security->get_csrf_hash(); ?>" />
        </form>
    </div>
</div>