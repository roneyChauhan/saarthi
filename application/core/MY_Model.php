<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Model extends CI_Model {

    public $tableName   = null;

    public function __construct() {
        parent::__construct();
    }

    public function all($filter = array()) {
        $filter['where']    = array('is_active' => 1);

        return $this->get_rows($filter);
    }
    
    
    public function insert($data) {
        $this->db->insert($this->tableName, $data);

        return $this->db->insert_id();
    }

    public function insert_betch($data) {
        $this->db->insert_batch($this->tableName, $data);
    }

    public function get_rows($filters = array(), $count = 0) {
        $this->db->from($this->tableName);

        if (isset($filters['distinct']))
            $this->db->distinct();

        if (isset($filters['select']))
            $this->db->select($filters['select']);

        if (isset($filters['where']))
            $this->db->where($filters['where']);

        if (isset($filters['having']))
            $this->db->having($filters['having']);

        if (isset($filters['or_having']))
            $this->db->or_having($filters['or_having']);

        if (isset($filters['like']) && isset($filters['or_like']) ) {
            $this->db->group_start();
            if (isset($filters['like']['type'])) {
                $this->db->like($filters['like']['field'], $filters['like']['value'], $filters['like']['type']);
            } else {
                $this->db->like($filters['like']['field'], $filters['like']['value']);
            }

            foreach ($filters['or_like'] as $or_like) {
                if (isset($or_like['type'])) {
                    $this->db->or_like($or_like['field'], $or_like['value'], $or_like['type']);   
                } else {
                    $this->db->or_like($or_like['field'], $or_like['value']);
                }
            }
            $this->db->group_end();
        } else {
            if (isset($filters['like'])) {
                if (isset($filters['like']['type'])) {
                    $this->db->like($filters['like']['field'], $filters['like']['value'], $filters['like']['type']);
                } else {
                    $this->db->like($filters['like']['field'], $filters['like']['value']);
                }
            }

            if (isset($filters['or_like'])){
                foreach ($filters['or_like'] as $or_like) {
                    if (isset($or_like['type'])) {
                        $this->db->or_like($or_like['field'], $or_like['value'], $or_like['type']);   
                    } else {
                        $this->db->or_like($or_like['field'], $or_like['value']);
                    }
                }
            }
        }

        if (isset($filters['customWhere']))
            $this->db->where($filters['customWhere'], null, false);

        if (isset($filters['where_in'])) {
            foreach ($filters['where_in'] as $where_in) {
                $this->db->where_in($where_in['field'], $where_in['value']);
            }
        }

        if (isset($filters['where_not_in']))
            $this->db->where_not_in($filters['where_not_in']['field'], $filters['where_not_in']['value']);

        if (isset($filters['orderby']))
            $this->db->order_by($filters['orderby']['field'], $filters['orderby']['order']);

        if (isset($filters['join'])) {
            foreach ($filters['join'] as $key => $join)
                $this->db->join($join['table'], $join['condition'], isset($join['type']) ? $join['type'] : NULL);
        }
        if (isset($filters['or_where_in'])) {
         foreach ($filters['or_where_in'] as $where_in) {
                $this->db->or_where_in($where_in['field'], $where_in['value']);
            }
        }

        if (isset($filters['or_where']))
            $this->db->or_where($filters['or_where']);

        if (isset($filters['limit']))
            $this->db->limit($filters['limit']['limit'], $filters['limit']['from']);

        if (isset($filters['groupby']))
            $this->db->group_by($filters['groupby']['field']);

        if (isset($filters['query']))
            return $this->db->query($filters['query'])->result();

        if ($count) {
            return $this->db->get()->num_rows();
        } else {
            if (isset($filters['row'])) {
                if ($filters['row'] == 2)
                    return $this->db->get()->row_array();
                else
                    return $this->db->get()->row();
            } else {
                if (isset($filters['result']))
                    return $this->db->get()->result_array();
                else
                    return $this->db->get()->result();
            }
        }
    }

    public function get_field($field, $where) {
        $this->db->from($this->tableName);
        $this->db->where($where);
        $row = $this->db->get()->row();

        if ($row)
            return $row->$field;
    }

    public function get_count($filters = array()) {
        if (isset($filters['select']))
            $this->db->select($filters['select']);
        else
            $this->db->select('count(id) as total');

        if (isset($filters['where']))
            $this->db->where($filters['where']);

        if (isset($filters['join'])) {
            foreach ($filters['join'] as $key => $join)
                $this->db->join($join['table'], $join['condition'], isset($join['type']) ? $join['type'] : NULL);
        }

        $this->db->from($this->tableName);

        $result = $this->db->get()->result();

        if ($result)
            return count($result);
        else
            return 0;
    }

    public function update_table($data, $where, $set = '') {
        if ($set == 1) {
            $this->db->where('id', $where['id']);

            foreach ($data as $field)
                $this->db->set($field, $field . '+1', FALSE);

            return $this->db->update($this->tableName);
        } else {
            return $this->db->update($this->tableName, $data, $where);
        }
    }

    public function get_columns() {
        $columns = $this->db->list_fields($this->tableName);
        return $columns;
    }

    public function delete($where) {
        $this->db->where($where);
        return $this->db->delete($this->tableName);
    }

    public function delete_filter($filters = array()) {
        if (isset($filters['where_in'])) {
            $this->db->where_in($filters['where_in']['field'], $filters['where_in']['value']);
        }
        return $this->db->delete($this->tableName);
    }

    public function update_batch($data = array(), $whereField = '') {
        if (!empty($data) && $whereField != '' ){
            return $this->db->update_batch($this->tableName, $data, $whereField);
        }
    }

}