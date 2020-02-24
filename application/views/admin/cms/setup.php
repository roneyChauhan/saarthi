<section id="basic-form-layouts">
    <div class="row match-height">
        <div class="col-md-12">
            <div class="card">
                <div class="card-content collapse show">
                    <div class="card-body">
                        <form class="form" id="cms_form" action="<?php echo admin_url().'cms/commit'; ?>" method="POST">
                            <input type="hidden" name="cms_id" value="<?php echo isset($cms->id) ? encryptIt($cms->id) : ''; ?>">
                            <div class="form-body">
<!--                                <h4 class="form-section">
                                    <i class="ft-flag"></i> 
                                    Book Details
                                </h4>-->
                                <div class="row">  
                                    <div class="form-group col-md-6">
                                        <label for="name">Title<span class="required_sign">*</span></label>
                                        <input type="text" id="title" class="form-control" placeholder="Page Title" data-field="title" name="title" value="<?php echo isset($cms->title) ? $cms->title : ''; ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="name">Heading<span class="required_sign">*</span></label>
                                        <input type="text" id="heading" class="form-control" placeholder="Page Heading" data-field="heading" name="heading" value="<?php echo isset($cms->heading) ? $cms->heading : ''; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>URL</label>
                                    <?php 
                                        $url = "";
                                        if (isset($cms->url) && ($cms->url != '')) {
                                            $url = base_url().'page/'.$cms->url;
                                        }
                                    ?>
                                    <input class="form-control " id="url" name="url" readonly="" type="hidden" value="<?php echo isset($cms->url) ? $cms->url : ''; ?>">
                                    <input class="form-control " id="urlText" readonly="" type="text" value="<?php echo $url; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="description">Content</label>
                                    <textarea id="content" rows="5" class="form-control ckeditor" name="content" placeholder="content"><?php echo isset($cms->content) ? $cms->content : ''; ?></textarea>
                                </div>
                            </div>
                            <div class="form-actions text-center">
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
</section>