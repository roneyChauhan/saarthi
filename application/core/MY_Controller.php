<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_controller extends CI_Controller {

    public $sitename = "sarthi";
    private $method  = "";

    public function __construct() {
        parent::__construct();


        $this->config->set_item('SITE_NAME', $this->sitename);
        $template       = $this->checkTemplate();
        $this->metod    = $this->router->fetch_method();
        if ($template == 'admin') {
            $this->config->set_item('ADMIN_URL', base_url() . 'admin/');
            $this->template->set_template('admin/template');
        } else if($template == 'portal') {
            $this->config->set_item('PORTAL_URL', base_url() . 'portal/');
            $this->template->set_template('portal/template');
        }
        $this->defineGlobal();
    }

    public function defineGlobal() {

        $filter['where']= array('is_active' => '1');
        $filter['row']  = 2;
        $result         = $this->sitesettings_model->get_rows($filter);
        if (!empty($result)) {
            foreach ($result as $key => $value) {   
                $this->config->set_item(strtoupper($key), $value);
            }
        }
    }

    public function checkTemplate() {
        $current_url    = explode('/', base_url(uri_string()));
        $template       = 'front';
        if (in_array('admin', $current_url)) {
            $template   = 'admin';
        } else if (in_array('portal', $current_url)){
            $template   = 'portal';
        }
        return $template;
    }
    
    public function setSession($data) {

        $oldData = $this->getSession();
        $sessionData = $data;
        if (!empty($oldData)) {
            $sessionData = array_merge($oldData, $data);
        }

        $this->session->set_userdata($this->sitename, $sessionData);
    }

    public function getSession($data = array()) {
        if (empty($data)) {
            return isset($this->session->userdata[$this->sitename]) ? $this->session->userdata[$this->sitename] : array();
        } else {
            return isset($this->session->userdata[$this->sitename][$data]) ? $this->session->userdata[$this->sitename][$data] : array();
        }
    }

    public function removeSession($data = array()) {
        $this->load->library('session');
        if (empty($data)) {
            $this->session->unset_userdata($this->sitename);
        } else {
            $sessionData = $this->getSession();
            foreach ($data as $key => $row) {
                if (is_array($row)) {
                    foreach($row as $value) {
                        unset($sessionData[$value]);
                    }
                }
                unset($sessionData[$row]);
            }
            $this->session->set_userdata($this->sitename, $sessionData);    
        }
    }

    public function getLoginUser() {
        if ($this->checkTemplate() == 'admin') {
            return $this->getAdminUserData();
        } else {
            return $this->getLoginUserData();
        }
    }

    public function getAdminUserData() {
        $user_data = array();

        if (isset($this->session->userdata[$this->sitename]['adminUser']['session_id'])) {
            $filter['select']   = array('bharat_admin.*');
            $filter['where']    = array('bharat_admin.id' => decreptIt($this->session->userdata[$this->sitename]['adminUser']['session_id']));
            $filter['groupby']  = array('field' => 'bharat_admin.id');
            $filter['row']      = 2;
            $user_data          = $this->admin_model->get_rows($filter);
        }

        return $user_data;
    }

    public function getLoginUserData() {
        $user_data = array();

        if (isset($this->session->userdata[$this->sitename]['loginUser']['session_id'])) {
            $filter['select']   = array('bharat_user.*');
            $filter['where']    = array('bharat_user.id' => decryptIt($this->session->userdata[$this->sitename]['loginUser']['session_id']));
            $filter['row']      = 2;
            $user_data          = $this->user_model->get_rows($filter);
        }

        return $user_data;
    }

    public function set_authorized_user($user = array()) {
        $this->setSession(array('loginUser' => $user));
    }

    public function get_authorized_user() {
        $return = false;
        $user   = $this->getLoginUserData();

        if (!empty($user)) {
            $return = true;
        }

        return $return;
    }
    
    public function get_admin_user() {
        return (bool) isset($this->session->userdata[$this->sitename]['adminUser']['session_id']) ? TRUE : FALSE;
    }

    public function set_admin_user($user = array()) {
        $this->setSession(array('adminUser' => $user));
    }

    public function removeAdminSession() {
        $sessionData = $this->getSession();
        foreach ($sessionData['adminUser'] as $key => $value) {
            unset($sessionData['adminUser'][$key]);
        }
        unset($sessionData['adminUser']);
        $this->session->set_userdata($this->sitename, $sessionData);
    }
    
    public function removeUserSession() {
        $sessionData = $this->getSession();
        if (isset($sessionData['loginUser'])) {
            foreach ($sessionData['loginUser'] as $key => $value) {
                if (isset($sessionData['loginUser'][$key])) {
                    unset($sessionData['loginUser'][$key]);
                }
            }
            unset($sessionData['loginUser']);
        }

        $this->session->set_userdata($this->sitename, $sessionData);
    }

    public function set_cookie_user($user = array()) {
        $user_cookie = array(
                    'name'      => $this->sitename,
                    'value'     => $user['user_value'],
                    'expire'    => $user['expire_time'],
                    );
        $this->input->set_cookie($user_cookie);
    }

    public function get_cookie_user() {
        $usercookie = $this->input->cookie($this->sitename);
        return $usercookie;
    }

    public function set_cookie($user = array()) {
        $cookie = array(
                    'name'      => $user['name'],
                    'value'     => $user['value'],
                    'expire'    => $user['expire'],
                    );
        $this->input->set_cookie($cookie);
    }

    public function get_cookie($name) {
        $cookie = $this->input->cookie($name);
        return $cookie;
    }

    public function sentMail($data) {

        $return = array();

        if (!empty($data)) {
//            $from_email         = $this->config->item('FROM_EMAIL');
//            $from_name          = $this->config->item('FROM_NAME');
            $from_email         = "noreply@saarthicab.com";
            $from_name          = "saarthicab";


            if (isset($data['from_name']) && isset($data['from_email'])) {
                $from_email = $data['from_email'];
                $from_name  = $data['from_name'];
            }
            $type       = "gmail";

            if ($type == "gmail") {
                $this->email->from($from_email, $from_name);
                $this->email->to($data['email']);
                $this->email->subject($data['subject']);
                $this->email->message($data['message']);
                $this->email->set_mailtype('html');
                if (isset($data['attachement']) && (! empty($data['attachement']))) {
                    foreach($data['attachement'] as $attachment) {
                        $this->email->attach($attachment);
                    }
                }

//                $smtp_email         = $this->config->item('SMTP_EMAIL');
//                $smtp_password      = $this->config->item('SMTP_PASSWORD');
//                $smtp_port          = $this->config->item('PORT');
//                $smtp_host          = $this->config->item('SMTP_HOST');
//                $is_ssl             = $this->config->item('IS_SSL');

                // Please specify your Mail Server - Example: mail.yourdomain.com.
                ini_set("SMTP","mail.saarthicab.com");

                // Please specify an SMTP Number 25 and 8889 are valid SMTP Ports.
                ini_set("smtp_port","25");

                // Please specify the return address to use
                ini_set('sendmail_from', 'ca.kishanchavda78@gmail.com');

                $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'smtp.gmail.com',
                'smtp_port' => '587',
                'smtp_user' => 'ca.kishanchavda78@gmail.com',
                'smtp_pass' => 'kishanmadhav58',
                'mailtype'  => 'html',
                'charset'   => 'iso-8859-1'
                );

                $this->load->library('email', $config);

                p($this->email->send());
                if ($this->email->send()) {
                    $return['status'] = true;
                    $return['message'] = "Mail sent successfully.";
                } else {
                    $return['status'] = false;
                    $return['message'] = "Something went wrong, Please try again later.";
                }
            } else if ($type == "sendgrid") {
//                $sandgrid_username = $this->config->item('SANDGRID_USERNAME');
//                $sandgrid_password = $this->config->item('SANDGRID_PASSWORD');
                $sandgrid_username = "kishan@gmail.com";
                $sandgrid_password = "123456";

                $this->email->initialize(array(
                    'protocol'  => 'smtp',
                    'smtp_host' => 'smtp.sendgrid.net',
                    'smtp_user' => $sandgrid_username, 
                    'smtp_pass' => $sandgrid_password, 
                    'smtp_port' => 587,
                    'crlf' => "\r\n",
                    'newline' => "\r\n"
                ));

                $this->email->from($from_email, $from_name);
                $this->email->to($data['email']);
                $this->email->subject($data['subject']);
                $this->email->message($data['message']);
                $this->email->set_mailtype('html');

                if (isset($data['attachement']) && (! empty($data['attachement']))) {
                    foreach($data['attachement'] as $attachment) {
                        $this->email->attach($attachment);
                    }
                }

                if ($this->email->send()) {
                    $return['status'] = true;
                    $return['message'] = "Mail sent successfully.";
                } else {
                    $return['status'] = false;
                    $return['message'] = "Something went wrong, Please try again later.";
                }
            }
        } else {
            $return['status'] = false;
            $return['message'] = "Parameters not found";
        }

        return $return;
    }

    public function dologin($data) {

        $return = array();
        if (! empty($data)) {
            $userRow        = $this->user_model->validate_user($data);
            if (! empty($userRow)) {

                if ($userRow['is_active'] == '1') {
//                    $loginData['last_login']     = date('Y-m-d H:i:s');
//                    $this->user_model->update_table($loginData, array('id' => $userRow['id']));

                    $sessionData['session_id']  = encryptIt($userRow['id']);
                    $this->set_authorized_user($sessionData);
//                    if ((isset($data['remember'])) && ($data['remember'] == "1")) {
//                        $cookie_data['user_name']    = 'usercookie';
//                        $cookie_data['user_value']   = $data['email'] . "," . $data['password'];
//                        $cookie_data['expire_time']  = 30 * 24 * 60 * 60;
//                        $this->set_cookie_user($cookie_data);
//                    }

                    $return['status']   = true;
                } else {
                    $return['status']   = false;
                    $return['message']  = "Account is not active.";
                }
            } else {
                $return['status']   = false;
                $return['message']  = "Email & password not valid";
            }
        }

        return $return;
    }
    function p($data) {
       echo "<pre>"; print_r($data); exit;
    }
}

?>