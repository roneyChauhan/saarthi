<section id="basic-form-layouts">
    <div class="row match-height">
        <div class="col-md-12">
            <div class="card">
                <div class="card-content collapse show">
                    <div class="card-body">
                        <form class="form" id="profileForm" method="POST" action="<?php echo isset($action_url) ? $action_url : ''; ?>">
                            <input type="hidden" name="user_id" value="<?php echo isset($user->id) ? encryptIt($user->id) : ""; ?>">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input type="text" id="first_name" class="form-control" placeholder="First Name" name="first_name" value="<?php echo isset($user->first_name) ? $user->first_name : ''; ?>">
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_name">Last Name</label>
                                            <input type="text" id="last_name" class="form-control" placeholder="Last Name" name="last_name" value="<?php echo isset($user->last_name) ? $user->last_name : ''; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="companyName">Username</label>
                                        <input type="text" id="username" class="form-control" placeholder="Username" name="username" value="<?php echo isset($user->username) ? $user->username : ''; ?>" <?php echo (!isset($user->id) || (isset($user->id) && $loginUser['id'] != $user->id)) ? '' : 'readonly'; ?>>
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="companyinput1">Email</label>
                                            <input type="text" id="profile_email" class="form-control" placeholder="Email" name="email" value="<?php echo isset($user->email) ? $user->email : ''; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="companyName">Password</label>
                                        <input type="password" id="password" class="form-control" placeholder="Enter your password" name="password">
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="companyinput1">Confirm password</label>
                                            <input type="password" id="cpassword" class="form-control" placeholder="Enter your password again" name="cpassword">
                                        </div>
                                    </div>
                                </div>
                                <?php if (!isset($user->id) || (isset($user->id) && $loginUser['id'] != $user->id)) { ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group pb-1">
                                                <input type="checkbox" id="is_active" name="is_active" class="switchery" <?php echo (!isset($user->is_active) || (isset($user->is_active) && ($user->is_active == '1'))) ? 'checked' : ''; ?>/>
                                                <label for="is_active" class="font-medium-2 text-bold-600 ml-1">Allow Login</label>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="form-actions">
                                <a href="<?php echo (isset($user->id) && $loginUser['id'] == $user->id) ? admin_url().'dashboard' : admin_url().'admin-users'; ?>" class="btn btn-danger mr-1 text-white">
                                    <i class="ft-x"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="la la-check-square-o"></i> Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--        <div class="md-card custom_form">
            <div class="md-card-content">
                <h3 class="heading_a">User Profile</h3>
                <div class="uk-grid" data-uk-grid-margin="">
                    <div class="uk-width-medium-1-1 uk-row-first">
                        <form id="profileForm" method="POST" action="<?php echo isset($action_url) ? $action_url : ''; ?>">
                            <div class="uk-form-row">
                                <div class="uk-grid" data-uk-grid-margin="">
                                    <div class="uk-width-medium-1-2 uk-row-first">
                                        <div class="md-input-wrapper md-input-filled">
                                            <label>Username</label>
                                            <input class="md-input" name="username" placeholder="enter your username" autocomplete="458" type="text" value="<?php echo isset($user->username) ? $user->username : ''; ?>">
                                        </div>
                                    </div>
                                    <div class="uk-width-medium-1-2 uk-row-first">
                                        <div class="md-input-wrapper md-input-filled">
                                            <label>Email</label>
                                            <input class="md-input" name="email" placeholder="enter email" autocomplete="458" type="text" value="<?php echo isset($user->email) ? $user->email : ''; ?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <div class="uk-grid" data-uk-grid-margin="">
                                    <div class="uk-width-medium-1-2 uk-row-first">
                                        <div class="md-input-wrapper md-input-filled">
                                            <label>Password</label>
                                            <input class="md-input" name="password" id="password" autocomplete="OFF" placeholder="enter your password" type="password">
                                        </div>
                                    </div>
                                    <div class="uk-width-medium-1-2 uk-row-first">
                                        <div class="md-input-wrapper md-input-filled">
                                            <label>Confirm password</label>
                                            <input class="md-input" name="cpassword" placeholder="enter your confirm password" type="password" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php if (isset($user->id) && $loginUser['id'] != $user->id) { ?>
                                <div class="uk-form-row">
                                    <div class="uk-grid" data-uk-grid-margin="">
                                        <div class="uk-width-medium-1-3">
                                            <input type="checkbox" name="is_active" <?php echo (isset($user->is_active) && ($user->is_active == '1')) ? 'checked' : ''; ?> data-switchery id="switch_demo_1" />
                                            <label for="switch_demo_1" class="inline-label">Allow Login</label>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="uk-form-row">
                                <?php if (isset($user->id)) { ?>
                                    <input type="hidden" name="userId" id="userId" value="<?php echo isset($user->id) ? encryptIt($user->id) : 0; ?>">
                                <?php } ?>
                                <div class="uk-grid" data-uk-grid-margin="">
                                    <div class="uk-width-medium-1-4 uk-container-center">
                                        <button class="md-btn md-btn-success md-btn-large md-btn-wave-light waves-effect waves-button waves-light" >Save Details</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>-->