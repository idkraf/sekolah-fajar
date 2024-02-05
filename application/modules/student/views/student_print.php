<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<head>
  <meta http-equiv="Content-Style-Type" content="text/css" /> 
  <title><?php echo $student['student_full_name'] ?></title>

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
    <h4 class="title">RIWAYAT SISWA</h4>
    <h5 class="detail">I. BIODATA SISWA</h5>		
	<div class="container">
		<div class="topright">
        <?php if (!empty($student['student_img'])) { ?>
        <img src="<?php echo upload_url('student/'.$student['student_img']) ?>" class="img-responsive avatar">
        <?php } else { ?>
        <img src="<?php echo media_url('img/user.png') ?>" class="img-responsive avatar">
        <?php } ?>

    </div>
	</div>
    <div id="tableborders" style="display:block;overflow:auto;">

        <table class="table1">
            <tbody>
              <tr>
                <td>No Siswa</td>
                <td>:</td>
                <td><?php echo $student['student_no'] ?></td>
              </tr>
              <tr>
                <td>Nik</td>
                <td>:</td>
                <td><?php echo $student['student_nik'] ?></td>
              </tr>
              <tr>
                <td>Nama Panggilan</td>
                <td>:</td>
                <td><?php echo $student['student_nama_panggilan'] ?></td>
              </tr>
              <tr>
                <td>Nama lengkap</td>
                <td>:</td>
                <td><?php echo $student['student_full_name'] ?></td>
              </tr>
              <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td><?php echo ($student['student_gender']=='L')? 'Laki-laki' : 'Perempuan' ?></td>
              </tr>
              <tr>
                <td>Tempat, Tanggal Lahir</td>
                <td>:</td>
                <td><?php echo $student['student_born_place'].', '. pretty_date($student['student_born_date'],'d F Y',false) ?></td>
              </tr>
              <tr>
                <td>Hobi</td>
                <td>:</td>
                <td><?php echo $student['student_hobby'] ?></td>
              </tr>
              <tr>
                <td>No. Handphone</td>
                <td>:</td>
                <td><?php echo $student['student_phone'] ?></td>
              </tr>
              <tr>
                <td>Email</td>
                <td>:</td>
                <td><?php echo $student['student_email'] ?></td>
              </tr>
              <tr>
                <td>Agama</td>
                <td>:</td>
                <td><?php echo $student['student_agama'] ?></td>
              </tr>
              <tr>
                <td>Ajaran Agama</td>
                <td>:</td>
                <td><?php echo $student['student_pelajaran_agama'] ?></td>
              </tr>
            </tbody>
        </table>
    </div>
    <br>
    <h5 class="detail">II. DATA SEKOLAH</h5>

      <table class="table1">
        <tbody>
          <tr>
            <td>Virtual Bank Siswa </td>
                <td>:</td>
            <td><?php echo $student['student_nomor_virtual_bank'] ?></td>
          </tr>
          <tr>
            <td>NIS </td>
                <td>:</td>
            <td><?php echo $student['student_nis'] ?></td>
          </tr> 

          <tr>
            <td>NISN</td>
                <td>:</td>
            <td><?php echo $student['student_nisn'] ?></td>
          </tr>
          <tr>
            <td>Unit Sekolah </td>
                <td>:</td>
            <td><?php echo $student['majors_name'] ?></td>
          </tr>
          <tr>
            <td>Kelas </td>
                <td>:</td>
            <td><?php echo $student['class_name'] ?></td>
          </tr>
          <tr>
            <td>Tingkatan </td>
                <td>:</td>
            <td><?php echo $student['student_tingkatan'] ?></td>
          </tr>
          <tr>
            <td>Jurusan </td>
            <td>:</td>
            <td><?php echo $student['student_jurusan'] ?></td>
          </tr>
        </tbody>
      </table>
    <br>
    <h5 class="detail">III. DATA AYAH</h5>    
      <table class="table1">
        <tbody>
          <tr>
            <td>Nama</td>
                <td>:</td>
            <td><?php echo $student['student_name_of_father'] ?></td>
          </tr>
          <tr>
            <td>Telp </td>
                <td>:</td>
            <td><?php echo $student['student_telp_ayah'] ?></td>
          </tr>
          <tr>
            <td>Email </td>
                <td>:</td>
            <td><?php echo $student['student_email_ayah'] ?></td>
          </tr>
          <tr>
            <td>Agama </td>
                <td>:</td>
            <td><?php echo $student['student_agama_ayah'] ?></td>
          </tr>
          <tr class="form-group">
            <td>Kewarganegaraan </td>
                <td>:</td>
            <td><?php echo $student['student_kewarganegaraan_ayah'] ?></td>
          </tr>
          <tr class="form-group">
            <td>Tempat Lahir </td>
                <td>:</td>
            <td><?php echo $student['student_tempat_lahir_ayah'] ?></td>
          </tr>
          <tr class="form-group">
            <td>Tanggal Lahir </td>
                <td>:</td>
            <td><?php echo $student['student_tanggal_lahir_ayah'] ?></td>
          </tr>
          <tr class="form-group">
            <td>Pekerjaan </td>
                <td>:</td>
            <td><?php echo $student['student_pekerjaan_ayah'] ?></td>
          </tr>
          <tr class="form-group">
            <td>Pendidikan Terakhir </td>
                <td>:</td>
            <td><?php echo $student['student_pendidikan_terakhir_ayah'] ?></td>
          </tr>
          <tr class="form-group">
            <td>Alamat</td>
                <td>:</td>
            <td><?php echo $student['student_alamat_ayah'] ?></td>
          </tr>
        </tbody>
      </table>

	  <br>
  <h5 class="detail">IV. DATA IBU</h5>  
  <table class="table1">
        <tbody>
          <tr>
            <td>Nama</td>
                <td>:</td>
            <td><?php echo $student['student_name_of_mother'] ?></td>
          </tr>
          <tr>
            <td>Telp </td>
                <td>:</td>
            <td><?php echo $student['student_telp_ibu'] ?></td>
          </tr>
          <tr>
            <td>Email </td>
                <td>:</td>
            <td><?php echo $student['student_email_ibu'] ?></td>
          </tr>
          <tr>
            <td>Agama </td>
                <td>:</td>
            <td><?php echo $student['student_agama_ibu'] ?></td>
          </tr>
          <tr class="form-group">
            <td>Kewarganegaraan </td>
                <td>:</td>
            <td><?php echo $student['student_kewarganegaraan_ibu'] ?></td>
          </tr>
          <tr class="form-group">
            <td>Tempat Lahir </td>
                <td>:</td>
            <td><?php echo $student['student_tempat_lahir_ibu'] ?></td>
          </tr>
          <tr class="form-group">
            <td>Tanggal Lahir </td>
                <td>:</td>
            <td><?php echo $student['student_tanggal_lahir_ibu'] ?></td>
          </tr>
          <tr class="form-group">
            <td>Pekerjaan </td>
                <td>:</td>
            <td><?php echo $student['student_pekerjaan_ibu'] ?></td>
          </tr>
          <tr class="form-group">
            <td>Pendidikan Terakhir </td>
                <td>:</td>
            <td><?php echo $student['student_pendidikan_terakhir_ibu'] ?></td>
          </tr>
          <tr class="form-group">
            <td>Alamat</td>
                <td>:</td>
            <td><?php echo $student['student_alamat_ibu'] ?></td>
          </tr>
        </tbody>
      </table>
	<br>
    <h5 class="detail">V. DATA WALI</h5>    
    <table>
      <tbody>
              <tr class="form-group">
								<td>Nama Wali</td>
                <td>:</td>
								<td><?php echo $student['student_nama_wali'] ?></td>
							</tr>
							<tr class="form-group">
								<td>No. Handphone Wali</td>
                <td>:</td>
								<td><?php echo $student['student_telp_wali'] ?></td>
							</tr>
							<tr class="form-group">
								<td>Alamat Wali</td>
                <td>:</td>
								<td><?php echo $student['student_alamat_wali'] ?></td>
							</tr>
							<tr class="form-group">
								<td>Email Wali</td>
                <td>:</td>
								<td><?php echo $student['student_email_wali'] ?></td>
							</tr>
							<tr class="form-group">
								<td>Pekerjaan Wali</td>
                <td>:</td>
								<td><?php echo $student['student_pekerjaan_wali'] ?></td>
							</tr>
      </tbody>
    </table>
	<br>				
    <h5 class="detail">VI. DATA ALAMAT</h5>    
    <table>
      <tbody>
              <tr class="form-group">
								<td>Alamat</td>
                <td>:</td>
								<td><?php echo $student['student_address'] ?></td>
							</tr>
							<tr class="form-group">
								<td>Kewarganegaraan</td>
                <td>:</td>
								<td><?php echo $student['student_kewarganegaraan'] ?></td>
							</tr>
							<tr class="form-group">
								<td>Kelurahan</td>
                <td>:</td>
								<td><?php echo $student['student_kelurahan'] ?></td>
							</tr>
							<tr class="form-group">
								<td>Kecamatan</td>
                <td>:</td>
								<td><?php echo $student['student_kecamatan'] ?></td>
							</tr>
							<tr class="form-group">
								<td>Provinsi</td>
                <td>:</td>
								<td><?php echo $student['student_provinsi'] ?></td>
							</tr>

      </tbody>
    </table>
	<br>			
    <h5 class="detail">VII. DATA KESEHATAN DAN FISIK</h5>    
    <table>
      <tbody>

                  <tr class="form-group">
										<td>Bahasa Dalam Rumah </td>
                <td>:</td>
										<td><?php echo $student['student_bahasa_rumah'] ?></td>
									</tr>
									<tr class="form-group">
										<td>Anak Ke </td>
                <td>:</td>
										<td><?php echo $student['student_anak_ke'] ?></td>
									</tr>
									<tr class="form-group">
										<td>Jumlah Saudara </td>
                <td>:</td>
										<td><?php echo $student['student_jumlah_saudara'] ?></td>
									</tr>
									<tr class="form-group">
										<td>Status Dalam Keluarga</td>
                <td>:</td>
										<td><?php echo $student['student_status_dalam_keluarga'] ?></td>
									</tr>

									<tr class="form-group">
										<td>Berat </td>
                <td>:</td>
										<td><?php echo $student['student_berat'] ?></td>
									</tr>
									<tr class="form-group">
										<td>Tinggi </td>
                <td>:</td>
										<td><?php echo $student['student_tinggi'] ?></td>
									</tr>
									<tr class="form-group">
										<td>Golongan Darah </td>
                <td>:</td>
										<td><?php echo $student['student_golongan_darah'] ?></td>
									</tr>
									<tr class="form-group">
										<td>Imunisasi </td>
                <td>:</td>
										<td><?php echo $student['student_imunisasi'] ?></td>
									</tr>
									<tr class="form-group">
										<td>Penyakit Yang Pernah diderita </td>
                <td>:</td>
										<td><?php echo $student['student_penyakit_yang_pernah_diderita'] ?></td>
									</tr>
									<tr class="form-group">
										<td>Alergi Makanan </td>
                <td>:</td>
										<td><?php echo $student['student_alergi_makanan'] ?></td>
									</tr>
      </tbody>
    </table>
	<br>			
    <h5 class="detail">VIII. DATA PINDAH</h5>    
    <table>
      <tbody>
        <tr class="form-group">
          <td>Sekolah Asal</td>
          <td>:</td>
          <td><?php echo $student['student_sekolah_asal'] ?></td>
        </tr>
        <tr class="form-group">
          <td>Tanggal Masuk</td>
          <td>:</td>
          <td><?php echo $student['student_tanggal_masuk'] ?></td>
        </tr>
        <tr class="form-group">
          <td>Tanggal Keluar </td>
          <td>:</td>
          <td><?php echo $student['student_tanggal_keluar'] ?></td>
        </tr>
        <tr class="form-group">
          <td>Pindah Ke Sekolah</td>
          <td>:</td>
          <td><?php echo $student['student_pindah_ke_sekolah'] ?></td>
        </tr>
        <tr class="form-group">
          <td>Alasan Pindah</td>
          <td>:</td>
          <td><?php echo $student['student_alasan_pindah'] ?></td>
        </tr>
        <tr class="form-group">
          <td>Alumni</td>
          <td>:</td>
          <td><?php echo $student['student_alumni'] ?></td>
        </tr>
      </tbody>
    </table>
	<br>			

</body>
</html>