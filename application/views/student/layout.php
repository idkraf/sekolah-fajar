<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $this->config->item('app_name') ?> <?php echo isset($title) ? ' | ' . $title : null; ?></title>
  <link rel="icon" type="image/png" href="<?php echo media_url('img/logo.png') ?>">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
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
  <div class="wrapper">

    <header class="main-header">        
      <nav class="navbar navbar-expand fixed-top">
          <ul class="navbar-nav mr-auto align-items-center">
              <li class="nav-item">
                  <a class="nav-link toggle-menu" href="javascript:void();">
                      <i class="icon-menu menu-icon"></i>
                  </a>
              </li>
              <!--li class="nav-item">
                  <form class="search-bar">
                      <input type="text" class="form-control" placeholder="Enter keywords">
                      <a href="javascript:void();"><i class="icon-magnifier"></i></a>
                  </form>
              </li-->
          </ul>

          <ul class="navbar-nav align-items-center right-nav-link">
              <!--li class="nav-item dropdown-lg">
                  <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown"
                      href="javascript:void();">
                      <i class="fa fa-envelope-open-o"></i></a>
              </li>
              <li class="nav-item dropdown-lg">
                  <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown"
                      href="javascript:void();">
                      <i class="fa fa-bell-o"></i></a>
              </li>
              <li class="nav-item language">
                  <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown"
                      href="javascript:void();"><i class="fa fa-flag"></i></a>
                  <ul class="dropdown-menu dropdown-menu-right">
                      <li class="dropdown-item"> <i class="flag-icon flag-icon-gb mr-2"></i> English</li>
                      <li class="dropdown-item"> <i class="flag-icon flag-icon-fr mr-2"></i> French</li>
                      <li class="dropdown-item"> <i class="flag-icon flag-icon-cn mr-2"></i> Chinese</li>
                      <li class="dropdown-item"> <i class="flag-icon flag-icon-de mr-2"></i> German</li>
                  </ul>
              </li-->
              <li class="nav-item">
                  <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
                      <span class="user-profile">                        
                        <?php if ($this->session->userdata('student_img') != null) { ?>
                        <img src="<?php echo upload_url().'/student/'.$this->session->userdata('student_img'); ?>" class="img-circle"
                              alt="user avatar">
                        <?php } else { ?>
                        <img src="https://via.placeholder.com/110x110" class="img-circle"
                              alt="user avatar">
                        <?php } ?>
                      </span>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-right">
                      <li class="dropdown-item user-details">
                          <a href="javaScript:void();">
                              <div class="media">
                                  <div class="avatar">                                  
                                    <?php if ($this->session->userdata('student_img') != null) { ?>
                                    <img class="align-self-start mr-3"
                                          src="<?php echo upload_url().'/student/'.$this->session->userdata('student_img'); ?>" alt="user avatar">
                                          <?php } else { ?>
                                    <img class="align-self-start mr-3"
                                          src="https://via.placeholder.com/110x110" alt="user avatar">
                                    <?php } ?>
                                    </div>
                                  <div class="media-body">
                                      <h6 class="mt-2 user-title"><?php echo ucfirst($this->session->userdata('ufullname_student')); ?></h6>
                                      <p class="user-subtitle"><?php echo $this->session->userdata('unis_student'); ?></p>
                                  </div>
                              </div>
                          </a>
                      </li>
                      <!--li class="dropdown-divider"></li>
                      <li class="dropdown-item"><i class="icon-envelope mr-2"></i> Inbox</li-->
                      <li class="dropdown-divider"></li>
                      <li class="dropdown-item">
                        <a href="<?php echo site_url('student/profile') ?>">
                        <i class="icon-wallet mr-2"></i> Account
                        </a>
                      </li>
                      <!--li class="dropdown-divider"></li>
                      <li class="dropdown-item"><i class="icon-settings mr-2"></i> Setting</li-->
                      <li class="dropdown-divider"></li>
                      <li class="dropdown-item">
                        <a href="<?php echo site_url('student/auth/logout?location=' . htmlspecialchars($_SERVER['REQUEST_URI'])) ?>">
                        <i class="icon-power mr-2"></i> Logout
                        </a>
                      </li>
                  </ul>
              </li>
          </ul>
      </nav>
    </header> 

    <?php $files = glob('media/barcode_student/*');
    foreach($files as $file) { // iterate files
      if(is_file($file))
    unlink($file); // delete file
    } ?>

    <?php $this->load->view('student/sidebar'); ?>
    <!-- Content Wrapper. Contains page content -->
    <?php isset($main) ? $this->load->view($main) : null; ?>
    <!-- Content Wrapper. Contains page content -->

    
    <!-- /.content-wrapper -->
    <!--footer class="footer">      
      <div class="container">
          <div class="pull-right hidden-xs">
            <?php echo $this->config->item('app_name').' '.$this->config->item('version') ?>
          </div>
          <p class="hidden-xs text-left"><?php echo $this->config->item('created') ?></p>
      </div>
    </footer-->

    <!--div class="navbar navbar-default navbar-fixed-bottom hidden-lg hidden-md hidden-sm">
      <div class="bott-bar hidden-lg hidden-md hidden-sm">
        <div class="pos-bar">
          <a class="content-bar <?php echo ($this->uri->segment(1) == 'student' && $this->uri->segment(2) == NULL) ? 'active' : '' ?>" href="<?php echo site_url('student') ?>">
            <div class="group-bot-bar">
              <i class="fa fa-th icon-bot-bar"></i>
              <p class="text-bot-bar">Dashboard</p>
            </div>
          </a>
          <a class="content-bar <?php echo ($this->uri->segment(2) == 'payout') ? 'active' : '' ?>" href="<?php echo site_url('student/payout') ?>">
            <div class="group-bot-bar">
              <i class="fa fa-calendar icon-bot-bar"></i>
              <p class="text-bot-bar">Bulanan</p>
            </div>
          </a>
          <a class="content-bar <?php echo ($this->uri->segment(1) == 'student' && $this->uri->segment(2) == NULL) ? 'active' : '' ?>" href="<?php echo site_url('student') ?>">
            <div class="group-bot-bar">
              <i class="fa fa-home icon-bot-bar"></i>
              <p class="text-bot-bar">Home</p>
            </div>
          </a>
          <a class="content-bar <?php echo ($this->uri->segment(1) == 'student' && $this->uri->segment(2) == NULL) ? 'active' : '' ?>" href="<?php echo site_url('student') ?>">
            <div class="group-bot-bar">
              <i class="fa fa-home icon-bot-bar"></i>
              <p class="text-bot-bar">Home</p>
            </div>
          </a>
          <a class="content-bar <?php echo ($this->uri->segment(2) == 'profile' && $this->uri->segment(3) == NULL) ? 'active' : '' ?>" href="<?php echo site_url('student/profile') ?>">
            <div class="group-bot-bar">
              <i class="fa fa-user icon-bot-bar"></i>
              <p class="text-bot-bar">Profile</p>
            </div>
          </a>
        </div>
      </div>
    </div-->

  </div>

    <!-- jQuery 3 -->
    
    <!-- SlimScroll -->
    <script src="<?php echo media_url() ?>/js/jquery.slimscroll.min.js"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo asset_url() ?>js/jquery.min.js"></script>
    <script src="<?php echo asset_url() ?>js/popper.min.js"></script>
    <script src="<?php echo asset_url() ?>js/bootstrap.min.js"></script>

    <!-- simplebar js -->
    <script src="<?php echo asset_url() ?>plugins/simplebar/js/simplebar.js"></script>
    <!-- sidebar-menu js -->
    <script src="<?php echo asset_url() ?>js/sidebar-menu.js"></script>
    <!-- Custom scripts -->
    <script src="<?php echo asset_url() ?>js/app-script.js"></script>
    <!-- Chart js -->

    <script src="<?php echo asset_url() ?>plugins/Chart.js/Chart.min.js"></script>

    <!-- Full Calendar -->
    <script src="<?php echo asset_url() ?>plugins/fullcalendar/js/moment.min.js"></script>
    <script src="<?php echo asset_url() ?>plugins/fullcalendar/js/fullcalendar.min.js"></script>
    <script src="<?php echo asset_url() ?>plugins/fullcalendar/js/fullcalendar-custom-script.js"></script>

    <?php if ($this->session->flashdata('success')) { ?>
    <script>
      $(document).ready(function() {
        $.toast({
          heading: 'Berhasil',
          text: '<?php echo $this->session->flashdata('success') ?>',
          position: 'top-right',
          loaderBg: '#ff6849',
          icon: 'success',
          hideAfter: 3500,
          stack: 6
        })
      });
    </script>
    <?php } ?>

    <script>
      $(function separator() {
        $('.numeric').inputmask("numeric", {
          removeMaskOnSubmit: true,
          radixPoint: ".",
          groupSeparator: ",",
          digits: 2,
          autoGroup: true,
            prefix: 'Rp ', //Space after $, this will not truncate the first character.
            rightAlign: false,
            // oncleared: function() {
            //   self.Value('');
            // }
          });
      });
    </script>

    <script>
      $.widget.bridge('uibutton', $.ui.button);
      $(".input-group.date").datepicker({autoclose: true, todayHighlight: true});
      $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
      });
    </script>

  </body>
  </html>
