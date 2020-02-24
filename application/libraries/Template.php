<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Template {

    var $obj;
    var $template;

    public function __construct($template = array('template' => 'template')) {
        $this->obj      = & get_instance();
        $this->template = $template['template'];
    }

    public function set_template($template) {
        $this->template = $template;
    }

    public function view($view, $data = NULL, $return = FALSE) {
        $checkTemplate = $this->obj->checkTemplate();
        if ($checkTemplate == 'front') {
            $this->template = 'front/template';
            $loaded_data    = $this->frontTemplate($view, $data);
        } else if ($checkTemplate == 'admin') {
            $this->template = 'admin/template';
            $loaded_data    = $this->adminTemplate($view, $data);
        } else if ($checkTemplate == 'portal') {
            $this->template = 'portal/template';
            $loaded_data    = $this->portalTemplate($view, $data);
        }

        if ($return) {
            $output = $this->obj->load->view($this->template, $loaded_data, true);
            return $output;
        } else {
            $this->obj->load->view($this->template, $loaded_data, false);
        }
    }
    
    private function frontTemplate($view, $data) {
        $data['is_login']   = $this->obj->get_authorized_user();
        $headerView         = "front/partial/header";
        if ($data['is_login']) {
            $data['loginUser']  = $this->obj->getLoginUser();
//            if (isset($data['loginUser']['user_type'])) {
//                if ($data['loginUser']['user_type'] == 1 || $data['loginUser']['user_type'] == 2 ) {
//                    $data['count']  = $this->obj->proposals_model->getTotal($data['loginUser']['business']);
//                    $headerView     = "front/partial/business_header";
//                }
//            }
        }
        $data['currentClass']   = $this->obj->router->fetch_class();
        $data['currentMethod']  = $this->obj->router->fetch_method();
        $data['menu_data']      = get_header_details();
        $loaded_data['header']      = $this->obj->load->view($headerView, $data, true);
        $loaded_data['footer']      = $this->obj->load->view('front/partial/footer', $data, true);
        $loaded_data['content']     = $this->obj->load->view($view, $data, true);

        $view_data['main_content']  = $this->obj->load->view('front/partial/main_template', $loaded_data, true);

        $js_files               = isset($data['js_files']) ? $data['js_files'] : array();
        $css_files              = isset($data['css_files']) ? $data['css_files'] : array();
        $view_data['css_files'] = $this->uploadModuleCSS($css_files, 1);
        $view_data['js_files']  = $this->uploadModuleJS($js_files, 1);

        return $view_data;
    }

    private function adminTemplate($view, $data) {
        $is_login               = $this->obj->get_admin_user();
        $view_data['body_class']= "hold-transition sidebar-mini";

        $loaded_data['is_login']            = $is_login;
        if ($is_login) {
            $data['loginUser']              = $this->obj->getLoginUser();
            $data['ADMIN_URL']              = $this->obj->config->item('ADMIN_URL');
            $data['currentClass']           = $this->obj->router->fetch_class();
            $data['currentMethod']          = $this->obj->router->fetch_method();
            $loaded_data['left_sidebar']    = $this->obj->load->view('admin/partial/left_sidebar', $data, true);
            $loaded_data['header']          = $this->obj->load->view('admin/partial/header', $data, true);
            $loaded_data['content']         = $this->obj->load->view($view, $data, true);
            $view_data['main_content']      = $this->obj->load->view('admin/partial/main_template', $loaded_data, true);
        } else {
            $view_data['body_class']        = "hold-transition login-page";
            $loaded_data['content']         = $this->obj->load->view($view, $data, true);
            $view_data['main_content']      = $this->obj->load->view('admin/partial/main_template2', $loaded_data, true);
        }


        $js_files               = isset($data['js_files']) ? $data['js_files'] : array();
        $css_files              = isset($data['css_files']) ? $data['css_files'] : array();
        $view_data['js_files']  = $this->uploadModuleJS($js_files);
        $view_data['css_files'] = $this->uploadModuleCSS($css_files);

        return $view_data;
    }

    private function portalTemplate($view, $data) {
        $is_login               = $this->obj->get_authorized_user();
        $view_data['body_class']= "hold-transition sidebar-mini";
        $loaded_data['is_login']            = $is_login;
        if ($is_login) {//$is_login
            $data['loginUser']              = $this->obj->getLoginUser();
//            p($data['loginUser']);
            $data['PORTAL_URL']             = $this->obj->config->item('PORTAL_URL');
            $data['currentClass']           = $this->obj->router->fetch_class();
            $data['currentMethod']          = $this->obj->router->fetch_method();
            $loaded_data['left_sidebar']    = $this->obj->load->view('portal/partial/left_sidebar', $data, true);
            $loaded_data['header']          = $this->obj->load->view('portal/partial/header', $data, true);
            $loaded_data['content']         = $this->obj->load->view($view, $data, true);
            $view_data['main_content']      = $this->obj->load->view('portal/partial/main_template', $loaded_data, true);
        } else {
            $view_data['body_class']        = "hold-transition login-page";
            $loaded_data['content']         = $this->obj->load->view($view, $data, true);
            $view_data['main_content']      = $this->obj->load->view('portal/partial/main_template2', $loaded_data, true);
        }
        $js_files               = isset($data['js_files']) ? $data['js_files'] : array();
        $css_files              = isset($data['css_files']) ? $data['css_files'] : array();
        $view_data['js_files']  = $this->uploadModuleJS($js_files,2);
        $view_data['css_files'] = $this->uploadModuleCSS($css_files,2);

        return $view_data;
    }

    private function uploadModuleCSS($css_files, $type = 0) { // type => 0 = Admin, 1 = Front side
        $css_file_view  = '';
        $base_path      = base_url().'assets/admin-side/css/';
        if ($type == 1) {
            $base_path  = base_url().'assets/front-side/css/';
        } else if ($type == 2) {
            $base_path  = base_url().'assets/portal-side/css/';
        }
        foreach ($css_files as $row) {
            $css_file_view .= '<link href="' . $base_path . $row . '" rel="stylesheet">';
        }

        return $css_file_view;
    }

    private function uploadModuleJS($js_files, $type = 0) { // type => 0 = Admin, 1 = Front side
        $js_file_view   = '';
        $base_path      = base_url().'assets/admin-side/js/';
        if ($type == 1) {
            $base_path  = base_url().'assets/front-side/js/';
        } else if ($type == 2) {
            $base_path  = base_url().'assets/portal-side/js/';
        }

        foreach ($js_files as $row) {
            $js_file_view .= '<script src="' . $base_path . $row . '"></script>';
        }

        $currentClass = $this->obj->router->fetch_class();
        $file_path = '';
        if ($type == 1) {
            $file_dir = getcwd() . '/assets/front-side/js/modules/' . $currentClass . '.js';
            if (file_exists($file_dir)) {
                $file_path = base_url() . 'assets/front-side/js/modules/' . $currentClass . '.js';
            }
        } else if($type == 2){
            $file_dir = getcwd() . '/assets/portal-side/js/modules/' . $currentClass . '.js';
            if (file_exists($file_dir)) {
                $file_path = base_url() . 'assets/portal-side/js/modules/' . $currentClass . '.js';
            }
        } else {
            $file_dir = getcwd() . '/assets/admin-side/js/modules/' . $currentClass . '.js';
            if (file_exists($file_dir)) {
                $file_path = base_url() . 'assets/admin-side/js/modules/' . $currentClass . '.js';
            }
        }

        if ($file_path != '') {
            $js_file_view .= '<script src="' . $file_path . '?'.time().'"></script>';
        }

        return $js_file_view;
    }
}
?>