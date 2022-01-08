<section class="content-header">
    <h1>
        Surat Eligibilitas Peserta
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> SEP</a></li>
        <li class="active">Home</li>
    </ol>
</section>

<section class="content" id="tabel_pasien_hari_ini">
	<div class="row">
		<div class="col-xs-12">
      		<div class="box">
      			<div class="box-header with-border">
			        <button class="btn btn-primary btn-flat" id="btn_cetak_sep"><i class="fa fa-fw fa-print"></i> Cetak SEP</button>
			        <button class="btn btn-primary btn-flat" id="btn_cetak_sep_pdf"><i class="fa fa-fw fa-print"></i> Cetak SEP PDF</button>
			        <!-- <button class="btn btn-info btn-flat" id="btn_daftar_pasien"><i class="fa fa-fw fa-plus"></i> Ambil Rujukan Pasien</button> -->
			        <!-- <button class="btn btn-danger btn-flat" id="btn_input_retur"><i class="fa fa-fw fa-rotate-right (alias)"></i> Retur</button> -->
			        <div class="box-tools pull-right">
			          	<button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
			          	<button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
			        </div>
			    </div>
			    <div class="box-body">
			    	<table border="1" style="width: 100%">
			    		<tr>
			    			<td style="width: 20%" rowspan="2">
			    				<img src="<?php echo base_url();?>assets/dist/img/logo-bpjs.png" style="width: 200px; ">
			    			</td>
			    			<td style="width: 80%"><center><b>SURAT ELEGIBILITAS PESERTA</b></center></td>
			    		</tr>
			    		<tr>
			    			<td style="width: 80%"><center><b>NAMA OUTLET</b></center></td>
			    		</tr>
			    	</table>
			    	<table border="1" style="width: 100%">
			    		<tr>
			    			<td style="width: 15%">No. SEP</td>
			    			<td style="width: 50%"> : </td>
			    		</tr>
			    		<tr>
			    			<td style="width: 15%">Tgl. SEP</td>
			    			<td> : </td>
			    		</tr>
			    		<tr>
			    			<td>No Kartu</td>
			    			<td> : </td>
			    			<td style="width: 10%">Peserta</td>
			    			<td> : </td>
			    		</tr>
			    		<tr>
			    			<td>Nama Peserta</td>
			    			<td> : </td>
			    		</tr>
			    		<tr>
			    			<td>Tgl. Lahir</td>
			    			<td> : </td>
			    			<td style="width: 10%">COB</td>
			    			<td> : </td>
			    		</tr>
			    		<tr>
			    			<td>Jns. Kelamin</td>
			    			<td> : </td>
			    			<td style="width: 10%">Jns. Rawat</td>
			    			<td> : </td>
			    		</tr>
			    		<tr>
			    			<td>Poli Tujuan</td>
			    			<td> : </td>
			    			<td style="width: 10%">Kls. Rawat</td>
			    			<td> : </td>
			    		</tr>
			    		<tr>
			    			<td>Asal Faskes Tk. I</td>
			    			<td> : </td>
			    		</tr>
			    	</table>
			    	<table border="1" style="width: 100%">
			    		<tr>
			    			<td style="width: 15%">Diagnosa Awal</td>
			    			<td style="width: 55%"> : </td>
			    			<td style="width: 9%; word-wrap: break-word;" rowspan="2">Pasien/ Keluarga Pasien</td>
			    			<td style="width: 2%;" rowspan="2"></td>
			    			<td style="width: 9%; word-wrap: break-word;" rowspan="2">Petugas BPJS Kesehatan</td>
			    			<td style="width: 10%;" rowspan="2"></td>
			    		</tr>
			    		<tr>
			    			<td style="width: 14%">Catatan</td>
			    			<td style="width: 50%"> : </td>
			    		</tr>
			    	</table>
			    	<table border="1" style="width: 100%">
			    		<tr>
			    			<td style="width: 70%"><i><font size="2">*Saya Menyetujui BPJS Kesehatan menggunakan informasi Medis Pasien jika diperlukan</font></i></td>
			    		</tr>
			    		<tr>
			    			<td style="width: 70%"><i><font size="2">*SEP bukan sebagai bukti penjamin peserta</font></i></td>
			    			<td style="width: 9%;">_____________</td>
			    			<td style="width: 2%;"></td>
			    			<td style="width: 9%;">_____________</td>
			    			<td style="width: 10%;"></td>
			    		</tr>
			    	</table>
			    </div>
      		</div>
      	</div>
	</div>
</section>

<script type="text/javascript">
	$('#btn_cetak_sep_pdf').click(function(){
		cetak_pdf();
	});
	function cetak_pdf(){
		var notoken 	= token_coba();
		var no_sep   = getUrlVars("no_sep");
		// var url = base_url()+'index.php/bpjs_api/Lihat_sep/cetak_sep_pdf?csrf_klinik_mata_edc='+notoken+'&no_sep='+nosep;
		var url = base_url()+'index.php/bpjs_api/Lihat_sep/cetak_sep_pdf?csrf_klinik_mata_edc='+notoken+'&no_sep='+no_sep;
    	window.open(url);
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
function getUrlVars(param=null)
  {
    if(param !== null)
    {
      var vars = [], hash;
      var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
      for(var i = 0; i < hashes.length; i++)
      {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
      }
      return vars[param];
    } 
    else 
    {
      return null;
    }
  }
</script>