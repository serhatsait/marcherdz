<?php
require_once 'functions.php';
require_once __DIR__ . '/facebook-php-sdk/autoload.php';
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
$redirectURL 	= 'https://www.marcherdz.com/facebook.php';
$fbPermissions 	= array('email'); 
$fb = new Facebook(array(
	'app_id' => $appId,
	'app_secret' => $appSecret,
	'default_graph_version' => 'v2.10',
));
$helper = $fb->getRedirectLoginHelper();
$_SESSION['FBRLH_state']=$_GET['state'];
try {
	if(isset($_SESSION['facebook_access_token'])){
		$accessToken = $_SESSION['facebook_access_token'];
	}else{
  		$accessToken = $helper->getAccessToken();
	}
} catch(FacebookResponseException $e) {
 	echo 'Graph returned an error: ' . $e->getMessage();
  	exit;
} catch(FacebookSDKException $e) {
	echo 'Facebook SDK returned an error: ' . $e->getMessage();
  	exit;
}


if(isset($accessToken)){
	if(isset($_SESSION['facebook_access_token'])){
		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
	}else{
		$_SESSION['facebook_access_token'] = (string) $accessToken;
		$oAuth2Client = $fb->getOAuth2Client();
		$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
		$_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
	}
	if(isset($_GET['code'])){
		header('Location: ./');
	}
	try {
		$profileRequest = $fb->get('/me?fields=name,first_name,last_name,email,link,gender,locale,picture');
		$fbUserProfile = $profileRequest->getGraphNode()->asArray();
	} catch(FacebookResponseException $e) {
		echo 'Graph returned an error: ' . $e->getMessage();
		session_destroy();
		header("Location: ./");
		exit;
	} catch(FacebookSDKException $e) {
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
		exit;
	}
	//
	$a1 = $fbUserProfile["id"];
	$sql = $db->query("SELECT * FROM users WHERE parola = '$a1'");
	if ($sql->rowCount() > 0){
		$a = $sql->fetch(PDO::FETCH_ASSOC);
		$_SESSION['uye'] = $a["Id"];
		$_SESSION['adsoyad'] = $a["ad_soyad"];
		header("location: index.php");
		} else {
		$tarih = date("Y-m-d");	
		$sql = $db->prepare('INSERT INTO users (Id, ad_soyad,dogum_tarihi, cinsiyet, eposta, parola, telefon, gsm, il, ilce, kayit_tarihi, aktivasyon, aktivasyonkodu) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)');
		$sql->execute(array(null, $fbUserProfile["first_name"]." ".$fbUserProfile["last_name"], null, null, "FacebookLogin", $fbUserProfile["id"], null, null, null, null, $tarih, 1, 1));
		$id = $db->lastInsertId();
		$_SESSION['uye'] = $id;
		$_SESSION['adsoyad'] = $fbUserProfile["first_name"]." ".$fbUserProfile["last_name"];
		header("location: index.php");
		}
	//
}else{
	$loginURL = $helper->getLoginUrl($redirectURL, $fbPermissions);
	$o = $loginURL;
	header("location: $o");
}
?>