<?php

if (isset($semester)) {

	$inputNameValue = $semester['semester_name'];
	$inputPeriodValue = $semester['period_id'];
	$inputStatusValue = $semester['semester_status'];
	
} else {
	$inputNameValue = set_value('semester_name');
	$inputPeriodValue = set_value('period_id');
	$inputStatusValue = set_value('semester_status');
	
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
			<li class="breadcrumb-item"><a href="<?php echo site_url('manage/semester') ?>">Semester</a></li>
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
				<div class="box box-primary">
					<!-- /.box-header -->
					<div class="card-body">
						<?php echo validation_errors(); ?>
						<?php if (isset($semester)) { ?>
							<input type="hidden" name="semester_id" value="<?php echo $semester['semester_id']; ?>">
						<?php } ?>

						<div class="form-group">
							<label>Nama Semester *</label>
							<div class="row">
								<div class="col-sm-6 col-md-6">
									<input type="text" name="semester_name" value="<?php echo $inputNameValue ?>" class="form-control">
								</div>
							</div>
						</div>

						<div class="form-group">						
							<label>Tahun Pelajaran</label>
							
								<select class="form-control" name="n" id="th_ajar">
									<?php foreach ($period as $row): ?>
										<option <?php echo (isset($f['n']) AND $f['n'] == $row['period_id']) ? 'selected' : '' ?> value="<?php echo $row['period_id'] ?>"><?php echo $row['period_start'].'/'.$row['period_end'] ?></option>
									<?php endforeach; ?>
								</select>
							
						</div>

						<div class="form-group">
							<label>Keterangan</label>
							<div class="radio">
								<label>
									<input type="radio" name="semester_status" value="1" <?php echo ($inputStatusValue == 1) ? 'checked' : ''; ?>> Aktif
								</label> &nbsp;&nbsp;&nbsp;&nbsp;
								<label>
									<input type="radio" name="semester_status" value="0" <?php echo ($inputStatusValue == 0) ? 'checked' : ''; ?>> Tidak Aktif
								</label>
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
						<button type="submit" class="btn btn-block btn-success">Simpan</button>
						<a href="<?php echo site_url('manage/semester'); ?>" class="btn btn-block btn-info">Batal</a>
					</div>
					<!-- /.box-body -->
				</div>
			</div>
		</div>
		<?php echo form_close(); ?>
		<!-- /.row -->
	</section>
</div>