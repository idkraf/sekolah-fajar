<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pegawai_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    // Get From Databases
    function get($params = array())
    {

        if (isset($params['id'])) {
            $this->db->where('employee.employee_id', $params['id']);
        }
        
        if (isset($params['pegawai_search'])) {
            $this->db->where('employee_nis', $params['pegawai_search']);
            $this->db->or_like('employee_name', $params['pegawai_search']);
        }

        if (isset($params['employee_name'])) {
            $this->db->where('employee.employee_name', $params['employee_name']);
        }

        if (isset($params['status'])) {
            $this->db->where('employee.employee_status', $params['status']);
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
            $this->db->order_by('employee_name', 'asc');
        }

        $res = $this->db->get('employee');
        if (isset($params['id'])) {
            return $res->row_array();
        } else if (isset($params['employee_nip'])) {
            return $res->row_array();
        } else {
            return $res->result_array();
        }
    }

    
    function get_position($params = array())
    {
        
        if (isset($params['id'])) {
            $this->db->where('position_id', $params['id']);
        }

        if (isset($params['position_name'])) {
            $this->db->where('position_name', $params['position_name']);
        }

        if (isset($params['position_code'])) {
            $this->db->where('position_code', $params['position_code']);
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
            $this->db->order_by('position_id', 'asc');
        }

        $this->db->select('position_id, position_name, position_code');
        $res = $this->db->get('position');

        if (isset($params['id'])) {
            return $res->row_array();
        } else {
            return $res->result_array();
        }
    }

    //function get_strata($params = array())
    //{

    //}
    
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
        if (isset($data['employee_id'])) {
            $this->db->set('employee_id', $data['employee_id']);
        }

        if (isset($data['employee_name'])) {
            $this->db->set('employee_name', $data['employee_name']);
        }

        if (isset($data['employee_nip'])) {
            $this->db->set('employee_nip', $data['employee_nip']);
        }
        
        if (isset($data['employee_email'])) {
            $this->db->set('employee_email', $data['employee_email']);
        }

        if (isset($data['employee_phone'])) {
            $this->db->set('employee_phone', $data['employee_phone']);
        }
        
        if (isset($data['employee_address'])) {
            $this->db->set('employee_address', $data['employee_address']);
        }

        if (isset($data['employee_photo'])) {
            $this->db->set('employee_photo', $data['employee_photo']);
        }
        if (isset($data['employee_majors_id'])) {
            $this->db->set('employee_majors_id', $data['employee_majors_id']);
        }

        $status = $this->db->affected_rows();
        return ($status == 0) ? FALSE : $id;
    }
    
    function add_majors($data = array())
    {
        
        if (isset($data['majors_id'])) {
            $this->db->set('majors_id', $data['majors_id']);
        }

        if (isset($data['majors_name'])) {
            $this->db->set('majors_name', $data['majors_name']);
        }

        if (isset($data['majors_short_name'])) {
            $this->db->set('majors_short_name', $data['majors_short_name']);
        }

        if (isset($data['majors_id'])) {
            $this->db->where('majors_id', $data['majors_id']);
            $this->db->update('majors');
            $id = $data['majors_id'];
        } else {
            $this->db->insert('majors');
            $id = $this->db->insert_id();
        }

        $status = $this->db->affected_rows();
        return ($status == 0) ? FALSE : $id;
    }
    

    function delete($id)
    {
    }

    function delete_majors($id)
    {
        $this->db->where('majors_id', $id);
        $this->db->delete('majors');
    }

    function delete_position($id)
    {
        $this->db->where('position_id', $id);
        $this->db->delete('position');
    }

    public function is_exist($field, $value)
    {
        $this->db->where($field, $value);

        return $this->db->count_all_results('employee') > 0 ? TRUE : FALSE;

    }
}