<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->is_logined       = $this->get_authorized_user();
        $this->loginUser        = $this->getLoginUser();
        $this->load->library("whats_app");
    }

    public function register() {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $return          = array();
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
            $this->form_validation->set_rules('mobile_no', 'Mobile Number', 'trim|required|numeric|is_unique[bharat_user.phone]', $phone_error_msg);
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[bharat_user.email]', $email_error_msg);
            $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_validate_password', array('required' => 'Please enter password', 'validate_password' => 'Password does not meet the requirements'));
            $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]', array('required' => 'Please confirm your password', 'matches' => "Password is not match"));

            if ($this->form_validation->run() == TRUE) {
                $this->db->trans_begin();
                $password                           = $this->input->post('password');
                $register_data['first_name']        = $this->input->post('first_name');
                $register_data['last_name']         = $this->input->post('last_name');
                $register_data['email']             = $this->input->post('email');
                $register_data['phone']             = $this->input->post('mobile_no');
                $encryptKey                         = md5($register_data['email'] . $register_data['phone'] . time());
                $register_data['password']          = encreptIt($password);
                $register_data['is_active']         = 0;
                $register_data['activation_code']   = $encryptKey;
                $register_data['created_date']      = date("Y-m-d H:i:s");
                $user_id                            = $this->user_model->insert($register_data);

                if ($user_id > 0) {
                    /* If Auto register Login */
//                    $user_session['session_id'] = encreptIt($user_id);
//                    $this->set_authorized_user($user_session);
                    $whats_app          = new Whats_app();
                    $activation_link    = base_url() . 'auth/user_verify/'. $encryptKey;
//                    $subjectX           = "Hi ".  ucfirst($register_data['first_name']) .",<br>Thank you for registration<br>Please click below link for active your account.<br>Regards,<br><a href='".$activation_link."'>'".$activation_link."'</a>";
                    $subjectX           = 'Hi' .  ucfirst($register_data['first_name']) .',<br>Thank you for registration<br>Please click below link for active your account.<br>Regards,<br>'. $activation_link; 
                    $authKey            = $whats_app->authKey;
                    $mobileNumber       = $register_data['phone'];
                    $senderId           = "Sarthi";
                    $message            = urlencode("$subjectX");
                    $route              = $whats_app->route;
                    $postData           = array(
                                            'emi'       => $authKey,
                                            'phone'     => $mobileNumber,
                                            'messages'  => $message,
                                            'sender'    => $senderId,
                                            'route'     => $route
                                        );
                    $sms_status         = $whats_app->sendSMS($postData);
                    if( isset($sms_status["status"]) && $sms_status["status"] == true ) {
                        $this->db->trans_commit();
                        $return["status"]   = true;
                        $return["message"]  = "Register Successfully! Check your Whats app for activaiton link!";
                    } else {
                        $this->db->trans_rollback();
                        $return["status"]   = false;
                        $return["message"]  = "Please try again later";
                    }
                } else {
                    $return["status"]   = FALSE;
                    $return["message"]  = "Register Successfully";
                }
            } else {
                $return["status"]   = FALSE;
                $return["message"]  = validation_errors();
            }
            json_output($return);
        }
        $data['js_files']   = array(
                                    'jquery.validate.min.js'
                                );
        $this->template->view("front/auth/register", $data);
    }

    public function login() {
        if(!$this->is_logined){
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $return = array();
                $this->form_validation->set_rules('username', 'User Name', 'trim|required', array('required' => 'Please enter username'));
                $this->form_validation->set_rules('password', 'Password', 'trim|required', array('required' => 'Please enter password'));
                if ($this->form_validation->run() == TRUE) {

                    $login_data['username'] = $this->input->post('username');
                    $login_data['password'] = $this->input->post('password');
                    $return                 = $this->dologin($login_data);
                    if(! empty($return)) {
                        if($return['status'] == true){
                            redirect(base_url().'user');
                        } else {
                            $this->session->set_flashdata('error', $return['message']);
                        }
                    } else {
                        $this->session->set_flashdata('error', 'Something went wrong.');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Please fill valid information.');
                }
            }
            $data['js_files']   = array(
                                        'jquery.validate.min.js'
                                    );
            $this->template->view("front/auth/login", $data);
        } else {
            redirect(base_url());
        }
    }
    
    public function forgot_password() {
        $data               = array();
        if (!$this->is_logined && $this->input->server('REQUEST_METHOD') == 'POST' ) {
            $email  = $this->input->post('email');
            $return = array();
            if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                $filter['where']= array('email' => trim($email));
                $filter['row']  = 1;
                $row            = $this->user_model->get_rows($filter);
                if (!empty($row)) {

                    $updateData                     = array();
                    $updateData['activation_code']  = encreptIt(rand());
                    $this->user_model->update_table($updateData, array('email' => trim($email)));

                    $link                       = base_url().'auth/reset_password/'.$updateData['activation_code'];
                    $viewData['email']          = $row->email;
                    $viewData['username']       = ucfirst($row->first_name) . ' ' . ucfirst($row->last_name);
                    $viewData['activation_code']= $link;
                    
                    $to_email   = $row->email;
                    $subject    = 'Password Reset - Saarthicab.com';
                    $headers    = 'MIME-Version: 1.0' . "\r\n";
                    $headers    .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";//        
                    $headers    .= 'From:noreply@saarthicab.com';

                    $message    = $this->load->view('front/email/forget_password', $viewData, true);

                    mail($to_email,$subject,$message,$headers);                     
                    
                    //$this->sentMail($sent_data);

                    $this->session->set_flashdata('success', 'You will get password reset link through your email');
                } else {
                    $this->session->set_flashdata('error', 'Account not exist with given email');
                }
            } else {
                    $this->session->set_flashdata('error', 'Please enter valid email address');
            }
            $this->template->view("front/auth/forgot_password", $data);
        } else{
            $this->template->view("front/auth/forgot_password", $data);
        }
        
    }

    public function reset_password($token = '') {
        if ($token != '') {
            $filters['where']   = array('activation_code' => $token);
            $filters['row']     = 1;
            $user_data          = $this->user_model->get_rows($filters);
            if (! empty($user_data)) {
                if ($this->input->server('REQUEST_METHOD') == 'POST') {
                    $password   = $this->input->post('password');
                    $cpassword  = $this->input->post('cpassword');

                    if ($password == $cpassword) {

                        $update_passsword = array(
                            'password'          => encreptIt($password),
                            'activation_code'   => ''
                        );

                        $this->user_model->update_table($update_passsword, array('id' => $user_data->id));

                        $this->session->set_flashdata('success', 'Password changed successfully.');
                        redirect(base_url());
                    } else {
                        $this->session->set_flashdata('error', 'Password and Confirm password does not match.');
                    }
                }

                $data   = array('token' => $token);
                $this->template->view('front/auth/reset_password', $data);
            } else {
                $this->session->set_flashdata('error', 'Invalid token.');
                redirect(base_url());
            }
        } else {
            redirect(base_url());
        }
    }

    function validate_password($password) {

        $return = TRUE;
        if(!preg_match('/^(?=.*[A-Za-z])(?=.*\d).{6,}$/', $password)) {
            $return = FALSE;
        }

        return $return;
    }

    public function logout() {
        $this->removeUserSession();
        redirect(base_url());
    }

    public function validate_email() {
        $email   = $this->input->post('email');
        $filter  = array();

        if (isset($email) && ($email != "")) {
            $filter['where'] = array('email' => $email);
        }

        $result = $this->user_model->get_rows($filter,1);
        $return = TRUE;

        if ($result > 0) {
            $return = FALSE;
        }
        json_output($return);
    }

    public function validate_phone() {
        $phone   = $this->input->post('mobile_no');
        $filter  = array();

        if (isset($phone) && ($phone != "")) {
            $filter['where'] = array('phone' => $phone);
        }

        $result = $this->user_model->get_rows($filter,1);
        $return = TRUE;

        if ($result > 0) {
            $return = FALSE;
        }
        json_output($return);
    }

    public function user_verify($token = '') {
        if ($token != '') {
            $filters['where']   = array('activation_code' => $token);
            $filters['row']     = 1;
            $user_data          = $this->user_model->get_rows($filters);
            if (! empty($user_data)) {
                $update_passsword = array(
                                        'activation_code' => '',
                                        'is_active' => 1,
                                    );
                $data['user_data'] = $user_data;
                $this->user_model->update_table($update_passsword, array('id' => $user_data->id));
                $this->template->view('front/auth/thank_you', $data);
            } else {
                $this->session->set_flashdata('error', 'Invalid token.');
                redirect(base_url());
            }
        } else {
            $this->session->set_flashdata('error', 'Invalid token.');
            redirect(base_url());
        }
    }
}