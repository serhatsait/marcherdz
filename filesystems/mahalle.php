<?
include '../functions.php';
$il = $_POST["mahalle"];
$ilanId = $_POST["ilanId"];
echo '<option value="">Seçiniz</option>';
$sql = $db->query("SELECT * FROM locality WHERE countyId = '$il'");
while ($row = $sql->fetch(PDO::FETCH_OBJ)){
if ($ilanId != ""){
echo '<option value="'.$row->id.'"'; if ($row->id == $ilanId){ echo ' selected'; } echo '>'.$row->districtname.'</option>';
} else {
echo '<option value="'.$row->id.'">'.$row->districtname.'</option>';

}
}
?>