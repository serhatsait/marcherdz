<?
$uye         = $_GET["uye"];
$telefon     = $_POST["telefon"];
$mesaj       = $_POST["mesaj"];
$data1       = $_POST["data1"];
$data2       = $_POST["data2"];
$data2		 = htmlentities($data2);
$data3       = $_POST["data3"];
$data4       = $_POST["data4"];
$data4		 = str_replace(".","",$data4);
$data5       = $_POST["data5"];
$data6       = $_POST["data6"];
$data7       = $_POST["data7"];
$data8       = $_POST["data8"];
$data9       = $_POST["data9"];
$data10      = $_POST["data10"];
$kargo1      = $_POST["kargo1"];
$kargo2      = $_POST["kargo2"];
$kargo3      = $_POST["kargo3"];
$kargo4      = $_POST["kargo4"];
$kargo5      = $_POST["kargo5"];
$kargo6      = $_POST["kargo6"];
$kargo7      = $_POST["kargo7"];
$kargo8      = $_POST["kargo8"];
$kargo9      = $_POST["kargo9"];
$kargo10     = $_POST["kargo10"];
$category1   = $_GET["id"];
$lat         = $_POST["lat"];
$lng         = $_POST["lng"];
$zoom        = $_POST["zoom"];
$yayintarihi = $_POST["yayintarihi"];

$hemen 	 = $_POST["xx1"];
$hemen		 = str_replace(".","",$hemen);
$fiyat2 	 = $_POST["xx4"];
$fiyat3 	 = $_POST["xx2"];
$fiyat2		 = str_replace(".","",$fiyat2);
$fiyat3		 = str_replace(".","",$fiyat3);
$bitis 	 	 = $_POST["xx3"];
if ($data3 == 2){
	$data4 = $hemen;
}

if ($data5 == ""){
	$data5 = "TL";
}
function ustkategori($e) {
global $db;
$sql = $db->query("SELECT Id, ustkategoriId FROM category WHERE Id = '$e'");
$a   = $sql->fetch(PDO::FETCH_OBJ);
return $a->ustkategoriId;
}

if ($zoom == "") {
$zoom = "14";
}

$sor1 = ustkategori($category1);
if ($sor1 != 0) { $category2 = $sor1;} else {
$category2 = 0;
}
if ($category2 != 0 and $category2 != "") {
$sor2 = ustkategori($category2);
if ($sor2 != 0) {
$category3 = $sor2;
} else {
$category3 = 0;
}
} else {
$category3 = 0;
}

if ($category3 != 0 and $category3 != "") {
$sor3 = ustkategori($category3);
if ($sor3 != 0) {
$category4 = $sor3;
} else {
$category4 = 0;
}
} else {
$category4 = 0;
}

if ($category4 != 0 and $category4 != "") {
$sor4 = ustkategori($category4);
if ($sor4 != 0) {
$category5 = $sor4;
} else {
$category5 = 0;
}
} else {
$category5 = 0;
}

if ($category5 != 0 and $category5 != "") {
$sor5 = ustkategori($category5);
if ($sor5 != 0) {
$category6 = $sor5;
} else {
$category6 = 0;
}
} else {
$category6 = 0;
}

if ($category6 != 0 and $category6 != "") {
$sor6 = ustkategori($category6);
if ($sor6 != 0) {
$category7 = $sor6;
} else {
$category7 = 0;
}
} else {
$category7 = 0;
}


if ($category7 != 0 and $category7 != "") {
$sor7 = ustkategori($category7);
if ($sor7 != 0) {
$category8 = $sor7;
} else {
$category8 = 0;
}
} else {
$category8 = 0;
}

if ($category8 != 0 and $category8 != "") {
$sor8 = ustkategori($category8);
if ($sor8 != 0) {
$category9 = $sor8;
} else {
$category9 = 0;
}
} else {
$category9 = 0;
}

if ($category9 != 0 and $category9 != "") {
$sor9 = ustkategori($category9);
if ($sor9 != 0) {
$category10 = $sor9;
} else {
$category10 = 0;
}
} else {
$category10 = 0;
}
$kargolar = "$kargo1-$kargo2-$kargo3-$kargo4-$kargo5-$kargo6-$kargo7-$kargo8-$kargo9-$kargo10";
$dates    = date("Y-m-d");

if ($_GET["ilanId"] != ""){
$eski = $_GET["ilanId"];
$uye = $_GET['uye'];
$sql2 = $db->prepare("DELETE FROM ilanlar WHERE Id = '{$eski}'");
$sql2->execute();
$sql2 = $db->prepare("DELETE FROM modul_ilan WHERE ilanId = '{$eski}'");
$sql2->execute();
$sql2 = $db->prepare("DELETE FROM prop_ilan WHERE ilanId = '{$eski}'");
$sql2->execute();

$sql = $db->prepare('INSERT INTO ilanlar (Id, uyeId, phone, message, title, content, type, price, exchange, cargoprice, cargoarrive, cargo, city, districts,locality,lat, lng, zoom, confirm, dates, category1, category2, category3, category4, category5, category6, category7, category8, category9, category10,yayin,bitis,fiyat2,fiyat3,bitiszamani,odeme) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');

$sql->execute(array($eski,$uye,$telefon,$mesaj,$data1,$data2,$data3,$data4,$data5,$data6,$data7,$kargolar,$data8,$data9,$data10,$lat,$lng,$zoom,0,$dates,$category1,$category2,$category3,$category4,$category5,$category6,$category7,$category8,$category9,$category10,$yayintarihi,"0000-00-00",$fiyat2,$fiyat3,$bitis,0));
$lastId = $eski;
print_r($sql->errorInfo());
} else {

$sql = $db->prepare('INSERT INTO ilanlar (Id, uyeId, phone, message, title, content, type, price, exchange, cargoprice, cargoarrive, cargo, city, districts,locality,lat, lng, zoom, confirm, dates, category1, category2, category3, category4, category5, category6, category7, category8, category9, category10,yayin,bitis,fiyat2,fiyat3,bitiszamani,odeme) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');

$sql->execute(array(null,$uye,$telefon,$mesaj,$data1,$data2,$data3,$data4,$data5,$data6,$data7,$kargolar,$data8,$data9,$data10,$lat,$lng,$zoom,0,$dates,$category1,$category2,$category3,$category4,$category5,$category6,$category7,$category8,$category9,$category10,$yayintarihi,"0000-00-00",$fiyat2,$fiyat3,$bitis,0));
$lastId = $db->lastInsertId();
print_r($sql->errorInfo());
}

$query = $db->query("SELECT * FROM category WHERE Id = '$category1'");
$q = $query->fetch(PDO::FETCH_OBJ);
$modul = $q->modul;
$query = $db->query("SELECT * FROM modulitems WHERE modulsId = '$modul'");
while ($dd = $query->fetch(PDO::FETCH_OBJ)){
$dat = $_POST['field_'.$dd->Id.''];
if ($dd->classx == 2) {
$secim = $dat;
$text = " ";
} elseif ($dd->classx == 1) {
$secim = $dat;
$text = " ";
} else {

$secim = "0";
$text = $dat;
}

$sql = $db->prepare('INSERT INTO modul_ilan (Id, ilanId, itemId, selects, text, type, category1, category2, category3, category4, category5, category6, category7, category8, category9, category10) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
$sql->execute(array(null,$lastId,$dd->Id,$secim, $text,$dd->classx,$category1,$category2,$category3,$category4,$category5,$category6,$category7,$category8,$category9,$category10));
}

$query = $db->query("SELECT * FROM prop WHERE modulId = '$modul'");
while ($mn = $query->fetch(PDO::FETCH_OBJ)){
$dats = $_POST['prop_'.$mn->Id.''];
$sql4 = $db->prepare('INSERT INTO prop_ilan (Id, propId, val, ilanId) VALUES (?,?,?,?)');
$sql4->execute(array(null, $mn->Id, $dats, $lastId));
}
if ($_GET["ilanId"] == ""){
$klasor = "9999999" . $_GET["uye"];
rename('fileserver/files/' . $klasor . '', 'fileserver/files/' . $lastId . '');

$sql = "UPDATE images SET ilanId = '$lastId' WHERE ilanId = '$klasor'";
$stmt = $db->prepare($sql);
$stmt->execute();
}
$return = $_GET['return'];
echo '<script> window.location.href = "index.php?page='.$return.''; if ($return == "uye"){ echo '&id='.$_GET["u"].''; } echo '"; </script>';
?>