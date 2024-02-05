<?php
    if(isset($barang)){
        
    }
?>
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
                                    Tambah Barang
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
                    <div class="box-body">
                        <?= $this->session->flashdata('pesan'); ?>
		                <?php echo form_open_multipart(current_url()); ?>
                        <!--?php echo form_open_multipart('manage/barang/add'); ?-->
                        <div class="form-group">
                            <label class="col-md-3 text-md-right" for="id_barang">ID Barang</label>
                            
                            <div class="input-group">
                                <input readonly value="<?= set_value('id_barang', $id_barang); ?>" name="id_barang" id="id_barang" type="text" class="form-control" placeholder="ID Barang...">
                                <?= form_error('id_barang', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 text-md-right" for="image">Image</label>
                            
                            <div class="input-group">
                                <input name="image" id="image" type="file"> <br>
                                <small>Biarkan Kosong Tidak Ada</small>
                                <?= form_error('image', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 text-md-right" for="nama_barang">Nama Barang</label>
                            
                            <div class="input-group">
                                <input value="<?= set_value('nama_barang'); ?>" name="nama_barang" id="nama_barang" type="text" class="form-control" placeholder="Nama Barang...">
                                <?= form_error('nama_barang', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 text-md-right" for="jenis_id">Jenis Barang</label>
                           
                                <div class="input-group">
                                    <select name="jenis_id" id="jenis_id" class="custom-select">
                                        <option value="" selected disabled>Pilih Jenis Barang</option>
                                        <?php foreach ($jenis as $j) : ?>
                                            <option <?= set_select('jenis_id', $j['id_jenis']) ?> value="<?= $j['id_jenis'] ?>"><?= $j['nama_jenis'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    
                                        <a class="btn btn-primary" href="<?= base_url('manage/jenis/add'); ?>"><i class="fa fa-plus"></i></a>
                                    
                                    <?= form_error('jenis_id', '<small class="text-danger">', '</small>'); ?>
                                </div>
                           
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 text-md-right" for="warna_id">Warna Barang</label>
                           
                            <div class="input-group">
                                    <select name="warna_id" id="warna_id" class="custom-select">
                                        <option value="" selected disabled>Pilih Warna Barang</option>
                                        <?php foreach ($warna as $j) : ?>
                                            <option <?= set_select('warna_id', $j['id_warna']) ?> value="<?= $j['id_warna'] ?>"><?= $j['nama_warna'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    
                                        <a class="btn btn-primary" href="<?= base_url('manage/warna/add'); ?>"><i class="fa fa-plus"></i></a>
                                    
                                <?= form_error('warna_id', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 text-md-right" for="rasa_id">Rasa Barang</label>
                         
                            <div class="input-group">
                                    <select name="rasa_id" id="rasa_id" class="custom-select">
                                        <option value="" selected disabled>Pilih Rasa Barang</option>
                                        <?php foreach ($rasa as $j) : ?>
                                            <option <?= set_select('rasa_id', $j['id_rasa']) ?> value="<?= $j['id_rasa'] ?>"><?= $j['nama_rasa'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    
                                        <a class="btn btn-primary" href="<?= base_url('manage/rasa/add'); ?>"><i class="fa fa-plus"></i></a>
                                  
                                <?= form_error('rasa_id', '<small class="text-danger">', '</small>'); ?>
                            </div>
                           
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 text-md-right" for="merek_id">Merek Barang</label>
                      
                            <div class="input-group">
                                    <select name="merek_id" id="merek_id" class="custom-select">
                                        <option value="" selected disabled>Pilih Merek Barang</option>
                                        <?php foreach ($merek as $j) : ?>
                                            <option <?= set_select('merek_id', $j['id_merek']) ?> value="<?= $j['id_merek'] ?>"><?= $j['nama_merek'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    
                                        <a class="btn btn-primary" href="<?= base_url('manage/merek/add'); ?>"><i class="fa fa-plus"></i></a>
                                    
                                <?= form_error('merek_id', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 text-md-right" for="satuan_id">Satuan Barang</label>
                            
                            <div class="input-group">
                                    <select name="satuan_id" id="satuan_id" class="custom-select">
                                        <option value="" selected disabled>Pilih Satuan Barang</option>
                                        <?php foreach ($satuan as $s) : ?>
                                            <option <?= set_select('satuan_id', $s['id_satuan']) ?> value="<?= $s['id_satuan'] ?>"><?= $s['nama_satuan'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                
                                    <a class="btn btn-primary" href="<?= base_url('manage/satuan/add'); ?>"><i class="fa fa-plus"></i></a>
                                
                                <?= form_error('satuan_id', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 text-md-right" for="stok_awal">Stok Awal</label>
                         
                            <div class="input-group">
                                <input value="0" name="stok" type="hidden">
                                <input value="0" name="stok_akhir" type="hidden">
                                <input value="<?= set_value('stok_awal'); ?>" name="stok_awal" id="stok_awal" type="number" class="form-control">
                                <?= form_error('stok_awal', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 text-md-right" for="harga_barang">Harga Barang</label>
                          
                            <div class="input-group">
                                <input value="<?= set_value('harga_barang'); ?>" name="harga_barang" id="harga_barang" type="number" class="form-control">
                                <?= form_error('harga_barang', '<small class="text-danger">', '</small>'); ?>
                            </div>
                       
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 text-md-right"  for="gudang_id">Gudang</label>
                      
                            <div class="input-group">
                                    <select name="gudang_id" id="gudang_id" class="custom-select">
                                        <option value="" selected disabled>Pilih Gudang</option>
                                        <?php foreach ($gudang as $g) : ?>
                                            <option <?= set_select('gudang_id', $g['id_gudang']) ?> value="<?= $g['id_gudang'] ?>"><?= $g['nama_gudang'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <!--div class="input-group-append"-->
                                        <a class="btn btn-primary" href="<?= base_url('manage/gudang/add'); ?>"><i class="fa fa-plus"></i></a>
                                    <!--/div-->
                                <?= form_error('gudang_id', '<small class="text-danger">', '</small>'); ?>
                        
                            </div>
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