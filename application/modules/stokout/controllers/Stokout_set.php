<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Stokout_set extends CI_Controller {

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

        $this->load->model('Stokout_model', 'admin');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Exit Item";
        //$data['barangkeluar'] = $this->admin->getBarangkeluar();    
        //$data['main'] = 'stokout/data';  
        $data['main'] = 'stokout/list';
        $this->load->view('manage/layout', $data);
        //$this->template->load('templates/dashboard', 'barang_keluar/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('tanggal_keluar', 'Tanggal Keluar', 'required|trim');
        $this->form_validation->set_rules('barang_id', 'Barang', 'required');

        $input = $this->input->post('barang_id', true);

        //$db = $this->admin->get('user', ['id_user' => $this->input->post('id_user', true)]);
        //$uniq_username = $db['username'] == $username ? '' : '|is_unique[user.username]';
        //$uniq_email = $db['email'] == $email ? '' : '|is_unique[user.email]';


        //$stok = $this->admin->get('barang', ['id_barang' => $input])['stok'];
        $stok = $this->admin->get('barang', ['id_barang' => $input]);

        $stok_valid = $stok + 1;

        $this->form_validation->set_rules(
            'jumlah_keluar',
            'Jumlah Keluar',
            "required|trim|numeric|greater_than[0]|less_than[{$stok_valid}]",
            [
                'less_than' => "Jumlah Keluar tidak boleh lebih dari {$stok}"
            ]
        );
    }

    public function add()
    {
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Exit Item";
            $data['barang'] = $this->admin->get('barang', null, ['stok >' => 0]);

            // Mendapatkan dan men-generate kode transaksi barang keluar
            $kode = 'T-BK-' . date('ymd');
            $kode_terakhir = $this->admin->getMax('barang_keluar', 'id_barang_keluar', $kode);
            $kode_tambah = substr($kode_terakhir, -5, 5);
            $kode_tambah++;
            $number = str_pad($kode_tambah, 5, '0', STR_PAD_LEFT);
            $data['id_barang_keluar'] = $kode . $number;
            $data['lokasi'] = "lokasi";   
            $data['main'] = 'stokout/add';
            $this->load->view('manage/layout', $data);
            //$this->template->load('templates/dashboard', 'barang_keluar/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('barang_keluar', $input);

            if ($insert) {
                //set_pesan('data berhasil disimpan.');
                redirect('manage/stokout');
            } else {
                //set_pesan('Opps ada kesalahan!');
                redirect('manage/stokout/add');
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('barang_keluar', 'id_barang_keluar', $id)) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        } else {
            $this->session->set_flashdata('failed', 'Data gagal dihapus');
        }
        redirect('manage/stokout');
    }
    
    
    public function ajax_list() {
        $list = $this->admin->get_datatables();
        $data = array();
        $no = 0;
        foreach ($list as $prd) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $prd->id_barang;
            $row[] = $prd->tanggal_keluar;
            $row[] = $prd->nama_barang;
            $row[] = $prd->nama_rasa;
            $row[] = $prd->nama_merek;
            $row[] = $prd->jumlah_keluar . '' . $prd->nama_satuan;
            $row[] = $prd->lokasi;
            $row[] = $prd->user_full_name;
            $row[] = '<a onclick="return confirm("Yakin ingin hapus?")" href="'. base_url('manage/stokout/delete') . '/' . $prd->id_barang_keluar .'" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a>';
            $data[] = $row;
        }
        $output = array(
            "recordsTotal" => $this->admin->count_all(),
            "recordsFiltered" => $this->admin->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
}
