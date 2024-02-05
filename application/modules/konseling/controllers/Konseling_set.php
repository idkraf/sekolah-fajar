<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konseling_set extends CI_Controller {

	public function __construct() {
		parent::__construct(TRUE);
		if ($this->session->userdata('logged') == NULL) {
			header("Location:" . site_url('manage/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
		}
		$this->load->model(array('payment/Payment_model', 'student/Student_model', 'period/Period_model', 'pos/Pos_model', 'bulan/Bulan_model', 'bebas/Bebas_model', 'bebas/Bebas_pay_model', 'setting/Setting_model', 'letter/Letter_model', 'logs/Logs_model', 'ltrx/Log_trx_model'));
	
        $this->load->model('obat/Obat_model', 'admin');
		$this->load->library('upload');
	}


  
	public function ajax_list() {
		$st = 0;
		$us = $this->input->post('us');
		$pr = $this->input->post('pr');
		$list = $this->Student_model->get_datatables($st,$us,$pr);
		$data = array();
		$no = 0;
		foreach ($list as $prd) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $prd->student_nis;
			$row[] = $prd->student_full_name;
			$row[] = $prd->class_name;
			$row[] = '<button type="button" data-dismiss="modal" class="btn btn-primary btn-xs" onclick="ambil_data('.$prd->student_nis.')">Pilih</button>';
			$data[] = $row;
		}
		$output = array(
		  "recordsTotal" => $this->Student_model->count_all(),
		  "recordsFiltered" => $this->Student_model->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	  }
	  
	
	public function index($offset = NULL, $id =NULL) {
	// Apply Filter
	// Get $_GET variable
		$f = $this->input->get(NULL, TRUE);
	
		$data['f'] = $f;
	
		$siswa['student_id'] = '';
		$params = array();
		$param = array();
		$pay = array();
		$cashback = array();
		$logs = array();
	
	// Tahun Ajaran
		if (isset($f['n']) && !empty($f['n']) && $f['n'] != '') {
		  $params['period_id'] = $f['n'];
		  $pay['period_id'] = $f['n'];
		  $cashback['period_id'] = $f['n'];
		  $logs['period_id'] = $f['n'];
		}
	
	// Siswa
		if (isset($f['r']) && !empty($f['r']) && $f['r'] != '') {
		  $params['student_nis'] = $f['r'];
		  $param['student_nis'] = $f['r'];
		  $cashback['student_nis'] = $f['r'];
		  $logs['student_nis'] = $f['r'];
		  $siswa = $this->Student_model->get(array('student_nis'=>$f['r']));
		}
	
		// tanggal
		if (isset($f['d']) && !empty($f['d']) && $f['d'] != '') {
		  $param['date'] = $f['d'];
	
		}
	
        $data['obat'] = $this->admin->get('obat');
	
		$data['kelas'] = $this->Student_model->get_class();
		$data['majors'] = $this->Student_model->get_majors();

		$params['group'] = TRUE;
		$pay['paymentt'] = TRUE;
		$param['status'] = 1;
		$cashback['status'] = 1;
		$pay['student_id']=$siswa['student_id'];
		$cashback['student_id']=$siswa['student_id'];
		$logs['student_id']=$siswa['student_id'];
		$cashback['date'] = date('Y-m-d');
		$cashback['bebas_pay_input_date'] = date('Y-m-d');
		$logs['limit'] = 3;
	
		$month = $this->Bulan_model->get_month();
	
		$paramsPage = $params;
		$data['student_id'] = $siswa['student_id'];
		$data['riwayat'] = $this->admin->get('riwayat_sakit', null,['student_id'=>$siswa['student_id']]);
		$data['period'] = $this->Period_model->get($params);
		$data['siswa'] = $this->Student_model->get(array('student_id'=>$siswa['student_id'], 'group'=>TRUE));
		$data['students'] = $this->Student_model->get(array('status'=>1));
	
		$config['base_url'] = site_url('manage/konseling/index');
		$config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$config['total_rows'] = count($this->Bulan_model->get($paramsPage));
	
		$data['title'] = 'Konseling';
		$data['main'] = 'konseling/konseling_list';
		$this->load->view('manage/layout', $data);
	} 

	public function addRiwayat(){
		$r = $this->input->post('r');
		$n = $this->input->post('n');
		$data = array();
		$data['tanggal'] = $this->input->post('tanggal');
		$data['student_id'] = $this->input->post('student_id');
		$data['obat_id'] = $this->input->post('obat_id');
		$data['sakit'] = $this->input->post('sakit');
		$data['keterangan'] = $this->input->post('keterangan');

		if($this->admin->insert('riwayat_sakit', $data)){
			$this->session->set_flashdata('success','Data berhasil disimpan');
			redirect('manage/konseling?n='.$n.'&r='.$r);
		}else{
			$this->session->set_flashdata('failed','data gagal disimpan');
			redirect('manage/konseling?n='.$n.'&r='.$r);
		}
	}

	public function updateRiwayat(){
		

		$r = $this->input->post('r');
		$n = $this->input->post('n');
		
		$data = array();
		$data['tanggal'] = $this->input->post('tanggal');
		$data['obat_id'] = $this->input->post('obat_id');
		$data['sakit'] = $this->input->post('sakit');
		$data['keterangan'] = $this->input->post('keterangan');

		//$this->db->where('id', $this->input->post('id'));
		//$this->db->set($data);
		
		$update = $this->admin->update('riwayat_sakit', 'id', $this->input->post('id'), $data);
		if ($update) {
		//if($this->db->update('riwayat_obat')){
			$this->session->set_flashdata('success','Data berhasil disimpan');
			redirect('manage/konseling?n='.$n.'&r='.$r);
		}else{
			$this->session->set_flashdata('failed','data gagal disimpan');
			redirect('manage/konseling?n='.$n.'&r='.$r);
		}
	}
	public function deleteRiwayat(){

		$r = $this->input->post('r');
		$n = $this->input->post('n');
        $id = $this->input->post('deleteid');            
        if ($this->db->delete('riwayat_sakit', array('id' => $id))) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect('manage/konseling?n='.$n.'&r='.$r);
        } else {
            $this->session->set_flashdata('failed', 'Data gagal dihapus');
			redirect('manage/konseling?n='.$n.'&r='.$r);
        }
	}
}