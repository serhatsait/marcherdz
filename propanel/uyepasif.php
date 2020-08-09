<?
include '../functions.php';
$id = $_GET['id'];
$sql = "UPDATE users SET aktivasyon = '0' WHERE Id = '$id'";
$stmt = $db->prepare($sql);
$stmt->execute();
echo '<script> window.location.href="index.php?page=aktif"; </script>';
?>