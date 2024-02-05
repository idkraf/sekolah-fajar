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
            <a href="<?= base_url('manage/aset/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                <span class="icon">
                    <i class="fa fa-plus"></i>
                </span>
                <span class="text">
                    Tambah
                </span>
            </a>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-striped" id="dataTable">
                    <thead>
                        <tr>
                            <th>No. </th>
                            <th>NAMA BARANG</th>
                            <th>MEREK</th>
                            <th>KATEGORI</th>
                            <th>DANA</th>
                            <th>KETERANGAN</th>
                            <th>STOK</th>
                            <th>TANGGAL PEMBELIAN</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        if ($aset) :
                            foreach ($aset as $g) :
                        ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $g['nama_barang']; ?></td>                                                        
                                    <td><?= $g['nama_merek']; ?></td>
                                    <td><?= $g['nama_kategori']; ?></td>
                                    <td><?= $g['nama_dana']; ?></td>
                                    <td><?= $g['keterangan']; ?></td>
                                    <td><?= $g['stok']; ?></td>
                                    <td><?= $g['tanggal_pembelian']; ?></td>
                                    <td>
                                        <a href="<?= base_url('manage/aset/edit/') . $g['id'] ?>" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-edit"></i></a>
                                        <a onclick="return confirm('Yakin ingin hapus?')" href="<?= base_url('manage/aset/delete/') . $g['idbarang'] ?>" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a>
                                    </td>
                                    
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="3" class="text-center">
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