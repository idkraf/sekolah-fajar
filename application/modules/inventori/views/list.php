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
    <?php error_reporting(0); ?>
    <?= $this->session->flashdata('pesan'); ?>
    <div class="box shadow-sm border-bottom-primary">
      <div class="table-responsive">
        <table class="table table-striped w-100 dt-responsive " id="dataTable">
          <thead>
            <tr>
              <th>No. </th>
              <th>ID Barang</th>
              <th>Nama Barang</th>
              <th>Jenis Barang</th>
              <th>Warna Barang</th>
              <th>Rasa Barang</th>
              <th>Merek Barang</th>
              <th>Stok Awal</th>
              <th>Stok Masuk</th>
              <th>Stok Keluar</th>
              <th>Stok Akhir</th>
              <th>Jumlah Keluar</th>
              <th>Satuan</th>
              <th>Harga Barang(Rp)</th>
              <th>Total Harga Barang(Rp)</th>
              <th>Gudang</th>
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
            <?= form_open('manage/inventori/delete'); ?>
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
            $('#dataTable').DataTable({
                'processing': true,
                'serverSide': true,
                'stateSave': true,
                //responsive:false,
                'order': [],
                'ajax': {
                    'url': "<?php echo site_url('manage/inventori/ajax_list') ?>",
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
                        text: 'Tambah Aset',
                        action: function ( e, dt, node, config ) {
                           window.location = '<?php echo site_url('manage/inventori/add') ?>'
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
</script>