<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventaris_model extends CI_Model {

    var $table = 'inventaris';
    var $order = array('idinventaris' => 'desc');
    var $column_search = array('nama_barang');

    private function _get_datatables_query($params = null) {
        $this->db->select('inventaris.*,a.nama_barang, s.majors_name,u.employee_name');
        $this->db->select('a.*,x1.nama_merek, x2.nama_kategori, x3.nama_ruangan, x4.nama_dana, x5.nama_kondisi, x6.nama_bahan');        
        

        $this->db->join('pegawai u', 'inventaris.user_id = u.employee_id');
        $this->db->join('majors s', 'inventaris.majors_id = s.majors_id');
        //$this->db->join('ruangan r', 'inventaris.ruangan_id = r.idruangan');

        $this->db->join('aset a', 'inventaris.aset_id = a.id');
        $this->db->join('merek x1', 'x1.id_merek = a.merek_id', 'left');
        $this->db->join('kategori x2', 'x2.idkategori = a.kategori_id', 'left');
        $this->db->join('ruangan x3', 'x3.idruangan = a.ruangan_id', 'left');
        $this->db->join('dana x4', 'x4.iddana = a.dana_id', 'left');
        $this->db->join('kondisi x5', 'x5.id = a.kondisi_id', 'left');
        $this->db->join('bahan x6', 'x6.id = a.bahan_id', 'left');
        $this->db->from($this->table);
        $i = 0;

        if (isset($params['ruangan_id'])) {
            if($params['ruangan_id'] != "0"){
            $this->db->where('inventaris.ruangan_id', $params['ruangan_id']);
            }
        }

        if (isset($params['majors_id'])) {
            if($params['majors_id'] != "0"){
            $this->db->where('inventaris.majors_id', $params['majors_id']);
            }
        }

        foreach ($this->column_search as $item) { // loop column
            if (isset($_POST['search']) && $this->input->post('search')['value']) { // if datatable send POST for search
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
	
    function get_datatables($m=0,$r=0) {
        $params = array();
        $params['majors_id'] = $m;
        $params['ruangan_id'] = $r;
        $this->_get_datatables_query($params);
        if (isset($_POST['length']) && $_POST['length'] != -1)
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
        $this->db->select('inventaris.id');
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