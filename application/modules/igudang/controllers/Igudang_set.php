<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Igudang_set extends CI_Controller {

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

        $this->load->model('Igudang_model', 'admin');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Werehouse";
        $data['gudang'] = $this->admin->get('igudang');
        $data['main'] = 'igudang/data';
        $this->load->view('manage/layout', $data);
        //$this->template->load('templates/dashboard', 'gudang/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('nama_gudang', 'Nama Gudang', 'required|trim');
    }

    public function add($getId = NULL)
    {
    if($getId == NULL){
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Werehouse";
            $data['main'] = 'igudang/add';
            $this->load->view('manage/layout', $data);
            //$this->template->load('templates/dashboard', 'gudang/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('igudang', $input);
            if ($insert) {
                $this->session->set_flashdata('success','Data berhasil disimpan');
                redirect('manage/igudang');
            } else {
                $this->session->set_flashdata('failed','data gagal disimpan');
                redirect('manage/igudang/add');
            }
        }
    }else{
        
        $id = encode_php_tags($getId);
        
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Werehouse";
            $data['gudang'] = $this->admin->get('igudang', ['id_gudang' => $id]);
            
            $data['main'] = 'igudang/edit';
            $this->load->view('manage/layout', $data);
            //$this->template->load('templates/dashboard', 'gudang/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('igudang', 'id_gudang', $id, $input);
            if ($update) {
                $this->session->set_flashdata('success','Data berhasil disimpan');
                redirect('manage/igudang');
            } else {
                $this->session->set_flashdata('failed','data gagal disimpan');
                redirect('manage/igudang/add');
            }
        }
    }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Werehouse";
            $data['gudang'] = $this->admin->get('igudang', ['id_gudang' => $id]);
            
            $data['main'] = 'igudang/edit';
            $this->load->view('manage/layout', $data);
            //$this->template->load('templates/dashboard', 'gudang/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('igudang', 'id_gudang', $id, $input);
            if ($update) {
                $this->session->set_flashdata('success','Data berhasil disimpan');
                redirect('manage/igudang');
            } else {
                $this->session->set_flashdata('failed','data gagal disimpan');
                redirect('manage/igudang/add');
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('igudang', 'id_gudang', $id)) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        } else {
            $this->session->set_flashdata('failed', 'Data gagal dihapus');
        }
        redirect('manage/igudang');
    }
}