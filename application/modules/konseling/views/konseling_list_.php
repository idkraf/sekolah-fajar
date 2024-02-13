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
				<div class="box box-info">
					<div class="card-header with-border">
						<h3 class="card-title">Filter Data Siswa</h3>
					</div><!-- /.box-header -->
					<div class="card-body">
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
						<div class="card-header with-border">
							<h3 class="card-title">Informasi Siswa</h3>
							<?php if ($f['n'] AND $f['r'] != NULL) { ?>
								<a href="<?php echo site_url('manage/konseling/printBill' . '/?' . http_build_query($f)) ?>" target="_blank" class="btn btn-danger btn-xs pull-right">Cetak Buku Kesehatan</a>
							<?php } ?>
						</div><!-- /.box-header -->
						<div class="card-body">
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
					</div>

				<?php } ?>
			</div>
		</div>
	</section>
</div>

<div class="modal fade" id="dataSiswa" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h4 class="modal-title text-primary">Cari Data Siswa</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<div class="col-sm-3">
						<select required="" name="unit_id" id="unit_id" onchange="change_class()" class="form-control">
							<option value="">-- Pilih Unit --</option>
							<option value="1"> TK</option>
							<option value="2"> SD</option>
							<option value="3"> SMP</option>
							<option value="4"> SMA</option>
							<option value="5"> Lainnya</option>
						</select>    
					</div>
					<div id="div_class">
						<div class="col-sm-3">
							<select required="" name="kelas_id" id="kelas_id" class="form-control">
								<option value="">-- Pilih Kelas --</option>
							</select>
						</div>
					</div>
				</div>
				<br>
				<div id="div_student">
					<div class="card-body table-responsive">
						<table id="dtable" class="table table-hover dataTable no-footer" role="grid">
							<tr>
								<th>No</th>
								<th>NIS</th>
								<th>Nama</th>
								<th>Kelas</th>
								<th>Aksi</th>
							</tr>	
							<tbody>

							<?php
								$i =1;
								foreach ($students as $row):
										?>
										<tr>
											<td><?php echo $i ?></td>
											<td><?php echo $row['student_nis']; ?></td>
											<td><?php echo $row['student_full_name']; ?></td>
											<td><?php echo $row['class_name']; ?></td>
											<td align="center">
												<button type="button" data-dismiss="modal" class="btn btn-primary btn-xs" onclick="ambil_data('<?php echo $row['student_nis']; ?>')">Pilih</button>
											</td>
										</tr>
										<?php 
										$i++;
									endforeach; 
									?>	
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
	$(".loader").hide();

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
