<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
    <div class="brand-logo">     
    <?php if (!empty(logo())) { ?>      
        <img src="<?php echo upload_url('school/' . logo()) ?>" class="logo-icon" alt="logo icon">   
      <?php } else { ?>
        <img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">   
      <?php } ?>
      <h5 class="logo-text">
        <?php echo ucfirst($this->config->item('app_name')); ?>
      </h5>        
    </div>
    <ul class="sidebar-menu do-nicescrol mt-5">
        <li class="sidebar-header">
          <i class="fa fa-circle text-success"></i> Online
        </li>
        <li class="<?php echo ($this->uri->segment(2) == 'dashboard' OR $this->uri->segment(2) == NULL) ? 'active' : '' ?>">
            <a href="<?php echo site_url('student'); ?>">
                <i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span>
            </a>
        </li>

        <li class="<?php echo ($this->uri->segment(2) == 'payout') ? 'active' : '' ?>">
            <a href="<?php echo site_url('student/payout'); ?>">
                <i class="zmdi zmdi-calendar-check"></i> <span>Bulanan</span>
                <small class="badge float-right badge-light">New</small>
            </a>
        </li>
    </ul>

</div>
