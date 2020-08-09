<?
include '../functions.php';
if ($_SESSION["uyeislemleri"] == 1){
$id = $_GET['id'];
$sql = $db->prepare("DELETE FROM users WHERE Id = '{$id}'");
$sql->execute();	
echo '<script> window.location.href="index.php?page=aktif"; </script>';
}
?>