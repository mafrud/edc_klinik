$('#divCarikartu').hide();

$('#rbcarirujukan').on('click', function(){
    $('#divCariRujukan').show();
    $('#divCarikartu').hide();
});
$('#rbcarikartu').on('click', function(){
    $('#divCariRujukan').hide();
    $('#divCarikartu').show();
});

$('#nodaftas_pasien').change(function(){
	var id = $(this).val();
	// alert($(this).val());
	get_data_pasien_nodaftar(id);
});
$('#btnCari').on('click', function(){
    // get_dokter();
    // var get_nama_provinsi = '';
    // get_provinsi(get_nama_provinsi);
    tes_http_request();
});

function get_data_pasien_nodaftar(nodaftar){
	var notoken = token_coba();
    $.ajax({
        type        : 'POST',
        url         : base_url()+'index.php/bpjs_api/Ambil_rujukan_masuk/get_data_pasien_nodaftar',
        async       : false,
        data        : 'csrf_klinik_mata_edc='+notoken+'&nodaftar='+nodaftar,
        dataType    : 'json',
        success     : function(data){
            console.log(data);
            for(i=0; i<data.length; i++){
            	$('#txtNoRujukan_0').val(data[i].NO_RUJUKAN);
            	$('#norm_pasien').val(data[i].NORM);
            	$('#nodaftar_pasien').val(data[i].NODAFTAR);
            }
        }
    });
}

function tes_http_request(){
    var notoken = token_coba();
    var form_rujukan    = $('#form_rujukan').serialize();
    $.ajax({
        type      : 'POST',
        url       : base_url()+'index.php/bpjs_api/Ambil_rujukan_masuk/tes_http_request',
        async     : false,
        data      : 'csrf_klinik_mata_edc='+notoken+'&'+form_rujukan,
        dataType  : 'json',
        success   : function(data){
          console.log(data);
          if (data.metaData.code==201) {
            alert('Data rujukan Tidak Ditemukan');
          }else if (data.metaData.code==200){
            $('#view_norujukan').html(data.response.rujukan.noKunjungan);
            $('#view_tujuan').html(data.response.rujukan.poliRujukan.nama);
            $('#view_tglrujukan').html(data.response.rujukan.tglKunjungan);
            $('#view_ppk_perujuk').html(data.response.rujukan.provPerujuk.nama);
            $('#view_nokartu').html(data.response.rujukan.peserta.noKartu);
            $('#view_asl_faskes').html(data.response.asalFaskes);
            $('#view_nama').html(data.response.rujukan.peserta.nama);
            // data
            $('#rujukan_asal_faskes_ambil').val(data.response.asalFaskes);
            $('#rujukan_diagnosa_kode_ambil').val(data.response.rujukan.diagnosa.kode);
            $('#rujukan_diagnosa_nama_ambil').val(data.response.rujukan.diagnosa.nama);
            $('#rujukan_keluhan_ambil').val(data.response.rujukan.keluhan);
            $('#rujukan_noKunjungan_ambil').val(data.response.rujukan.noKunjungan);
            $('#rujukan_pelayanan_kode_ambil').val(data.response.rujukan.pelayanan.kode);
            $('#rujukan_pelayanan_nama_ambil').val(data.response.rujukan.pelayanan.nama);
            $('#peserta_cob_nmasuransi_ambil').val(data.response.rujukan.peserta.cob.nmAsuransi);
            $('#peserta_cob_noasuransi_ambil').val(data.response.rujukan.peserta.cob.noAsuransi);
            $('#peserta_cob_tglTAT_ambil').val(data.response.rujukan.peserta.cob.tglTAT);
            $('#peserta_cob_tglTMT_ambil').val(data.response.rujukan.peserta.cob.tglTMT);
            $('#peserta_hakKelas_kode_ambil').val(data.response.rujukan.peserta.hakKelas.kode);
            $('#peserta_hakKelas_keterangan_ambil').val(data.response.rujukan.peserta.hakKelas.keterangan);
            $('#rujukan_peserta_informasi_dinsos_ambil').val(data.response.rujukan.peserta.informasi.dinsos);
            $('#rujukan_peserta_informasi_noSKTM_ambil').val(data.response.rujukan.peserta.informasi.noSKTM);
            $('#rujukan_peserta_informasi_prolanisPRB_ambil').val(data.response.rujukan.peserta.informasi.prolanisPRB);
            $('#rujukan_peserta_jenisPeserta_keterangan_ambil').val(data.response.rujukan.peserta.jenisPeserta.keterangan);
            $('#rujukan_peserta_jenisPeserta_kode_ambil').val(data.response.rujukan.peserta.jenisPeserta.kode);
            $('#rujukan_peserta_mr_noMR_ambil').val(data.response.rujukan.peserta.mr.noMR);
            $('#rujukan_peserta_mr_noTelepon_ambil').val(data.response.rujukan.peserta.mr.noTelepon);
            $('#rujukan_peserta_nama_ambil').val(data.response.rujukan.peserta.nama);
            $('#rujukan_peserta_nik_ambil').val(data.response.rujukan.peserta.nik);
            $('#rujukan_peserta_noKartu_ambil').val(data.response.rujukan.peserta.noKartu);
            $('#rujukan_peserta_pisa_ambil').val(data.response.rujukan.peserta.pisa);
            $('#rujukan_peserta_provUmum_kdProvider_ambil').val(data.response.rujukan.peserta.provUmum.kdProvider);
            $('#rujukan_peserta_provUmum_nmProvider_ambil').val(data.response.rujukan.peserta.provUmum.nmProvider);
            $('#rujukan_peserta_sex_ambil').val(data.response.rujukan.peserta.sex);
            $('#rujukan_peserta_statusPeserta_keterangan_ambil').val(data.response.rujukan.peserta.statusPeserta.keterangan);
            $('#rujukan_peserta_statusPeserta_kode_ambil').val(data.response.rujukan.peserta.statusPeserta.kode);
            $('#rujukan_peserta_tglCetakKartu_ambil').val(data.response.rujukan.peserta.tglCetakKartu);
            $('#rujukan_peserta_tglLahir_ambil').val(data.response.rujukan.peserta.tglLahir);
            $('#rujukan_peserta_tglTAT_ambil').val(data.response.rujukan.peserta.tglTAT);
            $('#rujukan_peserta_tglTMT_ambil').val(data.response.rujukan.peserta.tglTMT);
            $('#rujukan_peserta_umur_umurSaatPelayanan_ambil').val(data.response.rujukan.peserta.umur.umurSaatPelayanan);
            $('#rujukan_peserta_umur_umurSekarang_ambil').val(data.response.rujukan.peserta.umur.umurSekarang);
            $('#rujukan_poliRujukan_kode_ambil').val(data.response.rujukan.poliRujukan.kode);
            $('#rujukan_poliRujukan_nama_ambil').val(data.response.rujukan.poliRujukan.nama);
            $('#rujukan_provPerujuk_kode_ambil').val(data.response.rujukan.provPerujuk.kode);
            $('#rujukan_provPerujuk_nama_ambil').val(data.response.rujukan.provPerujuk.nama);
            $('#rujukan_tglKunjungan_ambil').val(data.response.rujukan.tglKunjungan);
            $('#tgl_lahir').val(data.response.rujukan.peserta.tglLahir);
            $('#norm_bpjs').val(data.response.rujukan.peserta.mr.noMR);
            // data
            var nama_pasien     = data.response.rujukan.peserta.nama;
            var nik_pasien      = data.response.rujukan.peserta.nik;
            var jenis_kelamin   = data.response.rujukan.peserta.sex;
            var tanggal_lahir   = data.response.rujukan.peserta.tglLahir;
            var nokartu         = data.response.rujukan.peserta.noKartu;
            // get_norm_pasien(nama_pasien, nik_pasien, jenis_kelamin, tanggal_lahir, nokartu);
            // get_dokter();
          }else{
            alert('Mohon Maaf Sepertinya Ada yang Salah');
          }
          
        }
    });
}

$('#btnAmbil').on('click', function(){
    ambil_data_rujukan();
});
function ambil_data_rujukan(){
    var notoken             = token_coba();
    var form_ambil_rujukan  = $('#form_ambil_rujukan').serialize();
    $.ajax({
        type        : 'POST',
        url         : base_url()+'index.php/bpjs_api/Ambil_rujukan_masuk/simpan_data_rujukan',
        async       : false,
        data        : 'csrf_klinik_mata_edc='+notoken+'&'+form_ambil_rujukan,
        dataType    : 'json',
        success     : function(data){
            console.log(data);
            if (data=='Benar') {
                swal("Data Berhasil di Simpan", {
                  icon: "success",
                  dangerMode: true,
                })
                .then((next) => {
                  var url2    = base_url()+'index.php/bpjs_api/pasien_bpjs';
                  window.location = url2;
                });
            }else{
                swal("Maaf, Penyimpanan Data Gagal!", {
                  icon: "error",
                });
            }
        }
    });
}

// function hapus_sep($kolom5){
//     var notoken = token_coba();
//     $.ajax({
//         type        : 'POST',
//         url         : base_url()+'index.php/bpjs_api/create_sep/delete_nosep',
//         async       : false,
//         data        : 'csrf_klinik_mata_edc='+notoken+'&nodaftar='+$kolom5,
//         dataType    : 'json',
//         success     : function(data){
//             console.log(data);
//         }
//     });
// }

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