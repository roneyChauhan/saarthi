<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->is_logined       = $this->get_authorized_user();
        $this->loginUser        = $this->getLoginUser();
    }

    public function index() {
        $data       = array();
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $trip_type  = $this->input->post('trip_type');
            if($trip_type == 0) {
                $this->form_validation->set_rules('trip_location', 'Trip Location', 'required|trim');
                $this->form_validation->set_rules('drop_location', 'Drop Location', 'required|trim');
                $this->form_validation->set_rules('trip_pick_date', 'Trip Pick Date', 'required|trim');
                $this->form_validation->set_rules('seating_capacity', 'Seating Capacity', 'required|trim');
                if ($this->form_validation->run() == true) {
                    $dateTime   = $this->input->post('trip_pick_date');
                    $isValid    = false;
                    if ($dateTime != "") {
                        $dateTimeArr = explode(" ", $dateTime);
                        if (! empty($dateTimeArr) && (count($dateTimeArr) == 3) ) {
                            $pick_date  = $dateTimeArr[0];
                            $pick_time  = date("H:i:s", strtotime($dateTimeArr[1] ." ". $dateTimeArr[0]));
                            $isValid    = true;
                        } else {
                            $this->session->set_flashdata('error', "All fields are required");
                        }
                    }
                    if ($isValid) {
                        $trip_location      = $this->input->post('trip_location');
                        $drop_location      = $this->input->post('drop_location');
                        $seating_capacity   = $this->input->post('seating_capacity');
                        $city_state_pick    = $this->cities_model->get_city_state_name($trip_location);
                        $city_state_drop    = $this->cities_model->get_city_state_name($drop_location);
                        if(!empty($city_state_pick) && !empty($city_state_drop)) {
                            $trip_session       = array(
                                                "trip_type"             => $trip_type,
                                                "trip_location"         => $trip_location,
                                                "drop_location"         => $drop_location,
                                                "trip_location_name"    => $city_state_pick["city_name"] . "-" . $city_state_pick["state_name"],
                                                "drop_location_name"    => $city_state_drop["city_name"] . "-" . $city_state_drop["state_name"],
                                                "pick_date"             => $pick_date,
                                                "pick_time"             => $pick_time,
                                                "seating_capacity"      => $seating_capacity,
                            );
                            $this->setSession(array('tripSession' => $trip_session));
                            redirect(base_url(). 'car/search');
                        } else {
                            $this->session->set_flashdata('error', "Something went wrong");
                            redirect(base_url(). 'home');
                        }
                    }
                } else {
                    $this->session->set_flashdata('error', "All fields are required");
                }
            } else if ($trip_type == 1) {
                $this->form_validation->set_rules('trip_location', 'Trip Location', 'required|trim');
                $this->form_validation->set_rules('drop_location', 'Drop Location', 'required|trim');
                $this->form_validation->set_rules('trip_pick_date', 'Trip Pick Date', 'required|trim');
                $this->form_validation->set_rules('trip_days', 'Trip Days', 'required|trim');
                $this->form_validation->set_rules('seating_capacity', 'Seating Capacity', 'required|trim');
                if ($this->form_validation->run() == true) {
                    $dateTime   = $this->input->post('trip_pick_date');
                    $isValid    = false;
                    if ($dateTime != "") {
                        $dateTimeArr = explode(" ", $dateTime);
                        if (! empty($dateTimeArr) && (count($dateTimeArr) == 3) ) {
                            $pick_date  = $dateTimeArr[0];
                            $pick_time  = date("H:i:s", strtotime($dateTimeArr[1] ." ". $dateTimeArr[0]));
                            $isValid    = true;
                        } else {
                            $this->session->set_flashdata('error', "All fields are required");
                        }
                    }
                    if ($isValid) {
                        $trip_days          = $this->input->post('trip_days');
                        $trip_location      = $this->input->post('trip_location');
                        $drop_location      = $this->input->post('drop_location');
                        $seating_capacity   = $this->input->post('seating_capacity');
                        $city_state_pick    = $this->cities_model->get_city_state_name($trip_location);
                        $city_state_drop    = $this->cities_model->get_city_state_name($drop_location);
                        if(!empty($city_state_pick) && !empty($city_state_drop)) {
                            $trip_session       = array(
                                                "trip_type"             => $trip_type,
                                                "trip_location"         => $trip_location,
                                                "drop_location"         => $drop_location,
                                                "trip_location_name"    => $city_state_pick["city_name"] . "-" . $city_state_pick["state_name"],
                                                "drop_location_name"    => $city_state_drop["city_name"] . "-" . $city_state_drop["state_name"],
                                                "pick_date"             => $pick_date,
                                                "pick_time"             => $pick_time,
                                                "trip_days"             => $trip_days,
                                                "seating_capacity"      => $seating_capacity,
                            );
                            $this->setSession(array('tripSession' => $trip_session));
                            redirect(base_url(). 'car/search');
                        } else {
                            $this->session->set_flashdata('error', "Something went wrong");
                            redirect(base_url(). 'home');
                        }
                    }
                } else {
                    $this->session->set_flashdata('error', "All fields are required");
                }
            }
        }

        $filter["where"]    = array("is_feature" => 1);
        $filter["limit"]    = array("limit" => 5, "from" => 0);
//        $filter["orderby"]  = array("field" => 'id', "order" => 'RANDOM');
        $filter["orderby"]  = array("field" => 'id', "order" => 'RANDOM');
        $data["car_list"]   = $this->vehicle_model->vehicle_search($filter);
//        p($data["car_list"]);
        $this->removeSession(array('tripSession'));
        $this->removeSession(array('userBookingSession'));
        $this->template->view("front/home/index", $data);
    }

    public function get_location() {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data       = array();
            $searchTerm = $this->input->post('searchTerm');
            $searchType = $this->input->post('searchType');
            $searchId   = $this->input->post('searchId');
            if($searchTerm != "") {
                $filter["select"]   = array("bharat_cities.*", "bs.state");
                $filter["like"]     = array('field' => 'bharat_cities.city_name', 'value' => $searchTerm);
                $filter["join"]     = array(
                                        "0" => array('table' => 'bharat_state as bs', 'condition' => "bs.id = bharat_cities.state_code", "type" => "left"),
                                        "1" => array('table' => 'bharat_route as rt', 'condition' => "rt.from_location = bharat_cities.id OR rt.to_location = bharat_cities.id ", "type" => "RIGHT")
                                    );
                $filter["where"]    = array('bs.status' => 1);
                if($searchId != "" && $searchType != "") {
                    $filter["join"]     = array(
                                            "0" => array('table' => 'bharat_state as bs', 'condition' => "bs.id = bharat_cities.state_code", "type" => "LEFT"),
                                            "1" => array('table' => 'bharat_route as rt', 'condition' => '(rt.from_location = bharat_cities.id AND rt.to_location = ' . $searchId .' ) OR (rt.to_location = bharat_cities.id AND rt.from_location = ' . $searchId .')' , "type" => "RIGHT")
                                        );
                    $filter["where"]["bharat_cities.id !="] = $searchId;
                }
                $filter["groupby"]  = array('field' => 'bharat_cities.id');
                $list_cities        = $this->cities_model->get_rows($filter);
                if (!empty($list_cities)) {
                    foreach ($list_cities as $city) {
                        $data[] = array("id" => $city->id, "text" => $city->city_name . " - " . ucfirst(strtolower($city->state))); 
                    }
                }
            }
            json_output($data);
        }
    }

    public function about_us(){
        $data = array();
        $this->template->view("front/home/aboutus", $data);
    }

    public function our_services(){
        $data = array();
        $this->template->view("front/home/services", $data);
    }

    public function contact_us(){
        $data   = array();
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $return = array();
            $this->form_validation->set_rules('name', 'Name', 'trim|required', array('required' => 'Please enter name'));
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', array('required' => 'Please enter email', 'valid_email' => 'Please enter valid email'));
            $this->form_validation->set_rules('subject', 'Subject', 'trim|required', array('required' => 'Please enter subject'));
            $this->form_validation->set_rules('message', 'Message', 'trim|required', array('required' => 'Please enter message'));         

            if ($this->form_validation->run() == TRUE) {
                $contact['email']          = $this->input->post('email');
                if (!filter_var($contact['email'], FILTER_VALIDATE_EMAIL) === false) {
                    
                        $contact['name']           = $this->input->post('name');
                        $contact['subject']        = $this->input->post('subject');
                        $contact['message']        = $this->input->post('message');
                        $contact['type']           = 1;
                        $contact['created_date']   = date('Y-m-d H:i:s');

                        $contact_id                = $this->inquiry_model->insert($contact);
                        if ($contact_id > 0) {

                            $to_email   = "inquiry@saarthicab.com";
                            $subject    = 'Contact Inquiry - Saarthicab.com';
                            $headers    = 'MIME-Version: 1.0' . "\r\n";
                            $headers    .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";//        
                            $headers    .= 'From:noreply@saarthicab.com';
//                            $message  = 'This mail is sent using the PHP mail function';
                            $viewData['email']      = $contact['email'];
                            $viewData['username']   = $contact['name'];
                            $viewData['subject']    = $contact['subject'];
                            $viewData['message']    = $contact['message'];
                            $message                = $this->load->view('front/email/contact_us', $viewData, true);
                            mail($to_email,$subject,$message,$headers);                    

                            $return["status"]   = TRUE;
                            $return["message"]  = "Contact send successfully";
                        } else {
                            $return["status"]   = FALSE;
                            $return["message"]  = "Contact send not successfully";
                        }
                    } else {
                        $return["status"]   = FALSE;
                        $return["message"]  = "Invalid email";
                    }
                } else {
                    $return["status"]   = FALSE;
                    $return["message"]  = "validation errors";
                }
            json_output($return);
        }
        $this->template->view("front/home/contectus", $data);
    }

    public function cancellation(){
        $data = array();
        $this->template->view("front/home/cancellation", $data);
    }

    public function terms(){
        $data = array();
        $this->template->view("front/home/terms", $data);
    }

    public function privacy_policy(){
        $data = array();
        $this->template->view("front/home/privacy_policy", $data);
    }
}