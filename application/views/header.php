<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bike Service</title>

    <link rel="stylesheet" href="<?php echo base_url('asserts/css/style.css');?>">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href='https://fonts.googleapis.com/css?family=Cookie' rel='stylesheet' type='text/css'>

</head>

<body>

<header class="header-fixed">

    <div class="header-limiter">

        <h1><a href="<?php echo base_url();?>">Bike<span>Service</span></a></h1>

        <nav>
            <?php if(isset($_SESSION['cust_userId'])){?>  <a href="<?php echo base_url().'/Customer/dashboard';?>">dashboard</a><?php } ?>
            <?php if(isset($_SESSION['vendor_userId'])){?>  <a href="<?php echo base_url().'/vendor/dashboard';?>">Vendor dashboard</a><?php } ?>
            <a href="<?php echo base_url().'/home/login';?>">Customer Login</a>
             <a href="<?php echo base_url().'/home/loginvendor';?>">Vendor Login</a>
        </nav>

    </div>

</header>

<!-- You need this element to prevent the content of the page from jumping up -->
<div class="header-fixed-placeholder"></div>

<!-- The content of your page would go here. -->








