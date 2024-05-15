<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
	<title>Child Abuse Management System</title>
	<link rel="shortcut icon" href="../images/logo1.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/local.css">
	<link rel="stylesheet" type="text/css" href="../css/responsive.css">
	<link rel="stylesheet" type="text/css" href="../css/fontawesome/css/all.css" media="screen">	
	<link rel="stylesheet" type="text/css" href="../css/animate-css/animate.min.css" media="screen" >
  <link rel="stylesheet" type="text/css" href="../css/lobipanel/lobipanel.min.css" media="screen" >
  <link rel="stylesheet" type="text/css" href="../css/prism/prism.css" media="screen">
  <link rel="stylesheet" type="text/css" href="../css/select2/select2.min.css" media="screen">
  <link rel="stylesheet" type="text/css" href="../css/toastr/toastr.min.css" media="screen" >
  <link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.min.css" media="screen"/>
  <link rel="stylesheet" type="text/css" href="../css/main.css" media="screen" >

  <script src="../js/modernizr/modernizr.min.js"></script>
</head>
<?php 
  session_start();
  if (empty($_SESSION)) {
    header("Location: ../");
  }
 ?>