<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-content ">
                <div class="card-body ">
                    <form class="form" id="vehicle_type_form" method="POST" enctype="multipart/form-data">
                        <div class="form-body">
                            <input type="hidden" name="vehicle_type_id" value="<?php echo isset($vehicle_type->id) ? $vehicle_type->id : '' ?>">
                            <div class="form-group">
                                <label for="name">Name<span class="required_sign">*</span></label>
                                <input type="text" id="name" class="form-control" placeholder="Name" name="name" value="<?php echo isset($vehicle_type->name) ? $vehicle_type->name : '' ?>" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input type="checkbox" data-switchery <?php echo ( !isset($vehicle_type->is_active) || (isset($vehicle_type->is_active) && $vehicle_type->is_active == 1)) ? "checked" : '' ?> id="is_active" name="is_active" class="switchery" />
                            </div>
                        </div>
                        <div class="form-actions text-right">
                            <button data-dismiss="modal" class="btn btn-danger mr-1 text-white">
                                <i class="ft-x"></i> Cancel
                            </button>
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
