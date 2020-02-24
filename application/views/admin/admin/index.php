<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <?php if (is_allowed(admin_url().'admin-users/setup')) { ?>
                            <a href="<?php echo admin_url(); ?>admin-users/setup" class="btn btn-primary btn-min-width btn-glow mr-1 mb-1" style="float: right;">Add Admin</a>
                        <?php } ?>
                        <div class="table-responsive">
                            <table id="adminUsers" class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>Full name</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Action</th>
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