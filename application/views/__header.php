<style>
    .example-modal .modal {
      position: relative;
      top: auto;
      bottom: auto;
      right: auto;
      left: auto;
      display: block;
      z-index: 1;
    }

    .example-modal .modal {
      background: transparent !important;
    }
    .scroll{
        display:block;
        border: 1px solid white;
        padding:5px;
        margin-top:5px;
        width:100%;
        height:400px;
        overflow:scroll;
    }
    /*.auto{
         display:block;
         border: 1px solid red;
         padding:5px;
         margin-top:5px;
         width:300px;
         height:50px;
         overflow:auto;
    }*/
  </style>
<header class="main-header">
  <!-- Logo -->
  <a href="#" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>A</b>LT</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>e-Syst </b>EDC</span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button" id="hide_menu">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </a>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- Messages: style can be found in dropdown.less-->
        <!-- pasien -->
        <li class="dropdown messages-menu" id="perubahan_pasien">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-user-md"></i>
            <span class="label label-danger" id="notif_pasien">4</span>
          </a>
          <ul class="dropdown-menu">
            <li class="header" id="notif_jumlah_ket_pasien">You have 4 messages</li>
            <li>
              <!-- inner menu: contains the actual data -->
              <ul class="menu" id="list_notif_kd_gol">
                <li><!-- start message -->
                  <a href="#">
                    <div class="pull-left">
                      <img src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                    </div>
                    <h4>
                      Support Team
                      <small><i class="fa fa-clock-o"></i> 5 mins</small>
                    </h4>
                    <p>Why not buy a new awesome theme?</p>
                  </a>
                </li><!-- end message -->
              </ul>
            </li>
            <li class="footer"><a href="#">Notifikasi Pasien</a></li>
          </ul>
        </li>

        
        <li class="dropdown messages-menu" id="panggil_antrian_p">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-users"></i>
            <span class="label label-danger" id="jum_antrian">4</span>
          </a>
          <ul class="dropdown-menu">
            <li class="header" id="notif_ket_jum_antrian">You have 4 messages</li>
            <li>
              <!-- inner menu: contains the actual data -->
              <ul class="menu" >
                <li id="panggil_pasien_u"><!-- start message -->
                  <a href="#">
                    <div class="pull-left">
                      <span class="glyphicon glyphicon-play" alt="User Image"></span>
                    </div>
                    <h4>
                      Panggil Pasien Umum
                      <small class="label label-danger" id="total_antrian_umum"> 5 pasien</small>
                    </h4>
                    <!-- <p>Why not buy a new awesome theme?</p> -->
                  </a>
                </li>
                <li id="panggil_pasien_b">
                  <a href="#">
                    <div class="pull-left">
                      <span class="glyphicon glyphicon-play" alt="User Image"></span>
                    </div>
                    <h4>
                      Panggil Pasien BPJS
                      <small class="label label-danger" id="total_antrian_bpjs"> 5 pasien</small>
                    </h4>
                    <!-- <p>Why not buy a new awesome theme?</p> -->
                  </a>
                </li><!-- end message -->
                <li id="show_modal" data-toggle="modal" data-target="#modal-antrian"></li>
                <li id="show_modal_px_lama" data-toggle="modal" data-target="#modal-px_lama"></li>
              </ul>
            </li>
            <li class="footer"><a href="#">Antrian Pasien</a></li>
          </ul>
        </li>

        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
            <span class="hidden-xs"><?=$this->session->userdata('username')?></span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
              <p>
                <div id="nm_user"><?=$this->session->userdata('username')?></div>
                <div id="lagu"></div>
                <small >Pegawai <?=$this->session->userdata('outlet')?></small>
              </p>
            </li>
            <div id="kode_outlet" hidden><?=$this->session->userdata('outlet')?></div>
            <!-- Menu Body -->
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <!-- <a href="#" class="btn btn-default btn-flat">Profile</a> -->
              </div>
              <div class="pull-right">
                <a href="<?php echo base_url();?>index.php/login/logout" class="btn btn-default btn-flat">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
        <!-- Control Sidebar Toggle Button -->
        <li>
          <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
        </li>
      </ul>
    </div>
  </nav>
</header>
<div class="modal fade" id="modal-antrian">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Deskripsi Pasien</h4>
      </div>
      <div class="modal-body">
        <form id="form_persiapan_pendaftaran_no_dantrian_pasien_baru">
          <!-- /.box-header -->
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <div class="col-md-6">
                    <button type="button" class="btn btn-primary" id="cari_px_lama_notif">Cari Pasien Lama</button>
                  </div>
                  <div class="col-md-6">
                    <button type="button" class="btn btn-warning" id="panggil_ulang">Panggil Ulang</button>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <div class="col-md-6">
                    <label>NIK <code>*</code></label>
                    <input type="hidden" name="idperusahaan_pasien_modal" id="idperusahaan_pasien_modal" class="form-control" style="width: 100%;">
                    <input type="hidden" name="idantrian_pasien_modal" id="idantrian_pasien_modal" class="form-control" style="width: 100%;">
                    <input type="hidden" name="noantrian_pasien_modal" id="noantrian_pasien_modal" class="form-control" style="width: 100%;">
                    <input type="hidden" name="norm_pasien_modal" id="norm_pasien_modal" class="form-control" style="width: 100%;">
                    <input type="text" name="nik_pasien_modal" id="nik_pasien_modal" class="form-control" maxlength="16" style="width: 100%;">
                  </div>
                  <div class="col-md-6">
                    <label>Nama Pasien <code>*</code></label>
                    <input type="text" name="nama_pasien_modal" id="nama_pasien_modal" class="form-control" style="width: 100%;">
                  </div>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-md-12">
                <div class="form-group">
                  <div class="col-md-6">
                    <label>Jenis Kelamin <code>*</code></label>
                    <select name="jenis_kelamin_modal" id="jenis_kelamin_modal" class="form-control" style="width: 100%;">
                      <option value=""> == || == </option>
                      <option value="Laki-laki"> Laki-laki </option>
                      <option value="Perempuan"> Perempuan </option>
                    </select>
                  </div>
                  <div class="col-md-6">
                      <label>Tanggal Lahir <code>*</code></label>
                      <input type="date" name="tgl_lahir_modal" id="tgl_lahir_modal" class="form-control" style="width: 100%;">
                  </div>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-md-12">
                <div class="form-group">
                  <div class="col-md-6">
                    <label>Tempat Lahir </label>
                    <input type="text" name="tempat_lahir_modal" id="tempat_lahir_modal" class="form-control" style="width: 100%;">
                  </div>
                  <div class="col-md-6">
                    <label>Pekerjaan </label>
                    <select class="form-control" style="width: 100%;" name="pekerjaan_modal" id="pekerjaan_modal">
                      <option value="">== || ==</option>
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
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <div class="col-md-6">
                      <label>Provinsi</label>
                      <select name="provinsi_modal" id="provinsi_modal" class="form-control select2" style="width: 100%;">
                        <option value=""> == || == </option>
                      </select>
                      <input type="hidden" name="provinsi_lama_modal" id="provinsi_lama_modal" class="form-control" maxlength="12" style="width: 100%;">
                  </div>
                  <div class="col-md-6">
                    <label>Kabupaten</label>
                    <select name="kabupaten_modal" id="kabupaten_modal" class="form-control select2" style="width: 100%;">
                      <option value=""> == || == </option>
                    </select>
                    <input type="hidden" name="kabupaten_lama_modal" id="kabupaten_lama_modal" class="form-control" maxlength="12" style="width: 100%;">
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <div class="col-md-6">
                      <label>Kecamatan</label>
                      <select name="kecamatan_modal" id="kecamatan_modal" class="form-control select2" style="width: 100%;">
                        <option value=""> == || == </option>
                    </select>
                    <input type="hidden" name="kecamatan_lama_modal" id="kecamatan_lama_modal" class="form-control" maxlength="12" style="width: 100%;">
                  </div>
                  <!-- /.form-group -->
                  <div class="col-md-6">
                    <label>Desa</label>
                    <select name="desa_modal" id="desa_modal" class="form-control select2" style="width: 100%;">
                        <option value=""> == || == </option>
                    </select>
                    <input type="hidden" name="desa_lama_modal" id="desa_lama_modal" class="form-control" maxlength="12" style="width: 100%;">
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <div class="col-md-6">
                    <label>Alamat Lengkap </label>
                    <textarea name="alamat_pasien_modal" id="alamat_pasien_modal" class="form-control" style="width: 100%;"></textarea>
                  </div>
                  <div class="col-md-6">
                    <label>No Telpon </label>
                    <input type="text" name="tlpon_pasien_modal" id="tlpon_pasien_modal" class="form-control" maxlength="12" style="width: 100%;">
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <div class="col-md-6">
                    <label>Golongan Pasien <code>*</code></label>
                    <select name="golongan_pasien_modal" id="golongan_pasien_modal" class="form-control" style="width: 100%;">
                      <option value=""> == || == </option>
                      <option value="UMUM"> UMUM </option>
                      <option value="BPJS"> BPJS </option>
                      <option value="GRATIS">GRATIS</option>
                    </select>
                  </div>
                  <div class="col-md-6" id="token_humas_modal">
                    <label>Token Voucher </label>
                    <input type="text" name="token_voucher_modal" id="token_voucher_modal" class="form-control" style="width: 100%;" maxlength="19">
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <div class="col-md-6" id="layout_norujukan_modal">
                    <label>No Rujukan </label>
                    <input type="text" name="no_rujukan_modal" id="no_rujukan_modal" class="form-control" style="width: 100%;" maxlength="19">
                  </div>
                </div>
              </div>
            <!-- /.row -->
          </div>
          <!-- row -->
          <!-- end form input pasien baru -->
          <!-- /.box-body -->
          <!-- <div class="box-footer">
            <button type="button" class="btn btn-success btn-flat pull-right" id="daftarkan_antrian_px_baru">Daftarkan Pasien</button>
          </div> -->
        <!-- /.box -->
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" id="close_modal" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-success" data-dismiss="modal" id="daftarkan_pasien_berdasarkan_no_antri">Simpan</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal" id="modal-px_lama">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close_modal_px_lama">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Data Pasien Lama</h4>
      </div>
      <div class="modal-body">
        <!-- <p>One fine body&hellip;</p> -->
        <div class="scroll">
          <div class="box-header">
            <form id="form_pendaftaran_no_dantrian_pasien_lama">
            <div class="col-md-12">
              <div class="form-group">
                <div class="col-md-6">
                  <label>No Kartu Pasien</label>
                  <input type="text" class="form-control" name="no_kartu_pasien" id="no_kartu_pasien" style="width: 100%;">
                </div>
                <div class="col-md-6">
                  <label>NIK</label>
                  <input type="text" class="form-control" maxlength="13" style="width: 100%;" name="nik_pasien_lama" id="nik_pasien_lama">
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                  <div class="col-md-3">
                    <label>Nama Pasien</label>
                    <input type="text" class="form-control" name="nama_pasien_lama" id="nama_pasien_lama" style="width: 100%;">
                  </div>
                  <div class="col-md-3">
                    <label>Tgl Lahir</label>
                    <input type="text" class="form-control" maxlength="13" style="width: 100%;" name="tgl_lahir_lama" id="tgl_lahir_lama">
                  </div>
                  <div class="col-md-3">
                    <label>Alamat</label>
                    <textarea class="form-control" name="alamat_pasien_lama" id="alamat_pasien_lama" style="width: 100%;" cols="10" rows="1"></textarea>
                  </div>
                  <div class="col-md-3">
                    <label>Cari</label>
                    <br>
                    <button type="button" class="btn btn-success btn-flat pull-left" id="cari_data2"><i class="fa fa-search"></i></button>
                  </div>
              </div>
            </div>
            </form>
            <br>
            <p>List Data Pasien</p>
            <div class="table-responsive">
            <table id="daftar_pencarian_pasien_antrian" class="table table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>NORM</th>
                    <th>Nama</th>
                    <th>NIK</th>
                    <th>Alamat</th>
                    <th hidden>JK</th>
                    <th hidden>Tgl Lahir</th>
                    <th hidden>Tempat Lahir</th>
                    <th hidden>Provinsi</th>
                    <th hidden>Kabupaten</th>
                    <th hidden>Kecamatan</th>
                    <th hidden>Desa</th>
                    <th hidden>Telp</th>
                    <th hidden>pekerjaan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody id="tbody_daftar_pencarian_pasien_antrian2"></tbody>
              </table>
              </div>
              <br>
          <!-- /.box-header -->
          </div>
            <div class="box-body no-padding">              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal" onclick="close_modal_px_lama();">Tutup</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-selamat" id="selamat">Selamat</button>

<!-- <div class="modal fade" id="modal-selamat">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Selamat Ulang Tahun Sayang ku <i class="fa fa-heart"></i></h4>
      </div>
      <div class="modal-body">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
            <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
          </ol>
          <div class="carousel-inner">
            <div class="item active">
              <img src="<?php echo base_url();?>lagu/ulang-tahun-islami.jpg" alt="First slide">

              <div class="carousel-caption">
                Katakan " I
              </div>
            </div>
            <div class="item">
              <center><img src="<?php echo base_url();?>lagu/kuelia.jpg" alt="Second slide" height="450" width="250"></center>

              <div class="carousel-caption">
                Love
              </div>
            </div>
            <div class="item">
              <center><img src="<?php echo base_url();?>lagu/emalia.jpeg" alt="Third slide" height="450" width="250"></center>

              <div class="carousel-caption">
                You"
              </div>
            </div>
          </div>
          <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
            <span class="fa fa-angle-left"></span>
          </a>
          <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
            <span class="fa fa-angle-right"></span>
          </a>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  
  </div>
  
</div> -->
<!-- /.modal -->

<script type="text/javascript">
  $(document).ready(function() {
    var role_parent = $('#role_permision').html();
    $('#selamat').hide();
    get_role_parent_pegawai();
    backup_sisa_stok_obat_harian();
  });
  function backup_sisa_stok_obat_harian(){
    var no_token = token_temp();
    $.ajax({
      type      : 'POST',
      url       : '<?php echo site_url("farmasi_obat/Sisa_stock_harian")?>',
      async     : false,
      data      : 'csrf_klinik_mata_edc='+no_token,
      dataType  : 'json',
      success   : function(data){
        console.log(data);
      }
    });
  }
  function get_role_parent_pegawai(){
    var no_token = token_temp();
    $.ajax({
      type      : 'POST',
      url       : '<?php echo site_url("daftar_antrian/Daftar_antrian_pasien/get_nip_pegawai")?>',
      async     : false,
      data      : 'csrf_klinik_mata_edc='+no_token,
      dataType  : 'json',
      success   : function(data){
        // console.log(data);
        if (data.id_role==9 || data.id_role==37) {
          var id_out = $('#kode_outlet').html();
          if (id_out=='MJG' || id_out=='HLD' || id_out=='TLG' || id_out=='NGJ') {
            var refreshId = setInterval(function(){
              get_jum_antrian();
            }, 15000);
          }
        }
      }
    });
  }
  function get_jum_antrian(){
    var no_token = token_temp();
    $.ajax({
      type      : 'POST',
      url       : '<?php echo site_url("notifikasi/notifikasi/get_jum_antrian")?>',
      async     : false,
      data      : 'csrf_klinik_mata_edc='+no_token,
      dataType  : 'json',
      success   : function(data){
        // console.log(data);
        // get_notif_pasien();
        $('#jum_antrian').html(data.jum_semua_antrian);
        $('#total_antrian_umum').html(data.total_antrian_umum);
        $('#total_antrian_bpjs').html(data.total_antrian_bpjs);
        $('#notif_ket_jum_antrian').html('Anda memiliki '+data.jum_semua_antrian+' notifikasi');
      }
    });
  }
  $('#panggil_pasien_u').on('click', function(){
    // alert('panggil pasien umum');
    var jumlah_pasien_u = $('#total_antrian_umum').html();
    if (jumlah_pasien_u==0) {
      swal("Maaf Tidak Ada Antrian Pasien Yang di Panggil", {
              icon: "warning",
            });
    }else{
      update_jum_antrian_umum();
    }
  });
  $('#cari_px_lama_notif').on('click', function(){
    $('#close_modal').click();
    $('#show_modal_px_lama').click();
  });
  // $('#pilih_pasien_notif').on('click', function(){
  //   close_modal_px_lama();
  // });
  function close_modal_px_lama(){
    $('#close_modal_px_lama').click();
    $('#show_modal').click();
  }
  function update_jum_antrian_umum(){
    var no_token = token_temp();
    $.ajax({
      type      : 'POST',
      url       : '<?php echo site_url("notifikasi/notifikasi/update_antrian_umum")?>',
      async     : false,
      data      : 'csrf_klinik_mata_edc='+no_token,
      dataType  : 'json',
      success   : function(data){
        console.log(data);
        if (data.data_ruang_periksa.length==0) {
          $('#show_modal').click();
          for (var i = 0; i < data.data_antrian_awal.length; i++) {
            $('#idperusahaan_pasien_modal').val(data.data_antrian_awal[i].ID_PERUSAHAAN);
            $('#idantrian_pasien_modal').val(data.data_antrian_awal[i].id_antrian);
            $('#noantrian_pasien_modal').val(data.data_antrian_awal[i].no_antri);
            $('#norm_pasien_modal').val(data.data_antrian_awal[i].NORM);
            $('#nik_pasien_modal').val(data.data_antrian_awal[i].nik_pasien);
            $('#nama_pasien_modal').val(data.data_antrian_awal[i].nm_pasien);
            $('#jenis_kelamin_modal').val(data.data_antrian_awal[i].JK).trigger('change');
            $('#tgl_lahir_modal').val(data.data_antrian_awal[i].TGL_LAHIR);
            $('#tempat_lahir_modal').val(data.data_antrian_awal[i].TEMPAT_LAHIR);
            $('#pekerjaan_modal').val(data.data_antrian_awal[i].PEKERJAAN).trigger('change');
            // $('#provinsi_modal').val(data[i].PROV);
            // $('#kabupaten_modal').val(data[i].KAB);
            // $('#kecamatan_modal').val(data[i].KEC);
            // $('#desa_modal').val(data[i].DESA);
            $('#alamat_pasien_modal').val(data.data_antrian_awal[i].alamat_p);
            $('#tlpon_pasien_modal').val(data.data_antrian_awal[i].NO_TELP);
            $('#golongan_pasien_modal').val(data.data_antrian_awal[i].GOLONGAN_PASIEN).trigger('change');
            $('#token_voucher_modal').val(data.data_antrian_awal[i].TOKEN_VOUCHER);
            $('#no_rujukan_modal').val(data.data_antrian_awal[i].NO_RUJUKAN);

            // $('#provinsi_lama_modal').val(data[i].PROV);
            $('#kabupaten_lama_modal').val(data.data_antrian_awal[i].KAB);
            $('#kecamatan_lama_modal').val(data.data_antrian_awal[i].KEC);
            $('#desa_lama_modal').val(data.data_antrian_awal[i].DESA);
            var get_nama_provinsi = data.data_antrian_awal[i].PROV;
            provinsi_nottif(get_nama_provinsi);
          }
        }else{
          swal("Maaf Ruangan Masih Terdapat Pasien", {
                icon: "warning",
              });
        }
      }
    }); 
  }
  function provinsi_nottif(get_nama_provinsi){
  var no_token    = token_temp();
  $.ajax({
    type      : 'POST',
    url       : base_url()+'index.php/daftar_antrian/daftar_antrian_pasien/provinsi',
    async     : false,
    data      : 'csrf_klinik_mata_edc='+no_token,
    dataType  : 'json',
    success   : function(data){
      // console.log(data);
      var option_kosong = '<option value=""> == || == </option>';
      var option = '';
      var provinsi = data.provinsi;
      for (var i = 0; i < provinsi.length; i++) {
        option += '<option value="'+provinsi[i].nama+','+provinsi[i].id+'"> '+provinsi[i].nama+' </option>';
      }
      $('#provinsi_modal').html(option_kosong+option);
      if (get_nama_provinsi!='') {
        $('#provinsi_modal').val(get_nama_provinsi).trigger("change");
      }
    }
  });
}
$("#provinsi_modal").change(function(){
    var get_id_prov = $(this).val().split(",");
    var get_nama_kabupaten = $("#kabupaten_lama_modal").val();
    // var get_nama_kabupaten = 'OK';
    // alert(get_nama_kabupaten);
    get_data_kabupaten_nottif(get_id_prov, get_nama_kabupaten);
  });
function get_data_kabupaten_nottif(id_provinsi, get_nama_kabupaten){
  var id_prov   = id_provinsi[1];
  var no_token  = token_temp();
  $.ajax({
    type      : 'POST',
    url       : base_url()+'index.php/daftar_antrian/daftar_antrian_pasien/kabupaten',
    async     : false,
    data      : 'csrf_klinik_mata_edc='+no_token+'&id_provinsi='+id_prov,
    dataType  : 'json',
    success   : function(data){
      console.log(data);
      var option_kosong = '<option value=""> == || == </option>';
      var option = '';
      var kabupaten = data.kota_kabupaten;
      for (var i = 0; i < kabupaten.length; i++) {
        option += '<option value="'+kabupaten[i].nama+','+kabupaten[i].id+'"> '+kabupaten[i].nama+' </option>';
      }
      $('#kabupaten_modal').html(option_kosong+option);
      if (get_nama_kabupaten!='') {
        var kabupaten = get_nama_kabupaten.substr(4);
        var kab = get_nama_kabupaten.substr(0,4);
        if (kab=='Kab.') {
          var hasil = 'Kabupaten'+kabupaten;
        }else{
          var hasil = get_nama_kabupaten;
        }
        $('#kabupaten_modal').val(hasil).trigger("change");
      }
    }
  });
}
$("#kabupaten_modal").change(function(){
    var get_id_kab          = $(this).val().split(",");
    // var get_id_kab          = $(this).val();
    // alert(get_id_kab);
    var get_nama_kecamatan  = $("#kecamatan_lama_modal").val();
    get_data_kecamatan_nottif(get_id_kab, get_nama_kecamatan);
  });
function get_data_kecamatan_nottif(id_kabupaten, get_nama_kecamatan){
  var id_kab  = id_kabupaten[1];
  // var id_prov = id_provinsi[1];
  // alert(id_kab);
  var no_token    = token_temp();
  $.ajax({
    type      : 'POST',
    url       : base_url()+'index.php/daftar_antrian/daftar_antrian_pasien/kecamatan',
    async     : false,
    data      : 'csrf_klinik_mata_edc='+no_token+'&id_kabupaten='+id_kab,
    dataType  : 'json',
    success   : function(data){
      console.log(data);
      var option_kosong = '<option value=""> == || == </option>';
      var option        = '';
      var kecamatan     = data.kecamatan;
      for (var i = 0; i < kecamatan.length; i++) {
        option += '<option value="'+kecamatan[i].nama+','+kecamatan[i].id+'"> '+kecamatan[i].nama+' </option>';
      }
      $('#kecamatan_modal').html(option_kosong+option);
      if (get_nama_kecamatan!='') {
        var hasil = get_nama_kecamatan.trim();
        $('#kecamatan_modal').val(hasil).trigger("change");
      }
    }
  });
}
$("#kecamatan_modal").change(function(){
    var get_id_kec = $(this).val().split(",");
    var get_nama_desa = $("#desa_lama_modal").val();
    get_data_desa_nottif(get_id_kec, get_nama_desa);
});
function get_data_desa_nottif(get_id_kec, get_nama_desa){
  var id_kec = get_id_kec[1];
  var no_token    = token_temp();
  $.ajax({
    type      : 'POST',
    url       : base_url()+'index.php/daftar_antrian/daftar_antrian_pasien/desa',
    async     : false,
    data      : 'csrf_klinik_mata_edc='+no_token+'&id_kecamatan='+id_kec,
    dataType  : 'json',
    success   : function(data){
      // console.log(data);
      var option_kosong = '<option value=""> == || == </option>';
      var option        = '';
      var desa     = data.kelurahan;
      for (var i = 0; i < desa.length; i++) {
        option += '<option value="'+desa[i].nama+'"> '+desa[i].nama+' </option>';
      }
      // $('#desa_baru').html(option_kosong+option);
      $('#desa_modal').html(option_kosong+option);
      if (get_nama_desa!='') {
        $('#desa_modal').val(get_nama_desa).trigger("change");
      }
    }
  });
}
$('#golongan_pasien_modal').change(function(){
  var golongan_pasien = $('#golongan_pasien_modal').val();
  if (golongan_pasien=='BPJS') {
    $('#layout_norujukan_modal').show();
    $('#token_humas_modal').show();
  }else if(golongan_pasien=='GRATIS') {
    $('#layout_norujukan_modal').hide();
    $('#token_humas_modal').show();
  }else{
    $('#layout_norujukan_modal').hide();
    $('#token_humas_modal').hide();
  }
});
  $('#daftarkan_pasien_berdasarkan_no_antri').on('click', function(){
    var form_data_untuk_pendaftaran_pasien = $('#form_persiapan_pendaftaran_no_dantrian_pasien_baru').serialize();
    // alert(form_data_untuk_pendaftaran_pasien);
    daftarkan_pasien_berdasarkan_no_antri(form_data_untuk_pendaftaran_pasien);
  });
  $('#panggil_pasien_b').on('click', function(){
    // alert('panggil pasien BPJS');
    var jumlah_pasien_b = $('#total_antrian_bpjs').html();
    if (jumlah_pasien_b==0) {
      swal("Maaf Tidak Ada Antrian Pasien Yang di Panggil", {
              icon: "warning",
            });
    }else{
      update_jum_antrian_bpjs();
    }
  });
  function update_jum_antrian_bpjs(){
    var no_token    = token_temp();
    $.ajax({
      type      : 'POST',
      url       : '<?php echo site_url("notifikasi/notifikasi/update_antrian_bpjs")?>',
      async     : false,
      data      : 'csrf_klinik_mata_edc='+no_token,
      dataType  : 'json',
      success   : function(data){
        console.log(data);
        if (data.data_ruang_periksa.length==0) {
          $('#show_modal').click();
          // alert(data.data_antrian_awal.length);
          for (var i = 0; i < data.data_antrian_awal.length; i++) {
            $('#idperusahaan_pasien_modal').val(data.data_antrian_awal[i].ID_PERUSAHAAN);
            $('#idantrian_pasien_modal').val(data.data_antrian_awal[i].id_antrian);
            $('#noantrian_pasien_modal').val(data.data_antrian_awal[i].no_antri);
            $('#nik_pasien_modal').val(data.data_antrian_awal[i].nik_pasien);
            $('#nama_pasien_modal').val(data.data_antrian_awal[i].nm_pasien);
            $('#norm_pasien_modal').val(data.data_antrian_awal[i].NORM);
            $('#jenis_kelamin_modal').val(data.data_antrian_awal[i].JK).trigger('change');
            $('#tgl_lahir_modal').val(data.data_antrian_awal[i].TGL_LAHIR);
            $('#tempat_lahir_modal').val(data.data_antrian_awal[i].TEMPAT_LAHIR);
            $('#pekerjaan_modal').val(data.data_antrian_awal[i].PEKERJAAN).trigger('change');
   
            $('#alamat_pasien_modal').val(data.data_antrian_awal[i].alamat_p);
            $('#tlpon_pasien_modal').val(data.data_antrian_awal[i].NO_TELP);
            $('#golongan_pasien_modal').val(data.data_antrian_awal[i].GOLONGAN_PASIEN).trigger('change');
            $('#token_voucher_modal').val(data.data_antrian_awal[i].TOKEN_VOUCHER);
            $('#no_rujukan_modal').val(data.data_antrian_awal[i].NO_RUJUKAN);

            $('#kabupaten_lama_modal').val(data.data_antrian_awal[i].KAB);
            $('#kecamatan_lama_modal').val(data.data_antrian_awal[i].KEC);
            $('#desa_lama_modal').val(data.data_antrian_awal[i].DESA);
            var get_nama_provinsi = data.data_antrian_awal[i].PROV;
            provinsi_nottif(get_nama_provinsi);
          }
        }else{
          swal("Maaf Ruangan Masih Terdapat Pasien!", {
                icon: "warning",
              });
        }
      }
    }); 
  }
  function daftarkan_pasien_berdasarkan_no_antri(form_data_untuk_pendaftaran_pasien){
    var no_token    = token_temp();
    $.ajax({
      type      : 'POST',
      url       : '<?php echo site_url("notifikasi/notifikasi/daftarkan_pasien_dari_noantri")?>',
      async     : false,
      data      : 'csrf_klinik_mata_edc='+no_token+'&'+form_data_untuk_pendaftaran_pasien,
      dataType  : 'json',
      success   : function(data){
        console.log(data);
        if (data=='Benar') {
          swal("Pasien Telah Anda Daftarkan", {
              icon: "success",
          });
          location.href='<?php echo site_url("dashboard/")?>';
        }else{
          swal("Pasien Gagal Di Daftarkan", {
              icon: "warning",
          });
        }
      }
    });
  }
  function batal_daftar_pasien_berdasarkan_no_antri(id_antrian, no_antri){
    var no_token    = token_temp();
    $.ajax({
      type      : 'POST',
      url       : '<?php echo site_url("notifikasi/notifikasi/batal_daftar_pasien_berdasarkan_no_antri")?>',
      async     : false,
      data      : 'csrf_klinik_mata_edc='+no_token+'&id_antrian='+id_antrian+'&no_antri='+no_antri,
      dataType  : 'json',
      success   : function(data){
        console.log(data);
      }
    });
  }
  function get_notif_pasien() {
    var no_token    = token_temp();
    $.ajax({
      type      : 'POST',
      url       : '<?php echo site_url("notifikasi/notifikasi/notifikasi_pasien")?>',
      async     : false,
      data      : 'csrf_klinik_mata_edc='+no_token,
      dataType  : 'json',
      success   : function(data){
        // console.log(data);
        var html = '';
        // alert();
        $('#notif_pasien').html(data.jum_kd_gol);
        $('#notif_jumlah_ket_pasien').html('Anda memiliki '+data.jum_kd_gol+' notifikasi');

        for (var i = 0; i < data.list_kd_gol.length; i++) {
          html += '<li>'+
                    '<a href="#">'+
                      '<div class="pull-left">'+
                        '<img src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">'+
                      '</div>'+
                      '<h4> '+data.list_kd_gol[i].NAMA+' <small><i class="fa fa-clock-o"></i> 5 mins</small></h4>'+
                      '<p style="width: 1%;"><textarea readonly>'+data.list_kd_gol[i].KETERANGAN+'</textarea></p> <small class="pull-right">'+
                      '<form id="'+data.list_kd_gol[i].NODAFTAR+'">'+
                      '<input type="hidden" name="kd_gol_perubahan" id="kd_gol_perubahan" value="'+data.list_kd_gol[i].KODE_PERUBAHAN+'" style="width:50px;" readonly>'+
                      '<input type="hidden" name="norm_kd_gol_perubahan" id="norm_kd_gol_perubahan" value="'+data.list_kd_gol[i].NORM+'" style="width:50px;" readonly>'+
                      '<input type="checkbox" name="nodaftar_kd_gol_perubahan" id="nodaftar_kd_gol_perubahan" value="'+data.list_kd_gol[i].NODAFTAR+'" onclick="update_kd_gol(this.form);"></form>'+
                    '</small></a>'+
                  '</li>';
        }
        $('#list_notif_kd_gol').html(html);
      }
    });
  }
  function update_kd_gol(nodaftar){
    var form_kd_gol = nodaftar.nodaftar_kd_gol_perubahan.value;
    var form_data   = $('#'+form_kd_gol).serialize();
    var no_token    = token_temp();
    $.ajax({
      type      : 'POST',
      url       : '<?php echo site_url("notifikasi/notifikasi/update_perubahan_kd_gol")?>',
      async     : false,
      data      : 'csrf_klinik_mata_edc='+no_token+'&'+form_data,
      dataType  : 'json',
      success   : function(data){
        // console.log(data);
        get_notif_pasien();
      }
    });
  }
  function get_data_pasien_lama(){
    // var form_kd_gol = nodaftar.nodaftar_kd_gol_perubahan.value;
    // var form_data   = $('#'+form_kd_gol).serialize();
    var norm = $('#norm_pasien_modal').val();
    var no_token    = token_temp();
    $.ajax({
      type      : 'POST',
      url       : '<?php echo site_url("notifikasi/notifikasi/update_perubahan_kd_gol")?>',
      async     : false,
      data      : 'csrf_klinik_mata_edc='+no_token+'&'+norm,
      dataType  : 'json',
      success   : function(data){
        // console.log(data);
        get_notif_pasien();
      }
    }); 
  }
$('#cari_data2').click(function(){
  var notoken           = token_temp();
  var form_data_antrian = $('#form_pendaftaran_no_dantrian_pasien_lama2').serialize();
  $.ajax({
    type      : 'POST',
    url       : base_url()+'index.php/daftar_antrian/daftar_antrian_pasien/cari_data_pasien_lama',
    async     : false,
    data      : 'csrf_klinik_mata_edc='+notoken+'&'+form_data_antrian,
    dataType  : 'json',
    success   : function(data){
      // console.log(data);
      if (data=='Data Harus di Isi') {
        alert(data);
      }else{
        if (data.length==0) {
          alert('tidak ada data'); 
        }else{
          var html_pasien = '';
          var no          = 1;
          var pasien_lama = data.pasien_lama;
          for (var i = 0; i < pasien_lama.length; i++) {
            var btn_daftarkan_pasien = '<button type="button" class="btn btn-success btn-flat" id="pilih_pasien_notif">Daftarkan</button>';
            html_pasien += '<tr>'
                            +  '<td>'+no+'</td>'
                            +  '<td>'+pasien_lama[i].NORM+'</td>'
                            +  '<td>'+pasien_lama[i].NAMA+'</td>'
                            +  '<td>'+pasien_lama[i].NIK+'</td>'
                            +  '<td>'+pasien_lama[i].ALAMAT+'</td>'
                            +  '<td hidden>'+pasien_lama[i].JK+'</td>'
                            +  '<td hidden>'+pasien_lama[i].TANGGAL_LAHIR+'</td>'
                            +  '<td hidden>'+pasien_lama[i].TEMPAT_LAHIR+'</td>'
                            +  '<td hidden>'+pasien_lama[i].PROVINSI+'</td>'
                            +  '<td hidden>'+pasien_lama[i].KAB+'</td>'
                            +  '<td hidden>'+pasien_lama[i].KEC+'</td>'
                            +  '<td hidden>'+pasien_lama[i].DESA+'</td>'
                            +  '<td hidden>'+pasien_lama[i].TELP+'</td>'
                            +  '<td hidden>'+pasien_lama[i].PEKERJAAN+'</td>'
                            +  '<td>'+btn_daftarkan_pasien+'</td>'
                            +'</tr>';
                            no++;
          }
          var html_px_baksos    = '';
          var pasien_baksos     = data.pasien_baksos;
          for (var i = 0; i < pasien_baksos.length; i++) {
            var btn_daftarkan_pasien = '<button type="button" class="btn btn-success btn-flat" id="pilih_pasien_notif">Daftarkan</button>';
            html_px_baksos += '<tr>'
                            +  '<td>'+no+'</td>'
                            +  '<td> </td>'
                            +  '<td>'+pasien_baksos[i].NAMA_PASIEN+'</td>'
                            +  '<td>'+pasien_baksos[i].NIK+'</td>'
                            +  '<td>'+pasien_baksos[i].ALAMAT_PASIEN+'</td>'
                            +  '<td hidden>'+pasien_baksos[i].JK+'</td>'
                            +  '<td hidden>'+pasien_baksos[i].TANGGAL_LAHIR+'</td>'
                            +  '<td hidden>'+pasien_baksos[i].TEMPAT_LAHIR+'</td>'
                            +  '<td hidden> </td>'
                            +  '<td hidden> </td>'
                            +  '<td hidden> </td>'
                            +  '<td hidden> </td>'
                            +  '<td hidden> </td>'
                            +  '<td hidden> </td>'
                            +  '<td>'+btn_daftarkan_pasien+'</td>'
                            +'</tr>';
                            no++;
          }
          $('#tbody_daftar_pencarian_pasien_antrian2').html(html_pasien+html_px_baksos);
        }
      }
    }
  });
});
$('#panggil_ulang').on('click', function(){
  var form_panggil_ulang_pasien = $('#form_persiapan_pendaftaran_no_dantrian_pasien_baru').serialize();
  // alert(form_data_untuk_pendaftaran_pasien);
  panggil_ulang_pasien(form_panggil_ulang_pasien);
});
function panggil_ulang_pasien(form_panggil_ulang_pasien){
    var no_token    = token_temp();
    $.ajax({
      type      : 'POST',
      url       : '<?php echo site_url("notifikasi/notifikasi/panggil_ulang_pasien")?>',
      async     : false,
      data      : 'csrf_klinik_mata_edc='+no_token+'&'+form_panggil_ulang_pasien,
      dataType  : 'json',
      success   : function(data){
        console.log(data);
        if (data=='Benar') {
          swal("Pasien Telah Anda Daftarkan", {
              icon: "success",
          });
          location.href='<?php echo site_url("dashboard/")?>';
        }else{
          swal("Pasien Gagal Di Daftarkan", {
              icon: "warning",
          });
        }
      }
    });
  }
$('#daftar_pencarian_pasien_antrian tbody').on('click', '#pilih_pasien_notif', function(){
  var id      = $(this).val();
  var $kolom1 = $(this).parents("tr").find("td:nth-child(1)").text();
  var $kolom2 = $(this).parents("tr").find("td:nth-child(2)").text();
  var $kolom3 = $(this).parents("tr").find("td:nth-child(3)").text();
  var $kolom4 = $(this).parents("tr").find("td:nth-child(4)").text();
  var $kolom5 = $(this).parents("tr").find("td:nth-child(5)").text();
  var $kolom6 = $(this).parents("tr").find("td:nth-child(6)").text();
  var $kolom7 = $(this).parents("tr").find("td:nth-child(7)").text();
  var $kolom8 = $(this).parents("tr").find("td:nth-child(8)").text();
  var $kolom9 = $(this).parents("tr").find("td:nth-child(9)").text();
  var $kolom10 = $(this).parents("tr").find("td:nth-child(10)").text();
  var $kolom11 = $(this).parents("tr").find("td:nth-child(11)").text();
  var $kolom12 = $(this).parents("tr").find("td:nth-child(12)").text();
  var $kolom13 = $(this).parents("tr").find("td:nth-child(13)").text();
  var $kolom14 = $(this).parents("tr").find("td:nth-child(14)").text();
  var id_perusahaan   = String($kolom2).substr(0,3);
  var norm_pasien     = String($kolom2).substr(3);
  if ($kolom4=='null') {
    var nik_pasien = '';
  }else{
    var nik_pasien = $kolom4;
  }
  $('#kabupaten_lama_modal').val($kolom10);
  $('#kecamatan_lama_modal').val($kolom11);
  $('#desa_lama_modal').val($kolom12);
  provinsi_nottif($kolom9);
  $('#idperusahaan_pasien_modal').val(id_perusahaan);
  // $('#norm_pasien_lama').val(norm_pasien);
  $('#norm_pasien_modal').val(id_perusahaan+norm_pasien);
  // $('#nik_pasen_lama').val(nik_pasien);
  $('#nik_pasien_modal').val(nik_pasien);
  // $('#nama_pasien_lama2').val($kolom3);
  $('#nama_pasien_modal').val($kolom3);
  // $('#jenis_kelamin_lama').val($kolom6);
  $('#jenis_kelamin_modal').val($kolom6).trigger('change');
  // $('#tgl_lahir_lama2').val($kolom7);
  $('#tgl_lahir_modal').val($kolom7);
  // $('#tempat_lahir_lama').val($kolom8);
  $('#tempat_lahir_modal').val($kolom8);
  // $('#alamat_pasien_lama2').val($kolom5);
  $('#alamat_pasien_modal').val($kolom5);
  // $('#tlpon_pasien_lama').val($kolom13);
  $('#tlpon_pasien_modal').val($kolom13);
  // $('#pekerjaan').val($kolom14).trigger('change');
  $('#pekerjaan_modal').val($kolom14).trigger('change');
  // $('#layout_norujukan').hide();  
  var norm_pasien_post = $('#norm_pasien_lama').val();
  if (norm_pasien_post=='') {
    $('#norm_pasien_modal').prop('readonly', false);
  }else{
    $('#norm_pasien_modal').prop('readonly', true);
  }
  close_modal_px_lama();
});
</script>