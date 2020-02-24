<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <a href="<?php echo admin_url().'vehicle/setup' ?>" class="btn btn-primary btn-glow mr-1 mb-1 pull-right">Add Vehicle</a>
<!--                        <form id="download_csv_form" action="<?php echo admin_url().'vehicle/download_csv'; ?>" method="POST">
                            <input type="hidden" name="search" value="">
                            <button type="submit" class="btn btn-info btn-glow mr-1 mb-1 pull-right custom_download_csv"  ><span>Download CSV</span></button>
                        </form>-->
                        <div class="table-responsive">
                            <table id="adminUsers" class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>Vehicle Name</th>
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
</section>