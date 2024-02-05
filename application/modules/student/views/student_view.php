<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo isset($title) ? '' . $title : null; ?>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('manage') ?>"><i class="fa fa-th"></i> Home</a></li>
			<li class="active"><?php echo isset($title) ? '' . $title : null; ?></li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-md-6">
				<div class="box box-success">
					<!-- /.box-header -->
					<div class="box-body">
						<div class="col-md-12 col-sm-12 col-xs-12 pull-left">
							<br>
							<div class="row">
								<div class="col-md-2">
									<?php if (!empty($student['student_img'])) { ?>
									<img src="<?php echo upload_url('student/'.$student['student_img']) ?>" class="img-responsive avatar">
									<?php } else { ?>
									<img src="<?php echo media_url('img/user.png') ?>" class="img-responsive avatar">
									<?php } ?>
								</div>
								<div class="col-md-10">
									<table class="table table-hover">
										<tbody>
											<tr>
												<td>No Siswa</td>
												<td>:</td>
												<td><?php echo $student['student_no'] ?></td>
											</tr>
											<tr>
												<td>Nik</td>
												<td>:</td>
												<td><?php echo $student['student_nik'] ?></td>
											</tr>
											<tr>
												<td>Nama Panggilan</td>
												<td>:</td>
												<td><?php echo $student['student_nama_panggilan'] ?></td>
											</tr>
											<tr>
												<td>Nama lengkap</td>
												<td>:</td>
												<td><?php echo $student['student_full_name'] ?></td>
											</tr>
											<tr>
												<td>Jenis Kelamin</td>
												<td>:</td>
												<td><?php echo ($student['student_gender']=='L')? 'Laki-laki' : 'Perempuan' ?></td>
											</tr>
											<tr>
												<td>Tempat, Tanggal Lahir</td>
												<td>:</td>
												<td><?php echo $student['student_born_place'].', '. pretty_date($student['student_born_date'],'d F Y',false) ?></td>
											</tr>
											<tr>
												<td>Hobi</td>
												<td>:</td>
												<td><?php echo $student['student_hobby'] ?></td>
											</tr>
											<tr>
												<td>No. Handphone</td>
												<td>:</td>
												<td><?php echo $student['student_phone'] ?></td>
											</tr>
											<tr>
												<td>Email</td>
												<td>:</td>
												<td><?php echo $student['student_email'] ?></td>
											</tr>
											<tr>
												<td>Agama</td>
												<td>:</td>
												<td><?php echo $student['student_agama'] ?></td>
											</tr>
											<tr>
												<td>Ajaran Agama</td>
												<td>:</td>
												<td><?php echo $student['student_pelajaran_agama'] ?></td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="col-md-12">
									<a href="<?php echo site_url('manage/student') ?>" class="btn btn-default">
										<i class="fa fa-arrow-circle-o-left"></i> Kembali
									</a>
									<?php if ($this->session->userdata('uroleid') == SUPERUSER) { ?>
									<a href="<?php echo site_url('manage/student/edit/' . $student['student_id']) ?>" class="btn btn-success">
										<i class="fa fa-edit"></i> Edit
									</a>
									<a href="#delModal<?php echo $student['student_id']; ?>" data-toggle="modal" class="btn btn-danger"><i class="fa fa-trash" data-toggle="tooltip" title="Hapus"></i> Hapus</a>
									<?php } ?>
									
									<a href="<?php echo site_url('manage/student/printRiwayat/'. $student['student_id']) ?>" target="_blank" title="Cetak PDF" class="btn btn-default pull-right">
										<i class="fa fa-print"></i> Cetak PDF
									</a>
								</div>
							</div>
							<!-- /.box-body -->
						</div>
					</div>
				</div>
			</div>	
			<div class="col-md-6">				
				<div class="box box-success">	
					<!-- /.box-header -->
					<div class="box-body">							
						<div class="col-md-12 col-sm-12 col-xs-12">
							<h3>Data Sekolah</h3>
									
							<table class="table table-hover">
								<tbody>
									<tr>
										<td>Virtual Bank Siswa </td>
												<td>:</td>
											<td><?php echo $student['student_nomor_virtual_bank'] ?></td>
										</tr>
										<tr>
											<td>NIS </td>
												<td>:</td>
											<td><?php echo $student['student_nis'] ?></td>
										</tr> 

										<tr>
											<td>NISN</td>
												<td>:</td>
											<td><?php echo $student['student_nisn'] ?></td>
										</tr>
										<tr>
											<td>Unit Sekolah </td>
												<td>:</td>
											<td><?php echo $student['majors_name'] ?></td>
										</tr>
										<tr>
											<td>Kelas </td>
												<td>:</td>
											<td><?php echo $student['class_name'] ?></td>
										</tr>
										<tr>
											<td>Tingkatan </td>
												<td>:</td>
											<td><?php echo $student['student_tingkatan'] ?></td>
										</tr>
										<tr>
											<td>Jurusan </td>
												<td>:</td>
											<td><?php echo $student['student_jurusan'] ?></td>
										</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>	
		</div>
		<div class="row">
			<div class="col-md-6">				
				<div class="box box-success">	
					<!-- /.box-header -->
					<div class="box-body">							
						<div class="col-md-12 col-sm-12 col-xs-12">
							<h3>Data Ayah</h3>
							<table class="table table-hover">
								<tbody>
									<tr class="form-group">
										<td>Nama</td>
												<td>:</td>
										<td><?php echo $student['student_name_of_father'] ?></td>
									</tr>
									<tr class="form-group">
										<td>Telp </td>
												<td>:</td>
										<td><?php echo $student['student_telp_ayah'] ?></td>
									</tr>
									<tr class="form-group">
										<td>Email </td>
												<td>:</td>
										<td><?php echo $student['student_email_ayah'] ?></td>
									</tr>
									<tr class="form-group">
										<td>Agama </td>
												<td>:</td>
										<td><?php echo $student['student_agama_ayah'] ?></td>
									</tr>
									<tr class="form-group">
										<td>Kewarganegaraan </td>
												<td>:</td>
										<td><?php echo $student['student_kewarganegaraan_ayah'] ?></td>
									</tr>
									<tr class="form-group">
										<td>Tempat Lahir </td>
												<td>:</td>
										<td><?php echo $student['student_tempat_lahir_ayah'] ?></td>
									</tr>
									<tr class="form-group">
										<td>Tanggal Lahir </td>
												<td>:</td>
										<td><?php echo $student['student_tanggal_lahir_ayah'] ?></td>
									</tr>
									<tr class="form-group">
										<td>Pekerjaan </td>
												<td>:</td>
										<td><?php echo $student['student_pekerjaan_ayah'] ?></td>
									</tr>
									<tr class="form-group">
										<td>Pendidikan Terakhir </td>
												<td>:</td>
										<td><?php echo $student['student_pendidikan_terakhir_ayah'] ?></td>
									</tr>
									<tr class="form-group">
										<td>Alamat</td>
												<td>:</td>
										<td><?php echo $student['student_alamat_ayah'] ?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">				
				<div class="box box-success">	
					<!-- /.box-header -->
					<div class="box-body">							
						<div class="col-md-12 col-sm-12 col-xs-12">
							<h3>Data Ibu</h3>
							<table class="table table-hover">
								<tbody>
									<tr class="form-group">
										<td>Nama</td>
												<td>:</td>
										<td><?php echo $student['student_name_of_mother'] ?></td>
									</tr>
									<tr class="form-group">
										<td>Telp </td>
												<td>:</td>
										<td><?php echo $student['student_telp_ibu'] ?></td>
									</tr>
									<tr class="form-group">
										<td>Email </td>
												<td>:</td>
										<td><?php echo $student['student_email_ibu'] ?></td>
									</tr>
									<tr class="form-group">
										<td>Agama </td>
												<td>:</td>
										<td><?php echo $student['student_agama_ibu'] ?></td>
									</tr>
									<tr class="form-group">
										<td>Kewarganegaraan </td>
												<td>:</td>
										<td><?php echo $student['student_kewarganegaraan_ibu'] ?></td>
									</tr>
									<tr class="form-group">
										<td>Tempat Lahir </td>
												<td>:</td>
										<td><?php echo $student['student_tempat_lahir_ibu'] ?></td>
									</tr>
									<tr class="form-group">
										<td>Tanggal Lahir </td>
												<td>:</td>
										<td><?php echo $student['student_tanggal_lahir_ibu'] ?></td>
									</tr>
									<tr class="form-group">
										<td>Pekerjaan </td>
												<td>:</td>
										<td><?php echo $student['student_pekerjaan_ibu'] ?></td>
									</tr>
									<tr class="form-group">
										<td>Pendidikan Terakhir </td>
												<td>:</td>
										<td><?php echo $student['student_pendidikan_terakhir_ibu'] ?></td>
									</tr>
									<tr class="form-group">
										<td>Alamat</td>
												<td>:</td>
										<td><?php echo $student['student_alamat_ibu'] ?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6">				
				<div class="box box-success">	
					<!-- /.box-header -->
					<div class="box-body">							
						<div class="col-md-12 col-sm-12 col-xs-12">
							<h3>Data Wali</h3>
							<table class="table table-hover">
								<tbody>
									<tr class="form-group">
										<td>Nama Wali</td>
												<td>:</td>
										<td><?php echo $student['student_nama_wali'] ?></td>
									</tr>
									<tr class="form-group">
										<td>No. Handphone Wali</td>
												<td>:</td>
										<td><?php echo $student['student_telp_wali'] ?></td>
									</tr>
									<tr class="form-group">
										<td>Alamat Wali</td>
												<td>:</td>
										<td><?php echo $student['student_alamat_wali'] ?></td>
									</tr>
									<tr class="form-group">
										<td>Email Wali</td>
												<td>:</td>
										<td><?php echo $student['student_email_wali'] ?></td>
									</tr>
									<tr class="form-group">
										<td>Pekerjaan Wali</td>
												<td>:</td>
										<td><?php echo $student['student_pekerjaan_wali'] ?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-md-6">				
				<div class="box box-success">	
					<!-- /.box-header -->
					<div class="box-body">							
						<div class="col-md-12 col-sm-12 col-xs-12">
							<h3>Alamat</h3>	
							<table class="table table-hover">
								<tbody>								
									<tr class="form-group">
										<td>Alamat</td>
												<td>:</td>
										<td><?php echo $student['student_address'] ?></td>
									</tr>
									<tr class="form-group">
										<td>Kewarganegaraan</td>
												<td>:</td>
										<td><?php echo $student['student_kewarganegaraan'] ?></td>
									</tr>
									<tr class="form-group">
										<td>Kelurahan</td>
												<td>:</td>
										<td><?php echo $student['student_kelurahan'] ?></td>
									</tr>
									<tr class="form-group">
										<td>Kecamatan</td>
												<td>:</td>
										<td><?php echo $student['student_kecamatan'] ?></td>
									</tr>
									<tr class="form-group">
										<td>Provinsi</td>
												<td>:</td>
										<td><?php echo $student['student_provinsi'] ?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
			
		<div class="row">
			<div class="col-md-6">				
				<div class="box box-success">	
					<!-- /.box-header -->
					<div class="box-body">							
						<div class="col-md-12 col-sm-12 col-xs-12">
							<h3>Riwayat Kesehatan &amp; Fisik</h3>

							<table class="table table-hover">
								<tbody>
									<dittrrv class="form-group">
										<td>Bahasa Dalam Rumah </td>
												<td>:</td>
										<td><?php echo $student['student_bahasa_rumah'] ?></td>
									</tr>
									<tr class="form-group">
										<td>Anak Ke </td>
												<td>:</td>
										<td><?php echo $student['student_anak_ke'] ?></td>
									</tr>
									<tr class="form-group">
										<td>Jumlah Saudara </td>
												<td>:</td>
										<td><?php echo $student['student_jumlah_saudara'] ?></td>
									</tr>
									<tr class="form-group">
										<td>Status Dalam Keluarga</td>
												<td>:</td>
										<td><?php echo $student['student_status_dalam_keluarga'] ?></td>
									</tr>

									<tr class="form-group">
										<td>Berat </td>
												<td>:</td>
										<td><?php echo $student['student_berat'] ?></td>
									</tr>
									<tr class="form-group">
										<td>Tinggi </td>
												<td>:</td>
										<td><?php echo $student['student_tinggi'] ?></td>
									</tr>
									<tr class="form-group">
										<td>Golongan Darah </td>
												<td>:</td>
										<td><?php echo $student['student_golongan_darah'] ?></td>
									</tr>
									<tr class="form-group">
										<td>Imunisasi </td>
												<td>:</td>
										<td><?php echo $student['student_imunisasi'] ?></td>
									</tr>
									<tr class="form-group">
										<td>Penyakit Yang Pernah diderita </td>
												<td>:</td>
										<td><?php echo $student['student_penyakit_yang_pernah_diderita'] ?></td>
									</tr>
									<tr class="form-group">
										<td>Alergi Makanan </td>
												<td>:</td>
										<td><?php echo $student['student_alergi_makanan'] ?></td>
									</tr>
									
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>	
			<div class="col-md-6">				
				<div class="box box-success">	
					<!-- /.box-header -->
					<div class="box-body">							
						<div class="col-md-12 col-sm-12 col-xs-12">
							<h3>Data Pindah</h3>

							<table class="table table-hover">
								<tbody>		
									<tr class="form-group">
										<td>Sekolah Asal</td>
												<td>:</td>
										<td><?php echo $student['student_sekolah_asal'] ?></td>
									</tr>
									<tr class="form-group">
										<td>Tanggal Masuk</td>
												<td>:</td>
										<td><?php echo $student['student_tanggal_masuk'] ?></td>
									</tr>
									<tr class="form-group">
										<td>Tanggal Keluar </td>
												<td>:</td>
										<td><?php echo $student['student_tanggal_keluar'] ?></td>
									</tr>
									<tr class="form-group">
										<td>Pindah Ke Sekolah</td>
												<td>:</td>
										<td><?php echo $student['student_pindah_ke_sekolah'] ?></td>
									</tr>
									<tr class="form-group">
										<td>Alasan Pindah</td>
												<td>:</td>
										<td><?php echo $student['student_alasan_pindah'] ?></td>
									</tr>
									<tr class="form-group">
										<td>Alumni</td>
												<td>:</td>
										<td><?php echo $student['student_alumni'] ?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
			<!-- /.row -->
			<div class="modal modal-default fade" id="delModal<?php echo $student['student_id']; ?>">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-td="Close">
								<span aria-hidden="true">&times;</span></button>
								<h3 class="modal-title"><span class="fa fa-warning"></span> Konfirmasi penghapusan</h3>
						</div>
						<div class="modal-body">
							<p>Apakah anda yakin akan menghapus data ini?</p>
						</div>
						<div class="modal-footer">
							<?php echo form_open('manage/student/delete/' . $student['student_id']); ?>
							<input type="hidden" name="delName" value="<?php echo $student['student_full_name']; ?>">
							<button type="button" class="btn btn-default pull-left" data-dismiss="modal"><span class="fa fa-close"></span> Batal</button>
							<button type="submit" class="btn btn-danger"><span class="fa fa-check"></span> Hapus</button>
							<?php echo form_close(); ?>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>

	</section>
</div>