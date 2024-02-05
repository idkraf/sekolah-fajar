<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth_guru extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('pegawai/Pegawai_model');
        $this->load->model('setting/Setting_model');
        $this->load->library('form_validation');
        $this->load->helper('string');
    }

    function index() {
        redirect('guru/auth');
    }

    function login() {
        if ($this->session->userdata('logged_student')) {
            redirect('guru');
        }
        if ($this->input->post('location')) {
            $location = $this->input->post('location');
        } else {
            $location = NULL;
        }
        $this->form_validation->set_rules('nip', 'NIP', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($_POST AND $this->form_validation->run() == TRUE) {
            $nip = $this->input->post('nip', TRUE);
            $password = $this->input->post('password', TRUE);

            $user = $this->Pegawai_model->get(array('nip' => $nis, 'password' => sha1($password)));

            if (count($user) > 0) {
                //$this->session->set_userdata('logged_student', TRUE);
                //$this->session->set_userdata('uid_student', $guru[0]['student_id']);
                //$this->session->set_userdata('unis_student', $guru[0]['student_nis']);
                //$this->session->set_userdata('ufullname_student', $guru[0]['student_full_name']);
                //$this->session->set_userdata('student_img', $guru[0]['student_img']);
                //$this->session->set_userdata('uroleid', 2);
                
                $this->session->set_userdata('logged', TRUE);
                $this->session->set_userdata('uid', $user[0]['employee_id']);
                $this->session->set_userdata('uemail', $user[0]['employee_email']);
                $this->session->set_userdata('ufullname', $user[0]['employee_name']);
                $this->session->set_userdata('uroleid', 2);
                $this->session->set_userdata('urolename', "Guru");
                $this->session->set_userdata('user_image', $user[0]['employee_photo']);

                if ($location != '') {
                    header("Location:" . htmlspecialchars($location));
                } else {
                    redirect('manage');
                }
            } else {
                if ($location != '') {
                    $this->session->set_flashdata('failed', 'Maaf, NIS dan password tidak cocok!');
                    header("Location:" . site_url('student/auth/login') . "?location=" . urlencode($location));
                } else {
                    $this->session->set_flashdata('failed', 'Maaf, NIS dan password tidak cocok!');
                    redirect('guru/auth/login');
                }
            }
        } else {
            $data['setting_school'] = $this->Setting_model->get(array('id'=>1));
            $data['setting_logo'] = $this->Setting_model->get(array('id'=>SCHOOL_LOGO));
            $this->load->view('guru/login', $data);
        }
    }

    // Logout Processing
    function logout() {
        $this->session->unset_userdata('logged');
        $this->session->unset_userdata('uid');
        $this->session->unset_userdata('uemail');
        $this->session->unset_userdata('ufullname');
        $this->session->unset_userdata('uroleid');
        $this->session->unset_userdata('urolename');
        $this->session->unset_userdata('user_image');

        $q = $this->input->get(NULL, TRUE);
        if ($q['location'] != NULL) {
            $location = $q['location'];
        } else {
            $location = NULL;
        }
        header("Location:" . $location);
    }

}
