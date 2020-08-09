<?
include '../functions.php';
$data1 = $_POST['data1'];
$sql = $db->query("SELECT * FROM category WHERE Id = '$data1'");
$a = $sql->fetch(PDO::FETCH_ASSOC);
echo $a["kategori_adi"];
?>