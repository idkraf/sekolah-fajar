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
					<div class="card-body">
						<div class="col-md-12 col-sm-12 col-xs-12 pull-left">
							<br>
							<div class="row">
								<div class="col-md-2">
									<?php if (!empty($pegawai['employee_img'])) { ?>
									<img src="<?php echo upload_url('employee/'.$pegawai['employee_img']) ?>" class="img-responsive avatar">
									<?php } else { ?>
									<img src="<?php echo media_url('img/user.png') ?>" class="img-responsive avatar">
									<?php } ?>
								</div>
								<div class="col-md-10">
									<table class="table table-hover">
										<tbody>
											<tr>
												<td>No. Induk</td>
												<td>:</td>
												<td><?php echo $pegawai['employee_nip'] ?></td>
											</tr>
											<tr>
												<td>NIK</td>
												<td>:</td>
												<td><?php echo $pegawai['employee_nik'] ?></td>
											</tr>
											<tr>
												<td>Nama</td>
												<td>:</td>
												<td><?php echo $pegawai['employee_name'] ?></td>
											</tr>
											<tr>
												<td>Tempat, Tanggal Lahir</td>
												<td>:</td>
												<td><?php echo $pegawai['employee_born_place'].', '. pretty_date($pegawai['employee_born_date'],'d F Y',false) ?></td>
											</tr>
											<tr>
												<td>Jenis Kelamin</td>
												<td>:</td>
												<td><?php echo ($pegawai['employee_gender']=='L')? 'Laki-laki' : 'Perempuan' ?></td>
											</tr>
											<tr>
												<td>Agama</td>
												<td>:</td>
												<td><?php echo $pegawai['employee_agama'] ?></td>
											</tr>
											<tr>
												<td>Email</td>
												<td>:</td>
												<td><?php echo $pegawai['employee_email'] ?></td>
											</tr>
											<tr>
												<td>Alamat</td>
												<td>:</td>
												<td><?php echo $pegawai['employee_address'] ?></td>
											</tr>
											<tr>
												<td>Kode Pos</td>
												<td>:</td>
												<td><?php echo $pegawai['employee_kodepos'] ?></td>
											</tr>
											<tr>
												<td>No. Handphone</td>
												<td>:</td>
												<td><?php echo $pegawai['employee_phone'] ?></td>
											</tr>
											<tr>
												<td>Jabatan</td>
												<td>:</td>
												<td><?php echo $pegawai['position_name'] ?></td>
											</tr>
											<tr>
												<td>Golongan</td>
												<td>:</td>
												<td></td>
											</tr>
											<tr>
												<td>Pendidikan Terakhir</td>
												<td>:</td>
												<td><?php echo $pegawai['employee_asal_sekolah'] ?></td>
											</tr>
											<tr>
												<td>BPJS Kesehatan</td>
												<td>:</td>
												<td><?php echo $pegawai['employee_bpjs_kesehatan'] ?></td>
											</tr>
											<tr>
												<td>BPJS Tenagakerjaan</td>
												<td>:</td>
												<td><?php echo $pegawai['employee_bpjs_ketenagakerjaan'] ?></td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="col-md-12">
									<a href="<?php echo site_url('manage/pegawai') ?>" class="btn btn-default">
										<i class="fa fa-arrow-circle-o-left"></i> Kembali
									</a>
									<?php if ($this->session->userdata('uroleid') == SUPERUSER) { ?>
									<a href="<?php echo site_url('manage/pegawai/edit/' . $pegawai['employee_id']) ?>" class="btn btn-success">
										<i class="fa fa-edit"></i> Edit
									</a>
									<a href="#delModal<?php echo $pegawai['employee_id']; ?>" data-toggle="modal" class="btn btn-danger"><i class="fa fa-trash" data-toggle="tooltip" title="Hapus"></i> Hapus</a>
									<?php } ?>
									
									<a href="<?php echo site_url('manage/pegawai/printPegawai/'. $pegawai['employee_id']) ?>" target="_blank" title="Cetak PDF" class="btn btn-default pull-right">
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
					<div class="card-body">
						<div class="col-md-12 col-sm-12 col-xs-12">
					    <h3>Riwayat Pendidikan</h3>
					    <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#addEducation<?php echo $pegawai['employee_id']; ?>"><i class="fa fa-plus"></i> Tambah</button>
							
							<table class="table table-bordered table-hover">
							    <thead>
							        <tr>
    							        <th>No</th>
    							        <th>Thn Masuk</th>
    							        <th>Thn Lulus</th>
    							        <th>Sekolah/Universitas</th>
    							        <th>Lokasi</th>
    							        <th>Aksi</th>
							        </tr>
							    </thead>
							    <tbody>
								<?php
									if (!empty($pendidikan_terakhir)) {
										$i = 1;
										foreach ($pendidikan_terakhir as $row):
											?>
									<tr>
    							        <td><?php echo $i; ?></td>
    							        <td><?php echo $row['thn_masuk']; ?></td>
    							        <td><?php echo $row['thn_lulus']; ?></td>
    							        <td><?php echo $row['sekolah']; ?></td>
    							        <td><?php echo $row['lokasi']; ?></td>
    							        <td>
    							            <a href="#delEdu<?php echo $row['id']?>" data-toggle="modal" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" title="" data-original-title="Hapus"></i></a>
											<div class="modal modal-default fade" id="delEdu<?php echo $row['id']?>">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">×</span></button>
																<h3 class="modal-title"><span class="fa fa-warning"></span> Konfirmasi penghapusan</h3>
															</div>
															<div class="modal-body">
																<p>Apakah anda yakin akan menghapus data ini?</p>
															</div>
															<div class="modal-footer">
															<?php echo form_open('manage/pegawai/delete_education/' . $row['id'] . '/' . $pegawai['employee_id']);   ?>
																<input type="hidden" name="employee_id" value="<?php echo $pegawai['employee_id']; ?>">
																<button type="button" class="btn btn-default pull-left" data-dismiss="modal"><span class="fa fa-close"></span> Batal</button>
																<button type="submit" class="btn btn-danger"><span class="fa fa-check"></span> Hapus</button>
																<?php echo form_close(); ?>
															</div>
														</div>
														<!-- /.modal-content -->
													</div>
													<!-- /.modal-dialog -->
												</div>
											</div>
										</td>
                                    </tr>
									<?php
											$i++;
										endforeach;
									} else {
										?>
										<tr id="row">
											<td colspan="8" align="center">Data Kosong</td>
										</tr>
										<?php } ?>
								</tbody>
							</table>
						</div>
				    </div>
				</div>
		    </div>

			<div class="col-md-6">
				<div class="box box-success">
					<!-- /.box-header -->
					<div class="card-body">
						<div class="col-md-12 col-sm-12 col-xs-12">
					    <h3>Riwayat Seminar &amp; Pelatihan</h3>
					    <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#addWorkshop<?php echo $pegawai['employee_id']; ?>"><i class="fa fa-plus"></i> Tambah</button>
							
							<table class="table table-bordered table-hover">
							    <thead>
							        <tr>
    							        <th>No</th>
    							        <th>Mulai</th>
    							        <th>Selesai</th>
    							        <th>Penyelenggara</th>
    							        <th>Lokasi</th>
    							        <th>Aksi</th>
    							    </tr>
							    </thead>
							    <tbody>
								<?php
								if (!empty($riwayat_pelatihan)) {
										$i = 1;
										foreach ($riwayat_pelatihan as $row):
											?>
									<tr>
    							        <td><?php echo $i; ?></td>
    							        <td><?php echo $row['start_date']; ?></td>
    							        <td><?php echo $row['end_date']; ?></td>
    							        <td><?php echo $row['penyelenggara']; ?></td>
    							        <td><?php echo $row['lokasi']; ?></td>
    							        <td>
    							            <a href="#delWork<?php echo $row['id']?>" data-toggle="modal" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" title="" data-original-title="Hapus"></i></a>
											<div class="modal modal-default fade" id="delWork<?php echo $row['id']?>">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">×</span></button>
																<h3 class="modal-title"><span class="fa fa-warning"></span> Konfirmasi penghapusan</h3>
															</div>
															<div class="modal-body">
																<p>Apakah anda yakin akan menghapus data ini?</p>
															</div>
															<div class="modal-footer">
																<?php echo form_open('manage/pegawai/delete_pelatihan/' . $row['id']);  ?>
																<input type="hidden" name="employee_id" value="<?php echo $pegawai['employee_id']; ?>">
																<button type="button" class="btn btn-default pull-left" data-dismiss="modal"><span class="fa fa-close"></span> Batal</button>
																<button type="submit" class="btn btn-danger"><span class="fa fa-check"></span> Hapus</button>
																<?php echo form_close(); ?>
															</div>
														</div>
														<!-- /.modal-content -->
													</div>
													<!-- /.modal-dialog -->
												</div>
											</div>
										</td>
                                    </tr>
                                    
									<?php
											$i++;
										endforeach;
									} else {
										?>
										<tr id="row">
											<td colspan="8" align="center">Data Kosong</td>
										</tr>
										<?php } ?>
								</tbody>
							</table>
						</div>
					   </div>
				</div>
            </div>
		</div>

	</section>
	<section class="content">
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-md-6">
				<div class="box box-success">
					<!-- /.box-header -->
					<div class="card-body">
						<div class="col-md-12 col-sm-12 col-xs-12">
					    <h3>Data Keluarga</h3>
					    <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#addFamily<?php echo $pegawai['employee_id']; ?>"><i class="fa fa-plus"></i> Tambah</button>
							
							<table class="table table-bordered table-hover">
							    <thead>
							        <tr>
    							        <th>No</th>
    							        <th>Nama</th>
    							        <th>Hubungan</th>
    							        <th>Aksi</th>
							        </tr>
							    </thead>
							    <tbody>
									
								<?php
								if (!empty($data_keluarga)) {
										$i = 1;
										foreach ($data_keluarga as $row):
											?>
									<tr>
    							        <td><?php echo $i; ?></td>
    							        <td><?php echo $row['fam_name']; ?></td>
    							        <td><?php echo $row['fam_desc']; ?></td>
    							        <td>
    							            <a href="#delFam<?php echo $row['id']; ?>" data-toggle="modal" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" title="" data-original-title="Hapus"></i></a>
											<div class="modal modal-default fade" id="delFam<?php echo $row['id']; ?>">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">×</span></button>
																<h3 class="modal-title"><span class="fa fa-warning"></span> Konfirmasi penghapusan</h3>
															</div>
															<div class="modal-body">
																<p>Apakah anda yakin akan menghapus data ini?</p>
															</div>
															<div class="modal-footer">
																<?php echo form_open('manage/pegawai/delete_family/' . $row['id'] . '/' . $pegawai['employee_id']);  ?>
																
																<input type="hidden" name="employee_id" value="<?php echo $pegawai['employee_id']; ?>">
																<button type="button" class="btn btn-default pull-left" data-dismiss="modal"><span class="fa fa-close"></span> Batal</button>
																<button type="submit" class="btn btn-danger"><span class="fa fa-check"></span> Hapus</button>
																<?php echo form_close(); ?>
															</div>
														</div>
														<!-- /.modal-content -->
													</div>
													<!-- /.modal-dialog -->
												</div>
											</div>
										</td>
                                    </tr>
                                    
									<?php
											$i++;
										endforeach;
									} else {
										?>
										<tr id="row">
											<td colspan="8" align="center">Data Kosong</td>
										</tr>
										<?php } ?>
								</tbody>
							</table>
						</div>
					   </div>
				</div>
		    </div>
		    <div class="col-md-6">
				<div class="box box-success">
					<!-- /.box-header -->
					<div class="card-body">
						<div class="col-md-12 col-sm-12 col-xs-12">
					    <h3>Riwayat Jabatan</h3>
					    <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#addPosition<?php echo $pegawai['employee_id']; ?>"><i class="fa fa-plus"></i> Tambah</button>
							
							<table class="table table-bordered table-hover">
							    <thead>
							        <tr>
    							        <th>No</th>
    							        <th>Tahun Mulai</th>
    							        <th>Tahun Selesai</th>
    							        <th>Keterangan</th>
    							        <th>Aksi</th>
    							    </tr>
							    </thead>
							    <tbody>
								<?php
								if (!empty($riwayat_jabatan)) {
										$i = 1;
										foreach ($riwayat_jabatan as $row):
											?>
									<tr>
    							        <td><?php echo $i; ?></td>
    							        <td><?php echo $row['position_start']; ?></td>
    							        <td><?php echo $row['position_end']; ?></td>
    							        <td><?php echo $row['position_desc']; ?></td>
    							        <td>
    							            <a href="#delPosition<?php echo $row['id']; ?>" data-toggle="modal" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" title="" data-original-title="Hapus"></i></a>
											<div class="modal modal-default fade" id="delPosition<?php echo $row['id']; ?>">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">×</span></button>
																<h3 class="modal-title"><span class="fa fa-warning"></span> Konfirmasi penghapusan</h3>
															</div>
															<div class="modal-body">
																<p>Apakah anda yakin akan menghapus data ini?</p>
															</div>
															<div class="modal-footer">
															<?php echo form_open('manage/pegawai/delete_position/' . $row['id'] . '/' . $pegawai['employee_id']);  ?>
																
																<input type="hidden" name="employee_id" value="<?php echo $pegawai['employee_id']; ?>">
																<button type="button" class="btn btn-default pull-left" data-dismiss="modal"><span class="fa fa-close"></span> Batal</button>
																<button type="submit" class="btn btn-danger"><span class="fa fa-check"></span> Hapus</button>
																<?php echo form_close(); ?>
															</div>
														</div>
														<!-- /.modal-content -->
													</div>
													<!-- /.modal-dialog -->
												</div>
											</div>
										</td>
                                    </tr>
                                    
									<?php
											$i++;
										endforeach;
									} else {
										?>
										<tr id="row">
											<td colspan="8" align="center">Data Kosong</td>
										</tr>
										<?php } ?>
								</tbody>
							</table>
						</div>
					   </div>
				</div>
		    </div>
        </div>
	</section>
	<section class="content">
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-md-6">
				<div class="box box-success">
					<!-- /.box-header -->
					<div class="card-body">
						<div class="col-md-12 col-sm-12 col-xs-12">
					    <h3>Riwayat Mengajar</h3>
					    <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#addTeaching<?php echo $pegawai['employee_id']; ?>"><i class="fa fa-plus"></i> Tambah</button>
						
						<table class="table table-bordered table-hover">
							    <thead>
							        <tr>
    							        <th>No</th>
    							        <th>Tahun Mulai</th>
    							        <th>Tahun Selesai</th>
    							        <th>Mata Pelajaran</th>
    							        <th>Keterangan</th>
    							        <th>Aksi</th>
    							    </tr>
							    </thead>
							    <tbody>
								<?php
								if (!empty($riwayat_mengajar)) {
										$i = 1;
										foreach ($riwayat_mengajar as $row):
											?>
									<tr>
    							        <td><?php echo $i; ?></td>
    							        <td><?php echo $row['teaching_start']; ?></td>
    							        <td><?php echo $row['teaching_end']; ?></td>
    							        <td><?php echo $row['teaching_lesson']; ?></td>
    							        <td><?php echo $row['teaching_desc']; ?></td>
    							        <td>
    							            <a href="#delTeaching<?php echo $row['id']; ?>" data-toggle="modal" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" title="" data-original-title="Hapus"></i></a>
											<div class="modal modal-default fade" id="delTeaching<?php echo $row['id']?>">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">×</span></button>
																<h3 class="modal-title"><span class="fa fa-warning"></span> Konfirmasi penghapusan</h3>
															</div>
															<div class="modal-body">
																<p>Apakah anda yakin akan menghapus data ini?</p>
															</div>
															<div class="modal-footer">
																<?php echo form_open('manage/pegawai/delete_teaching/' . $row['id'] . '/' . $pegawai['employee_id']);  ?>
																<input type="hidden" name="employee_id" value="<?php echo $pegawai['employee_id']; ?>">
																<button type="button" class="btn btn-default pull-left" data-dismiss="modal"><span class="fa fa-close"></span> Batal</button>
																<button type="submit" class="btn btn-danger"><span class="fa fa-check"></span> Hapus</button>
																<?php echo form_close(); ?>
															</div>
														</div>
														<!-- /.modal-content -->
													</div>
													<!-- /.modal-dialog -->
												</div>
											</div>
										</td>
                                    </tr>
                                    
									<?php
											$i++;
										endforeach;
									} else {
										?>
										<tr id="row">
											<td colspan="8" align="center">Data Kosong</td>
										</tr>
										<?php } ?>
								</tbody>
							</table>
						</div>
					   </div>
				</div>
		    </div>
		    <div class="col-md-6">
				<div class="box box-success">
					<!-- /.box-header -->
					<div class="card-body">
						<div class="col-md-12 col-sm-12 col-xs-12">
					    <h3>Penghargaan</h3>
					    <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#addAchievement<?php echo $pegawai['employee_id']; ?>"><i class="fa fa-plus"></i> Tambah</button>
							<table class="table table-bordered table-hover">
							    <thead>
							        <tr>
    							        <th>No</th>
    							        <th>Tahun</th>
    							        <th>Keterangan</th>
    							        <th>Aksi</th>
    							    </tr>
							    </thead>
							    <tbody>							    
								<?php
								if (!empty($penghargaan)) {
										$i = 1;
										foreach ($penghargaan as $row):
											?>
								
									<tr>
    							        <td><?php echo $i; ?></td>
    							        <td><?php echo $row['achievement_year']; ?></td>
    							        <td><?php echo $row['achievement_name']; ?></td>
    							        <td>
    							            <a href="#delPenghargaa<?php echo $row['id']; ?>" data-toggle="modal" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" title="" data-original-title="Hapus"></i></a>
											<div class="modal modal-default fade" id="delPenghargaa<?php echo $row['id']; ?>">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">×</span></button>
																<h3 class="modal-title"><span class="fa fa-warning"></span> Konfirmasi penghapusan</h3>
															</div>
															<div class="modal-body">
																<p>Apakah anda yakin akan menghapus data ini?</p>
															</div>
															<div class="modal-footer">
																<?php echo form_open('manage/pegawai/delete_penghargaan/' . $row['id'] . '/' . $pegawai['employee_id']);  ?>
																	<input type="hidden" name="employee_id" value="<?php echo $pegawai['employee_id']; ?>">
																	<button type="button" class="btn btn-default pull-left" data-dismiss="modal"><span class="fa fa-close"></span> Batal</button>
																	<button type="submit" class="btn btn-danger"><span class="fa fa-check"></span> Hapus</button>																
																<?php echo form_close(); ?>
															</div>
														</div>
														<!-- /.modal-content -->
													</div>
													<!-- /.modal-dialog -->
												</div>
											</div>
										</td>
                                    </tr>
                                    
								<?php
											$i++;
										endforeach;
									} else {
										?>
										<tr id="row">
											<td colspan="8" align="center">Data Kosong</td>
										</tr>
										<?php } ?>
								</tbody>
							</table>
						</div>
					   </div>
				</div>
		    </div>
        </div>
	</section>

</div>

	<div class="modal fade" id="addEducation<?php echo $pegawai['employee_id']; ?>" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">×</button>
					<h4 class="modal-title">Tambah Riwayat Pendidikan</h4>
				</div>
				<form action="<?php echo site_url('manage/pegawai/add_education') ?>" method="post" accept-charset="utf-8">
				<div class="modal-body">
					<input type="hidden" class="form-control" required="" name="employee_id" value="<?php echo $pegawai['employee_id']; ?>">
					<div id="p_scents_education">
						<div class="row">
						<div class="col-md-3">
							<label>Tahun Masuk *</label>
							<input type="text" class="form-control" required="" name="thn_masuk[]" placeholder="Contoh : 2010">
						</div>
						<div class="col-md-3">
							<label>Tahun Lulus *</label>
							<input type="text" class="form-control" required="" name="thn_lulus[]" placeholder="Contoh : 2014">
						</div>
						<div class="col-md-3">
							<label>Sekolah/Universitas *</label>
							<input type="text" class="form-control" required="" name="sekolah[]" placeholder="Sekolah/Universitas">
						</div>
						<div class="col-md-3">
							<label>Lokasi *</label>
							<input type="text" required="" name="lokasi[]" class="form-control" placeholder="Contoh : Jakarta">
						</div>
						</div>
					</div>
					<h6><a href="#" class="btn btn-xs btn-success" id="addScnt_education"><i class="fa fa-plus"></i><b> Tambah Baris</b></a></h6>
					<span>*) Wajib Diisi</span>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success">Simpan</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
				</form>		
			</div>
		</div>
	</div>

	<div class="modal fade" id="addWorkshop<?php echo $pegawai['employee_id']; ?>" role="dialog" style="display: none;">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">×</button>
					<h4 class="modal-title">Tambah Riwayat Seminar &amp; Pelatihan</h4>
				</div>
				
				<form action="<?php echo site_url('manage/pegawai/add_workshop') ?>" method="post" accept-charset="utf-8">
				<div class="modal-body">
					<input type="hidden" class="form-control" required="" name="employee_id" value="<?php echo $pegawai['employee_id']; ?>">
					<div id="p_scents_workshop">
						<div class="row">
						<div class="col-md-3">
							<label>Tanggal Mulai *</label>
								<input class="form-control" required="" type="date" name="start_date[]" placeholder="YYYY/MM/DD">
						</div>
						<div class="col-md-3">
							<label>Tanggal Selesai *</label>
								<input class="form-control" required="" type="date" name="end_date[]" placeholder="Tanggal Selesai">
						</div>
						<div class="col-md-3">
							<label>Penyelenggara *</label>
							<input type="text" class="form-control" required="" name="penyelenggara[]" placeholder="Penyelenggara Workshop">
						</div>
						<div class="col-md-3">
							<label>Lokasi *</label>
							<input type="text" required="" name="lokasi[]" class="form-control" placeholder="Contoh : Jakarta">
						</div>
						</div>
					</div>
					<h6><a href="#" class="btn btn-xs btn-success" id="addScnt_workshop"><i class="fa fa-plus"></i><b> Tambah Baris</b></a></h6>
					<span>*) Wajib Diisi</span>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success">Simpan</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
				</form>		</div>
		</div>
	</div>

	<div class="modal fade" id="addFamily<?php echo $pegawai['employee_id']; ?>" role="dialog" style="display: none;">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">×</button>
					<h4 class="modal-title">Tambah Data Keluarga</h4>
				</div>
				<form action="<?php echo site_url('manage/pegawai/add_family') ?>" method="post" accept-charset="utf-8">
				<div class="modal-body">
					<input type="hidden" class="form-control" required="" name="employee_id" value="<?php echo $pegawai['employee_id']; ?>">
					<div id="p_scents_family">
						<div class="row">
						<div class="col-md-6">
							<label>Nama Anggota Keluarga *</label>
								<input class="form-control" required="" type="text" name="fam_name[]" placeholder="Masukkan Nama Anggota Kelurga">
						</div>
						<div class="col-md-4">
							<label>Hubungan *</label>
								<select class="form-control" required="" name="fam_desc[]">
									<option value="">-Pilih Hubungan-</option>
									<option value="istri">Istri</option>
									<option value="suami">Suami</option>
									<option value="anak">Anak</option>
									<option value="ayah">Ayah</option>
									<option value="ibu">Ibu</option>
									<option value="lainnya">Lainnya</option>
								</select>
						</div>
						</div>
					</div>
					<h6><a href="#" class="btn btn-xs btn-success" id="addScnt_family"><i class="fa fa-plus"></i><b> Tambah Baris</b></a></h6>
					<span>*) Wajib Diisi</span>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success">Simpan</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
				</form>		</div>
		</div>
	</div>

	<div class="modal fade" id="addPosition<?php echo $pegawai['employee_id']; ?>" role="dialog" style="display: none;">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">×</button>
					<h4 class="modal-title">Tambah Riwayat Jabatan</h4>
				</div>
				<form action="<?php echo site_url('manage/pegawai/add_position') ?>" method="post" accept-charset="utf-8">
				<div class="modal-body">
					<input type="hidden" class="form-control" required="" name="employee_id" value="<?php echo $pegawai['employee_id']; ?>">
					<div id="p_scents_position">
						<div class="row">
						<div class="col-md-4">
							<label>Tahun Mulai *</label>
								<input class="form-control" required="" type="date" name="position_start[]" placeholder="Masukkan Tahun Mulai">
						</div>
						<div class="col-md-4">
							<label>Tahun Selesai *</label>
								<input class="form-control" required="" type="date" name="position_end[]" placeholder="Masukkan Tahun Selesai">
						</div>
						<div class="col-md-4">
							<label>Keterangan *</label>
								<input class="form-control" required="" type="text" name="position_desc[]" placeholder="Masukkan Keterangan">
						</div>
						</div>
					</div>
					<h6><a href="#" class="btn btn-xs btn-success" id="addScnt_position"><i class="fa fa-plus"></i><b> Tambah Baris</b></a></h6>
					<span>*) Wajib Diisi</span>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success">Simpan</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
				</form>		</div>
		</div>
	</div>

	<div class="modal fade" id="addTeaching<?php echo $pegawai['employee_id']; ?>" role="dialog" style="display: none;">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">×</button>
					<h4 class="modal-title">Tambah Riwayat Mengajar</h4>
				</div>
				<form action="<?php echo site_url('manage/pegawai/add_teaching') ?>" method="post" accept-charset="utf-8">
				<div class="modal-body">
					<input type="hidden" class="form-control" required="" name="employee_id" value="<?php echo $pegawai['employee_id']; ?>">
					<div id="p_scents_teaching">
						<div class="row">
						<div class="col-md-3">
							<label>Tahun Mulai *</label>
								<input class="form-control" required="" type="date" name="teaching_start[]" placeholder="Masukkan Tahun Mulai">
						</div>
						<div class="col-md-3">
							<label>Tahun Selesai *</label>
								<input class="form-control" required="" type="date" name="teaching_end[]" placeholder="Masukkan Tahun Selesai">
						</div>
						<div class="col-md-3">
							<label>Mata Pelajaran *</label>
								<input class="form-control" required="" type="text" name="teaching_lesson[]" placeholder="Masukkan Mata Pelajaran">
						</div>
						<div class="col-md-3">
							<label>Keterangan *</label>
								<input class="form-control" required="" type="text" name="teaching_desc[]" placeholder="Masukkan Keterangan">
						</div>
						</div>
					</div>
					<h6><a href="#" class="btn btn-xs btn-success" id="addScnt_teaching"><i class="fa fa-plus"></i><b> Tambah Baris</b></a></h6>
					<span>*) Wajib Diisi</span>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success">Simpan</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
				</form>		</div>
		</div>
	</div>

	<div class="modal fade" id="addAchievement<?php echo $pegawai['employee_id']; ?>" role="dialog" style="display: none;">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">×</button>
					<h4 class="modal-title">Tambah Data Penghargaan</h4>
				</div>
				<form action="<?php echo site_url('manage/pegawai/add_achievement') ?>" method="post" accept-charset="utf-8">
				<div class="modal-body">
					<input type="hidden" class="form-control" required="" name="employee_id" value="<?php echo $pegawai['employee_id']; ?>">
					<div id="p_scents_achievement">
						<div class="row">
						<div class="col-md-4">
							<label>Tahun *</label>
								<input class="form-control" required="" type="text" name="achievement_year[]" placeholder="Masukkan Tahun">
						</div>
						<div class="col-md-6">
							<label>Nama Penghargaan *</label>
								<input class="form-control" required="" type="text" name="achievement_name[]" placeholder="Masukkan Nama Penghargaan">
						</div>
						</div>
					</div>
					<h6><a href="#" class="btn btn-xs btn-success" id="addScnt_achievement"><i class="fa fa-plus"></i><b> Tambah Baris</b></a></h6>
					<span>*) Wajib Diisi</span>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success">Simpan</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
				</form>		</div>
		</div>
	</div>

	<div class="modal modal-default fade" id="delModal<?php echo $pegawai['employee_id']; ?>">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span></button>
						<h3 class="modal-title"><span class="fa fa-warning"></span> Konfirmasi penghapusan</h3>
					</button>
				</div>
				<div class="modal-body">
					<p>Apakah anda yakin akan menghapus data ini?</p>
				</div>
				<div class="modal-footer">
					<?php echo form_open('manage/pegawai/delete/' . $pegawai['employee_id']); ?>
					<input type="hidden" name="delName" value="<?php echo $pegawai['employee_name']; ?>">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal"><span class="fa fa-close"></span> Batal</button>
					<button type="submit" class="btn btn-danger"><span class="fa fa-check"></span> Hapus</button>
					<?php echo form_close(); ?>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>		<!-- /.modal-dialog -->


<script type="text/javascript">
	$(function() {
		var scntEdu = $('#p_scents_education');
		var a = $('#p_scents_education .row').length + 1;
		$("#addScnt_education").click(function() {
			$('<div class="row"><div class="col-md-3"><label>Tahun Masuk *</label><input type="text" class="form-control" required="" name="thn_masuk[]" class="form-control" placeholder="Contoh : 2010"><a href="#" class="btn btn-xs btn-danger remScnt_education">Hapus Baris</a></div><div class="col-md-3"><label>Tahun Lulus *</label><input type="text" class="form-control" required="" name="thn_lulus[]" class="form-control" placeholder="Contoh : 2014"></div><div class="col-md-3"><label>Sekolah/Universitas *</label><input type="text" class="form-control" required="" name="sekolah[]" class="form-control" placeholder="Sekolah/Universitas"></div><div class="col-md-3"><label>Lokasi *</label><input type="text" required="" name="lokasi[]" class="form-control" placeholder="Contoh : Jakarta"></div></div>').appendTo(scntEdu);
			a++;
			return false;
		});

		$(document).on("click", ".remScnt_education", function() {
			if (a > 2) {
				$(this).parents('.row').remove();
				a--;
			}
			return false;
		});
		
		var scntWork = $('#p_scents_workshop');
		var b = $('#p_scents_workshop .row').length + 1;
		$("#addScnt_workshop").click(function() {
			$('<div class="row"><div class="col-md-3"><label>Tanggal Mulai *</label><input class="form-control" required="" type="date" name="start_date[]" placeholder="Tanggal Mulai"><a href="#" class="btn btn-xs btn-danger remScnt_workshop">Hapus Baris</a></div><div class="col-md-3"><label>Tanggal Selesai *</label><input class="form-control" required="" type="date" name="end_date[]" placeholder="Tanggal Selesai"></div><div class="col-md-3"><label>Penyelenggara *</label><input type="text" class="form-control" required="" name="penyelenggara[]" class="form-control" placeholder="Penyelenggara Workshop"></div><div class="col-md-3"><label>Lokasi *</label><input type="text" required="" name="lokasi[]" class="form-control" placeholder="Contoh : Jakarta"></div></div>').appendTo(scntWork);
			b++;
			return false;
		});

		$(document).on("click", ".remScnt_workshop", function() {
			if (b > 2) {
				$(this).parents('.row').remove();
				b--;
			}
			return false;
		});
		
		var scntFam = $('#p_scents_family');
		var c = $('#p_scents_family .row').length + 1;
		$("#addScnt_family").click(function() {
			$('<div class="row"><div class="col-md-6"><label>Nama Anggota Keluarga *</label><input class="form-control" required="" type="text" name="fam_name[]" placeholder="Masukkan Nama Anggota Kelurga"><a href="#" class="btn btn-xs btn-danger remScnt_family">Hapus Baris</a></div><div class="col-md-4"><label>Hubungan *</label><select class="form-control" required="" name="fam_desc[]"><option value="">-Pilih Hubungan-</option><option value="1">Istri</option><option value="2">Suami</option><option value="3">Anak</option><option value="4">Ayah</option><option value="5">Ibu</option><option value="6">Lainnya</option></select></div></div>').appendTo(scntFam);
			c++;
			return false;
		});

		$(document).on("click", ".remScnt_family", function() {
			if (c > 2) {
				$(this).parents('.row').remove();
				c--;
			}
			return false;
		});
		
		var scntPos = $('#p_scents_position');
		var d = $('#p_scents_position .row').length + 1;
		$("#addScnt_position").click(function() {
			$('<div class="row"><div class="col-md-4"><label>Tahun Mulai *</label><input class="form-control" required="" type="date" name="position_start[]" placeholder="Masukkan Tahun Mulai"><a href="#" class="btn btn-xs btn-danger remScnt_position">Hapus Baris</a></div><div class="col-md-4"><label>Tahun Selesai *</label><input class="form-control" required="" type="date" name="position_end[]" placeholder="Masukkan Tahun Selesai"></div><div class="col-md-4"><label>Keterangan *</label><input class="form-control" required="" type="text" name="position_desc[]" placeholder="Masukkan Keterangan"></div></div>').appendTo(scntPos);
			d++;
			return false;
		});

		$(document).on("click", ".remScnt_position", function() {
			if (d > 2) {
				$(this).parents('.row').remove();
				d--;
			}
			return false;
		});
		
		var scntTeach = $('#p_scents_teaching');
		var e = $('#p_scents_teaching .row').length + 1;
		$("#addScnt_teaching").click(function() {
			$('<div class="row"><div class="col-md-3"><label>Tahun Mulai *</label><input class="form-control" required="" type="date" name="teaching_start[]" placeholder="Masukkan Tahun Mulai"><a href="#" class="btn btn-xs btn-danger remScnt_teaching">Hapus Baris</a></div><div class="col-md-3"><label>Tahun Selesai *</label><input class="form-control" required="" type="date" name="teaching_end[]" placeholder="Masukkan Tahun Selesai"></div><div class="col-md-3"><label>Mata Pelajaran *</label><input class="form-control" required="" type="text" name="teaching_lesson[]" placeholder="Masukkan Mata Pelajaran"></div><div class="col-md-3"><label>Keterangan *</label><input class="form-control" required="" type="text" name="teaching_desc[]" placeholder="Masukkan Keterangan"></div></div>').appendTo(scntTeach);
			e++;
			return false;
		});

		$(document).on("click", ".remScnt_teaching", function() {
			if (e > 2) {
				$(this).parents('.row').remove();
				e--;
			}
			return false;
		});
		
		var scntAchievement = $('#p_scents_achievement');
		var f = $('#p_scents_achievement .row').length + 1;
		$("#addScnt_achievement").click(function() {
			$('<div class="row"><div class="col-md-4"><label>Tahun *</label><input class="form-control" required="" type="text" name="achievement_year[]" placeholder="Masukkan Tahun"><a href="#" class="btn btn-xs btn-danger remScnt_achievement">Hapus Baris</a></div><div class="col-md-6"><label>Nama Penghargaan *</label><input class="form-control" required="" type="text" name="achievement_name[]" placeholder="Masukkan Nama Penghargaan"></div></div>').appendTo(scntAchievement);
			f++;
			return false;
		});

		$(document).on("click", ".remScnt_achievement", function() {
			if (f > 2) {
				$(this).parents('.row').remove();
				f--;
			}
			return false;
		});
		
	});
</script>