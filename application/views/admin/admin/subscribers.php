<div class="md-card uk-margin-medium-bottom">
    <div class="md-card-content">
        <div class="uk-grid data-uk-grid-margin">
            <div class="uk-width-medium-8-10">
                <h3 class="heading_a">Manage Subscribers</h3>
            </div>
            <div class="uk-width-medium-2-10 text-right">
                <a href="<?php echo admin_url(); ?>admin/export_subscribers" class="md-btn md-btn-primary" style="float: right;">Download CSV</a>
            </div>
        </div>
        <div class="uk-grid data-uk-grid-margin">
            <div class="uk-width-medium-1-1">
                <table id="customerUsers" class="uk-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Email</th>
                            <th>Subscription Date</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>