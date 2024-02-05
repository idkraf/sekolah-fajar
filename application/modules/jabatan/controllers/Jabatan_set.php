<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan_set extends CI_Controller {

  public function __construct()
  {
    parent::__construct(TRUE);
    if ($this->session->userdata('logged') == NULL) {
        header("Location:" . site_url('manage/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
    }
    $this->load->model(array('pegawai/Pegawai_model', 'jabatan/Jabatan_model', 'setting/Setting_model'));
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
      $params['position_search'] = $f['n'];
    }
    $params['group'] = TRUE;

    $paramsPage = $params;
    $params['limit'] = 10;
    $params['offset'] = $offset;
    $data['jabatan'] = $this->Jabatan_model->get($params);


    $config['per_page'] = 10;
    $config['uri_segment'] = 4;
    $config['base_url'] = site_url('manage/jabatan/index');
    $config['suffix'] = '?' . http_build_query($_GET, '', "&");
    $config['total_rows'] = count($this->Jabatan_model->get($paramsPage));

    $this->pagination->initialize($config);

    $data['title'] = 'Jabatan Pegawai';
    $data['main'] = 'jabatan/jabatan_list';
    $this->load->view('manage/layout', $data);

  }

  // Add User and Update
  public function add($id = NULL)
  {
    $list_access = array(SUPERUSER);
    if (!in_array($this->session->userdata('uroleid'), $list_access)) {
      redirect('manage');
    }
    $this->load->library('form_validation');

    $data['operation'] = is_null($id) ? 'Tambah' : 'Sunting';

    if (!$this->input->post('employee_id')) {
    
      $this->form_validation->set_rules('student_password', 'Password', 'trim|required|xss_clean|min_length[6]');
      $this->form_validation->set_rules('passconf', 'Konfirmasi password', 'trim|required|xss_clean|min_length[6]|matches[student_password]');
      $this->form_validation->set_message('passconf', 'Password dan konfirmasi password tidak cocok');

    }

    $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button position="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
    
    if ($_POST and $this->form_validation->run() == TRUE) {
      
      if ($this->input->post('employee_id')) {
        $params['employee_id'] = $id;
      } else {
        $params['employee_input_date'] = date('Y-m-d H:i:s');
        $params['employee_password'] = sha1($this->input->post('employee_password'));
      }
      
      $params['employee_name'] = $this->input->post('employee_name');
      $params['employee_born_place'] = $this->input->post('employee_born_place');
      $params['employee_born_date'] = $this->input->post('employee_born_date');
      $params['employee_address'] = $this->input->post('employee_address');
      $params['employee_nip'] = $this->input->post('employee_nip');
      $params['employee_gender'] = $this->input->post('employee_gender');
      $params['employee_phone'] = $this->input->post('employee_phone');
      $params['employee_email'] = $this->input->post('employee_email');
      $params['employee_majors_id'] = $this->input->post('employee_majors_id');

      $params['employee_last_update'] = date('Y-m-d H:i:s');
      $params['employee_status'] = $this->input->post('employee_status');
      $status = $this->Pegawai_model->add($params);

      if (!empty($_FILES['employee_photo']['name'])) {
        $paramsupdate['employee_photo'] = $this->do_upload($name = 'employee_photo', $fileName = $params['employee_name']);
      }

      $paramsupdate['employee_id'] = $status;
      $this->Student_model->add($paramsupdate);

      // activity log
      $this->load->model('logs/Logs_model');
      $this->Logs_model->add(
        array(
          'log_date' => date('Y-m-d H:i:s'),
          'user_id' => $this->session->userdata('uid'),
          'log_module' => 'Employee',
          'log_action' => $data['operation'],
          'log_info' => 'ID:' . $status . ';Name:' . $this->input->post('pegawai_name')
        )
      );

      $this->session->set_flashdata('success', $data['operation'] . ' Siswa Berhasil');
      redirect('manage/jabatan');
    }else{

      if ($this->input->post('employee_id')) {
        redirect('manage/jabatan/edit/' . $this->input->post('employee_id'));
      }
      

      // Edit mode
      if (!is_null($id)) {
        $object = $this->Jabatan_model->get(array('id' => $id));
        if ($object == NULL) {
          redirect('manage/jabatan');
        } else {
          $data['jabatan'] = $object;
        }
      }
      $data['setting_level'] = $this->Setting_model->get(array('id' => 7));
      $data['ngapp'] = 'ng-app="classApp"';
      $data['position'] = $this->Jabatan_model->get_position();
      $data['majors'] = $this->Jabatan_model->get_majors();
      $data['title'] = $data['operation'] . ' Jabatan';
      $data['main'] = 'jabatan/jabatan_add';
      $this->load->view('manage/layout', $data);
    }
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

  // Add User_customer and Update
  public function add_jabatan()
  {    
    if ($_POST == TRUE) {
      $posId = $_POST['position_majors_id'];
      $posName = $_POST['pos_name'];
      $posCode = $_POST['position_code'];
      $cpt = count($_POST['pos_name']);
      
      $params['position_majors_id'] = $posId; 
      for ($i = 0; $i < $cpt; $i++) {
        $params['position_name'] = $posName[$i];
        $params['position_code'] = $posCode[$i];
        $this->Jabatan_model->add($params);
      }
    }
    $this->session->set_flashdata('success',' Tambah Berhasil');
    redirect('manage/jabatan');
  }
  
  public function update_jabatan()
  {    
      if ($_POST == TRUE) {
      
      $id = $_POST['position_id'];
      $posId = $_POST['majors_id'];
      $posName = $_POST['name_unit'];
      $posCode = $_POST['code_unit'];
      
      $params['position_id'] = $id; 
      $params['position_majors_id'] = $posId; 
      $params['position_name'] = $posName;
      $params['position_code'] = $posCode;
      $this->Jabatan_model->update($params);
      }
      $this->session->set_flashdata('success',' Tambah Berhasil');
      redirect('manage/jabatan');
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