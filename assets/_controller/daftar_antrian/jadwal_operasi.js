$(function(){
  $('.select2').select2();
  get_anrtian_operasi_hari_ini();
  $('#example1').dataTable();
  $('#example2').dataTable();
  tabel_daftar_pasien_operasi();
});
function tabel_daftar_pasien_operasi(){
  $('#tabel_daftar_pasien_operasi').show();
  $('#tabel_daftar_pasien_hari_ini').hide();
  $('#form_pendaftaran_pasien_operasi').hide();
  $('#id_jadwal_op').val('');
  $('#norm').val('');
  $('#nodaftar').val('');
  $('#kode_golongan_jadwal_op').val('');
  $('#norm_palsu').val('');
  $('#nomor_kartu').val('');
  $('#nama_pasien_jadwal_op').val('');
  $('#tgl_operasi').val('');
  $('#jenis_tindakan').val('').trigger("change");
  $('#kode_poli').val('');
  $('#nama_poli').val('');
}
function tabel_daftar_pasien_hari_ini(){
  $('#tabel_daftar_pasien_operasi').hide();
  $('#tabel_daftar_pasien_hari_ini').show();
  $('#form_pendaftaran_pasien_operasi').hide();
}
function form_pendaftaran_pasien_operasi(){
  $('#tabel_daftar_pasien_operasi').hide();
  $('#tabel_daftar_pasien_hari_ini').hide();
  $('#form_pendaftaran_pasien_operasi').show();
  $('#id_jadwal_op').val('');
  $('#norm').val('');
  $('#nodaftar').val('');
  $('#kode_golongan_jadwal_op').val('');
  $('#norm_palsu').val('');
  $('#nomor_kartu').val('');
  $('#nama_pasien_jadwal_op').val('');
  $('#tgl_operasi').val('');
  $('#jenis_tindakan').val('').trigger("change");
  $('#kode_poli').val('');
  $('#nama_poli').val('');
}
$('#tambah_jadwal_operasi').click(function(){
  form_pendaftaran_pasien_operasi();
});
$('#daftar_pasien_sekarang').click(function(){
  tabel_daftar_pasien_hari_ini();
});
$('#btn_batal_jadwal_op').click(function(){
  tabel_daftar_pasien_operasi();
});
$('#btn_batal_jadwal_op').click(function(){
  tabel_daftar_pasien_operasi();
});
function notifikasi(){
  $('body').notify({
    message: 'Hello World',
    type: 'danger'
  });
}
$('#requests').click(function(){
  setTimeout(function(){$(".pesan").fadeIn('slow')}, 500);
  setTimeout(function(){$(".pesan").fadeOut('slow')}, 10000);
});
// To make Pace works on Ajax calls
$(document).ajaxStart(function () {
  Pace.restart()
});
$('.ajax').click(function () {
  $.ajax({
    url: '#', success: function (result) {
      $('.ajax-content').html('<hr>Ajax Request Completed !');
      // provinsi();
    }
  })
});
function show_pendaftaran_antrian(){
  $('#form_pendaftaran_antrian').show();
  // $('#hasil_pendaftaran').hide();
  // $('#list_pasien_lama').show();
  // $('#form_pasien_lama').hide();
  // $('#tab_2').hide();
}
function show_hasil_pendaftaran(){
  $('#form_pendaftaran_antrian').show();
  // $('#hasil_pendaftaran').show();
  // $('#list_pasien_lama').show();
  // $('#form_pasien_lama').hide();
  // $('#tab_2').hide();
}
function get_anrtian_operasi_hari_ini(){
  var notoken = token();
  $.ajax({
    type      : 'POST',
    url       : base_url()+'index.php/medis/Jadwal_operasi/get_anrtian_operasi_hari_ini',
    async     : false,
    data      : 'csrf_klinik_mata_edc='+notoken,
    dataType  : 'json',
    success   : function(data){
      console.log(data);
      var html_antrian  = '';
      var no            = 1;
      for (var i = 0; i < data.length; i++) {
            var pasien_terlayani = data[i].terlaksana;
            if (pasien_terlayani==1) {
              var btn_layani_pasien = '<button type="button" class="btn btn-success btn-flat" id="layani_pasien" value='+data[i].ID_JADWAL_OPERASI+' disabled><i class="fa fa-star"></i></button>';
              var btn_hapus_data    = '<button type="button" class="btn btn-danger btn-flat" id="hapus_data" value='+data[i].ID_JADWAL_OPERASI+' disabled><i class="fa fa-close"></i></button>';
              var btn_edit_data     = '<button type="button" class="btn btn-primary btn-flat" id="edit_data" value='+data[i].ID_JADWAL_OPERASI+' disabled><i class="fa fa-pencil"></i></button>';
            }else{
              var btn_layani_pasien = '<button type="button" class="btn btn-success btn-flat" id="layani_pasien" value='+data[i].ID_JADWAL_OPERASI+'><i class="fa fa-star"></i></button>';
              var btn_hapus_data    = '<button type="button" class="btn btn-danger btn-flat" id="hapus_data" value='+data[i].ID_JADWAL_OPERASI+'><i class="fa fa-close"></i></button>';
              var btn_edit_data     = '<button type="button" class="btn btn-primary btn-flat" id="edit_data" value='+data[i].ID_JADWAL_OPERASI+'><i class="fa fa-pencil"></i></button>';
            }
            html_antrian += '<tr>'
                            +  '<td>'+data[i].NO_ANTRI_OPERASI+'</td>'
                            +  '<td>'+btn_edit_data+' '+btn_layani_pasien+' '+btn_hapus_data+'</td>'
                            +  '<td>'+data[i].kodebooking+'</td>'
                            +  '<td hidden>'+data[i].NORM+'</td>'
                            +  '<td>'+data[i].nopeserta+'</td>'
                            +  '<td>'+data[i].namapeserta+'</td>'
                            +  '<td>'+data[i].tanggaloperasi+'</td>'
                            +  '<td>'+data[i].tgllastupdate+'</td>'
                            +  '<td>'+data[i].namapoli+'</td>'
                            +  '<td>'+data[i].NODAFTAR+'</td>'
                            +  '<td>'+data[i].KODE_GOLONGAN+'</td>'
                            +  '<td>'+data[i].NORM_PALSU+'</td>'
                            +  '<td>'+data[i].jenistindakan+'</td>'
                            +  '<td>'+data[i].kodepoli+'</td>'
                            +'</tr>';
                            no++;
      }
      $('#tbody_jadwal_operasi').html(html_antrian);
    }
  });
}
$('#tambah_jadwal_operasi').click(function(){
  daftar_tindakan_operasi();
});
function daftar_tindakan_operasi(){
  var notoken = token();
    $.ajax({
      type      : 'POST',
      url       : base_url()+'index.php/medis/Jadwal_operasi/daftar_tindakan_operasi',
      async     : false,
      data      : 'csrf_klinik_mata_edc='+notoken,
      dataType  : 'json',
      success   : function(data){
        console.log(data);
        var no   =1;
        var html1  = '';
        var html2  = '';
        var option_kosong_ob = '';
        option_kosong_ob += '<option selected="selected">- || -</option>';
        for (var i = 0; i < data.katarak.length; i++) {
          html1 += '<option value="'+data.katarak[i].nm_tindakan+'">' + data.katarak[i].nm_tindakan+'</option>';
        }
        for (var a = 0; a < data.nonkatarak.length; a++) {
          html2 += '<option value="'+data.nonkatarak[a].nm_tindakan+'">' + data.nonkatarak[a].nm_tindakan+'</option>';
        }
        $("#jenis_tindakan").html(option_kosong_ob+html1+html2);
      }
    });
  }
  $('#daftar_pasien_sekarang').click(function(){
    get_pasien_hari_ini();
  });
  function get_pasien_hari_ini(){
    var notoken = token();
    $.ajax({
      type      : 'POST',
      url       : base_url()+'index.php/medis/Jadwal_operasi/get_pasien_hari_ini',
      async     : false,
      data      : 'csrf_klinik_mata_edc='+notoken,
      dataType  : 'json',
      success   : function(pendaftar_hrn){
        console.log(pendaftar_hrn);
        // alert(pendaftar_hrn);
        var no            = 1;
        var tbl_daftar_p  = '';
        var dp;
        for (dp=0; dp<pendaftar_hrn.pasien.length; dp++) {
          var norm = pendaftar_hrn.pasien[dp].NORM.substring(3);
          var panjang_rm = norm.length;
          if (panjang_rm==1) {
            no_rm_potong = '000'+norm;
          }else if (panjang_rm==2) {
            no_rm_potong = '00'+norm;
          }else if (panjang_rm==3) {
            no_rm_potong = '0'+norm;
          }else{
            no_rm_potong = norm;
          }
          var nodaftar = pendaftar_hrn.pasien[dp].NODAFTAR.substring(3);
          var panjang_nodaf = nodaftar.length;
          if (panjang_nodaf==1) {
            nodaf_potong = '000'+nodaftar;
          }else if (panjang_nodaf==2) {
            nodaf_potong = '00'+nodaftar;
          }else if (panjang_nodaf==3) {
            nodaf_potong = '0'+nodaftar;
          }else{
            nodaf_potong = nodaftar;
          }
          var btn_daftarkan = '<button style="width:85%;" class="btn btn-block btn-success" id="daftarkan_op" value="'+pendaftar_hrn.pasien[dp].NODAFTAR+'"><i class="fa fa-fw fa-plus"></i></button>';
          
          tbl_daftar_p  += '<tr>'+
              '<td>'+no+'</td>'+
              '<td>'+pendaftar_hrn.pasien[dp].TGL_DAFTAR+'</td>'+
              '<td>'+no_rm_potong+'</td>'+
              '<td hidden>'+pendaftar_hrn.pasien[dp].NORM+'</td>'+
              '<td>'+nodaf_potong+'</td>'+
              '<td hidden>'+pendaftar_hrn.pasien[dp].NODAFTAR+'</td>'+
              '<td id="nama_pasien">'+pendaftar_hrn.pasien[dp].NAMA+'</td>'+
              '<td>'+pendaftar_hrn.pasien[dp].JK+'</td>'+
              '<td>'+pendaftar_hrn.pasien[dp].ALAMAT+'</td>'+
              '<td id="kode_golongan"><b>'+pendaftar_hrn.pasien[dp].KODE_GOLONGAN+'</b></td>'+
              '<td hidden>'+pendaftar_hrn.pasien[dp].ID_TARIF+'</td>'+
              '<td hidden>'+pendaftar_hrn.pasien[dp].TELP+'</td>'+
              '<td hidden>'+pendaftar_hrn.pasien[dp].PEKERJAAN+'</td>'+
              '<td hidden>'+pendaftar_hrn.pasien[dp].TEMPAT_LAHIR+'</td>'+
              '<td hidden>'+pendaftar_hrn.pasien[dp].TANGGAL_LAHIR+'</td>'+
              '<td hidden>'+pendaftar_hrn.pasien[dp].NOKPST+'</td>'+
              '<td hidden>'+pendaftar_hrn.pasien[dp].NIK+'</td>'+
              '<td hidden>'+pendaftar_hrn.pasien[dp].KODE_GOLONGAN+'</td>'+
              '<td><center>'+btn_daftarkan+'</center></td>'+
          '</tr>';
          no++;
          $("#tbody_pasien_hari_ini").html(tbl_daftar_p);
        };
      }
    });
  }
  $('#example2 tbody').on('click', '#daftarkan_op', function(){
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
    var $kolom15 = $(this).parents("tr").find("td:nth-child(15)").text();
    var $kolom16 = $(this).parents("tr").find("td:nth-child(16)").text();
    var $kolom17 = $(this).parents("tr").find("td:nth-child(17)").text();
    var $kolom18 = $(this).parents("tr").find("td:nth-child(18)").text();
    var $kolom19 = $(this).parents("tr").find("td:nth-child(19)").text();
    form_pendaftaran_pasien_operasi();
    $('#norm').val($kolom4);
    $('#nodaftar').val(id);
    $('#norm_palsu').val($kolom3);
    if ($kolom16=='null') {
      var nomorkartu_px = 0;
    }else{
      var nomorkartu_px = $kolom16;
    }
    $('#nomor_kartu').val(nomorkartu_px);
    $('#nama_pasien_jadwal_op').val($kolom7);
    $('#kode_golongan_jadwal_op').val($kolom18);
    get_kode_poli();
  });
  function get_kode_poli() {
    var notoken = token();
    $.ajax({
      type      : 'POST',
      url       : base_url()+'index.php/medis/Jadwal_operasi/get_kode_poli',
      async     : false,
      data      : 'csrf_klinik_mata_edc='+notoken,
      dataType  : 'json',
      success   : function(data){
        console.log(data);
        for (var i = 0; i < data.length; i++) {
          $('#kode_poli').val(data[i].kode_poli);
          $('#nama_poli').val(data[i].nama_poli);
        }
      }
    });
  }
  $('#btn_simpan_jadwal_op').click(function(){
    var form_jadwal_op = $('#form_jadwal_operasi').serialize();
    simpan_jadwal_op(form_jadwal_op);
  });
  function simpan_jadwal_op(form_jadwal_op){
    var notoken = token();
    $.ajax({
      type      : 'POST',
      url       : base_url()+'index.php/medis/Jadwal_operasi/simpan_jadwal_op',
      async     : false,
      data      : 'csrf_klinik_mata_edc='+notoken+'&'+form_jadwal_op,
      dataType  : 'json',
      success   : function(data){
        console.log(data);
        if (data=="Benar") {
        swal("Data Berhasil di simpan!", {
          icon: "success",
        });
        location.reload();
        }else if (data=="Salah") {
          swal("Maaf! data Gagal di Simpan!", {
            icon: "warning",
          });
        }else{
          swal(data, {
            icon: "warning",
          });
        }
      }
    }); 
  }
  // edit_data
  $('#example1 tbody').on('click', '#edit_data', function(){
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
    daftar_tindakan_operasi();
    $('#id_jadwal_op').val(id);
    $('#norm').val($kolom4);
    $('#nodaftar').val($kolom10);
    $('#kode_golongan_jadwal_op').val($kolom11);
    $('#norm_palsu').val($kolom12);
    $('#nomor_kartu').val($kolom5);
    $('#nama_pasien_jadwal_op').val($kolom6);
    $('#tgl_operasi').val($kolom7);
    $('#jenis_tindakan').val($kolom13).trigger("change");
    $('#kode_poli').val($kolom14);
    $('#nama_poli').val($kolom9);
    // layani_pasien(id);
  });
  $('#example1 tbody').on('click', '#layani_pasien', function(){
    var id      = $(this).val();
    var $kolom1 = $(this).parents("tr").find("td:nth-child(1)").text();
    var $kolom2 = $(this).parents("tr").find("td:nth-child(2)").text();
    var $kolom3 = $(this).parents("tr").find("td:nth-child(3)").text();
    var $kolom4 = $(this).parents("tr").find("td:nth-child(4)").text();
    var $kolom5 = $(this).parents("tr").find("td:nth-child(5)").text();
    // alert(id);
    layani_pasien(id);
  });
  function layani_pasien(id){
    var notoken = token();
    $.ajax({
      type      : 'POST',
      url       : base_url()+'index.php/medis/Jadwal_operasi/layani_pasien',
      async     : false,
      data      : 'csrf_klinik_mata_edc='+notoken+'&id_jadwal_op='+id,
      dataType  : 'json',
      success   : function(data){
        console.log(data);
        if (data=="Benar") {
          swal("Pasien Akan Dilayani Operasi!", {
            icon: "success",
          });
          var url     = base_url()+'index.php/medis/Jadwal_operasi';
          // location.href=url2;
          location.reload();
        }else if (data=="Salah") {
          swal("Maaf! data Gagal Melayani Pasien Operasi!", {
            icon: "warning",
          });
        }else{
          swal(data, {
            icon: "warning",
          });
        }
      }
    });
  }
$('#example1 tbody').on('click', '#hapus_data', function(){
  var id      = $(this).val();
  var $kolom1 = $(this).parents("tr").find("td:nth-child(1)").text();
  var $kolom2 = $(this).parents("tr").find("td:nth-child(2)").text();
  var $kolom3 = $(this).parents("tr").find("td:nth-child(3)").text();
  var $kolom4 = $(this).parents("tr").find("td:nth-child(4)").text();
  var $kolom5 = $(this).parents("tr").find("td:nth-child(5)").text();
  // alert(id);
  hapus_data_operasi(id);
});
function hapus_data_operasi(id){
  var notoken = token();
  $.ajax({
    type      : 'POST',
    url       : base_url()+'index.php/medis/Jadwal_operasi/hapus_data_operasi',
    async     : false,
    data      : 'csrf_klinik_mata_edc='+notoken+'&id_jadwal_op='+id,
    dataType  : 'json',
    success   : function(data){
      console.log(data);
      if (data=="Benar") {
        swal("Data Berhasil di Hapus!", {
          icon: "success",
        });
        var url     = base_url()+'index.php/medis/Jadwal_operasi';
        // location.href=url2;
        location.reload();
      }else if (data=="Salah") {
        swal("Maaf! data Gagal di Hapus!", {
          icon: "warning",
        });
      }else{
        swal(data, {
          icon: "warning",
        });
      }
    }
  });
}
function tgl_sekarang(){
  var waktu   = new Date();
  var tanggal = waktu.getDate();
  var bulan   = waktu.getMonth()+1;
  var tahun   = waktu.getFullYear(); 
  var string_tgl = tanggal.toString();
  var string_bulan = bulan.toString();
  if (string_tgl.length==1) {
    var tgl_2 = '0'+tanggal;
  }else{
    var tgl_2 = tanggal;
  }
  if (string_bulan.length==1) {
    var bulan_2 = '0'+bulan;
  }else{
    var bulan_2 = bulan;
  }
  $('#tgl_kunjungan_pasien_lama').val(tahun+'-'+bulan_2+'-'+tgl_2);
}
$('#golongan_pasien').change(function(){
  var golongan_pasien = $('#golongan_pasien').val();
  if (golongan_pasien=='BPJS') {
    $('#layout_norujukan').show();
    $('#token_humas2').show();
  }else if(golongan_pasien=='GRATIS') {
    $('#layout_norujukan').hide();
    $('#token_humas2').show();
  }else{
    $('#layout_norujukan').hide();
    $('#token_humas2').hide();
  }
});
$('#golongan_pasien_baru').change(function(){
  var golongan_pasien = $('#golongan_pasien_baru').val();
  if (golongan_pasien=='BPJS') {
    $('#no_rujukan_baru').show();
    $('#token_humas').show();
  }else if(golongan_pasien=='GRATIS') {
    $('#no_rujukan_baru').hide();
    $('#token_humas').show();
  }else{
    $('#no_rujukan_baru').hide();
    $('#token_humas').hide();
  }
});
function token(ambil_token){
  $.ajax({
    type     : 'POST',
    url      : base_url()+'/index.php/farmasi/token',
    async    : false,
    dataType :'json',
    success  : function(tok){
      ambil_token = tok.csrf_hash;
    }
  });
  return ambil_token;
}
$('#start_camera').on('click', function(){
  var notoken = token();
  var url     = base_url()+'index.php/daftar_antrian/Daftar_antrian_pasien/scan_qrcode?csrf_klinik_mata_edc='+notoken;
  // location.href=base_url()+'index.php/dashboard/karcis_umum?csrf_klinik_mata_edc='+notoken+'&id='+data.id;
  window.open(url); 
});
$('#cetak_no_antrian').on('click', function(){
  var notoken = token();
  var url     = base_url()+'index.php/daftar_antrian/Daftar_antrian_pasien/cetak_no_antrian?csrf_klinik_mata_edc='+notoken;
  window.open(url); 
});
