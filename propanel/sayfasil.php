<?
include '../functions.php';
if ($_SESSION["sayfa"] == 1){
$id = $_GET['id'];
$sql = $db->prepare("DELETE FROM sayfalar WHERE Id = '{$id}'");
$sql->execute();	
echo '<script> window.location.href="index.php?page=sayfalar"; </script>';
}
?>