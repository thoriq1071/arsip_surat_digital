<!-- Main content -->
<div class="content-wrapper">
  <!-- Content area -->
  <div class="content">
    <!-- Dashboard content -->
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-primary">
          <div class="panel-heading text-left">
            <div class="row">
              <div class="col-sm-6 text-left">
                <i class="icon-printer"></i><b>&nbsp; FILTER DATA LAPORAN SURAT MASUK</b><br>Sistem Informasi Arsip Surat Digital
              </div>
            </div>
          </div>
          <?php
          echo $this->session->flashdata('msg');
          ?>
          <div class="panel-body">
            <br>
            <br>
            <fieldset class="content-group">
              <form class="form-horizontal text-center" action="" method="post">
                <div class="form-group">
                  <label class="control-label col-lg-1 text-right">Tanggal Awal</label>
                  <div class="col-lg-4">
                    <div class="input-group">
                      <div class="input-group-addon"><i class="icon-calendar22"></i></div>
                      <input type="date" name="tgl1" class="form-control daterange-single" value="" maxlength="10" required>
                    </div>
                  </div>

                  <label class="control-label col-lg-1 text-right">Tanggal Akhir</label>
                  <div class="col-lg-4">
                    <div class="input-group">
                      <div class="input-group-addon"><i class="icon-calendar22"></i></div>
                      <input type="date" name="tgl2" class="form-control daterange-single" value="" maxlength="10" required>
                    </div>
                  </div>
                  <button type="submit" name="data_lap" class="btn btn-danger text-right"><span class="glyphicon glyphicon-search"></span>&nbsp;<b> FILTER DATA</b></button>
                </div>
              </form>
            </fieldset>
          </div>
        </div>
      </div>
    </div>
    <!-- /dashboard content -->