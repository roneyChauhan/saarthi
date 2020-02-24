<?php if (! empty($selected_files)) { ?>
    <?php foreach($selected_files as $file) { ?>
        <div class="vehicle_photo_list">
            <img src="<?php echo base_url().'/uploads/temp_uploads/' .$file; ?>" width="250px">
            <button class="btn btn-danger btn-sm btn-glow remove_ajax_vehicle_photo" data-type="ajax" data-name="<?php echo encryptIt($file); ?>">Delete</button>
            <input type="hidden" name="ajax_vehicle_photo[]" value="<?php echo encryptIt($file); ?>">
        </div>
    <?php } ?>
<?php } ?>