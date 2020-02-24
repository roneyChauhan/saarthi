<form class="form" id="category_form" method="POST" enctype="multipart/form-data">
    <div class="form-body">
        <input type="hidden" name="category_id" value="<?php echo isset($category->id) ? $category->id : '' ?>">
        <div class="form-group">
            <label for="name_english">Category Name<span class="required_sign">*</span></label>
            <input type="text" id="name" class="form-control" placeholder="Category Name" name="name" value="<?php echo isset($category->name) ? $category->name : '' ?>" autocomplete="off">
            <div class="custom-typeahead-content"></div>
        </div>
        <div class="form-group">
            <input type="checkbox" data-switchery <?php echo ( !isset($category->is_active) || (isset($category->is_active) && $category->is_active == 1)) ? "checked" : '' ?> id="is_active" name="is_active" class="switchery" />
            <label for="is_active" class="font-medium-2 text-bold-600 ml-1">Active</label>
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