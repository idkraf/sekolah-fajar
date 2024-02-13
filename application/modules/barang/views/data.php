<div class="content-wrapper">
  <section class="content-header">
		<h1>
			<?php echo isset($title) ? '' . $title : null; ?>
			<small></small>
		</h1>
		<ol class="breadcrumb">
			<li  class="breadcrumb-item"><a href="<?php echo site_url('manage') ?>"><i class="fa fa-th"></i> Home</a></li>
			<li class="active breadcrumb-item"><?php echo isset($title) ? '' . $title : null; ?></li>
		</ol>
	</section>
	<section class="content">
    <?php error_reporting(0); ?>
    <?= $this->session->flashdata('pesan'); ?>
    <div class="box shadow-sm border-bottom-primary">
      <div class="card-header bg-white py-3">
        
              <a href="<?= base_url('manage/barang/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                <span class="icon">
                  <i class="fa fa-plus"></i>
                </span>
                <span class="text">
                  Add Item
                </span>
              </a>
       
      </div>
      <div class="table-responsive">
        <table class="table table-striped w-100 dt-responsive " id="dataTable">
          <thead>
            <tr>
              <th>No. </th>
              <th>ID Barang</th>
              <th>Nama Barang</th>
              <th>Jenis Barang</th>
              <th>Warna Barang</th>
              <th>Rasa Barang</th>
              <th>Merek Barang</th>
              <th>Stok Awal</th>
              <th>Stok Masuk</th>
              <th>Stok Keluar</th>
              <th>Stok Akhir</th>
              <th>Jumlah Keluar</th>
              <th>Satuan</th>
              <th>Harga Barang(Rp)</th>
              <th>Total Harga Barang(Rp)</th>
              <th>Gudang</th>
              <th>Aksi</th>
             
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            $tot_bayar = 0;
            if ($barang) :
              foreach ($barang as $b) :
                $total = $b['harga_barang'] * $b['stok'];
                $stok_masuk = 0;
                $sm = $this->db->query("SELECT `jumlah_masuk` FROM `barang_masuk` WHERE `barang_id` = '" . $b['id_barang'] . "'")->result_array();
                foreach ($sm as $m) {
                  $stok_masuk += $m['jumlah_masuk'];
                }
                $stok_keluar = 0;
                $sk = $this->db->query("SELECT `jumlah_keluar` FROM `barang_keluar` WHERE `barang_id` = '" . $b['id_barang'] . "'")->result_array();
                foreach ($sk as $k) {
                  $stok_keluar += $k['jumlah_keluar'];
                }
                $stok_akhir = $b['stok_awal'] + $stok_masuk - $stok_keluar;
            ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $b['id_barang']; ?></td>
                  
                  <td><?= $b['nama_barang']; ?></td>
                  <td><?= $b['nama_jenis']; ?></td>
                  <td><?= $b['nama_warna']; ?></td>
                  <td><?= $b['nama_rasa']; ?></td>
                  <td><?= $b['nama_merek']; ?></td>
                  <td><?= $b['stok_awal']; ?></td>
                  <td><?= $stok_masuk; ?></td>
                  <td><?= $stok_keluar; ?></td>
                  <!-- <td><?= $b['stok']; ?></td> -->
                  <td><?= $stok_akhir; ?></td>
                  <td><?= $b['stok_awal'] - $b['stok']; ?></td>
                  <td><?= $b['nama_satuan']; ?></td>
                  <td><?php echo number_format($b['harga_barang'])  ?></td>
                  <td><?php echo number_format($total)  ?></td>
                  <td><?= $b['nama_gudang']; ?></td>
                  
                  <td>
                    <a href="<?= base_url('manage/barang/edit/') . $b['id_barang'] ?>" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-edit"></i></a>

                    <a onclick="return confirm('Yakin ingin hapus?')" href="<?= base_url('manage/barang/delete/') . $b['id_barang'] ?>" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a> 
                  </td>
                
                </tr>

              <?php endforeach; ?>
            <?php else : ?>
              <tr>
                <td colspan="7" class="text-center">
                  Data Kosong
                </td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>