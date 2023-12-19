<!-- Main content -->
<div class="content-wrapper">
  <!-- Content area -->
  <div class="content">
    <?php
    echo $this->session->flashdata('msg');
    ?>
    <!-- Dashboard content -->
    <div class="row">
      <div class="col-md-12">
        <!-- Basic datatable -->
        <div class="panel panel-default">
          <div class="panel-heading text-left">
            <div class="row">
              <div class="col-sm-6 text-left">
                <span class="glyphicon glyphicon-home" aria-hidden="true"></span><b class="">&nbsp; DAFTAR SURAT KELUAR</b><br>Sistem Informasi Arsip Surat Digital
              </div>
              <div class="col-md-6 text-right">
                <?php
                if ($user->row()->level == 'admin') { ?>
                  <form action="" method="post" target="_blank">
                    <button type="submit" name="btncetak" class="btn btn-xs btn-success" style="margin-top: 7px;"><span class="glyphicon glyphicon-random" aria-hidden="true"></span><b>&nbsp; CETAK LAPORAN</b></button>
                  </form>
                <?php
                } ?>
              </div>
            </div>
          </div>
          <div class="panel-body" style="margin-top: -20px;">

            <table class="table table-xs table-hover table-striped table-bordered datatable-basic">
              <thead>
                <tr>
                  <th width="1%">No</th>
                  <th>No. Surat</th>
                  <th>Taggal</th>
                  <th>Instansi</th>
                  <th>Perihal</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($sql->result() as $baris) {
                ?>
                  <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $baris->no_surat; ?></td>
                    <td><?php echo $baris->tgl_sk; ?></td>
                    <td><?php echo $baris->tujuan; ?></td>
                    <td><?php echo $baris->perihal; ?></td>
                  </tr>
                <?php
                  $no++;
                } ?>
              </tbody>
            </table>
          </div>
          <!-- /basic datatable -->
        </div>
      </div>
    </div>
    <!-- /dashboard content -->