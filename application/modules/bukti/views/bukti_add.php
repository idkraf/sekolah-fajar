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
			<li  class="breadcrumb-item"><a href="<?php echo site_url('manage') ?>"><i class="fa fa-th"></i> Home</a></li>
			<li class="breadcrumb-item"><a href="<?php echo site_url('manage/bukti') ?>"> Bukti Bayar</a></li>
			<li class="active breadcrumb-item"><?php echo isset($title) ? '' . $title : null; ?></li>
		</ol>
	</section>

	<!-- Main content -->
	<!-- Main content -->
	<section class="content">
		
	<div class="box box-info">
		<div class="card-header with-border">
			<h3 class="card-title">Filter Bukti Bayar</h3>
		</div><!-- /.box-header -->
		<div class="card-body">
			<?php echo form_open(current_url(), array('class' => 'form-horizontal', 'method' => 'get')) ?>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">	
						<label for="" class="control-label">Tahun Pelajaran</label>
						<select class="form-control" name="n" id="th_ajar">
							<?php foreach ($period as $row): ?>
								<option <?php echo (isset($f['n']) AND $f['n'] == $row['period_id']) ? 'selected' : '' ?> value="<?php echo $row['period_id'] ?>"><?php echo $row['period_start'].'/'.$row['period_end'] ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label for="" class="control-label">NIS Siswa</label>
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
			</div>
			</form>
		</div><!-- /.box-body -->
	</div><!-- /.box -->
	
	<?php if ($f) { ?>
		<?php echo form_open_multipart(current_url()); ?>
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-md-9">
				<div class="box box-success">
					<!-- /.box-header -->
					<div class="card-body">
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
									<option value="<?php echo $row['student_id']; ?>" <?php echo (isset($student_id) AND $student_id == $row['student_id']) ? 'selected' : '' ?>><?php echo $row['student_full_name']." - ".$row['class_name']." - ".$row['majors_name']; ?></option>
									<!-- option value="<//?php echo $row['student_id']; ?>"
									 <//?php echo ($inputStudentValue == $row['student_id']) ? 'selected' : '' ?>>
									 <//?php echo $row['student_full_name']." - ".$row['class_name']." - ".$row['majors_name']; ?></option-->
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
									<option value="<?php echo $row['period_id']; ?>"<?php echo (isset($f['n']) AND $f['n'] == $row['period_id']) ? 'selected' : '' ?>><?php echo $row['period_start'] . '/' . $row['period_end']; ?></option>
									<!--option value="<//?php echo $row['period_id']; ?>" <//?php echo ($inputPeriodValue == $row['period_id']) ? 'selected' : '' ?>>
									<//?php echo $row['period_start'] . '/' . $row['period_end']; ?></option-->
								<?php endforeach; ?>
							</select>
						</div>
						
						<div class="form-group">
							<label>Pada Bulan</label>
							<select class="form-control" name="month_id">
								<?php foreach ($bulan as $row): ?>
									<option value="<?php echo $row['month_id'] ?>"><?php echo $row['month_name'] ?></option>
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
					<div class="card-body">
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

	<?php } ?>
	</section>
	<?php if (isset($payment['id'])) { ?>
		<div class="modal fade" id="deletePayment">
			<div class="modal-dialog">
				<div class="modal-content text-secondary">
					<h4 class="modal-title text-primary">Konfirmasi Hapus</h4>
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
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

<div class="modal fade" id="dataSiswa" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title text-primary">Cari Data Siswa</h4>
				<button type="button" class="close" data-dismiss="modal">×</button>
			</div>
			<div class="modal-body">
				<div class="row form-group">
					<div class="col-sm-6">
						<select id="us" class="form-control text-primary">
							<option value="0">---Pilih Unit---</option>
							<?php foreach ($majors as $row): ?>
								<option value="<?php echo $row['majors_id'] ?>"><?php echo $row['majors_name'] ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div id="div_class col-sm-6">
						<div class="col-sm-12">
							<select id="pr" class="form-control text-primary">
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

function ambil_data(nis){
	var nisSiswa    = nis;
	var thAjaran    = $("#th_ajar").val();

	window.location.href = '/manage/bukti/add?n='+thAjaran+'&r='+nisSiswa;

}
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