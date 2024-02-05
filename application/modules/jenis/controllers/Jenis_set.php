<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_set extends CI_Controller {

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

        $this->load->model('Jenis_model', 'admin');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Type";
        $data['jenis'] = $this->admin->get('jenis');
        $data['main'] = 'jenis/data';
        $this->load->view('manage/layout', $data);
        //$this->template->load('templates/dashboard', 'jenis/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('nama_jenis', 'Nama Jenis', 'required|trim');
    }

    public function add($getId = NULL)
    {

    if($getId == NULL){ 
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Type";
            $data['main'] = 'jenis/add';
            $this->load->view('manage/layout', $data);
            //$this->template->load('templates/dashboard', 'jenis/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('jenis', $input);
            if ($insert) {
                $this->session->set_flashdata('success','Data berhasil disimpan');
                redirect('manage/jenis');
            } else {
                $this->session->set_flashdata('failed','data gagal disimpan');
                redirect('manage/jenis/add');
            }
        }
    }else{
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Type";
            $data['jenis'] = $this->admin->get('jenis', ['id_jenis' => $id]);
            $data['main'] = 'jenis/edit';
            $this->load->view('manage/layout', $data);
            //$this->template->load('templates/dashboard', 'jenis/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('jenis', 'id_jenis', $id, $input);
            if ($update) {
                $this->session->set_flashdata('success','Data berhasil disimpan');
                redirect('manage/jenis');
            } else {
                $this->session->set_flashdata('failed','data gagal disimpan');
                redirect('manage/jenis/add');
            }
        }
    }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Type";
            $data['jenis'] = $this->admin->get('jenis', ['id_jenis' => $id]);
            $data['main'] = 'jenis/edit';
            $this->load->view('manage/layout', $data);
            //$this->template->load('templates/dashboard', 'jenis/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('jenis', 'id_jenis', $id, $input);
            if ($update) {
                $this->session->set_flashdata('success','Data berhasil disimpan');
                redirect('manage/jenis');
            } else {
                $this->session->set_flashdata('failed','data gagal disimpan');
                redirect('manage/jenis/add');
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('jenis', 'id_jenis', $id)) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        } else {
            $this->session->set_flashdata('failed', 'Data gagal dihapus');
        }
        redirect('manage/jenis');
    }
}
