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
			<div class="col-md-12">
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
								<th>POS</th>
								<th>Nama Unit Pos</th>
								<th>Unit Sekolah</th>
								<th>Setting</th>
								<th>Aksi</th>
							</tr>
							<tbody>
								<?php
								if (!empty($item)) {
									$i = 1;
									foreach ($item as $row):
										?>
																		
										<?php
											$unit ="";
											if ($row['item_majors_id']== 1) $unit = "TK";
											if ($row['item_majors_id']== 2) $unit = "SD";
											if ($row['item_majors_id']== 3) $unit = "TK";
											if ($row['item_majors_id']== 99) $unit = "Lainnya";
										?>
										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo $row['item_name'] ?></td>
											<td><?= $unit; ?></td>
											<td>
											<a data-toggle="tooltip" data-placement="top" title="Ubah"
											class="btn btn-primary btn-xs"
											href="">
											Setting Tarif Pembayaran
											</a>
											</td>


									<td>
										<a data-toggle="modal" data-target="#<?php echo 'unit_'.$row['item_id'] ?>" class="btn btn-xs btn-success" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
										<div class="modal fade" id="<?php echo 'unit_'.$row['item_id'] ?>" role="dialog">
											<div class="modal-dialog modal-sm">
												<div class="modal-content bg-secondary">
													<div class="modal-header">
														<h4 class="modal-title">Edit Unit</h4>
														<button type="button" class="close" data-dismiss="modal">×</button>
													</div>
													<form action="<?php echo site_url('manage/item/update_unit') ?>" method="post" accept-charset="utf-8">
														<div class="modal-body">
															<input class="form-control" required="" type="hidden" name="item_id" value="<?php echo $row['item_id'] ?>">
																								
															<div class="form-group">
																<label>Unit Sekolah <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
																<select required="" name="majors_id" class="form-control">
																	<option <?= $row['item_majors_id'] == 1 ? 'selected' : ''; ?> value="1">TK</option>
																	<option <?= $row['item_majors_id'] == 2 ? 'selected' : ''; ?> value="2">SD</option>
																	<option <?= $row['item_majors_id'] == 3 ? 'selected' : ''; ?> value="3">SMP</option>
																	<option <?= $row['item_majors_id'] == 4 ? 'selected' : ''; ?> value="4">SMA</option>
																	<option <?= $row['item_majors_id'] == 99 ? 'selected' : ''; ?> value="99">Lainnya</option>
																</select>
															</div>
															<div class="form-group">
																<label>Nama Unit</label>
																<input class="form-control" type="text" name="name_unit"  value="<?php echo $row['item_name'] ?>">
															</div>
														</div>
														<div class="modal-footer">																																														<button type="submit" class="btn btn-success">Simpan</button>
															<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
														</div>
													</form>                    				
												</div>
											</div>
										</div>
									</td>	
								</tr>
								<?php
							endforeach;
						} else {
							?>
							<tr id="row">
								<td colspan="6" align="center">Data Kosong</td>
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

<div class="modal fade in" id="addPosition" role="dialog">
	<div class="modal-dialog modal-md">
		<div class="modal-content bg-secondary">
			<div class="modal-header">
				<h4 class="modal-title">Tambah Jabatan Pegawai</h4>
				<button type="button" class="close" data-dismiss="modal">×</button>
			</div>
			<?php echo form_open('manage/item/add_unit', array('method'=>'post')); ?>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<label>Unit Sekolah <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
							<select required="" name="item_majors_id" class="form-control">
								<option value="">-Pilih Unit Sekolah-</option>
								<option value="1">TK</option>
								<option value="2">SD</option>
								<option value="3">SMP</option>
								<option value="4">SMA</option>
								<option value="99">Lainnya</option>
							</select>
						</div>
					</div>
					<div id="p_scents_position">
						<div class="row">
							<div class="col-md-6">
								<label>Nama Unit Pos <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
								<input type="text" required="" name="item_name[]" class="form-control" placeholder="Contoh: Pembangunan Gedung Sekolah">
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
			$('<div class="row"><div class="col-md-6"><label>Nama Unit Pos <small data-toggle="tooltip" title="Wajib diisi">*</small></label><input type="text" required="" name="item_name[]" class="form-control" placeholder="Contoh: Pembangunan Gedung Sekolah"><a href="#" class="btn btn-xs btn-danger remScnt_position">Hapus Baris</a></div></div>').appendTo(scntDiv);
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
				html+='<div class="modal-content bg-secondary">';
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