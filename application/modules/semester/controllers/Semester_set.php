<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Semester_set extends CI_Controller {

  public function __construct() {
    parent::__construct(TRUE);
    if ($this->session->userdata('logged') == NULL) {
      header("Location:" . site_url('manage/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
    }
    $this->load->model(array('semester/Semester_model', 'period/Period_model', 'payment/Payment_model', 'logs/Logs_model'));
    $this->load->library('upload');
  }

// semester view in list
  public function index($offset = NULL) {
    $this->load->library('pagination');
// Apply Filter
// Get $_GET variable
    $f = $this->input->get(NULL, TRUE);

    $data['f'] = $f;

    $params = array();
// Nip
    if (isset($f['n']) && !empty($f['n']) && $f['n'] != '') {
      $params['semester'] = $f['n'];
    }

    $paramsPage = $params;
    $params['limit'] = 5;
    $params['offset'] = $offset;
    $data['semester'] = $this->Semester_model->get($params);

    $config['per_page'] = 5;
    $config['uri_segment'] = 4;
    $config['base_url'] = site_url('manage/semester/index');
    $config['suffix'] = '?' . http_build_query($_GET, '', "&");
    $config['total_rows'] = count($this->Semester_model->get($paramsPage));
    $this->pagination->initialize($config);

    $data['title'] = 'Semester';
    $data['main'] = 'semester/semester_list';
    $this->load->view('manage/layout', $data);
  }


// Add semester and Update
  public function add($id = NULL) {
    $this->load->library('form_validation');
    $this->form_validation->set_rules('semester_name', 'Nama semester', 'trim|required|xss_clean');
    $this->form_validation->set_rules('semester_status', 'Status', 'trim|required|xss_clean');

    $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
    $data['operation'] = is_null($id) ? 'Tambah' : 'Sunting';

    if ($_POST AND $this->form_validation->run() == TRUE) {

      if ($this->input->post('semester_id')) {
        $params['semester_id'] = $this->input->post('semester_id');
      }
      $params['period_id'] = $this->input->post('n');


      //$params['period_start'] = $this->input->post('period_start');
      //$params['period_end'] = $this->input->post('period_end');
      
      $params['semester_name'] = $this->input->post('semester_name');
      $params['semester_status'] = $this->input->post('semester_status');

      $non = array(
        'semester_status' => 0,
        'status_active' => TRUE
      );

      $this->Semester_model->add($non);

      $status = $this->Semester_model->add($params);
      $paramsupdate['semester_id'] = $status;
      $this->Semester_model->add($paramsupdate);


// activity log
      $this->Logs_model->add(
        array(
          'log_date' => date('Y-m-d H:i:s'),
          'user_id' => $this->session->userdata('user_id'),
          'log_module' => 'Semester',
          'log_action' => $data['operation'],
          'log_info' => 'ID:null;Title:' . $params['semester_name']
        )
      );

      $this->session->set_flashdata('success', $data['operation'] . ' semester berhasil');
      redirect('manage/semester');
    } else {
      if ($this->input->post('semester_id')) {
        redirect('manage/semester/edit/' . $this->input->post('semester_id'));
      }

// Edit mode
      if (!is_null($id)) {
        $data['semester'] = $this->Semester_model->get(array('id' => $id));
      }
      $data['period'] = $this->Period_model->get();
      $data['title'] = $data['operation'] . ' semester';
      $data['main'] = 'semester/semester_add';
      $this->load->view('manage/layout', $data);
    }
  }

  function semester_active($id = NULL) { 

    $non = array(
      'semester_status' => 0,
      'status_active' => TRUE
    );

    $this->Semester_model->add($non);

    $active = array(
      'semester_id' => $id,
      'semester_status' => 1
    );

    $status = $this->Semester_model->add($active);



    if ($this->input->is_ajax_request()) {
      echo $status;
    } else {
      $this->session->set_flashdata('success', 'Aktif semester Berhasil');
      redirect('manage/semester');
    }
  }


// Delete to database
  public function delete($id = NULL) {
    if ($this->session->userdata('uroleid')!= SUPERUSER){
      redirect('manage');
    }
    if ($_POST) {

      $payment = $this->Payment_model->get(array('semester_id'=>$this->input->post('semester_id')));

      if (count($payment) > 0) {
        $this->session->set_flashdata('failed', 'Semester tidak dapat dihapus');
        redirect('manage/semester');
      }

      $this->Semester_model->delete($this->input->post('semester_id'));
      // activity log
      $this->load->model('logs/Logs_model');
      $this->Logs_model->add(
        array(
          'log_date' => date('Y-m-d H:i:s'),
          'user_id' => $this->session->userdata('uid'),
          'log_module' => 'Semester',
          'log_action' => 'Hapus',
          'log_info' => 'ID:' . $id . ';Title:' . $this->input->post('delName')
        )
      );
      $this->session->set_flashdata('success', 'Hapus Tahun Ajaran berhasil');
      redirect('manage/semester');
    } elseif (!$_POST) {
      $this->session->set_flashdata('delete', 'Delete');
      redirect('manage/semester/edit/' . $id);
    }
  }

}