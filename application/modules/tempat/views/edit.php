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
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="box shadow-sm border-bottom-primary">
                    <div class="box-header bg-white py-3">
                        <div class="row">
                            <div class="col-lg-10">
                                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                                    Edit tempat
                                </h4>
                            </div>
                            <div class="col-auto">
                                <a href="<?= base_url('manage/tempat') ?>" class="btn btn-sm btn-secondary btn-icon-split">
                                    <span class="icon">
                                        <i class="fa fa-arrow-left"></i>
                                    </span>
                                    <span class="text">
                                        Back
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <?= $this->session->flashdata('pesan'); ?>
                        <?= form_open('', [], ['idtempat' => $tempat['idtempat']]); ?>
                        <div class="row form-group">
                            <label class="col-md-3 text-md-right" for="nama_tempat">Nama Tempat</label>
                            <div class="col-md-9">
                                <input value="<?= set_value('nama_tempat', $tempat['nama_tempat']); ?>" name="nama_tempat" id="nama_tempat" type="text" class="form-control" placeholder="Nama Tempat...">
                                <?= form_error('nama_tempat', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-3 text-md-right" for="keterangan">Keterangan</label>
                            <div class="col-md-9">
                                <input value="<?= set_value('keterangan', $tempat['keterangan']); ?>" name="keterangan" id="keterangan" type="text" class="form-control" placeholder="keterangan...">
                                <?= form_error('keterangan', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-9 offset-md-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </div>
                        <?= form_close(); ?>
                    </div>
                </div>
            </div>
</section>        </div>
</div>