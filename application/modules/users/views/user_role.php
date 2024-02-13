<div class="content-wrapper" style="min-height: 293px;">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Manajemen Pengguna		</h1>
		<ol class="breadcrumb">
			<li><a href="https://demo.adminsekolah.net/manage"><i class="fa fa-th"></i> Home</a></li>
			<li class="active">Manajemen Pengguna</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">

		<div class="row">
			<div class="col-md-4">

				<!-- Profile Image -->
				<div class="box box-primary">
					<div class="card-body">
						
						<div class="form-group">
							<label>Role <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
							<select name="role_id" id="role_id" class="form-control" onchange="loadData()">
								<option value="">-Pilih Hak Role -</option>								 
								<?php foreach ($roles as $row): ?> 
									<option value="<?php echo $row['role_id']; ?>"><?php echo $row['role_name']; ?></option>
								<?php endforeach; ?>

                                <!--
                                    <option value="1">Super User</option>

									<option value="8">AKADEMIK</option>
								 
									<option value="7">KESISWAAN</option>
								 
									<option value="6">TATA USAHA</option>
								 
									<option value="5">GURU</option>
								 
									<option value="4">KEUANGAN</option>
								 
									<option value="2">KASIR</option>
                                -->
                                </select>
						</div>
						
													
						<a href="/manage/users/" class="btn btn-info btn-block"><b>Kembali</b></a>

						
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->

			</div>
			<div class="col-md-8">
				<!-- About Me Box -->
				<div class="box box-primary">
					<div class="card-header with-border">
						<h3 class="card-title">Hak Akses</h3>
					</div>
					<!-- /.box-header -->
					<div class="card-body">
					    <div id="tabel">
                            <table data-paging="false" data-searching="false" data-ordering="false" id="dataPermision" class="table table-hover table-responsive">
                                <thead>
                                    <th width="10">No</th>
                                    <th>Nama Modul</th>
                                    <th>Keterangan</th>
                                    <th width="100">Aksi</th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>	
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->

			</div>
		</div>
	</section>
</div>
<script type="text/javascript">
	var SITEURL = "<?php echo site_url() ?>";
	//loadDdraw_data();

	function loadData() {
        var role_id = $("#role_id").val();
		console.log(role_id);
		$('#dataPermision').DataTable({
			'processing': true,
			'serverSide': true,
			'stateSave': true,
			paging: false,
			destroy: true,
			searching: false,
			'order': [],
			'ajax': {
				'url': "<?php echo site_url('manage/users/modul') ?>",
				'type': 'POST',
				'data': {
					'<?= $this->security->get_csrf_token_name() ?>': crsf_hash,
					'role_id': role_id,
				}
			},
			'columnDefs': [
				{
					'targets': [0],
					'orderable': false,
				},
			],
			dom: 'Blfrtip',
			lengthMenu: [10, 20, 50, 100, 200, 500],
			buttons: [
			],
		});
	};

    function loadData_(){
        var role_id = $("#role_id").val();
        $.ajax({
            type:'GET',
            url : SITEURL +'manage/users/modul',
            data:'role_id='+role_id,
            success:function(html){
                //$("#tabel").html(html);
                console.log(html);
            }
        })
    }
    
	$(document).on('click', ".updrole", function (e) {
		var permission_id  = $(this).attr('data-id');
		console.log(permission_id);
        var role_id = $("#role_id").val();
		console.log(role_id);
        $.ajax({
            type:'GET',
            url : SITEURL +'manage/users/updaterule',
            data:'role_id='+role_id+'&permission_id='+permission_id,
            success:function(event){		
			}
        })
	});
	$(document).on('click', ".cek", function (e) {
		var permission_id  = $(this).attr('data-id');
		console.log(permission_id);
        var role_id = $("#role_id").val();
		console.log(role_id);
        $.ajax({
            type:'GET',
            url : SITEURL +'manage/users/addrule',
            data:'role_id='+role_id+'&permission_id='+permission_id,
            success:function(event){
       			//$(this).attr('cek').remove();
				//$(".cek").toggleClass('cek hapus');	
				//e.preventDefault();
				
				e.target.classList.toggle('hapus');			
			}
        })
	});
	$(document).on('click', ".hapus", function (e) {
		var permission_id  = $(this).attr('data-id');
		console.log(permission_id);
        var role_id = $("#role_id").val();
		console.log(role_id);
        $.ajax({
            type:'GET',
            url : SITEURL +'manage/users/hapusrule',
            data:'role_id='+role_id+'&permission_id='+permission_id,
            success:function(event){
       			//$(this).attr('hapus').remove();
				//$(".hapus").toggleClass('hapus cek');
				//e.preventDefault();
				e.target.classList.toggle('cek');	
			}
        })
	});
</script>