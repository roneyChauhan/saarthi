<?php

class user_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->tableName = 'bharat_user';
    }

    public function validate_user($data = array()) {
        $username   = $data['username'];
        $password   = $data['password'];
        $return     = array();

        if (!empty($username) && !empty($password)) {
            $filter['where']    = array('password' => encreptIt($password), 'email' => $username);
            $filter['row']      = 2;
            $result             = $this->user_model->get_rows($filter);
            if (! empty($result)) {
                $return = $result;
            } else {
                $filter['where']    = array('password' => encreptIt($password), 'phone' => $username);
                $filter['row']      = 2;
                $result             = $this->user_model->get_rows($filter);
                if (! empty($result)) {
                    $return = $result;
                }
            }
        }

        return $return;
    }

    public function get_detail($id = 0) {
        $return = array();
        if ($id > 0) {
            
            $filter['select']   = array('bharat_user.*');
            $filter['where']    = array('bharat_user.id' => $id);
            $filter['row']      = 1;
            $return             = $this->user_model->get_rows($filter);
        }
        return $return;
    }
}

?>