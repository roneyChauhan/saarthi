<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class State extends MY_Controller {

    var $is_logined = FALSE;

    public function __construct() {
        parent::__construct();
        $this->is_logined   = $this->get_admin_user();
        $this->loginUser    = $this->getLoginUser();
    }

    public function index() {
        if ($this->is_logined) {
            if ($this->input->server('REQUEST_METHOD') == 'POST') {

                $search         = $this->input->post('search');
                $start          = intval($this->input->post("start"));
                $length         = intval($this->input->post("length"));
                $order          = $this->input->post("order");
                $columnArray    = array(
                                    '0' => 'state',
                                    '1' => 'status'
                                    );
                $filterCount    = $totalCount = $this->state_model->get_rows(array(), true);
                
                if (isset($search) && ($search['value'] != '')) {
                    $searchString       = $search['value'];
                    $filter['like']     = array('field' => 'bharat_state.state', 'value' => $searchString);
                    $filterCount        = $this->state_model->get_rows($filter, true);
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
                $filter['orderby']  = array('field' => $orderField, 'order' => $orderSort);
                $query              = $this->state_model->get_rows($filter);
                $admin              = array();

                foreach ($query as $row) {
                    $checked                    = ($row->status == 1) ? 'checked' : '';

                    $row_data                   = array();
                    $row_data['id']             = $row->id;
                    $row_data['name']           = $row->state;
                    $row_data['status']         = ($row->status == 1) ? "Active" : "Deactive";
                    $row_data['change_status']  = '<input type="checkbox" data-switchery '. $checked .' data-id='.encryptIt($row->id).' data-page="state" class="change_status" />';
                    $row_data['action']         = '<div class="md-btn-group" data-id="'.encryptIt($row->id).'">
                                                    <a href="'.admin_url().'state/setup/'.encryptIt($row->id).'" class="btn btn-sm btn-primary mr-1" title="Edit State">Edit</a>
                                                        <a href="javascript:void(0)" class="delete-state btn btn-sm btn-icon btn-danger mr-1">Delete</a>
                                                    </div>';
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
            $data['active_menu']                = 11;
            $data['breadcrumbs']['page_title']  = "Manage Status";
            $data['breadcrumbs']['data']        = array(
                                                    array('name' => 'Manage State', 'link' => admin_url().'state')
                                                );

            $this->template->view('admin/state/index', $data);
        } else {
            redirect(admin_url());
        }
    }
    public function setup($state = ""){
        if ($this->is_logined) {
            $data['breadcrumbs']['page_title']  = "Add State";
            $data['breadcrumbs']['data']        = array(
                                                    array('name' => 'Manage State', 'link' => admin_url().'state')
                                                );
            if ($state != '') {
                $state_date = $this->state_model->get_state(decryptIt($state));
                if (!empty($state_date)) {
                    $state_date->id  = encryptIt($state_date->id);
                    $data['state']   = $state_date;
                }
            }
            $this->template->view('admin/state/form', $data);
        } else {
            redirect(admin_url());
        }
    }

    public function get_state() {
        if ($this->is_logined) {
            $return     = array();
            $id         = $this->input->post('id');
            $view_data  = array();
            if ($id != '') {
                $user = $this->state_model->get_state(decryptIt($id));
                if (!empty($user)) {
                    $user->id               = encryptIt($user->id);
                    $view_data['state']     = $user;
                    $return['modal_form']   = $this->load->view("admin/state/form_modal", $view_data, true);
                    $return['status']       = true;
                } else {
                    $return['status'] = false;
                }
            } else {
                $return['modal_form']   = $this->load->view("admin/state/form_modal", $view_data, true);
                $return['status']       = true;
            }

            json_output($return);
        } else {
            redirect(admin_url());
        }
    }

    public function commit() {
        if ($this->is_logined && ($this->input->server('REQUEST_METHOD') == 'POST')) {

            $return = array();

            $this->form_validation->set_rules('state', 'Name', 'required|trim|callback_check_unique');

            if ($this->form_validation->run() == true) {
                $state_id       = $this->input->post('state_id');
                $data['state']  = $this->input->post('state');
                $data['status'] = $this->input->post('status') == 'on' ? 1 : 0;

                if ($state_id != '') {
                    $this->state_model->update_table($data, array('id' => decryptIt($state_id)));

                    $return['status']   = true;
                    $return['message']  = "State saved successfully.";
                } else {
                    $id                     = $this->state_model->insert($data);
                    if ($id > 0) {
                        $return['status']   = true;
                        $return['message']  = "State saved successfully.";
                    } else {
                        $return['status']   = false;
                        $return['message']  = "Something went wrong";
                    }
                }
            } else {
                $return['status']   = FALSE;
                $return['message']  = validation_errors();
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
            $user               = $this->state_model->get_rows($uFilter, true);

            if ($user > 0) {
                $this->state_model->delete($uFilter['where']);   
                $this->sub_state_model->delete(array('state' => $decrypt_id));   

                $return['status']   = true;
                $return['message']  = 'State deleted successfully';
            } else {
                $return['status']   = false;
                $return['message']  = 'Somthing went wrong';
            }
            json_output($return);
        } else {
            redirect(admin_url());
        }
    } 

    public function changeStatus() {
        if ($this->is_logined) {
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $id     = $this->input->post('id');
                $data   = array();

                if ($id != '') {
                    $filter['where']    = array('id' => decryptIt($id));
                    $filter['row']      = 1;
                    $item               = $this->state_model->get_rows($filter);

                    if (!empty($item)) {
                        $update_data['status']   = 0;
                        if ($item->status == 0) {
                            $update_data['status']   = 1;
                        }
                        $this->state_model->update_table($update_data, $filter['where']);
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

                json_output($data);
            } else {
                redirect(admin_url());
            }
        }
    }

    public function validate() {
        $name       = $this->input->post('status');
        $id         = $this->input->post('id');
        $filter     = array();

        if (isset($name) && ($name != "")) {
            if (isset($id) && ($id != "")) {
                $filter['where'] = array('id !=' => decryptIt($id), 'status' => $name);
            } else {
                $filter['where'] = array('status' => $name);
            }
        }

        $result = $this->state_model->get_rows($filter,1);
        $return = TRUE;

        if ($result > 0) {
            $return = FALSE;
        }
        json_output($return);
    }

    public function check_unique($state) {
        $state_id    = $this->input->post('state_id');
        $filter     = array();
        if (isset($state) && ($state != "")) {
            if ($state_id != "") {
                $filter['where'] = array('id !=' => decryptIt($state_id), "state" => $state);
            } else {
                $filter['where'] = array("state" => $state);
            }
        }

        $result = $this->state_model->get_rows($filter,1);

        if ($result > 0) {
            $this->form_validation->set_message('check_unique', 'State name already exist');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
?>