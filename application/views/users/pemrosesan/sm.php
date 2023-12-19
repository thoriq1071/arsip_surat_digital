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
                <span class="glyphicon glyphicon-home" aria-hidden="true"></span><b class="">&nbsp; DAFTAR SURAT MASUK</b><br>Sistem Informasi Arsip Surat Digital
              </div>
              <div class="col-md-6 text-right">
                <?php
                if ($user->row()->level == 'admin') { ?>
                  <a href="users/sm/t" class="btn btn-xs btn-success" style="margin-top: 5px;"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span><b>&nbsp; TAMBAH DATA</b></a>
                <?php
                } ?>
              </div>
            </div>
          </div>
          <div class="panel-body" style="margin-top: -20px;">
            <table class="table table-xs table-hover table-striped table-bordered datatable-basic">
              <thead>
                <tr class="bg-info">
                  <th width="20">No.</th>
                  <th>Tgl Diterima</th>
                  <th>Instansi</th>
                  <th>Perihal</th>
                  <th>Status</th>
                  <th>Disposisi</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($sm->result() as $baris) {
                ?>
                  <tr>
                    <td class="text-center"><?php echo $no . '.'; ?></td>
                    <td><?php echo $baris->tgl_sm; ?></td>
                    <td><?php echo $baris->pengirim; ?></td>
                    <td><?php echo $baris->perihal; ?></td>
                    <td class="text-uppercase">
                      <?php
                      if ($baris->penerima == "TL") { ?>
                        <span class="badge badge-pill badge-success"><?php echo $baris->penerima; ?></span>
                      <?php  } else { ?>
                        <span class="badge badge-pill badge-danger"><?php echo $baris->penerima; ?></span>
                      <?php } ?>
                    </td>
                    <td><?php echo $baris->disposisi; ?></td>
                    <td class="text-center">
                      <a href="users/sm/d/<?php echo $baris->id_sm; ?>" class="btn btn-default btn-xs"><i class="icon-books"></i>&nbsp; <b>DETAIL</b></a>
                      <?php
                      if ($user->row()->level == 'admin') { ?>
                        <a href="users/sm/e/<?php echo $baris->id_sm; ?>" class="btn btn-xs btn-primary"><i class="icon-pencil7"></i></a>
                        <a href="users/sm/h/<?php echo $baris->id_sm; ?>" class="btn btn-xs btn-danger" onclick="return confirm('Apakah Anda yakin?')"><i class="icon-trash"></i></a>
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