<?php 
ob_start();
session_set_cookie_params(0, '/', '.ilanpro.net');
session_start();
header("Content-Type: text/html; charset=utf-8");
if ($_SESSION["uye"] == "") {
	header("location: /login/");
}
include 'config.php';
ini_set("display_errors",1);
error_reporting(E_ALL ^ E_NOTICE);

try {
	$db = new PDO("mysql:host=localhost;dbname=".$MysqlDbName, $MysqlDbUserName, $MysqlDbUserPass,array(PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES utf8",PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET utf8"));
} catch ( PDOException $e ){
	print $e->getMessage();
}

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
	
	$result = json_decode($checkoutForm->getRawResult(), true);
	$items = $result['itemTransactions'];
	foreach ($items as $item) {
		$itemId[] = $item['itemId'];
	}
	
	$id = $itemId[0];
		$sql = $db->query("SELECT * FROM odemeler WHERE Id = '$id'");
		$x = $sql->fetch(PDO::FETCH_ASSOC);
		if ($x["tip"] == "Mağaza Ödemesi"){
			##
			$sql = $db->query("SELECT * FROM magazalar WHERE Id = '{$x['magazaId']}'");
			$a = $sql->fetch(PDO::FETCH_ASSOC);
			$tarih = date("Y-m-d");
			$start = date("Y-m-d", strtotime("+$a[sure] month", strtotime($tarih)));
			$sql2 = "UPDATE magazalar SET onay = '1', bitis = '$start' WHERE Id = '{$x['magazaId']}'";
			$stmt = $db->prepare($sql2);
			$stmt->execute();
			$sql = $db->prepare("DELETE FROM odemeler WHERE Id = '{$id}'");
			$sql->execute();
			$sql = $db->prepare("DELETE FROM bildirimler WHERE odemeId = '{$id}'");
			$sql->execute();
			##
			echo '<script>setTimeout(function(){window.location.href = "index.php?page=medit";},3000);</script><div class="show_success">Ödeme İşlemi Tamamlanmıştır, Yönlendiriliyorsunuz...</div>';
		} else {
			#######
			$sqlxx = $db->query("SELECT * FROM doping WHERE ilanId = '{$x['ilanId']}'");
			while ($f = $sqlxx->fetch(PDO::FETCH_ASSOC)){
				$tarih = date("Y-m-d");
				$gun = 7 * $f[selec];
				$start = date("Y-m-d", strtotime("+$gun days", strtotime($tarih)));
				$sql2 = "UPDATE doping SET onay = '1', val = '$start' WHERE Id = '{$f['Id']}'";
				$stmt = $db->prepare($sql2);
				$stmt->execute();
				$sql = $db->prepare("DELETE FROM odemeler WHERE Id = '{$id}'");
				$sql->execute();
				$sql = $db->prepare("DELETE FROM bildirimler WHERE odemeId = '{$id}'");
				$sql->execute();
			}
			######
			
			echo '<script>setTimeout(function(){window.location.href = "index.php?page=dopingyayinla&id='.$x['ilanId'].'&odeme=debit";},3000);</script><div class="show_success">Ödeme İşlemi Tamamlanmıştır, Yönlendiriliyorsunuz...</div>';
		}

} else {
		echo '<script>setTimeout(function(){window.location.href = "index.php?page=banaozel&type=odemeler";},3000);</script><div class="show_success">Bir hata oluştu, Yönlendiriliyorsunuz...</div>';
	
}


?>