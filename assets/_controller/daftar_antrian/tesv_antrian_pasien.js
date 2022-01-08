$(function(){
  $('.select2').select2();
  tgl_sekarang();
  // get_antrian_hari_ini();
  $('#daftar_antrian_pasien').dataTable();
  show_pendaftaran_antrian();
  // notifikasi();
  // setTimeout(function(){$(".pesan").fadeOut('slow')}, 1000);
  var get_nama_provinsi = '';
  provinsi(get_nama_provinsi);
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
function get_dokter(){
  var notoken = token();
  $.ajax({
    type : 'POST',
    url  : base_url()+'index.php/daftar_antrian/daftar_antrian_pasien/get_list_dokter',
    async : false,
    data  : 'csrf_klinik_mata_edc='+notoken,
    dataType : 'json',
    success : function(dokter){
      // console.log(dokter);
      var d;
      var option_dokter = '';
      var option_dokter_o = '';
      option_dokter_o += '<option selected="selected">== || ==</option>';
      for(d=0; d<dokter.length; d++){
        option_dokter += '<option value="'+dokter[d].ID_TARIF+'" >' + dokter[d].NAMA_DOKTER+'</option>';
      }
      $("#tarif_dokter").html(option_dokter_o+option_dokter);
    }
  });
}
function get_antrian_hari_ini(){
  var notoken = token();
  $.ajax({
    type      : 'POST',
    url       : base_url()+'index.php/daftar_antrian/daftar_antrian_pasien/list_antrian_hari_ini',
    async     : false,
    data      : 'csrf_klinik_mata_edc='+notoken,
    dataType  : 'json',
    success   : function(data){
      console.log(data);
      var html_antrian = '';
      for (var i = 0; i < data.length; i++) {
            var btn_layani_pasien = '<button type="button" class="btn btn-success btn-flat" id="layani_pasien" value='+data[i].ID_NO_ANTRI+'>Layani Pasien</button>';
            html_antrian += '<tr>'
                            +  '<td>'+data[i].NO_ANTRIAN+'</td>'
                            +  '<td>'+data[i].NORM+'</td>'
                            +  '<td>'+data[i].NAMA_PENDAFTAR+'</td>'
                            +  '<td>'+data[i].NIK+'</td>'
                            +  '<td>'+data[i].golongan_pasien+'</td>'
                            +  '<td hidden>'+data[i].JK+'</td>'
                            +  '<td hidden>'+data[i].TANGGAL_LAHIR+'</td>'
                            +  '<td hidden>'+data[i].TEMPAT_LAHIR+'</td>'
                            +  '<td hidden>'+data[i].PROVINSI+'</td>'
                            +  '<td hidden>'+data[i].KAB+'</td>'
                            +  '<td hidden>'+data[i].KEC+'</td>'
                            +  '<td hidden>'+data[i].DESA+'</td>'
                            +  '<td hidden>'+data[i].TELP+'</td>'
                            +  '<td>'+btn_layani_pasien+'</td>'
                            +'</tr>';
      }
      $('#tbody_daftar_antrian').html(html_antrian);
    }
  });
}
$('#daftar_antrian_pasien tbody').on('click', '#layani_pasien', function(){
  var id      = $(this).val();
  var $kolom1 = $(this).parents("tr").find("td:nth-child(1)").text();
  var $kolom2 = $(this).parents("tr").find("td:nth-child(2)").text();
  var $kolom3 = $(this).parents("tr").find("td:nth-child(3)").text();
  var $kolom4 = $(this).parents("tr").find("td:nth-child(4)").text();
  var $kolom5 = $(this).parents("tr").find("td:nth-child(5)").text();
  layani_pasien(id);
});
function layani_pasien(id){
  var notoken = token();
  $.ajax({
    type      : 'POST',
    url       : base_url()+'index.php/daftar_antrian/daftar_antrian_pasien/layani_pasien',
    async     : false,
    data      : 'csrf_klinik_mata_edc='+notoken+'&id_antrian_pasien='+id,
    dataType  : 'json',
    success   : function(data){
      console.log(data);
      if (data=="Benar") {
        swal("Pasien Akan Dilayani!", {
          icon: "success",
        });
      }else if (data=="Salah") {
        swal("Maaf! data Gagal di Melayani Pasien!", {
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
// $('#golongan_pasien_baru').change(function(){
//   var golongan_pasien = $('#golongan_pasien_baru').val();
//   if (golongan_pasien=='BPJS') {
//     $('#no_rujukan_baru').show();
//     $('#token_humas').show();
//   }else if(golongan_pasien=='GRATIS') {
//     $('#no_rujukan_baru').hide();
//     $('#token_humas').show();
//   }else{
//     $('#no_rujukan_baru').hide();
//     $('#token_humas').hide();
//   }
// });
$('#daftarkan_antrian').click(function(){
  var data_form = $('#form_pasien_lama').serialize();
  var notoken   = token();
  $.ajax({
    type      : 'POST',
    url       : base_url()+'index.php/daftar_antrian/daftar_antrian_pasien/daftarkan_pasien_lama',
    async     : false,
    data      : 'csrf_klinik_mata_edc='+notoken+'&'+data_form,
    dataType  : 'json',
    success   : function(data){
      console.log(data);
      if (data.status=="Benar") {
        swal("Pasien Berhasil di Daftarkan!", {
          icon: "success",
        });
        // show_hasil_pendaftaran();
        // $('#hasil_pendaftaran').show();
        $('#hsl_nik').html(data.form_data.NIK);
        $('#hsl_nama').html(data.form_data.NAMA_PENDAFTAR);
        $('#hsl_alamat').html(data.form_data.ALAMAT);
        $('#hsl_antrian').html(data.form_data.NO_ANTRIAN);

        $('#form_pasien_lama')[0].reset();
        $('#provinsi').val('').trigger("change");
        $('#kabupaten').val('').trigger("change");
        $('#kecamatan').val('').trigger("change");
        $('#desa').val('').trigger("change");
        // var notoken = token();
        var url     = base_url()+'index.php/daftar_antrian/Daftar_antrian_pasien/cetak_no_antrian?csrf_klinik_mata_edc='+notoken+'&no_antrian='+data.form_data.NO_ANTRIAN+'&id_perusahaan='+data.form_data.ID_PERUSAHAAN+'&golongan_pasien='+data.form_data.GOLONGAN_PASIEN+'&tgl_request_daftar='+data.form_data.TGL_REQUEST_DAFTAR;
        // var url     = base_url()+'index.php/daftar_antrian/Daftar_antrian_pasien/cetak_no_antrian?csrf_klinik_mata_edc='+notoken+'&no_antrian='+data.data_from.NO_ANTRIAN+'&id_perusahaan='+data.data_from.ID_PERUSAHAAN+'&golongan_pasien='+data.data_from.GOLONGAN_PASIEN+'&tgl_request_daftar='+data.data_from.TGL_REQUEST_DAFTAR;
        var url2    = base_url()+'index.php/daftar_antrian/daftar_antrian_pasien';
        // var url2      = 'http://tulungagung.klinikmataedc.id/cetak_no_antri.php?no_antrian='+data.data_from.NO_ANTRIAN+'&id_perusahaan='+data.data_from.ID_PERUSAHAAN+'&golongan_pasien='+data.data_from.GOLONGAN_PASIEN+'&tgl_request_daftar='+data.data_from.TGL_REQUEST_DAFTAR;
        // var url2      = 'http://tulungagung.klinikmataedc.id/cetak_no_antri.php?no_antrian='+data.data_from.NO_ANTRIAN;
        window.open(url);
        window.location = url2;
        // window.open(url2);
      }else if (data=="Salah") {
        swal("Maaf! data Gagal di Simpan!", {
          icon: "warning",
        });
      }else{
        swal(data.form_data, {
          icon: "warning",
        });
      }
    }
  });
});
$('#daftarkan_antrian_px_baru').click(function(){
  var notoken   = token();
  var form_data = $('#form_pendaftaran_no_dantrian_pasien_baru').serialize();
  // alert(form_data);
  $.ajax({
    type      : 'POST',
    url       : base_url()+'index.php/daftar_antrian/daftar_antrian_pasien/daftarkan_pasien_baru',
    async     : false,
    data      : 'csrf_klinik_mata_edc='+notoken+'&'+form_data,
    dataType  : 'json',
    success   : function(data){
      console.log(data);
      var keterangan = data.data_from;
      if (data.status=='Benar') {
        // show_hasil_pendaftaran();
        // $('#hasil_pendaftaran').show();
        $('#hsl_nik').html(data.data_from.NIK);
        $('#hsl_nama').html(data.data_from.NAMA_PENDAFTAR);
        $('#hsl_alamat').html(data.data_from.ALAMAT);
        $('#hsl_antrian').html(data.data_from.NO_ANTRIAN);
        $('#form_pasien_lama')[0].reset();
        $('#provinsi').val('').trigger("change");
        $('#kabupaten').val('').trigger("change");
        $('#kecamatan').val('').trigger("change");
        $('#desa').val('').trigger("change");
        // var notoken = token();
        var url       = base_url()+'index.php/daftar_antrian/Daftar_antrian_pasien/cetak_no_antrian?csrf_klinik_mata_edc='+notoken+'&no_antrian='+data.data_from.NO_ANTRIAN+'&id_perusahaan='+data.data_from.ID_PERUSAHAAN+'&golongan_pasien='+data.data_from.GOLONGAN_PASIEN+'&tgl_request_daftar='+data.data_from.TGL_REQUEST_DAFTAR;
        // var url2      = 'http://tulungagung.klinikmataedc.id/cetak_no_antri.php?no_antrian='+data.data_from.NO_ANTRIAN+'&id_perusahaan='+data.data_from.ID_PERUSAHAAN+'&golongan_pasien='+data.data_from.GOLONGAN_PASIEN+'&tgl_request_daftar='+data.data_from.TGL_REQUEST_DAFTAR;
        // var url2      = 'http://tulungagung.klinikmataedc.id/cetak_no_antri.php?no_antrian='+data.data_from.NO_ANTRIAN;
        // var url2     = base_url()+'index.php/daftar_antrian/daftar_antrian_pasien';
        window.open(url);
        // window.location = url2;
        // window.open(url2);
      }else{
        // $('#hasil_pendaftaran').hide();
        swal({
            title: "Maaf!",
            text: keterangan,
            icon: "warning",
            button: "Ok!",
          });
      }
    }
  });
});
function provinsi(get_nama_provinsi){
  var notoken = token();
  $.ajax({
    type      : 'POST',
    url       : base_url()+'index.php/daftar_antrian/daftar_antrian_pasien/provinsi',
    async     : false,
    data      : 'csrf_klinik_mata_edc='+notoken,
    dataType  : 'json',
    success   : function(data){
      // console.log(data);
      var option_kosong = '<option value=""> == || == </option>';
      var option = '';
      var provinsi = data.provinsi;
      for (var i = 0; i < provinsi.length; i++) {
        option += '<option value="'+provinsi[i].nama+','+provinsi[i].id+'"> '+provinsi[i].nama+' </option>';
      }
      // $('#provinsi_baru').html(option_kosong+option);
      $('#provinsi').html(option_kosong+option);
      if (get_nama_provinsi!='') {
        $('#provinsi').val(get_nama_provinsi).trigger("change");
      }
    }
  });
}
// $("#provinsi_baru").change(function(){
//     var get_id_prov = $(this).val().split(",");
//     // var get_nama_kabupaten = $("#kabupaten_antrian").val();
//     var get_nama_kabupaten = '';
//     // alert(get_id_prov);
//     get_data_kabupaten(get_id_prov, get_nama_kabupaten);
//   });
$("#provinsi").change(function(){
    var get_id_prov = $(this).val().split(",");
    var get_nama_kabupaten = $("#kabupaten_antrian").val();
    // var get_nama_kabupaten = 'OK';
    // alert(get_nama_kabupaten);
    get_data_kabupaten(get_id_prov, get_nama_kabupaten);
  });
function get_data_kabupaten(id_provinsi, get_nama_kabupaten){
  var id_prov = id_provinsi[1];
  var notoken = token();  
  $.ajax({
    type      : 'POST',
    url       : base_url()+'index.php/daftar_antrian/daftar_antrian_pasien/kabupaten',
    async     : false,
    data      : 'csrf_klinik_mata_edc='+notoken+'&id_provinsi='+id_prov,
    dataType  : 'json',
    success   : function(data){
      console.log(data);
      var option_kosong = '<option value=""> == || == </option>';
      var option = '';
      var kabupaten = data.kota_kabupaten;
      for (var i = 0; i < kabupaten.length; i++) {
        option += '<option value="'+kabupaten[i].nama+','+kabupaten[i].id+'"> '+kabupaten[i].nama+' </option>';
      }
      // $('#kabupaten_baru').html(option_kosong+option);
      $('#kabupaten').html(option_kosong+option);
      if (get_nama_kabupaten!='') {
        var kabupaten = get_nama_kabupaten.substr(4);
        var kab = get_nama_kabupaten.substr(0,4);
        if (kab=='Kab.') {
          var hasil = 'Kabupaten'+kabupaten;
        }else{
          var hasil = get_nama_kabupaten;
        }
        // alert(kab);
        $('#kabupaten').val(hasil).trigger("change");
      }
    }
  });
}
// $("#kabupaten_baru").change(function(){
//     var get_id_kab          = $(this).val().split(",");
//     var get_nama_kecamatan  = '';
//     get_data_kecamatan(get_id_kab, get_nama_kecamatan);
//   });
$("#kabupaten").change(function(){
    var get_id_kab          = $(this).val().split(",");
    // var get_id_kab          = $(this).val();
    // alert(get_id_kab);
    var get_nama_kecamatan  = $("#kecamatan_antrian").val();
    get_data_kecamatan(get_id_kab, get_nama_kecamatan);
  });
function get_data_kecamatan(id_kabupaten, get_nama_kecamatan){
  var id_kab  = id_kabupaten[1];
  // var id_prov = id_provinsi[1];
  // alert(id_kab);
  var notoken = token();  
  $.ajax({
    type      : 'POST',
    url       : base_url()+'index.php/daftar_antrian/daftar_antrian_pasien/kecamatan',
    async     : false,
    data      : 'csrf_klinik_mata_edc='+notoken+'&id_kabupaten='+id_kab,
    dataType  : 'json',
    success   : function(data){
      console.log(data);
      var option_kosong = '<option value=""> == || == </option>';
      var option        = '';
      var kecamatan     = data.kecamatan;
      for (var i = 0; i < kecamatan.length; i++) {
        option += '<option value="'+kecamatan[i].nama+','+kecamatan[i].id+'"> '+kecamatan[i].nama+' </option>';
      }
      // $('#kecamatan_baru').html(option_kosong+option);
      $('#kecamatan').html(option_kosong+option);
      if (get_nama_kecamatan!='') {
        var hasil = get_nama_kecamatan.trim();
        $('#kecamatan').val(hasil).trigger("change");
      }
    }
  });
}
// $("#kecamatan_baru").change(function(){
//     var get_id_kec    = $(this).val().split(",");
//     // alert(get_id_kec);
//     var get_nama_desa = '';
//     get_data_desa(get_id_kec, get_nama_desa);
// });
$("#kecamatan").change(function(){
    var get_id_kec = $(this).val().split(",");
    var get_nama_desa = $("#desa_antrian").val();
    get_data_desa(get_id_kec, get_nama_desa);
});
function get_data_desa(get_id_kec, get_nama_desa){
  var id_kec = get_id_kec[1];
  var notoken = token();  
  $.ajax({
    type      : 'POST',
    url       : base_url()+'index.php/daftar_antrian/daftar_antrian_pasien/desa',
    async     : false,
    data      : 'csrf_klinik_mata_edc='+notoken+'&id_kecamatan='+id_kec,
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
      $('#desa').html(option_kosong+option);
      if (get_nama_desa!='') {
        $('#desa').val(get_nama_desa).trigger("change");
      }
    }
  });
}
$('#cari_data').click(function(){
  var notoken           = token();
  var form_data_antrian = $('#form_pendaftaran_no_dantrian_pasien_lama').serialize();
  $.ajax({
    type      : 'POST',
    url       : base_url()+'index.php/daftar_antrian/daftar_antrian_pasien/cari_data_pasien_lama',
    async     : false,
    data      : 'csrf_klinik_mata_edc='+notoken+'&'+form_data_antrian,
    dataType  : 'json',
    success   : function(data){
      // console.log(data);
      if (data=='Data Harus di Isi') {
        // alert(data);
      }else{
        if (data.length==0) {
          alert('tidak ada data'); 
        }else{
          var html_pasien = '';
          var no          = 1;
          var pasien_lama = data.pasien_lama;
          for (var i = 0; i < pasien_lama.length; i++) {
            var btn_daftarkan_pasien = '<button type="button" class="btn btn-success btn-flat" id="daftarkan_pasien">Daftarkan</button>';
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
            var btn_daftarkan_pasien = '<button type="button" class="btn btn-success btn-flat" id="daftarkan_pasien">Daftarkan</button>';
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
          $('#tbody_daftar_pencarian_pasien_antrian').html(html_pasien+html_px_baksos);
        }
      }
    }
  });
});
$('#daftar_pencarian_pasien_antrian tbody').on('click', '#daftarkan_pasien', function(){
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
  // var data_provinsi   = String($kolom9).split(",");
  // var nm_provinsi     = data_provinsi[0];
  // var id_provinsi     = data_provinsi[1];
  // var data_kabupaten  = String($kolom10).split(",");
  // var nm_kabupaten    = data_kabupaten[0];
  // var id_kabupaten    = data_kabupaten[1];
  // var data_kecamatan  = String($kolom11).split(",");
  // var nm_kecamatan    = data_kecamatan[0];
  // var id_kecamatan    = data_kecamatan[1];
  var id_perusahaan   = String($kolom2).substr(0,3);
  var norm_pasien     = String($kolom2).substr(3);
  if ($kolom4=='null') {
    var nik_pasien = '';
  }else{
    var nik_pasien = $kolom4;
  }
  // var get_id_kab = $kolom10.split(",");
  $('#kabupaten_antrian').val($kolom10);
  $('#kecamatan_antrian').val($kolom11);
  $('#desa_antrian').val($kolom12);
  provinsi($kolom9);
  // $('#provinsi').val($kolom9).trigger("change");
  
  $('#id_perusahaan_pasien_lama').val(id_perusahaan);
  $('#norm_pasien_lama').val(norm_pasien);
  $('#nik_pasen_lama').val(nik_pasien);
  $('#nama_pasien_lama2').val($kolom3);
  $('#jenis_kelamin_lama').val($kolom6);
  $('#tgl_lahir_lama2').val($kolom7);
  $('#tempat_lahir_lama').val($kolom8);
  $('#alamat_pasien_lama2').val($kolom5);
  $('#tlpon_pasien_lama').val($kolom13);
  $('#pekerjaan').val($kolom14).trigger('change');
  $('#layout_norujukan').hide();  
  var norm_pasien_post = $('#norm_pasien_lama').val();
  if (norm_pasien_post=='') {
    $('#norm_pasien_lama').prop('readonly', false);
  }else{
    $('#norm_pasien_lama').prop('readonly', true);
  }
  get_dokter();
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
