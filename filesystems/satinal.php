<?
if ($_SESSION["uye"] == ""){ header("location: /login/"); }
$id = $_GET["id"];
$_SESSION['ilan'] = $id;
$uye = $_SESSION['uye'];
$id = $_GET["id"];
$uye = $_SESSION["uye"];
$sql2 = $db->query("SELECT * FROM ilanlar WHERE Id = '{$id}'");
$row = $sql2->fetch(PDO::FETCH_ASSOC);
$resim = $db->query("SELECT * FROM images WHERE ilanId = '{$row['Id']}' ORDER BY s ASC LIMIT 1");
if ($resim->rowCount() == 0) {
$src = "img/no.png";
} else {
$r   = $resim->fetch(PDO::FETCH_ASSOC);
$src = $base_url . "fileserver/files/" . $row["Id"] . "/thumbnail/" . $r["name"];
}
$e = explode("-", $row["dates"]);
$il    = $db->query("SELECT * FROM city WHERE id = '{$row['city']}'");
$ilyaz = $il->fetch(PDO::FETCH_ASSOC);
$ilce    = $db->query("SELECT * FROM county WHERE id = '{$row['districts']}'");
$ilceyaz = $ilce->fetch(PDO::FETCH_ASSOC);

$mahalle    = $db->query("SELECT * FROM locality WHERE id = '{$row['locality']}'");
$mahalleyaz = $mahalle->fetch(PDO::FETCH_ASSOC);
?>
<style type="text/css">
@media (max-width:768px){
.col-xs-9 {
margin-left:64px;
}
.col-xs-9 {
    width: 50%;
}
}
</style>
<div class="container top15">
    <div class="panel panel-default">
        <div class="panel-heading">Satın Al</div>
        <div class="panel-body">
            <?
            echo '
            <div class="adv' . $class . '" onclick="window.location.href=\'i-'.$row["Id"].'-'.slugify($row["title"]).'.html\'" style="cursor:pointer">
            <div class="row no-gutter">
            <div class="col-xs-1"><a href="i-'.$row["Id"].'-'.slugify($row["title"]).'.html"><img src="' . $src . '" class="img-thumbnail" width="100" /></a></div>
            <div class="col-xs-9"><strong style="font-size:14px">' . $row["title"] . '</strong>
            <br><span style="font-size:12px"><i class="fa fa-clock-o" aria-hidden="true"></i> ' . $e[2] . '-' . $e[1] . '-' . $e[0] . ' <br><i class="fa fa-map-marker" aria-hidden="true"></i> ' . $ilyaz["il_adi"] . ' / ' . $ilceyaz["county_adi"] . ' / ' . $mahalleyaz["districtname"] . '</span>
            </div>
            <div class="col-xs-2" style="text-align:center; padding:5px"><a href="javascript:void(0)" class="btn btn-danger btn-block price">' . str_replace(",", ".", number_format($row["price"])) . ' ' . $row["exchange"] . '</a></div>
            </div>
            </div>';
            ?>
            <div style="padding:15px; border:solid 1px #ededed">
                <p>ALICI; malı teslim aldığı tarihten itibaren 14 (ondört) gün içerisinde hiçbir hukuki ve cezai sorumluluk üstlenmeksizin ve hiçbir gerekçe göstermeksizin malı reddederek, sözleşmeden cayma hakkına sahiptir. ALICI, geçerli süre içerisinde cayma hakkını kullanmak istediğini SATICI&rsquo;ya beyan etmesi üzerine, Mesafeli Sözleşme ekinde (Ek-2) olarak yer alan örnek Cayma Hakkı Formu&rsquo;nu doldurup, mesafeli sözleşmede belirtilen iletişim yöntemlerinden herhangi biri ile SATICI&rsquo;ya gönderecektir.</p>
                <p>Onay süresi; ürüne ait kargo bilgisi girildikten sonra başlar ve ilanda belirtilen kargo süresi kadardır. ALICI, işbu onay süresi içinde, sistem üzerinden cayma hakkı bildirimini göndererek cayma hakkını kullanmak istemesi halinde; satış bedelinin SATICI&rsquo;ya aktarılmasını engellemek için <? echo $SiteName; ?>'a bilgilendirmesi gerekeceğinden, <? echo $base_url; ?>sistemi üzerinden &ldquo;Bana Özel&rdquo; sayfasında&ldquo;işlemi duraklatarak&rdquo; bildirimde bulunacaktır. İşbu onay süresi sona erdikten sonra ALICI cayma hakkını kullanmak istediğini sadece SATICI&rsquo;ya beyan edecek, <? echo $SiteName; ?>&rsquo;e herhangi bir bildirimde bulunmayacaktır. Cayma hakkı talebinin sistem üzerinden iletilmesi halinde <? echo $SiteName; ?>.&rsquo;nin cayma hakkının içeriği ve uygulanabilir olmadığı ile herhangi bir değerlendirme yapması mümkün olmayıp bu şekilde bir bildirim geldiğinde bedeli ALICI&rsquo;ya iade edecek; cayma hakkının kullanılması ile ilgili olası uyuşmazlıklarda taraf olarak kabul edilmeyecektir.</p>
                <p>Cayma hakkının kullanımından kaynaklanan masraflar SATICI'ya aittir.</p>
            </div> <br>
            <a href="index.php?page=adres" class="btn btn-danger">Satın Almaya Devam Et</a>
        </div></div></div>