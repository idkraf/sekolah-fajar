<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo isset($title) ? '' . $title : null; ?>
			<small>List</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('manage') ?>"><i class="fa fa-th"></i> Home</a></li>
			<li class="active"><?php echo isset($title) ? '' . $title : null; ?></li>
		</ol>
	</section>
	<section class="content">
    <?php $id_barang = $this->input->get('id_barang'); ?>
    <div class="row">
      <div class="col-xs-12">
        <div class="box shadow-sm border-bottom-primary">
          <div class="box-header bg-white py-3">
            <h4 class="h5 align-middle m-0 font-weight-bold text-dark">Pilih Barang</h4>
          </div>
          <div class="box-body">
            <form>
              <div class="input-group">
                <select name="id_barang" class="form-control" aria-describedby="button-addon2">
                  <option value="">-- Pilih Barang --</option>
                  <?php foreach ($barang as $b) { ?>
                    <option value="<?= $b['id_barang']; ?>" <?= ($id_barang == $b['id_barang']) ? 'selected' : ''; ?>><?= $b['nama_barang']; ?></option>
                  <?php } ?>
                </select>
                <input type="date" class="form-control" name="start" value="<?= $this->input->get('start'); ?>">
                <input type="date" class="form-control" name="end" value="<?= $this->input->get('end'); ?>">
                <div class="input-group-append">
                  <input type="submit" value="Submit" class="btn btn-primary" id="button-addon2">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <?php if (!empty($id_barang)) {
      $barang = $this->db->get_where('barang', ['id_barang' => $id_barang])->row_array();
      $rasa = $this->db->get_where('rasa', ['id_rasa' => $barang['rasa_id']])->row_array();
      $jenis = $this->db->get_where('jenis', ['id_jenis' => $barang['jenis_id']])->row_array();
      $merek = $this->db->get_where('merek', ['id_merek' => $barang['merek_id']])->row_array();
      $stok_awal = $barang['stok_awal'];
      $masuk_min = $this->db->select('tanggal_masuk')->order_by('tanggal_masuk', 'asc')->limit(1)->get_where('barang_masuk', ['barang_id' => $id_barang])->row_array();
      $masuk_max = $this->db->select('tanggal_masuk')->order_by('tanggal_masuk', 'desc')->limit(1)->get_where('barang_masuk', ['barang_id' => $id_barang])->row_array();
      $keluar_min = $this->db->select('tanggal_keluar')->order_by('tanggal_keluar', 'asc')->limit(1)->get_where('barang_keluar', ['barang_id' => $id_barang])->row_array();
      $keluar_max = $this->db->select('tanggal_keluar')->order_by('tanggal_keluar', 'desc')->limit(1)->get_where('barang_keluar', ['barang_id' => $id_barang])->row_array();
      $masuk_min = (null == $masuk_min) ? date('Y-m-d') : $masuk_min['tanggal_masuk'];
      $masuk_max = (null == $masuk_max) ? date('Y-m-d') : $masuk_max['tanggal_masuk'];
      $keluar_min = (null == $keluar_min) ? date('Y-m-d') : $keluar_min['tanggal_keluar'];
      $keluar_max = (null == $keluar_max) ? date('Y-m-d') : $keluar_max['tanggal_keluar'];
      $awal = (empty($this->input->get('start'))) ? min([$masuk_min, $keluar_min]) : $this->input->get('start');
      $akhir = (empty($this->input->get('end'))) ? max([$masuk_max, $keluar_max]) : $this->input->get('end');
      $begin = new DateTime($awal);
      $end = new DateTime($akhir);
      $interval = DateInterval::createFromDateString('1 day');
      $period = new DatePeriod($begin, $interval, $end);
      $jumlah_masuk = 0;
      $jumlah_keluar = 0;
      $jumlah_sisa = 0; ?>
      <div class="row justify-content-center mt-4">
        <div class="col-12">
          <div class="box shadow-sm border-bottom-primary">
            <div class="box-header bg-white py-3">
              
              <h4 class="h5 align-middle m-0 font-weight-bold text-dark">Nama Barang: <span class="text-primary"><?php echo $barang['nama_barang'] ?></span></h4>
              <h4 class="h5 align-middle m-0 font-weight-bold text-dark">Rasa: <span class="text-primary"><?php echo $rasa['nama_rasa'] ?></span></h4>
              <h4 class="h5 align-middle m-0 font-weight-bold text-dark">Jenis: <span class="text-primary"><?php echo $jenis['nama_jenis']?></span></h4>
              <h4 class="h5 align-middle m-0 font-weight-bold text-dark">Merek: <span class="text-primary"><?php echo $merek['nama_merek']?></span></h4>              
              <h4 class="h5 align-middle m-0 font-weight-bold text-dark">Stok Awal: <span class="text-primary"><?php echo $barang['stok_awal']?></span></h4>
            </div>
            <div class="box-body">
              <table class="table data w-100">
                <thead>
                  <tr>
                    <th>Tanggal</th>
                    <th>Masuk</th>
                    <th>Keluar</th>
                    <th>Sisa</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $sisa = $stok_awal;
                  foreach ($period as $dt) {
                    $tanggal = $dt->format('Y-m-d');
                    $masuk = $this->db->query("SELECT SUM(`jumlah_masuk`) as `masuk` FROM `barang_masuk` WHERE `barang_id` = '$id_barang' AND `tanggal_masuk` = '$tanggal'")->row_array()['masuk'];
                    $keluar = $this->db->query("SELECT SUM(`jumlah_keluar`) as `keluar` FROM `barang_keluar` WHERE `barang_id` = '$id_barang' AND `tanggal_keluar` = '$tanggal'")->row_array()['keluar'];
                    $masuk = (null == $masuk) ? 0 : $masuk;
                    $keluar = (null == $keluar) ? 0 : $keluar;
                    $sisa = $sisa + $masuk - $keluar;
                    if (0 < $masuk or 0 < $keluar) {
                      $jumlah_masuk += $masuk;
                      $jumlah_keluar += $keluar;
                      $jumlah_sisa += $sisa; ?>
                      <tr>
                        <td><?= $tanggal; ?></td>
                        <td><?= $masuk; ?></td>
                        <td><?= $keluar; ?></td>
                        <td><?= $sisa; ?></td>
                      </tr>
                    <?php } ?>
                  <?php } ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Jumlah</th>
                    <td><?= $jumlah_masuk; ?></td>
                    <td><?= $jumlah_keluar; ?></td>
                    <td><?= $jumlah_sisa; ?></td>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
      <script>
        $(document).ready(function() {
          var deskripsi = 'Nama Barang: <?= $barang['nama_barang']; ?>\nRasa: <?= $rasa['nama_rasa']; ?>\nJenis: <?= $jenis['nama_jenis']; ?>\nMerek: <?= $merek['nama_merek']; ?>\nStok Awal: <?= $barang['stok_awal']; ?>';
          $('.data').DataTable({
            dom: 'B',
            buttons: [{
              extend: 'copy',
              messageTop: deskripsi,
              footer: true
            }, {
              extend: 'excel',
              messageTop: deskripsi,
              footer: true
            }, {
              extend: 'pdf',
              // messageTop: '<//?= $deskripsi; ?>',
              messageTop: deskripsi,
              // customize: function(doc) {
              //   doc.content[1].table.widths =
              //     Array(doc.content[1].table.body[0].length + 1).join('*').split('');
              // },
              footer: true
            }],
            ordering: false
          });
        });
      </script>
    <?php } ?>

  </section>
</div>