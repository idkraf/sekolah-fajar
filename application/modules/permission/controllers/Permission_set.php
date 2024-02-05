<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Permission_set extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged') == NULL) {
            header("Location:" . site_url('manage/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
        }
        $list_access = array(SUPERUSER);
        if (!in_array($this->session->userdata('uroleid'),$list_access)) {
            redirect('manage');
        }

        $this->load->model('Permission_model', 'admin');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }
    
     // User_customer view in list
     public function index($offset = NULL) {        
        $data['title'] = 'Pengguna';
        $data['main'] = 'permission/list';
        $this->load->view('manage/layout', $data);
     }
}