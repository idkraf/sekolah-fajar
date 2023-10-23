<?php

if (isset($student)) {

	$inputFullnameValue = $student['employee_name'];
	$inputMajorValue = $student['employee_majors_id'];
	$inputNipValue = $student['employee_nip'];
	$inputPlaceValue = $student['employee_born_place'];
	$inputDateValue = $student['employee_born_date'];
	$inputPhoneValue = $student['employee_phone'];
	$inputEmailValue = $student['employee_email'];
	$inputAddressValue = $student['employee_address'];
	$inputGenderValue = $student['employee_gender'];
	$inputStatusValue = $student['employee_status'];
	$inputStrataValue = $student['employee_strata'];	
	$inputPositionValue = $student['employee_position_id'];
	$inputCategoryValue = $student['employee_category'];
} else {
	$inputFullnameValue = set_value('employee_name');
	$inputMajorValue = set_value('employee_majors_id');
	$inputNipValue = set_value('employee_nip');
	$inputPlaceValue = set_value('employee_born_place');
	$inputDateValue = set_value('employee_born_date');
	$inputPhoneValue = set_value('employee_phone');
	$inputEmailValue = set_value('employee_email');
	$inputAddressValue = set_value('employee_address');
	$inputGenderValue = set_value('employee_gender');
	$inputStatusValue = set_value('employee_status');
	$inputStrataValue = set_value('employee_strata');	
	$inputPositionValue = set_value('employee_position_id');
	$inputCategoryValue = set_value('employee_category');
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
			<li><a href="<?php echo site_url('manage/pegawai') ?>">Kelola Pegawai</a></li>
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
				<div class="box box-primary">
					<!-- /.box-header -->
					<div class="box-body">
            
                        <?php echo validation_errors(); ?>
                        <?php if (isset($pegawai)) { ?>
                            <input type="hidden" name="employee_id" value="<?php echo $pegawai['employee_id']; ?>">
                        <?php } ?>
                        
                        <div class="form-group">
                            <label>Nip Pegawai <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
                            <input name="employee_nip" type="text" class="form-control" value="<?php echo $inputNipValue ?>" placeholder="Nama lengkap">
                        </div>

                        <div class="form-group">
                            <label>Nama lengkap <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
                            <input name="employee_name" type="text" class="form-control" value="<?php echo $inputFullnameValue ?>" placeholder="Nama lengkap">
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="employee_gender" value="L" <?php echo ($inputGenderValue == 'L') ? 'checked' : ''; ?>> Laki-laki
                                </label>&nbsp;&nbsp;
                                <label>
                                    <input type="radio" name="employee_gender" value="P" <?php echo ($inputGenderValue == 'P') ? 'checked' : ''; ?>> Perempuan
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Tempat Lahir</label>
                            <input name="employee_born_place" type="text" class="form-control" value="<?php echo $inputPlaceValue ?>" placeholder="Tempat Lahir">
                        </div>

                        <div class="form-group">
                            <label>Tanggal Lahir </label>
                            <div class="input-group date " data-date="" data-date-format="yyyy-mm-dd">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                <input class="form-control" type="text" name="employee_born_date" readonly="readonly" placeholder="Tanggal" value="<?php echo $inputDateValue; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Pendidikan Terakhir <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
                            <select name="employee_strata" class="form-control">
                                <option value="">---Pilih Strata---</option>
								<option value="SMA"> SMA </option>
								<option value="SMK"> SMK </option>
								<option value="D1"> D1 </option>
								<option value="D2"> D2 </option>
								<option value="D3"> D3 </option>
								<option value="D4"> D4 </option>
								<option value="S1"> S1 </option>
								<option value="S2"> S2 </option>
								<option value="S3"> S3 </option>
								<!--
                                <//?php foreach ($strata as $row): ?>
                                    <option value="<//?php echo $row['strata_id'] ?>" <//?php echo ($inputStrataValue == $row['strata_id']) ? 'selected' : '' ?> ><//?php echo $row['strata_name'] ?></option>
                                <//?php endforeach ?>
								-->
                            </select>
                        </div> 


                        <div class="form-group">
                            <label>Unit Sekolah <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
                            <select name="employee_majors_id" class="form-control">
                                <option value="">---Pilih Unit Sekolah---</option>
                                <?php foreach ($majors as $row): ?>
                                    <option value="<?php echo $row['majors_id'] ?>" <?php echo ($inputMajorValue == $row['majors_id']) ? 'selected' : '' ?> ><?php echo $row['majors_name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div> 


                        <div class="form-group">
                            <label>Jabatan <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
                            <select name="employee_position_id" class="form-control">
                                <option value="">---Pilih Jabatan---</option>
                                <?php foreach ($position as $row): ?>
                                    <option value="<?php echo $row['position_id'] ?>" <?php echo ($inputPositionValue == $row['position_id']) ? 'selected' : '' ?> ><?php echo $row['position_name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div> 


                        <div class="form-group">
                            <label>Status Kepegawaian <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
                            <select name="employee_category" class="form-control">
                                <option value="">---Pilih Status Kepegawaian---</option>
                                <option value="1" <?php echo ($inputCategoryValue == 1) ? 'selected' : '' ?>>Pegawai Tetap</option>
                                <option value="2" <?php echo ($inputCategoryValue == 2) ? 'selected' : '' ?>>Pegawai Tidak Tetap</option>
                            </select>
                        </div> 

                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea class="form-control" name="employee_address" placeholder="Alamat Tempat Tinggal"><?php echo $inputAddressValue ?></textarea>
                        </div>					

						<div class="form-group">
							<label>Password <small data-toggle="tooltip" title="Wajib diisi">default: 123456</small></label>
							<input name="employee_password" type="password" class="form-control" placeholder="Password">
						</div>            

						<div class="form-group">
							<label>Konfirmasi Password <small data-toggle="tooltip" title="Wajib diisi"> Kosongkan jika password kosong</small></label>
							<input name="passconf" type="password" class="form-control" placeholder="Konfirmasi Password">
						</div> 

                        <div class="form-group">
                            <label>Telpon/HP</label>
                            <input name="employee_phone" type="text" class="form-control" value="<?php echo $inputPhoneValue ?>" placeholder="No Handphone">
                        </div>

						<div class="form-group">
							<label>Email <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
							<input name="employee_email" type="text" class="form-control" value="<?php echo $inputEmailValue ?>" placeholder="email">
						</div> 
						
						<p class="text-muted">*) Kolom wajib diisi.</p>
					</div>
					<!-- /.box-body -->
				</div>
			</div>
			<div class="col-md-3">
				<div class="box box-primary">
					<!-- /.box-header -->
					<div class="box-body">
						<div class="form-group">
							<label>Status</label>
							<div class="radio">
								<label>
									<input type="radio" name="employee_status" value="1" <?php echo ($inputStatusValue == 1) ? 'checked' : ''; ?>> Aktif
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="employee_status" value="0" <?php echo ($inputStatusValue == 0) ? 'checked' : ''; ?>> Tidak Aktif
								</label>
							</div>
						</div>
						<label >Foto</label>
						<a href="#" class="thumbnail">
							<?php if (isset($pegawai['employee_photo']) != NULL) { ?>
								<img src="<?php echo upload_url('pegawai/' . $pegawai['employee_photo']) ?>" class="img-responsive avatar">
							<?php } else { ?>
								<img src="<?php echo media_url('img/missing.png') ?>" id="target" alt="Choose image to upload">
							<?php } ?>
						</a>
						<input type='file' id="employee_photo" name="employee_photo">
						<br>
						<button type="submit" class="btn btn-block btn-success">Simpan</button>
						<a href="<?php echo site_url('manage/pegawai'); ?>" class="btn btn-block btn-info">Batal</a>
						<?php if (isset($pegawai)) { ?>
							<button type="button" onclick="getId(<?php echo $pegawai['employee_id'] ?>)" class="btn btn-danger btn-block" data-toggle="modal" data-target="#deleteEmployee">Hapus
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
</div>
<?php if (isset($pegawai)) { ?>
	<div class="modal fade" id="deleteEmployee">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title">Konfirmasi Hapus</h4>
				</div>
				<form action="<?php echo site_url('manage/pegawai/delete') ?>" method="POST">
					<div class="modal-body">
						<p>Apakah anda akan menghapus data ini?</p>
						<input type="hidden" name="employee_id" id="employeeId">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
						<button type="submit" class="btn btn-danger">Hapus</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php } ?>

<script>

	function getId(id) {
		$('#employeeId').val(id)
	}
</script>

<script>
	var SITEURL = "<?php echo site_url() ?>";
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#target').attr('src', e.target.result);
			};

			reader.readAsDataURL(input.files[0]);
		}
	}

	$("#employee_photo").change(function() {
		readURL(this);
	});

	function get_position(){
		var id_majors = $("#employee_majors_id").val();
		$.ajax({

		});
	}

</script>