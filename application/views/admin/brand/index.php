<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <a href="javascript:void(0)" class="btn btn-primary btn-glow mr-1 mb-1 pull-right open-modal">Add Brand</a>
<!--                        <form id="download_csv_form" action="<?php echo admin_url().'publisher/download_csv'; ?>" method="POST">
                            <input type="hidden" name="search" value="">
                            <button type="submit" class="btn btn-info btn-glow mr-1 mb-1 pull-right custom_download_csv"  ><span>Download CSV</span></button>
                        </form>-->
                        <div class="table-responsive">
                            <table id="brand_table" class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>Photo</th>
                                        <th>Brand Name</th>
                                        <th>Created Date</th>
                                        <th no-wrap>Action</th>
                                    </tr>
                                </thead>

                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade text-left" id="brand_modal" tabindex="-1" role="dialog" aria-labelledby="basicModalLabel3" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="basicModalLabel3">Setup Brand</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
</section>