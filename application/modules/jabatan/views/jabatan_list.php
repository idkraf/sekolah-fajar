<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo isset($title) ? '' . $title : null; ?>
			<small></small>
		</h1>
		<ol class="breadcrumb">
			<li  class="breadcrumb-item"><a href="<?php echo site_url('manage') ?>"><i class="fa fa-th"></i> Home</a></li>
			<li class="active breadcrumb-item"><?php echo isset($title) ? '' . $title : null; ?></li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-lg-12">
				<div class="card"> 
				<div class="card-header">
						<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addPosition"><i class="fa fa-plus"></i> Tambah</button>
						<br>
						<br>								
						<div class="card-body table-responsive">
							<form action="" class="form-horizontal" method="get" accept-charset="utf-8">
								<table>
									<tbody>
										<tr>
											<td>     
												<select style="width: 200px;" id="n" name="n" class="form-control" required="">
													<option value="">--- Pilih Unit Sekolah ---</option>
													<option value="all">Semua Unit</option>
													<option value="1">TK</option>
													<option value="2">SD</option>
													<option value="3">SMP</option>
													<option value="4">SMA</option>
													<option value="99">Lainnya</option>
												</select>
											</td>
											<td>
												&nbsp;&nbsp;
											</td>
											<td>
											<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Cari</button>    
											</td>
										</tr>
									</tbody>
								</table>
							</form>					
						</div>
					</div>
					<!-- /.box-header -->
					<div class="card-body table-responsive">
						<table class="table table-hover">
							<tr>
								<th><input type="checkbox" id="selectall" value="checkbox" name="checkbox"></th> 
								<th>No</th>
								<th>Kode Jabatan</th>
								<th>Nama Jabatan</th>
								<th>Unit Sekolah</th>
								<th>ID Unit</th>
								<th>Aksi</th>
							</tr>
							<tbody>
								<?php
								if (!empty($jabatan)) {
									$i = 1;
									foreach ($jabatan as $row):
										?>										
										<?php
											$unit ="";
											if ($row['position_majors_id']== 1) $unit = "TK";
											if ($row['position_majors_id']== 2) $unit = "SD";
											if ($row['position_majors_id']== 3) $unit = "TK";
											if ($row['position_majors_id']== 99) $unit = "Lainnya";
										?>
										<tr>
											<td><input type="checkbox" class="checkbox" name="msg[]" value="<?php echo $row['position_id']; ?>"></td>
											<td><?php echo $i; ?></td>
											<td><?php echo $row['position_code']; ?></td>
											<td><?php echo $row['position_name']; ?></td>
											<td>
											<?= $unit; ?>
											</td>
											<td><?php echo $row['position_majors_id']; ?></td>
											<td>
												<?php if ($this->session->userdata('uroleid') != GURU) { ?>
												<!-- a href="<//?php echo site_url('manage/jabatan/edit/' . $row['position_id']) ?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a-->
												<a data-toggle="modal" data-target="#<?php echo 'jb_'.$row['position_id'] ?>" class="btn btn-xs btn-success" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
												<div class="modal fade" id="<?php echo 'jb_'.$row['position_id'] ?>" role="dialog">
													<div class="modal-dialog modal-sm">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal">×</button>
																<h4 class="modal-title text-primary">Edit Unit</h4>
															</div>
															<form action="<?php echo site_url('manage/jabatan/update_jabatan') ?>" method="post" accept-charset="utf-8">
																<div class="modal-body">
																	<input class="form-control" required="" type="hidden" name="position_id" value="<?php echo $row['position_id'] ?>">
																										
																	<div class="form-group">
																		<label>Unit Sekolah <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
																		<select required="" name="majors_id" class="form-control">
																			<option <?= $row['position_majors_id'] == 1 ? 'selected' : ''; ?> value="1">TK</option>
																			<option <?= $row['position_majors_id'] == 2 ? 'selected' : ''; ?> value="2">SD</option>
																			<option <?= $row['position_majors_id'] == 3 ? 'selected' : ''; ?> value="3">SMP</option>
																			<option <?= $row['position_majors_id'] == 4 ? 'selected' : ''; ?> value="4">SMA</option>
																			<option <?= $row['position_majors_id'] == 99 ? 'selected' : ''; ?> value="99">Lainnya</option>
																		</select>
																	</div>
																	<div class="form-group">
																		<label>Nama jabatan</label>
																		<input class="form-control" type="text" name="name_unit"  value="<?php echo $row['position_name'] ?>">
																	</div>
																	<div class="form-group">
																		<label>Kode Jabatan</label>
																		<input class="form-control" type="text" name="code_unit"  value="<?php echo $row['position_code'] ?>">
																	</div>
																</div>
																<div class="modal-footer">																																														<button type="submit" class="btn btn-success">Simpan</button>
																	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																</div>
															</form>                    				
														</div>
													</div>
												</div>
												<?php } ?>
												<a href="<?php echo site_url('manage/jabatan/delete/' . $row['position_id']) ?>" class="btn btn-danger btn-xs view-pdf" data-toggle="tooltip" title="Hapus Jabatan"><i class="fa fa-trash"></i></a>
											</td>	
										</tr>
										<?php
										$i++;
									endforeach;
								} else {
									?>
									<tr id="row">
										<td colspan="8" align="center">Data Kosong</td>
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
			</form>
	</section>
		<!-- /.content -->
</div>
<div class="modal fade in" id="addPosition" role="dialog">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h4 class="modal-title text-primary">Tambah Jabatan Pegawai</h4>
			</div>
			<?php echo form_open('manage/jabatan/add_jabatan', array('method'=>'post')); ?>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<label>Unit Sekolah <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
							<select required="" name="position_majors_id" class="form-control">
								<option value="">-Pilih Unit Sekolah-</option>
								<option value="1">TK</option>
								<option value="2">SD</option>
								<option value="3">SMP</option>
								<option value="4">SMP</option>
								<option value="99">Lainnya</option>
							</select>
						</div>
					</div>
					<div id="p_scents_position">
						<div class="row">
							<div class="col-md-6">
								<label>Kode Jabatan <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
								<input type="text" required="" name="position_code[]" class="form-control" placeholder="Contoh: KSSD">
							</div>
							<div class="col-md-6">
								<label>Nama Jabatan <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
								<input type="text" required="" name="position_name[]" class="form-control" placeholder="Contoh: Kepala Sekolah SD">
							</div>
						</div>
					</div>
					<h6><a href="#" class="btn btn-xs btn-success" id="addScnt_position"><i class="fa fa-plus"></i><b> Tambah Baris</b></a></h6>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success">Simpan</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
				</div>
			<?php echo form_close(); ?>		
		</div>
	</div>
	
<script type="text/javascript">
	$(function() {
		var scntDiv = $('#p_scents_position');
		var i = $('#p_scents_position .row').length + 1;

		$("#addScnt_position").click(function() {
			$('<div class="row"><div class="col-md-6"><label>Kode Jabatan <small data-toggle="tooltip" title="Wajib diisi">*</small></label><input type="text" required="" name="position_code[]" class="form-control" placeholder="Contoh: KSSD"><a href="#" class="btn btn-xs btn-danger remScnt_position">Hapus Baris</a></div><div class="col-md-6"><label>Nama Jabatan <small data-toggle="tooltip" title="Wajib diisi">*</small></label><input type="text" required="" name="position_name[]" class="form-control" placeholder="Contoh: Kepala Sekolah SD"></div></div>').appendTo(scntDiv);
			i++;
			return false;
		});

		$(document).on("click", ".remScnt_position", function() {
			if (i > 2) {
				$(this).parents('.row').remove();
				i--;
			}
			return false;
		});
	});
</script>
</div>

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
					html+='<h4 class="modal-title text-primary">'+b.title+"</h4>"
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
					a(this).remove()})}})(jQuery);

	/*
	* Here is how you use it
	*/
	$(function(){    
		$('.view-pdf').on('click',function(){
			var pdf_link = $(this).attr('href');      
			var iframe = '<object type="application/pdf" data="'+pdf_link+'" width="100%" height="350">No Support</object>'
			$.createModal({
				title:'Cetak',
				message: iframe,
				closeButton:true,
				scrollable:false
			});
			return false;        
		});    
	});

</script>
<script>
	$(document).ready(function() {
		$("#selectall").change(function() {
			$(".checkbox").prop('checked', $(this).prop("checked"));
		});
	});
</script>