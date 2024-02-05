<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Item_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    // Get From Databases
    function get($params = array())
    {
        
        if (isset($params['id'])) {
            $this->db->where('item.item_id', $params['id']);
        }
        
        if (isset($params['search'])) {
            //$this->db->or_like('item_name', $params['search']);
            if($params['position_search'] != "all"){
            $this->db->where('item_majors_id', $params['search']);
            }
        }

        if (isset($params['item_name'])) {
            $this->db->where('item.item_name', $params['item_name']);
        }

        if (isset($params['limit'])) {
            if (!isset($params['offset'])) {
                $params['offset'] = NULL;
            }

            $this->db->limit($params['limit'], $params['offset']);
        }

        if (isset($params['order_by'])) {
            $this->db->order_by($params['order_by'], 'asc');
        } else {
            $this->db->order_by('item_name', 'asc');
        }

        $res = $this->db->get('item');
        if (isset($params['id'])) {
            return $res->row_array();
        } else if (isset($params['item_name'])) {
            return $res->row_array();
        } else {
            return $res->result_array();
        }
    }

    function add($data = array())
    {
        if (isset($data['item_id'])) {
            $this->db->set('item_id', $data['item_id']);
        }

        if (isset($data['item_name'])) {
            $this->db->set('item_name', $data['item_name']);
        }

        if (isset($data['item_majors_id'])) {
            $this->db->set('item_majors_id', $data['item_majors_id']);
        }
        
        if (isset($data['item_id'])) {
            $this->db->where('item_id', $data['item_id']);
            $this->db->update('item');
            $id = $data['item_id'];
        } else {
            $this->db->insert('item');
            $id = $this->db->insert_id();
        }
        $status = $this->db->affected_rows();
        return ($status == 0) ? FALSE : $id;
    }
    
    
    function update($data = array())
    {       

        if (isset($data['item_name'])) {
            $this->db->set('item_name', $data['item_name']);
        }

        if (isset($data['item_majors_id'])) {
            $this->db->set('item_majors_id', $data['item_majors_id']);
        }
        
        $this->db->where('item_id', $data['item_id']);
        $this->db->update('item');
        $id = $data['item_id'];
        
        $status = $this->db->affected_rows();
        return ($status == 0) ? FALSE : $id;
    }

    // Delete all to database
    function delete_all() {
        $this->db->truncate('item');
    }
    
    // Delete to database
    function delete($id) {
        $this->db->where('item_id', $id);
        $this->db->delete('item');
    }
    
}
