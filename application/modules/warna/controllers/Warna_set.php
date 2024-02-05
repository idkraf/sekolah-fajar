<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Warna_set extends CI_Controller {

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

        $this->load->model('Warna_model', 'admin');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Warna";
        $data['warna'] = $this->admin->get('warna');
        $data['main'] = 'warna/data';
        $this->load->view('manage/layout', $data);
        //$this->template->load('templates/dashboard', 'warna/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('nama_warna', 'Nama Warna', 'required|trim');
    }

    public function add($getId = NULL)
    {
    if($getId == NULL){
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Warna";
            
            $data['main'] = 'warna/add';
            $this->load->view('manage/layout', $data);
            //$this->template->load('templates/dashboard', 'warna/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('warna', $input);
            if ($insert) {
                $this->session->set_flashdata('success','Data berhasil disimpan');
                redirect('manage/warna');
            } else {
                $this->session->set_flashdata('failed','data gagal disimpan');
                redirect('manage/warna/add');
            }
        }
    }else{
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Warna";
            $data['warna'] = $this->admin->get('warna', ['id_warna' => $id]);
            $data['main'] = 'warna/edit';
            $this->load->view('manage/layout', $data);
            //$this->template->load('templates/dashboard', 'warna/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('warna', 'id_warna', $id, $input);
            if ($update) {
                $this->session->set_flashdata('success','Data berhasil disimpan');
                redirect('manage/warna');
            } else {
                $this->session->set_flashdata('failed','data gagal disimpan');
                redirect('manage/warna/add');
            }
        }
    }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Warna";
            $data['warna'] = $this->admin->get('warna', ['id_warna' => $id]);
            $data['main'] = 'warna/edit';
            $this->load->view('manage/layout', $data);
            //$this->template->load('templates/dashboard', 'warna/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('warna', 'id_warna', $id, $input);
            if ($update) {
                $this->session->set_flashdata('success','Data berhasil disimpan');
                redirect('manage/warna');
            } else {
                $this->session->set_flashdata('failed','data gagal disimpan');
                redirect('manage/warna/add');
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('warna', 'id_warna', $id)) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        } else {
            $this->session->set_flashdata('failed', 'Data gagal dihapus');
        }
        redirect('manage/warna');
    }

}
