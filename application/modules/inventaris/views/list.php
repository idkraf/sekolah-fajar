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
										
        <div class="card-body table-responsive">
            <form action="" class="form-horizontal" method="get" accept-charset="utf-8">
                
                <table>
                    <tbody>
                        <tr>
                            <td>     
                                <select name="m" class="unit form-control">
                                    <option value="">- Pilih Unit -</option>                        
                                    <?php foreach ($majors as $s) : ?>
                                        <option value="<?= $s['majors_id'] ?>" <?php echo (isset($m) AND $m == $s['majors_id']) ? 'selected' : '' ?>>
                                            <?= $s['majors_name'] ?></option>
                                        <?php endforeach; ?>
                                </select>
                            </td>
                            <td>
                                    
                                <select name="r" class="ruangan form-control">
                                    <option value="0">- Pilih Ruangan -</option>
                                    <?php foreach ($ruangan as $row): ?>
                                        <option value="<?php echo $row['idruangan'] ?>" <?php echo (isset($r) AND $r == $row['idruangan']) ? 'selected' : '' ?>>
                                        <?php echo $row['nama_ruangan'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Cari</button>    
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>		
        </div>
        <?= $this->session->flashdata('pesan'); ?>
        <div class="box shadow-sm border-bottom-primary">
            <div class="card-body table-responsive">
                <table class="table table-striped w-100 dt-responsive " id="invent">
                    <thead>
                        <tr>
                            <th>No. </th>
                            <th>Kode Barang</th>
                            <th>Gambar</th>
                            <th>Nama Barang</th>
                            <th>Jenis Barang</th>
                            <th>Nomor Register</th>
                            <th>Merek/Tipe</th>
                            <th>Ukuran/CC</th>
                            <th>Bahan</th>
                            <th>Sumber Dana</th>
                            <th>Tahun Pembelian</th>
                            <th>Nomor Rangka</th>
                            <th>Nomor Mesin</th>
                            <th>Nomor Polisi</th>
                            <th>BPKB</th>
                            <th>Asal/Usul</th>
                            <th>Harga</th>
                            <th>Kondisi</th>
                            <th>Keterangan</th>
                            <th>QR</th>
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

            <?= form_open('manage/inventaris/add'); ?>
            <div class="modal-body">
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
                                <option value="<?php echo $row['id'] ?>"><?php echo $row['idbarang'] ?> - <?php echo $row['nama_barang'] ?></option>
                            <?php endforeach; ?> 
                        </select>   
                    </div>
                    <div class="form-group">
                        <label>Unit</label>
                        <select name="majors_id" class="form-control">       
                            <?php foreach ($majors as $s) : ?>
                                <option value="<?= $s['majors_id'] ?>"><?= $s['majors_name'] ?></option>
                            <?php endforeach; ?>
                        </select>     
                    </div>
                    <div class="form-group">
                        <label>Ruangan</label>
                        <select name="majors_id" class="form-control">       
                            <?php foreach ($ruangan as $s) : ?>
                                <option value="<?= $s['idruangan'] ?>"><?= $s['nama_ruangan'] ?></option>
                            <?php endforeach; ?>
                        </select>     
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
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <?= form_open('manage/inventaris/edit'); ?>
                <div class="modal-body">          

                    <input type="hidden" name="id" class="edit_id" value="">

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
                                <option value="<?php echo $row['id'] ?>"><?php echo $row['idbarang'] ?> - <?php echo $row['nama_barang'] ?></option>
                            <?php endforeach; ?>                               
                        </select>   
                    </div>
                    
                    <div class="form-group">
                        <label>Unit</label>
                        <select name="majors_id" class="majors_id form-control">   
                            <?php foreach ($majors as $s) : ?>
                                <option value="<?= $s['majors_id'] ?>"><?= $s['majors_name'] ?></option>
                            <?php endforeach; ?>    
                        </select>     
                    </div>
                    <div class="form-group">
                        <label>Ruangan</label>
                        <select name="ruangan_id" class="ruangan_id form-control">       
                            <?php foreach ($ruangan as $s) : ?>
                                <option value="<?= $s['idruangan'] ?>"><?= $s['nama_ruangan'] ?></option>
                            <?php endforeach; ?>
                        </select>     
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
                
            <?= form_open('manage/inventaris/delete'); ?>
                <input type="hidden" name="deleteid" id="object-id" value="">
                <button type="submit" class="btn btn-primary">Hapus</button>
                <button type="button" data-dismiss="modal"
                        class="btn">Batal</button>
                        
            <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>

<div id="qr_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">QR</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label>Kode Barang</label>
                <input class="kode_qr border-0" disabled style="border:0">
                <label>Nama Barang</label>
                <input class="nama_qr border-0" disabled style="border:0">
                <label>Jenis Barang</label>
                <input class="jenis_qr border-0" disabled style="border:0">
                <label>Nomor Register</label>
                <input class="nomor_qr border-0" disabled style="border:0">
                <label>Nama Unit</label>
                <input class="unit_qr border-0" disabled style="border:0">
                <label>Nama Ruang</label>
                <input class="ruang_qr border-0" disabled style="border:0">
                <label>Tahun Pembelian</label>
                <input class="tahun_qr border-0" disabled style="border:0">
            </div>
            <div class="modal-footer">
                
                <button type="button" data-dismiss="modal"
                        class="btn">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        draw_data();


        function draw_data() {
            $('#invent').DataTable({
                'processing': true,
                'serverSide': true,
                'stateSave': true,
                responsive: true,
                'order': [],
                'ajax': {
                    'url': "<?php echo site_url('manage/inventaris/ajax_list') ?>",
                    'type': 'POST',
                    'data': {
                        'm': <?= isset($_GET['m']) ? $_GET['m'] : '0' ?>,
                        'r': <?= isset($_GET['r']) ? $_GET['r'] : '0' ?>,
                        '<?= $this->security->get_csrf_token_name() ?>': crsf_hash
                    }
                },
                'columnDefs': [
                    {
                        'targets': [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20],
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
            $('.aset_id').val($(this).attr('data-aset-id'));
            $('.user_id').val($(this).attr('data-user-id'));
            $('.majors_id').val($(this).attr('data-majors-id'));
            $('.ruangan_id').val($(this).attr('data-ruangan-id'));
            

            $(this).closest('tr').attr('id', $(this).attr('data-id'));
            $('#edit_model').modal({backdrop: 'static', keyboard: false});
        });

        
        $(document).on('click', ".qr-object", function (e) {
            e.preventDefault();
            
            $('.kode_qr').val($(this).attr('data-qr-kode'));
            $('.nama_qr').val($(this).attr('data-qr-nama'));
            $('.jenis_qr').val($(this).attr('data-qr-jenis'));
            $('.nomor_qr').val($(this).attr('data-qr-nomor'));
            $('.unit_qr').val($(this).attr('data-qr-unit'));
            $('.ruang_qr').val($(this).attr('data-qr-ruang'));
            $('.tahun_qr').val($(this).attr('data-qr-tahun'));

            $('#qr_model').modal({backdrop: 'static', keyboard: false});
        });
    });
</script>