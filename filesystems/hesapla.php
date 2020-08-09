<?
include '../functions.php';
$fiyat = $_POST["fiyat"];
$fiyat = str_replace(".","",$fiyat);
$cik = $fiyat * $komisyon / 100;
$fiyat = $fiyat - $cik;
if (strlen($fiyat) > 3){
$fiyat = number_format($fiyat);
}
echo $fiyat;
?>