<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Setting extends MY_Controller {

    var $is_logined = FALSE;

    public function __construct() {
        parent::__construct();
        $this->is_logined   = $this->get_admin_user();
        $this->loginUser    = $this->getLoginUser();
        
        check_admin_login();
    }

    public function ticket() {

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $this->form_validation->set_rules('child_price', 'Children Price', 'trim|required');
            $this->form_validation->set_rules('adult_price', 'Adult Price', 'trim|required');

            if ($this->form_validation->run() == TRUE) {
                $data['child_price']= formatePrice($this->input->post('child_price'));
                $data['adult_price']= formatePrice($this->input->post('adult_price'));
                $data['notes']      = $this->input->post('notes');
                $service_fees       = formatePrice($this->input->post('service_fees'));
                if ($service_fees != '') {
                    $data['service_fees'] = $service_fees;
                }
                
                $filter['where']= array('id' => 1);
                $count          = $this->ticket_setting_model->get_rows($filter, true);
                
                if ($count > 0) {
                    $this->ticket_setting_model->update_table($data, array('id' => 1));
                    $this->session->set_flashdata('success', 'Ticket setting saved successfully');
                } else {
                    $data['id'] = 1;
                    $insert_id = $this->ticket_setting_model->insert($data);

                    if ($insert_id > 0) {
                        $this->session->set_flashdata('success', 'Ticket setting saved successfully');
                    } else {
                        $this->session->set_flashdata('error', 'somthing went wrong');
                    }   
                }
            } else {
                $this->session->set_flashdata('error', 'Please fill required fields');
            }
        }

        $t_filter['where']  = array('id' => 1);
        $t_filter['row']    = 1;
        $data['ticket']     = $this->ticket_setting_model->get_rows($t_filter);

        $data['css_files']  = array(
                                'codemirror.css'
                            );

        $data['js_files']   = array(
                                'uikit_htmleditor_custom.min.js',
                                'jquery.inputmask.bundle.js'
                            );

        $this->template->view("admin/setting/ticket", $data);
    }

    public function profile() {
        if ($this->is_logined) {
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $this->form_validation->set_rules('username', 'Username', 'trim|required');
                $this->form_validation->set_rules('email', 'Email', 'trim|required');
                
                if ($this->form_validation->run() == TRUE) {
                    $data['username']   = $this->input->post('username');
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
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $email  = $this->input->post('email');
            $return = array();
            if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {

                $filter['where']= array('email' => trim($email));
                $filter['row']  = 1;
                $row            = $this->admin_model->get_rows($filter);

                if ((count($row) > 0)) {

                    $updateData                     = array();
                    $updateData['activation_code']  = md5($row->id);

                    $this->admin_model->update_table($updateData, array('email' => trim($email)));

                    $link = base_url().'admin/reset-password/'.md5($row->id);
                    
                    $viewData['email']          = $row->email;
                    $viewData['username']       = $row->username;
                    $viewData['activation_code']= $link;

                    $sent_data['subject']       = "Password Reset | STAFFT";
                    $sent_data['email']         = $row->email;
                    $sent_data['message']       = $this->load->view('admin/admin/forgotPass', $viewData, true);
                    $this->sentMail($sent_data);

                    $return['status']   = true;
                    $return['message']  = 'You will get password reset link through your email';
                } else {
                    $return['status']   = false;
                    $return['message']  = 'Somthing went wrong';
                }
            } else {
                $return['status']   = false;
                $return['message']  = 'Please enter valid email address';
            }
            echo json_encode($return);die;
        }
        $this->template->view("admin/forgot_password");
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

                $data               = array();
                $this->template->view('admin/reset_password', $data);
            } else {
                $this->session->set_flashdata('error', 'Invalid token.');
                redirect(base_url());
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
                                    '2' => 'password',
                                    '3' => 'created_date',
                                    '4' => 'is_active'
                                    );
                $filterCount    = $totalCount = $this->admin_model->get_rows(array(), true);
                
                if (isset($search) && ($search['value'] != '')) {
                    $searchString       = $search['value'];
                    $filter['like']     = array('field' => 'angel_admin.username', 'value' => $searchString);
                    $filter['or_like']  = array(
                        '0' => array('field' => 'angel_admin.email', 'value' => $searchString),
                        '1' => array('field' => 'angel_admin.visiblePassword', 'value' => $searchString),
                        '2' => array('field' => 'angel_admin.created_date', 'value' => str_replace("/", "-", $searchString))
                    );
                    $filterCount    = $this->admin_model->get_rows($filter, true);
                }
                $filter['where']    = array('id !=' => $this->loginUser['id']);
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
                    $status                 = '<input type="checkbox" '.$checked.' data-switchery class="change_status" data-id="'.encryptIt($row->id).'"/>';

                    $row_data               = array();
                    $row_data['id']         = $row->id;
                    $row_data['username']   = $row->username;
                    $row_data['email']      = $row->email;
                    $row_data['created_date']= showDate($row->created_date);
                    $row_data['is_active']  = $row->is_active;
                    $row_data['status']     = $status;

                    $row_data['action'] = '
                            <div class="md-btn-group">
                                <a href="'.base_url().'admin/admin-users/setup/'.encryptIt($row->id).'" class="md-btn md-btn-small md-btn-primary md-btn-wave waves-effect waves-button">Edit</a>
                                <a href="javascript:void(0)" data-Id="'.encryptIt($row->id).'"  class="delete-user md-btn md-btn-small md-btn-danger md-btn-wave waves-effect waves-button">Delete</a>
                            </div>
                    ';

                    $admin[]                = $row_data;
                }
                $data['recordsTotal']       = $totalCount;
                $data['recordsFiltered']    = $filterCount;
                $data['data']               = $admin;

                echo json_encode($data);die();
            } else {
                $data['js_files']   = array(
                                        'jquery.dataTables.min.js',
                                        'datatables.uikit.min.js'
                                    );
                
                $this->template->view('admin/admin/index', $data);
            }
        } else {
            redirect('admin');
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
                }
            }

            $this->template->view("admin/admin/profile", $data);
        } else {
            redirect(admin_url());
        }
    }

    public function commit($id = '') {
        if ($this->is_logined) {

            $data['username']   = $this->input->post('username');
            $data['email']      = $this->input->post('email');
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
    
    public function checkStatus() {
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
    
    public function site_settings() {
        if ($this->is_logined && $this->loginUser['user_type'] == 0) {
            $data = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data['from_name']      = $this->input->post('from_name');
                $data['from_email']     = $this->input->post('from_email');
                $data['encode_user_id'] = $this->input->post('encode_user_id');
                $data['encode_user_key']= $this->input->post('encode_user_key');
                $getExistRow            = $this->sitesettings_model->get_rows();

                if (empty($getExistRow)) {
                    $insertedId = $this->sitesettings_model->insert($data);
                } else {
                    $this->sitesettings_model->update_table($data, array());
                }

                $this->session->set_flashdata('success', 'Website settings updated successfully.');
                redirect('/admin/site-settings');
            }
            $filter2['where']   = array('type' => 'live');
            $filter2['row']     = 1;
            $data['settings']   = $this->sitesettings_model->get_rows($filter2);
            $this->template->view("admin/site-settings", $data);
        } else {
            redirect('/admin');
        }
    }

    public function search_user() {
        $return = array();

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $seach      = $this->input->post('search');

            $filter['like']     = array('field' => 'email', 'value' => $seach, 'type' => 'after');
            $filter['or_like']  = array(
                                    array('field' => 'first_name', 'value' => $seach, 'type' => 'after'),
                                    array('field' => 'last_name', 'value' => $seach, 'type' => 'after')
                                );

            $users           = $this->user_model->get_rows($filter);

            if (! empty($users)) {
                $data['users']      = $users;
                $return['html']     = $this->load->view('admin/admin/search_user', $data, true);
                $return['status']   = true;
            } else {
                $return['status'] = false;
            }
        } else {
            $return['status'] = false;
        }

        echo json_encode($return);
    }
    
    public function block_user() {
        $return = array();

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $block_id      = $this->input->post('block_id');

            if ($block_id != '') {
                $filter['where']= array('md5(id)' => $block_id);
                $filter['row']  = 1;
                $users          = $this->user_model->get_rows($filter);

                if (! empty($users)) {
                    $i_data['user_id']  = $users->id;
                    $insert_id          = $this->blocked_user_model->insert($i_data);
                    if ($insert_id > 0) {
                        $return['status']   = true;
                    } else {
                        $return['status'] = false;
                    }
                } else {
                    $return['status'] = false;
                }
            } else {
                $return['status'] = false;
            }
        } else {
            $return['status'] = false;
        }

        echo json_encode($return);
    }

    public function ublock_user() {
        $return = array();

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $block_id      = $this->input->post('block_id');

            if ($block_id != '') {
                $filter['where']= array('md5(id)' => $block_id);
                $filter['row']  = 1;
                $users          = $this->user_model->get_rows($filter);

                if (! empty($users)) {
                    $i_data['user_id']  = $users->id;
                    $this->blocked_user_model->delete($i_data);
                    $return['status']   = true;
                } else {
                    $return['status'] = false;
                }
            } else {
                $return['status'] = false;
            }
        } else {
            $return['status'] = false;
        }

        echo json_encode($return);
    }
    
    public function temp() {
        return $this->template->view('admin/ticket-booking');
    }
}
?>