<?
include '../functions.php';
if ($_SESSION["kategoriyonetimi"] == 1){
$id = $_GET['id'];
$sql = $db->prepare("DELETE FROM category WHERE Id = '{$id}'");
$sql->execute();	
echo '<script> window.location.href="index.php?page=kategoriler"; </script>';
}
?>