<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo isset($title) ? '' . $title : null; ?>
			<small></small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('manage') ?>"><i class="fa fa-th"></i> Home</a></li>
			<li class="active"><?php echo isset($title) ? '' . $title : null; ?></li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<a href="<?php echo site_url('manage/semester/add') ?>" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah</a>

						<div class="box-tools">
							<?php echo form_open(current_url(), array('class' => 'form-horizontal', 'method' => 'get')) ?>
							<div class="input-group input-group-sm" style="width: 250px;">
								<input type="text" id="field" autofocus name="n" <?php echo (isset($f['n'])) ? 'placeholder="'.$f['n'].'"' : 'placeholder="Tahun Ajaran"' ?> class="form-control" required>
								<div class="input-group-btn">
									<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
								</div>
							</div>
							<?php echo form_close(); ?>
						</div>
					</div>
					<!-- /.box-header -->
					<div class="box-body table-responsive no-padding">
						<table class="table table-hover">
							<tr>
								<th>No</th>
								<th>Nama Semester</th>
								<th>Tahun Ajaran</th>
								<th>Status</th>
								<th>Aksi</th>
							</tr>
							<tbody>
								<?php
								if (!empty($semester)) {
									$i = 1;
									foreach ($semester as $row):
										?>
										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo $row['semester_name']; ?></td>
											<td><?php echo $row['period_start'].'/'.$row['period_end'] ?></td>
											<td><?php echo ($row['semester_status'] == 1) ? 'Aktif' : 'Tidak Aktif' ?></td>
											<td>
												<a href="<?php echo site_url('manage/semester/edit/' . $row['semester_id']) ?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
												<button type="button" onclick="getId(<?php echo $row['semester_id'] ?>)" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteSemester">
													<i class="fa fa-trash"></i>
												</button>
												<?php if($row['semester_status']!=1){ ?>
													<a href="<?php echo site_url('manage/semester/semester_active/' . $row['semester_id']) ?>" class="btn btn-xs btn-success" data-toggle="tooltip" title="Aktifkan"><i class="fa fa-check"></i></a>
												<?php } ?>
											</td>	
										</tr>
										<?php
										$i++;
									endforeach;
								} else {
									?>
									<tr id="row">
										<td colspan="4" align="center">Data Kosong</td>
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

<div class="modal fade" id="deleteSemester">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Konfirmasi Hapus</h4>
			</div>
			<form action="<?php echo site_url('manage/semester/delete') ?>" method="POST">
				<div class="modal-body">
					<p>Apakah anda akan menghapus data ini?</p>
					<input type="hidden" name="semester_id" id="semesterID">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-danger">Hapus</button>
				</div>
			</form>
		</div>
	</div>
</div>


<script>

	function getId(id) {
		$('#semesterID').val(id)
	}
</script>