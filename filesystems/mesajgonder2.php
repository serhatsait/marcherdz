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



$link = $_GET['lock'];
echo '<script> alert("Mesajınız gönderildi"); window.location.href="'.$link.'"; </script>';
} else {
$sql = $db->query("SELECT * FROM ilanlar WHERE Id = '$id'");
$a = $sql->fetch(PDO::FETCH_ASSOC);
$uye = $_SESSION["uye"];
$sql2 = $db->query("SELECT * FROM users WHERE Id = '$uye'");
$b = $sql2->fetch(PDO::FETCH_ASSOC);
}
?>
<div class="container top15">
    <div class="panel panel-default">
        <div class="panel-heading">Mesaj Gönder</div>
        <div class="panel-body">
            <form action="index.php?page=mesajgonder2&id=<? echo $id; ?>&lock=<? echo $_SERVER['HTTP_REFERER']; ?>" method="post">
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