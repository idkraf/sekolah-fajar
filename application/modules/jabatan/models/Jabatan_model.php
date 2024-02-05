<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jabatan_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    // Get From Databases
    function get($params = array())
    {

        if (isset($params['id'])) {
            $this->db->where('position.position_id', $params['id']);
        }
        
        if (isset($params['position_search'])) {
            if($params['position_search'] != "all"){
                    
               // $this->db->where('position_code', $params['position_search']);
                //$this->db->or_like('position_name', $params['position_search']);

                $this->db->where('position_majors_id', $params['position_search']);
            }
            
        }

        if (isset($params['position_name'])) {
            $this->db->where('position.position_name', $params['position_name']);
        }

        //if (isset($params['status'])) {
        //    $this->db->where('position.position_status', $params['status']);
        //}
        
        if (isset($params['limit'])) {
            if (!isset($params['offset'])) {
                $params['offset'] = NULL;
            }

            $this->db->limit($params['limit'], $params['offset']);
        }

        if (isset($params['order_by'])) {
            $this->db->order_by($params['order_by'], 'asc');
        } else {
            $this->db->order_by('position_name', 'asc');
        }

        $res = $this->db->get('position');
        if (isset($params['id'])) {
            return $res->row_array();
        } else if (isset($params['position_name'])) {
            return $res->row_array();
        } else {
            return $res->result_array();
        }
    }

    
    function get_majors($params = array())
    {
        if (isset($params['id'])) {
            $this->db->where('majors_id', $params['id']);
        }

        if (isset($params['majors_name'])) {
            $this->db->where('majors_name', $params['majors_name']);
        }

        if (isset($params['majors_short_name'])) {
            $this->db->where('majors_short_name', $params['majors_short_name']);
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
            $this->db->order_by('majors_id', 'asc');
        }

        $this->db->select('majors_id, majors_name, majors_short_name');
        $res = $this->db->get('majors');

        if (isset($params['id'])) {
            return $res->row_array();
        } else {
            return $res->result_array();
        }
    }

    function add($data = array())
    {
        if (isset($data['position_id'])) {
            $this->db->set('position_id', $data['position_id']);
        }

        if (isset($data['position_name'])) {
            $this->db->set('position_name', $data['position_name']);
        }

        if (isset($data['position_code'])) {
            $this->db->set('position_code', $data['position_code']);
        }

        if (isset($data['position_majors_id'])) {
            $this->db->set('position_majors_id', $data['position_majors_id']);
        }
        
        if (isset($data['position_id'])) {
            $this->db->where('position_id', $data['position_id']);
            $this->db->update('position');
            $id = $data['position_id'];
        } else {
            $this->db->insert('position');
            $id = $this->db->insert_id();
        }
        $status = $this->db->affected_rows();
        return ($status == 0) ? FALSE : $id;
    }
    

    
    function update($data = array())
    {       
        if (isset($data['position_name'])) {
            $this->db->set('position_name', $data['position_name']);
        }

        if (isset($data['position_code'])) {
            $this->db->set('position_code', $data['position_code']);
        }

        if (isset($data['position_majors_id'])) {
            $this->db->set('position_majors_id', $data['position_majors_id']);
        }
        
        $this->db->where('position_id', $data['position_id']);
        $this->db->update('position');
        $id = $data['position_id'];
        $status = $this->db->affected_rows();
        return ($status == 0) ? FALSE : $id;
    }

    function delete($id)
    {
        $this->db->where('position_id', $id);
        $this->db->delete('position');
    }

    public function is_exist($field, $value)
    {
        $this->db->where($field, $value);

        return $this->db->count_all_results('position') > 0 ? TRUE : FALSE;

    }

}