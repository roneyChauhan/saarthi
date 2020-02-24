<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends MY_Controller {

    var $is_logined = FALSE; 

    public function __construct() {
        parent::__construct();
        $this->is_logined   = $this->get_admin_user();
        $this->loginUser    = $this->getLoginUser();
    }

    public function index() {

        if (!$this->is_logined) {
            $data['js_files']   = array(
                                    'modules/login.min.js'
                                );
            $this->template->view('admin/admin/login', $data);
        } else {
            redirect(admin_url().'dashboard');
        }
    }

    public function check_login() {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $filter['where']= array('username' => trim($this->input->post('username')), 'password' => trim(md5($this->input->post('password'))));
            $filter['row']  = 2;
            $row            = $this->admin_model->get_rows($filter);
            
            if (count($row) == 0) {
                $filter['where']= array('username' => trim($this->input->post('username')), 'password' => trim(md5($this->input->post('password'))));
                $filter['row']  = 2;
                $row            = $this->admin_model->get_rows($filter);
            }
            if ((count($row) > 0)) {
                if ($row['is_active'] == 1) {
                    $session_data['session_id'] = encreptIt($row['id']);
                    $this->set_admin_user($session_data);
                    redirect(admin_url().'dashboard');
                } else {
                    $this->session->set_flashdata('error', 'Your account is not active.');
                    redirect(admin_url());
                }
            } else {
                $this->session->set_flashdata('error', 'Wrong Username or Password.');
                redirect(admin_url());
            }
        } else {
            redirect(admin_url());
        }
    }

    public function dashboard() {
        if ($this->is_logined) {
            $data['active_menu'] = 1;
            $this->template->view("admin/admin/dashboard",$data);
        } else {
            redirect(admin_url());
        }
    }

    public function dashboard_stats() {
        if ($this->is_logined && ($this->input->server('REQUEST_METHOD') == 'POST')) {
            $return = array();
            
            json_output($return);
        } else {
            redirect(admin_url());
        }
    }
    
    public function profile() {
        if ($this->is_logined) {
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
                $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|trim|callback_check_unique_email');

                if ($this->form_validation->run() == TRUE) {
                    $data['first_name'] = $this->input->post('first_name');
                    $data['last_name']  = $this->input->post('last_name');
                    $data['email']      = $this->input->post('email');
                    $password           = $this->input->post('password');
                    $cpassword          = $this->input->post('cpassword');
                    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false) {
                        $id                 = $this->loginUser['id'];

                        if ($id > 0) {
                            $filter['where']= array('id' => $id);
                            $filter['row']  = 1;
                            $query          = $this->admin_model->get_rows($filter);

                            if (!empty($query)) {
                                if ($password != '' && $cpassword != '' && $password == $cpassword) {
                                    $data['password']           = md5($password);
                                    $data['visiblePassword']   = $password;
                                }
                                $this->admin_model->update_table($data, array('id' => $query->id));

                                $filter['where']= array('id' => $id);
                                $filter['row']  = 2;
                                $row            = $this->admin_model->get_rows($filter);

                                if (!empty($row)) {
                                    $this->set_admin_user($row);
                                }

                                $this->session->set_flashdata('success', 'Profile updated successfully');
                            } else {
                                $this->session->set_flashdata('error', 'no record found');
                            }
                        } else {
                            $this->session->set_flashdata('error', 'somthing went wrong');
                        }
                    } else {
                        $this->session->set_flashdata('error', 'Please enter valid email address');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Please fill required fields');
                }
                
                redirect(admin_url().'profile');
            }
            
            $data['action_url'] = "";

            $loginUser      = $this->getLoginUser();
            $filter['where']= array('id' => $loginUser['id']);
            $filter['row']  = 1;
            $user           = $this->admin_model->get_rows($filter);
            if (!empty($user)) {
                $data['user'] = $user;

                $data['breadcrumbs']['page_title']  = "Setup Profile";
                $data['breadcrumbs']['data']        = array(
                                                        array('name' => 'Setup Profile', 'link' => 'javascript:void(0)')
                                                    );

                $this->template->view("admin/admin/profile", $data);
            } else {
                redirect(admin_url());
            }
        } else {
            redirect(admin_url());
        }
    }

    public function logout() {
        $this->removeAdminSession();
        redirect(admin_url());
    }

    public function forgot_password() {
        if (!$this->is_logined) { 
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $email  = $this->input->post('email');
                $return = array();
                if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {

                    $filter['where']= array('email' => trim($email));
                    $filter['row']  = 1;
                    $row            = $this->admin_model->get_rows($filter);
                    if ((count($row) > 0)) {

                        $updateData                     = array();
                        $updateData['activation_code']  = md5($row->email . rand());

                        $this->admin_model->update_table($updateData, array('email' => trim($email)));

                        $link                       = admin_url().'reset-password/'.$updateData['activation_code'];
                        $viewData['email']          = $row->email;
                        $viewData['username']       = $row->username;
                        $viewData['activation_code']= $link;

                        $sent_data['subject']       = "Password Reset Request";
                        $sent_data['email']         = $row->email;
                        $sent_data['message']       = $this->load->view('admin/email/forget_password', $viewData, true);
                        $return = $this->sentMail($sent_data);

                        $this->session->set_flashdata('success', 'You will get password reset link through your email');
                        redirect(admin_url());
                    } else {
                        $this->session->set_flashdata('error', 'Account not exist with given email');
                        redirect(admin_url().'forgot-password');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Please enter valid email address');
                    redirect(admin_url().'forgot-password');
                }
            }
            $this->template->view("admin/admin/forgot_password");
        } else {
            redirect(admin_url());
        }
    }
    
    public function reset_password($token = '') {
        if ($token != '') {
            $filters['where']   = array('activation_code' => $token);
            $filters['row']     = 1;
            $admin_user         = $this->admin_model->get_rows($filters);
            if (! empty($admin_user)) {
                if ($this->input->server('REQUEST_METHOD') == 'POST') {
                    $password   = $this->input->post('password');
                    $cpassword  = $this->input->post('cpassword');

                    if ($password == $cpassword) {

                        $update_passsword = array(
                            'password'          => md5($password),
                            'visiblePassword'   => $password,
                            'activation_code'   => ''
                        );

                        $this->admin_model->update_table($update_passsword, array('id' => $admin_user->id));

                        $this->session->set_flashdata('success', 'Password changed successfully.');
                        redirect(admin_url());
                    } else {
                        $this->session->set_flashdata('error', 'Password and Confirm password does not match.');
                    }
                }

                $data               = array('token' => $token);
                $this->template->view('admin/admin/reset_password', $data);
            } else {
                $this->session->set_flashdata('error', 'Invalid token.');
                redirect(admin_url());
            }
        } else {
            redirect(admin_url());
        }
    }
    
    public function users() {
        if ($this->is_logined) {
            
            if ($this->input->server('REQUEST_METHOD') == 'POST') {

                $search         = $this->input->post('search');
                $start          = intval($this->input->post("start"));
                $length         = intval($this->input->post("length"));
                $order          = $this->input->post("order");
                $columnArray    = array(
                                    '0' => 'username',
                                    '1' => 'email',
                                    '2' => 'created_date',
                                    '3' => 'is_active'
                                    );
                
                $filter['join']     = array(
                                        array('table' => 'angel_role as r', 'condition' => 'r.id = angel_admin.role', 'type' => 'LEFT')
                                    );
                $filter['groupby']  = array('field' => 'angel_admin.id');
                $filter['select']   = array('angel_admin.*', 'r.name as role_name');
                $filterCount        = $totalCount = $this->admin_model->get_rows($filter, true);

                if (isset($search) && ($search['value'] != '')) {
                    $searchString       = $search['value'];
                    $filter['like']     = array('field' => 'angel_admin.username', 'value' => $searchString);
                    $filter['or_like']  = array(
                        '0' => array('field' => 'angel_admin.email', 'value' => $searchString),
                        '1' => array('field' => 'angel_admin.visiblePassword', 'value' => $searchString),
                        '2' => array('field' => "DATE_FORMAT(angel_admin.created_date, '%M %d, %Y')", 'value' => str_replace("/", "-", $searchString))
                    );
                    $filterCount    = $this->admin_model->get_rows($filter, true);
                }
                $filter['where']    = array('angel_admin.id !=' => $this->loginUser['id']);
                $filter['limit']    = array('limit' => $length, 'from' => $start);
                $orderField         = $columnArray[0];
                $orderSort          = 'DESC';
                if (!empty($order)) {
                    if (isset($order[0]['column']) && $order[0]['column'] != '') {
                        $orderField = $columnArray[$order[0]['column']];
                        $orderSort  = $order[0]['dir'];
                    }
                }
                $filter['orderby']  = array('field' => $orderField, 'order' => $orderSort);
                $query              = $this->admin_model->get_rows($filter);
                $admin              = array();

                foreach ($query as $row) {
                    $checked                = ($row->is_active == '1') ? 'checked' : '';

                    $row_data               = array();
                    $row_data['id']         = $row->id;
                    $row_data['full_name']  = trim($row->first_name.' '.$row->last_name);
                    $row_data['username']   = $row->username;
                    $row_data['email']      = $row->email;
                    $row_data['role']       = $row->role_name;
                    $row_data['is_active']  = $row->is_active;

                    $edit_button = "";
                    if (is_allowed(admin_url().'admin-users/setup/'.encryptIt($row->id))) {
                        $edit_button = '<a href="'.admin_url().'admin-users/setup/'.encryptIt($row->id).'" class="btn btn-sm btn-icon btn-primary mr-1"><i class="ft-edit" title="Edit Admin"></i></a>';
                    }

                    $delete_button = "";
                    if (is_allowed(admin_url().'admin-users/delete')) {
                        $delete_button = '<a href="javascript:void(0)" data-Id="'.encryptIt($row->id).'"  class="delete-user btn btn-sm btn-icon btn-danger mr-1"><i class="ft-trash-2"></i></a>';
                    }
                    
                    $row_data['action'] = '
                            <div class="md-btn-group">
                                '.$edit_button.'
                                '.$delete_button.'
                            </div>
                    ';

                    $admin[]                = $row_data;
                }
                $data['recordsTotal']       = $totalCount;
                $data['recordsFiltered']    = $filterCount;
                $data['data']               = $admin;

                echo json_encode($data);die();
            } else {
                $data['active_menu']    = 2;
                $data['js_files']       = array(
                                            'datatables.min.js'
                                        );
                $data['css_files']      = array(
                                            'datatables.min.css'
                                        );

                $data['breadcrumbs']['page_title']  = "Admin Users";
                $data['breadcrumbs']['data']        = array(
                                                        array('name' => 'Admin Users', 'link' => admin_url().'admin-users')
                                                    );

                $this->template->view('admin/admin/index', $data);
            }
        } else {
            redirect(admin_url());
        }
    }

    public function setup($id = '') {
        if ($this->is_logined) {
            $data['action_url'] = admin_url().'admin/commit';
            if ($id != '') {
                $decrypt_id     = decryptIt($id);
                $filter['where']= array('id' => $decrypt_id);
                $filter['row']  = 1;
                $user           = $this->admin_model->get_rows($filter);
                if (!empty($user)) {
                    $data['user']   = $user;
                    $data['action_url'] = admin_url().'admin/commit/'.  encryptIt($user->id);
                } else {
                    redirect(admin_url().'admin-users');
                }
            }
            $data['role']                       = $this->role_model->get_rows();
            $data['active_menu']                = 2;
            $data['breadcrumbs']['page_title']  = "Admin Users";
            $data['breadcrumbs']['data']        = array(
                                                    array('name' => 'Admin Users', 'link' => admin_url().'admin-users'),
                                                    array('name' => 'Setup Users', 'link' => 'javascript:void(0)')
                                                );
            
            $data['css_files']   = array(
                                    'select2.min.css'
                                );
            $data['js_files']   = array(
                                    'select2.full.min.js'
                                );
            
            $this->template->view("admin/admin/setup", $data);
        } else {
            redirect(admin_url());
        }
    }

    public function commit($id = '') {
        if ($this->is_logined) {
            
            $this->form_validation->set_rules('username', 'Username', 'trim|required|trim|callback_check_unique_name|callback_alpha_dash_space');
            $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
            $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|trim|callback_check_unique_email');
            $this->form_validation->set_rules('role', 'Role', 'trim|numeric|required|greater_than[0]');

            if ($this->form_validation->run() == TRUE) {
                $data['first_name'] = $this->input->post('first_name');
                $data['last_name']  = $this->input->post('last_name');
                $data['email']      = $this->input->post('email');
                $data['role']       = $this->input->post('role');
                $data['is_active']  = $this->input->post('is_active') == 'on' ? '1' : '0';

                if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false) {
                    if ($id != '') {
                        $password = $this->input->post('password');
                        if ($password != "") {
                            $data['password']       = md5($password);
                            $data['visiblePassword']= $password;
                        }

                        $this->admin_model->update_table($data, array('id' => decryptIt($id)));

                        $this->session->set_flashdata('success', 'User saved successfully.');
                    } else {
                        $username               = $this->input->post('username');
                        $username               = preg_replace('/[^A-Za-z0-9\-]/', '', $username);
                        $data['username']       = strtolower(str_replace(' ', '', $username));

                        $password               = $this->input->post('password');
                        $data['password']       = md5($password);
                        $data['visiblePassword']= $password;
                        $data['created_date']   = date('Y-m-d H:i:s');

                        $id = $this->admin_model->insert($data);
                        if ($id > 0) {
                            $this->session->set_flashdata('success', 'User saved successfully.');
                        } else {
                            $this->session->set_flashdata('success', 'Something went worng, Please try again later.');
                        }
                    }
                } else {
                    $this->session->set_flashdata('error', 'Please enter valid email address');
                }
            } else {
//                p(validation_errors());
                $this->session->set_flashdata('error', 'Please fill required fields');
                $r_url = admin_url().'admin/setup';
                if ($id != "") {
                    $r_url = admin_url().'admin/setup/' . $id;
                }
                redirect($r_url);
            }

            redirect(admin_url().'admin-users');
        } else {
            redirect(admin_url());
        }
    }
    
    public function validate() {
        $username   = $this->input->post('username');
        $email      = $this->input->post('email');
        $id         = $this->input->post('id');
        $decrypt_id = 0;
        if ($id != '' && $id != 'undefined') {
            $decrypt_id = decryptIt($id);
        }
        $filter     = array();

        if (isset($username) && ($username != "")) {
            if (isset($decrypt_id) && ($decrypt_id > 0)) {
                $filter['where'] = array('id !=' => $decrypt_id, 'username' => $username);
            } else {
                $filter['where'] = array('username' => $username);
            }
        }

        if (isset($email) && ($email != "")) {
            if (isset($decrypt_id) && ($decrypt_id > 0)) {
                $filter['where'] = array('id !=' => $decrypt_id, 'email' => $email);
            } else {
                $filter['where'] = array('email' => $email);
            }
        }
        $filter['row']  = 1;
        $result         = $this->admin_model->get_rows($filter);
        $return         = TRUE;

        if (! empty($result)) {
            if ($result->id != $this->loginUser['id']) {
                $return = FALSE;
            }
        }

        echo json_encode($return);die;
    }

    public function delete() {
        if ($this->is_logined) {
            $id                 = $this->input->post('id');
            $decrypt_id         = decryptIt($id);
            $uFilter['where']   = array('id' => $decrypt_id);
            $uFilter['row']     = 1;
            $user               = $this->admin_model->get_rows($uFilter, true);

            if ($user > 0) {

                $this->admin_model->delete($uFilter['where']);                

                $return['status']   = true;
                $return['message']  = 'Admin User deleted successfully';
            } else {
                $return['status']   = false;
                $return['message']  = 'Somthing went wrong';
            }
            echo json_encode($return);die;
        } else {
            redirect(admin_url());
        }
    }

    /*
    public function changeStatus() {
        if ($this->is_logined) {
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $id     = $this->input->post('id');
                $data   = array();

                if ($id != '') {
                    $filter['where']        = array('id' => decryptIt($id));
                    $filter['row']          = 1;
                    $item                   = $this->admin_model->get_rows($filter);

                    if (!empty($item)) {
                        $update_data['is_active']   = '0';
                        if ($item->is_active == '0') {
                            $update_data['is_active']   = '1';
                        }

                        $this->admin_model->update_table($update_data, $filter['where']);

                        $data['status']   = TRUE;
                        $data['message']  = 'Change status successfully';
                    } else {
                        $data['status']   = FALSE;
                        $data['message']  = 'Somthing went wrong';
                    }
                } else {
                    $data['status']   = FALSE;
                    $data['message']  = 'Somthing went wrong';
                }

                echo json_encode($data);die;
            } else {
                redirect(admin_url());
            }
        }
    }
     * 
     */

    public function change_site_mode() {
        if ($this->is_logined) {
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $active = $this->input->post('active');
                $data   = array();

                if ($active == '1') {
                    $update_data['is_active']   = '1';
                    $this->sitesettings_model->update_table($update_data, array('site_mode' => '1'));

                    $update_data['is_active']   = '0';
                    $this->sitesettings_model->update_table($update_data, array('site_mode' => '0'));

                } else if($active == '0'){
                    $update_data['is_active']   = '1';
                    $this->sitesettings_model->update_table($update_data, array('site_mode' => '0'));

                    $update_data['is_active']   = '0';
                    $this->sitesettings_model->update_table($update_data, array('site_mode' => '1'));

                }
                $data['status']   = TRUE;
                $data['message']  = 'Change status successfully';

                echo json_encode($data);die;
            } else {
                redirect(admin_url());
            }
        }
    }
    
    public function site_settings() {
        if ($this->is_logined) {
            $data = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $setting_data['from_name']          = $this->input->post('from_name');
                $setting_data['from_email']         = $this->input->post('from_email');
                $setting_data['smtp_host']          = $this->input->post('smtp_host');
                $setting_data['smtp_email']         = $this->input->post('smtp_email');
                $setting_data['smtp_password']      = $this->input->post('smtp_password');
                $setting_data['port']               = $this->input->post('port');
                $setting_data['is_ssl']             = $this->input->post('is_ssl') == 'on' ? 1 : 0;
                $site_mode                          = $this->input->post('site_mode');
                $en_site_mode                       = decreptIt($site_mode);
                $alive_type                         = array('1', '2');
                $filter2['where']                   = array('site_mode' => $en_site_mode);
                $filter2['row']                     = 1;
                $getExistRow                        = $this->sitesettings_model->get_rows($filter2);
                if (empty($getExistRow)) {
                    $setting_data['site_mode']  = $en_site_mode;
                    $insertedId                 = $this->sitesettings_model->insert($setting_data);
                } else {
                    $this->sitesettings_model->update_table($setting_data, array('site_mode' => decreptIt($site_mode)));
                }

                $data['status']   = TRUE;
                $data['message']  = 'Website settings updated successfully.';

                json_output($data);
            }
            $settings_array     = array('local' => array(), 'live' => array());
            $filter['result']   = 1;
            $settings           = $this->sitesettings_model->get_rows($filter);
            if (!empty($settings)) {
                foreach ($settings as $row) {
                    if ( $row['site_mode'] == '0' ) {
                        $settings_array['local'] = $row;
                    } else if($row['site_mode'] == '1') {
                        $settings_array['live'] = $row;
                    }
                }
            }
            $data['active_menu']    = 19;
            $data['settings']       = $settings_array;
            $this->template->view("admin/site-settings", $data);
        } else {
            redirect(admin_url());
        }
    }

    public function check_email() {
        $email  = $this->input->post('email');
        $id     = $this->input->post('id');
        $filter = array();

        if (isset($email) && ($email != "")) {
            if (isset($id) && ($id != "")) {
                $filter['where'] = array('id !=' => decryptIt($id), 'email' => trim($email));
            } else {
                $filter['where'] = array('email' => trim($email));
            }
        }

        $result = $this->admin_model->get_rows($filter,1);
        $return = TRUE;

        if ($result > 0) {
            $return = FALSE;
        }
        json_output($return);
    }

    public function check_username() {
        $username   = $this->input->post('username');
        $id         = $this->input->post('id');
        $filter     = array();

        if (isset($username) && ($username != "")) {
            if (isset($id) && ($id != "")) {
                $filter['where'] = array('id !=' => decryptIt($id), 'username' => trim($username));
            } else {
                $filter['where'] = array('username' => trim($username));
            }
        }

        $result = $this->admin_model->get_rows($filter,1);
        $return = TRUE;

        if ($result > 0) {
            $return = FALSE;
        }
        json_output($return);
    }
    
    public function check_unique_name($name) {
        $user_id    = $this->input->post('user_id');
        $decrypt_id = decryptIt($user_id);
        if (isset($name) && ($name != "")) {
            if ($decrypt_id > 0) {
                $filter['where'] = array('id !=' => $decrypt_id, 'username' => trim($name));
            } else {
                $filter['where'] = array('username' => trim($name));
            }
        }

        $result = $this->admin_model->get_rows($filter,1);

        if ($result > 0) {
            $this->form_validation->set_message('check_unique_name', 'Author name already exist');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    function alpha_dash_space($str) {
        $this->form_validation->set_message('alpha_dash_space', 'Username must contain only letters & number. No space allowed');
        return (preg_match("/^[a-zA-Z0-9]+$/", $str) == 1) ? TRUE : FALSE;
    }

    public function check_unique_email($email) {
        $user_id    = $this->input->post('user_id');
        $decrypt_id = decryptIt($user_id);
        if (isset($email) && ($email != "")) {
            if ($decrypt_id > 0) {
                $filter['where'] = array('id !=' => $decrypt_id, 'email' => trim($email));
            } else {
                $filter['where'] = array('email' => trim($email));
            }
        }

        $result = $this->admin_model->get_rows($filter,1);

        if ($result > 0) {
            $this->form_validation->set_message('check_unique_name', 'Author name already exist');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    public function get_dashboard_data() {
        if ($this->is_logined) {

            $return['status']   = true;
            json_output($return);
        } else {
            redirect(admin_url());
        }
    }
}
?>