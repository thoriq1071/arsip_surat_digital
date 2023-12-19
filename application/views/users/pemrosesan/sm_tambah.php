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
<link rel="stylesheet" type="text/css" href="assets/upload/dropzone.min.css">
<script type="text/javascript" src="assets/upload/dropzone.min.js"></script>
<style>
  .dropzone {
    margin-top: 10px;
    border: 2px dashed #0087F7;
  }
</style>

<?php
$this->db->order_by('id_sm', 'DESC');
$this->db->limit(1);
$cek_ns = $this->db->get('tbl_sm');
if ($cek_ns->num_rows() == 0) {
  $no_surat       = "SM/" . date('Y') . "/SI/001";
} else {
  $noUrut          = substr($cek_ns->row()->no_surat, 13, 15);
  $noUrut++;
  $no_surat        = "SM/" . date('Y') . "/SI/" . sprintf("%03s", $noUrut);
}
?>
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
                <span class="glyphicon glyphicon-home" aria-hidden="true"></span><b>&nbsp; TAMBAH SURAT MASUK</b><br>Sistem Informasi Arsip Surat Digital
              </div>
            </div>
          </div>
          <div class="panel-body">
            <fieldset class="content-group">
              <?php echo $this->session->flashdata('msg'); ?>
              <div class="msg"></div>
              <form class="form-horizontal" action="users/sm" enctype="multipart/form-data" method="post">
                <div class="form-group">
                  <label class="control-label col-lg-2 text-right">ID Surat Masuk</label>
                  <div class="col-lg-4">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="icon-sort"></i></span>
                      <input type="text" name="nsx" id="nsx" class="form-control" placeholder="" value="<?php echo $no_surat; ?>" required readonly>
                      <input type="hidden" name="ns" id="ns" class="form-control" placeholder="" value="<?php echo $no_surat; ?>" required>
                    </div>
                  </div>
                  <label class="control-label col-lg-2 text-right">Tanggal Surat</label>
                  <div class="col-lg-4">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="icon-calendar"></i></span>
                      <input type="text" name="tgl_no_asal" class="form-control daterange-single" id="tgl_no_asal" value="<?php echo date('d-m-Y'); ?>" maxlength="10" required placeholder="Masukkan Tanggal">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-2 text-right">Nomor Surat Masuk</label>
                  <div class="col-lg-4">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="icon-list"></i></span>
                      <input type="text" name="no_asal" id="no_asal" required class="form-control" placeholder="Input Nomor Surat Masuk">
                    </div>
                  </div>
                  <label class="control-label col-lg-2 text-right">Instansi Pengirim</label>
                  <div class="col-lg-4">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="icon-home"></i></span>
                      <input type="text" name="pengirim" id="pengirim" class="form-control" placeholder="Input Instansi/Lembaga Pengirim Surat">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-2 text-right">Perihal/Hal</label>
                  <div class="col-lg-4">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="icon-bookmark"></i></span>
                      <input type="text" name="perihal" id="perihal" class="form-control" placeholder="Input Perihal/Keterangan Surat">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-2 text-right">Diterima Tanggal</label>
                    <div class="col-lg-2">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="icon-calendar"></i></span>
                        <input type="text" name="tgl_sm" class="form-control daterange-single" id="tgl_sm" value="<?php echo date('d-m-Y'); ?>" maxlength="10" required placeholder="Masukkan Tanggal">
                      </div>
                    </div>
                    <div class="col-lg-2">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="icon-spinner"></i></span>
                        <select class="form-control" name="penerima" id="penerima" required>
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
                    <label class="control-label col-lg-2 text-right">Disposisi ke-</label>
                    <div class="col-lg-4">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="icon-database"></i></span>
                        <select class="form-control" name="disposisi" id="disposisi">
                          <option value="">-- Pilih Disposisi --</option>
                          <option value="Arsip">Arsip</option>
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
                        <select class="form-control" name="bagian" id="bagian">
                          <option value="">-- Pilih Bagian --</option>
                          <option value="Arsip">Arsip</option>
                          <option value="Umum">Umum</option>
                          <option value="Sekertaris">Sekertaris</option>
                          <option value="Bendahara">Bendahara</option>
                          <option value="TU">TU</option>
                          <option value="Keuangan">Keuangan</option>
                          <option value="Kemahasiswaan">Kemahasiswaan</option>
                          <option value="Prodi">Prodi</option>
                          <!-- <option value="Kepala Madrasah">Kepala Madrasah</option> -->
                          <!-- <option value=" TU"> TU</option> -->
                          <!-- <option value="WAKA Sarana">WAKA Sarana</option> -->
                          <!-- <option value="WAKA Kesiswaan">WAKA Kesiswaan</option> -->
                          <!-- <option value="WAKA Humas">WAKA Humas</option> -->
                          <!-- <option value="WAKA Kurikulum">WAKA Kurikulum</option> -->
                          <!-- <option value="Bendahara">Bendahara</option> -->
                          <!-- <option value="Kepala Perpustakaan">Kepala Perpustakaan</option> -->
                          <!-- <option value="Kepala LabKom">Kepala LabKom</option> -->
                          <!-- <option value="Kepala LAB">Kepala LAB</option> -->
                          <!-- <option value="Pembina Ekstrakurikuler">Pembina Ekstrakurikuler</option> -->
                          <!-- <option value="Tata Usaha">Tata Usaha</option> -->
                          <!-- <option value="Guru">Guru</option> -->
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3"><b>Unggah Lampiran</b></label>
                    <div class="col-lg-12">
                      <div class="dropzone" id="myDropzone">
                        <div class="dz-message">
                          <h3> KLIK/DROP FILE DISINI</h3>
                        </div>
                      </div>
                      <i class="bg-danger">&nbsp;&nbsp;* lampiran file wajib diisi &nbsp;&nbsp;</i>
                    </div>
                  </div>
                  <hr>
                  <a href="users/sm" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;<b>KEMBALI</b></a>
                  <button type="submit" id="submit-all" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-floppy-saved"></span>&nbsp;<b>SIMPAN DATA</b></button>
              </form>
            </fieldset>
          </div>
        </div>
      </div>
    </div>
    <!-- /dashboard content -->

    <script type="text/javascript">
      $('.msg').html('');
      Dropzone.options.myDropzone = {
        // Prevents Dropzone from uploading dropped files immediately
        url: "<?php echo base_url('users/sm') ?>",
        paramName: "userfile",
        // acceptedFiles:"'file/doc','file/xls','file/xlsx','file/docx','file/pdf','file/txt',image/jpg,image/jpeg,image/png,image/bmp",
        autoProcessQueue: false,
        maxFilesize: 10, //MB
        parallelUploads: 10,
        maxFiles: 10,
        addRemoveLinks: true,
        dictCancelUploadConfirmation: "Yakin ingin membatalkan upload ini?",
        dictInvalidFileType: "Type file ini tidak dizinkan",
        dictFileTooBig: "File yang Anda Upload terlalu besar {{filesize}} MB. Maksimal Upload {{maxFilesize}} MB",
        dictRemoveFile: "Hapus",

        init: function() {
          var submitButton = document.querySelector("#submit-all")
          myDropzone = this; // closure

          submitButton.addEventListener("click", function(e) {
            e.preventDefault();
            e.stopPropagation();
            myDropzone.processQueue(); // Tell Dropzone to process all queued files.
          });
          // You might want to show the submit button only when
          this.on("error", function(file, message) {
            alert(message);
            this.removeFile(file);
            errors = true;
          });
          // files are dropped here:
          this.on("addedfile", function(file) {
            // Show submit button here and/or inform user to click it.
            //  alert("Apakah anda yakin");
          });

          this.on("sending", function(data, xhr, formData) {
            formData.append("ns", jQuery("#ns").val());
            formData.append("tgl_ns", jQuery("#tgl_ns").val());
            formData.append("no_asal", jQuery("#no_asal").val());
            formData.append("tgl_no_asal", jQuery("#tgl_no_asal").val());
            formData.append("pengirim", jQuery("#pengirim").val());
            formData.append("penerima", jQuery("#penerima").val());
            formData.append("disposisi", jQuery("#disposisi").val());
            formData.append("perihal", jQuery("#perihal").val());
            formData.append("tgl_sm", jQuery("#tgl_sm").val());
            formData.append("bagian", jQuery("#bagian").val());
          });

          this.on("complete", function(file) {
            //Event ketika Memulai mengupload
            myDropzone.removeFile(file);
          });

          this.on("success", function(file, response) {
            //Event ketika Memulai mengupload
            // console.log(response);
            //           $(response).each(function (index, element) {
            //               if (element.status) {
            //               }
            //               else {

            $(".cari_ns").select2({
              placeholder: "Pilih nomor",
              allowClear: true
            });
            $(".cari_ns").val('').trigger('change');
            $('.form-horizontal')[0].reset();
            $('.msg').html('<div class="alert alert-success alert-dismissible" role="alert">' +
              '     <button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
              '       <span aria-hidden="true">&times;&nbsp; &nbsp;</span>' +
              '     </button>' +
              '     <strong>BERHASIL!</strong> DATA BERHASIL DISIMPAN.' +
              '  </div>');
            $("#no_asal").focus();

            alert('BERHASIL! DATA BERHASIL DISIMPAN.');
            window.location = "<?php echo base_url(); ?>users/sm/";
            //     }
            // });
            myDropzone.removeFile(file);
          });

        }
      };
    </script>