<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="box box-primary">
                <div class="card-body">
                    <?= $this->session->flashdata('pesan'); ?>
                    <?= form_open_multipart(); ?>
                    <div class="form-group">
                        <label for="supplier">Supplier</label>                
                        <input value="<?= set_value('supplier'); ?>" name="supplier" id="supplier" type="text" class="form-control">
                    
                        <?= form_error('supplier', '<small class="text-danger">', '</small>'); ?>
                
                    </div>
                    <!-- <div class="row form-group">
                        <label class="col-md-3 text-md-right" for="foto">Foto</label>
                        <div class="col-md-9">
                            <input name="foto" id="foto" type="file"> <br>
                            <small>Biarkan Kosong Tidak Ada</small>
                            <?= form_error('foto', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div> -->
                    <div class="form-group">
                        <label for="nama_supplier">Nama Supplier</label>
                        
                        <input value="<?= set_value('nama_supplier'); ?>" name="nama_supplier" id="nama_supplier" type="text" class="form-control" placeholder="Nama Supplier...">
                            
                            <?= form_error('nama_supplier', '<small class="text-danger">', '</small>'); ?>
                        
                    </div>
                    <div class="form-group">
                        <label for="no_telp">Nomor Telepon</label>
                       
                                <input value="<?= set_value('no_telp'); ?>" name="no_telp" id="no_telp" type="text" class="form-control" placeholder="Nomor Telepon...">
                            
                            <?= form_error('no_telp', '<small class="text-danger">', '</small>'); ?>
                        
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 text-md-right" for="alamat">Alamat</label>
                        
                                <textarea name="alamat" id="alamat" class="form-control" rows="4" placeholder="Alamat..."><?= set_value('alamat'); ?></textarea>
                            
                            <?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
                        
                    </div>
                    <div class="form-group">
                        <div class="col-md-9 offset-md-3">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
           
        </div>
    </section>
</div>