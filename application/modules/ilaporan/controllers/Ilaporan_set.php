<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ilaporan_set extends CI_Controller {

	public function __construct() {
		parent::__construct(TRUE);
		if ($this->session->userdata('logged') == NULL) {
			header("Location:" . site_url('manage/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
		}
		
		$this->load->model('Ilaporan_model', 'admin');
		$this->load->library('form_validation');
	}


	public function index()
	{
	  $this->form_validation->set_rules('transaksi', 'Transaksi', 'required|in_list[barang_masuk,barang_keluar]');
	  $this->form_validation->set_rules('tanggal', 'Periode Tanggal', 'required');
  
	  if ($this->form_validation->run() == false) {
		$data['title'] = "Transaction Report";
		$data['main'] = 'ilaporan/form';
		$this->load->view('manage/layout', $data);
		//$this->template->load('templates/dashboard', 'laporan/form', $data);
	  
	} else {
		$input = $this->input->post(null, true);
		$table = $input['transaksi'];
		$tanggal = $input['tanggal'];
		$pecah = explode(' - ', $tanggal);
		$mulai = date('Y-m-d', strtotime($pecah[0]));
		$akhir = date('Y-m-d', strtotime(end($pecah)));
  
		$query = '';
		if ($table == 'inventori_masuk') {
		  $query = $this->admin->getBarangMasuk(null, null, ['mulai' => $mulai, 'akhir' => $akhir]);
		} else {
		  $query = $this->admin->getBarangKeluar(null, null, ['mulai' => $mulai, 'akhir' => $akhir]);
		}
  
		$this->_cetak($query, $table, $tanggal);
	  }
	}
  
	private function _cetak($data, $table_, $tanggal)
	{
	  $this->load->library('CustomPDF');
	  $table = $table_ == 'inventori_masuk' ? 'Barang Masuk' : 'Barang Keluar';
  
	  $pdf = new FPDF();
	  $pdf->AddPage('L', 'Letter');
	  $pdf->SetFont('Times', 'B', 16);
	  $pdf->Image('./asset/img/logo1.png', 10, 8, 17, 15);
	  $pdf->Image('./asset/img/2.png', 255, 8, 15, 14);
	  $pdf->Cell(260, 7, 'Laporan ' . $table, 0, 1, 'C');
	  $pdf->SetFont('Times', '', 10);
	  $pdf->Cell(260, 4, 'Tanggal : ' . $tanggal, 0, 1, 'C');
	  $pdf->Line(10, 25, 270, 25);
	  $pdf->Ln(10);
  
	  $pdf->SetFont('Arial', 'B', 10);
  
	  if ($table_ == 'inventori_masuk') :
		$pdf->Cell(10, 7, 'No.', 1, 0, 'C');
		$pdf->Cell(35, 7, 'Tgl Masuk', 1, 0, 'C');
		$pdf->Cell(40, 7, 'ID Barang', 1, 0, 'C');
		$pdf->Cell(55, 7, 'Nama Barang', 1, 0, 'C');
		$pdf->Cell(47, 7, 'Supplier', 1, 0, 'C');
		$pdf->Cell(30, 7, 'Jumlah Masuk', 1, 0, 'C');
		$pdf->Cell(42, 7, 'Penanggung Jawab', 1, 0, 'C');
		$pdf->Ln();
  
		$no = 1;
		foreach ($data as $d) {
		  $pdf->SetFont('Arial', '', 10);
		  $pdf->Cell(10, 7, $no++ . '.', 1, 0, 'C');
		  $pdf->Cell(35, 7, $d['tanggal_masuk'], 1, 0, 'C');
		  $pdf->Cell(40, 7, $d['id_barang'], 1, 0, 'C');
		  $pdf->Cell(55, 7, $d['nama_barang'], 1, 0, 'L');
		  $pdf->Cell(47, 7, $d['nama_supplier'], 1, 0, 'L');
		  $pdf->Cell(30, 7, $d['jumlah_masuk'] . ' ' . $d['nama_satuan'], 1, 0, 'C');
		  $pdf->Cell(42, 7, $d['nama'], 1, 0, 'C');
		  $pdf->Ln();
		}
		$pdf->Ln(60);
		$pdf->Cell(75);
		$pdf->Cell(270, 7, 'Pontianak, ' . date('d-m-y'), 0, 1, 'C');
		$pdf->Cell(75);
		$pdf->Cell(270, 7, 'Admin Gudang,', 0, 1, 'C');
		$pdf->Ln(20);
		$pdf->Cell(75);
		$pdf->SetFont('Times', 'B', 15);
		$pdf->Cell(270, 7, 'Sari Ah, S.Pd', 0, 1, 'C');
		$pdf->SetFont('Times', '', 12);
		$pdf->Cell(75);
		$pdf->Cell(270, 7, '', 0, 1, 'C');
	  else :
		$pdf->Cell(8, 7, 'No.', 1, 0, 'C');
		$pdf->Cell(28, 7, 'Tanggal Keluar', 1, 0, 'C');
		$pdf->Cell(34, 7, 'ID Barang', 1, 0, 'C');
		$pdf->Cell(48, 7, 'Nama Barang', 1, 0, 'C');
		$pdf->Cell(15, 7, 'Rasa', 1, 0, 'C');
		$pdf->Cell(15, 7, 'Merek', 1, 0, 'C');
		$pdf->Cell(28, 7, 'Jumlah Keluar', 1, 0, 'C');
		$pdf->Cell(23, 7, 'Total Harga', 1, 0, 'C');
		$pdf->Cell(26, 7, 'Lokasi', 1, 0, 'C');
		$pdf->Cell(37, 7, 'Penanggung Jawab', 1, 0, 'C');
		$pdf->Ln();
  
		$no = 1;
		foreach ($data as $d) {
		  $total_harga = $d['jumlah_keluar'] * $d['harga_barang'];
		  $pdf->SetFont('Arial', '', 10);
		  $pdf->Cell(8, 7, $no++ . '.', 1, 0, 'C');
		  $pdf->Cell(28, 7, $d['tanggal_keluar'], 1, 0, 'C');
		  $pdf->Cell(34, 7, $d['id_barang'], 1, 0, 'C');
		  $pdf->Cell(48, 7, $d['nama_barang'], 1, 0, 'L');
		  $pdf->Cell(15, 7, $d['nama_rasa'], 1, 0, 'L');
		  $pdf->Cell(15, 7, $d['nama_merek'], 1, 0, 'L');
		  $pdf->Cell(28, 7, $d['jumlah_keluar'] . ' ' . $d['nama_satuan'], 1, 0, 'C');
		  $pdf->Cell(23, 7, $total_harga, 1, 0, 'C');
		  $pdf->Cell(26, 7, $d['lokasi'], 1, 0, 'C');
		  $pdf->Cell(37, 7, $d['nama'], 1, 0, 'C');
		  $pdf->Ln();
		}
		$pdf->Ln(60);
		$pdf->Cell(75);
		$pdf->Cell(270, 7, 'Bandung, ' . date('d-m-y'), 0, 1, 'C');
		$pdf->Cell(75);
		$pdf->Cell(270, 7, 'Admin Gudang,', 0, 1, 'C');
		$pdf->Ln(20);
		$pdf->Cell(75);
		$pdf->SetFont('Times', 'B', 15);
		$pdf->Cell(270, 7, 'Sari Ah, S.Pd', 0, 1, 'C');
		$pdf->SetFont('Times', '', 12);
		$pdf->Cell(75);
		$pdf->Cell(270, 7, 'NIP. 19601113 198603 1 003,', 0, 1, 'C');
  
	  endif;
	  ob_end_clean();
	  $file_name = $table . ' ' . $tanggal;
	  $pdf->Output('I', $file_name);
	}
}