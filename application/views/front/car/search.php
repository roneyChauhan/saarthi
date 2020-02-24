<div class="tj-inner-banner">
    <div class="container">
        <h2>Car Fleet List</h2>
    </div>
</div>
<!--<div class="tj-breadcrumb">
    <div class="container">
        <ul class="breadcrumb-list">
            <li><a href="<?php echo base_url(); ?>">Home</a></li>
            <li class="active">Car Fleet List</li>
        </ul>
    </div>
</div>-->
<section class="car-fleet">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="tab-content">
                    <div class="tab-pane active" id="car-list">
                        <!--Fleet List Box Wrapper Start-->
                        <div class="fleet-list">
                            <div class="row">
                                <?php if (isset($car_list) && !empty($car_list)) { ?>
                                    <?php foreach ($car_list as $key => $car) { ?>
                                        <div class="col-md-12 col-sm-12">
                                            <div class="fleet-list-box">
                                                <!--Fleet List Thumb Start-->
                                                <figure class="fleet-thumb car-fleet-img-cls">
                                                    <img src="<?php echo base_url() . 'attachment/view/' . encryptIt($car->img_id); ?>" alt=""/>
                                                </figure>
                                                <!--Fleet List Thumb End-->
                                                <!--Fleet List Text Start-->
                                                <div class="fleet-text">
                                                    <div class="price-box">
                                                        <span class="rated">Top Rated</span>
                                                        <?php if (isset($car->total_price) && ($car->total_price > 0) ) { ?>
                                                            <strong class="price-text" >&#x20B9 <?php echo $car->total_price; ?></strong>
                                                        <?php } ?>
                                                    </div>
                                                    <h3><?php echo $car->title; ?></h3>
                                                    <ul class="fleet-meta">
                                                        <li><i class="fas fa-user-circle"></i><?php echo $car->seating_capacity; ?> Passengers</li>
                                                    </ul>
                                                    <div class="exclusive-cls">
                                                        <a class="exclusive-link-cls active" data-toggle="pill" href="#inclusion_<?php echo $key ?>">Fare Breakup</a>
                                                        <a class="exclusive-link-cls nav-link mr-2" data-toggle="pill" href="#exclusion_<?php echo $key ?>">Exclusion</a>
                                                        <a class="exclusive-link-cls nav-link mr-2" data-toggle="pill" href="#extraCharges_<?php echo $key ?>">Extra Charges</a>
                                                        <div class="card card-body border border-0 pt-0">
                                                            <div class="tab-content">
                                                                <div id="inclusion_<?php echo $key ?>" class="container tab-pane pl-0 pr-0 pt-2 active">
                                                                    <?php if (isset($car->route_km) && ($car->route_km > 0) ) { ?>
                                                                        <ul class="fleet-meta">
                                                                            <li>Running Distance</li>
                                                                            <li> <?php echo $car->route_km; ?> KM</li>
                                                                        </ul>
                                                                    <?php } ?>
                                                                    <?php if (isset($car->outstation_price) && ($car->outstation_price > 0) ) { ?>
                                                                        <ul class="fleet-meta">
                                                                            <li>Rate/Km	</li>
                                                                            <li>Rs <?php echo $car->outstation_price; ?></li>
                                                                        </ul>
                                                                    <?php } ?>
                                                                    <?php if (isset($car->route_price) && ($car->route_price > 0) ) { ?>
                                                                        <ul class="fleet-meta">
                                                                            <li>Base Fare</li>
                                                                            <li>Rs <?php echo $car->route_price; ?></li>
                                                                        </ul>
                                                                    <?php } ?>
                                                                    <?php if (isset($car->driver_price) && ($car->driver_price > 0) ) { ?>
                                                                        <ul class="fleet-meta">
                                                                            <li>Driver Allowances</li>
                                                                            <li>Rs <?php echo $car->driver_price; ?></li>
                                                                        </ul>
                                                                    <?php } ?>
                                                                    <?php if (isset($car->total_price) && ($car->total_price > 0) ) { ?>
                                                                        <ul class="fleet-meta">
                                                                            <li>Total Fare</li>
                                                                            <li>Rs <?php echo $car->total_price; ?></li>
                                                                        </ul>
                                                                    <?php } ?>
                                                                </div>
                                                                <div id="exclusion_<?php echo $key ?>" class="container tab-pane fade pl-0 pr-0 pt-2">
                                                                    <ul class="fleet-meta">
                                                                        <li>Toll</li>
                                                                        <li>Parking</li>
                                                                        <li>State Permit</li>
                                                                    </ul>
                                                                </div>
                                                                <div id="extraCharges_<?php echo $key ?>" class="container tab-pane fade pl-0 pr-0 pt-2">
                                                                    <ul class="fleet-meta">
                                                                        <li>Extra Km beyond </li>
                                                                        <li>Rs.8.5/km</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
<!--                                                    <span class="fas fa-star"></span>
                                                    <span class="fas fa-star"></span>
                                                    <span class="fas fa-star"></span>
                                                    <span class="fas fa-star"></span>
                                                    <span class="fas fa-star"></span>-->
                                                    <?php if (!isset($car->route_km) || ($car->route_km == 0) ) { ?>
                                                        <p><?php echo $car->overview; ?></p>
                                                    <?php } else { ?>
                                                        <!--<p>&nbsp;</p>-->
                                                    <?php } ?>
                                                        
                                                    <a href="<?php echo base_url() . 'car/confirm_booking/' . encreptIt($car->id) ?>" class="tj-btn">Book Now <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                                                </div>
                                                
                                                <!--Fleet List Text Start-->
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } else { ?>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-9 col-sm-9">
                                                <div class="cta-tagline">
                                                    <h2>No car found as per your search filter!</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pagination-box">
                    <?php echo (isset($pagination_link)) ? $pagination_link : "" ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!--<section class="car-fleet">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="car-filter-holder">
                    <div class="row">
                        <div class="col-md-3 col-sm-3">
                            <div class="car-filter">
                                <span>By Categories</span>
                                <div class="select-list">
                                    <select name="car-category" class="selectpicker">
                                        <option>Select a Category</option>
                                        <option value="coupe">Coupe</option>
                                        <option value="crossover">Crossover</option>
                                        <option value="suv">SUV</option>
                                        <option value="mpv">MPV</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="car-filter">
                                <span>By Brand</span>
                                <div class="select-list">
                                    <select name="car-brand" class="selectpicker">
                                        <option>Select by Brand</option>
                                        <option value="porsche">Porsche</option>
                                        <option value="ferrari">Ferrari</option>
                                        <option value="audi">Audi</option>
                                        <option value="ford">Ford</option>
                                        <option value="honda">Honda</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="car-filter">
                                <span>By Seats</span>
                                <div class="select-list">
                                    <select name="car-seater" class="selectpicker">
                                        <option>Select by Seats</option>
                                        <option value="2seat">2 Seater</option>
                                        <option value="4seat">4 Seater</option>
                                        <option value="7seat">7 Seater</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane" id="car-grid">
                        <div class="fleet-grid">
                            <div class="row">
                                <?php if (isset($car_list) && !empty($car_list)) { ?>
                                    <?php foreach ($car_list as $car) { ?>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="fleet-grid-box">
                                                <figure class="fleet-thumb">
                                                    <img src="<?php echo base_url() . 'attachment/view/' . encryptIt($car->img_id); ?>" alt="">
                                                    <figcaption class="fleet-caption">
                                                        <div class="price-box">
                                                            <strong>₹<?php echo $car->hours_price; ?> <span>/ day</span></strong>
                                                        </div>
                                                        <span class="rated">Top Rated</span>
                                                    </figcaption>
                                                </figure>
                                                <div class="fleet-info-box">
                                                    <div class="fleet-info">
                                                        <h3><?php echo $car->title; ?></h3>
                                                        <span class="fas fa-star"></span>
                                                        <span class="fas fa-star"></span>
                                                        <span class="fas fa-star"></span>
                                                        <span class="fas fa-star"></span>
                                                        <span class="fas fa-star"></span>
                                                        <ul class="fleet-meta">
                                                            <li><i class="fas fa-user-circle"></i><?php echo $car->seating_capacity; ?> Passengers</li>
                                                        </ul>
                                                    </div>
                                                    <a href="<?php echo base_url() . 'car/confirm_booking/' . encreptIt($car->id) ?>" class="tj-btn">Book Now <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pagination-box">
                    <?php echo (isset($pagination_link)) ? $pagination_link : "" ?>
                     <nav aria-label="navigation">
                        <ul class="pagination">
                            <li>
                                <a href="#" aria-label="Previous">
                                    <i class="fas fa-angle-double-left"></i>
                                </a>
                            </li>
                            <li><a href="#">1</a></li>
                            <li class="active"><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li>
                                <a href="#" aria-label="Next">
                                    <i class="fas fa-angle-double-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>-->


