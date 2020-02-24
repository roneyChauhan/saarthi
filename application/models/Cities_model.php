<?php

class Cities_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->tableName = 'bharat_cities';
    }

    public function get_city($city_id = 0) {
        $return = array();

        if ($city_id > 0) {
            $filter['where']    = array('bharat_cities.id' => $city_id);
            $filter['row']      = 1;
            $filter['select']   = array('bharat_cities.*','s.state as state_name');
            $filter["join"]     = array(
                                        array('table' => 'bharat_state as s', 'condition' => "s.id = bharat_cities.state_code", "type" => "left"),
                                    );
            $return             = $this->cities_model->get_rows($filter);
        }

        return $return;
    }

    public function get_city_state_name($city_id = 0) {
        $name = array();

        if ($city_id > 0) {
            $filter['where']    = array('bharat_cities.id' => $city_id);
            $filter['row']      = 1;
            $filter['select']   = array('city_name','bs.state');
            $filter["join"]     = array(
                                        "0" => array('table' => 'bharat_state as bs', 'condition' => "bs.id = bharat_cities.state_code", "type" => "left")
                                    );
            $return             = $this->cities_model->get_rows($filter);
            if (!empty($return)) {
                $name = array("city_name" => $return->city_name, "state_name" => ucfirst(strtolower($return->state)));
            }
        }

        return $name;
    }    
}

?>