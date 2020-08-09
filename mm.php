<?
include 'functions.php';
$sql = $db->query("SELECT * FROM moduls");
while ($a = $sql->fetch(PDO::FETCH_ASSOC)){

$sql2 = "UPDATE modulitems SET goster = '0' WHERE modulsId = '{$a['Id']}' ORDER BY Id DESC LIMIT 1";
$stmt = $db->prepare($sql2);
$stmt->execute();


}
?>