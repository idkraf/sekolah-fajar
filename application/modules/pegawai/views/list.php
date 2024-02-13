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
					<div class="card-body table-responsive">
						<form action="" class="form-horizontal" method="get" accept-charset="utf-8">
							<table>
								<tbody>
									<tr>
										<td>     
											<select style="width: 200px;" name="m" class="form-control" onchange="this.form.submit()">
												<option value="0">Semua Unit</option>
												<?php foreach ($majors as $row): ?>
													<option <?php echo $m == $row['majors_id'] ? 'selected' : '' ?> value="<?php echo $row['majors_id'] ?>"><?php echo $row['majors_name'] ?></option>
												<?php endforeach; ?>
											</select>
										</td>
										<td>
											<select style="width: 200px;" name="j" class="form-control" onchange="this.form.submit()">
												<option value="0">-- Semua Jabatan  --</option>
												<?php foreach ($position as $row): ?>
													<option <?php echo $j == $row['position_id'] ? 'selected' : '' ?> value="<?php echo $row['position_id'] ?>"><?php echo $row['position_name'] ?></option>
												<?php endforeach; ?>
											</select>
										</td>
									</tr>
								</tbody>
							</table>
						</form>					
					</div>
					<!-- /.box-header -->
					<div class="card-body table-responsive">
						<table id="pegawai-view" class="table table-striped table-bordered zero-configuration table-sme">
							<thead>
								<th>No</th>
								<th>NIP</th>
								<th>Nama</th>
								<th>Unit Sekolah</th>
								<th>Jabatan</th>
								<th>Status Kepegawaian</th>
								<th>No. Telpon/HP</th>
								<th>Status</th>
								<th>Aksi</th>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
		</section>
		<!-- /.content -->
	</div>

	<script type="text/javascript">
		$(document).ready(function () {
			draw_data();

			function draw_data() {
				$('#pegawai-view').DataTable({
					'processing': true,
					'serverSide': true,
					'stateSave': true,
					//responsive: true,
					'order': [],
					'ajax': {
						'url': "<?php echo site_url('manage/pegawai/ajax_list') ?>",
						'type': 'POST',
						'data': {
							'm': <?= isset($_GET['m']) ? $_GET['m'] : '0' ?>,
							'j': <?= isset($_GET['j']) ? $_GET['j'] : '0' ?>,
							'<?= $this->security->get_csrf_token_name() ?>': crsf_hash
						}
					},
					'columnDefs': [
						{
							'targets': [0,1,2,3,4,5,6,7,8],
							'orderable': false,
						},
					],
					dom: 'Blfrtip',
					lengthMenu: [10, 20, 50, 100, 200, 500],
					buttons: [                    
						{
							text: 'Tambah',
							action: function ( e, dt, node, config ) {
							window.location = '<?php echo site_url('manage/pegawai/add') ?>'
							}
						},            
						{
							text: 'Upload',
							action: function ( e, dt, node, config ) {
							window.location = '<?php echo site_url('manage/pegawai/import') ?>'
							}
						},
						{
							extend: 'excelHtml5',
							footer: false,
							exportOptions: {
								columns: [1, 2, 3, 4, 5, 6, 7, 8]
							}
						}
					],
				});
			};
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