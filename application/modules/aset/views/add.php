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
                                Tambah Aset
                                </h4>
                            </div>
                            <div class="col-auto">
                                <a href="<?= base_url('manage/aset') ?>" class="btn btn-sm btn-secondary btn-icon-split">
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
                        <!--
                        <div class="row form-group">
                            <label class="col-md-3 text-md-right" for="nama_gudang">Nama Gudang</label>
                            <div class="col-md-9">
                                <input value="<//?= set_value('nama_gudang'); ?>" name="nama_gudang" id="nama_gudang" type="text" class="form-control" placeholder="Nama Gudang...">
                                <//?= form_error('nama_gudang', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        -->                                    
                        <div class="form-group">
                            <label for="idbarang">ID Barang <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="idbarang" name="idbarang" required>
                        </div>
                        <div class="form-group">
                            <label for="nama_barang">Nama Barang <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
                            <?= form_error('nama_barang', '<small class="text-danger">', '</small>'); ?>
                            
                        </div>
                        
                        <div class="form-group">
                            <label for="kode_barang">Kode Barang <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="kode_barang" name="kode_barang" required>
                            <?= form_error('kode_barang', '<small class="text-danger">', '</small>'); ?>                            
                        </div>
                        <div class="form-group">
                            <label for="nomor_register">Nomor Register <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nomor_register" name="nomor_register" required>
                            <?= form_error('nomor_register', '<small class="text-danger">', '</small>'); ?>                            
                        </div>
                        <div class="form-group">
                            <label for="merek_id">Merek Barang <span class="text-danger">*</span></label>
                            <select name="merek_id" id="merek_id" class="form-control select2" style="width:100%;" required>
                            <option value="">-- Pilih Merek --</option>
                            <?php foreach ($merek as $s) : ?>
                                <option  value="<?= $s['id_merek'] ?>"><?= $s['nama_merek'] ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kategori_id">Kategori Barang <span class="text-danger">*</span></label>
                            <select name="kategori_id" id="kategori_id" class="form-control select2" style="width:100%;" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php foreach ($kategori as $s) : ?>
                                <option  value="<?= $s['idkategori'] ?>"><?= $s['nama_kategori'] ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ruangan_id">Ruangan Barang <span class="text-danger">*</span></label>
                            <select name="ruangan_id" id="ruangan_id" class="form-control select2" style="width:100%;" required>
                            <option value="">-- Pilih Ruangan --</option>
                            <?php foreach ($ruangan as $s) : ?>
                                <option value="<?= $s['idruangan'] ?>"><?= $s['nama_ruangan'] ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="dana_id">Dana Barang <span class="text-danger">*</span></label>
                            <select name="dana_id" id="dana_id" class="form-control select2" style="width:100%;" required>
                            <option value="">-- Pilih Dana --</option>
                            <?php foreach ($dana as $s) : ?>
                                <option value="<?= $s['iddana'] ?>"><?= $s['nama_dana'] ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kondisi_id">Kondisi Barang <span class="text-danger">*</span></label>
                            <select name="kondisi_id" id="kondisi_id" class="form-control select2" style="width:100%;" required>
                            <option value="">-- Pilih Kondisi--</option>
                            <?php foreach ($kondisi as $s) : ?>
                                <option value="<?= $s['id'] ?>"><?= $s['nama_kondisi'] ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="bahan_id">Bahan<span class="text-danger">*</span></label>
                            <select name="bahan_id" id="bahan_id" class="form-control select2" style="width:100%;" required>
                            <option value="">-- Pilih Bahan --</option>
                            <?php foreach ($bahan as $s) : ?>
                                <option value="<?= $s['id'] ?>"><?= $s['nama_bahan'] ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="number" name="harga" id="harga"  class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="ukuran">Ukuran</label>
                            <input name="ukuran" id="ukuran"  class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="bpkb">Bpkb></label>
                            <input name="bpkb" id="bpkb"  class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="asal_usul">Asal usul </label>
                            <input name="asal_usul" id="asal_usul"  class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="nomor_register">Nomor register </label>
                            <input name="nomor_register" id="nomor_register" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="nomor_rangka">Nomor rangka </label>
                            <input name="nomor_rangka" id="nomor_rangka" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="nomor_mesin">Nomor mesin </label>
                            <input name="nomor_mesin" id="nomor_mesin"  class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="nomor_polisi">Nomor polisi </label>
                            <input name="nomor_polisi" id="nomor_polisi" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan <span class="text-danger">*</span></label>
                            <textarea name="keterangan" id="keterangan" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="stok">Stok <span class="text-danger">*</span></label>
                            <input type="number" name="stok" id="stok" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="gambar">Gambar Barang <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="filegambar" name="filegambar" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_beli">Tanggal Pembelian <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tanggal_beli" name="tanggal_beli" required>
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