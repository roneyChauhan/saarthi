<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cms extends MY_Controller {

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
                                    '0' => 'id',
                                    '1' => 'title',
                                    '2' => 'url',
                                    '3' => 'is_active',
                                    '4' => 'modify_date'
                                    );
                $filterCount    = $totalCount = $this->cms_model->get_rows(array(), true);
                
                if (isset($search) && ($search['value'] != '')) {
                    $searchString       = $search['value'];
                    $filter['like']     = array('field' => 'bharat_cms.title', 'value' => $searchString);
                    $filter['or_like']  = array(
                        '0' => array('field' => 'bharat_cms.url', 'value' => $searchString),
                        '1' => array('field' => 'bharat_cms.heading', 'value' => $searchString),
                        '2' => array('field' => "DATE_FORMAT(bharat_cms.modify_date, '%d/%m/%Y')", 'value' => $searchString)
                    );
                    $filterCount    = $this->cms_model->get_rows($filter, true);
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
                $query              = $this->cms_model->get_rows($filter);
                $admin              = array();

                foreach ($query as $row) {
                    $checked                    = ($row->is_active == 1) ? 'checked' : '';
                    $url                        = '<a href="'.base_url().'page/'.$row->url.'" target="_blank" >'.base_url(). 'page/'.$row->url.'</a>';
                    $row_data                   = array();
                    $row_data['id']             = $row->id;
                    $row_data['title']          = $row->title;
                    $row_data['url']            = $url;
                    $row_data['modify_date']    = showDate($row->modify_date);
                    $row_data['status']         = ($row->is_active == 1) ? 'Enable' : 'Disable';

                    $row_data['action'] = '
                            <div class="md-btn-group" data-id="'.encryptIt($row->id).'">
                                <a href="'.admin_url().'cms/setup/'.encryptIt($row->id).'" class="btn btn-sm btn-icon btn-primary mr-1" title="Edit Vehicle">Edit</a>
                                <a href="javascript:void(0)" class="delete-vehicle btn btn-sm btn-icon btn-danger mr-1">Delete</a>
                            </div>';
                    $admin[]    = $row_data;
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
            $this->template->view('admin/cms/index', $data);
        } else {
            redirect(admin_url());
        }
    }

    public function setup($id = "") {
        if ($this->is_logined) {
            $decrypt_id = 0;
            if ($id != '') {
                $decrypt_id     = decryptIt($id);
                $data['cms']    = $this->cms_model->get_cms($decrypt_id);
            }

            $data['css_files']   = array(
                                    'select2.min.css'
                                );
            $data['js_files']   = array(
                                    'select2.full.min.js',
                                    'ckeditor/ckeditor.js'
                                );

            $this->template->view('admin/cms/setup', $data);
        } else {
            redirect(admin_url());
        }
    }

    public function commit() {
        if ($this->is_logined && ($this->input->server('REQUEST_METHOD') == 'POST')) {
            $cms_id = $this->input->post('cms_id');
            $r_url  = admin_url().'cms';
            $this->form_validation->set_rules('title', 'Title', 'required|trim|callback_check_unique[title]');
            $this->form_validation->set_rules('heading', 'Title', 'required|trim');
            $this->form_validation->set_rules('url', 'Url', 'required|trim');

            if ($this->form_validation->run() == true) {
                $data['title']      = trim($this->input->post('title', TRUE));
                $data['heading']    = trim($this->input->post('heading', TRUE));
                $data['url']        = $this->input->post('url', TRUE);
                $data['content']    = $_POST['content'];
                $data['modify_by']  = $this->loginUser['id'];
                $decrypt_id         = 0;
                $change_logs        = array();
                $notification_msg   = "";
                if ($cms_id != "") {
                    $decrypt_id = decryptIt($cms_id);
                    $this->cms_model->update_table($data, array('id' => $decrypt_id));
                    $this->session->set_flashdata('success', 'Page saved successfully.');
                } else {
                    $data['created_by']     = $this->loginUser['id'];
                    $data['created_date']   = date('Y-m-d H:i:s', time());
                    $insert_id              = $this->cms_model->insert($data);

                    if ($insert_id > 0) {
                        $this->session->set_flashdata('success', 'Page saved successfully.');
                    } else {
                        $this->session->set_flashdata('error', 'Something went worng, Please try again later.');
                    }
                    $id = $insert_id;
                }
            } else {
                $r_url = admin_url().'cms/setup';
                if ($cms_id != "") {
                    $r_url = admin_url().'cms/setup/'.$cms_id;
                }
                $this->session->set_flashdata('error', 'Please fill required fields');
            }
            redirect($r_url);
        } else {
            redirect(admin_url());
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

        $result = $this->cms_model->get_rows($filter,1);
        $return = TRUE;

        if ($result > 0) {
            $return = FALSE;
        }
        json_output($return);
    }
    
    public function check_unique($name,$field) {
        $cms_id    = $this->input->post('cms_id');
        if (isset($name) && ($name != "")) {
            if ($cms_id != "") {    
                $filter['where'] = array('id !=' => decryptIt($cms_id), $field => trim($name));
            } else {
                $filter['where'] = array($field => trim($name));
            }
        }

        $result = $this->cms_model->get_rows($filter,1);

        if ($result > 0) {
            $this->form_validation->set_message('check_unique', 'Title name already exist');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function delete() {
        if ($this->is_logined) {
            $id                 = $this->input->post('id');
            $decrypt_id         = decryptIt($id);
            $uFilter['where']   = array('id' => $decrypt_id);
            $uFilter['row']     = 1;
            $user               = $this->cms_model->get_rows($uFilter, true);

            if ($user > 0) {

                $this->cms_model->delete($uFilter['where']);                
                $change_logs["description"] = "CMS Page deleted: cms id " . $decrypt_id;
                $change_logs["status"]      = 3;
                update_change_log($change_logs);
                $return['status']   = true;
                $return['message']  = 'CMS deleted successfully';
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
                $field          = $this->input->post('field');
                $data           = array();
                $acceptFields   = array("is_active", "is_visible");

                if ($id != '' && in_array($field, $acceptFields)) {
                    $filter['where']        = array('id' => decryptIt($id));
                    $filter['row']          = 1;
                    $item                   = $this->cms_model->get_rows($filter);

                    if (!empty($item)) {
                        $update_data[$field]   = 0;
                        if ($item->$field == 0) {
                            $update_data[$field]   = 1;
                        }

                        $this->cms_model->update_table($update_data, $filter['where']);

                        $data['status']   = TRUE;
                        $data['message']  = 'Status changed successfully';
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
}
?>