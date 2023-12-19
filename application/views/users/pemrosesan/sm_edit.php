<script src="assets/js/select2.min.js"></script>
<script src="assets/js/jquery-ui.js"></script>
<script>
  $(function() {
    $("#tgl_sm").datepicker();
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
                <span class="glyphicon glyphicon-home" aria-hidden="true"></span><b class="">&nbsp; EDIT SURAT MASUK</b><br>Sistem Informasi Arsip Surat Digital
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
                  <label class="control-label col-lg-2 text-right">ID. Surat Masuk</label>
                  <div class="col-lg-4">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="icon-sort"></i></span>
                      <input type="text" class="form-control" value="<?php echo $query->no_surat; ?>" readonly>
                    </div>
                  </div>
                  <label class="control-label col-lg-2 text-right">Tanggal Surat</label>
                  <div class="col-lg-4">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="icon-calendar"></i></span>
                      <input type="text" name="tgl_no_asal" class="form-control daterange-single" id="tgl_no_asal" value="<?php echo $query->tgl_no_asal; ?>" maxlength="10" required placeholder="Masukkan Tanggal">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-lg-2 text-right">Nomor</label>
                  <div class="col-lg-4">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="icon-list"></i></span>
                      <input type="text" name="no_asal" id="no_asal" class="form-control" value="<?php echo $query->no_asal; ?>" placeholder="" required>
                    </div>
                  </div>
                  <label class="control-label col-lg-2 text-right">Instansi Pengirim</label>
                  <div class="col-lg-4">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="icon-home"></i></span>
                      <input type="text" name="pengirim" class="form-control" id="pengirim" value="<?php echo $query->pengirim; ?>">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-lg-2 text-right">Perihal</label>
                  <div class="col-lg-4">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="icon-bookmark"></i></span>
                      <input type="text" name="perihal" id="perihal" class="form-control" value="<?php echo $query->perihal; ?>">
                    </div>
                  </div>
                  <label class="control-label col-lg-2 text-right">Diterima Tanggal</label>
                  <div class="col-lg-2">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="icon-calendar"></i></span>
                      <input type="text" name="tgl_sm" id="tgl_sm" class="form-control daterange-single" value="<?php echo $query->tgl_sm; ?>" placeholder="">
                    </div>
                  </div>
                  <div class="col-lg-2">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="icon-spinner"></i></span>
                      <select class="form-control cari_bag" name="penerima" id="penerima" required>
                        <option value="<?php echo $query->penerima; ?>"><?php echo $query->penerima; ?></option>
                        <option value="">-- Status --</option>
                        <option value="TL">Tindak Lanjut (TL)</option>
                        <option value="Arsip">Arsip</option>
                        <!-- <?php
                              $cari = "level<>'s_admin'";
                              $this->db->order_by('nama_lengkap', 'ASC');
                              foreach ($this->db->get_where('tbl_user', $cari)->result() as $baris) : ?>
                          <option value="<?php echo $baris->nama_lengkap; ?>"><?php echo $baris->nama_lengkap; ?></option>
                        <?php endforeach; ?> -->
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-2 text-right">Disposisi</label>
                  <div class="col-lg-4">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="icon-database"></i></span>
                      <select class="form-control cari_bag" name="disposisi" id="disposisi" required>
                        <option value="<?php echo $query->disposisi; ?>"><?php echo $query->disposisi; ?></option>
                        <option value="">-- Pilih Disposisi --</option>
                        <option value="-"><b>Arsip</b></option>
                        <?php
                        $this->db->order_by('nama_bagian', 'ASC');
                        $bagian = $this->db->get('tbl_bagian')->result();
                        foreach ($bagian as $baris) { ?>
                          <option value="<?php echo $baris->nama_bagian; ?>"><?php echo $baris->nama_bagian; ?></option>
                        <?php
                        } ?>
                      </select>
                    </div>
                  </div>
                  <label class="control-label col-lg-2 text-right">Bagian</label>
                  <div class="col-lg-4">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="icon-folder"></i></span>
                      <select class="form-control" name="bagian" id="bagian" required>
                        <option value="<?php echo $query->bagian; ?>"><?php echo $query->bagian; ?></option>
                        <option value="">-- Pilih Bagian --</option>
                        <option value="-">Arsip</option>
                        <option value="Kepala Madrasah">Kepala Madrasah</option>
                        <option value="Kepala TU">Kepala TU</option>
                        <option value="WAKA Sarana">WAKA Sarana</option>
                        <option value="WAKA Kesiswaan">WAKA Kesiswaan</option>
                        <option value="WAKA Humas">WAKA Humas</option>
                        <option value="WAKA Kurikulum">WAKA Kurikulum</option>
                        <option value="Bendahara">Bendahara</option>
                        <option value="Kepala Perpustakaan">Kepala Perpustakaan</option>
                        <option value="Kepala LabKom">Kepala LabKom</option>
                        <option value="Kepala LAB">Kepala LAB</option>
                        <option value="Pembina Ekstrakurikuler">Pembina Ekstrakurikuler</option>
                        <option value="Tata Usaha">Tata Usaha</option>
                        <option value="Guru">Guru</option>
                      </select>
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
                          <td td class="text-center"><a href="lampiran/surat_masuk/<?php echo $baris->nama_berkas; ?>" target="_blank" title="<?php echo substr($baris->ukuran / 1024, 0, 5); ?> MB" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-floppy-saved"></span></a></td>
                        </tr>
                      <?php
                        $no++;
                      } ?>
                    </table>
                  </div>
                </div>
                <script>
                  $(document).ready(function() {
                    $(".cari_penerima").select2({
                      placeholder: "Pilih Penerima"
                    });
                  });
                </script>
                <hr>
                <a href="users/sm" class="btn btn-danger"><span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;<b>KEMBALI</b></a>
                <button type="submit" name="btnupdate" id="submit-all" class="btn btn-success"><span class="glyphicon glyphicon-floppy-saved"></span>&nbsp;<b>UPDATE</b></button>
              </form>
            </fieldset>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /dashboard content -->