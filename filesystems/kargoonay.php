<?
include '../functions.php';
$id = $_GET["id"];
$uye = $_SESSION['uye'];
$sql = "UPDATE siparisler SET durum = '2' WHERE Id = '$id' and (alici = '$uye')";
$stmt = $db->prepare($sql);
$stmt->execute();	
header("location: index.php?page=alisislemlerim");
?>