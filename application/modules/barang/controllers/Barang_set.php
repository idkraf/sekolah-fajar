<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_set extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged') == NULL) {
          header("Location:" . site_url('manage/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
        }

        $this->load->model('Barang_model', 'admin');
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
            $row[] = '<a href="'.base_url('manage/barang/edit'). '/' . $prd->id .'" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-edit"></i></a>
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

        $data['title'] = "Inventory";
        $data['barang'] = $this->admin->getBarang();
        $data['main'] = 'barang/list';
        $this->load->view('manage/layout', $data);
        //$this->template->load('templates/dashboard', 'barang/data', $data);
    }
    public function detail($id)
    {
        $data['title'] = 'Barang';

        //menampilkan data berdasarkan id
        $data['data'] = $this->barang_model->detail_join($id, 'barang')->result();

        $data['main'] = 'barang/data';
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

        if ($_POST AND $this->form_validation->run() == TRUE) {
            
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
            $input['stok'] = $input['stok_awal'];
            if (@$_FILES['image']['name'] != null) {
                if ($this->upload->do_upload('image')) {
                    $input['image'] = $this->upload->data('file_name');
                    $insert = $this->admin->insert('barang', $input);
                    if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('Succes','Data Berhasil Disimpan');
                    } 
                    redirect('manage/barang');
                }else{
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                        redirect('manage/barang/add');
                }                
            }else{
                $input['image'] = null;
                $insert = $this->admin->insert('barang', $input);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('Succes','Data Berhasil Disimpan');
                    redirect('manage/barang');
                }else{
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                        redirect('manage/barang/add');
                }
            }  

        } else {
                    

            $data['title'] = "Inventory";
            $data['jenis'] = $this->admin->get('jenis');
            $data['warna'] = $this->admin->get('warna');
            $data['rasa'] = $this->admin->get('rasa');
            $data['merek'] = $this->admin->get('merek');
            $data['satuan'] = $this->admin->get('satuan');
            $data['gudang'] = $this->admin->get('gudang');
            $data['stok_awal'] = "stok_awal";
            $data['stok'] = "stok_awal";
            $data['harga_barang'] = "harga_barang";

            if ($id != null) {                
                $data['stok_akhir'] = "stok_awal";
                $data['barang'] = $this->admin->get('barang', ['id' => $id]);

                $data['id_barang'] = $data['barang']['id_barang'];
            }else{
                    
                // Mengenerate ID Barang
                $kode_terakhir = $this->admin->getMax('barang', 'id_barang');
                $kode_tambah = substr($kode_terakhir, -6, 6);
                $kode_tambah++;
                $number = str_pad($kode_tambah, 6, '0', STR_PAD_LEFT);
                $data['id_barang'] = 'B' . $number;

            }


            $data['main'] = 'barang/add';
            $this->load->view('manage/layout', $data);
                      
        }
    }

    public function _add($id = null)
    {            
        $list_access = array(SUPERUSER);
        if (!in_array($this->session->userdata('uroleid'),$list_access)) {
        redirect('manage');
        }
        $this->load->library('form_validation');
        
        if($id == null){
            $this->_validasi();
            $this->_config();
            if ($this->form_validation->run() == false) {
                $data['title'] = "Inventory";
                $data['jenis'] = $this->admin->get('jenis');
                $data['warna'] = $this->admin->get('warna');
                $data['rasa'] = $this->admin->get('rasa');
                $data['merek'] = $this->admin->get('merek');
                $data['satuan'] = $this->admin->get('satuan');
                $data['gudang'] = $this->admin->get('gudang');
                $data['stok_awal'] = "stok_awal";
                $data['stok'] = "stok_awal";
                $data['harga_barang'] = "harga_barang";
                // Mengenerate ID Barang
                $kode_terakhir = $this->admin->getMax('barang', 'id_barang');
                $kode_tambah = substr($kode_terakhir, -6, 6);
                $kode_tambah++;
                $number = str_pad($kode_tambah, 6, '0', STR_PAD_LEFT);
                $data['id_barang'] = 'B' . $number;

                $data['main'] = 'barang/add';
                $this->load->view('manage/layout', $data);
                
            } else {
                
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
                $input['stok'] = $input['stok_awal'];
                if (@$_FILES['image']['name'] != null) {
                    if ($this->upload->do_upload('image')) {
                        $input['image'] = $this->upload->data('file_name');
                        $insert = $this->admin->insert('barang', $input);
                        if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('Succes','Data Berhasil Disimpan');
                        } 
                        redirect('manage/barang');
                    }else{
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('error', $error);
                            redirect('manage/barang/add');
                    }                
                }else{
                    $input['image'] = null;
                    $insert = $this->admin->insert('barang', $input);
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('Succes','Data Berhasil Disimpan');
                        redirect('manage/barang');
                    }else{
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('error', $error);
                            redirect('manage/barang/add');
                    }
                }            
            }
        }
        else{
            
            $id = encode_php_tags($id);
            $this->_validasi();
            $this->_config();
            if ($this->form_validation->run() == false) {
                $data['title'] = "Inventory";
                $data['jenis'] = $this->admin->get('jenis');
                $data['warna'] = $this->admin->get('warna');
                $data['rasa'] = $this->admin->get('rasa');
                $data['merek'] = $this->admin->get('merek');
                $data['satuan'] = $this->admin->get('satuan');
                $data['gudang'] = $this->admin->get('gudang');
                $data['stok_awal'] = "stok_awal";

                // $stok = "stok";
                // $stok_akhir = "stok_akhir";
                // $data['stok'] = ($stok_akhir < $data['stok_awal']) ? $stok + ($data['stok_awal'] - $stok_akhir) : $stok - ($stok_akhir - $data['stok_awal']);

                $data['stok'] = "stok_awal";
                $data['stok_akhir'] = "stok_awal";
                $data['harga_barang'] = "harga_barang";
                $data['barang'] = $this->admin->get('barang', ['id_barang' => $id]);                
                
                $data['main'] = 'barang/edit';
                $this->load->view('manage/layout', $data);                    
            
            } else {
                // $input = $this->input->post(null, true);
                $input['id_barang'] = $this->input->post('id_barang');
                $input['image'] = $this->input->post('image');
                $input['nama_barang'] = $this->input->post('nama_barang');
                $input['jenis_id'] = $this->input->post('jenis_id');
                $input['warna_id'] = $this->input->post('warna_id');
                $input['rasa_id'] = $this->input->post('rasa_id');
                $input['merek_id'] = $this->input->post('merek_id');
                $input['satuan_id'] = $this->input->post('satuan_id');
                $stok = $this->input->post('stok');
                $stok_akhir = $this->input->post('stok_akhir');
                $input['stok_awal'] = $this->input->post('stok_awal');
                $input['harga_barang'] = $this->input->post('harga_barang');
                $input['gudang_id'] = $this->input->post('gudang_id');
                $input['stok'] = ($stok_akhir < $input['stok_awal']) ? $stok + ($input['stok_awal'] - $stok_akhir) : $stok - ($stok_akhir - $input['stok_awal']);
                
                if (empty($_FILES['image']['name'])) {
                    $insert = $this->admin->update('barang', 'id_barang', $id, $input);
                    if ($insert) {
                        $this->session->set_flashdata('success','Perubahan berhasil disimpan');
                        redirect('manage/barang');
                    }else{
                        $this->session->set_flashdata('failed','Perubahan tidak disimpan');
                    }
                    redirect('manage/barang/edit'.$id);
                } else {
                    if ($this->upload->do_upload('image') == false) {
                        echo $this->upload->display_errors();
                        die;
                    } else {
                        if ($data['image'] != null) {
                            $old_image = 'assets/upload/' . $data['image'];
                        unlink($old_image);
                        }

                        $input['image'] = $this->upload->data('file_name');
                    $update = $this->admin->update('barang', 'id_barang', $id, $input);
                        if ($update) {
                            $this->session->set_flashdata('success','Perubahan berhasil disimpan');
                            redirect('manage/barang');
                        } 
                        else {
                            //set_pesan('gagal menyimpan perubahan');
                        }
                        redirect('manage/barang/edit'.$id);
                    }
                }
            }
        }
    }
    public function _edit($getId)
    {  
        $id = encode_php_tags($getId);
        $this->_validasi();
        $this->_config();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Inventory";
            $data['jenis'] = $this->admin->get('jenis');
            $data['warna'] = $this->admin->get('warna');
            $data['rasa'] = $this->admin->get('rasa');
            $data['merek'] = $this->admin->get('merek');
            $data['satuan'] = $this->admin->get('satuan');
            $data['gudang'] = $this->admin->get('gudang');
            $data['stok_awal'] = "stok_awal";
            // $stok = "stok";
            // $stok_akhir = "stok_akhir";
            // $data['stok'] = ($stok_akhir < $data['stok_awal']) ? $stok + ($data['stok_awal'] - $stok_akhir) : $stok - ($stok_akhir - $data['stok_awal']);
            $data['stok'] = "stok_awal";
            $data['stok_akhir'] = "stok_awal";
            $data['harga_barang'] = "harga_barang";
            $data['barang'] = $this->admin->get('barang', ['id_barang' => $id]);
            
            
            $data['main'] = 'barang/edit';
            $this->load->view('manage/layout', $data);
            
           // $this->template->load('templates/dashboard', 'barang/edit', $data);
        
        
        } else {
            // $input = $this->input->post(null, true);
            $input['id_barang'] = $this->input->post('id_barang');
            $input['image'] = $this->input->post('image');
            $input['nama_barang'] = $this->input->post('nama_barang');
            $input['jenis_id'] = $this->input->post('jenis_id');
            $input['warna_id'] = $this->input->post('warna_id');
            $input['rasa_id'] = $this->input->post('rasa_id');
            $input['merek_id'] = $this->input->post('merek_id');
            $input['satuan_id'] = $this->input->post('satuan_id');
            $stok = $this->input->post('stok');
            $stok_akhir = $this->input->post('stok_akhir');
            $input['stok_awal'] = $this->input->post('stok_awal');
            $input['harga_barang'] = $this->input->post('harga_barang');
            $input['gudang_id'] = $this->input->post('gudang_id');
            $input['stok'] = ($stok_akhir < $input['stok_awal']) ? $stok + ($input['stok_awal'] - $stok_akhir) : $stok - ($stok_akhir - $input['stok_awal']);
             if (empty($_FILES['image']['name'])) {
                $insert = $this->admin->update('barang', 'id_barang', $id, $input);
                if ($insert) {
                    $this->session->set_flashdata('success','Perubahan berhasil disimpan');
                    redirect('manage/barang');
                }else{
                    $this->session->set_flashdata('failed','Perubahan tidak disimpan');
                }
                redirect('manage/barang/edit'.$id);
            } else {
                if ($this->upload->do_upload('image') == false) {
                    echo $this->upload->display_errors();
                    die;
                } else {
                    if ($data['image'] != null) {
                        $old_image = 'assets/upload/' . $data['image'];
                       unlink($old_image);
                    }

                    $input['image'] = $this->upload->data('file_name');
                   $update = $this->admin->update('barang', 'id_barang', $id, $input);
                    if ($update) {
                        $this->session->set_flashdata('success','Perubahan berhasil disimpan');
                        redirect('manage/barang');
                    } 
                    else {
                        //set_pesan('gagal menyimpan perubahan');
                    }
                    redirect('manage/barang/edit'.$id);
                }
            }
        }
    }
    //public function delete($getId)
    public function delete()
    {
        //$id = encode_php_tags($getId);
        $id = $this->input->post('deleteid'); 
        if ($this->admin->delete('barang', 'id', $id)) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        } else {
            $this->session->set_flashdata('failed', 'Data gagal dihapus');
        }
        redirect('manage/barang');
    }

    public function getstok($getId)
    {
        $id = encode_php_tags($getId);
        $query = $this->admin->cekStok($id);
        output_json($query);
    }
}
