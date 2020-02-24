<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->is_logined       = $this->get_authorized_user();
        $this->loginUser        = $this->getLoginUser();

        if (! $this->is_logined) {
            redirect(base_url());
        }
    }

    public function index() {
        $data                   = array();
        $filter["where"]        = array("id" => $this->loginUser["id"]);
        $filter["row"]          = 2;
        $user_details           = $this->user_model->get_rows($filter);
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $email_error_msg = array(
                                'required'      => 'Please enter email id',
                                'is_unique'     => 'Email id alrready exist',
                                'valid_email'   => 'Please valid email id');
            $phone_error_msg = array(
                                'required'  => 'Please enter email id',
                                'is_unique' => 'Phone no alrready exist',
                                'numeric'   => 'Please valid phone no');
            $this->form_validation->set_rules('first_name', 'First Name', 'trim|required', array('required' => 'Please enter first name'));
            $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required', array('required' => 'Please enter last name'));
            $this->form_validation->set_rules('phone', 'Phone', 'trim|required|numeric|callback_check_phone',$phone_error_msg);
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_check_email',$email_error_msg);

            if ($this->form_validation->run() == true) {
                $user_data                  = array();
                $user_data['username']      = $this->input->post('username');
                $user_data['first_name']    = $this->input->post('first_name');                    
                $user_data['last_name']     = $this->input->post('last_name');                    
                $user_data['phone']         = $this->input->post('phone');
                $user_data['email']         = $this->input->post('email');
                $old_pass                   = trim($this->input->post('old_pass'));
                if ($old_pass != "") {
                    if($user_details["password"] == encreptIt($old_pass)){
                        $new_pass       = $this->input->post('new_pass');
                        $confirm_pass   = $this->input->post('confirm_pass');
                        if(($new_pass != "") && $new_pass == $confirm_pass ) {
                            if (preg_match('/^(?=.*[A-Za-z])(?=.*\d).{6,}$/', $new_pass)) {
                                $user_data['password'] = encreptIt($new_pass);
                                $this->user_model->update_table($user_data, array("id" => $this->loginUser["id"]));
                                $this->session->set_flashdata('success', "Profile Updated");
                            } else {
                                $this->session->set_flashdata('error', "Password does not meet the requirements");
                            }
                        } else {
                            $this->session->set_flashdata('error', "New password and confirm password not match");
                        }
                    } else {
                        $this->session->set_flashdata('error', "Old password not match");
                    }
                } else {
                    $this->user_model->update_table($user_data, array("id" => $this->loginUser["id"]));
                    $this->session->set_flashdata('success', "Profile Updated");
                }
            } else {
                //p(validation_errors());
                $this->session->set_flashdata('error', "All field are required");
            }
            redirect(base_url().'user');
        }
        $data['user_details']   = $user_details;
        $data['js_files']       = array(
                                    'datatables.min.js'
                                );
        $data['css_files']      = array(
                                    'datatables.min.css'
                                );
        $this->template->view("front/user/index", $data);
    }
    
    public function load_booking(){
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $search         = $this->input->post('search');
            $start          = intval($this->input->post("start"));
            $length         = intval($this->input->post("length"));
            $order          = $this->input->post("order");
            $filter['where']= array("user_id" => $this->loginUser["id"]);
            $columnArray    = array(
                                'pickup_date',
                                'service_type',
                                '',
                                '',
                                '',
                                'status',
                                'total_amount',
                                '',
                                );
            $filterCount    = $totalCount = $this->booking_model->get_rows($filter, true);
            if (isset($search) && ($search['value'] != '')) {
//                    $searchString       = $search['value'];
//                    $filter['like']     = array('field' => 'bharat_category.name', 'value' => $searchString);
//                    $filter['or_like']  = array(
//                        '0' => array('field' => "DATE_FORMAT(bharat_category.created_date, '%M %d, %Y')", 'value' => $searchString)
//                    );
//                    $filterCount        = $this->booking_model->get_rows($filter, true);
            }
            $filter['limit']    = array('limit' => $length, 'from' => $start);
            $orderField         = $columnArray[0];
            $orderSort          = 'DESC';
            if (!empty($order)) {
                if (isset($order[0]['column']) && $order[0]['column'] != '') {
                    $orderField = $columnArray[$order[0]['column']];
                    $orderSort  = $order[0]['dir'];
                }
            }
            $filter["select"]   = array('bharat_booking.*','detail.service_type','bc_form.city_name as from_city','bc_to.city_name as to_city','bs_form.state as from_state','bs_to.state as to_state','detail.pickup_date','detail.pickup_time','detail.trip_days');
            $filter["join"]     = array(
                                    array('table' => 'bharat_booking_detail as detail', 'condition' => "detail.booking_id = bharat_booking.id", "type" => "left"),
                                    array('table' => 'bharat_cities as bc_form', 'condition' => "bc_form.id = detail.trip_location", "type" => "left"),
                                    array('table' => 'bharat_cities as bc_to', 'condition' => "bc_to.id = detail.drop_location", "type" => "left"),
                                    array('table' => 'bharat_state as bs_form', 'condition' => "bs_form.id = bc_form.state_code", "type" => "left"),
                                    array('table' => 'bharat_state as bs_to', 'condition' => "bs_to.id = bc_to.state_code", "type" => "left")

                                );
            $filter['orderby']  = array('field' => "id", 'order' => "DESC");
            $query              = $this->booking_model->get_rows($filter);
            $admin              = array();
            foreach ($query as $row) {
                //p($row);
                $row_data                   = array();
                $row_data['id']             = $row->id;
                $row_data['trip_date']      = showDate($row->pickup_date);
                $row_data['trip_type']      = ($row->service_type == 1) ? "Two Way" : "One Way";
                $row_data['from_location']  = $row->from_city . " - " . strtolower(ucfirst($row->from_state));
                $row_data['to_location']    = $row->to_city . " - " . strtolower(ucfirst($row->to_state));
                $row_data['status']         = ($row->status == "TXN_SUCCESS") ? "Success" : $row->status;
                $row_data['total_amount']   = $row->total_amount;

                $befor_date = date("Y-m-d", strtotime("- 1 Day"));
                $today_date = date("Y-m-d");

                $date1 = new DateTime($row->pickup_date);
                $date2 = new DateTime($today_date);
                $interval = $date1->diff($date2);
                $isTripComplete = "Pending";
                if ( !empty ($interval) ) {
                    if ($row->cancel_request == 0 && $row->status == "TXN_SUCCESS" ) {
                        //p($interval->days);
                        if ($interval->invert == 0 && $interval->days == 0) {
                            $isTripComplete = "On Today";
                        } if ($interval->invert == 0 && $interval->days >= 1) {
                            $isTripComplete = "Completed";
                        }
                    }
                }
                $action = '';
                if ( $isTripComplete == "Completed") {
                    $action = '<a href="javascript:;" class="btn btn-sm btn-success mr-1">Completed</a>';
                } else if ( $row->cancel_request == 0 && $row->status == "TXN_SUCCESS" ) {
                    $action = '<a href="javascript:;" data-booking_id="'.encryptIt($row->id).'"  class="btn btn-sm btn-primary mr-1 cancel_booking_btn ">Cancel Booking?</a>';
                } else if ($row->status == "Pending") {
                    $action = '<a href="javascript:;" class="btn btn-sm btn-danger mr-1">Payment Not Done</a>';
                } else if ($row->cancel_request == 3) {
                    $action = '<a href="javascript:;" class="btn btn-sm btn-danger mr-1">Request Reject</a>';
                } else if ($row->cancel_request == 2) {
                    $action = '<a href="javascript:;" class="btn btn-sm btn-danger mr-1">Canceled</a>';
                }
                $row_data['trip_status']    = $isTripComplete;
                $row_data['action']         = $action;
                $admin[]                    = $row_data;
            }
            $data['recordsTotal']       = $totalCount;
            $data['recordsFiltered']    = $filterCount;
            $data['data']               = $admin;

            json_output($data);
        } else {
            redirect(base_url());
        }
    }

    public function check_phone($phone) {
        $user_id    = $this->loginUser["id"];
        $filter     = array();
        if (isset($phone) && ($phone != "")) {
            $filter['where'] = array('id !=' => $user_id, "phone" => trim($phone));
        }
        $result = $this->user_model->get_rows($filter,1);
        if ($result > 0) {
            $this->form_validation->set_message('check_phone', 'Phone number already exist');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function check_email($email) {
        $user_id    = $this->loginUser["id"];
        $filter     = array();
        if (isset($email) && ($email != "")) {
            $filter['where'] = array('id !=' => $user_id, "email" => trim($email));
        }
        $result = $this->user_model->get_rows($filter,1);
        if ($result > 0) {
            $this->form_validation->set_message('check_email', 'Email already exist');
            return FALSE;
        } else {
            return TRUE;
        }
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

    public function cancel_booking() {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('booking_id', 'booking_id', 'required|trim');
            $this->form_validation->set_rules('message', 'Message', 'required|trim');
            if ($this->form_validation->run() == true) {
                $booking_id     = $this->input->post('booking_id');
                $message        = $this->input->post('message');
                $decrept_id     = decreptIt($booking_id);

                $filter['where']    = array("id" => $decrept_id);
                $filter['row']      = 1;
                $booking_data       = $this->booking_model->get_rows($filter);
                if ( !empty($booking_data) ) {
                    if ($booking_data->cancel_request == 1) {
                        $return['status']   = true;
                        $return['message']  = "Cancel request already sent";
                    } else {
                        $update_data   = array(
                                            "cancel_reason"     => $message,
                                            "cancel_request"    => 1,
                                        );
                        $this->booking_model->update_table($update_data, array('id' => $decrept_id));

                        $return['status']   = true;
                        $return['message']  = "Cancel request sent successfully.";
                    }
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
    
//    public function aboutus(){
//        $data = array();
//        $this->template->view("front/home/aboutus", $data);
//    }
//
//    public function services(){
//        $data = array();
//        $this->template->view("front/home/services", $data);
//    }
//
//    public function contectus(){
//        $data = array();
//        $this->template->view("front/home/contectus", $data);
//    }
}