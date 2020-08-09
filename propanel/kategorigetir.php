<?
include '../functions.php';
$id = $_POST["data1"];
$idx = $_POST["data2"];
$sql = $db->query("SELECT * FROM category WHERE ustkategoriId = '$id'");
if ($sql->rowCount() == 0){ echo '1'; } else {
echo '<select id="cat'.$idx.'" name="cat'.$idx.'" class="form-control" size="10" style="max-width: 180px; float:left; font-size:12px" onchange="cats'.$idx.'()">';
while ($a = $sql->fetch(PDO::FETCH_OBJ)){
echo '<option value="'.$a->Id.'">'.$a->kategori_adi.'</option>';	
}
echo '</select>';
}
?>