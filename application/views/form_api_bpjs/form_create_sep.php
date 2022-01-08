<?php
    // echo $rujukan_masuk;
    $data = json_decode($rujukan_masuk);
    foreach ($data as $key) {
?>
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
                        <h4 class="widget-user-username" id="lblnama"><?php echo $key->nama;?></h4>
                        <p class="widget-user-desc" id="lblnoka"><?php echo $key->noKartu;?></p>
                        <input type="text" id="txtnokartu_peserta" name="txtnokartu_peserta" value="<?php echo $key->noKartu;?>" placeholder="no kartu">
                        <input type="text" id="txtkelamin" name="txtkelamin" value="<?php echo $key->sex;?>" placeholder="kelamin">
                        <input type="" id="txtkdstatuspst" name="txtkdstatuspst" value="" placeholder="kd status peserta">
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
                                        <span class="fa fa-sort-numeric-asc"></span> <a title="NIK" class="pull-right-container" id="lblnik"><?php echo $key->nik;?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <span class="fa fa-credit-card"></span> <a title="No.Kartu Bapel JKK" class="pull-right-container" id="<?php echo $key->noKartu;?>"></a>
                                    </li>
                                    <li class="list-group-item">
                                        <span class="fa fa-calendar"></span> <a title="Tanggal Lahir" class="pull-right-container" id="lbltgllahir"><?php echo $key->tglLahir;?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <span class="fa fa-user"></span> <a title="PISA" class="pull-right-container" id="lblpisa">Istri</a>
                                    </li>

                                    <li class="list-group-item">
                                        <span class="fa fa-hospital-o"></span> <a title="Hak Kelas Rawat" class="pull-right-container" id="lblhakkelas">Kelas <?php echo $key->pisa;?></a>
                                        <input type="" id="txtpisa" name="txtpisa" value="<?php echo $key->pisa;?>">
                                        <input type="" id="txtkdklspst" name="txtkdklspst" value="<?php echo $key->pisa;?>">
                                    </li>
                                    <li class="list-group-item">
                                        <span class="fa fa-stethoscope"></span>  <a title="Faskes Tingkat 1" class="pull-right-container" id="lblfktp"><?php echo $key->provPerujuk_kode;?> - <?php echo $key->provPerujuk_nama;?></a>
                                        <input type="" id="txtppkasalpst" name="txtppkasalpst" value="<?php echo $key->provPerujuk_kode;?>">
                                    </li>
                                    <li class="list-group-item">
                                        <span class="fa fa-calendar"></span>  <a title="TMT dan TAT Peserta" class="pull-right-container" id="lbltmt_tat"><?php echo $key->tglTMT;?> s.d <?php echo $key->tglTAT;?></a>
                                        <input id="txttmtpst" name="txttmtpst" type="" value="<?php echo $key->tglTMT;?>">
                                    </li>
                                    <li class="list-group-item">
                                        <span class="fa fa-calendar"></span>  <a title="Jenis Peserta" class="pull-right-container" id="lblpeserta"><?php echo $key->jenisPeserta_keterangan;?></a>
                                        <input type="" id="txtjnspst" name="txtjnspst" value="<?php echo $key->jenisPeserta_kode;?>">
                                    </li>

                                </ul>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_2">
                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                        <span class="fa fa-sort-numeric-asc"></span> <a title="No. Asuransi" class="pull-right-container" id="lblnoasu"><?php echo $key->cob_noAsuransi;?></a>
                                        <input type="" id="txtkdasu" name="txtkdasu" value="<?php echo $key->cob_noAsuransi;?>">
                                    </li>
                                    <li class="list-group-item">
                                        <span class="fa fa-windows"></span> <a title="Nama Asuransi" class="pull-right-container" id="lblnmasu"><?php echo $key->cob_nmAsuransi;?></a>

                                    </li>
                                    <li class="list-group-item">
                                        <span class="fa fa-calendar"></span> <a title="TMT dan TAT Asuransi" class="pull-right-container" id="lbltmt_tatasu"><?php echo $key->cob_tglTMT;?> s.d <?php echo $key->cob_tglTAT;?></a>
                                        <input type="" id="txttmtasu" name="txttmtasu" value="<?php echo $key->cob_tglTMT;?>">
                                        <input type="" id="txttatasu" name="txttatasu" value="<?php echo $key->cob_tglTAT;?>">
                                    </li>
                                    <li class="list-group-item">
                                        <span class="fa fa-bank"></span> <a title="Nama Badan Usaha" class="pull-right-container" id="lblnamabu"></a>
                                        <input type="" id="txtkdbu" name="txtkdbu" value="" placeholder="kd bu">
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
                        <label class="pull-right" style="font-size:larger" id="lbljenpel"><?php echo $key->pelayanan_nama;?></label>
                        <input type="" id="txtjenpel" name="txtjenpel" value="<?php echo $key->pelayanan_kode;?>" placeholder="jenis pelayanan">
                        <input type="" id="txtID_TARIF" name="txtID_TARIF" placeholder="id tarif">
                        <input type="" id="txt_normesyst" name="txt_normesyst" placeholder="txt_normesyst" value="<?php echo $key->mr_noMR;?>" placeholder="NORM e-syst">
                        <input type="" id="txt_nodaftaresyst" name="txt_nodaftaresyst" placeholder="txt_nodaftaresyst" value="<?php echo $key->NODAFTAR;?>" placeholder="No daftar">
                        <input type="" id="txt_nosep" name="txt_nosep" placeholder="txt_nosep" placeholder="No SEP">
                    </div>
                    <!-- form input -->
                    
                        <input type="" id="txtprsklaimsep" name="txtprsklaimsep" value="0" placeholder="txtprsklaimsep">
                        <div class="box-body">
                            <div>
                                <label style="color:red;font-size:small">* Wajib Diisi</label>
                                <input type="" class="form-control" id="id_insert_sep" name="id_insert_sep" value="" placeholder="id insert sep">
                            </div>
                            <div class="form-group" id="divPoli">
                                <label class="col-md-3 col-sm-3 col-xs-12 control-label">Spesialis/SubSpesialis <label style="color:red;font-size:small">*</label></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <label><input type="checkbox" id="chkpoliesekutif" name="chkpoliesekutif" readonly=""> Eksekutif</label>
                                        </span>
                                        <input type="text" class="form-control ui-autocomplete-input" id="txtnmpoli" name="txtnmpoli" maxlength="10" placeholder="ketik kode atau nama Spesialis/Subspesialis min 3 karakter" autocomplete="off" disabled="" value="<?php echo $key->poliRujukan_nama;?>">
                                        <input type="" class="form-control" id="txtkdpoli" name="txtkdpoli" value="<?php echo $key->poliRujukan_kode;?>">
                                    </div>
                                </div>
                            </div>
                            <div id="divRujukan">
                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-12 control-label">Asal Rujukan</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select class="form-control" id="cbasalrujukan" name="cbasalrujukan">
                                            <option value="1" <?php if($key->asalFaskes=="1"){echo "selected";}?> >Faskes Tingkat 1</option>
                                            <option value="2" <?php if($key->asalFaskes=="2"){echo "selected";}?> >Faskes Tingkat 2</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-12 control-label">PPK Asal Rujukan <label style="color:red;font-size:small">*</label></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" class="form-control ui-autocomplete-input" id="txtppkasalrujukan" name="txtppkasalrujukan" placeholder="ketik kode atau nama ppk asal rujukan min 3 karakter" autocomplete="off" readonly="" value="<?php echo $key->provPerujuk_nama;?>">
                                        <input type="" class="form-control" id="txtkdppkasalrujukan" name="txtkdppkasalrujukan" value="<?php echo $key->provPerujuk_kode;?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-12 control-label"><label style="color:gray;font-size:x-small">(yyyy-mm-dd)</label> Tgl.Rujukan</label>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="input-group date">
                                            <input type="text" class="form-control datepicker" id="txttglrujukan" name="txttglrujukan" placeholder="yyyy-MM-dd" maxlength="10" readonly="" value="<?php echo $key->tglKunjungan;?>">
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
                                        <input type="text" class="form-control" id="txtnorujukan" name="txtnorujukan" placeholder="ketik nomor rujukan" maxlength="19" readonly="" value="<?php echo $key->noKunjungan;?>">
                                    </div>
                                </div>
                            </div>
                            <!-- kontrol -->
                            <div id="divkontrol" style="display: block;">
                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-12 control-label" id="lblkontrol">No.Surat Kontrol/SKDP <label style="color:red;font-size:small">*</label></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" class="form-control" id="txtnosuratkontrol" name="txtnosuratkontrol" placeholder="ketik nomor surat kontrol" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" maxlength="6">
                                        <input type="" id="txtidkontrol" name="txtidkontrol" value="" placeholder="id Kontrol">
                                        <input type="" id="txtnosuratkontrollama" name="txtnosuratkontrollama" value="" placeholder="nosurat kontrol lama">
                                        <input type="" id="txtpoliasalkontrol" name="txtpoliasalkontrol" value="" placeholder="poli asal kontrol">
                                        <input type="" id="txttglsepasalkontrol" name="txttglsepasalkontrol" value="" placeholder="sep asal">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-12 control-label">DPJP Pemberi Surat SKDP/SPRI <label style="color:red;font-size:small">*</label></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select class="form-control" id="txtnmdpjp" name="txtnmdpjp">
                                            <option value=""> == || == </option>
                                            <option value="14921">Dr. Eko, S.PM</option>
                                        </select>
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
                                        <input type="text" class="form-control" id="txtnomr" name="txtnomr" placeholder="ketik nomor MR" maxlength="10" readonly="" value="<?php echo substr($key->mr_noMR, 3);?>">
                                        <span class="input-group-addon">
                                            <label><input type="checkbox" id="chkCOB" name="chkCOB" value=""> Peserta COB</label>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" id="divkelasrawat" style="display: show;">
                                <label class="col-md-3 col-sm-3 col-xs-12 control-label">Kelas Rawat</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select class="form-control" id="cbKelas" name="cbKelas" >
                                        <option value="<?php echo $key->pisa;?>">Kelas <?php echo $key->pisa;?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12 control-label">Diagnosa <label style="color:red;font-size:small">*</label></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control ui-autocomplete-input" class="form-control select2" multiple="multiple" id="txtnmdiagnosa" name="txtnmdiagnosa" maxlength="10" placeholder="ketik kode atau nama diagnosa min 3 karakter" autocomplete="on" onkeyup="get_diagnosa();">
                                    <label id="lblDxSpesialistik" style="color: red; display: show;"></label>
                                    <input type="" class="form-control" id="txtkddiagnosa" name="txtkddiagnosa" value="H54.5">
                                </div>
                            </div>


                            <div class="form-group" id="divtujuankunj" style="display: show;">
                                <label class="col-md-3 col-sm-3 col-xs-12 control-label">Tujuan Kunjungan</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select class="form-control" id="tujuanKunj" name="tujuanKunj" >
                                        <option value="-">-- Silahkan Pilih --</option>
                                        <option value="0">Normal</option>
                                        <option value="1">Prosedur</option>
                                        <option value="2">Konsul Dokter</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="divprosedur" style="display: show;">
                                <label class="col-md-3 col-sm-3 col-xs-12 control-label">Prosedur</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select class="form-control" id="flagProcedure" name="flagProcedure" >
                                        <option value="-">-- Silahkan Pilih --</option>
                                        <option value="0">Prosedur Tidak Berkelanjutan</option>
                                        <option value="1">Prosedur dan Terapi Berkelanjutan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="divpenunjang" style="display: show;">
                                <label class="col-md-3 col-sm-3 col-xs-12 control-label">Penunjang</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select class="form-control" id="kdPenunjang" name="kdPenunjang" >
                                        <option value="-">-- Silahkan Pilih --</option>
                                        <option value="1">Radioterapi</option>
                                        <option value="2">Kemoterapi</option>
                                        <option value="3">Rehabilitasi Medik</option>
                                        <option value="4">Rehabilitasi Psikososial</option>
                                        <option value="5">Transfusi Darah</option>
                                        <option value="6">Pelayanan Gigi</option>
                                        <option value="7">Laboratorium</option>
                                        <option value="8">USG</option>
                                        <option value="9">Farmasi</option>
                                        <option value="10">Lain-Lain</option>
                                        <option value="11">MRI</option>
                                        <option value="12">HEMODIALISA</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="divassesmentPel" style="display: show;">
                                <label class="col-md-3 col-sm-3 col-xs-12 control-label">Assesment</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select class="form-control" id="assesmentPel" name="assesmentPel" >
                                        <option value="-">-- Silahkan Pilih --</option>
                                        <option value="1">Poli spesialis tidak tersedia pada hari sebelumnya</option>
                                        <option value="2">Jam Poli telah berakhir pada hari sebelumnya</option>
                                        <option value="3">Dokter Spesialis yang dimaksud tidak praktek pada hari sebelumnya</option>
                                        <option value="4">Atas Instruksi RS</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12 control-label">No. Telepon <label style="color:red;font-size:small">*</label></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" id="txtnotelp" name="txtnotelp" placeholder="ketik nomor telepon yang dapat dihubungi" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" maxlength="15" value="<?php echo $key->mr_noTelepon;?>">
                                </div>
                            </div>

                            <?php
                                $pelayanan_kode = $key->pelayanan_kode;
                                if ($pelayanan_kode=='2') {
                            ?>
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12 control-label">DPJP Rawat Jalan <label style="color:red;font-size:small">*</label></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select class="form-control" id="nmdpjpLayan" name="nmdpjpLayan">
                                        <option value=""> == || == </option>
                                        <option value="14921">Dr. Eko, S.PM</option>
                                    </select>
                                    <input type="text" class="form-control" id="dpjpLayan" name="dpjpLayan" placeholder="DPJP Rawat Jalan" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" maxlength="15" value="">
                                </div>
                            </div>
                            <?php
                                }else{}
                            ?>

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
                                <!-- <button type="button" id="btnEdit" class="btn btn-warning pull-left"><i class="fa fa-pencil"></i> Edit</button> -->
                                <!-- <button type="button" id="btnHapus" class="btn btn-danger pull-left"><i class="fa fa-eraser"></i> Hapus</button> -->
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
<?php
    }
?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="<?=base_url('assets/_controller/bridging_bpjs/create_sep.js')?>"></script>