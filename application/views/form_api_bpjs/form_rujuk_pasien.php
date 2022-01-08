
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