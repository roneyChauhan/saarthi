<?php

class State_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->tableName = 'bharat_state';
    }

    public function get_state($state_id = 0) {
        $return = array();

        if ($state_id > 0) {
            $filter['where']    = array('id' => $state_id);
            $filter['row']      = 1;
            $filter['select']   = array('id', 'state', 'status');
            $return             = $this->state_model->get_rows($filter);
        }

        return $return;
    }
    
    
    public function get_state_name($state_id = 0) {
        $state_name = "";

        if ($state_id > 0) {
            $filter['where']    = array('id' => $state_id);
            $filter['row']      = 1;
            $filter['select']   = array('id', 'state', 'is_active');
            $return             = $this->state_model->get_rows($filter);
            if (!empty($return)) {
                $state_name = $return->state;
            }
        }

        return $state_name;
    }    
}

?>