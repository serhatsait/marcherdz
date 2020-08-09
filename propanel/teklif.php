<?
include '../functions.php';
$tutar = $_POST["tutar"];
$tutar = str_replace(".","",$tutar);
$id = $_POST["id"];


function islem($id)
{
global $db;
$sql = $db->query("SELECT * FROM ilanlar WHERE Id = '$id'");
while ($a = $sql->fetch(PDO::FETCH_ASSOC)){
	$e = explode(" ", $a["bitiszamani"]);
	$saat = $e[1];
	$e2 = explode("-",$e[0]);
	
$d = DateTime::createFromFormat('d-m-Y H:i', ''.$e2[0].'-'.$e2[1].'-'.$e2[2].' '.$saat.'');
$ilan = $d->getTimestamp();

$d = DateTime::createFromFormat('d-m-Y H:i', date("d-m-Y H:i"));
$bugun = $d->getTimestamp();

if ($bugun >= $ilan){ } else { $kk = 0; }
}
}

if (islem($id) == 0){


$sql = $db->query("SELECT * FROM ilanlar WHERE Id = '$id'");
$a = $sql->fetch(PDO::FETCH_ASSOC);

$sql3 = $db->query("SELECT * FROM teklifler WHERE ilanId = '$id' ORDER BY Id DESC LIMIT 1");
$c = $sql3->fetch(PDO::FETCH_ASSOC);
if ($c["tutar"] == ""){
	if ($tutar < $a["fiyat2"]){
	echo '3';
	return;	
	}
}

if ($c["tutar"] == ""){ $c["tutar"] = $a["fiyat2"]; }
$minimum = $c["tutar"] + $a["fiyat3"];
if ($tutar < $minimum){
echo "1";
} else {


$sql3 = $db->query("SELECT * FROM teklifler WHERE ilanId = '$id' ORDER BY Id DESC LIMIT 1");
$c = $sql3->fetch(PDO::FETCH_ASSOC);
$son = $c["uyeId"];

if ($tutar <= $a["fiyat2"]){ echo '3'; return;
} else { $v = 0; }
	if ($v == 0){
	if ($tutar > $a["fiyat3"]){
		$l = 0;
	} else {
		if ($tutar == $a["fiyat3"]){
		$l = 0;	
		} else {
		echo '1';
		$l = 11;
		}
	}
	
	if ($l == 0){
	$sql2 = $db->query("SELECT * FROM teklifler WHERE ilanId = '$id' ORDER BY Id DESC LIMIT 1");
	$b = $sql2->fetch(PDO::FETCH_ASSOC);
	
	
	if ($b["tutar"] == ""){
	$uye = $_SESSION["uye"];
	$tarih = date("d-m-Y h:i");
	$sql = $db->prepare('INSERT INTO teklifler (Id, ilanId, uyeId, tutar, tarih) VALUES (?,?,?,?,?)');
	$sql->execute(array(null, $id, $uye, $tutar, $tarih));
	
	
	//
	$sql4 = $db->query("SELECT * FROM users WHERE Id = '$son'");
	$d = $sql4->fetch(PDO::FETCH_ASSOC);
	require 'PHPMailer-master/PHPMailerAutoload.php';
	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->Host = $MailHost;
	$mail->SMTPAuth = true;
	$mail->Username = $MailUsername;
	$mail->Password = $MailPassword;
	$mail->Port = 587;
	$mail->addAddress($d["eposta"]);
	$mail->setFrom($MailUsername, $MailTitleName);
	$mail->isHTML(true);
	$mail->CharSet  ="utf-8";
	$mail->Subject = 'Teklifiniz geçildi';
	$mail->Body    = '<strong>Sayın '.$d["ad_soyad"].';</strong> '.$a["title"].' adlı ilana verdiğiniz teklif geçildi.<br>İlana yeniden teklif vermek için aşağıdaki linke tıklayınız<br><br><a href="'.$base_url.'/i-'.$a["Id"].'-'.slugify($a["title"]).'.html">'.$base_url.'/i-'.$a["Id"].'-'.slugify($a["title"]).'.html</a> ';
	$mail->send();
	if ($d["gsm"] != ""){
	$gsm = str_replace("(0","",$d["gsm"]);
	$gsm = str_replace(")","",$gsm);
	$gsm = str_replace(" ","",$gsm);
	$ad = str_replace("http://","www.",$base_url);
	$ad = str_replace("/","",$ad);
	$xml_data ='<?xml version="1.0" encoding="UTF-8"?>'.'<smspack ka="kirkpinararena" pwd="26122011cinar" org="K.A.Onay" >'.'<mesaj>'.'<metin>Sayın '.$d["ad_soyad"].' '.$a["title"].' adlı ilana verdiğiniz teklif geçildi. '.$ad.'</metin>'.'<nums>'.$gsm.'</nums>'.'</mesaj>'.'</smspack>';
	
	$URL = "https://smsgw.mutlucell.com/smsgw-ws/sndblkex";
	$ch = curl_init($URL);
	curl_setopt($ch, CURLOPT_MUTE, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
	curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml_data");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($ch);
	curl_close($ch);
	}	 
	//
	echo "2";	
	####################################################
	$e = explode(" ", $a["bitiszamani"]);
	$saat = $e[1].":00";
	$e2 = explode("-",$e[0]);
	$tarih = $e2[2]."-".$e2[1]."-".$e2[0];
	
	$ilksaat = $tarih." ".$saat;
	$sonsaat = date("Y-m-d H:i:s");
	
	$baslangic     = strtotime($ilksaat);
	$bitis         = strtotime($sonsaat);
	$fark        = abs($bitis-$baslangic);
	$toplantiSure= $fark/60;
	$dakika = explode(".",$toplantiSure);
	
	if ($dakika[0] < 5){
	$minutes_to_add = 5;
	$time = new DateTime(date("Y-m-d H:i"));
	$time->add(new DateInterval('PT' . $minutes_to_add . 'M'));
	$stamp = $time->format('d-m-Y H:i');

	$sql = "UPDATE ilanlar SET bitiszamani = '$stamp' WHERE Id = '{$a['Id']}'";
	$stmt = $db->prepare($sql);
	$stmt->execute();
	
	}
	
	###################################################
	} else {
		if ($tutar > $b["tutar"]){
		$uye = $_SESSION["uye"];
		$tarih = date("d-m-Y h:i");
		$sql = $db->prepare('INSERT INTO teklifler (Id, ilanId, uyeId, tutar, tarih) VALUES (?,?,?,?,?)');
		$sql->execute(array(null, $id, $uye, $tutar, $tarih));
		//
	$sql4 = $db->query("SELECT * FROM users WHERE Id = '$son'");
	$d = $sql4->fetch(PDO::FETCH_ASSOC);
	require 'PHPMailer-master/PHPMailerAutoload.php';
	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->Host = $MailHost;
	$mail->SMTPAuth = true;
	$mail->Username = $MailUsername;
	$mail->Password = $MailPassword;
	$mail->Port = 587;
	$mail->addAddress($d["eposta"]);
	$mail->setFrom($MailUsername, $MailTitleName);
	$mail->isHTML(true);
	$mail->CharSet  ="utf-8";
	$mail->Subject = 'Teklifiniz geçildi';
	$mail->Body    = '<strong>Sayın '.$d["ad_soyad"].';</strong> '.$a["title"].' adlı ilana verdiğiniz teklif geçildi.<br>İlana yeniden teklif vermek için aşağıdaki linke tıklayınız<br><br><a href="'.$base_url.'/i-'.$a["Id"].'-'.slugify($a["title"]).'.html">'.$base_url.'/i-'.$a["Id"].'-'.slugify($a["title"]).'.html</a> ';
	$mail->send();
	if ($d["gsm"] != ""){
	$gsm = str_replace("(0","",$d["gsm"]);
	$gsm = str_replace(")","",$gsm);
	$ad = str_replace("http://","www.",$base_url);
	$ad = str_replace("/","",$ad);
	$xml_data ='<?xml version="1.0" encoding="UTF-8"?>'.'<smspack ka="kirkpinararena" pwd="26122011cinar" org="K.A.Onay" >'.'<mesaj>'.'<metin>Sayın '.$d["ad_soyad"].' '.$a["title"].' adlı ilana verdiğiniz teklif geçildi. '.$ad.'</metin>'.'<nums>'.$gsm.'</nums>'.'</mesaj>'.'</smspack>';
	
	$URL = "https://smsgw.mutlucell.com/smsgw-ws/sndblkex";
	$ch = curl_init($URL);
	curl_setopt($ch, CURLOPT_MUTE, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
	curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml_data");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($ch);
	curl_close($ch);
	}	
	//
	
	####################################################
	$e = explode(" ", $a["bitiszamani"]);
	$saat = $e[1].":00";
	$e2 = explode("-",$e[0]);
	$tarih = $e2[2]."-".$e2[1]."-".$e2[0];
	
	$ilksaat = $tarih." ".$saat;
	$sonsaat = date("Y-m-d H:i:s");
	
	$baslangic     = strtotime($ilksaat);
	$bitis         = strtotime($sonsaat);
	$fark        = abs($bitis-$baslangic);
	$toplantiSure= $fark/60;
	$dakika = explode(".",$toplantiSure);
	
	if ($dakika[0] < 5){
	$minutes_to_add = 5;
	$time = new DateTime(date("Y-m-d H:i"));
	$time->add(new DateInterval('PT' . $minutes_to_add . 'M'));
	$stamp = $time->format('d-m-Y H:i');

	$sql = "UPDATE ilanlar SET bitiszamani = '$stamp' WHERE Id = '{$a['Id']}'";
	$stmt = $db->prepare($sql);
	$stmt->execute();
	}
	
	###################################################
	
		echo "2";		
		} else {
		echo "0";	
		}
	}
	}
	}
}
} else { echo '5'; }
?>