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
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="box shadow-sm border-bottom-primary">
                    <div class="card-header bg-white py-3">
                        <div class="row">
                            <div class="col-lg-10">
                                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                                    Edit Barang
                                </h4>
                            </div>
                            <div class="col-auto">
                                <a href="<?= base_url('manage/barang') ?>" class="btn btn-sm btn-secondary btn-icon-split">
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
                        <?= form_open_multipart('', [], ['stok' => 0, 'id_barang' => $barang['id_barang']]); ?>                        
                       
                        <div class="form-group">
                            <label for="image">Image:</label>
                                <?php
                                if ($barang['image'] !== null) { ?>
                                    <div style="margin-bottom: 10px;">
                                        <img src="<?= base_url() ?>assets/upload/<?= $barang['image']; ?>" width="100px">
                                    </div>
                                <?php } ?>
                                <input name="image" id="image" type="file" class="input-group">
                                <small>(Biarkan Kosong Jika Tidak <?= $barang['image'] ? 'Diganti' : 'Ada' ?>)</small>
                                <?= form_error('image', '<small class="text-danger">', '</small>'); ?>
                            
                        </div>
                        <div class="form-group">
                            <label for="nama_barang">Nama Barang</label>
                           
                                <input value="<?= set_value('nama_barang', $barang['nama_barang']); ?>" name="nama_barang" id="nama_barang" type="text" class="form-control" placeholder="Nama Barang...">
                                <?= form_error('nama_barang', '<small class="text-danger">', '</small>'); ?>
                           
                        </div>
                        <div class="form-group">
                            <label for="jenis_id">Jenis Barang</label>
                            
                                    <select name="jenis_id" id="jenis_id" class="custom-select">
                                        <option value="" selected disabled>Pilih Jenis Barang</option>
                                        <?php foreach ($jenis as $j) : ?>
                                            <option <?= $barang['jenis_id'] == $j['id_jenis'] ? 'selected' : ''; ?> <?= set_select('jenis_id', $j['id_jenis']) ?> value="<?= $j['id_jenis'] ?>"><?= $j['nama_jenis'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="input-group-append">
                                        <a class="btn btn-primary" href="<?= base_url('manage/jenis/add'); ?>"><i class="fa fa-plus"></i></a>
                                    </div>
                                <?= form_error('jenis_id', '<small class="text-danger">', '</small>'); ?>
                            
                        </div>
                        <div class="form-group">
                            <label for="warna_id">Warna Barang</label>
                            
                                    <select name="warna_id" id="warna_id" class="custom-select">
                                        <option value="" selected disabled>Pilih Warna Barang</option>
                                        <?php foreach ($warna as $j) : ?>
                                            <option <?= $barang['warna_id'] == $j['id_warna'] ? 'selected' : ''; ?> <?= set_select('warna_id', $j['id_warna']) ?> value="<?= $j['id_warna'] ?>"><?= $j['nama_warna'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="input-group-append">
                                        <a class="btn btn-primary" href="<?= base_url('manage/warna/add'); ?>"><i class="fa fa-plus"></i></a>
                                    </div>
                                <?= form_error('warna_id', '<small class="text-danger">', '</small>'); ?>
                            
                        </div>
                        <div class="form-group">
                            <label for="rasa_id">Rasa Barang</label>
                            
                                    <select name="rasa_id" id="rasa_id" class="custom-select">
                                        <option value="" selected disabled>Pilih Rasa Barang</option>
                                        <?php foreach ($rasa as $j) : ?>
                                            <option <?= $barang['rasa_id'] == $j['id_rasa'] ? 'selected' : ''; ?> <?= set_select('rasa_id', $j['id_rasa']) ?> value="<?= $j['id_rasa'] ?>"><?= $j['nama_rasa'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="input-group-append">
                                        <a class="btn btn-primary" href="<?= base_url('manage/rasa/add'); ?>"><i class="fa fa-plus"></i></a>
                                    </div>
                                <?= form_error('rasa_id', '<small class="text-danger">', '</small>'); ?>
                            
                        </div>
                        <div class="form-group">
                            <label for="merek_id">Merek Barang</label>
                            
                                    <select name="merek_id" id="merek_id" class="custom-select">
                                        <option value="" selected disabled>Pilih Merek Barang</option>
                                        <?php foreach ($merek as $j) : ?>
                                            <option <?= $barang['merek_id'] == $j['id_merek'] ? 'selected' : ''; ?> <?= set_select('merek_id', $j['id_merek']) ?> value="<?= $j['id_merek'] ?>"><?= $j['nama_merek'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="input-group-append">
                                        <a class="btn btn-primary" href="<?= base_url('manage/merek/add'); ?>"><i class="fa fa-plus"></i></a>
                                    </div>
                                <?= form_error('merek_id', '<small class="text-danger">', '</small>'); ?>
                           
                        </div>
                        <div class="form-group">
                            <label for="satuan_id">Satuan Barang</label>
                            
                                    <select name="satuan_id" id="satuan_id" class="custom-select">
                                        <option value="" selected disabled>Pilih Satuan Barang</option>
                                        <?php foreach ($satuan as $s) : ?>
                                            <option <?= $barang['satuan_id'] == $s['id_satuan'] ? 'selected' : ''; ?> <?= set_select('satuan_id', $s['id_satuan']) ?> value="<?= $s['id_satuan'] ?>"><?= $s['nama_satuan'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="input-group-append">
                                        <a class="btn btn-primary" href="<?= base_url('manage/satuan/add'); ?>"><i class="fa fa-plus"></i></a>
                                    </div>
                                <?= form_error('satuan_id', '<small class="text-danger">', '</small>'); ?>
                            
                        </div>
                        <div class="form-group">
                            <label for="stok_awal">Stok Awal</label>
                           
                                <input value="<?= set_value('stok', $barang['stok']); ?>" name="stok" type="hidden">
                                <input value="<?= set_value('stok_awal', $barang['stok_awal']); ?>" name="stok_akhir" type="hidden">
                                <input value="<?= set_value('stok_awal', $barang['stok_awal']); ?>" name="stok_awal" id="stok_awal" type="number" class="form-control">
                                <?= form_error('stok_awal', '<small class="text-danger">', '</small>'); ?>
                           
                        </div>
                        <div class="form-group">
                            <label  for="harga_barang">Harga Barang</label>
                          
                                <input value="<?= set_value('harga_barang', $barang['harga_barang']); ?>" name="harga_barang" id="harga_barang" type="number" class="form-control">
                                <?= form_error('harga_barang', '<small class="text-danger">', '</small>'); ?>
                            
                        </div>
                        <div class="form-group">
                            <label  for="gudang_id">Gudang</label>
                         
                                    <select name="gudang_id" id="gudang_id" class="custom-select">
                                        <option value="" selected disabled>Pilih Gudang</option>
                                        <?php foreach ($gudang as $g) : ?>
                                            <option <?= $barang['gudang_id'] == $g['id_gudang'] ? 'selected' : ''; ?> <?= set_select('gudang_id', $g['id_gudang']) ?> value="<?= $g['id_gudang'] ?>"><?= $g['nama_gudang'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="input-group-append">
                                        <a class="btn btn-primary" href="<?= base_url('manage/gudang/add'); ?>"><i class="fa fa-plus"></i></a>
                                    </div>
                                <?= form_error('gudang_id', '<small class="text-danger">', '</small>'); ?>
                          
                        </div>
                        <div class="form-group">
                            <div class="col-md-9 offset-md-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button type="reset" class="btn btn-secondary">Reset</bu>
                            </div>
                        </div>
                        <?= form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>