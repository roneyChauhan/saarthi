<section id="basic-form-layouts">
    <div class="row match-height">
        <div class="col-md-12">
            <div class="card">
                <div class="card-content collapse show">
                    <div class="card-body">
                        <form class="form" id="setupForm" method="POST" action="<?php echo isset($action_url) ? $action_url : ''; ?>">
                            <input type="hidden" name="user_id" value="<?php echo isset($user->id) ? encryptIt($user->id) : ""; ?>">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">First Name <span class="required_sign">*</span></label>
                                        <input type="text" class="form-control" placeholder="First Name" name="first_name" value="<?php echo isset($user->first_name) ? $user->first_name : ''; ?>">
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Last Name <span class="required_sign">*</span></label>
                                            <input type="text" class="form-control" placeholder="Last Name" name="last_name" value="<?php echo isset($user->last_name) ? $user->last_name : ''; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Username <span class="required_sign">*</span></label>
                                        <input type="text" id="username" class="form-control" placeholder="Username" name="username" value="<?php echo isset($user->username) ? $user->username : ''; ?>" <?php echo (!isset($user->id)) ? '' : 'readonly'; ?>>
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Email <span class="required_sign">*</span></label>
                                            <input type="text" id="setup_email" class="form-control" placeholder="Email" name="email" value="<?php echo isset($user->email) ? $user->email : ''; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Password <span class="required_sign">*</span></label>
                                        <input type="password" id="password" class="form-control" placeholder="Enter your password" name="password">
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Confirm password <span class="required_sign">*</span></label>
                                            <input type="password" id="cpassword" class="form-control" placeholder="Enter your password again" name="cpassword">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Role <span class="required_sign">*</span></label>
                                            <select name="role" class="select2 form-control">
                                                <option value="0">Select Role</option>
                                                <?php foreach ($role as $row) { ?>
                                                    <?php $selected = (isset($user->role) && ($user->role == $row->id)) ? 'selected' : ''; ?>
                                                    <option value="<?php echo $row->id; ?>" <?php echo $selected; ?>><?php echo $row->name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <?php if (!isset($user->id) || (isset($user->id) && $loginUser['id'] != $user->id)) { ?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group pb-1">
                                                <input type="checkbox" id="is_active" name="is_active" class="switchery" <?php echo (!isset($user->is_active) || (isset($user->is_active) && ($user->is_active == '1'))) ? 'checked' : ''; ?>/>
                                                <label for="is_active" class="font-medium-2 text-bold-600 ml-1">Allow Login</label>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="form-actions text-center pb-0">
                                <button type="submit" class="btn btn-success">
                                    <i class="la la-check-square-o"></i> Save
                                </button>
                                <a href="<?php echo (isset($user->id) && $loginUser['id'] == $user->id) ? admin_url().'dashboard' : admin_url().'admin-users'; ?>" class="btn btn-danger mr-1 text-white">
                                    <i class="ft-x"></i> Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>