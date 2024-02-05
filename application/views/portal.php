<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>SMPTQ AL IKHLAS</title>
	<link rel="icon" type="image/png" href="<?php echo media_url('img/smplogo.png') ?>">

	<!-- Bootstrap Core CSS -->
	<link href="<?php echo media_url() ?>/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo media_url() ?>/css/load-font-googleapis.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo media_url() ?>/css/font-awesome.min.css">


	<!-- Custom CSS -->
	<link href="<?php echo media_url() ?>/css/frontend-style.css" rel="stylesheet">
	<link href="<?php echo media_url() ?>/css/portal.css" rel="stylesheet">

</head>

<body>

	<!-- Home -->
<body>
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
	<section class="content-section">
		<div class="container text-center">
			<div class="row">
				<div class="col-md-12">
					<h3> SISTEM INFORMASI</h3>
					<p class="lead mb-5 colr"><h1><strong><?php echo $setting_yayasan['setting_value'] ?></strong></h1></p>
				</div>	
				
				<table width="100%" border="0" >
					<tr>
						<td>                        
						<?php if (!empty($setting_logo_yayasan['setting_value'])) { ?>
							<img src="<?php echo upload_url('school/'.$setting_logo_yayasan['setting_value']) ?>" style="height: 140px; width: 140px;">
							<?php } else { ?>
							<img src="<?php echo media_url('img/missing.png') ?>" style="height: 140px; width: 140px;">
						<?php } ?>
						</td>
						<td class="text-right">              
						<?php if (!empty($setting_logo['setting_value'])) { ?>
							<img src="<?php echo upload_url('school/'.$setting_logo['setting_value']) ?>" style="height: 140px; width: 140px; margin-left:200px;">
							<?php } else { ?>
							<img src="<?php echo media_url('img/missing.png') ?>" style="height: 140px; width: 140px; ">
						<?php } ?>
						</td>      
					</tr>
				</table>
				<div class="col-md-3">
					<a href="<?php echo site_url('home') ?>">
					<div class="box">
						<i class="fa fa-money icon-menu"></i>
						<br>
						<strong>Cek Pembayaran</strong>
					</div>
				</a>
				</div>
				<div class="col-md-3">
					<a href="<?php echo site_url('student') ?>">
					<div class="box">
						<i class="fa fa-graduation-cap icon-menu"></i>
						<br>
						<strong>Login Siswa</strong>
					</div>
				</a>
				</div>
				<div class="col-md-3">
					<a href="<?php echo site_url('guru') ?>">
					<div class="box">
						<i class="fa fa-user icon-menu"></i>
						<br>
						<strong>Login Guru</strong> 
					</div>
				</a>
				</div>
				<div class="col-md-3">
					<a href="<?php echo site_url('manage') ?>">
					<div class="box">
						<i class="fa fa-user icon-menu"></i>
						<br>
						<strong>Login Staff</strong> 
					</div>
				</a>
				</div>
			</div>
		</div>
	</section>


</body>

</html>
