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
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col-lg-10">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Kategori Aset
                        </h4>
                    </div>
                    <div class="col-auto">
                            <a href="<?= base_url('manage/kategori/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                                <span class="icon">
                                    <i class="fa fa-plus"></i>
                                </span>
                                <span class="text">
                                    Input Kategori
                                </span>
                            </a>
                        </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable">
                    <thead>
                        <tr>
                            <th>No. </th>
                            <th>Nama</th>
                             <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        if ($kategori) :
                            foreach ($kategori as $g) :
                        ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $g['nama_kategori']; ?></td>
                                    <td><?= $g['keterangan']; ?></td>
                                    <td>
                                        <a href="<?= base_url('manage/kategori/edit/') . $g['idkategori'] ?>" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-edit"></i></a>
                                        <a onclick="return confirm('Yakin ingin hapus?')" href="<?= base_url('kategori/delete/') . $g['idkategori'] ?>" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a>
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


<div id="delete_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title">Hapus </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Hapus data ini?</p>
            </div>
            <div class="modal-footer">
            <?= form_open('manage/kategori/delete/'); ?>
                <input type="hidden" name="deleteid" id="object-id" value="">
                <button type="submit" class="btn btn-primary">Hapus</button>
                <button type="button" data-dismiss="modal"
                        class="btn">Batal</button>
            <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>
