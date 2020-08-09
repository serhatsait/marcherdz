<?
include '../functions.php';
$numara = $_POST["data1"];
$numara = str_replace("(","",$numara);
$numara = str_replace(")","",$numara);
$numara = str_replace(" ","",$numara);
$numara = substr($numara,1,15);
$kod = getrandmax();
$_SESSION["kod"] = $kod;
$sms = $db->query("SELECT * FROM sms");
$s = $sms->fetch(PDO::FETCH_ASSOC);


if ($s["firma"] == 0){
	$xml_data ='<?xml version="1.0" encoding="UTF-8"?>'.'<smspack ka="'.$s["kullaniciadi"].'" pwd="'.$s["parola"].'" org="'.$s["baslik"].'">'.'<mesaj>'.'<metin>Doğrulama Kodunuz: '.$kod.'</metin>'.'<nums>'.$numara.'</nums>'.'</mesaj>'.'</smspack>';
	$URL = "https://smsgw.mutlucell.com/smsgw-ws/sndblkex";
	$ch = curl_init($URL);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
	curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml_data");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($ch);
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
	<text>Doğrulama Kodunuz: {$kod}</text>
   	        		 <receipents>
   	            		 <number>{$numara}</number>
   	        		 </receipents>
   	    		 </message>
   			 </order>
   		 </request>
EOS;
	$result = sendRequest('http://api.iletimerkezi.com/v1/send-sms',$xml,array('Content-Type: text/xml'));
} elseif ($s["firma"] == 2){
function sendRequest2($site_name, $send_xml, $header_type=array("Content-Type: text/xml"))
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $site_name);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $send_xml);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$header_type);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);
    
        $result = curl_exec($ch);
    
        return $result;
    }
$username   = $s["kullaniciadi"];
$password   = $s["parola"];
$orgin_name = $s["baslik"];
  
    $xml = "
    <SMS>
        <oturum>
            <kullanici>$username</kullanici>
            <sifre>$password</sifre>
        </oturum>
        <baslik>$orgin_name</baslik>
        <mesaj>
            <metin>Doğrulama Kodunuz : $kod</metin>
            <alici>$numara</alici>
        </mesaj>     
    </SMS>";
    $gonder = sendRequest2("http://www.dakiksms.com/api/xml_ozel_api.php",$xml);
} elseif ($s["firma"] == 3){
$username   = $s["kullaniciadi"];
$password   = $s["parola"];
$orgin_name = $s["baslik"];	
$xml = '
<?xml version="1.0" encoding="UTF-8"?>
<mainbody>
<header>
<company>Netgsm</company>
<usercode>'.$username.'</usercode>
<password>'.$password.'</password>
<startdate>011220130101</startdate>
<stopdate>021220130101</stopdate>
<type>1:n</type>
<msgheader>'.$orgin_name.'</msgheader>
</header>
<body>
<msg><![CDATA[Dogrulama Kodunuz '.$kod.']]></msg>
<no>'.$numara.'</no>
</body>
</mainbody>
';
echo $xml;
function sendRequest3($site_name, $send_xml, $header_type=array("Content-Type: text/xml"))
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $site_name);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $send_xml);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$header_type);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);
        $result = curl_exec($ch);
        return $result;
    }
	
$gonder = sendRequest3("https://api.netgsm.com.tr/xmlbulkhttppost.asp",$xml);
}
?>