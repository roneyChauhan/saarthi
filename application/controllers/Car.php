<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Car extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->is_logined       = $this->get_authorized_user();
        $this->loginUser        = $this->getLoginUser();
        $this->load->library("paytm_lib");
        $this->load->library("whats_app");
    }

    public function index() {
        echo "Hi";
        $whats_app  = new Whats_app();
        $sms_status = $whats_app->sendSMS();
        die;
    }

    public function search($start = 0) {
        $data               = array();
        $filter             = array();
        $this->load->library('pagination');

        $tripSession            = $this->getSession("tripSession");
        if(isset($tripSession["seating_capacity"]) && $tripSession["seating_capacity"] != "" ){
            $route_details = $this->route_model->get_route_details($tripSession["trip_location"], $tripSession["drop_location"]);
            if (! empty($route_details)) {
                $filter['tripSession']  = $tripSession;
                $filter['route_km']     = $route_details->kilometer;
            }
            $filter["where"]["bharat_vehicle.seating_capacity >="] = $tripSession["seating_capacity"];
            $filter["where"]["bharat_vehicle.seating_capacity <="] = ($tripSession["seating_capacity"] + 3);
        }

        $config                 = initPagination();
        $per_page               = 5;
        $config['base_url']     = base_url() . 'car/search';
        $config['total_rows']   = $this->vehicle_model->vehicle_search($filter, true);
        $config['per_page']     = $per_page;
        $config["uri_segment"]  = 3;
        $start                  = ($start > 0) ? ($start - 1) * $per_page : 0;

        $filter["limit"]    = array("limit" => $per_page, "from" => $start);
        $filter["orderby"]  = array("field" => "bharat_vehicle.seating_capacity", "order" => "ASC");
        $car_list           = $this->vehicle_model->vehicle_search($filter);
        if (empty($car_list) ) {
            $this->removeSession(array('tripSession'));
            $this->removeSession(array('userBookingSession'));
        }
        $this->pagination->initialize($config);
        $pagination_link            = $this->pagination->create_links();
        $data["car_list"]           = $car_list;
        $data["pagination_link"]    = $pagination_link;
        $data["tripSession"]        = $tripSession;
        $this->template->view("front/car/search", $data);
    }

    public function lists($start = 0) {
        $data               = array();
        $filter             = array();
        $this->load->library('pagination');

        $config                 = initPagination();
        $per_page               = 5;
        $config['base_url']     = base_url() . 'car/lists';
        $config['total_rows']   = $this->vehicle_model->vehicle_search($filter, true);
        $config['per_page']     = $per_page;
        $config["uri_segment"]  = 3;
        $start                  = ($start > 0) ? ($start - 1) * $per_page : 0;

        $filter["limit"]    = array("limit" => $per_page, "from" => $start);
        $filter["orderby"]  = array("field" => "bharat_vehicle.seating_capacity", "order" => "ASC");
        $car_list           = $this->vehicle_model->vehicle_search($filter);
        $this->pagination->initialize($config);
        $pagination_link            = $this->pagination->create_links();
        $data["car_list"]           = $car_list;
        $data["pagination_link"]    = $pagination_link;
        $this->template->view("front/car/search", $data);
    }

    public function confirm_booking($car_id = "") {
        $data           = array();
        $filter         = array();
        if($car_id != ""){
            $decrypt_id         = decreptIt($car_id);
            $filter["where"]    = array("bharat_vehicle.id" => $decrypt_id);
            $tripSession        = $this->getSession("tripSession");
            $route_details      = $this->route_model->get_route_details($tripSession["trip_location"], $tripSession["drop_location"]);
            if (! empty($route_details)) {
                $filter['tripSession']  = $tripSession;
                $filter['route_km']     = $route_details->kilometer;
            }
            $filter["row"]      = 1;
            $selected_car       = $this->vehicle_model->vehicle_search($filter);
            if(!empty($selected_car)) {
                $tripSession    = $this->getSession("tripSession");
                if(!empty($tripSession)){
                    $route_details = $this->route_model->get_route_details($tripSession["trip_location"], $tripSession["drop_location"]);
                    if(!empty($route_details)) {
                        $driver_price   = $selected_car->driver_price;
                        $trip_type      = $tripSession["trip_type"];
                        $journey_type   = "One Way";
                        $route_price    = $route_details->kilometer * $selected_car->outstation_price / $selected_car->outstation_km;
                        if($trip_type == 1){
                            $journey_type   = "Two Way";
                            $trip_days      = $tripSession["trip_days"];
                            $day_min_km     = $this->config->item('DAY_MIN_KM');
                            $pref_km        = $day_min_km;
                            if($route_details->kilometer > $day_min_km) {
                                $pref_km    = $route_details->kilometer;
                            }
                            $driver_price   = $driver_price * $trip_days;
                            $route_price    = $pref_km * $trip_days * $selected_car->outstation_price / $selected_car->outstation_km;
                        }
                        $total_price    = $route_price + $driver_price;
                        $this->removeSession(array('tripSession'));
                        $tripSession['car_id']              = $car_id;
                        $tripSession['route_price']         = $route_price;
                        $tripSession['route_km']            = $route_details->kilometer;
                        $tripSession['driver_price']        = $driver_price;
                        $tripSession['total_price']         = $total_price;
                        $tripSession['journey_type']        = $journey_type;
                      
                        
                        $this->setSession(array('tripSession' => $tripSession));
                        $booking_details                    = $tripSession;
                        $booking_details["booking_cab"]     = $selected_car;
                        $booking_details["journey_type"]    = $journey_type;
                        $data["booking_details"]            = $booking_details;

                        $filter['tripSession']  = $tripSession;
                        $filter['route_km']     = $route_details->kilometer;
                        $filter["row"]          = 1;
                        $selected_car           = $this->vehicle_model->vehicle_search($filter);                          
                        $data["selected_car"]   = $selected_car;
                        if($this->is_logined) {
                            redirect(base_url(). 'car/payment/'. $car_id);
                        } else {
//                            p($data);
                            $this->template->view("front/car/confirm_booking", $data);
                        }
                    } else {
                        $this->session->set_flashdata('error', 'No route availabel');
                        redirect(base_url(). "car/search");
                    }
                } else {
                    redirect(base_url(). "car/booking_car/". $car_id);
                }
            } else {
                $this->session->set_flashdata('error', 'Please select car first.');
                redirect(base_url() . "car/search");
            }
        } else {
            $this->session->set_flashdata('error', 'Please select car first.');
            redirect(base_url() . "car/search");
        }
    }

    public function booking_car($car_id = ""){
        if($car_id != ""){
            $this->removeSession(array('tripSession'));
            $decrypt_id         = decreptIt($car_id);
            $filter["where"]    = array("bharat_vehicle.id" => $decrypt_id);
            $filter["row"]      = 1;
            $selected_car       = $this->vehicle_model->vehicle_search($filter);
            if(!empty($selected_car)) {
                if ($this->input->server('REQUEST_METHOD') == 'POST') {
                    $this->form_validation->set_rules('trip_location', 'Trip Location', 'required|trim');
                    $this->form_validation->set_rules('drop_location', 'Trip Location', 'required|trim');
                    $this->form_validation->set_rules('trip_pick_date', 'Trip Pick Date', 'required|trim');
                    if ($this->form_validation->run() == true) {
                        $service_type       = $this->input->post('service_type');
                        $journey_type       = "One Way";
                        $dateTime           = $this->input->post('trip_pick_date');
                        $isValid            = false;
                        if ($dateTime != "") {
                            $dateTimeArr = explode(" ", $dateTime);
                            if (! empty($dateTimeArr) && (count($dateTimeArr) == 3) ) {
                                $pick_date  = $dateTimeArr[0];
                                $pick_time  = date("H:i:s", strtotime($dateTimeArr[1] ." ". $dateTimeArr[2]));
                                $isValid    = true;
                            } else {
                                $this->session->set_flashdata('error', "All fields are required");
                            }
                        }
                        if ($isValid) {
                            $trip_location      = $this->input->post('trip_location');
                            $drop_location      = $this->input->post('drop_location');
                            if($service_type == 1) {
                                $trip_days      = $this->input->post('trip_days');
                                $journey_type   = "Two Way";
                            }
                            $city_state_pick    = $this->cities_model->get_city_state_name($trip_location);
                            $city_state_drop    = $this->cities_model->get_city_state_name($drop_location);
                            if(!empty($city_state_pick) && !empty($city_state_drop)) {
                                $driver_price   = $selected_car->driver_price;
                                $route_details  = $this->route_model->get_route_details($trip_location, $drop_location);
                                if(!empty($route_details)) {
                                    $route_price    = $route_details->kilometer * $selected_car->outstation_price / $selected_car->outstation_km;
                                    if($service_type == 1){
                                        $day_min_km     = $this->config->item('DAY_MIN_KM');
                                        $pref_km        = $day_min_km;
                                        if($route_details->kilometer > $day_min_km) {
                                            $pref_km    = $route_details->kilometer;
                                        }
                                        $driver_price   = $driver_price * $trip_days;
                                        $route_price    = $pref_km * $trip_days * $selected_car->outstation_price / $selected_car->outstation_km;
                                    }
                                    $total_price    = $driver_price + $route_price;
                                    $trip_session   = array(
                                                        "car_id"                => $car_id,
                                                        "trip_type"             => $service_type,
                                                        "journey_type"          => $journey_type,
                                                        "route_price"           => $route_price,
                                                        "route_km"              => $route_details->kilometer,
                                                        "driver_price"          => $driver_price,
                                                        "total_price"           => $total_price,
                                                        "trip_location"         => $trip_location,
                                                        "drop_location"         => $drop_location,
                                                        "trip_location_name"    => $city_state_pick["city_name"] . "-" . $city_state_pick["state_name"],
                                                        "drop_location_name"    => $city_state_drop["city_name"] . "-" . $city_state_drop["state_name"],
                                                        "pick_date"             => $pick_date,
                                                        "pick_time"             => $pick_time,
                                                        "seating_capacity"      => $selected_car->seating_capacity,
                                    );
                                    if($service_type == 1) {
                                        $trip_session["trip_days"] = $trip_days;
                                    }
                                    $this->setSession(array('tripSession' => $trip_session));
                                    if($this->is_logined) {
                                        redirect(base_url(). 'car/payment/'. $car_id);
                                    } else {
                                        redirect(base_url(). 'car/confirm_booking/'. $car_id);
                                    }
                                } else {
                                    $this->session->set_flashdata('error', 'Route not found.');
                                    redirect(base_url() . "car/search");
                                }
                            }
                        } else {
                            $this->session->set_flashdata('error', 'Route not found.');
                            redirect(base_url());
                        }
                    }
                }

                $booking_details["booking_cab"]     = $selected_car;
                $booking_details["booking_ref"]     = "sarthi_".time();
                $data["booking_details"]            = $booking_details;
                $this->template->view("front/car/booking_car", $data);
            } else {
                $this->session->set_flashdata('error', 'Please select car.');
                redirect(base_url() . "car/search");
            }
        } else {
            $this->session->set_flashdata('error', 'Please select car.');
            redirect(base_url() . "car/search");
        }
    }

    public function payment($car_id = "") {
        if($this->is_logined) {
            if($car_id != ""){
                $decrypt_id         = decreptIt($car_id);
                $filter["where"]    = array("bharat_vehicle.id" => $decrypt_id);
                $filter["row"]      = 1;
                $selected_car       = $this->vehicle_model->vehicle_search($filter);
                $tripSession        = $this->getSession("tripSession");
                if(!empty($selected_car) && !empty($tripSession)) {
                    $userBookingSession   = array(
                                                "username"  => $this->loginUser["first_name"],
                                                "phone"     => $this->loginUser["phone"],
                                            );
                    $this->setSession(array('userBookingSession' => $userBookingSession));
                    $booking_details                    = $tripSession;
                    $booking_details["booking_cab"]     = $selected_car;
                    $data["booking_details"]            = $booking_details;
                    $this->template->view("front/car/payment", $data);
                } else {
                    $this->session->set_flashdata('error', 'Please select car.');
                    redirect();
                }
            } else {
                $this->session->set_flashdata('error', 'Please select car.');
                redirect();
            }
        } else {
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data           = array();
                $filter         = array();
                $this->form_validation->set_rules('username', 'User Name', 'required|trim');
                $this->form_validation->set_rules('phone', 'Phone Number', 'required|trim');
                $this->form_validation->set_rules('email', 'email', 'required|trim');
                $this->form_validation->set_rules('car_id', 'Car', 'required|trim');
                $this->form_validation->set_rules('otp_text', 'OTP', 'required|trim');
                if ($this->form_validation->run() == true) {
                    $car_id         = $this->input->post('car_id');
                    $username       = $this->input->post('username');
                    $phone          = $this->input->post('phone');
                    $email          = $this->input->post('email');
                    $tripSession    = $this->getSession("tripSession");
                    $otp_text       = $this->input->post('otp_text');
                    if($car_id != "" && !empty($tripSession)){

                        $decrypt_id             = decreptIt($car_id);
                        $filter['tripSession']  = $tripSession;
                        $filter['route_km']     = (isset($tripSession["route_km"])) ? $tripSession["route_km"] : 0;
                        $filter["where"]        = array("bharat_vehicle.id" => $decrypt_id);
                        $filter["row"]          = 1;
                        $selected_car           = $this->vehicle_model->vehicle_search($filter);
                        if( ! empty($selected_car)) {
//                            $hiddenAcceccKey= $this->getSession("hiddenAcceccKey");
//                            $isVerify       = false;
                            $isVerify       = true;
//                            if(! empty($hiddenAcceccKey) && isset($hiddenAcceccKey["AcceccKey"]) ) {
//                                $acceccKey = decreptIt($hiddenAcceccKey["AcceccKey"]);
//                                if ($otp_text == $acceccKey) {
//                                    $isVerify = true;
//                                }
//                                $this->removeSession(array('hiddenAcceccKey'));
//                            }
                            if ($isVerify) {
                                $userBookingSession   = array(
                                                            "username"  => $username,
                                                            "phone"     => $phone,
                                                            "email"     => $email,
                                                        );
                                $this->setSession(array('userBookingSession' => $userBookingSession));
                                $booking_details                    = $tripSession;
                                $booking_details["booking_cab"]     = $selected_car;
                                $data["booking_details"]            = $booking_details;
                                $data["selected_car"]               = $selected_car;
                                $this->template->view("front/car/payment", $data);
                            } else {
                                $this->session->set_flashdata('error', 'Invalid otp please try again later');
                                redirect(base_url() . "confirm_booking/". $car_id);
                            }
                        } else {
                            $this->session->set_flashdata('error', 'Car not found');
                            redirect(base_url() . "car/search");
                        }
                    } else {
                        redirect(base_url() . "car/search");
                    }
                } else {
                    redirect(base_url() . "car/search");
                }
            } else {
                redirect();
            }
        }
    }

    public function checkout() {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data           = array();
            $filter         = array();
            $this->form_validation->set_rules('car_id', 'Car', 'required|trim');
            if ($this->form_validation->run() == true) {
                $car_id             = $this->input->post('car_id');
                $tripSession        = $this->getSession("tripSession");
                $userBookingSession = $this->getSession("userBookingSession");
                if($car_id != "" && !empty($tripSession) && !empty($userBookingSession) ){
                    $decrypt_id         = decreptIt($car_id);
                    $filter["where"]    = array("bharat_vehicle.id" => $decrypt_id);
                    $filter["row"]      = 1;
                    $selected_car       = $this->vehicle_model->vehicle_search($filter);
                    if(!empty($selected_car)) {
                        $total_amount   = 0;
                        $route_details  = $this->route_model->get_route_details($tripSession["trip_location"], $tripSession["drop_location"]);
                        if(!empty($route_details)) {
                            $driver_price   = $selected_car->driver_price;
                            $trip_type      = $tripSession["trip_type"];
                            $route_price    = $route_details->kilometer * $selected_car->outstation_price / $selected_car->outstation_km;
                            if($trip_type == 1){
                                $trip_days      = $tripSession["trip_days"];
                                $day_min_km     = $this->config->item('DAY_MIN_KM');
                                $pref_km        = $day_min_km;
                                if($route_details->kilometer > $day_min_km) {
                                    $pref_km    = $route_details->kilometer;
                                }
                                $driver_price   = $driver_price * $trip_days;
                                $route_price    = $pref_km * $trip_days * $selected_car->outstation_price / $selected_car->outstation_km;
                            }
                            $total_amount       = $route_price + $driver_price;
                            $user_id            = 0;
                            $order_id           = 'SRT_' . time();
                            $booking_id         = 0;
                            if(isset($this->loginUser["id"])) {
                                $user_id    = $this->loginUser["id"];
                            } else {
                                $filter['select']   = array('id');
                                $filter['where']    = array('phone' => $userBookingSession["phone"]);
                                $filter['row']      = 1;
                                $user_details       = $this->user_model->get_rows($filter);
                                if(!empty($user_details)) {
                                    $user_id    = $user_details->id;
                                } else {
                                    $user_data  = array(
                                                        "phone"             => $userBookingSession["phone"],
                                                        "first_name"        => $userBookingSession["username"],
                                                        "email"             => $userBookingSession["email"],
                                                        "password"          => encreptIt(123456),
                                                        "created_date"      => date("Y-m-d H:i:s"),
                                                    );
                                    $user_id    = $this->user_model->insert($user_data);
                                }
                            }
                            if($user_id > 0) {
                                $booking_data = array(
                                                    "reference_id"      => $order_id,
                                                    "user_id"           => $user_id,
                                                    "vehical_id"        => $decrypt_id,
                                                    "transaction_id"    => time(),
                                                    "total_amount"      => $total_amount,
                                                    "status"            => "Pending",
                                                    "created_date"      => date("Y-m-d H:i:s"),
                                                ); 
                                $booking_id = $this->booking_model->insert($booking_data);
                                if($booking_id > 0) {
                                    $paymentConfirmSession   = array(
                                                                "booking_id"    => encreptIt($booking_id)
                                                                );
                                    $this->setSession(array('paymentConfirmSession' => $paymentConfirmSession));
                                    $booking_detail_data = array(
                                                        "booking_id"    => $booking_id,
                                                        "service_type"  => $trip_type,
                                                        "trip_location" => $tripSession["trip_location"],
                                                        "drop_location" => $tripSession["drop_location"],
                                                        "pickup_date"   => date("Y-m-d", strtotime($tripSession["pick_date"])),
                                                        "pickup_time"   => date("H:i:s", strtotime($tripSession["pick_time"])),
                                                    );
                                    if($trip_type == 1) {
                                        $booking_detail_data['trip_days']   = $trip_days;
                                    }
                                    $booking_detail_id = $this->booking_detail_model->insert($booking_detail_data);
                                    if ($booking_detail_id > 0) {
                                        $returnURL  = base_url() . "car/payment_confirmation";
                                        $this->paytm_lib->add_field('CALLBACK_URL', $returnURL);
                                        $this->paytm_lib->add_field('ORDER_ID', $booking_id);
                                        $this->paytm_lib->add_field('CUST_ID', $user_id);
                                        $this->paytm_lib->add_field('TXN_AMOUNT', 10);// Payment amount
                                        $this->paytm_lib->add_field('MSISDN', $userBookingSession["phone"]);
                                        $this->paytm_lib->paytm_auto_form();
                                    } else {
                                        $this->session->set_flashdata('error', 'Database Error in booking details');
                                        redirect();
                                    }
                                } else {
                                    $this->session->set_flashdata('error', 'Database Error in booking');
                                    redirect();
                                }
                            } else {
                                $this->session->set_flashdata('error', 'Database Error in user');
                                redirect();
                            }
                        } else {
                            $this->session->set_flashdata('error', 'Route not found');
                            redirect(base_url() . "car/search");
                        }
                    } else {
                        $this->session->set_flashdata('error', 'Car not found');
                        redirect(base_url() . "car/search");
                    }
                } else {
                    $this->session->set_flashdata('error', 'Car not found');
                    redirect(base_url() . "car/search");
                }
            } else {
                $this->session->set_flashdata('error', 'Car not found');
                redirect(base_url() . "car/search");
            }
        } else {
            $this->session->set_flashdata('error', 'Invalid Method');
            redirect();
        }
    }

    function payment_confirmation() {
        $payment_response   = $_REQUEST;
        //p($payment_response);
        if(isset($payment_response['STATUS'])) {
            $paymentConfirmSession  = $this->getSession("paymentConfirmSession");
            if(!empty($paymentConfirmSession) && isset($paymentConfirmSession["booking_id"])) {
                $booking_id = ($paymentConfirmSession["booking_id"] != "") ? decreptIt($paymentConfirmSession["booking_id"]) : 0;
                if ($payment_response['STATUS'] == "TXN_SUCCESS") {
                    $this->removeSession(array('tripSession'));
                    $this->removeSession(array('userBookingSession'));
                    if($booking_id > 0) {
                        $filter["where"]    = array("bharat_booking.id" => $booking_id);
                        $booking_chk        = $this->booking_model->get_rows($filter, true);
                        if($booking_chk > 0) {
                            $update_booking["transaction_id"]   = $payment_response['TXNID'];
                            $update_booking["total_amount"]     = $payment_response['TXNAMOUNT'];
                            $update_booking["status"]           = $payment_response['STATUS'];
                            $update_booking["check_sum_arr"]    = $payment_response['CHECKSUMHASH'];
                            $this->booking_model->update_table($update_booking, $filter["where"]);

                            $filter["select"]   = array("bharat_booking.*", 
                                                        "bd.service_type", 
                                                        "c_pick.city_name as pick_city", 
                                                        "s_pick.state as pick_state ",
                                                        "c_drop.city_name as drop_city", 
                                                        "s_drop.state as drop_state", 
                                                        "bd.trip_location", 
                                                        "bd.drop_location",
                                                        "bd.pickup_date", "bd.pickup_time",
                                                        "bd.trip_days");
                            $filter["join"]     = array(
                                                        array('table' => 'bharat_booking_detail as bd', 'condition' => "bd.booking_id = bharat_booking.id", "type" => "left"),
                                                        array('table' => 'bharat_cities as c_pick', 'condition' => "c_pick.id = bd.trip_location", "type" => "left"),
                                                        array('table' => 'bharat_state as s_pick', 'condition' => "s_pick.id = c_pick.state_code", "type" => "left"),
                                                        array('table' => 'bharat_cities as c_drop', 'condition' => "c_drop.id = bd.drop_location", "type" => "left"),
                                                        array('table' => 'bharat_state as s_drop', 'condition' => "s_drop.id = c_drop.state_code", "type" => "left")
                                                    );
                            $filter["groupby"]  = array("field" => "bharat_booking.id");
                            $filter["row"]      = 1;
                            $booking_details    = $this->booking_model->get_rows($filter);

                            if( !empty($booking_details) ) {
                                $data["booking_details"] = $booking_details;
                                $this->template->view("front/car/payment_confirmation", $data);
                            } else {
                                $this->session->set_flashdata('error', 'Booking details does not exist');
                                redirect(base_url() . "car/search");
                            }
                        } else {
                            $this->session->set_flashdata('error', 'Booking details does not exist');
                            redirect(base_url() . "car/search");
                        }
                    } else {
                        $this->session->set_flashdata('error', 'Booking data does not exist');
                        redirect(base_url() . "car/search");
                    }
                } else if ($payment_response['STATUS'] == "TXN_FAILURE") {
                    $this->session->set_flashdata('error', 'Payment not complete please try again');
                    redirect(base_url() . "car/payment/". encryptIt($booking_id));
                }
            } else {
                $this->session->set_flashdata('error', 'Booking not exist');
                redirect(base_url() . "car/search");
            }
        } else {
            $this->session->set_flashdata('error', 'Payment not set');
            redirect('car/search');
        }
    }

    public function send_inquiry() {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('name', 'Name', 'required|trim');
            $this->form_validation->set_rules('email', 'Email', 'required|trim');
            $this->form_validation->set_rules('message', 'Message', 'required|trim');
            if ($this->form_validation->run() == true) {
                $name           = $this->input->post('name');
                $email          = $this->input->post('email');
                $message        = $this->input->post('message');
                $phone          = $this->input->post('phone');
                $detail_message = "";
                $tripSession    = $this->getSession("tripSession");
                if(!empty($tripSession)){
                    $detail_message = json_encode($tripSession);
                }
                $inquiry_data   = array(
                                    "name"              => $name,
                                    "email"             => $email,
                                    "subject"           => "Booking Inquiry",
                                    "message"           => $message,
                                    "phone"             => $phone,
                                    "trip_details"      => $detail_message,
                                    "type"              => 0,
                                    "created_date"      => date('Y-m-d H:i:s')
                                );
                $id = $this->inquiry_model->insert($inquiry_data);
                if ($id > 0) {
                    $to_email   = "inquiry@saarthicab.com";
                    $subject    = 'Contact Inquiry - Saarthicab.com';
                    $headers    = 'MIME-Version: 1.0' . "\r\n";
                    $headers    .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";//        
                    $headers    .= 'From:noreply@saarthicab.com';
////                            $message  = 'This mail is sent using the PHP mail function';
                    $viewData['email']          = $email;
                    $viewData['username']       = $name;
                    $viewData['phone']          = $phone;
                    $viewData['subject']        = "Booking Inquiry";
                    $viewData['message']        = $message;
                    $viewData['trip_details']   = $tripSession;
                    $message                    = $this->load->view('front/email/inquiry', $viewData, true);

                    mail($to_email,$subject,$message,$headers); 

                    $return['status']   = true;
                    $return['message']  = "Inquiry sent successfully.";
                } else {
                    $return['status']   = false;
                    $return['message']  = "Something went wrong";
                }
            } else {
                $return["status"]   = false;
                $return["message"]  = validation_errors();
            }
            json_output($return);
        } else {
            $this->session->set_flashdata('error', 'Invalid Method.');
            redirect(base_url());
        }
    }

    public function verify_whatsapp() {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('username', 'User Name', 'required|trim');
            $this->form_validation->set_rules('phone', 'Phone Number', 'required|numeric|trim');
            $this->form_validation->set_rules('email', 'Email', 'required|trim');
            if ($this->form_validation->run() == true) {
                $username   = $this->input->post('username');
                $phone_no   = $this->input->post('phone');

//                $this->removeSession(array('hiddenAcceccKey'));
//                $whats_app          = new Whats_app();
//                $rand_otp           = mt_rand(100000, 999999);
//                $hiddenAcceccKey    = array("AcceccKey"=> encryptIt($rand_otp));
//                $this->setSession(array('hiddenAcceccKey' => $hiddenAcceccKey));
//
//                $subjectX       = "Hi ".  ucfirst($username).",<br>Your otp is*$rand_otp*<br>Please go ahead and *Confirm* your *Booking*.<br><br>Regards,<br>*Saarthi cabs*";
//                $authKey        = $whats_app->authKey;
//                $mobileNumber   = $phone_no;
//                $senderId       = "Sarthi";
//                $message        = urlencode("$subjectX");
//                $route          = $whats_app->route;
//                $postData       = array(
//                    'emi'       => $authKey,
//                    'phone'     => $mobileNumber,
//                    'messages'  => $message,
//                    'sender'    => $senderId,
//                    'route'     => $route
//                );
//                $sms_status = $whats_app->sendSMS($postData);
                $return["status"]   = true;
//                if( isset($sms_status["status"]) && $sms_status["status"] == true ) {
//                    $return["status"]   = true;
//                } else {
//                    $return["status"]   = false;
//                    $return["message"]  = "Please try again later";
//                }
            } else {
                $return["status"]   = false;
                $return["message"]  = validation_errors();
            }
            json_output($return);
        } else {
            $this->session->set_flashdata('error', 'Invalid Method.');
            redirect(base_url());
        }
    }
}