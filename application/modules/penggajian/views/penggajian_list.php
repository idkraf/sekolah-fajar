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
													
						<div class="card-body table-responsive p-0">
							<form action="" class="form-horizontal" method="get" accept-charset="utf-8">
								<table>
									<tbody>
										<tr>
											<td>     
												<select style="width: 200px;" id="m"  name="m" class="form-control" onchange="this.form.submit()">
													<option value="">---Pilih Unit Sekolah---</option>
													<?php foreach ($majors as $row): ?>
														<option value="<?php echo $row['majors_id'] ?>" <?php echo (isset($f['m']) AND $f['m'] == $row['majors_id']) ? 'selected' : '' ?> ><?php echo $row['majors_name'] ?></option>
													<?php endforeach ?>
												</select>
											</td>
											<td>
												<select style="width: 200px;" id="j" name="j" class="form-control" onchange="this.form.submit()">
													<option value="">--- Pilih Jabatan ---</option>																			
														<?php foreach ($position as $row): ?>
															<option value="<?php echo $row['position_id'] ?>" <?php echo (isset($f['j']) AND $f['j'] == $row['position_id']) ? 'selected' : '' ?> ><?php echo $row['position_name'] ?></option>
														<?php endforeach ?>
												</select>
											</td>
										</tr>
									</tbody>
								</table>
							</form>					
						</div>

						<div class="btn-group" style="margin-top:15px;">
							<?php echo form_open(current_url(), array('class' => 'form-horizontal', 'method' => 'get')) ?>
							<div class="input-group input-group-sm" style="width: 200px;">
								<input type="text" id="field" autofocus name="n" <?php echo (isset($f['n'])) ? 'placeholder="'.$f['n'].'"' : 'placeholder="NIP"' ?> class="form-control">
								<div class="input-group-btn">
									<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
								</div>
							</div>
							<?php echo form_close(); ?>
						</div>
						<!-- /.box-header -->
						<div class="card-body table-responsive">
							<table id="penggajian" class="table table-hover">
								<tr>
									<th><input type="checkbox" id="selectall" value="checkbox" name="checkbox"></th> 
									<th>No</th>
									<th>NIP</th>
									<th>Nama</th>
									<th>Unit Sekolah</th>
									<th>Jabatan</th>
									<th>Status Kepegawaian</th>
									<th>Aksi</th>
								</tr>
								<tbody>
									<?php
									if (!empty($pegawai)) {
										$i = 1;
										foreach ($pegawai as $row):
											?>
											<tr>
												<td><input type="checkbox" class="checkbox" name="msg[]" value="<?php echo $row['employee_id']; ?>"></td>
												<td><?php echo $i; ?></td>
												<td><?php echo $row['employee_nip']; ?></td>
												<td><?php echo $row['employee_name']; ?></td>
												<td><?php echo $row['employee_majors_id']; ?></td>
												<td><?php echo $row['employee_position_id']; ?></td>
                                                <td><?php echo $row['employee_category']; ?></td>
												<td>
													<a href="<?php echo site_url('manage/penggajian/show/' . $row['employee_id']) ?>" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Setting Gaji">Seting gaji</a>
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
})
</script>
<script>
	$(document).ready(function() {
		$("#selectall").change(function() {
			$(".checkbox").prop('checked', $(this).prop("checked"));
		});
	});
</script>