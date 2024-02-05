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
					<div class="box-header with-border">
						<h3 class="box-title">Filter Data Siswa</h3>
					</div><!-- /.box-header -->
					<div class="box-body">
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
						<div class="box-header with-border">
							<h3 class="box-title">Informasi Siswa</h3>
							<?php if ($f['n'] AND $f['r'] != NULL) { ?>
								<a href="<?php echo site_url('manage/konseling/printBill' . '/?' . http_build_query($f)) ?>" target="_blank" class="btn btn-danger btn-xs pull-right">Cetak Buku Kesehatan</a>
							<?php } ?>
						</div><!-- /.box-header -->
						<div class="box-body">
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

						<div class="box-body">
									
							<div class="box box-primary">
								<div class="box-header with-border">
									<h3 class="box-title">Kesehatan Siswa</h3>
								</div><!-- /.box-header -->
								<div class="box-body">
									<div class="nav-tabs-custom">
										<ul class="nav nav-tabs">
											<li class="active"><a href="#tab_1" data-toggle="tab">Tambah Riwayat Kesehatan Siswa</a></li>
											<li><a href="#tab_2" data-toggle="tab">Riwayat Kesehatan Siswa</a></li>
										</ul>
										<div class="tab-content">
											<div class="tab-pane active" id="tab_1">
												<form action="<?php echo site_url('manage/konseling/addRiwayat') ?>" method="POST">
												
													<?php foreach ($siswa as $row): ?>
														<?php echo (isset($f['n']) AND $f['r'] == $row['student_nis']) ? 
														'<input type="hidden" name="student_id" value="'.$row['student_id'].'">' : '' ?> 
													<?php endforeach; ?>
													<input type="hidden" name="n"  value="<?php echo (isset($f['n'])) ? $f['n'] : 0 ?>">
													<input type="hidden" name="r" value="<?php echo (isset($f['r'])) ? $f['r'] : 0 ?>">
													
														
													<div class="form-group">
														<label>Tanggal <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
														
														<input type="date" class="form-control" id="tanggal" name="tanggal"
															value="<?=date('Y-m-d');?>" required>
														<?= form_error('tanggal', '<small class="text-danger">', '</small>'); ?>
													</div>

													<div class="form-group">
														<label>Sakit <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
														<input name="sakit" type="text"  class="form-control" required>
													</div>
													<div class="form-group">
														<label>Obat<small data-toggle="tooltip" title="Wajib diisi">*</small></label>
														<select name="obat_id" class="form-control"  required>
															<option value="">- Pilih Obat -</option>
															<?php foreach ($obat as $row) : ?>
																<option value="<?php echo $row['id']?>"><?php echo $row['nama_obat']; ?></option>
															<?php endforeach; ?>
														</select>
													</div>

													<div class="form-group">
														<label>Keterangan <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
														<textarea class="form-control" name="keterangan" placeholder="Keterangan"  required></textarea>
													</div>

													
													<button type="submit" class="btn btn-block btn-success"><i class="fa fa-save"></i> Simpan</button>
												</form>
											</div>
											<div class="tab-pane" id="tab_2">
                								<table class="table table-striped" id="dataTable">
													<thead>
														<th>No.</th>
														<th>Tanggal</th>
														<th>Sakit</th>
														<th>Obat</th>
														<th>Keterangan</th>
														<th></th>
													</thead>
													<tbody>
													<?php
														$no = 1;
														if ($riwayat) :
															foreach ($riwayat as $g) :
														?>
																<tr>
																	<td><?= $no++; ?></td>
																	<td><?= $g['tanggal']; ?></td>                                                        
																	<td><?= $g['sakit']; ?></td>
																	<td>																					
																		<?php foreach ($obat as $row): ?>
																			<?php echo (isset($g['obat_id']) AND $g['obat_id'] == $row['id']) ? 
																			$row['nama_obat'] : '' ?> 
																		<?php endforeach; ?>
																	</td>
																	<td><?= $g['keterangan']; ?></td>
																	<td>
																		<button
																		data-id ="<?php echo $g['id']?>"
																		data-id-obat="<?php echo $g['obat_id']?>"
																		data-tanggal ="<?php echo $g['tanggal']?>"
																		data-sakit="<?php echo $g['sakit']?>"
																		data-keterangan="<?php echo $g['keterangan']; ?>"
																		class="edit-object btn btn-warning btn-circle btn-sm"><i class="fa fa-edit"></i></button>
																		<button 
																		data-object-id ="<?php echo $g['id']?>"
																		class="delete-object btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></button>
																	</td>
																	
																</tr>
															<?php endforeach; ?>
														<?php else : ?>
															<tr>
																<td colspan="3" class="text-center">
																	Data Kosong
																</td>
															</tr>
														<?php endif; ?>
													</tbody>
												</table>
											</div>
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
<div  id="edit_model"  class="modal fade" >
	
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h4 class="modal-title">Edit Riwayat</h4>
			</div>
			<div class="modal-body">

			<form action="<?php echo site_url('manage/konseling/updateRiwayat') ?>" method="POST">
				
				<input type="hidden" name="id" class="edit_id" value="">
                <input type="hidden" name="n"  value="<?php echo (isset($f['n'])) ? $f['n'] : 0 ?>">
                <input type="hidden" name="r" value="<?php echo (isset($f['r'])) ? $f['r'] : 0 ?>">
					
				<div class="form-group">
					<label>Tanggal <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
					
					<input type="date" class="form-control tanggal" name="tanggal"
						value="<?=date('Y-m-d');?>" required>
					<?= form_error('tanggal', '<small class="text-danger">', '</small>'); ?>
				</div>

				<div class="form-group">
					<label>Sakit <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
					<input name="sakit" type="text"  class="form-control sakit" required>
				</div>
				<div class="form-group">
					<label>Obat<small data-toggle="tooltip" title="Wajib diisi">*</small></label>
					<select name="obat_id" class="form-control id_obat"  required>
						<?php foreach ($obat as $row) : ?>
							<option value="<?php echo $row['id']?>"><?php echo $row['nama_obat']; ?></option>
						<?php endforeach; ?>
					</select>
				</div>

				<div class="form-group">
					<label>Keterangan <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
					<textarea class="form-control keterangan" name="keterangan" placeholder="Keterangan"  required></textarea>
				</div>

				
				<button type="submit" class="btn btn-block btn-success"><i class="fa fa-save"></i> Simpan</button>
			</form>
			</div>
		</div>
	</div>
</div>

<div id="delete_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title">Hapus</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Hapus data ini?</p>
            </div>
            <div class="modal-footer">
            <?= form_open('manage/konseling/deleteRiwayat'); ?>
                <input type="hidden" name="deleteid" id="object-id" value="">
                <input type="hidden" name="n"  value="<?php echo (isset($f['n'])) ? $f['n'] : 0 ?>">
                <input type="hidden" name="r" value="<?php echo (isset($f['r'])) ? $f['r'] : 0 ?>">
                <button type="submit" class="btn btn-primary">Hapus</button>
                <button type="button" data-dismiss="modal"
                        class="btn">Batal</button>
            <?= form_close(); ?>
            </div>
        </div>
    </div>
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
					<div class="box-body table-responsive">
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
	
	$(document).on('click', ".edit-object", function (e) {
		e.preventDefault();
		$('.edit_id').val($(this).attr('data-id'));
		$('.tanggal').val($(this).attr('data-tanggal'));
		$('.id_obat').val($(this).attr('data-id-obat'));
		$('.sakit').val($(this).attr('data-sakit'));
		$('.keterangan').val($(this).attr('data-keterangan'));

		$(this).closest('tr').attr('id', $(this).attr('data-id'));
		$('#edit_model').modal({backdrop: 'static', keyboard: false});

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
					'url': "<?php echo site_url('manage/konseling/ajax_list') ?>",
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


    function ambil_data(nis){
        var nisSiswa    = nis;
        var thAjaran    = $("#th_ajar").val();
        
        window.location.href = '/manage/konseling?n='+thAjaran+'&r='+nisSiswa;
      }
      
      function change_class(){
          
            var majors_id = $("#unit_id").val();
            
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
</script>

<script type="text/javascript">
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
</script>
<script>
	$(document).ready(function() {
		$("#selectall").change(function() {
			$(".checkbox").prop('checked', $(this).prop("checked"));
		});
	});
</script>

<script type="text/javascript">
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
</script>
