<?php

if (isset($kredit)) {

	$inputDateValue = $kredit['kredit_date'];
	$inputValue = $kredit['kredit_value'];
	$inputDescValue = $kredit['kredit_desc'];
	
} else {
	$inputDateValue = set_value('kredit_date');
	$inputValue = set_value('kredit_value');
	$inputDescValue = set_value('kredit_desc');
	
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
			<li class="breadcrumb-item"><a href="<?php echo site_url('manage/kredit') ?>">Jurnal Pengeluaran</a></li>
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
						<?php if (isset($kredit)) { ?>
						<input type="hidden" name="kredit_id" value="<?php echo $kredit['kredit_id']; ?>">
						<?php } ?>
						
						<div class="form-group">
							<label>Tanggal </label>
							<div class="input-group">
								<!--span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span-->
								<input class="form-control" type="date" name="kredit_date" placeholder="Tanggal Pengeluaran" value="<?php echo $inputDateValue; ?>">
							</div>
						</div>

						<div class="form-group">
							<label>Keterangan *</label>
							<input type="text" class="form-control" name="kredit_desc" value="<?php echo $inputDescValue ?>" placeholder="Keterangan Pengeluaran">
						</div>

						<div class="form-group">
							<label>Jumlah Rupiah *</label>
							<input type="text" class="form-control numeric" name="kredit_value" value="<?php echo $inputValue ?>" placeholder="Jumlah">
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
						<a href="<?php echo site_url('manage/kredit'); ?>" class="btn btn-block btn-info">Batal</a>
					</div>
					<!-- /.box-body -->
				</div>
			</div>
		</div>
		<?php echo form_close(); ?>
		<!-- /.row -->
	</section>
</div>
