<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Booking extends MY_Controller {

    var $is_logined = FALSE;

    public function __construct() {
        parent::__construct();
        $this->is_logined   = $this->get_admin_user();
        $this->loginUser    = $this->getLoginUser();
    }

    public function index() {
        if ($this->is_logined) {
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $filter         = array();
                $search         = $this->input->post('search');
                $start          = intval($this->input->post("start"));
                $length         = intval($this->input->post("length"));
                $order          = $this->input->post("order");
                //$filter['where']= array("user_id" => $this->loginUser["id"]);
                $columnArray    = array(
                                    '',
                                    '',
                                    'pickup_date',
                                    'service_type',
                                    '',
                                    '',
                                    '',
                                    'status',
                                    'total_amount',
                                    '',
                                    );
                $filter["select"]   = array('bharat_booking.*','user.first_name', 'user.last_name','detail.service_type','bc_form.city_name as from_city','bc_to.city_name as to_city','bs_form.state as from_state','bs_to.state as to_state','detail.pickup_date','detail.pickup_time','detail.trip_days');
                $filter["join"]     = array(
                    array('table' => 'bharat_user as user', 'condition' => "user.id = bharat_booking.user_id", "type" => "left"),
                    array('table' => 'bharat_booking_detail as detail', 'condition' => "detail.booking_id = bharat_booking.id", "type" => "left"),
                    array('table' => 'bharat_cities as bc_form', 'condition' => "bc_form.id = detail.trip_location", "type" => "left"),
                    array('table' => 'bharat_cities as bc_to', 'condition' => "bc_to.id = detail.drop_location", "type" => "left"),
                    array('table' => 'bharat_state as bs_form', 'condition' => "bs_form.id = bc_form.state_code", "type" => "left"),
                    array('table' => 'bharat_state as bs_to', 'condition' => "bs_to.id = bc_to.state_code", "type" => "left")
                );
                $filterCount    = $totalCount = $this->booking_model->get_rows($filter, true);
                if (isset($search) && ($search['value'] != '')) {
                    $searchString       = $search['value'];
                    $filter['like']     = array('field' => 'user.first_name', 'value' => $searchString);
                    $filter['or_like']  = array(
                                            array('field' => "user.last_name", 'value' => $searchString),
                                            array('field' => "bc_form.city_name", 'value' => $searchString),
                                            array('field' => "bc_to.city_name", 'value' => $searchString),
                                            array('field' => "bs_form.state", 'value' => $searchString),
                                            array('field' => "bs_to.state", 'value' => $searchString),
                                            array('field' => "DATE_FORMAT(bharat_booking.created_date, '%M %d, %Y')", 'value' => $searchString)
                                        );
                    $filterCount        = $this->booking_model->get_rows($filter, true);
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
                $filter['orderby']  = array('field' => "id", 'order' => "DESC");
                $query              = $this->booking_model->get_rows($filter);
                $admin              = array();
                foreach ($query as $row) {
//                    p($row);
                    $row_data                   = array();
                    $row_data['reference_id']   = $row->reference_id;
                    $row_data['username']       = $row->first_name . " " . $row->last_name;
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
                        $action = '<a href="javascript:;" data-booking_id="'.encryptIt($row->id).'" class="btn btn-sm btn-success mr-1">Completed</a>';
                    } else if ( $row->cancel_request == 1 && $row->status == "TXN_SUCCESS" ) {
                        $action = '<a href="javascript:;" data-booking_id="'.encryptIt($row->id).'" class="btn btn-sm btn-primary mr-1 booking_view_btn ">Request sent for reject</a>';
                    } else if ($row->status == "Pending") {
                        $action = '<a href="javascript:;" class="btn btn-sm btn-danger mr-1">Payment Not Done</a>';
                    } else if ($row->cancel_request == 3) {
                        $action = '<a href="javascript:;" data-booking_id="'.encryptIt($row->id).'" class="btn btn-sm btn-danger mr-1">Request Reject</a>';
                    } else if ($row->cancel_request == 2) {
                        $action = '<a href="javascript:;" data-booking_id="'.encryptIt($row->id).'" class="btn btn-sm btn-danger mr-1">Canceled</a>';
                    }
                    $action .= '<a href="' . admin_url() . 'booking/view/'.encryptIt($row->id).'" class="btn btn-sm btn-info mr-1">View</a>';
                    $row_data['trip_status']    = $isTripComplete;
                    $row_data['action']         = $action;
                    $admin[]                    = $row_data;
                }
                $data['recordsTotal']       = $totalCount;
                $data['recordsFiltered']    = $filterCount;
                $data['data']               = $admin;

                json_output($data);
            } 

            $data['js_files']   = array(
                                    'datatables.min.js'
                                );
            $data['css_files']   = array(
                                    'datatables.min.css'
                                );

            $data['active_menu']                = 18;
            $data['breadcrumbs']['page_title']  = "Manage Booking";
            $data['breadcrumbs']['data']        = array(
                                                    array('name' => 'Manage Booking', 'link' => admin_url().'booking')
                                                );

            $this->template->view('admin/booking/index', $data);
        } else {
            redirect(admin_url());
        }
    }

    public function view($booking_id = "") {
        if ($this->is_logined) {
            if($booking_id != "") {
                $filter["where"]        = array("bharat_booking.id" => decreptIt($booking_id));
                $filter["select"]       = array("bharat_booking.*", 
                                            "user.first_name", 
                                            "user.last_name",
                                            "user.phone",
                                            "user.email",
                                            "bd.service_type", 
                                            "c_pick.city_name as pick_city", 
                                            "s_pick.state as pick_state ",
                                            "c_drop.city_name as drop_city", 
                                            "s_drop.state as drop_state", 
                                            "bd.trip_location", 
                                            "bd.drop_location",
                                            "bd.pickup_date", "bd.pickup_time",
                                            "bd.trip_days");
                $filter["join"]         = array(
                                            array('table' => 'bharat_booking_detail as bd', 'condition' => "bd.booking_id = bharat_booking.id", "type" => "left"),
                                            array('table' => 'bharat_user as user', 'condition' => "user.id = bharat_booking.user_id", "type" => "left"),
                                            array('table' => 'bharat_cities as c_pick', 'condition' => "c_pick.id = bd.trip_location", "type" => "left"),
                                            array('table' => 'bharat_state as s_pick', 'condition' => "s_pick.id = c_pick.state_code", "type" => "left"),
                                            array('table' => 'bharat_cities as c_drop', 'condition' => "c_drop.id = bd.drop_location", "type" => "left"),
                                            array('table' => 'bharat_state as s_drop', 'condition' => "s_drop.id = c_drop.state_code", "type" => "left")
                                        );
                $filter["groupby"]      = array("field" => "bharat_booking.id");
                $filter["row"]          = 1;
                $data["trip_details"]   = $this->booking_model->get_rows($filter);
                $data['breadcrumbs']['page_title']  = "Manage Booking";
                $data['breadcrumbs']['data']        = array(
                                                        array('name' => 'Manage Booking', 'link' => admin_url().'booking')
                                                    );
                $this->template->view('admin/booking/view', $data);
            } else {
                redirect(admin_url()."booking");
            }
        } else {
            redirect(admin_url());
        }
    }

    public function get_booking() {
        if ($this->is_logined) {
            $return     = array();
            $id         = $this->input->post('id');
            $view_data  = array();
            if ($id != '') {
                $filter['where']    = array('id' => decryptIt($id));
                $filter['row']      = 1;
                $booking            = $this->booking_model->get_rows($filter);
                if (!empty($booking)) {
                    $view_data['booking']   = $booking;
                    $return['modal_form']   = $this->load->view("admin/booking/form_modal", $view_data, true);
                    $return['status']       = true;
                } else {
                    $return['status'] = false;
                }
            } else {
                $return['modal_form']   = $this->load->view("admin/booking/form_modal", $view_data, true);
                $return['status']       = true;
            }

            json_output($return);
        } else {
            redirect(admin_url());
        }
    }

    public function delete() {
        if ($this->is_logined) {
            $id                 = $this->input->post('id');
            $decrypt_id         = decryptIt($id);
            $uFilter['where']   = array('id' => $decrypt_id);
            $uFilter['row']     = 1;
            $user               = $this->booking_model->get_rows($uFilter, true);

            if ($user > 0) {
                $this->booking_model->delete($uFilter['where']);

                $return['status']   = true;
                $return['message']  = 'Feedback deleted successfully';
            } else {
                $return['status']   = false;
                $return['message']  = 'Somthing went wrong';
            }
            json_output($return);
        } else {
            redirect(admin_url());
        }
    }

    public function driver_mail() {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('booking_id', 'booking_id', 'required|trim');
            $this->form_validation->set_rules('driver_name', 'driver_name', 'required|trim');
            $this->form_validation->set_rules('phone_no', 'phone_no', 'required|trim');
            $this->form_validation->set_rules('car_no', 'car_no', 'required|trim');
            if ($this->form_validation->run() == true) {
                $booking_id     = $this->input->post('booking_id');
                $driver_name    = $this->input->post('driver_name');
                $phone_no       = $this->input->post('phone_no');
                $car_no         = $this->input->post('car_no');
                $message        = $this->input->post('message');
                $subject        = ($this->input->post('subject') != "") ? $this->input->post('subject') : "Driver Details aginst your trip booking";

                $filter["where"]            = array("bharat_booking.id" => decreptIt($booking_id));
                $filter["select"]           = array("bharat_booking.*", 
                                                "user.first_name", 
                                                "user.last_name",
                                                "user.phone",
                                                "user.email",
                                                "bd.service_type", 
                                                "c_pick.city_name as pick_city", 
                                                "s_pick.state as pick_state ",
                                                "c_drop.city_name as drop_city", 
                                                "s_drop.state as drop_state", 
                                                "bd.trip_location", 
                                                "bd.drop_location",
                                                "bd.pickup_date", "bd.pickup_time",
                                                "bd.trip_days");
                $filter["join"]             = array(
                                                array('table' => 'bharat_booking_detail as bd', 'condition' => "bd.booking_id = bharat_booking.id", "type" => "left"),
                                                array('table' => 'bharat_user as user', 'condition' => "user.id = bharat_booking.user_id", "type" => "left"),
                                                array('table' => 'bharat_cities as c_pick', 'condition' => "c_pick.id = bd.trip_location", "type" => "left"),
                                                array('table' => 'bharat_state as s_pick', 'condition' => "s_pick.id = c_pick.state_code", "type" => "left"),
                                                array('table' => 'bharat_cities as c_drop', 'condition' => "c_drop.id = bd.drop_location", "type" => "left"),
                                                array('table' => 'bharat_state as s_drop', 'condition' => "s_drop.id = c_drop.state_code", "type" => "left")
                                            );
                $filter["groupby"]          = array("field" => "bharat_booking.id");
                $filter["row"]              = 1;
                $trip_details               = $this->booking_model->get_rows($filter);
                if (! empty($trip_details)) {
//                    $to_email   = $trip_details->email;
                    $to_email   = "inquiry@saarthicab.com";
                    $subject    = $subject . ' - Saarthicab.com';
                    $headers    = 'MIME-Version: 1.0' . "\r\n";
                    $headers    .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";//        
                    $headers    .= 'From:noreply@saarthicab.com';

                    $viewData['driver_name']    = $driver_name;
                    $viewData['phone_no']       = $phone_no;
                    $viewData['car_no']         = $car_no;
                    $viewData['subject']        = $subject;
                    $viewData['message']        = $message;
                    $viewData['trip_details']   = $trip_details;
                    $message                    = $this->load->view('front/email/driver_details', $viewData, true);
                    mail($to_email,$subject,$message,$headers);
                    $this->session->set_flashdata('success', 'Driver detail mail send successfully');
                } else {
                    $this->session->set_flashdata('error', 'Booking not found');
                }
                redirect(admin_url().'booking/view/'. $booking_id);
            } else {
                $this->session->set_flashdata('error', 'Invalid Method.');
                redirect(admin_url().'booking');
            }
        } else {
            $this->session->set_flashdata('error', 'Invalid Method.');
            redirect(base_url());
        }
    }    
    
}
?>