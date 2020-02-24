<?php 
    function p($data, $continue = false) {
        echo '<pre>'; print_r($data);
        if (!$continue) {
            die;
        }
    }

    function json_output($data = array()) {
        echo json_encode($data); die;
    }
    
    function check_login() {
        $ci     = & get_instance();
        if (!$ci->get_authorized_user()) {
            redirect(base_url());
        }
    }
    
    function check_admin_login() {
        $ci     = & get_instance();
        if (!$ci->get_admin_user()) {
            redirect(admin_url().'login');
        }
    }
    
    function showDate($date = '') {
        if ($date != '') {
//            return date('F d, Y', strtotime($date));
            return date('d F, Y', strtotime($date));
        }
    }

    function showTime($time = '') {
        if ($time != '') {
            return date('H:i A', strtotime($time));
        }
    }

    function showDateTime($time = '') {
        if ($time != '') {
            return date('F d, Y h:i A', strtotime($time));
        }
    }

    function showPrice($price = '') {
        if ($price != '') {
            return number_format($price, 2, ".", ",");
        }
    }

    function initPagination() {
        $config                     = array();
        $config['use_page_numbers'] = TRUE;
        $config['full_tag_open']    = '<ul class="pagination pagination-lg d-flex justify-content-center">';
        $config['full_tag_close']   = '</ul>';
        $config['first_tag_open']   = '<li>';
        $config['first_tag_close']  = '</li>';
        $config['prev_link']        = '&laquo';
        $config['prev_tag_open']    = '<li>';
        $config['prev_tag_close']   = '</li>';
        $config['next_link']        = '&raquo';
        $config['next_tag_open']    = '<li>';
        $config['next_tag_close']   = '</li>';
        $config['last_tag_open']    = '<li>';
        $config['last_tag_close']   = '</li>';
        $config['cur_tag_open']     = '<li class="active page-item"><a class="page-link" href="javascript:void()">';
        $config['cur_tag_close']    = '</a></li>';
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']    = '</li>';
        $config['first_link']       = false;
        $config['last_link']        = false;
        return $config;
    }
    
    function slug($str) {
        $str = preg_replace('/[^a-z0-9[:space:]]/', '', strtolower($str));
        $str = str_replace(' ', '-', $str);
        return $str;
    }

    function admin_url() {
        return base_url().'dhys/admin/';
    }
    
    function portal_url() {
        return base_url().'portal/';
    }

    function portal_asset_url() {
        return base_url().'assets/portal-side/';
    }
    
    function admin_img_url() {
        return base_url().'assets/admin-side/images/';
    }

    function asset_url() {
        return base_url().'assets/admin-side/';
    }

    function front_asset_url() {
        return base_url().'assets/front-side/';
    }
    
    function encryptIt($encrept_id = '') {
        $ci             = & get_instance();
        $encrept_str    = '';
        if ($encrept_id != '') {
            $encrept_str = urlencode(base64_encode($ci->config->item('SITE_NAME')).base64_encode($encrept_id));
        }
        return $encrept_str;
    }

    function decryptIt($encrept_id = '') {
        $ci             = & get_instance();
        $decrept_id     = '';
        if ($encrept_id != '') {
            $temp_id        = urldecode($encrept_id);
            $encoded_site   = base64_encode($ci->config->item('SITE_NAME'));
            $temp_var       = explode($encoded_site, $temp_id);
            $decrept_id     = base64_decode($temp_var[1]);
        }

        return $decrept_id;
    }

    function description($description, $length) {
        $str        = '';
        $description= preg_replace("/<img[^>]+\>/i", "", $description);
        if (strlen($description) > $length) {
            $str = substr($description, 0, $length).'...';
        } else {
            $str = $description;
        }
        return $str;
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function rrmdir($dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (is_dir($dir . "/" . $object))
                        rrmdir($dir . "/" . $object);
                    else
                        unlink($dir . "/" . $object);
                }
            }
            reset($objects);
            rmdir($dir);
        }
    }

    function encreptIt($encrept_id = '') {
        $ci             = & get_instance();
        $encrept_str    = '';
        if ($encrept_id != '') {
            $encrept_str = urlencode(base64_encode($ci->config->item('SITE_NAME')).base64_encode($encrept_id));
        }
        return $encrept_str;
    }

    function decreptIt($encrept_id = '') {
        $ci             = & get_instance();
        $decrept_id     = '';
        if ($encrept_id != '') {
            $temp_id        = urldecode($encrept_id);
            $encoded_site   = base64_encode($ci->config->item('SITE_NAME'));
            $temp_var       = explode($encoded_site, $temp_id);
            $decrept_id     = base64_decode($temp_var[1]);
        }

        return $decrept_id;
    }

    function correctOrientation($file_path) {
        $file_info = pathinfo($file_path);

        if (! empty($file_info) && $file_info['extension'] == 'jpg') {
            ini_set('memory_limit', '1028M');

            $exif = exif_read_data($file_path);
            if (!empty($exif['Orientation'])) {
                $imageResource = imagecreatefromjpeg($file_path); // provided that the image is jpeg. Use relevant function otherwise
                switch ($exif['Orientation']) {
                    case 3:
                        $image = imagerotate($imageResource, 180, 0);
                        break;
                    case 6:
                        $image = imagerotate($imageResource, -90, 0);
                        break;
                    case 8:
                        $image = imagerotate($imageResource, 90, 0);
                        break;
                    default:
                        $image = imagerotate($imageResource, 0, 0);;
                } 

                $fullpath = $file_info['dirname'].'/'.$file_info['basename'];
                imagejpeg($image, $fullpath, 100);
                imagedestroy($imageResource);
                imagedestroy($image);
            }
        }
    }
    
    function not_found() {
        $ci     = & get_instance();
        $data   = array();
        $ci->template->view("front/not_found", $data);
    }

    function display_order($id = 0) {
        $return = '';
        if ($id > 0) {
           $return = "SIP" . str_pad($id,5,"0",STR_PAD_LEFT);
        }
        return $return;
    }
    
    function last_query() {
         $ci     = & get_instance();
         
         echo $ci->db->last_query();die;
    }
    
    function imageUpload($image = array(), $file_name = '', $path) {

        $ci             = & get_instance();
        $attachment_id  = 0;
        $uploadPath     = getcwd().'/'.$path;
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }
        $ci->load->library('upload');
        $config                     = array();
        $config['upload_path']      = $uploadPath;
        $config['allowed_types']    = 'gif|jpg|jpeg|png|GIF|JPEG|JPG|PNG';
        $config['max_size']         = 2048; // 2MB=> 2048 , 5MB => 5120
        $config['overwrite']        = FALSE;
        $ci->upload->initialize($config, true);
        if ($ci->upload->do_upload($file_name)) {
            $fileData       = $ci->upload->data();
            $aData['path']  = $path.'/'.$fileData['file_name'];
            $aData['type']  = 'image';
            $attachment_id  = $ci->attachment_model->insert($aData);
            if ($attachment_id > 0) {
                compress_png($fileData['full_path'], $fileData['full_path'], 60);
            }
        } else {
//            echo $ci->upload->display_errors(); die;
        }

        return $attachment_id;
    }

    function fileUpload($image = array(), $file_name = '', $path) {

        $ci             = & get_instance();
        $attachment_id  = 0;

        $uploadPath = getcwd().'/'.$path;
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }
        $ci->load->library('upload');
        $config                     = array();
        $config['upload_path']      = $uploadPath;
        $config['allowed_types']    = 'pdf|docx';
        $config['max_size']         = 5120; // 2MB=> 2048 , 5MB => 5120
        $ci->upload->initialize($config, true);
        if ($ci->upload->do_upload($file_name)) {
            $fileData       = $ci->upload->data();
            $aData['path']  = $path.'/'.$fileData['file_name'];
            $aData['type']  = 'pdf';
            $attachment_id  = $ci->attachment_model->insert($aData);

        } else {
//            echo $ci->upload->display_errors(); die;
        }

        return $attachment_id;
    }
    
    function compress_png($source, $destination, $quality) {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', '0');

        $info = getimagesize($source);
        if ($info['mime'] == 'image/jpeg')
            $image = imagecreatefromjpeg($source);

        elseif ($info['mime'] == 'image/gif')
            $image = imagecreatefromgif($source);

        elseif ($info['mime'] == 'image/png')
            $image = imagecreatefrompng($source);

        if(isset($image)) {
            imagejpeg($image, $destination, $quality);
        }

        return $destination;
    }
    
    function get_left_menu($menu_array = array()) {
        $ci        = & get_instance();
        $menu_html = "";
        if (!empty($menu_array)) {
            $result['menu_item']    = $menu_array['item'];
            $menu_html              = $ci->load->view('admin/partial/left_sidebar_content', $result, true);
        }
        return $menu_html;
    }

    function is_allowed($current_url = '') {
        $allow          = false;
        $ci             = & get_instance();
        $loginUser      = $ci->getLoginUser();

        if ($current_url != '' && (!empty($loginUser))) {
            $className          = "";
            $methodName         = "";
            $param              = "";
            $temp_url           = array_filter(explode(admin_url(), $current_url));
            if (! empty($temp_url)) {
                if (isset($temp_url[1])) {
                    $url_param = explode('/', $temp_url[1]);

                    if (isset($url_param[0])) {
                        $className = $url_param[0];
                    }
                    if (isset($url_param[1])) {
                        $methodName = $url_param[1];
                    }
                    if (isset($url_param[2])) {
                        $param = $url_param[2];
                    }
                }
            }

            if ($className == 'dashboard') {
                $allow = true;
            } else {
                if ($className != '') {
                    $filter['where_in'] = array(
                                            array('field' => 'angel_role_permission.menu_id', 'value' => explode(',', $loginUser['allowed_menu']))
                                        );

                    $filter['where']    = array('angel_role_permission.role_id' => $loginUser['role'], 'url' => $className);

                    $filter['select']   = array('angel_role_permission.*', 'm.menu_name', 'm.url');
                    $filter['join']     = array(
                                            array('table' => 'angel_menu as m', 'condition' => 'm.id = angel_role_permission.menu_id', 'type' => 'LEFT')
                                        );
                    $filter["groupby"]  = array("field" => "angel_role_permission.menu_id");
                    $filter['row']      = 1;
                    $results            = $ci->role_permission_model->get_rows($filter);
//                    p($results, true);
//echo $methodName;
                    if (!empty($results)) {
                        if ($methodName == 'delete') {
                            if (isset($results->allowed_delete) && ($results->allowed_delete == 1)) {
                                $allow = true;
                            }
                        } else {
                            if ($param != '' && isset($results->allowed_edit) && ($results->allowed_edit == 1)) {
//                                echo 'hello 3';
                                $allow = true;
                            } else if ($param == '' && $className != '' && $methodName != '' && isset($results->allowed_create) && ($results->allowed_create == 1)) {
//                                echo 'hello';
                                $allow = true;
                            } else if ($param == '' && $methodName == '' && $className != '' && isset($results->allowed_view) && ($results->allowed_view == 1)) {
//                                echo 'hello 2';
                                $allow = true;
                            }
                        }
                    }
                }
            }  
        }
//echo $allow;die;
        return $allow;
    }

    function check_permission() {
        $ci             = & get_instance();
        $loginUser      = $ci->getLoginUser();

        if (!empty($loginUser)) {
            $allow          = false;
            $request_with = isset($_SERVER['HTTP_X_REQUESTED_WITH']) ? $_SERVER['HTTP_X_REQUESTED_WITH'] : '';

            if ($request_with == 'XMLHttpRequest') {
                $allow = true;
            } else {
                $current_url= current_url();
                $allow      = is_allowed($current_url);
            }

            if (!$allow) {
                if ($_SERVER['HTTP_REFERER'] != '') {
                    redirect($_SERVER['HTTP_REFERER']);
                } else {
                    redirect(admin_url().'dashboard');
                }
            }
        }
    }
    
    function create_role_row($menu_key, $role , $list) {
        $view_check = "";
        if (isset($list['actions']) && in_array('1', $list['actions'])) {
            $allowed_view_checked = "";
            if (isset($role->role_permission[$menu_key]["allowed_view"]) && $role->role_permission[$menu_key]["allowed_view"] == 1) {
                $allowed_view_checked = "checked";
            }
            
            $view_check = '
                <div class="checkbox">
                    <label>
                        <input type="checkbox" '.$allowed_view_checked.' class="icheckbox_flat-orange allowed_view_all" name="permission['.$menu_key.'][allowed_view]">
                    </label>
                </div>
            ';
        }

        $edit_check = "";
        if (isset($list['actions']) && in_array('3', $list['actions'])) {
            $allowed_edit_checked   = "";
            if (isset($role->role_permission[$menu_key]["allowed_edit"]) && $role->role_permission[$menu_key]["allowed_edit"] == 1 ) {
                $allowed_edit_checked   = "checked";
            }
            
            $edit_check = '
                <div class="checkbox">
                    <label>
                        <input type="checkbox" '.$allowed_edit_checked.' class="icheckbox_flat-orange allowed_view_all" name="permission['.$menu_key.'][allowed_edit]">
                    </label>
                </div>
            ';
        }

        $create_check = "";
        if (isset($list['actions']) && in_array('2', $list['actions'])) {
            $allowed_create_checked = "";
            if (isset($role->role_permission[$menu_key]["allowed_create"]) && $role->role_permission[$menu_key]["allowed_create"] == 1 ) {
                $allowed_create_checked = "checked";
            }
            
            $create_check = '
                <div class="checkbox">
                    <label>
                        <input type="checkbox" '.$allowed_create_checked.' class="icheckbox_flat-orange allowed_view_all" name="permission['.$menu_key.'][allowed_create]">
                    </label>
                </div>
            ';
        }

        $delete_check = "";
        if (isset($list['actions']) && in_array('4', $list['actions'])) {
            $allowed_create_checked = "";
            if (isset($role->role_permission[$menu_key]["allowed_delete"]) && $role->role_permission[$menu_key]["allowed_delete"] == 1 ) {
                $allowed_create_checked = "checked";
            }
            
            $delete_check = '
                <div class="checkbox">
                    <label>
                        <input type="checkbox" '.$allowed_create_checked.' class="icheckbox_flat-orange allowed_view_all" name="permission['.$menu_key.'][allowed_delete]">
                    </label>
                </div>
            ';
        }
        
        $tr = "
            <th>".$list['menu_name']."</th>
            <th class='text-center'>".$view_check."</th>
            <th class='text-center'>".$edit_check."</th>
            <th class='text-center'>".$create_check."</th>
            <th class='text-center'>".$delete_check."</th>
        ";

        return $tr;
    }
    
    function formatSizeUnits($bytes) {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } else if ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } else if ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } else if ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }
        return $bytes;
    }
    function get_header_details(){
        $ci     = & get_instance();
        $return = array();
        return $return;
    }
 
    function startsWith($string, $startString) {
        $len    = strlen($startString);
        return (substr($string, 0, $len) === $startString);
    }

?>