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
                                    <select style="width: 200px;" name="pr" class="form-control" onchange="this.form.submit()">
                                        <option value="0">-- Semua Kelas  --</option>
                                        <?php foreach ($kelas as $row): ?>
                                            <option <?php echo $pr == $row['class_id'] ? 'selected' : '' ?> value="<?php echo $row['class_id'] ?>"><?php echo $row['class_name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>					
            </div>
            <div class="card-body table-responsive">               										
                <table class="table table-striped" id="dataPeminjaman">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Hari/Tanggal</th>
                            <th>Nama</th>
                            <th>Unit</th>
                            <th>Kelas</th>
                            <th>Judul Buku</th>
                            <th>Kode Buku</th>
                            <th>Tanggal Kembali</th>
                            <th>keterangan</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                </tfoot>
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

            <?= form_open('manage/peminjaman/add'); ?>
            <div class="modal-body">
                    <div class="form-group">
                        <label>Tanggal Pinjam </label>
                        <div class="input-group">
                            <!--span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span-->
                            <input class="form-control" type="date" name="tgl_pinjam" placeholder="Tanggal" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Pengembalian</label>
                        <div class="input-group">
                            <!--span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span-->
                            <input class="form-control" type="date" name="tgl_kembali" placeholder="Tanggal">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Buku <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
                        <select name="buku_id" class="form-control">
                            <option value="">---Pilih Buku---</option>
                            <?php foreach ($buku as $row): ?>
                                <option value="<?php echo $row['id'] ?>" >
                                    <?php echo $row['nama'] ?>
                                </option>
                            <?php endforeach ?>
                            
                        </select>
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
                        <label>Unit Sekolah <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
                        <select name="unit" class="form-control">
                            <option value="">---Pilih Unit Sekolah---</option>
                            <?php foreach ($majors as $row): ?>
                                <option value="<?php echo $row['majors_id'] ?>" >
                                    <?php echo $row['majors_name'] ?>
                                </option>
                            <?php endforeach ?>
                            
                        </select>
                    </div> 
                    <div class="form-group">
                        <label>Kelas <small data-toggle="tooltip" title="Wajib diisi">*</small></label>

                        <select name="kelas" class="form-control">
                                <option value="">-- Pilih Kelas --</option>
                            <?php foreach ($class as $row): ?>
                                <option value="<?php echo $row['class_id'] ?>"><?php echo $row['class_name'] ?></option>
                            <?php endforeach ?>
                        </select>
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

            <?= form_open('manage/peminjaman/edit'); ?>
            <div class="modal-body">
                    <input type="hidden" name="id" class="edit_id" value="">

                    <div class="form-group">
                        <label>Tanggal Pinjam </label>
                        <div class="input-group">
                            <!--span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span-->
                            <input class="form-control tgl_pinjam" type="date" name="tgl_pinjam" placeholder="Tanggal" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Pengembalian</label>
                        <div class="input-group">
                            <!--span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span-->
                            <input class="form-control tgl_kembali" type="date" name="tgl_kembali" placeholder="Tanggal">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Buku <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
                        <select name="buku_id" class="form-control buku_id">
                            <?php foreach ($buku as $row): ?>
                                <option value="<?php echo $row['id'] ?>" >
                                    <?php echo $row['nama'] ?>
                                </option>
                            <?php endforeach ?>
                            
                        </select>
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
                        <label>Unit Sekolah <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
                        <select name="unit" class="form-control unit">
                            <?php foreach ($majors as $row): ?>
                                <option value="<?php echo $row['majors_id'] ?>" >
                                    <?php echo $row['majors_name'] ?>
                                </option>
                            <?php endforeach ?>
                            
                        </select>
                    </div> 
                    <div class="form-group">
                        <label>Kelas <small data-toggle="tooltip" title="Wajib diisi">*</small></label>

                        <select name="kelas" class="form-control kelas">
                            <?php foreach ($class as $row): ?>
                                <option value="<?php echo $row['class_id'] ?>"><?php echo $row['class_name'] ?></option>
                            <?php endforeach ?>
                        </select>
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

                <h4 class="modal-title text-primary">Hapus </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Hapus data ini?</p>
            </div>
            <div class="modal-footer">
            <?= form_open('manage/peminjaman/delete'); ?>
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
            $('#dataPeminjaman').DataTable({
                'processing': true,
                'serverSide': true,
                'stateSave': true,
                'order': [],
                'ajax': {
                    'url': "<?php echo site_url('manage/peminjaman/ajax_list') ?>",
                    'type': 'POST',
                    'data': {
                        'm': <?= isset($_GET['m']) ? $_GET['m'] : '0' ?>,
                        'pr': <?= isset($_GET['pr']) ? $_GET['pr'] : '0' ?>,
                        '<?= $this->security->get_csrf_token_name() ?>': crsf_hash
                    }
                },
                'columnDefs': [
                    {
                        'targets': [0,1,2,3,4,5,6,7,8,9],
                        'orderable': false,
                    },
                ],
                dom: 'Blfrtip',
                lengthMenu: [10, 20, 50, 100, 200, 500],                        
                //initComplete: function () {
                //    this.api().columns( [3,4] ).every( function () {
                //        var column = this;
                //        var select = $('<select><option value=""></option></select>')
                //            .appendTo( $('#search') )
                //            .on( 'change', function () {
                //                var val = $.fn.dataTable.util.escapeRegex(
                //                    $(this).val()
                //                );
        
                //                column
                //                    .search( val ? '^'+val+'$' : '', true, false )
                //                    .draw();
                //            } );
        
                //        column.data().unique().sort().each( function ( d, j ) {
                //            select.append( '<option value="'+d+'">'+d+'</option>' )
                //        } );
                //    });
                //},
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
                            columns: [1, 2, 3, 4, 5, 6, 7]
                        }
                    },
                    //{
                    //    extend: 'collection',
                    //    text: 'Unit',
                    //    buttons: [
                    //        <?php foreach ($majors as $row): ?>
                    //            {
                    //                text: '<?php echo $row['majors_name'] ?>',
                    //                action: function ( e, dt, node, config ) {
                                       //dt.column( 3 ).visible( ! dt.column(3 ).visible() );
                    //                   dt.column( 3 ).search('<?php echo $row['majors_name'] ?>', true, false).draw();
                    //                }
                    //            },
                    //        <?php endforeach; ?>
                    //    ]
                    //},
                    //{
                    //    extend: 'collection',
                    //    text: 'Kelas',
                    //    buttons: [
                    //        <?php foreach ($class as $row): ?>
                    //            {
                    //                text: '<?php echo $row['class_name'] ?>',
                    //                action: function ( e, dt, node, config ) {
                    //                   dt.column( 4 ).search('<?php echo $row['class_name'] ?>', true, false).draw();
                    //                }
                    //            },
                    //        <?php endforeach; ?>
                    //    ]
                    //}
                ],
            });
        };
        

        $(document).on('click', ".edit-object", function (e) {
            e.preventDefault();
            $('.edit_id').val($(this).attr('data-id'));
            $('.unit').val($(this).attr('data-unit'));
            $('.kelas').val($(this).attr('data-kelas'));
            $('.student_id').val($(this).attr('data-student-id'));
            $('.buku_id').val($(this).attr('data-buku-id'));
            $('.tgl_pinjam').val($(this).attr('data-tgl-pinjam'));
            $('.tgl_kembali').val($(this).attr('data-tgl-kembali'));
            $('.keterangan').val($(this).attr('data-keterangan'));

            $(this).closest('tr').attr('id', $(this).attr('data-id'));
            $('#edit_model').modal({backdrop: 'static', keyboard: false});

        });
    });
</script>