<?
include '../functions.php';
if ($_SESSION["ilanyonetimi"] == 1){
$id = $_GET["id"];


$sql = "UPDATE doping SET val = '0' WHERE ilanId = '$id'";
$stmt = $db->prepare($sql);
$stmt->execute();
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> <script> alert("'.$id.' Nolu İlanın Renkli ve Kalın Yazı Dopingi Kaldırılmıştır."); </script>';
echo '<script> window.location.href="index.php?page=renklivekalin"; </script>';
}
echo '<script> window.location.href="login.php"; </script>';
?>
