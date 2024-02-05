<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kartu_set extends CI_Controller {

	public function __construct() {
		parent::__construct(TRUE);
		if ($this->session->userdata('logged') == NULL) {
			header("Location:" . site_url('manage/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
		}
		
		$this->load->model('Kartu_model', 'admin');
		$this->load->library('form_validation');
	}

	public function index()
	{
	  $data['title'] = 'Bin Card';
	  $data['barang'] = $this->db->get_where('barang')->result_array();
	 
	  $data['main'] = 'kartu/barang';
	  $this->load->view('manage/layout', $data); 
	  //$this->template->load('templates/dashboard', 'kartu_kendali/barang', $data);
	}
}