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
						<?php if ($this->session->userdata('uroleid') != GURU) { ?>
						<a href="<?php echo site_url('manage/student/add') ?>" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah</a>
						<a href="<?php echo site_url('manage/student/import') ?>" class="btn btn-sm btn-info"><i class="fa fa-upload"></i> Upload Siswa</a>
						<a href="" class="btn btn-sm btn-info"><i class="fa fa-upload"></i> Download Excel</a>
						<?php } ?>

						<div class="btn-group col-ms-12">
							<?php echo form_open(current_url(), array('class' => 'form-horizontal', 'method' => 'get')) ?>
							<div class="input-group input-group-sm" style="width: 200px;">
								<input type="text" id="field" autofocus name="n" <?php echo (isset($f['n'])) ? 'placeholder="'.$f['n'].'"' : 'placeholder="NIS Siswa"' ?> class="form-control">
								<div class="input-group-btn">
									<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
								</div>
							</div>
							<?php echo form_close(); ?>
						</div>

						<div style="display:inline-block">
							<form action="<?php echo site_url('manage/student/multiple'); ?>" method="post">
								<input type="hidden" name="action" value="printPdf">
								<button type="submit" class="btn btn-danger btn-sm" formtarget="_blank"><span class="fa fa-print"></span> Cetak</button>
							</form>
						</div>
										
						<div class="card-body table-responsive">
							<form action="" class="form-horizontal" method="get" accept-charset="utf-8">
							
								<table>
									<tbody>
										<tr>
											<td>     
												<!--select style="width: 200px;" id="us" name="us" class="form-control">
													<option value="all" <//?php echo $us == "all" ? 'selected' : '' ?>>Semua Unit</option>
													<option value="1" <//?php echo $us == "1" ? 'selected' : '' ?>>TK</option>
													<option value="2" <//?php echo $us == "2" ? 'selected' : '' ?>>SD</option>
													<option value="3" <//?php echo $us == "3" ? 'selected' : '' ?>>SMP</option>
													<option value="4" <//?php echo $us == "4" ? 'selected' : '' ?>>SMA</option>
													<option value="99" <//?php echo $us == "99" ? 'selected' : '' ?>>Lainnya</option>
												</select-->
												<select name="us" style="width: 200px;" class="form-control" onchange="this.form.submit()">
													<option value="0">---Pilih Unit---</option>
													<?php foreach ($majors as $row): ?>
														<option value="<?php echo $row['majors_id'] ?>" <?php echo (isset($us) AND $us == $row['majors_id']) ? 'selected' : '' ?> ><?php echo $row['majors_name'] ?></option>
													<?php endforeach ?>
												</select>
											</td>
											<td>
												<div class="col-sm-2">
													<select name="pr" style="width: 200px;" class="form-control">
														<option value="0">-- Semua Kelas  --</option>
														<?php foreach ($class as $row): ?>
															<option <?php echo $pr == $row['class_id'] ? 'selected' : '' ?> value="<?php echo $row['class_id'] ?>"><?php echo $row['class_name'] ?></option>
														<?php endforeach; ?>
													</select>
												</div>
											</td>
											<td>				
												<div class="col-sm-2">								
													<select id="st" name="st" style="width: 200px;" class="form-control" >
														<option value="0">-- All Status  --</option>
														<option value="1" <?php echo  $st == "1" ? 'selected' : '' ?>>Aktif</option>
														<option value="2" <?php echo  $st == "2" ? 'selected' : '' ?>>Tidak Aktif</option>
													</select>
												</div>
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
								<th>NIS</th>
								<th>Nama</th>
								<th>Unit</th>
								<th>Kelas</th>
								<th>WA Ortu</th>
								<th>Status</th>
								<th>Aksi</th>
							</tr>
							<tbody>
								<?php
								if (!empty($student)) {
									$i = 1;
									foreach ($student as $row):
										?>
															
										<?php
											$unit ="";
											if ($row['majors_majors_id']== 1) $unit = "TK";
											if ($row['majors_majors_id']== 2) $unit = "SD";
											if ($row['majors_majors_id']== 3) $unit = "TK";
											if ($row['majors_majors_id']== 99) $unit = "Lainnya";
										?>
										<tr>
											<td><input type="checkbox" class="checkbox" name="msg[]" value="<?php echo $row['student_id']; ?>"></td>
											<td><?php echo $i; ?></td>
											<td><?php echo $row['student_nis']; ?></td>
											<td><?php echo $row['student_full_name']; ?></td>
											<td><?= $unit; ?></td>
											<td><?php echo $row['class_name']; ?></td>
											<td><?php echo $row['student_parent_phone']; ?></td>
											<td><label class="label <?php echo ($row['student_status']==1) ? 'label-success' : 'label-danger' ?>"><?php echo ($row['student_status']==1) ? 'Aktif' : 'Tidak Aktif' ?></label></td>
											<td>
												<a href="<?php echo site_url('manage/student/rpw/' . $row['student_id']) ?>" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Reset Password"><i class="fa fa-unlock"></i></a>
												<a href="<?php echo site_url('manage/student/view/' . $row['student_id']) ?>" class="btn btn-xs btn-info" data-toggle="tooltip" title="Lihat"><i class="fa fa-eye"></i></a>
												<?php if ($this->session->userdata('uroleid') != GURU) { ?>
												<a href="<?php echo site_url('manage/student/edit/' . $row['student_id']) ?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
												<?php } ?>
												<a href="<?php echo site_url('manage/student/printPdf/' . $row['student_id']) ?>" class="btn btn-success btn-xs view-pdf" data-toggle="tooltip" title="Cetak Kartu"><i class="fa fa-print"></i></a>
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
	</section>
	<!-- /.content -->
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
			title:'Cetak Kartu Pembayaran',
			message: iframe,
			closeButton:true,
			scrollable:false
		});
		return false;        
	});    
})
</script>
<script>
	$(document).ready(function() {
		$("#selectall").change(function() {
			$(".checkbox").prop('checked', $(this).prop("checked"));
		});
	});
</script>