<?
include '../functions.php';
$id = $_GET['id'];
$sql = $db->prepare("DELETE FROM sss WHERE Id = '{$id}'");
$sql->execute();	
echo '<script> window.location.href="index.php?page=sss"; </script>';
?>