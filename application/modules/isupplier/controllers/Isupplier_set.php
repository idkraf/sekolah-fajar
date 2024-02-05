<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Isupplier_set extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //cek_login();

        $this->load->model('Isupplier_model', 'admin');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Supplier";
        $data['supplier'] = $this->admin->get('isupplier');
        
        $data['main'] = 'isupplier/data';
        $this->load->view('manage/layout', $data);
        //$this->template->load('templates/dashboard', 'supplier/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('supplier', 'Supplier', 'required|trim');
        $this->form_validation->set_rules('nama_supplier', 'Nama Supplier', 'required|trim');
        $this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'required|trim|numeric');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
    }
      private function _config()
    {
        $config['upload_path']      = "./assets/img/avatar";
        $config['allowed_types']    = 'gif|jpg|jpeg|png';
        $config['max_size']         = '2048';
        $config['file_name']         = 'item-'.date('ymd').'-'.substr(md5(rand()),0,10);
        $this->load->library('upload', $config);
    }

    public function add($getId = NULL)
    {
        $this->_validasi();
        $this->_config();
        
    if ($getId == NULL) {
        if ($this->form_validation->run() == false) {
            $data['title'] = "Supplier";
            //$this->template->load('templates/dashboard', 'supplier/add', $data);

            $data['main'] = 'isupplier/add';
            $this->load->view('manage/layout', $data);
        
        
        } else {
            $input = $this->input->post(null, true);
             if (@$_FILES['foto']['name'] != null) {
                if ($this->upload->do_upload('foto')) {
                $input['foto'] = $this->upload->data('file_name');
                $save = $this->admin->insert('isupplier', $input);
                    if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('Succes','Data Berhasil Disimpan');
                } 
                    redirect('manage/isupplier');
                }else{
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    redirect('manage/isupplier/add');
                }

                    
            }else{
                $input['foto'] = is_null;
                $save = $this->admin->insert('isupplier', $input);
                    if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('Succes','Data Berhasil Disimpan');
                    redirect('manage/isupplier');
                }else{
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    redirect('manage/isupplier/add');
                }
            }                
        }
    }else{
        $id = encode_php_tags($getId);
        if ($this->form_validation->run() == false) {
            $data['title'] = "Supplier";
            $data['supplier'] = $this->admin->get('isupplier', ['id_supplier' => $id]);
            //$this->template->load('templates/dashboard', 'supplier/edit', $data);
        
            $data['main'] = 'isupplier/edit';
            $this->load->view('manage/layout', $data);
        } else {
            $input = $this->input->post(null, true);
            if (empty($_FILES['foto']['name'])) {
                $update = $this->admin->update('isupplier', 'id_supplier', $id, $input);
                if ($update) {
                    $this->session->set_flashdata('success','Perubahan berhasil disimpan');
                    redirect('manage/isupplier');
                }else{
                    $this->session->set_flashdata('failed','Perubahan tidak disimpan');
                }
                redirect('manage/isupplier/edit'.$id);
            } else {
                if ($this->upload->do_upload('foto') == false) {
                    echo $this->upload->display_errors();
                    die;
                } else {
                    if ($data['foto'] != null) {
                        $old_image = 'assets/img/avatar/' . $data['foto'];
                        unlink($old_image);
                    }

                    $input['foto'] = $this->upload->data('file_name');
                    $update = $this->admin->update('isupplier', 'id_supplier', $id, $input);
                    if ($update) {
                        $this->session->set_flashdata('success','Perubahan berhasil disimpan');
                        redirect('manage/isupplier');
                    } 
                    else {
                        //set_pesan('gagal menyimpan perubahan');
                    }
                    redirect('manage/isupplier/edit'.$id);
                }
            }
        }
    }
    
    }
    
    public function edit($getId)
    {

        $id = encode_php_tags($getId);
        $this->_validasi();
        $this->_config();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Supplier";
            $data['supplier'] = $this->admin->get('isupplier', ['id_supplier' => $id]);
            //$this->template->load('templates/dashboard', 'supplier/edit', $data);
        
            $data['main'] = 'isupplier/supplier_edit';
            $this->load->view('manage/layout', $data);
        } else {
            $input = $this->input->post(null, true);
            if (empty($_FILES['foto']['name'])) {
                $update = $this->admin->update('isupplier', 'id_supplier', $id, $input);
                if ($update) {
                    $this->session->set_flashdata('success','Perubahan berhasil disimpan');
                    redirect('manage/isupplier');
                }else{
                    $this->session->set_flashdata('failed','Perubahan tidak disimpan');
                }
                redirect('manage/isupplier/edit'.$id);
            } else {
                if ($this->upload->do_upload('foto') == false) {
                    echo $this->upload->display_errors();
                    die;
                } else {
                    if ($data['foto'] != null) {
                        $old_image = 'assets/img/avatar/' . $data['foto'];
                        unlink($old_image);
                    }

                    $input['foto'] = $this->upload->data('file_name');
                    $update = $this->admin->update('isupplier', 'id_supplier', $id, $input);
                    if ($update) {
                        $this->session->set_flashdata('success','Perubahan berhasil disimpan');
                        redirect('manage/isupplier');
                    } 
                    else {
                        //set_pesan('gagal menyimpan perubahan');
                    }
                    redirect('manage/isupplier/edit'.$id);
                }
            }
        }
    }
    
    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('isupplier', 'id_supplier', $id)) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        } else {
            $this->session->set_flashdata('failed', 'Data gagal dihapus');
        }
        redirect('manage/isupplier');
    }
}
