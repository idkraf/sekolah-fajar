
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo isset($title) ? '' . $title : null; ?>
			<small>List</small>
		</h1>
		<ol class="breadcrumb">
			<li  class="breadcrumb-item"><a href="<?php echo site_url('manage') ?>"><i class="fa fa-th"></i> Home</a></li>
			<li class="active breadcrumb-item"><?php echo isset($title) ? '' . $title : null; ?></li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-success">
					<div class="card-header">
						<?php echo form_open(current_url(), array('method' => 'get')) ?> <br>
						<div class="row">
							<div class="col-md-3">  
								<div class="form-group">
									<div class="input-group ">
										<!--span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span-->
										<input class="form-control" type="date" name="ds" <?php echo (isset($q['ds'])) ? 'value="'.$q['ds'].'"' : '' ?> placeholder="Tanggal Awal">
									</div>
								</div>
							</div>
							<div class="col-md-3">  
								<div class="form-group">
									<div class="input-group ">
										<!--span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span-->
										<input class="form-control" type="date" name="de" <?php echo (isset($q['de'])) ? 'value="'.$q['de'].'"' : '' ?> placeholder="Tanggal Akhir">
										
									</div>
								</div>
							</div>
							<button type="submit" class="btn btn-primary">Filter</button>
							<?php if ($q) { ?>
							<a class="btn btn-success" href="<?php echo site_url('manage/report/report' . '/?' . http_build_query($q)) ?>"><i class="fa fa-file-excel-o" ></i> Export Excel</a>
							<?php } ?>
						</div>
					</div>

				</div>
			</div>

		</div>
	</section>
	<!-- /.content -->
</div>