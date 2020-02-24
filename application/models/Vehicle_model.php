<?php

class Vehicle_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->tableName = 'bharat_vehicle';
    }

    public function get_vehicle($vehicle_id = 0) {
        $return = array();

        if ($vehicle_id > 0) {
            $filter['where']    = array('bharat_vehicle.id' => $vehicle_id);
            $filter['row']      = 1;
            $filter['groupby']  = array('field' => 'bharat_vehicle.id');
            $filter['select']   = array('bharat_vehicle.*');

            $return = $this->vehicle_model->get_rows($filter);
            if (! empty($return)) {
                $return->vehicle_photos   = $this->vehicle_model->vehicle_photo($vehicle_id);
            }
        }

        return $return;
    }

    public function vehicle_search($filter = array(), $count = false) {

        $filter['groupby']  = array('field' => 'bharat_vehicle.id');
        $filter['select']   = array('bharat_vehicle.*', 'GROUP_CONCAT( DISTINCT vimages.image) as image_ids','category.name as category_name', 'category.driver_price');
        $filter['join'][]   = array('table' => 'bharat_vehicle_image as vimages', 'condition' => 'vimages.vehicle_id = bharat_vehicle.id', 'type' => 'LEFT');
        $filter['join'][]   = array('table' => 'bharat_vehicle_categories as category', 'condition' => 'category.id = bharat_vehicle.category', 'type' => 'LEFT');
        if($count) {
            return $this->vehicle_model->get_rows($filter, true);
        }

        $return = $this->vehicle_model->get_rows($filter);
        if (!empty($return)) {
//            if(!isset($filter['row']) || $filter['row'] != 1) {
            if(is_array($return)) {
                foreach ($return as $row) {
                    $route_km       = 0;
                    $route_price    = 0;
                    $total_price    = 0;
                    $driver_price   = (isset($row->driver_price) && $row->driver_price > 0 ) ? $row->driver_price : 0;
                    if( isset($filter['route_km']) ) {
                        $route_km       = $filter['route_km'];
                        $route_price    = $filter['route_km'] * $row->outstation_price / $row->outstation_km;
                        if (isset($filter['tripSession']['trip_type']) && $filter['tripSession']['trip_type'] == '1') {
                            $route_price    = ($filter['route_km'] * $filter['tripSession']['trip_days'] * $row->outstation_price) / $row->outstation_km;
                            $driver_price   = $row->driver_price * $filter['tripSession']['trip_days'];
                        }
                        $total_price    = $route_price + $driver_price;
                    }
                    $row->route_km      = $route_km;
                    $row->route_price   = showPrice($route_price);
                    $row->total_price   = showPrice($total_price);
                    $row->driver_price  = showPrice($driver_price);
                    $row->img_id        = 0;
                    if($row->image_ids != ""){
                        $images         = explode(",", $row->image_ids);
                        $row->img_id    = $images[0];                    
                    }
                }
            } else {
                $route_km       = 0;
                $route_price    = 0;
                $total_price    = 0;
                $driver_price   = 0;
                if( isset($filter['route_km']) ) {
                    $driver_price   = $return->driver_price;
                    $route_km       = $filter['route_km'];
                    $route_price    = $filter['route_km'] * $return->outstation_price / $return->outstation_km;
                    if (isset($filter['tripSession']['trip_type']) && $filter['tripSession']['trip_type'] == '1') {
                        $route_price    = ($filter['route_km'] * $filter['tripSession']['trip_days'] * $return->outstation_price) / $return->outstation_km;
                        $driver_price   = $return->driver_price * $filter['tripSession']['trip_days'];
                    }
                    $total_price    = $route_price + $driver_price;
                }
                $return->route_km      = $route_km;
                $return->route_price   = showPrice($route_price);
                $return->total_price   = showPrice($total_price);
                $return->driver_price  = showPrice($driver_price);
                $return->img_id        = 0;
            }
        }
        return $return;
    }
    public function vehicle_photo($vehicle_id = 0) {
        $return = array();

        if ($vehicle_id > 0) {
            $filter['where']    = array('bharat_vehicle_image.vehicle_id' => $vehicle_id);
            $filter['groupby']  = array('field' => 'bharat_vehicle_image.vehicle_id');
            $filter['select']   = array('GROUP_CONCAT(bharat_vehicle_image.image SEPARATOR ", ") as vehicle_photos');
            $filter['join']     = array(
                                    array('table' => 'bharat_vehicle as v', 'condition' => 'v.id = bharat_vehicle_image.vehicle_id', 'type' => 'LEFT'),
                                );
            $filter['row']      = 1;
            $result             = $this->vehicle_image_model->get_rows($filter);
            if (! empty($result) && isset($result->vehicle_photos)) {
                $return = explode(', ', $result->vehicle_photos);
            }
        }

        return $return;
    }
}

?>