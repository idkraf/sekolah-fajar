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
												<!--select style="width: 200px;" id="us" name="us" class="form-control">
													<option value="0" <?php echo $us == "all" ? 'selected' : '' ?>>Semua Unit</option>
													<option value="1" <?php echo $us == "1" ? 'selected' : '' ?>>TK</option>
													<option value="2" <?php echo $us == "2" ? 'selected' : '' ?>>SD</option>
													<option value="3" <?php echo $us == "3" ? 'selected' : '' ?>>SMP</option>
													<option value="4" <?php echo $us == "4" ? 'selected' : '' ?>>SMA</option>
													<option value="99" <?php echo $us == "99" ? 'selected' : '' ?>>Lainnya</option>
												</select-->
												
												<select style="width: 200px;" name="us" class="form-control" onchange="this.form.submit()">
													<option value="0">---Pilih Unit---</option>
													<?php foreach ($majors as $row): ?>
														<option value="<?php echo $row['majors_id'] ?>" <?php echo (isset($us) AND $us == $row['majors_id']) ? 'selected' : '' ?> ><?php echo $row['majors_name'] ?></option>
													<?php endforeach ?>
												</select>
											</td>
											<td>
												<div class="col-sm-2">
													<select style="width: 200px;" class="form-control" name="pr">
														<option value="0">-- Semua Kelas  --</option>
														<?php foreach ($class as $row): ?>
															<option <?php echo $pr == $row['class_id'] ? 'selected' : '' ?> value="<?php echo $row['class_id'] ?>"><?php echo $row['class_name'] ?></option>
														<?php endforeach; ?>
													</select>
												</div>
											</td>
											<td>				
												<div class="col-sm-2">								
													<select style="width: 200px;" id="st" name="st" class="form-control" >
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
						<!-- /.box-header -->
						<div class="card-body table-responsive">
							<table id="siswa" class="table table-striped table-bordered zero-configuration table-sm">
								<thead>
									<th>No</th>
									<th>NIS</th>
									<th>Nama</th>
									<th>Unit</th>
									<th>Kelas</th>									
									<th>WA Ortu</th>
									<th>Status</th>
									<th>Aksi</th>
									<th class="hidden">No</th>
									<th class="hidden">NIS</th>
									<th class="hidden">Nik</th>
									<th class="hidden">Virtual Bank</th>
									<th class="hidden">Unit</th>
									<th class="hidden">Nisn</th>
									<th class="hidden">Nama</th>
									<th class="hidden">Panggilan</th>
									<th class="hidden">Tempat Lahir</th>
									<th class="hidden">Tanggal Lahir</th>
									<th class="hidden">Gender</th>
									<th class="hidden">Phone</th>
									<th class="hidden">Email</th>
									<th class="hidden">Warga Negara</th>
									<th class="hidden">Agama</th>
									<th class="hidden">Pelajaran Agama</th>
									<th class="hidden">Alamat</th>
									<th class="hidden">Kelurahan</th>
									<th class="hidden">Kecamatan</th>
									<th class="hidden">Provinsi</th>
									<th class="hidden">Golongan Darah</th>
									<th class="hidden">Tingkatan</th>									
									<th class="hidden">Kelas</th>
									<th class="hidden">Jurusan</th>
									<th class="hidden">Anak Ke</th>
									<th class="hidden">Jumlah Saudara</th>
									<th class="hidden">Tanggal Masuk</th>
									<th class="hidden">Penyakit Pernah diderita</th>
									<th class="hidden">Tinggi</th>
									<th class="hidden">Berat</th>
									<th class="hidden">Bahasa rumah</th>
									<th class="hidden">Imunisasi</th>
									<th class="hidden">Alergi Makanan</th>
									<th class="hidden">Nama Ayah</th>
									<th class="hidden">Pekerjaan Ayah</th>
									<th class="hidden">Alamat Ayah</th>
									<th class="hidden">Telp Ayah</th>
									<th class="hidden">Email Ayah</th>
									<th class="hidden">Agama Ayah</th>
									<th class="hidden">Tempat lahir ayah</th>
									<th class="hidden">Tanggal lahir ayah</th>
									<th class="hidden">Warganegara ayah</th>
									<th class="hidden">Pendidikan Terakhir Ayah</th>
									<th class="hidden">Nama Ibu</th>
									<th class="hidden">Pekerjaan Ibu</th>
									<th class="hidden">Alamat Ibu</th>
									<th class="hidden">Telp Ibu</th>
									<th class="hidden">Email Ibu</th>
									<th class="hidden">Agama Ibu</th>
									<th class="hidden">Tempat lahir ibu</th>
									<th class="hidden">Tanggal lahir ibu</th>
									<th class="hidden">Warganegara ibu</th>
									<th class="hidden">Pendidikan Terakhir ibu</th>
									<th class="hidden">Pekerjaan Wali</th>
									<th class="hidden">Nama Wali</th>
									<th class="hidden">Alamat Wali</th>
									<th class="hidden">Telp Wali</th>
									<th class="hidden">Email Wali</th>
									<th class="hidden">Status</th>									
									<th class="hidden">Alumni</th>
									<th class="hidden">Asal Sekolah</th>
									<th class="hidden">Pindah Ke</th>
									<th class="hidden">Alasan Pindah</th>
									<th class="hidden">Status Dalam Keluarga</th>
									<th class="hidden">Tanggal Keluar</th>
									
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
						<!-- /.box-body -->
					</div>
			<div>
			<!-- /.box -->
		</div>
	</section>
	<!-- /.content -->
</div>

	<script type="text/javascript">
		$(document).ready(function () {
			draw_data();
			function draw_data() {
				$('#siswa').DataTable({
					'processing': true,
					'serverSide': true,
					'stateSave': true,
					//responsive: true,
					'order': [],
					'ajax': {
						'url': "<?php echo site_url('manage/student/ajax_list') ?>",
						'type': 'POST',
						'data': {
							'st': <?= isset($_GET['st']) ? $_GET['st'] : '0' ?>,
							'us': <?= isset($_GET['us']) ? $_GET['us'] : '0' ?>,
							'pr': <?= isset($_GET['pr']) ? $_GET['pr'] : '0' ?>,
							'<?= $this->security->get_csrf_token_name() ?>': crsf_hash
						}
					},
					'columnDefs': [
						{
							'targets': [0,1,2,3,4,5,6,7],
							'visible':true,
							'orderable': false,
						},
						{ 
							'targets': [8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72], 
							'visible': false 
						}
					],
					dom: 'Blfrtip',
					lengthMenu: [10, 20, 50, 100, 200, 500],
					buttons: [                    
						{
							text: 'Tambah',
							action: function ( e, dt, node, config ) {
							window.location = '<?php echo site_url('manage/student/add') ?>'
							}
						},                
						{
							text: 'Upload',
							action: function ( e, dt, node, config ) {
								window.location = '<?php echo site_url('manage/student/import') ?>'
							}
						},
						{
							extend: 'excelHtml5',
							footer: false,
							exportOptions: {
								columns: [8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72]
							}
							//exportOptions: {
							//	customizeData: function (d) {
							//		var exportBody = GetDataToExport();
							//		d.body.length = 0;
							//		d.body.push.apply(d.body, exportBody);
							//	}
							//}							
							//action: function ( e, dt, node, config ) {
							//	$.ajax({ 
							//		url: '<?php echo site_url('manage/student/export') ?>',
							//		method: 'POST',
							//		data: {
							//			'search': '',
							//			'<?= $this->security->get_csrf_token_name() ?>': crsf_hash
							//		},									
							//		'dataSrc': function (d) {
							//			return d
							//		}
							//	}).then(function (ajaxReturnedData) {
							//		console.log(ajaxReturnedData);
							//		dt.rows.add(ajaxReturnedData.data).draw();
							//		$.fn.dataTable.ext.buttons.excelHtml5.action.call(this, e, dt, node, config);

							//	});
							//}
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