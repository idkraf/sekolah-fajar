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
                            Data Dana
                        </h4>
                    </div>
                    <div class="col-auto">
                            <a href="<?= base_url('manage/dana/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                                <span class="icon">
                                    <i class="fa fa-plus"></i>
                                </span>
                                <span class="text">
                                    Input Data Dana
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
                            <th>Keterangan</th>
                             <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        if ($dana) :
                            foreach ($dana as $g) :
                        ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $g['nama_dana']; ?></td>
                                    <td><?= $g['keterangan']; ?></td>
                                     <td>
                                            <a href="<?= base_url('manage/dana/edit/') . $g['iddana'] ?>" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-edit"></i></a>
                                            <a onclick="return confirm('Yakin ingin hapus?')" href="<?= base_url('dana/delete/') . $g['iddana'] ?>" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a>
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