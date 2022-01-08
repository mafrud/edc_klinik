<section class="content-header">
  <h1>Pelayanan Administrasi Klinik Mata EDC</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Examples</a></li>
    <li class="active">Blank page</li>
  </ol>
</section>

<section class="content" id="tabel_pasien_hari_ini">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary btn-flat" id="btn_riwayat_pasien"><i class="fa fa-fw fa-list-alt"></i> Riwayat Pasien</button>
        <button class="btn btn-info btn-flat" id="btn_daftar_pasien"><i class="fa fa-fw fa-plus"></i> Daftar Pasien</button>
        <!-- <button class="btn btn-danger btn-flat" id="btn_input_retur"><i class="fa fa-fw fa-rotate-right (alias)"></i> Retur</button> -->
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
          <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
        <div class="box-header">
          <h3 class="box-title">Daftar Pasien Hari ini</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th width="10%">No.</th>
                <th>Tgl Daftar</th>
                <th>No RM</th>
                <th hidden>No RM</th>
                <th>No Daftar</th>
                <th hidden>No Daftar</th>
                <th>Nama Pasien</th>
                <th>JK</th>
                <th>Alamat</th>
                <th>Nama Golongan</th>
                <th hidden>Id Dokter</th>
                <th hidden>No Telfon</th>
                <th hidden>Pekerjaan</th>
                <th hidden>Tempat Lahir</th>
                <th hidden>Tanggal lahir</th>
                <th hidden>NOKPST</th>
                <th hidden>NIK</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody id="daftar_pasien_hari_ini">
              
            </tbody>
            <tfoot>
              <tr>
                <th>No.</th>
                <th>Tgl Daftar</th>
                <th>No RM</th>
                <th hidden>No RM</th>
                <th>No Daftar</th>
                <th hidden>No Daftar</th>
                <th>Nama Pasien</th>
                <th>JK</th>
                <th>Alamat</th>
                <th>Nama Golongan</th>
                <th hidden>Id Dokter</th>
                <th hidden>No Telfon</th>
                <th hidden>Pekerjaan</th>
                <th hidden>Tempat Lahir</th>
                <th hidden>Tanggal lahir</th>
                <th hidden>NOKPST</th>
                <th hidden>NIK</th>
                <th>Aksi</th>
              </tr>
            </tfoot>
          </table>
          </div>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->

<section class="content" id="riwayat_tabel_pasien">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-danger btn-flat" id="back_home"><i class="fa fa-fw fa-chevron-left"></i> Kembali</button>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
          <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
        <div class="box-header">
          <h3 class="box-title">Riwayat Pendaftaran Pasien</h3>
        </div><!-- /.box-header -->
        <div class="box-header with-border">
        <form id="form_tanggal_riwayat">
        <div class="col-md-12">
          <div class="form-group">
            <div class="col-md-6">
              <label>Tanggal Pertama</label>
              <input type="date" class="form-control" placeholder="Nama Pembayar ..." name="tanggal_rwyt1" id="tanggal_rwyt1">
            </div>
            <div class="col-md-6">
              <label>Tanggal Kedua</label>
              <input type="date" class="form-control" placeholder="Nama Pembayar ..." name="tanggal_rwyt2" id="tanggal_rwyt2">
            </div>
          </div>
        </div><!-- /.col -->
        </form>
      </div>
        <div class="box-body">
          <div class="table-responsive">
          <table id="example2" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No.</th>
                <th>Tgl Daftar</th>
                <th hidden>No RM</th>
                <th hidden>No Daftar</th>
                <th>No RM</th>
                <th>No Daftar</th>
                <th>Nama Pasien</th>
                <th>JK</th>
                <th>Alamat</th>
                <th>Nama Golongan</th>
                <th hidden>ID Tarif</th>
                <th hidden>Notelp</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody id="tbody_riwayat_pasien">
            </tbody>
            <tfoot>
              <tr>
                <th>No.</th>
                <th>Tgl Daftar</th>
                <th hidden>No RM</th>
                <th hidden>No Daftar</th>
                <th>No RM</th>
                <th>No Daftar</th>
                <th>Nama Pasien</th>
                <th>JK</th>
                <th>Alamat</th>
                <th>Nama Golongan</th>
                <th hidden>ID Tarif</th>
                <th hidden>Notelp</th>
                <th>Aksi</th>
              </tr>
            </tfoot>
          </table>
        </div>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->

<section class="content" id="tabel_pasien_lama">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary btn-flat" id="tambah_pasien_baru"><i class="fa fa-fw fa-plus"></i> Tambah Pasien Baru</button>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
          <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
        <div class="box-header">
          <div class="box-body">
            <form method="post" class="form-user" id="form_cari_pasien_lama">
              <div class="col-xs-3">
                <input type="" class="form-control" name="nik_pasien_screening" id="nik_pasien_screening" placeholder="NIK Pasien">
              </div>
              <div class="col-xs-3">
                <input type="" class="form-control" name="no_rm_pasien_lama" id="no_rm_pasien_lama" placeholder="Norm Pasien Lama">
              </div>
              <div class="col-xs-3">
                <input type="" class="form-control" name="nama_pasien_lama" id="nama_pasien_lama" placeholder="Nama Pasien Lama">
              </div>
            </form>
            <!-- <div class="col-xs-5"> -->
                <button class="btn btn-primary btn-flat" id="cari_pasien_lama"><i class="fa fa-fw fa-search"></i> Cari Pasien</button>
              <!-- </div> -->
          </div>
        </div><!-- /.box-header -->
        <div class="box-header">
          <h3 class="box-title">List Daftar Pasien Lama</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
          <table id="example3" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No.</th>
                <th>Norm</th>
                <th>Nama Pasien</th>
                <th>JK</th>
                <th>Alamat</th>
                <th>Kecamatan - Kabupaten</th>
                <th hidden>Tempat Lahir</th>
                <th hidden>Tanggal Lahir</th>
                <th hidden>Pekerjaan</th>
                <th hidden>Jenis Pasien</th>
                <th hidden>Provinsi</th>
                <th hidden>Kabupaten</th>
                <th hidden>Kecamatan</th>
                <th hidden>Desa</th>
                <th hidden>No Telp</th>
                <th hidden>No KPST</th>
                <th hidden>Batas</th>
                <th hidden>nik</th>
                <th class="">Aksi</th>
              </tr>
            </thead>
            <tbody id="tbody_example3">
              
            </tbody>
            <tfoot>
              <tr>
                <th>No.</th>
                <th>Norm</th>
                <th>Nama Pasien</th>
                <th>JK</th>
                <th>Alamat</th>
                <th>Kecamatan - Kabupaten</th>
                <th hidden>Tempat Lahir</th>
                <th hidden>Tanggal Lahir</th>
                <th hidden>Pekerjaan</th>
                <th hidden>Jenis Pasien</th>
                <th hidden>Provinsi</th>
                <th hidden>Kabupaten</th>
                <th hidden>Kecamatan</th>
                <th hidden>Desa</th>
                <th hidden>No Telp</th>
                <th hidden>No KPST</th>
                <th hidden>Batas</th>
                <th hidden>nik</th>
                <th class="">Aksi</th>
              </tr>
            </tfoot>
          </table>
        </div>
        </div><!-- /.box-body -->
        <div class="box-header">
          <h3 class="box-title">List Daftar Pasien Lama Dari Dos</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
          <table id="tabel_pasien_dos" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No.</th>
                <th>Norm</th>
                <th>Nama Pasien</th>
                <th>JK</th>
                <th>Alamat</th>
                <th>Kecamatan - Kabupaten</th>
                <th hidden>Tempat Lahir</th>
                <th hidden>Tanggal Lahir</th>
                <th hidden>Pekerjaan</th>
                <th hidden>Jenis Pasien</th>
                <th hidden>Provinsi</th>
                <th hidden>Kabupaten</th>
                <th hidden>Kecamatan</th>
                <th hidden>Desa</th>
                <th hidden>No Telp</th>
                <th hidden>No KPST</th>
                <th hidden>Batas</th>
                <th class="">Aksi</th>
              </tr>
            </thead>
            <tbody id="tbody_pasien_dos">
              
            </tbody>
            <tfoot>
              <tr>
                <th>No.</th>
                <th>Norm</th>
                <th>Nama Pasien</th>
                <th>JK</th>
                <th>Alamat</th>
                <th>Kecamatan - Kabupaten</th>
                <th hidden>Tempat Lahir</th>
                <th hidden>Tanggal Lahir</th>
                <th hidden>Pekerjaan</th>
                <th hidden>Jenis Pasien</th>
                <th hidden>Provinsi</th>
                <th hidden>Kabupaten</th>
                <th hidden>Kecamatan</th>
                <th hidden>Desa</th>
                <th hidden>No Telp</th>
                <th hidden>No KPST</th>
                <th hidden>Batas</th>
                <th class="">Aksi</th>
              </tr>
            </tfoot>
          </table>
        </div>
        </div><!-- /.box-body -->
        <div class="box-header">
          <h3 class="box-title">List Daftar Pasien Hasil Screening</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
          <table id="tabel_pasien_screening" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No.</th>
                <th>Norm</th>
                <th>Nama Pasien</th>
                <th>JK</th>
                <th>Alamat</th>
                <th>NIK</th>
                <th hidden>Tempat Lahir</th>
                <th hidden>Tanggal Lahir</th>
                <th hidden>Pekerjaan</th>
                <th hidden>Jenis Pasien</th>
                <th hidden>Provinsi</th>
                <th hidden>Kabupaten</th>
                <th hidden>Kecamatan</th>
                <th hidden>Desa</th>
                <th hidden>No Telp</th>
                <th hidden>No KPST</th>
                <th hidden>Batas</th>
                <th class="">Aksi</th>
              </tr>
            </thead>
            <tbody id="tbody_pasien_screening">
              
            </tbody>
            <tfoot>
              <tr>
                <th>No.</th>
                <th>Norm</th>
                <th>Nama Pasien</th>
                <th>JK</th>
                <th>Alamat</th>
                <th>NIK</th>
                <th hidden>Tempat Lahir</th>
                <th hidden>Tanggal Lahir</th>
                <th hidden>Pekerjaan</th>
                <th hidden>Jenis Pasien</th>
                <th hidden>Provinsi</th>
                <th hidden>Kabupaten</th>
                <th hidden>Kecamatan</th>
                <th hidden>Desa</th>
                <th hidden>No Telp</th>
                <th hidden>No KPST</th>
                <th hidden>Batas</th>
                <th class="">Aksi</th>
              </tr>
            </tfoot>
          </table>
        </div>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->

<!-- pembuka pendaftaran pasien -->
<section class="content" id="form_pendaftaran_pasien">
<form method="post" class="form-user" id="form_daftarkan_pasien">
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Form Pendaftaran Pasien</h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div><!-- /.box-header -->
    <div class="box-header with-border">
      <h3 class="box-title">Data Pasien</h3>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <div class="col-md-6">
              <label>NIK</label>
              <input type="text" class="form-control" maxlength="16" placeholder="NIK Pasien Sesuai KTP ..." name="nik_pasien" id="nik_pasien">
            </div>
            <div class="col-md-6">
              <label>Nama</label>
              <input type="hidden" id="token_d_p" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="">
              <input type="hidden" id="id_backup_dos" name="id_backup_dos" value="">
              <input type="hidden" id="ID_KUNJUNGAN_PASIEN" name="ID_KUNJUNGAN_PASIEN" value="">
              <input type="hidden" class="form-control" placeholder="Norm ..." name="norm_pasien" id="norm_pasien" >
              <input type="text" class="form-control" placeholder="Nama ..." name="nama_pasien" id="data_nama_pasien">
            </div>
          </div>
        </div><!-- /.col -->
        <div class="col-md-12">
          <div class="form-group">
            <div class="col-md-6">
              <label>Jenis Kelamin</label>
              <select class="form-control" style="width: 100%;" name="jk" id="jk">
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
            </div>
            <div class="col-md-6">
              <label>Tempat / tgl Lahir</label>
              <div class="form-group">
                <div class="col-xs-6">
                  <input type="text" class="form-control" placeholder="tempat ..." name="tempat_lahir" id="tempat_lahir">
                </div>
                <div class="col-xs-6">
                  <input type="date" class="form-control" placeholder="Tanggal Lahir ..." name="tgl_lahir" id="tgl_lahir">
                </div>
              </div>
            </div>
          </div>
        </div><!-- /.col -->
        <div class="col-md-12">
          <div class="form-group">
            <div class="col-md-6">
              <label>Pekerjaan</label>
              <select class="form-control" style="width: 100%;" name="pekerjaan" id="pekerjaan">
                <option value="Pekerjaan Swasta">Pekerjaan Swasta</option>
                <option value="Ibu Rumah Tangga">Ibu Rumah Tangga</option>
                <option value="PNS/TNI/POLRI">PNS/TNI/POLRI</option>
                <option value="Wiraswasta">Wiraswasta</option>
                <option value="Pelajar">Pelajar</option>
                <option value="Petani">Petani</option>
                <option value="Buruh">Buruh</option>
              </select>
            </div>
            <div class="col-md-6">
              <label>Alamat</label>
              <input type="text" class="form-control" placeholder="Alamat ..." name="alamat" id="alamat">
            </div>
          </div>
        </div><!-- /.col -->
        <div class="col-md-12">
          <div class="form-group">
            <div class="col-md-6" id="utk_jenis_p">
              <label>Jenis Pasien <div id="batas_awal"></div></label>
              <input type="hidden" class="form-control" placeholder="batas ..." name="batas" id="batas" readonly>
              <select class="form-control" style="width: 100%;" name="jenis_pasien" id="jenis_pasien">
                <option value=""> == | Pilih Kode Jenis Pasien | ==</option>
                <option value="UMUM">UMUM</option>
                <option value="BPJS">BPJS</option>
                <option value="GRATIS">GRATIS</option>
                <option value="MNC">MNC</option>
              </select>
            </div>
            <div class="col-md-6">
              <label>Provinsi</label>
              <div class="form-group">
                <select class="form-control select2" style="width: 100%;" name="provinsi" id="provinsi">
                  <option selected="selected">== | Pilih Provinsi | ==</option>
                </select>
              
                <div class="col-lg-3">
                  <input type="hidden" class="form-control" placeholder="Nama Provinsi" name="nama_provinsi" id="nama_provinsi" value="" readonly>
                </div>
                <div class="col-lg-4">
                </div>
              </div>
            </div>
          </div>
        </div><!-- /.col -->
        <div class="col-md-12">
          <div class="form-group">
            <div class="col-md-6">
              <label>Kota</label>
              <select class="form-control select2" style="width: 100%;" name="kabupaten" id="kabupaten">
                
              </select>
              <div class="col-lg-3">
                  <input type="hidden" class="form-control" placeholder="Nama Kabupaten" name="nama_kabupaten" id="nama_kabupaten" value="" readonly>
                </div>
            </div>
            <div class="col-md-6">
              <label>Kecamatan</label>
              <div class="form-group">
              <input type="hidden" class="form-control" placeholder="Nama Kecamatan" name="nama_kecamatan" id="nama_kecamatan" value=" " readonly>
                <select class="form-control select2" style="width: 100%;" name="kecamatan" id="kecamatan">
                </select>
                <div class="col-lg-4">
                  <!-- <input type="text" class="form-control" placeholder="ID Provinsi" name="id_provinsi" id="id_provinsi"> -->
                </div>
              </div>
            </div>
          </div>
        </div><!-- /.col -->
        <div class="col-md-12">
          <div class="form-group">
            <div class="col-md-6">
              <label>Desa</label>
              <select class="form-control select2" style="width: 100%;" name="desa" id="desa">
              </select>
              <div class="col-lg-3">
                <input type="hidden" class="form-control" placeholder="Nama Desa" name="nama_desa" id="nama_desa" value="" readonly>
              </div>
            </div>
            <div class="col-md-6">
              <label>No. Telp</label>
              <input type="text" class="form-control" placeholder="No Telp ..." name="no_telp" id="no_telp">
            </div>
          </div>
        </div><!-- /.col -->
        <div class="col-md-12" id="norm_lama">
          <div class="form-group">
            <div class="col-md-6" id="input_nokpst">
              <label>No. KPST</label>
              <div class="input-group input-group-sm">
                <input type="text" class="form-control" placeholder="No KPST ..." name="no_kpst" id="no_kpst">
                <span class="input-group-btn">
                  <button class="btn btn-info btn-flat" type="button" data-toggle="modal" data-target="#myModal" id="scanqr"><i class="fa fa-fw fa-qrcode"></i></button>
                  <!-- <button class="btn btn-info btn-flat" type="button" id="scanqr"><i class="fa fa-fw fa-qrcode"></i></button> -->
                </span>
              </div><!-- /input-group -->
            </div>
            <div class="col-md-6">
              <label>No. RM Lama</label>
              <input type="text" class="form-control" placeholder="Isi Dengan Norm lama jika penginputan SEP dengan NORM baru Gagal ..." name="norm_lama" id="norm_lama">
            </div>
          </div>
        </div><!-- /.col -->
      </div>
    </div>

    <div class="box-footer">
      <center>
        <h4 class="box-title">Karcis Pasien</h4>
          <div class="box-body" style="width:50%;">
            <table class="table table-bordered" id="tabel_karcis">
              
              <tbody id="daftar_pelayanan_karcis">
              </tbody>
            </table>
            <div class="form-group">
              <label>Pelayanan Dokter</label>
              <!-- <input type="text" class="form-control" placeholder="No Telp ..." name="id_dokter" id="id_dokter"> -->
              <!-- <input type="text" class="form-control" placeholder="No Telp ..." name="nm_dokter" id="nm_dokter"> -->
              <select class="form-control select" style="width: 100%;" name="id_dokter" id="id_dokter">
              </select>
              <input type="hidden" class="form-control" placeholder="No Telp ..." name="jumlah_tindakan" id="jumlah_tindakan" value="0" readonly>
              <input type="hidden" class="form-control" placeholder="No Telp ..." name="id_rj_sementara" id="id_rj_sementara" value="0" readonly>
              <input type="hidden" class="form-control" placeholder="No Telp ..." name="tarif_rj_sementara" id="tarif_rj_sementara" value="0" readonly>
            </div><!-- /.form-group -->
            <div class="form-group">
              <button type="button" class="btn btn-danger btn-flat" id="btn_batal_pendaftaran"><i class="fa fa-fw fa-remove"></i> Batal</button>
              <button type="button" class="btn btn-success btn-flat" id="btn_simpan_pendaftaran" name="btn_simpan_pendaftaran" value="">
                <i class="fa fa-fw fa-save"></i> Simpan
              </button> 
            </div>
          </div>
      </center>
    </div>
  </div>
</form>
</section>
<!-- penutup pendaftaran pasien -->

<div class="container">
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Scan QrCode Kartu BPJS Pasien</h4>
        </div>
        <div class="modal-body">
          <center>
            <canvas id="canvas"></canvas>
          </center>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" id="tutup_modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
</div>

<section class="content" id="section_karcis">
  <div class="box box-default">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-widget widget-user-2">
          <div >
            <div class="box-body table-responsive no-padding">
                <table class="table">
                  <tr>
                    <th>Nama Pasien</th>
                    <th>:</th>
                    <th id="nama_jk_k"></th>
                    <th>No RM / No Daftar</th>
                    <th>:</th>
                    <th id="norm_nodaftar_k"></th>
                  </tr>
                  <tr>
                    <th>Alamat</th>
                    <th>:</th>
                    <th id="alamat_k"></th>
                    <th>No. Telp</th>
                    <th>:</th>
                    <th id="notelpon_k"></th>
                  </tr>
                  <tr>
                    <th>Kepesertaan</th>
                    <th>:</th>
                    <th id="kepesetaan_k"></th>
                    <!-- <th>No. Telp</th>
                    <th>:</th>
                    <th id="no_telpon_t"></th> -->
                  </tr>
                  <tr>
                    <th></th><th></th><th></th><th></th><th></th><th></th>
                  </tr>
                </table>
            </div><!-- /.box-body -->
          </div>

          <!-- SELECT2 EXAMPLE -->
          <div class="box-body" id="form_karcis_urgen">
            <div class="row">
              <form method="post" id="form_input_karcis_urgen">
              <div class="col-md-12">
                <div class="form-group">
                  <div class="col-md-5">
                    <div class="form-group" id="dokter_tindakan2">
                        <label>Pilih Dokter</label>
                        <select class="form-control select2" style="width: 100%;" name="id_dokter_input_karcis_urgen" id="id_dokter_input_karcis_urgen">
                        </select>
                        <!-- <option selected="selected">- || -</option> -->
                    </div><!-- /.form-group -->
                    <label>Daftar Karcis</label>
                    <input type="hidden" class="form-control pull-right" placeholder="status input karcis Karcis" name="status_input_karcis" id="status_input_karcis" readonly>
                    <input type="hidden" class="form-control pull-right" placeholder="Tangaal Karcis" name="tgl_kasir" id="tgl_kasir" readonly>
                    <input type="hidden" class="form-control pull-right" placeholder="norm ..." name="norm_ksr_urgen" id="norm_ksr_urgen" readonly>
                    <input type="hidden" class="form-control pull-right" placeholder="nodaftar ..." name="nodaf_ksr_urgen" id="nodaf_ksr_urgen" readonly>
                    <select class="form-control select2" style="width: 100%;" id="daftar_id_karcis" name="daftar_id_karcis">
                      <!-- <option selected="selected">== || ==</option> -->
                    </select>
                  </div>
                  <div class="col-md-5">
                    <label>Tagihan</label>
                    <input type="text" class="form-control pull-right" placeholder="Tagihan ..." name="tagihan_karcis_urgen" id="tagihan_karcis_urgen" readonly>
                  </div>
                  <div class="col-md-2">
                    <label style="color: white;">Aksi</label> <br>
                    <button type="button" class="btn btn-success btn-flat" id="btn_simpan_karcis_urgen" name="btn_simpan_karcis_urgen" value="">
                      <i class="fa fa-fw fa-save"></i> Simpan Karcis
                    </button>
                  </div>
                </div><!-- /.form-group -->
              </div><!-- /.col -->
              </form>
            </div><!-- /.row -->
          </div><!-- /.box-body -->

          <strong>Rincian Biaya<div id="nodaftar_k" hidden></div></strong>
          <div class="box-footer no-padding">
            <table class="table table-bordered" id="tabel_karcis_pasien_k">
            <tr>
              <th style="width: 10px">No. </th>
              <th>Nama Tindakan</th>
              <th style="width: 150px">Harga Satuan</th>
              <th style="width: 10px">Qty</th>
              <th style="width: 100px">Total</th>
              <th style="width: 100px">Cetak</th>
              <th style="width: 100px"></th>
            </tr>
            <tbody id="tbd_tabel_karcis_pasien_k">
              
            </tbody>
          </table>
          </div>
          <div class="box-footer no-padding">
            <strong>TTD Dokter</strong>
            <div class="form-group" id="list_dokter_ttd_karcis">
              <table class="table table-bordered" id="tabel_status_ttd_pasien_k">
                <tr>
                  <th hidden>ID Dokter</th>
                  <th>Nama Dokter</th>
                  <th style="width: 150px">Status</th>
                </tr>
                <tbody id="tbd_tabel_status_ttd_pasien_k">
                  
                </tbody>
              </table>
            </div>
          </div>
          <div class="box-footer no-padding">
            <form method="post" name="form_bayar_karcis" id="form_bayar_karcis" action="">
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="col-md-6">
                      <label>Tanggal Pembayaran</label>
                      <input type="hidden" id="token_b_k" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="">
                      <input type="text" class="form-control pull-right" placeholder="Tanggal Pembayaran ..." name="tanggal_pembayaran_k" id="tanggal_pembayaran_k" readonly>
                    </div>
                    <div class="col-md-6">
                      <label>Jam Bayar</label>
                      <input type="text" class="form-control" placeholder="Jam Pembayaran ..." name="jam_pembayaran_k" id="jam_pembayaran_k" readonly>
                    </div>
                  </div>
                </div><!-- /.col -->

                <div class="col-md-12">
                  <div class="form-group">
                    <div class="col-md-6">
                      <label>Nama Pembayar</label>
                      <input type="hidden" class="form-control" placeholder="No RM ..." name="norm_pembayar_k" id="norm_pembayar_k" readonly>
                      <input type="hidden" class="form-control" placeholder="No Daftar ..." name="nodaftar_pembayar_k" id="nodaftar_pembayar_k" readonly>
                      <input type="text" class="form-control" placeholder="Nama Pembayar ..." name="nama_pembayar_k" id="nama_pembayar_k">
                    </div>
                    <div class="col-md-6">
                      <label>Diskon</label>
                      <div id="tari_dokter_awal" hidden></div>
                      <input type="text" class="form-control" placeholder="Diskon ..." name="diskon_k" id="diskon_k" onKeyUp="diskon_karcis();">
                      <input type="hidden" class="form-control" placeholder="Hasil Diskon ..." name="hasil_diskon_k" id="hasil_diskon_k" readonly>
                      <input type="hidden" class="form-control" placeholder="Admin ..." name="tarif_admin_k" id="tarif_admin_k" readonly>
                      <input type="hidden" class="form-control" placeholder="Tarif Periksa ..." name="tarif_periksa_k" id="tarif_periksa_k" readonly>
                      <input type="hidden" class="form-control" placeholder="ID Biaya Periksa ..." name="id_biaya_perawatan_k" id="id_biaya_perawatan_k" readonly>
                    </div>
                  </div>
                </div><!-- /.col -->

                <div class="col-md-12">
                  <div class="form-group">
                    <div class="col-md-6">
                      <label>Jumlah Yang di Tagihkan</label>
                      <input type="text" class="form-control" placeholder="jumlah_tagihan ..." name="jumlah_tagihan_k" id="jumlah_tagihan_k" readonly>
                    </div>
                    <div class="col-md-6">
                      <label>Jumlah Yang Dibayar</label>
                      <input type="text" class="form-control" placeholder="Jumlah Yang di Bayar ..." name="jumlah_yang_dibayar_k" id="jumlah_yang_dibayar_k" onKeyUp="pengurangan_kembalian_karcis();">
                    </div>
                  </div>
                </div><!-- /.col -->

                <div class="col-md-12">
                  <div class="form-group">
                    <div class="col-md-6">
                      <label>Kembali</label>
                      <input type="text" class="form-control" placeholder="Uang kembalian ..." name="uang_kembalian_k" id="uang_kembalian_k" readonly>
                    </div>
                  </div>
                </div><!-- /.col -->

                <div class="col-md-12">
                  <div class="form-group">
                    <div class="col-md-6">
                      <label>Jenis Pembayaran</label>
                      <select class="form-control" name="jenis_pembayaran_k" id="jenis_pembayaran_k">
                        <option value="">== || ==</option>
                        <option value="Bayar Cash">Bayar Cash</option>
                        <option value="Credit">Kredit Card</option>
                        <option value="Debet">Debit Card</option>
                        <option value="Piutang">Terhutang</option>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label>Dokter</label>
                      <input type="text" class="form-control" placeholder="Nama Dokter ..." name="dokter_k" id="dokter_k" readonly>
                    </div>
                  </div>
                </div><!-- /.col -->

              </div><!-- /.row -->
            </div><!-- /.box-body -->
          </div>
        </div>
      </div>
    </div>
    </form>
    <div class="box-footer clearfix">
      <div class="clearfix pull-right">
        <button class="btn btn-danger btn-flat" id="btn_batal_simpan_pembayaran_k"><i class="fa fa-fw fa-remove"></i> Kembali</button>
        <button class="btn btn-danger btn-flat" id="btn_batal_pembayaran"><i class="fa fa-fw fa-remove"></i> Kembali</button>
        <button class="btn btn-danger btn-flat" id="btn_batal_pembayaran_k_urgen"><i class="fa fa-fw fa-remove"></i> Kembali</button>
        <button class="btn btn-success btn-flat" id="btn_simpan_bayar_karcis" name="btn_simpan_bayar_karcis" value="">
          <i class="fa fa-fw fa-save"></i> Simpan Bayar
        </button>
        <button class="btn btn-success btn-flat" id="btn_bayar_karcis" name="btn_bayar_karcis" value="">
          <i class="fa fa-fw fa-cc-discover"></i> Bayar
        </button>
        
        <div class="btn-group" id="grup_cetak_karcis">
          <button type="button" class="btn btn-primary btn-flat">
            <i class="fa fa-fw fa-print"></i> Cetak
          </button>
          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
          </button>
          <ul class="dropdown-menu" role="menu">
            <li><a id="btn_cetak_karcis" name="btn_cetak_karcis" value="">Cetak Umum</a></li>
            <li class="divider"></li>
            <li><a id="btn_cetak_karcis_bpjs" name="btn_cetak_karcis_bpjs" value="">Cetak BPJS</a></li>
            <li><a id="btn_cetak_uji_umum" name="btn_cetak_uji_umum" value="">tes cetak</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="content" id="list_tindakan_pasien">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
      <div class="box-header with-border">
      <h3 class="box-title">Data Tindakan Pasien</h3>
      <table class="table">
        <tr>
          <th>Nama Pasien</th>
          <th>:</th>
          <th id="nama_dan_jk_t"></th>
          <th>No RM / No Daftar</th>
          <th>:</th>
          <th id="norm_nodaftar_t"></th>
        </tr>
        <tr>
          <th>Alamat</th>
          <th>:</th>
          <th id="alamat_t"></th>
          <th>No. Telp</th>
          <th>:</th>
          <th id="no_telpon_t"></th>
        </tr>
        <tr>
          <th>Kepesertaan</th>
          <th>:</th>
          <th id="kepesetaan"></th>
          <!-- <th>No. Telp</th>
          <th>:</th>
          <th id="no_telpon_t"></th> -->
        </tr>
      </table>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
          <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
        </div>
       </div>
        <div class="box-body">
          <div class="nav-tabs-custom">
                <div class="tab-content no-padding">
                  <div class="chart tab-pane active" id="data_rincian_global" style="position: relative;">
                    Data Rincian Global
                    <input type="hidden" class="form-control" placeholder="status Input Tindakan ..." name="status_input_tindakan" id="status_input_tindakan" readonly>
                    <input type="hidden" class="form-control" placeholder="status Input Tindakan ..." name="tgl_input_tindakan" id="tgl_input_tindakan" readonly>
                    <table class="table" id="table_tindakan_global" width="100%">
                      <tr>
                        <th width="10%">NO</th>
                        <th width="30%">Nama Tindakan</th>
                        <th width="25%">Harga Satuan</th>
                        <th width="22%">Qty</th>
                        <th width="22%">cetak</th>
                        <th width="13%">Total</th>
                      </tr>
                      <tbody id="tbody_tindakan_global">
                        
                      </tbody>
                    </table>
                    <table class="table" id="table_obat_global" width="100%">
                      <tr>
                        <th width="10%">NO</th>
                        <th width="30%">Nama Obat</th>
                        <th width="25%">Harga Satuan</th>
                        <th width="22%">Qty</th>
                        <th width="22%">cetak</th>
                        <th width="13%">Total</th>
                      </tr>
                      <tbody id="tbody_obat_global"></tbody>
                    </table>
                    <table class="table" id="table_optik_global" width="100%">
                      <tr>
                        <th width="10%">NO</th>
                        <th width="30%">Nama Barang</th>
                        <th width="25%">Harga Satuan</th>
                        <th width="22%">Qty</th>
                        <th width="22%">cetak</th>
                        <th width="13%">Total</th>
                      </tr>
                      <tbody id="tbody_optik_global"></tbody>
                    </table>
                    <table class="table" id="table_sewa_mobil" width="100%">
                      <tr>
                        <th width="10%">NO</th>
                        <th width="67%" colspan="2">Tujuan</th>
                        <th width="22%">cetak</th>
                        <th width="13%" colspan="2">Nominal Sewa</th>
                      </tr>
                      <tbody id="tbody_sewa_mobil_global"></tbody>
                      <tbody id="tbody_grand_total"></tbody>
                    </table>
                  </div>
                </div>
              </div><!-- /.nav-tabs-custom -->
              <div class="box-footer no-padding">
                <strong>TTD Dokter</strong>
                <div class="form-group" id="list_dokter_ttd_tindakan">
                  <table class="table table-bordered" id="tabel_status_ttd_pasien_t">
                    <tr>
                      <th hidden>ID Dokter</th>
                      <th>Nama Dokter</th>
                      <th style="width: 150px">Status</th>
                    </tr>
                    <tbody id="tbd_tabel_status_ttd_pasien_t">
                      
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="clearfix pull-left">
                <button class="btn btn-danger btn-flat" id="btn_back_tindakan"><i class="fa fa-fw fa-arrow-left"></i> Kembali</button>
                <button class="btn btn-danger btn-flat" id="btn_back_tindakan_urgent"><i class="fa fa-fw fa-arrow-left"></i> Kembali</button>
              </div>
              <div class="clearfix pull-right">
                <button class="btn btn-default btn-flat" id="btn_masukkan_tindakan"><i class="fa fa-fw fa-plus"></i> Tindakan</button>
                <button class="btn btn-default btn-flat" id="btn_masukkan_resep"><i class="fa fa-fw fa-plus"></i> Resep</button>
                <button class="btn btn-default btn-flat" id="btn_masukkan_obat"><i class="fa fa-fw fa-plus"></i> Obat</button>
                <button class="btn btn-default btn-flat" id="btn_masukkan_optik"><i class="fa fa-fw fa-plus"></i> Optik</button>
                <button class="btn btn-default btn-flat" id="btn_masukkan_sewa_mobil"><i class="fa fa-fw fa-plus"></i> Sewa Mobil</button>
                <!-- <button class="btn btn-default btn-flat" id="btn_cetak_rincian"><i class="fa fa-fw fa-print"></i> Cetak Rincian</button> -->
                <div class="btn-group" id="grup_cetak_tindakan">
                  <button type="button" class="btn btn-default btn-flat">
                    <i class="fa fa-fw fa-print"></i> Cetak Rincian
                  </button>
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a id="btn_cetak_rincian_umum" name="btn_cetak_rincian_umum" value="">Cetak Rincian Umum</a></li>
                    <!-- <li class="divider"></li> -->
                    <li><a id="btn_cetak_rincian" name="btn_cetak_rincian" value="">Cetak Rincian BPJS</a></li>
                    <!-- <li class="divider"></li> -->
                    <!-- <li><a id="btn_cetak_rincian_manual_umum" name="btn_cetak_rincian_manual_umum" value="">Cetak Rincian Manual</a></li> -->
                    <li><a id="btn_cetak_rincian_total_sub" name="btn_cetak_rincian_total_sub" value="">Cetak Rincian Total Persub BPJS</a></li>
                  </ul>
                </div>
                <button class="btn btn-default btn-flat" id="btn_pembayaran_tindakan"><i class="fa fa-fw fa-credit-card"></i> Pembayaran</button>
                <button class="btn btn-default btn-flat" id="btn_cetak_resep"><i class="fa fa-fw fa-print"></i> Cetak Resep</button>
              </div>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->


<section class="content" id="pembayaran_tindakan_pasien">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
      <div class="box-header with-border">
      <h3 class="box-title">Form Pembayaran Tindakan</h3>
      <table class="table">
        <tr>
          <th>Nama Pasien</th>
          <th>:</th>
          <th id="nama_jk_bt"></th>
          <th>No RM / No Daftar</th>
          <th>:</th>
          <th id="norm_nodaftar_bt"></th>
        </tr>
        <tr>
          <th>Alamat</th>
          <th>:</th>
          <th id="alamat_bt"></th>
          <th>No. Telp</th>
          <th>:</th>
          <th id="no_telpon_bt"></th>
        </tr>
      </table>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
          <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <form method="post" class="form-user" id="form_bayar_tindakan">
        <div class="box-body">
          <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="col-md-6">
                      <label>Tanggal Pembayaran</label>
                      <input type="hidden" id="token_b_t" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="">
                      <input type="text" class="form-control" placeholder="Tanggal Pembayaran ..." name="tanggal_pembayaran" id="tanggal_pembayaran" readonly>
                    </div>
                    <div class="col-md-6">
                      <label>Jam Bayar</label>
                      <input type="text" class="form-control" placeholder="Jam Pembayaran ..." name="jam_pembayaran" id="jam_pembayaran" readonly>
                    </div>
                  </div>
                </div><!-- /.col -->

                <div class="col-md-12">
                  <div class="form-group">
                    <div class="col-md-6">
                      <label>Nama Pembayar</label>
                      <input type="hidden" class="form-control" placeholder="Norm Pembayar Tindakan ..." name="norm_bayar_tindakan" id="norm_bayar_tindakan" readonly>
                      <input type="hidden" class="form-control" placeholder="No Daftar Pembayar Tindakan ..." name="nodaftar_bayar_tindakan" id="nodaftar_bayar_tindakan" readonly>
                      <input type="text" class="form-control" placeholder="Nama Pembayar ..." name="nama_pembayar_tindakan" id="nama_pembayar_tindakan">
                    </div>
                    <div class="col-md-6">
                      <label>Diskon Tindakan</label>
                      <div id="harga_awal_bt" hidden></div>
                      <input type="number" class="form-control" placeholder="Diskon ..." name="diskon_bt" id="diskon_bt">
                      <input type="hidden" class="form-control" placeholder="Hasil Diskon ..." name="hasil_diskon_bt" id="hasil_diskon_bt" readonly>
                      <input type="hidden" class="form-control" placeholder="Biaya Operasi ..." name="biaya_operasi_bt" id="biaya_operasi_bt" readonly>
                      <input type="hidden" class="form-control" placeholder="ID Biaya Operasi ..." name="id_operasi_bt" id="id_operasi_bt" readonly>
                      <input type="hidden" class="form-control" placeholder="Tindakan Rawat Jalan ..." name="biaya_bukan_operasi_bt" id="biaya_bukan_operasi_bt" readonly>
                    </div>
                  </div>
                </div><!-- /.col -->

                <div class="col-md-12">
                  <div class="form-group">
                    <div class="col-md-6">
                      <label>Gatis Obat</label>
                      <div id="hrg_obt" hidden></div>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <input type="checkbox" id="checkbox_gratiskan_obat" name="checkbox_gratiskan_obat">
                        </span>
                        <input type="text" class="form-control" placeholder="Jumlah Tagihan ..." name="jumlah_tagihan_obat" id="jumlah_tagihan_obat" readonly>
                        <input type="hidden" class="form-control" placeholder="Jumlah Sewa ..." name="jumlah_sewa" id="jumlah_sewa" readonly>
                        <input type="hidden" class="form-control" placeholder="Jumlah Tagihan Optik ..." name="jumlah_hrg_optik" id="jumlah_hrg_optik" readonly>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <label>Jumlah Yang di Tagihkan</label>
                      <input type="text" class="form-control" placeholder="Jumlah Tagihan ..." name="jumlah_tagihan" id="jumlah_tagihan" readonly>
                    </div>
                  </div>
                </div><!-- /.col -->

                <div class="col-md-12">
                  <div class="form-group">
                  <div class="col-md-6">
                      <label>Jumlah Yang Dibayar</label>
                      <input type="text" class="form-control" placeholder="Jumlah Yang di Bayar ..." name="jumlah_yang_dibayar" id="jumlah_yang_dibayar">
                    </div>
                    <div class="col-md-6">
                      <label>Kembali</label>
                      <input type="text" class="form-control" placeholder="Uang kembalian ..." name="uang_kembalian" id="uang_kembalian" readonly>
                    </div>
                  </div>
                </div><!-- /.col -->

                <div class="col-md-12">
                  <div class="form-group">
                    <div class="col-md-6">
                      <label>Jenis Pembayaran</label>
                      <select class="form-control" name="jenis_pembayaran" id="jenis_pembayaran">
                        <option value="">== || ==</option>
                        <option value="Bayar Cash">Bayar Cash</option>
                        <option value="Credit">Kredit Card</option>
                        <option value="Debet">Debit Card</option>
                        <option value="Piutang">Terhutang</option>
                      </select>
                    </div>
                  </div>
                </div><!-- /.col -->
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="col-md-6">
                      <label>Status Pembayaran</label>
                      <select class="form-control" name="status_pembayaran" id="status_pembayaran">
                        <option value="">== || ==</option>
                        <option value="Proses">Proses</option>
                        <option value="Lunas">Lunas</option>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label>Dokter</label>
                      <input type="text" class="form-control" placeholder="Nama Dokter ..." name="id_dokter_bt" id="id_dokter_bt">
                      <input type="text" class="form-control" placeholder="Nama Dokter ..." name="dokter_bt" id="dokter_bt">
                    </div>
                  </div>
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.box-body -->
            <div class="clearfix pull-right">
              <button type="button" class="btn btn-danger btn-flat" id="btn_batal_pembayaran_tindakan"><i class="fa fa-fw fa-remove"></i> Kembali</button>
              <button type="button" class="btn btn-success btn-flat" id="btn_bayar_tindakan" name="btn_bayar_tindakan" value="">
                <i class="fa fa-fw fa-cc-discover"></i> Bayar
              </button>
              <div class="btn-group" id="grup_cetak_tindakan">
                <button type="button" class="btn btn-primary btn-flat">
                  <i class="fa fa-fw fa-print"></i> Cetak
                </button>
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                  <span class="caret"></span>
                  <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                  <li><a id="btn_cetak_kwitansi" name="btn_cetak_kwitansi" value="">Cetak Umum</a></li>
                  <li class="divider"></li>
                  <li><a id="btn_cetak_kwitansi_bpjs" name="btn_cetak_kwitansi_bpjs" value="">Cetak BPJS</a></li>
                  <li><a id="btn_cetak_uji_kwitansi_umum" name="btn_cetak_uji_kwitansi_umum" value="">tes umum</a></li>
                </ul>
              </div>
            </div>
        </div><!-- /.box-body -->
        </form>
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->

<!-- sewa -->
<section class="content" id="input_sewa_kendaraan">
  <div class="box box-danger">
    <div class="box-header">
      <h3 class="box-title" id="judul_input_sewa">Input Sewa</h3>
    </div>
    <form method="post" name="form_input_sewa" id="form_input_sewa" action="">
    <div class="box-body">
      <div class="col-md-12">
        <input type="hidden" class="form-control" placeholder="ID semua Proses Tindakan ..." name="id_sewa" id="id_sewa" readonly>
        <input type="hidden" class="form-control" placeholder="Ndaftar semua Proses Tindakan ..." name="nodaftar_sewa" id="nodaftar_sewa" readonly>
        <input type="hidden" class="form-control" placeholder="Norm semua Proses Tindakan ..." name="norm_sewa" id="norm_sewa" readonly>
        <div class="form-group" id="">
          <label>List Harga</label>
          <select class="form-control" style="width: 100%;" name="list_sewa" id="list_sewa">
          </select>
        </div><!-- /.form-group -->
      </div><!-- /.col -->      
      <div class="col-md-12">
        <div class="form-group" id="nama_sewa_mobil">
          <label>Lokasi Tujuan</label>
          <input type="text" class="form-control" placeholder="Lokasi Tujuan ..." name="lokasi_tujuan" id="lokasi_tujuan">
        </div><!-- /.form-group -->
        <div class="form-group" id="">
          <label>Jumlah Harga</label>
          <input type="text" class="form-control" placeholder="Total Harga ..." name="jumlah_harga" id="jumlah_harga">
        </div><!-- /.form-group -->
      </div><!-- /.col -->      
      <div class="col-md-12">
        <div class="form-group">
          <div class="col-md-6">
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <div class="clearfix pull-right">
            <button type="button" class="btn btn-danger btn-flat" id="btn_batal_sewa"><i class="fa fa-fw fa-remove"></i> Batal</button>
            <button type="button" class="btn btn-success btn-flat" id="btn_simpan_sewa_mobil" name="btn_simpan_sewa_mobil" value="">
              <i class="fa fa-fw fa-save"></i> Simpan
            </button> 
          </div>
        </div>
      </div>
      </form>
      <div class="col-md-12">
        <div class="form-group">
          <table class="table table-bordered" id="tbl_sewa_mobil">
            <tr>
              <th style="width: 5px">No</th>
              <th style="width: 5px">ID Sewa</th>
              <th style="width: 5px">ID Tarif Sewa</th>
              <th style="width: 40px">Tujuan</th>
              <th style="width: 40px">Nominal Sewa</th>
              <th style="width: 40px">Aksi</th>
            </tr>
            <tbody id="list_sewa_mobil">
              
            </tbody>
          </table>
        </div>
      </div>
    </div><!-- /.box-body -->
  </div><!-- /.box -->
</section>
<section class="content" id="input_tindakan_dan_obat">
  <div class="box box-danger">
    <div class="box-header">
      <h3 class="box-title" id="judul_input_tindakan">Input Tindakan</h3>
      <h3 class="box-title" id="judul_input_obat">Input Obat</h3>
    </div>
    <form method="post" name="form_input_semua_tindakan" id="form_input_semua_tindakan" action="">
    <div class="box-body">
      <div class="col-md-12">
        <input type="hidden" id="token_s" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="">
        <input type="hidden" class="form-control" placeholder="ID semua Proses Tindakan ..." name="id_proses_tindakan" id="id_proses_tindakan" readonly>
        <input type="hidden" class="form-control" placeholder="Ndaftar semua Proses Tindakan ..." name="nodaftar_proses_tindakan" id="nodaftar_proses_tindakan" readonly>
        <input type="hidden" class="form-control" placeholder="Norm semua Proses Tindakan ..." name="norm_proses_tindakan" id="norm_proses_tindakan" readonly>
        <div class="form-group" id="daftar_input_tindakan">
          <label>Tindakan</label>
          <select class="form-control select2" style="width: 100%;" name="idtindakan" id="idtindakan">
            <option selected="selected">- || -</option>
          </select>
          <input type="hidden" class="form-control" placeholder=" ..." name="id_tarif_tindakan_op" id="id_tarif_tindakan_op" readonly>
          <input type="hidden" class="form-control" placeholder="..." name="biaya_tarif_tindakan_op" id="biaya_tarif_tindakan_op" readonly>
        </div><!-- /.form-group -->
        <div class="form-group" id="dp_harga_tindakan">
          <label>Centang Jika Pembayaran Operasi DP</label>
          <input type="checkbox" id="checklist_dp_harga_tindakan" name="checklist_dp_harga_tindakan" value="0">
          <input type="text" class="form-control" placeholder=" ..." name="nominal_dp_tindakan_palsu" id="nominal_dp_tindakan_palsu">
          <input type="hidden" class="form-control" placeholder=" ..." name="nominal_dp_tindakan" id="nominal_dp_tindakan">
        </div><!-- /.form-group -->
        <div class="form-group" id="daftar_input_obat">
          <label>Obat</label>
          <select class="form-control select2" style="width: 100%;" name="idobat" id="idobat">
            
          </select>
        </div><!-- /.form-group -->
      </div><!-- /.col -->      
      <div class="col-md-12">
        <div class="form-group" id="daftar_input_tindakan">
          <label>Qty</label>
          <input type="number" class="form-control" placeholder="Quantity ..." name="qty" id="qty">
          <!-- <input type="text" class="form-control" placeholder="Total Biaya ..." name="biaya_input_tindakan" id="biaya_input_tindakan"> -->
        </div><!-- /.form-group -->
        <div class="form-group" id="dokter_tindakan">
            <label>Pilih Dokter</label>
            <!-- <input type="text" class="form-control" name="id_dokter_input_tindakan" id="id_dokter_input_tindakan"> -->
            <select class="form-control select2" style="width: 100%;" name="id_dokter_input_tindakan" id="id_dokter_input_tindakan">
            </select>
            <!-- <option selected="selected">- || -</option> -->
        </div><!-- /.form-group -->
      </div><!-- /.col -->      
      <div class="col-md-12">
        <div class="form-group">
          <label>Keterangan</label>
          <textarea class="form-control" placeholder="Keterangan ..." name="Keterangan" id="Keterangan"></textarea>
        </div>
        <div class="form-group">
          <div  id="ceklist_pegawai">
            <input type="checkbox" id="cheklist_obat_pegawai" name="cheklist_obat_pegawai" value="1">
            Checklist Jika Pembeli Adalah Pegawai
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <div class="clearfix pull-right">
            <button type="button" class="btn btn-danger btn-flat" id="btn_batal_tindakan"><i class="fa fa-fw fa-remove"></i> Batal</button>
            <button type="button" class="btn btn-success btn-flat" id="btn_simpan_tindakan_obat" name="btn_simpan_tindakan_obat" value="">
              <i class="fa fa-fw fa-save"></i> Simpan
            </button> 
            <button type="button" class="btn btn-success btn-flat" id="btn_simpan_tindakan_pelayanan" name="btn_simpan_tindakan_pelayanan" value="">
              <i class="fa fa-fw fa-save"></i> Simpan
            </button> 
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <table class="table table-bordered" id="tbl_input_obat_baru">
            <tr>
              <th style="width: 5px">No</th>
              <th style="width: 40px">Tanggal</th>
              <th style="width: 40px">Nama Obat</th>
              <th style="width: 40px">Keterangan</th>
              <th style="width: 40px">Jumlah</th>
              <th style="width: 40px">Harga</th>
              <th style="width: 40px">Aksi</th>
            </tr>
            <tbody id="list_obata_pesanan_pasien">
              
            </tbody>
          </table>
        </div>
      </div>
      </form>
      <div class="col-md-12">
        <div class="form-group">
          <table class="table table-bordered" id="tbl_input_tindakan_baru">
            <tr>
              <th style="width: 5px">No</th>
              <th style="width: 40px">Tanggal</th>
              <th style="width: 40px">Nama Tindakan</th>
              <th style="width: 40px">Keterangan</th>
              <th style="width: 40px">Jumlah</th>
              <th style="width: 40px">Harga</th>
              <th style="width: 40px">Aksi</th>
            </tr>
            <tbody id="list_daftar_tindakan_pasien"></tbody>
          </table>
        </div>
      </div>
    </div><!-- /.box-body -->
  </div><!-- /.box -->
</section>
<!-- resep -->
<section class="content" id="input_resep_obat">
  <div class="box box-danger">
    <div class="box-header">
      <h3 class="box-title">Input Resep</h3>
    </div>
    <div class="box-body">
      <form method="post" name="form_input_resep" id="form_input_resep" action="">
      <div class="col-md-12">
        <input type="hidden" class="form-control" placeholder="ID semua Proses Tindakan ..." name="id_resep" id="id_resep" readonly>
        <input type="hidden" class="form-control" placeholder="Ndaftar Resep ..." name="nodaftar_resep" id="nodaftar_resep" readonly>
        <input type="hidden" class="form-control" placeholder="Norm Resep ..." name="norm_resep" id="norm_resep" readonly>
        <div class="form-group" id="daftar_resep">
          <label>Obat</label>
          <select class="form-control select2" style="width: 100%;" name="idresep" id="idresep">
            
          </select>
        </div><!-- /.form-group -->
      </div><!-- /.col -->      
      <div class="col-md-12">
        <div class="form-group" id="daftar_input_tindakan">
          <label>Qty</label>
          <input type="number" class="form-control" placeholder="Quantity ..." name="qty_resep" id="qty_resep">
          <!-- <input type="text" class="form-control" placeholder="Total Biaya ..." name="biaya_input_tindakan" id="biaya_input_tindakan"> -->
        </div><!-- /.form-group -->
        <div class="form-group" id="daftar_input_obat">
          <label>Keterangan</label>
          <textarea class="form-control" placeholder="Keterangan ..." name="Keterangan" id="Keterangan"></textarea>
        </div><!-- /.form-group -->
      </div><!-- /.col -->
      <div class="col-md-12">
        <div class="form-group">
          <div class="clearfix pull-right">
            <button type="button" class="btn btn-danger btn-flat" id="btn_batal_resep"><i class="fa fa-fw fa-remove"></i> Batal</button>
            <button type="button" class="btn btn-success btn-flat" id="btn_simpan_resep" name="btn_simpan_resep" value="">
              <i class="fa fa-fw fa-save"></i> Simpan
            </button>
          </div>
        </div>
      </div>
      </form>
      <div class="col-md-12">
        <div class="form-group">
          <table class="table table-bordered" id="tbl_input_resep_baru">
            <tr>
              <th style="width: 5px">No</th>
              <th style="width: 40px" hidden>Id Stok</th>
              <th style="width: 40px">Tanggal</th>
              <th style="width: 40px">Nama Obat</th>
              <th style="width: 40px">Jumlah</th>
              <th style="width: 40px" hidden>Harga</th>
              <th style="width: 40px">Harga</th>
              <th style="width: 40px">Aksi</th>
            </tr>
            <tbody id="list_resep_pesanan_pasien">
              
            </tbody>
          </table>
        </div>
      </div>
    </div><!-- /.box-body -->
  </div><!-- /.box -->
</section>
<!-- resep -->
<!-- sewa -->
<!-- optik -->
<section class="content" id="form_penjualan_optik">
  <form method="post" class="form-user" id="form_pengeluaran_optik">
    <div class="box box-default">
      <div class="box-header with-border">
        <h3 class="box-title">Form Penjualan Optik Hari Ini</h3>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
        </div>
      </div><!-- /.box-header -->
      <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <div class="col-md-6">
                <input type="hidden" class="form-control" name="id_optik" id="id_optik" placeholder="ID Optik ..." readonly>
                <input type="hidden" class="form-control" name="nodaftar_optik" id="nodaftar_optik" placeholder="Nodaftar ..." readonly>
                <input type="hidden" class="form-control" name="norm_optik" id="norm_optik" placeholder="Norm ..." readonly>
                <label>Nama Barang</label>
                <input type="text" class="form-control" name="nama_barang_optik" id="nama_barang_optik" placeholder="Nama Barang ...">
                <!-- <select class="form-control select2" style="width: 100%;" name="id_stok_optik" id="id_stok_optik">
                  <option value="" selected="selected">== || ==</option>
                </select>
                <input type="hidden" class="form-control" name="id_stok_optik2" id="id_stok_optik2" placeholder="id stok optik ..." readonly> -->
              </div>
              <div class="col-md-6">
                <label>Frame</label>
                <input type="text" class="form-control" name="nama_frame" id="nama_frame" placeholder="Nama Frame ..." >
              </div>
            </div>
          </div><!-- /.col -->
          <div class="col-md-12">
            <div class="form-group">
              <div class="col-md-6">
                <label>Lensa</label>
                <input type="text" class="form-control" name="nama_lensa" id="nama_lensa" placeholder="Nama Lensa ..." >
              </div>
              <div class="col-md-6">
                <label>Quantity</label>
                <input type="number" class="form-control" name="qty_obat_optik" id="qty_obat_optik" placeholder="Quantity ..." >
              </div>
            </div>
          </div><!-- /.col -->
          <div class="col-md-12">
            <div class="form-group">
              <div class="col-md-6">
                <label>Status Pemesanan</label>
                <br>
                <input type="checkbox" name="status_bayar_dp" id="status_bayar_dp"> Checklist Jika Pembayaran DP<br>
                <input type="checkbox" name="status_bayar_lunas" id="status_bayar_lunas"> Checklist Jika Pembayaran Pelunasan
              </div>
              <div class="col-md-6">
                <label>Keterangan</label>
                <textarea class="form-control" name="Keterangan_jual_optik" id="Keterangan_jual_optik" placeholder="Keterangan ..."></textarea>
              </div>
            </div>
          </div><!-- /.col -->
          <div class="col-md-12">
            <div class="form-group">
              <div class="col-md-6">
                <label>Harga Satuan</label>
                <input type="text" class="form-control" name="harga_satuan_optik" id="harga_satuan_optik" placeholder="Harga Satuan ...">
              </div>
              <div class="col-md-6">
                <label>Jumlah Harga</label>
                <input type="text" class="form-control" name="jumlah_total_optik" id="jumlah_total_optik" placeholder="Jumlah Total Harga ..." readonly>
              </div>
            </div>
          </div><!-- /.col -->
          <div class="col-md-12">
            <div class="form-group">
              <div class="col-md-6" id="tanggal_pelunasan">
                <label>Tanggal Hutang</label>
                <input type="date" class="form-control" name="tanggal_hutang" id="tanggal_hutang" placeholder="Tanggal ...">
              </div>
              <div class="col-md-6">
                
              </div>
            </div>
          </div><!-- /.col -->
        </div>
      </div>
      <div class="box-footer">
        <div class="form-group">
          <div class="clearfix pull-right">
            <button type="button" class="btn btn-danger btn-flat" id="btn_batal_gunakan_optik"><i class="fa fa-fw fa-remove"></i> Batal</button>
            <button type="button" class="btn btn-success btn-flat" id="btn_simpan_gunakan_optik" name="btn_simpan_gunakan_optik" value="">
                <i class="fa fa-fw fa-save"></i> Simpan
            </button>
          </div>
        </div>
      <center>
        <div class="box-body" style="width:100%;">
            <table class="table table-bordered" id="tbl_daftar_penjualan_optik">
              <tr>
                <th>No</th>
                <th>Nama Optik</th>
                <th hidden>Nama Frame</th>
                <th hidden>Nama Lensa</th>
                <th>Harga Jual</th>
                <th>Qty</th>
                <th>Jumlah Harga</th>
                <th>Tanggal Penjualan</th>
                <th hidden>status bayar</th>
                <th hidden>tgl bayar</th>
                <th hidden>Keterangan</th>
                <th>Aksi</th>
              </tr>
              <tbody id="tbody_tbl_daftar_penjualan_optik"></tbody>
            </table>
          </div>
        </center>
      </div>
    </div>
  </form>
</section>
<!-- optik -->

<section class="content" id="form_retur_penjualan_obat">
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Form Riwayat Pasien</h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div><!-- /.box-header -->
    <div class="box-body">
      <div class="table-responsive">
      <div class="row">
      <form method="post" class="form-user" id="form_retur">
        <center>
          <div class="box-body" style="width:100%;">
          <table class="table">
            <tr>
              <th>Nama Pasien</th>
              <th>:</th>
              <th id="nama_jk_r">-</th>
              <th>No RM / No Daftar</th>
              <th>:</th>
              <th id="norm_nodaftar_r">-</th>
            </tr>
            <tr>
              <th>Alamat</th>
              <th>:</th>
              <th id="alamat_r">-</th>
              <th>No. Telp</th>
              <th>:</th>
              <th id="notelpon_r">-</th>
            </tr>
          </table>
          <br>
              <table class="table table-bordered" id="tbl_riwayat_terapi_pasien">
                <tr>
                  <th>No</th>
                  <th>Nama Tindakan</th>
                  <th>Harga Satuan</th>
                  <th>Qty</th>
                  <th>Total</th>
                  <th> </th>
                </tr>
                <tbody id="tbody_tbl_riwayat_terapi_pasien">
                  <tr>
                    <td>1</td>
                    <td>nm tindakan</td>
                    <td>hrga satuan</td>
                    <td>qty</td>
                    <td>total</td>
                    <td> </td>
                  </tr>
                </tbody>
              </table>
            </div>
        </center>
        <div class="col-md-12" id="form_retur_terapi">
          <div class="form-group">
            <div class="col-md-6">
              <label>Nama Obat</label>
              <input type="hidden" class="form-control" name="id_stok_retur" id="id_stok_retur" placeholder="Id Stok ..." readonly>
              <input type="hidden" class="form-control" name="id_penjualan" id="id_penjualan" placeholder="Id Penjualan ..." readonly>
              <input type="hidden" class="form-control" name="jenis_retur" id="jenis_retur" placeholder="Jenis Retur ..." readonly>
              <input type="text" class="form-control" name="nm_obat_retur" id="nm_obat_retur" placeholder="Nama Obat ..." readonly>
            </div>
            <div class="col-md-6">
              <label>Quantity</label>
              <input type="hidden" class="form-control" name="qty_retur_awal" id="qty_retur_awal" placeholder="Quantity ..." readonly>
              <input type="text" class="form-control" name="qty_retur" id="qty_retur" placeholder="Quantity ...">
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-6">
              <label>Keterangan</label>
              <textarea class="form-control" name="Keterangan_retur" id="Keterangan_retur" placeholder="Keterangan Retur ..."></textarea>
            </div>
            <div class="col-md-6">
              
            </div>
          </div>
        </div><!-- /.col -->
        </form>
      </div>
    </div>
    </div>
    
    <!-- bayar -->
<div class="col-md-12" id="pasien_belum_bayar">
  <form method="post" class="form-user" id="form_pasien_belum_lunas">
    <div class="box-body">
      <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <div class="col-md-6">
                  <label>Tanggal Pembayaran</label>
                  <input type="text" class="form-control" placeholder="" name="tgl_bayar_hutang" id="tgl_bayar_hutang" readonly>
                </div>
                <div class="col-md-6">
                  <label>Jam Bayar</label>
                  <input type="text" class="form-control" placeholder="" name="jam_bayar_hutang" id="jam_bayar_hutang" readonly>
                </div>
              </div>
            </div><!-- /.col -->

            <div class="col-md-12">
              <div class="form-group">
                <div class="col-md-6">
                  <label>Nama Pembayar</label>
                  <input type="" class="form-control" placeholder="" name="norm_bayar_utang" id="norm_bayar_utang" readonly>
                  <input type="" class="form-control" placeholder="" name="nodaftar_bayar_utang" id="nodaftar_bayar_utang" readonly>
                  <input type="text" class="form-control" placeholder="" name="nama_pembayar_utang" id="nama_pembayar_utang">
                </div>
                <div class="col-md-6">
                  <label>Diskon Tindakan</label>
                  <div id="harga_awal_utang" ></div>
                  <input type="number" class="form-control" placeholder="Diskon ..." name="diskon_utang" id="diskon_utang">
                  <input type="" class="form-control" placeholder="Hasil Diskon ..." name="hasil_diskon_utang" id="hasil_diskon_utang" readonly>
                  <input type="" class="form-control" placeholder="BiayaOperasi..." name="biaya_operasi_utang" id="biaya_operasi_utang" readonly>
                  <input type="" class="form-control" placeholder="ID Biaya Operasi ..." name="id_operasi_utang" id="id_operasi_utang" readonly>
                  <input type="" class="form-control" placeholder="RawatJalan" name="biaya_bukan_operasi_utang" id="biaya_bukan_operasi_bt" readonly>
                </div>
              </div>
            </div><!-- /.col -->

            <div class="col-md-12">
              <div class="form-group">
                <div class="col-md-6">
                  <label>Gatis Obat</label>
                  <div id="hrg_obt_utang" ></div>
                  <div class="input-group">
                    <span class="input-group-addon">
                      <input type="checkbox" id="gratiskan_obat_utang" name="gratiskan_obat_utang">
                    </span>
                    <input type="text" class="form-control" placeholder="Jumlah Tagihan ..." name="jumlah_tagihan_obat" id="jumlah_tagihan_obat" readonly>
                    <input type="" class="form-control" placeholder="Sewa" name="jumlah_sewa_utang" id="jumlah_sewa_utang" readonly>
                    <input type="" class="form-control" placeholder="Tagihan Optik" name="hrg_optik_utang" id="hrg_optik_utang" readonly>
                  </div>
                </div>
                <div class="col-md-6">
                  <label>Jumlah Yang di Tagihkan</label>
                  <input type="text" class="form-control" placeholder="Jumlah Tagihan ..." name="tagihan_utang" id="tagihan_utang" readonly>
                </div>
              </div>
            </div><!-- /.col -->

            <div class="col-md-12">
              <div class="form-group">
              <div class="col-md-6">
                  <label>Jumlah Yang Dibayar</label>
                  <input type="text" class="form-control" placeholder="Jumlah Yang di Bayar ..." name="jumlah_bayar_utang" id="jumlah_bayar_utang">
                </div>
                <div class="col-md-6">
                  <label>Kembali</label>
                  <input type="text" class="form-control" placeholder="Uang kembalian" name="kembalian_utang" id="kembalian_utang" readonly>
                </div>
              </div>
            </div><!-- /.col -->

            <div class="col-md-12">
              <div class="form-group">
                <div class="col-md-6">
                  <label>Jenis Pembayaran</label>
                  <select class="form-control select2" style="width: 100%;" name="jenis_pembayaran_utang" id="jenis_pembayaran_utang">
                    <option value="Bayar Cash">Bayar Cash</option>
                    <option value="Credit">Kredit Card</option>
                    <option value="Debet">Debit Card</option>
                    <option value="Piutang">Terhutang</option>
                  </select>
                </div>
              </div>
            </div><!-- /.col -->
            <div class="col-md-12">
              <div class="form-group">
                <div class="col-md-6">
                  <label>Status Pembayaran</label>
                  <select class="form-control select2" style="width: 100%;" name="status_pembayaran_utang" id="status_pembayaran_utang">
                    <option value="Proses">Proses</option>
                    <option value="Lunas">Lunas</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label>Dokter</label>
                  <input type="text" class="form-control" placeholder="Nama Dokter ..." name="id_dokter_utang" id="id_dokter_utang">
                  <input type="text" class="form-control" placeholder="Nama Dokter ..." name="dokter_utang" id="dokter_utang">
                </div>
              </div>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.box-body -->
        <div class="clearfix pull-right">
          <button type="button" class="btn btn-danger btn-flat" id="batal_bayar_utang"><i class="fa fa-fw fa-remove"></i> Kembali</button>
          <button type="button" class="btn btn-success btn-flat" id="btn_bayar_utang" name="btn_bayar_utang" value="">
            <i class="fa fa-fw fa-cc-discover"></i> Bayar
          </button>
          <div class="btn-group" id="grup_cetak_utang">
            <button type="button" class="btn btn-primary btn-flat">
              <i class="fa fa-fw fa-print"></i> Cetak
            </button>
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
              <span class="caret"></span>
              <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu">
              <li><a id="btn_cetak_kwitansi_riwayat" name="btn_cetak_kwitansi_riwayat" value="">Cetak Umum</a></li>
              <li class="divider"></li>
              <li><a id="btn_cetak_kwitansi_bpjs_riwayat" name="btn_cetak_kwitansi_bpjs_riwayat" value="">Cetak BPJS</a></li>
            </ul>
          </div>
        </div>
    </div><!-- /.box-body -->
  </form>
</div>
<!-- bayar -->
    <div class="box-footer" id="footer_terapi">
      <div class="form-group">
        <div class="clearfix pull-right">
          <button type="button" class="btn btn-danger btn-flat" id="btn_batal_retur"><i class="fa fa-fw fa-remove"></i> Kembali</button>
          <button type="button" class="btn btn-success btn-flat" id="btn_simpan_retur" name="btn_simpan_retur" value="">
              <i class="fa fa-fw fa-save"></i> Simpan
          </button> 
          <button class="btn btn-warning btn-flat" id="btn_karcis_urgen"><i class="fa fa-fw fa-plus"></i> Karcis Urgen</button>
          <button class="btn btn-warning btn-flat" id="btn_tindakan_urgen"><i class="fa fa-fw fa-plus"></i> Tindakan Urgen</button>
        </div>
        </div>
    </div>
  </div>
</section>
<div id="get_user"></div>
<div id="get_data_pendaftar_hari_ini"></div>
<!-- modal perubahan golongan pasien -->
<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default" id="modal_kode_golongan">
  Launch Default Modal
</button>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Form Perubahan Golongan Pasien atas Nama : <b id="nm_pasien_kd_gol"></b></h4>
      </div>
      <form action="<?php echo base_url().'index.php/dashboard/update_kd_golongan'; ?>" method="post">
      <div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="form-control-label">Nama Golongan:</label>
            <input type="hidden" class="form-control" id="csrf_klinik_mata_edc" name="csrf_klinik_mata_edc" placeholder="csrf" required readonly>
            <input type="hidden" class="form-control" id="norm_perubahan_golongan" name="norm_perubahan_golongan" placeholder="Norm" required readonly>
            <input type="hidden" class="form-control" id="nodaftar_perubahan_golongan" name="nodaftar_perubahan_golongan" placeholder="No Daftar" required readonly>
            <select class="required form-control" id="kode_golongan_baru" name="kode_golongan_baru" required>
              <option value=""> ==||== </option>
              <option value="UMUM">UMUM</option>
              <option value="BPJS">BPJS</option>
              <option value="GRATIS">GRATIS</option>
              <option value="MNC">MNC</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message-text" class="form-control-label">Alasan Perubahan:</label>
            <textarea class="form-control" id="keterangan_perubahan" name="keterangan_perubahan" required></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" id="simpan_perubahan_kd_gol">Simpan</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- modal perubahan golongan pasien -->
<!-- modal perubahan detail pasien -->
<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-detail_pasien" id="modal_detail_pasien">
  Launch Default Modal
</button>
<div class="modal fade" id="modal-detail_pasien">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Form Perubahan Detail Pasien atas Nama : <b id="nm_pasien_detail"></b></h4>
      </div>
      <form action="<?php echo base_url().'index.php/dashboard/update_detail_pasien'; ?>" method="post">
      <div class="modal-body">
        <div class="form-group">
          <label for="recipient-name" class="form-control-label">NIK Pasien</label>
          <input type="text" maxlength="16" class="form-control" placeholder="Nik Pasien ..." name="nik_pasien_detail" id="nik_pasien_detail" required>
        </div>
        <div class="form-group">
          <label for="recipient-name" class="form-control-label">Nama</label>
          <input type="hidden" class="form-control" id="csrf_klinik_mata_edc_detail" name="csrf_klinik_mata_edc" placeholder="csrf" required readonly>
          <input type="hidden" class="form-control" placeholder="Norm ..." name="norm_pasien_detail" id="norm_pasien_detail" required readonly>
          <input type="text" class="form-control" placeholder="Nama ..." name="nama_pasien_detail" id="nama_pasien_detail" required>
          <label for="recipient-name" class="form-control-label">Jenis Kelamin</label>
          <select class="form-control" style="width: 100%;" name="jk_detail" id="jk_detail" required>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
          </select>
        </div>
        <div class="form-group">
          <label for="recipient-name" class="form-control-label">Tempat / tgl Lahir</label>
          <div class="form-group">
            <div class="col-xs-6">
              <input type="text" class="form-control" placeholder="tempat ..." name="tempat_lahir_detail" id="tempat_lahir_detail" required>
            </div>
            <div class="col-xs-6">
              <input type="date" class="form-control" placeholder="Tanggal Lahir ..." name="tgl_lahir_detail" id="tgl_lahir_detail" required>
            </div>
          </div>
          <label for="recipient-name" class="form-control-label">Pekerjaan</label>
          <select class="form-control" style="width: 100%;" name="pekerjaan_detail" id="pekerjaan_detail" required>
            <option value="Pekerjaan Swasta">Pekerjaan Swasta</option>
            <option value="Ibu Rumah Tangga">Ibu Rumah Tangga</option>
            <option value="PNS/TNI/POLRI">PNS/TNI/POLRI</option>
            <option value="Wiraswasta">Wiraswasta</option>
            <option value="Pelajar">Pelajar</option>
            <option value="Petani">Petani</option>
            <option value="Buruh">Buruh</option>
          </select>
        </div>
        <div class="form-group">
          <label for="recipient-name" class="form-control-label">Alamat</label>
          <input type="text" class="form-control" placeholder="Alamat ..." name="alamat_detail" id="alamat_detail" required>
          <label for="recipient-name" class="form-control-label">No. Telp</label>
          <input type="text" class="form-control" placeholder="No Telp ..." name="no_telp_detail" id="no_telp_detail" required>
          <label for="recipient-name" class="form-control-label">No. KPST</label>
          <input type="text" class="form-control" placeholder="No KPST ..." name="no_kpst_detail" id="no_kpst_detail">
          <label for="recipient-name" class="form-control-label">No. RM Lama</label>
          <input type="text" class="form-control" placeholder="Isi Dengan Norm lama jika penginputan SEP dengan NORM baru Gagal ..." name="no_rm_lama" id="no_rm_lama">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" id="simpan_perubahan_detail">Simpan</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- modal perubahan detail pasien -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="<?=base_url('assets/_controller/administration.js')?>"></script>
