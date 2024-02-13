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
	<section class="content">
		<div class="row"> 
			<div class="col-md-12">
				<div class="box box-info">
					<div class="card-header with-border">
						<h3 class="box-title">Filter Data Pembayaran Siswa</h3>
					</div><!-- /.box-header -->
					<div class="card-body">
						<?php echo form_open(current_url(), array('class' => 'form-horizontal', 'method' => 'get')) ?>
							<div class="form-group">						
								<label for="" class="col-sm-2 control-label">Tahun Pelajaran</label>
								<div class="col-sm-2">
									<select class="form-control" name="n" id="th_ajar">
										<?php foreach ($period as $row): ?>
											<option <?php echo (isset($f['n']) AND $f['n'] == $row['period_id']) ? 'selected' : '' ?> value="<?php echo $row['period_id'] ?>"><?php echo $row['period_start'].'/'.$row['period_end'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<label for="" class="col-sm-2 control-label">NIS Siswa</label>
								<div class="col-sm-3">
									<div class="input-group">
										<input type="text" class="form-control" autofocus name="r" <?php echo (isset($f['r'])) ? 'placeholder="'.$f['r'].'"' : 'placeholder="Masukan NIS Siswa"' ?> required>
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
											<button type="button" class="btn btn-default" data-toggle="modal" data-target="#dataSiswa"><b>Data Siswa</b></button>
										</span>
									</div>
								</div>
							</div>
						</form>
					</div><!-- /.box-body -->
				</div><!-- /.box -->
				<?php if ($f) { ?>
					<div class="box box-success">
						<div class="card-header with-border">
							<h3 class="box-title">Informasi Siswa</h3>
							<?php if ($f['n'] AND $f['r'] != NULL) { ?>
								<a href="<?php echo site_url('manage/payout/printBill' . '/?' . http_build_query($f)) ?>" target="_blank" class="btn btn-danger btn-xs pull-right">Cetak Semua Tagihan</a>
							<?php } ?>
						</div><!-- /.box-header -->
						<div class="card-body">
							<div class="col-md-9">
								<table class="table table-striped">
									<tbody>
										<tr>
											<td width="200">Tahun Ajaran</td><td width="4">:</td>
											<?php foreach ($period as $row): ?>
												<?php echo (isset($f['n']) AND $f['n'] == $row['period_id']) ? 
												'<td><strong>'.$row['period_start'].'/'.$row['period_start'].'<strong></td>' : '' ?> 
											<?php endforeach; ?>
										</tr>
										<tr>
											<td>NIS</td>
											<td>:</td>
											<?php foreach ($siswa as $row): ?>
												<?php echo (isset($f['n']) AND $f['r'] == $row['student_nis']) ? 
												'<td>'.$row['student_nis'].'</td>' : '' ?> 
											<?php endforeach; ?>
										</tr>
										<tr>
											<td>Nama Siswa</td>
											<td>:</td>
											<?php foreach ($siswa as $row): ?>
												<?php echo (isset($f['n']) AND $f['r'] == $row['student_nis']) ? 
												'<td>'.$row['student_full_name'].'</td>' : '' ?> 
											<?php endforeach; ?>
										</tr>
										<tr>
											<td>Nama Ibu Kandung</td>
											<td>:</td>
											<?php foreach ($siswa as $row): ?>
												<?php echo (isset($f['n']) AND $f['r'] == $row['student_nis']) ?  
												'<td>'.$row['student_name_of_mother'].'</td>' : '' ?> 
											<?php endforeach; ?>
										</tr>
										<tr>
											<td>Kelas</td>
											<td>:</td>
											<?php foreach ($siswa as $row): ?>
												<?php echo (isset($f['n']) AND $f['r'] == $row['student_nis']) ? 
												'<td>'.$row['class_name'].'</td>' : '' ?> 
											<?php endforeach; ?>
										</tr>
										<?php if (majors() == 'senior') { ?>
											<tr>
												<td>Program Keahlian</td>
												<td>:</td>
												<?php foreach ($siswa as $row): ?>
													<?php echo (isset($f['n']) AND $f['r'] == $row['student_nis']) ? 
													'<td>'.$row['majors_name'].'</td>' : '' ?> 
												<?php endforeach; ?>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
							<div class="col-md-3">
								<?php foreach ($siswa as $row): ?>
									<?php if (isset($f['n']) AND $f['r'] == $row['student_nis']) { ?> 
										<?php if (!empty($row['student_img'])) { ?>
											<img src="<?php echo upload_url('student/'.$row['student_img']) ?>" class="img-thumbnail img-responsive">
										<?php } else { ?>
											<img src="<?php echo media_url('img/user.png') ?>" class="img-thumbnail img-responsive">
										<?php } 
									} ?>
								<?php endforeach; ?>
							</div>
						</div>
					</div>

					<div class="row">

						<div class="col-md-5">
							<div class="box box-primary">
								<div class="card-header with-border">
									<h3 class="box-title">Transaksi Terakhir</h3>
								</div><!-- /.box-header -->
								<div class="card-body">
									<table class="table table-responsive table-bordered" style="white-space: nowrap;">
										<tr class="info">
											<th>Pembayaran</th>
											<th>Tagihan</th>
											<th>Tanggal</th>
										</tr>
										<?php 
										foreach ($log as $key) :
										?>
										<tr>
											<td><?php echo ($key['bulan_bulan_id']!= NULL) ? $key['posmonth_name'].' - T.A '.$key['period_start_month'].'/'.$key['period_end_month'].' ('.$key['month_name'].')' : $key['posbebas_name'].' - T.A '.$key['period_start_bebas'].'/'.$key['period_end_bebas'] ?></td>
											<td><?php echo ($key['bulan_bulan_id']!= NULL) ? 'Rp. '. number_format($key['bulan_bill'], 0, ',', '.') : 'Rp. '. number_format($key['bebas_pay_bill'], 0, ',', '.') ?></td>
											<td><?php echo pretty_date($key['log_trx_input_date'],'d F Y',false)  ?></td>
										</tr>
									<?php endforeach ?>

									</table>
								</div>
							</div>
						</div>
						
						<div class="col-md-4">
							<div class="box box-primary">
								<div class="card-header with-border">
									<h3 class="box-title">Pembayaran</h3>
								</div>
								<div class="card-body">
									<form id="calcu" name="calcu" method="post" action="">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Total</label>
													<input type="text" class="form-control numeric" value="<?php echo $cash+$cashb ?>" name="harga" id="harga" placeholder="Total Pembayaran" onfocus="startCalculate()" onblur="stopCalc()">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Dibayar</label>
													<input type="text" class="form-control numeric" value="<?php echo $cash+$cashb ?>" name="bayar" id="bayar" placeholder="Jumlah Uang" onfocus="startCalculate()" onblur="stopCalc()">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label>Kembalian</label>
											<input type="text" class="form-control numeric" readonly="" name="kembalian" id="kembalian" onblur="stopCalc()">
										</div>
									</form>
								</div>
							</div>
						</div>

						<div class="col-md-3">
							<div class="box box-primary">
								<div class="card-header with-border">
									<h3 class="box-title">Cetak Bukti Pembayaran</h3>
								</div><!-- /.box-header -->
								<div class="card-body">
									<form action="<?php echo site_url('manage/payout/cetakBukti') ?>" method="GET" class="view-pdf">
										<input type="hidden" name="n" value="<?php echo $f['n'] ?>">
										<input type="hidden" name="r" value="<?php echo $f['r'] ?>">
										<div class="form-group">
											<label>Tanggal Transaksi</label>
											<div class="input-group" data-date="<?php echo date('Y-m-d') ?>" data-date-format="yyyy-mm-dd">
												
												<input class="form-control" readonly="" required="" type="text" name="d" value="<?php echo date('Y-m-d') ?>">
											</div>
										</div>
										<button class="btn btn-success btn-block" formtarget="_blank" type="submit">Cetak</button>
									</form>
								</div>
							</div>
						</div>

					</div>


					<!-- List Tagihan Bulanan --> 
					<div class="box box-primary">
						<div class="card-header with-border">
							<h3 class="box-title">Jenis Pembayaran</h3>
						</div><!-- /.box-header -->
						<div class="card-body">
							<div class="nav-tabs-custom">
								<ul class="nav nav-tabs">
									<li class="active"><a href="#tab_1" data-toggle="tab">Bulanan</a></li>
									<li><a href="#tab_2" data-toggle="tab">Bebas</a></li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="tab_1">
										<div class="card-body table-responsive">
											<table class="table table-bordered" style="white-space: nowrap;">
												<thead>
													<tr class="info">
														<th>No.</th>
														<th>Nama Pembayaran</th>
														<th>Sisa Tagihan</th>
														<th>Juli</th>
														<th>Agustus</th>
														<th>September</th>
														<th>Oktober</th>
														<th>November</th>
														<th>Desember</th>
														<th>Januari</th>
														<th>Februari</th>
														<th>Maret</th>
														<th>April</th>
														<th>Mei</th>
														<th>Juni</th>
														<!--
														<//?php foreach ($bulan as $key) : ?>
															<th><//?php echo $key['month_name'] ?></th>
														<//?php endforeach ?>
														-->
													</tr>
												</thead>
												<tbody>
													<?php
													$i =1;
													foreach ($student as $row):
														if ($f['n'] AND $f['r'] == $row['student_nis']) {
															?>													
															<tr>
																<td><?php echo $i ?> <?php echo $row['payment_payment_id'] ?> </td>
																<td><?php echo $row['pos_name'].' - T.A '.$row['period_start'].'/'.$row['period_end'] ?></td>
																<td>																	
																	<?php
																		$semua = 0;
																		$dibayar = 0;
																		foreach ($bulan as $key) {
																			if ($key['payment_payment_id'] == $row['payment_payment_id']) {																				
																				$semua += $key['bulan_bill'];																					
																				if ($key['bulan_status'] == 1) {
																					$dibayar += $key['bulan_bill'];
																				}
																			}
																		}
																		$jumlah = $semua - $dibayar;
																	?>
																	<?php echo 'Rp. '.number_format($jumlah,0,',','.') ?>
																</td>																
																
																	<?php foreach ($bulan as $key) : ?>
																		<?php if ($key['month_month_id'] == 1 && $key['payment_payment_id'] == $row['payment_payment_id']) { ?>
																			<td class="<?php echo ($key['bulan_status'] ==1) ? 'success' : 'danger' ?>" style=" <?php echo ($key['bulan_bill'] ==0) ? 'background-color: #f5f5f5!important;' : '' ?>">
																				<a data-toggle="<?php echo ($key['bulan_bill'] ==0) ? 'none' : 'modal' ?>" data-target="#<?php echo $row['pos_name']. $key['month_name'] ?>">																				
																					<?php echo ($key['bulan_status']==1) 
																					? number_format($key['bulan_bill'], 0, ',', '.') . '<br>' . '('.pretty_date($key['bulan_date_pay'],'d/m/y',false).')'																		
																					: number_format($key['bulan_bill'], 0, ',', '.')
																					?>
																				</a>
																				<div class="modal fade" id="<?php echo $row['pos_name']. $key['month_name'] ?>" role="dialog">
																					<div class="modal-dialog modal-sm">
																						<div class="modal-content">
																							<div class="modal-header">
																								<button type="button" class="close" data-dismiss="modal">×</button>
																								<h4 class="modal-title"><?php echo ($key['bulan_status'] ==1) ? 'Batalkan' : 'Pembayaran' ?> <?php echo $row['pos_name'] ?> Bulan <?php echo $key['month_name'] ?></h4>
																							</div>
																							<form action="<?php echo ($key['bulan_status'] ==0) ? site_url('manage/payout/pay') : site_url('manage/payout/not_pay') ?>" method="post" accept-charset="utf-8">
																								<div class="modal-body">
																									<input class="form-control" required="" type="hidden" name="student_id" value="<?php echo $row['student_student_id'] ?>">
																									<input class="form-control" required="" type="hidden" name="student_nis" value="<?php echo $row['student_nis'] ?>">
																									<input class="form-control" required="" type="hidden" name="bulan_id" value="<?php echo $key['month_month_id'] ?>">
																									<input class="form-control" required="" type="hidden" name="payment_id" value="<?php echo $key['payment_payment_id'] ?>">
																									<input class="form-control" required="" type="hidden" name="payout_id" value="<?php echo $key['bulan_id'] ?>">
																									
																								<?php if ($key['bulan_status'] == 0) { ?>
																									<div class="form-group">
																										<label>Tanggal</label>
																										<div class="input-group" data-date="" data-date-format="yyyy-mm-dd">
																											
																											<input class="form-control" required="" type="date" name="payout_date" placeholder="Tanggal Bayar" value="<?php echo $key['bulan_date_pay'] ?>">
																										</div>
																									</div>
																									<div class="form-group">
																										<label>Jumlah Bayar</label>
																										<input class="form-control" readonly="" type="text" name="payout_value" placeholder="Jumlah Bayar" value="<?php echo $key['bulan_bill'] ?>">
																									</div>																									
																								<?php }  ?>
																								</div>
																								<div class="modal-footer">																																														<button type="submit" class="btn btn-success">Simpan</button>
																									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																								</div>
																							</form>                    				
																						</div>
																					</div>
																				</div>
																			</td>
																		<?php }  ?>
																	<?php endforeach ?>
																
																
																	<?php foreach ($bulan as $key) : ?>
																		<?php if ($key['month_month_id'] == 2   && $key['payment_payment_id'] == $row['payment_payment_id']) { ?>
																			<td class="<?php echo ($key['bulan_status'] ==1) ? 'success' : 'danger' ?>" style=" <?php echo ($key['bulan_bill'] ==0) ? 'background-color: #f5f5f5!important;' : '' ?>">
																			
																				<a data-toggle="<?php echo ($key['bulan_bill'] ==0) ? 'none' : 'modal' ?>" data-target="#<?php echo $row['pos_name'].$key['month_name'] ?>">
																					<?php echo ($key['bulan_status']==1) 
																					? number_format($key['bulan_bill'], 0, ',', '.') . '<br>' . '('.pretty_date($key['bulan_date_pay'],'d/m/y',false).')'																		
																					: number_format($key['bulan_bill'], 0, ',', '.')
																					?>
																				</a>
																				<div class="modal fade" id="<?php echo $row['pos_name']. $key['month_name'] ?>" role="dialog">
																					<div class="modal-dialog modal-sm">
																						<div class="modal-content">
																							<div class="modal-header">
																								<button type="button" class="close" data-dismiss="modal">×</button>
																								<h4 class="modal-title"><?php echo ($key['bulan_status'] ==1) ? 'Batalkan' : 'Pembayaran' ?> <?php echo $row['pos_name'] ?> Bulan <?php echo $key['month_name'] ?></h4>
																							</div>
																							<form action="<?php echo ($key['bulan_status'] ==0) ? site_url('manage/payout/pay') : site_url('manage/payout/not_pay') ?>" method="post" accept-charset="utf-8">
																								<div class="modal-body">
																									<input class="form-control" required="" type="hidden" name="student_id" value="<?php echo $row['student_student_id'] ?>">
																									<input class="form-control" required="" type="hidden" name="student_nis" value="<?php echo $row['student_nis'] ?>">
																									<input class="form-control" required="" type="hidden" name="bulan_id" value="<?php echo $key['month_month_id'] ?>">
																									<input class="form-control" required="" type="hidden" name="payment_id" value="<?php echo $key['payment_payment_id'] ?>">
																									<input class="form-control" required="" type="hidden" name="payout_id" value="<?php echo $key['bulan_id'] ?>">
																									
																								<?php if ($key['bulan_status'] == 0) { ?>
																									<div class="form-group">
																										<label>Tanggal</label>
																										<div class="input-group" data-date="" data-date-format="yyyy-mm-dd">
																											
																											<input class="form-control" required="" type="date" name="payout_date" placeholder="Tanggal Bayar" value="<?php echo $key['bulan_date_pay'] ?>">
																										</div>
																									</div>
																									<div class="form-group">
																										<label>Jumlah Bayar</label>
																										<input class="form-control" readonly="" type="text" name="payout_value" placeholder="Jumlah Bayar" value="<?php echo $key['bulan_bill'] ?>">
																									</div>
																																																	
																								<?php }  ?>
																								</div>
																								<div class="modal-footer">																																														<button type="submit" class="btn btn-success">Simpan</button>
																									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																								</div>
																							</form>                    				
																						</div>
																					</div>
																				</div>
																			</td>
																		<?php }  ?>
																	<?php endforeach ?>
																
																
																	<?php foreach ($bulan as $key) : ?>
																		<?php if ($key['month_month_id'] == 3   && $key['payment_payment_id'] == $row['payment_payment_id']) { ?>
																			<td class="<?php echo ($key['bulan_status'] ==1) ? 'success' : 'danger' ?>" style=" <?php echo ($key['bulan_bill'] ==0) ? 'background-color: #f5f5f5!important;' : '' ?>">
																				
																				<a data-toggle="<?php echo ($key['bulan_bill'] ==0) ? 'none' : 'modal' ?>" data-target="#<?php echo $row['pos_name'].$key['month_name'] ?>">
																					<?php echo ($key['bulan_status']==1) 
																					? number_format($key['bulan_bill'], 0, ',', '.') . '<br>' . '('.pretty_date($key['bulan_date_pay'],'d/m/y',false).')'																		
																					: number_format($key['bulan_bill'], 0, ',', '.')
																					?>
																				</a>
																				<div class="modal fade" id="<?php echo $row['pos_name']. $key['month_name'] ?>" role="dialog">
																					<div class="modal-dialog modal-sm">
																						<div class="modal-content">
																							<div class="modal-header">
																								<button type="button" class="close" data-dismiss="modal">×</button>
																								<h4 class="modal-title"><?php echo ($key['bulan_status'] ==1) ? 'Batalkan' : 'Pembayaran' ?> <?php echo $row['pos_name'] ?> Bulan <?php echo $key['month_name'] ?></h4>
																							</div>
																							<form action="<?php echo ($key['bulan_status'] ==0) ? site_url('manage/payout/pay') : site_url('manage/payout/not_pay') ?>" method="post" accept-charset="utf-8">
																								<div class="modal-body">
																									<input class="form-control" required="" type="hidden" name="student_id" value="<?php echo $row['student_student_id'] ?>">
																									<input class="form-control" required="" type="hidden" name="student_nis" value="<?php echo $row['student_nis'] ?>">
																									<input class="form-control" required="" type="hidden" name="bulan_id" value="<?php echo $key['month_month_id'] ?>">
																									<input class="form-control" required="" type="hidden" name="payment_id" value="<?php echo $key['payment_payment_id'] ?>">
																									<input class="form-control" required="" type="hidden" name="payout_id" value="<?php echo $key['bulan_id'] ?>">
																									
																								<?php if ($key['bulan_status'] == 0) { ?>
																									<div class="form-group">
																										<label>Tanggal</label>
																										<div class="input-group" data-date="" data-date-format="yyyy-mm-dd">
																											
																											<input class="form-control" required="" type="date" name="payout_date" placeholder="Tanggal Bayar" value="<?php echo $key['bulan_date_pay'] ?>">
																										</div>
																									</div>
																									<div class="form-group">
																										<label>Jumlah Bayar</label>
																										<input class="form-control" readonly="" type="text" name="payout_value" placeholder="Jumlah Bayar" value="<?php echo $key['bulan_bill'] ?>">
																									</div>
																																															
																								<?php }  ?>
																								</div>
																								<div class="modal-footer">																																														<button type="submit" class="btn btn-success">Simpan</button>
																									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																								</div>
																							</form>                    				
																						</div>
																					</div>
																				</div>
																			</td>
																		<?php }  ?>
																	<?php endforeach ?>

																
																
																	<?php foreach ($bulan as $key) : ?>
																		<?php if ($key['month_month_id'] == 4   && $key['payment_payment_id'] == $row['payment_payment_id']) { ?>
																			<td class="<?php echo ($key['bulan_status'] ==1) ? 'success' : 'danger' ?>" style=" <?php echo ($key['bulan_bill'] ==0) ? 'background-color: #f5f5f5!important;' : '' ?>">
																				
																				<a data-toggle="<?php echo ($key['bulan_bill'] ==0) ? 'none' : 'modal' ?>" data-target="#<?php echo $row['pos_name'].$key['month_name'] ?>">
																					<?php echo ($key['bulan_status']==1) 
																					? number_format($key['bulan_bill'], 0, ',', '.') . '<br>' . '('.pretty_date($key['bulan_date_pay'],'d/m/y',false).')'																		
																					: number_format($key['bulan_bill'], 0, ',', '.')
																					?>
																				</a>
																				<div class="modal fade" id="<?php echo $row['pos_name']. $key['month_name'] ?>" role="dialog">
																					<div class="modal-dialog modal-sm">
																						<div class="modal-content">
																							<div class="modal-header">
																								<button type="button" class="close" data-dismiss="modal">×</button>
																								<h4 class="modal-title"><?php echo ($key['bulan_status'] ==1) ? 'Batalkan' : 'Pembayaran' ?> <?php echo $row['pos_name'] ?> Bulan <?php echo $key['month_name'] ?></h4>
																							</div>
																							<form action="<?php echo ($key['bulan_status'] ==0) ? site_url('manage/payout/pay') : site_url('manage/payout/not_pay') ?>" method="post" accept-charset="utf-8">
																								<div class="modal-body">
																									<input class="form-control" required="" type="hidden" name="student_id" value="<?php echo $row['student_student_id'] ?>">
																									<input class="form-control" required="" type="hidden" name="student_nis" value="<?php echo $row['student_nis'] ?>">
																									<input class="form-control" required="" type="hidden" name="bulan_id" value="<?php echo $key['month_month_id'] ?>">
																									<input class="form-control" required="" type="hidden" name="payment_id" value="<?php echo $key['payment_payment_id'] ?>">
																									<input class="form-control" required="" type="hidden" name="payout_id" value="<?php echo $key['bulan_id'] ?>">
																									
																								<?php if ($key['bulan_status'] == 0) { ?>
																									<div class="form-group">
																										<label>Tanggal</label>
																										<div class="input-group" data-date="" data-date-format="yyyy-mm-dd">
																											
																											<input class="form-control" required="" type="date" name="payout_date"  placeholder="Tanggal Bayar" value="<?php echo $key['bulan_date_pay'] ?>">
																										</div>
																									</div>
																									<div class="form-group">
																										<label>Jumlah Bayar</label>
																										<input class="form-control" readonly="" type="text" name="payout_value" placeholder="Jumlah Bayar" value="<?php echo $key['bulan_bill'] ?>">
																									</div>
																																												
																								<?php }  ?>
																								</div>
																								<div class="modal-footer">																																														<button type="submit" class="btn btn-success">Simpan</button>
																									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																								</div>
																							</form>                    				
																						</div>
																					</div>
																				</div>
																			</td>
																		<?php }  ?>
																	<?php endforeach ?>
																
																
																
																	<?php foreach ($bulan as $key) : ?>
																		<?php if ($key['month_month_id'] == 5   && $key['payment_payment_id'] == $row['payment_payment_id']) { ?>
																			<td class="<?php echo ($key['bulan_status'] ==1) ? 'success' : 'danger' ?>" style=" <?php echo ($key['bulan_bill'] ==0) ? 'background-color: #f5f5f5!important;' : '' ?>">
																				
																				<a data-toggle="<?php echo ($key['bulan_bill'] ==0) ? 'none' : 'modal' ?>" data-target="#<?php echo $row['pos_name'].$key['month_name'] ?>">
																					<?php echo ($key['bulan_status']==1) 
																					? number_format($key['bulan_bill'], 0, ',', '.') . '<br>' . '('.pretty_date($key['bulan_date_pay'],'d/m/y',false).')'																		
																					: number_format($key['bulan_bill'], 0, ',', '.')
																					?>
																				</a>
																				<div class="modal fade" id="<?php echo $row['pos_name']. $key['month_name'] ?>" role="dialog">
																					<div class="modal-dialog modal-sm">
																						<div class="modal-content">
																							<div class="modal-header">
																								<button type="button" class="close" data-dismiss="modal">×</button>
																								<h4 class="modal-title"><?php echo ($key['bulan_status'] ==1) ? 'Batalkan' : 'Pembayaran' ?> <?php echo $row['pos_name'] ?> Bulan <?php echo $key['month_name'] ?></h4>
																							</div>
																							<form action="<?php echo ($key['bulan_status'] ==0) ? site_url('manage/payout/pay') : site_url('manage/payout/not_pay') ?>" method="post" accept-charset="utf-8">
																								<div class="modal-body">
																									<input class="form-control" required="" type="hidden" name="student_id" value="<?php echo $row['student_student_id'] ?>">
																									<input class="form-control" required="" type="hidden" name="student_nis" value="<?php echo $row['student_nis'] ?>">
																									<input class="form-control" required="" type="hidden" name="bulan_id" value="<?php echo $key['month_month_id'] ?>">
																									<input class="form-control" required="" type="hidden" name="payment_id" value="<?php echo $key['payment_payment_id'] ?>">
																									<input class="form-control" required="" type="hidden" name="payout_id" value="<?php echo $key['bulan_id'] ?>">
																									
																								<?php if ($key['bulan_status'] == 0) { ?>
																									<div class="form-group">
																										<label>Tanggal</label>
																										<div class="input-group" data-date="" data-date-format="yyyy-mm-dd">
																											
																											<input class="form-control" required="" type="date" name="payout_date"  placeholder="Tanggal Bayar" value="<?php echo $key['bulan_date_pay'] ?>">
																										</div>
																									</div>
																									<div class="form-group">
																										<label>Jumlah Bayar</label>
																										<input class="form-control" readonly="" type="text" name="payout_value" placeholder="Jumlah Bayar" value="<?php echo $key['bulan_bill'] ?>">
																									</div>
																																										
																								<?php }  ?>
																								</div>
																								<div class="modal-footer">																																														<button type="submit" class="btn btn-success">Simpan</button>
																									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																								</div>
																							</form>                    				
																						</div>
																					</div>
																				</div>
																			</td>
																		<?php }  ?>
																	<?php endforeach ?>
																
																
																
																	<?php foreach ($bulan as $key) : ?>
																		<?php if ($key['month_month_id'] == 6   && $key['payment_payment_id'] == $row['payment_payment_id']) { ?>
																			<td class="<?php echo ($key['bulan_status'] ==1) ? 'success' : 'danger' ?>" style=" <?php echo ($key['bulan_bill'] ==0) ? 'background-color: #f5f5f5!important;' : '' ?>">
																				
																				<a data-toggle="<?php echo ($key['bulan_bill'] ==0) ? 'none' : 'modal' ?>" data-target="#<?php echo $row['pos_name'].$key['month_name'] ?>">
																					<?php echo ($key['bulan_status']==1) 
																					? number_format($key['bulan_bill'], 0, ',', '.') . '<br>' . '('.pretty_date($key['bulan_date_pay'],'d/m/y',false).')'																		
																					: number_format($key['bulan_bill'], 0, ',', '.')
																					?>
																				</a>
																				<div class="modal fade" id="<?php echo $row['pos_name']. $key['month_name'] ?>" role="dialog">
																					<div class="modal-dialog modal-sm">
																						<div class="modal-content">
																							<div class="modal-header">
																								<button type="button" class="close" data-dismiss="modal">×</button>
																								<h4 class="modal-title"><?php echo ($key['bulan_status'] ==1) ? 'Batalkan' : 'Pembayaran' ?> <?php echo $row['pos_name'] ?> Bulan <?php echo $key['month_name'] ?></h4>
																							</div>
																							<form action="<?php echo ($key['bulan_status'] ==0) ? site_url('manage/payout/pay') : site_url('manage/payout/not_pay') ?>" method="post" accept-charset="utf-8">
																								<div class="modal-body">
																									<input class="form-control" required="" type="hidden" name="student_id" value="<?php echo $row['student_student_id'] ?>">
																									<input class="form-control" required="" type="hidden" name="student_nis" value="<?php echo $row['student_nis'] ?>">
																									<input class="form-control" required="" type="hidden" name="bulan_id" value="<?php echo $key['month_month_id'] ?>">
																									<input class="form-control" required="" type="hidden" name="payment_id" value="<?php echo $key['payment_payment_id'] ?>">
																									<input class="form-control" required="" type="hidden" name="payout_id" value="<?php echo $key['bulan_id'] ?>">
																									
																								<?php if ($key['bulan_status'] == 0) { ?>
																									<div class="form-group">
																										<label>Tanggal</label>
																										<div class="input-group" data-date="" data-date-format="yyyy-mm-dd">
																											
																											<input class="form-control" required="" type="date" name="payout_date"  placeholder="Tanggal Bayar" value="<?php echo $key['bulan_date_pay'] ?>">
																										</div>
																									</div>
																									<div class="form-group">
																										<label>Jumlah Bayar</label>
																										<input class="form-control" readonly="" type="text" name="payout_value" placeholder="Jumlah Bayar" value="<?php echo $key['bulan_bill'] ?>">
																									</div>
																																								
																								<?php }  ?>
																								</div>
																								<div class="modal-footer">																																														<button type="submit" class="btn btn-success">Simpan</button>
																									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																								</div>
																							</form>                    				
																						</div>
																					</div>
																				</div>
																			</td>
																		<?php }  ?>
																	<?php endforeach ?>
																

																
																	<?php foreach ($bulan as $key) : ?>
																		<?php if ($key['month_month_id'] == 7   && $key['payment_payment_id'] == $row['payment_payment_id']) { ?>
																			<td class="<?php echo ($key['bulan_status'] ==1) ? 'success' : 'danger' ?>" style=" <?php echo ($key['bulan_bill'] ==0) ? 'background-color: #f5f5f5!important;' : '' ?>">
																				
																				<a data-toggle="<?php echo ($key['bulan_bill'] ==0) ? 'none' : 'modal' ?>" data-target="#<?php echo $row['pos_name'].$key['month_name'] ?>">
																					<?php echo ($key['bulan_status']==1) 
																					? number_format($key['bulan_bill'], 0, ',', '.') . '<br>' . '('.pretty_date($key['bulan_date_pay'],'d/m/y',false).')'																		
																					: number_format($key['bulan_bill'], 0, ',', '.')
																					?>
																				</a>
																				<div class="modal fade" id="<?php echo $row['pos_name']. $key['month_name'] ?>" role="dialog">
																					<div class="modal-dialog modal-sm">
																						<div class="modal-content">
																							<div class="modal-header">
																								<button type="button" class="close" data-dismiss="modal">×</button>
																								<h4 class="modal-title"><?php echo ($key['bulan_status'] ==1) ? 'Batalkan' : 'Pembayaran' ?> <?php echo $row['pos_name'] ?> Bulan <?php echo $key['month_name'] ?></h4>
																							</div>
																							<form action="<?php echo ($key['bulan_status'] ==0) ? site_url('manage/payout/pay') : site_url('manage/payout/not_pay') ?>" method="post" accept-charset="utf-8">
																								<div class="modal-body">
																									<input class="form-control" required="" type="hidden" name="student_id" value="<?php echo $row['student_student_id'] ?>">
																									<input class="form-control" required="" type="hidden" name="student_nis" value="<?php echo $row['student_nis'] ?>">
																									<input class="form-control" required="" type="hidden" name="bulan_id" value="<?php echo $key['month_month_id'] ?>">
																									<input class="form-control" required="" type="hidden" name="payment_id" value="<?php echo $key['payment_payment_id'] ?>">
																									<input class="form-control" required="" type="hidden" name="payout_id" value="<?php echo $key['bulan_id'] ?>">
																									
																								<?php if ($key['bulan_status'] == 0) { ?>
																									<div class="form-group">
																										<label>Tanggal</label>
																										<div class="input-group" data-date="" data-date-format="yyyy-mm-dd">
																											
																											<input class="form-control" required="" type="date" name="payout_date"  placeholder="Tanggal Bayar" value="<?php echo $key['bulan_date_pay'] ?>">
																										</div>
																									</div>
																									<div class="form-group">
																										<label>Jumlah Bayar</label>
																										<input class="form-control" readonly="" type="text" name="payout_value" placeholder="Jumlah Bayar" value="<?php echo $key['bulan_bill'] ?>">
																									</div>
																																					
																								<?php }  ?>
																								</div>
																								<div class="modal-footer">																																														<button type="submit" class="btn btn-success">Simpan</button>
																									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																								</div>
																							</form>                    				
																						</div>
																					</div>
																				</div>
																			</td>
																		<?php }  ?>
																	<?php endforeach ?>
																

																
																
																	<?php foreach ($bulan as $key) : ?>
																		<?php if ($key['month_month_id'] == 8   && $key['payment_payment_id'] == $row['payment_payment_id']) { ?>
																			<td class="<?php echo ($key['bulan_status'] ==1) ? 'success' : 'danger' ?>" style=" <?php echo ($key['bulan_bill'] ==0) ? 'background-color: #f5f5f5!important;' : '' ?>">
																				
																				<a data-toggle="<?php echo ($key['bulan_bill'] ==0) ? 'none' : 'modal' ?>" data-target="#<?php echo $row['pos_name'].$key['month_name'] ?>">
																					<?php echo ($key['bulan_status']==1) 
																					? number_format($key['bulan_bill'], 0, ',', '.') . '<br>' . '('.pretty_date($key['bulan_date_pay'],'d/m/y',false).')'																		
																					: number_format($key['bulan_bill'], 0, ',', '.')
																					?>
																				</a>
																				<div class="modal fade" id="<?php echo $row['pos_name']. $key['month_name'] ?>" role="dialog">
																					<div class="modal-dialog modal-sm">
																						<div class="modal-content">
																							<div class="modal-header">
																								<button type="button" class="close" data-dismiss="modal">×</button>
																								<h4 class="modal-title"><?php echo ($key['bulan_status'] ==1) ? 'Batalkan' : 'Pembayaran' ?> <?php echo $row['pos_name'] ?> Bulan <?php echo $key['month_name'] ?></h4>
																							</div>
																							<form action="<?php echo ($key['bulan_status'] ==0) ? site_url('manage/payout/pay') : site_url('manage/payout/not_pay') ?>" method="post" accept-charset="utf-8">
																								<div class="modal-body">
																									<input class="form-control" required="" type="hidden" name="student_id" value="<?php echo $row['student_student_id'] ?>">
																									<input class="form-control" required="" type="hidden" name="student_nis" value="<?php echo $row['student_nis'] ?>">
																									<input class="form-control" required="" type="hidden" name="bulan_id" value="<?php echo $key['month_month_id'] ?>">
																									<input class="form-control" required="" type="hidden" name="payment_id" value="<?php echo $key['payment_payment_id'] ?>">
																									<input class="form-control" required="" type="hidden" name="payout_id" value="<?php echo $key['bulan_id'] ?>">
																									
																								<?php if ($key['bulan_status'] == 0) { ?>
																									<div class="form-group">
																										<label>Tanggal</label>
																										<div class="input-group" data-date="" data-date-format="yyyy-mm-dd">
																											
																											<input class="form-control" required="" type="date" name="payout_date"  placeholder="Tanggal Bayar" value="<?php echo $key['bulan_date_pay'] ?>">
																										</div>
																									</div>
																									<div class="form-group">
																										<label>Jumlah Bayar</label>
																										<input class="form-control" readonly="" type="text" name="payout_value" placeholder="Jumlah Bayar" value="<?php echo $key['bulan_bill'] ?>">
																									</div>
																																			
																								<?php }  ?>
																								</div>
																								<div class="modal-footer">																																														<button type="submit" class="btn btn-success">Simpan</button>
																									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																								</div>
																							</form>                    				
																						</div>
																					</div>
																				</div>
																			</td>
																		<?php }  ?>
																	<?php endforeach ?>
																
																
																
																	<?php foreach ($bulan as $key) : ?>
																		<?php if ($key['month_month_id'] == 9   && $key['payment_payment_id'] == $row['payment_payment_id']) { ?>
																			<td class="<?php echo ($key['bulan_status'] ==1) ? 'success' : 'danger' ?>" style=" <?php echo ($key['bulan_bill'] ==0) ? 'background-color: #f5f5f5!important;' : '' ?>">
																				
																				<a data-toggle="<?php echo ($key['bulan_bill'] ==0) ? 'none' : 'modal' ?>" data-target="#<?php echo $row['pos_name'].$key['month_name'] ?>">
																					<?php echo ($key['bulan_status']==1) 
																					? number_format($key['bulan_bill'], 0, ',', '.') . '<br>' . '('.pretty_date($key['bulan_date_pay'],'d/m/y',false).')'																		
																					: number_format($key['bulan_bill'], 0, ',', '.')
																					?>
																				</a>
																				<div class="modal fade" id="<?php echo $row['pos_name']. $key['month_name'] ?>" role="dialog">
																					<div class="modal-dialog modal-sm">
																						<div class="modal-content">
																							<div class="modal-header">
																								<button type="button" class="close" data-dismiss="modal">×</button>
																								<h4 class="modal-title"><?php echo ($key['bulan_status'] ==1) ? 'Batalkan' : 'Pembayaran' ?> <?php echo $row['pos_name'] ?> Bulan <?php echo $key['month_name'] ?></h4>
																							</div>
																							<form action="<?php echo ($key['bulan_status'] ==0) ? site_url('manage/payout/pay') : site_url('manage/payout/not_pay') ?>" method="post" accept-charset="utf-8">
																								<div class="modal-body">
																									<input class="form-control" required="" type="hidden" name="student_id" value="<?php echo $row['student_student_id'] ?>">
																									<input class="form-control" required="" type="hidden" name="student_nis" value="<?php echo $row['student_nis'] ?>">
																									<input class="form-control" required="" type="hidden" name="bulan_id" value="<?php echo $key['month_month_id'] ?>">
																									<input class="form-control" required="" type="hidden" name="payment_id" value="<?php echo $key['payment_payment_id'] ?>">
																									<input class="form-control" required="" type="hidden" name="payout_id" value="<?php echo $key['bulan_id'] ?>">
																									
																								<?php if ($key['bulan_status'] == 0) { ?>
																									<div class="form-group">
																										<label>Tanggal</label>
																										<div class="input-group" data-date="" data-date-format="yyyy-mm-dd">
																											
																											<input class="form-control" required="" type="date" name="payout_date"  placeholder="Tanggal Bayar" value="<?php echo $key['bulan_date_pay'] ?>">
																										</div>
																									</div>
																									<div class="form-group">
																										<label>Jumlah Bayar</label>
																										<input class="form-control" readonly="" type="text" name="payout_value" placeholder="Jumlah Bayar" value="<?php echo $key['bulan_bill'] ?>">
																									</div>
																																	
																								<?php }  ?>
																								</div>
																								<div class="modal-footer">																																														<button type="submit" class="btn btn-success">Simpan</button>
																									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																								</div>
																							</form>                    				
																						</div>
																					</div>
																				</div>
																			</td>
																		<?php }  ?>
																	<?php endforeach ?>
																
																
																
																	<?php foreach ($bulan as $key) : ?>
																		<?php if ($key['month_month_id'] == 10   && $key['payment_payment_id'] == $row['payment_payment_id']) { ?>
																			<td class="<?php echo ($key['bulan_status'] ==1) ? 'success' : 'danger' ?>" style=" <?php echo ($key['bulan_bill'] ==0) ? 'background-color: #f5f5f5!important;' : '' ?>">
																				
																				<a data-toggle="<?php echo ($key['bulan_bill'] ==0) ? 'none' : 'modal' ?>" data-target="#<?php echo $row['pos_name'].$key['month_name'] ?>">
																					<?php echo ($key['bulan_status']==1) 
																					? number_format($key['bulan_bill'], 0, ',', '.') . '<br>' . '('.pretty_date($key['bulan_date_pay'],'d/m/y',false).')'																		
																					: number_format($key['bulan_bill'], 0, ',', '.')
																					?>
																				</a>
																				<div class="modal fade" id="<?php echo $row['pos_name']. $key['month_name'] ?>" role="dialog">
																					<div class="modal-dialog modal-sm">
																						<div class="modal-content">
																							<div class="modal-header">
																								<button type="button" class="close" data-dismiss="modal">×</button>
																								<h4 class="modal-title"><?php echo ($key['bulan_status'] ==1) ? 'Batalkan' : 'Pembayaran' ?> <?php echo $row['pos_name'] ?> Bulan <?php echo $key['month_name'] ?></h4>
																							</div>
																							<form action="<?php echo ($key['bulan_status'] ==0) ? site_url('manage/payout/pay') : site_url('manage/payout/not_pay') ?>" method="post" accept-charset="utf-8">
																								<div class="modal-body">
																									<input class="form-control" required="" type="hidden" name="student_id" value="<?php echo $row['student_student_id'] ?>">
																									<input class="form-control" required="" type="hidden" name="student_nis" value="<?php echo $row['student_nis'] ?>">
																									<input class="form-control" required="" type="hidden" name="bulan_id" value="<?php echo $key['month_month_id'] ?>">
																									<input class="form-control" required="" type="hidden" name="payment_id" value="<?php echo $key['payment_payment_id'] ?>">
																									<input class="form-control" required="" type="hidden" name="payout_id" value="<?php echo $key['bulan_id'] ?>">
																									
																								<?php if ($key['bulan_status'] == 0) { ?>
																									<div class="form-group">
																										<label>Tanggal</label>
																										<div class="input-group" data-date="" data-date-format="yyyy-mm-dd">
																											
																											<input class="form-control" required="" type="date" name="payout_date"  placeholder="Tanggal Bayar" value="<?php echo $key['bulan_date_pay'] ?>">
																										</div>
																									</div>
																									<div class="form-group">
																										<label>Jumlah Bayar</label>
																										<input class="form-control" readonly="" type="text" name="payout_value" placeholder="Jumlah Bayar" value="<?php echo $key['bulan_bill'] ?>">
																									</div>
																															
																								<?php }  ?>
																								</div>
																								<div class="modal-footer">																																														<button type="submit" class="btn btn-success">Simpan</button>
																									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																								</div>
																							</form>                    				
																						</div>
																					</div>
																				</div>
																			</td>
																		<?php }  ?>
																	<?php endforeach ?>
																
																
																
																	<?php foreach ($bulan as $key) : ?>
																		<?php if ($key['month_month_id'] == 11   && $key['payment_payment_id'] == $row['payment_payment_id']) { ?>
																			<td class="<?php echo ($key['bulan_status'] ==1) ? 'success' : 'danger' ?>" style=" <?php echo ($key['bulan_bill'] ==0) ? 'background-color: #f5f5f5!important;' : '' ?>">
																				
																				<a data-toggle="<?php echo ($key['bulan_bill'] ==0) ? 'none' : 'modal' ?>" data-target="#<?php echo $row['pos_name'].$key['month_name'] ?>">
																					<?php echo ($key['bulan_status']==1) 
																					? number_format($key['bulan_bill'], 0, ',', '.') . '<br>' . '('.pretty_date($key['bulan_date_pay'],'d/m/y',false).')'																		
																					: number_format($key['bulan_bill'], 0, ',', '.')
																					?>
																				</a>
																				<div class="modal fade" id="<?php echo $row['pos_name']. $key['month_name'] ?>" role="dialog">
																					<div class="modal-dialog modal-sm">
																						<div class="modal-content">
																							<div class="modal-header">
																								<button type="button" class="close" data-dismiss="modal">×</button>
																								<h4 class="modal-title"><?php echo ($key['bulan_status'] ==1) ? 'Batalkan' : 'Pembayaran' ?> <?php echo $row['pos_name'] ?> Bulan <?php echo $key['month_name'] ?></h4>
																							</div>
																							<form action="<?php echo ($key['bulan_status'] ==0) ? site_url('manage/payout/pay') : site_url('manage/payout/not_pay') ?>" method="post" accept-charset="utf-8">
																								<div class="modal-body">
																									<input class="form-control" required="" type="hidden" name="student_id" value="<?php echo $row['student_student_id'] ?>">
																									<input class="form-control" required="" type="hidden" name="student_nis" value="<?php echo $row['student_nis'] ?>">
																									<input class="form-control" required="" type="hidden" name="bulan_id" value="<?php echo $key['month_month_id'] ?>">
																									<input class="form-control" required="" type="hidden" name="payment_id" value="<?php echo $key['payment_payment_id'] ?>">
																									<input class="form-control" required="" type="hidden" name="payout_id" value="<?php echo $key['bulan_id'] ?>">
																									
																								<?php if ($key['bulan_status'] == 0) { ?>
																									<div class="form-group">
																										<label>Tanggal</label>
																										<div class="input-group" data-date="" data-date-format="yyyy-mm-dd">
																											
																											<input class="form-control" required="" type="date" name="payout_date"  placeholder="Tanggal Bayar" value="<?php echo $key['bulan_date_pay'] ?>">
																										</div>
																									</div>
																									<div class="form-group">
																										<label>Jumlah Bayar</label>
																										<input class="form-control" readonly="" type="text" name="payout_value" placeholder="Jumlah Bayar" value="<?php echo $key['bulan_bill'] ?>">
																									</div>
																													
																								<?php }  ?>
																								</div>
																								<div class="modal-footer">																																														<button type="submit" class="btn btn-success">Simpan</button>
																									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																								</div>
																							</form>                    				
																						</div>
																					</div>
																				</div>
																			</td>
																		<?php }  ?>
																	<?php endforeach ?>
																
																
																
																	<?php foreach ($bulan as $key) : ?>
																		<?php if ($key['month_month_id'] == 12   && $key['payment_payment_id'] == $row['payment_payment_id']) { ?>
																			<td class="<?php echo ($key['bulan_status'] ==1) ? 'success' : 'danger' ?>" style=" <?php echo ($key['bulan_bill'] ==0) ? 'background-color: #f5f5f5!important;' : '' ?>">
																				
																				<a data-toggle="<?php echo ($key['bulan_bill'] ==0) ? 'none' : 'modal' ?>" data-target="#<?php echo $row['pos_name'].$key['month_name'] ?>">
																					<?php echo ($key['bulan_status']==1) 
																					? number_format($key['bulan_bill'], 0, ',', '.') . '<br>' . '('.pretty_date($key['bulan_date_pay'],'d/m/y',false).')'																		
																					: number_format($key['bulan_bill'], 0, ',', '.')
																					?>
																				</a>
																				<div class="modal fade" id="<?php echo $row['pos_name']. $key['month_name'] ?>" role="dialog">
																					<div class="modal-dialog modal-sm">
																						<div class="modal-content">
																							<div class="modal-header">
																								<button type="button" class="close" data-dismiss="modal">×</button>
																								<h4 class="modal-title"><?php echo ($key['bulan_status'] ==1) ? 'Batalkan' : 'Pembayaran' ?> <?php echo $row['pos_name'] ?> Bulan <?php echo $key['month_name'] ?></h4>
																							</div>
																							<form action="<?php echo ($key['bulan_status'] ==0) ? site_url('manage/payout/pay') : site_url('manage/payout/not_pay') ?>" method="post" accept-charset="utf-8">
																								<div class="modal-body">
																									<input class="form-control" required="" type="hidden" name="student_id" value="<?php echo $row['student_student_id'] ?>">
																									<input class="form-control" required="" type="hidden" name="student_nis" value="<?php echo $row['student_nis'] ?>">
																									<input class="form-control" required="" type="hidden" name="bulan_id" value="<?php echo $key['month_month_id'] ?>">
																									<input class="form-control" required="" type="hidden" name="payment_id" value="<?php echo $key['payment_payment_id'] ?>">
																									<input class="form-control" required="" type="hidden" name="payout_id" value="<?php echo $key['bulan_id'] ?>">
																									
																								<?php if ($key['bulan_status'] == 0) { ?>
																									<div class="form-group">
																										<label>Tanggal</label>
																										<div class="input-group">
																											<!--span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span-->
																											<input class="form-control" required="" type="date" name="payout_date" placeholder="Tanggal Bayar" value="<?php echo $key['bulan_date_pay'] ?>">
																										</div>
																									</div>
																									<div class="form-group">
																										<label>Jumlah Bayar</label>
																										<input class="form-control" readonly="" type="text" name="payout_value" placeholder="Jumlah Bayar" value="<?php echo $key['bulan_bill'] ?>">
																									</div>
																													
																								<?php }  ?>
																								</div>
																								<div class="modal-footer">																																														<button type="submit" class="btn btn-success">Simpan</button>
																									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																								</div>
																							</form>                    				
																						</div>
																					</div>
																				</div>
																			</td>
																		<?php }  ?>
																	<?php endforeach ?>
																
															</tr>
														<?php 
															}
															$i++;
														endforeach; 
														?>					
												</tbody>
											</table>
										</div>
									</div>
									<div class="tab-pane" id="tab_2">
										<!-- End List Tagihan Bulanan -->

										<!-- List Tagihan Lainnya (Bebas) -->

										<div class="card-body">
											<a href="" class="btn btn-info btn-xs"><i class="fa fa-refresh"></i> Refresh</a>
											<table class="table table-hover table-responsive table-bordered" style="white-space: nowrap;">
												<thead>
													<tr class="info">
														<th>No.</th>
														<th>Jenis Pembayaran</th>
														<th>Total Tagihan</th>
														<th>Dibayar</th>
														<th>Status</th>
														<th>Bayar</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$i =1;
													foreach ($bebas as $row):
														if ($f['n'] AND $f['r'] == $row['student_nis']) {
															$sisa = $row['bebas_bill']-$row['bebas_total_pay'];
															?>
															<tr class="<?php echo ($row['bebas_bill'] == $row['bebas_total_pay']) ? 'success' : 'danger' ?>" style=" <?php echo ($key['bulan_bill'] ==0) ? 'background-color: #f5f5f5!important;' : '' ?>">
																<td style="background-color: #fff !important;"><?php echo $i ?></td>
																<td style="background-color: #fff !important;"><?php echo $row['pos_name'].' - T.A '.$row['period_start'].'/'.$row['period_end'] ?></td>
																<td><?php echo 'Rp. ' . number_format($sisa, 0, ',', '.') ?></td>
																<td><?php echo 'Rp. ' . number_format($row['bebas_total_pay'], 0, ',', '.') ?></td>
																<td><a href="<?php echo site_url('manage/payout/payout_bebas/'. $row['payment_payment_id'].'/'.$row['student_student_id'].'/'.$row['bebas_id']) ?>" class="view-cicilan label <?php echo ($row['bebas_bill']==$row['bebas_total_pay']) ? 'label-success' : 'label-warning' ?>"><?php echo ($row['bebas_bill']==$row['bebas_total_pay']) ? 'Lunas' : 'Belum Lunas' ?></a></td>
																<td width="40" style="text-align:center">
																	<a data-toggle="modal" class="btn btn-success btn-xs <?php echo ($row['bebas_bill']==$row['bebas_total_pay']) ? 'disabled' : '' ?>" title="Bayar" href="#addCicilan<?php echo $row['bebas_id'] ?>"><span class="fa fa-money"></span> Bayar</a>
																</td>
															</tr>

															<div class="modal fade" id="addCicilan<?php echo $row['bebas_id'] ?>" role="dialog">
																<div class="modal-dialog modal-md">
																	<div class="modal-content">
																		<div class="modal-header">
																			<button type="button" class="close" data-dismiss="modal">&times;</button>
																			<h4 class="modal-title">Tambah Pembayaran/Cicilan</h4>
																		</div>
																		<?php echo form_open('manage/payout/payout_bebas/', array('method'=>'post')); ?>
																		<div class="modal-body">
																			<input type="hidden" name="bebas_id" value="<?php echo $row['bebas_id'] ?>">
																			<input type="hidden" name="student_nis" value="<?php echo $row['student_nis'] ?>">
																			<input type="hidden" name="student_student_id" value="<?php echo $row['student_student_id'] ?>">
																			<input type="hidden" name="payment_payment_id" value="<?php echo $row['payment_payment_id'] ?>">
																			<div class="form-group">
																				<label>Nama Pembayaran</label>
																				<input class="form-control" readonly="" type="text" value="<?php echo $row['pos_name'].' - T.A '.$row['period_start'].'/'.$row['period_end'] ?>">
																			</div>
																			<div class="form-group">
																				<label>Tanggal</label>
																				<input class="form-control" readonly="" type="text" value="<?php echo pretty_date(date('Y-m-d'),'d F Y',false) ?>">
																			</div>
																			<div class="row">
																				<div class="col-md-6">
																					<label>Jumlah Bayar *</label>
																					<input type="text" required="" name="bebas_pay_bill" class="form-control numeric" placeholder="Jumlah Bayar">
																				</div>
																				<div class="col-md-6">
																					<label>Keterangan *</label>
																					<input type="text" required="" name="bebas_pay_desc" class="form-control" placeholder="Keterangan">
																				</div>
																			</div>
																		</div>
																		<div class="modal-footer">
																			<button type="submit" class="btn btn-success">Simpan</button>
																			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																		</div>
																		<?php echo form_close(); ?>
																	</div>

																	<?php 
																}
																$i++;
													endforeach; 
													?>				
												</tbody>
											</table> 
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					
				<?php } ?>
			</div>
		</div>
	</section>
</div>

<div class="modal fade" id="dataSiswa" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h4 class="modal-title">Cari Data Siswa</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<div class="col-sm-3">
						<select id="us" class="form-control">
							<option value="0">---Pilih Unit---</option>
							<?php foreach ($majors as $row): ?>
								<option value="<?php echo $row['majors_id'] ?>"><?php echo $row['majors_name'] ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div id="div_class">
						<div class="col-sm-3">
							<select id="pr" class="form-control">
								<option value="0">-- Pilih Kelas --</option>
								<?php foreach ($kelas as $row): ?>
									<option value="<?php echo $row['class_id'] ?>"><?php echo $row['class_name'] ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
				</div>
				<br>
				<div id="div_student">
					<div class="card-body table-responsive">
						<table id="dtable" class="table table-hover dataTable no-footer" width="100%">
							<thead>
								<th>No</th>
								<th>NIS</th>
								<th>Nama</th>
								<th>Kelas</th>
								<th>Aksi</th>
							</thead>	
							<tbody>
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

<script type="text/javascript">
	$(".loader").hide();

    function ambil_data(nis){
        var nisSiswa    = nis;
        var thAjaran    = $("#th_ajar").val();
        
        window.location.href = '/manage/payout?n='+thAjaran+'&r='+nisSiswa;
        
      }
      
      function change_class(){
          
            var majors_id = $("#unit_id").val();
			
			$("#div_class").html("");
            
            $.ajax({ 
            url: '/manage/payout/change_class/',
            type: 'POST', 
            data: {
                    'majors_id': majors_id,
            },
            success: function(msg){
                    $("#div_class").html(msg);
            },
			error: function(msg){
					alert('msg');
			}
            });
      }
      
      function change_student(){
          
            var majors_id = $("#unit_id").val()
            var class_id = $("#kelas_id").val()
            
            $.ajax({ 
            url: '/manage/payout/change_student/',
            type: 'POST', 
            data: {
                    'majors_id': majors_id,
                    'class_id' : class_id,
            },
            success: function(msg){
                    $("#div_student").html(msg);
            },
			error: function(msg){
					alert('msg');
			}
            });  
      }
      
      function change_kas_account(){
          
            var kas = $("#kas_account_id").val()
            
            $("#kas_account_jul").val(kas);
            $("#kas_account_agu").val(kas);
            $("#kas_account_sep").val(kas);
            $("#kas_account_okt").val(kas);
            $("#kas_account_nov").val(kas);
            $("#kas_account_des").val(kas);
            $("#kas_account_jan").val(kas);
            $("#kas_account_feb").val(kas);
            $("#kas_account_mar").val(kas);
            $("#kas_account_apr").val(kas);
            $("#kas_account_mei").val(kas);
            $("#kas_account_jun").val(kas);
            $("#kas_account_bebas").val(kas);
      }
      
		function cari_noref(){
			var trxDate = $("#trxDate").val();
			var nis     = $("#student_nis").val();
			
			$.ajax({ 
			url: '/manage/payout/cari_noref/',
			type: 'POST', 
			data: {
					'trxDate': trxDate,
					'nis': nis,
			},
			success: function(msg){
					$("#div_noref").html(msg);
			},
			error: function(msg){
					alert('msg');
			}
			});
		}
    
    
		function pay_bebas(){
			var nis                 = $("#student_nis").val();
			var period              = $("#th_ajar").val();
			var kas_account_id      = $("#kas_account_id").val();
			var kas_noref           = $("#kas_noref").val();
			var bebas_id            = $('#bebas_id').val();
			var student_nis         = $('#student_nis').val();
			var student_student_id  = $('#student_student_id').val();
			var payment_payment_id  = $('#payment_payment_id').val();
			var bebas_pay_date      = $('#bebas_pay_date').val();
			var bebas_pay_bill      = $('#bebas_pay_bill').val();
			var bebas_pay_desc      = $('#bebas_pay_desc').val();
			
			if(kas_noref != '' && kas_account_id != ''){
			if (bebas_pay_bill != '' && bebas_pay_desc != '') {
			$.ajax({ 
				url: '/manage/payout/payout_bebas/',
				type: 'POST', 
				data: {
						'kas_account_id'        : kas_account_id,
						'kas_noref'             : kas_noref,
						'bebas_id'              : bebas_id,
						'student_nis'           : student_nis,
						'student_student_id'    : student_student_id,
						'payment_payment_id'    : payment_payment_id,
						'bebas_pay_date'        : bebas_pay_date,
						'bebas_pay_bill'        : bebas_pay_bill,
						'bebas_pay_desc'        : bebas_pay_desc,
				},    
				success: function(msg) {
						window.location.href = '/manage/payout?n='+period+'&r='+nis;
				},
				error: function(msg){
						alert('msg');
				}
				
			});
			} else {
				alert("Jumlah Bayar atau Keterangan Belum Terisi");
			}
			} else {
				alert("Akun Kas Belum di Pilih");
			}
		}
		
		function trxFinish(){
			var nis                 = $("#student_nis").val();
			var period              = $("#th_ajar").val();
			var kas_account_id      = $("#kas_account_id").val();
			var kas_noref           = $("#kas_noref").val();
			
			if(kas_noref != '' && kas_account_id != ''){
			$.ajax({ 
				url: '/manage/payout/payout_finish/',
				type: 'POST', 
				data: {
						'kas_account_id'        : kas_account_id,
						'kas_noref'             : kas_noref,
						'student_nis'           : nis,
						'period'                : period,
				},
				beforeSend: function () {
					$(".loader").fadeIn("slow");
					$(".payment").fadeOut("slow");
				},    
				success: function(msg) {
						window.location.href = '/manage/payout?n='+period+'&r='+nis;
				},
				error: function(msg){
						alert('msg');
				}
				
			});
			} else {
				alert("Akun Kas Belum di Pilih");
			} 
		}
		
		function get_kelas(){
			var id_majors    = $("#majors_id").val();
			
			$.ajax({ 
				url: '/manage/payout/get_kelas',
				type: 'POST', 
				data: {
						'id_majors': id_majors,
				},    
				success: function(msg) {
						$("#div_kelas").html(msg);
				},
				error: function(msg){
						alert('msg');
				}
				
			});
		}
		
		function get_student(){
			var id_majors       = $("#majors_id").val();
			var id_kelas        = $("#class_id").val();
			var student_name    = $("#student_name").val();
			
			$.ajax({ 
				url: '/manage/payout/get_student',
				type: 'POST', 
				data: {
						'id_majors'   : id_majors,
						'id_kelas'    : id_kelas,
						'student_name': student_name,
				},    
				success: function(msg) {
						$("#div_data").html(msg);
				},
				error: function(msg){
						alert('msg');
				}
				
			});
		}

	function startCalculate(){
		interval=setInterval("Calculate()",10);
	}

	function Calculate() {
		var numberHarga = $('#harga').val(); // a string
		numberHarga = numberHarga.replace(/\D/g, '');
		numberHarga = parseInt(numberHarga, 10);

		var numberBayar = $('#bayar').val(); // a string
		numberBayar = numberBayar.replace(/\D/g, '');
		numberBayar = parseInt(numberBayar, 10);

		var total = numberBayar - numberHarga;
		$('#kembalian').val(total);
	}

	function stopCalc(){
		clearInterval(interval);
	}
	
	$(document).ready(function() {
		$("#selectall").change(function() {
			$(".checkbox").prop('checked', $(this).prop("checked"));
		});
	});

	(function(a){
		a.createModal=function(b){
			defaults={
				title:"",message:"Your Message Goes Here!",closeButton:true,scrollable:false
			};
			var b=a.extend({},defaults,b);
			var c=(b.scrollable===true)?'style="max-height: 420px;overflow-y: auto;"':"";
			html='<div class="modal fade" id="myModal">';
			html+='<div class="modal-dialog">';
			html+='<div class="modal-content">';
			html+='<div class="modal-header">';
			html+='<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>';
			if(b.title.length>0){
				html+='<h4 class="modal-title">'+b.title+"</h4>"
			}
			html+="</div>";
			html+='<div class="modal-body" '+c+">";
			html+=b.message;
			html+="</div>";
			html+='<div class="modal-footer">';
			if(b.closeButton===true){
				html+='<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>'
			}
			html+="</div>";
			html+="</div>";
			html+="</div>";
			html+="</div>";a("body").prepend(html);a("#myModal").modal().on("hidden.bs.modal",function(){
				a(this).remove()})}
	})(jQuery);

	/*
	* Here is how you use it
	*/
	$(function(){    
		$('.view-cicilan').on('click',function(){
			var link = $(this).attr('href');      
			var iframe = '<object type="text/html" data="'+link+'" width="100%" height="350">No Support</object>'
			$.createModal({
				title:'Lihat Pembayaran/Ciiclan',
				message: iframe,
				closeButton:true,
				scrollable:false
			});
			return false;        
		});    
	});

	$(document).ready(function () {
		draw_data();
		$('#us').change(function() {
			//console.log($(this).val());
			draw_data();
		});
		$('#pr').change(function() {
			//console.log($(this).val());
			draw_data();
		});

		function draw_data() {
			$us = $("#us").val();
			console.log($us);
			$pr = $("#pr").val();
			console.log($pr);
			$('#dtable').DataTable({
				'processing': true,
				'serverSide': true,
				'stateSave': true,
				paging: false,
				destroy: true,
				//responsive: true,
				'order': [],
				'ajax': {
					'url': "<?php echo site_url('manage/payout/ajax_list') ?>",
					'type': 'POST',
					'data': {
						'us': $us, //unit
						'pr': $pr, //kelas
						'<?= $this->security->get_csrf_token_name() ?>': crsf_hash
					}
				},
				'columnDefs': [
					{
						'targets': [0,1,2,3,4],
						'orderable': false,
					},
				],
				dom: 'Blfrtip',
				lengthMenu: [10, 20, 50, 100, 200, 500],
				buttons: [ 
				],
			});
		};

	});

</script>