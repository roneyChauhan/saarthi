<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Route extends MY_Controller {

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
                                    '0' => 'from_location',
                                    '1' => 'to_location',
                                    '2' => 'kilometer',
                                    '3' => 'is_active',
                                    '4' => 'created_date'
                                    );
                $filterCount    = $totalCount = $this->route_model->get_rows(array(), true);

                $filter['select']   = array('bharat_route.*','bc_form.city_name as from_city','bc_to.city_name as to_city');
                $filter["join"]     = array(
                                        "0" => array('table' => 'bharat_cities as bc_form', 'condition' => "bc_form.id = bharat_route.from_location", "type" => "left"),
                                        "1" => array('table' => 'bharat_cities as bc_to', 'condition' => "bc_to.id = bharat_route.to_location", "type" => "left")
                                    );
                if (isset($search) && ($search['value'] != '')) {
                    $searchString       = $search['value'];
//                    $filter['like']     = array('field' => 'bharat_route.from_location', 'value' => $searchString);
                    $filter['or_like']  = array(
                        '0' => array('field' => "DATE_FORMAT(bharat_route.created_date, '%M %d, %Y')", 'value' => $searchString)
                    );
                    $filterCount    = $this->route_model->get_rows($filter, true);
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
                $query              = $this->route_model->get_rows($filter);
                $admin              = array();
                foreach ($query as $row) {
                    $checked                    = ($row->is_active == 1) ? 'checked' : '';
                    $row_data                   = array();
                    $row_data['id']             = $row->id;
                    $row_data['route']          = $row->from_city . ' - ' . $row->to_city;
                    $row_data['kilometer']      = $row->kilometer;
                    $row_data['created_date']   = showDate($row->created_date);
                    $row_data['change_status']  = '<input type="checkbox" data-switchery '. $checked .' data-id='.encryptIt($row->id).' data-page="route" class="change_status" />';
                    $row_data['action']         = '<div class="md-btn-group" data-id="'.encryptIt($row->id).'">
                                                        <a href="'.admin_url().'route/setup/'.encryptIt($row->id).'" class="btn btn-sm btn-primary mr-1" title="Edit Route">Edit</a>
                                                        <a href="javascript:void(0)" class="delete-route btn btn-sm btn-icon btn-danger mr-1" title="Delete Route">Delete</a>
                                                    </div> ';
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
            $data['breadcrumbs']['page_title']  = "Manage Route";
            $data['breadcrumbs']['data']        = array(
                                                    array('name' => 'Manage Route', 'link' => admin_url().'route')
                                                );
            $this->template->view('admin/route/index', $data);
        } else {
            redirect(admin_url());
        }
    }
    public function setup($route = ""){
        if ($this->is_logined) {
            $data['breadcrumbs']['page_title']  = "Add Route";
            $data['breadcrumbs']['data']        = array(
                                                    array('name' => 'Manage Route', 'link' => admin_url().'route')
                                                );
            if ($route != '') {
                $route_date = $this->route_model->get_route(decryptIt($route));
                if (!empty($route_date)) {
                    $route_date->id  = encryptIt($route_date->id);
                    $data['route']   = $route_date;
                }
            }

            $data['css_files']   = array(
                                    'select2.min.css',
                                    'select2-bootstrap4.min.css'
                                );
            $data['js_files']   = array(
                                    'select2.full.js',
                                    'moment.min.js',
                                    'jquery.inputmask.bundle.min.js'
                                );
            $this->template->view('admin/route/form', $data);
        } else {
            redirect(admin_url());
        }
    }

    public function get_route() {
        if ($this->is_logined) {
            $return     = array();
            $id         = $this->input->post('id');
            $view_data  = array();
            if ($id != '') {
                $user = $this->route_model->get_route(decryptIt($id));
                if (!empty($user)) {
                    $user->id               = encryptIt($user->id);
                    $view_data['route']     = $user;
                    $return['modal_form']   = $this->load->view("admin/route/form_modal", $view_data, true);
                    $return['status']       = true;
                } else {
                    $return['status'] = false;
                }
            } else {
                $return['modal_form']   = $this->load->view("admin/route/form_modal", $view_data, true);
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

            $this->form_validation->set_rules('from_location', 'From location', 'required|trim');
            $this->form_validation->set_rules('to_location', 'To location', 'required|trim');
            $this->form_validation->set_rules('kilometer', 'kilometer', 'required|trim');
            if ($this->form_validation->run() == true) {
                $route_id               = $this->input->post('route_id');
                $data['from_location']  = $this->input->post('from_location');
                $data['to_location']    = $this->input->post('to_location');
                $from_city_state        = $this->cities_model->get_city_state_name($data['from_location']);
                $to_city_state          = $this->cities_model->get_city_state_name($data['to_location']);
                if(!empty($from_city_state)) {
                    $data['from_city']  = $from_city_state['city_name'];
                    $data['from_state'] = $from_city_state['state_name'];
                }
                if(!empty($to_city_state)) {
                    $data['to_city']    = $to_city_state['city_name'];
                    $data['to_state']   = $to_city_state['state_name'];
                }
                $data['kilometer']      = $this->input->post('kilometer');
                $data['is_active']      = $this->input->post('is_active') == 'on' ? 1 : 0;

                if ($route_id != '') {
                    $this->route_model->update_table($data, array('id' => decryptIt($route_id)));

                    $return['status']   = true;
                    $return['message']  = "Route saved successfully.";
                } else {
                    $data['created_date']   = date('Y-m-d H:i:s');
                    $id                     = $this->route_model->insert($data);
                    if ($id > 0) {
                        $return['status']   = true;
                        $return['message']  = "Route saved successfully.";
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
            $user               = $this->route_model->get_rows($uFilter, true);

            if ($user > 0) {
                $this->route_model->delete($uFilter['where']);   
                $this->sub_category_model->delete(array('category' => $decrypt_id));   

                $return['status']   = true;
                $return['message']  = 'Route deleted successfully';
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
                    $item                   = $this->route_model->get_rows($filter);

                    if (!empty($item)) {
                        $update_data['is_active']   = 0;
                        if ($item->is_active == 0) {
                            $update_data['is_active']   = 1;
                        }

                        $this->route_model->update_table($update_data, $filter['where']);

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
        $name       = $this->input->post('name');
        $id         = $this->input->post('id');
        $filter     = array();

        if (isset($name) && ($name != "")) {
            if (isset($id) && ($id != "")) {
                $filter['where'] = array('id !=' => decryptIt($id), 'name' => $name);
            } else {
                $filter['where'] = array('name' => $name);
            }
        }

        $result = $this->route_model->get_rows($filter,1);
        $return = TRUE;

        if ($result > 0) {
            $return = FALSE;
        }
        json_output($return);
    }

    public function check_unique($name) {
        $route_id    = $this->input->post('route_id');

        if (isset($name) && ($name != "")) {
            if ($route_id != "") {
                $filter['where'] = array('id !=' => decryptIt($route_id), "name" => $name);
            } else {
                $filter['where'] = array("name" => $name);
            }
        }

        $result = $this->route_model->get_rows($filter,1);

        if ($result > 0) {
            $this->form_validation->set_message('check_unique', 'Route name already exist');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function get_location() {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data       = array();
            $searchTerm = $this->input->post('searchTerm');
            if($searchTerm != "") {
                $filter["select"]   = array("bharat_cities.*", "bs.state");
                $filter["like"]     = array('field' => 'bharat_cities.city_name', 'value' => $searchTerm);
                $filter["join"]     = array(
                                        "0" => array('table' => 'bharat_state as bs', 'condition' => "bs.id = bharat_cities.state_code", "type" => "left")
                                    );
                $filter["where"]    = array('bs.status' => 1);
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
}
?>