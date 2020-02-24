<section id="basic-form-layouts">
    <div class="row match-height">
        <div class="col-md-12">
            <div class="card">
                <div class="card-content collapse show">
                    <div class="card-body custom_tabs">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group pb-1">
                                    <label for="is_active">Website currently Active as &nbsp;</label>
                                    <input type="checkbox" id="is_active_live" name="is_active" class="switchery" <?php echo (isset($settings['live']['is_active']) && ($settings['live']['is_active'] == '1')) ? 'checked' : ''; ?>/>
                                    <label for="is_active" class="font-medium-2 text-bold-600 ml-1"> Live </label>
                                </div>
                            </div>
                        </div>
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" id="local-tab1" data-toggle="tab" aria-controls="tab1" href="#tab1" aria-expanded="true">Local</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="live-tab2" data-toggle="tab" aria-controls="tab2" href="#tab2" aria-expanded="false">Live</a>
                            </li>
                        </ul>
                        <div class="tab-content px-1 pt-1">
                            <div role="tabpanel" class="tab-pane active" id="tab1" aria-expanded="true" aria-labelledby="local-tab1">
                               <form class="form" id="sitesettingLocalForm" method="POST" action="">
                                    <div class="form-body">
                                        <h4>Email Settings</h4>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="from_name">From Name</label>
                                                    <input type="text" class="form-control" placeholder="From Name" name="from_name" value="<?php echo isset($settings['local']['from_name']) ? $settings['local']['from_name'] : '' ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="from_email">From Email</label>
                                                    <input type="text" class="form-control" placeholder="From Email" name="from_email" value="<?php echo isset($settings['local']['from_email']) ? $settings['local']['from_email'] : '' ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="smtp_host">SMTP Host</label>
                                                    <input type="text" class="form-control" placeholder="SMTP Host" name="smtp_host" value="<?php echo isset($settings['local']['smtp_host']) ? $settings['local']['smtp_host'] : '' ?>" >
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="port">Port</label>
                                                    <input type="text" class="form-control" placeholder="Port" name="port" value="<?php echo isset($settings['local']['port']) ? $settings['local']['port'] : '' ?>" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="smtp_email">Email</label>
                                                    <input type="text" class="form-control" placeholder="SMTP Email" name="smtp_email" value="<?php echo isset($settings['local']['smtp_email']) ? $settings['local']['smtp_email'] : '' ?>" >
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="smtp_password">Password</label>
                                                    <input type="password" class="form-control" placeholder="SMTP Password" name="smtp_password" value="<?php echo isset($settings['local']['smtp_password']) ? $settings['local']['smtp_password'] : '' ?>" >
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="is_ssl">SSL</label>
                                                <div class="form-group">
                                                    <input type="checkbox" data-switchery <?php echo ((isset($settings['local']['is_ssl']) && $settings['local']['is_ssl'] == 1)) ? "checked" : '' ?> name="is_ssl" class="switchery form-control" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <input type="hidden" name="site_mode" value="<?php echo encreptIt('0'); ?>">
                                        <button type="submit" class="btn btn-success">
                                            <i class="la la-check-square-o"></i> Update
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="tab2" aria-labelledby="live-tab2">
                                <form class="form" id="sitesettingLiveForm" method="POST" action="">
                                    <div class="form-body">
                                        <h4>Email Settings</h4>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="from_name">From Name</label>
                                                    <input type="text" class="form-control" placeholder="From Name" name="from_name" value="<?php echo isset($settings['live']['from_name']) ? $settings['live']['from_name'] : '' ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="from_email">From Email</label>
                                                    <input type="text" class="form-control" placeholder="From Email" name="from_email" value="<?php echo isset($settings['live']['from_email']) ? $settings['live']['from_email'] : '' ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="smtp_host">SMTP Host</label>
                                                    <input type="text" class="form-control" placeholder="SMTP Host" name="smtp_host" value="<?php echo isset($settings['live']['smtp_host']) ? $settings['live']['smtp_host'] : '' ?>" >
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="port">Port</label>
                                                    <input type="text" class="form-control" placeholder="Port" name="port" value="<?php echo isset($settings['live']['port']) ? $settings['live']['port'] : '' ?>" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="smtp_email">Email</label>
                                                    <input type="text" class="form-control" placeholder="SMTP Email" name="smtp_email" value="<?php echo isset($settings['live']['smtp_email']) ? $settings['live']['smtp_email'] : '' ?>" >
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="smtp_password">Password</label>
                                                    <input type="password" class="form-control" placeholder="SMTP Password" name="smtp_password" value="<?php echo isset($settings['live']['smtp_password']) ? $settings['live']['smtp_password'] : '' ?>" >
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="is_ssl">SSL</label>
                                                <div class="form-group">
                                                    <input type="checkbox" data-switchery <?php echo ((isset($settings['live']['is_ssl']) && $settings['live']['is_ssl'] == 1)) ? "checked" : '' ?> name="is_ssl" class="switchery form-control" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <input type="hidden" name="site_mode" value="<?php echo encreptIt('1'); ?>">
                                        <button type="submit" class="btn btn-success">
                                            <i class="la la-check-square-o"></i> Update
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
