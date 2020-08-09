<?
if(!defined('access')){ exit; }
$err = "";
$urlArr=parse_url($_SERVER['REQUEST_URI']);
parse_str($urlArr['query'], $output);

if (isset($_POST["data1"]) != ""){
$data1 = $_POST["data1"];
$data2 = $_POST["data2"];
$sql = $db->query("SELECT * FROM users WHERE eposta = '$data1' and parola = '$data2'");
if ($sql->rowCount() == 0){
$err = '<div class="alert alert-danger"><strong>Uyarı!</strong> E-Posta adresi veya parola hatalı.</div>';
} else {
$a = $sql->fetch(PDO::FETCH_ASSOC);
if ($a["aktivasyon"] == 0){
$err = '<div class="alert alert-danger"><strong>Uyarı!</strong> E-Posta adresinize gönderilen aktivasyon linkine tıklayarak üyeliğinizi aktif hale getiriniz</div>';
} else {
$_SESSION['uye'] = $a["Id"];
$_SESSION['adsoyad'] = $a["ad_soyad"];
header("location: /index.php");
}
}
}

if ($output['success'] == 1){
$err = '<div class="alert alert-success"><strong>Uyarı!</strong> Üyeliğiniz gerçekleştirildi. E-Posta adresinize gönderilen maildeki aktivasyon linkine tıklayarak hesabınızı aktif hale getirebilirsiniz.</div>';
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
        <div class="panel-heading"><i class="fa fa-sign-in" aria-hidden="true"></i> Üye Girişi</div>
        <div class="panel-body"> <? echo $err; ?>
		
		
            <form action="" method="post">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 borderright" style="background: url(<? echo $base_url; ?>img/bg-login-2.gif);">
					<a href="<? echo $base_url; ?>facebook.php" class="btn btn-sm btn-facebook" style="margin-top:7px; margin-bottom:7px"><i class="fa fa-facebook fa-2"></i> Facebook ile Giriş Yap</a>
                    
                        <div class="form-group">
                            <label>E-Posta Adresi :</label>
                            <input type="email" name="data1" class="form-control" value="" placeholder="E-Posta adresi" required="required">
                        </div>
                        <div class="form-group">
                            <label>Parola :</label>
                            <input type="password" name="data2" id="data2" class="form-control" required="required" placeholder="Parola">
                        </div>
                        <div class="form-group">
                            <a href="/lostpassword/"><i class="fa fa-key" aria-hidden="true"></i> Parolamı Unuttum ?</a>
                        </div>
                        <input type="submit" class="btn btn-primary btn-block btn-lg renk2" value="Üye Girişi">
                            </form>
                    </div>
					
                    <div class="hidden-xs col-sm-6" style="padding-top:6px; text-align:center">
					<center><img border="0" src="<? echo $base_url; ?>img/kurumsalmagaza.png" width="280" height="150"></p></center>
                        <? echo $SiteName; ?> Üyeliğiniz yok ise Aşağıdaki Butona Tıklayarak Sitemize Üye Olabilir ve Ayrıcalıklı Kurumsal Mağaza Seçeneklerimizden Faydalanabilirsiniz.
                        <div style="padding-top:10px"><a href="<? echo $base_url; ?>index.php?page=mopen" class="btn btn-primary">Kurumsal Mağaza Aç</a>&nbsp;&nbsp;&nbsp;<a href="/register/" class="btn btn-primary">Ücretsiz Üye Ol</a></div>
						
                    </div>
                </div>
        </div>
    </div>
</div>
