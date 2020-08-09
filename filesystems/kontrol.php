<?
include '../functions.php';
$name = $_POST["name"];
$sql = $db->query("SELECT * FROM magazalar WHERE adres = '$name'");
echo $sql->rowCount();
?>