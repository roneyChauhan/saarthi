<?php

class Route_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->tableName = 'bharat_route';
    }

    public function get_route($route_id = 0) {
        $return = array();

        if ($route_id > 0) {
            $filter['where']    = array('id' => $route_id);
            $filter['row']      = 1;
            $return             = $this->route_model->get_rows($filter);
        }

        return $return;
    }
    
    
    public function get_route_name($route_id = 0) {
        $route_name = "";

        if ($route_id > 0) {
            $filter['where']    = array('id' => $route_id);
            $filter['row']      = 1;
            $filter['select']   = array('id', 'name', 'is_active');
            $return             = $this->route_model->get_rows($filter);
            if (!empty($return)) {
                $route_name = $return->name;
            }
        }

        return $route_name;
    }

    public function get_route_details($route_from = "", $route_to = "") {
        $route_data = array();

        if ($route_from != "" && $route_to != "" ) {
            $filter['where_in'] = array(
                                        array('field' => 'from_location','value' => array($route_from, $route_to)),
                                        array('field' => 'to_location', 'value' => array($route_from, $route_to))
                                    );
            $filter['row']      = 1;
            $filter['where']    = array('is_active' => 1);
            $route_data         = $this->route_model->get_rows($filter);
        }
        return $route_data;
    }    
}

?>