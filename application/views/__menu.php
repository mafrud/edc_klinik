<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image" style="background-color:white;border-radius: 100%;">
        <img src="<?php echo base_url();?>assets/dist/img/logo.png" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p id="untuk_nm_perusahaan"></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online (<span id="clock"></span>)</a>
      </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="fa form-control">
      <div class="input-group">
        <span id="tanggal_sekarang"></span>
        <span id="tanggal_pada_hari_ini" hidden></span>
      </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      <li class="header" id="role_permision"></li>
      <li class="treeview" id="menu1">
        <a href="#">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li id="menu1_1">
            <?php echo anchor('dashboard', '<i class="fa fa-circle-o"></i> Dashboard', array('class' => 'nav-link active'));?>
          </li>
          <li id="menu1_2">
            <?php echo anchor('daftar_antrian/Daftar_antrian_pasien', '<i class="fa fa-circle-o"></i> Form Daftar Antrian', array('class' => 'nav-link active'));?>
          </li>
          <li id="menu1_3">
            <?php echo anchor('daftar_antrian/Daftar_antrian_pasien/data_antrian_pasien', '<i class="fa fa-circle-o"></i> Data Antrian Pasien', array('class' => 'nav-link active'));?>
          </li>
          <li id="menu1_4">
            <?php echo anchor('farmasi/master_harga_obat', '<i class="fa fa-circle-o"></i> Master Harga Obat', array('class' => 'nav-link active'));?>
          </li>
          <li id="menu1_5">
          	<?php echo anchor('daftar_antrian/Daftar_antrian_pasien/tes_halaman_daftar_antrian_pasien', '<i class="fa fa-circle-o"></i> Form Daftar Antrian Pasien', array('class' => 'nav-link active'));?>
          </li>

          <!-- <li><a href="<?php //echo base_url();?>assets/index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li> -->
        </ul>
      </li>
      <li class="treeview" id="menu2">
        <a href="#">
          <i class="fa fa-files-o"></i>
          <span>Layout Options</span>
          <span class="label label-primary pull-right">4</span>
        </a>
        <ul class="treeview-menu">
          <li><?php echo anchor('kepegawaian/Master_user', '<i class="fa fa-circle-o"></i> Master User ', array('class' => 'nav-link active'));?></li>
          <li><?php echo anchor('kepegawaian/Master_data_pegawai', '<i class="fa fa-circle-o"></i> Master pegawai ', array('class' => 'nav-link active'));?></li>
          <li><?php echo anchor('kepegawaian/Master_data_pegawai/Data_kontrak_pg', '<i class="fa fa-circle-o"></i> Kontrak Pegawai ', array('class' => 'nav-link active'));?></li>
          <li><?php echo anchor('kepegawaian/Master_data_pegawai/Data_cuti_pg', '<i class="fa fa-circle-o"></i> Data Cuti Pegawai ', array('class' => 'nav-link active'));?></li>
          <li><?php echo anchor('login/cek_login', '<i class="fa fa-circle-o"></i> Login', array('class' => 'nav-link active'));?></li>
          <li><?php echo anchor('bpjs_api/create_sep', '<i class="fa fa-circle-o"></i> Buat SEP', array('class' => 'nav-link active'));?></li>
          <li><?php echo anchor('bpjs_api/pasien_bpjs', '<i class="fa fa-circle-o"></i> Pasien BPJS', array('class' => 'nav-link active'));?></li>
          <li><?php echo anchor('medis/Jadwal_operasi', '<i class="fa fa-circle-o"></i> Jadwal Operasi', array('class' => 'nav-link active'));?></li>
          <li><?php echo anchor('laporan_harian', '<i class="fa fa-circle-o"></i> Layout Laporan Baru', array('class' => 'nav-link active'));?></li>
          <li><?php echo anchor('medis/rekamedis', '<i class="fa fa-circle-o"></i> Rekamedis', array('class' => 'nav-link active'));?></li>
          <!-- <li><a href="../layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li> -->
          <!-- <li><a href="../layout/fixed.html"><i class="fa fa-circle-o"></i> fixed </a></li> -->
          <li><?php echo anchor('farmasi/ujicoba', '<i class="fa fa-circle-o"></i> Farmasi', array('class' => 'nav-link active'));?>
          </li>
          <li>
            <?php echo anchor('keuangan/jasmed/jasmed_dokter', '<i class="fa fa-circle-o"></i> Jasmed Dokter', array('class' => 'nav-link active'));?>
          </li>
          <li>
            <?php echo anchor('daftar_antrian/Daftar_antrian_pasien/tes_halaman_daftar_antrian_pasien', '<i class="fa fa-circle-o"></i> tes Daftar Antrian Pasien', array('class' => 'nav-link active'));?>
          </li>
          <li>
            <?php echo anchor('daftar_antrian/Daftar_antrian_pasien/data_antrian_pasien', '<i class="fa fa-circle-o"></i> Data Antrian Pasien', array('class' => 'nav-link active'));?>
          </li>
          <li>
            <?php echo anchor('http://tulungagung.klinikmataedc.id/display_antrian_pasien.php?id_perusahaan='.$this->session->userdata('outlet'), '<i class="fa fa-circle-o"></i> Pemanggil Pasien', array('class' => 'nav-link active'));?>
          </li>
          <li>
            <?php echo anchor('http://tulungagung.klinikmataedc.id/display_antrian_operasi.php?id_perusahaan='.$this->session->userdata('outlet'), '<i class="fa fa-circle-o"></i> Daftar Antrian Operasi', array('class' => 'nav-link active'));?>
          </li>
          <li id="menu5_6">
            <?php echo anchor('master_farmasi', '<i class="fa fa-circle-o"></i> Farmasi Obat', array('class' => 'nav-link active'));?>
          </li>
          <li>
            <?php echo anchor('farmasi_obat/Sp_farmasi', '<i class="fa fa-circle-o"></i> Form SP Farmasi', array('class' => 'nav-link active'));?>
          </li>
          <li>
            <?php echo anchor('farmasi_obat/Sp_farmasi', '<i class="fa fa-circle-o"></i> Form SP Manager', array('class' => 'nav-link active'));?>
          </li>
          <li>
            <?php echo anchor('farmasi_obat/Sp_gudang', '<i class="fa fa-circle-o"></i> Form SP Gudang', array('class' => 'nav-link active'));?>
          </li>
          <li>
            <?php echo anchor('farmasi_obat/Cetak_sp_gudang', '<i class="fa fa-circle-o"></i> Cetak SP Gudang', array('class' => 'nav-link active'));?>
          </li>
          <li>
            <?php echo anchor('farmasi_obat/Cetak_sp_distributor', '<i class="fa fa-circle-o"></i> Cetak SP Distributor', array('class' => 'nav-link active'));?>
          </li>
          <li>
            <?php echo anchor('farmasi/obat_gudang', '<i class="fa fa-circle-o"></i> Transaksi Gudang', array('class' => 'nav-link active'));?>
          </li>
          <li>
            <?php echo anchor('farmasi/jual_obat_di_gudang', '<i class="fa fa-circle-o"></i> Penjualan Gudang', array('class' => 'nav-link active'));?>
          </li>
          <li>
            <?php echo anchor('farmasi/gudang_outlet', '<i class="fa fa-circle-o"></i> Gudang Outlet', array('class' => 'nav-link active'));?>
          </li>
          <li>
            <?php echo anchor('farmasi/pengajuan_pembayaran_obat', '<i class="fa fa-circle-o"></i> Data Pengajuan', array('class' => 'nav-link active'));?>
          </li>
        </ul>
      </li>
      <!-- <li>
        <a href="../widgets.html">
          <i class="fa fa-th"></i> <span>Widgets</span> <small class="label pull-right bg-green">Hot</small>
        </a>
      </li> -->
      <li class="treeview" id="menu3">
        <a href="#">
          <i class="fa fa-file-text-o"></i>
          <span>Laporan</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li>
            <?php echo anchor('laporan_harian', '<i class="fa fa-circle-o"></i> Laporan Harian', array('class' => 'nav-link active'));?>
          </li>
          <li>
            <?php echo anchor('laporan_b', '<i class="fa fa-circle-o"></i> Laporan Bulanan', array('class' => 'nav-link active'));?>
          </li>
        </ul>
      </li>
      <li class="treeview" id="menu4">
        <a href="#">
          <i class="fa fa-plus-square"></i>
          <span>Farmasi</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li>
            <?php echo anchor('farmasi', '<i class="fa fa-circle-o"></i> Transaksi Obat', array('class' => 'nav-link active'));?>
          </li>
          <li id="menu4_2"><?php echo anchor('farmasi/ujicoba', '<i class="fa fa-circle-o"></i> Stok Toko', array('class' => 'nav-link active'));?>
          </li>
          <li>
          	<?php echo anchor('lap_faktur_penjualan/laporan_stok_toko', '<i class="fa fa-circle-o"></i> Laporan Stok', array('class' => 'nav-link active'));?>
          	<!-- <a href="#"><i class="fa fa-circle-o"></i> Laporan Penjualan</a> -->
          </li>
          <li>
            <?php echo anchor('laporan_penjualan', '<i class="fa fa-circle-o"></i> Laporan Penjualan', array('class' => 'nav-link active'));?>
            <!-- <a href="#"><i class="fa fa-circle-o"></i> Laporan Penjualan</a> -->
          </li>
          <li>
            <?php echo anchor('lap_barang_masuk', '<i class="fa fa-circle-o"></i> Laporan Barang Masuk', array('class' => 'nav-link active'));?>
            <!-- <a href="#"><i class="fa fa-circle-o"></i> Laporan Penjualan</a> -->
          </li>
          <li><?php echo anchor('farmasi_obat/laporan_sisa_stok', '<i class="fa fa-circle-o"></i> Laporan Sisa Stok', array('class' => 'nav-link active'));?></li>
          <li>
            <!-- <?php //echo anchor('lap_faktur_penjualan', '<i class="fa fa-circle-o"></i> Faktur Penjualan', array('class' => 'nav-link active'));?> -->
            <!-- <a href="#"><i class="fa fa-circle-o"></i> Laporan Penjualan</a> -->
          </li>
          <!-- <li><a href="../UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
          <li><a href="../UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
          <li><a href="../UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li> -->
          <li>
            <?php echo anchor('Tes_Upload', '<i class="fa fa-circle-o"></i> Tes', array('class' => 'nav-link active'));?>
          </li>
        </ul>
      </li>
      <li class="treeview" id="menu5">
        <a href="#">
          <i class="fa fa-edit"></i> <span>Master</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li id="menu5_1">
            <?php echo anchor('master_dokter', '<i class="fa fa-circle-o"></i> Dokter', array('class' => 'nav-link active'));?>
          </li>
          <li id="menu5_2">
            <?php echo anchor('master_suplier', '<i class="fa fa-circle-o"></i> Suplier', array('class' => 'nav-link active'));?>
          </li>
          <li id="menu5_3">
            <?php echo anchor('master_obat', '<i class="fa fa-circle-o"></i> Obat', array('class' => 'nav-link active'));?>
          </li>
          <li id="menu5_4">
            <?php echo anchor('master_tindakan', '<i class="fa fa-circle-o"></i> Tindakan', array('class' => 'nav-link active'));?>
          </li>
          <li id="menu5_5">
            <?php echo anchor('master_cabang', '<i class="fa fa-circle-o"></i> Outlet', array('class' => 'nav-link active'));?>
          </li>
          <!-- <li><a href="../forms/general.html"><i class="fa fa-circle-o"></i> Cabang</a></li> -->
          <!-- <li><a href="../forms/advanced.html"><i class="fa fa-circle-o"></i> Dokter</a></li>
          <li><a href="../forms/editors.html"><i class="fa fa-circle-o"></i> Tindakan</a></li>
          <li><a href="../forms/editors.html"><i class="fa fa-circle-o"></i> Pegawai</a></li>
          <li><a href="../forms/editors.html"><i class="fa fa-circle-o"></i> User</a></li>
          <li><a href="../forms/editors.html"><i class="fa fa-circle-o"></i> Pekerjaan</a></li> -->
        </ul>
      </li>
      <li id="menu6">
        <?php echo anchor('validasi_retur_obat', '<i class="fa fa-reply"></i> <span>Retur Barang</span> <small class="label pull-right bg-red">3</small>', array('class' => 'nav-link active'));?>
      </li>
      <li id="menu8">
        <?php echo anchor('folder_laporan/laporan_pembatalan', '<i class="fa fa-file-text-o"></i> <span>Laporan Pembatalan</span>', array('class' => 'nav-link active'));?>
        
      </li>
      <li class="treeview" id="menu7">
        <a href="#">
          <i class="fa fa-money"></i>
          <span>Keuangan</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <!-- <li> -->
            <!-- <?php //echo anchor('lap_faktur_penjualan', '<i class="fa fa-circle-o"></i> Faktur Penjualan 1', array('class' => 'nav-link active'));?> -->
            <!-- <a href="#"><i class="fa fa-circle-o"></i> Laporan Penjualan</a> -->
          <!-- </li> -->
          <li>
            <?php echo anchor('lap_faktur_penjualan/laporan_faktur_jual', '<i class="fa fa-circle-o"></i> Faktur Penjualan', array('class' => 'nav-link active'));?>
            <!-- <a href="#"><i class="fa fa-circle-o"></i> Laporan Penjualan</a> -->
          </li>
          <li>
            <?php echo anchor('laporan_penjualan', '<i class="fa fa-circle-o"></i> Laporan Penjualan', array('class' => 'nav-link active'));?>
            <!-- <a href="#"><i class="fa fa-circle-o"></i> Laporan Penjualan</a> -->
          </li>
          <li>
            <?php echo anchor('lap_faktur_pemesanan', '<i class="fa fa-circle-o"></i> Faktur Pemesanan', array('class' => 'nav-link active'));?>
            <!-- <a href="#"><i class="fa fa-circle-o"></i> Laporan Penjualan</a> -->
          </li>
          <li>
            <?php echo anchor('lap_barang_masuk', '<i class="fa fa-circle-o"></i> Laporan Barang Masuk', array('class' => 'nav-link active'));?>
            <!-- <a href="#"><i class="fa fa-circle-o"></i> Laporan Penjualan</a> -->
          </li>
          <!-- <li><a href="../UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
          <li><a href="../UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
          <li><a href="../UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li> -->
        </ul>
      </li>
      <li id="menu9">
        <a href="#">
          <i class="fa fa-book"></i>
          <span>Humas Marketing</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li id="">
            <?php echo anchor('humas/Kegiatan', '<i class="fa fa-pencil"></i> <span>Kegiatan Humas</span>', array('class' => 'nav-link active'));?>
          </li>
          <li id="menu9_2">
            
            <?php echo anchor('humas/Kegiatan/capaianKegiatan', '<i class="fa fa-circle-o"></i> <span>Capaian Kegiatan</span>', array('class' => 'nav-link active'));?>

          </li>
          <!-- <li>
            
            echo anchor('humas/data_humas/laporan_kunjungan_instansi', '<i class="fa fa-circle-o"></i> <span>Data Laporan</span>', array('class' => 'nav-link active'));
            
          </li> -->
        </ul>
      </li>
      <li class="treeview" id="menu10">
        <a href="#">
          <i class="fa fa-hospital-o"></i>
          <span>Gudang</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li>
            <?php echo anchor('farmasi/obat_gudang', '<i class="fa fa-circle-o"></i> Transaksi Gudang', array('class' => 'nav-link active'));?>
          </li>
          <li>
            <?php echo anchor('farmasi/jual_obat_di_gudang', '<i class="fa fa-circle-o"></i> Penjualan Gudang', array('class' => 'nav-link active'));?>
          </li>
          <li>
            <?php echo anchor('farmasi', '<i class="fa fa-circle-o"></i> Transaksi Obat', array('class' => 'nav-link active'));?>
          </li>
          <li id="menu4_2"><?php echo anchor('farmasi/ujicoba', '<i class="fa fa-circle-o"></i> Stok Toko', array('class' => 'nav-link active'));?>
          </li>
          <li>
          	<?php echo anchor('lap_faktur_penjualan/laporan_stok_toko', '<i class="fa fa-circle-o"></i> Laporan Stok', array('class' => 'nav-link active'));?>
          	<!-- <a href="#"><i class="fa fa-circle-o"></i> Laporan Penjualan</a> -->
          </li>
          <li>
            <?php echo anchor('laporan_penjualan', '<i class="fa fa-circle-o"></i> Laporan Penjualan', array('class' => 'nav-link active'));?>
            <!-- <a href="#"><i class="fa fa-circle-o"></i> Laporan Penjualan</a> -->
          </li>
          <li>
            <?php echo anchor('lap_barang_masuk', '<i class="fa fa-circle-o"></i> Laporan Barang Masuk', array('class' => 'nav-link active'));?>
            <!-- <a href="#"><i class="fa fa-circle-o"></i> Laporan Penjualan</a> -->
          </li>
          <li><?php echo anchor('farmasi_obat/laporan_sisa_stok', '<i class="fa fa-circle-o"></i> Laporan Sisa Stok', array('class' => 'nav-link active'));?></li>
          <li>
            <!-- <?php //echo anchor('lap_faktur_penjualan', '<i class="fa fa-circle-o"></i> Faktur Penjualan', array('class' => 'nav-link active'));?> -->
            <!-- <a href="#"><i class="fa fa-circle-o"></i> Laporan Penjualan</a> -->
          </li>
          <!-- <li><a href="../UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
          <li><a href="../UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
          <li><a href="../UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li> -->
          <li>
            <?php echo anchor('Tes_Upload', '<i class="fa fa-circle-o"></i> List Harga Terkunci', array('class' => 'nav-link active'));?>
          </li>
        </ul>
      </li>
      
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>