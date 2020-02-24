<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Page extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index($url = "") {
        $data               = array();
        $filter['where']    = array('url' => $url, 'is_active' => 1);
        $filter['row']      = 1;
        $result             = $this->cms_model->get_rows($filter);
        if (!empty($result)) {

            $data['page']    = $result;
            $this->template->view('front/page/index', $data);
        } else {
            $this->session->set_flashdata('error', 'Page is not found, Please try again later.');
            redirect('/');
        }
    }
}

?>