$(function () {

    // $('#tgl_lahir').datepicker({
    //   format:"yyyy-mm-dd"
    // });
    public_fuction_CI();
    // layout_daftar_pasien();
    // provinsi_bpjs();
    $('#example1').dataTable();
    $(".select2").select2();
    $(".timepicker").timepicker({
          showInputs: false
    });
});

$('#btn_daftar_pasien').click(function(){
    var url2        = base_url()+'index.php/bpjs_api/Ambil_rujukan_masuk';
    window.location = url2;
});

function public_fuction_CI(){
    var notoken = token_coba();
    $.ajax({
        type        : 'POST',
        url         : base_url()+'index.php/bpjs_api/pasien_bpjs/get_pasien_hari_ini',
        async       : false,
        data        : 'csrf_klinik_mata_edc='+notoken,
        dataType    : 'json',
        success     : function(data){
            console.log(data);
            var load = data.data;
            // alert(load[0].tgl_daftar);
            var htmls    = '';
            var no      = 1;
            if (load==null) {
                $('#daftar_pasien_bpjs_hari_ini').html(htmls);
            }else{
                for (var i = 0; i < load.length; i++) {
                    if (load[i].status==1) {
                        var btn_batal           = '<button class="btn btn-block btn-danger" id="btn_batal_bpjs" value="'+load[i].id+'" disabled><i class="fa fa-times"> </i> Batal</button>';
                        var btn_create_sep      = '<button class="btn btn-block btn-warning" id="btn_create_sep" value="'+load[i].id+'" ><i class="fa fa-pencil-square-o"> </i> Create SEP</button>';
                        var btn_rujuk_pasien    = '<button class="btn btn-block btn-primary" id="btn_rujuk_pasien" value="'+load[i].id+'" disabled><i class="fa fa-envelope-square"> </i> Rujuk Pasien</button>';
                        var btn_lihat_sep       = '<button class="btn btn-block btn-success" id="btn_lihat_sep" value="'+load[i].id+'" disabled><i class="fa fa-eye"> </i> Lihat</button>';
                    }else{
                        var btn_batal           = '<button class="btn btn-block btn-danger" id="btn_batal_bpjs" value="'+load[i].id+'"><i class="fa fa-times"> </i> Batal</button>';
                        var btn_create_sep      = '<button class="btn btn-block btn-warning" id="btn_create_sep" value="'+load[i].id+'" disabled><i class="fa fa-pencil-square-o"> </i> Create SEP</button>';
                        var btn_rujuk_pasien    = '<button class="btn btn-block btn-primary" id="btn_rujuk_pasien" value="'+load[i].id+'"><i class="fa fa-envelope-square"> </i> Rujuk Pasien</button>';
                        var btn_lihat_sep       = '<button class="btn btn-block btn-success" id="btn_lihat_sep" value="'+load[i].id+'"><i class="fa fa-eye"> </i> Lihat</button>';
                    }
                    htmls += '<tr>'
                                    +'<td>'+no+'</td>'
                                    +'<td>'+load[i].tgl_daftar+'</td>'
                                    +'<td>'+load[i].norm_pot+'</td>'
                                    +'<td hidden>'+load[i].norm+'</td>'
                                    +'<td>'+load[i].pot_nopendaftar+'</td>'
                                    +'<td hidden>'+load[i].no_pendaftaran+'</td>'
                                    +'<td>'+load[i].nm_pasien+'</td>'
                                    +'<td>'+load[i].jk+'</td>'
                                    +'<td>'+load[i].no_rujuk+'</td>'
                                    +'<td>'+load[i].no_kpst+'</td>'
                                    +'<td>'+btn_lihat_sep + btn_create_sep + btn_rujuk_pasien + btn_batal+'</td>'
                            +'</tr>';
                            no++;
                }
                $('#daftar_pasien_bpjs_hari_ini').html(htmls);
            }
        }
    });
}

$('#example1 tbody').on('click', '#btn_rujuk_pasien', function(){
    var id = $(this).val();
    var $kolom5 = $(this).parents("tr").find("td:nth-child(5)").text();
    var url = base_url()+'index.php/bpjs_api/Rujuk_pasien?nodaftar_pasien='+$kolom5;
    window.open(url);
    // swal("Anda Yakin !", {
    //   icon: "success",
    // })
    // .then((next) => {
    //     var url = base_url()+'index.php/bpjs_api/pasien_bpjs';
    //     window.open(url);
    // });
    // alert($kolom5);
    // hapus_sep($kolom5);
});

$('#example1 tbody').on('click', '#btn_batal_bpjs', function(){
    var id = $(this).val();
    var $kolom5 = $(this).parents("tr").find("td:nth-child(5)").text();
    // alert($kolom5);
    hapus_sep($kolom5);
});

function hapus_sep($kolom5){
    var notoken = token_coba();
    $.ajax({
        type        : 'POST',
        url         : base_url()+'index.php/bpjs_api/pasien_bpjs/delete_nosep',
        async       : false,
        data        : 'csrf_klinik_mata_edc='+notoken+'&nodaftar='+$kolom5,
        dataType    : 'json',
        success     : function(data){
            console.log(data);
            if (data=='Benar') {
                // alert('data Gagal Disimpan');
                swal("Data Berhasil di Disimpan!", {
                  icon: "success",
                })
                .then((next) => {
                    var url = base_url()+'index.php/bpjs_api/pasien_bpjs';
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

$('#example1 tbody').on('click', '#btn_create_sep', function(){
    // layout_form_ambil_sep();
    var id              = $(this).val();
    var $kolom1         = $(this).parents("tr").find("td:nth-child(1)").text();
    var $kolom2         = $(this).parents("tr").find("td:nth-child(2)").text();
    var $kolom3         = $(this).parents("tr").find("td:nth-child(3)").text();
    var $norm           = $(this).parents("tr").find("td:nth-child(4)").text();
    var $nodaftar       = $(this).parents("tr").find("td:nth-child(6)").text();
    var nama_pasien     = $(this).parents("tr").find("td:nth-child(7)").text();
    var noka_pas        = $(this).parents("tr").find("td:nth-child(10)").text();
    var url2        = base_url()+'index.php/bpjs_api/buat_sep?id_rujukan='+id;
    window.location = url2;
});

$('#example1 tbody').on('click', '#btn_lihat_sep', function(){
    // layout_form_ambil_sep();
    var id              = $(this).val();
    var $kolom1         = $(this).parents("tr").find("td:nth-child(1)").text();
    var $kolom2         = $(this).parents("tr").find("td:nth-child(2)").text();
    var $kolom3         = $(this).parents("tr").find("td:nth-child(3)").text();
    var $norm           = $(this).parents("tr").find("td:nth-child(4)").text();
    var $nodaftar       = $(this).parents("tr").find("td:nth-child(6)").text();
    var nama_pasien     = $(this).parents("tr").find("td:nth-child(7)").text();
    var noka_pas        = $(this).parents("tr").find("td:nth-child(10)").text();
    var url2        = base_url()+'index.php/bpjs_api/lihat_sep?noka_peserta='+noka_pas+'&id_rujukan='+id;
    window.location = url2;
});

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