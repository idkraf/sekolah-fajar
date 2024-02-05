<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Peminjaman_model extends CI_Model {

    var $table = 'peminjaman';
    var $order = array('id' => 'desc');
    var $column_search = array('student_full_name','nama','majors_name','class_name');

    private function _get_datatables_query($params = null) {
        
        $this->db->select('peminjaman.*');
        $this->db->select('student.student_full_name');        
        $this->db->select('buku.kode, buku.nama');
        $this->db->select('class.class_name');
        $this->db->select('majors.majors_name');

        $this->db->join('student', 'student.student_id = peminjaman.student_id');
        $this->db->join('buku', 'buku.id = peminjaman.buku_id');
        $this->db->join('class', 'class.class_id = peminjaman.kelas');
        $this->db->join('majors', 'majors.majors_id = peminjaman.unit');
        $this->db->from($this->table);
        $i = 0;

        if (isset($params['class_id'])) {
            if($params['class_id'] != "0"){
            $this->db->where('kelas', $params['class_id']);
            }
        }

        if (isset($params['majors_id'])) {
            if($params['majors_id'] != "0"){
            $this->db->where('unit', $params['majors_id']);
            }
        }

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
    
    function get_datatables($m, $pr) {
        $params = array();
        $params['class_id'] = $pr;
        $params['majors_id'] = $m;
        $this->_get_datatables_query($params);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();

        return $query->result();
    }
    
    function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all() {
        $this->db->select('peminjaman.id');
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function get($table, $data = null, $where = null)
    {
        if ($data != null) {
            return $this->db->get_where($table, $data)->row_array();
        } else {
            return $this->db->get_where($table, $where)->result_array();
        }
    }

    public function update($table, $pk, $id, $data)
    {
        $this->db->where($pk, $id);
        return $this->db->update($table, $data);
    }

    public function insert($table, $data, $batch = false)
    {
        return $batch ? $this->db->insert_batch($table, $data) : $this->db->insert($table, $data);
    }

    public function delete($table, $pk, $id)
    {
        return $this->db->delete($table, [$pk => $id]);
    }


}
