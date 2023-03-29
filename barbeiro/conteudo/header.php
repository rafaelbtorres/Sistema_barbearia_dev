<?php
$base_url = "../barbeiro/";
session_start();
if(empty($_SESSION)) {
	header('Location: ../index.php');
	exit();
}
?>

<!DOCTYPE html>

<html lang="pt-br">

<head>
<meta charset="utf-8">
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $base_url ?>css/all.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
    <link rel="stylesheet" href="<?php echo $base_url ?>css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $base_url ?>css/navbar.css">
    <link rel="stylesheet" href="<?php echo $base_url ?>css/datatables.min.css">
    <link rel="stylesheet" href="<?php echo $base_url ?>css/global.css">
    <link rel="icon" type="image/x-icon" href="assets/icons/favicon.ico">

    <title>AgendAÍ</title>
    <link rel="icon" type="image/x-icon" href="assets/icons/favicon.ico">

    <!-- Adição do freela -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-inputmask@1.0.1/index.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>