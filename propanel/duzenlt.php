<?
include '../functions.php';
$sql = $db->query("SELECT * FROM moduls");
while ($a = $sql->fetch(PDO::FETCH_ASSOC)){
	$yeni = str_replace("-"," ",$a["name"]);
	$sql2 = "UPDATE moduls SET name = '$yeni' WHERE Id = '$a[Id]'";
	$stmt = $db->prepare($sql2);
	$stmt->execute();	
}
?>