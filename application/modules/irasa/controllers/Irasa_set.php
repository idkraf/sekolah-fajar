<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Irasa_set extends CI_Controller {

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

        $this->load->model('Irasa_model', 'admin');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Rasa";
        $data['rasa'] = $this->admin->get('irasa');
        $data['main'] = 'irasa/data';
        $this->load->view('manage/layout', $data);
        //$this->template->load('templates/dashboard', 'rasa/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('nama_rasa', 'Nama Rasa', 'required|trim');
    }

    public function add($getId = NULL)
    {
    if($getId == NULL){
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Rasa";
            $data['main'] = 'irasa/add';
            $this->load->view('manage/layout', $data);
            //$this->template->load('templates/dashboard', 'rasa/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('irasa', $input);
            if ($insert) {
                $this->session->set_flashdata('success','Data berhasil disimpan');
                redirect('manage/irasa');
            } else {
                $this->session->set_flashdata('failed','data gagal disimpan');
                redirect('manage/irasa/add');
            }
        }
    }else{
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Rasa";
            $data['rasa'] = $this->admin->get('irasa', ['id_rasa' => $id]);
            $data['main'] = 'irasa/edit';
            $this->load->view('manage/layout', $data);
            //$this->template->load('templates/dashboard', 'rasa/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('irasa', 'id_rasa', $id, $input);
            if ($update) {
                $this->session->set_flashdata('success','Data berhasil disimpan');
                redirect('manage/irasa');
            } else {
                $this->session->set_flashdata('failed','data gagal disimpan');
                redirect('manage/irasa/add');
            }
        }
    }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Rasa";
            $data['rasa'] = $this->admin->get('irasa', ['id_rasa' => $id]);
            $data['main'] = 'irasa/edit';
            $this->load->view('manage/layout', $data);
            //$this->template->load('templates/dashboard', 'rasa/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('irasa', 'id_rasa', $id, $input);
            if ($update) {
                $this->session->set_flashdata('success','Data berhasil disimpan');
                redirect('manage/irasa');
            } else {
                $this->session->set_flashdata('failed','data gagal disimpan');
                redirect('manage/irasa/add');
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('irasa', 'id_rasa', $id)) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        } else {
            $this->session->set_flashdata('failed', 'Data gagal dihapus');
        }
        redirect('manage/irasa');
    }
}
