<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Aset_set extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged') == NULL) {
            header("Location:" . site_url('manage/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
        }
        $list_access = array(SUPERUSER);
        if (!in_array($this->session->userdata('uroleid'),$list_access)) {
            redirect('manage');
        }

        $this->load->model('Aset_model', 'admin');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Aset";
        //$data['aset'] = $this->admin->get('aset');
        //$data['aset'] = $this->admin->getAset();
        //$data['main'] = 'aset/data';
        $data['main'] = 'aset/aset_list';
        $this->load->view('manage/layout', $data);
    }

    private function _validasi()
    {
        //`idbarang` text NOT NULL,
        //`merek_id` int(11) NOT NULL,
        //`kategori_id` int(11) NOT NULL,
        //`ruangan_id` int(11) NOT NULL,
        //`dana_id` int(11) NOT NULL,
        //`nama_barang` varchar(128) NOT NULL,
        //`keterangan` varchar(256) NOT NULL,
        //`stok` int(11) NOT NULL,
        //`gambar` varchar(255) NOT NULL,
        //`tanggal_pembelian` date NOT NULL
        $this->form_validation->set_rules('idbarang', 'Id Aset', 'required|trim');
        $this->form_validation->set_rules('merek_id', 'Merek Aset', 'required');
        $this->form_validation->set_rules('kategori_id', 'Kategori Aset', 'required');
        $this->form_validation->set_rules('ruangan_id', 'Ruangan Aset', 'required');
        $this->form_validation->set_rules('dana_id', 'Dana Aset', 'required');
        $this->form_validation->set_rules('nama_barang', 'Nama Aset', 'required|trim');
        $this->form_validation->set_rules('keterangan', 'Nama Aset', 'required|trim');
        $this->form_validation->set_rules('stok', 'Stok','required|trim|numeric');
        $this->form_validation->set_rules('gambar', 'Gambar Aset', 'required');
        $this->form_validation->set_rules('tanggal_pembelian', 'Tanggal Pembelian Aset', 'required');
    }

    public function add($getId = NULL)
    {
        if($getId == NULL){
            $this->_validasi();
            if ($this->form_validation->run() == false) {
                $data['title'] = "Aset";
                $data['main'] = 'aset/add';
                $data['merek'] = $this->admin->get('merek');
                $data['kategori'] = $this->admin->get('kategori');
                $data['ruangan'] = $this->admin->get('ruangan');
                $data['dana'] = $this->admin->get('dana');
                $data['bahan'] = $this->admin->get('bahan');
                $data['kondisi'] = $this->admin->get('kondisi');
                $this->load->view('manage/layout', $data);
            } else {
                $input = $this->input->post(null, true);
                //$insert = $this->admin->insert('aset', $input);
                $insert = $this->admin->add('aset', $input);
                if ($insert) {
                                    
                    if (!empty($_FILES['filegambar']['name'])) {
                        $paramsupdate['gambar'] = $this->do_upload($name = 'filegambar', $fileName= $id);
                    } 
                    
                    $paramsupdate['id'] = $insert;
                    $this->admin->add($paramsupdate);
                    
                    $this->session->set_flashdata('success','Data berhasil disimpan');
                    redirect('manage/aset');
                } else {
                    $this->session->set_flashdata('failed','data gagal disimpan');
                    redirect('manage/aset/add');
                }
            }
        }else{
            
            $id = encode_php_tags($getId);
            
            $this->_validasi();
            if ($this->form_validation->run() == false) {
                $data['title'] = "Aset";
                //$data['aset'] = $this->admin->get('aset', ['id' => $id]);
                $data['aset'] = $this->admin->getAsetEdit(['id_barang' => $id]);
                $data['merek'] = $this->admin->get('merek');
                $data['kategori'] = $this->admin->get('kategori');
                $data['ruangan'] = $this->admin->get('ruangan');
                $data['dana'] = $this->admin->get('dana');
                $data['kondisi'] = $this->admin->get('kondisi');
                $data['bahan'] = $this->admin->get('bahan');
                
                $data['main'] = 'aset/edit';
                $this->load->view('manage/layout', $data);
                //$this->template->load('templates/dashboard', 'gudang/edit', $data);
            } else {
                $input = $this->input->post(null, true);                
                 $input['id'] = $id;
                //$update = $this->admin->update('aset', 'id', $id, $input);                
                $update = $this->admin->add('aset', $input);
                if ($update) {
                    $this->session->set_flashdata('success','Data berhasil disimpan');
                    redirect('manage/aset');
                } else {
                    $this->session->set_flashdata('failed','data gagal disimpan');
                    redirect('manage/aset/add');
                }
            }
        }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Aset";
            $data['aset'] = $this->admin->get('aset', ['idbarang' => $id]);
            $data['merek'] = $this->admin->get('merek');
            $data['kategori'] = $this->admin->get('kategori');
            $data['ruangan'] = $this->admin->get('ruangan');
            $data['dana'] = $this->admin->get('dana');
            $data['kondisi'] = $this->admin->get('kondisi');
            $data['bahan'] = $this->admin->get('bahan');
            
            $data['main'] = 'aset/edit';
            $this->load->view('manage/layout', $data);
            //$this->template->load('templates/dashboard', 'gudang/edit', $data);
        } else {
            $input = $this->input->post(null, true);                
            $input['id'] = $id;          
            $update = $this->admin->add('aset', $input);
            //$update = $this->admin->update('aset', 'idbarang', $id, $input);
            if ($update) {
                
                if (!empty($_FILES['filegambar']['name'])) {
                    $paramsupdate['gambar'] = $this->do_upload($name = 'filegambar', $fileName= $id);
                } 
                
                $paramsupdate['id'] = $insert;
                $this->admin->add($paramsupdate);

                $this->session->set_flashdata('success','Data berhasil disimpan');
                redirect('manage/aset');
            } else {
                $this->session->set_flashdata('failed','data gagal disimpan');
                redirect('manage/aset/add');
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('aset', 'idbarang', $id)) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        } else {
            $this->session->set_flashdata('failed', 'Data gagal dihapus');
        }
        redirect('manage/aset');
    }
    
    public function ajax_list() {
        $list = $this->admin->get_datatables();
        $data = array();
        $no = 0;
        foreach ($list as $prd) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $prd->nama_barang;
            $row[] = $prd->nama_merek;
            $row[] = $prd->nama_kategori;
            $row[] = $prd->nama_dana;
            $row[] = $prd->keterangan;
            $row[] = $prd->stok;
            $row[] = $prd->tanggal_pembelian;
            $row[] = '<a href="'.base_url('manage/aset/edit'). '/' . $prd->id .'" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-edit"></i></a>
            <a onclick="return confirm("Yakin ingin hapus?")" href="'. base_url('manage/aset/delete') . '/' . $prd->idbarang .'" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a>
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

    
    // Setting Upload File Requied
  function do_upload($name=NULL, $fileName=NULL) {
    $this->load->library('upload');

    $config['upload_path'] = FCPATH . 'media/aset/';

    /* create directory if not exist */
    if (!is_dir($config['upload_path'])) {
      mkdir($config['upload_path'], 0777, TRUE);
    }

    $config['allowed_types'] = 'gif|jpg|jpeg|png';
    $config['max_size'] = '1024';
    $config['file_name'] = $fileName;
    $this->upload->initialize($config);

    if (!$this->upload->do_upload($name)) {
      $this->session->set_flashdata('success', $this->upload->display_errors('', ''));
      redirect(uri_string());
    }

    $upload_data = $this->upload->data();

    return $upload_data['file_name'];
  }

}
