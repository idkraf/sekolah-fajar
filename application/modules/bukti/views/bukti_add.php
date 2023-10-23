<?php

if (isset($payment)) {

	$inputPeriodValue = $payment['period_period_id'];
	$inputPosValue = $payment['pos_pos_id'];
	$inputNilaiValue = $payment['nilai'];
	$inputNilaiBebasValue = $payment['nilaiBebas'];
	$inputBuktiFoto = $payment['upload_image'];
	$inputStudentValue = $payment['student_id'];
	$inputdescriptionValue = $payment['description'];
} else {
	$inputPeriodValue = set_value('period_id');
	$inputPosValue = set_value('pos_id');
	$inputNilaiValue = set_value('nilai');
	$inputNilaiBebasValue = set_value('nilaiBebas');
	$inputBuktiFoto = set_value('image');
	$inputStudentValue = set_value('idStudent');
	if($userRole == 3){
		$inputStudentValue = $GetStudentID;
	  }
	$inputdescriptionValue = set_value('description');
}
?>

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo isset($title) ? '' . $title : null; ?>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('manage') ?>"><i class="fa fa-th"></i> Home</a></li>
			<li><a href="<?php echo site_url('manage/bukti') ?>"> Bukti Bayar</a></li>
			<li class="active"><?php echo isset($title) ? '' . $title : null; ?></li>
		</ol>
	</section>

	<!-- Main content -->
	<!-- Main content -->
	<section class="content">
		<?php echo form_open_multipart(current_url()); ?>
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-md-9">
				<div class="box box-success">
					<!-- /.box-header -->
					<div class="box-body">
						<?php echo validation_errors(); ?>
						<?php if (isset($payment)) { ?>
							<input type="hidden" name="id" value="<?php echo $payment['id']; ?>">
						<?php } ?>
						<input type="hidden" name="GetStudentIDs" value="<?php echo $GetStudentID; ?>">

						<div class="form-group">
							<label>Nama Siswa <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
							<select name="student_id" class="form-control" <?php echo $userRole == 3 ? 'disabled' :'' ?>>
								<option value="">-Pilih Nama Siswa-</option>
								<?php foreach ($student as $row) : ?>
									<option value="<?php echo $row['student_id']; ?>" <?php echo ($inputStudentValue == $row['student_id']) ? 'selected' : '' ?>><?php echo $row['student_full_name']." - ".$row['class_name']." - ".$row['majors_name']; ?></option>
								<?php endforeach; ?>
							</select>
						</div>

						<div class="form-group">
							<label>Nama Pembayaran <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
							<select id="pos_id" name="pos_id" class="form-control" onChange="changetextbox();">
								<option value="">- Semua Nama Pembayaran -</option>
								<?php foreach ($pos as $row) : ?>
									<option value="<?php echo $row['pos_pos_id'] .'-'. $row['payment_type']; ?>" <?php echo ($inputPosValue == $row['pos_pos_id']) ? 'selected' : '' ?>><?php echo $row['pos_name'] .' - '. $row['payment_type']; ?></option>
								<?php endforeach; ?>
							</select>
						</div>

						<div class="form-group">
							<label>Tahun Pelajaran <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
							<select name="period_id" class="form-control">
								<option value="">-Pilih Tahun-</option>
								<?php foreach ($period as $row) : ?>
									<option value="<?php echo $row['period_id']; ?>" <?php echo ($inputPeriodValue == $row['period_id']) ? 'selected' : '' ?>><?php echo $row['period_start'] . '/' . $row['period_end']; ?></option>
								<?php endforeach; ?>
							</select>
						</div>

						<div class="form-group">
							<label>Total Bayar Tagihan Bulanan <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
							<input name="nilai" type="text" id="allTarif"  class="form-control numeric" value="<?php echo $inputNilaiValue; ?>">
						</div>
						<div class="form-group">
							<label>Total Bayar Tagihan Bebas <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
							<input name="nilaiBebas" type="text" id="allTarifBebas"  class="form-control numeric" value="<?php echo $inputNilaiBebasValue; ?>">
						</div>

						<div class="form-group">
							<label>Keterangan <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
							<textarea class="form-control" name="description" placeholder="Keterangan"><?php echo $inputdescriptionValue ?></textarea>
						</div>

						<p class="text-muted">*) Kolom wajib diisi.</p>
					</div>
					<!-- /.box-body -->
				</div>
			</div>
			<div class="col-md-3">
				<div class="box box-success">
					<!-- /.box-header -->
					<div class="box-body">
						<label>Bukti Bayar</label>
						<a href="#" class="thumbnail">
							<?php if (isset($inputBuktiFoto) and $inputBuktiFoto != NULL) { ?>
								<img src="<?php echo upload_url('ubukti/' . $inputBuktiFoto) ?>" class="img-responsive avatar">
							<?php } else { ?>
								<img id="target" src="<?php echo media_url('img/missing.png') ?>" alt="Choose image to upload">
							<?php } ?>
						</a>
						<input type='file' id="image" name="image">
						<br>
						<?php if (!isset($payment['id']) || ((isset($payment['id']) && ($payment['status'] == 0)))) { ?>
							<button type="submit" class="btn btn-block btn-success"><i class="fa fa-save"></i> Simpan</button>
						<?php } ?>
						<a href="<?php echo site_url('manage/bukti'); ?>" class="btn btn-block btn-info"><i class="fa fa-repeat"></i> Batal</a>
						<?php if (isset($payment['id']) && $payment['status'] == 0) { ?>
							<button type="button" onclick="getId(<?php echo $payment['id'] ?>)" class="btn btn-danger btn-block" data-toggle="modal" data-target="#deletePayment"><i class="fa fa-close"></i> Hapus
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
	<?php if (isset($payment['id'])) { ?>
		<div class="modal fade" id="deletePayment">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title">Konfirmasi Hapus</h4>
					</div>
					<form action="<?php echo site_url('manage/bukti/delete') ?>" method="POST">
						<div class="modal-body">
							<p>Apakah anda akan menghapus data ini?</p>
							<input type="hidden" name="id" id="id" value="<?php echo $payment['id']; ?>">
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-danger">Hapus</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	<?php } ?>
</div>
<script>
	function getId(id) {
		$('#paymentId').val(id)
	}
</script>
<script type="text/javascript">
$(document).ready(function () {
	changetextbox();
});

function changetextbox()
{
    if (document.getElementById("pos_id").value != '') {
		if(document.getElementById("pos_id").value.match(/^.*BEBAS$/))
		{
			document.getElementById("allTarif").disabled=false;
			document.getElementById("allTarifBebas").disabled=true;
		}
		else if(document.getElementById("pos_id").value.match(/^.*BULAN$/))
		{
			document.getElementById("allTarif").disabled=true;
			document.getElementById("allTarifBebas").disabled=false;
		}
    } else {
        document.getElementById("allTarif").disabled=false;
		document.getElementById("allTarifBebas").disabled=false;
    }
}
</script>