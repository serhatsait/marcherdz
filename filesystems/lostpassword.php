<?
if(!defined('access')){ exit; }
$err = "";
if (isset($_POST["data1"]) != ""){
$data1 = $_POST["data1"];
$sql = $db->query("SELECT * FROM users WHERE eposta = '$data1'");
if ($sql->rowCount() == 0){
$err = '<div class="alert alert-danger"><strong>Uyarı!</strong> E-Posta adresi hatalı.</div>';
} else {
$a = $sql->fetch(PDO::FETCH_ASSOC);
require 'PHPMailer-master/PHPMailerAutoload.php';
$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host = $MailHost;
$mail->SMTPAuth = true;
$mail->Username = $MailUsername;
$mail->Password = $MailPassword;
$mail->Port = 587;
$mail->addAddress($data1, $a["ad_soyad"]);
$mail->setFrom($MailUsername, $MailTitleName);
$mail->isHTML(true);
$mail->CharSet  ="utf-8";
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
$mail->Subject = 'Parola Hatırlatma';
$mail->Body    = 'Sayın '.$a["ad_soyad"].' sistemde kayıtlı parolanız: '.$a["parola"].'';
$mail->send();
$err = '<div class="alert alert-success"><strong>Uyarı!</strong> Parolanız belirtilen E-Posta adresine gönderildi</div>';
}
}

?>
<div class="container top15">
    <div class="panel panel-default">
        <div class="panel-heading">Şifremi Unuttum?</div>
        <div class="panel-body"> <? echo $err; ?>
            <form action="" method="post">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 borderright">
                        <div class="form-group">
                            <label>Sitemizde kayıtlı e-posta adresiniz :</label>
                            <input type="email" name="data1" class="form-control" placeholder="E-Posta adresi" required="required">
                        </div>
                        <input type="submit" class="btn btn-primary btn-block btn-lg renk2" value="Şifremi Gönder">
                            </form>
                    </div>
                    <div class="hidden-xs col-sm-6" style="padding-top:20px; text-align:center"> <strong style="font-size:18px"><?php echo $SiteName; ?> üyesi değilim</strong><br>
                        <?php echo $SiteName; ?> üyeliğiniz yok ise aşağıdaki butona tıklayarak sitemize üye olabilirsiniz
                        <div style="padding-top:10px"><a href="/register/" class="btn btn-primary renk2">Ücretsiz Üye Ol</a></div>
                    </div>
                </div>
        </div>
    </div>
</div>
