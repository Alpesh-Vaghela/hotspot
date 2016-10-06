<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
*/
class Default_model extends CI_model {

    public $table = '';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function query($sql) {
        return $this->resultValid($this->db->query($sql)->result_array());
    }

    public function getAll($order_by = "DESC", $order = "id") {
        $result = $this->db
                        // ->limit($limit)
                        ->order_by($order, $order_by)
                        ->get($this->table)
                        ->result_array();
        return $this->resultValid($result);
    }

    public function get($where = array()) {
        if(empty($where)) {
            return FALSE;
        }
        else {
            $result = $this->db
                            ->where($where)
                            ->get($this->table)
                            ->result_array();
            return $this->resultValid($result);
        }
    }

    public function set($data = array(), $where = array()) {
        if(empty($data))
            return FALSE;
        if(empty($where)) {
            $this->db->insert($this->table, $data);
            return $this->db->insert_id();
        }
        else {
            $this->db->update($this->table, $data, $where);
            return TRUE;
        }
    }

    public function delete($where) {
        $this->db->delete($this->table, $where);
        return TRUE;
    }

    private function resultValid($result = array()) {
        if(!empty($result))
            return $result;
        else
            return FALSE; 
    }
    
}