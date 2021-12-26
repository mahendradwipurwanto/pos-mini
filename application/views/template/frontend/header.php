<!doctype html>
<html lang="en">

<head>
	<title>
		<?= ($this->uri->segment(1) ? ucwords(str_replace('-', ' ', $this->uri->segment(1)).' '.($this->uri->segment(2) ? str_replace('-', ' ', $this->uri->segment(2)) : "")." - POS mini") : "POS mini");?>
	</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta property="og:title" content="<?= ($this->uri->segment(1) ? ucwords(str_replace('-', ' ', $this->uri->segment(1)).' '.($this->uri->segment(2) ? str_replace('-', ' ', $this->uri->segment(2)) : "")." - POS mini") : "POS mini");?>">
  <meta property="og:description" content="POS Mini - PT. Majoo Teknologi Indonesia">
  <meta property="og:image" content="<?= base_url();?>assets/img/logo.png">
  <meta property="og:url" content="<?= base_url(uri_string()) ?>">

  <!-- Favicon -->
  <link rel="shortcut icon" href="<?= base_url() ?>assets/img/logo.png">

	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?= base_url();?>assets/css/bootstrap.min.css">

	<!-- custom css -->
	<link rel="stylesheet" href="<?= base_url();?>assets/css/custom.css?<?= time();?>">

	<!-- main jquery -->
	<script src="<?= base_url();?>assets/js/jquery-3.6.0.js"></script>
  
  <!-- Sweetalert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	
</head>

<body>
  
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

	<main role="main">
