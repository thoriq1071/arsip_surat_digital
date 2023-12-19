<?php
$user = $query; ?>
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
                <span class="glyphicon glyphicon-home" aria-hidden="true"></span><b class="">&nbsp; EDIT PENGGUNA</b><br>Sistem Informasi Arsip Surat Digital
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
                  <label class="control-label col-lg-3">Nama Pengguna</label>
                  <div class="col-lg-9">
                    <input type="text" name="username" class="form-control" value="<?php echo $user->username; ?>" placeholder="Nama Pengguna" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-3">Nama Lengkap</label>
                  <div class="col-lg-9">
                    <input type="text" name="nama_lengkap" class="form-control" value="<?php echo $user->nama_lengkap; ?>" placeholder="Nama Lengkap" maxlength="100" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-3">Email</label>
                  <div class="col-lg-9">
                    <input type="email" name="email" class="form-control" value="<?php echo $user->email; ?>" placeholder="Email" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-3">Level</label>
                  <div class="col-lg-9">
                    <select class="form-control" name="level" required>
                      <option value="">- Pilih Level Pengguna -</option>
                      <option value="admin" <?php if ($user->level == "admin") {
                                              echo "selected";
                                            } ?>>Admin</option>
                      <option value="user" <?php if ($user->level == "user") {
                                              echo "selected";
                                            } ?>>User</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-3">Alamat</label>
                  <div class="col-lg-9">
                    <textarea name="alamat" rows="3" cols="80" class="form-control" placeholder="Alamat" required><?php echo $user->alamat; ?></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-3">Telepon</label>
                  <div class="col-lg-9">
                    <input type="text" name="telp" class="form-control" value="<?php echo $user->telp; ?>" placeholder="Level User" maxlength="30" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-3">Pengalaman</label>
                  <div class="col-lg-9">
                    <textarea name="pengalaman" rows="3" cols="80" class="form-control" placeholder="Pengalaman" required><?php echo $user->pengalaman; ?></textarea>
                  </div>
                </div>

                <a href="users/pengguna" class="btn btn-danger"><span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;<b>KEMBALI</b></a>
                <button type="submit" name="btnupdate" class="btn btn-success"><span class="glyphicon glyphicon-floppy-saved"></span>&nbsp;<b>UPDATE</b></button>
              </form>

            </fieldset>


          </div>

        </div>
      </div>
    </div>
    <!-- /dashboard content -->