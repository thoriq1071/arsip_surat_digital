  <nav class="navbar navbar-inverse navbar-fixed-top">
  	<div class="col-md-12">
  		<div class="navbar-header">
  			<ul class="nav navbar-nav navbar-center">
  				<li><a href="javascript:void(0)"><span class='glyphicon glyphicon-send' aria-hidden='true'></span>&nbsp;<b> ARSIP SURAT DIGITAL</b></a></li>
  			</ul>
  		</div>
  	</div>
  </nav>
  <div class="kontainer">
  	<div class="kotak">
  		<?php echo $this->session->flashdata('msg'); ?>
  		<div class="wrapper">
  			<p style="padding: 20px 10px; text-align-last: center;">
  				<img src="<?php echo base_url('foto/stmik_indo.png') ?>" height="100">
  			</p>
  			<div class="title1"><span>LOGIN ARSIP SURAT DIGITAL</span></div>
  			<form action="" method="post">
  				<div class="row">
  					<i class="icon-user-lock"></i>
  					<input type="text" required="" autofocus="" name="username" placeholder="Username" class="form-control flat">
  				</div>
  				<div class="row">
  					<i class="icon-lock2"></i>
  					<input type="password" required="" name="password" placeholder="Password" class="form-control flat">
  				</div>
  				<div class="row" style="margin-bottom: -12px;">
  					<button type="submit" name="btnlogin" class="btn btn-login"><span class="fa fa-random"></span> &nbsp;<b>LOGIN</b></button>
  				</div>

  			</form>
  		</div>
  		</br>