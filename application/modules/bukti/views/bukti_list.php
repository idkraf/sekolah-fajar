<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo isset($title) ? '' . $title : null; ?>
			<small>List</small>
		</h1>
		<ol class="breadcrumb">
			<li  class="breadcrumb-item"><a href="<?php echo site_url('manage') ?>"><i class="fa fa-th"></i> Home</a></li>
			<li class="active breadcrumb-item"><?php echo isset($title) ? '' . $title : null; ?></li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-success">		
					<div class="card-header table-responsive">
						<?php echo form_open(current_url(), array('class' => 'form-horizontal', 'method' => 'get')) ?>
						<table style="width:100%">
							<tbody>
								<tr>
									<!--td><a href="<?php echo site_url('manage/bukti/add') ?>" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah Data</a></td-->
									<td> 
										<div class="input-group" style="margin-right:10px">
											<div class="input-group-addon alert-success p-2">Unit</div>
											<select name="m" class="form-control" onchange="this.form.submit()">
												<option value="all">---Pilih Unit---</option>
												<?php foreach ($majors as $row): ?>
													<option value="<?php echo $row['majors_id'] ?>" <?php echo (isset($f['m']) AND $f['m'] == $row['majors_id']) ? 'selected' : '' ?> ><?php echo $row['majors_name'] ?></option>
												<?php endforeach ?>
											</select>
										</div>
									</td>
									<td>
										<div class="input-group" style="margin-right:10px">
											<div class="input-group-addon alert-info p-2">Kelas</div>
											<select class="form-control" name="pr" onchange="this.form.submit()">
												<option value="all">-- Pilih Kelas  --</option>
												<?php foreach ($class as $row): ?>
													<option <?php echo (isset($f['pr']) AND $f['pr'] == $row['class_id']) ? 'selected' : '' ?> value="<?php echo $row['class_id'] ?>"><?php echo $row['class_name'] ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</td>
									<td>
										<div class="input-group ">
											<input type="text" id="field" autofocus name="n" <?php echo (isset($f['n'])) ? 'placeholder="' . $f['n'] . '"' : 'placeholder="Cari"' ?> class="form-control">
											<div class="input-group-btn">
												<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
											</div>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
						<?php echo form_close() ?>
					</div>
					<!-- /.box-header -->
					<div class="card-body table-responsive">
						<table class="table table-hover table-striped table-bordered">
							<tr class="bg-success">
								<th>Nama Siswa</th>
								<th>Total Bayar</th>
								<th>Jenis Pembayaran</th>
								<th>Keterangan</th>
								<th>Status</th>
								<th>Aksi</th>
							</tr>
							<tbody>
								<?php
								if (!empty($payment)) {
									foreach ($payment as $row) :
								?>
										<tr>
											<td><?php echo $row['student_full_name']; ?></td>
											<td><?php echo 'Rp.'.number_format($row['nilai'] + $row['nilaiBebas'], 0, ',', '.'); ?></td>
											<td><?php echo ($row['pos_name'] > 0 ? $row['pos_name'] : 'Semua Pembayaran') . ' - T.P ' . $row['period_start'] . '/' . $row['period_end']; ?></td>
											<td><?php echo $row['description']; ?></td>
											<td>
												<?php switch ($row['status']) {
													case 1: ?>
														<p class="label label-success label-xs">Approve</p>
												<?php break; case 2: ?>
													<p class="label label-danger label-xs">Reject</p>
												<?php break; default: ?>
													<p class="label label-info label-xs">Pending</p>
												<?php break; } ?>
											</td>
											<td>
												<?php if ($row['status'] == 0 && $userRole <> 3) { ?>
													<a data-toggle="tooltip" data-placement="top" title="Approve" class="btn btn-success btn-xs" href="<?php echo site_url('manage/bukti/Approve/' . $row['id']) ?>">
														Approve
													</a>
													<a data-toggle="tooltip" data-placement="top" title="Reject" class="btn btn-danger btn-xs" href="<?php echo site_url('manage/bukti/Reject/' . $row['id']) ?>">
														Reject
													</a>
												<?php } ?>
												<a href="<?php echo site_url('manage/bukti/edit/' . $row['id']) ?>" class="btn btn-xs btn-primary" data-toggle="tooltip" title="Detail"><i class="fa fa-search"></i></a>
											</td>
										</tr>
									<?php
									endforeach;
								} else {
									?>
									<tr id="row">
										<td colspan="6" align="center">Data Kosong</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
					<!-- /.box-body -->
				</div>
				<div>
					<?php echo $this->pagination->create_links(); ?>
				</div>
				<!-- /.box -->
			</div>
		</div>
	</section>
	<!-- /.content -->
</div>