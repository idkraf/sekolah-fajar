<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Penggajian_set extends CI_Controller {

  public function __construct()
  {
    parent::__construct(TRUE);
    if ($this->session->userdata('logged') == NULL) {
        header("Location:" . site_url('manage/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
    }
    $this->load->model(array('penggajian/Penggajian_model','pegawai/Pegawai_model', 'jabatan/Jabatan_model', 'setting/Setting_model'));
    $this->load->helper(array('form', 'url'));
  }

  public function index($offset = NULL) {
    
    $this->load->library('pagination');
    // Apply Filter
    // Get $_GET variable
    $f = $this->input->get(NULL, TRUE);

    $data['f'] = $f;

    $params = array();
    // Nip
    if (isset($f['n']) && !empty($f['n']) && $f['n'] != '') {
      $params['pegawai_search'] = $f['n'];
    }
    if (isset($f['m']) && !empty($f['m']) && $f['m'] != '') {
      $params['majors'] = $f['m'];
      $params['majors_id'] = $f['m'];
    }
    if (isset($f['j']) && !empty($f['j']) && $f['j'] != '') {
      $params['jabatan'] = $f['j'];
    }
    $params['group'] = TRUE;

    $paramsPage = $params;
    $params['limit'] = 10;
    $params['offset'] = $offset;
    $data['pegawai'] = $this->Pegawai_model->get($params);


    $config['per_page'] = 10;
    $config['uri_segment'] = 4;
    $config['base_url'] = site_url('manage/penggajian/index');
    $config['suffix'] = '?' . http_build_query($_GET, '', "&");
    $config['total_rows'] = count($this->Pegawai_model->get($paramsPage));

    $this->pagination->initialize($config);

    $data['majors'] = $this->Pegawai_model->get_majors();
    $data['position'] = $this->Pegawai_model->get_position($params);

    $data['title'] = 'Penggajian';
    $data['main'] = 'penggajian/penggajian_list';
    $this->load->view('manage/layout', $data);

  }

  public function show($id = NULL) {
    $params['id'] = $id;
    $data['pegawai'] = $this->Penggajian_model->get($params);
    $data['gajipokok'] = $this->Penggajian_model->get_gaji($params);
    $data['potongan'] = $this->Penggajian_model->get_potongan($params);
    $data['title'] = 'Setting Penggajian';
    $data['main'] = 'penggajian/penggajian_add';
    $this->load->view('manage/layout', $data);
  }

  
  public function add($id = NULL)
  {
    $list_access = array(SUPERUSER);
    if (!in_array($this->session->userdata('uroleid'), $list_access)) {
      redirect('manage');
    }
    $this->load->library('form_validation');

    $data['operation'] = is_null($id) ? 'Tambah' : 'Sunting';

    if (!$this->input->post('employee_id')) {
      redirect('manage');
    }

    $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button position="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
    
    if ($_POST) {
      
      if ($this->input->post('gaji_id')) {
        $params['gaji_id'] =  $this->input->post('gaji_id');
      }
      if ($this->input->post('employee_id')) {
        $params['employee_id'] =  $this->input->post('employee_id');
      }
      $params['gaji_pokok'] = $this->input->post('gaji_pokok');
      $params['tunjangan_fungsional'] = $this->input->post('tunjangan_fungsional');
      $params['tunjangan_struktural'] = $this->input->post('tunjangan_struktural');
      $params['tunjangan_khusus'] = $this->input->post('tunjangan_khusus');
      $params['tunjangan_prestasi'] = $this->input->post('tunjangan_prestasi');
      $params['poin'] = $this->input->post('poin');

      $params['tunjangan_jabatan'] = $this->input->post('tunjangan_jabatan');
      $params['tunjangan_profesi'] = $this->input->post('tunjangan_profesi');
      $params['tunjangan_transport'] = $this->input->post('tunjangan_transport');
      $params['uang_makan'] = $this->input->post('uang_makan');
      $params['tunjangan_umum'] = $this->input->post('tunjangan_umum');
      $params['tunjangan_guru_tetap'] = $this->input->post('tunjangan_guru_tetap');
      

      $status = $this->Penggajian_model->add($params);

      $this->session->set_flashdata('success', 'Gaji Pokok Berhasil diupdate');
      redirect('manage/penggajian');
    }else{

      $this->session->set_flashdata('error', 'Gaji Pokok gagal diupdate');
     // if ($this->input->post('employee_id')) {
        redirect('manage/penggajian/show/' . $this->input->post('employee_id'));
     // }
    }
  }

  public function add_potongan($id = NULL)
  {
    $list_access = array(SUPERUSER);
    if (!in_array($this->session->userdata('uroleid'), $list_access)) {
      redirect('manage');
    }
    $this->load->library('form_validation');

    $data['operation'] = is_null($id) ? 'Tambah' : 'Sunting';

    if (!$this->input->post('employee_id')) {
      redirect('manage');
    }

    $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button position="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
    
    if ($_POST) {
      
      if ($this->input->post('potongan_id')) {
        $params['potongan_id'] = $this->input->post('potongan_id');
      }
      if ($this->input->post('employee_id')) {
        $params['employee_id'] = $this->input->post('employee_id');
      }
      $params['pinjaman_bank'] = $this->input->post('pinjaman_bank');
      $params['organisasi'] = $this->input->post('organisasi');
      $params['koperasi'] = $this->input->post('koperasi');
      $params['program_bahasa'] = $this->input->post('program_bahasa');
      $params['majalah'] = $this->input->post('majalah');
      $params['adm_bank'] = $this->input->post('adm_bank');
      $params['infaq_dakwah'] = $this->input->post('infaq_dakwah');
      $params['bpjs'] = $this->input->post('bpjs');
      $params['telemarket'] = $this->input->post('telemarket');
      $params['lainnya'] = $this->input->post('lainnya');
      $params['absensi'] = $this->input->post('absensi');
      $params['iuran_jht'] = $this->input->post('iuran_jht');
      $params['jaminan_pensiun'] = $this->input->post('jaminan_pensiun');

      $status = $this->Penggajian_model->add_potongan($params);

      $this->session->set_flashdata('success', 'Potongan Gaji Berhasil diupdate');
      redirect('manage/penggajian');
    }else{

      if ($this->input->post('employee_id')) {
        redirect('manage/penggajian/show/' . $this->input->post('employee_id'));
      }
    }
  }

  
	public function slip_gaji() {

		$q = $this->input->get(NULL, TRUE);

		$data['q'] = $q;

		$params = array();
		$param = array();
		$stu = array();
		$free = array();

		if (isset($q['p']) && !empty($q['p']) && $q['p'] != '') {
			$params['period_id'] = $q['p'];
			$param['period_id'] = $q['p'];
			$stu['period_id'] = $q['p'];
			$free['period_id'] = $q['p'];
		}

		if (isset($q['c']) && !empty($q['c']) && $q['c'] != '') {
			$params['class_id'] = $q['c'];
			$param['class_id'] = $q['c'];
			$stu['class_id'] = $q['c'];
			$free['class_id'] = $q['c'];
		}

		if (isset($q['k']) && !empty($q['k']) && $q['k'] != '') {
			$params['majors_id'] = $q['k'];
			$param['majors_id'] = $q['k'];
			$stu['majors_id'] = $q['k'];
			$free['majors_id'] = $q['k'];
		}

		$param['paymentt'] = TRUE;
		$params['grup'] = TRUE;
		$stu['group'] = TRUE;


		$data['period'] = $this->Period_model->get($params);
		//$data['class'] = $this->Student_model->get_class($params);
		//$data['majors'] = $this->Student_model->get_majors($params);
		//$data['student'] = $this->Bulan_model->get($stu);
		$data['bulan'] = $this->Bulan_model->get($free);
		//$data['month'] = $this->Bulan_model->get($params);
		//$data['py'] = $this->Bulan_model->get($param);
		//$data['bebas'] = $this->Bebas_model->get($params);
		//$data['free'] = $this->Bebas_model->get($free);

		$config['suffix'] = '?' . http_build_query($_GET, '', "&");

		$data['title'] = 'Rekapitulasi';
		$data['main'] = 'report/report_bill_list';
		$this->load->view('manage/layout', $data);
	}
  // View data detail
  public function view($id = NULL)
  {
    $data['pegawai'] = $this->Pegawai_model->get(array('id' => $id));
    $data['title'] = 'Pegawai';
    $data['main'] = 'pegawai/student_view';
    $this->load->view('manage/layout', $data);
  }

  // Delete to database
  public function delete($id = NULL)
  {
    if ($this->session->userdata('uroleid')!= SUPERUSER){
      redirect('manage');
    }
  }

  // Class view in list
  public function clasess($offset = NULL)
  {
  }
      // Setting Upload File Requied
  function do_upload($name = NULL, $fileName = NULL)
  {
  }

  // Add User_customer and Update
  public function add_class($id = NULL)
  {
  }

  function multiple()
  {
    $this->load->helper(array('dompdf'));
    //multi print
    $action = $this->input->post('action');
    $print = array();
    $idcard = array();

  }

  function printPdf($id = NULL)
  {
    $this->load->helper(array('dompdf'));
    $this->load->helper(array('tanggal'));

  }

}