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
                <table class="table table-striped" id="dataObatOut">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                            <th>Unit/Kelas</th>
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
                <h4 class="modal-title">Tambah</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <?= form_open('manage/obatout/add'); ?>
            <div class="modal-body">

                <div class="form-group">
                    <label>Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" value="<?=date('Y-m-d');?>" required>
                </div>
                <div class="form-group">
                    <label>Obat</label>
                    <select name="obat_id" class="form-control select2" style="width:100%" required>
                        <option value="" selected>Pilih Obat</option>
                        <?php foreach ($obat as $s) : ?>
                            <option value="<?= $s['id'] ?>"><?= $s['nama_obat'] ?></option>
                        <?php endforeach; ?>
                    </select>     
                </div>
                <div class="form-group">
                    <label>Unit</label>
                    <select name="unit" class="form-control select2" style="width:100%" required>
                        <option value="" selected>Pilih Unit Sekolah</option>
                        <?php foreach ($majors as $s) : ?>
                            <option value="<?= $s['majors_id'] ?>"><?= $s['majors_name'] ?></option>
                        <?php endforeach; ?>
                    </select>     
                </div>
                <div class="form-group">
                    <label>Kelas</label>
                    <select name="kelas" class="form-control select2" style="width:100%" required>
                        <option value="" selected>Pilih Kelas</option>
                        <?php foreach ($class as $s) : ?>
                            <option value="<?= $s['class_id'] ?>"><?= $s['class_name'] ?></option>
                        <?php endforeach; ?>
                    </select>     
                </div>
                <div class="form-group">
                    <label>Jumlah</label>
                    <input type="text" name="jumlah" class="form-control">        
                </div>
                <div class="form-group">
                    <label>Keterangan</label> 
                    <input type="text" class="form-control" name="keterangan">   
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
                <h4 class="modal-title">Edit</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <?= form_open('manage/obatout/edit'); ?>
                <div class="modal-body">       

                    <input type="hidden" name="idobat_keluar" class="edit_id" value="">

                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" class="form-control tanggal" name="tanggal" value="<?=date('Y-m-d');?>" required>
                    </div>
                    <div class="form-group">
                        <label>Obat</label>
                        <select name="obat_id" class="form-control select2 obat_id" style="width:100%" required>
                            <?php foreach ($obat as $s) : ?>
                                <option value="<?= $s['id'] ?>"><?= $s['nama_obat'] ?></option>
                            <?php endforeach; ?>
                        </select>   
                    </div>
                    <div class="form-group">
                        <label>Unit Sekolah</label>
                        <select name="unit" class="form-control select2 unit_id" style="width:100%" required>
                            <?php foreach ($majors as $s) : ?>
                                <option value="<?= $s['majors_id'] ?>"><?= $s['majors_name'] ?></option>
                            <?php endforeach; ?>
                        </select>   
                    </div>
                    <div class="form-group">
                        <label>Kelas</label>
                        <select name="kelas" class="form-control select2 kelas_id" style="width:100%" required>
                            <?php foreach ($class as $s) : ?>
                                <option value="<?= $s['class_id'] ?>"><?= $s['class_name'] ?></option>
                            <?php endforeach; ?>
                        </select>   
                    </div>
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="text" name="jumlah" class="form-control jumlah">        
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" class="form-control keterangan" name="keterangan">          
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
                
            <?= form_open('manage/obatout/delete'); ?>
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
            $('#dataObatOut').DataTable({
                'processing': true,
                'serverSide': true,
                'stateSave': true,
                'order': [],
                'ajax': {
                    'url': "<?php echo site_url('manage/obatout/ajax_list') ?>",
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
                    },
                    'print',   
                ],
            });
        };

        $(document).on('click', ".edit-obat", function (e) {
            e.preventDefault();
            $('.edit_id').val($(this).attr('data-id'));
            $('.tanggal').val($(this).attr('data-tanggal'));
            $('.obat_id').val($(this).attr('data-obat-id'));
            $('.unit_id').val($(this).attr('data-unit'));
            $('.kelas_id').val($(this).attr('data-kelas'));
            $('.jumlah').val($(this).attr('data-jumlah'));
            $('.keterangan').val($(this).attr('data-keterangan'));
            $(this).closest('tr').attr('id', $(this).attr('data-id'));
            $('#edit_model').modal({backdrop: 'static', keyboard: false});
        });

    });
</script>