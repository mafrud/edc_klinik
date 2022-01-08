  $(function () {
    $('#modal_kode_golongan').hide();
    $('#modal_detail_pasien').hide();
    $(".select2").select2();
    $(".timepicker").timepicker({
          showInputs: false
    });
    var outlet = $('#kode_outlet').html();
    if (outlet=='HLD' || outlet=='SPJ') {
        $('#btn_masukkan_resep').show();    
    }else{
        $('#btn_masukkan_resep').hide();
    }
    get_data_dokter_aktif_ttd();
  });
  function get_data_dokter_aktif_ttd(){
    var notoken = token_coba();
    $.ajax({
      type      : 'POST',
      url       : base_url()+'index.php/dashboard/get_data_dokter_aktif_ttd',
      async     : false,
      data      : 'csrf_klinik_mata_edc='+notoken,
      dataType  : 'json',
      success   : function(data){
        console.log(data);
        var no    = 1;
        var html  = '';
        var i;
        for (i = 0; i < data.length; i++) {
            var status_ttd_cetak = data[i].STATUS_CETAK;
            if (status_ttd_cetak==1) {
                var check_k = '<input type="checkbox" class="minimal" name="status_cetak_k" id="status_cetak_k" value="'+data[i].STATUS_CETAK+'" checked>';
            }else{
                var check_k = '<input type="checkbox" class="minimal" name="status_cetak_k" id="status_cetak_k" value="'+data[i].STATUS_CETAK+'" ';
            }
          html +='<tr>'+
                          '<td hidden>'+data[i].ID_TARIF+'</td>'+
                          '<td>'+data[i].NAMA_DOKTER+'</td>'+
                          '<td>'+check_k+'</td>'+
                        '</tr>';
        }
        $('#tbd_tabel_status_ttd_pasien_k').html(html);
        $('#tbd_tabel_status_ttd_pasien_t').html(html);
      }
    });
  }
  $("#tabel_status_ttd_pasien_k tbody").on('click', "#status_cetak_k", function(){
    var status = $(this).val();
    var $kolom1 = $(this).parents("tr").find("td:nth-child(1)").text();
    var $kolom2 = $(this).parents("tr").find("td:nth-child(2)").text();    
    update_ttd_data(status, $kolom1);
  });
  $("#tabel_status_ttd_pasien_t tbody").on('click', "#status_cetak_k", function(){
    var status = $(this).val();
    var $kolom1 = $(this).parents("tr").find("td:nth-child(1)").text();
    var $kolom2 = $(this).parents("tr").find("td:nth-child(2)").text();    
    update_ttd_data(status, $kolom1);
  });
  function update_ttd_data(status, id){
    var notoken = token_coba();
    $.ajax({
      type      : 'POST',
      url       : base_url()+'index.php/dashboard/update_ttd_data',
      async     : false,
      data      : 'csrf_klinik_mata_edc='+notoken+'&status='+status+'&id='+id,
      dataType  : 'json',
      success   : function(data){
        console.log(data);
        get_data_dokter_aktif_ttd();
      }
    });
  }
  function hide_all(){
    $('#form_retur_terapi').hide();
    $("#tabel_pasien_hari_ini").show();
    $("#tabel_pasien_lama").hide();
    $("#form_pendaftaran_pasien").hide();
    $("#section_karcis").hide();
    $("#list_tindakan_pasien").hide();
    $("#pembayaran_tindakan_pasien").hide();
    $("#input_tindakan_dan_obat").hide();
    $("#riwayat_tabel_pasien").hide();
    $("#form_retur_penjualan_obat").hide();
    $('#input_sewa_kendaraan').hide();
    $('#form_penjualan_optik').hide();
    $('#input_resep_obat').hide();
  }
  function sewa_mobil(){
    $('#form_retur_terapi').hide();
    $("#tabel_pasien_hari_ini").hide();
    $("#tabel_pasien_lama").hide();
    $("#form_pendaftaran_pasien").hide();
    $("#section_karcis").hide();
    $("#list_tindakan_pasien").hide();
    $("#pembayaran_tindakan_pasien").hide();
    $("#input_tindakan_dan_obat").hide();
    $("#riwayat_tabel_pasien").hide();
    $("#form_retur_penjualan_obat").hide();
    $('#form_penjualan_optik').hide();
    $('#input_sewa_kendaraan').show(); 
    $('#input_resep_obat').hide();
  }
  function jual_optik(){
    $('#form_retur_terapi').hide();
    $("#tabel_pasien_hari_ini").hide();
    $("#tabel_pasien_lama").hide();
    $("#form_pendaftaran_pasien").hide();
    $("#section_karcis").hide();
    $("#list_tindakan_pasien").hide();
    $("#pembayaran_tindakan_pasien").hide();
    $("#input_tindakan_dan_obat").hide();
    $("#riwayat_tabel_pasien").hide();
    $("#form_retur_penjualan_obat").hide();
    $('#input_sewa_kendaraan').hide(); 
    $('#form_penjualan_optik').show();
    $('#input_resep_obat').hide();
  }
  function riwayat_pasien(){
    $("#tabel_pasien_hari_ini").hide();
    $("#tabel_pasien_lama").hide();
    $("#form_pendaftaran_pasien").hide();
    $("#section_karcis").hide();
    $("#list_tindakan_pasien").hide();
    $("#pembayaran_tindakan_pasien").hide();
    $("#input_tindakan_dan_obat").hide();
    $("#riwayat_tabel_pasien").show();
    $("#form_retur_penjualan_obat").hide();
    $('#form_penjualan_optik').hide();
    $('#input_resep_obat').hide();
  }
  function show_pasien(){
    $("#tabel_pasien_hari_ini").hide();
    $("#tabel_pasien_lama").show();
    $("#form_pendaftaran_pasien").hide();
    $("#section_karcis").hide();
    $("#list_tindakan_pasien").hide();
    $("#pembayaran_tindakan_pasien").hide(); 
    $("#input_tindakan_dan_obat").hide();
    $("#riwayat_tabel_pasien").hide();
    $("#form_retur_penjualan_obat").hide();
    $('#form_penjualan_optik').hide();
    $('#input_resep_obat').hide();
  }
  function show_form_pendaftaran(){
    $("#tabel_pasien_hari_ini").hide();
    $("#tabel_pasien_lama").hide();
    $("#form_pendaftaran_pasien").show();
    $("#section_karcis").hide();
    $("#list_tindakan_pasien").hide();
    $("#pembayaran_tindakan_pasien").hide(); 
    $("#input_tindakan_dan_obat").hide();
    $("#riwayat_tabel_pasien").hide();
    $("#form_retur_penjualan_obat").hide();
    $('#form_penjualan_optik').hide();
    $('#input_resep_obat').hide();
  }
  function show_karcis(){
    $("#tabel_pasien_hari_ini").hide();
    $("#tabel_pasien_lama").hide();
    $("#form_pendaftaran_pasien").hide();
    $("#section_karcis").show();
    $("#list_tindakan_pasien").hide();
    $("#pembayaran_tindakan_pasien").hide(); 
    $("#input_tindakan_dan_obat").hide();
    $("#riwayat_tabel_pasien").hide();
    $("#form_retur_penjualan_obat").hide();
    $('#form_penjualan_optik').hide();
    $('#input_resep_obat').hide();
  }
  function list_tindakan_pasien(){
    $("#tabel_pasien_hari_ini").hide();
    $("#tabel_pasien_lama").hide();
    $("#form_pendaftaran_pasien").hide();
    $("#section_karcis").hide();
    $("#list_tindakan_pasien").show();
    $("#pembayaran_tindakan_pasien").hide(); 
    $("#input_tindakan_dan_obat").hide();
    $("#riwayat_tabel_pasien").hide();
    $("#form_retur_penjualan_obat").hide();
    $('#input_sewa_kendaraan').hide();
    $('#form_penjualan_optik').hide();
    $('#input_resep_obat').hide();
  }
  function pembayaran_tindakan_pasien(){
    $("#tabel_pasien_hari_ini").hide();
    $("#tabel_pasien_lama").hide();
    $("#form_pendaftaran_pasien").hide();
    $("#section_karcis").hide();
    $("#list_tindakan_pasien").hide();
    $("#pembayaran_tindakan_pasien").show();  
    $("#input_tindakan_dan_obat").hide();
    $("#riwayat_tabel_pasien").hide();
    $("#form_retur_penjualan_obat").hide();
    $('#form_penjualan_optik').hide();
    $('#input_resep_obat').hide();
  }
  function input_tindakan_dan_obat(){
    $("#tabel_pasien_hari_ini").hide();
    $("#tabel_pasien_lama").hide();
    $("#form_pendaftaran_pasien").hide();
    $("#section_karcis").hide();
    $("#list_tindakan_pasien").hide();
    $("#pembayaran_tindakan_pasien").hide();  
    $("#input_tindakan_dan_obat").show();
    $("#riwayat_tabel_pasien").hide(); 
    $("#form_retur_penjualan_obat").hide();
    $('#form_penjualan_optik').hide();
    $('#input_resep_obat').hide();
  }
  function input_resep_obat(){
    $("#tabel_pasien_hari_ini").hide();
    $("#tabel_pasien_lama").hide();
    $("#form_pendaftaran_pasien").hide();
    $("#section_karcis").hide();
    $("#list_tindakan_pasien").hide();
    $("#pembayaran_tindakan_pasien").hide();  
    $("#input_tindakan_dan_obat").hide();
    $("#riwayat_tabel_pasien").hide(); 
    $("#form_retur_penjualan_obat").hide();
    $('#form_penjualan_optik').hide();
    $('#input_resep_obat').show();
  }
  function input_form_retur(){
    $("#tabel_pasien_hari_ini").hide();
    $("#tabel_pasien_lama").hide();
    $("#form_pendaftaran_pasien").hide();
    $("#section_karcis").hide();
    $("#list_tindakan_pasien").hide();
    $("#pembayaran_tindakan_pasien").hide();  
    $("#input_tindakan_dan_obat").hide();
    $("#riwayat_tabel_pasien").hide(); 
    $("#form_retur_penjualan_obat").show(); 
    $('#form_penjualan_optik').hide();
    $('#input_resep_obat').hide();
  }
  function kosongkan_form_optik(){
    $("#id_proses_tindakan").val("");
    $("#nama_barang_optik").val("");
    $("#nama_frame").val("");
    $("#nama_lensa").val("");
    $("#idtindakan").val("").trigger("change");
    $("#qty_obat_optik").val("");
    $("#Keterangan_jual_optik").val("");
    $("#id_stok_optik2").val("");
    $("#tanggal_hutang").val("");
    $('#harga_satuan_optik').val('');
    $('#jumlah_total_optik').val('');
    $('#id_optik').val('');
    $('#id_stok_optik').val('').prop('disabled',false);
    $("#status_bayar_dp").prop('checked',false);
    $("#status_bayar_lunas").prop('checked',false);
  }
  hide_all();
  $("#btn_daftar_pasien").click(function(){
    show_pasien();
  });
  $('#cari_pasien_lama').click(function(){
    var nik_pasien = $('#nik_pasien_screening').val();
    var norm_pasien = $('#no_rm_pasien_lama').val();
    var nama_pasien = $('#nama_pasien_lama').val();
    if (nik_pasien=='') {
      get_pasien();
      $('#example3').dataTable();
      get_pasien_lama();
      $('#tabel_pasien_dos').dataTable();
    }else{
      get_pasien();
      $('#example3').dataTable();
      get_pasien_screening();
      $('#tabel_pasien_screening').dataTable();
    }
  });
  $("#btn_riwayat_pasien").click(function(){
    riwayat_pasien();
  });
  $('#tanggal_rwyt2').on('change', function(){
    get_riwayat_pasien();
    $('#example2').dataTable();
  });
  $("#back_home").click(function(){
    hide_all();
    $('#tanggal_rwyt1').val('');
    $('#tanggal_rwyt2').val('');
  });
  $("#tambah_pasien_baru").click(function(){
    var get_nama_provinsi = '';
    show_form_pendaftaran();
    
    get_dokter();
    get_provinsi(get_nama_provinsi);
    $("#input_nokpst").hide();
    $("#norm_lama").hide();
  });
  $("#btn_batal_pendaftaran").click(function(){
    show_pasien();
    $("#form_daftarkan_pasien")[0].reset();
    $('#norm_pasien').val('');
    $("#jk").val('').trigger('change');
    $("#pekerjaan").val('').trigger('change');
    $("#jenis_pasien").val('').trigger('change');
    $("#jenis_pasien").prop('disabled', false);
    $("#nama_provinsi").val("");
    $("#nama_kabupaten").val("");
    $("#nama_kecamatan").val("");
    $("#nama_desa").val();
    var option_jenis_p = '<option value="UMUM">UMUM</option>'+
                         '<option value="BPJS">BPJS</option>'+
                         '<option value="GRATIS">GRATIS</option>'+
                         '<option value="MNC">MNC</option>';
    $("#jenis_pasien").html(option_jenis_p);
  });
  $("#btn_batal_simpan_pembayaran_k").click(function(){
    $("#btn_simpan_bayar_karcis").hide();
    $("#form_bayar_karcis").hide();
    $("#diskon_k").val("");
    $('#grup_cetak_karcis').show();
    $("#hasil_diskon_k").val("");
    $("#token_b_k").val("");
    $("#tabel_karcis_pasien_k").show();
    $("#btn_bayar_karcis").show();
    $("#btn_cetak_karcis").show();
    var status = $('#status_input_karcis').val();
    if (status==1) {
        $("#btn_batal_pembayaran").show();
        $("#btn_batal_pembayaran_k_urgen").hide();
    }else{
        $("#btn_batal_pembayaran").hide();
        $("#btn_batal_pembayaran_k_urgen").show();
    }
    $("#btn_batal_simpan_pembayaran_k").hide();
    var id_role = $('#role_permision').html();
    if (id_role==37) {
      $('#form_karcis_urgen').hide();
    }else{
      $('#form_karcis_urgen').show();
    }
    $("#jumlah_yang_dibayar_k").hide();
  })
  $("#btn_bayar_karcis").click(function(){
    var tanggal_sekarang = $("#tanggal_pada_hari_ini").html();
    $("#jam_pembayaran_k").val($("#clock").html());
    $("#btn_simpan_bayar_karcis").show();
    $("#form_bayar_karcis").show();
    $("#tabel_karcis_pasien_k").hide();
    $("#btn_bayar_karcis").hide();
    $("#btn_cetak_karcis").hide();
    $('#form_karcis_urgen').hide();
    $("#btn_batal_pembayaran").hide();
    $("#btn_batal_pembayaran_k_urgen").hide();
    $("#btn_batal_simpan_pembayaran_k").show();
    $("#tanggal_pembayaran_k").val(tanggal_sekarang).trigger("change");
    $("#jumlah_yang_dibayar_k").show();
    var nodaftar  = $("#nodaftar_pembayar_k").val();
    get_nominal_bayar_kasrcis(nodaftar);
    var t_admin   = $("#tarif_admin_k").val();
    var t_dokter  = $("#tarif_periksa_k").val();
    $("#jumlah_tagihan_k").val(parseInt(t_admin)+parseInt(t_dokter));
    $('#grup_cetak_karcis').hide();
  });
  $("#btn_masukkan_tindakan").click(function(){
    input_tindakan_dan_obat();
    $("#judul_input_obat").hide();
    $("#daftar_input_obat").hide();
    $("#tbl_input_obat_baru").hide();
    $("#btn_simpan_tindakan_obat").hide();
    $('#ceklist_pegawai').hide();
    $('#dp_harga_tindakan').show();
    $('#nominal_dp_tindakan_palsu').hide();
    list_data_tindakan();
    get_dokter();
  });
  $('#checklist_dp_harga_tindakan').on('change', function(){
    if ($(this).is(':checked')) {
      $(this).val('1')
      $('#nominal_dp_tindakan_palsu').show();
    }else{
      $('#nominal_dp_tindakan_palsu').hide();
      $(this).val('0')
    }
  });
  $('#nominal_dp_tindakan_palsu').change(function(e){
    var rupiah1 = $('#nominal_dp_tindakan_palsu').val();
    var str = rupiah1.replace(/[Rp . ]/g, "")
    $('#nominal_dp_tindakan').val(str);
    var rupiah = document.getElementById('nominal_dp_tindakan_palsu');
    rupiah.value = formatRupiah(this.value, 'Rp. ');
  });
  $('#nominal_dp_tindakan_palsu').on('keyup', function(e){
    var rupiah1 = $('#nominal_dp_tindakan_palsu').val();
    var str = rupiah1.replace(/[Rp . ]/g, "")
    $('#nominal_dp_tindakan').val(str);
    var rupiah = document.getElementById('nominal_dp_tindakan_palsu');
    rupiah.value = formatRupiah(this.value, 'Rp. ');
  });
  function formatRupiah(angka, prefix){
    var rupiah = document.getElementById('nominal_dp_tindakan_palsu');
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split       = number_string.split(','),
    sisa        = split[0].length % 3,
    rupiah      = split[0].substr(0, sisa),
    ribuan      = split[0].substr(sisa).match(/\d{3}/gi);
    if(ribuan){
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
  }
  $("#btn_masukkan_obat").click(function(){
    input_tindakan_dan_obat();
    $("#judul_input_tindakan").hide();
    $("#daftar_input_tindakan").hide();
    $("#tbl_input_tindakan_baru").hide();
    $("#btn_simpan_tindakan_pelayanan").hide();
    $('#ceklist_pegawai').show();
    $('#dokter_tindakan').hide();
    $('#dokter_tindakan').hide();
    $('#dp_harga_tindakan').hide();
    get_data_obat_outlet();
  });
  $("#btn_masukkan_resep").click(function(){
    input_resep_obat();
    get_data_obat_resep();
    get_resep_pasien();
  });
  $("#btn_pembayaran_tindakan").click(function(){
    var tanggal_sekarang = $("#tanggal_pada_hari_ini").html();
    $("#tanggal_pembayaran").val(tanggal_sekarang);
    $("#jam_pembayaran").val($("#clock").html());
    get_biaya_pembayaran_tindakan();
    pembayaran_tindakan_pasien();
    pembayaran_sewa_mobil();
    pembayaran_optik();
    var biaya_op    = $("#biaya_operasi_bt").val();
    var biaya_rj    = $("#biaya_bukan_operasi_bt").val();
    var biaya_ob    = $("#jumlah_tagihan_obat").val();
    var sewa        = $('#jumlah_sewa').val();
    var optik       = $("#jumlah_hrg_optik").val();
    if (sewa=='') {
      var jum_sewa_mobil = 0;
    }else{
      var jum_sewa_mobil = sewa;
    }
    var total_harga = parseInt(biaya_op)+parseInt(biaya_rj)+parseInt(biaya_ob)+parseInt(jum_sewa_mobil)+parseInt(optik);
    var total_bayar = total_harga.toString();
    var potong = total_bayar.substr(-2);
    var status_pasien = $("#kepesetaan").html();
    if (status_pasien=='BPJS') {
      var bayar_bulat = total_harga;
    }else{
      if (potong>00) {
        var bulat = parseInt(total_harga)-parseInt(potong)+100;
        var bayar_bulat = bulat;
      }else{
        var bayar_bulat = total_harga;
      }
    }
    $("#jumlah_tagihan").val(bayar_bulat);
    var tagihan_bayar = $("#jumlah_tagihan").val();
    if (isNaN(tagihan_bayar) || tagihan_bayar==0) {
      $("#btn_bayar_tindakan").show();
      $('#grup_cetak_tindakan').show();
    }else{
      $("#btn_bayar_tindakan").show();
      $('#grup_cetak_tindakan').hide();
    }
  });
  $("#btn_batal_tindakan").click(function(){
    var nodaftar = $("#nodaftar_proses_tindakan").val();
    $("#judul_input_obat").show();
    $("#daftar_input_obat").show();
    $("#judul_input_tindakan").show();
    $("#daftar_input_tindakan").show();
    $("#tbl_input_tindakan_baru").show();
    $("#tbl_input_obat_baru").show();
    $("#btn_simpan_tindakan_pelayanan").show();
    $("#btn_simpan_tindakan_obat").show();
    $("#idobat").prop('disabled', false);
    $('#dokter_tindakan').show();
    $("#id_proses_tindakan").val("");
    $("#idobat").val("").trigger("change");
    $("#idtindakan").val("").trigger("change");
    $("#qty").val("");
    $("#Keterangan").val("");
    list_tindakan_pasien();
    get_tindakan_global(nodaftar);
    get_obat_global(nodaftar);
  });
  $("#btn_batal_resep").click(function(){
    var nodaftar = $("#nodaftar_proses_tindakan").val();
    $("#judul_input_obat").show();
    $("#daftar_input_obat").show();
    $("#judul_input_tindakan").show();
    $("#daftar_input_tindakan").show();
    $("#tbl_input_tindakan_baru").show();
    $("#tbl_input_obat_baru").show();
    $("#btn_simpan_tindakan_pelayanan").show();
    $("#btn_simpan_tindakan_obat").show();
    $("#idobat").prop('disabled', false);
    $("#id_proses_tindakan").val("");
    $("#idobat").val("").trigger("change");
    $("#idtindakan").val("").trigger("change");
    $("#qty").val("");
    $("#Keterangan").val("");
    $('#id_resep').val('');
    $('#idresep').val('').trigger('change');
    $('#qty_resep').val('');
    list_tindakan_pasien();
    get_tindakan_global(nodaftar);
    get_obat_global(nodaftar);
  });
  $('#btn_batal_sewa').click(function(){
    var nodaftar = $("#nodaftar_proses_tindakan").val();
    $("#judul_input_obat").show();
    $("#daftar_input_obat").show();
    $("#judul_input_tindakan").show();
    $("#daftar_input_tindakan").show();
    $("#tbl_input_tindakan_baru").show();
    $("#tbl_input_obat_baru").show();
    $("#btn_simpan_tindakan_pelayanan").show();
    $("#btn_simpan_tindakan_obat").show();
    $("#id_proses_tindakan").val("");
    $("#idobat").val("").trigger("change");
    $("#idtindakan").val("").trigger("change");
    $("#qty").val("");
    $("#Keterangan").val("");
    list_tindakan_pasien();
    get_tindakan_global(nodaftar);
    get_obat_global(nodaftar);
  });
  $("#btn_batal_gunakan_optik").click(function(){
    var nodaftar = $("#nodaftar_proses_tindakan").val();
    $("#judul_input_obat").show();
    $("#daftar_input_obat").show();
    $("#judul_input_tindakan").show();
    $("#daftar_input_tindakan").show();
    $("#tbl_input_tindakan_baru").show();
    $("#tbl_input_obat_baru").show();
    $("#btn_simpan_tindakan_pelayanan").show();
    $("#btn_simpan_tindakan_obat").show();
    $("#id_proses_tindakan").val("");
    $("#idobat").val("").trigger("change");
    $("#idtindakan").val("").trigger("change");
    $("#qty_obat_optik").val("");
    $("#Keterangan_jual_optik").val("");
    $("#id_stok_optik2").val("");
    $("#tanggal_hutang").val("");
    $('#harga_satuan_optik').val('');
    $('#jumlah_total_optik').val('');
    $('#id_optik').val('');
    $('#id_stok_optik').val('').prop('disabled',false);;
    $("#status_bayar_dp").prop('checked',false);
    $("#status_bayar_lunas").prop('checked',false);
    list_tindakan_pasien();
    get_tindakan_global(nodaftar);
    get_obat_global(nodaftar);
    kosongkan_form_optik();
  });
  $("#btn_batal_pembayaran_tindakan").click(function(){
    var nodaftar = $("#nodaftar_bayar_tindakan").val();
    list_tindakan_pasien();
    get_tindakan_global(nodaftar);
    get_obat_global(nodaftar);
    tampilkan_obat_pasien(nodaftar);
    daftar_tindakan_kepada_pasien(nodaftar);
  });
  $("#btn_batal_pembayaran").click(function(){
    hide_all();
    $("#tbd_tabel_karcis_pasien_k").html("");
  });
  $("#btn_batal_retur").click(function(){
    riwayat_pasien();
    get_riwayat_pasien();
    $('#example2').dataTable();
    $('#form_retur_terapi').hide();
  });
  $("#btn_back_tindakan").click(function(){
    $('#jumlah_sewa').val('');
    hide_all();
  });
  $('#btn_masukkan_sewa_mobil').click(function(){
    $('#nama_sewa_mobil').hide();
    $('#jumlah_harga').prop('readonly', true);
    sewa_mobil();
    get_list_sewa_mobil();
    get_data_sewa();
  });
  $('#btn_masukkan_optik').click(function(){
    $('#tanggal_pelunasan').hide();
    get_penjualan_optik_hari_ini();
    jual_optik();
  });
  $('#status_bayar_dp').on('change', function(){
    if ($(this).is(':checked')) {
      $('#harga_satuan_optik').prop('readonly', false);
      $('#tanggal_hutang').val();
    }else{
      $('#harga_satuan_optik').prop('readonly', false);
    }
  });
  $('#status_bayar_lunas').on('change', function(){
    if ($(this).is(':checked')) {
      $('#harga_satuan_optik').prop('readonly', false);
      $('#tanggal_pelunasan').show();
    }else{
      $('#harga_satuan_optik').prop('readonly', false);
      $('#tanggal_pelunasan').hide();
    }
  });
  $(document).ready(function(){
    user();
    var get_nama_provinsi = '';
    get_data_pendaftar_hari_ini();
    $('#example1').dataTable(
    );
  });
  $('#btn_simpan_pendaftaran').click(function(){
    token_data(1);
  });
  $('#id_stok_optik').change(function(){
    var id_stok = $(this).val();
    var notoken = token_coba();
    get_harga_barang(id_stok,notoken);
    var qty_optik         = $("#qty_obat_optik").val();
    if (qty_optik=='') {
      var qty_o = 0;
    }else{
      var qty_o = qty_optik;
    }
    var hrg_optik         = $("#harga_satuan_optik").val();
    var total_harga_optik = parseInt(qty_o)*parseInt(hrg_optik);
    $("#jumlah_total_optik").val(total_harga_optik);
  });
  $("#qty_obat_optik").on('keyup', function(){
    var qty_optik         = $("#qty_obat_optik").val();
    if (qty_optik=='') {
      var qty_o = 0;
    }else{
      var qty_o = qty_optik;
    }
    var hrg_optik         = $("#harga_satuan_optik").val();
    var total_harga_optik = parseInt(qty_o)*parseInt(hrg_optik);
    $("#jumlah_total_optik").val(total_harga_optik);
  });
  $('#harga_satuan_optik').on('keyup', function(){
    var qty_optik   = $("#qty_obat_optik").val();
    var hrg_satuan  = $("#harga_satuan_optik").val();
    if (qty_optik=='') {
      var qty_o = 0;
    }else{
      var qty_o = qty_optik;
    }
    if (hrg_satuan=='') {
      var hrg_o = 0;
    }else{
      var hrg_o = hrg_satuan;
    }
    var total_harga_optik = parseInt(qty_o)*parseInt(hrg_o);
    $("#jumlah_total_optik").val(total_harga_optik);
  });
  $("#btn_simpan_gunakan_optik").click(function(){
    simpan_penjualan_optik();
  });
  function formatNumber (num) {
      return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")
  }
  function daftar_obat(){
    $('#id_stok_optik').empty();
    var notoken = token_coba();
    $.ajax({
      type      : 'POST',
      url       : base_url()+'index.php/dashboard/nama_optik',
      async     : false,
      data      : 'csrf_klinik_mata_edc='+notoken,
      dataType  : 'json',
      success   : function(data){
        console.log(data);
        var no    = 1;
        var html  = '';
        var i;
        var option_kosong_ob = '';
        option_kosong_ob += '<option selected="selected">- || -</option>';
        for (i = 0; i < data.length; i++) {
          html += '<option value="'+data[i].KODE_OPTIK+'">' + data[i].NAMA_MERK + ' ('+data[i].KODE_MEREK+') Rp. '+formatNumber(data[i].HARGA_JUAL)+'</option>';
        }
      }
    });
  }
  function get_harga_barang(id, notoken){
    $.ajax({
      type      : 'POST',
      url       : base_url()+'/index.php/dashboard/get_harga_optik',
      async     : false,
      data      : "csrf_klinik_mata_edc="+notoken+"&id_stok="+id,
      dataType  : 'json',
      success   : function(data){
        console.log(data);
        for (var i = 0; i<data.length; i++) {
          $('#harga_satuan_optik').val(data[i].HARGA_JUAL);
        }
      }
    });
  }
  function simpan_penjualan_optik(){
    var form_pengeluaran_optik  = $('#form_pengeluaran_optik').serialize();
    var notoken                 = token_coba();
    var tgl_input               = $('#tgl_input_tindakan').val();
    if ($('#status_bayar_dp').is(':checked')) {
      var bayar_dp = 'check';
    }else{
      var bayar_dp = 'uncheck';
    }
    if ($('#status_bayar_lunas').is(':checked')) {
      var bayar_lunas = 'check';
    }else{
      var bayar_lunas = 'uncheck';
    }
    swal({
      title: "Apakah Anda Yakin?",
      text: "Anda Akan Melakukan Penjualan Optik!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          type      : 'POST',
          url       : base_url()+'/index.php/dashboard/simpan_penjualan_optik',
          async     : false,
          data      : form_pengeluaran_optik+'&csrf_klinik_mata_edc='+notoken+'&bayar_dp='+bayar_dp+'&bayar_lunas='+bayar_lunas+'&tgl_input_tindakan='+tgl_input,
          dataType  : 'json',
          success   : function(data){
            console.log(data);
            if (data=="Benar") {
              swal("Selamat! Data Berhasi di Simpan!", {
                icon: "success",
              });
              get_penjualan_optik_hari_ini();
              kosongkan_form_optik();
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
      } else {
        swal("Anda Membatalkan Penjualan!");
      }
    });
  }
  function get_penjualan_optik_hari_ini(){
    var id_role = $('#role_permision').html();
    var nodaftar  = $("#nodaftar_optik").val();
    var notoken   = token_coba();
    $.ajax({
      type      : 'POST',
      url       : base_url()+'/index.php/dashboard/get_penjualan_optik_hari_ini',
      async     : false,
      data      : 'csrf_klinik_mata_edc='+notoken+'&nodaftar='+nodaftar,
      dataType  : 'json',
      success   : function(data){
        console.log(data);
        var no=1;
        var html = '';
        if (data=='') {
          html +='<tr>'+
                    '<td colspan="14"><center> Maaf, Data Kosong</center></td>'+
                    '</tr>';
          $('#tbody_tbl_daftar_penjualan_optik').html(html);
        }else{
          for (var i=0; i<data.length; i++) {
            var kd_status = data[i].kode_status;
            if (kd_status==1) {
              var btn_hapus = '<button type="button" class="btn btn-sm btn-danger" id="btn_hapus_optik" value="'+data[i].id_optik+'" title="Hapus"><i class="fa fa-fw fa-eraser"></i> Hapus</button>';
            }else{
              var btn_hapus = '';
            }
            var btn_edit  = '<button type="button" class="btn btn-sm btn-warning" id="btn_edit_optik" value="'+data[i].id_optik+'" title="Edit"><i class="fa fa-fw fa-pencil"></i> Edit</button>';            
            if (id_role==37) {
              var btn_retur = '';
            }else{
              var btn_retur = '<button type="button" class="btn btn-sm btn-danger" id="btn_retur_optik" value="'+data[i].id_optik+'" title="Edit"><i class="fa fa-fw fa-pencil"></i> Retur</button>';     
            }
              html +='<tr>'+
                      '<td>'+no+'</td>'+
                      '<td>'+data[i].nm_obat+'</td>'+
                      '<td hidden>'+data[i].nm_frame+'</td>'+
                      '<td hidden>'+data[i].nm_lensa+'</td>'+
                      '<td>'+data[i].hrg_satuan+'</td>'+
                      '<td>'+data[i].qty+'</td>'+
                      '<td>'+data[i].tot_hrg+'</td>'+
                      '<td>'+data[i].tgl_jual+'</td>'+
                      '<td hidden>'+data[i].status_byr+'</td>'+
                      '<td hidden>'+data[i].tgl_byr+'</td>'+
                      '<td hidden>'+data[i].keterangan+'</td>'+
                      '<td>'+btn_edit+' '+btn_hapus+' '+btn_retur+'</td>'+
                      '</tr>';
                      no++;
            $('#tbody_tbl_daftar_penjualan_optik').html(html);
          }
        }
      }
    });
  }
  $("#tbl_daftar_penjualan_optik tbody").on('click', "#btn_edit_optik", function(){
    var id = $(this).val();
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
    $("#id_optik").val(id);
    $("#nama_barang_optik").val($kolom2);
    $("#nama_frame").val($kolom3);
    $("#nama_lensa").val($kolom4);
    $("#qty_obat_optik").val($kolom6);
    $("#jumlah_total_optik").val($kolom7);
    $("#Keterangan_jual_optik").val($kolom11);
    if ($kolom9=='Bayar DP') {
      $('#status_bayar_dp').prop('checked',true);
      $('#status_bayar_lunas').prop('checked',false);
      $('#harga_satuan_optik').val($kolom5);
      $('#tanggal_hutang').val('');
      $('#tanggal_pelunasan').hide();
    }else if ($kolom9=='Bayar Pelunasan') {
      $('#status_bayar_dp').prop('checked',false);
      $('#status_bayar_lunas').prop('checked',true);
      $('#harga_satuan_optik').val($kolom5);
      $('#tanggal_hutang').val($kolom10).show();
      $('#tanggal_pelunasan').show();
    }else{
      $('#status_bayar_dp').prop('checked',false);
      $('#status_bayar_lunas').prop('checked',false);
      $('#harga_satuan_optik').val($kolom5);
      $('#tanggal_hutang').val('');
      $('#tanggal_pelunasan').hide();
    }
  });
  $("#tbl_daftar_penjualan_optik tbody").on('click', "#btn_hapus_optik", function(){
    var id_optik  = $(this).val();
    hapus_optik(id_optik);
  });
  function hapus_optik(id_optik){
    var notoken = token_coba();
    swal({
      title: "Apakah Anda Yakin?",
      text: "Anda Akan Melakukan Penjualan Optik!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          type      : 'POST',
          url       : base_url()+'index.php/dashboard/hapus_optik',
          async     : false,
          data      : 'csrf_klinik_mata_edc='+notoken+'&id_optik='+id_optik,
          dataType  : 'json',
          success   : function(data){
            console.log(data);
            if (data=="Benar") {
              swal("Selamat! data Berhasil di Hapus!", {
                icon: "success",
              });
              get_penjualan_optik_hari_ini();
            }else{
              swal("Maaf! data Gagal di Hapus!", {
                icon: "error",
              });
            }
          }
        });
      }else{
        swal("Anda Membatalkan Penjualan!");
      }
    });
  }
  $('#tbl_daftar_penjualan_optik tbody').on('click', '#btn_retur_optik', function(){
    var id = $(this).val();
    retur_penjualan_optik(id);
  });
  function retur_penjualan_optik(id){
    var notoken = token_coba();
    swal("Berilah Alasan, Kenapa Anda Ingin Mencetak Lebih Dari Satu:", {
          content: "input",
    })
    .then((value) => {
      if (value=="") {
        swal(`Data Tidak Boleh Kosong: ${value}`);
      }else{
        $.ajax({
          type      : 'POST',
          url       : base_url()+'index.php/dashboard/retur_penjualan_optik',
          async     : false,
          data      : "csrf_klinik_mata_edc="+notoken+"&keterangan="+value+"&id="+id,
          dataType  : 'json',
          success   : function(data){
            console.log(data);
            if (data=="Salah") {
              swal(`Data Gagal Disimpan`, {
                icon: "warning",
              });
            }else{
              swal(`Data Berhasil Disimpan`, {
                icon: "success",
              });
              get_penjualan_optik_hari_ini();
            }
          }
        });
      }
    });
  }
  function pembayaran_optik(){
    var notoken = token_coba();
    var daftar  = $('#nodaftar_sewa').val();
    $.ajax({
      type      : 'POST',
      url       : base_url()+'index.php/dashboard/tagihan_optik',
      async     : false,
      data      : 'csrf_klinik_mata_edc='+notoken+'&nodaftar='+daftar,
      dataType  : 'json',
      success   : function(data){
        console.log(data);
        for (var i = 0; i < data.length; i++) {
          var tagihan_optik = data[i].tot_biaya;
          if (tagihan_optik==null) {
            var t_optik = 0;
          }else{
            var t_optik = tagihan_optik;
          }
          $("#jumlah_hrg_optik").val(t_optik);
        }
      }
    });
  }
  function user(){
    $.ajax({
      type      : 'POST',
      url       : base_url()+'index.php/dashboard/get_data_session',
      async     : false,
      dataType  : 'json',
      success : function(data){
      }
    });
  }
  function pembayaran_sewa_mobil(){
    var notoken = token_coba();
    var daftar  = $('#nodaftar_sewa').val();
    $.ajax({
      type      : 'POST',
      url       : base_url()+'/index.php/dashboard/tagihan_sewa',
      async     : false,
      data      : 'csrf_klinik_mata_edc='+notoken+'&nodaftar='+daftar,
      dataType  : 'json',
      success   : function(data){
        console.log(data);
        var i;
        for (i = 0; i < data.length; i++) {
          $('#jumlah_sewa').val(data[i].tot_tagihan_sewa);
        }
      }
    });
  }
  function get_list_sewa_mobil(){
    var notoken = token_coba();
    $('#list_sewa').empty();
    $.ajax({
      type      : 'POST',
      url       : base_url()+'index.php/dashboard/get_list_sewa_mobil',
      async     : false,
      data      : 'csrf_klinik_mata_edc='+notoken,
      dataType  : 'json',
      success   : function(data){
        console.log(data);
        var option  = '';
        var option2 = '';
        var i;
        option_kosong_sw = '';
        option_kosong_sw += '<option selected="selected">== || ==</option>';
        for (i = 0; i < data.length; i++) {
          option += '<option value="'+data[i].id_tarif_sewa+'" >' + data[i].nm_list + '</option>';
        }
        option2 = '<option value="lainnya" >Lainnya</option>';
        $("#list_sewa").html(option_kosong_sw+option+option2);
      }
    });
  }
  $("#list_sewa").change(function(){
    var id_tujuan = $("#list_sewa").val();
    if (id_tujuan=="lainnya") {
      $('#nama_sewa_mobil').show();
      $('#jumlah_harga').prop('readonly', false);
    }else{
      $('#nama_sewa_mobil').hide();
      $('#lokasi_tujuan').val('');
      $('#jumlah_harga').prop('readonly', true);
      get_harga_sewa(id_tujuan);
    }
  });
  function get_harga_sewa(id_sewa){
    var notoken = token_coba();
    $.ajax({
        type      : 'POST',
        url       : base_url()+'/index.php/dashboard/get_harga_sewa',
        async     : false,
        data      : 'csrf_klinik_mata_edc='+notoken+'&id_sewa='+id_sewa,
        dataType  : 'json',
        success   : function(data){
          console.log(data);
          var i;
          for (i = 0; i < data.length; i++) {
            $("#jumlah_harga").val(data[i].hrg_tarif);
          }
        }
    }); 
  }
  $('#btn_simpan_sewa_mobil').click(function(){
    swal({
      title: "Apakah Anda Yakin?",
      text: "Anda Akan Menyimpan data Sewa Kendaraan!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        simpan_sewa_mobil();
      } else {
        swal("Anda Membatalkan Penyimpanan!");
      }
    });
  });
  function simpan_sewa_mobil(){
    var notoken   = token_coba();
    var form_sewa = $('#form_input_sewa').serialize();
    var tgl_input = $('#tgl_input_tindakan').val();
    $.ajax({
      type        : 'POST',
      url         : base_url()+'/index.php/dashboard/simpan_sewa_mobil',
      async       : false,
      data        : 'csrf_klinik_mata_edc='+notoken+'&'+form_sewa+'&tgl_input_tindakan='+tgl_input,
      dataType    : 'json',
      success     : function(data){
        if (data="Benar") {
          swal("Selamat, Anda Berhasil Menyimpan Data Sewa!", {
            icon: "success",
          });
          $('#id_sewa').val('');
          $('#list_sewa').val('').trigger('change');
          $('#lokasi_tujuan').val('');
          $('#jumlah_harga').val('');
          get_data_sewa();
        }else{
          swal("Maaf, Data Gagal Disimpan!", {
            icon: "error",
          });
        }
      }
    });
  }
  function get_data_sewa(){
    var notoken = token_coba();
    var rm      = $('#norm_sewa').val();
    var daftar  = $('#nodaftar_sewa').val();
    $.ajax({
      type      : 'POST',
      url       : base_url()+'/index.php/dashboard/get_data_sewa',
      async     : false,
      data      : 'csrf_klinik_mata_edc='+notoken+'&norm='+rm+'&daftar='+daftar,
      dataType  : 'json',
      success   : function(data){
        var no    = 1;
        var html  = '';
        var i;
        for (i = 0; i < data.length; i++) {
          var nm_loakasi = data[i].tujuan;
          if (nm_loakasi=='') {
            var tujuan = data[i].nm_tujuan;
          }else{
            var tujuan = data[i].tujuan;
          }
          var status = data[i].kd_status;
          if (status==1) {
            var btn_hapus = '<button type="button" class="btn btn-danger btn-flat" id="btn_hapus_sewa" name="btn_hapus_sewa" title="Hapus" value="'+data[i].id_sewa+'"><i class="fa fa-fw fa-trash-o"></i></button>';
            var btn_edit  = '<button type="button" class="btn btn-success btn-flat" id="btn_edit_sewa" name="btn_edit_sewa" value="'+data[i].id_sewa+'" title="Edit Obat"><i class="fa fa-fw  fa-pencil-square-o"></i></button>';
          }else{
            var btn_hapus = '';
            var btn_edit = '';
          }
          html +='<tr>'+
                          '<td>'+no+'</td>'+
                          '<td>'+data[i].id_sewa+'</td>'+
                          '<td>'+data[i].trf_sewa+'</td>'+
                          '<td>'+tujuan+'</td>'+
                          '<td>'+data[i].hrg_sewa+'</td>'+
                          '<td>'+btn_edit+' '+btn_hapus+'</td>'+
                        '</tr>';
          no++;
        }
        $('#list_sewa_mobil').html(html);
      }
    });
  }  
  $("#tbl_sewa_mobil tbody").on('click', '#btn_edit_sewa', function(){
    var id = $(this).val();
    var $kolom1 = $(this).parents("tr").find("td:nth-child(1)").text();
    var $kolom2 = $(this).parents("tr").find("td:nth-child(2)").text();
    var $kolom3 = $(this).parents("tr").find("td:nth-child(3)").text();
    var $kolom4 = $(this).parents("tr").find("td:nth-child(4)").text();
    var $kolom5 = $(this).parents("tr").find("td:nth-child(5)").text();
    $('#id_sewa').val($kolom2);
    if ($kolom3==0) {
      $('#list_sewa').val('lainnya');
      $('#lokasi_tujuan').val($kolom4);
      $('#nama_sewa_mobil').show();
      $('#jumlah_harga').prop('readonly', false);
    }else{
      $('#list_sewa').val($kolom3);
      $('#lokasi_tujuan').val('');
      $('#nama_sewa_mobil').hide();
      $('#jumlah_harga').prop('readonly', true);
    }
    $('#jumlah_harga').val($kolom5);
  });
  $("#tbl_sewa_mobil tbody").on('click', '#btn_hapus_sewa', function(){
    var $kolom2 = $(this).parents("tr").find("td:nth-child(2)").text();
    var $kolom4 = $(this).parents("tr").find("td:nth-child(4)").text();
    swal({
      title: "Apakah Anda Yakin?",
      text: "Anda Akan Menghapus"+$kolom4+"!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        hapus_sewa_mobil($kolom2);
      } else {
        swal("Data Batal di Hapus!");
      }
    });
  });
  function hapus_sewa_mobil(id_sewa){
    var notoken = token_coba();
    $.ajax({
      type        : 'POST',
      url         : base_url()+'/index.php/dashboard/hapus_sewa_mobil',
      async       : false,
      data        : 'csrf_klinik_mata_edc='+notoken+'&id_sewa='+id_sewa,
      dataType    : 'json',
      success     : function(data){
        if (data=="Benar") {
          swal("Selamat! Data Berhasil di Hapus!", {
            icon: "success",
          });
          get_data_sewa();
        }else{
          swal("Maaf! Data Gagal di Hapus!", {
            icon: "error",
          });
        }
      }
    });
  }
  function get_pasien(){
    var notoken                 = token_coba();
    var form_cari_pasien_lama   = $('#form_cari_pasien_lama').serialize();
    $.ajax({
      type      : 'POST',
      url       : base_url()+'index.php/dashboard/get_data_pasien',
      async     : false,
      data      : 'csrf_klinik_mata_edc='+notoken+'&'+form_cari_pasien_lama,
      dataType  : 'json',
      success   : function(pasien){
        console.log(pasien);
        var no          = 1;
        var html_pasien = '';
        var i;
        for (i=0; i<pasien.length; i++) {
          var desa      = String(pasien[i].desa).split(",", 1);
          var kecamatan = String(pasien[i].kecamatan).split(",", 1);
          var kabupaten = String(pasien[i].kabupaten).split(",", 1);
          var provinsi  = String(pasien[i].provinsi).split(",", 1);
          var btn_daftarkan = '<button class="btn btn-block btn-success btn-sm" name="btn_daftarkan_pasien" id="btn_daftarkan_pasien" value="'+pasien[i].norm+'"><i class="fa fa-fw fa-plus"></i>Daftarkan</button>';
          html_pasien +='<tr>'+
                          '<td>'+no+'</td>'+
                          '<td>'+pasien[i].norm+'</td>'+
                          '<td>'+pasien[i].nm_pas+'</td>'+
                          '<td>'+pasien[i].jk+'</td>'+
                          '<td>'+pasien[i].alamat+'</td>'+
                          '<td>'+kecamatan+' - '+kabupaten+'</td>'+
                          '<td hidden>'+pasien[i].temp_lahir+'</td>'+
                          '<td hidden>'+pasien[i].tgl_lahir+'</td>'+
                          '<td hidden>'+pasien[i].pekerjaan+'</td>'+
                          '<td hidden>'+pasien[i].kode_gol+'</td>'+
                          '<td hidden>'+provinsi+'</td>'+
                          '<td hidden>'+kabupaten+'</td>'+
                          '<td hidden>'+kecamatan+'</td>'+
                          '<td hidden>'+desa+'</td>'+
                          '<td hidden>'+pasien[i].telp+'</td>'+
                          '<td hidden>'+pasien[i].nokpst+'</td>'+
                          '<td hidden>'+pasien[i].batas+'</td>'+
                          '<td hidden>'+pasien[i].nik_pasien+'</td>'+
                          '<td>'+btn_daftarkan+'</td>'+
                        '</tr>';
          no++;
        }
        $("#tbody_example3").html(html_pasien);
      }
    });
  }
  function get_pasien_lama(){
    var notoken                 = token_coba();
    var form_cari_pasien_lama   = $('#form_cari_pasien_lama').serialize();
    $.ajax({
      type      : 'POST',
      url       : base_url()+'index.php/dashboard/get_pasien_lama',
      async     : false,
      data      : 'csrf_klinik_mata_edc='+notoken+'&'+form_cari_pasien_lama,
      dataType  : 'json',
      success   : function(pasien){
        console.log(pasien);
        var no          = 1;
        var html_pasien = '';
        var i;
        for (i=0; i<pasien.length; i++) {
          var btn_daftarkan = '<button class="btn btn-block btn-success btn-sm" name="btn_daftarkan_pasien" id="btn_daftarkan_pasien" value="'+pasien[i].id_backup_dos+'"><i class="fa fa-fw fa-plus"></i>Daftarkan</button>';
          html_pasien +='<tr>'+
                          '<td>'+no+'</td>'+
                          '<td>'+pasien[i].no_pasien+'</td>'+
                          '<td>'+pasien[i].nm_pasien+'</td>'+
                          '<td>'+pasien[i].j_kelamin+'</td>'+
                          '<td>'+pasien[i].alamat+'</td>'+
                          '<td>'+pasien[i].kota+'</td>'+
                          '<td hidden></td>'+
                          '<td hidden>'+pasien[i].tgl_lahir+'</td>'+
                          '<td hidden></td>'+
                          '<td hidden></td>'+
                          '<td hidden></td>'+
                          '<td hidden></td>'+
                          '<td hidden></td>'+
                          '<td hidden></td>'+
                          '<td hidden>'+pasien[i].phone+'</td>'+
                          '<td hidden></td>'+
                          '<td hidden>0</td>'+
                          '<td>'+btn_daftarkan+'</td>'+
                        '</tr>';
          no++;
        }
        $("#tbody_pasien_dos").html(html_pasien);
      }
    });
  }
  function get_pasien_screening(){
    var notoken                 = token_coba();
    var form_cari_pasien_lama   = $('#form_cari_pasien_lama').serialize();
    $.ajax({
      type      : 'POST',
      url       : base_url()+'index.php/dashboard/get_pasien_screening',
      async     : false,
      data      : 'csrf_klinik_mata_edc='+notoken+'&'+form_cari_pasien_lama,
      dataType  : 'json',
      success   : function(pasien){
        console.log(pasien);
        var no          = 1;
        var html_pasien = '';
        var i;
        for (i=0; i<pasien.length; i++) {
          var btn_daftarkan = '<button class="btn btn-block btn-success btn-sm" name="btn_daftarkan_pasien" id="btn_daftarkan_pasien" value="'+pasien[i].ID_KUNJUNGAN_PASIEN+'"><i class="fa fa-fw fa-plus"></i>Daftarkan</button>';
          html_pasien +='<tr>'+
                          '<td>'+no+'</td>'+
                          '<td></td>'+
                          '<td>'+pasien[i].NAMA_PASIEN+'</td>'+
                          '<td>'+pasien[i].JK+'</td>'+
                          '<td>'+pasien[i].ALAMAT_PASIEN+'</td>'+
                          '<td>'+pasien[i].NIK+' </td>'+
                          '<td hidden></td>'+
                          '<td hidden></td>'+
                          '<td hidden></td>'+
                          '<td hidden>'+pasien[i].GOLONGAN_PASIEN+'</td>'+
                          '<td hidden></td>'+
                          '<td hidden></td>'+
                          '<td hidden></td>'+
                          '<td hidden></td>'+
                          '<td hidden></td>'+
                          '<td hidden></td>'+
                          '<td hidden>0</td>'+
                          '<td>'+btn_daftarkan+'</td>'+
                        '</tr>';
          no++;
        }
        $("#tbody_pasien_screening").html(html_pasien);
      }
    });
  }
  function get_provinsi(get_nama_provinsi){
    $.ajax({
        type  : 'POST',
        url       : base_url()+'index.php/dashboard/provinsi',
        async : false,
        dataType : 'json',
        success : function(data){
          console.log(data);
          var provinsi = data.provinsi;
          var option   = '';
          var i;
          for(i=0; i<provinsi.length; i++){
            option = '<option value="'+provinsi[i].nama+','+provinsi[i].id+'" >' + provinsi[i].nama + '</option>';
            $("#provinsi").append(option);
            if (get_nama_provinsi == provinsi[i].nama) {
              var select_prov = get_nama_provinsi+','+provinsi[i].id;
                $('#provinsi').val(select_prov).trigger("change");
            }
          }
        }
    }); 
  }
  $("#jenis_pasien").change(function(){
    if ($(this).val()=="UMUM") {
      $("#input_nokpst").hide();
    }else if ($(this).val()=="GRATIS"){
      $("#input_nokpst").hide();
      $("#norm_lama").hide();
    }else{
      $("#input_nokpst").show();
      $("#norm_lama").show();
    }
  });
  $("#provinsi").change(function(){
    var get_id_prov = $(this).val().split(",");
    var get_nama_kabupaten = $("#nama_kabupaten").val();
    get_kabupaten(get_id_prov, get_nama_kabupaten);
  });
  function get_kabupaten(get_id_prov, get_nama_kabupaten){
    var id_prov = get_id_prov[1];
  $.ajax({
          type      : 'POST',
          url       : base_url()+'index.php/dashboard/kabupaten',
          async     : false,
          data      : "id_provinsi="+id_prov,
          dataType  : 'json',
          success   : function(data){
            var kabupaten = data.kota_kabupaten;
            var option_kab   = '';
            var kab;
            for(kab=0; kab<kabupaten.length; kab++){
              option_kab = '<option value="'+kabupaten[kab].nama+','+kabupaten[kab].id+'" >' + kabupaten[kab].nama + '</option>';
              $(" #kabupaten").append(option_kab);
              if (get_nama_kabupaten == kabupaten[kab].nama) {
                var select_kab = get_nama_kabupaten+','+kabupaten[kab].id;
                  $('#kabupaten').val(select_kab).trigger("change");
              }
            }
          }
    }); 
  }
  $("#kabupaten").change(function(){
    var get_id_kab          = $(this).val().split(",");
    var get_nama_kecamatan  = $("#nama_kecamatan").val();
    get_kecamatan(get_id_kab, get_nama_kecamatan);
  });
  function get_kecamatan(get_id_kab, get_nama_kecamatan){
    var id_kab = get_id_kab[1];
    $.ajax({
            type     : 'POST',
            url       : base_url()+'index.php/dashboard/kecamatan',
            async    : false,
            data     : "id_kabupaten="+id_kab,
            dataType : 'json',
            success : function(data){
              var kecamatan   = data.kecamatan;
              var option_kec  = '';
              var kec;
              for(kec=0; kec<kecamatan.length; kec++){
                option_kec = '<option value="'+kecamatan[kec].nama+','+kecamatan[kec].id+'" >' + kecamatan[kec].nama + '</option>';
                $("#kecamatan").append(option_kec);
                if (get_nama_kecamatan==kecamatan[kec].nama) {
                  var select_kec = get_nama_kecamatan+','+kecamatan[kec].id;
                  $('#kecamatan').val(select_kec).trigger("change");
                }
              }
            }
    });
  }
$("#kecamatan").change(function(){
    var get_id_kec = $(this).val().split(",");
    var get_nama_desa = $("#nama_desa").val();
    get_desa(get_id_kec, get_nama_desa);
});
  function get_desa(get_id_kec, get_nama_desa){
    var id_kec = get_id_kec[1];
    $.ajax({
            type      : 'POST',
            url       : base_url()+'index.php/dashboard/desa',
            async     : false,
            data      : "id_kecamatan="+id_kec,
            dataType  : 'json',
            success   : function(data){
              var desa = data.kelurahan;
              var option_des = '';
              var des;
              for(des=0; des<desa.length; des++){
                option_des = '<option value="'+desa[des].nama+'">'+desa[des].nama+'</option>';
                $("#desa").append(option_des);
                if (get_nama_desa==desa[des].nama) {
                  var select_des = get_nama_desa;
                  $('#desa').val(select_des).trigger("change");
                }
              }
            }
    });
  }

  function get_data_karcis(){
    var id_dokter = $('#id_dokter').val();
    $.ajax({
      type      : 'POST',
      url       : base_url()+'index.php/dashboard/get_karcis',
      async     : false,
      data      : "id_dokter="+id_dokter,
      dataType  : 'json',
      success   : function (karcis){
        console.log(karcis);
        var html_karcis     = '';
        var html_karcis2    = '';
        var k;
        var n_k = 1;
        for (k=0; k<karcis.admin.length; k++) {
          html_karcis += '<tr>'+
              '<td><input type="checkbox" class="flat-k" name="tarif'+n_k+'" id="tarif" value="'+karcis.admin[k].TARIF+'" ></td>'+
              '<td>'+karcis.admin[k].NAMA_TINDAKAN+'</td>'+
              '<td>Rp. '+formatNumber(karcis.admin[k].TARIF)+'</td>'+
              '<td><input type="checkbox" class="flat-red" name="karcis'+n_k+'" id="karcis" value="'+karcis.admin[k].ID_TARIF_TINDAKAN+'"></td>'+
              '<td hidden>'+karcis.admin[k].TARIF+'</td>'+
              '<td hidden>'+karcis.admin[k].ID_TARIF_TINDAKAN+'</td>'+
          '</tr>';
          n_k++;
        };
        for (k=0; k<karcis.dokter.length; k++) {
          tarif_spesialis_mata  = karcis.dokter[k].JUMLAH_TARIF;
          tarif_mata            = karcis.dokter[k].TARIF_MATA;
        };
        for (k=0; k<karcis.pemeriksaan.length; k++) {
            if (karcis.pemeriksaan[k].NAMA_TINDAKAN=='Pemeriksaan Dokter Spesialis Mata') {
                var hrg_tarif = tarif_spesialis_mata;
            }else if (karcis.pemeriksaan[k].NAMA_TINDAKAN=='Pemeriksaan Mata') {
                var hrg_tarif = tarif_mata;
            }else{
                var hrg_tarif = karcis.pemeriksaan[k].TARIF;
            }
          html_karcis2 += '<tr>'+
              '<td><input type="checkbox" class="flat-k" name="tarif'+n_k+'" id="tarif" value="'+hrg_tarif+'" ></td>'+
              '<td>'+karcis.pemeriksaan[k].NAMA_TINDAKAN+'</td>'+
              '<td>Rp. '+formatNumber(hrg_tarif)+'</td>'+
              '<td><input type="checkbox" class="flat-red" name="karcis'+n_k+'" id="karcis" value="'+karcis.pemeriksaan[k].ID_TARIF_TINDAKAN+'"></td>'+
              '<td hidden>'+hrg_tarif+'</td>'+
              '<td hidden>'+karcis.pemeriksaan[k].ID_TARIF_TINDAKAN+'</td>'+
          '</tr>';
          n_k++;
        };
        $("#daftar_pelayanan_karcis").html(html_karcis+html_karcis2);
        $(".flat-k").hide();
        $("#jumlah_tindakan").prop("readonly", true);
        $("#jumlah_tindakan").val(n_k);
      }
    });
  }
  function get_dokter_nodaftar(nodaftar){
    var notoken = token_coba();
    $.ajax({
      type      : 'POST',
      url       : base_url()+'index.php/dashboard/get_dokter_nodaftar',
      data      : 'csrf_klinik_mata_edc='+notoken+'&NODAFTAR='+nodaftar,
      async     : false,
      dataType  : 'json',
      success   : function(dokter){
        var d;
        for(d=0; d<dokter.length; d++){
          $("#id_dokter_bt").val(dokter[d].ID_TARIF).hide();
          $("#dokter_bt").val(dokter[d].NAMA_DOKTER).prop('readonly', true);
        }
      }
    });
  }
  function get_dokter(){
    $("#id_dokter").empty();
    $("#id_dokter_input_tindakan").empty();
    $.ajax({
      type : 'POST',
      url  : base_url()+'index.php/dashboard/get_dokter',
      async : false,
      dataType : 'json',
      success : function(dokter){
        var d;
        var option_dokter = '';
        var option_dokter_o = '';
        option_dokter_o += '<option selected="selected">- || -</option>';
        for(d=0; d<dokter.length; d++){//
          option_dokter += '<option value="'+dokter[d].ID_TARIF+'" >' + dokter[d].NAMA_DOKTER+'</option>';
        }
        $("#id_dokter").html(option_dokter_o+option_dokter);
        $("#id_dokter_input_tindakan").html(option_dokter_o+option_dokter);
        $("#id_dokter_input_karcis_urgen").html(option_dokter_o+option_dokter);
      }
    });
  }
  function get_data_pendaftar_hari_ini(){
    var id_role = $('#role_permision').html();
    var notoken = token_coba();
    $.ajax({
      type      : 'POST',
      url       : base_url()+'index.php/dashboard/get_data_pendaftar',
      async     : false,
      data      : 'csrf_klinik_mata_edc='+notoken+'&id_role='+id_role,
      dataType  : 'json',
      success   : function(pendaftar_hrn){
        console.log(pendaftar_hrn);
        var no            = 1;
        var tbl_daftar_p  = '';
        var dp;
        var role_id = pendaftar_hrn.role_id;
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
          var btn_tindakan      = '<button style="width:85%;" class="btn btn-block btn-warning" id="btn_lihat_tindakan" value="'+pendaftar_hrn.pasien[dp].NODAFTAR+'"><center><i class="fa fa-fw fa-plus"></i> Tindakan</center></button>';
          var btn_karcis        = '<button style="width:85%;" class="btn btn-block btn-warning" id="btn_lihat_karcis" value="'+pendaftar_hrn.pasien[dp].NODAFTAR+'"><i class="fa fa-fw fa-list-alt"></i> Karcis</button>';
          if (role_id==18) {
              var btn_batal_daftar = '<button style="width:85%;" class="btn btn-block btn-danger" id="btn_batal_daftar" value="'+pendaftar_hrn.pasien[dp].NODAFTAR+'"><i class="fa fa-fw fa-list-alt"></i> Batalkan</button>';
          }else{
            var btn_batal_daftar  = '';
          }
          
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
              '<td><center>'+btn_tindakan+btn_karcis+btn_batal_daftar+'</center></td>'+
          '</tr>';
          no++;
          $("#daftar_pasien_hari_ini").html(tbl_daftar_p);
        };
      }
    });
  }
  function get_riwayat_pasien(){
    var id_role         = $('#role_permision').html();
    var tanggal_riwayat = $('#form_tanggal_riwayat').serialize();
    var notoken = token_coba();
    $.ajax({
      type      : 'POST',
      url       : base_url()+'/index.php/dashboard/get_data_riwayat',
      async     : false,
      data      : 'csrf_klinik_mata_edc='+notoken+'&'+tanggal_riwayat,
      dataType  : 'json',
      success   : function(pendaftar_hrn){
        console.log(pendaftar_hrn);
        var no            = 1;
        var tbl_daftar_p  = '';
        var dp;
        for (dp=0; dp<pendaftar_hrn.length; dp++) {
            var norm = pendaftar_hrn[dp].NORM.substring(3);
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
            var nodaftar = pendaftar_hrn[dp].NODAFTAR.substring(3);
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
          var btn_lihat   = '<button class="btn btn-flat btn-primary" id="btn_lihat_riwayat_tindakan" value="'+pendaftar_hrn[dp].NODAFTAR+'"><i class="fa fa-fw fa-eye"></i> Detail</button>';
          tbl_daftar_p  += '<tr>'+
              '<td>'+no+'</td>'+
              '<td>'+pendaftar_hrn[dp].TGL_DAFTAR+'</td>'+
              '<td hidden>'+pendaftar_hrn[dp].NORM+'</td>'+
              '<td hidden>'+pendaftar_hrn[dp].NODAFTAR+'</td>'+
              '<td>'+no_rm_potong+'</td>'+
              '<td>'+nodaf_potong+'</td>'+
              '<td>'+pendaftar_hrn[dp].NAMA+'</td>'+
              '<td>'+pendaftar_hrn[dp].JK+'</td>'+
              '<td>'+pendaftar_hrn[dp].ALAMAT+'</td>'+
              '<td>'+pendaftar_hrn[dp].KODE_GOLONGAN+'</td>'+
              '<td hidden>'+pendaftar_hrn[dp].ID_TARIF+'</td>'+
              '<td hidden>'+pendaftar_hrn[dp].TELP+'</td>'+
              '<td><center>'+btn_lihat+'</center></td>'+
          '</tr>';
          no++;
          $("#tbody_riwayat_pasien").html(tbl_daftar_p);
        };
        $('#btn_simpan_retur').hide();
      }
    });
  }
  function get_tindakan_karcis($kolom4){
    var id_role = $('#role_permision').html();
    $.ajax({
      type      : 'POST',
      url       : base_url()+'index.php/dashboard/get_tindakan_karcis_by_nodaftar',
      async     : false,
      data      : "NODAFTAR="+$kolom4,
      dataType  : 'json',
      success   : function(tindakan_karcis){
        var no_tk               = 1;
        var tbl_karcis_pas_k    = '';
        var tbdy_diskon_karcis  = '';
        var tbdy_total_karcis   = '';
        var k;
        for (k=0; k<tindakan_karcis.length; k++) {
            var kd_status_k = tindakan_karcis[k].KODE_STATUS;
            if (kd_status_k==1) {
                var btn_hapus_karcis = '<button type="button" class="btn btn-danger btn-flat" id="btn_hapus_tindakan_karcis" name="btn_hapus_tindakan_karcis" title="Hapus" value="'+tindakan_karcis[k].ID_PERAWATAN+'"><i class="fa fa-fw fa-trash-o"></i></button>';
            }else{
                var btn_hapus_karcis = '';
            }
            if (id_role==37) {
                var btn_retur_karcis = btn_hapus_karcis;  
            }else{
                var btn_retur_k = '<button type="button" class="btn btn-danger btn-flat" id="btn_retur_tindakan_karcis" name="btn_retur_tindakan_karcis" title="Hapus" value="'+tindakan_karcis[k].ID_PERAWATAN+'"><i class="fa fa-fw fa-trash-o"></i></button>';

                var btn_retur_karcis = btn_retur_k+' '+btn_hapus_karcis;
            }
            var status_print = tindakan_karcis[k].PRINT;
            if (status_print==1) {
                var check_k = '<input type="checkbox" class="flat-k" name="status_cetak_k" id="status_cetak_k" value="'+tindakan_karcis[k].PRINT+'" checked>';
            }else{
                var check_k = '<input type="checkbox" class="flat-k" name="status_cetak_k" id="status_cetak_k" value="'+tindakan_karcis[k].PRINT+'" ';
            }
            tbl_karcis_pas_k  += '<tr>'+
                                        '<td>'+no_tk+'</td>'+
                                        '<td>'+tindakan_karcis[k].NAMA_TINDAKAN+'</td>'+
                                        '<td>Rp. '+formatNumber(tindakan_karcis[k].BIAYA)+'</td>'+
                                        '<td>'+tindakan_karcis[k].QTY_TINDAKAN+'</td>'+
                                        '<td>Rp. '+formatNumber(tindakan_karcis[k].BIAYA)+'</td>'+
                                        '<td hidden>'+tindakan_karcis[k].ID_PERAWATAN+'</td>'+
                                        '<td>'+check_k+'</td>'+
                                        '<td>'+btn_retur_karcis+'</td>'+
                                '</tr>';
                                no_tk++;
        }
        tbdy_diskon_karcis+='<tr>'+
              '<td colspan="2">Discount</td>'+
              '<td colspan="3"><p style="float:right;">-</td>'+
            '</tr>';
        tbdy_total_karcis +='<tr>'+
              '<td colspan="2">Total</td>'+
              '<td colspan="3"><p style="float:right;">-</p></td>'+
            '</tr>';
        $("#tbd_tabel_karcis_pasien_k").html(tbl_karcis_pas_k);
      }
    });
  }
  function get_nominal_bayar_kasrcis(nodaftar){
    $.ajax({
      type      : 'POST',
      url       : base_url()+'index.php/dashboard/get_tarif_bayar_karcis',
      async     : false,
      data      : 'nodaftar='+nodaftar,
      dataType  : 'json',
      success   : function(biaya_k){
        console.log(biaya_k);
        var i;
        for (i=0; i<biaya_k.admin.length; i++) {
          var b_admin = biaya_k.admin[i].tarif_admin;
          if (b_admin==null) {
            var admin_tarif = 0;
            var kdstatus  = 2;
          }else{
            var admin_tarif = b_admin;
            var kdstatus  = 1;
          }
          $("#tarif_admin_k").val(admin_tarif);
        };
        if (biaya_k.tindakan_dok.length==0) {
          var harga     = 0;
        }else{
          for (i=0; i<biaya_k.tindakan_dok.length; i++) {
            var harga_t_awal = biaya_k.tindakan_dok[i].tarif_dokter;
            var harga     = biaya_k.tindakan_dok[i].tarif_dokter;
            var id_per    = biaya_k.tindakan_dok[i].id_p;
            var kdstatus  = 1;
          };
        }
        $("#tarif_periksa_k").val(harga);
        $("#tari_dokter_awal").html(harga);
        $("#id_biaya_perawatan_k").val(id_per);
        if (kdstatus==1) {
          $('#btn_simpan_bayar_karcis').show();
        }else{
          $('#btn_simpan_bayar_karcis').show();
        }
        for (i=0; i<biaya_k.nama_dokter.length; i++) {
          $("#dokter_k").val(biaya_k.nama_dokter[i].nm_dokter);
        };
      }
    });
  }
  function diskon_karcis(){
    var admin     = $("#tarif_admin_k").val();
    var tarif     = $("#tari_dokter_awal").html();
    var tagihan   = (parseInt(tarif) + parseInt(admin));
    var diskon    = $("#diskon_k").val();
      if (parseInt(diskon)==0 || diskon=='') {
        $("#tarif_periksa_k").val(tarif);
        $("#jumlah_tagihan_k").val(tagihan);
        $("#hasil_diskon_k").val(diskon);
      }else if(parseInt(diskon)<=100){
        var mencari_harga_persen  = (parseInt(diskon) * parseInt(tarif)/100);
        var pengurangan           = tarif-mencari_harga_persen;
        $("#tarif_periksa_k").val(pengurangan);
        var tot_tagihan           = pengurangan+parseInt(admin);
        $("#jumlah_tagihan_k").val(tot_tagihan);
        $("#hasil_diskon_k").val(mencari_harga_persen);
      }else if(parseInt(diskon)>parseInt(tarif)){
        $("#diskon_k").val(0);
        $("#tarif_periksa_k").val(tarif);
        $("#hasil_diskon_k").val(0);
        $("#jumlah_tagihan_k").val(tagihan);
      }else{
        var jumlah_jadi = (parseInt(tarif) - parseInt(diskon));
        $("#tarif_periksa_k").val(jumlah_jadi);
        var tot_tagihan = jumlah_jadi+parseInt(admin);
        $("#jumlah_tagihan_k").val(tot_tagihan);
        $("#hasil_diskon_k").val(diskon);
      }
  }

  function pengurangan_kembalian_karcis(){
    var tagihan   = $("#jumlah_tagihan_k").val();
    var bayar     = $("#jumlah_yang_dibayar_k").val();
    var kembali   = (parseInt(bayar) - parseInt(tagihan));
    if (!isNaN(kembali)) {
      $("#uang_kembalian_k").val(kembali);
    }
  }
  function get_data_obat_outlet(){
    $("#idobat").empty();
    $.ajax({
      type : 'POST',
      url  : base_url()+'index.php/dashboard/get_obat_outlet',
      async : false,
      dataType : 'json',
      success : function(obat){
        var i;
        var option_obat = '';
        var option_kosong_o = '';
        option_kosong_o += '<option selected="selected">- || -</option>';
        for(i=0; i<obat.length; i++){
          option_obat += '<option value="'+obat[i].id_o+'" >' + obat[i].nm_o+' * Rp. '+ obat[i].hrg_j+ ' | Stok = ' + obat[i].stk_r +'</option>';
        }
        $("#idobat").append(option_kosong_o+option_obat);
      }
    });
  }
  function get_data_obat_resep(){
    $("#idresep").empty();
    var notoken = token_coba();
    $.ajax({
      type      : 'POST',
      url       : base_url()+'index.php/dashboard/get_obat_resep',
      async     : false,
      data      : 'csrf_klinik_mata_edc='+notoken,
      dataType  : 'json',
      success   : function(resep){
        var i;
        var option_resep = '';
        var option_kosong_o = '';
        option_kosong_o += '<option selected="selected">- || -</option>';
        for(i=0; i<resep.length; i++){
          option_resep += '<option value="'+resep[i].id_o+'" >' + resep[i].nm_o+' * Rp.'+resep[i].hrg_j+'</option>';
        }
        $("#idresep").append(option_kosong_o+option_resep);
      }
    });
  }
  $('#btn_simpan_resep').on('click', function(){
    var form_resep_obat = $('#form_input_resep').serialize();
    var notoken         = token_coba();
    swal({
      title: "Apakah Anda Yakin?",
      text: "Anda Akan Menyimpan Data Resep Obat ",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        simpan_resep_obat(form_resep_obat, notoken);
      } else {
        swal("Data Batal Di Simpan!");
      }
    });
  });
  function simpan_resep_obat(form_resep_obat, notoken){
    $.ajax({
        type        : 'POST',
        url         : base_url()+'index.php/dashboard/simpan_resep_obat',
        async       : false,
        data        : 'csrf_klinik_mata_edc='+notoken+'&'+form_resep_obat,
        dataType    : 'json',
        success     : function(data){
            console.log(data);
            if (data.status=="Benar") {
                swal("Selamat!", "Data Berhasil di Simpan", "success");
                get_resep_pasien();
                $('#id_resep').val('');
                $('#idresep').val('').trigger('change');
                $('#qty_resep').val('');
            }else{
                swal("Mohon Maaf!", "Data Gagal Di Simpan!", "warning");
            }
        }
    });
  }
  function get_resep_pasien(){
    var nodaftar = $('#nodaftar_resep').val();
    var notoken = token_coba();
    $.ajax({
        type        : 'POST',
        url         : base_url()+'index.php/dashboard/get_resep_pasien',
        async       : false,
        data        : 'csrf_klinik_mata_edc='+notoken+'&nodaftar='+nodaftar,
        dataType    : 'json',
        success     : function(data){
            console.log(data);
            var role = $('#role_permision').html();
            var no = 1;
            var html = '';
            var btn_hapus   = '';
            var btn_edit    = '';
            for (var i = 0; i < data.length; i++) {
                if (data.KETERANGAN=='Resep') {
                    if (role==37 || role==34) {
                        btn_hapus   = '';
                        btn_edit   = '';
                    }else{
                        btn_hapus   = '<button type="button" class="btn btn-danger btn-flat" id="btn_hapus_resep_obat" name="btn_hapus_resep_obat" title="Hapus" value="'+data[i].ID_PENJUALAN+'"> <i class="fa fa-fw fa-trash-o"></i> </button> ';
                        btn_edit    = '<button type="button" class="btn btn-success btn-flat" id="btn_edit_resep_obat" name="btn_edit_resep_obat" value="'+data[i].ID_PENJUALAN+'" title="Edit Obat"> <i class="fa fa-fw  fa-pencil-square-o"></i> </button> ';        
                    }
                }else{
                    btn_hapus   = '<button type="button" class="btn btn-danger btn-flat" id="btn_hapus_resep_obat" name="btn_hapus_resep_obat" title="Hapus" value="'+data[i].ID_PENJUALAN+'"> <i class="fa fa-fw fa-trash-o"></i> </button> ';
                    btn_edit    = '<button type="button" class="btn btn-success btn-flat" id="btn_edit_resep_obat" name="btn_edit_resep_obat" value="'+data[i].ID_PENJUALAN+'" title="Edit Obat"> <i class="fa fa-fw  fa-pencil-square-o"></i> </button> ';
                }
                html += '<tr>'+
                            '<td>'+no+'</td>'+
                            '<td hidden>'+data[i].ID_STOK+'</td>'+
                            '<td>'+data[i].TGL_JUAL+'</td>'+
                            '<td>'+data[i].NAMA_OBAT+'</td>'+
                            '<td>'+data[i].QTY+'</td>'+
                            '<td hidden>'+data[i].BIAYA+'</td>'+
                            '<td>Rp. '+formatNumber(data[i].BIAYA)+'</td>'+
                            '<td> '+btn_edit +' | '+ btn_hapus+' </td>'+
                        '</tr>';
                        no++;
            }
            $('#list_resep_pesanan_pasien').html(html);
        }
    }); 
  }
  $('#tbl_input_resep_baru tbody').on('click', '#btn_edit_resep_obat', function(){
    var id = $(this).val();
    var $kolom1 = $(this).parents("tr").find("td:nth-child(1)").text();
    var $kolom2 = $(this).parents("tr").find("td:nth-child(2)").text();
    var $kolom3 = $(this).parents("tr").find("td:nth-child(3)").text();
    var $kolom4 = $(this).parents("tr").find("td:nth-child(4)").text();
    var $kolom5 = $(this).parents("tr").find("td:nth-child(5)").text();
    var $kolom6 = $(this).parents("tr").find("td:nth-child(6)").text();
    $('#id_resep').val(id);
    $('#idresep').val($kolom2).trigger('change');
    $('#qty_resep').val($kolom5);
  });
  $('#tbl_input_resep_baru tbody').on('click', '#btn_hapus_resep_obat', function(){
    var id = $(this).val();
    var $kolom4 = $(this).parents("tr").find("td:nth-child(4)").text();
    swal({
      title: "Apakah Anda Yakin?",
      text: "Anda Akan Menghapus Daftar Resep Obat "+$kolom4,
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        hapus_resep_obat(id);
      } else {
        swal("Data Batal Dihapus!");
      }
    });
  });
  function hapus_resep_obat(id){
    var notoken     = token_coba();
    $.ajax({
        type        : 'POST',
        url         : base_url()+'index.php/dashboard/hapus_resep_obat',
        async       : false,
        data        : 'csrf_klinik_mata_edc='+notoken+'&id_resep='+id,
        dataType    : 'json',
        success     : function(data){
            console.log(data);
            if (data=="Benar") {
                swal("Selamat!", "Data Berhasil di Hapus", "success");
                get_resep_pasien();
            }else{
                swal("Mohon Maaf!", "Data Gagal Di Hapus!", "warning");
            }
        }
    });
  }
  function tampilkan_obat_pasien(nodaftar){
    $.ajax({
      type : 'POST',
      url  : base_url()+'index.php/dashboard/get_data_obat_pasien_belum_bayar',
      async : false,
      data : "nodaftar="+nodaftar,
      dataType : 'json',
      success : function(obat_pasien){
        var no    = 1;
        var html  ='';
        var i;
        for (i=0;i<obat_pasien.length;i++) {
          var btn_hapus = '<button type="button" class="btn btn-danger btn-flat" id="btn_hapus_tindakan_obat" name="btn_hapus_tindakan_obat" title="Hapus" value="'+obat_pasien[i].id_jual+'"><i class="fa fa-fw fa-trash-o"></i></button>';
          var btn_edit = '<button type="button" class="btn btn-success btn-flat" id="btn_edit_input_obat" name="btn_edit_input_obat" value="'+obat_pasien[i].id_jual+'" title="Edit Obat"><i class="fa fa-fw  fa-pencil-square-o"></i></button>';
          html +='<tr>'+
              '<td>'+no+'</td>'+
              '<td>'+obat_pasien[i].tgl_jual+'</td>'+
              '<td>'+obat_pasien[i].nm_obat+'</td>'+
              '<td>'+obat_pasien[i].keterangan+'</td>'+
              '<td>'+obat_pasien[i].qty+'</td>'+
              '<td>'+obat_pasien[i].biaya+'</td>'+
              '<td hidden>'+obat_pasien[i].id_stok+'</td>'+
              '<td><center>'+btn_hapus+'</center></td>'+
              '</tr>';
            no++;
        }
        $("#list_obata_pesanan_pasien").html(html);
      }
    });
  }
  function list_data_tindakan(){
    $("#idtindakan").empty();
    $.ajax({
      type      : 'POST',
      url       : base_url()+'index.php/dashboard/data_tindakan_outlet',
      async     : false,
      dataType  : 'json',
      success   : function(tindakan){
        var i;
        var option_kosong = '';
        option_kosong += '<option selected="selected">- || -</option>';
        var option_tindakan = '';
        for (i=0; i<tindakan.length; i++) {
          option_tindakan += '<option value="'+tindakan[i].id_tarif+'" >' + tindakan[i].nm_tarif+' * Rp.'+ formatNumber(tindakan[i].tarif)+'</option>';
        }
        $("#idtindakan").html(option_kosong+option_tindakan);
      }
    });
  }
  $("#idtindakan").change(function(){
    var id_tarif_tindakan = $("#idtindakan").val();
    get_validasi_jenis_tindakan(id_tarif_tindakan);
  });
  function get_validasi_jenis_tindakan(id_tarif_tindakan){
    var notoken     = token_coba();
    $.ajax({
      type      : 'POST',
      url       : base_url()+'index.php/dashboard/get_validasi_jenis_tindakan',
      async     : false,
      data      : 'csrf_klinik_mata_edc='+notoken+'&id_tarif_tindakan='+id_tarif_tindakan,
      dataType  : 'json',
      success   : function(data){
        console.log(data);
        var id_tarif_tindakan   = data.id_tarif_tindakan;
        var tarif_tindakan      = data.tarif;
        if (id_tarif_tindakan!='kosong') {
            $('#id_tarif_tindakan_op').val(id_tarif_tindakan);
            $('#biaya_tarif_tindakan_op').val(tarif_tindakan);
            $('#nominal_dp_tindakan').val(tarif_tindakan);
            $('#nominal_dp_tindakan_palsu').val(tarif_tindakan);
        }else{
            $('#id_tarif_tindakan_op').val('');
            $('#biaya_tarif_tindakan_op').val('');
        }
      }
    });
  }
  function daftar_tindakan_kepada_pasien(nodaftar){
    $.ajax({
      type      : 'POST',
      url       : base_url()+'index.php/dashboard/get_daftar_tindakan_kepada_pasien',
      async     : false,
      data      : "nodaftar="+nodaftar,
      dataType  : 'json',
      success   : function(tindakan){
        var no   =1;
        var html ='';
        var i;
        for (i=0; i<tindakan.length; i++) {
          var btn_hapus = '<button type="button" class="btn btn-danger btn-flat" id="btn_hapus_s_tindakan" title="Hapus" value="'+tindakan[i].id_perawatan+'"><i class="fa fa-fw fa-trash-o"></i></button>';
          var btn_edit = '<button type="button" class="btn btn-success btn-flat" id="btn_edit_input_tindakan" name="btn_edit_input_tindakan" title="Edit Tindakan" value="'+tindakan[i].id_perawatan+'"><i class="fa fa-fw  fa-pencil-square-o"></i></button>';
          html += '<tr>'+
                    '<td>'+no+'</td>'+
                    '<td>'+tindakan[i].tgl_tindakan+'</td>'+
                    '<td>'+tindakan[i].nm_tindakan+'</td>'+
                    '<td>'+tindakan[i].keterangan+'</td>'+
                    '<td>'+tindakan[i].qty+'</td>'+
                    '<td>'+formatNumber(tindakan[i].biaya_t)+'</td>'+
                    '<td hidden>'+tindakan[i].tar_tindakan+'</td>'+
                    '<td>'+btn_hapus+btn_edit+'</td>'+
                  '</tr>';
        }
        $("#list_daftar_tindakan_pasien").html(html);
      }
    });
  }
  function get_tindakan_global(nodaftar){
    $.ajax({
      type      : 'POST',
      url       : base_url()+'index.php/dashboard/get_tindakan_global',
      async     : false,
      data      : "nodaftar="+nodaftar,
      dataType  : 'json',
      success   : function (tindakan_g){
        console.log(tindakan_g);
        var no1            = 1;
        var no;
        var html_tindakan1 = '';
        var html_tindakan = '';
        var i;
        for (i=0; i<tindakan_g.list_tindakan.length; i++) {
          if (no1==null) {
            html_tindakan1+=  '<tr>'+
                                '<td colspan="5"><center>Maaf Data Tidak Ditemukan</center></td>'+
                              '</tr>';
          }else{
            if (tindakan_g.list_tindakan[i].PRINT==1) {
                var check_t = '<input type="checkbox" class="flat-k" name="status_cetak_t" id="status_cetak_t" value="'+tindakan_g.list_tindakan[i].id_perawatan+'" checked>';
            }else{
                var check_t = '<input type="checkbox" class="flat-k" name="status_cetak_t" id="status_cetak_t" value="'+tindakan_g.list_tindakan[i].id_perawatan+'" >';
            }
            html_tindakan1+= '<tr>'+
                            '<td>'+no1+'</td>'+
                            '<td>'+tindakan_g.list_tindakan[i].nm_tindakan+'</td>'+
                            '<td> Rp. '+formatNumber(tindakan_g.list_tindakan[i].tarif_t)+'</td>'+
                            '<td>'+tindakan_g.list_tindakan[i].qty+'</td>'+
                            '<td>'+check_t+'</td>'+
                            '<td> Rp. '+formatNumber(tindakan_g.list_tindakan[i].biaya_p)+'</td>'+
                          '</tr>';
                          no1++;
          }
        }
        for (i=0; i<tindakan_g.tot_tindakan.length; i++) {
          var d_tind = tindakan_g.tot_tindakan[i].tot_biaya;
          if (d_tind==null) {
              html_tindakan+=  '<tr>'+
                                '<td colspan="5"><center>Maaf Data Tidak Ditemukan</center></td>'+
                              '</tr>';
            }else{
              html_tindakan+= '<tr>'+
                              '<td colspan="5"><strong> Total</strong></td>'+
                              '<td hidden><strong id="tot_bp">'+tindakan_g.tot_tindakan[i].tot_biaya+'</strong></td>'+
                              '<td colspan="1"><strong> Rp. '+formatNumber(tindakan_g.tot_tindakan[i].tot_biaya)+'</strong></td>'+
                          '</tr>';
            }
        }
        $("#tbody_tindakan_global").html(html_tindakan1+html_tindakan);
      }
    });
  }
  $("#table_tindakan_global tbody").on('click',"#status_cetak_t", function(){
    var notoken     = token_coba();
    var id_tindakan = $(this).val();
    if ($(this).is(':checked')) {
        var status = 1;
    }else{
        var status = 0;
    }
    $.ajax({
        type      : 'POST',
        url       : base_url()+'index.php/dashboard/status_cetak_karcis',
        async     : false,
        data      : 'csrf_klinik_mata_edc='+notoken+'&id='+id_tindakan+'&status='+status,
        dataType  : 'json',
        success   : function(data){
          if (data=="Benar") {
            if (status==1) {
                swal("Data di Cetak", "success");    
            }else{
                swal("Data tidak di Cetak", "warning");
            }
          }else{
            swal("Gagal Proses","warning");
          }
        }
    });
  });
  $("#table_obat_global tbody").on('click',"#status_cetak_o", function(){
    var notoken     = token_coba();
    var id_obat = $(this).val();
    if ($(this).is(':checked')) {
        var status = 1;
    }else{
        var status = 0;
    }
    $.ajax({
        type      : 'POST',
        url       : base_url()+'index.php/dashboard/status_cetak_obat',
        async     : false,
        data      : 'csrf_klinik_mata_edc='+notoken+'&id='+id_obat+'&status='+status,
        dataType  : 'json',
        success   : function(data){
            console.log(data);
          if (data=="Benar") {
            if (status==1) {
                swal("Data di Cetak", "success");    
            }else{
                swal("Data tidak di Cetak", "warning");
            }
          }else{
            swal("Gagal Proses","warning");
          }
        }
    });
  });
  $("#table_optik_global tbody").on('click',"#status_cetak_op", function(){
    var notoken     = token_coba();
    var id_optik = $(this).val();
    if ($(this).is(':checked')) {
        var status = 1;
    }else{
        var status = 0;
    }
    $.ajax({
        type      : 'POST',
        url       : base_url()+'index.php/dashboard/status_cetak_optik',
        async     : false,
        data      : 'csrf_klinik_mata_edc='+notoken+'&id='+id_optik+'&status='+status,
        dataType  : 'json',
        success   : function(data){
            console.log(data);
          if (data=="Benar") {
            if (status==1) {
                swal("Data di Cetak", "success");    
            }else{
                swal("Data tidak di Cetak", "warning");
            }
          }else{
            swal("Gagal Proses","warning");
          }
        }
    });
  });
  $("#table_sewa_mobil tbody").on('click',"#status_cetak_sw", function(){
    var notoken     = token_coba();
    var id_sewa = $(this).val();
    if ($(this).is(':checked')) {
        var status = 1;
    }else{
        var status = 0;
    }
    $.ajax({
        type      : 'POST',
        url       : base_url()+'index.php/dashboard/status_cetak_sewa',
        async     : false,
        data      : 'csrf_klinik_mata_edc='+notoken+'&id='+id_sewa+'&status='+status,
        dataType  : 'json',
        success   : function(data){
            console.log(data);
          if (data=="Benar") {
            if (status==1) {
                swal("Data di Cetak", "success");    
            }else{
                swal("Data tidak di Cetak", "warning");
            }
          }else{
            swal("Gagal Proses","warning");
          }
        }
    });
  });
  function get_obat_global(nodaftar){
    $.ajax({
        type      : 'POST',
        url       : base_url()+'index.php/dashboard/get_obat_global',
        async     : false,
        data      : "nodaftar="+nodaftar,
        dataType  : 'json',
        success   : function (obat_g){
          console.log(obat_g);
          var no1         = 1;
          var no          = 1;
          var html_obat1  = '';
          var html_obat   = '';
          var html_grand_total = '';
          var i;
          for (i=0; i<obat_g.list_obat.length; i++) {
            if (no1==null) {
              html_obat1 += '<tr>'+
                              '<td colspan="5"><center> Maaf Data Tidak Ditemukan</center></td>'+
                            '</tr>';
            }else{
                if (obat_g.list_obat[i].PRINT==1) {
                    var check_o = '<input type="checkbox" class="flat-k" name="status_cetak_o" id="status_cetak_o" value="'+obat_g.list_obat[i].id_jual+'" checked>';
                }else{
                    var check_o = '<input type="checkbox" class="flat-k" name="status_cetak_o" id="status_cetak_o" value="'+obat_g.list_obat[i].id_jual+'" >';
                }
              html_obat1+= '<tr>'+
                            '<td>'+no1+'</td>'+
                            '<td>'+obat_g.list_obat[i].nm_obat+'</td>'+
                            '<td> Rp. '+formatNumber(obat_g.list_obat[i].hrg_jual_o)+'</td>'+
                            '<td>'+obat_g.list_obat[i].qty+'</td>'+
                            '<td>'+check_o+'</td>'+
                            '<td> Rp. '+formatNumber(obat_g.list_obat[i].biaya)+'</td>'+
                          '</tr>';
                          no1++;
            }
          }
          for (i=0; i<obat_g.tot_obat.length; i++) {
            var tot = obat_g.tot_obat[i].tot_biaya;
            if (tot==null) {
              html_obat += '<tr>'+
                              '<td colspan="5"><center>Maaf Data Tidak Ditemukan</center></td>'+
                            '</tr>';
            }else{
              html_obat+= '<tr>'+
                              '<td colspan="4"><strong> Total</strong></td>'+
                              '<td colspan="1"><strong> Rp. '+formatNumber(obat_g.tot_obat[i].tot_biaya)+'</strong></td>'+
                             '</tr>';
            }
          }
          $("#tbody_obat_global").html(html_obat1+html_obat);
          var no_op = 1;
          var html_op1 = '';
          var html_op2 = '';
          var ip;
          for (ip=0; ip<obat_g.list_optik.length; ip++) {
            if (no_op==null) {
              html_op1+= '<tr>'+
                          
                        '</tr>';  
            }else{
                if (obat_g.list_optik[ip].PRINT==1) {
                    var check_op = '<input type="checkbox" class="flat-k" name="status_cetak_op" id="status_cetak_op" value="'+obat_g.list_optik[ip].id_optik+'" checked>';
                }else{
                    var check_op = '<input type="checkbox" class="flat-k" name="status_cetak_op" id="status_cetak_op" value="'+obat_g.list_optik[ip].id_optik+'" >';
                }
              html_op1+= '<tr>'+
                          '<td>'+no_op+'</td>'+
                          '<td>'+obat_g.list_optik[ip].nm_obat+'</td>'+
                          '<td> Rp. '+formatNumber(obat_g.list_optik[ip].hrg_satuan)+'</td>'+
                          '<td>'+obat_g.list_optik[ip].qty+'</td>'+
                          '<td>'+check_op+'</td>'+
                          '<td> Rp. '+formatNumber(obat_g.list_optik[ip].tot_hrg)+'</td>'+
                        '</tr>';
                        no_op++;
            }
          }
          for (ip=0; ip<obat_g.tot_optik.length; ip++) {
            var tot_p_optik = obat_g.tot_optik[ip].tot_biaya;
            if (tot_p_optik==null) {
              total_optik = 0;
            }else{
              total_optik = tot_p_optik;
            }
            if (total_optik==0) {
              html_op2+= '<tr>'+
                            '<td colspan="5"><center>Maaf Data Tidak Ditemukan</center></td>'+
                         '</tr>';
            }else{
              html_op2+= '<tr>'+
                          '<td colspan="4"><strong> Total</strong></td>'+
                          '<td colspan="1"><strong> Rp. '+formatNumber(total_optik)+'</strong></td>'+
                         '</tr>';
            }
          }
          $("#tbody_optik_global").html(html_op1+html_op2);
          var no_s    = 1;
          var html_s  = '';
          var html_2  = '';
          var is;
          for (is = 0; is < obat_g.list_sewa.length; is++) {
            var nm_loakasi = obat_g.list_sewa[is].tujuan;
            if (nm_loakasi=='') {
              var tujuan = obat_g.list_sewa[is].nm_tujuan;
            }else{
              var tujuan = obat_g.list_sewa[is].tujuan;
            }
            var status = obat_g.list_sewa[is].kd_status;
            if (obat_g.list_sewa[is].PRINT==1) {
                var check_sw = '<input type="checkbox" class="flat-k" name="status_cetak_sw" id="status_cetak_sw" value="'+obat_g.list_sewa[is].id_sewa+'" checked>';
            }else{
                var check_sw = '<input type="checkbox" class="flat-k" name="status_cetak_sw" id="status_cetak_sw" value="'+obat_g.list_sewa[is].id_sewa+'" >';
            }
            html_s +='<tr>'+
                            '<td>'+no_s+'</td>'+
                            '<td colspan="2">'+tujuan+'</td>'+
                            '<td colspan="1">'+check_sw+'</td>'+
                            '<td colspan="2"> Rp. '+formatNumber(obat_g.list_sewa[is].hrg_sewa)+'</td>'+
                          '</tr>';
            no_s++;
          }
          for (is = 0; is < obat_g.tot_sewa.length; is++) {
            var total_harga_sewa = obat_g.tot_sewa[is].tot_sewa;
            if (total_harga_sewa==null) {
              total_sewa = 0;
            }else{
              total_sewa = total_harga_sewa;
            }
            if (total_sewa==0) {
              html_2 += '<tr>'+
                              '<td colspan="5"><center>Maaf Data Tidak Ditemukan</center></td>'+
                            '</tr>';
            }else{
              html_2+= '<tr>'+
                              '<td colspan="4"><strong> Total</strong></td>'+
                              '<td colspan="1"><strong> Rp. '+formatNumber(total_sewa)+'</strong></td>'+
                             '</tr>';
            }
          }
          if (tot==null) {
            tot_harga_obat = 0;
          }else{
            tot_harga_obat = tot;
          }
          var list_biaya_tindakan = $("#tot_bp").html();
          if (list_biaya_tindakan==null) {
            tot_hrg_biaya_tindakan = 0;
          }else{
            tot_hrg_biaya_tindakan = list_biaya_tindakan;
          }
          var gran_tot = parseInt(tot_hrg_biaya_tindakan)+parseInt(tot_harga_obat)+parseInt(total_sewa)+parseInt(total_optik);
          if (isNaN(tot)){
            html_grand_total += '<tr>'+
                            '</tr>';
          }else{
            var total_grand   = gran_tot.toString();
            var potong        = total_grand.substr(-2);
            var status_pasien = $("#kepesetaan").html();
            if (status_pasien=='BPJS') {
              var grand_bulat = gran_tot;
            }else{
              if (potong>00) {
                var bulat = parseInt(gran_tot)-parseInt(potong)+100;
                var grand_bulat = bulat;
              }else{
                var grand_bulat = gran_tot;
              }
            }
            html_grand_total +='<tr>'+
                                '<td colspan="2"><strong><h2> Grand Total</h2></strong></td>'+
                                '<td colspan="3"><strong style="float:right;"><h2> Rp. '+formatNumber(grand_bulat)+'</h2></strong></td>'+
                              '</tr>';
          }
          $('#tbody_sewa_mobil_global').html(html_s+html_2);
          $("#tbody_grand_total").html(html_grand_total);
        }
    }); 
  }
  function get_biaya_pembayaran_tindakan(){
    var nodaftar = $("#nodaftar_bayar_tindakan").val();
    var tgl_input = $('#tgl_input_tindakan').val();
    $.ajax({
      type      : 'POST',
      url       : base_url()+'index.php/dashboard/get_biaya_bayar_tindakan',
      async     : false,
      data      : "nodaftar="+nodaftar+'&tgl_input_tindakan='+tgl_input,
      dataType  : 'json',
      success : function(biaya_tindakan){
        $("#biaya_operasi_bt").val(biaya_tindakan.biaya_operasi);
        $("#harga_awal_bt").html(biaya_tindakan.biaya_operasi);
        $("#id_operasi_bt").val(biaya_tindakan.id_biaya_perawatan);
        for (var i=0; i<biaya_tindakan.biaya_bukan_operasi.length; i++) {
          var data_rawat_jalan = biaya_tindakan.biaya_bukan_operasi[i].tot_biaya_op;
          var biaya_bukan_op;
          if (data_rawat_jalan==null) {
            biaya_bukan_op = 0;
          }else{
            biaya_bukan_op = data_rawat_jalan;
          }
          $("#biaya_bukan_operasi_bt").val(biaya_bukan_op);
        }
        for (var i=0; i<biaya_tindakan.biaya_obat.length; i++) {
          var data_obat = biaya_tindakan.biaya_obat[i].tot_biaya_obt;
          var biaya_obat;
          if (data_obat==null) {
            biaya_obat = 0;
          }else{
            biaya_obat = data_obat;
          }
          $("#jumlah_tagihan_obat").val(biaya_obat);
          $("#hrg_obt").html(biaya_obat);
        }
      }
    });
  }
  function token_data(nilai){
    $.ajax({
      type      : 'POST',
      url       : base_url()+'index.php/dashboard/token',
      async     : false,
      dataType  : 'json',
      success   : function(token){
        var csrf_name = token.csrf_name;
        var csrf_hash = token.csrf_hash;
        if (nilai==1) {
          $("#token_d_p").val(csrf_hash);
          simpan_pendaftaran_pasien();
        }else if (nilai==2) {
          $("#token_b_k").val(csrf_hash);
          simpan_bayar_karcis();
        }else if (nilai==3) {
          $("#token_s").val(csrf_hash);
          simpan_tindakan_pelayanan();
        }else if(nilai==4){
          $("#token_s").val(csrf_hash);
          simpan_tindakan_obat();
        }else if(nilai==5){
          $("#token_b_t").val(csrf_hash);
          simpan_bayar_tindakan();
        }
      }
    });
  }
  function simpan_pendaftaran_pasien(){
    var data_form = $("#form_daftarkan_pasien").serialize();
    var batas_awasl = $("#batas_awal").html();
    swal({
      title: "Apakah Anda Yakin?",
      text: "Anda Akan Melakukan Pendaftaran Pasien!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
          $.ajax({
                  type      : 'POST',
                  url       : base_url()+'index.php/dashboard/daftarkan_pasien',
                  async     : false,
                  data      : data_form+'&batas_awal='+batas_awal,
                  dataType  : 'json',
                  success   : function(daftar_pasien){
                    if (daftar_pasien.simpan=="Benar") {
                        swal(`Data Berhasil Disimpan`, {
                          icon: "success",
                        })
                        .then((value) => {
                          location.href=window.location.toString();
                        });
                    }else{
                        swal(daftar_pasien, {
                          icon: "warning",
                          buttons: true,
                          dangerMode: true,
                        });
                    }
                  }
            });
        }else {
          swal("You Canceled Saving registration!");
        }
    });
  }
  function simpan_tindakan_pelayanan(){
    var data_form   = $("#form_input_semua_tindakan").serialize();
    var tgl_input = $('#tgl_input_tindakan').val();
    var nodaftar    = $("#nodaftar_proses_tindakan").val();
    $.ajax({  
      type      : 'POST',
      url       : base_url()+'index.php/dashboard/simpan_pelayanan_tindakan_pasien',
      async     : false,
      data      : data_form+'&tgl_input_tindakan='+tgl_input,
      dataType  : 'json',
      success   : function(tindakan){
        if (tindakan=='Benar') {
          $("#id_proses_tindakan").val("");
          $("#idtindakan").val('').trigger('change');
          $("#qty").val("");
          $("#Keterangan").val("");
          $("#nominal_dp_tindakan").val("");
          $("#nominal_dp_tindakan_palsu").val("");
          $('#checklist_dp_harga_tindakan').prop('checked',false);
          $('#checklist_dp_harga_tindakan').val("0");
          daftar_tindakan_kepada_pasien(nodaftar);
          swal("Suksess!", "Data Berhasil Disimpan");
        }else{
          swal("Gagal!", "Data Gagal Disimpan", {
            icon: "warning",
            buttons: true,
            dangerMode: true,
          });
        }
      }
    });
  }
  function simpan_tindakan_obat(){
    var data_form = $("#form_input_semua_tindakan").serialize();
    var nodaftar  = $("#nodaftar_proses_tindakan").val();
    var tgl_input = $('#tgl_input_tindakan').val();
    $.ajax({
      type      : 'POST',
      url       : base_url()+'index.php/dashboard/simpan_data_obat_pasien',
      async     : false,
      data      : data_form+'&tgl_input_tindakan='+tgl_input,
      dataType  : 'json',
      success   : function(obat_p){
        console.log(obat_p);
        if (obat_p=="Benar") {
          swal({
            title: "Selamat!",
            text: "Data Berhasil Tersimpan!",
            icon: "success",
            button: "Ok!",
          });
          $("#id_proses_tindakan").val("");
          $("#idobat").val("");
          $("#idtindakan").val("");
          $("#qty").val("");
          $("#Keterangan").val("");
          $("#idobat").val('').trigger('change');
          tampilkan_obat_pasien(nodaftar);
          $("#idobat").prop('disabled', false);
        }else{
          swal({
            title: "Maaf!",
            text: "Anda Gagal Dalam Melakukan Penyimpanan!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          });
        }        
      }
    });
  }
  function simpan_bayar_tindakan(){
    var data_bayar_tindakan = $("#form_bayar_tindakan").serialize();
    var tgl_input = $('#tgl_input_tindakan').val();
    swal({
      title: "Apakah Anda Yakin?",
      text: "Anda Akan melakukan Penyimpanan Pembayaran!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
          $.ajax({
            type      : 'POST',
            url       : base_url()+'index.php/dashboard/simpan_pembayaran_tindakan',
            async     : false,
            data      : data_bayar_tindakan+'&tgl_input_tindakan='+tgl_input,
            dataType  : 'json',
            success   : function(bayar_tindakan){
              console.log(bayar_tindakan);
              if (bayar_tindakan=="Benar") {
                swal("Selamat! Data BErhasil Tersimpan!", {
                  icon: "success",
                });
                $("#btn_bayar_karcis").click();
                $("#checkbox_gratiskan_obat").prop('unchecked',true);
                $("#jumlah_yang_dibayar").val("");
                $("#uang_kembalian").val("");
                $("#token_b_t").val("");
                $("#btn_pembayaran_tindakan").click();
              }else{
                swal("Gagal menyimpan Data Pembayaran!");
              }
            }
          });
        } else {
          swal("Anda Membatalkan Pembayaran!");
        }
      });
  }
  function simpan_bayar_karcis(){
    var data_pembayaran_k   = $("#form_bayar_karcis").serialize();
    var tgl_pembayaran_k    = $('#tgl_kasir').val();
    var nodaftar_k          = $('#nodaftar_pembayar_k').val();
    swal({
      title: "Apakah Anda Yakin?",
      text: "Anda Akan Melakukan Menyimpan Pembayaran!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
          $.ajax({
            type      : 'POST',
            url       : base_url()+'index.php/dashboard/simpan_pembayaran_karcis',
            async     : false,
            data      : data_pembayaran_k+'&tgl_kasir='+tgl_pembayaran_k,
            dataType  : 'json',
            success   : function(simpan_k){
              if (simpan_k=="Benar") {
                swal("Selamat! Data Berhasil Tersimpan!", {
                        icon: "success",
                      });
                kosong_form_bkarcis();
                get_tindakan_karcis(nodaftar_k);
                $("#btn_batal_simpan_pembayaran_k").click();
              }else{
                swal("Gagal Penyimpanan Data!", {
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                      });
              }
            }
          });
        } else {
          swal("Anda Membatalkan Pembayaran!");
        }
      });
  }
  $("#tabel_karcis tbody").on('change', '.flat-red', function(){
    var $kolom2 = $(this).parents("tr").find("td:nth-child(2)").text();
    var $kolom5 = $(this).parents("tr").find("td:nth-child(5)").text();
    var $kolom6 = $(this).parents("tr").find("td:nth-child(6)").text();
    if ($(this).is(':checked')) {
      $(this).parents("tr").find("td:nth-child(1)").find('input[type=checkbox]').prop('checked',true);
      $(this).parents("tr").find("td:nth-child(3)").find('input[type=checkbox]').prop('checked',true);
      if ($kolom2 != 'Administrasi' && $kolom2 != 'Registrasi') {
        $('#id_rj_sementara').val($kolom6);
        $('#tarif_rj_sementara').val($kolom5);
      }
    }else{
      $(this).parents("tr").find("td:nth-child(1)").find('input[type=checkbox]').prop('checked',false);
      $(this).parents("tr").find("td:nth-child(3)").find('input[type=checkbox]').prop('checked',false);
      if ($kolom2 != 'Administrasi' && $kolom2 != 'Registrasi') {
        $('#id_rj_sementara').val('');
        $('#tarif_rj_sementara').val('');
      }
    }
  });
  $('#example2 tbody').on('click', '#btn_lihat_riwayat_tindakan', function(){
    var id = $(this).val();
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
    $("#nama_jk_r").html($kolom7+" / "+$kolom8);
    $("#norm_nodaftar_r").html($kolom5+" / "+$kolom6);
    $("#alamat_r").html($kolom9);
    $("#notelpon_r").html($kolom12);
    $('#norm_bayar_utang').val($kolom3);
    $('#nodaftar_bayar_utang').val($kolom4);
    input_form_retur();
    riwayat_terapi_pasien($kolom4);
    $('#pasien_belum_bayar').hide();
    //
    $("#nama_dan_jk_t").html($kolom7+" / "+$kolom8);
    $("#norm_nodaftar_t").html($kolom5+" / "+$kolom6);
    $("#alamat_t").html($kolom9);
    $("#no_telpon_t").html($kolom12);
    $("#nodaftar_proses_tindakan").val($kolom4);
    $('#nodaftar_sewa').val($kolom4);
    $('#nodaftar_resep').val($kolom4);
    $("#norm_proses_tindakan").val($kolom3);
    $("#norm_sewa").val($kolom3);
    $("#norm_resep").val($kolom3);
    $("#norm_bayar_tindakan").val($kolom3);
    $("#nodaftar_bayar_tindakan").val($kolom4);
    $("#nama_pembayar_tindakan").val($kolom7);
    $("#nodaftar_optik").val($kolom4);
    $("#norm_optik").val($kolom3);
    $("#nama_jk_bt").html($kolom7+" / "+$kolom8);
    $("#norm_nodaftar_bt").html($kolom5+" / "+$kolom6);
    $("#kepesetaan").html($kolom10);
    $("#alamat_bt").html($kolom9);
    $("#no_telpon_bt").html($kolom12);
    var nodaftar = $kolom4;
    get_tindakan_global(nodaftar);
    get_obat_global(nodaftar);
    tampilkan_obat_pasien(nodaftar);
    daftar_tindakan_kepada_pasien(nodaftar);
    get_dokter_nodaftar(nodaftar);
    $('#tgl_input_tindakan').val($kolom2);
    ///Karcis
    $("#nama_jk_k").html($kolom7+" / "+$kolom8);
    $("#norm_nodaftar_k").html($kolom5+" / "+$kolom6);
    $("#alamat_k").html($kolom9);
    $("#notelpon_k").html($kolom12);
    $("#nama_pembayar_k").val($kolom7);
    $("#nodaftar_pembayar_k").val($kolom4);
    $("#norm_pembayar_k").val($kolom3);
    $("#nodaftar_k").html($kolom4);
    $("#kepesetaan_k").html($kolom10);
    $("#norm_ksr_urgen").val($kolom3);
    $("#nodaf_ksr_urgen").val($kolom4);
    $('#daftar_id_karcis').prop('disabled',true);
    $('#tgl_kasir').val($kolom2);
    $('#status_input_karcis').val(2);
    get_tindakan_karcis($kolom4);
    $("#btn_simpan_bayar_karcis").hide();
    $("#btn_batal_pembayaran_k_urgen").hide();
    $("#btn_batal_simpan_pembayaran_k").hide();
    $("#form_bayar_karcis").hide();
  });
  $('#btn_tindakan_urgen').on('click', function(){
    $('#status_input_tindakan').val(2);
    list_tindakan_pasien();
    var status_input = $('#status_input_tindakan').val();
    if (status_input==2) {
        $('#btn_back_tindakan_urgent').show();
        $('#btn_back_tindakan').hide();
    }else{
        $('#btn_back_tindakan_urgent').hide();
        $('#btn_back_tindakan').show();
    }
  });
  $('#btn_karcis_urgen').click(function(){
    $('#status_input_karcis').val(2);
    get_list_karcis_urgen();
    show_karcis();
    get_dokter();
    $("#btn_simpan_bayar_karcis").hide();
    $("#btn_batal_simpan_pembayaran_k").hide();
    $("#form_bayar_karcis").hide();
    var id_role = $('#role_permision').html();
    if (id_role==37) {
      $('#form_karcis_urgen').show();
    }else{
      $('#form_karcis_urgen').show();
    }
    $('#btn_batal_pembayaran_k_urgen').show();
    $('#btn_batal_pembayaran').hide();
  });
  $("#btn_back_tindakan_urgent").click(function(){
    input_form_retur();
  });
  $("#btn_batal_pembayaran_k_urgen").click(function(){
    input_form_retur();
  });
  function riwayat_terapi_pasien(nodaftar){
    var id_role = $('#role_permision').html();
    var notoken = token_coba();
    $.ajax({
      type      : 'POST',
      url       : base_url()+'/index.php/dashboard/riwayat_terapi_pasien',
      async     : false,
      data      : 'csrf_klinik_mata_edc='+notoken+'&nodaftar='+nodaftar,
      dataType  : 'json',
      success   : function(data){
        console.log(data);
        var no            = 1;
        var tbl_terapi  = '';
        var i;
        var terapi = data.terapi_tindakan;
        for (i=0; i<terapi.length; i++) {
          if (id_role==37) {
            var btn_retur_terapi  = '';
          }else{
            var btn_retur_terapi  = '<button type="button" style="width:85%;" class="btn btn-block btn-danger" id="batal_riwayat_tindakan" value="'+terapi[i].id_perawatan+'"><i class="fa fa-fw fa-list-alt"></i> Batalkan</button>';
          }
          
          tbl_terapi  += '<tr>'+
              '<td>'+no+'</td>'+
              '<td hidden>'+terapi[i].nodaftar+'</td>'+
              '<td hidden>'+terapi[i].no_pasien+'</td>'+
              '<td>'+terapi[i].nm_tindakan+'</td>'+
              '<td>'+terapi[i].tarif+'</td>'+
              '<td>'+terapi[i].qty+'</td>'+
              '<td>'+terapi[i].biaya+'</td>'+
              '<td><center>'+btn_retur_terapi+'</center></td>'+
          '</tr>';
          no++;
          
        };
        var obat = data.terapi_obat;
        for (i=0; i<obat.length; i++) {
          if (id_role==37) {
            if (obat[i].qty==0) {
              var btn_retur_terapi  = '';
            }else{
              var btn_retur_terapi  = '';
            }
          }else{
            if (obat[i].qty==0) {
              var btn_retur_terapi  = '';
            }else{
              var btn_retur_terapi  = '<button type="button" style="width:85%;" class="btn btn-block btn-danger" id="btn_retur_terapi" value="'+obat[i].nodaftar+'"><i class="fa fa-fw fa-reply"></i> Retur</button>';  
            }
          }
          
          tbl_terapi  += '<tr>'+
              '<td>'+no+'</td>'+
              '<td hidden>'+obat[i].id_penjualan+'</td>'+
              '<td hidden>'+obat[i].id_stok+'</td>'+
              '<td>'+obat[i].nm_obat+'</td>'+
              '<td>'+obat[i].hrg_jual+'</td>'+
              '<td>'+obat[i].qty+'</td>'+
              '<td>'+obat[i].biaya+'</td>'+
              '<td hidden>obat</td>'+
              '<td><center>'+btn_retur_terapi+'</center></td>'+
          '</tr>';
          no++;
          
        };
        var optik = data.terapi_optik;
        for (var i = 0; i < optik.length; i++) {
          if (id_role==37) {
            if (optik[i].qty==0) {
              var btn_retur_terapi  = '';
            }else{
              var btn_retur_terapi  = '<button type="button" style="width:85%;" class="btn btn-block btn-danger" id="btn_retur_terapi" value="'+optik[i].nodaftar+'"><i class="fa fa-fw fa-reply"></i> Retur</button>';
            }
          }else{
            if (optik[i].qty==0) {
              var btn_retur_terapi  = '';
            }else{
              var btn_retur_terapi  = '<button type="button" style="width:85%;" class="btn btn-block btn-danger" id="btn_retur_terapi" value="'+optik[i].nodaftar+'"><i class="fa fa-fw fa-reply"></i> Retur</button>';
            }
          }
          tbl_terapi  += '<tr>'+
              '<td>'+no+'</td>'+
              '<td hidden>'+optik[i].ID_PENJUALAN_OPTIK+'</td>'+
              '<td hidden> </td>'+
              '<td>'+optik[i].NAMA_BARANG+'</td>'+
              '<td>'+optik[i].HARGA_SATUAN+'</td>'+
              '<td>'+optik[i].QTY+'</td>'+
              '<td>'+optik[i].TOTAL_HARGA+'</td>'+
              '<td hidden>optik</td>'+
              '<td><center>'+btn_retur_terapi+'</center></td>'+
          '</tr>';
          no++;
        }
        var sewa = data.terapi_sewa;
        for (var i = 0; i < sewa.length; i++) {
          var nm_tujuan = sewa[i].nm_tujuan;
          if (nm_tujuan==null) {
            var tujuan = sewa[i].tujuan;
          }else{
            var tujuan = nm_tujuan;
          }
          var btn_retur_terapi = '';
          tbl_terapi  += '<tr>'+
              '<td>'+no+'</td>'+
              '<td hidden>'+sewa[i].id_sewa+'</td>'+
              '<td hidden>'+sewa[i].trf_sewa+'</td>'+
              '<td>'+tujuan+'</td>'+
              '<td> - </td>'+
              '<td> - </td>'+
              '<td>'+sewa[i].hrg_sewa+'</td>'+
              '<td hidden>optik</td>'+
              '<td><center>'+btn_retur_terapi+'</center></td>'+
          '</tr>';
          no++;
        }
        $("#tbody_tbl_riwayat_terapi_pasien").html(tbl_terapi);
      }
    });
  }
  $('#tbl_riwayat_terapi_pasien').on('click', '#batal_riwayat_tindakan', function(){
    var id = $(this).val();
    var $kolom1 = $(this).parents("tr").find("td:nth-child(1)").text();
    var $kolom2 = $(this).parents("tr").find("td:nth-child(2)").text();
    var $kolom3 = $(this).parents("tr").find("td:nth-child(3)").text();
    swal("Tulis Keterangan Anda : ", {
      content: "input",
    })
    .then((value) => {
      if (value=='') {
        swal(`Maaf Data Kosong:`);
      }else{
        batalkan_riwayat_tindakan(id, $kolom2, $kolom3, value);
      }
    });
  });
  function batalkan_riwayat_tindakan(id, nodaftar, norm, keterangan){
    var notoken = token_coba();
    swal({
      title: "Apakah Anda Yakin?",
      text: "Anda Akan Membatalkan Pendaftaran!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          type      : 'POST',
          url       : base_url()+'/index.php/dashboard/simpan_batalkan_tindakan',
          async     : false,
          data      : 'csrf_klinik_mata_edc='+notoken+'&nodaftar='+nodaftar+'&norm='+norm+'&keterangan='+keterangan+'&id='+id,
          dataType  : 'json',
          success   : function(data){
            console.log(data);
            if (data=="Benar") {
              swal("Selamat! Data Berhasil di Simpan!", {
                icon: "success",
              });
              riwayat_terapi_pasien(nodaftar);
            }else{
              swal("Maaf! Data Gagal Disimpan!", {
                icon: "warning",
              });
            }
          }
        });
      } else {
        swal("Anda Membatalkan Penyimpanan!");
      }
    });
  }
  $('#tbl_riwayat_terapi_pasien').on('click', '#btn_retur_terapi', function(){
    var col     = $(this).parents("tr");
    var $kolom1 = $(this).parents("tr").find("td:nth-child(1)").text();
    var $kolom2 = $(this).parents("tr").find("td:nth-child(2)").text();
    var $kolom3 = $(this).parents("tr").find("td:nth-child(3)").text();
    var $kolom4 = $(this).parents("tr").find("td:nth-child(4)").text();
    var $kolom5 = $(this).parents("tr").find("td:nth-child(5)").text();
    var $kolom6 = $(this).parents("tr").find("td:nth-child(6)").text();
    var $kolom7 = $(this).parents("tr").find("td:nth-child(7)").text();
    var $kolom8 = $(this).parents("tr").find("td:nth-child(8)").text();
    var $kolom9 = $(this).parents("tr").find("td:nth-child(9)").text();
    $('#id_stok_retur').val($kolom3);
    $('#id_penjualan').val($kolom2);
    $('#nm_obat_retur').val($kolom4);
    $('#qty_retur_awal').val($kolom6);
    $('#qty_retur').val($kolom6).prop('readonly', true);
    $('#jenis_retur').val($kolom8);
    $('#form_retur_terapi').show();
    $('#btn_simpan_retur').show();
  });
  $('#qty_retur').on('keyup', function(){
    var qty_retur_awal  = $('#qty_retur_awal').val();
    var qty_retur       = $('#qty_retur').val();
    var number          = /^[0-9]+$/;
    if (parseInt(qty_retur)>parseInt(qty_retur_awal)) {
      swal("Maaf! Jumlah Yang Anda Input Terlalu Besar!", {
        icon: "warning",
      });
      $('#qty_retur').val(qty_retur_awal);
    }else if(parseInt(qty_retur)<1){
      $('#qty_retur').val(qty_retur_awal);
    }else if(!qty_retur.match(number)){
      swal("Maaf! Inputan Harus Angka!", {
        icon: "warning",
      });
      $('#qty_retur').val(qty_retur_awal);
    }
  });
  $('#btn_simpan_retur').click(function(){
    retur_terapi_pasien();
  });
  function retur_terapi_pasien(){
    var form_retur_penjualan = $("#form_retur").serialize();
    var notoken = token_coba();
    $.ajax({
      type      : 'POST',
      url       : base_url()+'/index.php/dashboard/retur_terapi_pasien',
      async     : false,
      data      : 'csrf_klinik_mata_edc='+notoken+'&'+form_retur_penjualan,
      dataType  : 'json',
      success   : function(data){
        console.log(data);
        if (data.status=="Benar") {
          swal("Selamat! Data Yang Anda Inputkan Benar!", {
            icon: "success",
          });
          riwayat_terapi_pasien(data.nodaftar);
        }else if(data.status=="Salah"){
          swal("Maaf! Data Gagal Di Simpan!", {
            icon: "warning",
          });
        }else{
          swal(data.status, {
            icon: "warning",
          });
        }
        $('#form_retur_terapi').hide();
        $('#btn_simpan_retur').hide();
      }
    });
  }
  $("#example1 tbody").on('click', '#btn_lihat_tindakan', function(){
    var col     = $(this).parents("tr");
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
    $("#nama_dan_jk_t").html($kolom7+" / "+$kolom8);
    $("#norm_nodaftar_t").html($kolom3+" / "+$kolom5);
    $("#alamat_t").html($kolom9);
    $("#no_telpon_t").html($kolom12);
    $("#nodaftar_proses_tindakan").val($kolom6);
    $('#nodaftar_sewa').val($kolom6);
    $('#nodaftar_resep').val($kolom6);
    $("#norm_proses_tindakan").val($kolom4);
    $("#norm_sewa").val($kolom4);
    $("#norm_resep").val($kolom4);
    $("#norm_bayar_tindakan").val($kolom4);
    $("#nodaftar_bayar_tindakan").val($kolom6);
    $("#nama_pembayar_tindakan").val($kolom7);
    $("#nodaftar_optik").val($kolom6);
    $("#norm_optik").val($kolom4);
    $("#nama_jk_bt").html($kolom7+" / "+$kolom8);
    $("#norm_nodaftar_bt").html($kolom3+" / "+$kolom5);
    $("#kepesetaan").html($kolom10);
    $("#alamat_bt").html($kolom9);
    $("#no_telpon_bt").html($kolom12);
    var nodaftar = $kolom6;
    get_tindakan_global(nodaftar);
    get_obat_global(nodaftar);
    list_tindakan_pasien();
    tampilkan_obat_pasien(nodaftar);
    daftar_tindakan_kepada_pasien(nodaftar);
    get_dokter_nodaftar(nodaftar);
    $('#status_input_tindakan').val(1);
    $('#tgl_input_tindakan').val($kolom2);
    var status_input = $('#status_input_tindakan').val();
    if (status_input==2) {
        $('#btn_back_tindakan_urgent').show();
        $('#btn_back_tindakan').hide();
    }else{
        $('#btn_back_tindakan_urgent').hide();
        $('#btn_back_tindakan').show();
    }
  });
  $("#example1 tbody").on('click', '#btn_lihat_karcis', function(){
    var col     = $(this).parents("tr");
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
    $("#nama_jk_k").html($kolom7+" / "+$kolom8);
    $("#norm_nodaftar_k").html($kolom3+" / "+$kolom5);
    $("#alamat_k").html($kolom9);
    $("#notelpon_k").html($kolom12);
    $("#nama_pembayar_k").val($kolom7);
    $("#nodaftar_pembayar_k").val($kolom6);
    $("#norm_pembayar_k").val($kolom4);
    $("#nodaftar_k").html($kolom6);
    $("#kepesetaan_k").html($kolom10);
    $("#norm_ksr_urgen").val($kolom4);
    $("#nodaf_ksr_urgen").val($kolom6);
    $('#daftar_id_karcis').prop('disabled',true);
    $('#tgl_kasir').val($kolom2);
    $('#status_input_karcis').val(1);
    get_list_karcis_urgen();
    get_tindakan_karcis($kolom6);
    show_karcis();
    get_dokter();
    $("#btn_simpan_bayar_karcis").hide();
    $("#btn_batal_pembayaran_k_urgen").hide();
    $("#btn_batal_simpan_pembayaran_k").hide();
    $("#form_bayar_karcis").hide();
    var id_role = $('#role_permision').html();
    if (id_role==37) {
      $('#form_karcis_urgen').show();
    }else{
      $('#form_karcis_urgen').show();
    }
  });
  $("#example1 tbody").on('dblclick', '#kode_golongan', function(){
    var notoken           = token_coba();
    $('#modal_kode_golongan').click();
    var col     = $(this).parents("tr");
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
    $('#csrf_klinik_mata_edc').val(notoken);
    $('#nm_pasien_kd_gol').html($kolom7);
    $('#norm_perubahan_golongan').val($kolom4);
    $('#nodaftar_perubahan_golongan').val($kolom6);
    $('#kode_golongan_lama').val($kolom10);
  });
  $("#example1 tbody").on('dblclick', '#nama_pasien', function(){
    $('#modal_detail_pasien').click();
    var col     = $(this).parents("tr");
    var $kolom1 = $(this).parents("tr").find("td:nth-child(1)").text();
    var $kolom2 = $(this).parents("tr").find("td:nth-child(2)").text();
    var $kolom3 = $(this).parents("tr").find("td:nth-child(3)").text();
    var $kolom4 = $(this).parents("tr").find("td:nth-child(4)").text();
    detail_pasien($kolom4);
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
    var notoken           = token_coba();
    $('#csrf_klinik_mata_edc_detail').val(notoken);
    $('#nm_pasien_detail').html($kolom7);
    $('#norm_pasien_detail').val($kolom4);
    $('#nama_pasien_detail').val($kolom7);
    $('#jk_detail').val($kolom8).trigger('change');
    $('#tempat_lahir_detail').val($kolom14);
    $('#tgl_lahir_detail').val($kolom15);
    $('#pekerjaan_detail').val($kolom13).trigger('change');
    $('#alamat_detail').val($kolom9);
    $('#no_telp_detail').val($kolom12);
    $('#no_kpst_detail').val($kolom16);
    $('#nik_pasien_detail').val($kolom17);
  });
  $('#simpan_perubahan_kd_gol').click(function(){
  });
  $('#id_dokter_input_karcis_urgen').on('change', function(){
    $('#daftar_id_karcis').val('').prop('disabled',false);
    $('#tagihan_karcis_urgen').val('');
    $('#daftar_id_karcis').val('').trigger('change');
    var dokter = $(this).val();
    get_list_karcis_urgen();
  });
  function get_list_karcis_urgen(){
    $('#daftar_id_karcis').empty();
    var notoken = token_coba();
    $.ajax({
      type      : 'POST',
      url       : base_url()+'index.php/dashboard/get_karcis',
      async     : false,
      data      : 'csrf_klinik_mata_edc='+notoken,
      dataType  : 'json',
      success   : function(data){
        console.log(data);
        var option_kosong_k = '';
        option_kosong_k += '<option selected="selected">- || -</option>';
        var html    = '';
        var html2   = '';
        for (var i = 0; i < data.admin.length; i++) {
          html += '<option value="'+data.admin[i].ID_TARIF_TINDAKAN+'">'+data.admin[i].NAMA_TINDAKAN+'</option>';
        }
        for (var i = 0; i < data.pemeriksaan.length; i++) {
            html2 += '<option value="'+data.pemeriksaan[i].ID_TARIF_TINDAKAN+'">'+data.pemeriksaan[i].NAMA_TINDAKAN+'</option>';
        }
        $('#daftar_id_karcis').html(option_kosong_k+html+html2);
      }
    });
  }
  $('#daftar_id_karcis').on('change', function(){
    var id_tindakan = $(this).val();
    get_herga_karcis_urgen(id_tindakan);
  });
  function detail_pasien($kolom4){
    var notoken = token_coba();
    $.ajax({
        type        : 'POST',
        url         : base_url()+'index.php/dashboard/detail_pasien',
        async       : false,
        data        : 'csrf_klinik_mata_edc='+notoken+'&norm='+$kolom4,
        dataType    : 'json',
        success     : function(data){
            console.log(data);
            $('#no_rm_lama').val(data);
        }
    });
  }
  function get_herga_karcis_urgen(id_tindakan){
    var nodaftar        = $("#nodaftar_pembayar_k").val();
    var dokter_karcis   = $("#id_dokter_input_karcis_urgen").val();
    var notoken     = token_coba();
    $.ajax({
      type      : 'POST',
      url       : base_url()+'index.php/dashboard/get_harga_karcis_urgen',
      async     : false,
      data      : 'csrf_klinik_mata_edc='+notoken+'&id_tindakan='+id_tindakan+'&nodaftar='+nodaftar+'&dokter='+dokter_karcis,
      dataType  : 'json',
      success   : function(data){
        console.log(data);
        for (var i = 0; i < data.dokter.length; i++) {
          tarif_spesialis_mata2 = data.dokter[i].JUMLAH_TARIF;
          tarif_mata2           = data.dokter[i].TARIF_MATA;
        }
        for (var i = 0; i < data.harga.length; i++) {
          if (data.harga[i].KODE_TINDAKAN==97) {
            var tarif = tarif_spesialis_mata2;
          }else if (data.harga[i].KODE_TINDAKAN==96) {
            var tarif = tarif_mata2;
          }else{
            var tarif = data.harga[i].TARIF;
          }
          if (tarif=='') {
            var hrg_tarif = 0;
          }else{
            var hrg_tarif = tarif;
          }
          $('#tagihan_karcis_urgen').val(hrg_tarif);
        }
      }
    }); 
  }
  $('#btn_simpan_karcis_urgen').on('click', function(){
    simpan_karcis_urgen();
  });
  function simpan_karcis_urgen(){
    var form_karcis_urgen = $('#form_input_karcis_urgen').serialize();
    var nodaftar          = $('#nodaf_ksr_urgen').val();
    var notoken           = token_coba();
    $.ajax({
      type      : 'POST',
      url       : base_url()+'index.php/dashboard/simpan_karcis_urgen',
      async     : false,
      data      : 'csrf_klinik_mata_edc='+notoken+'&'+form_karcis_urgen,
      dataType  : 'json',
      success   : function(data){
        console.log(data);
        if (data=="Benar") {
          swal("Selamat! Data Berhasil di Simpan!", {
            icon: "success",
          });
          $('#id_dokter_input_karcis_urgen').val('').trigger('change');
          $('#daftar_id_karcis').val('').trigger('change');
          $('#tagihan_karcis_urgen').val('');
          get_tindakan_karcis(nodaftar);
          show_karcis();
        }else{
          swal("Maaf! Data Gagal Disimpan!", {
            icon: "error",
          });
        }
      }
    });
  }
  $("#example1 tbody").on('click', '#btn_batal_daftar', function(){
    var nodaftar  = $(this).val();
    var $kolom3   = $(this).parents("tr").find("td:nth-child(3)").text();
    var $kolom4   = $(this).parents("tr").find("td:nth-child(4)").text();
    swal("Tulis Keterangan Anda : ", {
      content: "input",
    })
    .then((value) => {
      if (value=='') {
        swal(`Maaf Data Kosong:`);
      }else{
        batalkan_pendaftaran_pasien(nodaftar, $kolom4, value);
      }
    });
  });
  function batalkan_pendaftaran_pasien(nodaftar, norm, keterangan){
    var notoken = token_coba();
    swal({
      title: "Apakah Anda Yakin?",
      text: "Anda Akan Membatalkan Pendaftaran!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          type      : 'POST',
          url       : base_url()+'/index.php/dashboard/simpan_batalkan_daftar',
          async     : false,
          data      : 'csrf_klinik_mata_edc='+notoken+'&nodaftar='+nodaftar+'&norm='+norm+'&keterangan='+keterangan,
          dataType  : 'json',
          success   : function(data){
            console.log(data);
            if (data=="Benar") {
              swal("Selamat! Data Berhasil di Simpan!", {
                icon: "success",
              });
              get_data_pendaftar_hari_ini();
            }else{
              swal("Maaf! Data Gagal Disimpan!", {
                icon: "warning",
              });
            }
          }
        });
      } else {
        swal("Anda Membatalkan Penyimpanan!");
      }
    });
  }
  function base_url(){
  let protocol  = window.location.protocol+"//"; 
  let host      = protocol+window.location.host+"/"; 
      host      = host+"klinik_mata_edc_4"; 
      return host;
  }
  $("#example3 tbody").on('click', '#btn_daftarkan_pasien', function(){
    var id = $(this).val();
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
    show_form_pendaftaran();
    var get_nama_provinsi = $kolom11;
    $("#norm_pasien").val(id);
    $('#data_nama_pasien').val($kolom3);        
    $("#jk").val($kolom4).trigger('change');
    $("#tempat_lahir").val($kolom7);
    $("#tgl_lahir").val($kolom8);
    $("#pekerjaan").val($kolom9).trigger('change');
    $("#alamat").val($kolom5);
    $("#nama_provinsi").val($kolom11);
    $("#nama_kabupaten").val($kolom12);
    $("#nama_kecamatan").val($kolom13);
    $("#nama_desa").val($kolom14);
    $("#no_telp").val($kolom15);
    $("#no_kpst").val($kolom16);
    $("#batas").val($kolom17);
    $("#batas_awal").val($kolom17);
    $('#nik_pasien').val($kolom18);
    var batas = $("#batas").val();
    if (batas==3) {
      $("#jenis_pasien").val($kolom10).trigger('change'); 
      
      var option_jenis_p =  '<option value="UMUM">UMUM</option>'+
                            '<option value="BPJS">BPJS</option>'+
                            '<option value="GRATIS">GRATIS</option>'+
                            '<option value="MNC">MNC</option>';
      $("#jenis_pasien").html(option_jenis_p);
      $("#jenis_pasien").val($kolom10).trigger('change'); 
    }else{
      var option_jenis_p =  '<option value="UMUM">UMUM</option>'+
                            '<option value="BPJS">BPJS</option>'+
                            '<option value="GRATIS">GRATIS</option>'+
                            '<option value="MNC">MNC</option>';
      $("#jenis_pasien").html(option_jenis_p);
      $("#jenis_pasien").val($kolom10).trigger('change'); 
    }
    if ($("#jenis_pasien").val()=="BPJS") {
      $("#input_nokpst").show();
    }else{
      $("#input_nokpst").hide();
      $("#norm_lama").hide();
    }
    get_provinsi(get_nama_provinsi);

    get_dokter();
  });
  $("#tabel_pasien_dos tbody").on('click', '#btn_daftarkan_pasien', function(){
    var id = $(this).val();
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
    show_form_pendaftaran();
    var get_nama_provinsi = $kolom11;
    var jns_kelamin = $kolom4;
    if (jns_kelamin=="L") {
        var jk_dos = "Laki-laki";
    }else{
        var jk_dos = "Perempuan";
    }
    $('#id_backup_dos').val(id);
    $("#norm_pasien").val('');
    $('#data_nama_pasien').val($kolom3);        
    $("#jk").val(jk_dos).trigger('change');
    $("#tempat_lahir").val('');
    $("#tgl_lahir").val($kolom8);
    $("#pekerjaan").val('').trigger('change');
    $("#alamat").val($kolom5);
    $("#nama_provinsi").val($kolom11);
    $("#no_telp").val($kolom15);
    $("#no_kpst").val('');
    $("#batas").val($kolom17);
    $("#batas_awal").val($kolom17);
    var batas = $("#batas").val();
    if (batas==3) {
      $("#jenis_pasien").val($kolom10).trigger('change'); ;
      var option_jenis_p =  '<option value="UMUM">UMUM</option>'+
                            '<option value="BPJS">BPJS</option>'+
                            '<option value="GRATIS">GRATIS</option>'+
                            '<option value="MNC">MNC</option>';
      $("#jenis_pasien").html(option_jenis_p);
      $("#jenis_pasien").val($kolom10).trigger('change'); 
    }else{
      var option_jenis_p =  '<option value="UMUM">UMUM</option>'+
                            '<option value="BPJS">BPJS</option>'+
                            '<option value="GRATIS">GRATIS</option>'+
                            '<option value="MNC">MNC</option>';
      $("#jenis_pasien").html(option_jenis_p);
      $("#jenis_pasien").val($kolom10).trigger('change');
    }
    if ($("#jenis_pasien").val()=="BPJS") {
      $("#input_nokpst").show();
    }else{
      $("#input_nokpst").hide();
      $("#norm_lama").hide();
    }
    get_provinsi(get_nama_provinsi);
    get_dokter();
  });
  $("#tabel_pasien_screening tbody").on('click', '#btn_daftarkan_pasien', function(){
    var id = $(this).val();
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
    show_form_pendaftaran();
    var get_nama_provinsi = $kolom11;
    var jns_kelamin = $kolom4;
    if (jns_kelamin=="L") {
        var jk_scr = "Laki-laki";
    }else{
        var jk_scr = "Perempuan";
    }
    var get_nama_provinsi = $kolom11;
    var jns_kelamin = $kolom4;
    $('#nik_pasien').val($kolom6);
    $('#ID_KUNJUNGAN_PASIEN').val(id);
    $("#norm_pasien").val('');
    $('#data_nama_pasien').val($kolom3);        
    $("#jk").val(jk_scr).trigger('change');
    $("#tempat_lahir").val('');
    $("#tgl_lahir").val('');
    $("#pekerjaan").val('').trigger('change');
    $("#alamat").val($kolom5);
    $("#nama_provinsi").val($kolom11);
    $("#no_telp").val('');
    $("#no_kpst").val('');
    $("#batas").val($kolom17);
    $("#batas_awal").val($kolom17);
    var batas = $("#batas").val();
    if (batas==3) {
      $("#jenis_pasien").val($kolom10).trigger('change'); 
      var option_jenis_p =  '<option value="UMUM">UMUM</option>'+
                            '<option value="BPJS">BPJS</option>'+
                            '<option value="GRATIS">GRATIS</option>'+
                            '<option value="MNC">MNC</option>';
      $("#jenis_pasien").html(option_jenis_p);
      $("#jenis_pasien").val($kolom10).trigger('change'); 
    }else{
      var option_jenis_p =  '<option value="UMUM">UMUM</option>'+
                            '<option value="BPJS">BPJS</option>'+
                            '<option value="GRATIS">GRATIS</option>'+
                            '<option value="MNC">MNC</option>';
      $("#jenis_pasien").html(option_jenis_p);
      $("#jenis_pasien").val($kolom10).trigger('change'); 
    }
    if ($("#jenis_pasien").val()=="BPJS") {
      $("#input_nokpst").show();
    }else{
      $("#input_nokpst").hide();
      $("#norm_lama").hide();
    }
    get_provinsi(get_nama_provinsi);
    get_dokter();
  });
  $('#id_dokter').on('change', function(){
    get_data_karcis();
  });
  $("#btn_simpan_bayar_karcis").click(function(){
    token_data(2);
  });
  $('#btn_cetak_uji_umum').click(function(){
    var nodaftar = $("#nodaftar_pembayar_k").val();
    $.ajax({
      type      : 'POST',
      url       : base_url()+"index.php/dashboard/cetak_karcis",
      async     : false,
      data      : "nodaftar="+nodaftar,
      dataType  : 'json',
      success   : function(data){
        if (data.simpan=="Salah") {
          swal("Mungkin Ada Yang Salah!", {
              icon: "warning",
              buttons: true,
              dangerMode: true,
          });
        }else if(data.keterangan=="Lebih Dari 1"){
          swal("Berilah Alasan, Kenapa Anda Ingin Mencetak Lebih Dari Satu:", {
            content: "input",
          })
          .then((value) => {
            if (value=="") {
              swal(`Data Tidak Boleh Kosong: ${value}`);
            }else{
              $.ajax({
                type      : 'POST',
                url       : window.location.toString()+"/update_cetak_dan_keterangan",
                async     : false,
                data      : "keterangan="+value+"&id="+data.id+"&nokarcis="+data.nokarcis+"&cetak="+data.cetak,
                dataType  : 'json',
                success   : function(subdata){
                  if (subdata=="Salah") {
                    swal(`Data Gagal Disimpan`, {
                      icon: "warning",
                    });
                  }else{
                    swal(`Data Berhasil Disimpan`, {
                      icon: "success",
                    })
                    .then((value) => {
                    var notoken = token_coba();
                    location.href=base_url()+'index.php/dashboard/karcis_umum?csrf_klinik_mata_edc='+notoken+'&id='+data.id;
                    });
                  }
                }
              });
            }
          });
        }else{
            var notoken = token_coba();
            location.href=base_url()+'index.php/dashboard/karcis_umum?csrf_klinik_mata_edc='+notoken+'&id='+data.id;
        }
      }
    });
  });
  $("#btn_cetak_karcis").click(function(){
    var nodaftar = $("#nodaftar_pembayar_k").val();
    $.ajax({
      type      : 'POST',
      url       : window.location.toString()+"/cetak_karcis",
      async     : false,
      data      : "nodaftar="+nodaftar,
      dataType  : 'json',
      success   : function(data){
        if (data.simpan=="Salah") {
          swal("Mungkin Ada Yang Salah!", {
              icon: "warning",
              buttons: true,
              dangerMode: true,
          });
        }else if(data.keterangan=="Lebih Dari 1"){
          swal("Berilah Alasan, Kenapa Anda Ingin Mencetak Lebih Dari Satu:", {
            content: "input",
          })
          .then((value) => {
            if (value=="") {
              swal(`Data Tidak Boleh Kosong: ${value}`);
            }else{
              $.ajax({
                type      : 'POST',
                url       : window.location.toString()+"/update_cetak_dan_keterangan",
                async     : false,
                data      : "keterangan="+value+"&id="+data.id+"&nokarcis="+data.nokarcis+"&cetak="+data.cetak,
                dataType  : 'json',
                success   : function(subdata){
                  if (subdata=="Salah") {
                    swal(`Data Gagal Disimpan`, {
                      icon: "warning",
                    });
                  }else{
                    swal(`Data Berhasil Disimpan`, {
                      icon: "success",
                    })
                    .then((value) => {
                      location.href=window.location.toString()+'/pdf_umum?id='+data.id;
                    });
                  }
                }
              });
            }
          });
        }else{
          location.href=window.location.toString()+'/pdf_umum?id='+data.id;
        }
      }
    });
  });
  $("#btn_cetak_karcis_bpjs").click(function(){
    var nodaftar = $("#nodaftar_pembayar_k").val();
    $.ajax({
      type      : 'POST',
      url       : window.location.toString()+"/cetak_karcis",
      async     : false,
      data      : "nodaftar="+nodaftar,
      dataType  : 'json',
      success   : function(data){
        if (data.simpan=="Salah") {
          swal("Mungkin Ada Yang Salah!", {
              icon: "warning",
              buttons: true,
              dangerMode: true,
          });
        }else if(data.keterangan=="Lebih Dari 1"){
          swal("Berilah Alasan, Kenapa Anda Ingin Mencetak Lebih Dari Satu:", {
            content: "input",
          })
          .then((value) => {
            if (value=="") {
              swal(`Data Tidak Boleh Kosong: ${value}`);
            }else{
              $.ajax({
                type      : 'POST',
                url       : window.location.toString()+"/update_cetak_dan_keterangan",
                async     : false,
                data      : "keterangan="+value+"&id="+data.id+"&nokarcis="+data.nokarcis+"&cetak="+data.cetak,
                dataType  : 'json',
                success   : function(subdata){
                  if (subdata=="Salah") {
                    swal(`Data Gagal Disimpan`, {
                      icon: "warning",
                    });
                  }else{
                    swal(`Data Berhasil Disimpan`, {
                      icon: "success",
                    })
                    .then((value) => {
                      location.href=window.location.toString()+'/pdf_bpjs?id='+data.id;
                    });
                  }
                }
              });
            }
          });
        }else{
          location.href=window.location.toString()+'/pdf_bpjs?id='+data.id;
        }
      }
    });
  });
  $("#btn_cetak_resep").click(function(){
    var nodaftar = $("#nodaftar_proses_tindakan").val();
    $.ajax({
      type      : 'POST',
      url       : base_url()+'index.php/dashboard/cetak_resep',
      async     : false,
      data      : "id="+nodaftar,
      dataType  : 'json',
      success   : function(data){
        location.href=window.location.toString()+'/cetak_resep_pdf?id='+data.id;
      }
    });
  });
  $("#btn_cetak_rincian").click(function(){
    var nodaftar  = $("#nodaftar_proses_tindakan").val();
    var notoken   = token_coba();
    var pot_nodaftar = nodaftar.substr(3);
    location.href=base_url()+'index.php/dashboard/cetak_rincian?csrf_klinik_mata_edc='+notoken+'&nodaftar='+pot_nodaftar;
  });
  $("#btn_cetak_rincian_total_sub").click(function(){
    var nodaftar  = $("#nodaftar_proses_tindakan").val();
    var notoken   = token_coba();
    var pot_nodaftar = nodaftar.substr(3);
    location.href=base_url()+'index.php/dashboard/cetak_rincian_total_persub?csrf_klinik_mata_edc='+notoken+'&nodaftar='+pot_nodaftar;
  });
  $("#btn_cetak_rincian_umum").click(function(){
    var nodaftar        = $("#nodaftar_proses_tindakan").val();
    var notoken         = token_coba();
    var pot_nodaftar    = nodaftar.substr(3);
    location.href=base_url()+'index.php/dashboard/cetak_rincian_umum?csrf_klinik_mata_edc='+notoken+'&nodaftar='+pot_nodaftar;
  });
  $("#btn_cetak_rincian_manual_umum").click(function(){
    var nodaftar        = $("#nodaftar_proses_tindakan").val();
    var notoken         = token_coba();
    var pot_nodaftar    = nodaftar.substr(3);
    location.href=base_url()+'index.php/dashboard/cetak_rincian_manual_umum?csrf_klinik_mata_edc='+notoken+'&nodaftar='+pot_nodaftar;
  });

  $('#btn_cetak_uji_kwitansi_umum').on('click', function(){
    var nodaftar = $("#nodaftar_bayar_tindakan").val();
    $.ajax({
      type      : 'POST',
      url       : base_url()+'index.php/dashboard/cetak_kwitansi',
      async     : false,
      data      : "nodaftar="+nodaftar,
      dataType  : 'json',
      success   : function(data){
        if (data.simpan=="Salah") {
          swal("Mungkin Ada Yang Salah!", {
            icon: "warning",
            buttons: true,
            dangerMode: true,
          });
        }else if(data.keterangan=="Lebih Dari 1"){
          swal("Berilah Alasan, Kenapa Anda Ingin Mencetak Lebih Dari Satu:", {
            content: "input",
          })
          .then((value) => {
            if (value=="") {
              swal("Data Tidak Boleh Kosong!", {
                icon: "warning",
                buttons: true,
                dangerMode: true,
              })
            }else{
              $.ajax({
                type      : 'POST',
                url       : base_url()+'index.php/dashboard/update_cetak_dan_keterangan',
                async     : false,
                data      : "keterangan="+value+"&id="+data.id+"&nokarcis="+data.nokarcis+"&cetak="+data.cetak,
                dataType  : 'json',
                success   : function(subdata){
                  if (subdata=="Salah") {
                     swal(`Data Gagal Disimpan`, {
                      icon: "warning",
                     });
                  }else{
                    swal(`Data Berhasil Disimpan`, {
                          icon: "success",
                    })
                    .then((value) => {
                        var notoken = token_coba();
                        location.href=base_url()+'index.php/dashboard/kwitansi_ujicoba_umum?csrf_klinik_mata_edc='+notoken+'&id='+data.id;
                    });
                   }
                 }
              });
            } 
          });
        }else{
            var notoken = token_coba();
            location.href=base_url()+'index.php/dashboard/kwitansi_ujicoba_umum?csrf_klinik_mata_edc='+notoken+'&id='+data.id;
        }
      }
    });
  });
  $("#btn_cetak_kwitansi").click(function(){
    var nodaftar = $("#nodaftar_bayar_tindakan").val();
    $.ajax({
      type      : 'POST',
      url       : base_url()+'index.php/dashboard/cetak_kwitansi',
      async     : false,
      data      : "nodaftar="+nodaftar,
      dataType  : 'json',
      success   : function(data){
        if (data.simpan=="Salah") {
          swal("Mungkin Ada Yang Salah!", {
            icon: "warning",
            buttons: true,
            dangerMode: true,
          });
        }else if(data.keterangan=="Lebih Dari 1"){
          swal("Berilah Alasan, Kenapa Anda Ingin Mencetak Lebih Dari Satu:", {
            content: "input",
          })
          .then((value) => {
            if (value=="") {
              swal("Data Tidak Boleh Kosong!", {
                icon: "warning",
                buttons: true,
                dangerMode: true,
              })
            }else{
              $.ajax({
                type      : 'POST',
                url       : base_url()+'index.php/dashboard/update_cetak_dan_keterangan',
                async     : false,
                data      : "keterangan="+value+"&id="+data.id+"&nokarcis="+data.nokarcis+"&cetak="+data.cetak,
                dataType  : 'json',
                success   : function(subdata){
                  if (subdata=="Salah") {
                     swal(`Data Gagal Disimpan`, {
                      icon: "warning",
                     });
                  }else{
                    swal(`Data Berhasil Disimpan`, {
                          icon: "success",
                    })
                    .then((value) => {
                      location.href=base_url()+'index.php/dashboard/kwitansi_pdf_umum?id='+data.id;
                    });
                   }
                 }
              });
            } 
          });
        }else{
             location.href=base_url()+'index.php/dashboard/kwitansi_pdf_umum?id='+data.id;
        }
      }
    });
  });
  $("#btn_cetak_kwitansi_bpjs").click(function(){
    var nodaftar = $("#nodaftar_bayar_tindakan").val();
    $.ajax({
      type      : 'POST',
      url       : base_url()+'index.php/dashboard/cetak_kwitansi',
      async     : false,
      data      : "nodaftar="+nodaftar,
      dataType  : 'json',
      success   : function(data){
        if (data.simpan=="Salah") {
          swal("Mungkin Ada Yang Salah!", {
            icon: "warning",
            buttons: true,
            dangerMode: true,
          });
        }else if(data.keterangan=="Lebih Dari 1"){
          swal("Berilah Alasan, Kenapa Anda Ingin Mencetak Lebih Dari Satu:", {
            content: "input",
          })
          .then((value) => {
            if (value=="") {
              swal("Data Tidak Boleh Kosong!", {
                icon: "warning",
                buttons: true,
                dangerMode: true,
              })
            }else{
              $.ajax({
                type      : 'POST',
                url       : window.location.toString()+"/update_cetak_dan_keterangan",
                async     : false,
                data      : "keterangan="+value+"&id="+data.id+"&nokarcis="+data.nokarcis+"&cetak="+data.cetak,
                dataType  : 'json',
                success   : function(subdata){
                  if (subdata=="Salah") {
                     swal(`Data Gagal Disimpan`, {
                      icon: "warning",
                     });
                  }else{
                    swal(`Data Berhasil Disimpan`, {
                          icon: "success",
                    })
                    .then((value) => {
                      location.href=window.location.toString()+'/kwitansi_pdf_bpjs?id='+data.id;
                    });
                   }
                 }
              });
            } 
          });
        }else{
             location.href=window.location.toString()+'/kwitansi_pdf_bpjs?id='+data.id;
        }
      }
    });
  });
  $("#btn_simpan_tindakan_obat").click(function(){
    token_data(4);
  });
  $("#tbl_input_obat_baru tbody").on('click', '#btn_edit_input_obat', function(){
    var id      = $(this).val();
    var $kolom1 = $(this).parents("tr").find("td:nth-child(1)").text();
    var $kolom4 = $(this).parents("tr").find("td:nth-child(4)").text();
    var $kolom5 = $(this).parents("tr").find("td:nth-child(5)").text();
    var $kolom7 = $(this).parents("tr").find("td:nth-child(7)").text();
    $("#id_proses_tindakan").val(id);
    $("#Keterangan").val($kolom4);
    $("#qty").val($kolom5);
    $("#idobat").val($kolom7).trigger("change");
  });
  $("#tbl_input_obat_baru tbody").on('click', '#btn_hapus_tindakan_obat', function(){
    var id      = $(this).val();
    var row     = $(this).parents("tr");
    var $kolom5 = $(this).parents("tr").find("td:nth-child(5)").text();
    var $kolom7 = $(this).parents("tr").find("td:nth-child(7)").text();
    swal({
      title: "Apakah Anda Yakin?",
      text: "Anda Akan menghapus data tindakan!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          type      : 'POST',
          url       : base_url()+'index.php/dashboard/hapus_obat_pasien',
          async     : false,
          data      : "id_jualobat="+id+"&id_produk="+$kolom7+"&qty="+$kolom5,
          dataType  : 'json',
          success   : function(obat){
            if (obat=="Benar") {
                swal("Poof! Your imaginary file has been deleted!", {
                  icon: "success",
                });
                row.remove();
              }else{
                swal("Your imaginary file is safe!");
              }
          }
        });
      } else {
        swal("Your imaginary file is safe!");
      }
    });
  });
  $("#btn_simpan_tindakan_pelayanan").click(function(){
    token_data(3);
  });
  $("#tbl_input_tindakan_baru tbody").on('click', '#btn_hapus_s_tindakan', function(){
    var id    = $(this).val();
    var row   = $(this).parents("tr");
    swal({
      title: "Apakah Anda Yakin?",
      text: "Anda Akan  menghapus data tindakan pasien!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
    if (willDelete) {
      $.ajax({
        type      : 'POST',
        url       : window.location.toString()+'/hapus_list_tindakan_pasien',
        async     : false,
        data      : 'id_tindakan='+id,
        dataType  : 'json',
        success   : function(delete_id){
          if (delete_id=="Benar") {
            swal("Poof! Your imaginary file has been deleted!", {
              icon: "success",
            });
            row.remove();
          }else{
            swal("Your imaginary file is safe!");
          }
        }
      });
    } else {
      swal("Your imaginary file is safe!");
    }
  });
  });
  $("#tbl_input_tindakan_baru tbody").on('click', '#btn_edit_input_tindakan', function(){
    var id = $(this).val();
    var $kolom1     = $(this).parents("tr").find("td:nth-child(1)").text();
    var $kolom4     = $(this).parents("tr").find("td:nth-child(4)").text();
    var $kolom5     = $(this).parents("tr").find("td:nth-child(5)").text();
    var $kolom7     = $(this).parents("tr").find("td:nth-child(7)").text();
    var id_tindakan = $kolom7;
    $("#id_proses_tindakan").val(id);
    $("#idtindakan").val($kolom7).trigger("change");
    $("#Keterangan").val($kolom4);
    $("#qty").val($kolom5);
  });
  $("#jumlah_yang_dibayar").on('keyup', function(){
    var tagihan         = $("#jumlah_tagihan").val();
    var bayar           = $("#jumlah_yang_dibayar").val();
    var tot_hasil_bayar = parseInt(bayar)-parseInt(tagihan);
    var jumlah_dibayar  = $("#jumlah_yang_dibayar").val();
    if (jumlah_dibayar==0 || jumlah_dibayar=='') {
      kembali = 0;
    }else{
      kembali = tot_hasil_bayar;
    }
    $("#uang_kembalian").val(kembali);
  });
  $("#checkbox_gratiskan_obat").on('change', function(){
    if ($(this).is(':checked')) {
      $("#jumlah_tagihan_obat").val(0);
      $("#checkbox_gratiskan_obat").val(1);
      var biaya_op = $("#biaya_operasi_bt").val();
      var biaya_rj = $("#biaya_bukan_operasi_bt").val();
      var biaya_ob = $("#jumlah_tagihan_obat").val();
      var sewa     = $('#jumlah_sewa').val();
      var optik    = $("#jumlah_hrg_optik").val();
      if (sewa=='') {
        var jum_sewa_mobil = 0;
      }else{
        var jum_sewa_mobil = sewa;
      }
      var tagihan  = parseInt(biaya_op)+parseInt(biaya_rj)+parseInt(biaya_ob)+parseInt(jum_sewa_mobil)+parseInt(optik);
      var diskon   = $("#diskon_bt").val();
      $("#jumlah_tagihan").val(tagihan);
    }else{
      $("#jumlah_tagihan_obat").val($("#hrg_obt").html());
      $("#checkbox_gratiskan_obat").val(0);
      var biaya_op = $("#biaya_operasi_bt").val();
      var biaya_rj = $("#biaya_bukan_operasi_bt").val();
      var biaya_ob = $("#jumlah_tagihan_obat").val();
      var sewa     = $('#jumlah_sewa').val();
      var optik    = $("#jumlah_hrg_optik").val();
      if (sewa=='') {
        var jum_sewa_mobil = 0;
      }else{
        var jum_sewa_mobil = sewa;
      }
      var tagihan  = parseInt(biaya_op)+parseInt(biaya_rj)+parseInt(biaya_ob)+parseInt(jum_sewa_mobil)+parseInt(optik);
      var diskon   = $("#diskon_bt").val();
      $("#jumlah_tagihan").val(tagihan);
    }
    pembulatan();
  });
  $("#diskon_bt").on('keyup', function(){
    var biaya_op = parseInt($("#harga_awal_bt").html());
    var biaya_rj = $("#biaya_bukan_operasi_bt").val();
    var biaya_ob = $("#jumlah_tagihan_obat").val();
    var sewa     = $('#jumlah_sewa').val();
    var optik    = $("#jumlah_hrg_optik").val();
      if (sewa=='') {
        var jum_sewa_mobil = 0;
      }else{
        var jum_sewa_mobil = sewa;
      }
    var tagihan  = parseInt(biaya_op)+parseInt(biaya_rj)+parseInt(biaya_ob)+parseInt(jum_sewa_mobil)+parseInt(optik);
    var diskon   = $("#diskon_bt").val();
    var mencari_harga_persen;
    var tot_tagihan_bt;
    var pengurangan;
    if (diskon==0 || diskon=='') {
      $("#biaya_operasi_bt").val(biaya_op);
      $("#jumlah_tagihan").val(tagihan);
      $("#hasil_diskon_bt").val(diskon);      
    }else if (diskon<=100) {
      mencari_harga_persen  = (parseInt(diskon) * parseInt(biaya_op)/100);
      $("#hasil_diskon_bt").val(mencari_harga_persen);
      pengurangan           = biaya_op-mencari_harga_persen;
      $("#biaya_operasi_bt").val(pengurangan);
      tot_tagihan_bt        = parseInt(pengurangan)+parseInt(biaya_rj)+parseInt(biaya_ob)+parseInt(jum_sewa_mobil)+parseInt(optik);
      $("#jumlah_tagihan").val(tot_tagihan_bt);
    }else if (diskon>100 && diskon<=biaya_op) {
      mencari_harga_persen  = parseInt(biaya_op)-parseInt(diskon);
      $("#hasil_diskon_bt").val(diskon);
      $("#biaya_operasi_bt").val(mencari_harga_persen);
      tot_tagihan_bt        = parseInt(mencari_harga_persen)+parseInt(biaya_rj)+parseInt(biaya_ob)+parseInt(jum_sewa_mobil)+parseInt(optik);
      $("#jumlah_tagihan").val(tot_tagihan_bt);
    }
    else if(diskon>biaya_op){
      $("#diskon_bt").val(0);
      $("#biaya_operasi_bt").val(biaya_op);
      $("#jumlah_tagihan").val(tagihan);
      $("#hasil_diskon_bt").val('');
      $("#jumlah_tagihan").val(biaya_op+parseInt(biaya_rj)+parseInt(biaya_ob)+parseInt(jum_sewa_mobil)+parseInt(optik));
    }else if(diskon<0){
      {
        alert('data tidak boleh kurang dari 0');
      }
    }
    pembulatan();
  });
  function pembulatan(){
    var total_bayar = $('#jumlah_tagihan').val();
    var potong = total_bayar.substr(-2);
    var status_pasien = $("#kepesetaan").html();
    if (status_pasien=='BPJS') {
      var bayar_bulat = total_bayar;
    }else{
      if (potong>00) {
        var bulat = parseInt(total_bayar)-parseInt(potong)+100;
        var bayar_bulat = bulat;
      }else{
        var bayar_bulat = total_bayar;
      }
    }
    $('#jumlah_tagihan').val(bayar_bulat);
  }
  $("#btn_bayar_tindakan").click(function(){
    var tot_tagihan_bayar   = $('#jumlah_tagihan').val();
    var jumlah_dibayar      = $('#jumlah_yang_dibayar').val();
    if (isNaN(tot_tagihan_bayar) || jumlah_yang_dibayar=='') {
      swal("Maaf! Tidak Ada Tagihan Yang Perlu di Bayar!", {
        icon: "error",
      });
    }else{
      token_data(5);
    }
  });
  $("#tabel_karcis_pasien_k tbody").on('click',"#btn_retur_tindakan_karcis", function(){
    var notoken     = token_coba();
    var id_tindakan = $(this).val();
    var $kolom1 = $(this).parents("tr").find("td:nth-child(1)").text();
    var $kolom2 = $(this).parents("tr").find("td:nth-child(2)").text();
    swal({
      title: "Apakah Anda Yakin?",
      text: "Anda Akan Menghapus Daftar Karcis "+$kolom2,
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        swal("Berilah Keterangan Jika Anda Ingin Melakukan Retur:", {
          content: "input",
        })
        .then((value) => {
          $.ajax({
            type      : 'POST',
            url       : base_url()+'index.php/dashboard/update_retur_tindakan_karcis',
            async     : false,
            data      : 'csrf_klinik_mata_edc='+notoken+'&id='+id_tindakan+'&keterangan='+value,
            dataType  : 'json',
            success   : function(retur_tindakan){
              if (retur_tindakan=="Benar") {
                swal("Selamat!", "Data BErhasil di Retur", "success");
                var $kolom4 = $("#nodaftar_k").html();
                get_tindakan_karcis($kolom4);
              }else{
                swal("Mohon Maaf!", "Data Gagal Di Retur!", "warning");
              }
            }
          });
        });
      } else {
        swal("Data Batal Dihapus!");
      }
    });
  });
  $("#tabel_karcis_pasien_k tbody").on('click',"#status_cetak_k", function(){
    var notoken     = token_coba();
    var id_tindakan = $(this).val();
    var $kolom6 = $(this).parents("tr").find("td:nth-child(6)").text();
    if ($(this).is(':checked')) {
        var status = 1;
    }else{
        var status = 0;
    }
    $.ajax({
        type      : 'POST',
        url       : base_url()+'index.php/dashboard/status_cetak_karcis',
        async     : false,
        data      : 'csrf_klinik_mata_edc='+notoken+'&id='+$kolom6+'&status='+status,
        dataType  : 'json',
        success   : function(data){
            console.log(data);
          if (data=="Benar") {
            if (status==1) {
                swal("Data di Cetak", "success");    
            }else{
                swal("Data tidak di Cetak", "warning");
            }
          }else{
            swal("Gagal Proses","warning");
          }
        }
    });
  });
  $("#tabel_karcis_pasien_k tbody").on('click',"#btn_hapus_tindakan_karcis", function(){
    var notoken     = token_coba();
    var id_tindakan = $(this).val();
    var $kolom1 = $(this).parents("tr").find("td:nth-child(1)").text();
    var $kolom2 = $(this).parents("tr").find("td:nth-child(2)").text();
    swal({
      title: "Apakah Anda Yakin?",
      text: "Anda Akan Menghapus Daftar Karcis "+$kolom2,
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
            type      : 'POST',
            url       : base_url()+'index.php/dashboard/hapus_tindakan_karcis',
            async     : false,
            data      : 'csrf_klinik_mata_edc='+notoken+'&id='+id_tindakan,
            dataType  : 'json',
            success   : function(data){
                console.log(data);
              if (data=="Benar") {
                swal("Selamat!", "Data BErhasil di Retur", "success");
                var $kolom4 = $("#nodaftar_k").html();
                get_tindakan_karcis($kolom4);
              }else{
                swal("Mohon Maaf!", "Data Gagal Di Retur!", "warning");
              }
            }
          });
      } else {
        swal("Data Batal Dihapus!");
      }
    });
  });
  //function open camera Qr Code
  $("#scanqr").click(function(){
    open_cam();
  });
  function open_cam(){
    var txt = $("#no_kpst").val("textContent");
        var arg = {
            resultFunction: function(result) {
                txt = $("#no_kpst").val(result.code);
                isi();
            }
        };
    new WebCodeCamJS("canvas").init(arg).play();
  }
  function isi(){
    $("#tutup_modal").click();
  }
  
  function token_coba(ambil_token){
    $.ajax({
      type     : 'POST',
      url      : base_url()+'index.php/dashboard/token',
      async    : false,
      dataType :'json',
      success  : function(tok){
        ambil_token = tok.csrf_hash;
      }
    });
    return ambil_token;
  }


  function kosong_form_bkarcis(){
    $('#diskon_k').val('');
    $('#hasil_diskon_k').val('');
    $('#tarif_admin_k').val('');
    $('#tarif_periksa_k').val('');
    $('#id_biaya_perawatan_k').val('');
    $('#jumlah_tagihan_k').val('');
    $('#jumlah_yang_dibayar_k').val('');
    $('#uang_kembalian_k').val('');
    $('#jenis_pembayaran_k').val('').trigger('change');
  }