<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Semester_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    
    // Get semester from database
    function get($params = array())
    {
        if(isset($params['id']))
        {
            $this->db->where('semester_id', $params['id']);
        }

        if(isset($params['name']))
        {
            $this->db->where('semester_name', $params['name']);
        }
        if(isset($params['status']))
        {
            $this->db->where('semester_status', $params['status']);
        }

        if(isset($params['period_id']))
        {
           
        }

        if(isset($params['limit']))
        {
            if(!isset($params['offset']))
            {
                $params['offset'] = NULL;
            }

            $this->db->limit($params['limit'], $params['offset']);
        }
        if(isset($params['order_by']))
        {
            $this->db->order_by($params['order_by'], 'desc');
        }
        else
        {
            $this->db->order_by('semester_id', 'desc');
        }

        $this->db->select('semester_id, semester.period_id, semester_name, semester_status, period.period_start, period.period_end');
        $this->db->join('period', 'period.period_id = semester.period_id', 'left');
        $res = $this->db->get('semester');

        if(isset($params['id']))
        {
            return $res->row_array();
        }
        else
        {
            return $res->result_array();
        }
    }
    
    // Add and update to database
    function add($data = array()) {

    if(isset($data['semester_id'])) {
        $this->db->set('semester_id', $data['semester_id']);
    }
    if(isset($data['period_id'])) {
        $this->db->set('period_id', $data['period_id']);
    }

    if(isset($data['semester_name'])) {
        $this->db->set('semester_name', $data['semester_name']);
    }


    if(isset($data['semester_status'])) {
        $this->db->set('semester_status', $data['semester_status']);
    }

    if (isset($data['semester_id'])) {
        $this->db->where('semester_id', $data['semester_id']);
        $this->db->update('semester');
        $id = $data['semester_id'];
    } else if (isset($data['status_active'])) {
        $this->db->update('semester');
        $id = NULL;
    } else {
        $this->db->insert('semester');
        $id = $this->db->insert_id();
    }

    $status = $this->db->affected_rows();
    return ($status == 0) ? FALSE : $id;
}

// Delete semester to database
function delete($id) {
    $this->db->where('semester_id', $id);
    $this->db->delete('semester');
}

}
