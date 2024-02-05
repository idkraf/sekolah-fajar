<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    // Get From Databases
    function get($params = array()) {

        if (isset($params['id'])) {
            $this->db->where('users.user_id', $params['id']);
        }
        if (isset($params['user_id'])) {
            $this->db->where('users.user_id', $params['user_id']);
        }

        if (isset($params['email'])) {
            $this->db->like('user_email', $params['email']);
        }
        
        if (isset($params['password'])) {
            $this->db->like('user_password', $params['password']);
        }

        if (isset($params['search'])) {
            $this->db->where('user_email', $params['search']);
            $this->db->or_like('user_full_name', $params['search']);
        }

        if (isset($params['date'])) {
            $this->db->where('user_input_date', $params['date']);
        }

        if (isset($params['user_role_role_id'])) {
            $this->db->where('user_role_role_id', $params['user_role_role_id']);
        }

        $this->db->where('user_is_deleted', FALSE);

        if (isset($params['limit'])) {
            if (!isset($params['offset'])) {
                $params['offset'] = NULL;
            }

            $this->db->limit($params['limit'], $params['offset']);
        }

        if (isset($params['order_by'])) {
            $this->db->order_by($params['order_by'], 'desc');
        } else {
            $this->db->order_by('user_last_update', 'desc');
        }

        $this->db->select('users.user_id, user_password, user_full_name, user_description,
            user_email, user_is_deleted, user_image, user_input_date, user_last_update');
        $this->db->select('user_role_role_id, user_roles.role_name');

        $this->db->join('user_roles', 'user_roles.role_id = users.user_role_role_id', 'left');
        $res = $this->db->get('users');

        if (isset($params['id'])) {
            return $res->row_array();
        } else {
            return $res->result_array();
        }
    }

    // Get Role From Databases
    function get_role($params = array()) {
        $this->db->select('user_roles.role_id, role_name');

        if (isset($params['id'])) {
            $this->db->where('user_roles.role_id', $params['id']);
        }
        if (isset($params['role_id'])) {
            $this->db->where('user_roles.role_id', $params['role_id']);
        }

        if (isset($params['limit'])) {
            if (!isset($params['offset'])) {
                $params['offset'] = NULL;
            }

            $this->db->limit($params['limit'], $params['offset']);
        }

        if (isset($params['order_by'])) {
            $this->db->order_by($params['order_by'], 'desc');
        } else {
            $this->db->order_by('user_roles.role_id', 'desc');
        }

        $res = $this->db->get('user_roles');

        if (isset($params['id'])) {
            return $res->row_array();
        } else {
            return $res->result_array();
        }
    }    

    function add($data = array()) {

        if (isset($data['user_id'])) {
            $this->db->set('user_id', $data['user_id']);
        }

        if (isset($data['user_password'])) {
            $this->db->set('user_password', $data['user_password']);
        }

        if (isset($data['user_full_name'])) {
            $this->db->set('user_full_name', $data['user_full_name']);
        }

        if (isset($data['user_email'])) {
            $this->db->set('user_email', $data['user_email']);
        }

        if (isset($data['user_image'])) {
            $this->db->set('user_image', $data['user_image']);
        }

        if (isset($data['user_description'])) {
            $this->db->set('user_description', $data['user_description']);
        }

        if (isset($data['user_input_date'])) {
            $this->db->set('user_input_date', $data['user_input_date']);
        }

        if (isset($data['user_last_update'])) {
            $this->db->set('user_last_update', $data['user_last_update']);
        }

        if (isset($data['user_is_deleted'])) {
            $this->db->set('user_is_deleted', $data['user_is_deleted']);
        }

        if (isset($data['user_role_role_id'])) {
            $this->db->set('user_role_role_id', $data['user_role_role_id']);
        }

        if (isset($data['user_id'])) {
            $this->db->where('user_id', $data['user_id']);
            $this->db->update('users');
            $id = $data['user_id'];
        } else {
            $this->db->insert('users');
            $id = $this->db->insert_id();
        }

        $status = $this->db->affected_rows();
        return ($status == 0) ? FALSE : $id;
    }

    function add_role($data = array()) {

        if (isset($data['role_id'])) {
            $this->db->set('role_id', $data['role_id']);
        }

        if (isset($data['role_name'])) {
            $this->db->set('role_name', $data['role_name']);
        }

        if (isset($data['role_id'])) {
            $this->db->where('role_id', $data['role_id']);
            $this->db->update('user_roles');
            $id = $data['role_id'];
        } else {
            $this->db->insert('user_roles');
            $id = $this->db->insert_id();
        }

        $status = $this->db->affected_rows();
        return ($status == 0) ? FALSE : $id;
    }

    function delete($id) {
        $this->db->where('user_id', $id);
        $this->db->delete('users');
    }

    function delete_role($id) {
        $this->db->where('role_id', $id);
        $this->db->delete('user_roles');
    }

    function change_password($id, $params) {
        $this->db->where('user_id', $id);
        $this->db->update('users', $params);
    }

    function cekRole($id, $role){        
        return $this->db
        ->where('role_has_permissions.permission_id', $id)
        ->where('role_has_permissions.role_id', $role)
        ->count_all_results('role_has_permissions');
    }
    
    var $table = 'permision';
    var $order = array('id' => 'desc');
    var $column_search = array('name');

    private function _get_modul_query($role_id= null) {

        $this->db->select('permision.*');
        //$this->db->join('role_has_permissions x2', 'x2.permission_id = permision.id');
        $this->db->from($this->table);
        //if ($role_id != null) {
        //    $this->db->where('role_has_permissions.role_id', $role_id);
        //}
        $i = 0;
        foreach ($this->column_search as $item) { // loop column
            if ($this->input->post('search')['value']) { // if datatable send POST for search
                if ($i === 0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $this->input->post('search')['value']);
                } else {
                    $this->db->or_like($item, $this->input->post('search')['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    
    function get_datatables($role_id= null) {
        $this->_get_modul_query($role_id);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();

        return $query->result();
    }
    
    function get_module($role_id= null) {
        //$this->_get_modul_query($role_id);
        $this->db->from('permision');
        $query = $this->db->get();
        return $query->result();        
    }

    function count_modul_filtered($role_id= null) {
        //$this->_get_modul_query($role_id);
        $this->db->from($this->table);
        //$this->db->where('role_has_permissions.role_id', $role_id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_modul_all() {
        $this->db->select('permision.id');
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function addrule(){

    }
    public function getP($table, $data = null, $where = null)
    {
        if ($data != null) {
            return $this->db->get_where($table, $data)->row_array();
        } else {
            return $this->db->get_where($table, $where)->result_array();
        }
    }

    public function updateP($table, $pk, $id, $data)
    {
        $this->db->where($pk, $id);
        return $this->db->update($table, $data);
    }

    public function insertP($table, $data, $batch = false)
    {
        return $batch ? $this->db->insert_batch($table, $data) : $this->db->insert($table, $data);
    }

    public function deleteP($table, $pk, $id)
    {
        return $this->db->delete($table, [$pk => $id]);
    }

    public function getIfExist($tablex, $where = null)
    {
        $this->db->where($where);
        $this->db->from($tablex);
        $query = $this->db->get();
        if ($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
}
