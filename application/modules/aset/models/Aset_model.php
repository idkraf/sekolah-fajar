<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Aset_model extends CI_Model {

    var $table = 'aset';
    var $order = array('id' => 'desc');
    var $column_search = array('nama_barang');

    private function _get_datatables_query() {
        
        $this->db->select('aset.*,x1.nama_merek, x2.nama_kategori, x3.nama_ruangan, x4.nama_dana, x5.nama_kondisi, x6.nama_bahan');        
        $this->db->join('merek x1', 'x1.id_merek = aset.merek_id');
        $this->db->join('kategori x2', 'x2.idkategori = aset.kategori_id');
        $this->db->join('ruangan x3', 'x3.idruangan = aset.ruangan_id');
        $this->db->join('dana x4', 'x4.iddana = aset.dana_id');
        $this->db->join('kondisi x5', 'x5.id = aset.kondisi_id');
        $this->db->join('bahan x6', 'x6.id = aset.bahan_id');
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

    function add($data = array()) {

        if (isset($data['id'])) {
            $this->db->set('id', $data['id']);
        }
        if (isset($data['idbarang'])) {
            $this->db->set('idbarang', $data['idbarang']);
        }
        if (isset($data['merek_id'])) {
            $this->db->set('merek_id', $data['merek_id']);
        }
        if (isset($data['kategori_id'])) {
            $this->db->set('kategori_id', $data['kategori_id']);
        }
        if (isset($data['ruangan_id'])) {
            $this->db->set('ruangan_id', $data['ruangan_id']);
        }
        if (isset($data['dana_id'])) {
            $this->db->set('dana_id', $data['dana_id']);
        }
        if (isset($data['kondisi_id'])) {
            $this->db->set('kondisi_id', $data['kondisi_id']);
        }
        if (isset($data['bahan_id'])) {
            $this->db->set('bahan_id', $data['bahan_id']);
        }
        if (isset($data['nama_barang'])) {
            $this->db->set('nama_barang', $data['nama_barang']);
        }
        if (isset($data['kode_barang'])) {
            $this->db->set('kode_barang', $data['kode_barang']);
        }
        if (isset($data['nomor_register'])) {
            $this->db->set('nomor_register', $data['nomor_register']);
        }
        if (isset($data['ukuran'])) {
            $this->db->set('ukuran', $data['ukuran']);
        }
        if (isset($data['nomor_rangka'])) {
            $this->db->set('nomor_rangka', $data['nomor_rangka']);
        }
        
        if (isset($data['nomor_mesin'])) {
            $this->db->set('nomor_mesin', $data['nomor_mesin']);
        }
        
        if (isset($data['nomor_polisi'])) {
            $this->db->set('nomor_polisi', $data['nomor_polisi']);
        }
        
        if (isset($data['bpkb'])) {
            $this->db->set('bpkb', $data['bpkb']);
        }
        
        if (isset($data['asal_usul'])) {
            $this->db->set('asal_usul', $data['asal_usul']);
        }
        if (isset($data['harga'])) {
            $this->db->set('harga', $data['harga']);
        }
        if (isset($data['keterangan'])) {
            $this->db->set('keterangan', $data['keterangan']);
        }
        if (isset($data['stok'])) {
            $this->db->set('stok', $data['stok']);
        }
        if (isset($data['tanggal_pembelian'])) {
            $this->db->set('tanggal_pembelian', $data['tanggal_pembelian']);
        }
        //if (isset($data[''])) {
        //    $this->db->set('', $data['']);
       // }
        
        
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('aset');
            $id = $data['id'];
        } else {
            $this->db->insert('aset');
            $id = $this->db->insert_id();
        }

        $status = $this->db->affected_rows();
        return ($status == 0) ? FALSE : $id;
    }

}
