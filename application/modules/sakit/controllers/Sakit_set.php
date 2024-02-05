<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sakit_set extends CI_Controller {

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

        $this->load->model('Sakit_model', 'admin');
        $this->load->model(array('student/Student_model'));
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Keterangan siswa sakit";
        $data['obat'] = $this->admin->get('obat');
        $data['students'] = $this->Student_model->get(array('status'=>1));
        $data['main'] = 'sakit/data';
        $this->load->view('manage/layout', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('tanggal', 'Pilih Tanggal Sakit', 'required|trim');
        $this->form_validation->set_rules('student_id', 'Pilih Siswa', 'required|trim');
    }

    public function add()
    {
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('failed','data gagal disimpan');
            redirect('manage/sakit');
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('sakit', $input);
            if ($insert) {
                $this->session->set_flashdata('success','Data berhasil disimpan');
                redirect('manage/sakit');
            } else {
                $this->session->set_flashdata('failed','data gagal disimpan');
                redirect('manage/sakit');
            }
        }
    }

    public function edit()
    {
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            
            $this->session->set_flashdata('failed','data gagal disimpan');
            redirect('manage/sakit');
        } else {
            $id = $this->input->post("id");
            $input = $this->input->post(null, true);
            $update = $this->admin->update('sakit', 'id', $id, $input);
            if ($update) {
                $this->session->set_flashdata('success','Data berhasil disimpan');
                redirect('manage/sakit');
            } else {
                $this->session->set_flashdata('failed','data gagal disimpan');
                redirect('manage/sakit');
            }
        }
    }

    public function delete()
    {
        $id = $this->input->post('deleteid');       
        if ($this->admin->delete('sakit', 'id', $id)) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        } else {
            $this->session->set_flashdata('failed', 'Data gagal dihapus');
        }
        redirect('manage/sakit');
    }

    
    
    public function ajax_list() {
        $list = $this->admin->get_datatables();
        $data = array();
        $no = 0;
        foreach ($list as $prd) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $prd->tanggal;
            $row[] = $prd->student_full_name;
            $row[] = $prd->class_name;
            $row[] = $prd->keluhan;
            $row[] = $prd->keterangan;
            $row[] = '<button             
            data-id="'.$prd->id.'" 
            data-tanggal="'.$prd->tanggal.'"
            data-student-id="'.$prd->student_id.'"
            data-keluhan="'.$prd->keluhan.'"
            data-keterangan="'.$prd->keterangan.'"
            class="btn btn-warning btn-circle btn-sm edit-object"><i class="fa fa-edit"></i></button>
            <button data-object-id="'.$prd->id.'"class="btn btn-success btn-circle btn-sm delete-object"><i class="fa fa-minus"></i></button>
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
