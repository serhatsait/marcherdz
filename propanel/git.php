<?
include 'functions.php';
$site = "http://www.e-sirket.com/";
$icerik = file_get_contents($site);
$veri = explode('<ul class="sorted_p">',$icerik);
$veri = explode('</ul>',$veri[1]);
$veri = $veri[0];

preg_match_all('|<a href="(.*?)" title="(.*?)">(.*?)<\/a>|',$veri,$veriler);
$i = 0;
foreach ($veriler[3] as $v){
	$anakategori = $v;
	
	$sql = $db->prepare('INSERT INTO category (Id, kategori_adi, ustkategoriId, modul, ikon, title, description, sira, slink, moduller, durum, fiyat1, fiyat2, fiyat3,tip) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
	$sql->execute(array(null,$anakategori,0, 0, " ", $anakategori, $anakategori, 0, " ", " ", 0, 0,0,0,1));
	$lastId = $db->lastInsertId();

	$link = "http://www.e-sirket.com/".$veriler[1][$i];
	$icerik2 = file_get_contents($link);
	$veri2 = explode('<div class="sektorler_firm">',$icerik2);
	$veri2 = explode('</div>',$veri2[1]);
	$veri2 = $veri2[0];
	preg_match_all('|<a href="(.*?)">(.*?) <span>|',$veri2,$veriler2);
	$i2 = 0;
	foreach ($veriler2[2] as $v2){
	$sql2 = $db->prepare('INSERT INTO category (Id, kategori_adi, ustkategoriId, modul, ikon, title, description, sira, slink, moduller, durum, fiyat1, fiyat2, fiyat3,tip) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
	$sql2->execute(array(null,$v2,$lastId, 0, " ", $v2, $v2, 0, " ", " ", 0, 0,0,0,1));
	$i2++;
	}
	$i++;
}
echo 'bitti';

?>