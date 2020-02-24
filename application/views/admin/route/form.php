<div class="card card-default">
    <div class="card-header">
        
    </div>
    <div class="card-body">
        <form class="form" id="route_form" method="POST" enctype="multipart/form-data">
            <div class="form-body">
                <input type="hidden" name="route_id" value="<?php echo isset($route->id) ? $route->id : '' ?>">
                <div class="row">
                    <div class="col-md-6" >
                        <div class="form-group">
                            <label for="from_location">Select Location<span class="required_sign">*</span></label>
                            <select id="from_location" name="from_location" class="form-control select_location" style="width: 100%;">
                                <?php if ( isset($route->from_location) && ($route->from_location != "") ) { ?>
                                    <option value="<?php echo $route->from_location ?>" selected="" > <?php echo $route->from_city . '-' . $route->from_state; ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6" >
                        <div class="form-group">
                            <label for="to_location">Select Location<span class="required_sign">*</span></label>
                            <select name="to_location" id="to_location" class="form-control select_location" style="width: 100%;">
                                <?php if ( isset($route->to_location) && ($route->to_location != "") ) { ?>
                                    <option value="<?php echo $route->to_location ?>" selected="" > <?php echo $route->to_city . '-' . $route->to_state; ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6" >
                        <div class="form-group">
                            <label for="kilometer">Enter Kilometer<span class="required_sign">*</span></label>
                            <input type="text" id="kilometer" name="kilometer" class="form-control kilometer_cls" value="<?php echo isset($route->kilometer) ? $route->kilometer : '' ?>" >
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="checkbox" data-switchery <?php echo ( !isset($route->is_active) || (isset($route->is_active) && $route->is_active == 1)) ? "checked" : '' ?> id="is_active" name="is_active" class="switchery" />
                </div>
            </div>
            <div class="form-actions text-right">
                <a class="btn btn-danger mr-1 text-white" href="<?php echo admin_url().'route'; ?>">
                    <i class="ft-x"></i> Cancel
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="la la-check-square-o"></i> Save
                </button>
            </div>
        </form>
    </div>
</div>
