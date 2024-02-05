<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Obatout_set extends CI_Controller {

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

        $this->load->model('Obatout_model', 'admin');
        $this->load->model(array('bukti/Bukti_model', 'student/Student_model', 'period/Period_model', 'pos/Pos_model', 'bulan/Bulan_model', 'bebas/Bebas_model', 'bebas/Bebas_pay_model', 'logs/Logs_model','payment/Payment_model'));
  
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Obat Keluar";
        $data['period'] = $this->Period_model->get();
        $data['bulan'] = $this->Bulan_model->get_month();
        
        $data['obat'] = $this->admin->get('obat');
        $data['majors'] = $this->admin->get('majors');
        $data['class'] = $this->admin->get('class');
        $data['main'] = 'obatout/data';
        $this->load->view('manage/layout', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required|trim');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|trim');
        $this->form_validation->set_rules('unit', 'Unit', 'required|trim');
        $this->form_validation->set_rules('kelas', 'Kelas', 'required|trim');
        $this->form_validation->set_rules('obat_id', 'Pilih Obat', 'required|trim');
    }

    public function add($getId = NULL)
    {
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('failed','data gagal disimpan');
            redirect('manage/obatout');
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('obat_keluar', $input);
            if ($insert) {
                $this->session->set_flashdata('success','Data berhasil disimpan');
                redirect('manage/obatout');
            } else {
                $this->session->set_flashdata('failed','data gagal disimpan');
                redirect('manage/obatout');
            }
        }
    }

    public function edit()
    {
        $id = $this->input->post('idobat_keluar');
        if ($id) {  
            $input = $this->input->post(null, true);
            $update = $this->admin->update('obat_keluar', 'idobat_keluar', $id, $input);
            if ($update) {
                $this->session->set_flashdata('success','Data berhasil disimpan');
                redirect('manage/obatout');
            } else {
                $this->session->set_flashdata('failed','data gagal disimpan');
                redirect('manage/obatout');
            }
        }else{
            
            echo json_encode(array('status' => 'Error', 'message' => 'Error!'));
        }
    }

    public function delete()
    {
        $id = $this->input->post('deleteid');            
        if ($this->db->delete('obat_keluar', array('idobat_keluar' => $id))) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
            redirect('manage/obatout');
        } else {
            $this->session->set_flashdata('failed', 'Data gagal dihapus');
            redirect('manage/obatout');
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
            $row[] = $prd->tanggal;
            $row[] = $prd->nama_obat;
            $row[] = $prd->jumlah;
            $row[] = $prd->keterangan;
            $row[] = $prd->majors_name . '/'. $prd->class_name;
            $row[] = '<button            
            data-id="'.$prd->idobat_keluar.'" 
            data-tanggal="'.$prd->tanggal.'"
            data-obat-id="'.$prd->obat_id.'"
            data-jumlah="'.$prd->jumlah.'"
            data-keterangan="'.$prd->keterangan.'"
            data-unit="'.$prd->unit.'"
            data-kelas="'.$prd->kelas.'"
            class="btn btn-warning btn-circle btn-sm edit-obat"><i class="fa fa-edit"></i></button>
            <button data-object-id="'.$prd->idobat_keluar.'" class="btn btn-success btn-circle btn-sm delete-object"><i class="fa fa-minus"></i></button>
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
