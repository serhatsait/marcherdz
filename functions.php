<?
ob_start();
session_set_cookie_params(0, '/', '.marcherdz.com');
session_start();
header("Content-Type: text/html; charset=utf-8");
include 'config.php';
ini_set("display_errors", 0);
error_reporting(E_ALL ^ E_NOTICE);
try {
    $db = new PDO("mysql:host=localhost;dbname=" . $MysqlDbName, $MysqlDbUserName, $MysqlDbUserPass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET utf8"));
} catch (PDOException $e) {
    print $e->getMessage();
}
$sql = $db->query("SELECT * FROM mail_ayarlari");
$a = $sql->fetch(PDO::FETCH_ASSOC);
$MailHost = $a["host"];
$MailUsername = $a["kullaniciadi"];
$MailPassword = $a["parola"];
$MailTitleName = $a["baslik"];

$sql = $db->query("SELECT * FROM doping_ayarlari");
$a = $sql->fetch(PDO::FETCH_ASSOC);
$doping_anasayfa_1 = $a["a1"] . ".00";
$doping_anasayfa_2 = $a["a2"] . ".00";
$doping_anasayfa_4 = $a["a3"] . ".00";
$doping_kategori_1 = $a["a4"] . ".00";
$doping_kategori_2 = $a["a5"] . ".00";
$doping_kategori_4 = $a["a6"] . ".00";
$doping_acil_1 = $a["a7"] . ".00";
$doping_acil_2 = $a["a8"] . ".00";
$doping_acil_4 = $a["a9"] . ".00";
$doping_kalin_1 = $a["a10"] . ".00";
$doping_kalin_2 = $a["a11"] . ".00";
$doping_kalin_4 = $a["a12"] . ".00";
$sql = $db->query("SELECT * FROM magaza_ucretleri");
$a = $sql->fetch(PDO::FETCH_ASSOC);
$magaza1 = $a["a1"] . ".00";
$magaza2 = $a["a2"] . ".00";
$magaza3 = $a["a3"] . ".00";
$kota1 = $a["kota1"];
$kota2 = $a["kota2"];
$kota3 = $a["kota3"];
$sql = $db->query("SELECT * FROM get_ayarlari");
$a = $sql->fetch(PDO::FETCH_ASSOC);
$komisyon = $a["a2"];
$gdurum = $a["a1"];
$ihalebedeli = $a["a3"];

$sql = $db->query("SELECT * FROM sinir");
$a = $sql->fetch(PDO::FETCH_ASSOC);
$MagazaSinir = $a["sinir"];

$sql = $db->query("SELECT * FROM genel");
$a = $sql->fetch(PDO::FETCH_ASSOC);

$base_url = $a["base_url"];
$SiteName = $a["SiteName"];
$MaksimumResimUpload = $a["MaksimumResimUpload"];
$admin_mail = $a["admin_mail"];
$appId = $a["appId"];
$appSecret = $a["appSecret"];


function tr_ucwords($deger)
{
    $deger = mb_strtolower(str_replace(array('I', 'Ğ', 'Ü', 'Ş', 'İ', 'Ö', 'Ç'), array('ı', 'ğ', 'ü', 'ş', 'i', 'ö', 'ç'), $deger), 'utf-8');
    return $deger;
}

function banner($e)
{
    global $db;
    global $base_url;
    $sql = $db->query("SELECT * FROM banner WHERE Id = '$e'");
    $a = $sql->fetch(PDO::FETCH_ASSOC);
    if ($a["tip"] == 0) {
        if ($e != 6) {
            $l = '<a href="'.$base_url.'"><img src="' . $base_url . 'uploads/' . $a["kod"] . '" width="100%" alt="Reklam Alanı"/></a>';
        } else {
            $l = '<a href="'.$base_url.'"><img src="' . $base_url . 'uploads/' . $a["kod"] . '" alt="Reklam Alanı"/></a>';
        }
    } else {
        $l = html_entity_decode($a["kod"]);
    }
    return $l;
}

foreach ($_GET as $key => $value) {
    $value = str_replace('"', "", $value);
    $value = str_replace("'", "", $value);
    $value = str_replace("select", "", $value);
    $value = str_replace("SELECT", "", $value);
    $value = str_replace("UPDATE", "", $value);
    $value = str_replace("update", "", $value);
    $value = str_replace("delete", "", $value);
    $value = str_replace("DELETE", "", $value);
    $value = str_replace("UNION", "", $value);
    $value = str_replace("union", "", $value);
    $value = str_replace('"', "", $value);
    $value = str_replace("%", "", $value);
    $value = str_replace("`", "", $value);
    $value = str_replace("'", "'", $value);
    $_GET[$key] = $value;
}
foreach ($_POST as $key => $value) {
    $value = str_replace('"', "", $value);
    $value = str_replace("'", "", $value);
    $value = str_replace("select", "", $value);
    $value = str_replace("SELECT", "", $value);
    $value = str_replace("UPDATE", "", $value);
    $value = str_replace("update", "", $value);
    $value = str_replace("delete", "", $value);
    $value = str_replace("DELETE", "", $value);
    $value = str_replace("UNION", "", $value);
    $value = str_replace("union", "", $value);
    $value = str_replace('"', "", $value);
    $value = str_replace("%", "", $value);
    $value = str_replace("`", "", $value);
    $value = str_replace("'", "'", $value);
    $_POST[$key] = $value;
}
function slugify($str, $options = array())
{
    $str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
    $defaults = array(
        'delimiter' => '-',
        'limit' => null,
        'lowercase' => true,
        'replacements' => array(),
        'transliterate' => true,
    );
    $options = array_merge($defaults, $options);
    $char_map = array('Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G', 'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g',);
    $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
    if ($options['transliterate']) {
        $str = str_replace(array_keys($char_map), $char_map, $str);
    }
    $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
    $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
    $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
    $str = trim($str, $options['delimiter']);
    return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
}

function sendRequest($site_name, $send_xml, $header_type)
{

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $site_name);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $send_xml);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header_type);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 120);

    $result = curl_exec($ch);

    return $result;
}

function bildirimgonder($posta, $tip)
{
    require 'filesystems/PHPMailer-master/PHPMailerAutoload.php';
    global $MailHost;
    global $MailUsername;
    global $MailPassword;
    global $MailTitleName;
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = $MailHost;
    $mail->SMTPAuth = true;
    $mail->Username = $MailUsername;
    $mail->Password = $MailPassword;
    $mail->Port = 587;
    $mail->addAddress($posta);
    $mail->setFrom($MailUsername, $MailTitleName);
    $mail->isHTML(true);
    $mail->CharSet = "utf-8";
    if ($tip == 1) {
        $mail->Subject = 'Onay Bekleyen İlan';
        $mail->Body = '' . date("d-m,Y H:i:s") . ' tarihinde ilan eklenmiştir';
    } elseif ($tip == 2) {
        $mail->Subject = 'Ödeme Bildirimi';
        $mail->Body = '' . date("d-m,Y H:i:s") . ' tarihinde ödeme bildirimi yapıldı';
    }
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail->send();
}

ob_end_flush();
?>