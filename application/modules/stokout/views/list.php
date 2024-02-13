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
                <table class="table table-striped w-100 dt-responsive" id="stokout">
                    <thead>
                        <tr>
                            <th>No. </th>
                            <th>ID Barang</th>
                            <th>Tanggal Keluar</th>
                            <th>Nama Barang</th>
                            <th>Rasa</th>
                            <th>Merek</th>
                            <th>Jumlah Keluar</th>
                            <th>Lokasi</th>
                            <th>User</th>
                            <th>Hapus</th>
                        </tr>
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
            $('#stokout').DataTable({
                'processing': true,
                'serverSide': true,
                'stateSave': true,
                responsive: true,
                'order': [],
                'ajax': {
                    'url': "<?php echo site_url('manage/stokout/ajax_list') ?>",
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
                           window.location = '<?php echo site_url('manage/stokout/add') ?>'
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        footer: false,  
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6, 7]
                        }
                    }
                ],
            });
        };
    });
</script>