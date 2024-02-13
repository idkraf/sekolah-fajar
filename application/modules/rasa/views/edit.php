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
	<section class="content"><div class="row justify-content-center">
    <div class="col-md-8">
        <div class="box shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col-lg-10">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Item Rasa Edit Form
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('manage/rasa') ?>" class="btn btn-sm btn-secondary btn-icon-split">
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
                <?= form_open('', [], ['id_rasa' => $rasa['id_rasa']]); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="nama_rasa">Nama Rasa</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('nama_rasa', $rasa['nama_rasa']); ?>" name="nama_rasa" id="nama_rasa" type="text" class="form-control" placeholder="Nama Rasa...">
                        <?= form_error('nama_rasa', '<small class="text-danger">', '</small>'); ?>
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
</div>    </section>
</div>