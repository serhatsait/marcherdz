<?php
ob_start();
include '../functions.php';
$id = $_GET['id'];
$_SESSION['list'] = $id;
$ref = $_SERVER['HTTP_REFERER'];
header("location: $ref");
?>