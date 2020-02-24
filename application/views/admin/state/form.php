<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-content ">
                <div class="card-body ">
                    <form class="form" id="state_form" method="POST" enctype="multipart/form-data">
                        <div class="form-body">
                            <input type="hidden" name="state_id" value="<?php echo isset($state->id) ? $state->id : '' ?>">
                            <div class="form-group">
                                <label for="state">State Name<span class="required_sign">*</span></label>
                                <input type="text" id="state" class="form-control" placeholder="State Name" name="state" value="<?php echo isset($state->state) ? $state->state : '' ?>" autocomplete="off">
                                <div class="custom-typeahead-content"></div>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" data-switchery <?php echo ( !isset($state->status) || (isset($state->status) && $state->status == 1)) ? "checked" : '' ?> id="status" name="status" class="switchery" />
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
