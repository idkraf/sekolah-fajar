<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo isset($title) ? '' . $title : null; ?>
		</h1>
		<ol class="breadcrumb">
			<li  class="breadcrumb-item"><a href="<?php echo site_url('manage') ?>"><i class="fa fa-th"></i> Home</a></li>
			<li class="active breadcrumb-item"><?php echo isset($title) ? '' . $title : null; ?></li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-danger">
					Warning ! 
					Jika ada siswa yang telah dibuatkan tagihan dan dipindah kelasnya melalui halaman ini, maka tagihan tetap ada di kelas sebelumnya!
				</div>
			</div>
		</div>
		<!-- /.box-header -->
		<div class="row">
			<div class="col-md-9">
				<div class="card">					
					<div class="card-body table-responsive">
						<?php echo form_open(current_url(), array('method' => 'get')) ?>
						<table style="width:100%">
							<tbody>
								<tr>
									<td> 
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-addon alert-success">Unit</div>
												<select name="m" class="form-control" onchange="this.form.submit()">
													<option value="all">---Pilih Unit---</option>
													<?php foreach ($majors as $row): ?>
														<option value="<?php echo $row['majors_id'] ?>" <?php echo (isset($f['m']) AND $f['m'] == $row['majors_id']) ? 'selected' : '' ?> ><?php echo $row['majors_name'] ?></option>
													<?php endforeach ?>
												</select>
											</div>
										</div> 
									</td>
									<td>
										<div class="form-group">
											<div class="input-group">
												<div class="input-group-addon alert-info">Pilih kelas</div>
												<select class="form-control" name="pr" onchange="this.form.submit()">
													<option value="all">-- Pilih Kelas  --</option>
													<?php foreach ($class as $row): ?>
														<option <?php echo (isset($f['pr']) AND $f['pr'] == $row['class_id']) ? 'selected' : '' ?> value="<?php echo $row['class_id'] ?>"><?php echo $row['class_name'] ?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
						<?php echo form_close() ?>
					</div>
					<div class="card-body table-responsive">
						<table class="table table-hover table-bordered table-responsive">
							<form action="<?php echo site_url('manage/student/multiple'); ?>" method="post">
								<input type="hidden" name="action" value="upgrade">
								<tr>
									<th><input type="checkbox" id="selectall" value="checkbox" name="checkbox"></th> 
									<th>No</th>
									<th>NIS</th>
									<th>Nama</th>
									<th>Kelas</th>
								</tr>
								<tbody>
									<?php if($this->input->get(NULL)) { ?>
										<?php
										if (!empty($student)) {
											$i = 1;
											foreach ($student as $row):
												?>
												<tr style="<?php echo ($row['student_status']==0) ? 'color:#00E640' : '' ?>">
													<td><input type="checkbox" class="<?php echo ($row['student_status']==0) ? NULL : 'checkbox' ?>" <?php echo ($row['student_status']==0) ? 'disabled' : NULL ?> name="msg[]" value="<?php echo $row['student_id']; ?>"></td>
													<td><?php echo $i; ?></td>
													<td><?php echo $row['student_nis']; ?></td>
													<td><?php echo $row['student_full_name']; ?></td>	
													<td><?php echo $row['class_name']; ?></td>	
												</tr>
												<?php
												$i++;
											endforeach;
										} else {
											?>
											<tr id="row">
												<td colspan="5" align="center">Data Kosong</td>
											</tr>
											<?php } ?>
											<?php } else {
											?>
											<tr id="row">
												<td colspan="5" align="center">Data Kosong</td>
											</tr>
											<?php } ?>
										</tbody>
									
								</table>
							</div>
						</div>
					</div>

					<div class="col-md-3">
						<div class="panel panel-info">
								<div class="panel-body">
									<select name="mp" class="form-control mp">
										<option value="all">---Pilih Unit---</option>
										<?php foreach ($majors as $row): ?>
											<option value="<?php echo $row['majors_id'] ?>"><?php echo $row['majors_name'] ?></option>
										<?php endforeach ?>
									</select>
									
									<br>
									<label> Pilih Kelas </label>
									<select class="form-control" name="class_id" required="" id="div_class">
									</select>
								</div>	
							<br>
							<button class="btn btn-danger btn-block" type="submit">Proses Pindah/Naik Kelas</button>
							</form>
						</div>
					</div>

				</div>

			</section>
			<!-- /.content -->
		</div>

<script>
	$(document).ready(function() {
		$("#selectall").change(function() {
			$(".checkbox").prop('checked', $(this).prop("checked"));
		});

		$("#selectall2").change(function() {
			$(".checkbox").prop('checked', $(this).prop("checked"));
		});
		
		$(".mp").change(function() {
			console.log($(this).val());	
            var majors_id = $(this).val();			
			//$("#div_class").html("");            
            $.ajax({ 
            url: '/manage/student/change_class/',
            type: 'GET', 
            data: {
                    'majors_id': majors_id,
            },
            success: function(msg){
                console.log(msg);
				$("#div_class").html(msg);
            },
			error: function(msg){
					alert('msg');
			}
            });

		});
		
	});

</script>
