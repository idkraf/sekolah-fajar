<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Asetout_set extends CI_Controller {

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

        $this->load->model('Asetout_model', 'admin');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Aset Keluar";
        $data['asetout'] = $this->admin->getAsetKeluar();
        $data['main'] = 'asetout/data';
        $this->load->view('manage/layout', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('jumlah', 'Jumlah barang keluar', 'required|trim');
        $this->form_validation->set_rules('keterangan', 'Keterangan barang keluar', 'required|trim');
        $this->form_validation->set_rules('tanggal', 'Tanggal barang keluar', 'required|trim');
    }

    public function add($getId = NULL)
    {
    if($getId == NULL){
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Aset Keluar";
            $data['main'] = 'asetout/add';
            $data['aset'] = $this->admin->get('aset');
            $this->load->view('manage/layout', $data);
            //$this->template->load('templates/dashboard', 'gudang/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('aset_keluar', $input);
            if ($insert) {
                $this->session->set_flashdata('success','Data berhasil disimpan');
                redirect('manage/asetout');
            } else {
                $this->session->set_flashdata('failed','data gagal disimpan');
                redirect('manage/asetout/add');
            }
        }
    }else{
        
        $id = encode_php_tags($getId);
        
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Edit Aset Keluar";
            $data['asetout'] = $this->admin->get('aset_keluar', ['idbarang_keluar' => $id]);
            $data['aset'] = $this->admin->get('aset');

            $data['main'] = 'asetout/edit';
            $this->load->view('manage/layout', $data);
            //$this->template->load('templates/dashboard', 'gudang/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('aset_keluar', 'idbarang_keluar', $id, $input);
            if ($update) {
                $this->session->set_flashdata('success','Data berhasil disimpan');
                redirect('manage/asetout');
            } else {
                $this->session->set_flashdata('failed','data gagal disimpan');
                redirect('manage/asetout/add');
            }
        }
    }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Edit Aset Keluar";
            $data['asetout'] = $this->admin->get('aset_keluar', ['idbarang_keluar' => $id]);
            $data['aset'] = $this->admin->get('aset');

            $data['main'] = 'asetout/edit';
            $this->load->view('manage/layout', $data);
            //$this->template->load('templates/dashboard', 'gudang/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('aset_keluar', 'idbarang_keluar', $id, $input);
            if ($update) {
                $this->session->set_flashdata('success','Data berhasil disimpan');
                redirect('manage/asetout');
            } else {
                $this->session->set_flashdata('failed','data gagal disimpan');
                redirect('manage/asetout/add');
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('aset_keluar', 'idbarang_keluar', $id)) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        } else {
            $this->session->set_flashdata('failed', 'Data gagal dihapus');
        }
        redirect('manage/asetout');
    }
}
