<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Student_set extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('logged') == NULL) {
      header("Location:" . site_url('manage/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
    }

    $this->load->model(array('student/Student_model', 'setting/Setting_model', 'bulan/Bulan_model', 'bebas/Bebas_model'));
    $this->load->helper(array('form', 'url'));
  }

  public function export() {
    $st = 0;
    $us = 0;
    $pr = 0;
    $data = array();
    //$list = $this->Student_model->get_datatables($st,$us,$pr);
    $list = $this->Student_model->getAllData();
    foreach ($list as $prd) {
      $row = array();
      $row[] = $prd->student_nis;
      $row[] = $prd->student_full_name;
      $data[] = $row;
    }
    //$data = $this->Student_model->getAllData();
    //$data['length'] = $this->Student_model->count_all();
    $output = array(
        //"length" => $this->Student_model->count_all(),
        "recordsTotal" => $this->Student_model->count_all(),
        "recordsFiltered" => $this->Student_model->countAllfiltered(),
        "data" => $data,
    );
    echo json_encode($output);
  }

  public function ajax_list() {
    $st = $this->input->post('st');
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
        $row[] = $prd->majors_name;
        $row[] = $prd->class_name;
        $row[] = $prd->student_telp_ayah . ' - ' . $prd->student_telp_ibu;
        $row[] = $prd->student_status == 1 ? '<label class="label label-success">Aktif</label>' : '<label class="label label-danger">Tidak Aktif</label>' ;
        $row[] = '<a href="'.base_url('manage/student/rpw'). '/' . $prd->student_id .'" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-unlock"></i></a>
        <a href="'.base_url('manage/student/view'). '/' . $prd->student_id .'" class="btn btn-info btn-circle btn-sm"><i class="fa fa-eye"></i></a>
        <a href="'.base_url('manage/student/edit'). '/' . $prd->student_id .'" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-edit"></i></a>
        <a href="'.base_url('manage/student/printPdf'). '/' . $prd->student_id .'" class="btn btn-success btn-circle btn-sm view-pdf"><i class="fa fa-print"></i></a>
        ';     
        $row[] = $prd->student_no;
        $row[] = $prd->student_nis;
        $row[] = $prd->student_nik;
        $row[] = $prd->student_nomor_virtual_bank;
        $row[] = $prd->majors_name;
        $row[] = $prd->student_nisn;
        $row[] = $prd->student_full_name;
        $row[] = $prd->student_nama_panggilan;
        $row[] = $prd->student_born_place;
        $row[] = $prd->student_born_date;
        $row[] = $prd->student_gender;
        $row[] = $prd->student_phone;
        $row[] = $prd->student_email;
        $row[] = $prd->student_kewarganegaraan;
        $row[] = $prd->student_agama;
        $row[] = $prd->student_pelajaran_agama;
        $row[] = $prd->student_address;
        $row[] = $prd->student_kelurahan;
        $row[] = $prd->student_kecamatan;
        $row[] = $prd->student_provinsi;
        $row[] = $prd->student_golongan_darah;
        $row[] = $prd->student_tingkatan;
        $row[] = $prd->class_name;
        $row[] = $prd->student_jurusan;
        $row[] = $prd->student_anak_ke;
        $row[] = $prd->student_jumlah_saudara;
        $row[] = $prd->student_tanggal_masuk;
        $row[] = $prd->student_penyakit_yang_pernah_diderita;
        $row[] = $prd->student_tinggi;
        $row[] = $prd->student_berat;
        $row[] = $prd->student_bahasa_rumah;
        $row[] = $prd->student_imunisasi;
        $row[] = $prd->student_alergi_makanan;
        $row[] = $prd->student_name_of_father;
        $row[] = $prd->student_pekerjaan_ayah;
        $row[] = $prd->student_alamat_ayah;
        $row[] = $prd->student_telp_ayah;
        $row[] = $prd->student_email_ayah;
        $row[] = $prd->student_agama_ayah;
        $row[] = $prd->student_tempat_lahir_ayah;
        $row[] = $prd->student_tanggal_lahir_ayah;
        $row[] = $prd->student_kewarganegaraan_ayah;
        $row[] = $prd->student_pendidikan_terakhir_ayah;
        $row[] = $prd->student_name_of_mother;
        $row[] = $prd->student_pekerjaan_ibu;
        $row[] = $prd->student_alamat_ibu;
        $row[] = $prd->student_telp_ibu;
        $row[] = $prd->student_email_ibu;
        $row[] = $prd->student_agama_ibu;
        $row[] = $prd->student_tempat_lahir_ibu;
        $row[] = $prd->student_tanggal_lahir_ibu;
        $row[] = $prd->student_kewarganegaraan_ibu;
        $row[] = $prd->student_pendidikan_terakhir_ibu;
        $row[] = $prd->student_pekerjaan_wali;
        $row[] = $prd->student_nama_wali;
        $row[] = $prd->student_alamat_wali;
        $row[] = $prd->student_telp_wali;
        $row[] = $prd->student_email_wali;
        $row[] = $prd->student_status;
        $row[] = $prd->student_alumni;
        $row[] = $prd->student_sekolah_asal;
        $row[] = $prd->student_pindah_ke_sekolah;
        $row[] = $prd->student_alasan_pindah;
        $row[] = $prd->student_status_dalam_keluarga;
        $row[] = $prd->student_tanggal_keluar;
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
  // User_customer view in list
  public function index($offset = NULL) {
    $f = $this->input->get(NULL, TRUE);
    $data['f'] = $f;
    $data['pr'] = "0";
    $data['us'] = "0";
    $data['st'] = "0";
    $params = array();
    // Nip
    if (isset($f['n']) && !empty($f['n']) && $f['n'] != '') {
      $params['student_search'] = $f['n'];
    }
    if (isset($f['pr']) && !empty($f['pr']) && $f['pr'] != '') {
      $params['class_id'] = $f['pr'];
      $data['pr'] = $f['pr'];
    }
    if (isset($f['us']) && !empty($f['us']) && $f['us'] != '') {
      $params['majors_id'] = $f['us'];
      $data['us'] = $f['us'];
    }
    if (isset($f['st']) && !empty($f['st']) && $f['st'] != '') {      
      $params['status'] = $f['st'];
      $data['st'] = $f['st'];
    }

    $data['majors'] = $this->Student_model->get_majors();
    $data['class'] = $this->Student_model->get_class($params);
    $data['title'] = 'Siswa';
    $data['main'] = 'student/list';
    $this->load->view('manage/layout', $data);
  }

    // User_customer view in list
  public function _index($offset = NULL) {
    $this->load->library('pagination');
    // Apply Filter
    // Get $_GET variable
    $f = $this->input->get(NULL, TRUE);

    $data['f'] = $f;
    $data['pr'] = "all";
    $data['us'] = "all";
    $data['st'] = "1";
    $params = array();
    // Nip
    if (isset($f['n']) && !empty($f['n']) && $f['n'] != '') {
      $params['student_search'] = $f['n'];
    }
    if (isset($f['pr']) && !empty($f['pr']) && $f['pr'] != '') {
      $params['class_id'] = $f['pr'];
      $data['pr'] = $f['pr'];
    }
    if (isset($f['us']) && !empty($f['us']) && $f['us'] != '') {
      $params['majors_id'] = $f['us'];
      $data['us'] = $f['us'];
    }
    if (isset($f['st']) && !empty($f['st']) && $f['st'] != '') {      
      $params['status'] = $f['st'];
      $data['st'] = $f['st'];
    }

    $paramsPage = $params;
    $params['limit'] = 10;
    $params['offset'] = $offset;
    $data['student'] = $this->Student_model->get($params);


    $config['per_page'] = 10;
    $config['uri_segment'] = 4;
    $config['base_url'] = site_url('manage/student/index');
    $config['suffix'] = '?' . http_build_query($_GET, '', "&");
    $config['total_rows'] = count($this->Student_model->get($paramsPage));

    $this->pagination->initialize($config);
    $data['class'] = $this->Student_model->get_class();

    $data['title'] = 'Siswa';
    $data['main'] = 'student/student_list';
    $this->load->view('manage/layout', $data);
  }

    // Add User and Update
  public function add($id = NULL) {

    $list_access = array(SUPERUSER);
    if (!in_array($this->session->userdata('uroleid'),$list_access)) {
      redirect('manage');
    }
    $this->load->library('form_validation');

    if (!$this->input->post('student_id')) {
      $this->form_validation->set_rules('student_nis', 'NIS', 'trim|required|xss_clean|is_unique[student.student_nis]');
      $this->form_validation->set_rules('student_password', 'Password', 'trim|required|xss_clean|min_length[6]');
      $this->form_validation->set_rules('passconf', 'Konfirmasi password', 'trim|required|xss_clean|min_length[6]|matches[student_password]');
      $this->form_validation->set_message('passconf', 'Password dan konfirmasi password tidak cocok');
    }
    $this->form_validation->set_rules('class_class_id', 'Kelas', 'trim|required|xss_clean');
    $this->form_validation->set_rules('student_full_name', 'Nama lengkap', 'trim|required|xss_clean');
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button position="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
    $data['operation'] = is_null($id) ? 'Tambah' : 'Sunting';

    if ($_POST AND $this->form_validation->run() == TRUE) {

      if ($this->input->post('student_id')) {
        $params['student_id'] = $id;
      } else {
        $params['student_input_date'] = date('Y-m-d H:i:s');
        $params['student_password'] = sha1($this->input->post('student_password'));

      }
      $params['student_nis'] = $this->input->post('student_nis');
      $params['student_nisn'] = $this->input->post('student_nisn');
      $params['student_gender'] = $this->input->post('student_gender');
      $params['student_phone'] = $this->input->post('student_phone');
      $params['student_hobby'] = $this->input->post('student_hobby');
      $params['class_class_id'] = $this->input->post('class_class_id');
      $params['majors_majors_id'] = $this->input->post('majors_majors_id');
      $params['student_last_update'] = date('Y-m-d H:i:s');
      $params['student_full_name'] = $this->input->post('student_full_name');
      $params['student_born_place'] = $this->input->post('student_born_place'); 
      $params['student_born_date'] = $this->input->post('student_born_date'); 
      $params['student_address'] = $this->input->post('student_address'); 
      $params['student_name_of_mother'] = $this->input->post('student_name_of_mother'); 
      $params['student_name_of_father'] = $this->input->post('student_name_of_father'); 
      $params['student_parent_phone'] = $this->input->post('student_parent_phone'); 
      $params['student_status'] = $this->input->post('student_status');

      $params['student_no']  = $this->input->post('student_no');
      $params['student_nik'] = $this->input->post('student_nik');
      $params['student_nomor_virtual_bank'] = $this->input->post('student_nomor_virtual_bank');
      $params['student_nama_panggilan'] = $this->input->post('student_nama_panggilan');
      $params['student_jurusan'] = $this->input->post('student_jurusan');
      $params['student_tingkatan'] = $this->input->post('student_tingkatan');
    
      $params['student_email'] = $this->input->post('student_email');
      $params['student_agama'] = $this->input->post('student_agama');
      $params['student_pelajaran_agama'] = $this->input->post('student_pelajaran_agama');
      $params['student_kewarganegaraan'] = $this->input->post('student_kewarganegaraan');
      $params['student_anak_ke'] = $this->input->post('student_anak_ke');
      $params['student_jumlah_saudara'] = $this->input->post('student_jumlah_saudara');
      $params['student_status_dalam_keluarga'] = $this->input->post('student_status_dalam_keluarga');
      $params['student_tinggi'] = $this->input->post('student_tinggi');
      $params['student_berat'] = $this->input->post('student_berat');
      $params['student_imunisasi'] = $this->input->post('student_imunisasi');
      $params['student_penyakit_yang_pernah_diderita'] = $this->input->post('student_penyakit_yang_pernah_diderita');
      $params['student_golongan_darah'] = $this->input->post('student_golongan_darah');
      $params['student_bahasa_rumah'] = $this->input->post('student_bahasa_rumah');
      $params['student_alergi_makanan'] = $this->input->post('student_alergi_makanan');
    
      $params['student_kelurahan'] = $this->input->post('student_kelurahan');
      $params['student_kecamatan'] = $this->input->post('student_kecamatan');
      $params['student_provinsi'] = $this->input->post('student_provinsi');
      
      $params['student_sekolah_asal'] = $this->input->post('student_sekolah_asal');
      $params['student_alumni'] = $this->input->post('student_alumni');
      $params['student_tanggal_masuk'] = $this->input->post('student_tanggal_masuk');
      $params['student_tanggal_keluar'] = $this->input->post('student_tanggal_keluar');
      $params['student_pindah_ke_sekolah'] = $this->input->post('student_pindah_ke_sekolah');
      $params['student_alasan_pindah'] = $this->input->post('student_alasan_pindah');
    
      $params['student_telp_ayah'] = $this->input->post('student_telp_ayah');
      $params['student_pekerjaan_ayah'] = $this->input->post('student_pekerjaan_ayah');
      $params['student_alamat_ayah'] = $this->input->post('student_alamat_ayah');
      $params['student_email_ayah'] = $this->input->post('student_email_ayah');
      $params['student_agama_ayah'] = $this->input->post('student_agama_ayah');
      $params['student_tempat_lahir_ayah'] = $this->input->post('student_tempat_lahir_ayah');
      $params['student_tanggal_lahir_ayah'] = $this->input->post('student_tanggal_lahir_ayah');
      $params['student_kewarganegaraan_ayah'] = $this->input->post('student_kewarganegaraan_ayah');
      $params['student_pendidikan_terakhir_ayah'] = $this->input->post('student_pendidikan_terakhir_ayah');
      
      $params['student_telp_ibu'] = $this->input->post('student_telp_ibu');
      $params['student_pekerjaan_ibu'] = $this->input->post('student_pekerjaan_ibu');
      $params['student_alamat_ibu'] = $this->input->post('student_alamat_ibu');
      $params['student_email_ibu'] = $this->input->post('student_email_ibu');
      $params['student_agama_ibu'] = $this->input->post('student_agama_ibu');
      $params['student_tempat_lahir_ibu'] = $this->input->post('student_tempat_lahir_ibu');
      $params['student_tanggal_lahir_ibu'] = $this->input->post('student_tanggal_lahir_ibu');
      $params['student_kewarganegaraan_ibu'] = $this->input->post('student_kewarganegaraan_ibu');
      $params['student_pendidikan_terakhir_ibu'] = $this->input->post('student_pendidikan_terakhir_ibu');
    
      $params['student_nama_wali'] = $this->input->post('student_nama_wali');
      $params['student_telp_wali'] = $this->input->post('student_telp_wali');
      $params['student_pekerjaan_wali'] = $this->input->post('student_pekerjaan_wali');
      $params['student_alamat_wali'] = $this->input->post('student_alamat_wali');
      $params['student_email_wali'] = $this->input->post('student_email_wali');


      $status = $this->Student_model->add($params);

      if (!empty($_FILES['student_img']['name'])) {
        $paramsupdate['student_img'] = $this->do_upload($name = 'student_img', $fileName= $params['student_full_name']);
      } 

      $paramsupdate['student_id'] = $status;
      $this->Student_model->add($paramsupdate);

    // activity log
      $this->load->model('logs/Logs_model');
      $this->Logs_model->add(
        array(
          'log_date' => date('Y-m-d H:i:s'),
          'user_id' => $this->session->userdata('uid'),
          'log_module' => 'Student',
          'log_action' => $data['operation'],
          'log_info' => 'ID:' . $status . ';Name:' . $this->input->post('student_full_name')
        )
      );

      $this->session->set_flashdata('success', $data['operation'] . ' Siswa Berhasil');
      redirect('manage/student');
    } else {
      if ($this->input->post('student_id')) {
        redirect('manage/student/edit/' . $this->input->post('student_id'));
      }

    // Edit mode
      if (!is_null($id)) {
        $object = $this->Student_model->get(array('id' => $id));
        if ($object == NULL) {
          redirect('manage/student');
        } else {
          $data['student'] = $object;
        }
      }
      $data['setting_level'] = $this->Setting_model->get(array('id' => 7)); 
      $data['ngapp'] = 'ng-app="classApp"';
      $data['class'] = $this->Student_model->get_class();
      $data['majors'] = $this->Student_model->get_majors();
      $data['title'] = $data['operation'] . ' Siswa';
      $data['main'] = 'student/student_add';
      $this->load->view('manage/layout', $data);
    }
  }

    // View data detail

  public function view($id = NULL) {
    $data['student'] = $this->Student_model->get(array('id' => $id));
    $data['title'] = 'Siswa';
    $data['main'] = 'student/student_view';
    $this->load->view('manage/layout', $data);
  }

    // Delete to database
  public function delete($id = NULL) {
    if ($this->session->userdata('uroleid')!= SUPERUSER){
      redirect('manage');
    }
    if ($_POST) {

      $bulan = $this->Bulan_model->get(array('student_id' => $this->input->post('student_id')));
      $bebas = $this->Bebas_model->get(array('student_id' => $this->input->post('student_id')));

      if (count($bulan)>0 OR count($bebas)>0) {
        $this->session->set_flashdata('failed', 'Siswa tidak dapat dihapus');
        redirect('manage/student');
      }

      $this->Student_model->delete($this->input->post('student_id'));

    // activity log
      $this->load->model('logs/Logs_model');
      $this->Logs_model->add(
        array(
          'log_date' => date('Y-m-d H:i:s'),
          'user_id' => $this->session->userdata('uid'),
          'log_module' => 'user',
          'log_action' => 'Hapus',
          'log_info' => 'ID:' . $id . ';Title:' . $this->input->post('delName')
        )
      );
      $this->session->set_flashdata('success', 'Hapus Siswa berhasil');
      redirect('manage/student');
    } elseif (!$_POST) {
      $this->session->set_flashdata('delete', 'Delete');
      redirect('manage/student/edit/' . $id);
    }
  }

    // Class view in list
  public function clasess($offset = NULL) {
    $this->load->library('pagination');

    $data['class'] = $this->Student_model->get_class(array('limit' => 10, 'offset' => $offset));
    $data['title'] = 'Daftar Kelas';
    $data['main'] = 'student/class_list';
    $config['total_rows'] = count($this->Student_model->get_class());
    $this->pagination->initialize($config);

    $this->load->view('manage/layout', $data);
  }

    // Setting Upload File Requied
  function do_upload($name=NULL, $fileName=NULL) {
    $this->load->library('upload');

    $config['upload_path'] = FCPATH . 'uploads/student/';

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
  public function add_class($id = NULL) {
    $this->load->library('form_validation');
    $this->form_validation->set_rules('class_name', 'Name', 'trim|required|xss_clean');
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button ket="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
    $data['operation'] = is_null($id) ? 'Tambah' : 'Sunting';

    if ($_POST AND $this->form_validation->run() == TRUE) {

      if ($this->input->post('class_id')) {
        $params['class_id'] = $this->input->post('class_id');
      }
      $params['class_name'] = $this->input->post('class_name');
      $status = $this->Student_model->add_class($params);


      $this->session->set_flashdata('success', $data['operation'] . ' Keterangan Kelas');
      redirect('manage/student/add');

      if ($this->input->post('from_angular')) {
        echo $status;
      }
    } else {
      if ($this->input->post('class_id')) {
        redirect('manage/student/class/edit/' . $this->input->post('class_id'));
      }

    // Edit mode
      if (!is_null($id)) {
        $object = $this->Student_model->get_ket(array('id' => $id));
        if ($object == NULL) {
          redirect('manage/student/class');
        } else {
          $data['class'] = $object;
        }
      }
      $data['title'] = $data['operation'] . ' Keterangan Kelas';
      $data['main'] = 'manage/student/class_add';
      $this->load->view('manage/layout', $data);
    }
  }

  public function import() {
    if ($_POST) {
      $rows= explode("\n", $this->input->post('rows'));
      $success = 0;
      $failled = 0;
      $exist = 0;
      foreach($rows as $row) {
        $exp = explode("\t", $row);
        $count = 63;// (majors()=='senior') ? 14 : 13;
        if (count($exp) != $count) continue;
        $ttl = trim($exp[9]) != "" ? trim($exp[9]) : "0000-00-00";
        $date = str_replace('-', '',$ttl); 
        $arr = [
          'student_no' => trim($exp[0]),
          'student_nis' => trim($exp[1]),
          'student_nik' => trim($exp[2]),
          'student_nomor_virtual_bank' => trim($exp[3]),
         // 'majors_majors_id' => trim($exp[4]),
          'student_nisn' => trim($exp[5]),
          'student_password' => sha1(date('dmY', strtotime($date))),
          'student_full_name' => trim($exp[6]),
          'student_nama_panggilan' => trim($exp[7]),
          'student_born_place' => trim($exp[8]),
          'student_born_date' => trim($exp[9]) != "" ? trim($exp[9]) : null,
          'student_gender' => trim($exp[10]),
          'student_phone' => trim($exp[11]),
          'student_email' => trim($exp[12]),
          'student_kewarganegaraan' => trim($exp[13]),
          'student_agama' => trim($exp[14]),
          'student_pelajaran_agama' => trim($exp[15]),
          'student_address' => trim($exp[16]),
          'student_kelurahan' => trim($exp[17]),
          'student_kecamatan' => trim($exp[18]),
          'student_provinsi' => trim($exp[19]),
          'student_golongan_darah' => trim($exp[20]),
          'student_tingkatan' => trim($exp[21]),
          //'class_class_id' => trim($exp[22]),
          'student_jurusan' => trim($exp[23]),
          'student_anak_ke' => trim($exp[24]),
          'student_jumlah_saudara' => trim($exp[25]),
          'student_tanggal_masuk' => trim($exp[26]),
          'student_penyakit_yang_pernah_diderita' => trim($exp[27]),
          'student_tinggi' => trim($exp[28]),
          'student_berat' => trim($exp[29]),
          'student_bahasa_rumah' => trim($exp[30]),
          'student_imunisasi' => trim($exp[31]),
          'student_alergi_makanan' => trim($exp[32]),
          'student_name_of_father' => trim($exp[33]),
          'student_pekerjaan_ayah' => trim($exp[34]),
          'student_alamat_ayah' => trim($exp[35]),
          'student_telp_ayah' => trim($exp[36]),
          'student_email_ayah' => trim($exp[37]),
          'student_agama_ayah' => trim($exp[38]),
          'student_tempat_lahir_ayah' => trim($exp[39]),
          'student_tanggal_lahir_ayah' => trim($exp[40]) != "" ? trim($exp[40]) : null,
          'student_kewarganegaraan_ayah' => trim($exp[41]),
          'student_pendidikan_terakhir_ayah' => trim($exp[42]),
          'student_name_of_mother' => trim($exp[43]),
          'student_pekerjaan_ibu' => trim($exp[44]),
          'student_alamat_ibu' => trim($exp[45]),
          'student_telp_ibu' => trim($exp[46]),
          'student_email_ibu' => trim($exp[47]),
          'student_agama_ibu' => trim($exp[48]),
          'student_tempat_lahir_ibu' => trim($exp[49]),
          'student_tanggal_lahir_ibu' => trim($exp[50]) != "" ? trim($exp[50]) : null,
          'student_kewarganegaraan_ibu' => trim($exp[51]),
          'student_pendidikan_terakhir_ibu' => trim($exp[52]),
          'student_pekerjaan_wali' => trim($exp[53]),
          'student_nama_wali' => trim($exp[54]),
          'student_alamat_wali' => trim($exp[55]),
          'student_telp_wali' => trim($exp[56]),
          'student_email_wali' => trim($exp[57]),
          'student_status' => trim($exp[58]),
          'student_alumni' => trim($exp[59]),
          'student_sekolah_asal' => trim($exp[60]),
          'student_pindah_ke_sekolah' => trim($exp[61]),
          'student_alasan_pindah' => trim($exp[62]),
          'student_status_dalam_keluarga' => trim($exp[63]),
          'student_tanggal_keluar' => trim($exp[64]) != "" ? trim($exp[64]) : null,
          //'student_phone' => trim($exp[7]),
          //'student_parent_phone' => trim($exp[11]),
          //'majors_majors_id' => trim($exp[13]),//(majors()=='senior') ? trim($exp[13]) : NULL,
          'student_input_date' => date('Y-m-d H:i:s'),
          'student_last_update' => date('Y-m-d H:i:s')
        ];
        
        
        if (trim($exp[4]) != NULL) {
          $majors = $this->Student_model->get_majors(array('majors_name'=>trim($exp[4])));
          if (is_null($majors)) {            
            $this->session->set_flashdata('failed', 'Unit tidak ada');
            redirect('manage/student/import');
          }else{
            //$arr['majors_majors_id'] = trim($exp[4]);
            $arr['majors_majors_id'] = $majors['id'];
          }
        }
        
        if (trim($exp[22]) != NULL) {
          //$class = $this->Student_model->get_class(array('id'=>trim($exp[22])));
          $class = $this->Student_model->get_class(array('class_name'=>trim($exp[22])));
          if (is_null($class)) {     
            $this->session->set_flashdata('failed', 'ID Kelas tidak ada');
            redirect('manage/student/import');
          }else{
            //$arr['class_class_id'] => trim($exp[22]);
            $arr['class_class_id'] = $class['id'];
          }
        }
          //if (majors()=='senior') {
        //$majors = $this->Student_model->get_majors(array('id'=>trim($exp[13])));
        //}
        $check = $this->db
        ->where('student_nis', trim($exp[1]))
        ->count_all_results('student');
        if ($check == 0) {
        //  if (trim($exp[22]) == NULL OR is_null($class)) {
        //    $this->session->set_flashdata('failed', 'ID Kelas tidak ada');
        //    redirect('manage/student/import');
           
        //} else 
        if ($this->db->insert('student', $arr)) {
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
    redirect('manage/student/import');
  } else {
    $data['title'] = 'Import Data Siswa';
    $data['main'] = 'student/student_upload';
    $data['action'] = site_url(uri_string());
    $this->load->view('manage/layout', $data);
  }
}

function rpw($id = NULL) {
  $this->load->library('form_validation');
  $this->form_validation->set_rules('student_password', 'Password', 'trim|required|xss_clean|min_length[6]');
  $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|xss_clean|min_length[6]|matches[student_password]');
  $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
  if ($_POST AND $this->form_validation->run() == TRUE) {
    $id = $this->input->post('student_id');
    $params['student_password'] = sha1($this->input->post('student_password'));
    $status = $this->Student_model->change_password($id, $params);

    $this->session->set_flashdata('success', 'Reset Password Berhasil');
    redirect('manage/student');
  } else {
    if ($this->Student_model->get(array('id' => $id)) == NULL) {
      redirect('manage/student');
    }
    $data['student'] = $this->Student_model->get(array('id' => $id));
    $data['title'] = 'Reset Password';
    $data['main'] = 'student/change_pass';
    $this->load->view('manage/layout', $data);
  }
}

public function download() {
  //if (majors()=='senior') {
    $data = file_get_contents("./media/template_excel/Template_Data_Siswa_Senior.xls");
    $name = 'Template_Data_Siswa_Senior.xls';
  //} else {
  //  $data = file_get_contents("./media/template_excel/Template_Data_Siswa_Primary.xls");
  //  $name = 'Template_Data_Siswa_Primary.xls.xls';
  //}

  $this->load->helper('download');
  force_download($name, $data);
}

public function pass($offset = NULL) {
  $f = $this->input->get(NULL, TRUE);
  $data['f'] = $f;
  $params = array();
    // Nip
  if (isset($f['pr']) && !empty($f['pr']) && $f['pr'] != '') {
    $params['class_id'] = $f['pr'];
  }

  if (isset($f['m']) && !empty($f['m']) && $f['m'] != '') {
    $params['majors_id'] = $f['m'];
  }

  $paramsPage = $params;
  $params['status'] = TRUE;
  $params['offset'] = $offset;
  $data['notpass'] = $this->Student_model->get($params);
  $data['pass'] = $this->Student_model->get(array('status'=>0));
  $data['class'] = $this->Student_model->get_class($params);
  $data['majors'] = $this->Student_model->get_majors();
  $config['base_url'] = site_url('manage/student/index');
  $config['suffix'] = '?' . http_build_query($_GET, '', "&");
  $config['total_rows'] = count($this->Student_model->get($paramsPage));


  $data['title'] = 'Kelulusan Siswa';
  $data['main'] = 'student/student_pass';
  $this->load->view('manage/layout', $data);
}

public function upgrade($offset = NULL) {
  $f = $this->input->get(NULL, TRUE);
  $data['f'] = $f;
  $params = array();
  $paramsx = array();
    // Nip
  if (isset($f['pr']) && !empty($f['pr']) && $f['pr'] != '') {
    $params['class_id'] = $f['pr'];
  }
  if (isset($f['m']) && !empty($f['m']) && $f['m'] != '') {
    $params['majors_id'] = $f['m'];
  }
  if (isset($f['mp']) && !empty($f['mp']) && $f['mp'] != '') {
    $paramsx['majors_id'] = $f['mp'];
  }


  $params['status'] =1;

  $paramsPage = $params;
  $params['offset'] = $offset;
  $data['student'] = $this->Student_model->get($params);
  $data['class'] = $this->Student_model->get_class($params);
  $data['majors'] = $this->Student_model->get_majors();
  $data['upgrade'] = $this->Student_model->get_class($paramsx);
  $config['base_url'] = site_url('manage/student/index');
  $config['suffix'] = '?' . http_build_query($_GET, '', "&");
  $config['total_rows'] = count($this->Student_model->get($paramsPage));

  $data['title'] = 'Kenaikan Kelas';
  $data['main'] = 'student/student_upgrade';
  $this->load->view('manage/layout', $data);
}

function multiple() {
  $action = $this->input->post('action');
  $print = array();
  $idcard = array();
  //if ($action == "filterSiswa") {
  //  $f = $this->input->get(NULL, TRUE);

  //  $data['f'] = $f;

  //  $params = array();
    // Nip
  //  if (isset($f['pr']) && !empty($f['pr']) && $f['pr'] != '') {
  //    $params['kelas_search'] = $f['pr'];
  //  }
  //  if (isset($f['n']) && !empty($f['n']) && $f['n'] != '') {
  //    $params['student_search'] = $f['n'];
  //  }
    

  //}else 
  if ($action == "pass") {
    $pass = $this->input->post('msg');
    for ($i = 0; $i < count($pass); $i++) {
      $this->Student_model->add(array('student_id'=> $pass[$i],'student_status'=>0, 'student_last_update'=>date('Y-m-d H:i:s')));
      $this->session->set_flashdata('success', 'Proses Lulus berhasil'); 
    } redirect('manage/student/pass');

  } elseif ($action == "notpass") {
    $notpass = $this->input->post('msg');
    for ($i = 0; $i < count($notpass); $i++) {
      $this->Student_model->add(array('student_id'=> $notpass[$i],'student_status'=>1, 'student_last_update'=>date('Y-m-d H:i:s')));
      $this->session->set_flashdata('success', 'Proses Kembali berhasil'); 
    } redirect('manage/student/pass');

  } elseif ($action == "upgrade") {
    $upgrade = $this->input->post('msg');
    for ($i = 0; $i < count($upgrade); $i++) {
      $this->Student_model->add(array('student_id'=> $upgrade[$i],'class_class_id'=>$this->input->post('class_id'), 'student_last_update'=>date('Y-m-d H:i:s')));
      $this->session->set_flashdata('success', 'Proses Kenaikan Kelas berhasil'); 
    }  redirect('manage/student/upgrade');

  } elseif ($action == "printPdf") {
    $this->load->helper(array('dompdf'));
    $print = [];
    $idcard = $this->input->post('msg');
    if($idcard != null){

      for ($i = 0; $i < count($idcard); $i++) {
        $print[] = $idcard[$i]; 
      }
    }

    $data['setting_school'] = $this->Setting_model->get(array('id' => SCHOOL_NAME));
    $data['setting_address'] = $this->Setting_model->get(array('id' => SCHOOL_ADRESS));
    $data['setting_phone'] = $this->Setting_model->get(array('id' => SCHOOL_PHONE));
    $data['setting_district'] = $this->Setting_model->get(array('id' => SCHOOL_DISTRICT));
    $data['setting_city'] = $this->Setting_model->get(array('id' => SCHOOL_CITY)); 
    $data['student'] = $this->Student_model->get(array('multiple_id' => $print));

    for($i = 0; $i < count($data['student']); $i++ ){
      $this->barcode2($data['student'][$i]['student_nis'], '');
    }
    $html = $this->load->view('student/student_multiple_pdf', $data, true);
    $data = pdf_create($html, 'KARTU_'.date('d_m_Y'), TRUE, 'A4', 'potrait');
  }

}



      // satuan
function printPdf($id = NULL) {
  $this->load->helper(array('dompdf'));
  $this->load->helper(array('tanggal'));
  $this->load->model('student/Student_model');
  $this->load->model('setting/Setting_model');
  if ($id == NULL)
    redirect('manage/student');

  $data['setting_school'] = $this->Setting_model->get(array('id' => SCHOOL_NAME));
  $data['setting_address'] = $this->Setting_model->get(array('id' => SCHOOL_ADRESS));
  $data['setting_phone'] = $this->Setting_model->get(array('id' => SCHOOL_PHONE));
  $data['setting_district'] = $this->Setting_model->get(array('id' => SCHOOL_DISTRICT));
  $data['setting_city'] = $this->Setting_model->get(array('id' => SCHOOL_CITY)); 
  $data['student'] = $this->Student_model->get(array('id' => $id));
  $this->barcode2($data['student']['student_nis'], '');
  $html = $this->load->view('student/student_pdf', $data, true);
  $data = pdf_create($html, $data['student']['student_full_name'], TRUE, 'A4', 'potrait');
}

function printRiwayat($id = NULL) {
  $this->load->helper(array('dompdf'));
  $this->load->helper(array('tanggal'));
  $this->load->model('student/Student_model');
  $this->load->model('setting/Setting_model');
  if ($id == NULL)
    redirect('manage/student');

  $data['setting_school'] = $this->Setting_model->get(array('id' => SCHOOL_NAME));
  $data['setting_address'] = $this->Setting_model->get(array('id' => SCHOOL_ADRESS));
  $data['setting_phone'] = $this->Setting_model->get(array('id' => SCHOOL_PHONE));
  $data['setting_district'] = $this->Setting_model->get(array('id' => SCHOOL_DISTRICT));
  $data['setting_city'] = $this->Setting_model->get(array('id' => SCHOOL_CITY)); 
  $data['student'] = $this->Student_model->get(array('id' => $id));
  $this->barcode2($data['student']['student_nis'], '');
  $html = $this->load->view('student/student_print', $data, true);
  $data = pdf_create($html, $data['student']['student_full_name'], TRUE, 'A4', 'potrait');
}



private function barcode2($sparepart_code, $barcode_type=39, $scale=6, $fontsize=1, $thickness=30,$dpi=72) {

  $this->load->library('upload');
  $config['upload_path'] = FCPATH . 'media/barcode_student/';

  /* create directory if not exist */
  if (!is_dir($config['upload_path'])) {
    mkdir($config['upload_path'], 0777, TRUE);
  }
  $this->upload->initialize($config);

    // CREATE BARCODE GENERATOR
    // Including all required classes
  require_once( APPPATH . 'libraries/barcodegen/BCGFontFile.php');
  require_once( APPPATH . 'libraries/barcodegen/BCGColor.php');
  require_once( APPPATH . 'libraries/barcodegen/BCGDrawing.php');

    // Including the barcode technology
    // Ini bisa diganti-ganti mau yang 39, ato 128, dll, liat di folder barcodegen
  require_once( APPPATH . 'libraries/barcodegen/BCGcode39.barcode.php');

    // Loading Font
    // kalo mau ganti font, jangan lupa tambahin dulu ke folder font, baru loadnya di sini
  $font = new BCGFontFile(APPPATH . 'libraries/font/Arial.ttf', $fontsize);

    // Text apa yang mau dijadiin barcode, biasanya kode produk
  $text = $sparepart_code;

    // The arguments are R, G, B for color.
  $color_black = new BCGColor(0, 0, 0);
  $color_white = new BCGColor(255, 255, 255);

  $drawException = null;
  try {
        $code = new BCGcode39(); // kalo pake yg code39, klo yg lain mesti disesuaikan
        $code->setScale($scale); // Resolution
        $code->setThickness($thickness); // Thickness
        $code->setForegroundColor($color_black); // Color of bars
        $code->setBackgroundColor($color_white); // Color of spaces
        $code->setFont($font); // Font (or 0)
        $code->parse($text); // Text
      } catch(Exception $exception) {
        $drawException = $exception;
      }

    /* Here is the list of the arguments
    1 - Filename (empty : display on screen)
    2 - Background color */
    $drawing = new BCGDrawing('', $color_white);
    if($drawException) {
      $drawing->drawException($drawException);
    } else {
      $drawing->setDPI($dpi);
      $drawing->setBarcode($code);
      $drawing->draw();
    }
    // ini cuma labeling dari sisi aplikasi saya, penamaan file menjadi png barcode.
    $filename_img_barcode = $sparepart_code .'_'.$barcode_type.'.png';
    // folder untuk menyimpan barcode
    $drawing->setFilename( FCPATH .'media/barcode_student/'. $sparepart_code.'.png');
    // proses penyimpanan barcode hasil generate
    $drawing->finish(BCGDrawing::IMG_FORMAT_PNG);

    return $filename_img_barcode;

  }


  public function change_class(){  
   // static $form;  
  //  $params['majors_id'] = $this->input->get('majors_id');
	//	$form = '<div class="col-sm-3"><select name="kelas_id" id="kelas_id" class="form-control"><option value="all">-- Pilih Kelas --</option>';
  //  $data = $this->Student_model->get_class($params); 
  
    //if($params['majors_id'] != "all"){
    //  $this->db->where('majors_id', $params['majors_id']);
    //}

    $data = $this->Student_model->getx('class', null, [ 'majors_id' => $this->input->get('majors_id')]); 
    //$data = $this->Student_model->getx('class');
    $output = "";   
    //$output = '<option value="">--' . 'Select' . '--</option>';
		foreach ($data as $row)
		{
      //$rowx = array();
      //$id = $row['class_id'];
      //$id = $row->class_id;
      $output .= '<option value="' . $row->class_id . '">' . $row->class_name . '</option>';
      //$output .= '<option value="'.$row['class_id'].'">'.$row['class_name']."</option>\n";
      //array_push($ouput, $id);
      //$rowx[] = '<option value="' . $row->class_id . '">' . $row->class_name . '</option>';
      //$output[] = $rowx;
    }
    //return $form."</select></div>";
    //return response()->json($output, 200);
    //echo json_encode([$data, $this->input->get('majors_id')]);
    //echo json_encode($output);
    echo $output;
  }
}