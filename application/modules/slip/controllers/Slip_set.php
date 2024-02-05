<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Slip_set extends CI_Controller {

  public function __construct()
  {
    parent::__construct(TRUE);
    if ($this->session->userdata('logged') == NULL) {
        header("Location:" . site_url('manage/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
    }
    $this->load->model(array('slip/Slip_model','bulan/Bulan_model','jabatan/Jabatan_model','period/Period_model','penggajian/Penggajian_model','pegawai/Pegawai_model', 'jabatan/Jabatan_model', 'setting/Setting_model'));
    $this->load->helper(array('form', 'url'));
  }

  public function ajax_list() {
    $m = $this->input->post('m');
    $j = $this->input->post('j');
    $list = $this->Pegawai_model->get_datatables($m,$j);
    $data = array();
    $no = 0;
    foreach ($list as $prd) {
        $no++;
        $row = array();
        $row[] = $no;
        $row[] = $prd->employee_nip;
        $row[] = $prd->employee_name;
        $row[] = $prd->majors_name;
        $row[] = $prd->position_name;
        $row[] = '<button type="button" data-dismiss="modal" class="btn btn-primary btn-xs" onclick="ambil_data('.$prd->employee_id.','.$prd->employee_nip.')">Pilih</button>';
        $data[] = $row;
    }
    $output = array(
        "recordsTotal" => $this->Pegawai_model->count_all(),
        "recordsFiltered" => $this->Pegawai_model->count_filtered(),
        "data" => $data,
    );
    //output to json format
    echo json_encode($output);
  }
  
  public function index($offset = NULL) {
    
    $this->load->library('pagination');
    // Apply Filter
    // Get $_GET variable
    $f = $this->input->get(NULL, TRUE);

    $data['f'] = $f;

    $params = array();
    $paramx = array();
    
    //$params['id'] = $id;

    // Nip
    if (isset($f['n']) && !empty($f['n']) && $f['n'] != '') {
      $params['pegawai_search'] = $f['n'];
    }
    
    //$paramsP = $f['n'];
    if (isset($f['p']) && !empty($f['p']) && $f['p'] != '') {
      $params['period_id'] = $f['p'];
    }

    if (isset($f['c']) && !empty($f['c']) && $f['c'] != '') {
      $params['month_id'] = $f['c'];
    }
    $params['group'] = TRUE;

    $paramsPage = $params;
    $params['limit'] = 10;
    $params['offset'] = $offset;
    
    $data['position'] = $this->Pegawai_model->get_position($params);
    $data['majors'] = $this->Pegawai_model->get_majors();
    $data['pegawai'] = $this->Pegawai_model->get();

    if (isset($f['n']) && !empty($f['n']) && $f['n'] != '') { 
      $paramx['pegawai_search'] = $f['n'];    
      //$data['employee'] = $this->Pegawai_model->get($paramx); 
      //$p = $this->Pegawai_model->get($paramx);
      //$data['gajipokok'] = $this->Penggajian_model->get_gaji($p['employee_id']);
      //$data['potongan'] = $this->Penggajian_model->get_potongan($p['employee_id']);
    }
    
    if (isset($f['i']) && !empty($f['i']) && $f['i'] != '') {
      //$paramx['pegawai_search'] = $f['i'];     
      $paramx['id'] = $f['i']; 
      //$data['employee'] = $this->Pegawai_model->get($paramx);
      $data['gajipokok'] = $this->Penggajian_model->get_gaji($paramx);
      $data['potongan'] = $this->Penggajian_model->get_potongan($paramx);
    }

    $data['slip'] = $this->Slip_model->get($params);
    //$data['class'] = $this->Class_model->get();
    $data['period'] = $this->Period_model->get();
    //$data['jabatan'] = $this->Jabatan_model->get();
    $data['jabatan'] = $this->Pegawai_model->get_position();
    $data['bulan'] = $this->Bulan_model->get_month();

    $config['per_page'] = 10;
    $config['uri_segment'] = 4;
    $config['base_url'] = site_url('manage/slip/index');
    $config['suffix'] = '?' . http_build_query($_GET, '', "&");
    $config['total_rows'] = count($this->Slip_model->get($paramsPage));

    $this->pagination->initialize($config);

    $data['title'] = 'Slip Gaji';
    $data['main'] = 'slip/slip_gaji';
    $this->load->view('manage/layout', $data);

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

  // Delete to database
  public function delete($id = NULL)
  {
    if ($this->session->userdata('uroleid')!= SUPERUSER){
      redirect('manage');
    }
  }

      // Setting Upload File Requied
  function do_upload($name = NULL, $fileName = NULL)
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

  function printPdf($id = NULL, $employee_id = NULL)
  {
    $this->load->helper(array('dompdf'));

    $list_access = array(SUPERUSER);
    if (!in_array($this->session->userdata('uroleid'), $list_access)) {
      redirect('manage');
    }

    $paramx = array();
    $paramy = array();
    $params = array();
    $data = array();
      
    $paramy['slip_id'] =  $id;
    $slip = $this->Slip_model->get($paramy);
    $data['slip'] = $slip;
    
    $paramx['id'] = $employee_id;
    $data['pegawai'] = $this->Pegawai_model->get($paramx);
            
    $data['setting_district'] = $this->Setting_model->get(array('id' => SCHOOL_DISTRICT)); 
    $data['setting_school'] = $this->Setting_model->get(array('id' => SCHOOL_NAME)); 
    $data['setting_address'] = $this->Setting_model->get(array('id' => SCHOOL_ADRESS)); 
    $data['setting_phone'] = $this->Setting_model->get(array('id' => SCHOOL_PHONE)); 
    $data['setting_logo'] = $this->Setting_model->get(array('id'=>SCHOOL_LOGO));
    $data['setting_logo_yayasan'] = $this->Setting_model->get(array('id'=>SCHOOL_LOGO_YAYASAN));
    $data['bulan'] = $this->Bulan_model->get_month();
    
    $html = $this->load->view('slip/slip_gaji_pdf', $data, true);
    
    $data = pdf_create($html, 'SLIP_GAJI_'.date('d_m_Y'), TRUE, 'A4', 'landscape');

  }

  function add_slip(){
    $this->load->helper(array('dompdf'));

    $list_access = array(SUPERUSER);
    if (!in_array($this->session->userdata('uroleid'), $list_access)) {
      redirect('manage');
    }
    
    $paramx = array();
    $paramy = array();
    $params = array();
    $data = array();
      
    if ($_POST) {
      if ($this->input->post('employee_id')) {

        $paramx['id'] = $this->input->post('employee_id');
        $pegawai = $this->Pegawai_model->get($paramx);
        $data['pegawai'] = $pegawai;

        //if ($this->input->post('gaji_id')) {
        //  $paramy['gaji_id'] =  $this->input->post('gaji_id');
        //  $data['slip'] = $this->Slip_model->get($paramy);
        //}
        

        $params['employee_id'] = $this->input->post('employee_id');
        $params['period_id'] = $this->input->post('period_id');
        $params['month_id'] = $this->input->post('month_id');
        $params['gaji'] = $this->input->post('gaji');
        $params['potongan'] = $this->input->post('potongan');
        $params['jumlah_gaji'] = $this->input->post('jumlah_gaji');
        $params['catatan_gaji'] = $this->input->post('catatan_gaji');
        
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
        
        $params['tanggal_cut_off'] = $this->input->post('tanggal_cut_off');        
        $params['hari_efektif'] = $this->input->post('hari_efektif');        
        $params['hari_masuk'] = $this->input->post('hari_masuk');        
        $params['lupa_absen_masuk'] = $this->input->post('lupa_absen_masuk');        
        $params['lupa_absen_pulang'] = $this->input->post('lupa_absen_pulang');        
        $params['sakit_skd'] = $this->input->post('sakit_skd');        
        $params['sakit_non_skd'] = $this->input->post('sakit_non_skd');        
        $params['izin'] = $this->input->post('izin');        
        $params['keterlambatan'] = $this->input->post('keterlambatan');        
        $params['tanpa_keterangan'] = $this->input->post('tanpa_keterangan');
        

        $cekdata = $this->Slip_model->is_exist($params);
        if($cekdata){
          //$paramy['slip_id'] =  $cekdata;
          $data['slip'] = $this->Slip_model->get($params);
                
          $data['setting_district'] = $this->Setting_model->get(array('id' => SCHOOL_DISTRICT)); 
          $data['setting_school'] = $this->Setting_model->get(array('id' => SCHOOL_NAME)); 
          $data['setting_address'] = $this->Setting_model->get(array('id' => SCHOOL_ADRESS)); 
          $data['setting_phone'] = $this->Setting_model->get(array('id' => SCHOOL_PHONE)); 
          $data['setting_logo'] = $this->Setting_model->get(array('id'=>SCHOOL_LOGO));
          $data['setting_logo_yayasan'] = $this->Setting_model->get(array('id'=>SCHOOL_LOGO_YAYASAN));
          $data['bulan'] = $this->Bulan_model->get_month();
          
          $html = $this->load->view('slip/slip_gaji_pdf', $data, true);
          
          $data = pdf_create($html, 'SLIP_GAJI_'.date('d_m_Y'), TRUE, 'A4', 'landscape');
          //$data = pdf_create($html, 'KARTU_'.date('d_m_Y'), TRUE, 'A4', TRUE);
          //$data = pdf_create($html, 'KARTU_'.date('d_m_Y'), TRUE, 'A4', 'potrait');
          
        }else{

          $id = $this->Slip_model->add($params);
          if($id) {
            $paramy['slip_id'] =  $id;
            $data['slip'] = $this->Slip_model->get($paramy);
                    
            $data['setting_district'] = $this->Setting_model->get(array('id' => SCHOOL_DISTRICT)); 
            $data['setting_school'] = $this->Setting_model->get(array('id' => SCHOOL_NAME)); 
            $data['setting_address'] = $this->Setting_model->get(array('id' => SCHOOL_ADRESS)); 
            $data['setting_phone'] = $this->Setting_model->get(array('id' => SCHOOL_PHONE)); 
            $data['setting_logo'] = $this->Setting_model->get(array('id'=> SCHOOL_LOGO));
            $data['setting_logo_yayasan'] = $this->Setting_model->get(array('id'=>SCHOOL_LOGO_YAYASAN));
            $data['bulan'] = $this->Bulan_model->get_month();
            
            $html = $this->load->view('slip/slip_gaji_pdf', $data, true);
            
            $data = pdf_create($html, 'SLIP_GAJI_'.date('d_m_Y'), TRUE, 'A4', 'landscape');
            //$data = pdf_create($html, 'KARTU_'.date('d_m_Y'), TRUE, 'A4', TRUE);
            //$data = pdf_create($html, 'KARTU_'.date('d_m_Y'), TRUE, 'A4', 'potrait');

          }
        }
      }
    }

  }
}