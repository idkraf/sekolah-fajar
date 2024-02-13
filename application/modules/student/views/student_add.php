<?php

if (isset($student)) {

	$inputFullnameValue = $student['student_full_name'];
	$inputClassValue = $student['class_class_id'];
	$inputMajorValue = $student['majors_majors_id'];
	$inputNisValue = $student['student_nis'];
	$inputNisNValue = $student['student_nisn'];
	$inputPlaceValue = $student['student_born_place'];
	$inputDateValue = $student['student_born_date'];
	$inputPhoneValue = $student['student_phone'];
	$inputParPhoneValue = $student['student_parent_phone'];
	$inputHobbyValue = $student['student_hobby'];
	$inputAddressValue = $student['student_address'];
	$inputGenderValue = $student['student_gender'];
	$inputMotherValue = $student['student_name_of_mother'];
	$inputFatherValue = $student['student_name_of_father'];
	$inputStatusValue = $student['student_status'];
	
	$inputNoValue = $student['student_no'];
	$inputNikValue = $student['student_nik'];
	$inputNomorVirtualBankValue = $student['student_nomor_virtual_bank'];
	$inputNamaPanggilanValue = $student['student_nama_panggilan'];
	$inputJurusanValue = $student['student_jurusan'];
	$inputTingkatanValue = $student['student_tingkatan'];

	$inputEmailValue = $student['student_email'];
	$inputAgamaValue = $student['student_agama'];
	$inputPelajaranAgamaValue = $student['student_pelajaran_agama'];
	$inputKewarganegaraanValue = $student['student_kewarganegaraan'];
	$inputAnakKeValue = $student['student_anak_ke'];
	$inputJumlahSaudaraValue = $student['student_jumlah_saudara'];
	$inputStatusDalamKeluargaValue = $student['student_status_dalam_keluarga'];
	$inputTinggiValue = $student['student_tinggi'];
	$inputBeratValue = $student['student_berat'];
	$inputImunisasiValue = $student['student_imunisasi'];
	$inputPenyakitYangPernahDideritaValue = $student['student_penyakit_yang_pernah_diderita'];
	$inputGolonganDarahValue = $student['student_golongan_darah'];
	$inputBahasaRumahValue = $student['student_bahasa_rumah'];
	$inputAlergiMakananValue = $student['student_alergi_makanan'];

	$inputKelurahanValue = $student['student_kelurahan'];
	$inputKecamatanValue = $student['student_kecamatan'];
	$inputProvinsiValue = $student['student_provinsi'];
	
	$inputSekolahAsalValue = $student['student_sekolah_asal'];
	$inputAlumniValue = $student['student_alumni'];
	$inputTanggalMasukValue = $student['student_tanggal_masuk'];
	$inputTanggalKeluarValue = $student['student_tanggal_keluar'];
	$inputPindahKeSekolahValue = $student['student_pindah_ke_sekolah'];
	$inputAlasanPindahValue = $student['student_alasan_pindah'];
	//$inputValue = $student['student_'];
	

	$inputTelpAyahValue = $student['student_telp_ayah'];
	$inputPekerjaanAyahValue = $student['student_pekerjaan_ayah'];
	$inputAlamatAyahValue = $student['student_alamat_ayah'];
	$inputEmailAyahValue = $student['student_email_ayah'];
	$inputAgamaAyahValue = $student['student_agama_ayah'];
	$inputTempatLahirAyahValue = $student['student_tempat_lahir_ayah'];
	$inputTanggalLahirAyahValue = $student['student_tanggal_lahir_ayah'];
	$inputKewarganegaraanAyahValue = $student['student_kewarganegaraan_ayah'];
	$inputPendidikanTerakhirAyahValue = $student['student_pendidikan_terakhir_ayah'];
	
	$inputTelpIbuValue = $student['student_telp_ibu'];
	$inputPekerjaanIbuValue = $student['student_pekerjaan_ibu'];
	$inputAlamatIbuValue = $student['student_alamat_ibu'];
	$inputEmailIbuValue = $student['student_email_ibu'];
	$inputAgamaIbuValue = $student['student_agama_ibu'];
	$inputTempatLahirIbuValue = $student['student_tempat_lahir_ibu'];
	$inputTanggalLahirIbuValue = $student['student_tanggal_lahir_ibu'];
	$inputKewarganegaraanIbuValue = $student['student_kewarganegaraan_ibu'];
	$inputPendidikanTerakhirIbuValue = $student['student_pendidikan_terakhir_ibu'];

	$inputNamaWaliValue = $student['student_nama_wali'];
	$inputTelpWaliValue = $student['student_telp_wali'];
	$inputPekerjaanWaliValue = $student['student_pekerjaan_wali'];
	$inputAlamatWaliValue = $student['student_alamat_wali'];
	$inputEmailWaliValue = $student['student_email_wali'];

} else {

	$inputFullnameValue = set_value('student_full_name');
	$inputClassValue = set_value('class_class_id');
	$inputMajorValue = set_value('majors_majors_id');
	$inputNisValue = set_value('student_nis');
	$inputNisNValue = set_value('student_nisn');
	$inputPlaceValue = set_value('student_born_place');
	$inputDateValue = set_value('student_born_date');
	$inputPhoneValue = set_value('student_phone');
	$inputParPhoneValue = set_value('student_parent_phone');
	$inputHobbyValue = set_value('student_hobby');
	$inputAddressValue = set_value('student_address');
	$inputGenderValue = set_value('student_gender');
	$inputMotherValue = set_value('student_name_of_mother');
	$inputFatherValue = set_value('student_name_of_father');
	$inputStatusValue = set_value('student_status');	
	
	$inputNoValue = set_value('student_no');
	$inputNikValue = set_value('student_nik');
	$inputNomorVirtualBankValue = set_value('student_nomor_virtual_bank');
	$inputNamaPanggilanValue = set_value('student_nama_panggilan');
	$inputJurusanValue = set_value('student_jurusan');
	$inputTingkatanValue = set_value('student_tingkatan');

	$inputEmailValue = set_value('student_email');
	$inputAgamaValue = set_value('student_agama');
	$inputPelajaranAgamaValue = set_value('student_pelajaran_agama');
	$inputKewarganegaraanValue = set_value('student_kewarganegaraan');

	$inputAnakKeValue = set_value('student_anak_ke');
	$inputJumlahSaudaraValue = set_value('student_jumlah_saudara');
	$inputStatusDalamKeluargaValue = set_value('student_status_dalam_keluarga');
	$inputTinggiValue = set_value('student_tinggi');
	$inputBeratValue = set_value('student_berat');
	$inputImunisasiValue = set_value('student_imunisasi');
	$inputPenyakitYangPernahDideritaValue = set_value('student_penyakit_yang_pernah_diderita');
	$inputGolonganDarahValue = set_value('student_golongan_darah');
	$inputBahasaRumahValue = set_value('student_bahasa_rumah');
	$inputAlergiMakananValue = set_value('student_alergi_makanan');

	$inputKelurahanValue = set_value('student_kelurahan');
	$inputKecamatanValue = set_value('student_kecamatan');
	$inputProvinsiValue = set_value('student_provinsi');

	$inputSekolahAsalValue =  set_value('student_sekolah_asal');
	$inputAlumniValue = set_value('student_alumni');
	$inputTanggalMasukValue = set_value('student_tanggal_masuk');
	$inputTanggalKeluarValue = set_value('student_tanggal_keluar');
	$inputPindahKeSekolahValue = set_value('student_pindah_ke_sekolah');
	$inputAlasanPindahValue = set_value('student_alasan_pindah');

	$inputTelpAyahValue = set_value('student_telp_ayah');
	$inputPekerjaanAyahValue = set_value('student_pekerjaan_ayah');
	$inputAlamatAyahValue = set_value('student_alamat_ayah');
	$inputEmailAyahValue = set_value('student_email_ayah');
	$inputAgamaAyahValue = set_value('student_agama_ayah');
	$inputTempatLahirAyahValue = set_value('student_tempat_lahir_ayah');
	$inputTanggalLahirAyahValue = set_value('student_tanggal_lahir_ayah');
	$inputKewarganegaraanAyahValue = set_value('student_kewarganegaraan_ayah');
	$inputPendidikanTerakhirAyahValue = set_value('student_pendidikan_terakhir_ayah');

	$inputTelpIbuValue = set_value('student_telp_ibu');
	$inputPekerjaanIbuValue = set_value('student_pekerjaan_ibu');
	$inputAlamatIbuValue = set_value('student_alamat_ibu');
	$inputEmailIbuValue = set_value('student_email_ibu');
	$inputAgamaIbuValue = set_value('student_agama_ibu');
	$inputTempatLahirIbuValue = set_value('student_tempat_lahir_ibu');
	$inputTanggalLahirIbuValue = set_value('student_tanggal_lahir_ibu');
	$inputKewarganegaraanIbuValue = set_value('student_kewarganegaraan_ibu');
	$inputPendidikanTerakhirIbuValue = set_value('student_pendidikan_terakhir_ibu');

	$inputNamaWaliValue = set_value('student_nama_wali');
	$inputTelpWaliValue = set_value('student_telp_wali');
	$inputPekerjaanWaliValue = set_value('student_pekerjaan_wali');
	$inputAlamatWaliValue = set_value('student_alamat_wali');
	$inputEmailWaliValue = set_value('student_email_wali');
}
?>

<div class="content-wrapper"> 
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo isset($title) ? '' . $title : null; ?>
		</h1>
		<ol class="breadcrumb">
			<li  class="breadcrumb-item"><a href="<?php echo site_url('manage') ?>"><i class="fa fa-th"></i> Home</a></li>
			<li><a href="<?php echo site_url('manage/student') ?>">Kelola Siswa</a></li>
			<li class="active breadcrumb-item"><?php echo isset($title) ? '' . $title : null; ?></li>
		</ol>
	</section>

	<!-- Main content -->
	<!-- Main content -->
	<section class="content">
		<?php echo form_open_multipart(current_url()); ?>
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-md-9">
				<div class="card">
					<!-- /.box-header -->
					<div class="card-body">
						<div class="nav-tabs-custom">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#tab_1" data-toggle="tab">Data Pribadi</a></li>
								<li><a href="#tab_2" data-toggle="tab">Data Sekolah</a></li>
								<li><a href="#tab_3" data-toggle="tab">Data Ayah</a></li>
								<li><a href="#tab_4" data-toggle="tab">Data Ibu</a></li>
								<li><a href="#tab_5" data-toggle="tab">Data Wali</a></li>
								<li><a href="#tab_6" data-toggle="tab">Data Alamat</a></li>
								<li><a href="#tab_7" data-toggle="tab">Data Lainnya</a></li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane active" id="tab_1">
									<?php echo validation_errors(); ?>
									<?php if (isset($student)) { ?>
										<input type="hidden" name="student_id" value="<?php echo $student['student_id']; ?>">
									<?php } ?>
									
									<div class="form-group">
										<label>Nomor </label>
										<input name="student_no" type="text" class="form-control" value="<?php echo $inputNoValue ?>">
									</div>
									<div class="form-group">
										<label>Nama lengkap <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
										<input name="student_full_name" type="text" class="form-control" value="<?php echo $inputFullnameValue ?>" placeholder="Nama lengkap">
									</div>
									<div class="form-group">
										<label>Nama Panggilan <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
										<input name="student_nama_panggilan" type="text" class="form-control" value="<?php echo $inputNamaPanggilanValue ?>" placeholder="Nama Panggilan">
									</div>
									<div class="form-group">
										<label>Jenis Kelamin</label>
										<div class="radio">
											<label>
												<input type="radio" name="student_gender" value="L" <?php echo ($inputGenderValue == 'L') ? 'checked' : ''; ?>> Laki-laki
											</label>&nbsp;&nbsp;
											<label>
												<input type="radio" name="student_gender" value="P" <?php echo ($inputGenderValue == 'P') ? 'checked' : ''; ?>> Perempuan
											</label>
										</div>
									</div>

									<div class="form-group">
										<label>Tempat Lahir</label>
										<input name="student_born_place" type="text" class="form-control" value="<?php echo $inputPlaceValue ?>" placeholder="Tempat Lahir">
									</div>

									<div class="form-group">
										<label>Tanggal Lahir </label>
										<div class="input-group">
											<!--span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span-->
											<input class="form-control" type="date" name="student_born_date" placeholder="Tanggal" value="<?php echo $inputDateValue; ?>">
										</div>
									</div>

									<div class="form-group">
										<label>Email</label>
										<input name="student_email" type="text" class="form-control" value="<?php echo $inputEmailValue ?>" placeholder="Email">
									</div>
									<div class="form-group" hidden>
										<label>Hobi</label>
										<input name="student_hobby" type="text" class="form-control" value="<?php echo $inputHobbyValue ?>" placeholder="Hobi">
									</div>
									<div class="form-group">
										<label>Agama</label>
										<input name="student_agama" type="text" class="form-control" value="<?php echo $inputAgamaValue ?>">
									</div>
									<div class="form-group">
										<label>Ajaran Agama</label>
										<input name="student_pelajaran_agama" type="text" class="form-control" value="<?php echo $inputPelajaranAgamaValue ?>">
									</div>

									<div class="form-group">
										<label>No. Handphone <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
										<input name="student_phone" type="text" class="form-control" value="<?php echo $inputPhoneValue ?>" placeholder="No Handphone">
									</div>
								</div>

								<div class="tab-pane" id="tab_2">
								
									<div class="form-group">
										<label>Virtual Bank Siswa </label>
										<input name="student_nomor_virtual_bank" type="text" class="form-control" value="<?php echo $inputNomorVirtualBankValue ?>">
									</div>
									<div class="form-group">
										<label>Nik </label>
										<input name="student_nik" type="text" class="form-control" value="<?php echo $inputNikValue ?>">
									</div>
									<div class="form-group">
										<label>NIS <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
										<input name="student_nis" type="text" class="form-control" value="<?php echo $inputNisValue ?>" placeholder="NIS Siswa">
									</div> 

									<?php if (!isset($student)) { ?>
										<div class="form-group">
											<label>Password <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
											<input name="student_password" type="password" class="form-control" placeholder="Password">
										</div>            

										<div class="form-group">
											<label>Konfirmasi Password <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
											<input name="passconf" type="password" class="form-control" placeholder="Konfirmasi Password">
										</div>       
									<?php } ?>

									<div class="form-group">
										<label>NISN <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
										<input name="student_nisn" type="text" class="form-control" value="<?php echo $inputNisNValue ?>" placeholder="NISN Siswa">
									</div>
									<!--?php if ($setting_level['setting_value']=='senior') { ?-->
										<div class="form-group">
											<label>Unit Sekolah <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
											<select name="majors_majors_id" class="form-control">
												<option value="">---Pilih Unit Sekolah---</option>
												<?php foreach ($majors as $row): ?>
													<option value="<?php echo $row['majors_id'] ?>" <?php echo ($inputMajorValue == $row['majors_id']) ? 'selected' : '' ?> ><?php echo $row['majors_name'] ?></option>
												<?php endforeach ?>
											</select>
										</div> 
									<!--?php } ?-->
									<div ng-controller="classCtrl">
										<div class="form-group"> 
											<label >Kelas *</label>
											<select name="class_class_id" class="form-control autocomplete">
												<option value="">-- Pilih Kelas --</option>
												<option ng-repeat="class in classs" ng-selected="class_data.index == class.class_id" value="{{class.class_id}}">{{class.class_name}}</option>
											</select>
											<a data-toggle="modal" href="#myModal"><span class="fa fa-plus"></span> Tambah Kelas</a><br><br>
											<div class="modal fade bs-example-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
												<div class="modal-dialog" role="document">
													<div class="modal-dialog modal-sm"> 
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<h4 class="modal-title" id="myModalLabel">Tambah Kelas</h4>
															</div>
															<div class="modal-body">
																<label >Nama Kelas *</label>
																<input type="text" name="class_name" ng-model="classForm.class_name" placeholder="Kelas" class="form-control"><br>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
																<button type="button" class="btn btn-primary" ng-disabled="!(!!classForm.class_name)" ng-click="submit(classForm)" type="button" data-dismiss="modal">Simpan</button>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<label>Tingkatan </label>
										<input name="student_tingkatan" type="text" class="form-control" value="<?php echo $inputTingkatanValue ?>">
									</div>
									<div class="form-group">
										<label>Jurusan </label>
										<input name="student_jurusan" type="text" class="form-control" value="<?php echo $inputJurusanValue ?>">
									</div>
									<div class="form-group">
										<label>Sekolah Asal</label>
										<input name="student_sekolah_asal" type="text" class="form-control" value="<?php echo $inputSekolahAsalValue ?>" placeholder="Nama Sekolah">
									</div>
									<div class="form-group">
										<label>Tanggal Masuk</label>
										<div class="input-group">
											<!--span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span-->
											<input class="form-control" type="date" name="student_tanggal_masuk" placeholder="Tanggal Masuk" value="<?php echo $inputTanggalMasukValue; ?>">
										</div>
									</div>
									<div class="form-group">
										<label>Tanggal Keluar </label>
										<div class="input-group">
											<!--span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span-->
											<input class="form-control" type="date" name="student_tanggal_keluar" placeholder="Tanggal Keluar" value="<?php echo $inputTanggalKeluarValue; ?>">
										</div>
									</div>
									<div class="form-group">
										<label>Pindah Ke Sekolah</label>
										<input name="student_pindah_ke_sekolah" type="text" class="form-control" value="<?php echo $inputPindahKeSekolahValue ?>" placeholder="Nama Sekolah">
									</div>
									<div class="form-group">
										<label>Alasan Pindah</label>
										<input name="student_alasan_pindah" type="text" class="form-control" value="<?php echo $inputAlasanPindahValue ?>" placeholder="Alasan Pindah">
									</div>
									<div class="form-group">
										<label>Alumni</label>
										<input name="student_alumni" type="text" class="form-control" value="<?php echo $inputAlumniValue ?>">
									</div>
								</div>

								<div class="tab-pane" id="tab_7">
									<div class="form-group">
										<label>Bahasa Dalam Rumah </label>
										<input name="student_bahasa_rumah" type="text" class="form-control" value="<?php echo $inputBahasaRumahValue ?>">
									</div>
									<div class="form-group">
										<label>Anak Ke </label>
										<input name="student_anak_ke" type="text" class="form-control" value="<?php echo $inputAnakKeValue ?>">
									</div>
									<div class="form-group">
										<label>Jumlah Saudara </label>
										<input name="student_jumlah_saudara" type="text" class="form-control" value="<?php echo $inputJumlahSaudaraValue ?>">
									</div>
									<div class="form-group">
										<label>Status Dalam Keluarga</label>
										<input name="student_status_dalam_keluarga" type="text" class="form-control" value="<?php echo $inputStatusDalamKeluargaValue ?>">
									</div>

									<div class="form-group">
										<label>Berat </label>
										<input name="student_berat" type="text" class="form-control" value="<?php echo $inputBeratValue ?>">
									</div>
									<div class="form-group">
										<label>Tinggi </label>
										<input name="student_tinggi" type="text" class="form-control" value="<?php echo $inputTinggiValue ?>">
									</div>
									<div class="form-group">
										<label>Golongan Darah </label>
										<input name="student_golongan_darah" type="text" class="form-control" value="<?php echo $inputGolonganDarahValue ?>">
									</div>
									<div class="form-group">
										<label>Imunisasi </label>
										<input name="student_imunisasi" type="text" class="form-control" value="<?php echo $inputImunisasiValue ?>">
									</div>
									<div class="form-group">
										<label>Penyakit Yang Pernah diderita </label>
										<input name="student_penyakit_yang_pernah_diderita" type="text" class="form-control" value="<?php echo $inputPenyakitYangPernahDideritaValue ?>">
									</div>
									<div class="form-group">
										<label>Alergi Makanan </label>
										<input name="student_alergi_makanan" type="text" class="form-control" value="<?php echo $inputAlergiMakananValue ?>">
									</div>
									

								</div>
								<div class="tab-pane" id="tab_6">									
									<div class="form-group">
										<label>Alamat</label>
										<textarea class="form-control" name="student_address" placeholder="Alamat Tempat Tinggal"><?php echo $inputAddressValue ?></textarea>
									</div>
									<div class="form-group">
										<label>Kewarganegaraan</label>
										<input name="student_kewarganegaraan" type="text" class="form-control" value="<?php echo $inputKewarganegaraanValue ?>">
									</div>
									<div class="form-group">
										<label>Kelurahan</label>
										<input name="student_kelurahan" type="text" class="form-control" value="<?php echo $inputKelurahanValue ?>">
									</div>
									<div class="form-group">
										<label>Kecamatan</label>
										<input name="student_kecamatan" type="text" class="form-control" value="<?php echo $inputKecamatanValue ?>">
									</div>
									<div class="form-group">
										<label>Provinsi</label>
										<input name="student_provinsi" type="text" class="form-control" value="<?php echo $inputProvinsiValue ?>">
									</div>
								</div>
								<div class="tab-pane" id="tab_3">
									<div class="form-group">
										<label>Nama Ayah Kandung</label>
										<input name="student_name_of_father" type="text" class="form-control" value="<?php echo $inputFatherValue ?>" placeholder="Nama Ayah">
									</div>
									<div class="form-group">
										<label>No. Handphone Ayah</label>
										<input name="student_telp_ayah" type="text" class="form-control" value="<?php echo $inputTelpAyahValue ?>" placeholder="No Handphone Orang Tua">
									</div>
									<input name="student_parent_phone" type="hidden" class="form-control" value="<?php echo $inputParPhoneValue ?>" placeholder="No Handphone Orang Tua">
									
									<div class="form-group">
										<label>Alamat Ayah</label>
										<input name="student_alamat_ayah" type="text" class="form-control" value="<?php echo $inputAlamatAyahValue ?>">
									</div>
									<div class="form-group">
										<label>Email Ayah</label>
										<input name="student_email_ayah" type="text" class="form-control" value="<?php echo $inputEmailAyahValue ?>">
									</div>
									<div class="form-group">
										<label>Pekerjaan Ayah</label>
										<input name="student_pekerjaan_ayah" type="text" class="form-control" value="<?php echo $inputPekerjaanAyahValue ?>">
									</div>
									
									<div class="form-group">
										<label>Pendidikan Terakhir Ayah</label>
										<input name="student_pendidikan_terakhir_ayah" type="text" class="form-control" value="<?php echo $inputPendidikanTerakhirAyahValue ?>" placeholder="Tempat Lahir">
									</div>
									<div class="form-group">
										<label>Tempat Lahir Ayah</label>
										<input name="student_tempat_lahir_ayah" type="text" class="form-control" value="<?php echo $inputTempatLahirAyahValue ?>" placeholder="Tempat Lahir">
									</div>

									<div class="form-group">
										<label>Tanggal Lahir Ayah</label>
										<div class="input-group">
											<!--span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span-->
											<input class="form-control" type="date" name="student_tanggal_lahir_ayah" placeholder="Tanggal" value="<?php echo $inputTanggalLahirAyahValue; ?>">
										</div>
									</div>

									<div class="form-group">
										<label>Kewarganegaraan Ayah</label>
										<input name="student_kewarganegaraan_ayah" type="text" class="form-control" value="<?php echo $inputKewarganegaraanAyahValue ?>">
									</div>
									<div class="form-group">
										<label>Agama Ayah</label>
										<input name="student_agama_ayah" type="text" class="form-control" value="<?php echo $inputAgamaAyahValue ?>">
									</div>
									
								</div>

								<div class="tab-pane" id="tab_4">
									<div class="form-group">
										<label>Nama Ibu Kandung</label>
										<input name="student_name_of_mother" type="text" class="form-control" value="<?php echo $inputMotherValue ?>" placeholder="Nama Ibu">
									</div>
									<div class="form-group">
										<label>No. Handphone Ibu</label>
										<input name="student_telp_ibu" type="text" class="form-control" value="<?php echo $inputTelpIbuValue ?>" placeholder="No Handphone Orang Tua">
									</div>
									<div class="form-group">
										<label>Alamat Ibu</label>
										<input name="student_alamat_ibu" type="text" class="form-control" value="<?php echo $inputAlamatIbuValue ?>">
									</div>
									<div class="form-group">
										<label>Email Ibu</label>
										<input name="student_email_ibu" type="text" class="form-control" value="<?php echo $inputEmailIbuValue ?>">
									</div>
									<div class="form-group">
										<label>Pekerjaan Ibu</label>
										<input name="student_pekerjaan_ibu" type="text" class="form-control" value="<?php echo $inputPekerjaanIbuValue ?>">
									</div>
									
									<div class="form-group">
										<label>Pendidikan Terakhir Ibu</label>
										<input name="student_pendidikan_terakhir_ibu" type="text" class="form-control" value="<?php echo $inputPendidikanTerakhirIbuValue ?>" placeholder="Tempat Lahir">
									</div>
									<div class="form-group">
										<label>Tempat Lahir Ibu</label>
										<input name="student_tempat_lahir_ibu" type="text" class="form-control" value="<?php echo $inputTempatLahirIbuValue ?>" placeholder="Tempat Lahir">
									</div>

									<div class="form-group">
										<label>Tanggal Lahir Ibu</label>
										<div class="input-group">
											<!--span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span-->
											<input class="form-control" type="date" name="student_tanggal_lahir_ibu" placeholder="Tanggal" value="<?php echo $inputTanggalLahirIbuValue; ?>">
										</div>
									</div>

									<div class="form-group">
										<label>Kewarganegaraan Ibu</label>
										<input name="student_kewarganegaraan_ibu" type="text" class="form-control" value="<?php echo $inputKewarganegaraanIbuValue ?>">
									</div>
									<div class="form-group">
										<label>Agama Ibu</label>
										<input name="student_agama_ibu" type="text" class="form-control" value="<?php echo $inputAgamaIbuValue ?>">
									</div>
								</div>

								<div class="tab-pane" id="tab_5">
									<div class="form-group">
										<label>Nama Wali</label>
										<input name="student_nama_wali" type="text" class="form-control" value="<?php echo $inputNamaWaliValue ?>" placeholder="Nama Wali">
									</div>
									<div class="form-group">
										<label>No. Handphone Wali</label>
										<input name="student_telp_wali" type="text" class="form-control" value="<?php echo $inputTelpWaliValue ?>" placeholder="No Handphone Wali">
									</div>
									<div class="form-group">
										<label>Alamat Wali</label>
										<input name="student_alamat_wali" type="text" class="form-control" value="<?php echo $inputAlamatWaliValue ?>" placeholder="No Handphone Wali">
									</div>
									<div class="form-group">
										<label>Email Wali</label>
										<input name="student_email_wali" type="text" class="form-control" value="<?php echo $inputEmailWaliValue ?>" placeholder="No Handphone Wali">
									</div>
									<div class="form-group">
										<label>Pekerjaan Wali</label>
										<input name="student_pekerjaan_wali" type="text" class="form-control" value="<?php echo $inputPekerjaanWaliValue ?>" placeholder="No Handphone Wali">
									</div>
									
								</div>
								
							</div>
						</div>

						
						<p class="text-muted">*) Kolom wajib diisi.</p>
					</div>
					<!-- /.box-body -->
				</div>
			</div>
			<div class="col-md-3">
				<div class="box box-primary">
					<!-- /.box-header -->
					<div class="card-body">
						<div class="form-group">
							<label>Status</label>
							<div class="radio">
								<label>
									<input type="radio" name="student_status" value="1" <?php echo ($inputStatusValue == 1) ? 'checked' : ''; ?>> Aktif
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="student_status" value="0" <?php echo ($inputStatusValue == 0) ? 'checked' : ''; ?>> Tidak Aktif
								</label>
							</div>
						</div>
						<label >Foto</label>
						<a href="#" class="thumbnail">
							<?php if (isset($student['student_img']) != NULL) { ?>
								<img src="<?php echo upload_url('student/' . $student['student_img']) ?>" class="img-responsive avatar">
							<?php } else { ?>
								<img src="<?php echo media_url('img/missing.png') ?>" id="target" alt="Choose image to upload">
							<?php } ?>
						</a>
						<input type='file' id="student_img" name="student_img">
						<br>
						<button type="submit" class="btn btn-block btn-success">Simpan</button>
						<a href="<?php echo site_url('manage/student'); ?>" class="btn btn-block btn-info">Batal</a>
						<?php if (isset($student)) { ?>
							<button type="button" onclick="getId(<?php echo $student['student_id'] ?>)" class="btn btn-danger btn-block" data-toggle="modal" data-target="#deleteStudent">Hapus
							</button>
						<?php } ?>
					</div>
					<!-- /.box-body -->
				</div>
			</div>
		</div>
		<?php echo form_close(); ?>
		<!-- /.row -->
	</section>
</div>
<?php if (isset($student)) { ?>
	<div class="modal fade" id="deleteStudent">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title">Konfirmasi Hapus</h4>
				</div>
				<form action="<?php echo site_url('manage/student/delete') ?>" method="POST">
					<div class="modal-body">
						<p>Apakah anda akan menghapus data ini?</p>
						<input type="hidden" name="student_id" id="studentId">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
						<button type="submit" class="btn btn-danger">Hapus</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php } ?>

<script>

	function getId(id) {
		$('#studentId').val(id)
	}
</script>

<script>
	var classApp = angular.module("classApp", []);
	var SITEURL = "<?php echo site_url() ?>";

	classApp.controller('classCtrl', function($scope, $http) {
		$scope.classs = [];
		<?php if (isset($student)): ?>
			$scope.class_data = {index: <?php echo $student['class_class_id']; ?>};
		<?php endif; ?>

		$scope.getClass = function() {

			var url = SITEURL + 'api/get_class/';
			$http.get(url).then(function(response) {
				$scope.classs = response.data;
			});

		};

		$scope.submit = function(student) {
			var postData = $.param(student);
			$.ajax({
				method: "POST",
				url: SITEURL + "manage/student/add_class",
				data: postData,
				success: function(data) {
					$scope.getClass();
					$scope.classForm.class_name = '';
				}
			});
		};

		angular.element(document).ready(function() {
			$scope.getClass();
		});

	});

	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#target').attr('src', e.target.result);
			};

			reader.readAsDataURL(input.files[0]);
		}
	}

	$("#student_img").change(function() {
		readURL(this);
	});


</script>