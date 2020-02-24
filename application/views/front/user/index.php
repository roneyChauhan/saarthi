<div class="tj-inner-banner">
    <div class="container">
        <h2>User Account</h2>
    </div>
</div>
<!--<div class="tj-breadcrumb">
    <div class="container">
        <ul class="breadcrumb-list">
            <li><a href="<?php echo base_url(); ?>">Home</a></li>
            <li class="active">User Account</li>
        </ul>
    </div>
</div>-->
<section class="tj-account-frm">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="tj-tabs">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="active"><a href="#user_account" data-toggle="tab"><i class="far fa-user"></i> My Account</a></li>
                        <li><a href="#booking_history" data-toggle="tab">
                        <i class="far fa-chart-bar"></i> Booking History</a></li>
                        <li><a href="<?php echo base_url().'auth/logout'; ?>"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="user_account">
                        <form class="account-frm" action="<?php echo base_url().'user'; ?>" method="POST">
                            <div class="col-md-6 col-sm-6">
                                <div class="account-field">
                                    <label>First Name</label>
                                    <span class="far fa-user"></span>
                                    <input type="text" name="first_name" value="<?php echo isset($user_details["first_name"]) ? $user_details["first_name"] : "" ; ?>" placeholder="Enter First Name">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="account-field">
                                    <label>Last Name</label>
                                    <span class="far fa-user"></span>
                                    <input type="text" name="last_name" value="<?php echo isset($user_details["last_name"]) ? $user_details["last_name"] : "" ; ?>"  placeholder="Enter Last Name">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="account-field">
                                    <label>What's App No.</label>
                                    <span class="icon-phone icomoon"></span>
                                    <input type="text" name="phone" value="<?php echo isset($user_details["phone"]) ? $user_details["phone"] : "" ; ?>" placeholder="Enter What's App Number">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="account-field">
                                    <label>Email</label>
                                    <span class="far fa-envelope"></span>
                                    <input type="text" name="email" value="<?php echo isset($user_details["email"]) ? $user_details["email"] : "" ; ?>" placeholder="Enter Email id">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="account-field">
                                    <label>Old Password</label>
                                    <span class="fas fa-lock"></span>
                                    <input type="password" name="old_pass" placeholder="Password">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="account-field">
                                    <label>New Password</label>
                                    <span class="fas fa-lock"></span>
                                    <input type="password" name="new_pass" placeholder="Password">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="account-field">
                                    <label>Confirm Password</label>
                                    <span class="fas fa-lock"></span>
                                    <input type="password" name="confirm_pass" placeholder="Password">
                                </div>
                            </div>
<!--                            <div class="col-md-6 col-sm-6">
                                <div class="account-field">
                                    <label>Profile Image</label>
                                    <button class="file-btn"><i class="fas fa-download"></i> Upload Photo</button>
                                    <span class="limit">Maximum file size : 6MB </span>
                                </div>
                            </div>-->
                            <div class="col-md-6 col-sm-6">
                                <button type="submit" class="save-btn">Save <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="booking_history">
                        <div class="table-responsive">
                            <table class="table table-striped" style="width:100% !important;" id="booking_table">
                                <thead>
                                    <tr>
                                        <th><i class="icon_profile"></i> Trip Date</th>
                                        <th><i class="icon_calendar"></i> Trip Type</th>
                                        <th><i class="icon_pin_alt"></i> From Location</th>
                                        <th><i class="icon_pin_alt"></i> To Location</th>
                                        <th><i class="icon_pin_alt"></i> Trip Status</th>
                                        <th><i class="icon_pin_alt"></i> Status</th>
                                        <th><i class="icon_mobile"></i> Amount</th>
                                        <th><i class="icon_mobile"></i> Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
    .payment-cancel-model {
        position    : absolute;
        top         : 10px;
        right       : 100px;
        bottom      : 0;
        left        : 0;
        z-index     : 10040;
        overflow    : auto;
        overflow-x  : auto;
        overflow-y  : auto;
     }
</style>
<div class="modal payment-cancel-model fade" id="modalCancelBooking" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Cancel Booking</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="cancel_from" id="cancel_from" method="post" >
                <div class="modal-body mx-3">
                    <div class="form-group mb-5 mt-3" >
                        <label for="message">For cancel booking please call on our service number given below!</label>
                    </div>
                    <div class="form-group mb-5 mt-3" >
                        <label for="message">&nbsp;</label>
                        <strong><a href="tel:+918200451795">+91 82004 51795</a></strong>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
