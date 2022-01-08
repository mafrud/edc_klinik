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
        <button class="btn btn-primary btn-flat" id="btn_riwayat_pasien"><i class="fa fa-fw fa-list-alt"></i> Riwayat Pasien</button>
        <button class="btn btn-info btn-flat" id="btn_daftar_pasien"><i class="fa fa-fw fa-plus"></i> Ambil Rujukan Pasien</button>
        <!-- <button class="btn btn-danger btn-flat" id="btn_input_retur"><i class="fa fa-fw fa-rotate-right (alias)"></i> Retur</button> -->
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
          <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
        <div class="box-header">
          <h3 class="box-title">Daftar Pasien Hari ini</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th width="10%">No.</th>
                <th>Tgl Daftar</th>
                <th>No RM</th>
                <th hidden>No RM</th>
                <th>No Daftar</th>
                <th hidden>No Daftar</th>
                <th>Nama Pasien</th>
                <th>JK</th>
                <th>No Rujukan</th>
                <th>No Kartu</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody id="daftar_pasien_bpjs_hari_ini">
              
            </tbody>
            <tfoot>
              <tr>
                <th width="10%">No.</th>
                <th>Tgl Daftar</th>
                <th>No RM</th>
                <th hidden>No RM</th>
                <th>No Daftar</th>
                <th hidden>No Daftar</th>
                <th>Nama Pasien</th>
                <th>JK</th>
                <th>No Rujukan</th>
                <th>No Kartu</th>
                <th>Aksi</th>
              </tr>
            </tfoot>
          </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="<?=base_url('assets/_controller/bridging_bpjs/data_pasien.js')?>"></script>