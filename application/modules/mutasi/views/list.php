<div class="content-wrapper">
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
        <?= $this->session->flashdata('pesan'); ?>
        <div class="box shadow-sm border-bottom-primary">
            <div class="card-body table-responsive">
                <table class="table table-striped w-100 dt-responsive " id="mutasi">
                    <thead>
                        <tr>
                            <th>No. </th>
                            <th>Kode Barang</th>
                            <th>Kode Register</th>
                            <th>Nama Barang</th>
                            <th>Nama Pengajuan</th>
                            <th>Unit</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Tempat asal barang</th>
                            <th>Tempat tujuan barang</th>
                            <th>Keterangan</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>


<div id="add_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content bg-secondary">
            <div class="modal-header">
                <h4 class="modal-title">Tambah</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <?= form_open('manage/mutasi/add'); ?>
            <div class="modal-body">
                    <div class="form-group">
                        <label>Unit</label>
                        <select name="majors_id" class="form-control">   
                            <?php foreach ($majors as $s) : ?>
                                <option value="<?= $s['majors_id'] ?>"><?= $s['majors_name'] ?></option>
                            <?php endforeach; ?>  
                        </select>     
                    </div>
                    <div class="form-group">
                        <label>Pegawai</label>
                        <select name="user_id" class="form-control">     
                            <?php foreach ($employee as $row): ?>
                                <option value="<?php echo $row['employee_id'] ?>"><?php echo $row['employee_name'] ?></option>
                            <?php endforeach; ?> 
                        </select>        
                    </div>
                    <div class="form-group">
                        <label>Aset</label>
                        <select name="aset_id" class="form-control">    
                            <?php foreach ($aset as $row): ?>
                                <option value="<?php echo $row['id'] ?>"><?php echo $row['nama_barang'] ?></option>
                            <?php endforeach; ?>  
                        </select>   
                    </div>
                    
                    <div class="form-group">
                        <label>Tanggal Pengajuan</label>
                        <input type="text" name="tempat_asal_barang" class="form-control">        
                    </div>
                    <div class="form-group">
                        <label>Tempat Asal barang</label>
                        <input type="text" name="tempat_asal_barang" class="form-control">        
                    </div>
                    <div class="form-group">
                        <label>Tempat Tujuan Barang</label>
                        <input type="text" name="tempat_asal_barang" class="form-control">        
                    </div>
                    <div class="form-group">
                        <label>Keteerangan</label>
                        <input type="text" name="keterangan" class="form-control">        
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">Close</button>
                <button type="submit" id="simpanAdd1" class="btn btn-primary">Simpan</button>
            </div>
            
            <?= form_close(); ?>
        </div>
    </div>

</div>

<div id="edit_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content bg-secondary">
            <div class="modal-header">
                <h4 class="modal-title">Edit</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <?= form_open('manage/mutasi/edit'); ?>
                <div class="modal-body">          

                    <input type="hidden" name="id" class="edit_id" value="">

                    <div class="form-group">
                        <label>Unit</label>
                        <select name="majors_id" class="majors_id form-control">
                            <?php foreach ($majors as $s) : ?>
                                <option value="<?= $s['majors_id'] ?>"><?= $s['majors_name'] ?></option>
                            <?php endforeach; ?>                                 
                        </select>     
                    </div>
                    <div class="form-group">
                        <label>Pegawai</label>
                        <select name="user_id" class="user_id form-control">  
                            <?php foreach ($employee as $row): ?>
                                <option value="<?php echo $row['employee_id'] ?>"><?php echo $row['employee_name'] ?></option>
                            <?php endforeach; ?>     
                        </select>        
                    </div>
                    <div class="form-group">
                        <label>Aset</label>
                        <select name="aset_id" class="aset_id form-control">  
                            <?php foreach ($aset as $row): ?>
                                <option value="<?php echo $row['id'] ?>"><?php echo $row['nama_barang'] ?></option>
                            <?php endforeach; ?>    
                        </select>   
                    </div>
                    
                    <div class="form-group">
                        <label>Tanggal Pengajuan</label>
                        <input type="text" name="tempat_asal_barang" class="tempat_asal_barang form-control">        
                    </div>
                    <div class="form-group">
                        <label>Tempat Asal barang</label>
                        <input type="text" name="tempat_asal_barang" class="tempat_asal_barang form-control">        
                    </div>
                    <div class="form-group">
                        <label>Tempat Tujuan Barang</label>
                        <input type="text" name="tempat_asal_barang" class="tempat_asal_barang form-control">        
                    </div>
                    <div class="form-group">
                        <label>Keteerangan</label>
                        <input type="text" name="keterangan" class="keterangan form-control">        
                    </div>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">Close</button>
                    <button type="submit" id="simpanEdit1" class="btn btn-primary">Simpan</button>
                </div>
            <?= form_close(); ?>
        </div>
    </div>

</div>

<div id="delete_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content bg-secondary">
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
                
            <?= form_open('manage/mutasi/delete'); ?>
                <input type="hidden" name="deleteid" id="object-id" value="">
                <button type="submit" class="btn btn-primary">Hapus</button>
                <button type="button" data-dismiss="modal"
                        class="btn">Batal</button>
                        
            <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        draw_data();

        function draw_data() {
            $('#mutasi').DataTable({
                'processing': true,
                'serverSide': true,
                'stateSave': true,
                responsive: true,
                'order': [],
                'ajax': {
                    'url': "<?php echo site_url('manage/mutasi/ajax_list') ?>",
                    'type': 'POST',
                    'data': {
                        '<?= $this->security->get_csrf_token_name() ?>': crsf_hash
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
                    {
                        text: 'Tambah',
                        action: function ( e, dt, node, config ) {
                            //popup                            
                            $('#add_model').modal('show');
                            $('#add_model').modal({backdrop: 'static', keyboard: false});
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        footer: false,
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6, 7]
                        }
                    },
                    'print',  
                ],
            });
        };
        
        $(document).on('click', ".edit-object", function (e) {
            e.preventDefault();
            $('.edit_id').val($(this).attr('data-id'));
            $('.majors_id').val($(this).attr('data-majorsid'));
            $('.aset_id').val($(this).attr('data-aset-id'));
            $('.user_id').val($(this).attr('data-user-id'));
            $('.tanggal_pengajuan').val($(this).attr('data-tanggal-pengajuan'));
            $('.tempat_asal_barang').val($(this).attr('data-tempat-asal-barang'));
            $('.tempat_tujuan_barang').val($(this).attr('data-tempat-tujuan-barang'));
            $('.keterangan').val($(this).attr('data-keterangan'));

            $(this).closest('tr').attr('id', $(this).attr('data-id'));
            $('#edit_model').modal({backdrop: 'static', keyboard: false});
        });

    });
</script>