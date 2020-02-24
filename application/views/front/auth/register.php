<section class="section sign-up">
    <div class="container">
        <div class="row">

            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                <h2 class="head-title"> Create your the Arya Samaj eLibrary Account</h2>
                <p class="head-sub mb-0">Please fill all the details to continue</p>
                <div class="e_form_div form-wrapper sign_up_div">
                    <form method="post" name="register_form" id="register_form" class="e_form form" action="" autocomplete="off">
                        <div class="row">
                            <div class="textfield_gorup form-group col-xl-6 col-md-6">
                                <label class="form-label" for="first_name">First Name</label>
                                <input type="text" name="first_name" class="custom_textbox" id="first_name" autocomplete="nop">  
                            </div>
                            <div class="textfield_gorup form-group col-xl-6 col-md-6">
                                <label class="form-label" for="last_name">Last Name</label>
                                <input type="text" name="last_name" class="custom_textbox" id="last_name" autocomplete="nop">
                            </div>
                            <div class="textfield_gorup form-group col-xl-6 col-md-6">
                                <label class="form-label" for="email">Email</label>
                                <input type="text" name="email" class="custom_textbox" id="email" autocomplete="nopee">                              
                                <span class="error">Please enter a valid email address</span>
                            </div>
                            <div class="textfield_gorup form-group col-xl-6 col-md-6">
                                <label class="form-label" for="mobile_no">Mobile</label>
                                <input type="text" name="mobile_no" class="custom_textbox" id="mobile_no" autocomplete="nop"> 
                            </div>
                            <div class="textfield_gorup form-group col-xl-6 col-md-6">
                                <label class="form-label" for="date_of_birth">Date of Birth (YYYY-MM-DD)</label>
                                <input type="text" name="date_of_birth" class="custom_textbox" id="date_of_birth" autocomplete="nop">
                            </div>
                            <div class="textfield_gorup form-group col-xl-6 col-md-6">
                                <label class="form-label" for="country">Country</label>
                                <input type="text" name="country"  class="custom_textbox" id="country" autocomplete="nop">
                                <!-- <i class="fas fa-sort-down"></i> -->
                            </div>
                            <div class="textfield_gorup form-group col-xl-6 col-md-6">
                                <label class="form-label" for="password">Password</label>
                                <input type="Password" name="password" class="custom_textbox" id="password" autocomplete="nop">
                                <span class="pass-info">Use 6 or more characters with a mix of letters,numbers & symbols.</span>
                            </div>
                            <div class="textfield_gorup form-group col-xl-6 col-md-6">
                                <label class="form-label" for="cpassword">Confirm password</label>
                                <input type="Password" name="cpassword" class="custom_textbox" id="cpassword" autocomplete="nop"> 
                                <!-- <i class="fas fa-eye"></i> -->
                            </div>
                            <div class="textfield_gorup captcha-image mb-4 col-xl-6 col-md-6">
                                <img src="<?php echo front_asset_url() ?>images/captcha.jpg" class="">
                            </div>
                            <div class="textfield_gorup col-xl-6 col-md-6">
                                <button type="submit" class="signin_button signup_btn">Sign Up</button>
                                <p class="text-md-right"><a href="<?php echo base_url(); ?>auth/login" class="exterlink sign-in-link">Sign in Instead</a></p>
                            </div>
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
</section>