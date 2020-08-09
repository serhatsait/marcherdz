<?
include ("../functions.php");
$uyeler = $db->query("select eposta from users");

foreach($uyeler as $uye)             
{     
	$mailler[] = $uye["eposta"];
}  

toplumail($mailler,$_POST["name"],$_POST["feedback"]);  

$sonuc = true;             
?>