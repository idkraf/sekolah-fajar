<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title><?php echo $setting_school['setting_value'] ?></title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="icon" type="image/png" href="<?php echo media_url('img/smplogo.png') ?>">

  <link href="<?php echo media_url() ?>css/login.css" rel="stylesheet" />
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
<body class="bg-theme bg-theme3">


  <div class="row">
    <div class="col-md-5">
      <div class="card logo hidden-xs hidden-sm">
        <?php if (isset($setting_logo) AND $setting_logo['setting_value'] == NULL) { ?>
        <img src="<?php echo media_url('img/logo.png') ?>" class="img-responsive card-img-top">
        <?php } else { ?>
        <img src="<?php echo upload_url('school/' . $setting_logo['setting_value']) ?>" class="img-responsive">
        <?php } ?>
      </div>
      <p class="merk"><span style="color: #2ABB9B">SISTEM INFORMASI PEMBAYARAN</span> </p> 
      <?php if (isset($setting_school) AND $setting_school['setting_value'] == '-') { ?>
      <p class="school">Sistem Informasi Pembayaran </p> 
      <?php } else { ?>
      <p class="school"><?php echo $setting_school['setting_value'] ?></p> 
      <?php } ?> 
    </div>
    <div class="col-md-7">
      <div class="card">
        <?php echo form_open('student/auth/login', array('class'=>'login100-form validate-form')); ?>

        <div class="col-md-12">
          <p class="title-login">Login Siswa</p>
          <?php if ($this->session->flashdata('failed')) { ?>
          <br><br>
        <div class="alert alert-danger alert-dismissible" style="margin-top: -85px !important;">
          <h5><i class="fa fa-close"></i> NIS atau Password salah!</h5>
        </div>
        <?php  }  ?>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>NIS</label>
                <input type="text" required="" autofocus="" name="nis" placeholder="Masukan NIS" class="form-control flat">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Password</label>
                <input type="password" required="" name="password" placeholder="Masukan password" class="form-control flat">
              </div>
            </div>
          </div>
          <button class="btn btn-login">Login</button>
        </div>
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>


</body>
</html>
