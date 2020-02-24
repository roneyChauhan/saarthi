<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vehicle extends MY_Controller {

    var $is_logined     = FALSE;
    var $active_menu_id = 0;

    public function __construct() {
        parent::__construct();
        $this->is_logined       = $this->get_admin_user();
        $this->loginUser        = $this->getLoginUser();
        $this->active_menu_id   = 8;
    }
    public function index() {
        if ($this->is_logined) {
            if ($this->input->server('REQUEST_METHOD') == 'POST') {

                $search         = $this->input->post('search');
                $start          = intval($this->input->post("start"));
                $length         = intval($this->input->post("length"));
                $order          = $this->input->post("order");
                $columnArray    = array(
                                    '0' => 'title',
                                    '2' => 'created_date',
                                    '3' => 'is_active'
                                    );
                $filterCount    = $totalCount = $this->vehicle_model->get_rows(array(), true);
                
                if (isset($search) && ($search['value'] != '')) {
                    $searchString       = $search['value'];
                    $filter['like']     = array('field' => 'bharat_vehicle.title', 'value' => $searchString);
                    $filterCount        = $this->vehicle_model->get_rows($filter, true);
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
                $query              = $this->vehicle_model->get_rows($filter);
                $admin              = array();

                foreach ($query as $row) {
                    $checked                = ($row->is_active == 1) ? 'checked' : '';

                    $row_data                   = array();
                    $row_data['id']             = $row->id;
                    $row_data['name']           = $row->title;
                    $row_data['created_date']   = showDate($row->created_date);
                    $row_data['is_active']      = $row->is_active;

                    $row_data['action'] = '
                            <div class="md-btn-group" data-id="'.encryptIt($row->id).'">
                                <a href="'.admin_url().'vehicle/setup/'.encryptIt($row->id).'" class="btn btn-sm btn-icon btn-primary mr-1" title="Edit Vehicle">Edit</a>
                                <a href="javascript:void(0)" class="delete-vehicle btn btn-sm btn-icon btn-danger mr-1">Delete</a>
                            </div>
                    ';

                    $admin[]                = $row_data;
                }
                $data['recordsTotal']       = $totalCount;
                $data['recordsFiltered']    = $filterCount;
                $data['data']               = $admin;

                json_output($data);
            }

            $data['js_files']   = array(
                                    'datatables.min.js',
                                );
            $data['css_files']   = array(
                                    'datatables.min.css'
                                );
            $data['active_menu']                = $this->active_menu_id;
            $data['breadcrumbs']['page_title']  = "Manage Vehicle";
            $data['breadcrumbs']['data']        = array(
                                                    array('name' => 'Manage Vehicle', 'link' => admin_url().'vehicle')
                                                );

            $this->template->view('admin/vehicle/index', $data);
        } else {
            redirect(admin_url());
        }
    }

    public function setup($id = "") {
        if ($this->is_logined) {
            $decrypt_id = 0;
            if ($id != '') {
                $decrypt_id         = decryptIt($id);
                $vehicle            = $this->vehicle_model->get_vehicle($decrypt_id);
                if (! empty($vehicle)) {
                    $data['vehicle']   = $vehicle;
                } else {
                    redirect(admin_url().'vehicle');
                }
            }

            $data['category']                   = $this->vehicle_categories_model->get_rows();
            $data['vehicle_type']               = $this->vehicle_type_model->get_rows();
            $data['active_menu']                = $this->active_menu_id;
            $data['breadcrumbs']['page_title']  = "Manage Vehicle";
            $data['breadcrumbs']['data']        = array(
                                                    array('name' => 'Manage Vehicle', 'link' => admin_url().'vehicle')
                                                );

            $this->template->view('admin/vehicle/setup', $data);
        } else {
            redirect(admin_url());
        }
    }
    
    public function get_vehicle() {
        if ($this->is_logined) {
            $return     = array();
            $id         = $this->input->post('id');
            $view_data  = array();
            if ($id != '') {
                $vehicle = $this->vehicle_model->get_vehicle(decryptIt($id));
                if (!empty($vehicle)) {
                    $vehicle->id               = encryptIt($vehicle->id);
                    $view_data['vehicle']      = $vehicle;
                    $return['modal_form']   = $this->load->view("admin/vehicle/form_modal", $view_data, true);
                    $return['status']       = true;
                } else {
                    $return['status'] = false;
                }
            } else {
                $return['modal_form']   = $this->load->view("admin/vehicle/form_modal", $view_data, true);
                $return['status']       = true;
            }

            json_output($return);
        } else {
            redirect(admin_url());
        }
    }

    public function commit() {
        if ($this->is_logined && ($this->input->server('REQUEST_METHOD') == 'POST')) {
            $vehicle_id    = $this->input->post('vehicle_id');
            $this->form_validation->set_rules('title', 'Vehicle name', 'required|trim|callback_check_unique');
            $this->form_validation->set_rules('overview', 'Overview', 'required');
            $this->form_validation->set_rules('category', 'Category', 'required|trim|numeric');
            $this->form_validation->set_rules('vehicle_type', 'Vehicle Type', 'required|trim|numeric');

            $status = true;
            if ($this->form_validation->run() == true) {
                $data                       = array();
                $data['title']              = $this->input->post('title');
                $data['category']           = $this->input->post('category');
                $data['type']               = $this->input->post('vehicle_type');
                $data['overview']           = $_POST['overview'];
//                $data['min_hours']          = $this->input->post('min_hours');
//                $data['local_km']           = $this->input->post('local_km');
//                $data['hours_price']        = $this->input->post('hours_price');
                $data['min_day']            = $this->input->post('min_day');
                $data['outstation_km']      = $this->input->post('outstation_km');
                $data['outstation_price']   = $this->input->post('outstation_price');
                $data['seating_capacity']   = $this->input->post('seating_capacity');
                $data['is_feature']         = $this->input->post('is_feature') == 'on' ? 1 : 0;
                $data['is_active']          = $this->input->post('is_active') == 'on' ? 1 : 0;
                $decrypt_id                 = 0;
                if (! empty($data)) {
                    if ($vehicle_id != '') {
                        $decrypt_id = decryptIt($vehicle_id);
                        $this->vehicle_model->update_table($data, array('id' => $decrypt_id));
                        $this->session->set_flashdata('success', "Vehicle details saved successfully");
                    } else {
                        $data['created_date']   = date('Y-m-d H:i:s');
                        $decrypt_id             = $this->vehicle_model->insert($data);
                        if ($decrypt_id > 0) {
                            $vehicle_id = encryptIt($decrypt_id);
                            $this->session->set_flashdata('success', "Vehicle details saved successfully");
                        } else {
                            $this->session->set_flashdata('error', "Something went wrong");
                        }
                    }
                } else {
                    $status = false;
                    $this->session->set_flashdata('error', "Something went wrong");
                    redirect(admin_url().'vehicle');
                }

                if ($decrypt_id > 0 ) {
                    $ajax_vehicle_photo   = $this->input->post('ajax_vehicle_photo');
                    if  (!empty($ajax_vehicle_photo)) {
                        $vehicle_photo_data = array();
                        foreach ($ajax_vehicle_photo as $vehicle_photo_name){
                            if ($vehicle_photo_name != "") {
                                $vehicle_photo_name = decryptIt($vehicle_photo_name);
                                $source_file        = getcwd() . '/uploads/temp_uploads/'.  $vehicle_photo_name;
                                $upload_path_file   = getcwd() . '/uploads/vehicle_photos/' . md5($decrypt_id).'/vehicle_photo/';
                                $file_path          = '/uploads/vehicle_photos/' . md5($decrypt_id).'/vehicle_photo/';
                                if(file_exists($source_file)) {
                                    if (!is_dir($upload_path_file)) {
                                        mkdir($upload_path_file, 0777, true);
                                    }
                                    rename($source_file, $upload_path_file . $vehicle_photo_name);
                                    $aData['path']      = $file_path . $vehicle_photo_name;
                                    $aData['type']      = 'image';
                                    $attachment_id      = $this->attachment_model->insert($aData);
                                    $vehicle_photo_data[] = array("vehicle_id" => $decrypt_id, 'image' => $attachment_id);
                                }
                            }
                        }
                        if(!empty($vehicle_photo_data)) {
                            $this->vehicle_image_model->insert_betch($vehicle_photo_data);
                        }
                    }
                }
            } else {
                $status = false;
                $this->session->set_flashdata('error_message', validation_errors());
            }
            if($status) {
                redirect(admin_url().'vehicle');
            } else {
                if ($vehicle_id != '') {
                    redirect(admin_url().'vehicle/setup/'.$vehicle_id);
                } else {
                    redirect(admin_url().'vehicle/setup/');
                }
            }
        }
    }

    public function delete() {
        if ($this->is_logined) {
            $id                 = $this->input->post('id');
            $decrypt_id         = decryptIt($id);
            $uFilter['where']   = array('id' => $decrypt_id);
            $uFilter['row']     = 1;
            $user               = $this->vehicle_model->get_rows($uFilter, true);

            if ($user > 0) {

                $this->vehicle_model->delete($uFilter['where']);                

                $return['status']   = true;
                $return['message']  = 'Vehicle deleted successfully';
            } else {
                $return['status']   = false;
                $return['message']  = 'Somthing went wrong';
            }
            echo json_encode($return);die;
        } else {
            redirect(admin_url());
        }
    } 
    
    public function get_name() {
        if ($this->is_logined) {
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $return['status']   = FALSE;
                $name               = $this->input->post('name');
                if ($name != '') {
                    $filter['select']   = array('name');
                    $filter['like']     = array('field' => 'name', 'value' => $name);
                    $filter['limit']    = array('limit' => 5, 'from' => 0);
                    $filter['orderby']  = array('field' => 'name', 'order' => 'ASC');
                    $filter['result']   = 1;
                    $vehicles              = $this->vehicle_model->get_rows($filter);
                    if (!empty($vehicles)) {
                        $data                   = array('result_array' => $vehicles);
                        $return['status']       = TRUE;
                        $return['html']         = $this->load->view('admin/partial/custom_typeahead_html', $data, true);
                    }
                }
                json_output($return);
            } else {
                redirect(admin_url());
            }
        } else {
            redirect(admin_url());
        }
    }

    public function check_unique($name) {
        $vehicle_id    = $this->input->post('vehicle_id');
        $filter     = array();
        if (isset($name) && ($name != "")) {
            if ($vehicle_id != "") {
                $filter['where'] = array('id !=' => decryptIt($vehicle_id), "title" => trim($name));
            } else {
                $filter['where'] = array("title" => trim($name));
            }
        }
        $result = $this->vehicle_model->get_rows($filter,1);

        if ($result > 0) {
            $this->form_validation->set_message('check_unique', 'Vehicle name already exist');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function validate() {
        $title  = $this->input->post('title');
        $id     = $this->input->post('id');
        $filter = array();

        if (isset($title) && ($title != "")) {
            if (isset($id) && ($id != "")) {
                $filter['where'] = array('id !=' => decryptIt($id), 'title' => $title);
            } else {
                $filter['where'] = array('title' => $title);
            }
        }

        $result = $this->vehicle_model->get_rows($filter,1);
        $return = TRUE;

        if ($result > 0) {
            $return = FALSE;
        }
        json_output($return);
    }

    public function upload_vehicle_photo() {
        if ($this->is_logined) {
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $return         = array();
                $status         = false;
                $uploade_files  = array();
                if (isset($_FILES['vehicle_photo']['name']) && !empty($_FILES['vehicle_photo']['name'])) {
                    $files          = $_FILES['vehicle_photo'];
                    $filesCount     = count($_FILES['vehicle_photo']['name']);
                    if ($filesCount > 0) {
                        for ($i = 0; $i < $filesCount; $i++) {
                            $_FILES = array();
                            $_FILES['vehicle_photo']['name']     = time()."_".$files['name'][$i];
                            $_FILES['vehicle_photo']['type']     = $files['type'][$i];
                            $_FILES['vehicle_photo']['tmp_name'] = $files['tmp_name'][$i];
                            $_FILES['vehicle_photo']['error']    = $files['error'][$i];
                            $_FILES['vehicle_photo']['size']     = $files['size'][$i];

                            $upload_path_file   = '/uploads/temp_uploads/';
                            $uploadPath         = getcwd().'/'.$upload_path_file;
                            if (!is_dir($uploadPath)) {
                                mkdir($uploadPath, 0777, true);
                            }

                            $this->load->library('upload');
                            $config                     = array();
                            $config['upload_path']      = $uploadPath;
                            $config['allowed_types']    = '*';
                            $config['overwrite']        = TRUE;

                            $this->upload->initialize($config, true);
                            if ($this->upload->do_upload('vehicle_photo')) {
                                $fileData           = $this->upload->data();
//                                compress_png($fileData['full_path'], $fileData['full_path'], 60);
                                $uploade_files[]    = $fileData['file_name'];
                            }
                        }
                    }
                }
                $html   = "";
                if (!empty($uploade_files)) {
                    $status = true;
                    $data['selected_files'] = $uploade_files;
                    $html                   = $this->load->view('admin/vehicle/ajax_select_index_files', $data, true);
                }
                $return['status']           = $status;
                $return['html']             = $html;

                json_output($return);
            } else {
                redirect(admin_url());
            }
        } else {
            redirect(admin_url());
        }
    }
    public function remove_vehicle_photo() {
        if ($this->is_logined) {
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $return     = array();
                $status     = false;
                $type       = $this->input->post('type');
                $image_name = $this->input->post('image_name');
                if ($type == "exist") {
                    $image_id           = decreptIt($image_name);
                    $filter['where']    = array("image" => $image_id);
                    $filter['row']      = 1;
                    $image_exist        = $this->vehicle_image_model->get_rows($filter);
                    if (!empty($image_exist)) {
                        $this->attachment_model->remove($image_exist->image);
                        $this->vehicle_image_model->delete(array("image" => $image_id));
                        $status = true;
                    }
                } else if ($type == "ajax") {
                    $book       = decryptIt($image_name);
                    $bookPath   = getcwd().'/uploads/temp_uploads/'.$book;
                    if (file_exists($bookPath) && !is_dir($bookPath)) {
                        unlink($bookPath);
                    }
                    $status = true;
                }

                $return['status'] = $status;
                json_output($return);
            } else {
                redirect(admin_url());
            }
        } else {
            redirect(admin_url());
        }
    }
}
?>