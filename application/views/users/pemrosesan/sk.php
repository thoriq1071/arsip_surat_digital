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
                  <a href="users/sk/t" class="btn btn-xs btn-success" style="margin-top: 5px;"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span><b>&nbsp; TAMBAH DATA</b></a>
                <?php
                } ?>
              </div>
            </div>
          </div>

          <div class="panel-body" style="margin-top: -20px;">
            <table class="table table-xs table-hover table-striped table-bordered datatable-basic">
              <thead>
                <tr>
                  <th width="30px;">No.</th>
                  <th>No. Surat</th>
                  <th>Tanggal</th>
                  <th>Instansi</th>
                  <th>Perihal</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($sk->result() as $baris) {
                ?>
                  <tr <?php if ($baris->peringatan == 1) {
                        echo 'style="background:yellow;"';
                      } ?>>
                    <td><?php echo $no . '.'; ?></td>
                    <td><?php echo $baris->no_surat; ?></td>
                    <td><?php echo $baris->tgl_sk; ?></td>
                    <td><?php echo $baris->tujuan; ?></td>
                    <td><?php echo $baris->perihal; ?></td>
                    <td class="text-center">
                      <a href="users/sk/d/<?php echo $baris->id_sk; ?>" class="btn btn-default btn-xs"><i class="icon-books"></i>&nbsp; <b>DETAIL</b></a>
                      <?php
                      if ($user->row()->level == 'admin') { ?>
                        <a href="users/sk/e/<?php echo $baris->id_sk; ?>" class="btn btn-primary btn-xs"><i class="icon-pencil7"></i></a>
                        <a href="users/sk/h/<?php echo $baris->id_sk; ?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah Anda yakin?')"><i class="icon-trash"></i></a>
                      <?php
                      } ?>
                    </td>
                  </tr>
                <?php
                  $no++;
                } ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- /basic datatable -->
      </div>
    </div>
    <!-- /dashboard content -->