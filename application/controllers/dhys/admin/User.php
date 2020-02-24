<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends MY_Controller {

    var $is_logined = FALSE;

    public function __construct() {
        parent::__construct();
        $this->is_logined   = $this->get_admin_user();
        $this->loginUser    = $this->getLoginUser();
    }

    public function index() {
        if ($this->is_logined) {
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $filter         = array();
                $search         = $this->input->post('search');
                $start          = intval($this->input->post("start"));
                $length         = intval($this->input->post("length"));
                $order          = $this->input->post("order");
                //$filter['where']= array("user_id" => $this->loginUser["id"]);
                $columnArray    = array(
                                    'fist_name',
                                    'email',
                                    'phone',
                                    '',
                                    );
                $filterCount    = $totalCount = $this->user_model->get_rows($filter, true);
                if (isset($search) && ($search['value'] != '')) {
                    $searchString       = $search['value'];
                    $filter['like']     = array('field' => 'first_name', 'value' => $searchString);
                    $filter['or_like']  = array(
                                            array('field' => "email", 'value' => $searchString),
                                            array('field' => "phone", 'value' => $searchString),
                                        );
                    $filterCount        = $this->user_model->get_rows($filter, true);
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
                $filter['orderby']  = array('field' => "id", 'order' => "DESC");
                $query              = $this->user_model->get_rows($filter);
                $admin              = array();
                foreach ($query as $row) {
                    //p($row);
                    $row_data                   = array();
                    $row_data['first_name']     = $row->first_name;
                    $row_data['email']          = $row->email;
                    $row_data['phone']          = $row->phone;
                    $action                     = '';
                    $row_data['action']         = $action;
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

            $data['active_menu']                = 18;
            $data['breadcrumbs']['page_title']  = "Manage User";
            $data['breadcrumbs']['data']        = array(
                                                    array('name' => 'Manage User', 'link' => admin_url().'user')
                                                );

            $this->template->view('admin/user/index', $data);
        } else {
            redirect(admin_url());
        }
    }

    public function get_booking() {
        if ($this->is_logined) {
            $return     = array();
            $id         = $this->input->post('id');
            $view_data  = array();
            if ($id != '') {
                $filter['where']    = array('id' => decryptIt($id));
                $filter['row']      = 1;
                $user            = $this->user_model->get_rows($filter);
                if (!empty($user)) {
                    $view_data['user']   = $user;
                    $return['modal_form']   = $this->load->view("admin/user/form_modal", $view_data, true);
                    $return['status']       = true;
                } else {
                    $return['status'] = false;
                }
            } else {
                $return['modal_form']   = $this->load->view("admin/user/form_modal", $view_data, true);
                $return['status']       = true;
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
            $user               = $this->user_model->get_rows($uFilter, true);

            if ($user > 0) {
                $this->user_model->delete($uFilter['where']);

                $return['status']   = true;
                $return['message']  = 'Feedback deleted successfully';
            } else {
                $return['status']   = false;
                $return['message']  = 'Somthing went wrong';
            }
            json_output($return);
        } else {
            redirect(admin_url());
        }
    }
    
}
?>