<?php
include 'functions2.php';
if(!isset($_SESSION)) { session_start(); }
$name = $_POST['name'];
$idd = $_SESSION["resimklasoru"];
$name = str_replace("http://","",$name);
$name = str_replace("www.","",$name);
$name = str_replace($_SERVER["SERVER_NAME"]."/fileserver/","",$name);
$name = str_replace("files/$idd/thumbnail/","",$name);
$name = str_replace("/orakuploader//images/loader.gif","",$name);
$id = 100;
foreach ($name as $n){
	$id = $id + 1;
	$sql = $db->prepare("UPDATE images SET s=? WHERE ilanId = '$idd' and name = '$n'");
	$ekle = $sql->execute(array($id));
}
?>