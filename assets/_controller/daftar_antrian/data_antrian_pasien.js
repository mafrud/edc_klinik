$(function(){
  $('.select2').select2();
  // tgl_sekarang();
  get_antrian_hari_ini();
  $('#daftar_antrian_pasien').dataTable();
  // show_pendaftaran_antrian();
  // notifikasi();
  // setTimeout(function(){$(".pesan").fadeOut('slow')}, 1000);
  // var get_nama_provinsi = '';
  // provinsi(get_nama_provinsi);
});
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
            // var norm = data[i].NORM.substring(3);
            var btn_layani_pasien = '<button type="button" class="btn btn-success btn-flat" id="layani_pasien" value='+data[i].ID_NO_ANTRI+'>Layani Pasien</button>';
            var btn_modal = '<button type="button" class="btn btn-success btn-flat" id="panggil_pasien" name="panggil_pasien"  value='+data[i].ID_NO_ANTRI+'>Layani Pasien</button>';
            var panggil = data[i].PANGGIL;
            if (panggil==0) {
              var status_panggilan = 'Belum Terpanggil';
            }else{
              var status_panggilan = 'Sudah Terpanggil';
            }
            html_antrian += '<tr>'
                            +  '<td>'+data[i].NO_ANTRIAN+'</td>'
                            +  '<td>'+data[i].rm_potong+'</td>'
                            +  '<td>'+data[i].NAMA_PENDAFTAR+'</td>'
                            +  '<td>'+data[i].NIK+'</td>'
                            +  '<td>'+data[i].GOLONGAN_PASIEN+'</td>'
                            +  '<td hidden>'+data[i].ID_PERUSAHAAN+'</td>'
                            +  '<td hidden>'+data[i].JK+'</td>'
                            +  '<td hidden>'+data[i].TANGGAL_LAHIR+'</td>'
                            +  '<td hidden>'+data[i].TEMPAT_LAHIR+'</td>'
                            +  '<td hidden>'+data[i].PEKERJAAN+'</td>'
                            +  '<td hidden>'+data[i].ALAMAT+'</td>'
                            +  '<td hidden>'+data[i].PROVINSI+'</td>'
                            +  '<td hidden>'+data[i].KAB+'</td>'
                            +  '<td hidden>'+data[i].KEC+'</td>'
                            +  '<td hidden>'+data[i].DESA+'</td>'
                            +  '<td hidden>'+data[i].TELP+'</td>'
                            +  '<td>'+status_panggilan+'</td>'
                            +  '<td>'+btn_modal+'</td>'
                            +'</tr>';
      }
      $('#tbody_daftar_antrian').html(html_antrian);
    }
  });
}
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
$('#daftar_antrian_pasien tbody').on('click', '#panggil_pasien', function(){
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
  panggil_pasien(id);
  // alert(id);
  $('#idperusahaan_pasien_modal').val($kolom6);
  $('#idantrian_pasien_modal').val(id);
  $('#noantrian_pasien_modal').val($kolom1);
  if ($kolom2=='') {
    var norm_pasienmodal = '';
  }else{
    var norm_pasienmodal = $kolom6+$kolom2;
  }
  $('#norm_pasien_modal').val(norm_pasienmodal);
  $('#nik_pasien_modal').val($kolom4);
  $('#nama_pasien_modal').val($kolom3);
  $('#jenis_kelamin_modal').val($kolom7).trigger('change');
  $('#tgl_lahir_modal').val($kolom8);
  $('#tempat_lahir_modal').val($kolom9);
  $('#pekerjaan_modal').val($kolom10).trigger('change');
  // $('#provinsi_modal').val(data[i].PROV);
  // $('#kabupaten_modal').val(data[i].KAB);
  // $('#kecamatan_modal').val(data[i].KEC);
  // $('#desa_modal').val(data[i].DESA);
  $('#alamat_pasien_modal').val($kolom11);
  $('#tlpon_pasien_modal').val($kolom16);
  $('#golongan_pasien_modal').val($kolom5).trigger('change');
  $('#token_voucher_modal').val('');
  $('#no_rujukan_modal').val('');

  // $('#provinsi_lama_modal').val(data[i].PROV);
  $('#kabupaten_lama_modal').val($kolom13);
  $('#kecamatan_lama_modal').val($kolom14);
  $('#desa_lama_modal').val($kolom15);
  var get_nama_provinsi = $kolom12;
  provinsi_nottif(get_nama_provinsi);
});
// $('#panggil_pasien').click(function(){
//   // panggil_pasien();
//   alert('ok');
// });
function panggil_pasien(id){
  $('#show_modal').click();
  // var notoken = token();
  // $.ajax({
  //   type      : 'POST',
  //   url       : base_url()+'index.php/daftar_antrian/daftar_antrian_pasien/panggil_pasien',
  //   async     : false,
  //   data      : 'csrf_klinik_mata_edc='+notoken+'&id_antrian_pasien='+id,
  //   dataType  : 'json',
  //   success   : function(data){
  //     console.log(data);
  //     if (data=="Benar") {
  //       swal("Pasien Akan Dilayani!", {
  //         icon: "success",
  //       });
  //     }else if (data=="Salah") {
  //       swal("Maaf! data Gagal di Melayani Pasien!", {
  //         icon: "warning",
  //       });
  //     }else{
  //       swal(data, {
  //         icon: "warning",
  //       });
  //     }
  //   }
  // });
}
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