<?
include 'functions.php';
$bugun = date("Y-m-d");

function islem($id)
{
global $db;
global $MailHost;
global $MailUsername;
global $MailPassword;
global $MailTitleName;

$sql = $db->query("SELECT * FROM ilanlar WHERE Id = '$id'");
while ($a = $sql->fetch(PDO::FETCH_ASSOC)){
	$e = explode(" ", $a["bitiszamani"]);
	$saat = $e[1];
	$e2 = explode("-",$e[0]);
	
$d = DateTime::createFromFormat('d-m-Y H:i', ''.$e2[0].'-'.$e2[1].'-'.$e2[2].' '.$saat.'');
$ilan = $d->getTimestamp();

$d = DateTime::createFromFormat('d-m-Y H:i', date("d-m-Y H:i"));
$bugun = $d->getTimestamp();

if ($bugun >= $ilan){ 
$sql3 = $db->query("SELECT * FROM teklifler WHERE ilanId = '$id' ORDER BY Id DESC LIMIT 1");
$c = $sql3->fetch(PDO::FETCH_ASSOC);

$kazanan = $c["uyeId"];
$tarih = date("Y-m-d");

$sqlx = $db->prepare('INSERT INTO ihaleler (Id, ilanId, uyeId, kazandi, tarih) VALUES (?,?,?,?,?)');
$sqlx->execute(array(null, $id, $kazanan, 1, $tarih));


$sql4 = $db->query("SELECT * FROM users WHERE Id = '$kazanan'");
$d = $sql4->fetch(PDO::FETCH_ASSOC);

require 'filesystems/PHPMailer-master/PHPMailerAutoload.php';
$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host = $MailHost;
//$mail->SMTPDebug  = 1; 
$mail->SMTPAuth = true;
$mail->Username = $MailUsername;
$mail->Password = $MailPassword;
$mail->Port = 587;
$mail->addAddress($d["eposta"]);
$mail->setFrom($MailUsername, $MailTitleName);
$mail->isHTML(true);
$mail->CharSet  ="utf-8";
$mail->Subject = 'İhaleyi Kazandınız';
$mail->Body    = '<strong>Sayın '.$d["ad_soyad"].';</strong> '.$a["title"].' adlı ihaleyi kazandınız.<br<br>>İlan sahibinin iletişim bilgilerini görmek için sitemizde bulunan baza özel bölümünden kazandığım ihalalere tıklayarak ilgili ilan sahibinin iletişim bilgilerini görebilirsiniz.<br><br> <a href="http://www.sanalkus.com">www.sanalkus.com</a>';
$mail->send();
 	$sms = $db->query("SELECT * FROM sms");
	$s = $sms->fetch(PDO::FETCH_ASSOC);
	if ($s["aktiflik"] == 1){
	if ($d["gsm"] != ""){
	$gsm = str_replace("(0","",$d["gsm"]);
	$gsm = str_replace(")","",$gsm);
	$gsm = str_replace(" ","",$gsm);
	$ad = str_replace("http://","www.",$base_url);
	$ad = str_replace("/","",$ad);
	if ($s["firma"] == 0){
	$xml_data ='<?xml version="1.0" encoding="UTF-8"?>'.'<smspack ka="'.$s["kullaniciadi"].'" pwd="'.$s["parola"].'" org="'.$s["baslik"].'" >'.'<mesaj>'.'<metin><strong>Sayın '.$d["ad_soyad"].';</strong> '.$a["title"].' adlı ihaleyi kazandınız.<br>İlan sahibinin iletişim bilgilerini görmek için sitemizde bulunan baza özel bölümünden kazandığım ihalalere tıklayarak ilgili ilan sahibinin iletişim bilgilerini görebilirsiniz.</metin>'.'<nums>'.$gsm.'</nums>'.'</mesaj>'.'</smspack>';
	
	$URL = "https://smsgw.mutlucell.com/smsgw-ws/sndblkex";
	$ch = curl_init($URL);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
	curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml_data");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($ch);
	curl_close($ch);
	} elseif ($s["firma"] == 1){
	$username   = $s["kullaniciadi"];
	$password   = $s["parola"];
	$orgin_name = $s["baslik"];
$xml = <<<EOS
   		 <request>
   			 <authentication>
   				 <username>{$username}</username>
   				 <password>{$password}</password>
   			 </authentication>

   			 <order>
   	    		 <sender>{$orgin_name}</sender>
   	    		 <sendDateTime>01/05/2013 18:00</sendDateTime>
   	    		 <message>
	<text>Sayın {$d[ad_soyad]} {$a[title]} adlı ihaleyi kazandınız.<br>İlan sahibinin iletişim bilgilerini görmek için sitemizde bulunan baza özel bölümünden kazandığım ihalalere tıklayarak ilgili ilan sahibinin iletişim bilgilerini görebilirsiniz.</text>
   	        		 <receipents>
   	            		 <number>{$gsm}</number>
   	        		 </receipents>
   	    		 </message>
   			 </order>
   		 </request>
EOS;
	$result = sendRequest('http://api.iletimerkezi.com/v1/send-sms',$xml,array('Content-Type: text/xml'));
	
	}
}		
}

$sql2 = $db->query("SELECT * FROM teklifler WHERE ilanId = '$id' and uyeId != '$kazanan' GROUP BY uyeId ORDER BY Id DESC");
$i = 0;
while ($b = $sql2->fetch(PDO::FETCH_ASSOC)){

$tarih = date("Y-m-d");
$sqlx = $db->prepare('INSERT INTO ihaleler (Id, ilanId, uyeId, kazandi, tarih) VALUES (?,?,?,?,?)');
$sqlx->execute(array(null, $id, $b["uyeId"], 0, $tarih));
$i++;	
}
$sql88 = "UPDATE ilanlar SET confirm = '0', type = '3' WHERE Id = '$id'";
$stmt = $db->prepare($sql88);
$stmt->execute();

} else { echo 'bitmedi'; }
}
}


$sql = $db->query("SELECT * FROM ilanlar WHERE type = '2' and bitis = '$bugun'");
while ($a = $sql->fetch(PDO::FETCH_ASSOC)){
	islem($a["Id"]);
}
?>