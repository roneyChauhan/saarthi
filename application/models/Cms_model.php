<?php
    class Cms_model extends MY_Model
    {
        public function __construct()
        {
            parent::__construct();
            $this->tableName = 'bharat_cms';
        }

        public function get_cms($cms_id = 0) {
            $return = array();

            if ($cms_id > 0) {
                $filter['where']    = array('id' => $cms_id);
                $filter['row']      = 1;
                $return             = $this->cms_model->get_rows($filter);
            }

            return $return;
        }
    }
?>