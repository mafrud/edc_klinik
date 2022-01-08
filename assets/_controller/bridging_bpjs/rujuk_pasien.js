$(function () {

    // $('#tgl_lahir').datepicker({
    //   format:"yyyy-mm-dd"
    // });
    // public_fuction_CI();
    // layout_daftar_pasien();
    // provinsi_bpjs();
    $('#example1').dataTable();
    $(".select2").select2();
    $(".timepicker").timepicker({
          showInputs: false
    });
});
$('#example1 tbody').on('click', '#btn_rujuk_pasien', function(){
    layout_form_rujuk_pasien();
    // location.href=base_url()+'index.php/dashboard/karcis_umum?csrf_klinik_mata_edc='+notoken+'&id='+data.id;
    var notoken = token_coba();
    var id = $(this).val();
    var $kolom1 = $(this).parents("tr").find("td:nth-child(1)").text();
    var $kolom2 = $(this).parents("tr").find("td:nth-child(2)").text();
    var $kolom3 = $(this).parents("tr").find("td:nth-child(3)").text();
    var $norm = $(this).parents("tr").find("td:nth-child(4)").text();
    var $nodaftar = $(this).parents("tr").find("td:nth-child(6)").text();
    // alert($nodaftar);
    $.ajax({
        type        : 'POST',
        url         : base_url()+'index.php/bpjs_api/create_sep/get_sep_pasien_untuk_dirujuk',
        async       : false,
        data        : 'csrf_klinik_mata_edc='+notoken+'&norm='+$norm+'&nodaftar='+$nodaftar,
        dataType    : 'json',
        success     : function(data){
            console.log(data);
            var hasil_1 = data.data_rujukan;
            var hasil_2 = data.data_edit;
            $('#view_norujukan_keluar').html(hasil_1.noKunjungan);
            $('#view_tujuan_keluar').html(hasil_1.poliRujukan_nama);
            $('#view_tglrujukan_keluar').html(hasil_1.tglKunjungan);
            $('#view_ppk_perujuk_keluar').html(hasil_1.provPerujuk_nama);
            $('#view_nokartu_keluar').html(hasil_1.noKartu);
            $('#view_asl_faskes_keluar').html(hasil_1.asalFaskes);
            $('#view_nama_keluar').html(hasil_1.nama);
            if (hasil_2!='Kosong') {
                $('#id_rujukan_keluar').val(hasil_2.id_insert_rujukan);
                $('#nodaftar_rujukan_keluar').val(hasil_1.nodaftar);
                $('#sep_pasien').val(hasil_1.no_sep);
                $('#tgl_rujukan').val(hasil_2.tglRujukan);
                $('#jenis_faskes').val(hasil_2.jenis_Faskes).trigger('change');
                $('#ppkdirujuk').val(hasil_2.ppkDirujuk);
                // $('#kd_ppkdirujuk').val(hasil_2.nama);
                $('#jenis_layanan').val(hasil_2.jnsPelayanan);
                $('#catatanrujukan').val(hasil_2.catatan);
                $('#diagnosa_rujukan_keluar').val(hasil_2.diagRujukan);
                // $('#kd_diagnosa_rujukan_keluar').val(hasil_2.nama);
                $('#type_rujukan_keluar').val(hasil_2.tipeRujukan).trigger('change');
                $('#poli_rujukan_keluar').val(hasil_2.poliRujukan);

                // $('#diagnosa_rujukan_keluar').val('H54.0 - Blindness, both eyes');
                // $('#kd_poli_rujukan_keluar').val(hasil_2.nama);
                var nama_diagnosa = $('#diagnosa_rujukan_keluar').val();
                var kode_diagnosa = nama_diagnosa.split(" ", 1);
                $('#kd_diagnosa_rujukan_keluar').val(kode_diagnosa);

                var nama_poli = $('#poli_rujukan_keluar').val();
                var kode_poli = nama_poli.split(" ", 1);
                $('#kd_poli_rujukan_keluar').val(kode_poli);

                var nama_faskes = $('#ppkdirujuk').val();
                var kode_faskes = nama_faskes.split(" ", 1);
                $('#kd_ppkdirujuk').val(kode_faskes);

            }else{
                $('#nodaftar_rujukan_keluar').val(hasil_1.nodaftar);
                $('#sep_pasien').val(hasil_1.no_sep);
                
                // $('#diagnosa_rujukan_keluar').val('H54.0 - Blindness, both eyes');
                // $('#kd_poli_rujukan_keluar').val(hasil_2.nama);
                // var nama_diagnosa = $('#diagnosa_rujukan_keluar').val();
                // var kode_diagnosa = nama_diagnosa.split(" ", 1);
                // $('#kd_diagnosa_rujukan_keluar').val(kode_diagnosa);

                // var nama_poli = $('#poli_rujukan_keluar').val();
                // var kode_poli = nama_poli.split(" ", 1);
                // $('#kd_poli_rujukan_keluar').val(kode_poli);

                // var nama_faskes = $('#ppkdirujuk').val();
                // var kode_faskes = nama_faskes.split(" ", 1);
                // $('#kd_ppkdirujuk').val(kode_faskes);
            }
        }
    });
});
$('#btn_simpan_rujukan_keluar').on('click', function(){
    simpan_rujukan_keluar();
});
function simpan_rujukan_keluar(){
    var data_rujukan_keluar = $('#form_rujukan_keluar').serialize();
    var notoken             = token_coba();
    alert(data_rujukan_keluar);
    $.ajax({
        type        : 'POST',
        url         : base_url()+'index.php/bpjs_api/create_sep/simpan_rujukan_keluar',
        async       : false,
        data        : 'csrf_klinik_mata_edc='+notoken+'&'+data_rujukan_keluar,
        dataType    : 'json',
        success     : function(data){
            console.log(data);
        }
    });
}
$('#btn_hapus_rujukan_keluar').on('click', function(){
    hapus_rujukan_keluar();
});
function hapus_rujukan_keluar(){
    alert('Anda yakin ingin menghapus Rujukan Keluar?');
    var data_rujukan_keluar = $('#form_rujukan_keluar').serialize();
    var notoken             = token_coba();
    // alert(data_rujukan_keluar);
    $.ajax({
        type        : 'POST',
        url         : base_url()+'index.php/bpjs_api/create_sep/hapus_data_rujukan_keluar',
        async       : false,
        data        : 'csrf_klinik_mata_edc='+notoken+'&'+data_rujukan_keluar,
        dataType    : 'json',
        success     : function(data){
            console.log(data);
        }
    });
}

$('#btn_update_rujukan_keluar').on('click', function(){
    // alert('Update Data');
    var data_form = $('#form_rujukan_keluar').serialize();
    update_data_rujukan(data_form);
});
function update_data_rujukan(data_form){
    // var data_rujukan_keluar = $('#form_rujukan_keluar').serialize();
    var notoken             = token_coba();
    $.ajax({
        type        : 'POST',
        url         : base_url()+'index.php/bpjs_api/create_sep/update_data_rujukan',
        async       : false,
        data        : 'csrf_klinik_mata_edc='+notoken+'&'+data_form,
        dataType    : 'json',
        success     : function(data){
            console.log(data);
        }
    });
}