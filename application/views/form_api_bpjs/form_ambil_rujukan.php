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
                            <!-- <div class="input-group">
                                <input type="text" class="form-control" id="txtNoSepCari" placeholder="ketik nomor sep" maxlength="19">
                                <span class="input-group-btn">
                                    <button type="button" id="btnCariNoSEP" class="btn btn-info">
                                        Cari SEP
                                    </button>
                                </span>
                            </div> -->
                        </div>
                    </div>

                    <form class="form-horizontal" id="form_rujukan">
                        <div class="box-body">
                            <div class="form-group" id="div_nodaftar">
                                <label class="col-md-2 col-sm-2 col-xs-12 control-label">Pilih Nodaftar</label>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <select class="form-control" id="nodaftas_pasien" name="nodaftas_pasien">
                                        <option value="">== || ==</option>
                                        <?php
                                            foreach ($get_data_bpjs as $key) {
                                        ?>
                                        <option value="<?php echo $key->NODAFTAR;?>"><?php echo $key->NODAFTAR.' | '.$key->NAMA;?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
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
                                    <label>NORM E-Syst</label>
                                    <input type="" class="form-control" placeholder="Norm ..." name="norm_pasien" id="norm_pasien" >
                                </div>
                                <div class="col-md-6">
                                    <label>NORM BPJS</label>
                                    <input type="" class="form-control" placeholder="Norm ..." name="norm_bpjs" id="norm_bpjs" >
                                </div>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <div class="col-md-6">
                                    <label>No Daftar</label>
                                    <input type="" class="form-control" placeholder="No Daftar ..." name="nodaftar_pasien" id="nodaftar_pasien" >
                                </div>
                                <div class="col-md-6">
                                    <!-- <label>NIK</label>
                                    <input type="" class="form-control" placeholder="Norm ..." name="nik_bpjs" id="nik_bpjs" > -->
                                </div>
                              </div>
                            </div><!-- /.col -->
                        </div>
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="<?=base_url('assets/_controller/bridging_bpjs/ambil_rujukan_masuk.js')?>"></script>