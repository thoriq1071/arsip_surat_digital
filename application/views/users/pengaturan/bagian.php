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
                <span class="glyphicon glyphicon-home" aria-hidden="true"></span><b class="">&nbsp; DAFTAR TENAGA PENDIDIK & KEPENDIDIKAN</b><br>Sistem Informasi Arsip Surat Digital
              </div>
              <div class="col-md-6 text-right">
                <?php
                if ($user->row()->level == 'admin') { ?>
                  <a href="users/bagian/t" class="btn btn-xs btn-success" style="margin-top: 5px;"><span class="glyphicon glyphicon-user" aria-hidden="true"></span><b>&nbsp;&nbsp;TAMBAH DATA GURU</b></a>
                <?php
                } ?>
              </div>
            </div>
          </div>

          <div class="panel-body" style="margin-top: -20px;">
            <table class="table table-xs table-hover table-striped table-bordered datatable-basic">
              <thead>
                <tr>
                  <th width="5%">No.</th>
                  <th>Nama Tenaga Pendidik dan Kependidikan</th>
                  <?php
                  if ($user->row()->level == 'admin') { ?>
                    <th class="text-center" width="170"> Aksi</th>
                  <?php
                  } ?>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($bagian->result() as $baris) {
                ?>
                  <tr>
                    <td><?php echo $no . '.'; ?></td>
                    <td><?php echo $baris->nama_bagian; ?></td>
                    <?php
                    if ($user->row()->level == 'admin') { ?>
                      <td class="text-center">
                        <a href="users/bagian/e/<?php echo $baris->id_bagian; ?>" class="btn btn-xs btn-primary"><i class="icon-pencil7"></i></a>
                        <a href="users/bagian/h/<?php echo $baris->id_bagian; ?>" class="btn btn-xs btn-danger" onclick="return confirm('Apakah Anda yakin?')"><i class="icon-trash"></i></a>
                      </td>
                    <?php
                    } ?>
                  </tr>
                <?php
                  $no++;
                } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- /basic datatable -->
    </div>
    <!-- /dashboard content -->