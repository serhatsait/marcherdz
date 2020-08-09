<?
if ($_SESSION["uye"] == ""){ header("location: /login/"); }
$uye = $_SESSION['uye'];
$a1 = $_POST["a1"];
$a2 = $_POST["a2"];
$a3 = $_POST["a3"];
$a4 = $_POST["a4"];
$a5 = $_POST["a5"];
$a6 = $_POST["a6"];
include('class.upload.php');
$logo = $_FILES['logo'];
$handle = new Upload($logo);
$dir_dest = "uploads/";
$handle->image_convert	= 'jpg';
$handle->allowed		= array ( 'image/*' );
$handle->Process($dir_dest);
if ($handle->processed) { $resim = $handle->file_dst_name; }

$mslider = $_FILES['mslider'];
$handle = new Upload($mslider);
$dir_dest = "uploads/";
$handle->image_convert	= 'jpg';
$handle->allowed		= array ( 'image/*' );
$handle->Process($dir_dest);
if ($handle->processed) { $mslider2 = $handle->file_dst_name; }


$sql = $db->query("SELECT * FROM magazalar WHERE uyeId = '$uye'");
if ($sql->rowCount() > 0){
header("location:index.php");
} else {
if ($a5 == "3"){ $fiyat = $magaza1; } elseif ($a5 == "6"){ $fiyat = $magaza2; } elseif ($a5 == "12"){ $fiyat = $magaza3; }
$sql = $db->prepare('INSERT INTO magazalar (Id, uyeId, onay, magazaadi, adres, aciklama, kategori, sure, bitis, odemeturu, fiyat, logo, magazaslider) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)');
$sql->execute(array(null, $uye, 0, $a1, $a2, $a3, "0", $a5, "0000-00-00", $a6, $fiyat,$resim,$mslider2));
$id = $db->lastInsertId();

$sql = $db->prepare('INSERT INTO odemeler (Id, tip, tutar, uyeId, aciklama, durum, ilanId, magazaId) VALUES (?,?,?,?,?,?,?,?)');
$sql->execute(array(null, "Mağaza Ödemesi", $fiyat, $uye, "$id Nolu $a5 Aylık Mağaza Ödemesi", 0, 0, $id));
$odemelerId = $db->lastInsertId();

?>

<div class="container top15">
    <div class="panel panel-default">
        <div class="panel-heading">Mağaza Aç</div>
        <div class="panel-body">
            
			<? if ($a6 == 0){ ?>
            Aşağıda bulunan hesap numaralarımıza ödemenizi yapabilirsiniz. Ödeme yapmanız gereken tutar : <strong><? echo $fiyat; ?> TL</strong> 'dir.<br>
            Ödeme açıklamasına siparişniz numaranızı yazmayı unutmayınız sipariş numaranız : <strong><? echo $id; ?></strong><br>
            Ödeme yaptıktan sonra <u><strong>BANAÖZEL / ÖDEME BİLDİRİMİ</strong></u> bölümünden bildirim yapabilirsiniz<br><br>
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
				 <a href="index.php" class="btn btn-primary">Anasayfa dönmek için tıklayınız</a>
				</div>
        </div>
    </div>
</div>
				
			<? } ?>
			
			
			<? if ($a6 == 3){
				
				echo'<div class="alert alert-success">
                <h4 style="margin-bottom:0px !important; padding-bottom: 5px !important">Kredi Kartı İle  Ödeme</h4>
                Mağazanız Ödeme Sonrası Editörlerimiz Tarafından İncelenip Onaylanacaktır.</div>';
				
				require_once('iyzipay/config.php');
				$request = new \Iyzipay\Request\CreateCheckoutFormInitializeRequest();
				$request->setLocale(\Iyzipay\Model\Locale::TR);
				$request->setPrice($fiyat);
				$request->setPaidPrice($fiyat);
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
				$item->setCategory1("Mağaza");
				$item->setItemType(\Iyzipay\Model\BasketItemType::VIRTUAL);
				$item->setPrice($fiyat);
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
			
               
            
<? } ?>