<?php

class Vehicle_categories_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->tableName = 'bharat_vehicle_categories';
    }

    public function get_vehicle_categories($category_id = 0) {
        $return = array();

        if ($category_id > 0) {
            $filter['where']    = array('id' => $category_id);
            $filter['row']      = 1;
            $filter['select']   = array('id', 'name', 'driver_price','is_active');
            $return             = $this->vehicle_categories_model->get_rows($filter);
        }

        return $return;
    }

    public function get_category_name($category_id = 0) {
        $category_name = "";

        if ($category_id > 0) {
            $filter['where']    = array('id' => $category_id);
            $filter['row']      = 1;
            $filter['select']   = array('id', 'name', 'is_active');
            $return             = $this->category_model->get_rows($filter);
            if (!empty($return)) {
                $category_name = $return->name;
            }
        }

        return $category_name;
    }    
}

?>