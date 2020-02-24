<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inquiry extends MY_Controller {

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
                                    '1' => 'name',
                                    '2' => 'email',
                                    '3' => 'type',
                                    '4' => 'created_date',
                                    );
                $filterCount    = $totalCount = $this->inquiry_model->get_rows(array(), true);

                if (isset($search) && ($search['value'] != '')) {
                    $searchString       = $search['value'];
                    $filter['like']     = array('field' => 'id', 'value' => $searchString);
                    $filter['or_like']  = array(
                        '0' => array('field' => 'name', 'value' => $searchString),
                        '1' => array('field' => 'email', 'value' => $searchString),
                        '2' => array('field' => "DATE_FORMAT(created_date, '%d/%m/%Y')", 'value' => $searchString)
                    );
                    $filterCount        = $this->inquiry_model->get_rows($filter, true);
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
                $query              = $this->inquiry_model->get_rows($filter);
                $admin              = array();

                foreach ($query as $row) {
                    $row_data                   = array();
                    $row_data['id']             = $row->id;
                    $row_data['name']           = $row->name;
                    $row_data['email']          = $row->email;
                    $row_data['type']           = ($row->type == 1) ? 'Contact' : 'Inquiry';
                    $row_data['created_date']   = showDate($row->created_date);

                    $delete_button = '<a href="javascript:void(0)" class="delete-inquiry btn btn-sm btn-icon btn-danger mr-1" title="Delete Inquiry">delete</a>';
                    $row_data['action'] = '
                            <div class="md-btn-group" data-id="'.encryptIt($row->id).'">
                                <a href="javascript:void(0)" class="view-inquiry btn btn-sm btn-icon btn-primary mr-1" title="View Inquiry">view</a>
                                '.$delete_button.'
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
                                    'datatables.min.js'
                                );
            $data['css_files']   = array(
                                    'datatables.min.css'
                                );

            $data['active_menu']                = 18;
            $data['breadcrumbs']['page_title']  = "Manage Inquiry";
            $data['breadcrumbs']['data']        = array(
                                                    array('name' => 'Manage Inquiry', 'link' => admin_url().'inquiry')
                                                );

            $this->template->view('admin/inquiry/index', $data);
        } else {
            redirect(admin_url());
        }
    }

    public function get_inquiry() {
        if ($this->is_logined) {
            $return     = array();
            $id         = $this->input->post('id');
            $view_data  = array();
            if ($id != '') {
                $filter['where']    = array('id' => decryptIt($id));
                $filter['row']      = 1;
                $inquiry            = $this->inquiry_model->get_rows($filter);
                if (!empty($inquiry)) {
                    $view_data['inquiry']   = $inquiry;
                    $return['modal_form']   = $this->load->view("admin/inquiry/form_modal", $view_data, true);
                    $return['status']       = true;
                } else {
                    $return['status'] = false;
                }
            } else {
                $return['modal_form']   = $this->load->view("admin/inquiry/form_modal", $view_data, true);
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
            $user               = $this->inquiry_model->get_rows($uFilter, true);

            if ($user > 0) {
                $this->inquiry_model->delete($uFilter['where']);

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