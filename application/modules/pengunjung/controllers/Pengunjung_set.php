<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pengunjung_set extends CI_Controller {

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

        $this->load->model('Pengunjung_model', 'admin');
        $this->load->model(array('student/Student_model', 'buku/Buku_model','pegawai/Pegawai_model', 'setting/Setting_model', 'bulan/Bulan_model', 'bebas/Bebas_model'));
        
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }

    public function index()
    {
        $f = $this->input->get(NULL, TRUE);
        $data['f'] = $f;
        $data['pr'] = "0";
        $data['m'] = "0";
        $params = array();
          // Nip
        if (isset($f['pr']) && !empty($f['pr']) && $f['pr'] != '') {
          $params['class_id'] = $f['pr'];
          $data['pr'] = $f['pr'];
        }
      
        if (isset($f['m']) && !empty($f['m']) && $f['m'] != '') {
          $params['majors_id'] = $f['m'];
          $data['m'] = $f['m'];
        }
        
        $data['kelas'] = $this->Student_model->get_class($params);
        $data['majors'] = $this->Student_model->get_majors();

        $data['title'] = "Pengunjung";
        $data['pengunjung'] = $this->admin->get('pengunjung');
        $data['class'] = $this->admin->get('class');
        $data['main'] = 'pengunjung/data';
        $this->load->view('manage/layout', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required|trim');
        $this->form_validation->set_rules('nama', 'Keterangan', 'required|trim');
    }

    public function add($getId = NULL)
    {
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('failed','data gagal disimpan');
            redirect('manage/pengunjung');
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('pengunjung', $input);
            if ($insert) {
                $this->session->set_flashdata('success','Data berhasil disimpan');
                redirect('manage/pengunjung');
            } else {
                $this->session->set_flashdata('failed','data gagal disimpan');
                redirect('manage/pengunjung');
            }
        }
    }

    public function edit()
    {
        $id = $this->input->post('id');
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            
            $this->session->set_flashdata('failed','data gagal disimpan');
            redirect('manage/pengunjung');
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('pengunjung', 'id', $id, $input);
            if ($update) {
                $this->session->set_flashdata('success','Data berhasil disimpan');
                redirect('manage/pengunjung');
            } else {
                $this->session->set_flashdata('failed','data gagal disimpan');
                redirect('manage/pengunjung');
            }
        }
    }

    public function delete()
    {
        $id = $this->input->post('deleteid');     
        if ($this->admin->delete('pengunjung', 'id', $id)) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        } else {
            $this->session->set_flashdata('failed', 'Data gagal dihapus');
        }
        redirect('manage/pengunjung');
    }

        
    public function ajax_list() {
        $m = $this->input->post('m');
        $pr = $this->input->post('pr');
        $list = $this->admin->get_datatables($m,$pr);
        $data = array();
        $no = 0;
        foreach ($list as $prd) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $prd->tanggal;
            $row[] = $prd->nama;
            $row[] = $prd->class_name;
            $row[] = $prd->keperluan;
            $row[] = $prd->gender == 1 ? 'Male' : 'Female';
            $row[] = '<button 
            data-id="'.$prd->id.'" 
            data-nama="'.$prd->nama.'"
            data-tanggal="'.$prd->tanggal.'"
            data-kelas="'.$prd->kelas.'"
            data-keperluan="'.$prd->keperluan.'"
            data-gender="'.$prd->gender.'"         
            class="btn btn-warning btn-circle btn-sm edit-object"><i class="fa fa-edit"></i></button>
            <button class="btn btn-success btn-circle btn-sm delete-object"><i class="fa fa-minus"></i></button>
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
