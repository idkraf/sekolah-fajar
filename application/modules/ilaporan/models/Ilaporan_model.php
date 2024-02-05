<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ilaporan_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	
    public function getBarangMasuk($limit = null, $id_barang = null, $range = null)
    {
        $this->db->select('*');
        $this->db->join('users u', 'bm.user_id = u.user_id');
        $this->db->join('isupplier sp', 'bm.supplier_id = sp.id_supplier');
        $this->db->join('inventori b', 'bm.barang_id = b.id_barang');
        $this->db->join('isatuan s', 'b.satuan_id = s.id_satuan');
        if ($limit != null) {
            $this->db->limit($limit);
        }

        if ($id_barang != null) {
            $this->db->where('id_barang', $id_barang);
        }

        if ($range != null) {
            $this->db->where('tanggal_masuk' . ' >=', $range['mulai']);
            $this->db->where('tanggal_masuk' . ' <=', $range['akhir']);
        }

        $this->db->order_by('id_barang_masuk', 'DESC');
        return $this->db->get('inventori_masuk bm')->result_array();
    }

    public function getBarangKeluar($limit = null, $id_barang = null, $range = null)
    {
        $this->db->select('*');
        $this->db->join('users u', 'bk.user_id = u.user_id');
        $this->db->join('inventori b', 'bk.barang_id = b.id_barang');
        $this->db->join('isatuan s', 'b.satuan_id = s.id_satuan');
        $this->db->join('irasa r', 'b.rasa_id = r.id_rasa');
        $this->db->join('imerek m', 'b.merek_id = m.id_merek');
        if ($limit != null) {
            $this->db->limit($limit);
        }
        if ($id_barang != null) {
            $this->db->where('id_barang', $id_barang);
        }
        if ($range != null) {
            $this->db->where('tanggal_keluar' . ' >=', $range['mulai']);
            $this->db->where('tanggal_keluar' . ' <=', $range['akhir']);
        }
        $this->db->order_by('id_barang_keluar', 'DESC');
        return $this->db->get('inventori_keluar bk')->result_array();
    }

}