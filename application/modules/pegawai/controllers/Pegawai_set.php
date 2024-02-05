<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai_set extends CI_Controller {

  public function __construct()
  {
    parent::__construct(TRUE);
    if ($this->session->userdata('logged') == NULL) {
        header("Location:" . site_url('manage/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
    }
    $this->load->model(array('pegawai/Pegawai_model', 'jabatan/Jabatan_model', 'setting/Setting_model'));
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
        $row[] = $prd->employee_category== 1 ? '<label class="label label-success">Pegawai Tetap</label>' : '<label class="label label-warning">Pegawai Tidak Tetap</label>';
        $row[] = $prd->employee_phone;
        $row[] = $prd->employee_aktif == 1 ? '<label class="label label-success">Aktif</label>' : '<label class="label label-danger">Tidak Aktif</label>';
        $row[] = '<a href="'.base_url('manage/pegawai/view'). '/' . $prd->employee_id .'" class="btn btn-info btn-circle btn-sm"><i class="fa fa-eye"></i></a>
        <a href="'.base_url('manage/pegawai/edit'). '/' . $prd->employee_id .'" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-edit"></i></a>
        <a href="'.base_url('manage/pegawai/printPdf'). '/' . $prd->employee_id .'" class="btn btn-success btn-circle btn-sm"><i class="fa fa-print"></i></a>
        ';
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
    $f = $this->input->get(NULL, TRUE);
    $data['f'] = $f;
    $data['j'] = "0";
    $data['m'] = "0";
    $params = array();
      // Nip
    if (isset($f['j']) && !empty($f['j']) && $f['j'] != '') {
      $params['position_id'] = $f['j'];
      $data['j'] = $f['j'];
    }
  
    if (isset($f['m']) && !empty($f['m']) && $f['m'] != '') {
      $params['majors_id'] = $f['m'];
      $data['m'] = $f['m'];
    }
  
    $data['position'] = $this->Pegawai_model->get_position($params);
    $data['majors'] = $this->Pegawai_model->get_majors();
    $data['title'] = 'Pegawai';
    $data['main'] = 'pegawai/list';
    $this->load->view('manage/layout', $data);
  }
  
  public function _index($offset = NULL) {
    
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
    $params['group'] = TRUE;

    $paramsPage = $params;
    $params['limit'] = 10;
    $params['offset'] = $offset;
    $data['pegawai'] = $this->Pegawai_model->get($params);


    $config['per_page'] = 10;
    $config['uri_segment'] = 4;
    $config['base_url'] = site_url('manage/pegawai/index');
    $config['suffix'] = '?' . http_build_query($_GET, '', "&");
    $config['total_rows'] = count($this->Pegawai_model->get($paramsPage));

    $this->pagination->initialize($config);

    $data['title'] = 'Pegawai';
    $data['main'] = 'pegawai/pegawai_list';
    $this->load->view('manage/layout', $data);

  }

  // Add User and Update
  // View data detail
  public function view($id = NULL)
  {
    $data['pegawai'] = $this->Pegawai_model->get(array('id' => $id));
    $data['pendidikan_terakhir'] = $this->Pegawai_model->getRiwayat('riwayat_pendidikan_pegawai', null, ['employee_id'=> $id]);
    $data['riwayat_pelatihan'] = $this->Pegawai_model->getRiwayat('riwayat_pelatihan', null, ['employee_id'=> $id]);
    $data['riwayat_jabatan'] = $this->Pegawai_model->getRiwayat('riwayat_jabatan', null, ['employee_id'=> $id]);
    $data['riwayat_mengajar'] = $this->Pegawai_model->getRiwayat('riwayat_mengajar', null, ['employee_id'=> $id]);
    $data['data_keluarga'] = $this->Pegawai_model->getRiwayat('data_keluarga_pegawai', null, ['employee_id'=> $id]);
    $data['penghargaan'] = $this->Pegawai_model->getRiwayat('penghargaan_pegawai', null, ['employee_id'=> $id]);
    $data['title'] = 'Pegawai';
    $data['main'] = 'pegawai/pegawai_view';
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
      $this->form_validation->set_rules('employee_password', 'Password', 'trim|required|xss_clean|min_length[6]');
      $this->form_validation->set_rules('passconf', 'Konfirmasi password', 'trim|required|xss_clean|min_length[6]|matches[employee_password]');
      $this->form_validation->set_message('passconf', 'Password dan konfirmasi password tidak cocok');
    }

    $this->form_validation->set_rules('employee_name', 'Nama lengkap', 'trim|required|xss_clean');
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button position="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
    
    if ($_POST AND $this->form_validation->run() == TRUE) {
      
      if ($this->input->post('employee_id')) {
        $params['employee_id'] = $id;
      } else {
        $params['employee_input_date'] = date('Y-m-d H:i:s');
        $params['employee_password'] = sha1($this->input->post('employee_password'));
      }
      
      $params['employee_name'] = $this->input->post('employee_name');
      $params['employee_nip'] = $this->input->post('employee_nip');
      $params['employee_category'] = $this->input->post('employee_category');
      $params['employee_position_id'] = $this->input->post('employee_position_id');
      $params['employee_majors_id'] = $this->input->post('employee_majors_id');
      $params['employee_strata'] = $this->input->post('employee_strata');
      $params['employee_gender'] = $this->input->post('employee_gender');
      $params['employee_born_date'] = $this->input->post('employee_born_date');
      $params['employee_born_place'] = $this->input->post('employee_born_place');
      $params['employee_aktif'] = $this->input->post('employee_aktif');
      $params['employee_email'] = $this->input->post('employee_email');
      $params['employee_address'] = $this->input->post('employee_address');      
      $params['employee_phone'] = $this->input->post('employee_phone');      
      $params['employee_last_update'] = date('Y-m-d H:i:s');
      
      $params['employee_nik'] = $this->input->post('employee_nik');  
      $params['employee_asal_sekolah'] = $this->input->post('employee_asal_sekolah');  
      $params['employee_agama'] = $this->input->post('employee_agama');  
      $params['employee_bpjs_kesehatan'] = $this->input->post('employee_bpjs_kesehatan');  
      $params['employee_bpjs_ketenagakerjaan'] = $this->input->post('employee_bpjs_ketenagakerjaan');  
      $params['employee_address_ktp'] = $this->input->post('employee_address_ktp');  
      $params['employee_kodepos'] = $this->input->post('employee_kodepos');  
      $params['employee_mulai_tugas'] = $this->input->post('employee_mulai_tugas');  
      $status = $this->Pegawai_model->add($params);

      if (!empty($_FILES['employee_photo']['name'])) {
        $paramsupdate['employee_photo'] = $this->do_upload($name = 'employee_photo', $fileName = $params['employee_name']);
      }
      
      if (!empty($_FILES['employee_berkas']['name'])) {
        $paramsupdate['employee_berkas'] = $this->do_upload($name = 'employee_berkas', $fileName = $params['employee_nip']);
      }

      $paramsupdate['employee_id'] = $status;
      $this->Pegawai_model->add($paramsupdate);

      // activity log
     // $this->load->model('logs/Logs_model');
     // $this->Logs_model->add(
     //   array(
     //     'log_date' => date('Y-m-d H:i:s'),
     //     'user_id' => $this->session->userdata('uid'),
     //     'log_module' => 'Pegawai',
     //     'log_action' => $data['operation'],
     //     'log_info' => 'ID:' . $status . ';Name:' . $this->input->post('employee_name')
     //   )
     // );

      $this->session->set_flashdata('success', $data['operation'] . ' Siswa Berhasil');
      redirect('manage/pegawai');
    }else{

      if ($this->input->post('employee_id')) {
        redirect('manage/pegawai/edit/' . $this->input->post('employee_id'));
      }
      

      // Edit mode
      if (!is_null($id)) {
        $object = $this->Pegawai_model->get(array('id' => $id));
        if ($object == NULL) {
          redirect('manage/pegawai');
        } else {
          $data['pegawai'] = $object;
        }
      }
      $data['setting_level'] = $this->Setting_model->get(array('id' => 7));
      $data['ngapp'] = 'ng-app="classApp"';
      $data['position'] = $this->Pegawai_model->get_position();
      //$data['strata'] = $this->Pegawail_model->get_strata();
      $data['majors'] = $this->Pegawai_model->get_majors();
      $data['title'] = $data['operation'] . ' Pegawai';
      $data['main'] = 'pegawai/pegawai_add';
      $this->load->view('manage/layout', $data);
    }
  }

  public function delete_education($getId = NULL, $employeeId = NULL){
    
    $id = encode_php_tags($getId);
    if ($this->Pegawai_model->deleteRiwayat('riwayat_pendidikan_pegawai', 'id', $id)) {
        $this->session->set_flashdata('success', 'Data berhasil dihapus');
    } else {
        $this->session->set_flashdata('failed', 'Data gagal dihapus');
    }
    redirect('manage/pegawai/view/'. $employeeId);

  }

  public function delete_pelatihan($getId = NULL, $employeeId = NULL){
    $id = encode_php_tags($getId);
    if ($this->Pegawai_model->deleteRiwayat('riwayat_pelatihan', 'id', $id)) {
        $this->session->set_flashdata('success', 'Data berhasil dihapus');
    } else {
        $this->session->set_flashdata('failed', 'Data gagal dihapus');
    }
    redirect('manage/pegawai/view/'. $employeeId);
  }

  public function delete_family($getId = NULL, $employeeId = NULL){
    $id = encode_php_tags($getId);
    if ($this->Pegawai_model->deleteRiwayat('data_keluarga_pegawai', 'id', $id)) {
        $this->session->set_flashdata('success', 'Data berhasil dihapus');
    } else {
        $this->session->set_flashdata('failed', 'Data gagal dihapus');
    }
    redirect('manage/pegawai/view/'. $employeeId);
  }

  public function delete_position($getId = NULL, $employeeId = NULL){
    $id = encode_php_tags($getId);
    if ($this->Pegawai_model->deleteRiwayat('riwayat_jabatan', 'id', $id)) {
        $this->session->set_flashdata('success', 'Data berhasil dihapus');
    } else {
        $this->session->set_flashdata('failed', 'Data gagal dihapus');
    }
    redirect('manage/pegawai/view/'. $employeeId);
  }
  public function delete_teaching($getId = NULL, $employeeId = NULL){
    $id = encode_php_tags($getId);
    if ($this->Pegawai_model->deleteRiwayat('riwayat_mengajar', 'id', $id)) {
        $this->session->set_flashdata('success', 'Data berhasil dihapus');
    } else {
        $this->session->set_flashdata('failed', 'Data gagal dihapus');
    }
    redirect('manage/pegawai/view/'. $employeeId);
  }
  public function delete_penghargaan($getId = NULL, $employeeId = NULL){
    $id = encode_php_tags($getId);
    if ($this->Pegawai_model->deleteRiwayat('penghargaan_pegawai', 'id', $id)) {
        $this->session->set_flashdata('success', 'Data berhasil dihapus');
    } else {
        $this->session->set_flashdata('failed', 'Data gagal dihapus');
    }
    redirect('manage/pegawai/view/'. $employeeId);
  }
  
  public function add_education(){

    $employeeId = $_POST['employee_id'];
    if ($_POST == TRUE) {
      $thn_masuk = $_POST['thn_masuk'];
      $thn_lulus = $_POST['thn_lulus'];
      $sekolah = $_POST['sekolah'];
      $lokasi = $_POST['lokasi'];
      $cpt = count($_POST['sekolah']);
      
      $params['employee_id'] = $employeeId; 
      for ($i = 0; $i < $cpt; $i++) {
        $params['thn_masuk'] = $thn_masuk[$i];
        $params['thn_lulus'] = $thn_lulus[$i];
        $params['sekolah'] = $sekolah[$i];
        $params['lokasi'] = $lokasi[$i];
        $this->Pegawai_model->addRiwayatPendidikan($params);
      }
    }
    $this->session->set_flashdata('success',' Tambah Berhasil');
    redirect('manage/pegawai/view/'. $employeeId);
  }

  public function add_workshop(){    
    if ($_POST == TRUE) {
      $employeeId = $_POST['employee_id'];
      $start_date = $_POST['start_date'];
      $end_date = $_POST['end_date'];
      $penyelenggara = $_POST['penyelenggara'];
      $lokasi = $_POST['lokasi'];
      $cpt = count($_POST['penyelenggara']);
      
      $params['employee_id'] = $employeeId; 
      for ($i = 0; $i < $cpt; $i++) {
        $params['start_date'] = $start_date[$i];
        $params['end_date'] = $end_date[$i];
        $params['penyelenggara'] = $penyelenggara[$i];
        $params['lokasi'] = $lokasi[$i];
        $this->Pegawai_model->addRiwayatPelatihan($params);
      }
    }
    $this->session->set_flashdata('success',' Tambah Berhasil');
    redirect('manage/pegawai/view/'. $employeeId);

  }

  public function add_family(){    
    if ($_POST == TRUE) {
      $employeeId = $_POST['employee_id'];
      $fam_name = $_POST['fam_name'];
      $fam_desc = $_POST['fam_desc'];
      $cpt = count($_POST['fam_name']);
      
      $params['employee_id'] = $employeeId; 
      for ($i = 0; $i < $cpt; $i++) {
        $params['fam_name'] = $fam_name[$i];
        $params['fam_desc'] = $fam_desc[$i];
        $this->Pegawai_model->addKeluargaPegawai($params);
      }
    }
    $this->session->set_flashdata('success',' Tambah Berhasil');
    redirect('manage/pegawai/view/'. $employeeId);
  }

  public function add_position(){
    
    if ($_POST == TRUE) {
      $employeeId = $_POST['employee_id'];
      $position_start = $_POST['position_start'];
      $position_end = $_POST['position_end'];
      $position_desc = $_POST['position_desc'];
      $cpt = count($_POST['position_start']);
      
      $params['employee_id'] = $employeeId; 
      for ($i = 0; $i < $cpt; $i++) {
        $params['position_start'] = $position_start[$i];
        $params['position_end'] = $position_end[$i];
        $params['position_desc'] = $position_desc[$i];
        $this->Pegawai_model->addRiwayatJabatan($params);
      }
    }
    $this->session->set_flashdata('success',' Tambah Berhasil');
    redirect('manage/pegawai/view/'. $employeeId);
  }
  public function add_teaching(){   
    if ($_POST == TRUE) {
      $employeeId = $_POST['employee_id'];
      $teaching_start = $_POST['teaching_start'];
      $teaching_end = $_POST['teaching_end'];
      $teaching_lesson = $_POST['teaching_lesson'];
      $teaching_desc = $_POST['teaching_desc'];
      $cpt = count($_POST['teaching_start']);
      
      $params['employee_id'] = $employeeId; 
      for ($i = 0; $i < $cpt; $i++) {
        $params['teaching_start'] = $teaching_start[$i];
        $params['teaching_end'] = $teaching_end[$i];
        $params['teaching_lesson'] = $teaching_lesson[$i];
        $params['teaching_desc'] = $teaching_desc[$i];
        $this->Pegawai_model->addRiwayatMengajar($params);
      }
    }
    $this->session->set_flashdata('success',' Tambah Berhasil');
    redirect('manage/pegawai/view/'. $employeeId);
  }
  public function add_achievement(){
    
    if ($_POST == TRUE) {
      $employeeId = $_POST['employee_id'];
      $achievement_year = $_POST['achievement_year'];
      $achievement_name = $_POST['achievement_name'];
      $cpt = count($_POST['achievement_year']);
      
      $params['employee_id'] = $employeeId; 
      for ($i = 0; $i < $cpt; $i++) {
        $params['achievement_year'] = $achievement_year[$i];
        $params['achievement_name'] = $achievement_name[$i];
        $this->Pegawai_model->addPenghargaanPegawai($params);
      }
    }
    $this->session->set_flashdata('success',' Tambah Berhasil');
    redirect('manage/pegawai/view/'. $employeeId);
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
    $this->load->library('upload');

    $config['upload_path'] = FCPATH . 'uploads/pegawai/';

    /* create directory if not exist */
    if (!is_dir($config['upload_path'])) {
      mkdir($config['upload_path'], 0777, TRUE);
    }

    $config['allowed_types'] = 'gif|jpg|jpeg|png';
    $config['max_size'] = '1024';
    $config['file_name'] = $fileName;
    $this->upload->initialize($config);

    if (!$this->upload->do_upload($name)) {
      $this->session->set_flashdata('success', $this->upload->display_errors('', ''));
      redirect(uri_string());
    }

    $upload_data = $this->upload->data();

    return $upload_data['file_name'];
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

  function printPegawai($id = NULL)
  {  
    $this->load->helper(array('dompdf'));
    
    $data['pegawai'] = $this->Pegawai_model->get(array('id' => $id));
    $data['pendidikan_terakhir'] = $this->Pegawai_model->getRiwayat('riwayat_pendidikan_pegawai');
    $data['riwayat_pelatihan'] = $this->Pegawai_model->getRiwayat('riwayat_pelatihan');
    $data['riwayat_jabatan'] = $this->Pegawai_model->getRiwayat('riwayat_jabatan');
    $data['riwayat_mengajar'] = $this->Pegawai_model->getRiwayat('riwayat_mengajar');
    $data['data_keluarga'] = $this->Pegawai_model->getRiwayat('data_keluarga_pegawai');
    $data['penghargaan'] = $this->Pegawai_model->getRiwayat('penghargaan_pegawai');
        
    $html = $this->load->view('pegawai/pegawai_print', $data, true);
    $data = pdf_create($html, "Riwayat_hidup". $data['pegawai']['employee_name'], TRUE, 'A4', 'potrait');
  }
  function printPdf($id = NULL)
  {
    $this->load->helper(array('dompdf'));
    $this->load->helper(array('tanggal'));
    
  }

    
  public function download() {
    //if (majors()=='senior') {
    //  $data = file_get_contents("./media/template_excel/Template_Data_Pegawai_Senior.xls");
    ///  $name = 'Template_Data_Pegawai_Senior.xls';
    //} else {
      $data = file_get_contents("./media/template_excel/Template_Data_Pegawai.xls");
      $name = 'Template_Data_Pegawai.xls';
    //}

    $this->load->helper('download');
    force_download($name, $data);
  }

  public function import() {
    if ($_POST) {
      $rows= explode("\n", $this->input->post('rows'));
      $success = 0;
      $failled = 0;
      $exist = 0;
      foreach($rows as $row) {
        $exp = explode("\t", $row);
        $count = 23;
        if (count($exp) != $count) continue;
        $ttl = trim($exp[5]);
        $date = str_replace('-', '',$ttl); 
        $arr = [
          'employee_nip' => trim($exp[0]),
          'employee_nik' => trim($exp[1]),
          //'employee_majors_id' => trim($exp[2]),
          'employee_password' => sha1(date('dmY', strtotime($date))),
          'employee_name' => trim($exp[3]),
          'employee_born_place' => trim($exp[4]),
          'employee_born_date' => trim($exp[5]),
          'employee_mulai_tugas' => trim($exp[6]),
          'employee_gender' => trim($exp[7]),
          'employee_agama' => trim($exp[8]),
          'employee_email' => trim($exp[9]),
          'employee_address' => trim($exp[10]),
          'employee_kodepos' => trim($exp[11]),
          'employee_phone' => trim($exp[12]),
          //'employee_position_id' => trim($exp[13]),
          'employee_golongan' => trim($exp[14]),
          'employee_pendidikan_akhir' => trim($exp[15]),
          'employee_bpjs_kesehatan' => trim($exp[16]),
          'employee_bpjs_ketenagakerjaan' => trim($exp[17]),
          'employee_aktif' => trim($exp[18]),
          'employee_alumni' => trim($exp[19]),
          'employee_asal_sekolah' => trim($exp[20]),
          'employee_pindah_ke_sekolah' => trim($exp[21]),
          'employee_alasan_pindah' => trim($exp[22]),
          'employee_tanggal_keluar' => trim($exp[23]),
          'employee_input_date' => date('Y-m-d H:i:s'),
          'employee_last_update' => date('Y-m-d H:i:s')
        ];
        
        
        if (trim($exp[2]) != NULL) {
          $majors = $this->Pegawai_model->get_majors(array('majors_name'=>trim($exp[2])));
          if (is_null($majors)) {            
            $this->session->set_flashdata('failed', 'Unit tidak ada');
            redirect('manage/pegawai/import');
          }else{
            $arr['employee_majors_id'] = $majors['id'];
          }
        }
        
        if (trim($exp[13]) != NULL) {
          $jabatan = $this->Jabatan_model->get(array('position_name'=>trim($exp[13])));
          if (is_null($jabatan)) {     
            $this->session->set_flashdata('failed', 'Jabatan tidak ada');
            redirect('manage/pegawai/import');
          }else{
            $arr['employee_position_id'] = $jabatan['id'];
          }
        }

        //$jabatan = $this->Jabatan_model->get(array('id'=>trim($exp[13])));
        //if (majors()=='senior') {
        //$majors = $this->Pegawai_model->get_majors(array('id'=>trim($exp[13])));
        //}
        $check = $this->db
        ->where('student_nip', trim($exp[0]))
        ->count_all_results('pegawai');
        if ($check == 0) {
        //  if (trim($exp[13]) == NULL OR is_null($jabatan)) {
         //   $this->session->set_flashdata('failed', 'ID Kelas tidak ada');
        //    redirect('manage/pegawai/import');
           
        //} else 
        if ($this->db->insert('pegawai', $arr)) {
          $success++;
        } else {
          $failled++;
        }
      } else {
        $exist++;
      }
    }

    $msg = 'Sukses : ' . $success. ' baris, Gagal : '. $failled .', Duplikat : ' . $exist;
    $this->session->set_flashdata('success', $msg);
    redirect('manage/pegawai/import');
  } else {
    $data['title'] = 'Import Data Pegawai';
    $data['main'] = 'pegawai/pegawai_upload';
    $data['action'] = site_url(uri_string());
    $this->load->view('manage/layout', $data);
  }
}
}