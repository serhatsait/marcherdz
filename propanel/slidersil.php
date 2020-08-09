<?
include '../functions.php';
if ($_SESSION["siteayarlari"] == 1){
$id = $_GET['id'];
$sql = $db->prepare("DELETE FROM slider WHERE Id = '{$id}'");
$sql->execute();	
echo '<script> window.location.href="index.php?page=slider"; </script>';
}
?>