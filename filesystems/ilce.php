<?
include '../functions.php';
$il = $_POST["il"];

echo '<option value="">Seçiniz</option>';
$sql = $db->query("SELECT * FROM county WHERE il_id = '$il'");
while ($row = $sql->fetch(PDO::FETCH_OBJ)){
echo '<option value="'.$row->id.'">'.$row->county_adi.'</option>';
}
?>