<?php

class Vehicle_type_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->tableName = 'bharat_vehicle_type';
    }

    public function get_vehicle_type($vehicle_type_id = 0) {
        $return = array();

        if ($vehicle_type_id > 0) {
            $filter['where']    = array('id' => $vehicle_type_id);
            $filter['row']      = 1;
            $filter['select']   = array('id', 'name','is_active');
            $return             = $this->vehicle_type_model->get_rows($filter);
        }

        return $return;
    }
}

?>