<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Merek_set extends CI_Controller {

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

        $this->load->model('Merek_model', 'admin');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Merek";
        $data['merek'] = $this->admin->get('merek');
        $data['main'] = 'merek/data';
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
            $data['main'] = 'merek/add';
            $this->load->view('manage/layout', $data);
            //$this->template->load('templates/dashboard', 'merek/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('merek', $input);
            if ($insert) {
                $this->session->set_flashdata('success','Data berhasil disimpan');
                redirect('manage/merek');
            } else {
                $this->session->set_flashdata('failed','data gagal disimpan');
                redirect('manage/merek/add');
            }
        }
    }else{
        
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Merek";
            $data['merek'] = $this->admin->get('merek', ['id_merek' => $id]);
            
            $data['main'] = 'merek/edit';
            $this->load->view('manage/layout', $data);
            //$this->template->load('templates/dashboard', 'merek/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('merek', 'id_merek', $id, $input);
            if ($update) {
                $this->session->set_flashdata('success','Data berhasil disimpan');
                redirect('manage/merek');
            } else {
                $this->session->set_flashdata('failed','data gagal disimpan');
                redirect('manage/merek/add');
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
            $data['merek'] = $this->admin->get('merek', ['id_merek' => $id]);
            
            $data['main'] = 'merek/edit';
            $this->load->view('manage/layout', $data);
            //$this->template->load('templates/dashboard', 'merek/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('merek', 'id_merek', $id, $input);
            if ($update) {
                $this->session->set_flashdata('success','Data berhasil disimpan');
                redirect('manage/merek');
            } else {
                $this->session->set_flashdata('failed','data gagal disimpan');
                redirect('manage/merek/add');
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('merek', 'id_merek', $id)) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        } else {
            $this->session->set_flashdata('failed', 'Data gagal dihapus');
        }
        redirect('manage/merek');
    }
}
