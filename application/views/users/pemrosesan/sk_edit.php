<script src="assets/js/select2.min.js"></script>
<script src="assets/js/jquery-ui.js"></script>
<script>
  $(function() {
    $("#tgl_sk").datepicker();
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
                <span class="glyphicon glyphicon-home" aria-hidden="true"></span><b class="">&nbsp; EDIT SURAT KELUAR</b><br>Sistem Informasi Arsip Surat Digital
              </div>
            </div>
          </div>
          <div class="panel-body">
            <fieldset class="content-group">
              <?php
              echo $this->session->flashdata('msg');
              ?>
              <div class="msg"></div>
              <form class="form-horizontal" action="" method="post">
                <div class="form-group">
                  <label class="control-label col-lg-2 text-right">ID Surat Keluar</label>
                  <div class="col-lg-4">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="icon-database"></i></span>
                      <input type="text" name="id_surat" id="id_surat" value="<?php echo $query->id_surat; ?>" class="form-control" readonly>
                    </div>
                  </div>
                  <label class="control-label col-lg-2 text-right">Tanggal Surat</label>
                  <div class="col-lg-4">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="icon-calendar"></i></span>
                      <input type="text" name="tgl_sk" class="form-control daterange-single" id="tgl_sk" value="<?php echo $query->tgl_sk; ?>" maxlength="10" required placeholder="Masukkan Tanggal">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-lg-2 text-right">Nomor Surat</label>
                  <div class="col-lg-4">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="icon-list"></i></span>
                      <input type="text" name="no_surat" id="no_surat" value="<?php echo $query->no_surat; ?>" class="form-control" placeholder="Masukkan Nomor Surat">
                    </div>
                  </div>
                  <label class="control-label col-lg-2 text-right">Status</label>
                  <div class="col-lg-4">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="icon-spinner"></i></span>
                      <select class="form-control" name="status" id="status" required>
                        <option value="<?php echo $query->status; ?>"><?php echo $query->status; ?></option>
                        <option value="">-- Status --</option>
                        <option value="Keluar">Keluar</option>
                        <option value="Arsip">Arsip</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-lg-2 text-right">Perihal/Hal</label>
                  <div class="col-lg-4">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="icon-bookmark"></i></span>
                      <input type="text" name="perihal" id="perihal" value="<?php echo $query->perihal; ?>" class="form-control" placeholder="Masukkan Perihal/Hal">
                    </div>
                  </div>
                  <label class="control-label col-lg-2 text-right">Tujuan</label>
                  <div class="col-lg-4">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="icon-books"></i></span>
                      <input type="text" name="tujuan" id="tujuan" value="<?php echo $query->tujuan; ?>" class="form-control" placeholder="Masukkan Tujuan Lembaga atau Lainnya">
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
                        <th><b>Tanggal Berkas</b></th>
                        <th><b>Ukuran</b></th>
                        <th class="text-center"><b>Aksi</b></th>
                      </tr>
                      <?php
                      $lampiran = $this->db->get_where('tbl_lampiran', "token_lampiran='$query->token_lampiran'");
                      $no = 1;
                      foreach ($lampiran->result() as $baris) { ?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $baris->nama_berkas; ?></td>
                          <td><?php echo $query->tgl_sk; ?></td>
                          <td><?php echo substr($baris->ukuran / 1024, 0, 5); ?> MB</td>
                          <td class="text-center"><a href="lampiran/<?php echo $baris->nama_berkas; ?>" target="_blank" title="<?php echo substr($baris->ukuran / 1024, 0, 5); ?> MB" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-floppy-saved"></span></a></td>
                        </tr>
                      <?php
                        $no++;
                      } ?>
                    </table>
                  </div>
                </div>
                <hr>
                <a href="users/sk" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;<b>KEMBALI</b></a>
                <button type="submit" name="btnupdate" id="submit-all" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-floppy-saved"></span>&nbsp;<b>UPDATE</b></button>
              </form>
            </fieldset>
          </div>
        </div>
      </div>
    </div>
    <!-- /dashboard content -->