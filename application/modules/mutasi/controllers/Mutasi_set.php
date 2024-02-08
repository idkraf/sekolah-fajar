<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mutasi_set extends CI_Controller {

	public function __construct() {
		parent::__construct(TRUE);
		if ($this->session->userdata('logged') == NULL) {
			header("Location:" . site_url('manage/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
		}
		
		$this->load->model('mutasi_model', 'admin');
		$this->load->library('form_validation');
	}
	
    public function index()
    {
        $data['title'] = "Mutasi";
        $data['main'] = 'mutasi/list';
        $data['majors'] = $this->admin->get('majors');
        $data['employee'] = $this->admin->get('pegawai');
        $data['aset'] = $this->admin->get('aset');
        $this->load->view('manage/layout', $data);
    }

    public function ajax_list() {
        $list = $this->admin->get_datatables();
        $data = array();
        $no = 0;
        foreach ($list as $prd) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $prd->kode_barang;
            $row[] = $prd->kode_register;
            $row[] = $prd->nama_barang;
            $row[] = $prd->employee_name;
            $row[] = $prd->majors_name;
            $row[] = $prd->tanggal_pengajuan;
            $row[] = $prd->tempat_asal_barang;
            $row[] = $prd->tempat_tujuan_barang;
            $row[] = $prd->keterangan; 
            $row[] = '<button            
            data-id="'.$prd->id.'" 
            data-majorsid="'.$prd->majors_id.'"
            data-aset-id="'.$prd->aset_id.'"
            data-user-id="'.$prd->user_id.'"
            data-tanggal-pengajuan="'.$prd->tanggal_pengajuan.'"
            data-tempat-asal-barang="'.$prd->tempat_asal_barang.'"
            data-tempat-tujuan-barang="'.$prd->tempat_tujuan_barang.'"
            data-keterangan="'.$prd->keterangan.'"
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

    public function add()
    {
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('failed','data gagal disimpan');
            redirect('manage/mutasi');
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('mutasi', $input);
            if ($insert) {
                $this->session->set_flashdata('success','Data berhasil disimpan');
                redirect('manage/mutasi');
            } else {
                $this->session->set_flashdata('failed','data gagal disimpan');
                redirect('manage/mutasi');
            }
        }
    }

    public function edit()
    {
        $id = $this->input->post('id');
        if ($id) {  
            $input = $this->input->post(null, true);
            $update = $this->admin->update('mutasi', 'id', $id, $input);
            if ($update) {
                $this->session->set_flashdata('success','Data berhasil disimpan');
                redirect('manage/mutasi');
            } else {
                $this->session->set_flashdata('failed','data gagal disimpan');
                redirect('manage/mutasi');
            }
        }else{
            
            echo json_encode(array('status' => 'Error', 'message' => 'Error!'));
        }
    }

    public function delete()
    {
        $id = $this->input->post('deleteid');            
        if ($this->db->delete('mutasi', array('id' => $id))) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
            redirect('manage/mutasi');
        } else {
            $this->session->set_flashdata('failed', 'Data gagal dihapus');
            redirect('manage/mutasi');
        }
    }
}
