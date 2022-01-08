<section class="content-header">
    <h1>
        Surat Eligibilitas Peserta
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> SEP</a></li>
        <li class="active">Home</li>
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
                <th>No Rujukan</th>
                <th>No Kartu</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody id="daftar_pasien_bpjs_hari_ini">
              
            </tbody>
            <tfoot>
              <tr>
                <th width="10%">No.</th>
                <th>Tgl Daftar</th>
                <th>No RM</th>
                <th hidden>No RM</th>
                <th>No Daftar</th>
                <th hidden>No Daftar</th>
                <th>Nama Pasien</th>
                <th>JK</th>
                <th>No Rujukan</th>
                <th>No Kartu</th>
                <!-- <th hidden>Id Dokter</th>
                <th hidden>No Telfon</th>
                <th hidden>Pekerjaan</th>
                <th hidden>Tempat Lahir</th>
                <th hidden>Tanggal lahir</th> -->
                <th>Aksi</th>
              </tr>
            </tfoot>
          </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="content" id="layout_form_cari_norujukan_masuk">
    <input type="" id="txturl" value="https://vclaim.bpjs-kesehatan.go.id/VClaim">
    <input type="" id="txtnmprovider" value="KLINIK MATA MOJOAGUNG">
    <input type="" id="txtid" value="0197S001">
    <input type="" id="txtpks" value="1">
    <input type="" id="txtidApprove">
    <input type="" id="txtflaglibur">
    <input type="" id="txtketlibur">
    <input type="" id="txtfp" value="0">
    <input type="" id="txttipe" value="0">
    <div class="row">
        <div class="col-md-12">
            <div id="divHeader">
                <div class="box box-success">

                    <div class="box-header with-border">
                        <div class="pull-right col-md-3 col-sm-3 col-xs-12">
                            <div class="input-group">
                                <input type="text" class="form-control" id="txtNoSepCari" placeholder="ketik nomor sep" maxlength="19">
                                <span class="input-group-btn">
                                    <button type="button" id="btnCariNoSEP" class="btn btn-info">
                                        Cari SEP
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>

                    <form class="form-horizontal" id="form_rujukan">
                        <div class="box-body">
                            <div class="form-group" id="div_rdpilih">
                                <label class="col-md-2 col-sm-2 col-xs-12 control-label">Pilih</label>
                                <div class="col-md-5 col-sm-5 col-xs-12">
                                    <label>
                                        <input type="radio" name="rdpilih" id="rbcarirujukan" value="2" checked="">
                                        Rujukan
                                    </label>&nbsp;
                                    <label>
                                        <input type="radio" name="rdpilih" id="rbcarikartu" value="0">
                                        Rujukan Manual/IGD
                                    </label>&nbsp;
                                </div>
                            </div>
                            <div id="divCariRujukan">
                                <div class="form-group">
                                    <label class="col-md-2 col-sm-2 col-xs-12 control-label"><label style="color:gray;font-size:x-small">(yyyy-mm-dd)</label> Tgl.Sep</label>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="input-group date">
                                            <input type="date" class="form-control datepicker" id="txtTanggal_0" placeholder="yyyy-MM-dd" maxlength="10">
                                            <span class="input-group-addon">
                                                <span class="fa fa-calendar">
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 col-sm-2 col-xs-12 control-label">Asal Rujukan</label>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <select class="form-control" id="cbasalrujukan_0" name="cbasalrujukan_0">
                                            <option value="1">Faskes Tingkat 1</option>
                                            <option value="2">Faskes Tingkat 2</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 col-sm-2 col-xs-12 control-label">No.Rujukan</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="txtNoRujukan_0" name="txtNoRujukan_0" placeholder="ketik nomor rujukan faskes" maxlength="19" value="132210010919P000001">
                                            <span class="input-group-btn">
                                                <button type="button" id="btnRujukanLain" class="btn btn-flat">
                                                    <i class="fa fa-list"> No.Kartu</i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- // -->
                            <!-- <div id="divCarikartu" style="display: none;"> -->
                            <div id="divCarikartu">
                                <div class="form-group">
                                    <label class="col-md-2 col-sm-2 col-xs-12 control-label">Pelayanan</label>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <select class="form-control" id="cbpelayanan_1">
                                            <option value="2">Rawat Jalan</option>
                                            <option value="1">Rawat Inap</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 col-sm-2 col-xs-12 control-label"><label style="color:gray;font-size:x-small">(yyyy-mm-dd)</label> Tgl.Sep</label>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="input-group date">
                                            <input type="text" class="form-control datepicker" id="txtTanggal" placeholder="yyyy-MM-dd" maxlength="10">
                                            <span class="input-group-addon">
                                                <span class="fa fa-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <!-- rujukan online -->
                                <div class="form-group">
                                    <label class="col-md-2 col-sm-2 col-xs-12 control-label">PPK Asal Peserta <label style="color:red;font-size:small">*</label></label>
                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                        <input type="text" class="form-control ui-autocomplete-input" id="txtppkasalrujukan_OL" placeholder="ketik kode atau nama ppk asal rujukan min 3 karakter" autocomplete="off">
                                        <input type="" class="form-control" id="txtkdppkasalrujukan_OL">
                                        <input type="" class="form-control" id="txtjarkom" value="0">
                                        <input type="" class="form-control" id="txtpascainap">
                                    </div>
                                </div>
                                <!-- end rujukan online -->
                                <div class="form-group">
                                    <label class="col-md-2 col-sm-2 col-xs-12 control-label">Nomor</label>
                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="txtNokartu" name="txtNokartu" value="0000725469445" placeholder="ketik nomor" maxlength="13">
                                            <span class="input-group-addon">
                                                <label><input type="radio" name="rbnomor" value="0" id="rbkartubpjs" checked=""> BPJS</label>
                                                <label><input type="radio" name="rbnomor" value="1" id="rbkartunik"> NIK(eKTP)</label>
                                                <label><input type="radio" name="rbnomor" value="2" id="rbkartunik"> eKTP-Reader</label>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="alert alert-info alert-dismissible" id="divInfoJarkom">
                                    <h4><i class="icon fa fa-commenting-o"></i> Pembuatan SEP rawat jalan menggunakan no.kartu hanya bisa :</h4>
                                    <p>
                                        1. Untuk PPK yang tidak menggunakan jaringan komunikasi dapat manual.<br>
                                        2. Untuk PPK yang mempunyai jaringan komunikasi data hanya bisa menerbitkan SEP Gawat Darurat.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="button" id="btnCari" class="btn btn-primary pull-left">Cari</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>
                <div class="alert alert-danger alert-dismissible" id="divPengajuanPenjaminan" style="display:;">
                    <h4><i class="icon fa fa-ban"></i> PERHATIAN!</h4>
                    <p id="pInfoJaminan"></p>
                    <a id="myLinkPengajuanPenjaminan" href="#"> Klik Disini Pengajuan Form</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- pembuka ambil data dari Rujukan -->
<section class="content" id="layout_form_pendaftaran_pasien_bpjs">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    Data Pasien
                    <div class="pull-right col-md-3 col-sm-3 col-xs-12">
                        <div class="input-group">
                            <!-- <input type="text" class="form-control" id="txtNoSepCari" placeholder="ketik nomor sep" maxlength="19">
                            <span class="input-group-btn">
                                <button type="button" id="btnCariNoSEP" class="btn btn-info">
                                    Cari SEP
                                </button>
                            </span> -->
                        </div>
                    </div>
                </div>
                <div class="box-body">
                        <!-- /.box-header -->
                    <table class="table table-condensed" style="width: 100%;">
                        <tr>
                          <td style="width: 15%;"><b>No Rujukan</b></td>
                          <td style="width: 35%;" id="view_norujukan"> : 0087872</td>
                          <td style="width: 15%;"><b>Tujuan</b></td>
                          <td style="width: 35%;" id="view_tujuan"> : Bedah</td>
                        </tr>
                        <tr>
                          <td style="width: 15%;"><b>Tgl Rujukan</b></td>
                          <td style="width: 35%;" id="view_tglrujukan"> : 0087872</td>
                          <td style="width: 15%;"><b>PPK / Perujuk</b></td>
                          <td style="width: 35%;" id="view_ppk_perujuk"> : Bedah</td>
                        </tr>
                        <tr>
                          <td style="width: 15%;"><b>No Kartu</b></td>
                          <td style="width: 35%;" id="view_nokartu"> : 0087872</td>
                          <td style="width: 15%;"><b>Asal Faskes</b></td>
                          <td style="width: 35%;" id="view_asl_faskes"> : Bedah</td>
                        </tr>
                        <tr>
                          <td style="width: 15%;"><b>Nama</b></td>
                          <td style="width: 35%;" id="view_nama"> : 0087872</td>
                          <td style="width: 15%;"><b></b></td>
                          <td style="width: 35%;"></td>
                        </tr>
                    </table>
                    <form class="form-horizontal" id="form_ambil_rujukan">
                        <input type="hidden" id="rujukan_asal_faskes_ambil" name="rujukan_asal_faskes_ambil" placeholder="rujukan_asal_faskes_ambil" value="">
                        <!-- diagnosa -->
                        <input type="hidden" id="rujukan_diagnosa_kode_ambil" name="rujukan_diagnosa_kode_ambil" placeholder="rujukan_diagnosa_kode_ambil" value="">
                        <input type="hidden" id="rujukan_diagnosa_nama_ambil" name="rujukan_diagnosa_nama_ambil" placeholder="rujukan_diagnosa_nama_ambil" value="">
                        <!-- diagnosa -->
                        <input type="hidden" id="rujukan_keluhan_ambil" name="rujukan_keluhan_ambil" placeholder="rujukan_keluhan_ambil" value="">
                        <input type="hidden" id="rujukan_noKunjungan_ambil" name="rujukan_noKunjungan_ambil" placeholder="rujukan_noKunjungan_ambil" value="">
                        <!-- pelayanan -->
                        <input type="hidden" id="rujukan_pelayanan_kode_ambil" name="rujukan_pelayanan_kode_ambil" placeholder="rujukan_pelayanan_kode_ambil" value="">
                        <input type="hidden" id="rujukan_pelayanan_nama_ambil" name="rujukan_pelayanan_nama_ambil" placeholder="rujukan_pelayanan_nama_ambil" value="">
                        <!-- pelayanan -->
                        <!-- peserta -->
                            <!-- COB -->
                            <input type="hidden" id="peserta_cob_nmasuransi_ambil" name="peserta_cob_nmasuransi_ambil" placeholder="peserta_cob_nmasuransi_ambil" value="">
                            <input type="hidden" id="peserta_cob_noasuransi_ambil" name="peserta_cob_noasuransi_ambil" placeholder="peserta_cob_noasuransi_ambil" value="">
                            <input type="hidden" id="peserta_cob_tglTAT_ambil" name="peserta_cob_tglTAT_ambil" placeholder="peserta_cob_tglTAT_ambil" value="">
                            <input type="hidden" id="peserta_cob_tglTMT_ambil" name="peserta_cob_tglTMT_ambil" placeholder="peserta_cob_tglTMT_ambil" value="">
                            <!-- COB -->
                            <!-- hakKelas -->
                            <input type="hidden" id="peserta_hakKelas_kode_ambil" name="peserta_hakKelas_kode_ambil" placeholder="peserta_hakKelas_kode_ambil" value="">
                            <input type="hidden" id="peserta_hakKelas_keterangan_ambil" name="peserta_hakKelas_keterangan_ambil" placeholder="peserta_hakKelas_keterangan_ambil" value="">
                            <!-- hakKelas -->
                            <!-- informasi -->
                            <input type="hidden" id="rujukan_peserta_informasi_dinsos_ambil" name="rujukan_peserta_informasi_dinsos_ambil" placeholder="rujukan_peserta_informasi_dinsos_ambil" value="">
                            <input type="hidden" id="rujukan_peserta_informasi_noSKTM_ambil" name="rujukan_peserta_informasi_noSKTM_ambil" placeholder="rujukan_peserta_informasi_noSKTM_ambil" value="">
                            <input type="hidden" id="rujukan_peserta_informasi_prolanisPRB_ambil" name="rujukan_peserta_informasi_prolanisPRB_ambil" placeholder="rujukan_peserta_informasi_prolanisPRB_ambil" value="">
                            <!-- informasi -->
                            <!-- jenisPeserta -->
                            <input type="hidden" id="rujukan_peserta_jenisPeserta_keterangan_ambil" name="rujukan_peserta_jenisPeserta_keterangan_ambil" placeholder="rujukan_peserta_jenisPeserta_keterangan_ambil" value="">
                            <input type="hidden" id="rujukan_peserta_jenisPeserta_kode_ambil" name="rujukan_peserta_jenisPeserta_kode_ambil" placeholder="rujukan_peserta_jenisPeserta_kode_ambil" value="">
                            <!-- jenisPeserta -->
                            <!-- mr -->
                            <input type="hidden" id="rujukan_peserta_mr_noMR_ambil" name="rujukan_peserta_mr_noMR_ambil" placeholder="rujukan_peserta_mr_noMR_ambil" value="">
                            <input type="hidden" id="rujukan_peserta_mr_noTelepon_ambil" name="rujukan_peserta_mr_noTelepon_ambil" placeholder="rujukan_peserta_mr_noTelepon_ambil" value="">
                            <!-- mr -->
                            <input type="hidden" id="rujukan_peserta_nama_ambil" name="rujukan_peserta_nama_ambil" placeholder="rujukan_peserta_nama_ambil" value="">
                            <input type="hidden" id="rujukan_peserta_nik_ambil" name="rujukan_peserta_nik_ambil" placeholder="rujukan_peserta_nik_ambil" value="">
                            <input type="hidden" id="rujukan_peserta_noKartu_ambil" name="rujukan_peserta_noKartu_ambil" placeholder="rujukan_peserta_noKartu_ambil" value="">
                            <input type="hidden" id="rujukan_peserta_pisa_ambil" name="rujukan_peserta_pisa_ambil" placeholder="rujukan_peserta_pisa_ambil" value="">
                            <!-- provUmum -->
                            <input type="hidden" id="rujukan_peserta_provUmum_kdProvider_ambil" name="rujukan_peserta_provUmum_kdProvider_ambil" placeholder="rujukan_peserta_provUmum_kdProvider_ambil" value="">
                            <input type="hidden" id="rujukan_peserta_provUmum_nmProvider_ambil" name="rujukan_peserta_provUmum_nmProvider_ambil" placeholder="rujukan_peserta_provUmum_nmProvider_ambil" value="">
                            <!-- provUmum -->
                            <input type="hidden" id="rujukan_peserta_sex_ambil" name="rujukan_peserta_sex_ambil" placeholder="rujukan_peserta_sex_ambil" value="">
                            <!-- statusPeserta -->
                            <input type="hidden" id="rujukan_peserta_statusPeserta_keterangan_ambil" name="rujukan_peserta_statusPeserta_keterangan_ambil" placeholder="rujukan_peserta_statusPeserta_keterangan_ambil" value="">
                            <input type="hidden" id="rujukan_peserta_statusPeserta_kode_ambil" name="rujukan_peserta_statusPeserta_kode_ambil" placeholder="rujukan_peserta_statusPeserta_kode_ambil" value="">
                            <!-- statusPeserta -->
                            <input type="hidden" id="rujukan_peserta_tglCetakKartu_ambil" name="rujukan_peserta_tglCetakKartu_ambil" placeholder="rujukan_peserta_tglCetakKartu_ambil" value="">
                            <input type="hidden" id="rujukan_peserta_tglLahir_ambil" name="rujukan_peserta_tglLahir_ambil" placeholder="rujukan_peserta_tglLahir_ambil" value="">
                            <input type="hidden" id="rujukan_peserta_tglTAT_ambil" name="rujukan_peserta_tglTAT_ambil" placeholder="rujukan_peserta_tglTAT_ambil" value="">
                            <input type="hidden" id="rujukan_peserta_tglTMT_ambil" name="rujukan_peserta_tglTMT_ambil" placeholder="rujukan_peserta_tglTMT_ambil" value="">
                            <!-- umur -->
                            <input type="hidden" id="rujukan_peserta_umur_umurSaatPelayanan_ambil" name="rujukan_peserta_umur_umurSaatPelayanan_ambil" placeholder="rujukan_peserta_umur_umurSaatPelayanan_ambil" value="">
                            <input type="hidden" id="rujukan_peserta_umur_umurSekarang_ambil" name="rujukan_peserta_umur_umurSekarang_ambil" placeholder="rujukan_peserta_umur_umurSekarang_ambil" value="">
                            <input type="hidden" id="rujukan_peserta_umur_umurSekarang_ambil" name="rujukan_peserta_umur_umurSekarang_ambil" placeholder="rujukan_peserta_umur_umurSekarang_ambil" value="">
                            <!-- umur -->
                            <input type="hidden" id="rujukan_poliRujukan_kode_ambil" name="rujukan_poliRujukan_kode_ambil" placeholder="rujukan_poliRujukan_kode_ambil" value="">
                            <input type="hidden" id="rujukan_poliRujukan_nama_ambil" name="rujukan_poliRujukan_nama_ambil" placeholder="rujukan_poliRujukan_nama_ambil" value="">
                            <input type="hidden" id="rujukan_provPerujuk_kode_ambil" name="rujukan_provPerujuk_kode_ambil" placeholder="rujukan_provPerujuk_kode_ambil" value="">
                            <input type="hidden" id="rujukan_provPerujuk_nama_ambil" name="rujukan_provPerujuk_nama_ambil" placeholder="rujukan_provPerujuk_nama_ambil" value="">
                            <input type="hidden" id="rujukan_tglKunjungan_ambil" name="rujukan_tglKunjungan_ambil" placeholder="rujukan_tglKunjungan_ambil" value="">
                        <!-- peserta -->
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <div class="col-md-6">
                                    <label>Tempat / tgl Lahir</label>
                                    <input type="" class="form-control" placeholder="Norm ..." name="norm_pasien" id="norm_pasien" >
                                    <div class="form-group">
                                        <div class="col-xs-6">
                                            <input type="text" class="form-control" placeholder="tempat ..." name="tempat_lahir" id="tempat_lahir">
                                        </div>
                                        <div class="col-xs-6">
                                            <input type="date" class="form-control" placeholder="Tanggal Lahir ..." name="tgl_lahir" id="tgl_lahir" readonly>
                                        </div>
                                    </div>
                                </div>
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
                              </div>
                            </div><!-- /.col -->
                            <div class="col-md-12">
                              <div class="form-group">
                                <div class="col-md-6">
                                    <label>Alamat</label>
                                    <input type="text" class="form-control" placeholder="Alamat ..." name="alamat" id="alamat">
                                </div>
                                <div class="col-md-6">
                                    <label>Provinsi</label>
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
                                <div class="col-md-6" id="utk_jenis_p">
                                    <label>Kecamatan</label>
                                    <input type="hidden" class="form-control" placeholder="Nama Kecamatan" name="nama_kecamatan" id="nama_kecamatan" value=" " readonly>
                                    <select class="form-control select2" style="width: 100%;" name="kecamatan" id="kecamatan">
                                    </select>
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
                                  
                                </div>
                              </div>
                            </div><!-- /.col -->
                            
                        </div>
                        <center>
                            <h4 class="box-title">Karcis Pasien</h4>
                            <div class="box-body" style="width:50%;">
                                <table class="table table-bordered" id="tabel_karcis">  
                                    <tbody id="daftar_pelayanan_karcis"></tbody>
                                </table>
                                <div class="form-group">
                                    <label>Pelayanan Dokter</label>
                                    <select class="form-control select" style="width: 100%;" name="id_dokter" id="id_dokter">
                                    </select>
                                    <input type="hidden" class="form-control" placeholder="No Telp ..." name="jumlah_tindakan" id="jumlah_tindakan" value="0" readonly>
                                </div><!-- /.form-group -->
                            </div>
                        </center>
                    </form>  
                        <!-- /.box-body -->
                </div>
                <div class="box-footer">
                    <button type="button" id="btnAmbil" class="btn btn-primary pull-left"> Ambil Data </button> 
                    <button type="button" class="btn btn-danger btn-flat" id="btn_batal_pendaftaran"><i class="fa fa-fw fa-remove"></i> Batal </button>
                    <button type="button" class="btn btn-success btn-flat" id="btn_simpan_pendaftaran" name="btn_simpan_pendaftaran" value="">
                        <i class="fa fa-fw fa-save"></i> Simpan
                    </button> 
                </div>
            </div>
        </div>
    </div> 
</section>
<!-- penutup ambil data dari Rujukan -->

<!-- pembuka pendaftaran pasien -->
<!-- penutup pendaftaran pasien -->
<section class="content" id="layout_form_pengambilan_sep">
    <form class="form-horizontal" id="theform">
    <div class="row">
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box box-widget widget-user-2">
                    <div class="widget-user-header bg-aqua-active">
                        <div class="widget-user-image">
                            <img class="img-circle" src="<?php echo base_url('/assets/dist/img/avatar3.png');?>" alt="User Avatar" id="imgMale" style="display: none;">
                            <img class="img-circle" src="<?php echo base_url('/assets/dist/img/avatar5.png');?>" alt="User Avatar" id="imgFemale">
                        </div>
                        <h4 class="widget-user-username" id="lblnama">ISTIARI</h4>
                        <p class="widget-user-desc" id="lblnoka">0001926763751</p>
                        <input type="text" id="txtnokartu_peserta" name="txtnokartu_peserta">
                        <input type="" id="txtkelamin" name="txtkelamin" value="P">
                        <input type="" id="txtkdstatuspst" name="txtkdstatuspst" value="">
                    </div>
                </div>
                <div class="box-body">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a title="Profile Peserta" href="#tab_1" data-toggle="tab"><span class="fa fa-user"></span></a></li>
                            <li><a href="#tab_2" title="COB" data-toggle="tab"><span class="fa fa-building"></span></a></li>
                            <li><a href="#tab_3" title="Histori" data-toggle="tab" id="tabHistori"><span class="fa fa-list"></span></a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                        <span class="fa fa-sort-numeric-asc"></span> <a title="NIK" class="pull-right-container" id="lblnik">6402025407670001</a>
                                    </li>
                                    <li class="list-group-item">
                                        <span class="fa fa-credit-card"></span> <a title="No.Kartu Bapel JKK" class="pull-right-container" id="lblnokartubapel"></a>
                                    </li>
                                    <li class="list-group-item">
                                        <span class="fa fa-calendar"></span> <a title="Tanggal Lahir" class="pull-right-container" id="lbltgllahir">1967-07-14</a>
                                    </li>
                                    <li class="list-group-item">
                                        <span class="fa fa-user"></span> <a title="PISA" class="pull-right-container" id="lblpisa">Istri</a>
                                    </li>

                                    <li class="list-group-item">
                                        <span class="fa fa-hospital-o"></span> <a title="Hak Kelas Rawat" class="pull-right-container" id="lblhakkelas">Kelas 3</a>
                                        <input type="" id="txtpisa" name="txtpisa" value="3">
                                        <input type="" id="txtkdklspst" name="txtkdklspst" value="3">
                                    </li>
                                    <li class="list-group-item">
                                        <span class="fa fa-stethoscope"></span>  <a title="Faskes Tingkat 1" class="pull-right-container" id="lblfktp">13211901 - BARENG</a>
                                        <input type="" id="txtppkasalpst" name="txtppkasalpst" value="13211901">
                                    </li>
                                    <li class="list-group-item">
                                        <span class="fa fa-calendar"></span>  <a title="TMT dan TAT Peserta" class="pull-right-container" id="lbltmt_tat">2016-09-01 s.d 2050-01-01</a>
                                        <input id="txttmtpst" name="txttmtpst" type="" value="2016-09-01">
                                    </li>
                                    <li class="list-group-item">
                                        <span class="fa fa-calendar"></span>  <a title="Jenis Peserta" class="pull-right-container" id="lblpeserta">MANDIRI</a>
                                        <input type="" id="txtjnspst" name="txtjnspst" value="14">
                                    </li>

                                </ul>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_2">
                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                        <span class="fa fa-sort-numeric-asc"></span> <a title="No. Asuransi" class="pull-right-container" id="lblnoasu"></a>
                                        <input type="" id="txtkdasu" name="txtkdasu" value="">
                                    </li>
                                    <li class="list-group-item">
                                        <span class="fa fa-windows"></span> <a title="Nama Asuransi" class="pull-right-container" id="lblnmasu"></a>

                                    </li>
                                    <li class="list-group-item">
                                        <span class="fa fa-calendar"></span> <a title="TMT dan TAT Asuransi" class="pull-right-container" id="lbltmt_tatasu">null s.d null</a>
                                        <input type="" id="txttmtasu" name="txttmtasu" value="">
                                        <input type="" id="txttatasu" name="txttatasu" value="">
                                    </li>
                                    <li class="list-group-item">
                                        <span class="fa fa-bank"></span> <a title="Nama Badan Usaha" class="pull-right-container" id="lblnamabu"></a>
                                        <input type="" id="txtkdbu" name="txtkdbu" value="">
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-pane" id="tab_3">
                                <div id="divHistori" class="list-group">
                                </div>
                                <div>
                                    <button type="button" id="btnHistori" class="btn btn-xs btn-default btn-block"><span class="fa fa-cubes"></span> Histori</button>
                                </div>
                            </div>
                        </div><!-- /.tab-content -->
                    </div>
                    <div id="divriwayatKK" style="display: none;">
                        <button type="button" id="btnRiwayatKK" class="btn btn-danger btn-block"><span class="fa fa-th-list"></span> Pasien Memiliki Riwayat KLL/KK/PAK <br><i>(klik lihat data)</i></button>
                    </div>
                </div><!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-header with-border">
                        <h3 class="box-title"><label class="pull-right" style="font-size:larger" id="lblnosep"></label> </h3>
                        <label class="pull-right" style="font-size:larger" id="lbljenpel">Rawat Jalan</label>
                        <input type="" id="txtjenpel" name="txtjenpel" value="2">
                        <input type="" id="txtID_TARIF" name="txtID_TARIF">
                        <input type="" id="txt_normesyst" name="txt_normesyst" placeholder="txt_normesyst">
                        <input type="" id="txt_nodaftaresyst" name="txt_nodaftaresyst" placeholder="txt_nodaftaresyst">
                        <input type="" id="txt_nosep" name="txt_nosep" placeholder="txt_nosep">
                    </div>
                    <!-- form input -->
                    
                        <input type="" id="txtprsklaimsep" name="txtprsklaimsep" value="0">
                        <div class="box-body">
                            <div>
                                <label style="color:red;font-size:small">* Wajib Diisi</label>
                                <input type="" class="form-control" id="id_insert_sep" name="id_insert_sep" value="">
                            </div>
                            <div class="form-group" id="divPoli">
                                <label class="col-md-3 col-sm-3 col-xs-12 control-label">Spesialis/SubSpesialis <label style="color:red;font-size:small">*</label></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <label><input type="checkbox" id="chkpoliesekutif" name="chkpoliesekutif" readonly=""> Eksekutif</label>
                                        </span>
                                        <input type="text" class="form-control ui-autocomplete-input" id="txtnmpoli" name="txtnmpoli" maxlength="10" placeholder="ketik kode atau nama Spesialis/Subspesialis min 3 karakter" autocomplete="off" disabled="">
                                        <input type="" class="form-control" id="txtkdpoli" name="txtkdpoli" value="">
                                    </div>
                                </div>
                            </div>
                            <div id="divRujukan">
                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-12 control-label">Asal Rujukan</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select class="form-control" id="cbasalrujukan" name="cbasalrujukan">
                                            <option value="1">Faskes Tingkat 1</option>
                                            <option value="2">Faskes Tingkat 2</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-12 control-label">PPK Asal Rujukan <label style="color:red;font-size:small">*</label></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" class="form-control ui-autocomplete-input" id="txtppkasalrujukan" name="txtppkasalrujukan" placeholder="ketik kode atau nama ppk asal rujukan min 3 karakter" autocomplete="off" readonly="">
                                        <input type="" class="form-control" id="txtkdppkasalrujukan" name="txtkdppkasalrujukan" value="13211901">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-12 control-label"><label style="color:gray;font-size:x-small">(yyyy-mm-dd)</label> Tgl.Rujukan</label>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="input-group date">
                                            <input type="text" class="form-control datepicker" id="txttglrujukan" name="txttglrujukan" placeholder="yyyy-MM-dd" maxlength="10" readonly="">
                                            <span class="input-group-addon">
                                                <span class="fa fa-calendar">
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-12 control-label">No. Rujukan <label style="color:red;font-size:small">*</label></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" class="form-control" id="txtnorujukan" name="txtnorujukan" placeholder="ketik nomor rujukan" maxlength="19" readonly="">
                                    </div>
                                </div>
                            </div>
                            <!-- kontrol -->
                            <div id="divkontrol" style="display: block;">
                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-12 control-label" id="lblkontrol">No.Surat Kontrol/SKDP <label style="color:red;font-size:small">*</label></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" class="form-control" id="txtnosuratkontrol" name="txtnosuratkontrol" placeholder="ketik nomor surat kontrol" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" maxlength="6">
                                        <input type="" id="txtidkontrol" name="txtidkontrol" value="1">
                                        <input type="" id="txtnosuratkontrollama" name="txtnosuratkontrollama" value="000681">
                                        <input type="" id="txtpoliasalkontrol" name="txtpoliasalkontrol" value="MAT">
                                        <input type="" id="txttglsepasalkontrol" name="txttglsepasalkontrol" value="2019-09-17">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-12 control-label">DPJP Pemberi Surat SKDP/SPRI <label style="color:red;font-size:small">*</label></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select class="form-control" id="txtnmdpjp" name="txtnmdpjp">
                                        </select>
                                        <!-- <input type="text" class="form-control ui-autocomplete-input" id="txtnmdpjp" name="txtnmdpjp" placeholder="ketik nama dokter DPJP Pemberi Surat SKDP/SPRI" autocomplete="off" disabled=""> -->
                                        <input type="" id="txtkddpjp" name="txtkddpjp" value="14921">
                                    </div>
                                </div>
                            </div>
                            <!-- end kontrol -->
                            <div class="clearfix"></div>
                            <!-- sep -->
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12 control-label"><label style="color:gray;font-size:x-small">(yyyy-mm-dd)</label>  Tgl. SEP</label>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="input-group date">
                                        <input type="date" class="form-control datepicker" id="txttglsep" name="txttglsep" placeholder="yyyy-MM-dd" maxlength="10" >
                                        <span class="input-group-addon">
                                            <span class="fa fa-calendar">
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12 control-label">No. MR <label style="color:red;font-size:small">*</label></label>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="txtnomr" name="txtnomr" placeholder="ketik nomor MR" maxlength="10" readonly="">
                                        <span class="input-group-addon">
                                            <label><input type="checkbox" id="chkCOB" name="chkCOB"> Peserta COB</label>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" id="divkelasrawat" style="display: show;">
                                <label class="col-md-3 col-sm-3 col-xs-12 control-label">Kelas Rawat</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select class="form-control" id="cbKelas" name="cbKelas" ><option value="3">Kelas 3</option></select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12 control-label">Diagnosa <label style="color:red;font-size:small">*</label></label>
                                <!-- <div class="form-group">
                                    <label>Multiple</label>
                                    <select class="form-control select2" multiple="multiple" id="nm_diagnosa" name="nm_diagnosa" data-placeholder="Select a State" onkeyup="get_diagnosa();" style="width: 100%;">
                                        <option>Alabama</option>
                                        <option>Alaska</option>
                                        <option>California</option>
                                        <option>Delaware</option>
                                        <option>Tennessee</option>
                                        <option>Texas</option>
                                        <option>Washington</option>
                                    </select>
                                </div> -->
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control ui-autocomplete-input" class="form-control select2" multiple="multiple" id="txtnmdiagnosa" name="txtnmdiagnosa" maxlength="10" placeholder="ketik kode atau nama diagnosa min 3 karakter" autocomplete="on" >
                                    <label id="lblDxSpesialistik" style="color: red; display: show;"></label>
                                    <input type="" class="form-control" id="txtkddiagnosa" name="txtkddiagnosa" value="H54.5">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12 control-label">No. Telepon <label style="color:red;font-size:small">*</label></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" id="txtnotelp" name="txtnotelp" placeholder="ketik nomor telepon yang dapat dihubungi" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" maxlength="15">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12 control-label">Catatan</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <textarea class="form-control" id="txtcatatan" name="txtcatatan" rows="2" placeholder="ketik catatan apabila ada"></textarea>
                                </div>
                            </div>
                            <!--  katarak-->
                            <div class="form-group" id="divkatarak" style="display: block;">
                                <label class="col-md-3 col-sm-3 col-xs-12 control-label">Katarak <input type="checkbox" id="chkkatarak" name="chkkatarak"></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <p class="text-muted well well-sm no-shadow">Centang Katarak <i class="fa fa-check"></i>, Jika Peserta Tersebut Mendapatkan Surat Perintah Operasi katarak</p>
                                </div>
                            </div>

                            <!--  lakalantas-->
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12 control-label">Status Kecelakaan <label style="color:red;font-size:small">*</label></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select class="form-control" id="cbstatuskll" name="cbstatuskll">
                                        <option value="-">-- Silahkan Pilih --</option>
                                        <option value="0" title="Kasus bukan akibat kecelakaan lalu lintas dan kerja">Bukan Kecelakaan</option>
                                        <option value="1" title="Kasus KLL Tidak Berhubungan dengan Pekerjaan">Kecelakaan LaluLintas dan Bukan Kecelakaan Kerja</option>
                                        <option value="2" title="1).Kasus KLL Berhubungan dengan Pekerjaan. 2).Kasus KLL Berangkat dari Rumah menuju tempat Kerja. 3).Kasus KLL Berangkat dari tempat Kerja menuju rumah.">Kecelakaan LaluLintas dan Kecelakaan Kerja</option>
                                        <option value="3" title="1).Kasus Kecelakaan Berhubungan dengan pekerjaan. 2).Kasus terjadi di tempat kerja.Kasus terjadi pada saat kerja.">Kecelakaan Kerja</option>
                                    </select>
                                    
                                </div>                                
                            </div>

                            <div id="divJaminanHistori" class="text-muted well well-sm no-shadow col-md-12 col-sm-12 col-xs-12" style="display: show;">
                                <input type="" id="txtkasuslaka" name="txtkasuslaka" value="0">
                                <input type="" id="txtnosepjaminanhistori" name="txtnosepjaminanhistori">
                                <input type="" id="txtnosepjaminanhistori2" name="txtnosepjaminanhistori2">
                                <input type="" id="txtkasuskejadian2" name="txtkasuskejadian2">
                                <input type="" id="txtstatusdijamin" name="txtstatusdijamin">
                                <p style="margin-top: 10px;" id="pketerangan"></p>
                            </div>
                            <div id="divJaminan" class="text-muted well well-sm no-shadow" style="display: show;">
                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-12 control-label">Tanggal Kejadian</label>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="input-group date">
                                            <input type="text" class="form-control datepicker" id="txtTglKejadian" name="txtTglKejadian" placeholder="yyyy-MM-dd" maxlength="10" disabled="">
                                            <span class="input-group-addon">
                                                <span class="fa fa-calendar">
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label class="col-md-3 col-sm-3 col-xs-12 control-label">Lokasi Kejadian</label>
                                    <div class="col-md-7 col-sm-7 col-xs-12">
                                        <select class="form-control" id="cbpropinsi" name="cbpropinsi">
                                            <option value="">-- Silahkan Pilih Propinsi --</option>
                                            <option value="16">BALI</option>
                                            <option value="15">BANTEN</option>
                                            <option value="07">BENGKULU</option>
                                            <option value="13">D I  YOGYAKARTA</option>
                                            <option value="10">DKI JAKARTA</option>
                                            <option value="27">GORONTALO</option>
                                            <option value="05">JAMBI</option>
                                            <option value="11">JAWA BARAT</option>
                                            <option value="12">JAWA TENGAH</option>
                                            <option value="14">JAWA TIMUR</option>
                                            <option value="19">KALIMANTAN BARAT</option>
                                            <option value="21">KALIMANTAN SELATAN</option>
                                            <option value="20">KALIMANTAN TENGAH</option>
                                            <option value="22">KALIMANTAN TIMUR</option>
                                            <option value="34">KALIMANTAN UTARA</option>
                                            <option value="09">KEP. BANGKA BELITUNG</option>
                                            <option value="33">KEPULAUAN RIAU</option>
                                            <option value="08">LAMPUNG</option>
                                            <option value="99">LUAR NEGERI</option>
                                            <option value="28">MALUKU</option>
                                            <option value="29">MALUKU UTARA</option>
                                            <option value="01">NANGGROE ACEH DARUSSALAM</option>
                                            <option value="17">NUSA TENGGARA BARAT</option>
                                            <option value="18">NUSA TENGGARA TIMUR</option>
                                            <option value="30">PAPUA</option>
                                            <option value="31">PAPUA BARAT</option>
                                            <option value="04">RIAU</option>
                                            <option value="32">SULAWESI BARAT</option>
                                            <option value="25">SULAWESI SELATAN</option>
                                            <option value="24">SULAWESI TENGAH</option>
                                            <option value="26">SULAWESI TENGGARA</option>
                                            <option value="23">SULAWESI UTARA</option>
                                            <option value="03">SUMATERA BARAT</option>
                                            <option value="06">SUMATERA SELATAN</option>
                                            <option value="02">SUMATERA UTARA</option></select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-12 control-label"></label>
                                    <div class="col-md-7 col-sm-7 col-xs-12">
                                        <select class="form-control" id="cbkabupaten" name="cbkabupaten"></select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-12 control-label"></label>
                                    <div class="col-md-7 col-sm-7 col-xs-12">
                                        <select class="form-control" id="cbkecamatan" name="cbkecamatan"></select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-12 control-label">Keterangan Kejadian</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <textarea class="form-control" id="txtketkejadian" name="txtketkejadian" rows="2" placeholder="ketik keterangan kejadian"></textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- end lakalantas-->

                        </div>
                        <div class="box-footer clearfix">
                            <div id="divSimpan" style="display: block;">
                                <button type="button" id="btnSimpan" class="btn btn-success pull-left"><i class="fa fa-save"></i> Simpan</button>
                            </div>
                            <div id="divEditSEP" style="display: block;">
                                <button type="button" id="btnEdit" class="btn btn-warning pull-left"><i class="fa fa-pencil"></i> Edit</button>
                                <button type="button" id="btnHapus" class="btn btn-danger pull-left"><i class="fa fa-eraser"></i> Hapus</button>
                                <button type="button" id="btnCetak" class="btn btn-primary pull-left"><i class="fa fa-print"></i> Cetak</button>
                            </div>
                            <button type="button" id="btnBatal" class="btn btn-danger pull-right"><i class="fa fa-chevron-left"></i> Batal</button>
                        </div>
                    
                    <!-- form inpput -->
                </div>
            </div>
        </div>
    </div>
    </form>    
</section>
<!-- pembuka Input Rujukan Keluar -->
<section class="content" id="layout_form_pengambilan_rujuk_pasien">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    Rujuk Pasien
                    <div class="pull-right col-md-3 col-sm-3 col-xs-12">
                        <div class="input-group">
                            <!-- <input type="text" class="form-control" id="txtNoSepCari" placeholder="ketik nomor sep" maxlength="19">
                            <span class="input-group-btn">
                                <button type="button" id="btnCariNoSEP" class="btn btn-info">
                                    Cari SEP
                                </button>
                            </span> -->
                        </div>
                    </div>
                </div>
                <div class="box-body">
                        <!-- /.box-header -->
                    <table class="table table-condensed" style="width: 100%;">
                        <tr>
                          <td style="width: 15%;"><b>No Rujukan</b></td>
                          <td style="width: 35%;" id="view_norujukan_keluar"> : 0087872</td>
                          <td style="width: 15%;"><b>Tujuan</b></td>
                          <td style="width: 35%;" id="view_tujuan_keluar"> : Bedah</td>
                        </tr>
                        <tr>
                          <td style="width: 15%;"><b>Tgl Rujukan</b></td>
                          <td style="width: 35%;" id="view_tglrujukan_keluar"> : 0087872</td>
                          <td style="width: 15%;"><b>PPK / Perujuk</b></td>
                          <td style="width: 35%;" id="view_ppk_perujuk_keluar"> : Bedah</td>
                        </tr>
                        <tr>
                          <td style="width: 15%;"><b>No Kartu</b></td>
                          <td style="width: 35%;" id="view_nokartu_keluar"> : 0087872</td>
                          <td style="width: 15%;"><b>Asal Faskes</b></td>
                          <td style="width: 35%;" id="view_asl_faskes_keluar"> : Bedah</td>
                        </tr>
                        <tr>
                          <td style="width: 15%;"><b>Nama</b></td>
                          <td style="width: 35%;" id="view_nama_keluar"> : 0087872</td>
                          <td style="width: 15%;"><b></b></td>
                          <td style="width: 35%;"></td>
                        </tr>
                    </table>
                    <form class="form-horizontal" id="form_rujukan_keluar">
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <div class="col-md-6">
                                    <label>SEP</label>
                                    <input type="hidden" class="form-control" placeholder="Id Rujukan Keluar ..." name="id_rujukan_keluar" id="id_rujukan_keluar" >
                                    <input type="hidden" class="form-control" placeholder="Nodaftar ..." name="nodaftar_rujukan_keluar" id="nodaftar_rujukan_keluar" >
                                    <input type="" class="form-control" placeholder="NO SEP ..." name="sep_pasien" id="sep_pasien" >
                                    <div class="form-group">
                                        <!-- <div class="col-xs-6">
                                            <input type="text" class="form-control" placeholder="tempat ..." name="tempat_lahir" id="tempat_lahir">
                                        </div>
                                        <div class="col-xs-6">
                                            <input type="date" class="form-control" placeholder="Tanggal Lahir ..." name="tgl_lahir" id="tgl_lahir" readonly>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Tanggal Rujukan</label>
                                    <input type="date" class="form-control" placeholder="Tanggal Rujukan ..." name="tgl_rujukan" id="tgl_rujukan">
                                </div>
                              </div>
                            </div><!-- /.col -->
                            <div class="col-md-12">
                              <div class="form-group">
                                <div class="col-md-6">
                                    <div class="ui-widget">
                                    <label>Jenis Faskes</label>
                                    <select class="form-control" style="width: 100%;" name="jenis_faskes" id="jenis_faskes">
                                        <option value="">== || ==</option>
                                        <option value="1">Faskes Tingkat1</option>
                                        <option value="2">Faskes Tingkat2</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>PPK Dirujuk</label>
                                    <input class="form-control" style="width: 100%;" name="ppkdirujuk" id="ppkdirujuk">
                                    <input type="hidden" class="form-control" style="width: 100%;" name="kd_ppkdirujuk" id="kd_ppkdirujuk">
                                    <!-- <input type="" class="form-control" placeholder="PPK Dirujuk" name="ppkdirujuk" id="ppkdirujuk" value=""> -->
                                  
                                    <div class="col-lg-3">
                                        <!-- <input type="hidden" class="form-control" placeholder="Nama Provinsi" name="nama_provinsi" id="nama_provinsi" value="" readonly> -->
                                    </div>
                                    <div class="col-lg-4">
                                    </div>
                                </div>
                              </div>
                            </div><!-- /.col -->
                            <div class="col-md-12">
                              <div class="form-group">
                                <div class="col-md-6">
                                    <label>Jenis Pelayanan</label>
                                    <select class="form-control" style="width: 100%;" name="jenis_layanan" id="jenis_layanan">
                                        <option value="">== || ==</option>
                                        <option value="1">R. Inap</option>
                                        <option value="2">R. Jalan</option>
                                    </select>
                                </div>
                                <div class="col-md-6" id="utk_jenis_p">
                                    <label>Catatan</label>
                                    <textarea class="form-control" placeholder="Catatan" name="catatanrujukan" id="catatanrujukan" value=""></textarea>
                                </div>
                              </div>
                            </div><!-- /.col -->
                            <div class="col-md-12">
                              <div class="form-group">
                                <div class="col-md-6">
                                    <label>Diagnosa</label>
                                    <input class="form-control" style="width: 100%;" name="diagnosa_rujukan_keluar" id="diagnosa_rujukan_keluar">
                                    <input type="hidden" class="form-control" style="width: 100%;" name="kd_diagnosa_rujukan_keluar" id="kd_diagnosa_rujukan_keluar">
                                    <div class="col-lg-3">
                                        <!-- <input type="hidden" class="form-control" placeholder="Nama Desa" name="nama_desa" id="nama_desa" value="" readonly> -->
                                    </div>
                                  
                                </div>
                                <div class="col-md-6">
                                    <label>type Rujukan</label>
                                    <select class="form-control select2" style="width: 100%;" name="type_rujukan_keluar" id="type_rujukan_keluar">
                                        <option value="">== || ==</option>
                                        <option value="0">Penuh</option>
                                        <option value="1">Partial</option>
                                        <option value="2">Rujuk Balik</option>
                                    </select>
                                    <div class="col-lg-3">
                                        <!-- <input type="hidden" class="form-control" placeholder="Nama Desa" name="nama_desa" id="nama_desa" value="" readonly> -->
                                    </div>
                                </div>
                              </div>
                            </div><!-- /.col -->
                            <div class="col-md-12">
                              <div class="form-group">
                                <div class="col-md-6">
                                    <label>Poli Rujukan</label>
                                    <input class="form-control" style="width: 100%;" name="poli_rujukan_keluar" id="poli_rujukan_keluar">
                                    <input type="hidden" class="form-control" style="width: 100%;" name="kd_poli_rujukan_keluar" id="kd_poli_rujukan_keluar">
                                </div>
                                <div class="col-md-6">

                                    <div class="col-lg-3">
                                        <!-- <input type="hidden" class="form-control" placeholder="Nama Desa" name="nama_desa" id="nama_desa" value="" readonly> -->
                                    </div>
                                </div>
                              </div>
                            </div><!-- /.col -->
                        </div>
                    </form>  
                        <!-- /.box-body -->
                </div>
                <div class="box-footer">
                    <!-- <button type="button" id="btnAmbil" class="btn btn-primary pull-left"> Ambil Data </button>  -->
                    <button type="button" class="btn btn-warning btn-flat" id="btn_batal_rujuk_keluar"><i class="fa fa-fw  fa-chevron-left"></i> Batal </button>

                    <button type="button" class="btn btn-danger btn-flat" id="btn_hapus_rujukan_keluar" name="btn_hapus_rujukan_keluar" value="">
                        <i class="fa fa-fw fa-eraser"></i> Hapus
                    </button> 

                    <button type="button" class="btn btn-success btn-flat" id="btn_simpan_rujukan_keluar" name="btn_simpan_rujukan_keluar" value="">
                        <i class="fa fa-fw fa-save"></i> Simpan
                    </button>
                    <button type="button" class="btn btn-primary btn-flat" id="btn_update_rujukan_keluar" name="btn_update_rujukan_keluar" value="">
                        <i class="fa fa-fw fa-upload"></i> Update
                    </button>
                </div>
            </div>
        </div>
    </div> 
</section>
<!-- penutup Input Rujukan Keluar -->
<style type="text/css">
  .ui-autocomplete-row
  {
    padding:8px;
    background-color: #f4f4f4;
    border-bottom:1px solid #fce4e4;
    font-weight:bold;
  }
  .ui-autocomplete-row:hover
  {
    background-color: #ffffff;
  }
</style>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="<?=base_url('assets/_controller/create_sep.js')?>"></script>