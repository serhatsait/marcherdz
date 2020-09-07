<?php
if ($_SESSION["uye"] == "") {
    header("location: /login/");
}


$dp1 = $_POST["dp1"];
$dp2 = $_POST["dp2"];
$dp3 = $_POST["dp3"];
$dp4 = $_POST["dp4"];
$id = $_GET["id"];
$uye = $_SESSION["uye"];
$sql = $db->query("SELECT * FROM ilanlar WHERE Id = '$id'");
$il = $sql->fetch(PDO::FETCH_OBJ);
$toplam = "";
if ($dp1 == 1) {
    $toplam = $toplam + $doping_anasayfa_1;
    $dp1_tutar = $doping_anasayfa_1;
} elseif ($dp1 == 2) {
    $toplam = $toplam + $doping_anasayfa_2;
    $dp1_tutar = $doping_anasayfa_2;
} elseif ($dp1 == 4) {
    $toplam = $toplam + $doping_anasayfa_4;
    $dp1_tutar = $doping_anasayfa_4;
}

if ($dp2 == 1) {
    $toplam = $toplam + $doping_kategori_1;
    $dp2_tutar = $doping_kategori_1;
} elseif ($dp2 == 2) {
    $toplam = $toplam + $doping_kategori_2;
    $dp2_tutar = $doping_kategori_2;
} elseif ($dp2 == 4) {
    $toplam = $toplam + $doping_kategori_4;
    $dp2_tutar = $doping_kategori_4;
}

if ($dp3 == 1) {
    $toplam = $toplam + $doping_acil_1;
    $dp3_tutar = $doping_acil_1;
} elseif ($dp3 == 2) {
    $toplam = $toplam + $doping_acil_2;
    $dp3_tutar = $doping_acil_2;
} elseif ($dp3 == 4) {
    $toplam = $toplam + $doping_acil_4;
    $dp3_tutar = $doping_acil_4;
}

if ($dp4 == 1) {
    $toplam = $toplam + $doping_kalin_1;
    $dp4_tutar = $doping_kalin_1;
} elseif ($dp4 == 2) {
    $toplam = $toplam + $doping_kalin_2;
    $dp4_tutar = $doping_kalin_2;
} elseif ($dp4 == 4) {
    $toplam = $toplam + $doping_kalin_4;
    $dp4_tutar = $doping_kalin_4;
}
$tt = $toplam;
if ($toplam == "") {
    header("location: index.php?page=yayin");
}
if ($toplam > 0) {
    $toplam = number_format($toplam, 2, ',', '.');
    if ($dp1 != 0) {
        $sql = $db->prepare('INSERT INTO doping (Id, ilanId,name, val, selec, category1, category2, category3, category4, category5, category6, category7, category8,category9,category10,odeme,onay,tutar) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
        $sql->execute(array(
            null,
            $id,
            "anasayfa",
            "0000-00-00",
            $dp1,
            $il->category1,
            $il->category2,
            $il->category3,
            $il->category4,
            $il->category5,
            $il->category6,
            $il->category7,
            $il->category8,
            $il->category9,
            $il->category10,
            0,
            0,
            $toplam
        ));
        $v1 = array(
            '<tr><td width="150">Vitrine</td><td  width="100">' . $dp1 . ' Hafta</td><td>' . $dp1_tutar . '</td>'
        );
    }

    if ($dp2 != 0) {
        $sql = $db->prepare('INSERT INTO doping (Id, ilanId,name, val, selec, category1, category2, category3, category4, category5, category6, category7, category8,category9,category10,odeme,onay,tutar) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
        $sql->execute(array(
            null,
            $id,
            "kategori",
            "0000-00-00",
            $dp2,
            $il->category1,
            $il->category2,
            $il->category3,
            $il->category4,
            $il->category5,
            $il->category6,
            $il->category7,
            $il->category8,
            $il->category9,
            $il->category10,
            0,
            0,
            $toplam
        ));
        $v1[] = ('<tr><td>Kategori Vitrini</td><td>' . $dp2 . ' Hafta</td><td>' . $dp2_tutar . '</td>');
    }

    if ($dp3 != 0) {
        $sql = $db->prepare('INSERT INTO doping (Id, ilanId,name, val, selec, category1, category2, category3, category4, category5, category6, category7, category8,category9,category10,odeme,onay,tutar) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
        $sql->execute(array(
            null,
            $id,
            "acil",
            "0000-00-00",
            $dp3,
            $il->category1,
            $il->category2,
            $il->category3,
            $il->category4,
            $il->category5,
            $il->category6,
            $il->category7,
            $il->category8,
            $il->category9,
            $il->category10,
            0,
            0,
            $toplam
        ));
        $v1[] = ('<tr><td>Acil İlanlar</td><td>' . $dp3 . ' Hafta</td><td>' . $dp3_tutar . '</td>');
    }

    if ($dp4 != 0) {
        $sql = $db->prepare('INSERT INTO doping (Id, ilanId,name, val, selec, category1, category2, category3, category4, category5, category6, category7, category8,category9,category10,odeme,onay,tutar) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
        $sql->execute(array(
            null,
            $id,
            "kalin",
            "0000-00-00",
            $dp4,
            $il->category1,
            $il->category2,
            $il->category3,
            $il->category4,
            $il->category5,
            $il->category6,
            $il->category7,
            $il->category8,
            $il->category9,
            $il->category10,
            0,
            0,
            $toplam
        ));
        $v1[] = ('<tr><td>Kalın - Renkli Yazı</td><td>' . $dp4 . ' Hafta</td><td>' . $dp4_tutar . '</td>');
    }
}
if ($toplam != ""){
$sql = $db->prepare('INSERT INTO odemeler (Id, tip, tutar, uyeId, aciklama, durum, ilanId, magazaId) VALUES (?,?,?,?,?,?,?,?)');
$sql->execute(array(null, "Doping Yayın Ödemesi", $toplam, $uye, "$id Nolu İlanın Doping Yayın Ücreti", 0, $id, 0));
$odemelerId = $db->lastInsertId();
}
?>

<div class="container top15">
    <div class="panel panel-default">
        <div class="panel-heading">Sipariş Özeti</div>
        <div class="panel-body">
            <div style="padding:10px; border:solid 1px #d8d8d8">
                <table class="table table-striped">
                    <thead>
                        <tr style="font-size:14px !important">
                            <td><b>Doping Adı</b></td>
                            <td><b>Süre</b></td>
                            <td><b>Fiyat</b></td>
                        </tr>
                    </thead>
                    <tbody style="font-size:12px !important">
                        <?php
                        foreach ($v1 as $n) {
                            echo $n;
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr style="font-size:14px !important">
                            <td><b></b></td>
                            <td width="125"  style="font-size:12px !important"><b>Genel Toplam</b></td>
                            <td  style="font-size:12px !important"><b>
                                    <?php echo $toplam; ?>
                                </b></td>
                        </tr>
                    <tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<?
	$odemesistemleri = $db->query("SELECT * FROM odemesistemleri");
	$odm = $odemesistemleri->fetch(PDO::FETCH_ASSOC);
?>
<? if ($odm["iyzico"] == 1){
    
    require_once('iyzipay/config.php');
    $request = new \Iyzipay\Request\CreateCheckoutFormInitializeRequest();
    $request->setLocale(\Iyzipay\Model\Locale::TR);
    $request->setPrice($tt);
    $request->setPaidPrice($tt);
    $request->setCurrency(\Iyzipay\Model\Currency::TL);
    $request->setPaymentGroup(\Iyzipay\Model\PaymentGroup::LISTING);
    $request->setCallbackUrl("https://www.ilanpro.net/odeme_kontrol.php");
    $request->setEnabledInstallments(array(2, 3, 6, 9));
    
    
    
    $uyeBilgileri = $db->query("SELECT * FROM users WHERE Id = $uye ")->fetch(PDO::FETCH_ASSOC);
    
    $uyeAdSoyad = explode (" ",$uyeBilgileri['ad_soyad'],2);
    $uyeAd = $uyeAdSoyad[0];
    $uyeSoyad = $uyeAdSoyad[1];
    
    
    $buyer = new \Iyzipay\Model\Buyer();
    $buyer->setId($uyeBilgileri['Id']);
    $buyer->setName($uyeAd);
    $buyer->setSurname($uyeSoyad);
    $buyer->setGsmNumber($uyeBilgileri['gsm']);
    $buyer->setEmail($uyeBilgileri['eposta']);
    $buyer->setIdentityNumber("11111111111");
    $buyer->setRegistrationAddress("Şirinevler Mah. Bahçelievler");
    $buyer->setIp("85.34.78.112");
    $buyer->setCity("İstanbul");
    $buyer->setCountry("Turkey");
    $request->setBuyer($buyer);
    
    $billingAddress = new \Iyzipay\Model\Address();
    $billingAddress->setContactName($uyeBilgileri['ad_soyad']);
    $billingAddress->setCity("İstanbul");
    $billingAddress->setCountry("Turkey");
    $billingAddress->setAddress("Şirinevler Mah. Bahçelievler");
    $request->setBillingAddress($billingAddress);
    
    $aciklama = $id . " Nolu İlanın Doping Yayın Ücreti";
    $basketItems = array();
    $item = new \Iyzipay\Model\BasketItem();
    $item->setId($odemelerId);
    $item->setName($aciklama);
    $item->setCategory1("Listeleme");
    $item->setItemType(\Iyzipay\Model\BasketItemType::VIRTUAL);
    $item->setPrice($tt);
    $basketItems[] = $item;
    $request->setBasketItems($basketItems);
    
    $checkoutFormInitialize = \Iyzipay\Model\CheckoutFormInitialize::create($request, Config::options());
    // print_r($checkoutFormInitialize);
    //print_r($checkoutFormInitialize->getStatus());
    print_r($checkoutFormInitialize->getErrorMessage());
    print_r($checkoutFormInitialize->getCheckoutFormContent());
    
?>
<div class="container top15">
    <div class="panel panel-default">
        <div class="panel-heading">Kredi Kartı İle Ödeme</div>
    </div>
     <div class="panel-body">
    <div id="iyzipay-checkout-form" class="responsive" style="overflow:auto"></div>
    </div>
</div>
<? } ?>
<? if ($odm["havale"] == 1){ ?>
<div class="container top15">
    <div class="panel panel-default">
        <div class="panel-heading">Havale / Eft</div>
        <div class="panel-body"><b>
                <?php echo $toplam; ?>
            </b> ödemenizi aşağıdaki hesap numaralarımıza yapabilirsiniz.<br />
            Ödemeniz açıklama bölümüne bir sonraki aşamada verilecek olan sipariş numaranızı girmeyi ve bana özel bölümünde bulunan ödeme bildirimi menüsünden bildirim göndermeyi unutmayınız.<br />
            <br />
            <h4>Banka Hesap Numaralarımız</h4>
            <div style="padding:10px; border:solid 1px #d8d8d8">
                <table class="table table-striped">
                    <thead>
                        <tr style="font-size:14px !important">
                            <td><b>Banka Adı</b></td>
                            <td><b>Şube Kodu</b></td>
                            <td><b>Hesap No</b></td>
                            <td><b>IBAN</b></td>
                        </tr>
                    </thead>
                    <tbody style="font-size:12px !important">
                        <?php
                        $sql = $db->query("SELECT * FROM bank");
                        while ($b = $sql->fetch(PDO::FETCH_OBJ)) {
                            echo '
                         <tr style="font-size:12px !important">
                            <td>' . $b->bankaadi . '</td>
                            <td>' . $b->sube . '</td>
                            <td>' . $b->hesap . '</td>
                            <td>' . $b->iban . '</td>
	</tr>';

                        }
                        ?>
                    </tbody>
                </table>
                <input type="button" class="btn btn-primary" value="Kaydet ve İlerle" onclick="window.location.href = 'index.php?page=dopingyayinla&id=<?php echo $id; ?>>&odeme=0'">
            </div>
        </div>
    </div>
	</div>
<? } ?>


