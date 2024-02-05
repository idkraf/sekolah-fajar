<div class="content-wrapper">
  <section class="content-header">
		<h1>
			<?php echo isset($title) ? '' . $title : null; ?>
			<small></small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('manage') ?>"><i class="fa fa-th"></i> Home</a></li>
			<li class="active"><?php echo isset($title) ? '' . $title : null; ?></li>
		</ol>
	</section>
	<section class="content">
        <?= $this->session->flashdata('pesan'); ?>
        <div class="box shadow-sm border-bottom-primary">
            <div class="box-body table-responsive">
                <table class="table table-striped" id="dataBuku">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kode Buku</th>
                            <th>Judul</th>
                             <th>Aksi</th>
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
                <h4 class="modal-title">Tambah</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <?= form_open('manage/buku/add'); ?>
            <div class="modal-body">
                <!-- form id="add_form" -->
                    <div class="form-group">
                        <label>Kode Buku</label>
                        <input type="text" name="kode" class="form-control">        
                    </div>
                    <div class="form-group">
                        <label>Nama Buku</label>
                        <input type="text" name="nama" class="form-control">        
                    </div>
                <!-- /form -->
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
                <h4 class="modal-title">Edit</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <?= form_open('manage/buku/edit'); ?>
            <div class="modal-body">


                    <input type="hidden" name="id" class="edit_id" value="">

                    <div class="form-group">
                        <label>Kode Buku</label>
                        <input type="text" name="kode" class="form-control kode">        
                    </div>
                    <div class="form-group">
                        <label>Nama Buku</label>
                        <input type="text" name="nama" class="form-control nama">        
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

                <h4 class="modal-title">Hapus</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Hapus data ini?</p>
            </div>
            <div class="modal-footer">
            <?= form_open('manage/buku/delete'); ?>
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
            $('#dataBuku').DataTable({
                'processing': true,
                'serverSide': true,
                'stateSave': true,
                'order': [],
                'ajax': {
                    'url': "<?php echo site_url('manage/buku/ajax_list') ?>",
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
            $('.nama').val($(this).attr('data-nama'));
            $('.kode').val($(this).attr('data-kode'));

            $(this).closest('tr').attr('id', $(this).attr('data-id'));
            $('#edit_model').modal({backdrop: 'static', keyboard: false});

        });

</script>