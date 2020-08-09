<?
include '../functions.php';
$numara = $_POST["data1"];
$numara = str_replace("(","",$numara);
$numara = str_replace(")","",$numara);
$numara = str_replace(" ","",$numara);
$numara = substr($numara,1,15);


  
$kod = rand(1000,9999);;
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
<startdate></startdate>
<stopdate></stopdate>
<type>1:n</type>
<msgheader>'.$orgin_name.'</msgheader>
</header><body>
<msg><![CDATA[Dogrulama Kodunuz '.$kod.']]></msg>
<no>0'.$numara.'</no>
</body>
</mainbody>';
$xml = file_get_contents('https://api.netgsm.com.tr/bulkhttppost.asp?usercode='.$username.'&password='.$password.'&gsmno='.$numara.'&message='.$kod.'&msgheader='.$orgin_name.'');

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
	
echo $gonder = sendRequest3("https://api.netgsm.com.tr/xmlbulkhttppost.asp",$xml);
} elseif ($s["firma"] == 4){
$username   = $s["kullaniciadi"];
$password   = $s["parola"];
$orgin_name = $s["baslik"];	
function sms_gonder ($Url, $strRequest){
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $Url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1) ;
			curl_setopt($ch, CURLOPT_POSTFIELDS, $strRequest);
			curl_setopt($ch, CURLOPT_TIMEOUT, 30);
			$result = curl_exec($ch);
			curl_close($ch);
			return $result;
			} 
sms_gonder("http://api.smsvitrini.com/index.php", "islem=1&user=$username&pass=$password&mesaj=$kod&numaralar=$numara&baslik=$orgin_name");			
}
?>