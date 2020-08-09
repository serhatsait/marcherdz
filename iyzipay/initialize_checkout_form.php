<?php
include("setting.php");
ob_start();
session_start();
if ($_SESSION['giris'] != 1){

	header("location: uyegirisi.html");

}

check_ssl_page();

if($mysqli->query("select Id from pos_ayarlar where status='1' limit 1")->num_rows!=0){
$post=guvenlik($_POST['post']);
$item_id=guvenlik($_POST['item_Id']);
$uye = $_SESSION['uye'];
if($post=='1' and !empty($item_id) and !empty($uye)){
$uye_detay=$mysqli->query("select * from uyeler where Id='".$uye."' and onay='1'")->fetch_assoc();
$item_id=explode(",",$item_id);
for ($i = 0; $i <= count($item_id)-1; $i++) {
if(is_numeric($item_id[$i])){
$pay_check=$mysqli->query("select tutar from siparis where Id='".$item_id[$i]."' and durum='0' and uyeId='".$uye."'");
$pay_check_details=$pay_check->fetch_assoc();
if($pay_check->num_rows=='0'){exit('<div class="show_error">Hata: İşlem Geçersiz</div>');}
$pay_Id[]=$item_id[$i];
$pay_amount[]=$pay_check_details[tutar];
}
}
if(count($pay_amount)==0){exit('<div class="show_error">Hata: İşlem Geçersiz</div>');}
$amount = array_sum($pay_amount);
}
}
require_once('config.php');

# create request class
$request = new \Iyzipay\Request\CreateCheckoutFormInitializeRequest();
$request->setLocale(\Iyzipay\Model\Locale::TR);
$request->setConversationId("123456789");
$request->setPrice("1");
//$request->setPaidPrice($amount);
$request->setPaidPrice("1.2");
$request->setCurrency(\Iyzipay\Model\Currency::TL);
$request->setBasketId("B67832");
$request->setPaymentGroup(\Iyzipay\Model\PaymentGroup::PRODUCT);
$request->setCallbackUrl("https://www.merchant.com/callback");
$request->setEnabledInstallments(array(2, 3, 6, 9));

$buyer = new \Iyzipay\Model\Buyer();
$buyer->setId("BY789");
$buyer->setName("John");
$buyer->setSurname("Doe");
$buyer->setGsmNumber("+905350000000");
$buyer->setEmail("email@email.com");
$buyer->setIdentityNumber("74300864791");
$buyer->setLastLoginDate("2015-10-05 12:43:35");
$buyer->setRegistrationDate("2013-04-21 15:12:09");
$buyer->setRegistrationAddress("Nidakule Göztepe, Merdivenköy Mah. Bora Sok. No:1");
$buyer->setIp("85.34.78.112");
$buyer->setCity("Istanbul");
$buyer->setCountry("Turkey");
$buyer->setZipCode("34732");
$request->setBuyer($buyer);

$shippingAddress = new \Iyzipay\Model\Address();
$shippingAddress->setContactName("Jane Doe");
$shippingAddress->setCity("Istanbul");
$shippingAddress->setCountry("Turkey");
$shippingAddress->setAddress("Nidakule Göztepe, Merdivenköy Mah. Bora Sok. No:1");
$shippingAddress->setZipCode("34742");
$request->setShippingAddress($shippingAddress);

$billingAddress = new \Iyzipay\Model\Address();
$billingAddress->setContactName("Jane Doe");
$billingAddress->setCity("Istanbul");
$billingAddress->setCountry("Turkey");
$billingAddress->setAddress("Nidakule Göztepe, Merdivenköy Mah. Bora Sok. No:1");
$billingAddress->setZipCode("34742");
$request->setBillingAddress($billingAddress);

$basketItems = array();
$firstBasketItem = new \Iyzipay\Model\BasketItem();
$firstBasketItem->setId("BI101");
$firstBasketItem->setName("Binocular");
$firstBasketItem->setCategory1("Collectibles");
$firstBasketItem->setCategory2("Accessories");
$firstBasketItem->setItemType(\Iyzipay\Model\BasketItemType::PHYSICAL);
$firstBasketItem->setPrice("0.3");
$basketItems[0] = $firstBasketItem;

$secondBasketItem = new \Iyzipay\Model\BasketItem();
$secondBasketItem->setId("BI102");
$secondBasketItem->setName("Game code");
$secondBasketItem->setCategory1("Game");
$secondBasketItem->setCategory2("Online Game Items");
$secondBasketItem->setItemType(\Iyzipay\Model\BasketItemType::VIRTUAL);
$secondBasketItem->setPrice("0.5");
$basketItems[1] = $secondBasketItem;

$thirdBasketItem = new \Iyzipay\Model\BasketItem();
$thirdBasketItem->setId("BI103");
$thirdBasketItem->setName("Usb");
$thirdBasketItem->setCategory1("Electronics");
$thirdBasketItem->setCategory2("Usb / Cable");
$thirdBasketItem->setItemType(\Iyzipay\Model\BasketItemType::PHYSICAL);
$thirdBasketItem->setPrice("0.2");
$basketItems[2] = $thirdBasketItem;
$request->setBasketItems($basketItems);

# make request
$checkoutFormInitialize = \Iyzipay\Model\CheckoutFormInitialize::create($request, Config::options());

# print result
//print_r($checkoutFormInitialize);
//print_r($checkoutFormInitialize->getStatus());
print_r($checkoutFormInitialize->getErrorMessage());
print_r($checkoutFormInitialize->getCheckoutFormContent());

?>

<html>
<body>
	<div id="iyzipay-checkout-form" class="responsive"></div>
</body>
</html>