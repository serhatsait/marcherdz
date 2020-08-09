<?
if ($_SESSION["uye"] == ""){ header("location: /login/"); }

$a2 = $_POST['a2'];
$a3 = $_POST['a3'];
$tcc = $_POST['tcc'];
$a5 = $_POST['a5'];
$a6 = $_POST['a6'];
$a7 = $_POST['a7'];
$a8 = $_POST['a8'];
$a9 = $_POST['a9'];
$a10 = $_POST['a10'];
$a11 = $_POST['a11'];
$fatura = $_POST['fatura'];
$uye = $_SESSION['uye'];
if ($tcc != "") {
$_SESSION['tcNo'] = $tcc;
}
$sql = $db->prepare('INSERT INTO teslimat (Id,adsoyad, tc, firmaadi, vergidairesi, vergino, telefon, il, ilce, adres, uyeId, siparisId	) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)');
$sql->execute(array(null,$a2, $tcc, "", "", "", $a11, $a7, $a8, $a10, $uye, ""));

$sql55 = $db->prepare('INSERT INTO fatura (Id, adsoyad, tc, firmaadi, vergidairesi, vergino, telefon, il, ilce, adres, uyeId, siparisId	) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)');
$sql55->execute(array(null,$a2, $tcc, $a3, $a5, $a6, $a11, $a7, $a8, $a10, $uye, ""));

$id = $_SESSION['ilan'];
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

<div class="container top15">
    <div class="panel panel-default">
        <div class="panel-heading">Ürün</div>
        <div class="panel-body">
            <?
            echo '
            <div class="adv' . $class . '" onclick="window.location.href=\'i-'.$row["Id"].'-'.slugify($row["title"]).'.html\'" style="cursor:pointer">
            <div class="row no-gutter">
            <div class="col-xs-1"><a href="i-'.$row["Id"].'-'.slugify($row["title"]).'.html"><img src="' . $src . '" class="img-thumbnail" width="100" /></a></div>
            <div class="col-xs-9" style="width: 100%;"><strong style="font-size:14px">' . $row["title"] . '</strong>
            <br><span style="font-size:12px"><i class="fa fa-clock-o" aria-hidden="true"></i> ' . $e[2] . '-' . $e[1] . '-' . $e[0] . ' <br><i class="fa fa-map-marker" aria-hidden="true"></i> ' . $ilyaz["il_adi"] . ' / ' . $ilceyaz["county_adi"] . ' / ' . $mahalleyaz["districtname"] . '</span>
            </div>
            <div class="col-xs-2" style="text-align:center; padding:5px"><a href="javascript:void(0)" class="btn btn-danger btn-block price">' . str_replace(",", ".", number_format($row["price"])) . ' ' . $row["exchange"] . '</a></div>
            </div>
            </div>';
            ?>
        </div>
    </div>
</div>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">Teslimat ve Fatura</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-6" style="width: 100%;">
                    <div class="panel panel-default">
                        <div class="panel-body" style="height:170px">
                            <h3 style="padding:0px !important; margin:0px; font-size:16px; font-weight:bold; border-bottom:solid 1px #ededed; padding-bottom:10px !important; margin-bottom:5px">Teslimat Adresi</h3>
                            <?
                            $uye = $_SESSION["uye"];
                            $sql = $db->query("SELECT * FROM teslimat WHERE uyeId = '$uye' ORDER BY Id DESC LIMIT 1");
                            $a = $sql->fetch(PDO::FETCH_ASSOC);
                            if ($a["tip"] == 0){
                            echo '<b>'.$a["adsoyad"].' / TC No : '.$a["tc"].'</b>';
                            } else {
                            echo '<b>'.$a["firmaadi"].'</b><br>'.$a["vergidairesi"].' / '.$a["vergino"].'';
                            }
                            $il    = $db->query("SELECT * FROM city WHERE id = '{$a['il']}'");
                            $ilyaz = $il->fetch(PDO::FETCH_ASSOC);
                            $ilce    = $db->query("SELECT * FROM county WHERE id = '{$a['ilce']}'");
                            $ilceyaz = $ilce->fetch(PDO::FETCH_ASSOC);

                            $mahalle    = $db->query("SELECT * FROM locality WHERE id = '{$a['mahalle']}'");
                            $mahalleyaz = $mahalle->fetch(PDO::FETCH_ASSOC);

                            echo '<br><b>Adres :</b>'.$a["adres"].'<br> ' . $ilyaz["il_adi"] . ' / ' . $ilceyaz["county_adi"] . ' / ' . $mahalleyaz["districtname"] . '<br><b>Telefon :</b>'.$a["telefon"].'';
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6" style="width: 100%;">
                    <div class="panel panel-default">
                        <div class="panel-body" style="height:170px">
                            <h3 style="padding:0px !important; margin:0px; font-size:16px; font-weight:bold; border-bottom:solid 1px #ededed; padding-bottom:10px !important; margin-bottom:5px">Firma Bilgileri (Yoksa Boş Görünecektir)</h3>
                            <?
                            $uye = $_SESSION["uye"];
                            $sql = $db->query("SELECT * FROM fatura WHERE uyeId = '$uye' ORDER BY Id DESC LIMIT 1");
                            $a = $sql->fetch(PDO::FETCH_ASSOC);
                            
                            echo '<b>'.$a["adsoyad"].' / TC No : '.$a["tc"].'</b><br>';
                           
                            echo '<b>Firma Adı :</b>'.$a["firmaadi"].'<br><b>Vergi Dairesi :</b>'.$a["vergidairesi"].' / <b>Vergi No :</b> '.$a["vergino"].'';
                         
                            $il    = $db->query("SELECT * FROM city WHERE id = '{$a['il']}'");
                            $ilyaz = $il->fetch(PDO::FETCH_ASSOC);
                            $ilce    = $db->query("SELECT * FROM county WHERE id = '{$a['ilce']}'");
                            $ilceyaz = $ilce->fetch(PDO::FETCH_ASSOC);

                            $mahalle    = $db->query("SELECT * FROM locality WHERE id = '{$a['mahalle']}'");
                            $mahalleyaz = $mahalle->fetch(PDO::FETCH_ASSOC);

                            echo '<br><b>Adres :</b>'.$a["adres"].'<br> ' . $ilyaz["il_adi"] . ' / ' . $ilceyaz["county_adi"] . ' / ' . $mahalleyaz["districtname"] . '<br><b>Telefon :</b>'.$a["telefon"].'';
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">Kredi Kartı Bilgileri</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12">
				<?php 
				
				function getUserIP()
				{
					$client  = @$_SERVER['HTTP_CLIENT_IP'];
					$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
					$remote  = $_SERVER['REMOTE_ADDR'];
					
					if(filter_var($client, FILTER_VALIDATE_IP))
					{
						$ip = $client;
					}
					elseif(filter_var($forward, FILTER_VALIDATE_IP))
					{
						$ip = $forward;
					}
					else
					{
						$ip = $remote;
					}
					
					return $ip;
				}
				
				$ip = getUserIP();
				
				require_once('iyzipay/config.php');
				$request = new \Iyzipay\Request\CreateCheckoutFormInitializeRequest();
				$request->setLocale(\Iyzipay\Model\Locale::TR);
				$request->setPrice($row["price"]);
				$request->setPaidPrice($row["price"]);
				$request->setCurrency(\Iyzipay\Model\Currency::TL);
				$request->setPaymentGroup(\Iyzipay\Model\PaymentGroup::PRODUCT);
				$request->setCallbackUrl("https://www.istekapida.com/index.php?page=odeme");
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
				$buyer->setIdentityNumber($_SESSION["tcNo"]);
				$buyer->setRegistrationAddress($a10);
				$buyer->setIp($ip);
				$buyer->setCity($ilyaz["il_adi"]);
				$buyer->setCountry("Turkey");
				$request->setBuyer($buyer);
				
				$shippingAddress = new \Iyzipay\Model\Address();
				$shippingAddress->setContactName($a2);
				$shippingAddress->setCity($ilyaz["il_adi"]);
				$shippingAddress->setCountry("Turkey");
				$shippingAddress->setAddress($a10);
				$shippingAddress->setZipCode("34000");
				$request->setShippingAddress($shippingAddress);
				
				
				$billingAddress = new \Iyzipay\Model\Address();
				$billingAddress->setContactName($uyeBilgileri['ad_soyad']);
				$billingAddress->setCity($ilyaz["il_adi"]);
				$billingAddress->setCountry("Turkey");
				$billingAddress->setAddress($a10);
				$request->setBillingAddress($billingAddress);
				
				$aciklama = $row["title"];
				
				$basketItems = array();
				$item = new \Iyzipay\Model\BasketItem();
				$item->setId($id);
				$item->setName($aciklama);
				$item->setCategory1("GET");
				$item->setItemType(\Iyzipay\Model\BasketItemType::PHYSICAL);
				$item->setPrice($row["price"]);
				$basketItems[] = $item;
				$request->setBasketItems($basketItems);
				
				$checkoutFormInitialize = \Iyzipay\Model\CheckoutFormInitialize::create($request, Config::options());
				// print_r($checkoutFormInitialize);
				//print_r($checkoutFormInitialize->getStatus());
				print_r($checkoutFormInitialize->getErrorMessage());
				print_r($checkoutFormInitialize->getCheckoutFormContent());
				?>
				<div id="iyzipay-checkout-form" class="responsive" style="overflow:auto"></div>
                </div>
            </div>


        </div>
    </div>
</div>
