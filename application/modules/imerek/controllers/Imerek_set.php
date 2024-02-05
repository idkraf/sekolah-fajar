<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Imerek_set extends CI_Controller {

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

        $this->load->model('Imerek_model', 'admin');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Merek";
        $data['merek'] = $this->admin->get('imerek');
        $data['main'] = 'imerek/data';
        $this->load->view('manage/layout', $data);
        //$this->template->load('templates/dashboard', 'merek/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('nama_merek', 'Nama Merek', 'required|trim');
    }

    public function add($getId = NULL)
    {
    if($getId == NULL){
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Merek";
            $data['main'] = 'imerek/add';
            $this->load->view('manage/layout', $data);
            //$this->template->load('templates/dashboard', 'merek/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('imerek', $input);
            if ($insert) {
                $this->session->set_flashdata('success','Data berhasil disimpan');
                redirect('manage/imerek');
            } else {
                $this->session->set_flashdata('failed','data gagal disimpan');
                redirect('manage/imerek/add');
            }
        }
    }else{
        
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Merek";
            $data['merek'] = $this->admin->get('imerek', ['id_merek' => $id]);
            
            $data['main'] = 'imerek/edit';
            $this->load->view('manage/layout', $data);
            //$this->template->load('templates/dashboard', 'merek/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('imerek', 'id_merek', $id, $input);
            if ($update) {
                $this->session->set_flashdata('success','Data berhasil disimpan');
                redirect('manage/imerek');
            } else {
                $this->session->set_flashdata('failed','data gagal disimpan');
                redirect('manage/imerek/add');
            }
        }
    }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Merek";
            $data['merek'] = $this->admin->get('imerek', ['id_merek' => $id]);
            
            $data['main'] = 'imerek/edit';
            $this->load->view('manage/layout', $data);
            //$this->template->load('templates/dashboard', 'merek/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('imerek', 'id_merek', $id, $input);
            if ($update) {
                $this->session->set_flashdata('success','Data berhasil disimpan');
                redirect('manage/imerek');
            } else {
                $this->session->set_flashdata('failed','data gagal disimpan');
                redirect('manage/imerek/add');
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('imerek', 'id_merek', $id)) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        } else {
            $this->session->set_flashdata('failed', 'Data gagal dihapus');
        }
        redirect('manage/imerek');
    }
}
