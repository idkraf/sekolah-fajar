<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<head>
  <meta http-equiv="Content-Style-Type" content="text/css" /> 
  <title><?php echo $pegawai['employee_name'] ?></title>

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
        border-collapse: collapse;
        text-align:left;
        font-size: 12px;
    }
    .text-right{
        position:absolute;
        float:right;
    }
    .container {
        position: relative;
    }

    .topright {
        position: absolute;
        top: 0;
        right: 0;
        font-size: 18px;
        border-width: thin;
        padding: 5px;
        height:100px;
    }
    .header {
        color: #fff; /* old IE */
        background-color: #333; /* Modern Browsers */
    }
    .detail{
        text-align: center;
	    border: 1px solid;
    }
</style>
</head>
<body>
    <h4 class="title">RIWAYAT HIDUP</h4>
    <h5 class="detail">I. BIODATA PEGAWAI</h5>		
	<div class="container">
		<div class="topright">
        <?php if (!empty($pegawai['employee_img'])) { ?>
                                    <img src="<?php echo upload_url('employee/'.$pegawai['employee_img']) ?>">
                                    <?php } else { ?>
                                    <img src="<?php echo media_url('img/user.png') ?>">
                                    <?php } ?>
        </div>
	</div>
    <div id="tableborders" style="display:block;overflow:auto;">

        <table class="table1">
            <tbody>
                <tr>
                    <td>No. Induk</td>
                    <td>:</td>
                    <td><?php echo $pegawai['employee_nip'] ?></td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td>:</td>
                    <td><?php echo $pegawai['employee_nik'] ?></td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><?php echo $pegawai['employee_name'] ?></td>
                </tr>
                <tr>
                    <td>Tempat, Tanggal Lahir</td>
                    <td>:</td>
                    <td><?php echo $pegawai['employee_born_place'].', '. pretty_date($pegawai['employee_born_date'],'d F Y',false) ?></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td><?php echo ($pegawai['employee_gender']=='L')? 'Laki-laki' : 'Perempuan' ?></td>
                </tr>
                <tr>
                    <td>Agama</td>
                    <td>:</td>
                    <td><?php echo $pegawai['employee_agama'] ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><?php echo $pegawai['employee_email'] ?></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td><?php echo $pegawai['employee_address'] ?></td>
                </tr>
                <tr>
                    <td>Kode Pos</td>
                    <td>:</td>
                    <td><?php echo $pegawai['employee_kodepos'] ?></td>
                </tr>
                <tr>
                    <td>No. Handphone</td>
                    <td>:</td>
                    <td><?php echo $pegawai['employee_phone'] ?></td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td><?php echo $pegawai['position_name'] ?></td>
                </tr>
                <tr>
                    <td>Golongan</td>
                    <td>:</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Pendidikan Terakhir</td>
                    <td>:</td>
                    <td><?php echo $pegawai['employee_asal_sekolah'] ?></td>
                </tr>
                <tr>
                    <td>BPJS Kesehatan</td>
                    <td>:</td>
                    <td><?php echo $pegawai['employee_bpjs_kesehatan'] ?></td>
                </tr>
                <tr>
                    <td>BPJS Tenagakerjaan</td>
                    <td>:</td>
                    <td><?php echo $pegawai['employee_bpjs_ketenagakerjaan'] ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <br>
    <h5 class="detail">II. DATA KELUARGA</h5>
    <table width="100%" class="table1 table-hover">
    <thead>
    <tr>
        <th style="width: 40px;">#</th>
        <th style="width: 140px;">Nama</th>
        <th style="width: 140px;">Hubungan</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
    </tr>
    </thead>
    <tbody>

    <?php
    if (!empty($data_keluarga)) {
        $i = 1;
        foreach ($data_keluarga as $row):
            ?>
    <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $row['fam_name']; ?></td>
        <td><?php echo $row['fam_desc']; ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>

    <?php
            $i++;
        endforeach;
    } else {
        ?>
        <tr id="row">
            <td colspan="8" align="center">Data Kosong</td>
        </tr>
        <?php } ?>
    </tbody>
    </table>
    <br>
    <h5 class="detail">III. RIWAYAT JABATAN</h5>
    <table width="100%" class="table1 table-hover">
        <thead>
            <tr>
                <th style="width: 40px;">#</th>
                <th style="width: 140px;">Tahun Mulai</th>
                <th style="width: 140px;">Tahun Selesai</th>
                <th>Keterangan</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if (!empty($riwayat_jabatan)) {
            $i = 1;
            foreach ($riwayat_jabatan as $row):
                ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $row['position_start']; ?></td>
            <td><?php echo $row['position_end']; ?></td>
            <td><?php echo $row['position_desc']; ?></td>
            <td>&nbsp;</td>
        </tr>

        <?php
                $i++;
            endforeach;
        } else {
            ?>
            <tr id="row">
                <td colspan="8" align="center">Data Kosong</td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
	<br>
    <h5 class="detail">IV. RIWAYAT MENGAJAR</h5>
    <table width="100%" class="table1 table-bordered table-hover">
        <thead>
            <tr>
                <th style="width: 40px;">#</th>
                <th style="width: 140px;">Tahun Mulai</th>
                <th style="width: 140px;">Tahun Selesai</th>
                <th>Mata Pelajaran</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if (!empty($riwayat_mengajar)) {
                $i = 1;
                foreach ($riwayat_mengajar as $row):
                    ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row['teaching_start']; ?></td>
                <td><?php echo $row['teaching_end']; ?></td>
                <td><?php echo $row['teaching_lesson']; ?></td>
                <td><?php echo $row['teaching_desc']; ?></td>
            </tr>
            
            <?php
                    $i++;
                endforeach;
            } else {
                ?>
                <tr id="row">
                    <td colspan="8" align="center">Data Kosong</td>
                </tr>
                <?php } ?>
        </tbody>
    </table>
	<br>
    <h5 class="detail">V. PENGHARGAAN</h5>
    <table width="100%" class="table1 table-bordered table-hover">
        <thead>
            <tr>
                <th style="width: 40px;">#</th>
                <th style="width: 140px;">Tahun</th>
                <th style="width: 140px;">Keterangan</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>							    
        <?php
        if (!empty($penghargaan)) {
                $i = 1;
                foreach ($penghargaan as $row):
                    ?>
        
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row['achievement_year']; ?></td>
                <td><?php echo $row['achievement_name']; ?></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            
        <?php
                    $i++;
                endforeach;
            } else {
                ?>
                <tr id="row">
                    <td colspan="8" align="center">Data Kosong</td>
                </tr>
                <?php } ?>
        </tbody>
    </table>
	<br>				

</body>
</html>