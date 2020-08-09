<?
$uye = $_SESSION["uye"];
if ($_SESSION["uye"] == "") {
header("location: /login");
}

$uye         = $_SESSION["uye"];
$data4       = $_POST["data4"];
$data4		 = str_replace(".","",$data4);




if ($_GET["ilanId"] != ""){
$eski = $_GET["ilanId"];
$uye = $_SESSION['uye'];
$dustu = 1;

$sql = "UPDATE ilanlar SET price = '$data4', fiyatdustu = '$dustu' WHERE Id = '$eski'";
$stmt = $db->prepare($sql);
$stmt->execute();

echo '<script> alert("Fiyat Güncellendi"); window.location.href="index.php?page=adverts"; </script>';

} else { 

echo '<script> alert("Fiyat Güncelleme Başarısız"); window.location.href="index.php?page=adverts"; </script>';


}

?>