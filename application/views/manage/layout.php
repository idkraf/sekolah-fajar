<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo isset($title) ? '' . $title : null; ?></title>
  <link rel="icon" type="image/png" href="<?php echo media_url('img/smplogo.png') ?>">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <link href="<?php echo base_url('/media/js/forms/selects/select2.min.css');?>" rel="stylesheet" type="text/css">
   <link rel="stylesheet" type="text/css" href="<?php echo media_url() ?>/css/tables/datatable/datatables.min.css">
   <link rel="stylesheet" type="text/css" href="<?php echo media_url() ?>css/buttons.dataTables.min.css">
          
   <!-- Date Picker -->
   <link rel="stylesheet" href="<?php echo media_url() ?>css/bootstrap-datepicker.min.css">
   <!-- Daterange picker -->
   <link rel="stylesheet" href="<?php echo media_url() ?>css/daterangepicker.css">
    <!--Full Calendar Css-->
    <!--link href="<?php echo asset_url() ?>plugins/fullcalendar/css/fullcalendar.min.css" rel='stylesheet' /-->
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

    <!-- Bootstrap core JavaScript-->
   <script src="<?php echo media_url() ?>/js/jquery.min.js"></script>
    <script src="<?php echo asset_url() ?>js/popper.min.js"></script>
    <script src="<?php echo asset_url() ?>js/bootstrap.min.js"></script>

    <script src="<?php echo media_url() ?>/js/angular.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo media_url() ?>/js/jquery-ui.min.js"></script>
    <script src="<?php echo media_url() ?>/js/jquery.inputmask.bundle.js"></script>
   
  <script type="text/javascript">var baseurl = '<?php echo base_url() ?>';            
    var crsf_token = '<?= $this->security->get_csrf_token_name() ?>';
    var crsf_hash = '<?= $this->security->get_csrf_hash(); ?>';
  </script>

 </head>
 <body class="bg-theme bg-theme1 hold-transition fixed sidebar-mini" <?php echo isset($ngapp) ? $ngapp : null; ?>>
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
                <?php if ($this->session->userdata('user_image') != null) { ?>
                        <img src="<?php echo upload_url().'/users/'.$this->session->userdata('user_image'); ?>" class="img-circle"
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
                <?php if ($this->session->userdata('user_image') != null) { ?>
                                    <img class="align-self-start mr-3"
                                          src="<?php echo upload_url().'/users/'.$this->session->userdata('user_image'); ?>" alt="user avatar">
                                          <?php } else { ?>
                                    <img class="align-self-start mr-3"
                                          src="https://via.placeholder.com/110x110" alt="user avatar">
                                    <?php } ?>
                                    </div>
                                  <div class="media-body">
                                      <h6 class="mt-2 user-title"><?php echo ucfirst($this->session->userdata('ufullname')); ?></h6>
                                      <p class="user-subtitle"><?php echo ucfirst($this->session->userdata('urolename')); ?></p>
                                      <p class="user-subtitle"><?php echo $this->session->userdata('uemail'); ?></p>
                                  </div>
                              </div>
                          </a>
                      </li>
                      <!--li class="dropdown-divider"></li>
                      <li class="dropdown-item"><i class="icon-envelope mr-2"></i> Inbox</li-->
                      <li class="dropdown-divider"></li>
                      <li class="dropdown-item">
                        <a href="<?php echo site_url('manage/profile') ?>">
                        <i class="icon-wallet mr-2"></i> Account
                        </a>
                      </li>
                      <!--li class="dropdown-divider"></li>
                      <li class="dropdown-item"><i class="icon-settings mr-2"></i> Setting</li-->
                      <li class="dropdown-divider"></li>
                      <li class="dropdown-item">
                        <a href="<?php echo site_url('manage/auth/logout?location=' . htmlspecialchars($_SERVER['REQUEST_URI'])) ?>">
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

<?php $this->load->view('manage/sidebar'); ?>

<!-- Content Wrapper. Contains page content -->
<?php isset($main) ? $this->load->view($main) : null; ?>
<!-- Content Wrapper. Contains page content -->


<!-- /.content-wrapper -->
<!--footer class="main-footer">
  <div class="pull-right hidden-xs">
    <//?php echo $this->config->item('app_name').' '.$this->config->item('version') ?>
  </div>
  <//?php echo $this->config->item('created') ?>
</footer-->

<!-- jQuery 3 -->


<!-- simplebar js -->
<script src="<?php echo asset_url() ?>plugins/simplebar/js/simplebar.js"></script>
<!-- sidebar-menu js -->
<script src="<?php echo asset_url() ?>js/sidebar-menu.js"></script>
<!-- Custom scripts -->
<script src="<?php echo asset_url() ?>js/app-script.js"></script>
<!-- Chart js -->

<script src="<?php echo asset_url() ?>plugins/Chart.js/Chart.min.js"></script>

<!-- Full Calendar -->
<!--script src="<//?php echo asset_url() ?>plugins/fullcalendar/js/moment.min.js"></script>
<script src="<//?php echo asset_url() ?>plugins/fullcalendar/js/fullcalendar.min.js"></script>
<script src="<//?php echo asset_url() ?>plugins/fullcalendar/js/fullcalendar-custom-script.js"></script-->

<script src="<?php echo media_url() ?>js/moment.min.js"></script>
<script src="<?php echo media_url() ?>js/fullcalendar/fullcalendar.js"></script>
<script src="<?php echo media_url() ?>js/fullcalendar.min.js"></script>


<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Notyfy JS -->
<script src="<?php echo media_url() ?>js/jquery.toast.js"></script>
<script src="<?php echo media_url() ?>js/select2.min.js"></script>
<script src="<?php echo media_url(); ?>js/tables/datatable/datatables.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo media_url() ?>/js/jquery.slimscroll.min.js"></script>
   
<script>
  // $(".input-group.date").datepicker({autoclose: true, todayHighlight: true});
  $(".years").datepicker({
    format: "yyyy",
    viewMode: "years",
    minViewMode: "years",
    autoclose: true,
    todayHighlight: true
  });
  $(".input-group.date").datepicker({
    format: "yyyy-mm-dd",
    autoclose: true,
    todayHighlight: true
  });
  
  $('.select2').select2();
  //universal list item delete from table
  $(document).on('click', ".delete-object", function (e) {
      e.preventDefault();
      $('#object-id').val($(this).attr('data-object-id'));

      $(this).closest('tr').attr('id', $(this).attr('data-object-id'));
      $('#delete_model').modal({backdrop: 'static', keyboard: false});

  });
  $(document).on('click', ".delete-object2", function (e) {
      e.preventDefault();
      $('#object-id2').val($(this).attr('data-object-id'));
      $(this).closest('tr').attr('id', $(this).attr('data-object-id'));
      $('#delete_model2').modal({backdrop: 'static', keyboard: false});

  });

  $("#delete-confirm").on("click", function () {
      var o_data = 'deleteid=' + $('#object-id').val();
      var action_url = $('#delete_model #action-url').val();
      $('#' + $('#object-id').val()).remove();
      removeObject(o_data, action_url);
  });
  $("#delete-confirm2").on("click", function () {
      var o_data = 'deleteid=' + $('#object-id2').val();
      var action_url = $('#delete_model2 #action-url2').val();
      $('#' + $('#object-id2').val()).remove();
      removeObject(o_data, action_url);
  });
</script>

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

<?php if ($this->session->flashdata('failed')) { ?>
  <script>
    $(document).ready(function() {
      $.toast({
       heading: 'Gagal',
       text: '<?php echo $this->session->flashdata('failed') ?>',
       position: 'top-right',
       loaderBg: '#ff6849',
       icon: 'error',
       hideAfter: 3500,
       stack: 6
     })
    });
  </script>
<?php } ?>


<script>
  $(document).ready(function(){
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
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
  });
</script>

</body>
</html>
