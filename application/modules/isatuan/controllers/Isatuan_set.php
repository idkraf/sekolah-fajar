<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Isatuan_set extends CI_Controller {

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

        $this->load->model('Isatuan_model', 'admin');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Unit";
        $data['satuan'] = $this->admin->get('isatuan');
        $data['main'] = 'isatuan/data';
        $this->load->view('manage/layout', $data);
        //$this->template->load('templates/dashboard', 'satuan/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('nama_satuan', 'Nama Satuan', 'required|trim');
    }

    public function add($getId = NULL)
    {
    if($getId == NULL){
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Unit";
            $data['main'] = 'isatuan/add';
            $this->load->view('manage/layout', $data);
            //$this->template->load('templates/dashboard', 'satuan/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('isatuan', $input);
            if ($insert) {
                $this->session->set_flashdata('success','Data berhasil disimpan');
                redirect('manage/isatuan');
            } else {
                $this->session->set_flashdata('failed','data gagal disimpan');
                redirect('manage/isatuan/add');
            }
        }
    }else{
        
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Unit";
            $data['satuan'] = $this->admin->get('isatuan', ['id_satuan' => $id]);
            
            $data['main'] = 'isatuan/edit';
            $this->load->view('manage/layout', $data);
        //$this->template->load('templates/dashboard', 'satuan/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('isatuan', 'id_satuan', $id, $input);
            if ($update) {
                $this->session->set_flashdata('success','Data berhasil disimpan');
                redirect('manage/isatuan');
            } else {
                $this->session->set_flashdata('failed','data gagal disimpan');
                redirect('manage/isatuan/add');
            }
        }
    }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Unit";
            $data['satuan'] = $this->admin->get('isatuan', ['id_satuan' => $id]);
            
            $data['main'] = 'isatuan/edit';
            $this->load->view('manage/layout', $data);
        //$this->template->load('templates/dashboard', 'satuan/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('isatuan', 'id_satuan', $id, $input);
            if ($update) {
                $this->session->set_flashdata('success','Data berhasil disimpan');
                redirect('manage/isatuan');
            } else {
                $this->session->set_flashdata('failed','data gagal disimpan');
                redirect('manage/isatuan/add');
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('isatuan', 'id_satuan', $id)) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        } else {
            $this->session->set_flashdata('failed', 'Data gagal dihapus');
        }
        redirect('manage/isatuan');
    }
}
