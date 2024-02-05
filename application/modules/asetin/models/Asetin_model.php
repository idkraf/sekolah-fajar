<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Asetin_model extends CI_Model {

    public function getAsetMasuk($limit = null, $id_barang = null, $range = null)
    {
        
        $this->db->select('x.*,x1.nama_barang,x2.nama_merek,x3.nama_kategori');
        $this->db->join('aset x1', 'x.barang_id = x1.idbarang', 'left');
        $this->db->join('merek x2', 'x1.merek_id = x2.id_merek', 'left');
        $this->db->join('kategori x3', 'x1.kategori_id = x3.idkategori', 'left');
        if ($limit != null) {
            $this->db->limit($limit);
        }
        $this->db->order_by('idbarang_masuk', 'DESC');
        return $this->db->get('aset_masuk x')->result_array();
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
