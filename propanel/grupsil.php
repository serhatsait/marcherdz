<?
include '../functions.php';
if ($_SESSION["siteayarlari"] == 1){
$id = $_GET['id'];
$sql = $db->query("SELECT * FROM groups WHERE Id = '$id'");
$a = $sql->fetch(PDO::FETCH_ASSOC);

$sql = $db->prepare("DELETE FROM groups WHERE Id = '{$id}'");
$sql->execute();

$sql = $db->prepare("DELETE FROM prop WHERE groupId = '{$id}'");
$sql->execute();

	
echo '<script> window.location.href="index.php?page=modulozellikleri&id='.$a["modulId"].'"; </script>';
}
?>