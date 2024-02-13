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
                    <div class="card-header bg-white py-3">
                        <div class="row">
                            <div class="col-lg-10">
                                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                                Tambah Data Asset Keluar
                                </h4>
                            </div>
                            <div class="col-auto">
                                <a href="<?= base_url('manage/asetout') ?>" class="btn btn-sm btn-secondary btn-icon-split">
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
                    <div class="card-body">
                        <?= $this->session->flashdata('pesan'); ?>
                        <?= form_open(); ?>

                        <div class="form-group">
                            <label for="tanggal">Tanggal<span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal"
                                value="<?=date('Y-m-d');?>" required>
                            <?= form_error('tanggal', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="barang_id">Nama Barang <span class="text-danger">*</span></label>                            
                            <select name="barang_id" id="barang_id" class="form-control custom-select" style="width:100%;"
                                required>
                                        <option value="" selected disabled>Pilih Barang</option>
                                        <?php foreach ($aset as $s) : ?>
                                            <option value="<?= $s['idbarang'] ?>"><?= $s['nama_barang'] ?></option>
                                        <?php endforeach; ?>
                            </select>
                            <?= form_error('barang_id', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah<span class="text-danger">*</span></label>
                            <input type="text" class="form-control uang" id="jumlah" name="jumlah" required>
                            <?= form_error('jumlah', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan <span class="text-danger">*</span></label>
                            <textarea name="keterangan" id="keterangan" cols="30" rows="5" class="form-control"
                                required></textarea>
                            <?= form_error('keterangan', '<small class="text-danger">', '</small>'); ?>
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
        </div>
    </section>
</div>