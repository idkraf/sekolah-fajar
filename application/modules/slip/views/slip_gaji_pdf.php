<html>
<head>  
<title>Cetak Slip Gaji - </title>  
<style type="text/css">
  .upper { text-transform: uppercase; }
  .lower { text-transform: lowercase; }
  .cap   { text-transform: capitalize; }
  .small { font-variant:   small-caps; }
</style>
<style type="text/css">
@page {
  margin-top: 1.5em;
  margin-bottom: 0.1em;
  margin-left: 5.0em;
  margin-right: 5.0em;
  } 
  .style12 {font-size: 10px}
  .style13 {
   font-size: 14pt;
   font-weight: bold;
 }
 html {
    -ms-text-size-adjust: 100%;
    -webkit-text-size-adjust: 100%;
}
 .title{
  font-size: 24pt;
  text-align: center;
  font-weight: bold;
  padding-bottom: -10px;
}
.tp{
  font-size: 12pt;
  text-align: center;
  font-weight: bold;
}
body {
  font-family: sans-serif;
}
table {
    display: table;
    border-collapse: separate;
    box-sizing: border-box;
    text-indent: initial;
    border-spacing: 2px;
    border-color: gray;
}
tbody {
    display: table-row-group;
    vertical-align: middle;
    border-color: inherit;
}
.table1, .table1 th, .table1 td {
    border: 1px solid #282A35;
    border-collapse: collapse;
    font-size: 12px;
}
.text-right{
  position:absolute;
  float:right;
}
.fieldset-auto-width {
   width: 40%;
   border: 1px solid;
   padding: 0;
   margin-bottom: 10px;
 }
 .header {
    color: #fff; /* old IE */
    background-color: #333; /* Modern Browsers */
  }
</style>
</head>
<body >
    <?php
    function terbilang($x) {
      $angka = ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"];
    
      if ($x < 12)
        return " " . $angka[$x];
      elseif ($x < 20)
        return terbilang($x - 10) . " belas";
      elseif ($x < 100)
        return terbilang($x / 10) . " puluh" . terbilang($x % 10);
      elseif ($x < 200)
        return "seratus" . terbilang($x - 100);
      elseif ($x < 1000)
        return terbilang($x / 100) . " ratus" . terbilang($x % 100);
      elseif ($x < 2000)
        return "seribu" . terbilang($x - 1000);
      elseif ($x < 1000000)
        return terbilang($x / 1000) . " ribu" . terbilang($x % 1000);
      elseif ($x < 1000000000)
        return terbilang($x / 1000000) . " juta" . terbilang($x % 1000000);
    }
    ?>
    <table width="100%" border="0" >
      <tr>
        <td>                        
          <?php if (!empty($setting_logo_yayasan['setting_value'])) { ?>
              <img src="<?php echo upload_url('school/'.$setting_logo_yayasan['setting_value']) ?>" style="height: 140px; width: 140px;">
              <?php } else { ?>
              <img src="<?php echo media_url('img/missing.png') ?>" style="height: 140px; width: 140px;">
          <?php } ?>
        </td>
        <td class="title">SLIP GAJI</td>      
        <td class="text-right">              
          <?php if (!empty($setting_logo['setting_value'])) { ?>
              <img src="<?php echo upload_url('school/'.$setting_logo['setting_value']) ?>" style="height: 140px; width: 140px; margin-left:200px;">
              <?php } else { ?>
              <img src="<?php echo media_url('img/missing.png') ?>" style="height: 140px; width: 140px; ">
          <?php } ?>
        </td>      
      </tr>
    </table>
    <hr noshade="noshade" align="center" style="border: 3px solid; border-color: #000; margin-top: 15px; margin-bottom:25px; text-align: center;">
    
    <table style="font-size: 10pt;" width="100%" border="0">
      <tr>
        <td style="width: 100px;">ID</td>
        <td style="width: 5px;">:</td>
        <td style="width: 150px;"><?php echo (isset($pegawai)) ? $pegawai['employee_id'] : '-' ?></td>
        <td style="width: 130px;">Jabatan</td>
        <td style="width: 5px;">:</td>
        <td style="width: 131px;"><?php echo (isset($pegawai)) ? $pegawai['position_name'] : '-' ?></td>
      </tr>
      <tr>
        <td style="width: 100px;">Nama</td>
        <td style="width: 5px;">:</td>
        <td style="width: 150px;"><?php echo (isset($pegawai)) ? $pegawai['employee_name'] : '-' ?></td>
        <td style="width: 130px;">Bulan</td>
        <td style="width: 5px;">:</td>
        <td style="width: 131px;"><?php echo (isset($slip)) ? $slip['month_name'] : '-' ?></td>
      </tr>
      <tr>
        <td style="width: 100px;">Unit</td>
        <td style="width: 5px;">:</td>
        <td style="width: 150px;"><?php echo (isset($pegawai)) ? $pegawai['majors_name'] : '-' ?></td>
        <td style="width: 130px;">Tanggal Cetak</td>
        <td style="width: 5px;">:</td>
        <td style="width: 131px;"><?php echo (isset($slip)) ? $slip['created_at'] : date('d-m-Y H:i') ?></td>
      </tr>
    </table>
    <hr noshade="noshade" align="center" style="border: 3px solid; border-color: #000; margin-top: 25px; margin-bottom:25px; text-align: center;">
    <div id="tableborders" style="display:block;overflow:auto;">
    <table width="100%" border="0">
      <tr>
        <td>
          <table class="table1" style="width:100%;">
            <tbody>
              <tr class="header">
                <th colspan="3">Cut Off Absensi</th>
              </tr>
              <tr class="header">
                <th colspan="3">
                <?php echo (isset($slip) && $slip['tanggal_cut_off'] != null) ? $slip['tanggal_cut_off'] : '- s/d -' ?>
                </th>
              </tr>
              <tr>
                <td>Hari Efektif</td>
                <td style="width: 5px;text-align:center">:</td>
                <td><?php echo (isset($slip) && $slip['hari_efektif'] != null) ? $slip['hari_efektif'] : '-' ?></td>
              </tr>
              <tr>
                <td>Hari Masuk</td>
                <td style="width: 5px;text-align:center">:</td>
                <td><?php echo (isset($slip) && $slip['hari_masuk'] != null) ? $slip['hari_masuk'] : '-' ?></td>
              </tr>
              <tr>
                <td>Lupa Absen Masuk</td>
                <td style="width: 5px;text-align:center">:</td>
                <td><?php echo (isset($slip) && $slip['lupa_absen_masuk'] != null) ? $slip['lupa_absen_masuk'] : '-' ?></td>
              </tr>
              <tr>
                <td>Lupa Absen Pulang</td>
                <td style="width: 5px;text-align:center">:</td>
                <td><?php echo (isset($slip) && $slip['lupa_absen_pulang'] != null) ? $slip['lupa_absen_pulang'] : '-' ?></td>
              </tr>
              <tr>
                <td>Sakit SKD</td>
                <td style="width: 5px;text-align:center">:</td>
                <td><?php echo (isset($slip) && $slip['sakit_skd'] != null) ? $slip['sakit_skd'] : '-' ?></td>
              </tr>
              <tr>
                <td>Sakit Non SKD</td>
                <td style="width: 5px;text-align:center">:</td>
                <td><?php echo (isset($slip) && $slip['sakit_non_skd'] != null) ? $slip['sakit_non_skd'] : '-' ?></td>
              </tr>
              <tr>
                <td>Izin</td>
                <td style="width: 5px;text-align:center">:</td>
                <td><?php echo (isset($slip) && $slip['izin'] != null) ? $slip['izin'] : '-' ?></td>
              </tr>
              <tr>
                <td>Keterlambatan</td>
                <td style="width: 5px;text-align:center">:</td>
                <td><?php echo (isset($slip) && $slip['keterlambatan'] != null) ? $slip['keterlambatan'] : '-' ?></td>
              </tr>
              <tr>
                <td>Tanpa Keterangan</td>
                <td style="width: 5px;text-align:center">:</td>
                <td><?php echo (isset($slip) && $slip['tanpa_keterangan'] != null) ? $slip['tanpa_keterangan'] : '-' ?></td>
              </tr>
            </tbody>
          </table>
        </td>
        <td>
          <table class="table1" style="width:95%;margin-left:5%;">
            <tbody>
              <tr class="header">
                <th colspan="2">DATA PENGHASILAN</th>
              </tr>
              <tr class="header">
                <th>Keterangan</th>
                <th>Jumlah</th>
              </tr>

              <?php if($slip['gaji_pokok'] != 0) { ?>
              <tr>
                <td>Gaji Pokok</td>
                <td><?php echo (isset($slip)) ? 'Rp. '.number_format($slip['gaji_pokok'],0,',','.') : '-' ?></td>
              </tr>
              <?php } ?>

              <?php if($slip['tunjangan_jabatan'] != 0) { ?>
              <tr>
                <td>Tunjangan Jabatan</td>
                <td><?php echo (isset($slip)) ? 'Rp. '.number_format($slip['tunjangan_jabatan'],0,',','.') : '-' ?></td>
              </tr>
              <?php } ?>

              <?php if($slip['tunjangan_profesi'] != 0) { ?>
              <tr>
                <td>Tunjangan Profesi</td>
                <td><?php echo (isset($slip)) ? 'Rp. '.number_format($slip['tunjangan_profesi'],0,',','.') : '-' ?></td>
              </tr>
              <?php } ?>

              <?php if($slip['tunjangan_transport'] != 0) { ?>
              <tr>
                <td>Tunjangan Transpot</td>
                <td><?php echo (isset($slip)) ? 'Rp. '.number_format($slip['tunjangan_transport'],0,',','.') : '-' ?></td>
              </tr>
              <?php } ?>

              <?php if($slip['uang_makan'] != 0) { ?>
              <tr>
                <td>Uang Makan</td>
                <td><?php echo (isset($slip)) ? 'Rp. '.number_format($slip['uang_makan'],0,',','.') : '-' ?></td>
              </tr>
              <?php } ?>

              <?php if($slip['tunjangan_umum'] != 0) { ?>
                <tr>
                  <td>Tunjangan Umum</td>
                  <td><?php echo (isset($slip)) ? 'Rp. '.number_format($slip['tunjangan_umum'],0,',','.') : '-' ?></td>
                </tr>
              <?php } ?>

              <?php if($slip['tunjangan_guru_tetap'] != 0) { ?>   
              <tr>
                <td>Tunjangan Guru Tetap</td>
                <td><?php echo (isset($slip)) ? 'Rp. '.number_format($slip['tunjangan_guru_tetap'],0,',','.') : '-' ?></td>
              </tr>
              <?php } ?>

              
              <?php if($slip['gaji_pokok'] == 0) { ?>                
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <?php } ?>

              <?php if($slip['tunjangan_jabatan'] == 0) { ?>                
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <?php } ?>

              <?php if($slip['tunjangan_profesi'] == 0) { ?>                
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <?php } ?>

              <?php if($slip['tunjangan_transport'] == 0) { ?>                
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <?php } ?>

              <?php if($slip['uang_makan'] == 0) { ?>                
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <?php } ?>

              <?php if($slip['tunjangan_umum'] == 0) { ?>                
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <?php } ?>
              
              <?php if($slip['tunjangan_guru_tetap'] == 0) { ?>                
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <?php } ?>

              <tr>                
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>                
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>

            </tbody>
          </table>
        </td>
        <td>
          <table class="table1" style="width:95%;margin-left:5%;">
            <tbody>
              <tr class="header">
                <th colspan="2">DATA POTONGAN</th>
              </tr>
              
              <tr class="header">
                <th>Keterangan</th>
                <th>Jumlah</th>
              </tr>

              <?php if($slip['absensi'] != 0) { ?>    
              <tr>
                <td>Absensi</td>
                <td><?php echo (isset($slip)) ? 'Rp. '.number_format($slip['absensi'],0,',','.') : '-' ?></td>
              </tr>
              <?php } ?>

              <?php if($slip['bpjs'] != 0) { ?>    
              <tr>
                <td>BPJS Kesehatan</td>
                <td><?php echo (isset($slip)) ? 'Rp. '.number_format($slip['bpjs'],0,',','.') : '-' ?></td>
              </tr>
              <?php } ?>

              <?php if($slip['iuran_jht'] != 0) { ?>    
              <tr>
                <td>Iuran JHT</td>
                <td><?php echo (isset($slip)) ? 'Rp. '.number_format($slip['iuran_jht'],0,',','.') : '-' ?></td>
              </tr>
              <?php } ?>

              <?php if($slip['jaminan_pensiun'] != 0) { ?>    
              <tr>
                <td>Jaminan Pensiun</td>
                <td><?php echo (isset($slip)) ? 'Rp. '.number_format($slip['jaminan_pensiun'],0,',','.') : '-' ?></td>
              </tr>
              <?php } ?>
              
              <?php if($slip['absensi'] == 0) { ?>    
              <tr> 
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <?php } ?>

              <?php if($slip['bpjs'] == 0) { ?>    
              <tr> 
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <?php } ?>

              <?php if($slip['iuran_jht'] == 0) { ?>    
              <tr> 
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <?php } ?>

              <?php if($slip['jaminan_pensiun'] == 0) { ?>    
              <tr> 
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <?php } ?>
              <tr>                
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>           
              <tr>                
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>           
              <tr>                
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>           
              <tr>                
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>           
              <tr>                
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </tbody>
          </table>
        </td>    
      </tr>
    </table>
    </div>
    <br>
    <table class="table1" style="width:40%;">
      <tbody>
        <tr class="header">
          <th colspan="3">TOTAL GAJI YANG DITERIMA</th>
        </tr>
        <tr>
          <td>Jumlah</td>
          <td style="width: 5px;text-align:center">:</td>
          <td><?php echo (isset($slip)) ? 'Rp. '.number_format($slip['jumlah_gaji'],0,',','.') : '-' ?></td>
        </tr>
        <tr>
          <td>Terbilang</td>
          <td style="width: 5px;text-align:center">:</td>
          <td><?php echo ucwords(terbilang($slip['jumlah_gaji'])) ?></td>
        </tr>
      </tbody>
    </table>
    <br>
    <table style="font-size: 10pt;" width="100%" border="0">
      <tbody>
        <tr>
          <td>*) Keterangan Pajak PPh 21 ditanggung Yayasan</td>
        </tr>
        <tr>
          <td>Slip gaji ini tidak membutuhkan tanda tangan, untuk konfirmasi silahkan hubungi 085751057608</td>
        </tr>
      </tbody>
    </table>
    
  </body>
  </html>