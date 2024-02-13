<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo isset($title) ? '' . $title : null; ?>
			<small>List</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('manage') ?>"><i class="fa fa-th"></i> Home</a></li>
			<li class="active"><?php echo isset($title) ? '' . $title : null; ?></li>
		</ol>
	</section>
	<section class="content">
		
				<div class="box box-success">
					<div class="card-header">
						<?php echo form_open(current_url(), array('method' => 'get')) ?>
							<div class="row">
								<div class="col-md-3">  
									<div class="form-group">
										<label>Tahun Ajaran</label>
										<select class="form-control" name="p" id="th_ajar">
											<!-- <option value="">-- Tahun Ajaran --</option> -->
											<?php foreach ($period as $row): ?>
												<option <?php echo (isset($f['p']) AND $f['p'] == $row['period_id']) ? 'selected' : '' ?> value="<?php echo $row['period_id'] ?>"><?php echo $row['period_start'].'/'.$row['period_end'] ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								<div class="col-md-3">  
									<div class="form-group">
										<label>Bulan</label>
										<select class="form-control" name="c"  id="bln_ajar">
											<!-- <option value="">-- Tahun Ajaran --</option> -->
											<?php foreach ($bulan as $row): ?>
												<option <?php echo (isset($f['c']) AND $f['c'] == $row['month_id']) ? 'selected' : '' ?> value="<?php echo $row['month_id'] ?>"><?php echo $row['month_name'] ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								<div class="col-md-5">
									<div class="form-group">
										<label>NIP</label>
										<div class="row input-group">
											<input type="text" class="form-control" autofocus name="" <?php echo (isset($f['n'])) ? 'placeholder="'.$f['n'].'"' : 'placeholder="Masukan NIP Pegawai"' ?>>
											<span class="input-group-btn">
												<button class="btn btn-success" type="submit">Cari</button>
											</span>
											<span class="input-group-btn">
											</span>
											<span class="input-group-btn">
											</span>
											<span class="input-group-btn">
											</span>
											<span class="input-group-btn">
												<button type="button" class="btn btn-default" data-toggle="modal" data-target="#dataPegawai"><b>Data Pegawai</b></button>
											</span>
										</div>
									</div>
								</div>
							</div>
						<?php echo form_close(); ?>						
					</div>
				</div>
				<?php if ($f) { ?>
					<?php
						if (isset($gajipokok)) {

							$inputGajiPokokValue = $gajipokok['gaji_pokok'];
							$inputTFValue = $gajipokok['tunjangan_fungsional'];
							$inputTSValue = $gajipokok['tunjangan_struktural'];
							$inputTKEValue = $gajipokok['tunjangan_kesra'];
							$inputTKHValue = $gajipokok['tunjangan_khusus'];
							$inputTPValue = $gajipokok['tunjangan_prestasi'];
							$inputPoinValue = $gajipokok['poin'];
							$inputTJValue = $gajipokok['tunjangan_jabatan'];
							$inputTPRValue = $gajipokok['tunjangan_profesi'];
							$inputTTValue = $gajipokok['tunjangan_transport'];
							$inputUAValue = $gajipokok['uang_makan'];
							$inputTUValue = $gajipokok['tunjangan_umum'];
							$inputTGTValue = $gajipokok['tunjangan_guru_tetap'];
							$totalGaji=
							$inputGajiPokokValue
							+$inputTFValue
							+$inputTSValue
							+$inputTKEValue
							+$inputTKHValue
							+$inputTPValue
							+$inputPoinValue
							+$inputTJValue;
							+$inputTPRValue;
							+$inputTTValue;
							+$inputUAValue;
							+$inputTUValue;
							+$inputTGTValue;
						} else {
							$inputGajiPokokValue =  0;//set_value('gaji_pokok');
							$inputTFValue =  0;//set_value('tunjangan_fungsional');
							$inputTSValue =  0;//set_value('tunjangan_struktural');
							$inputTKEValue =  0;//set_value('tunjangan_kesra');
							$inputTKHValue =  0;//set_value('tunjangan_khusus');
							$inputTPValue =  0;//set_value('tunjangan_prestasi');
							$inputPoinValue =  0;//set_value('poin');							
							$inputTJValue = 0;//$gajipokok['tunjangan_jabatan'];
							$inputTPRValue = 0;//$gajipokok['tunjangan_profesi'];
							$inputTTValue = 0;//$gajipokok['tunjangan_transport'];
							$inputUAValue = 0;//$gajipokok['uang_makan'];
							$inputTUValue = 0;//$gajipokok['tunjangan_umum'];
							$inputTGTValue = 0;//$gajipokok['tunjangan_guru_tetap'];
							$totalGaji = 0;
						}
						if (isset($potongan)) {

							$inputPinjamanBankValue = $potongan['pinjaman_bank'];
							$inputOrganisasiValue = $potongan['organisasi'];
							$inputKoperasiValue = $potongan['koperasi'];
							$inputProgramBahasaValue = $potongan['program_bahasa'];
							$inputMajalahValue = $potongan['majalah'];
							$inputAdmValue = $potongan['adm_bank'];
							$inputInfaqValue = $potongan['infaq_dakwah'];
							$inputBpjsValue = $potongan['bpjs'];
							$inputTelemarketValue = $potongan['telemarket'];
							$inputLainnyaValue = $potongan['lainnya'];
							$inputAbsensiValue = $potongan['absensi'];
							$inputIuranJhtValue = $potongan['iuran_jht'];
							$inputJaminanPensiunValue = $potongan['jaminan_pensiun'];
							$totalPotongan = 
							$inputPinjamanBankValue
							+$inputOrganisasiValue
							+$inputKoperasiValue
							+$inputProgramBahasaValue
							+$inputMajalahValue
							+$inputAdmValue
							+$inputInfaqValue
							+$inputBpjsValue
							+$inputTelemarketValue
							+$inputLainnyaValue
							+$inputAbsensiValue
							+$inputIuranJhtValue
							+$inputJaminanPensiunValue;
						} else {
							$inputPinjamanBankValue = 0;//set_value('pinjaman_bank');
							$inputOrganisasiValue =  0;//set_value('organisasi');
							$inputKoperasiValue =  0;//set_value('koperasi');
							$inputProgramBahasaValue =  0;//set_value('program_bahasa');
							$inputMajalahValue =  0;//set_value('majalah');
							$inputAdmValue =  0;//set_value('adm_bank');
							$inputInfaqValue =  0;//set_value('infaq_dakwah');
							$inputBpjsValue =  0;//set_value('bpjs');
							$inputTelemarketValue =  0;//set_value('telemarket');
							$inputLainnyaValue =  0;//set_value('lainnya');							
							$inputAbsensiValue = 0;//$potongan['absensi'];
							$inputIuranJhtValue = 0;//$potongan['iuran_jht'];
							$inputJaminanPensiunValue = 0;//$potongan['jaminan_pensiun'];
							$totalPotongan = 0;// set_value('potongan');
						}
						$jumlahGaji = $totalGaji - $totalPotongan;
						$pembulatan = $jumlahGaji;
					?>

					<div class="box box-success">
						<div class="card-header with-border">
							<h3 class="box-title">Informasi Pegawai</h3>
						</div><!-- /.box-header -->
						<div class="card-body">
							<div class="col-md-9">
								<table class="table table-striped">
									<tbody>
										<tr>
											<td width="200">Tahun Ajaran</td><td width="4">:</td>
											<?php foreach ($period as $row): ?>
												<?php echo (isset($f['p']) AND $f['p'] == $row['period_id']) ? 
												'<td><strong>'.$row['period_start'].'/'.$row['period_start'].'<strong></td>' : '' ?> 
											<?php endforeach; ?>
										</tr>
										<tr>
											<td>NIP</td>
											<td>:</td>
											<?php foreach ($pegawai as $row): ?>
												<?php echo (isset($f['n']) AND $f['n'] == $row['employee_nip']) ? 
												'<td>'.$row['employee_nip'].'</td>' : '' ?> 
											<?php endforeach; ?>
										</tr>
										<tr>
											<td>Nama Pegawai</td>
											<td>:</td>
											<?php foreach ($pegawai as $row): ?>
												<?php echo (isset($f['n']) AND $f['n'] == $row['employee_nip']) ? 
												'<td>'.$row['employee_name'].'</td>' : '' ?> 
											<?php endforeach; ?>
										</tr>
										<tr>
											<td>Unit Sekolah</td>
											<td>:</td>
											<?php foreach ($pegawai as $row): ?>
												<?php echo (isset($f['n']) AND $f['n'] == $row['employee_nip']) ?  
												'<td>'.$row['majors_name'].'</td>' : '' ?> 
											<?php endforeach; ?>
										</tr>
										<tr>
											<td>Jabatan</td>
											<td>:</td>
											<?php foreach ($pegawai as $row): ?>
												<?php echo (isset($f['n']) AND $f['n'] == $row['employee_nip']) ? 
												'<td>'.$row['position_name'].'</td>' : '' ?> 
											<?php endforeach; ?>
										</tr>
										<tr>
											<td>Pendidikan Terakhir</td>
											<td>:</td>
											<?php foreach ($pegawai as $row): ?>
												<?php echo (isset($f['n']) AND $f['n'] == $row['employee_nip']) ? 
												'<td>'.$row['employee_strata'].'</td>' : '' ?> 
											<?php endforeach; ?>
										</tr>
										<tr>
											<td>Status Kepegawaian</td>
											<td>:</td>
											<?php foreach ($pegawai as $row): ?>
												<?php echo (isset($f['n']) AND $f['n'] == $row['employee_nip']) ? 
												'<td>'.$row['employee_category'].'</td>' : '' ?> 
											<?php endforeach; ?>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="col-md-3">
								<?php foreach ($pegawai as $row): ?>
									<?php if (isset($f['n']) AND $f['n'] == $row['employee_nip']) { ?> 
										<?php if (!empty($row['employee_photo'])) { ?>
											<img src="<?php echo upload_url('pegawai/'.$row['employee_photo']) ?>" class="img-thumbnail img-responsive">
										<?php } else { ?>
											<img src="<?php echo media_url('img/user.png') ?>" class="img-thumbnail img-responsive">
										<?php } 
									} ?>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="box box-primary">
								<div class="card-header with-border">
									<h3 class="box-title">History Penggajian</h3>
												<a href="" class="btn btn-info btn-xs"><i class="fa fa-refresh"></i> Refresh</a>
								</div><!-- /.box-header -->
								
								<div class="card-body table-responsive">
									<div class="over">
										<table id="slip" class="table table-responsive table-bordered" style="white-space: nowrap;">
											<tbody>
												<tr class="info">
													<th>No. Referensi</th>
													<th>Tanggal</th>
													<th>Bulan</th>
													<th>Gaji (Kotor)</th>
													<th>Potongan</th>
													<th>Gaji Diterima</th>
													<th>Aksi</th>
												</tr>
												<?php  foreach ($slip as $row) : ?>
													<tr>															
														
														<td><?php echo $row['slip_id'] ?></td>
														<td><?php echo $row['created_at'] ?></td>
														<td><?php echo $row['month_name'] ?></td>
														<td><?php echo $row['gaji'] ?></td>
														<td><?php echo $row['potongan'] ?></td>
														<td><?php echo $row['jumlah_gaji'] ?></td>
														<td>	
															<a href="<?php echo site_url('manage/slip/printPdf/' . $row['slip_id'].'/'.$row['employee_id']) ?>" target="_blank" class="btn btn-success btn-xs view-pdf" data-toggle="tooltip" title="Cetak Kartu"><i class="fa fa-print"></i></a>
														</td>
													</tr>
												<?php endforeach ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>

					</div>
					<div class="box box-primary">
						<div class="card-header with-border">
							<h3 class="box-title">Kelola Penggajian</h3>
						</div><!-- /.box-header -->
						<!--form action="slip/add_slip" method="post" target="_blank"-->
			
						<?php echo form_open_multipart('manage/slip/add_slip', array('target'=>'_blank')); ?>

										
							<div class="card-body">		
								<?php foreach ($pegawai as $row): ?>
									<?php echo (isset($f['n']) AND $f['n'] == $row['employee_nip']) ? 
									'<input type="hidden" name="employee_id" value="'.$row['employee_id'].'">' : '' ?> 
								<?php endforeach; ?>

								<div class="row">
									
									<div class="col-md-3">
									<div class="form-group">
										<label>Tanggal Cut Off <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
										<input name="tanggal_cut_off" type="text" class="form-control" required="" placeholder="Dari Bulan s/d Bulan">
									</div></div>
									<div class="col-md-3" hidden>
										<label>No. Referensi</label>
										<input required="" name="kas_noref" id="kas_noref" class="form-control" value="GKTK000356745330122301" readonly="">
									</div>
									<div class="col-md-3" hidden>
										<label>Pembayaran Gaji Via *</label>
										<select required="" name="kas_account_id" id="kas_account_id" class="form-control">
											<option value="">-- Pilih Akun Kas --</option>
											<option value="99" selected="">1-11001 - Kas Tunai TK</option>
											<option value="100">1-11002 - Kas Bank  TK</option>
											<option value="206">1-11003 - KAS IPAYMU TK</option>
											<option value="207">1-11004 - KAS IPAYMU TABUNGAN TK</option>
										</select>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Tahun Ajaran</label>
											<select class="form-control" name="period_id">
												<?php foreach ($period as $row): ?>
													<option value="<?php echo $row['period_id'] ?>"><?php echo $row['period_start'].'/'.$row['period_end'] ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<!--
										<input type="hidden" name="kas_majors_id" id="kas_majors_id" class="form-control" value="2" readonly="">
										<input type="hidden" name="kas_period" value="13">
										<input type="hidden" name="gaji_account_id" value="66">
										<input type="hidden" name="premier_id" value="14">
										<input type="hidden" name="potongan_id" value="14">
										<input type="hidden" name="period_id" value="13">
												-->

										<div class="form-group">
											<label>Gaji Pada Bulan</label>
											<select class="form-control" name="month_id">
												<!-- <option value="">-- Tahun Ajaran --</option> -->
												<?php foreach ($bulan as $row): ?>
													<option value="<?php echo $row['month_id'] ?>"><?php echo $row['month_name'] ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>					    
								<div class="nav-tabs-custom">
									<ul class="nav nav-tabs">
										<li class=""><a href="#tab_1" data-toggle="tab" aria-expanded="false">Gaji Pokok</a></li>
										<li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Potongan</a></li>
										<li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Absensi</a></li>
										<li class="active"><a href="#tab_4" data-toggle="tab" aria-expanded="true">Kalkulasi Gaji</a></li>
									</ul>
									<div class="tab-content">
										
										<div class="tab-pane" id="tab_1">
											<div class="form-group">
												<div class="row">
												<div class="col-md-3">
													<label>Gaji Pokok <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
												</div>
												<div class="col-md-1"><label> = </label></div>
												<div class="col-md-3">
													<input name="gaji_pokok" type="text" class="form-control" value="<?php echo $inputGajiPokokValue ?>" readonly>
												</div>
												</div>
											</div>
						
											<div class="form-group" hidden>
												<div class="row">
												<div class="col-md-3">
												<label>Tunjangan Fungsional <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
												</div>
												<div class="col-md-1"><label> = </label></div>
												<div class="col-md-3">
												<input name="tunjangan_fungsional" type="text" class="form-control" value="<?php echo $inputTFValue ?>"  readonly>
												</div>
												</div>
											</div>
						
											<div class="form-group" hidden>
												<div class="row">
												<div class="col-md-3">
												<label>Tunjangan Struktural <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
												</div>
												<div class="col-md-1"><label> = </label></div>
												<div class="col-md-3">
												<input name="tunjangan_struktural" type="text" class="form-control" value="<?php echo $inputTSValue ?>" readonly>
												</div>
												</div>
											</div>
						
											<div class="form-group" hidden>
												<div class="row">
												<div class="col-md-3">
												<label>Tunjangan Kesra <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
												</div>
												<div class="col-md-1"><label> = </label></div>
												<div class="col-md-3">
												<input name="tunjangan_kesra" type="text" class="form-control" value="<?php echo $inputTKEValue ?>" readonly>
												</div>
												</div>
											</div>
						
											<div class="form-group" hidden>
												<div class="row">
												<div class="col-md-3">
												<label>Tunjangan Khusus <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
												</div>
												<div class="col-md-1"><label> = </label></div>
												<div class="col-md-3">
												<input name="tunjangan_khusus" type="text" class="form-control" value="<?php echo $inputTKHValue ?>" readonly>
												</div>
												</div>
											</div>
						
											<div class="form-group" hidden>
												<div class="row">
												<div class="col-md-3">
												<label>Tunjangan Prestasi <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
												</div>
												<div class="col-md-1"><label> = </label></div>
												<div class="col-md-3">
												<input name="tunjangan_prestasi" type="text" class="form-control" value="<?php echo $inputTPValue ?>" readonly>
												</div>
												</div>
											</div>
						
											<div class="form-group" hidden>
												<div class="row">
												<div class="col-md-3">
												<label>Tambahan / Poin <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
												</div>
												<div class="col-md-1"><label> = </label></div>
												<div class="col-md-3">
												<input name="poin" type="text" class="form-control" value="<?php echo $inputPoinValue ?>" readonly>
												</div>
												</div>
											</div>

											
											<div class="form-group">
												<div class="row">
												<div class="col-md-3">
												<label>Tunjangan Jabatan <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
												</div>
												<div class="col-md-1"><label> = </label></div>
												<div class="col-md-3">
												<input name="tunjangan_jabatan" type="text" class="form-control" value="<?php echo $inputTJValue ?>"  readonly>
												</div>
												</div>
											</div>
											<div class="form-group">
												<div class="row">
												<div class="col-md-3">
												<label>Tunjangan Profesi <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
												</div>
												<div class="col-md-1"><label> = </label></div>
												<div class="col-md-3">
												<input name="tunjangan_profesi" type="text" class="form-control" value="<?php echo $inputTPRValue ?>" readonly>
												</div>
												</div>
											</div>
											
											<div class="form-group">
												<div class="row">
												<div class="col-md-3">
												<label>Tunjangan transport <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
												</div>
												<div class="col-md-1"><label> = </label></div>
												<div class="col-md-3">
												<input name="tunjangan_transport" type="text" class="form-control" value="<?php echo $inputTTValue ?>" readonly>
												</div>
												</div>
											</div>
											
											<div class="form-group">
												<div class="row">
												<div class="col-md-3">
												<label>Uang Makan <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
												</div>
												<div class="col-md-1"><label> = </label></div>
												<div class="col-md-3">
												<input name="uang_makan" type="text" class="form-control" value="<?php echo $inputUAValue ?>" readonly>
												</div>
												</div>
											</div>
											<div class="form-group">
												<div class="row">
												<div class="col-md-3">
												<label>Tunjangan Umum <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
												</div>
												<div class="col-md-1"><label> = </label></div>
												<div class="col-md-3">
												<input name="tunjangan_umum" type="text" class="form-control" value="<?php echo $inputTUValue ?>" readonly>
												</div>
												</div>
											</div>
											
											<div class="form-group">
												<div class="row">
												<div class="col-md-3">
												<label>Tunjangan Guru Tetap <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
												</div>
												<div class="col-md-1"><label> = </label></div>
												<div class="col-md-3">
												<input name="tunjangan_guru_tetap" type="text" class="form-control" value="<?php echo $inputTGTValue ?>" readonly>
												</div>
												</div>
											</div>
										</div>
										
										<div class="tab-pane" id="tab_2">
										
											<div class="form-group" hidden>
												<div class="row">
												<div class="col-md-3">
												<label>Pinjaman Bank <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
												</div>
												<div class="col-md-1"><label> = </label></div>
												<div class="col-md-3">
												<input name="pinjaman_bank" type="text" class="form-control" value="<?php echo $inputPinjamanBankValue ?>" readonly>
												</div>
												</div>
											</div>
						
											<div class="form-group" hidden>
												<div class="row">
												<div class="col-md-3">
												<label>Organisasi <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
												</div>
												<div class="col-md-1"><label> = </label></div>
												<div class="col-md-3">
												<input name="organisasi" type="text" class="form-control" value="<?php echo $inputOrganisasiValue ?>" readonly>
												</div>
												</div>
											</div>
											
											<div class="form-group" hidden>
												<div class="row">
												<div class="col-md-3">
												<label>Koperasi <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
												</div>
												<div class="col-md-1"><label> = </label></div>
												<div class="col-md-3">
												<input name="koperasi" type="text" class="form-control" value="<?php echo $inputKoperasiValue ?>" readonly>
												</div>
												</div>
											</div>
						
											<div class="form-group" hidden>
												<div class="row">
												<div class="col-md-3">
												<label>Program Bahasa <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
												</div>
												<div class="col-md-1"><label> = </label></div>
												<div class="col-md-3">
												<input name="program_bahasa" type="text" class="form-control" value="<?php echo $inputProgramBahasaValue ?>" readonly>
												</div>
												</div>
											</div>
						
											<div class="form-group" hidden>
												<div class="row">
												<div class="col-md-3">
												<label>Majalah <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
												</div>
												<div class="col-md-1"><label> = </label></div>
												<div class="col-md-3">
												<input name="majalah" type="text" class="form-control" value="<?php echo $inputMajalahValue ?>" readonly>
												</div>
												</div>
											</div>
						
											<div class="form-group" hidden>
												<div class="row">
												<div class="col-md-3">
												<label>Administrasi Bank <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
												</div>
												<div class="col-md-1"><label> = </label></div>
												<div class="col-md-3">
												<input name="adm_bank" type="text" class="form-control" value="<?php echo $inputAdmValue ?>" readonly>
												</div>
												</div>
											</div>
						
											<div class="form-group" hidden>
												<div class="row">
												<div class="col-md-3">
												<label>Infaq Ged. Dakwah<small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
												</div>
												<div class="col-md-1"><label> = </label></div>
												<div class="col-md-3">
												<input name="infaq_dakwah" type="text" class="form-control" value="<?php echo $inputInfaqValue ?>" readonly>
												</div>
												</div>
											</div>
						
											<div class="form-group">
												<div class="row">
												<div class="col-md-3">
												<label>Absensi <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
												</div>
												<div class="col-md-1"><label> = </label></div>
												<div class="col-md-3">
												<input name="absensi" type="text" class="form-control" value="<?php echo $inputAbsensiValue ?>"  readonly>
												</div>
												</div>
											</div>

											<div class="form-group">
												<div class="row">
												<div class="col-md-3">
												<label>BPJS <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
												</div>
												<div class="col-md-1"><label> = </label></div>
												<div class="col-md-3">
												<input name="bpjs" type="text" class="form-control" value="<?php echo $inputBpjsValue ?>" readonly>
												</div>
												</div>
											</div>
						
											<div class="form-group">
												<div class="row">
												<div class="col-md-3">
												<label>Iuran JHT <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
												</div>
												<div class="col-md-1"><label> = </label></div>
												<div class="col-md-3">
												<input name="iuran_jht" type="text" class="form-control" value="<?php echo $inputIuranJhtValue ?>"  readonly>
												</div>
												</div>
											</div>
											
											<div class="form-group">
												<div class="row">
												<div class="col-md-3">
												<label>Jaminan Pensiun<small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
												</div>
												<div class="col-md-1"><label> = </label></div>
												<div class="col-md-3">
												<input name="jaminan_pensiun" type="text" class="form-control" value="<?php echo $inputJaminanPensiunValue ?>"  readonly>
												</div>
												</div>
											</div>
											<div class="form-group" hidden>
												<div class="row">
												<div class="col-md-3">
												<label>Telemarket <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
												</div>
												<div class="col-md-1"><label> = </label></div>
												<div class="col-md-3">
												<input name="telemarket" type="text" class="form-control" value="<?php echo $inputTelemarketValue ?>" readonly>
												</div>
												</div>
											</div>
						
											<div class="form-group" hidden>
												<div class="row">
												<div class="col-md-3">
												<label>Lain-lain <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
												</div>
												<div class="col-md-1"><label> = </label></div>
												<div class="col-md-3">
												<input name="lainnya" type="text" class="form-control" value="<?php echo $inputLainnyaValue ?>" readonly>
												</div>
												</div>
											</div>
										</div>
										<div class="tab-pane" id="tab_3">
											
											<div class="form-group">
												<div class="row">
													<div class="col-md-3">
														<label>Hari Efektif <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
													</div>
													<div class="col-md-1"><label> = </label></div>
													<div class="col-md-8">
														<input name="hari_efektif" type="text" class="form-control" required="" >
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="row">
													<div class="col-md-3">
														<label>Hari Masuk <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
													</div>
													<div class="col-md-1"><label> = </label></div>
													<div class="col-md-8">
														<input name="hari_masuk" type="text" class="form-control" required="">
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="row">
													<div class="col-md-3">
														<label>Lupa Absen Masuk <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
													</div>
													<div class="col-md-1"><label> = </label></div>
													<div class="col-md-8">
														<input name="lupa_absen_masuk" type="text" class="form-control"required="">
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="row">
													<div class="col-md-3">
														<label>Lupa Absen Pulang <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
													</div>
													<div class="col-md-1"><label> = </label></div>
													<div class="col-md-8">
														<input name="lupa_absen_pulang" type="text" class="form-control" required="">
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="row">
													<div class="col-md-3">
														<label>Sakit SKD <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
													</div>
													<div class="col-md-1"><label> = </label></div>
													<div class="col-md-8">
														<input name="sakit_skd" type="text" class="form-control" required="">
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="row">
													<div class="col-md-3">
														<label>Sakit Non SKD <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
													</div>
													<div class="col-md-1"><label> = </label></div>
													<div class="col-md-8">
														<input name="sakit_non_skd" type="text" class="form-control" required="">
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="row">
													<div class="col-md-3">
														<label>Izin <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
													</div>
													<div class="col-md-1"><label> = </label></div>
													<div class="col-md-8">
														<input name="izin" type="text" class="form-control" required="" >
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="row">
													<div class="col-md-3">
														<label>Keterlambatan <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
													</div>
													<div class="col-md-1"><label> = </label></div>
													<div class="col-md-8">
														<input name="keterlambatan" type="text" class="form-control" required="">
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="row">
													<div class="col-md-3">
														<label>Tanpa Keterangan <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
													</div>
													<div class="col-md-1"><label> = </label></div>
													<div class="col-md-8">
														<input name="tanpa_keterangan" type="text" class="form-control" required="">
													</div>
												</div>
											</div>
										</div>
										<div class="tab-pane active" id="tab_4">
											<div class="form-group">
												<div class="row">
												<div class="col-md-3">
													<label>Gaji Pokok </label>
												</div>
												<div class="col-md-1"><label> = </label></div>
												<div class="col-md-3">
													<input name="gaji" type="text" class="form-control" value="<?php echo $totalGaji ?>" readonly="" placeholder="Gaji Pokok">
												</div>
												</div>
											</div>
						
											<div class="form-group">
												<div class="row">
												<div class="col-md-3">
												<label>Potongan </label>
												</div>
												<div class="col-md-1"><label> = </label></div>
												<div class="col-md-3">
												<input name="potongan" type="text" class="form-control" value="<?php echo $totalPotongan ?>" readonly="" placeholder="Tunjangan Struktural">
												</div>
												</div>
											</div>
											
											<hr>
											
											<div class="form-group">
												<div class="row">
												<div class="col-md-3">
												<label>Jumlah Gaji</label>
												</div>
												<div class="col-md-1"><label>=</label></div>
												<div class="col-md-3">
												<input name="jumlah_gaji" id="jumlah_gaji" type="text" class="form-control" value="<?php echo $jumlahGaji ?>" readonly="">
												</div>
												</div>
											</div>
											
											<hr>
											
											<div class="form-group" hidden>
												<div class="row">
												<div class="col-md-3">
												<label>Pembulatan Gaji</label>
												</div>
												<div class="col-md-1"><label>=</label></div>
												<div class="col-md-3">
												<input name="pembulatan_gaji" id="pembulatan_gaji" type="text" class="form-control" value="<?php echo $pembulatan ?>" readonly="">
												</div>
												</div>
											</div>
											
											<hr>
											
											<div class="form-group">
												<div class="row">
												<div class="col-md-3">
												<label>Catatan</label>
												</div>
												<div class="col-md-1"><label>=</label></div>
												<div class="col-md-4">
												<textarea name="catatan_gaji" class="form-control" cols="4" rows="3" id="comment"></textarea>
												</div>
												</div>
											</div>
											
											<div class="form-group">
												<div class="row">
													<div class="col-md-4">
														<label></label>
													</div>
													<div class="col-md-3">
														<button type="submit" class="btn btn-block btn-success">Cetak Slip Gaji</button>
													</div>
												</div>
											</div>
										</div>
									</div>    
									<p class="text-muted">*) Isi catatan jika diperlukan.</p>
								</div>					
							</div>

						<!--/form-->

                        <?= form_close(); ?>
					</div>
				<?php } ?>
	</div>
		
	</section>
	<!-- /.content -->
</div>


<div class="modal fade" id="dataPegawai" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h4 class="modal-title">Cari Data Pegawai</h4>
			</div>
			<div class="modal-body">
				<div id="div_student">
					<div class="card-body table-responsive">
						<table id="dtable" class="table table-hover dataTable no-footer" role="grid">
							<tr>
								<th>No</th>
								<th>NIP</th>
								<th>Nama</th>
								<th>Unit Sekolah</th>
								<th>Jabatan</th>
								<th>Aksi</th>
							</tr>	
							<tbody>

							<?php
								$i =1;
								foreach ($pegawai as $row):
										?>
										<tr>
											<td><?php echo $i ?></td>
											<td><?php echo $row['employee_nip']; ?></td>
											<td><?php echo $row['employee_name']; ?></td>
											<td><?php echo $row['majors_name']; ?></td>
											<td><?php echo $row['position_name']; ?></td>
											<td align="center">
												<button type="button" data-dismiss="modal" class="btn btn-primary btn-xs" onclick="ambil_data('<?php echo $row['employee_id']; ?>','<?php echo $row['employee_nip']; ?>')">Pilih</button>
											</td>
										</tr>
										<?php 
										$i++;
									endforeach; 
									?>	
							</tbody>
						</table>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
function ambil_data(id,nip){
	var idPegawai    = id;
	var nipPegawai    = nip;
	var thAjaran    = $("#th_ajar").val();
	var blAjaran    = $("#bln_ajar").val();

	window.location.href = '/manage/slip?p='+thAjaran+'&c='+blAjaran+'&i='+idPegawai+'&n='+nipPegawai;
}
</script>