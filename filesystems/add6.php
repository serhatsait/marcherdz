<?
$uye = $_SESSION["uye"];
if ($_SESSION["uye"] == "") {
header("location: /login");
}
$sql = $db->query("SELECT * FROM ilanlar WHERE uyeId = '$uye'");
if ($sql->RowCount() >= $MagazaSinir) {
header("location: index.php?page=add");
}
$uye         = $_SESSION["uye"];
$f1         = $_POST["f1"];
$f2         = $_POST["f2"];
$f3         = $_POST["f3"];
$f4         = $_POST["f4"];
$f5         = $_POST["f5"];
$f6         = $_POST["f6"];
$f7         = $_POST["f7"];
$f8         = $_POST["f8"];
$f9         = $_POST["f9"];
$f10         = $_POST["f10"];
$f11         = $_POST["f11"];
$f12         = $_POST["f12"];
$f13         = htmlentities($_POST["f13"]);
$f14         = $_POST["f14"];
$data8       = $_POST["data8"];
$data9       = $_POST["data9"];
$data10      = $_POST["data10"];
$category1   = $_GET["id"];
$lat         = $_POST["lat"];
$lng         = $_POST["lng"];
$zoom        = $_POST["zoom"];
$yayintarihi = 365;


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
$dates    = date("Y-m-d");

if ($_GET["ilanId"] != ""){
$eski = $_GET["ilanId"];
$uye = $_SESSION['uye'];
$sql2 = $db->prepare("DELETE FROM ilanlar WHERE Id = '{$eski}' and uyeId = '$uye'");
$sql2->execute();
$sql = $db->prepare('INSERT INTO ilanlar (Id, uyeId, city, districts, locality,lat, lng, zoom, confirm, dates, category1, category2, category3, category4, category5, category6, category7, category8, category9, category10,yayin, firmadi, telefon, fax, gsm, web, vergidairesi, vergino, kurulusyili, isletmeturu, yetkili, ciro, calisansayisi, hakkinda, fadres) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
$sql->execute(array($eski,$uye,$data8,$data9,$data10,$lat,$lng,$zoom,0,$dates,$category1,$category2,$category3,$category4,$category5,$category6,$category7,$category8,$category9,$category10,$yayintarihi, $f1, $f2, $f3, $f4, $f5, $f6, $f7, $f8, $f9, $f10, $f11, $f12, $f13, $f14));
$lastId = $eski;
} else {
$sql = $db->prepare('INSERT INTO ilanlar (Id, uyeId, city, districts, locality,lat, lng, zoom, confirm, dates, category1, category2, category3, category4, category5, category6, category7, category8, category9, category10,yayin, firmadi, telefon, fax, gsm, web, vergidairesi, vergino, kurulusyili, isletmeturu, yetkili, ciro, calisansayisi, hakkinda, fadres) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
$sql->execute(array(null,$uye,$data8,$data9,$data10,$lat,$lng,$zoom,0,$dates,$category1,$category2,$category3,$category4,$category5,$category6,$category7,$category8,$category9,$category10,$yayintarihi, $f1, $f2, $f3, $f4, $f5, $f6, $f7, $f8, $f9, $f10, $f11, $f12, $f13, $f14));
$lastId = $db->lastInsertId();
}
bildirimgonder($admin_mail, 1);
if ($_GET["ilanId"] == ""){
$klasor = "9999999" . $_SESSION["uye"];
rename('fileserver/files/' . $klasor . '', 'fileserver/files/' . $lastId . '');
$sql = "UPDATE images SET ilanId = '$lastId' WHERE ilanId = '$klasor'";
$stmt = $db->prepare($sql);
$stmt->execute();
}
header("location: index.php?page=yayin");
?>