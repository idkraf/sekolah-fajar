<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('users/Users_model');
        $this->load->model('setting/Setting_model');
        $this->load->library('form_validation');
        $this->load->helper('string');
    }
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data['setting_school'] = $this->Setting_model->get(array('id'=>1));
		$data['setting_yayasan'] = $this->Setting_model->get(array('id' => 12));
		$data['setting_logo'] = $this->Setting_model->get(array('id'=>SCHOOL_LOGO));
		$data['setting_logo_yayasan'] = $this->Setting_model->get(array('id'=>SCHOOL_LOGO_YAYASAN));
		$this->load->view('portal', $data);
	}
}
