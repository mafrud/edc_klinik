$(function () {
    $('#divprosedur').hide();
    $('#divpenunjang').hide();
    $('#divassesmentPel').hide();
    $('#divJaminanHistori').hide();
    $('#divJaminan').hide();
    $(".select2").select2();
    $(".timepicker").timepicker({
        showInputs: false
    });
    isi_data_tujuan_kunjungan();
});

function isi_data_tujuan_kunjungan(){
    var tujuanKunj      = $('#tujuanKunj').val();
    // var flagProcedure   = $('#flagProcedure').val();
    // var kdPenunjang     = $('#kdPenunjang').val();
    // var assesmentPel    = $('#assesmentPel').val();
    if (tujuanKunj==0) {
        $('#divprosedur').show();
        $('#divpenunjang').show();
        $('#divassesmentPel').show();
    }else if (tujuanKunj==2){
        $('#divprosedur').hide();
        $('#divpenunjang').hide();
        $('#divassesmentPel').show();
    }else{
        $('#divprosedur').hide();
        $('#divpenunjang').hide();
        $('#divassesmentPel').hide();
    }
}

$('#tujuanKunj').change(function(){
    var tujuan_kunj = $(this).val();
    if (tujuan_kunj==0) {
        $('#divprosedur').show();
        $('#divpenunjang').show();
        $('#divassesmentPel').show();
    }else if (tujuan_kunj==2){
        $('#divprosedur').hide();
        $('#divpenunjang').hide();
        $('#divassesmentPel').show();
    }else{
        $('#divprosedur').hide();
        $('#divpenunjang').hide();
        $('#divassesmentPel').hide();
    }
});

$("#ppkdirujuk").on('keyup', function(){
    var test = tes_auto();
    // console.log(test);
    $( "#ppkdirujuk").autocomplete({
      source : test,
      minLength: 1,
      select: function(event, ui)
      {
        $('#ppkdirujuk').val(ui.item.value);
      }
    }).data('ui-autocomplete')._renderItem = function(ul, item){
          return $("<li class='ui-autocomplete-row'></li>")
            .data("item.autocomplete", item)
            .append(item.label)
            .appendTo(ul);
    };
});
$('#diagnosa_rujukan_keluar').on('keyup', function(){
    var diagnosa = get_diagnosa();
    // console.log(test);
    $( "#diagnosa_rujukan_keluar").autocomplete({
      source : diagnosa,
      minLength: 1,
      select: function(event, ui)
      {
        $('#diagnosa_rujukan_keluar').val(ui.item.value);
      }
    }).data('ui-autocomplete')._renderItem = function(ul, item){
          return $("<li class='ui-autocomplete-row'></li>")
            .data("item.autocomplete", item)
            .append(item.label)
            .appendTo(ul);
    };
});
$('#diagnosa_rujukan_keluar').on('change', function(){
    var nama_diagnosa = $('#diagnosa_rujukan_keluar').val();
    var kode_diagnosa = nama_diagnosa.split(" ", 1);
    $('#kd_diagnosa_rujukan_keluar').val(kode_diagnosa);
});
$('#poli_rujukan_keluar').on('keyup', function(){
    var poli = get_data_poli();
    // console.log(test);
    $( "#poli_rujukan_keluar").autocomplete({
      source : poli,
      minLength: 1,
      select: function(event, ui)
      {
        $('#poli_rujukan_keluar').val(ui.item.value);
      }
    }).data('ui-autocomplete')._renderItem = function(ul, item){
          return $("<li class='ui-autocomplete-row'></li>")
            .data("item.autocomplete", item)
            .append(item.label)
            .appendTo(ul);
    };
});
$('#poli_rujukan_keluar').on('change', function(){
    var nama_poli = $('#poli_rujukan_keluar').val();
    var kode_poli = nama_poli.split(" ", 1);
    $('#kd_poli_rujukan_keluar').val(kode_poli);
});

$('#ppkdirujuk').on('keyup', function(){
    var faskes = get_data_faskes();
    // console.log(test);
    $( "#ppkdirujuk").autocomplete({
      source : faskes,
      minLength: 1,
      select: function(event, ui)
      {
        $('#ppkdirujuk').val(ui.item.value);
      }
    }).data('ui-autocomplete')._renderItem = function(ul, item){
          return $("<li class='ui-autocomplete-row'></li>")
            .data("item.autocomplete", item)
            .append(item.label)
            .appendTo(ul);
    };
});
$('#ppkdirujuk').on('change', function(){
    var nama_faskes = $('#ppkdirujuk').val();
    var kode_faskes = nama_faskes.split(" ", 1);
    $('#kd_ppkdirujuk').val(kode_faskes);
});

$('#cbstatuskll').on('change', function(){
    var status_kecelakaan = $(this).val();
    if (status_kecelakaan==0) {
        $('#divJaminan').hide();
    }else{
        $('#divassesmentPel').hide();
        $('#divJaminan').show();
    }
});
function tes_auto(data_lemparan){
        // var ppkdirujuk          = $('#ppkdirujuk').val();
        var jenis_faskes        = $('#jenis_faskes').val();
        var ambil_notoken       = token_coba();
        var inputan_ppkrujukan  = $("#ppkdirujuk").val();
        $.ajax({
            method      : 'POST',
            url         : base_url()+'index.php/bpjs_api/buat_sep/ppk_dirujuk',
            async       : false,
            data        : {csrf_klinik_mata_edc : ambil_notoken, ppkdirujuk : inputan_ppkrujukan, jns_faskes : jenis_faskes},
            dataType    : 'json',
            success     : function(data){
                // console.log(data);
                data_lemparan = data;
            }
        });
        // console.log(data_lemparan);
        return data_lemparan;
}   
function get_dokter_DPJP(){
    var notoken = token_coba();
    $.ajax({
        type        : 'POST',
        url         : base_url()+'index.php/bpjs_api/buat_sep/get_dokter_DPJP',
        async       : false,
        data        : 'csrf_klinik_mata_edc='+notoken,
        dataType    : 'json',
        success     : function(data){
            console.log(data);
            var option_kosong   = '<option value="-">-- Silahkan Pilih --</option>';
            var html_dpjp       = '';
            var list_dokter = data.response.list;
            for (var i = 0; i < list_dokter.length; i++) {
                html_dpjp += '<option value="'+list_dokter[i].kode+'">'+list_dokter[i].nama+'</option>';
            }
            $('#txtnmdpjp').html(option_kosong+html_dpjp);
        }
    });
}
function get_diagnosa(lempar_data){
    var notoken     = token_coba();
    var nm_diagnosa = $('#diagnosa_rujukan_keluar').val();
    $.ajax({
        type        : 'POST',
        url         : base_url()+'index.php/bpjs_api/buat_sep/get_diagnosa',
        async       : false,
        data        : 'csrf_klinik_mata_edc='+notoken+'&diagnosa='+nm_diagnosa,
        dataType    : 'json',
        success     : function(data){
            // console.log(data);
            lempar_data = data;
        }
    });
    return lempar_data;
}
function get_data_poli(lempar_poli){
    var notoken = token_coba();
    var nm_poli = $('#poli_rujukan_keluar').val();
    $.ajax({
        type        : 'POST',
        url         : base_url()+'index.php/bpjs_api/buat_sep/get_data_poli_rujukan',
        async       : false,
        data        : 'csrf_klinik_mata_edc='+notoken+'&nm_poli='+nm_poli,
        dataType    : 'json',
        success     : function(data){
            // console.log(data);
            lempar_poli = data;
        }
    });
    return lempar_poli;
}
function get_data_faskes(lempar_faskes){
    var notoken         = token_coba();
    var ppkdirujuk      = $('#ppkdirujuk').val();
    var jenis_faskes    = $('#jenis_faskes').val();
    $.ajax({
        type        : 'POST',
        url         : base_url()+'index.php/bpjs_api/buat_sep/get_jenis_faskes',
        async       : false,
        data        : 'csrf_klinik_mata_edc='+notoken+'&ppkdirujuk='+ppkdirujuk+'&jenis_faskes='+jenis_faskes,
        dataType    : 'json',
        success     : function(data){
            // console.log(data);
            lempar_faskes = data;
        }
    });
    return lempar_faskes;
}
$('#btnSimpan').click(function(){
    insert_sep_ke_BPJS();
});
function insert_sep_ke_BPJS(){
    var notoken     = token_coba();
    var form_sep    = $('#theform').serialize();
    // alert(form_sep);
    $.ajax({
        type        : 'POST',
        url         : base_url()+'index.php/bpjs_api/Lihat_sep/update_data_sep',
        async       : false,
        data        : 'csrf_klinik_mata_edc='+notoken+'&'+form_sep,
        dataType    : 'json',
        success     : function(data){
            // console.log(data.keterangan);
            console.log(data);
            // alert(data);
            // if (data.keterangan!='Benar') {
            //     // alert('data Gagal Disimpan');
            //     swal("Maaf! data Gagal di Simpan!", {
            //       icon: "warning",
            //     });
            // }else{
                var nosep = data.nosep;
                var keter = data.keterangan;
                if (keter=='Benar') {
                    swal("Data Berhasil di Disimpan!", {
                      icon: "success",
                    })
                    .then((next) => {
                        var url = base_url()+'index.php/bpjs_api/Lihat_sep/cetak_sep?csrf_klinik_mata_edc='+notoken+'&no_sep='+nosep;
                        window.open(url);
                    });
                }else{
                    swal("Maaf! data Gagal di Simpan!", {
                      icon: "warning",
                    });
                }
        }
    });
}

function token_coba(ambil_token){
    $.ajax({
      type     : 'POST',
      url      : base_url()+'index.php/farmasi/token',
      async    : false,
      dataType :'json',
      success  : function(tok){
        ambil_token = tok.csrf_hash;
      }
    });
    return ambil_token;
}
function formatNumber (num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")
}