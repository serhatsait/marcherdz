<?
include '../functions.php';
if ($_SESSION["blog"] == 1){
$id = $_GET['id'];
$sql = $db->prepare("DELETE FROM bkategoriler WHERE Id = '{$id}'");
$sql->execute();	
echo '<script> window.location.href="index.php?page=bkategoriler"; </script>';
}
?>