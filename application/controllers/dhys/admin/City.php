<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class City extends MY_Controller {

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
                                    '0' => 'city_name',
                                    '1' => 'status'
                                    );
                $filterCount    = $totalCount = $this->cities_model->get_rows(array(), true);

                $filter['select']   = array('bharat_cities.*','s.state as state_name');
                $filter["join"]     = array(
                                        array('table' => 'bharat_state as s', 'condition' => "s.id = bharat_cities.state_code", "type" => "left"),
                                    );
                if (isset($search) && ($search['value'] != '')) {
                    $searchString       = $search['value'];
                    $filter['like']     = array('field' => 'bharat_cities.city_name', 'value' => $searchString);
                    $filter['or_like']  = array(
                                            array('field' => 's.state', 'value' => $searchString)
                                        );
                    $filterCount        = $this->cities_model->get_rows($filter, true);
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
                $query              = $this->cities_model->get_rows($filter);
                $admin              = array();

                foreach ($query as $row) {
                    $checked                = ($row->status == 1) ? 'checked' : '';

                    $row_data               = array();
                    $row_data['id']         = $row->id;
                    $row_data['name']       = $row->city_name;
                    $row_data['state_name'] = $row->state_name;
                    $row_data['status']     = '<input type="checkbox" data-switchery '. $checked .' data-id='.encryptIt($row->id).' data-page="city" class="change_status" />';
                    $row_data['action']     = '<div class="md-btn-group" data-id="'.encryptIt($row->id).'">
                                                <a href="'.admin_url().'city/setup/'.encryptIt($row->id).'" class="btn btn-sm btn-primary mr-1" title="Edit City">Edit</a>
                                                <a href="javascript:void(0)" class="delete-city btn btn-sm btn-icon btn-danger mr-1">Delete</a>
                                            </div> ';
                    $admin[]                = $row_data;
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
            $data['breadcrumbs']['page_title']  = "Manage city";
            $data['breadcrumbs']['data']        = array(
                                                    array('name' => 'Manage City', 'link' => admin_url().'city')
                                                );

            $this->template->view('admin/city/index', $data);
        } else {
            redirect(admin_url());
        }
    }
    public function setup($city = ""){
        if ($this->is_logined) {
            $data['breadcrumbs']['page_title']  = "Add City";
            $data['breadcrumbs']['data']        = array(
                                                    array('name' => 'Manage City', 'link' => admin_url().'city')
                                                );
            $data['state']   = $this->state_model->get_rows();
            if ($city != '') {
                $city_date = $this->cities_model->get_city(decryptIt($city));
                if (!empty($city_date)) {
                    $city_date->id  = encryptIt($city_date->id);
                    $data['city']   = $city_date;
                }
            }
            $this->template->view('admin/city/form', $data);
        } else {
            redirect(admin_url());
        }
    }

    public function get_city() {
        if ($this->is_logined) {
            $return     = array();
            $id         = $this->input->post('id');
            $view_data  = array();
            if ($id != '') {
                $user = $this->cities_model->get_city(decryptIt($id));
                if (!empty($user)) {
                    $user->id               = encryptIt($user->id);
                    $view_data['city']     = $user;
                    $return['modal_form']   = $this->load->view("admin/city/form_modal", $view_data, true);
                    $return['status']       = true;
                } else {
                    $return['status'] = false;
                }
            } else {
                $return['modal_form']   = $this->load->view("admin/city/form_modal", $view_data, true);
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

            $this->form_validation->set_rules('city_name', 'Name', 'required|trim|callback_check_unique');
            $this->form_validation->set_rules('state', 'state', 'required|trim');

            if ($this->form_validation->run() == true) {
                $city_id            = $this->input->post('city_id');
                $data['city_name']  = $this->input->post('city_name');
                $data['state_code'] = $this->input->post('state');
                $data['status']     = $this->input->post('status') == 'on' ? 1 : 0;

                if ($city_id != '') {
                    $this->cities_model->update_table($data, array('id' => decryptIt($city_id)));

                    $return['status']   = true;
                    $return['message']  = "City saved successfully.";
                } else {
                    $id = $this->cities_model->insert($data);
                    if ($id > 0) {
                        $return['status']   = true;
                        $return['message']  = "City saved successfully.";
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
            $user               = $this->cities_model->get_rows($uFilter, true);

            if ($user > 0) {
                $this->cities_model->delete($uFilter['where']);
                $return['status']   = true;
                $return['message']  = 'City deleted successfully';
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
                    $filter['where']        = array('id' => decryptIt($id));
                    $filter['row']          = 1;
                    $item                   = $this->cities_model->get_rows($filter);
                    if (!empty($item)) {
                        $update_data['status']   = 0;
                        if ($item->status == 0) {
                            $update_data['status']   = 1;
                        }
                        $this->cities_model->update_table($update_data, $filter['where']);

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

        $result = $this->cities_model->get_rows($filter,1);
        $return = TRUE;

        if ($result > 0) {
            $return = FALSE;
        }
        json_output($return);
    }

    public function check_unique($name) {
        $city_id    = $this->input->post('city_id');
        $filter     = array();
        if (isset($name) && ($name != "")) {
            if ($city_id != "") {
                $filter['where'] = array('id !=' => decryptIt($city_id), "city_name" => $name);
            } else {
                $filter['where'] = array("city_name" => $name);
            }
        }

        $result = $this->cities_model->get_rows($filter,1);

        if ($result > 0) {
            $this->form_validation->set_message('check_unique', 'City name already exist');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
?>