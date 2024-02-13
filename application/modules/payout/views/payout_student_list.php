<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo isset($title) ? '' . $title : null; ?>
		</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo site_url('manage') ?>"><i class="fa fa-th"></i></a></li>
			<li class="breadcrumb-item active"><?php echo isset($title) ? '' . $title : null; ?></li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<!-- /.box-header -->
					<div class="card-body table-responsive">
						<table class="table table-hover">
							<tr>
								<th>No</th>
								<th>Jenis Pembayaran</th>
          						<th>TANGGAL PEMBAYARAN</th>
								<th>Total Tagihan</th>
								<th>Status</th>
							</tr>
							<tbody>
								
							<?php 
								$i = 1;
								foreach ($student as $row) :
								$namePay = $row['pos_name'].' - T.A '.$row['period_start'].'/'.$row['period_end'];
								$mont = ($row['month_month_id']<=6) ? $row['period_start'] : $row['period_end'];
								?>
								<tr>
									<td style="text-align: center;"><?php echo $i ?></td>
									<td><?php echo $namePay .' - ('.$row['month_name'].' '.$mont.')' ?></td>
									<td><?php echo ($row['bulan_status']==1) ? pretty_date($row['bulan_date_pay'],'d F Y',false) : '-' ?></td>
									<td><?php echo ($row['bulan_status']==0) ? 'Rp. '. number_format($row['bulan_bill'], 0, ',', '.') : 'Rp. -' ?></td>
									<td><?php echo ($row['bulan_status']==1) ? 'Lunas' : 'Belum Lunas' ?></td>
								</tr>
							<?php 
							$i++;
							endforeach
							?>

							<?php 
							$j = $i;
							foreach ($bebas as $row) :
								$namePayFree = $row['pos_name'].' - T.A '.$row['period_start'].'/'.$row['period_end'];
								?>
								<tr>
									<td style="text-align: center;"><?php echo $j ?></td>
									<td><?php echo $namePayFree ?></td>
									<td><?php echo ($row['bebas_total_pay']>0) ? pretty_date($row['bebas_last_update'],'d F Y',false) : '-'  ?></td>
									<td><?php echo ($row['bebas_bill']-$row['bebas_total_pay']!=0) ? 'Rp. '. number_format($row['bebas_bill']-$row['bebas_total_pay'], 0, ',', '.') : 'Rp. -' ?></td>
									<td><?php echo ($row['bebas_bill']==$row['bebas_total_pay']) ? 'Lunas' : 'Belum Lunas' ?></td>
								</tr>
								<?php 
								$j++;
							endforeach
							?>
						</tbody>
					</table>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
	</div>
</section>
<!-- /.content -->
</div>