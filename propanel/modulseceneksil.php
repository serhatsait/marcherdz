<?
include '../functions.php';
$id = $_GET['id'];
$sql = $db->query("SELECT * FROM modulitems WHERE Id = '$id'");
$a = $sql->fetch(PDO::FETCH_ASSOC);

$sql = $db->prepare("DELETE FROM modulitems WHERE Id = '{$id}'");
$sql->execute();
$sql = $db->prepare("DELETE FROM modulitemsselect WHERE itemId = '{$id}'");
$sql->execute();
$sql = $db->prepare("DELETE FROM modul_ilan WHERE itemId = '{$id}'");
$sql->execute();

echo '<script> window.location.href = "index.php?page=modulsecenekleri&id='.$a["modulsId"].'"; </script>';
?>