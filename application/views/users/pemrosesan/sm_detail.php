<script src="assets/js/select2.min.js"></script>
<script src="assets/js/jquery-ui.js"></script>
<script>
  $(function() {
    $("#tgl_ns").datepicker();
  });
  $(function() {
    $("#tgl_no_asal").datepicker();
  });
</script>
<script type="text/javascript" src="assets/js/core/app.js"></script>
<!-- Main content -->
<div class="content-wrapper">
  <!-- Content area -->
  <div class="content">
    <!-- Dashboard content -->
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading text-left">
            <div class="row">
              <div class="col-sm-6 text-left">
                <span class="glyphicon glyphicon-home" aria-hidden="true"></span><b class="">&nbsp; DETAIL SURAT MASUK</b><br>Sistem Informasi Arsip Surat Digital
              </div>
            </div>
          </div>
          <div class="panel-body">
            <fieldset class="content-group">
              <?php
              echo $this->session->flashdata('msg');
              ?>
              <div class="msg"></div>
              <form class="form-horizontal" action="" enctype="multipart/form-data" method="post">
                <div class="form-group">
                  <label class="control-label col-lg-2 text-right">ID. Surat Masuk</label>
                  <div class="col-lg-4">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="icon-sort"></i></span>
                      <input type="text" name="no_asal" id="no_asal" class="form-control" value="<?php echo $query->no_surat; ?>" placeholder="" required readonly>
                    </div>
                  </div>
                  <label class="control-label col-lg-2 text-right">Tanggal Surat</label>
                  <div class="col-lg-4">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="icon-calendar"></i></span>
                      <input type="text" name="tgl_no_asal" class="form-control daterange-single" id="tgl_no_asal" value="<?php echo $query->tgl_no_asal; ?>" maxlength="10" required placeholder="Masukkan Tanggal" readonly>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-lg-2 text-right">Nomor</label>
                  <div class="col-lg-4">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="icon-list"></i></span>
                      <input type="text" name="pengirim" id="pengirim" class="form-control" value="<?php echo $query->no_asal; ?>" readonly>
                    </div>
                  </div>
                  <label class="control-label col-lg-2 text-right">Instansi Pengirim</label>
                  <div class="col-lg-4">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="icon-home"></i></span>
                      <input type="text" name="penerima" id="penerima" class="form-control" value="<?php echo $query->pengirim; ?>" readonly>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-lg-2 text-right">Perihal</label>
                  <div class="col-lg-4">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="icon-bookmark"></i></span>
                      <input type="text" class="form-control" value="<?php echo $query->perihal; ?>" readonly>
                    </div>
                  </div>
                  <label class="control-label col-lg-2 text-right">Diterima Tanggal</label>
                  <div class="col-lg-4">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="icon-calendar"></i></span>
                      <input type="text" class="form-control" value="<?php echo $query->tgl_sm; ?>" readonly>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-2 text-right">Status</label>
                  <div class="col-lg-4">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="icon-spinner"></i></span>
                      <input type="text" class="form-control" value="<?php echo $query->penerima; ?>" readonly>
                    </div>
                  </div>
                  <label class="control-label col-lg-2 text-right">Disposisi</label>
                  <div class="col-lg-4">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="icon-users"></i></span>
                      <input type="text" class="form-control" value="<?php echo $query->disposisi; ?>" readonly>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-lg-3"><b>Lampiran</b></label>
                  <div class="col-lg-12">
                    <table class="table table-xs table-bordered">
                      <tr>
                        <th width='5%'><b>No.</b></th>
                        <th><b>Nama Berkas</b></th>
                        <th width='15%'><b>Tanggal Berkas</b></th>
                        <th width='10%'><b>Ukuran</b></th>
                        <th width='5%' td class="text-center"><b>Aksi</b></th>
                      </tr>
                      <?php
                      $lampiran = $this->db->get_where('tbl_lampiran', "token_lampiran='$query->token_lampiran'");
                      $no = 1;
                      foreach ($lampiran->result() as $baris) { ?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $baris->nama_berkas; ?></td>
                          <td><?php echo $query->tgl_sm; ?></td>
                          <td><?php echo substr($baris->ukuran / 1024, 0, 5); ?> MB</td>
                          <td td class="text-center"><a href="lampiran/surat_masuk/<?php echo $baris->nama_berkas; ?>" target="_blank" title="<?php echo substr($baris->ukuran / 1024, 0, 5); ?> MB" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-floppy-saved"></span></a></td>
                        </tr>
                      <?php
                        $no++;
                      } ?>
                    </table>
                  </div>
                </div>

                <hr>
                <a href="users/sm" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;<b> KEMBALI</b></a>
                <?php if ($user->row()->level == 'admin') { ?>
                  <a href="users/sm/e/<?php echo $query->id_sm; ?>" class="btn btn-xs btn-success"><i class="icon-pencil7"></i>&nbsp;<b> EDIT DATA</b></a>
                <?php } ?>
              </form>

            </fieldset>


          </div>

        </div>
      </div>
    </div>
    <!-- /dashboard content -->