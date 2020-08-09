<?
error_reporting(0);


if ($_POST['name'] == ""){
	
	echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> <script> alert("Boş Alan Bırakmayınız."); window.history.go(-1); </script>';
    exit;
	}
include ("func.php");


function toplumail($gonder= array(),$subject,$message)
{

include ("../config.php");
try {
$db = new PDO("mysql:host=localhost;dbname=".$MysqlDbName, $MysqlDbUserName, $MysqlDbUserPass,array(PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES utf8",PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET utf8"));
} catch ( PDOException $e ){
print $e->getMessage();
}

$sql = $db->query("SELECT * FROM mail_ayarlari");
$a36 = $sql->fetch(PDO::FETCH_ASSOC);
$MailHost = $a36["host"];
$MailUsername = $a36["kullaniciadi"];
$MailPassword = $a36["parola"];

$sql = $db->query("SELECT * FROM genel");
$a23 = $sql->fetch(PDO::FETCH_ASSOC);
$base_url = $a23["base_url"];
$name=$_POST['name'];
$feedback=$_POST['feedback'];

require '../filesystems/PHPMailer-master/PHPMailerAutoload.php';
$mail = new PHPMailer();
$mail->IsSMTP(); 
$mail->Port = "587";
$mail->Host = $MailHost;
$mail->SMTPAuth = true;
$mail->Username = $MailUsername;
$mail->Password = $MailPassword;
$mail->From = $MailUsername;
$mail->FromName = $base_url;
foreach($gonder as $item)
{
       $mail->AddAddress($item);
}
$mail->WordWrap = 50;
$mail->IsHTML(true);
$mail->Subject = $name;
$mail->Body    = $feedback;
$mail->SMTPOptions = array (
        'ssl' => array(
            'verify_peer'  => false,
            'verify_peer_name'  => false,
            'allow_self_signed' => true));
$mail->CharSet  ="utf-8";
$mail->send();				

}

echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> <script> alert("Mesajınız Tüm Üyelerinize Gönderilmiştir."); window.history.go(-1); </script>';
 

?>


