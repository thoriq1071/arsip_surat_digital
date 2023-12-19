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
                <span class="glyphicon glyphicon-home" aria-hidden="true"></span><b class="">&nbsp; DAFTAR PENGGUNA</b><br>Sistem Informasi Arsip Surat Digital
              </div>
              <div class="col-md-6 text-right">
                <?php
                if ($user->row()->level == 's_admin') { ?>
                  <a href="users/pengguna/t" class="btn btn-xs btn-success" style="margin-top: 5px;"><span class="glyphicon glyphicon-random" aria-hidden="true"></span><b>&nbsp; TAMBAH PENGGUNA</b></a>
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
                  <th>Nama Pengguna</th>
                  <th>Nama Lengkap</th>
                  <th>Email</th>
                  <th>Level</th>
                  <th>Tgl Daftar</th>
                  <th>Login Terakhir</th>
                  <th class="text-center" width="140px">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($level_users->result() as $baris) {
                ?>
                  <tr>
                    <td class="text-center"><?php echo $no . '.'; ?></td>
                    <td><?php echo $baris->username; ?></td>
                    <td><?php echo $baris->nama_lengkap; ?></td>
                    <td><?php echo $baris->email; ?></td>
                    <td><?php if ($baris->level == "s_admin") {
                          echo "Super Admin";
                        } else {
                          echo ucwords($baris->level);
                        } ?></td>
                    <td><?php if ($baris->tgl_daftar == "") {
                          echo "-";
                        } else {
                          echo $baris->tgl_daftar;
                        } ?></td>
                    <td><?php if ($baris->terakhir_login == "") {
                          echo "-";
                        } else {
                          echo $baris->terakhir_login;
                        } ?></td>
                    <td class="text-center">
                      <a href="users/pengguna/d/<?php echo $baris->id_user; ?>" class="btn btn-info btn-xs"><i class="icon-eye"></i></a>
                      <a href="users/pengguna/e/<?php echo $baris->id_user; ?>" class="btn btn-success btn-xs"><i class="icon-pencil7"></i></a>
                      <a href="users/pengguna/h/<?php echo $baris->id_user; ?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah Anda yakin?')"><i class="icon-trash"></i></a>
                    </td>
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