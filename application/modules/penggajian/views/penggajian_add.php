<?php


if (isset($gajipokok)) {

	$inputGajiPokokValue = $gajipokok['gaji_pokok'];
	$inputTFValue = $gajipokok['tunjangan_fungsional'];
	$inputTSValue = $gajipokok['tunjangan_struktural'];
	$inputTKEValue = $gajipokok['tunjangan_kesra'];
	$inputTKHValue = $gajipokok['tunjangan_khusus'];
	$inputTPValue = $gajipokok['tunjangan_prestasi'];
	$inputPoinValue = $gajipokok['poin'];

	
	$inputTJValue = $gajipokok['tunjangan_jabatan'];
	$inputTPRValue = $gajipokok['tunjangan_profesi'];
	$inputTTValue = $gajipokok['tunjangan_transport'];
	$inputUAValue = $gajipokok['uang_makan'];
	$inputTUValue = $gajipokok['tunjangan_umum'];
	$inputTGTValue = $gajipokok['tunjangan_guru_tetap'];

	} else {
	$inputGajiPokokValue =  0;//set_value('gaji_pokok');
	$inputTFValue =  0;//set_value('tunjangan_fungsional');
	$inputTSValue =  0;//set_value('tunjangan_struktural');
	$inputTKEValue =  0;//set_value('tunjangan_kesra');
	$inputTKHValue =  0;//set_value('tunjangan_khusus');
	$inputTPValue =  0;//set_value('tunjangan_prestasi');
	$inputPoinValue =  0;//set_value('poin');
	
	$inputTJValue = 0;//$gajipokok['tunjangan_jabatan'];
	$inputTPRValue = 0;//$gajipokok['tunjangan_profesi'];
	$inputTTValue = 0;//$gajipokok['tunjangan_transport'];
	$inputUAValue = 0;//$gajipokok['uang_makan'];
	$inputTUValue = 0;//$gajipokok['tunjangan_umum'];
	$inputTGTValue = 0;//$gajipokok['tunjangan_guru_tetap'];
}


if (isset($potongan)) {

	$inputPinjamanBankValue = $potongan['pinjaman_bank'];
	$inputOrganisasiValue = $potongan['organisasi'];
	$inputKoperasiValue = $potongan['koperasi'];
	$inputProgramBahasaValue = $potongan['program_bahasa'];
	$inputMajalahValue = $potongan['majalah'];
	$inputAdmValue = $potongan['adm_bank'];
	$inputInfaqValue = $potongan['infaq_dakwah'];
	$inputBpjsValue = $potongan['bpjs'];
	$inputTelemarketValue = $potongan['telemarket'];
	$inputLainnyaValue = $potongan['lainnya'];

	$inputAbsensiValue = $potongan['absensi'];
	$inputIuranJhtValue = $potongan['iuran_jht'];
	$inputJaminanPensiunValue = $potongan['jaminan_pensiun'];

} else {
	$inputPinjamanBankValue = 0;//set_value('pinjaman_bank');
	$inputOrganisasiValue =  0;//set_value('organisasi');
	$inputKoperasiValue =  0;//set_value('koperasi');
	$inputProgramBahasaValue =  0;//set_value('program_bahasa');
	$inputMajalahValue =  0;//set_value('majalah');
	$inputAdmValue =  0;//set_value('adm_bank');
	$inputInfaqValue =  0;//set_value('infaq_dakwah');
	$inputBpjsValue =  0;//set_value('bpjs');
	$inputTelemarketValue =  0;//set_value('telemarket');
	$inputLainnyaValue =  0;//set_value('lainnya');
	
	$inputAbsensiValue = 0;//$potongan['absensi'];
	$inputIuranJhtValue = 0;//$potongan['iuran_jht'];
	$inputJaminanPensiunValue = 0;//$potongan['jaminan_pensiun'];

}
?>

<div class="content-wrapper">
<section class="content">
    <div class="row">
        <div class="col-md-9">
            <div class="card">
            <table class="table">
                    <tbody><tr>
                        <td width="200">Unit</td>
                        <td width="4">:</td>
                        <td><?php echo $pegawai['majors_name'] ?></td>
                    </tr>
                    <tr>
                        <td>NIP</td>
                        <td>:</td>
                        <td><?php echo $pegawai['employee_nip'] ?></td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><?php echo $pegawai['employee_name'] ?></td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td>:</td>
                        <td><?php echo $pegawai['position_name'] ?></td>
                    </tr>
                </tbody></table>
            </div>
        </div>
    </div>
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-md-9">
                <div class="card">
					<!-- /.box-header -->
					<div class="card-body">
					    		    
					    <div class="form-group">
    					    <div class="row">
    					    <div class="col-md-3">
    						<label>Akun Gaji<small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
    						</div>
    					    <div class="col-md-1"><label> = </label></div>
    					    <div class="col-md-4">
								<select required="" name="gaji_account_id" class="form-control">
									<option value="">-Pilih Kode Akun-</option>
									<option value="88">5-50105 - Biaya Biaya Gaji Guru TK TK</option>
									<option value="40">5-50201 - Biaya Gaji SMP</option>
									<option value="65">5-50301 - Biaya Gaji SD</option>
									<option value="66" selected="">5-50401 - Biaya Gaji SMA</option>
								</select>
    					    </div>
    					    <div class="col-md-1">
    					    </div>
    					    </div>
    					</div>
    					
					    <div class="nav-tabs-custom">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Gaji Pokok</a></li>
								<li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Potongan</a></li>
								<li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Absensi</a></li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane active" id="tab_1">										
									<?php echo form_open_multipart('manage/penggajian/add'); ?>
									<?php echo validation_errors(); ?>									
										<input type="hidden" name="employee_id" value="<?php echo $pegawai['employee_id'] ?>">
										<?php if (isset($gajipokok)) { ?>
											<input type="hidden" name="gaji_id" value="<?php echo $gajipokok['gaji_id']; ?>">
										<?php } ?>
										<div class="form-group">
											<div class="row">
											<div class="col-md-3">
												<label>Gaji Pokok <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
											</div>
											<div class="col-md-1"><label> = </label></div>
											<div class="col-md-3">
												<input name="gaji_pokok" type="text" class="form-control" value="<?php echo $inputGajiPokokValue ?>" required="">
											</div>
											</div>
										</div>
					
										<div class="form-group" hidden>
											<div class="row">
											<div class="col-md-3">
											<label>Tunjangan Fungsional <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
											</div>
											<div class="col-md-1"><label> = </label></div>
											<div class="col-md-3">
											<input name="tunjangan_fungsional" type="text" class="form-control" value="<?php echo $inputTFValue ?>" required="">
											</div>
											</div>
										</div>
					
										<div class="form-group" hidden>
											<div class="row">
											<div class="col-md-3">
											<label>Tunjangan Struktural <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
											</div>
											<div class="col-md-1"><label> = </label></div>
											<div class="col-md-3">
											<input name="tunjangan_struktural" type="text" class="form-control" value="<?php echo $inputTSValue ?>" required="">
											</div>
											</div>
										</div>
					
										<div class="form-group" hidden>
											<div class="row">
											<div class="col-md-3">
											<label>Tunjangan Kesra <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
											</div>
											<div class="col-md-1"><label> = </label></div>
											<div class="col-md-3">
											<input name="tunjangan_kesra" type="text" class="form-control" value="<?php echo $inputTKEValue ?>" required="">
											</div>
											</div>
										</div>
					
										<div class="form-group" hidden>
											<div class="row">
											<div class="col-md-3">
											<label>Tunjangan Khusus <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
											</div>
											<div class="col-md-1"><label> = </label></div>
											<div class="col-md-3">
											<input name="tunjangan_khusus" type="text" class="form-control" value="<?php echo $inputTKHValue ?>" required="">
											</div>
											</div>
										</div>
					
										<div class="form-group" hidden>
											<div class="row">
											<div class="col-md-3">
											<label>Tunjangan Prestasi <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
											</div>
											<div class="col-md-1"><label> = </label></div>
											<div class="col-md-3">
											<input name="tunjangan_prestasi" type="text" class="form-control" value="<?php echo $inputTPValue ?>" required="">
											</div>
											</div>
										</div>
					
										<div class="form-group" hidden>
											<div class="row">
											<div class="col-md-3">
											<label>Tambahan / Poin <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
											</div>
											<div class="col-md-1"><label> = </label></div>
											<div class="col-md-3">
											<input name="poin" type="text" class="form-control" value="<?php echo $inputPoinValue ?>" required="">
											</div>
											</div>
										</div>
												
										<div class="form-group">
											<div class="row">
											<div class="col-md-3">
											<label>Tunjangan Jabatan <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
											</div>
											<div class="col-md-1"><label> = </label></div>
											<div class="col-md-3">
											<input name="tunjangan_jabatan" type="text" class="form-control" value="<?php echo $inputTJValue ?>" required="">
											</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
											<div class="col-md-3">
											<label>Tunjangan Profesi <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
											</div>
											<div class="col-md-1"><label> = </label></div>
											<div class="col-md-3">
											<input name="tunjangan_profesi" type="text" class="form-control" value="<?php echo $inputTPRValue ?>" required="">
											</div>
											</div>
										</div>
										
										<div class="form-group">
											<div class="row">
											<div class="col-md-3">
											<label>Tunjangan transport <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
											</div>
											<div class="col-md-1"><label> = </label></div>
											<div class="col-md-3">
											<input name="tunjangan_transport" type="text" class="form-control" value="<?php echo $inputTTValue ?>" required="">
											</div>
											</div>
										</div>
										
										<div class="form-group">
											<div class="row">
											<div class="col-md-3">
											<label>Uang Makan <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
											</div>
											<div class="col-md-1"><label> = </label></div>
											<div class="col-md-3">
											<input name="uang_makan" type="text" class="form-control" value="<?php echo $inputUAValue ?>" required="">
											</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
											<div class="col-md-3">
											<label>Tunjangan Umum <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
											</div>
											<div class="col-md-1"><label> = </label></div>
											<div class="col-md-3">
											<input name="tunjangan_umum" type="text" class="form-control" value="<?php echo $inputTUValue ?>" required="">
											</div>
											</div>
										</div>
										
										<div class="form-group">
											<div class="row">
											<div class="col-md-3">
											<label>Tunjangan Guru Tetap <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
											</div>
											<div class="col-md-1"><label> = </label></div>
											<div class="col-md-3">
											<input name="tunjangan_guru_tetap" type="text" class="form-control" value="<?php echo $inputTGTValue ?>" required="">
											</div>
											</div>
										</div>
										<p class="text-muted">*) Kolom wajib diisi.</p>
										<button type="submit" class="btn btn-md btn-success">Simpan</button>
										
    								
									<?= form_close(); ?>
								</div>
								
								<div class="tab-pane" id="tab_2">								    
									<?php echo form_open_multipart('manage/penggajian/add_potongan'); ?>
										<?php echo validation_errors(); ?>
										<input type="hidden" name="employee_id" value="<?php echo $pegawai['employee_id'] ?>">
										<?php if (isset($potongan)) { ?>
											<input type="hidden" name="potongan_id" value="<?php echo $potongan['potongan_id']; ?>">
										<?php } ?>

										<div class="form-group" hidden>
											<div class="row">
											<div class="col-md-3">
											<label>Pinjaman Bank <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
											</div>
											<div class="col-md-1"><label> = </label></div>
											<div class="col-md-3">
											<input name="pinjaman_bank" type="text" class="form-control" value="<?php echo $inputPinjamanBankValue ?>" required="" placeholder="Pinjaman Bank">
											</div>
											</div>
										</div>
					
										<div class="form-group" hidden>
											<div class="row">
											<div class="col-md-3">
											<label>Organisasi <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
											</div>
											<div class="col-md-1"><label> = </label></div>
											<div class="col-md-3">
											<input name="organisasi" type="text" class="form-control" value="<?php echo $inputOrganisasiValue ?>" required="" placeholder="Organisasi">
											</div>
											</div>
										</div>
										
										<div class="form-group" hidden>
											<div class="row">
											<div class="col-md-3">
											<label>Koperasi <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
											</div>
											<div class="col-md-1"><label> = </label></div>
											<div class="col-md-3">
											<input name="koperasi" type="text" class="form-control" value="<?php echo $inputKoperasiValue ?>" required="" placeholder="Koperasi">
											</div>
											</div>
										</div>
					
										<div class="form-group" hidden>
											<div class="row">
											<div class="col-md-3">
											<label>Program Bahasa <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
											</div>
											<div class="col-md-1"><label> = </label></div>
											<div class="col-md-3">
											<input name="program_bahasa" type="text" class="form-control" value="<?php echo $inputProgramBahasaValue ?>" required="" placeholder="Program Bahasa">
											</div>
											</div>
										</div>
					
										<div class="form-group" hidden>
											<div class="row">
											<div class="col-md-3">
											<label>Majalah <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
											</div>
											<div class="col-md-1"><label> = </label></div>
											<div class="col-md-3">
											<input name="majalah" type="text" class="form-control" value="<?php echo $inputMajalahValue ?>" required="" placeholder="Majalah">
											</div>
											</div>
										</div>
					
										<div class="form-group" hidden>
											<div class="row">
											<div class="col-md-3">
											<label>Administrasi Bank <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
											</div>
											<div class="col-md-1"><label> = </label></div>
											<div class="col-md-3">
											<input name="adm_bank" type="text" class="form-control" value="<?php echo $inputAdmValue ?>" required="" placeholder="Administrasi Bank">
											</div>
											</div>
										</div>
					
										<div class="form-group" hidden>
											<div class="row">
											<div class="col-md-3">
											<label>Infaq Ged. Dakwah<small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
											</div>
											<div class="col-md-1"><label> = </label></div>
											<div class="col-md-3">
											<input name="infaq_dakwah" type="text" class="form-control" value="<?php echo $inputInfaqValue ?>" required="" placeholder="Infaq">
											</div>
											</div>
										</div>
					
										<div class="form-group">
											<div class="row">
											<div class="col-md-3">
											<label>Absensi <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
											</div>
											<div class="col-md-1"><label> = </label></div>
											<div class="col-md-3">
											<input name="absensi" type="text" class="form-control" value="<?php echo $inputAbsensiValue ?>" required="" placeholder="BPJS">
											</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
											<div class="col-md-3">
											<label>BPJS Kesehatan<small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
											</div>
											<div class="col-md-1"><label> = </label></div>
											<div class="col-md-3">
											<input name="bpjs" type="text" class="form-control" value="<?php echo $inputBpjsValue ?>" required="" placeholder="BPJS">
											</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
											<div class="col-md-3">
											<label>Iuran JHT <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
											</div>
											<div class="col-md-1"><label> = </label></div>
											<div class="col-md-3">
											<input name="iuran_jht" type="text" class="form-control" value="<?php echo $inputIuranJhtValue ?>" required="" placeholder="BPJS">
											</div>
											</div>
										</div>
										
										<div class="form-group">
											<div class="row">
											<div class="col-md-3">
											<label>Jaminan Pensiun<small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
											</div>
											<div class="col-md-1"><label> = </label></div>
											<div class="col-md-3">
											<input name="jaminan_pensiun" type="text" class="form-control" value="<?php echo $inputJaminanPensiunValue ?>" required="" placeholder="BPJS">
											</div>
											</div>
										</div>
					
										<div class="form-group" hidden>
											<div class="row">
											<div class="col-md-3">
											<label>Telemarket <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
											</div>
											<div class="col-md-1"><label> = </label></div>
											<div class="col-md-3">
											<input name="telemarket" type="text" class="form-control" value="<?php echo $inputTelemarketValue ?>" required="" placeholder="Telemarket">
											</div>
											</div>
										</div>
					
										<div class="form-group" hidden>
											<div class="row">
											<div class="col-md-3">
											<label>Lain-lain <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
											</div>
											<div class="col-md-1"><label> = </label></div>
											<div class="col-md-3">
											<input name="lainnya" type="text" class="form-control" value="<?php echo $inputLainnyaValue ?>" required="" placeholder="Lain-lain">
											</div>
											</div>
										</div>
												
										<p class="text-muted">*) Kolom wajib diisi.</p>
										<button type="submit" class="btn btn-md btn-success">Simpan</button>
										
    								
									<?= form_close(); ?>
								</div>
								<div class="tab-pane" id="tab_3">
								<?php echo form_open_multipart('manage/penggajian/add_cutoff'); ?>
									<div class="form-group">
										<div class="row">
											<div class="col-md-3">
												<label>Hari Efektif <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
											</div>
											<div class="col-md-1"><label> = </label></div>
											<div class="col-md-8">
												<input name="hari_efektif" type="text" class="form-control" value="1 Agustus s/d 30 Agustus" required="" placeholder="Gaji Pokok">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-md-3">
												<label>Hari Masuk <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
											</div>
											<div class="col-md-1"><label> = </label></div>
											<div class="col-md-8">
												<input name="hari_masuk" type="text" class="form-control" value="1 Agustus s/d 30 Agustus" required="" placeholder="Gaji Pokok">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-md-3">
												<label>Lupa Absen Masuk <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
											</div>
											<div class="col-md-1"><label> = </label></div>
											<div class="col-md-8">
												<input name="lupa_absen_masuk" type="text" class="form-control" value="1 Agustus s/d 30 Agustus" required="" placeholder="Gaji Pokok">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-md-3">
												<label>Lupa Absen Pulang <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
											</div>
											<div class="col-md-1"><label> = </label></div>
											<div class="col-md-8">
												<input name="lupa_absen_pulang" type="text" class="form-control" value="1 Agustus s/d 30 Agustus" required="" placeholder="Gaji Pokok">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-md-3">
												<label>Sakit SKD <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
											</div>
											<div class="col-md-1"><label> = </label></div>
											<div class="col-md-8">
												<input name="sakit_skd" type="text" class="form-control" value="1 Agustus s/d 30 Agustus" required="" placeholder="Gaji Pokok">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-md-3">
												<label>Sakit Non SKD <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
											</div>
											<div class="col-md-1"><label> = </label></div>
											<div class="col-md-8">
												<input name="sakit_non_skd" type="text" class="form-control" value="1 Agustus s/d 30 Agustus" required="" placeholder="Gaji Pokok">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-md-3">
												<label>Izin <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
											</div>
											<div class="col-md-1"><label> = </label></div>
											<div class="col-md-8">
												<input name="izin" type="text" class="form-control" value="1 Agustus s/d 30 Agustus" required="" placeholder="Gaji Pokok">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-md-3">
												<label>Keterlambatan <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
											</div>
											<div class="col-md-1"><label> = </label></div>
											<div class="col-md-8">
												<input name="keterlambatan" type="text" class="form-control" value="1 Agustus s/d 30 Agustus" required="" placeholder="Gaji Pokok">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-md-3">
												<label>Tanpa Keterangan <small data-toggle="tooltip" title="" data-original-title="Wajib diisi">*</small></label>
											</div>
											<div class="col-md-1"><label> = </label></div>
											<div class="col-md-8">
												<input name="tanpa_keterangan" type="text" class="form-control" value="1 Agustus s/d 30 Agustus" required="" placeholder="Gaji Pokok">
											</div>
										</div>
									</div>
									
									<button type="submit" class="btn btn-md btn-success">Simpan</button>
										
									<?= form_close(); ?>
								</div>
							</div>
						</div>
					</div>
					<!-- /.box-body -->
				</div>
            </div>
        </div>
</section>


</div>