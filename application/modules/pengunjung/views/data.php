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
                <table class="table table-striped" id="dataPengunjung">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Hari/Tanggal</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Keperluan</th>
                            <th>Gender</th>
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

            <?= form_open('manage/pengunjung/add'); ?>
            <div class="modal-body">

                <div class="form-group">
                    <label>Tanggal</label>
                    <div class="input-group date " data-date="" data-date-format="yyyy-mm-dd">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        <input class="form-control" type="text" name="tanggal" readonly="readonly" placeholder="Tanggal" >
                    </div>   
                </div>               
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control ">        
                </div>
                <div class="form-group">
                    <label>Keperluan</label>
                    <input type="text" name="keperluan" class="form-control ">        
                </div>
                <div class="form-group">
                    <label>Kelas <small data-toggle="tooltip" title="Wajib diisi">*</small></label>

                    <select name="kelas" class="form-control ">
                        <?php foreach ($class as $row): ?>
                            <option value="<?php echo $row['class_id'] ?>"><?php echo $row['class_name'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Gender</label>
                    <select name="gender" class="form-control">
                        <option value="1">Pria</option>
                        <option value="2">Wanita</option>
                    </select>     
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

            <?= form_open('manage/pengunjung/edit'); ?>
                <div class="modal-body">
          

                        <input type="hidden" name="id" class="edit_id" value="">

                        <div class="form-group">
                            <label>Tanggal</label>
                            <div class="input-group date " data-date="" data-date-format="yyyy-mm-dd">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                <input class="form-control tanggal" type="text" name="tanggal" readonly="readonly" placeholder="Tanggal" >
                            </div>        
                        </div>
                        
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control nama">        
                        </div>
                        <div class="form-group">
                            <label>Keperluan</label>
                            <input type="text" name="keperluan" class="form-control keperluan">        
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
                            <label>Gender</label>
                            <select name="gender" class="form-control genderx">
                                <option value="1">Pria</option>
                                <option value="2">Wanita</option>
                            </select>     
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
                
            <?= form_open('manage/pengunjung/delete'); ?>
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
            $('#dataPengunjung').DataTable({
                'processing': true,
                'serverSide': true,
                'stateSave': true,
                'order': [],
                'ajax': {
                    'url': "<?php echo site_url('manage/pengunjung/ajax_list') ?>",
                    'type': 'POST',
                    'data': {
                        'm': <?= isset($_GET['m']) ? $_GET['m'] : '0' ?>,
                        'pr': <?= isset($_GET['pr']) ? $_GET['pr'] : '0' ?>,
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
            $('.tanggal').val($(this).attr('data-tanggal'));
            $('.kelas').val($(this).attr('data-kelas'));
            $('.keperluan').val($(this).attr('data-keperluan'));
            $('.genderx').val($(this).attr('data-gender'));
            $(this).closest('tr').attr('id', $(this).attr('data-id'));
            $('#edit_model').modal({backdrop: 'static', keyboard: false});
        });

</script>