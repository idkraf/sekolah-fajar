<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tempat_set extends CI_Controller {

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

        $this->load->model('Tempat_model', 'admin');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Tempat";
        $data['tempat'] = $this->admin->get('tempat');
        $data['main'] = 'tempat/data';
        $this->load->view('manage/layout', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('nama_tempat', 'Nama Tempat', 'required|trim');
    }

    public function add($getId = NULL)
    {
    if($getId == NULL){
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Tambah Tempat";
            $data['main'] = 'tempat/add';
            $this->load->view('manage/layout', $data);
            //$this->template->load('templates/dashboard', 'gudang/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('tempat', $input);
            if ($insert) {
                $this->session->set_flashdata('success','Data berhasil disimpan');
                redirect('manage/tempat');
            } else {
                $this->session->set_flashdata('failed','data gagal disimpan');
                redirect('manage/tempat/add');
            }
        }
    }else{
        
        $id = encode_php_tags($getId);
        
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Edit Tempat";
            $data['tempat'] = $this->admin->get('tempat', ['idtempat' => $id]);
            
            $data['main'] = 'tempat/edit';
            $this->load->view('manage/layout', $data);
            //$this->template->load('templates/dashboard', 'gudang/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('tempat', 'idtempat', $id, $input);
            if ($update) {
                $this->session->set_flashdata('success','Data berhasil disimpan');
                redirect('manage/tempat');
            } else {
                $this->session->set_flashdata('failed','data gagal disimpan');
                redirect('manage/tempat/add');
            }
        }
    }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Tempat";
            $data['tempat'] = $this->admin->get('tempat', ['idtempat' => $id]);
            
            $data['main'] = 'tempat/edit';
            $this->load->view('manage/layout', $data);
            //$this->template->load('templates/dashboard', 'gudang/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('tempat', 'idtempat', $id, $input);
            if ($update) {
                $this->session->set_flashdata('success','Data berhasil disimpan');
                redirect('manage/tempat');
            } else {
                $this->session->set_flashdata('failed','data gagal disimpan');
                redirect('manage/tempat/add');
            }
        }
    }

    public function delete()
    {
        $id = $this->input->post('deleteid');     
        if ($this->admin->delete('tempat', 'idtempat', $id)) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        } else {
            $this->session->set_flashdata('failed', 'Data gagal dihapus');
        }
        redirect('manage/tempat');
    }

    
    
    public function ajax_list() {
        $list = $this->admin->get_datatables();
        $data = array();
        $no = 0;
        foreach ($list as $prd) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $prd->nama_tempat;
            //$row[] = $prd->keterangan;
            $row[] = '<a href="'.base_url('manage/tempat/edit'). '/' . $prd->idtempat .'"
            class="btn btn-warning btn-circle btn-sm"><i class="fa fa-edit"></i></a>
            <button data-object-id="'.$prd->idtempat.'"class="btn btn-success btn-circle btn-sm delete-object"><i class="fa fa-minus"></i></button>
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
}
