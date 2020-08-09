<?
include '../functions.php';
if ($_SESSION["siteayarlari"] == 1){
$id = $_GET['id'];

$sql = $db->prepare("DELETE FROM moduls WHERE Id = '{$id}'");
$sql->execute();

$sql = "UPDATE category SET modul = '0' WHERE modul = '$id'";
$stmt = $db->prepare($sql);
$stmt->execute();
	
echo '<script> window.location.href="index.php?page=moduller"; </script>';
}
?>