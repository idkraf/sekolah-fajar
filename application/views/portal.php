<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Pelita Harapan</title>
	<link rel="icon" type="image/png" href="<?php echo media_url('img/smplogo.png') ?>">

	

    <!-- loader-->
    <link href="<?php echo asset_url() ?>css/pace.min.css" rel="stylesheet" />
    <script src="<?php echo asset_url() ?>js/pace.min.js"></script>
    <!--favicon-->
    <link rel="icon" href="<?php echo asset_url() ?>images/favicon.ico" type="image/x-icon">
    <!--Full Calendar Css-->
    <link href="<?php echo asset_url() ?>plugins/fullcalendar/css/fullcalendar.min.css" rel='stylesheet' />
    <!-- simplebar CSS-->
    <link href="<?php echo asset_url() ?>plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <!-- Bootstrap core CSS-->
    <link href="<?php echo asset_url() ?>css/bootstrap.min.css" rel="stylesheet" />
    <!-- animate CSS-->
    <link href="<?php echo asset_url() ?>css/animate.css" rel="stylesheet" type="text/css" />
    <!-- Icons CSS-->
    <link href="<?php echo asset_url() ?>css/icons.css" rel="stylesheet" type="text/css" />
    <!-- Sidebar CSS-->
    <link href="<?php echo asset_url() ?>css/sidebar-menu.css" rel="stylesheet" />
    <!-- Custom Style-->
    <link href="<?php echo asset_url() ?>css/app-style.css" rel="stylesheet" />
</head>

<body class="bg-theme bg-theme1">
	<div class="wrapper m-5">
		<div class="container-fluid text-center">
			<div class="row">
				<div class="col-md-12">
					<h3> SISTEM INFORMASI</h3>
					<p class="lead mb-5 colr"><h1><strong><?php echo $setting_yayasan['setting_value'] ?></strong></h1></p>
				</div>	
				
				<!-- div  class="row">
					<div  class="card">                        
					<?php if (!empty($setting_logo_yayasan['setting_value'])) { ?>
						<img class="card-img-block" src="<?php echo upload_url('school/'.$setting_logo_yayasan['setting_value']) ?>" style="height: 140px; width: 140px;">
						<?php } else { ?>
						<img src="<?php echo media_url('img/missing.png') ?>" style="height: 140px; width: 140px;">
					<?php } ?>
					</div>
					<div class="col-md-3 text-right">              
					<?php if (!empty($setting_logo['setting_value'])) { ?>
						<img class="card-img-block" src="<?php echo upload_url('school/'.$setting_logo['setting_value']) ?>" style="height: 140px; width: 140px; margin-left:200px;">
						<?php } else { ?>
						<img src="<?php echo media_url('img/missing.png') ?>" style="height: 140px; width: 140px; ">
					<?php } ?>
					</div>      
				</div-->
				<div class="col-md-3 mt-5">
					<a href="<?php echo site_url('home') ?>">
					<div class="card pt-2 pb-2">
						<i class="fa fa-5x fa-money"></i>
						<strong>Cek Pembayaran</strong>
					</div>
				</a>
				</div>
				<div class="col-md-3 mt-5">
					<a href="<?php echo site_url('student') ?>">
					<div class="card pt-2 pb-2">
						<i class="fa fa-5x fa-graduation-cap"></i>
						<strong>Login Siswa</strong>
					</div>
				</a>
				</div>
				<div class="col-md-3 mt-5">
					<a href="<?php echo site_url('guru') ?>">
					<div class="card pt-2 pb-2">
						<i class="fa fa-5x fa-user"></i>
						<strong>Login Guru</strong> 
					</div>
				</a>
				</div>
				<div class="col-md-3 mt-5">
					<a href="<?php echo site_url('manage') ?>">
					<div class="card pt-2 pb-2">
						<i class="fa fa-5x fa-user"></i>
						<strong>Login Staff</strong> 
					</div>
				</a>
				</div>
			</div>
		</div>
	</div>


</body>

</html>
