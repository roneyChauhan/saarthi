<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="name">Name</label> : 
                                </div>
                                <div class="col-md-9">
                                    <p><?php echo (isset($trip_details->first_name) && isset($trip_details->last_name)) ? $trip_details->first_name . " " .$trip_details->last_name : '' ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="name">Email</label> :
                                </div>
                                <div class="col-md-9">
                                    <p><?php echo isset($trip_details->email) ? $trip_details->email : '' ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="name">Phone</label> :
                                </div>
                                <div class="col-md-9">
                                    <p><?php echo isset($trip_details->phone) ? $trip_details->phone : '' ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="name">Journey Type</label> :
                                </div>
                                <div class="col-md-9">
                                    <p><?php echo (isset($trip_details->service_type) && ($trip_details->service_type == 1) ) ? "Two Way" : 'One Way' ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="name">From location</label> :
                                </div>
                                <div class="col-md-9">
                                    <p><?php echo ( isset($trip_details->pick_city) && isset($trip_details->pick_state)) ? $trip_details->pick_city . '-' . $trip_details->pick_state : '' ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="name">To location</label> :
                                </div>
                                <div class="col-md-9">
                                    <p><?php echo ( isset($trip_details->drop_city) && isset($trip_details->drop_state)) ? $trip_details->drop_city . '-' . $trip_details->drop_state : '' ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="name">Pickup date</label> :
                                </div>
                                <div class="col-md-9">
                                    <p><?php echo isset($trip_details->pickup_date) ? date("d F, Y", strtotime($trip_details->pickup_date)) : '' ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="name">Pickup time</label> :
                                </div>
                                <div class="col-md-9">
                                    <p><?php echo isset($trip_details->pickup_time) ? date("h:i A", strtotime($trip_details->pickup_time)) : '' ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="name">Total Amount</label> :
                                </div>
                                <div class="col-md-9">
                                    <p><?php echo isset($trip_details->total_amount) ? showPrice($trip_details->total_amount) : '' ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="name">Payment Status</label> :
                                </div>
                                <div class="col-md-9">
                                    <p><?php echo (isset($trip_details->method) && ($trip_details->method == 1)) ? "Partially Paid" : 'Paid' ?></p>
                                </div>
                            </div>
                            <?php if(isset($trip_details->method) && ($trip_details->method == 1) ) { ?>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="name">Pending Amount</label> :
                                    </div>
                                    <div class="col-md-9">
                                        <p><?php echo showPrice($trip_details->total_amount - ($trip_details->total_amount / 2)); ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-info send_payment_reminder"> Payment Reminder</button>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="row mt-3">
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-info send_driver_details">Send Driver Details</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade text-left" id="driver_modal" tabindex="-1" role="dialog" aria-labelledby="basicModalLabel3" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="basicModalLabel3">Send Driver Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="driver_from" id="driver_from" action="<?php echo admin_url().'booking/driver_mail'; ?>" method="post" >
                    <input type="hidden" name="booking_id" value="<?php echo isset($trip_details->id) ? encreptIt($trip_details->id) : '' ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Driver Name</label>
                            <input type="text" id="driver_name" name="driver_name" class="form-control ">
                        </div>
                        <div class="form-group">
                            <label for="email">Driver Phone No</label>
                            <input type="text" name="phone_no" id="phone_no" class="form-control ">
                        </div>
                        <div class="form-group">
                            <label for="email">Car No</label>
                            <input type="text" name="car_no" id="car_no" class="form-control ">
                        </div>
                        <div class="form-group" >
                            <label for="message">Mail Subject</label>
                            <input type="text" id="subject" name="subject" class="form-control" >
                        </div>
                        <div class="form-group" >
                            <label for="message">Message</label>
                            <textarea type="text" id="message" name="message" class="md-textarea form-control" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button class="btn btn-primary" type="submit" >Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>