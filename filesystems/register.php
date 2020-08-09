<?
if(!defined('access')){ exit; }
$err = "";
if (isset($_POST["data1"]) != ""){
$kntrl=$_POST['kontrol'];
if($kntrl != $_SESSION["kod"]){
echo '<script> alert("Güvenlik Kodu Hatalı..!"); window.location.href="/register/"; </script>';
exit;
}
$data1 = $_POST["data1"];
$data2 = $_POST["data2"];
$data3 = $_POST["data3"];
$data4 = $_POST["data4"];
$data5 = $_POST["data5"];
$d = $_POST["d"];
$tarih = date("Y-m-d");
$aktivasyon = md5(sha1($data2));
$sms = $db->query("SELECT * FROM sms");
$s = $sms->fetch(PDO::FETCH_ASSOC);
if ($s["aktiflik"] == 1){
if ($d != $_SESSION["kod"]){ $dv = 0; } else { $dv = 1; }
} else { $dv =1; }

if ($dv == 0){
$err = '<div class="alert alert-danger"><strong>Uyarı!</strong> GSM Doğrulama Kodu Hatalı.</div>';	
} else {
$sql = $db->query("SELECT * FROM users WHERE eposta = '$data2'");
if ($sql->rowCount() > 0){
$err = '<div class="alert alert-danger"><strong>Uyarı!</strong> Belirtilen e-posta adresi kayıtlı.</div>';
} else {
$sql223 = $db->query("SELECT * FROM users WHERE gsm = '$data5'");
if ($sql223->rowCount() > 0){
$err = '<div class="alert alert-danger"><strong>Uyarı!</strong> Belirtilen GSM Numarası Daha Önce Kayıt Edilmiş.</div>';
} else {
if ($ay["mail"] == 0){	
	
$sql = $db->prepare('INSERT INTO users (Id, ad_soyad,dogum_tarihi, cinsiyet, eposta, parola, telefon, gsm, il, ilce, kayit_tarihi, aktivasyon, aktivasyonkodu) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)');
$sql->execute(array(null,$data1,null,$data4,$data2,$data3,null,$data5,null,null,$tarih,0,$aktivasyon));
$id = $db->lastInsertId();
require 'PHPMailer-master/PHPMailerAutoload.php';
$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host = $MailHost;
$mail->SMTPAuth = true;
$mail->Username = $MailUsername;
$mail->Password = $MailPassword;
$mail->Port = 587;
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
$mail->addAddress($data2, $data1);
$mail->setFrom($MailUsername, $MailTitleName);
$mail->isHTML(true);
$mail->CharSet  ="utf-8";
$mail->Subject = 'Aktivasyon';
$mail->Body    = 'Sayın '.$data2.' üyeliğini aktif hale getirmek için lütfen aşağıdaki linke tıklayınız veya kopyalayıp adres satırına yapıştırarak üyeliğinizi aktif hale getiriniz<br><br><a href="'.$base_url.'index.php?page=act&c='.$aktivasyon.'">Aktivasyon İçin Buraya Tıklayınız</a>';
$mail->send();

echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> <script> alert("Üyelik İşleminiz Gerçekleştirildi.Aktivasyon Linkiniz Mail Adresinize Gönderildi"); window.location.href = "/login"; </script>';
} else {
$sql = $db->prepare('INSERT INTO users (Id, ad_soyad,dogum_tarihi, cinsiyet, eposta, parola, telefon, gsm, il, ilce, kayit_tarihi, aktivasyon, aktivasyonkodu) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)');
$sql->execute(array(null,$data1,null,$data4,$data2,$data3,null,$data5,null,null,$tarih,0,$aktivasyon));


require 'PHPMailer-master/PHPMailerAutoload.php';
$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host = $MailHost;
$mail->SMTPAuth = true;
$mail->Username = $MailUsername;
$mail->Password = $MailPassword;
$mail->Port = 587;
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
$mail->addAddress($data2, $data1);
$mail->setFrom($MailUsername, $MailTitleName);
$mail->isHTML(true);
$mail->CharSet  ="utf-8";
$mail->Subject = 'Aktivasyon';
$mail->Body    = 'Sayın '.$data2.' üyeliğini aktif hale getirmek için lütfen aşağıdaki linke tıklayınız veya kopyalayıp adres satırına yapıştırarak üyeliğinizi aktif hale getiriniz<br><br><a href="'.$base_url.'index.php?page=act&c='.$aktivasyon.'">Aktivasyon İçin Buraya Tıklayınız</a>';
$mail->send();
header("location: /login/?success=1");
}


}
}
}
}
?>
<style>
.btn-facebook {
    color: #fff;
    background-color: #4C67A1;
    width: 100%;
    height: 40px;
    font-size: 18px;
}
.btn-facebook:hover {color: #fff;background-color: #405D9B;}
.btn-facebook:focus {color: #fff;}
</style>
<div class="container top15">
    <div class="panel panel-default">
        <div class="panel-heading"><i class="fa fa-user-plus" aria-hidden="true"></i> Yeni Üyelik</div>
        <div class="panel-body"><? echo $err; ?>
		
            <form action="" method="post">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6 borderright">
					
					<a href="<? echo $base_url; ?>facebook.php" class="btn btn-sm btn-facebook" style="margin-top:7px; margin-bottom:7px"><i class="fa fa-facebook fa-2"></i> Facebook ile Kayıt Ol</a>
                        <div class="form-group">
                            <label>Ad Soyad :</label>
                            <input type="text" name="data1" class="form-control" placeholder="Ad soyad" value="<? if (isset($_POST["data1"])){  echo $data1; } ?>" required="required">
                    </div>
                    <div class="row no-pad">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>E-Posta Adresi :</label>
                                <input type="email" name="data2" id="data2" placeholder="E-Posta adresi" class="form-control"  required="required">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>E-Posta Adresi Tekrar :</label>
                                <input type="email" name="data2_repeat" id="data2_repeat" placeholder="E-Posta adresi tekrarı" class="form-control" required="required" oninput="repeat(this)">
                            </div>
                        </div>
                    </div>
                    <div class="row no-pad">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Parola :</label>
                                <input type="password" name="data3" id="data3" placeholder="***" class="form-control" required="required">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Parola Tekrar :</label>
                                <input type="password" name="data3_repeat" placeholder="***"  id="data3_repeat" class="form-control" required="required" oninput="repeat(this)">
                            </div>
                        </div>
                    </div>
                    <div class="row no-pad">
                    <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Cinsiyet :</label>
                                    <select name="data4" id="data4" class="form-control" required>
                                        <option value="Erkek">Erkek</option>
                                        <option value="Kadın">Kadın</option>
                                    </select>
                                </div>
                            </div>
                            
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>GSM :</label>
                                <input type="text" name="data5" id="data5" placeholder="GSM No" class="form-control phone" required="required">
                            </div>
                        </div>
                    </div>
					
					<?
					$sms = $db->query("SELECT * FROM sms");
					$s = $sms->fetch(PDO::FETCH_ASSOC);
					if ($s["aktiflik"] == 1){
					?>
					<div class="row no-pad">
                    <div class="col-sm-6">
                                <div class="form-group">
                                <label>DOĞRULAMA KODU :</label>
                                <input type="text" name="d" id="d" placeholder="Doğrulama Kodu" class="form-control" required="required">
                            </div>
                            </div>
					 <div class="col-sm-6"><label>Kod Gönder</label><button type="button" onclick="dogrulama()" class="btn btn-success btn-block dg">Doğrulama Kodu Gönder</button></div>
                    </div>
					<div style="color:red; padding-bottom:7px">Belirttiğiniz GSM numarasına sms olarak gönderilir.</div>
					<? } ?>
					<div class="form-group">
            <label>Güvenlik Doğrulaması</label><br>
            <img src='../cap.php'/><br><br>
            <input type='text' name='kontrol' class="form-control" style="max-width:300px" required/>
          </div>
					
                    
                    <div class="form-group">
                        <input type="checkbox" required>
                            <u><a href="#" data-toggle="modal" data-target="#myModal">Üyelik sözleşmesini okudum onaylıyorum</a></u> </div>
                    <input type="submit" class="btn btn-primary btn-block btn-lg renk2" value="Hesabımı Oluştur">
                        </form>
                </div>
				
                <div class="hidden-xs col-sm-12 col-md-6" style="padding-top:90px; text-align:center"> <strong style="font-size:18px"><?php echo $SiteName; ?> üyesiyim</strong><br>
                    <?php echo $SiteName; ?> üyeliğiniz varsa aşağıdaki butona tıklayarak üye girişi yapabilirsiniz.
                    <div style="padding-top:10px"><a href="/login/" class="btn btn-primary renk2">Üye Girişi Yap</a></div>
                </div>
				
				
            </div>
        </form>
    </div>
</div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Üyelik Sözleşmesi</h4>
            </div>
            <div class="modal-body">
                <? include 'uyelik_sozlesmesi.php'; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
            </div>
        </div>
    </div>
</div>
<script>
function dogrulama()
{
	var e = $("#data5").val();
	if (e == ""){
		alert("GSM Numaranızı belirtmediniz");
	} else {
		 $.post('/filesystems/sms.php', {data1: e}, function (output) {	 
		alert("Doğrulama kodu GSM numaranıza gönderildi");
		$("#dg").attr("disabled", true);
		$("#d").focus();
		 });
	}
}
</script>