<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman_set extends CI_Controller {

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

        $this->load->model('Peminjaman_model', 'admin');
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
      
        $data['peminjaman'] = $this->admin->get('peminjaman');
        $data['class'] = $this->Student_model->get_class();
        $data['kelas'] = $this->Student_model->get_class($params);
        $data['majors'] = $this->Student_model->get_majors();
        $data['buku'] = $this->Buku_model->get('buku');
        $data['students'] = $this->Student_model->get(array('status'=>1));
        $data['title'] = "Peminjaman";
        $data['main'] = 'peminjaman/data';
        $this->load->view('manage/layout', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('student_id', 'Pilih Siswa', 'required|trim');
        $this->form_validation->set_rules('buku_id', 'Pilih Buku', 'required|trim');
    }

    public function add()
    {
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('failed','data gagal disimpan');
            redirect('manage/peminjaman');
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('peminjaman', $input);
            if ($insert) {
                $this->session->set_flashdata('success','Data berhasil disimpan');
                redirect('manage/peminjaman');
            } else {
                $this->session->set_flashdata('failed','data gagal disimpan');
                redirect('manage/peminjaman');
            }
        }
    }

    public function edit()
    {
        //$id = encode_php_tags($getId);
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            
            $this->session->set_flashdata('failed','data gagal disimpan');
            redirect('manage/peminjaman');
        } else {
            $id = $this->input->post("id");
            $input = $this->input->post(null, true);
            $update = $this->admin->update('peminjaman', 'id', $id, $input);
            if ($update) {
                $this->session->set_flashdata('success','Data berhasil disimpan');
                redirect('manage/peminjaman');
            } else {
                $this->session->set_flashdata('failed','data gagal disimpan');
                redirect('manage/peminjaman');
            }
        }
    }

    public function delete()
    {
        $id = $this->input->post('deleteid');       
        if ($this->admin->delete('peminjaman', 'id', $id)) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        } else {
            $this->session->set_flashdata('failed', 'Data gagal dihapus');
        }
        redirect('manage/peminjaman');
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
            $row[] = $prd->tgl_pinjam;
            $row[] = $prd->student_full_name;
            $row[] = $prd->majors_name;
            $row[] = $prd->class_name;
            $row[] = $prd->nama; //nama buku
            $row[] = $prd->kode; //kode buku
            $row[] = $prd->tgl_kembali;
            $row[] = $prd->keterangan;
            $row[] = '<button             
            data-id="'.$prd->id.'" 
            data-unit="'.$prd->unit.'"
            data-kelas="'.$prd->kelas.'"
            data-student-id="'.$prd->student_id.'"
            data-buku-id="'.$prd->buku_id.'"
            data-tgl-pinjam="'.$prd->tgl_pinjam.'"
            data-tgl-kembali="'.$prd->tgl_kembali.'"
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
