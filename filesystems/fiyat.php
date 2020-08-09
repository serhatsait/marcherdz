<?
include '../functions.php';
$name = $_POST["name"];
$sql = $db->query("SELECT * FROM category WHERE Id = '$name'");
while ($a = $sql->fetch(PDO::FETCH_ASSOC)){
echo ''.$a["fiyat1"].'-'.$a["fiyat2"].'-'.$a["fiyat3"].'';	
}
?>