<?
$uye = $_SESSION["uye"];
if ($_SESSION["uye"] == "") {
header("location: /login/");
}
$id = $_GET["id"];
if ($_POST["a1"] != ""){
$sql = $db->query("SELECT * FROM ilanlar WHERE Id = '$id'");
$a = $sql->fetch(PDO::FETCH_ASSOC);
$gonderen = $_SESSION['uye'];
$gonderilen = $a["uyeId"];
$konu = $_GET["id"];
$tarih = date("d-m-Y H:i:s");
$mesaj = $_POST["a1"];



$sql44 = $db->query("SELECT * FROM engel WHERE engellenen = '$gonderen' and engelleyen = '$gonderilen'");
$a22 = $sql44->fetch(PDO::FETCH_ASSOC);

if ($a22 > 0) {
	echo '<script> alert("Bu Üyeye Mesaj Gönderemezsiniz"); window.location.href="index.php"; </script>';
    exit;
}


$sql = $db->prepare('INSERT INTO mesajlar (Id, gonderen,gonderilen, konu, mesaj, tarih, okundu, gonderensil, gonderilensil) VALUES (?,?,?,?,?,?,?,?,?)');
$sql->execute(array(null,$gonderen,$gonderilen,$konu, $mesaj, $tarih, 0, 0, 0));

$sql2 = $db->query("SELECT * FROM users WHERE Id = '{$a['uyeId']}'");
$b = $sql2->fetch(PDO::FETCH_ASSOC);
require 'PHPMailer-master/PHPMailerAutoload.php';
try {
$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host = $MailHost;
$mail->SMTPAuth = true;
$mail->Username = $MailUsername;
$mail->Password = $MailPassword;
$mail->Port = 587;
$mail->addAddress($b["eposta"]);
$mail->setFrom($MailUsername, $MailTitleName);
$mail->isHTML(true);
$mail->CharSet  ="utf-8";
$mail->Subject = 'Mesajınız Var';
$mail->Body    = 'Sayın '.$b["ad_soyad"].' <strong>'.$a["title"].'</strong> adlı ilanınız hakkında mesaj aldınız.<br>
Mesajınızı okumak için lütfen <a href="'.$base_url.'index.php">tıklayınız</a>';
$mail->send();
} catch (phpmailerException $e) {
echo $e->errorMessage();
} catch (Exception $e) {
echo $e->getMessage();
}




$link = "i-".$a["Id"]."-".slugify($a["title"]).".html";
echo '<script> alert("Mesajınız gönderildi"); window.location.href="'.$link.'"; </script>';
} else {
$sql = $db->query("SELECT * FROM ilanlar WHERE Id = '$id'");
$a = $sql->fetch(PDO::FETCH_ASSOC);
$uye = $_SESSION["uye"];
$sql2 = $db->query("SELECT * FROM users WHERE Id = '$uye'");
$b = $sql2->fetch(PDO::FETCH_ASSOC);
}
$sql26 = $db->query("SELECT * FROM ilanlar WHERE Id = '$id'");
$a16 = $sql26->fetch(PDO::FETCH_ASSOC);
$sql23 = $db->query("SELECT * FROM users WHERE Id = '{$a16['uyeId']}'");
$a17 = $sql23->fetch(PDO::FETCH_ASSOC);
$gonderen = $_SESSION['uye'];
$gonderilen = $a17["ad_soyad"];
$gonderilen22 = $a16["uyeId"];
$sql448 = $db->query("SELECT * FROM engel WHERE engellenen = '$gonderilen22' and engelleyen = '$gonderen'");
$a229 = $sql448->fetch(PDO::FETCH_ASSOC);
$idd = $a229["Id"];
if ($_GET["bankaldir"] == 1){
$sql28 = $db->prepare("DELETE FROM engel WHERE Id = '$idd'");
$sql28->execute();
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> <script> alert("'.$gonderilen.' Kullanıcısının Engelini Kaldırdınız..!"); </script>';

}
?>
<div class="container top15">
    <div class="panel panel-default">
        <div class="panel-heading">Mesaj Gönder</div>
        <div class="panel-body">
            <form action="index.php?page=mesajgonder&id=<? echo $id; ?>" method="post">
                <?
				$id = $_GET["id"];
				$sql333 = $db->query("SELECT * FROM ilanlar WHERE Id = '$id'");
$a222 = $sql333->fetch(PDO::FETCH_ASSOC);
$gonderen1 = $_SESSION['uye'];
$gonderilen1 = $a222["uyeId"];
				
				$sql447 = $db->query("SELECT * FROM engel WHERE engellenen = '$gonderilen1' and engelleyen = '$gonderen1'");
				$a226 = $sql447->fetch(PDO::FETCH_ASSOC);
				
				
				echo $bankaldir;
				if ($a226 > 0) {
					
				echo '<div class="alert alert-danger"><strong>'.$gonderilen.'</strong> Üyesini Daha Önce Engellemişsiniz.Mesajınıza Cevap Alamazsınız.Engeli Kaldırmak İçin <a href="index.php?page=mesajgonder&id='.$id.'&bankaldir=1">Buraya Tıklayın</a></div>';
					
				}
					?>

				
				
				<div class="alert alert-danger"><strong><? echo $b["telefon"]; ?> <? echo $b["gsm"]; ?></strong> telefon numaralarınız karşı tarafla paylaşılacaktır.</div>

                <div class="form-group">
                    <label>Konu</label>
                    <input type="text" class="form-control" value="<? echo $a["title"]; ?>" placeholder="konu" readonly>
            </div>
            <div class="form-group">
                <label>Mesaj</label>
                <textarea name="a1" id="a1" class="form-control" style="height:200px" required></textarea>
            </div>
            <input type="submit" value="Mesajı Gönder" class="btn btn-primary">
                </div>
        </form>
    </div>
</div>