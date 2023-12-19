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
                <span class="glyphicon glyphicon-home" aria-hidden="true"></span><b class="">&nbsp; EDIT TENAGA PENDIDIK & KEPENDIDIKAN</b><br>Sistem Informasi Arsip Surat Digital
              </div>
            </div>
          </div>
          <div class="panel-body">
            <fieldset class="content-group">
              <?php
              echo $this->session->flashdata('msg');
              ?>
              <form class="form-horizontal" action="" method="post">
                <div class="form-group">
                  <label class="control-label col-lg-3">Nama Lengap</label>
                  <div class="col-lg-9">
                    <input type="text" name="nama_bagian" class="form-control" value="<?php echo $query->nama_bagian; ?>" required>
                  </div>
                </div>
                <a href="users/bagian" class="btn btn-danger"><span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;<b>KEMBALI</b></a>
                <button type="submit" name="btnupdate" class="btn btn-success"><span class="glyphicon glyphicon-floppy-saved"></span>&nbsp;<b>UPDATE</b></button>
              </form>
            </fieldset>
          </div>
        </div>
      </div>
    </div>
    <!-- /dashboard content -->