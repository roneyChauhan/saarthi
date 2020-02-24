<form class="form" id="brand_form" method="POST" enctype="multipart/form-data">
    <div class="form-body">
        <input type="hidden" name="brand_id" value="<?php echo isset($brand->id) ? $brand->id : '' ?>">
        <div class="row">
            <div class="form-group col-md-6">
                <label for="name">Brand Name<span class="required_sign">*</span></label>
                <input type="text" id="brand_name" class="form-control" placeholder="Brand Name" name="brand_name" value="<?php echo isset($brand->brand_name) ? $brand->brand_name : '' ?>" autocomplete="off">
                <div class="custom-typeahead-content"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="description">Brand Photo</label>
                    <div class="custom-file">
                        <input type="file" name="avatar" class="custom-file-input" id="avatar_img">
                        <label class="custom-file-label image_content_lbl" for="avatar_img">Choose file</label>
                    </div>
                </div>
                <div class="form-group">
                    <input type="checkbox" data-switchery <?php echo ( !isset($brand->is_active) || (isset($brand->is_active) && $brand->is_active == 1)) ? "checked" : '' ?> id="is_active" name="is_active" class="switchery" />
                    <label for="is_active" class="font-medium-2 text-bold-600 ml-1">Active</label>
                </div>
            </div>
            <div class="col-sm-4">
                <?php if(isset($brand->image_id) && $brand->image_id != "" ) { ?>
                    <img src="<?php echo base_url() . 'attachment/image/100/100/' . $brand->image_id; ?>" onerror="<?php echo base_url() . 'attachment/image/100/100/' . encryptIt('0'); ?>" class="rounded-circle img-border height-100 brand_image image_content_preview" alt="Brand Image">
                <?php } else { ?>
                    <img src="<?php echo base_url() . 'attachment/image/100/100/' . encryptIt('0'); ?>" class="rounded-circle img-border height-100 brand_image image_content_preview" alt="Brand Image">
                <?php } ?>
            </div>
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