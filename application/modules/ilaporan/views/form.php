<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo isset($title) ? '' . $title : null; ?>
			<small>List</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('manage') ?>"><i class="fa fa-th"></i> Home</a></li>
			<li class="active"><?php echo isset($title) ? '' . $title : null; ?></li>
		</ol>
	</section>
	<section class="content">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="box shadow-sm border-bottom-primary">
                    <div class="box-header bg-white py-3">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Report Form
                        </h4>
                    </div>
                    <div class="box-body">
                        <?= $this->session->flashdata('pesan'); ?>
                        <?= form_open(); ?>
                        <div class="row form-group">
                            <label class="col-md-3 text-md-right" for="transaksi">Laporan Transaksi</label>
                            <div class="col-md-9">
                                <div class="custom-control custom-radio">
                                    <input value="barang_masuk" type="radio" id="barang_masuk" name="transaksi" class="custom-control-input">
                                    <label class="custom-control-label" for="barang_masuk">Gudang Masuk</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input value="barang_keluar" type="radio" id="barang_keluar" name="transaksi" class="custom-control-input">
                                    <label class="custom-control-label" for="barang_keluar">gudang Keluar</label>
                                </div>
                                <?= form_error('transaksi', '<span class="text-danger small">', '</span>'); ?>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-lg-3 text-lg-right" for="tanggal">Tanggal</label>
                            <div class="col-lg-5">
                                <div class="input-group date "data-date="" data-date-format="yyyy-mm-dd">
								    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    <input value="<?= set_value('tanggal'); ?>" name="tanggal" id="tanggal" type="text" class="form-control"  readonly="readonly" placeholder="Periode Tanggal">
                                    
                                </div>
                                <?= form_error('tanggal', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-9 offset-lg-3">
                                <button type="submit" class="btn btn-primary btn-icon-split">
                                    <span class="icon">
                                        <i class="fa fa-print"></i>
                                    </span>
                                    <span class="text">
                                        Print
                                    </span>
                                </button>
                            </div>
                        </div>
                        <?= form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
</section>
</div>
<script type="text/javascript">
        $(function() {
            $('.date').datepicker({
                uiLibrary: 'bootstrap4',
                format: 'yyyy-mm-dd'
            });

            var start = moment().subtract(29, 'days');
            var end = moment();

            function cb(start, end) {
                $('#tangal').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
            }

            $('#tanggal').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Hari ini': [moment(), moment()],
                    'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    '7 hari terakhir': [moment().subtract(6, 'days'), moment()],
                    '30 hari terakhir': [moment().subtract(29, 'days'), moment()],
                    'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
                    'Bulan lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                    'Tahun ini': [moment().startOf('year'), moment().endOf('year')],
                    'Tahun lalu': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
                }
            }, cb);

            cb(start, end);
        });
</script>