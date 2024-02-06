<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventori_set extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged') == NULL) {
          header("Location:" . site_url('manage/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
        }

        $this->load->model('Inventori_model', 'admin');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url'));
    }

    public function ajax_list() {
        $list = $this->admin->get_datatables();
        $data = array();
        $no = 0;
        foreach ($list as $prd) {
            $no++;
            
            $stok_masuk = 0;
            $stok_keluar = 0;
            $stok_akhir = 0;
            $jumlah_keluar = 0;//$prd->stok_awal - $prd->stok;
            $total = 0;//$prd->harga_barang * $prd->stok;

            $row = array();
            $row[] = $no;
            $row[] = $prd->id_barang;
            $row[] = $prd->nama_barang;
            $row[] = $prd->nama_jenis;
            $row[] = $prd->nama_warna;
            $row[] = $prd->nama_rasa;
            $row[] = $prd->nama_merek;
            $row[] = $prd->stok_awal;
            $row[] = $stok_masuk;
            $row[] = $stok_keluar;
            $row[] = $stok_akhir;
            $row[] = $jumlah_keluar;
            $row[] = $prd->nama_satuan;
            $row[] = $prd->harga_barang;
            $row[] = $total;
            $row[] = $prd->nama_gudang;
            $row[] = '<a href="'.base_url('manage/inventori/edit'). '/' . $prd->id .'" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-edit"></i></a>
            <button data-object-id="'.$prd->id.'" class="btn btn-success btn-circle btn-sm delete-object"><i class="fa fa-minus"></i></button>
            ';
            $data[] = $row;
        }
        $output = array(
            "recordsTotal" => $this->admin->count_all(),
            "recordsFiltered" => $this->admin->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
      
    public function index()
    {
        $this->load->library('pagination');

        $data['title'] = "Inventori Gudang";
        $data['barang'] = $this->admin->getBarang();
        $data['main'] = 'inventori/list';
        $this->load->view('manage/layout', $data);
        //$this->template->load('templates/dashboard', 'barang/data', $data);
    }
    public function detail($id)
    {
        $data['title'] = 'Barang';

        //menampilkan data berdasarkan id
        $data['data'] = $this->barang_model->detail_join($id, 'inventori')->result();

        $data['main'] = 'inventori/data';
        $this->load->view('manage/layout', $data);
        //$this->template->load('templates/dashboard', 'barang/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required|trim');
        $this->form_validation->set_rules('jenis_id', 'Jenis Barang', 'required');
        $this->form_validation->set_rules('warna_id', 'Warna Barang', 'required');
        $this->form_validation->set_rules('rasa_id', 'Rasa Barang', 'required');
        $this->form_validation->set_rules('merek_id', 'Merek Barang', 'required');
        $this->form_validation->set_rules('satuan_id', 'Satuan Barang', 'required');
        $this->form_validation->set_rules('stok', 'Stok','required|trim|numeric');
        $this->form_validation->set_rules('stok_akhir', 'Stok Akhir','required|trim|numeric');
        $this->form_validation->set_rules('stok_awal', 'Stok Awal','required|trim|numeric');
        $this->form_validation->set_rules('harga_barang', 'Harga Barang','required|trim|numeric');
        $this->form_validation->set_rules('gudang_id', 'Gudang', 'required');
    }

    private function _config()
    {
        $config['upload_path']      = "./assets/upload";
        $config['allowed_types']    = 'gif|jpg|jpeg|png';
        $config['max_size']         = '2048';
        $config['file_name']         = 'item-'.date('ymd').'-'.substr(md5(rand()),0,10);
        $this->load->library('upload', $config);
    }


    public function add($id = null)
    {            
        $list_access = array(SUPERUSER);
        if (!in_array($this->session->userdata('uroleid'),$list_access)) {
        redirect('manage');
        }
        $this->load->library('form_validation');    
        $this->_validasi();
        $this->_config();

        if ($_POST) {
            
            $input['id_barang'] = $this->input->post('id_barang');
            $input['image'] = $this->input->post('image');
            $input['nama_barang'] = $this->input->post('nama_barang');
            $input['jenis_id'] = $this->input->post('jenis_id');
            $input['warna_id'] = $this->input->post('warna_id');
            $input['rasa_id'] = $this->input->post('rasa_id');
            $input['merek_id'] = $this->input->post('merek_id');
            $input['satuan_id'] = $this->input->post('satuan_id');
            $input['stok_awal'] = $this->input->post('stok_awal');
            $input['harga_barang'] = $this->input->post('harga_barang');
            $input['gudang_id'] = $this->input->post('gudang_id');
            if (@$_FILES['image']['name'] != null) {
                if ($this->upload->do_upload('image')) {
                    $input['image'] = $this->upload->data('file_name');
                    if($id!=null){
                        $stok = $this->input->post('stok');
                        $stok_akhir = $this->input->post('stok_akhir');
                        $input['stok'] = ($stok_akhir < $input['stok_awal']) ? $stok + ($input['stok_awal'] - $stok_akhir) : $stok - ($stok_akhir - $input['stok_awal']);                
                       $this->admin->update('inventori', 'id', $id, $input);
                    }else{
                        $input['stok'] = $input['stok_awal'];
                       $this->admin->insert('inventori', $input);
                    }                   

                    if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('Succes','Data Berhasil Disimpan');
                    } 
                    redirect('manage/inventori');
                }else{
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                        redirect('manage/inventori/add');
                }                
            }else{
                $input['image'] = null;
                //$insert = $this->admin->insert('inventori', $input);
                
                if($id!=null){
                    $stok = $this->input->post('stok');
                    $stok_akhir = $this->input->post('stok_akhir');
                    $input['stok'] = ($stok_akhir < $input['stok_awal']) ? $stok + ($input['stok_awal'] - $stok_akhir) : $stok - ($stok_akhir - $input['stok_awal']);
                    $insert = $this->admin->update('inventori', 'id', $id, $input);
                }else{
                    $input['stok'] = $input['stok_awal'];
                    $insert = $this->admin->insert('inventori', $input);
                }                   

                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('Succes','Data Berhasil Disimpan');
                    redirect('manage/inventori');
                }else{
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                        redirect('manage/inventori/add');
                }
            }  

        } else {
                    

            $data['title'] = "Inventori";
            $data['jenis'] = $this->admin->get('ijenis');
            $data['warna'] = $this->admin->get('iwarna');
            $data['rasa'] = $this->admin->get('irasa');
            $data['merek'] = $this->admin->get('imerek');
            $data['satuan'] = $this->admin->get('isatuan');
            $data['gudang'] = $this->admin->get('igudang');
            $data['stok_awal'] = "stok_awal";
            $data['stok'] = "stok_awal";
            $data['harga_barang'] = "harga_barang";

            if ($id != null) {                
                $data['stok_akhir'] = "stok_awal";
                $data['barang'] = $this->admin->get('inventori', ['id' => $id]);

                $data['id_barang'] = $data['barang']['id_barang'];
            }else{
                    
                // Mengenerate ID Barang
                $kode_terakhir = $this->admin->getMax('inventori', 'id');
                $kode_tambah = substr($kode_terakhir, -6, 6);
                $kode_tambah++;
                $number = str_pad($kode_tambah, 6, '0', STR_PAD_LEFT);
                $data['id_barang'] = 'B' . $number;

            }


            $data['main'] = 'inventori/add';
            $this->load->view('manage/layout', $data);
                      
        }
    }
   
    
    public function delete()
    {
        //$id = encode_php_tags($getId);
        $id = $this->input->post('deleteid'); 
        if ($this->admin->delete('inventori', 'id', $id)) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        } else {
            $this->session->set_flashdata('failed', 'Data gagal dihapus');
        }
        redirect('manage/inventori');
    }

    public function getstok($getId)
    {
        $id = encode_php_tags($getId);
        $query = $this->admin->cekStok($id);
        output_json($query);
    }
}
