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
                <table id="assets" class="table table-striped table-bordered zero-configuration table-sme">
                    <thead>
                        <th>No. </th>
                        <th>NAMA BARANG</th>
                        <th>MEREK</th>
                        <th>KATEGORI</th>
                        <th>DANA</th>
                        <th>KETERANGAN</th>
                        <th>STOK</th>
                        <th>TANGGAL PEMBELIAN</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        draw_data();

        function draw_data() {
            $('#assets').DataTable({
                'processing': true,
                'serverSide': true,
                'stateSave': true,
                //responsive: true,
                'order': [],
                'ajax': {
                    'url': "<?php echo site_url('manage/aset/ajax_list') ?>",
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
                           window.location = '<?php echo site_url('manage/aset/add') ?>'
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