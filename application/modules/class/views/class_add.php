<?php

if (isset($class)) {
	$inputMajorValue= $class['majors_id'];
	$inputClassValue = $class['class_name'];
	
} else {
	$inputMajorValue= $class['majors_id'];
	$inputClassValue = set_value('class_name');
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
			<li class="breadcrumb-item"><a href="<?php echo site_url('manage/class') ?>">Kelas</a></li>
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
						<?php if (isset($class)) { ?>
						<input type="hidden" name="class_id" value="<?php echo $class['class_id']; ?>">
						<?php } ?>

						<div class="form-group">
							<label>Unit Sekolah <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
							<select name="majors_id" class="form-control">
								<option value="">---Pilih Unit Sekolah---</option>
								<?php foreach ($majors as $row): ?>
									<option value="<?php echo $row['majors_id'] ?>" <?php echo ($inputMajorValue == $row['majors_id']) ? 'selected' : '' ?> ><?php echo $row['majors_name'] ?></option>
								<?php endforeach ?>
							</select>
						</div> 

						<div class="form-group">
							<label>Nama Kelas <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
							<input name="class_name" type="text" class="form-control" value="<?php echo $inputClassValue ?>" placeholder="Isi Nama Kelas">
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
						<a href="<?php echo site_url('manage/class'); ?>" class="btn btn-block btn-info">Batal</a>
					</div>
					<!-- /.box-body -->
				</div>
			</div>
		</div>
		<?php echo form_close(); ?>
		<!-- /.row -->
	</section>
</div>