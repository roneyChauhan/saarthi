<section id="basic-form-layouts">
    <div class="card">
        <div class="card-content collapse show">
            <div class="card-body custom_tabs">
                <?php 
                    $error_message = $this->session->flashdata('error_message');
                    if ($error_message != '') {
                ?>
                    <div class="alert alert-danger">
                        <?php echo $error_message; ?>
                    </div>
                <?php   
                    }
                ?>
                <form class="form" id="vehicle_details" action="<?php echo admin_url() . 'vehicle/commit'; ?>" method="POST" enctype="multipart/form-data" >
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" id="local-tab1" data-toggle="tab" aria-controls="tab1" href="#tab1" aria-expanded="true">Vehicle Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="live-tab2" data-toggle="tab" aria-controls="tab2" href="#tab2" aria-expanded="false">Vehicle Images</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="live-tab4" data-toggle="tab" aria-controls="tab4" href="#tab4" aria-expanded="false">Vehicle Out Station Pricing</a>
                        </li>
                    </ul>
                    <div class="tab-content px-1 pt-1">
                        <div role="tabpanel" class="tab-pane active" id="tab1" aria-expanded="true" aria-labelledby="local-tab1">
                            <div class="row match-height-2">
                                <div class="col-md-12">
                                    <input type="hidden" name="vehicle_id" value="<?php echo isset($vehicle->id) ? encryptIt($vehicle->id) : ''; ?>">
                                    <div class="form-body pt-1">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="title">Vehicle Title <span class="required_sign">*</span></label>
                                                    <input type="text" id="name_english" class="form-control" data-page="vehicle" data-field="title" placeholder="Vehicle Title" name="title" value="<?php echo isset($vehicle->title) ? $vehicle->title : ''; ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="seating_capacity">Seating Capacity <span class="required_sign">*</span></label>
                                                    <input type="text" id="seating_capacity" class="form-control" placeholder="Seating Capacity" name="seating_capacity" value="<?php echo isset($vehicle->seating_capacity) ? $vehicle->seating_capacity : ''; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="category">Category <span class="required_sign">*</span></label>
                                                    <select id="category" class="form-control" placeholder="Vehicle Category" name="category">
                                                        <option value="">Select Category</option>
                                                        <?php if( isset($category) && !empty($category)) { ?>
                                                            <?php foreach ($category as $row) { ?>
                                                                <option value="<?php echo $row->id; ?>" <?php echo (isset($vehicle->category) && ($vehicle->category == $row->id) ) ? "selected='selected'" : ''; ?> ><?php echo $row->name; ?></option>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="vehicle_type">Vehicle Type<span class="required_sign">*</span></label>
                                                    <select type="text" id="vehicle_type" class="form-control" placeholder="Vehicle Type" name="vehicle_type">
                                                        <option value="">Select Type</option>
                                                        <?php if( isset($vehicle_type) && !empty($vehicle_type)) { ?>
                                                            <?php foreach ($vehicle_type as $row) { ?>
                                                                <option value="<?php echo $row->id; ?>" <?php echo (isset($vehicle->type) && ($vehicle->type == $row->id) ) ? "selected='selected'" : ''; ?> ><?php echo $row->name; ?></option>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="overview">Vehicle overview <span class="required_sign">*</span></label>
                                                    <textarea id="overview" rows="5" class="form-control" name="overview" placeholder="Vehicle Overview"><?php echo isset($vehicle->overview) ? $vehicle->overview : ''; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="checkbox" data-switchery <?php echo ((isset($vehicle->is_active) && $vehicle->is_active == 1) || !isset($vehicle->is_active)) ? "checked" : '' ?> id="is_active" name="is_active" class="" />
                                            <label for="is_active" class="font-medium-2 text-bold-600 ml-1">Active</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="checkbox" data-switchery <?php echo ((isset($vehicle->is_feature) && $vehicle->is_feature == 1) || !isset($vehicle->is_feature)) ? "checked" : '' ?> id="is_feature" name="is_feature" class="" />
                                            <label for="is_feature" class="font-medium-2 text-bold-600 ml-1">Is Feature</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpane2" class="tab-pane" id="tab2" aria-expanded="true" aria-labelledby="local-tab2">
                            <div class="row match-height-2">
                                <div class="col-md-12">
                                    <div class="form-body pt-1">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <div class="form-group">
                                                            <label for="vehicle_photo">Vehicle Photos</label>
                                                            <label class="file_size_lable"></label>
                                                            <div class="custom-file">
                                                                <input type="file" name="vehicle_photo[]" multiple="" class="custom-file-input" id="vehicle_photo">
                                                                <label class="custom-file-label" for="vehicle_photo">Choose file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="uploaded_vehicle_photo">
                                                    <?php if(isset($vehicle->vehicle_photos) && !empty($vehicle->vehicle_photos) ) { ?>
                                                        <?php foreach ($vehicle->vehicle_photos as $photo) { ?>
                                                            <div class="vehicle_photo_list">
                                                                <img src="<?php echo base_url() . 'attachment/view/' . encryptIt($photo); ?>" width="250px">
                                                                <button class="btn btn-danger btn-sm btn-glow remove_ajax_vehicle_photo" data-type="exist" data-name="<?php echo encryptIt($photo); ?>">Delete</button>
                                                            </div>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </div>                                                 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpane4" class="tab-pane" id="tab4" aria-expanded="true" aria-labelledby="local-tab4">
                            <div class="row match-height-2">
                                <div class="col-md-12">
                                    <div class="form-body pt-1">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="min_day">Day <span class="required_sign">*</span></label>
                                                    <input type="text" id="min_day" class="form-control" placeholder="Days" name="min_day" value="<?php echo isset($vehicle->min_day) ? $vehicle->min_day : ''; ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="outstation_km">Kilo Meters <span class="required_sign">*</span></label>
                                                    <input type="text" id="outstation_km" class="form-control" name="outstation_km" value="<?php echo isset($vehicle->outstation_km) ? $vehicle->outstation_km : ''; ?>" placeholder="Kilo Meters">
                                               </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="outstation_price">Price <span class="required_sign">*</span></label>
                                                    <input type="text" id="outstation_price" class="form-control" placeholder="Price" name="outstation_price" value="<?php echo isset($vehicle->outstation_price) ? $vehicle->outstation_price : ''; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions text-center pb-0">
                        <button type="submit" class="btn btn-success">
                            <i class="la la-check-square-o"></i> Save
                        </button>
                        <a href="<?php echo admin_url().'vehicle' ?>" class="btn btn-danger">
                            <i class="la la-reply"></i>
                            Back
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>