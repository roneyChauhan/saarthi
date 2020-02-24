<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-content ">
                <div class="card-body ">
                    <form class="form" id="city_form" method="POST" enctype="multipart/form-data">
                        <div class="form-body">
                            <input type="hidden" name="city_id" value="<?php echo isset($city->id) ? $city->id : '' ?>">
                            <div class="form-group">
                                <label for="city">City Name<span class="required_sign">*</span></label>
                                <input type="text" id="city_name" class="form-control" placeholder="City Name" name="city_name" value="<?php echo isset($city->city_name) ? $city->city_name : '' ?>" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="state">State<span class="required_sign">*</span></label>
                                <select name="state" id="state" class="form-control select2">
                                    <option value=""> Select State</option>
                                    <?php if (!empty($state)) { ?>
                                        <?php foreach ($state as $row) { ?>
                                            <option value="<?php echo $row->id ?>" <?php echo (isset($city->state_code) && ($city->state_code == $row->id)) ? "selected='selected'" : "" ?> > <?php echo $row->state; ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" data-switchery <?php echo ( !isset($city->status) || (isset($city->status) && $city->status == 1)) ? "checked" : '' ?> id="status" name="status" class="switchery" />
                                <label for="status" class="font-medium-2 text-bold-600 ml-1">Active</label>
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
