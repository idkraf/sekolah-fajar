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
            <div class="box-header bg-white py-3">
                <div class="row">
                    <div class="col-lg-9">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Hystory of Outgoing Goods
                        </h4>
                    </div>
                        <div class="col-auto">
                            <a href="<?= base_url('manage/stokout/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                                <span class="icon">
                                    <i class="fa fa-plus"></i>
                                </span>
                                <span class="text">
                                    Input Item
                                </span>
                            </a>
                        </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped w-100 dt-responsive " id="dataTable">
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
                        <?php
                        $no = 1;
                        if ($barangkeluar) :
                            foreach ($barangkeluar as $bk) :
                        ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $bk['id_barang']; ?></td>
                                    <td><?= $bk['tanggal_keluar']; ?></td>
                                    <td><?= $bk['nama_barang']; ?></td>
                                    <td><?= $bk['nama_rasa']; ?></td>
                                    <td><?= $bk['nama_merek']; ?></td>
                                    <td><?= $bk['jumlah_keluar'] . ' ' . $bk['nama_satuan']; ?></td>
                                    <td><?= $bk['lokasi']; ?></td>
                                    <td><?= $bk['user_full_name']; ?></td>
                                    <td>
                                        <a onclick="return confirm('Yakin ingin hapus?')" href="<?= base_url('manage/stokout/delete/') . $bk['id_barang_keluar'] ?>" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="7" class="text-center">
                                    Data Kosong
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
