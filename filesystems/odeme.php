<?
if ($_SESSION["uye"] == ""){ header("location: /login/"); }
require_once('iyzipay/config.php');
$token = $_POST["token"];
# create request class
$request = new \Iyzipay\Request\RetrieveCheckoutFormRequest();
$request->setLocale(\Iyzipay\Model\Locale::TR);
$request->setToken($token);

# make request
$checkoutForm = \Iyzipay\Model\CheckoutForm::retrieve($request, Config::options());

# print result

if ($checkoutForm->getPaymentStatus() == "SUCCESS" ) { $pay_action_completed = 1;}

if($pay_action_completed=='1'){
	
$id = $_SESSION['ilan'];
$uye = $_SESSION["uye"];
$tarih = date("Y-m-d");
$sql = $db->query("SELECT * FROM ilanlar WHERE Id = '$id'");
$a = $sql->fetch(PDO::FETCH_ASSOC);
$fiyat = $a["price"];
$fiyat = str_replace(".","",$fiyat);
$cik = $fiyat * $komisyon / 100;
$fiyat = $fiyat - $cik;
if (strlen($fiyat) > 3){
$fiyat = number_format($fiyat);
}
$sql = $db->prepare('INSERT INTO siparisler (Id, alici, satici, ilanId, fiyat, durum, tarih, kargotarihi, kargoadi, takipno, aktarilacaktutar, odeme) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)');
$sql->execute(array(null, $uye, $a["uyeId"], $id, $a["price"], 0, $tarih,"","","", $fiyat,0));
$lastId = $db->lastInsertId();

$sql = "UPDATE teslimat SET siparisId = '$lastId' WHERE uyeId = '$uye' ORDER BY Id DESC LIMIT 1";
$stmt = $db->prepare($sql);
$stmt->execute();

$sql = "UPDATE fatura SET siparisId = '$lastId' WHERE uyeId = '$uye' ORDER BY Id DESC LIMIT 1";
$stmt = $db->prepare($sql);
$stmt->execute();

$sql = $db->prepare('INSERT INTO satilanlar (Id, ilanId, uyeId, phone, message, title, content, type, price, exchange, cargoprice, cargoarrive, cargo, city, districts,locality,lat, lng, zoom, confirm, dates, category1, category2, category3, category4, category5, category6, category7, category8, category9, category10,yayin,bitis) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
$sql->execute(array(null, $id, $a["uyeId"], $a["phone"], $a["message"], $a["title"], $a["content"], $a["type"], $a["price"], $a["exchange"], $a["cargoprice"], $a["cargoarrive"], $a["cargo"],$a["city"], $a["districts"], $a["locality"], $a["lat"], $a["lng"], $a["zoom"], $a["confirm"], $a["dates"], $a["category1"], $a["category2"], $a["category3"], $a["category4"], $a["category5"], $a["category6"], $a["category7"], $a["category8"], $a["category9"], $a["category10"], $a["yayin"], $a["bitis"]));

$sql48 = "UPDATE ilanlar SET confirm = '0' WHERE Id = '$id'";
$stmt48 = $db->prepare($sql48);
$stmt48->execute();

?>

<div class="container top15">
    <div class="panel panel-default">
        <div class="panel-heading">Sipariş</div>
        <div class="panel-body">
            <div class="alert alert-success">
                <h4 style="margin-bottom:0px !important; padding-bottom: 5px !important">İşlem Tamamlandı</h4>
                Ödemeniz gerçekleştirildi. Siparişinizi bana özel bölümündeki <strong>Alış İşlemlerimden</strong> Takip Edebilirsiniz<br>
                <br><a href="index.php?page=alisislemlerim" class="btn btn-primary">Alış İşlemlerine Gitmek İçin Tıklayınız</a></div>
        </div>
    </div>
</div>
<?php 
} else {
?>
<div class="container top15">
    <div class="panel panel-default">
        <div class="panel-heading">Sipariş</div>
        <div class="panel-body">
            <div class="alert alert-success">
                <h4 style="margin-bottom:0px !important; padding-bottom: 5px !important">İşlem Tamamlanamadı</h4>
                Ödemeniz gerçekleştirilemedi. Tekrar denemek için <a href="index.php?page=ozet" target="_self">tıklayınız</a></div>
        </div>
    </div>
</div>
<?php 
}
?>


