<!doctype html>
<html lang="en">

<head>
	<title>
		<?= ($this->uri->segment(1) ? ucwords(str_replace('-', ' ', $this->uri->segment(1)).' '.($this->uri->segment(2) ? str_replace('-', ' ', $this->uri->segment(2)) : "")." - POS mini") : "POS mini");?>
	</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?= base_url();?>assets/css/bootstrap.min.css">

	<!-- custom css -->
	<link rel="stylesheet" href="<?= base_url();?>assets/css/custom.css?<?= time();?>">

	<style>
		html,
		body {
			height: 100%;
		}

		body {
			display: -ms-flexbox;
			display: -webkit-box;
			display: flex;
			-ms-flex-align: center;
			-ms-flex-pack: center;
			-webkit-box-align: center;
			align-items: center;
			-webkit-box-pack: center;
			justify-content: center;
			padding-top: 40px;
			padding-bottom: 40px;
			background-color: #f5f5f5;
    }
    
    .icon-home{
      position: absolute;
      top: 15px;
      right: 15px;
    }

	</style>

	<!-- main jquery -->
	<script src="<?= base_url();?>assets/js/jquery-3.6.0.js"></script>
  
  <!-- Sweetalert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="text-center">
  
  <!-- ALERT -->
  <?php if ($this->session->flashdata('error')) { ?>
  <script>
    Swal.fire({
      text: '<?php echo $this->session->flashdata('error');?>',
      icon: 'info',
    })

  </script>
  <?php }?>

  <?php if ($this->session->flashdata('warning')) { ?>
  <script>
    Swal.fire({
      text: '<?php echo $this->session->flashdata('warning');?>',
      icon: 'warning',
    })

  </script>
  <?php }?>

  <?php if ($this->session->flashdata('success')) { ?>
  <script>
    Swal.fire({
      text: '<?php echo $this->session->flashdata('success');?>',
      icon: 'success',
    })

  </script>
	<?php }?>
	
  <a href="<?= base_url();?>"><i class="fa fa-home fa-2x text-success icon-home"></i></a>
	<form class="form-signin" action="<?= site_url('authentication/proses_masuk');?>" method="POST">
		<h1 class="h3 mb-3 font-weight-normal">Masuk ke akun anda</h1>
		<label for="inputUsername" class="sr-only">Username</label>
		<input type="text" id="inputUsername" class="form-control" name="username" placeholder="username" autofocus>
		<label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" >
    
		<button class="btn btn-lg btn-success btn-block" type="submit">Masuk</button>
		<p class="mt-5 mb-3 text-muted">&copy; 2021 PT. Majoo Teknologi Indonesia</p>
	</form>
</body>

<script src="<?= base_url();?>assets/js/bootstrap.js"></script>

</html>
