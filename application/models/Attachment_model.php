<?php

class Attachment_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->tableName = 'bharat_attachment';
    }
    
    public function getRecord($id) {
        $return = array();
        
        if ($id != '') {
            $filter['where']= array('id' => decryptIt($id));
            $filter['row']  = 1;
            $return         = $this->attachment_model->get_rows($filter);
        }

        return $return;
    }

    public function remove($id) {
        if ($id != '') {
            $filter['where']= array('id' => $id);
            $filter['row']  = 1;
            $photo          = $this->attachment_model->get_rows($filter);

            if (! empty($photo)) {
                if (isset($photo->path) && ($photo->path != '')) {
                    $file_path = getcwd().'/'.$photo->path;
                    
                    if (file_exists($file_path)) {
                        unlink($file_path);
                    }
                }
            }

            $this->attachment_model->delete($filter['where']);
        }
    }
}

?>