<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventaris_set extends CI_Controller {

	public function __construct() {
		parent::__construct(TRUE);
		if ($this->session->userdata('logged') == NULL) {
			header("Location:" . site_url('manage/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
		}
		
		$this->load->model('Inventaris_model', 'admin');
		$this->load->library('form_validation');
	}

	public function index()
	{

		$f = $this->input->get(NULL, TRUE);

		$data['m'] = "0";
		$data['r'] = "0";

		$data['title'] = 'Inventaris';
		$data['majors'] = $this->admin->get('majors');
		$data['employee'] = $this->admin->get('pegawai');
		$data['aset'] = $this->admin->get('aset');
		$data['ruangan'] = $this->admin->get('ruangan');

		$data['main'] = 'inventaris/list';
		$this->load->view('manage/layout', $data); 
	}
	
    public function ajax_list() {
		$m = $this->input->post('m');
		$r = $this->input->post('r');
        $list = $this->admin->get_datatables($m,$r);
        $data = array();
        $no = 0;
        foreach ($list as $prd) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $prd->idbarang.' - '.$prd->kode_barang;
            $row[] = '';
            $row[] = $prd->nama_barang;
            $row[] = '';
            $row[] = $prd->nomor_register;
            $row[] = $prd->nama_merek;
            $row[] = $prd->ukuran;
            $row[] = $prd->nama_bahan;
            $row[] = $prd->nama_dana;
            $row[] = $prd->tanggal_pembelian;
            $row[] = $prd->nomor_rangka;
            $row[] = $prd->nomor_mesin;
            $row[] = $prd->nomor_polisi;
            $row[] = $prd->bpkb;
            $row[] = $prd->asal_usul;
            $row[] = $prd->harga;
            $row[] = $prd->nama_kondisi;
            $row[] = $prd->keterangan;
            $row[] = '<button            
            data-qr-kode="'.$prd->idbarang.'  '.$prd->kode_barang.'" 
            data-qr-nama="'.$prd->nama_barang.'" 
            data-qr-jenis="'.$prd->majors_id.'"
            data-qr-nomor="'.$prd->nomor_register.'"
            data-qr-unit="'.$prd->majors_name.'"
            data-qr-ruang="'.$prd->nama_ruangan.'"
            data-qr-tahun="'.$prd->tanggal_pembelian.'"
            class="btn btn-warning qr-object">Open QR</button>';
            $row[] = '<button            
            data-id="'.$prd->idinventaris.'" 
            data-majors-id="'.$prd->majors_id.'"
            data-aset-id="'.$prd->aset_id.'"
            data-user-id="'.$prd->user_id.'"
            data-ruangan-id="'.$prd->ruangan_id.'"
            class="btn btn-warning btn-circle btn-sm edit-object"><i class="fa fa-edit"></i></button>
            <button data-object-id="'.$prd->idinventaris.'" class="btn btn-success btn-circle btn-sm delete-object"><i class="fa fa-minus"></i></button>
            ';
            $data[] = $row;
			//push_array($data[], $row);
        }
        $output = array(
            "recordsTotal" => $this->admin->count_all(),
            "recordsFiltered" => $this->admin->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
	
    private function _validasi()
    {
        $this->form_validation->set_rules('aset_id', 'Id Aset', 'required|trim');
        $this->form_validation->set_rules('majors_id', 'Unit', 'required|trim');
    }

    public function add()
    {
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('failed','data gagal disimpan');
            redirect('manage/inventaris');
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('inventaris', $input);
            if ($insert) {
                $this->session->set_flashdata('success','Data berhasil disimpan');
                redirect('manage/inventaris');
            } else {
                $this->session->set_flashdata('failed','data gagal disimpan');
                redirect('manage/inventaris');
            }
        }
    }

    public function edit()
    {
        $id = $this->input->post('id');
        if ($id) {  
            $input = $this->input->post(null, true);
            $update = $this->admin->update('inventaris', 'idinventaris', $id, $input);
            if ($update) {
                $this->session->set_flashdata('success','Data berhasil disimpan');
                redirect('manage/inventaris');
            } else {
                $this->session->set_flashdata('failed','data gagal disimpan');
                redirect('manage/inventaris');
            }
        }else{
            
            echo json_encode(array('status' => 'Error', 'message' => 'Error!'));
        }
    }

    public function delete()
    {
        $id = $this->input->post('deleteid');            
        if ($this->db->delete('inventaris', array('idinventaris' => $id))) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
            redirect('manage/inventaris');
        } else {
            $this->session->set_flashdata('failed', 'Data gagal dihapus');
            redirect('manage/inventaris');
        }
    }
}