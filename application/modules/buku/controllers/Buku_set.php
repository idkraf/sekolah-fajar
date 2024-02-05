<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Buku_set extends CI_Controller {

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

        $this->load->model('Buku_model', 'admin');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Buku";
        $data['buku'] = $this->admin->get('buku');
        $data['main'] = 'buku/data';
        $this->load->view('manage/layout', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('kode', 'Kode Buku', 'required|trim');
        $this->form_validation->set_rules('nama', 'Nama Buku', 'required|trim');
    }

    public function add()
    {

            $this->_validasi();
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('failed','data gagal disimpan');
                redirect('manage/buku');
            } else {
                
            $input = $this->input->post(null, true);
                $insert = $this->admin->insert('buku', $input);
                if ($insert) {
                    $this->session->set_flashdata('success','Data berhasil disimpan');
                    redirect('manage/buku');
                } else {
                    $this->session->set_flashdata('failed','data gagal disimpan');
                    redirect('manage/buku');
                }
            }

    }

    public function edit()
    {
        $this->_validasi();

        if ($this->form_validation->run() == false) {            
            $this->session->set_flashdata('failed','data gagal disimpan');
            redirect('manage/buku');
        } else {
            $id = $this->input->post("id");
            $input = $this->input->post(null, true);
            $update = $this->admin->update('buku', 'id', $id, $input);
            if ($update) {
                $this->session->set_flashdata('success','Data berhasil disimpan');
                redirect('manage/buku');
            } else {
                $this->session->set_flashdata('failed','data gagal disimpan');
                redirect('manage/buku');
            }
        }
    }

    public function delete()
    {
        $id = $this->input->post('deleteid');            
        if ($this->db->delete('buku', array('id' => $id))) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
            redirect('manage/buku');
        } else {
            $this->session->set_flashdata('failed', 'Data gagal dihapus');
            redirect('manage/buku');
        }
    }

    
    
    public function ajax_list() {
        $list = $this->admin->get_datatables();
        $data = array();
        $no = 0;
        foreach ($list as $prd) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $prd->kode;
            $row[] = $prd->nama;
            $row[] = '<button
            data-id="'.$prd->id.'" 
            data-kode="'.$prd->kode.'"
            data-nama="'.$prd->nama.'"
            class="btn btn-warning btn-circle btn-sm edit-object"><i class="fa fa-edit"></i></button>
            <button data-object-id="'.$prd->id.'" class="btn btn-success btn-circle btn-sm delete-object"><i class="fa fa-minus"></i></button>
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
