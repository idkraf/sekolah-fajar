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
            <div class="table-responsive">
                <table class="table table-striped" id="dataSakit">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Keluhan</th>
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
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-primary">Tambah</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <?= form_open('manage/sakit/add'); ?>
            <div class="modal-body">

                <div class="form-group">
                    <label>Tanggal</label>
                    <div class="input-group">
                        <!--span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span-->
                        <input class="form-control" type="date" name="tanggal" placeholder="Tanggal" >
                    </div>   
                </div>       
                    <div class="form-group">
                        <label>Student <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
                        <select name="student_id" class="form-control">
                            <option value="">---Pilih Siswa---</option>
                            <?php foreach ($students as $row): ?>
                                <option value="<?php echo $row['student_id'] ?>" >
                                    <?php echo $row['student_full_name'] ?>
                                </option>
                            <?php endforeach ?>
                            
                        </select>
                    </div> 
                        <div class="form-group">
                            <label>Keluhan</label>
                            <input type="text" name="keluhan" class="form-control">        
                        </div>
                        
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" name="keterangan" class="form-control">        
                        </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            
            <?= form_close(); ?>
        </div>
    </div>

</div>

<div id="edit_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-primary">Edit</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <?= form_open('manage/sakit/edit'); ?>
                <div class="modal-body">
          

                        <input type="hidden" name="id" class="edit_id" value="">

                        <div class="form-group">
                            <label>Tanggal</label>
                            <div class="input-group">
                                <!--span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span-->
                                <input class="form-control tanggal" type="date" name="tanggal" placeholder="Tanggal" >
                            </div>        
                        </div>
                        <div class="form-group">
                            <label>Student <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
                            <select name="student_id" class="form-control student_id">
                                <?php foreach ($students as $row): ?>
                                    <option value="<?php echo $row['student_id'] ?>" >
                                        <?php echo $row['student_full_name'] ?>
                                    </option>
                                <?php endforeach ?>
                                
                            </select>
                        </div> 
                        <div class="form-group">
                            <label>Keluhan</label>
                            <input type="text" name="keluhan" class="form-control keluhan">        
                        </div>
                        
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" name="keterangan" class="form-control keterangan">        
                        </div>

                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            <?= form_close(); ?>
        </div>
    </div>

</div>

<div id="delete_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-primary">Hapus</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Hapus data ini?</p>
            </div>
            <div class="modal-footer">
                
            <?= form_open('manage/sakit/delete'); ?>
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
            $('#dataSakit').DataTable({
                'processing': true,
                'serverSide': true,
                'stateSave': true,
                'order': [],
                'ajax': {
                    'url': "<?php echo site_url('manage/sakit/ajax_list') ?>",
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
                            
                           $('#add_model').modal('show');
                            $('#add_model').modal({backdrop: 'static', keyboard: false});
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
    
    $(document).on('click', ".edit-object", function (e) {
            e.preventDefault();
            $('.edit_id').val($(this).attr('data-id'));
            $('.student_id').val($(this).attr('data-student-id'));
            $('.tanggal').val($(this).attr('data-tanggal'));
            $('.keluhan').val($(this).attr('data-keluhan'));
            $('.keterangan').val($(this).attr('data-keterangan'));
            $(this).closest('tr').attr('id', $(this).attr('data-id'));
            $('#edit_model').modal({backdrop: 'static', keyboard: false});
        });

</script>