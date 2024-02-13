<div class="content-wrapper">
	<!-- Content Header (Page header) -->
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
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title"></h3>

						<div class="btn-group">
							<div class="input-group input-group-sm" style="width: 150px;">
								<input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

								<div class="input-group-btn">
									<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
								</div>
							</div>
						</div>
					</div>
					<!-- /.box-header -->
					<div class="card-body table-responsive no-padding">
						<table class="table table-hover">
							<tr>
								<th>No</th>
								<th>Tanggal</th>
								<th>Modul</th>
								<th>Aksi</th>
								<th>Info</th>
								<th>Penulis</th>
							</tr>
							<tbody>
								<?php
								if (!empty($logs)) {
									$i = 1;
									foreach ($logs as $row):
										?>
										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo pretty_date($row['log_date'],'d M Y h:m:s',false) ?></td>
											<td><?php echo $row['log_module']; ?></td>
											<td><?php echo $row['log_action']; ?></td>
											<td><?php echo $row['log_info']; ?></td>
											<td><?php echo $row['user_full_name']; ?></td>	
										</tr>
										<?php
										$i++;
									endforeach;
								} else {
									?>
									<tr id="row">
										<td colspan="6" align="center">Data Kosong</td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
						<!-- /.box-body -->
					</div>
					<div>
						<?php echo $this->pagination->create_links(); ?>
					</div>
					<!-- /.box -->
				</div>
			</div>
		</section>
		<!-- /.content -->
	</div>