<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<?php $this->load->view("header");?>
  <body class="hold-transition skin-blue sidebar-mini" id="content_body" onload="tampilkanwaktu();setInterval('tampilkanwaktu()', 1000);get_notif_pasien();get_jum_antrian();myFunction();" style="margin:0;">
    <!-- Site wrapper -->
    <div id="loader"></div>
    <div style="display:none;" id="myDiv" class="animate-bottom">
    <div class="wrapper">

      

      <!-- =============================================== -->

      <?php 
        $this->load->view("__header");
        $this->load->view("__menu");
      ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <?php echo $contents;?>
      </div><!-- /.content-wrapper -->
      <?php $this->load->view("footer.php");?>
<script type="text/javascript">
  function tampilkanwaktu(){
    var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
    var waktu = new Date();
    var tanggal = waktu.getDate();
    var bulan = waktu.getMonth();
    var tahun = waktu.getFullYear();
    var thisDay = waktu.getDay(),
    thisDay = myDays[thisDay];
    var sh = waktu.getHours() + "";
    var sm = waktu.getMinutes() + "";
    var ss = waktu.getSeconds() + "";
    document.getElementById("clock").innerHTML = (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
    $("#tanggal_sekarang").html(thisDay + ', ' + tanggal + ' ' + months[bulan] + ' ' + tahun);
    $("#tanggal_pada_hari_ini").html(tanggal + '/' +bulan + '/' + tahun);
  }
  $(document).ready(function(){
    get_nm_outlet();
    get_role_permision();
    batas_menu();
  });
  function get_nm_outlet(){
    $.ajax({
      type  : 'POST',
      url   : '<?=site_url("for_get_session/get_data_login")?>',
      async : false,
      cache: false,
      dataType : 'json',
      success : function(nm_outlet_m){
        for (var i=0; i<nm_outlet_m.length; i++) {
          $("#untuk_nm_perusahaan").html(nm_outlet_m[i].nm_outlet);
        };
      }
    });
  }
  function get_role_permision(){
    var no_token = token_temp();
    $.ajax({
      type  : 'POST',
      url   : '<?php echo site_url("For_get_session/get_role_permision")?>',
      async : false,
      cache : false,
      data  : 'csrf_klinik_mata_edc='+no_token,
      dataType : 'json',
      success : function(data){
        for (var i=0; i<data.length; i++) {
          // console.log(data);
          $("#role_permision").html(data[i].role);
        };
      }
    }); 
  }
  function token_temp(take){
    $.ajax({
      type     : 'POST',
      url      : '<?=site_url("dashboard/token")?>',
      async    : false,
      dataType :'json',
      success  : function(tok){
        take = tok.csrf_hash;
      }
    });
    return take;
  }
  function base_url(){
  let protocol  = window.location.protocol+"//"; //untuk mengambil protocol http: / https:
  let host      = protocol+window.location.host+"/"; //untuk mengambil host atau root domain
      //host      = host+"klinik_mata_edc_4"; //isi dengan nama folder project jika dilocalhost // namun jika di hosting /server sebaiknya dikosongkan
      return host;
  }
  function batas_menu(){
    var nm_user = $('#nm_user').html();
    // if (nm_user=='emalemal') {
    //   // alert('ok');
    //   $('#lagu').html(html_tes);
    //   // $('#selamat').click();
    //   $('#selamat').click();
    // }
    var role = $('#role_permision').html();
    if (role==7) {
      $('#menu1').hide();
      $('#menu1_2').hide();
      $('#menu2').hide();
      $('#menu3').hide();
      $('#menu4').show();
      $('#menu5').show();
      $('#menu5_1').hide();
      $('#menu5_2').show();
      $('#menu6').hide();
      $('#menu7').hide();
      $('#perubahan_pasien').hide();
      $('#panggil_antrian_p').hide();
      $('#menu8').hide();
      $('#menu9').hide();
      $('#menu10').show();
    }else if (role==15) {
      $('#form_pegawai_humas').hide();
      $('#menu1').show();
      $('#menu1_2').hide();
      $('#menu2').hide();
      $('#menu3').show();
      $('#menu4').hide();
      $('#menu5').hide();
      $('#menu5_1').hide();
      $('#menu5_2').hide();
      $('#menu6').hide();
      $('#menu7').hide();
      $('#perubahan_pasien').hide();
      $('#panggil_antrian_p').hide();
      $('#menu8').show();
      $('#menu9').show();
      $('#menu10').hide();
    }else if (role==17) {
      $('#menu1').hide();
      $('#menu1_2').hide();
      $('#menu2').hide();
      $('#menu3').hide();
      $('#menu4').hide();
      $('#menu5').hide();
      $('#menu5_1').hide();
      $('#menu5_2').hide();
      $('#menu6').hide();
      $('#menu7').show();
      $('#perubahan_pasien').hide();
      $('#panggil_antrian_p').hide();
      $('#menu8').hide();
      $('#menu9').hide();
      $('#menu10').hide();
    }else if (role==19) {
      $('#hide_menu').click();
      $('#menu1').hide();
      $('#menu1_2').hide();
      $('#menu2').hide();
      $('#menu3').hide();
      $('#menu4').hide();
      $('#menu5').hide();
      $('#menu5_1').hide();
      $('#menu5_2').hide();
      $('#menu6').hide();
      $('#menu7').hide();
      $('#perubahan_pasien').hide();
      $('#panggil_antrian_p').hide();
      $('#menu8').hide();
      $('#menu9').hide();
      $('#menu10').hide();
    }else if (role==36) {
      $('#menu1').hide();
      $('#menu1_2').hide();
      $('#menu2').hide();
      $('#menu3').show();
      $('#menu4').hide();
      $('#menu5').hide();
      $('#menu5_1').hide();
      $('#menu5_2').hide();
      $('#menu6').hide();
      $('#menu7').show();
      $('#perubahan_pasien').hide();
      $('#panggil_antrian_p').hide();
      $('#menu8').show();
      $('#menu9').hide();
      $('#menu10').hide();
    }else if (role==25) {
      $('#menu1').hide();
      $('#menu1_2').hide();
      $('#menu2').hide();
      $('#menu3').hide();
      $('#menu4').show();
      $('#menu4_1').hide();
      $('#menu5').show();
      $('#menu5_1').hide();
      $('#menu5_2').show();
      $('#menu5_4').hide();
      $('#menu5_5').hide();
      $('#menu6').hide();
      $('#menu7').hide();
      $('#perubahan_pasien').hide();
      $('#panggil_antrian_p').hide();
      $('#menu8').hide();
      $('#menu9').hide();
      $('#menu10').hide();
    }else if (role==23) {
      $('#menu1').hide();
      $('#menu1_2').hide();
      $('#menu2').hide();
      $('#menu3').hide();
      $('#menu4').show();
      $('#menu5').show();
      $('#menu5_1').hide();
      $('#menu5_2').show();
      $('#menu5_4').hide();
      $('#menu5_5').hide();
      $('#menu6').hide();
      $('#menu7').hide();
      $('#perubahan_pasien').hide();
      $('#panggil_antrian_p').hide();
      $('#menu8').hide();
      $('#menu9').hide();
      $('#menu10').hide();
    }else if (role==21) {
      $('#menu1').hide();
      $('#menu1_2').hide();
      $('#menu2').hide();
      $('#menu3').hide();
      $('#menu4').show();
      $('#menu5').show();
      $('#menu5_1').hide();
      $('#menu5_2').show();
      $('#menu5_4').hide();
      $('#menu5_5').hide();
      $('#menu6').hide();
      $('#menu7').hide();
      $('#perubahan_pasien').hide();
      $('#panggil_antrian_p').hide();
      $('#menu8').hide();
      $('#menu9').hide();
      $('#menu10').hide();
    }else if (role==37) {
      $('#menu1').show();
      $('#menu1_2').show();
      $('#menu2').hide();
      $('#menu3').show();
      $('#menu4').hide();
      $('#menu5').show();
      $('#menu5_1').show();
      $('#menu5_2').hide();
      $('#menu5_3').hide();
      $('#menu5_4').hide();
      $('#menu5_5').hide();
      $('#menu6').hide();
      $('#menu7').hide();
      $('#perubahan_pasien').hide();
      var id_outlet = $('#kode_outlet').html();
      if (id_outlet=='MJG' || id_outlet=='HLD' || id_outlet=='TLG' || id_outlet=='NGJ' || id_outlet=='MJS' || id_outlet=='BKL') {
        $('#panggil_antrian_p').show();
      }else{
        $('#panggil_antrian_p').hide();
      }
      $('#menu8').show();
      $('#menu9').hide();
      $('#menu10').hide();
    }else if (role==34) {
      $('#menu1').show();
      $('#menu1_2').hide();
      $('#menu2').hide();
      $('#menu3').show();
      $('#menu4').hide();
      $('#menu5').hide();
      $('#menu5_1').hide();
      $('#menu5_2').hide();
      $('#menu6').hide();
      $('#menu7').hide();
      $('#perubahan_pasien').hide();
      $('#panggil_antrian_p').hide();
      $('#menu8').show();
      $('#menu9').hide();
      $('#menu10').hide();
    }else if (role==35) {
      $('#menu1').hide();
      $('#menu1_2').hide();
      $('#menu2').hide();
      $('#menu3').show();
      $('#menu4').hide();
      $('#menu5').hide();
      $('#menu5_1').hide();
      $('#menu5_2').hide();
      $('#menu6').hide();
      $('#menu7').show();
      $('#perubahan_pasien').hide();
      $('#panggil_antrian_p').hide();
      $('#menu8').show();
      $('#menu9').hide();
      $('#menu10').hide();
    }
    // else if (role==36) {
    //   $('#menu1').hide();
    //   $('#menu1_2').hide();
    //   $('#menu2').hide();
    //   $('#menu3').show();
    //   $('#menu4').hide();
    //   $('#menu5').hide();
    //   $('#menu5_1').hide();
    //   $('#menu5_2').hide();
    //   $('#menu6').hide();
    //   $('#menu7').show();
    //   $('#perubahan_pasien').hide();
    //   $('#menu8').show();
    // $('#menu9').hide();
    // }
    else if (role==18) {
      $('#menu1').show();
      $('#menu1_2').hide();
      $('#menu2').hide();
      $('#menu3').show();
      $('#menu4').show();
      $('#menu4_1').hide();
      $('#menu5').show();
      $('#menu5_1').show();
      $('#menu5_2').show();
      $('#menu5_3').show();
      $('#menu5_4').hide();
      $('#menu5_5').hide();
      $('#menu6').show();
      $('#menu7').show();
      $('#perubahan_pasien').show();
      $('#panggil_antrian_p').hide();
      $('#menu8').show();
      $('#menu9').show();
      $('#menu10').hide();
    }
    else if (role==28) {
      $('#form_pegawai_humas').hide();
      $('#menu1').hide();
      $('#menu1_2').hide();
      $('#menu2').hide();
      $('#menu3').hide();
      $('#menu4').hide();
      $('#menu5').hide();
      $('#menu5_1').hide();
      $('#menu5_2').hide();
      $('#menu5_3').hide();
      $('#menu5_4').hide();
      $('#menu5_5').hide();
      $('#menu6').hide();
      $('#menu7').hide();
      $('#perubahan_pasien').hide();
      $('#panggil_antrian_p').hide();
      $('#menu8').hide();
      $('#menu9').show();
      $('#menu9_2').hide();
      $('#menu10').hide();
    }
    else if (role==29) {
      $('#form_pegawai_humas').hide();
      $('#menu1').hide();
      $('#menu1_2').hide();
      $('#menu2').hide();
      $('#menu3').hide();
      $('#menu4').hide();
      $('#menu5').hide();
      $('#menu5_1').hide();
      $('#menu5_2').hide();
      $('#menu5_3').hide();
      $('#menu5_4').hide();
      $('#menu5_5').hide();
      $('#menu6').hide();
      $('#menu7').hide();
      $('#perubahan_pasien').hide();
      $('#panggil_antrian_p').hide();
      $('#menu8').hide();
      $('#menu9').show();
      $('#menu9_2').hide();
      $('#menu10').hide();
    }
    else if (role==6) {
      // $('#form_pegawai_humas').hide();
      $('#menu1').hide();
      $('#menu1_2').hide();
      $('#menu2').hide();
      $('#menu3').hide();
      $('#menu4').hide();
      $('#menu5').hide();
      $('#menu5_1').hide();
      $('#menu5_2').hide();
      $('#menu5_3').hide();
      $('#menu5_4').hide();
      $('#menu5_5').hide();
      $('#menu6').hide();
      $('#menu7').hide();
      $('#perubahan_pasien').hide();
      $('#panggil_antrian_p').hide();
      $('#menu8').hide();
      $('#menu9').show();
      $('#menu9_1').hide();
      $('#menu10').hide();
    }else if (role==8) { //Admin Digital Marketing
      // $('#form_pegawai_humas').hide();
      $('#menu1').hide();
      $('#menu1_2').hide();
      $('#menu2').hide();
      $('#menu3').hide();
      $('#menu4').hide();
      $('#menu5').hide();
      $('#menu5_1').hide();
      $('#menu5_2').hide();
      $('#menu5_3').hide();
      $('#menu5_4').hide();
      $('#menu5_5').hide();
      $('#menu6').hide();
      $('#menu7').hide();
      $('#perubahan_pasien').hide();
      $('#panggil_antrian_p').hide();
      $('#menu8').hide();
      $('#menu9').show();
      $('#menu9_2').show();
      $('#menu9_1').hide();
      $('#menu10').hide();
    }
    else{
      $('#menu1').show();
      $('#menu1_2').show();
      $('#menu2').show();
      $('#menu3').show();
      $('#menu4').show();
      $('#menu5').show();
      $('#menu6').show();
      $('#menu7').show();
      $('#perubahan_pasien').show();
      $('#panggil_antrian_p').show();
      $('#menu8').show();
      $('#menu9').show();
      $('#menu10').show();
    }
  }
</script>