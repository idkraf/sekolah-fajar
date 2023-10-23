<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bukti_set extends CI_Controller
{
  public function __construct()
  {
    parent::__construct(TRUE);
    if ($this->session->userdata('logged') == NULL) {
      header("Location:" . site_url('manage/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
    }
    $this->load->model(array('bukti/Bukti_model', 'student/Student_model', 'period/Period_model', 'pos/Pos_model', 'bulan/Bulan_model', 'bebas/Bebas_model', 'bebas/Bebas_pay_model', 'logs/Logs_model','payment/Payment_model'));
  }

  // payment view in list
  public function index($offset = NULL)
  {
    $this->load->library('pagination');
    // Apply Filter
    // Get $_GET variable
    $f = $this->input->get(NULL, TRUE);

    $data['f'] = $f;

    $params = array();
    // Tahun Ajaran
    if (isset($f['n']) && !empty($f['n']) && $f['n'] != '') {
      $params['search'] = $f['n'];
    }

    if($this->session->userdata('uroleid') == 3){
      $params['student_nis'] = $this->session->userdata('uemail');
    }

    $paramsPage = $params;
    $params['limit'] = 50;
    $params['offset'] = $offset;
    $data['payment'] = $this->Bukti_model->get($params);
    $data['userRole'] = $this->session->userdata('uroleid');

    $config['per_page'] = 50;
    $config['uri_segment'] = 4;
    $config['base_url'] = site_url('manage/bukti/index');
    $config['suffix'] = '?' . http_build_query($_GET, '', "&");
    $config['total_rows'] = count($this->Bukti_model->get($paramsPage));
    $this->pagination->initialize($config);

    $data['title'] = 'Bukti Bayar';
    $data['main'] = 'bukti/bukti_list';
    $this->load->view('manage/layout', $data);
  }

  public function Approve($id = NULL) 
  {
    $where = array('id' => $id);
    $pay = $this->Bukti_model->get($where);
    //Update Saldo Siswa
    $params['student_id'] = $pay['student_student_id'];
    $params['SaldoBulanan'] = $pay['nilai'];
    $params['SaldoBebas'] = $pay['nilaiBebas'];
    $this->Student_model->add($params);

    $update_data = array('status'=> 1);
    $where = array('id' => $id);
    $res = $this->db->update('buktibayar',$update_data,$where);
    if ($res >= 1) {
      $this->session->set_flashdata('success', ' Bukti Bayar Di Approve');
      $this->index();
    }
  }
  public function Reject($id = NULL) 
  {
      $update_data = array('status'=> 2);
      $where = array('id' => $id);
      $res = $this->db->update('buktibayar',$update_data,$where);
      if ($res >= 1) {
        $this->session->set_flashdata('success', ' Bukti Bayar Di Reject');
        $this->index();
      }
  }

  // Add payment and Update
  public function add($id = NULL)
  {
    $this->load->library('form_validation');
    //$this->form_validation->set_rules('pos_id', 'Jenis Pembayaran', 'trim|required|xss_clean');
    $this->form_validation->set_rules('period_id', 'Tahun Pelajaran', 'trim|required|xss_clean');
    if($this->session->userdata('uroleid') <> 3){
      $this->form_validation->set_rules('student_id', 'Nama Siswa', 'trim|required|xss_clean');
    }
    //$this->form_validation->set_rules('nilai', 'Total Bayar', 'trim|required|xss_clean');
    $this->form_validation->set_rules('description', 'Keterangan', 'trim|required|xss_clean');
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
    $data['operation'] = is_null($id) ? 'Tambah' : 'Edit';
    $userRole = $this->session->userdata('uroleid');
    $data['userRole'] = $userRole;
    $data['GetStudentID'] = 0;
    if($userRole == 3){
      $databukti = $this->db->query("select student_id from student where student_nis = '".$this->session->userdata('uemail')."'");
		  $res = $databukti -> result_array();
      $data['GetStudentID'] = $res[0]['student_id'];
    }

    if ($_POST and $this->form_validation->run() == TRUE) {

      if ($this->input->post('id')) {
        $params['id'] = $this->input->post('id');
      } else {
        //$params['payment_input_date'] = date('Y-m-d H:i:s');
      }

      $params['period_id'] = $this->input->post('period_id');
      $params['student_id'] = $userRole == 3 ? $this->input->post('GetStudentIDs') : $this->input->post('student_id');
      $posid = str_replace("BULANAN", "",$this->input->post('pos_id'));
      $posid = str_replace("BEBAS", "",$this->input->post('pos_id'));
      $params['pos_id'] = $posid;
      $params['nilai'] = $this->input->post('nilai');
      $params['nilaiBebas'] = $this->input->post('nilaiBebas');
      $params['description'] = $this->input->post('description');
      
      if (!empty($_FILES['image']['name'])) {
        $params['upload_image'] = $this->do_upload($name = 'image', $fileName= date('YmdHis'));
      }

      $status = $this->Bukti_model->add($params);
      $paramsupdate['id'] = $status;
      $this->Bukti_model->add($paramsupdate);
      
      // activity log
      $this->Logs_model->add(
        array(
          'log_date' => date('Y-m-d H:i:s'),
          'user_id' => $this->session->userdata('user_id'),
          'log_module' => 'Bukti Bayar',
          'log_action' => $data['operation'],
          'log_info' => 'ID:null;Title:'.$paramsupdate
        )
      );

      $this->session->set_flashdata('success', $data['operation'] . ' Bukti Bayar berhasil');
      redirect('manage/bukti');
    } else {
      if ($this->input->post('id')) {
        redirect('manage/bukti/edit/' . $this->input->post('id'));
      }

      // Edit mode
      if (!is_null($id)) {
        $data['payment'] = $this->Bukti_model->get(array('id' => $id));
      }
      $data['period'] = $this->Period_model->get();
      $data['pos'] = $this->Payment_model->get();

      $paramstudent = array();
      // Nip
      // if (isset($f['n']) && !empty($f['n']) && $f['n'] != '') {
      //   $params['student_search'] = $f['n'];
      // }
      $paramstudent['group'] = TRUE;

      $data['student'] = $this->Student_model->get($paramstudent);
      $data['title'] = $data['operation'] . ' Bukti Bayar';
      $data['main'] = 'bukti/bukti_add';
      $this->load->view('manage/layout', $data);
    }
  }

  // Setting Upload File Requied
  function do_upload($name=NULL, $fileName=NULL) {
    $this->load->library('upload');

    $config['upload_path'] = FCPATH . 'uploads/ubukti/';

    /* create directory if not exist */
    if (!is_dir($config['upload_path'])) {
        mkdir($config['upload_path'], 0777, TRUE);
    }

    $config['allowed_types'] = 'gif|jpg|jpeg|png';
    $config['max_size'] = '32000';
    $config['file_name'] = $fileName;
            $this->upload->initialize($config);

    if (!$this->upload->do_upload($name)) {
        $this->session->set_flashdata('failed', $this->upload->display_errors('', ''));
        redirect(uri_string());
    }

    $upload_data = $this->upload->data();

    return $upload_data['file_name'];
}
// Delete to database
public function delete($id = NULL)
{
  // if ($this->session->userdata('uroleid') != SUPERUSER) {
  //   redirect('manage');
  // }
  if ($_POST) {

    $this->Bukti_model->delete($this->input->post('id'));
    // activity log
    $this->load->model('logs/Logs_model');
    $this->Logs_model->add(
      array(
        'log_date' => date('Y-m-d H:i:s'),
        'user_id' => $this->session->userdata('uid'),
        'log_module' => 'Bukti Bayar',
        'log_action' => 'Hapus',
        'log_info' => 'ID:' . $id . ';Title:Bukti Bayar'
      )
    );
    $this->session->set_flashdata('success', 'Hapus Bukti Bayar Berhasil');
    redirect('manage/bukti');
  } elseif (!$_POST) {
    $this->session->set_flashdata('delete', 'Delete');
    redirect('manage/bukti/edit/' . $id);
  }
}

}
