<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category extends MY_Controller {

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
                                    '0' => 'name',
                                    '1' => 'driver_price',
                                    '1' => 'created_date',
                                    '2' => 'is_active'
                                    );
                $filterCount    = $totalCount = $this->vehicle_categories_model->get_rows(array(), true);
                
                if (isset($search) && ($search['value'] != '')) {
                    $searchString       = $search['value'];
                    $filter['like']     = array('field' => 'bharat_vehicle_categories.name', 'value' => $searchString);
                    $filter['or_like']  = array(
                        '0' => array('field' => "DATE_FORMAT(bharat_vehicle_categories.created_date, '%M %d, %Y')", 'value' => $searchString)
                    );
                    $filterCount        = $this->vehicle_categories_model->get_rows($filter, true);
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
                $query              = $this->vehicle_categories_model->get_rows($filter);
                $admin              = array();

                foreach ($query as $row) {
                    $checked                    = ($row->is_active == 1) ? 'checked' : '';
                    $row_data                   = array();
                    $row_data['id']             = $row->id;
                    $row_data['name']           = $row->name;
                    $row_data['driver_price']   = $row->driver_price;
                    $row_data['created_date']   = showDate($row->created_date);
                    $row_data['change_status']  = '<input type="checkbox" data-switchery '. $checked .' data-id='.encryptIt($row->id).' data-page="category" class="change_status" />';
                    $row_data['is_active']      = $row->is_active;

                    $row_data['action'] = '
                            <div class="md-btn-group" data-id="'.encryptIt($row->id).'">
                                <a href="'.admin_url().'category/setup/'.encryptIt($row->id).'" class="btn btn-sm btn-primary mr-1" title="Edit Category">Edit</a>
                                <a href="javascript:void(0)" class="delete-category btn btn-sm btn-icon btn-danger mr-1" title="Delete Category">Delete</a>
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
            $data['breadcrumbs']['page_title']  = "Manage Category";
            $data['breadcrumbs']['data']        = array(
                                                    array('name' => 'Manage Category', 'link' => admin_url().'category')
                                                );
            $this->template->view('admin/category/index', $data);
        } else {
            redirect(admin_url());
        }
    }
    public function setup($category = ""){
        if ($this->is_logined) {
            $data['breadcrumbs']['page_title']  = "Add Category";
            $data['breadcrumbs']['data']        = array(
                                                    array('name' => 'Manage Category', 'link' => admin_url().'category')
                                                );
            if ($category != '') {
                $category_date = $this->vehicle_categories_model->get_vehicle_categories(decryptIt($category));
                if (!empty($category_date)) {
                    $category_date->id  = encryptIt($category_date->id);
                    $data['category']   = $category_date;
                }
            }
            $data['js_files']   = array(
                                    'bootstrap-switch.min.js'
                                );
            $this->template->view('admin/category/form', $data);
        } else {
            redirect(admin_url());
        }
    }

    public function get_category() {
        if ($this->is_logined) {
            $return     = array();
            $id         = $this->input->post('id');
            $view_data  = array();
            if ($id != '') {
                $user = $this->vehicle_categories_model->get_category(decryptIt($id));
                if (!empty($user)) {
                    $user->id               = encryptIt($user->id);
                    $view_data['category']  = $user;
                    $return['modal_form']   = $this->load->view("admin/category/form_modal", $view_data, true);
                    $return['status']       = true;
                } else {
                    $return['status'] = false;
                }
            } else {
                $return['modal_form']   = $this->load->view("admin/category/form_modal", $view_data, true);
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

            $this->form_validation->set_rules('name', 'Name', 'required|trim|callback_check_unique');

            if ($this->form_validation->run() == true) {
                $category_id            = $this->input->post('category_id');
                $data['name']           = $this->input->post('name');
                $data['driver_price']   = $this->input->post('driver_price');
                $data['is_active']      = $this->input->post('is_active') == 'on' ? 1 : 0;

                if ($category_id != '') {
                    $this->vehicle_categories_model->update_table($data, array('id' => decryptIt($category_id)));

                    $return['status']   = true;
                    $return['message']  = "Category saved successfully.";
                } else {
                    $data['created_date']   = date('Y-m-d H:i:s');
                    $id                     = $this->vehicle_categories_model->insert($data);
                    if ($id > 0) {
                        $return['status']   = true;
                        $return['message']  = "Category saved successfully.";
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
            $user               = $this->vehicle_categories_model->get_rows($uFilter, true);

            if ($user > 0) {
                $this->vehicle_categories_model->delete($uFilter['where']);   
                $this->sub_vehicle_categories_model->delete(array('category' => $decrypt_id));   

                $return['status']   = true;
                $return['message']  = 'Category deleted successfully';
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
                    $item                   = $this->vehicle_categories_model->get_rows($filter);

                    if (!empty($item)) {
                        $update_data['is_active']   = 0;
                        if ($item->is_active == 0) {
                            $update_data['is_active']   = 1;
                        }

                        $this->vehicle_categories_model->update_table($update_data, $filter['where']);

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

        $result = $this->vehicle_categories_model->get_rows($filter,1);
        $return = TRUE;

        if ($result > 0) {
            $return = FALSE;
        }
        json_output($return);
    }

    public function check_unique($name) {
        $category_id    = $this->input->post('category_id');

        if (isset($name) && ($name != "")) {
            if ($category_id != "") {
                $filter['where'] = array('id !=' => decryptIt($category_id), "name" => $name);
            } else {
                $filter['where'] = array("name" => $name);
            }
        }

        $result = $this->vehicle_categories_model->get_rows($filter,1);

        if ($result > 0) {
            $this->form_validation->set_message('check_unique', 'Category name already exist');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
?>