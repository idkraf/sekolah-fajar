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
    <ul class="sidebar-menu do-nicescrol mt-5 ">
        <li class="sidebar-header">
          <i class="fa fa-circle text-success"></i> Online
        </li>
        <li class="<?php echo ($this->uri->segment(1) == 'dashboard' OR $this->uri->segment(1) == NULL) ? 'active' : '' ?>">
            <a href="<?php echo site_url('manage'); ?>">
                <i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span>
            </a>
        </li>
        <?php if(aturan(2,$this->session->userdata('uroleid'))){ ?>
        <li class="<?php echo ($this->uri->segment(2) == 'student' 
        OR $this->uri->segment(4) == 'class' 
        OR $this->uri->segment(4) == 'majors' 
        OR $this->uri->segment(4) == 'period'
        OR $this->uri->segment(4) == 'semester'
        OR $this->uri->segment(4) == 'upgrade'
        OR $this->uri->segment(4) == 'pass'
        ) ? 'active' : '' ?> treeview">
        <a href="javascript:;" class="has-arrow" aria-expanded="false">
            <i class="fa fa-graduation-cap text-stock"></i> <span>Akademik</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="sidebar-submenu treeview-menu">
            <li class="<?php echo ($this->uri->segment(2) == 'student' AND $this->uri->segment(3) != 'pass' AND $this->uri->segment(3) != 'upgrade') ? 'active' : '' ?> ">
              <a href="<?php echo site_url('manage/student') ?>"><i class="fa  <?php echo ($this->uri->segment(2) == 'student' AND $this->uri->segment(3) != 'pass' AND $this->uri->segment(3) != 'upgrade') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> Siswa</a>
            </li>
            <li class="<?php echo ($this->uri->segment(2) == 'class') ? 'active' : '' ?> ">
              <a href="<?php echo site_url('manage/class') ?>"><i class="fa  <?php echo ($this->uri->segment(2) == 'class') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> Kelas</a>
            </li>
            <li class="<?php echo ($this->uri->segment(2) == 'period') ? 'active' : '' ?> ">
              <a href="<?php echo site_url('manage/period') ?>"><i class="fa  <?php echo ($this->uri->segment(2) == 'period') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> Tahun Ajaran</a>
            </li>
            <li class="<?php echo ($this->uri->segment(2) == 'semester') ? 'active' : '' ?> ">
              <a href="<?php echo site_url('manage/semester') ?>"><i class="fa  <?php echo ($this->uri->segment(2) == 'semester') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> Semester</a>
            </li>
            <?php if (majors() == 'senior') { ?>
            <li class="<?php echo ($this->uri->segment(2) == 'majors') ? 'active' : '' ?> ">
              <a href="<?php echo site_url('manage/majors') ?>">
              <i class="fa  <?php echo ($this->uri->segment(2) == 'majors') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> Program Keahlian</a>
            </li>
            <?php } ?>
            <li class="<?php echo ($this->uri->segment(3) == 'upgrade') ? 'active' : '' ?> ">
              <a href="<?php echo site_url('manage/student/upgrade') ?>">
              <i class="fa  <?php echo ($this->uri->segment(3) == 'upgrade') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> Kenaikan Kelas</a>
            </li>
            <!--li class="">
              <a href=""><i class="fa fa-circle-o"></i> Pindah</a>
            </li-->
            <li class="<?php echo ($this->uri->segment(3) == 'pass') ? 'active' : '' ?> ">
              <a href="<?php echo site_url('manage/student/pass') ?>">
              <i class="fa  <?php echo ($this->uri->segment(3) == 'pass') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> Kelulusan</a>
            </li>
          </ul>
        </li>

        <?php } ?>
        <!-- PEMBAYARAN SISWA-->

        <?php if(aturan(4,$this->session->userdata('uroleid'))){ ?>
        <li class="<?php echo ($this->uri->segment(4) == 'payout' 
        OR $this->uri->segment(4) == 'pos' 
        OR $this->uri->segment(4) == 'payment' 
        OR $this->uri->segment(4) == 'report' 
        OR $this->uri->segment(4) == 'report_bill' 
        OR $this->uri->segment(4) == 'kredit' 
        OR $this->uri->segment(4) == 'debit'
        OR $this->uri->segment(4) == 'bukti'
        OR $this->uri->segment(4) == 'pos'
        OR $this->uri->segment(4) == 'payment'
        OR $this->uri->segment(4) == 'item'
        ) ? 'active' : '' ?> treeview">
        <a href="javascript:;">
          <i class="fa fa-credit-card"></i> <span>Pembayaran Spp</span>
          <span class="pull-right-container">              
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>

        <ul class="sidebar-submenu treeview-menu">
          <!--
          <li class="">
            <a href=""><i class="fa fa-circle-o"></i> Unit, TK, SD, SMP, SMA</a>
          </li>
          -->
          <li class="<?php echo ($this->uri->segment(2) == 'payout') ? 'active' : '' ?> ">
            <a href="<?php echo site_url('manage/payout') ?>">
            <i class="fa  <?php echo ($this->uri->segment(2) == 'payout') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i>
              Pembayaran Siswa</a>
          </li>
          <li class="<?php echo ($this->uri->segment(2) == 'bukti') ? 'active' : '' ?>">
            <a href="<?php echo site_url('manage/bukti/add'); ?>">
              <i class="fa  <?php echo ($this->uri->segment(2) == 'bukti') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i>               
              <span>Input Bukti Bayar</span>
              <span class="pull-right-container"></span>
            </a>
          </li>
          <li class="<?php echo ($this->uri->segment(2) == 'bukti') ? 'active' : '' ?>">
            <a href="<?php echo site_url('manage/bukti'); ?>">
              <i class="fa  <?php echo ($this->uri->segment(2) == 'bukti') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i>               
              <span>Konfirmasi Pembayaran</span>
              <span class="pull-right-container"></span>
            </a>
          </li>
          <li class="<?php echo ($this->uri->segment(2) == 'pos'
            OR $this->uri->segment(2) == 'payment'
            OR $this->uri->segment(2) == 'item'
            ) ? 'active' : '' ?> treeview">
            <a href="#">
              <i class="fa fa-suitcase"></i> <span>Setting Pembayaran</span>
              <span class="pull-right-container">              
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>              
            <ul class="sidebar-submenu treeview-menu">
                          
                <!--    <li class="<//?php echo ($this->uri->segment(2) == 'account') ? 'active' : '' ?>">
                  <a href="<//?php echo site_url('manage/account') ?>">
                    <i class="fa fa-circle-o"></i> Akun Biaya</a>
                </li>-->           

                <li class="<?php echo ($this->uri->segment(2) == 'pos') ? 'active' : '' ?> ">
                  <a href="<?php echo site_url('manage/pos') ?>">
                  <i class="fa  <?php echo ($this->uri->segment(2) == 'pos') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> 
                  Pos Bayar</a>
                </li>                    
                <li class="<?php echo ($this->uri->segment(2) == 'payment') ? 'active' : '' ?> ">
                  <a href="<?php echo site_url('manage/payment') ?>">
                  <i class="fa  <?php echo ($this->uri->segment(2) == 'payment') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> 
                  Jenis Bayar</a>
                </li>                         
                <li class="<?php echo ($this->uri->segment(2) == 'item') ? 'active' : '' ?>">
                  <a href="<?php echo site_url('manage/item') ?>">
                    <i class="fa  <?php echo ($this->uri->segment(2) == 'item') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> 
                    Unit Pos</a>
                </li>

              </ul>
            </li>

            <li class="<?php echo ($this->uri->segment(2) == 'report' AND $this->uri->segment(3) != 'report_bill') ? 'active' : '' ?> ">
              <a href="<?php echo site_url('manage/report') ?>">
              <i class="fa  <?php echo ($this->uri->segment(2) == 'report' AND $this->uri->segment(3) != 'report_bill') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> 
              Lap. Pembayaran</a>
            </li>
            <li class="<?php echo ($this->uri->segment(3) == 'report_bill') ? 'active' : '' ?> ">
              <a href="<?php echo site_url('manage/report/report_bill') ?>"><i class="fa  <?php echo ($this->uri->segment(3) == 'report_bill') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> Rekapitulasi</a>
            </li>
            <li class="<?php echo ($this->uri->segment(2) == 'kredit') ? 'active' : '' ?> ">
              <a href="<?php echo site_url('manage/kredit') ?>"><i class="fa  <?php echo ($this->uri->segment(2) == 'kredit') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> Pengeluaran</a>
            </li>
            <li class="<?php echo ($this->uri->segment(2) == 'debit') ? 'active' : '' ?> ">
              <a href="<?php echo site_url('manage/debit') ?>"><i class="fa  <?php echo ($this->uri->segment(2) == 'debit') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> Pemasukan</a>
            </li>
          </ul>
        </li>

        <?php } ?>

        <?php if(aturan(5,$this->session->userdata('uroleid'))){ ?>
        <li class="<?php echo ($this->uri->segment(2) == 'jabatan' 
        OR $this->uri->segment(2) == 'pegawai'
        OR $this->uri->segment(2) == 'penggajian'
        OR $this->uri->segment(2) == 'slip'
        ) 
        ? 'active' 
        : '' ?>
        treeview">
          <a href="#">
            <i class="fa fa-suitcase"></i> <span>Kepegawaian</span>
            <span class="pull-right-container">              
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          
          <ul class="sidebar-submenu treeview-menu">
            
            <li class="<?php echo ($this->uri->segment(2) == 'jabatan') ? 'active' : '' ?>">
              <a href="<?php echo site_url('manage/jabatan'); ?>">
              <i class="fa  <?php echo ($this->uri->segment(2) == 'jabatan') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i>
              Jabatan pegawai
              </a>
            </li>
            <li class="<?php echo ($this->uri->segment(2) == 'pegawai') ? 'active' : '' ?>">
              <a href="<?php echo site_url('manage/pegawai'); ?>">
                <i class="fa <?php echo ($this->uri->segment(2) == 'pegawai') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> 
                Pegawai
              </a>
            </li>
            <li class="<?php echo ($this->uri->segment(2) == 'penggajian') ? 'active' : '' ?>">
              <a href="<?php echo site_url('manage/penggajian'); ?>">
                <i class="fa <?php echo ($this->uri->segment(2) == 'penggajian') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i>
                Set. Gaji</a>
            </li>
            <li class="<?php echo ($this->uri->segment(2) == 'slip') ? 'active' : '' ?>">
              <a href="<?php echo site_url('manage/slip'); ?>">
                <i class="fa <?php echo ($this->uri->segment(2) == 'slip') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i>
                Slip Gaji</a>
            </li>
          </ul>
        </li>
        <?php } ?>


        <?php if(aturan(6,$this->session->userdata('uroleid'))){ ?>
        <li class="<?php echo ($this->uri->segment(2) == 'peminjaman' 
          OR $this->uri->segment(2) == 'pengunjung'
          OR $this->uri->segment(2) == 'buku'
          OR $this->uri->segment(2) == 'bukuin'
          OR $this->uri->segment(2) == 'bukuout'
          ) 
          ? 'active' 
          : '' ?> treeview">
          <a href="javascript:;">
            <i class="fa fa-lightbulb-o"></i> <span>Perpustakaan</span>
            <span class="pull-right-container">              
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          
          <ul class="sidebar-submenu treeview-menu">
                
            <li class="<?php echo ($this->uri->segment(2) == 'buku') ? 'active' : '' ?>">
              <a href="<?php echo site_url('manage/buku'); ?>">
              <i class="fa <?php echo ($this->uri->segment(2) == 'buku') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> 
              Buku</a>
            </li>           
            <li class="<?php echo ($this->uri->segment(2) == 'peminjaman') ? 'active' : '' ?>">
              <a href="<?php echo site_url('manage/peminjaman'); ?>">
              <i class="fa <?php echo ($this->uri->segment(2) == 'peminjaman') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> 
              Peminjaman</a>
            </li>
            <li class="<?php echo ($this->uri->segment(2) == 'pengunjung') ? 'active' : '' ?>">
              <a href="<?php echo site_url('manage/pengunjung'); ?>">
              <i class="fa <?php echo ($this->uri->segment(2) == 'pengunjung') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> 
              Pengunjung</a>
            </li>
          </ul>
        </li>
        <?php } ?>


        <?php if(aturan(7,$this->session->userdata('uroleid'))){ ?>

        <li class="<?php echo ($this->uri->segment(2) == 'aset' 
          OR $this->uri->segment(2) == 'inventaris' 
          OR $this->uri->segment(2) == 'mutasi'
          OR $this->uri->segment(2) == 'asetin'
          OR $this->uri->segment(2) == 'asetout'
          OR $this->uri->segment(2) == 'kategori'
          OR $this->uri->segment(2) == 'bahan'
          OR $this->uri->segment(2) == 'ruangan'
          OR $this->uri->segment(2) == 'tempat'
          OR $this->uri->segment(2) == 'dana'
          OR $this->uri->segment(2) == 'kondisi'
          OR $this->uri->segment(2) == 'stok'
          OR $this->uri->segment(2) == 'qr'
          ) 
          ? 'active' 
          : '' ?> treeview">
          <a href="javascript:;">
            <i class="fa fa-upload"></i> <span>Asset</span>
            <span class="pull-right-container">              
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          
          <ul class="sidebar-submenu treeview-menu">
            <li class="<?php echo ($this->uri->segment(2) == 'aset') ? 'active' : '' ?>">
              <a href="<?php echo site_url('manage/aset'); ?>">
              <i class="fa <?php echo ($this->uri->segment(2) == 'aset') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> 
              Data Master</a>
            </li>
            <li class="<?php echo ($this->uri->segment(2) == 'inventaris') ? 'active' : '' ?>">
              <a href="<?php echo site_url('manage/inventaris'); ?>">
              <i class="fa <?php echo ($this->uri->segment(2) == 'inventaris') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> 
              Kartu Inventaris</a>
            </li>
            <li class="<?php echo ($this->uri->segment(2) == 'mutasi') ? 'active' : '' ?>">
              <a href="<?php echo site_url('manage/mutasi'); ?>">
              <i class="fa <?php echo ($this->uri->segment(2) == 'mutasi') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> 
              Form Mutasi</a>
            </li>
            <li class="<?php echo ($this->uri->segment(2) == 'kategori') ? 'active' : '' ?>">
              <a href="<?php echo site_url('manage/kategori'); ?>">
              <i class="fa <?php echo ($this->uri->segment(2) == 'kategori') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> 
              Kategori</a>
            </li>
            <li class="<?php echo ($this->uri->segment(2) == 'bahan') ? 'active' : '' ?>">
              <a href="<?php echo site_url('manage/bahan'); ?>">
              <i class="fa <?php echo ($this->uri->segment(2) == 'bahan') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> 
              Bahan</a>
            </li>
            <li class="<?php echo ($this->uri->segment(2) == 'ruangan') ? 'active' : '' ?>">
              <a href="<?php echo site_url('manage/ruangan'); ?>">
              <i class="fa <?php echo ($this->uri->segment(2) == 'ruangan') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> 
              Ruangan</a>
            </li>
            <li class="<?php echo ($this->uri->segment(2) == 'tempat') ? 'active' : '' ?>">
              <a href="<?php echo site_url('manage/tempat'); ?>">
              <i class="fa <?php echo ($this->uri->segment(2) == 'tempat') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> 
              Tempat</a>
            </li>
            <li class="<?php echo ($this->uri->segment(2) == 'dana') ? 'active' : '' ?>">
              <a href="<?php echo site_url('manage/dana'); ?>">
              <i class="fa <?php echo ($this->uri->segment(2) == 'dana') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> 
              Dana</a>
            </li>
            <li class="<?php echo ($this->uri->segment(2) == 'kondisi') ? 'active' : '' ?>">
              <a href="<?php echo site_url('manage/kondisi'); ?>">
              <i class="fa <?php echo ($this->uri->segment(2) == 'kondisi') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> 
              Kondisi</a>
            </li>
            <li class="<?php echo ($this->uri->segment(2) == 'asetin') ? 'active' : '' ?>">
              <a href="<?php echo site_url('manage/asetin'); ?>">
              <i class="fa <?php echo ($this->uri->segment(2) == 'asetin') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> 
              Lap. Masuk</a>
            </li>
            <li class="<?php echo ($this->uri->segment(2) == 'asetout') ? 'active' : '' ?>">
              <a href="<?php echo site_url('manage/asetout'); ?>">
              <i class="fa <?php echo ($this->uri->segment(2) == 'asetout') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> 
              Lap. Keluar</a>
            </li>
            <!--
            <li class="<?php echo ($this->uri->segment(2) == 'stok') ? 'active' : '' ?>">
              <a href="">
              <i class="fa <?php echo ($this->uri->segment(2) == 'stok') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i>  
              Lap. Stok</a>
            </li>
            <li class="<?php echo ($this->uri->segment(2) == 'qr') ? 'active' : '' ?>">
              <a href="">
              <i class="fa <?php echo ($this->uri->segment(2) == 'qr') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> 
              QR</a>
            </li>
        -->
          </ul>
        </li>

        <?php } ?>


        <?php if(aturan(8,$this->session->userdata('uroleid'))){ ?>
        <li class="<?php echo ($this->uri->segment(7) == 'satuan' 
              OR $this->uri->segment(7) == 'jenis'
              OR $this->uri->segment(7) == 'warna'
              OR $this->uri->segment(7) == 'merek'
              OR $this->uri->segment(7) == 'rasa'
              OR $this->uri->segment(7) == 'gudang'
              OR $this->uri->segment(7) == 'supplier'
              OR $this->uri->segment(7) == 'barang'
              OR $this->uri->segment(7) == 'stokin'
              OR $this->uri->segment(7) == 'stokout'
              OR $this->uri->segment(7) == 'laporan'
              OR $this->uri->segment(7) == 'kartu'
              ) 
              ? 'active' 
              : '' ?> treeview">
          <a href="javascript:;">
            <i class="fa fa-download"></i> <span>Kantin</span>
            <span class="pull-right-container">              
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          
          <ul class="sidebar-submenu treeview-menu">
            <li class="<?php echo ($this->uri->segment(2) == 'barang') ? 'active' : '' ?>">
              <a href="<?php echo site_url('manage/barang'); ?>">
              <i class="fa <?php echo ($this->uri->segment(2) == 'barang') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> 
              Inventori</a>
            </li>

            <li class="<?php echo ($this->uri->segment(7) == 'satuan' 
              OR $this->uri->segment(7) == 'jenis'
              OR $this->uri->segment(7) == 'warna'
              OR $this->uri->segment(7) == 'merek'
              OR $this->uri->segment(7) == 'rasa'
              OR $this->uri->segment(7) == 'gudang'
              OR $this->uri->segment(7) == 'supplier'
              ) 
              ? 'active' 
              : '' ?> treeview">
              <a href="javascript:;">
                <i class="fa fa-database"></i> <span>Master Data</span>
                <span class="pull-right-container">              
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>              
              <ul class="sidebar-submenu treeview-menu">
                <li class="<?php echo ($this->uri->segment(2) == 'satuan') ? 'active' : '' ?>">
                  <a href="<?php echo site_url('manage/satuan'); ?>">
                  <i class="fa <?php echo ($this->uri->segment(2) == 'satuan') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> 
                  Item Unit</a>
                </li>
                <li class="<?php echo ($this->uri->segment(2) == 'jenis') ? 'active' : '' ?>">
                  <a href="<?php echo site_url('manage/jenis'); ?>">
                  <i class="fa <?php echo ($this->uri->segment(2) == 'jenis') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i>  
                  Jenis</a>
                </li>
                <li class="<?php echo ($this->uri->segment(2) == 'warna') ? 'active' : '' ?>">
                  <a href="<?php echo site_url('manage/warna'); ?>">
                  <i class="fa <?php echo ($this->uri->segment(2) == 'warna') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i>  
                  Warna</a>
                </li>
                <li class="<?php echo ($this->uri->segment(2) == 'merek') ? 'active' : '' ?>">
                  <a href="<?php echo site_url('manage/merek'); ?>">
                  <i class="fa <?php echo ($this->uri->segment(2) == 'merek') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i>  
                  Merek</a>
                </li>
                <li class="<?php echo ($this->uri->segment(2) == 'rasa') ? 'active' : '' ?>">
                  <a href="<?php echo site_url('manage/rasa'); ?>">
                  <i class="fa <?php echo ($this->uri->segment(2) == 'rasa') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i>  
                  Rasa</a>
                </li>
                <li class="<?php echo ($this->uri->segment(2) == 'gudang') ? 'active' : '' ?>">
                  <a href="<?php echo site_url('manage/gudang'); ?>">
                  <i class="fa <?php echo ($this->uri->segment(2) == 'gudang') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> 
                  Warehouse</a>
                </li>
                <li class="<?php echo ($this->uri->segment(2) == 'supplier') ? 'active' : '' ?>">
                  <a href="<?php echo site_url('manage/supplier'); ?>">                        
                  <i class="fa <?php echo ($this->uri->segment(2) == 'supplier') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> 
                  Data Suplier</span>
                  </a>
                </li>
              </ul>
            </li>
            <li class="<?php echo ($this->uri->segment(2) == 'stokin') ? 'active' : '' ?>">
              <a href="<?php echo site_url('manage/stokin'); ?>">
                  <i class="fa <?php echo ($this->uri->segment(2) == 'stokin') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> 
                  Barang Masuk</a>
            </li>
            <li class="<?php echo ($this->uri->segment(2) == 'stokout') ? 'active' : '' ?>">
              <a href="<?php echo site_url('manage/stokout'); ?>">
                  <i class="fa <?php echo ($this->uri->segment(2) == 'stokout') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> 
                  Barang Keluar</a>
            </li>
            <li class="<?php echo ($this->uri->segment(2) == 'laporan') ? 'active' : '' ?>">
              <a href="<?php echo site_url('manage/laporan'); ?>">
                  <i class="fa <?php echo ($this->uri->segment(2) == 'laporan') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> 
                  Print Laporan</a>
            </li>
            <li class="<?php echo ($this->uri->segment(2) == 'kartu') ? 'active' : '' ?>">
              <a href="<?php echo site_url('manage/kartu'); ?>">
                  <i class="fa <?php echo ($this->uri->segment(2) == 'kartu') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> 
                  Kartu Kendali</a>
            </li>
          </ul>
        </li>

        <?php } ?>

        <?php if(aturan(9,$this->session->userdata('uroleid'))){ ?>
        <!--li class="">
          <a href="">
            <i class="fa fa-th"></i> <span>BP-BK</span>
            <span class="pull-right-container"></span>
          </a>
        </li-->
        <?php } ?>

        <?php if(aturan(10,$this->session->userdata('uroleid'))){ ?>
        <li class="<?php echo ($this->uri->segment(2) == 'obat' 
            OR $this->uri->segment(2) == 'obatin'
            OR $this->uri->segment(2) == 'obatout'
            OR $this->uri->segment(2) == 'sakit'
            OR $this->uri->segment(2) == 'konseling'
            ) 
            ? 'active' 
            : '' ?>
            treeview">
              <a href="#">
                <i class="fa fa-suitcase"></i> <span>UKS</span>
                <span class="pull-right-container">              
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>              
              <ul class="sidebar-submenu treeview-menu">
                    
                <li class="<?php echo ($this->uri->segment(2) == 'konseling') ? 'active' : '' ?>">
                  <a href="<?php echo site_url('manage/konseling'); ?>">
                  <i class="fa <?php echo ($this->uri->segment(2) == 'konseling') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> 
                  Konseling</a>
                </li>
                <li class="<?php echo ($this->uri->segment(2) == 'obat') ? 'active' : '' ?>">
                  <a href="<?php echo site_url('manage/obat'); ?>">
                  <i class="fa <?php echo ($this->uri->segment(2) == 'obat') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> 
                  Penggunaan Obat</a>
                </li>
                <li class="<?php echo ($this->uri->segment(2) == 'obatin') ? 'active' : '' ?>">
                  <a href="<?php echo site_url('manage/obatin'); ?>">
                  <i class="fa <?php echo ($this->uri->segment(2) == 'obatin') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> 
                  Obat Masuk</a>
                </li>
                <li class="<?php echo ($this->uri->segment(2) == 'obatout') ? 'active' : '' ?>">
                  <a href="<?php echo site_url('manage/obatout'); ?>">
                  <i class="fa <?php echo ($this->uri->segment(2) == 'obatout') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> 
                  Obat Keluar</a>
                </li>
                
                <li class="<?php echo ($this->uri->segment(2) == 'sakit') ? 'active' : '' ?>">
                  <a href="<?php echo site_url('manage/sakit'); ?>">
                  <i class="fa <?php echo ($this->uri->segment(2) == 'sakit') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> 
                  Keterangan Siswa Sakit</a>
                </li>
              </ul>
        </li> 

        <li class="<?php echo ($this->uri->segment(2) == 'inventori' 
          OR $this->uri->segment(2) == 'inventoriin'
          OR $this->uri->segment(2) == 'inventoriout'
          OR $this->uri->segment(2) == 'isatuan' 
          OR $this->uri->segment(2) == 'ijenis'
          OR $this->uri->segment(2) == 'iwarna'
          OR $this->uri->segment(2) == 'imerek'
          OR $this->uri->segment(2) == 'irasa'
          OR $this->uri->segment(2) == 'igudang'
          OR $this->uri->segment(2) == 'isupplier'
          OR $this->uri->segment(2) == 'ilaporan'
          OR $this->uri->segment(2) == 'ikartu'
          ) 
          ? 'active' 
          : '' ?> treeview">
          <a href="javascript:;">
            <i class="fa fa-upload"></i> <span>Gudang</span>
            <span class="pull-right-container">              
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          
          <ul class="sidebar-submenu treeview-menu">
            <li class="<?php echo ($this->uri->segment(2) == 'inventori') ? 'active' : '' ?>">
              <a href="<?php echo site_url('manage/inventori'); ?>">
              <i class="fa <?php echo ($this->uri->segment(2) == 'inventori') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> 
              Inventori Gudang</a>
            </li>

            <li class="<?php echo ($this->uri->segment(8) == 'isatuan' 
              OR $this->uri->segment(2) == 'ijenis'
              OR $this->uri->segment(2) == 'iwarna'
              OR $this->uri->segment(2) == 'imerek'
              OR $this->uri->segment(2) == 'irasa'
              OR $this->uri->segment(2) == 'igudang'
              OR $this->uri->segment(2) == 'isupplier'
              ) 
              ? 'active' 
              : '' ?> treeview">
              <a href="javascript:;">
                <i class="fa fa-database"></i> <span>Master Data</span>
                <span class="pull-right-container">              
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>              
              <ul class="sidebar-submenu treeview-menu">
                <li class="<?php echo ($this->uri->segment(2) == 'isatuan') ? 'active' : '' ?>">
                  <a href="<?php echo site_url('manage/isatuan'); ?>">
                  <i class="fa <?php echo ($this->uri->segment(2) == 'isatuan') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> 
                  Item Unit</a>
                </li>
                <li class="<?php echo ($this->uri->segment(2) == 'ijenis') ? 'active' : '' ?>">
                  <a href="<?php echo site_url('manage/ijenis'); ?>">
                  <i class="fa <?php echo ($this->uri->segment(2) == 'ijenis') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i>  
                  Jenis</a>
                </li>
                <li class="<?php echo ($this->uri->segment(2) == 'iwarna') ? 'active' : '' ?>">
                  <a href="<?php echo site_url('manage/iwarna'); ?>">
                  <i class="fa <?php echo ($this->uri->segment(2) == 'iwarna') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i>  
                  Warna</a>
                </li>
                <li class="<?php echo ($this->uri->segment(2) == 'imerek') ? 'active' : '' ?>">
                  <a href="<?php echo site_url('manage/imerek'); ?>">
                  <i class="fa <?php echo ($this->uri->segment(2) == 'imerek') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i>  
                  Merek</a>
                </li>
                <li class="<?php echo ($this->uri->segment(2) == 'irasa') ? 'active' : '' ?>">
                  <a href="<?php echo site_url('manage/irasa'); ?>">
                  <i class="fa <?php echo ($this->uri->segment(2) == 'irasa') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i>  
                  Rasa</a>
                </li>
                <li class="<?php echo ($this->uri->segment(2) == 'igudang') ? 'active' : '' ?>">
                  <a href="<?php echo site_url('manage/igudang'); ?>">
                  <i class="fa <?php echo ($this->uri->segment(2) == 'igudang') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> 
                  Warehouse</a>
                </li>
                <li class="<?php echo ($this->uri->segment(2) == 'isupplier') ? 'active' : '' ?>">
                  <a href="<?php echo site_url('manage/isupplier'); ?>">                        
                  <i class="fa <?php echo ($this->uri->segment(2) == 'isupplier') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> 
                  Data Suplier</span>
                  </a>
                </li>
              </ul>
            </li>
            <li class="<?php echo ($this->uri->segment(2) == 'inventoriin') ? 'active' : '' ?>">
              <a href="<?php echo site_url('manage/inventoriin'); ?>">
                  <i class="fa <?php echo ($this->uri->segment(2) == 'inventoriin') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> 
                  Gudang Masuk</a>
            </li>
            <li class="<?php echo ($this->uri->segment(2) == 'inventoriout') ? 'active' : '' ?>">
              <a href="<?php echo site_url('manage/inventoriout'); ?>">
                  <i class="fa <?php echo ($this->uri->segment(2) == 'inventoriout') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> 
                  Gudang Keluar</a>
            </li>
            <li class="<?php echo ($this->uri->segment(2) == 'ilaporan') ? 'active' : '' ?>">
              <a href="<?php echo site_url('manage/ilaporan'); ?>">
                  <i class="fa <?php echo ($this->uri->segment(2) == 'ilaporan') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> 
                  Print Laporan</a>
            </li>
            <li class="<?php echo ($this->uri->segment(2) == 'ikartu') ? 'active' : '' ?>">
              <a href="<?php echo site_url('manage/ikartu'); ?>">
                  <i class="fa <?php echo ($this->uri->segment(2) == 'ikartu') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> 
                  Kartu Kendali</a>
            </li>
          </ul>
        </li>
        <?php } ?>

        <?php if ($this->session->userdata('uroleid') == SUPERUSER) { ?>
        <!-- PENGATURAN-->
        <li class="<?php echo (
            $this->uri->segment(2) == 'setting' OR 
            $this->uri->segment(2) == 'users' OR 
            $this->uri->segment(2) == 'information' OR 
            $this->uri->segment(2) == 'maintenance' OR 
            $this->uri->segment(2) == 'month') ? 'active' : '' ?> treeview">
          <a href="#">
            <i class="fa fa-gear text-stock"></i> <span>Pengaturan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="sidebar-submenu treeview-menu">
            <li class="<?php echo ($this->uri->segment(2) == 'setting') ? 'active' : '' ?>">
              <a href="<?php echo site_url('manage/setting') ?>"><i class="fa  <?php echo ($this->uri->segment(2) == 'setting') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> Sekolah</a>
            </li>
            <li class="<?php echo ($this->uri->segment(2) == 'month') ? 'active' : '' ?> ">
              <a href="<?php echo site_url('manage/month') ?>"><i class="fa  <?php echo ($this->uri->segment(2) == 'month') ? 'fa-dot-circle-o' : 'fa-circle-o' ?>"></i> Bulan</a>
            </li>

            <!-- INFORMASI-->
            <li class="<?php echo ($this->uri->segment(2) == 'information') ? 'active' : '' ?>">
              <a href="<?php echo site_url('manage/information'); ?>">
                <i class="fa fa-bullhorn"></i> <span>Informasi</span>
                <span class="pull-right-container"></span>
              </a>
            </li>

            <li class="<?php echo ($this->uri->segment(2) == 'users') ? 'active' : '' ?>">
              <a href="<?php echo site_url('manage/users'); ?>">
                <i class="fa fa-user"></i> <span>Manajemen Pengguna</span>
                <span class="pull-right-container"></span>
              </a>
            </li>

            <li class="<?php echo ($this->uri->segment(2) == 'users') ? 'active' : '' ?>">
              <a href="<?php echo site_url('manage/users/role'); ?>">
                <i class="fa fa-user"></i> <span>Role Pengguna</span>
                <span class="pull-right-container"></span>
              </a>
            </li>
          
            <li class="<?php echo ($this->uri->segment(2) == 'maintenance') ? 'active' : '' ?>">
              <a href="<?php echo site_url('manage/maintenance'); ?>">
                <i class="fa fa-database"></i> <span>Backup Data</span>
                <span class="pull-right-container"></span>
              </a>
            </li>
          </ul>
        </li>


      <?php } ?>
    </ul>

</div>
