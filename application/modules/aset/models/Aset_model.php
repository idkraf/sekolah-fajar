<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Aset_model extends CI_Model {

    var $table = 'aset';
    var $order = array('id' => 'desc');
    var $column_search = array('nama_barang');

    private function _get_datatables_query() {
        
        $this->db->select('aset.*,x1.nama_merek, x2.nama_kategori, x3.nama_ruangan, x4.nama_dana');        
        $this->db->join('merek x1', 'x1.id_merek = aset.merek_id');
        $this->db->join('kategori x2', 'x2.idkategori = aset.kategori_id');
        $this->db->join('ruangan x3', 'x3.idruangan = aset.ruangan_id');
        $this->db->join('dana x4', 'x4.iddana = aset.dana_id');
        //if ($limit != null) {
        //    $this->db->limit($limit);
        //}

        //if ($id_barang != null) {
        //    $this->db->where('id', $id_barang);
        //}
        //$this->db->order_by('idbarang', 'DESC');
        //return $this->db->get('aset x')->result_array();
        $this->db->from($this->table);
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

    public function getAset($limit = null, $id_barang = null, $range = null)
    {

        $this->db->select('x.*,x1.nama_merek, x2.nama_kategori, x3.nama_ruangan, x4.nama_dana');        
        $this->db->join('merek x1', 'x1.id_merek = x.merek_id');
        $this->db->join('kategori x2', 'x2.idkategori = x.kategori_id');
        $this->db->join('ruangan x3', 'x3.idruangan = x.ruangan_id');
        $this->db->join('dana x4', 'x4.iddana = x.dana_id');
        if ($limit != null) {
            $this->db->limit($limit);
        }

        if ($id_barang != null) {
            $this->db->where('id', $id_barang);
        }
        $this->db->order_by('idbarang', 'DESC');
        return $this->db->get('aset x')->result_array();
    } 
    
    function get_datatables() {
        $this->_get_datatables_query();
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
        $this->db->select('aset.id');
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function getAsetEdit($limit = null, $id_barang = null, $range = null)
    {
        //$query = mysqli_query($con,"SELECT * FROM barang WHERE idbarang='$id'") 
        //or die(mysqli_error($con));
    
        $this->db->select('x.*,x1.nama_merek, x2.nama_kategori, x3.nama_ruangan, x4.nama_dana');        
        $this->db->join('merek x1', 'x1.id_merek = x.merek_id');
        $this->db->join('kategori x2', 'x2.idkategori = x.kategori_id');
        $this->db->join('ruangan x3', 'x3.idruangan = x.ruangan_id');
        $this->db->join('dana x4', 'x4.iddana = x.dana_id');
        if ($limit != null) {
            $this->db->limit($limit);
        }

        if ($id_barang != null) {
            $this->db->where('id', $id_barang);
        }

        //if ($range != null) {
        //    $this->db->where('tanggal_masuk' . ' >=', $range['mulai']);
        //    $this->db->where('tanggal_masuk' . ' <=', $range['akhir']);
       // }

        $this->db->order_by('idbarang', 'DESC');
        return $this->db->get('aset x')->row_array();
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
