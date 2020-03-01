<?php

class Booking_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->tableName = 'bharat_booking';
    }

    public function get_booking_data($filter = array()) {

        $bFilter["select"]   = array("bharat_booking.*",
                                                        "user.first_name", "user.last_name", "user.email",
                                                        "bd.service_type", 
                                                        "c_pick.city_name as pick_city", 
                                                        "s_pick.state as pick_state ",
                                                        "c_drop.city_name as drop_city", 
                                                        "s_drop.state as drop_state", 
                                                        "bd.trip_location", 
                                                        "bd.drop_location",
                                                        "bd.pickup_date", "bd.pickup_time",
                                                        "bd.trip_days");
        $bFilter['where']   = array();
        if (isset($filter['today'])) {
            $bFilter['where']['bd.pickup_date >='] = date("Y-m-d");
            $bFilter['where']['bd.pickup_date <='] = date("Y-m-d");
        }
        $bFilter["join"]     = array(
                                    array('table' => 'bharat_booking_detail as bd', 'condition' => "bd.booking_id = bharat_booking.id", "type" => "left"),
                                    array('table' => 'bharat_cities as c_pick', 'condition' => "c_pick.id = bd.trip_location", "type" => "left"),
                                    array('table' => 'bharat_state as s_pick', 'condition' => "s_pick.id = c_pick.state_code", "type" => "left"),
                                    array('table' => 'bharat_cities as c_drop', 'condition' => "c_drop.id = bd.drop_location", "type" => "left"),
                                    array('table' => 'bharat_state as s_drop', 'condition' => "s_drop.id = c_drop.state_code", "type" => "left"),
                                    array('table' => 'bharat_user as user', 'condition' => "user.id = bharat_booking.user_id", "type" => "left")
                                );
        $return = $this->booking_model->get_rows($bFilter);
        return $return;
    }
}

?>