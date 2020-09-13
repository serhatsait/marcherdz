<?
function sayac($id)
{
global $db;
$bugun = date("Y-m-d");
$sql   = $db->query("SELECT Id FROM ilanlar WHERE (category1 = '$id' or category2 = '$id' or category3 = '$id' or category4 = '$id' or category5 = '$id' or category6 = '$id' or category7 = '$id' or category8 = '$id' or category9 = '$id' or category10 = '$id') and (bitis >= '$bugun') and (confirm = '1')");
return $sql->rowCount();
}
if ($_POST["a1"] != ""){
	echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> <script> alert("Mesajınız Gönderildi"); window.history.go(-1); </script>';
$a1 = $_POST["a1"];
$a2 = $_POST["a2"];
$a3 = $_POST["a3"];
$a4 = $_POST["a4"];
$a5 = $_POST["a5"];
$a6 = $_POST["a6"];	
require 'PHPMailer-master/PHPMailerAutoload.php';
$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host = $MailHost;
$mail->SMTPAuth = true;
$mail->Username = $MailUsername;
$mail->Password = $MailPassword;
$mail->Port = 587;
$mail->addAddress($admin_mail);
$mail->setFrom($MailUsername, $MailTitleName);
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
$mail->isHTML(true);
$mail->CharSet  ="utf-8";
$mail->Subject = 'İletişim Formu';
$mail->Body    = 'Ad Soyad : '.$a1.' '.$a2.'<br>E-Posta : '.$a3.'<br>Telefon : '.$a4.'<br>Konu : '.$a5.'<br>Mesaj : '.$a6.' ';
$mail->send();
}

?>

<div class="container top15">
  
    
    
      <div class="panel panel-default">
        <div class="panel-heading">à propos de nous</div>
        <div class="panel-body">
        <div class="alert alert-warning">İstek, öneri ve şikayetleriniz aşağıdaki iletişim formu aracılığı ile bize bildirebilirsiniz.</div>
          <form name="form1" id="form1" action="" method="post">
            <div class="row form-group">
              <div class="col-xs-6">
                <input class="form-control"  id="a1" name="a1" placeholder="Adınız" required="" type="text" required >
              </div>
              <div class="col-xs-6">
                <input class="form-control"  id="a2" name="a2" placeholder="Soyadınız" required="" type="text" required>
              </div>
            </div>
            <div class="row form-group">
              <div class="col-xs-6">
                <input class="form-control" name="a3" id="a3" placeholder="E-Posta Adresiniz" required="" type="email" required>
              </div>
              <div class="col-xs-6">
                <input class="form-control" name="a4" id="a4" placeholder="Telefon Numaranız" required="" type="number" required>
              </div>
            </div>
            <div class="row form-group">
              <div class="col-xs-12">
                <input class="form-control" name="a5" id="a5" placeholder="Konu" required="" type="text" required>
              </div>
            </div>
            <div class="row form-group">
              <div class="col-xs-12">
                <textarea name="a6" cols="" rows="" class="form-control" required placeholder="Mesajınız" required></textarea>
              </div>
            </div>
            <div class="row form-group">
              <div class="col-xs-12">
                <button class="btn btn-primary" type="submit">Gönder</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>