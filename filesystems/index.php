<?php
ob_start();
include 'functions.php';
include 'language/' . $lang . '.php';
define('access', true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?
if ($_GET['page'] == ""){
$sql = $db->query("SELECT * FROM metalar WHERE Id = '1'");
$a = $sql->fetch(PDO::FETCH_ASSOC);
$title = $a["title"];
$description = $a["description"];
} elseif ($_GET["page"] == "acil"){
$sql = $db->query("SELECT * FROM metalar WHERE Id = '2'");
$a = $sql->fetch(PDO::FETCH_ASSOC);
$title = $a["title"];
$description = $a["description"];
} elseif ($_GET["page"] == "magazalar"){
$sql = $db->query("SELECT * FROM metalar WHERE Id = '3'");
$a = $sql->fetch(PDO::FETCH_ASSOC);
$title = $a["title"];
$description = $a["description"];
} elseif ($_GET["page"] == "sayfa"){
if ($_GET["id"] == "1"){
$sql = $db->query("SELECT * FROM metalar WHERE Id = '4'");
$a = $sql->fetch(PDO::FETCH_ASSOC);
} elseif ($_GET["id"] == 2){
$sql = $db->query("SELECT * FROM metalar WHERE Id = '6'");
$a = $sql->fetch(PDO::FETCH_ASSOC);
} elseif ($_GET["id"] == 3){
$sql = $db->query("SELECT * FROM metalar WHERE Id = '7'");
$a = $sql->fetch(PDO::FETCH_ASSOC);	
} elseif ($_GET["id"] == 4){
$sql = $db->query("SELECT * FROM metalar WHERE Id = '8'");
$a = $sql->fetch(PDO::FETCH_ASSOC);	
} elseif ($_GET["id"] == 5){
$sql = $db->query("SELECT * FROM metalar WHERE Id = '9'");
$a = $sql->fetch(PDO::FETCH_ASSOC);	
} elseif ($_GET["id"] == 6){
$sql = $db->query("SELECT * FROM metalar WHERE Id = '10'");
$a = $sql->fetch(PDO::FETCH_ASSOC);	
} elseif ($_GET["id"] == 7){
$sql = $db->query("SELECT * FROM metalar WHERE Id = '11'");
$a = $sql->fetch(PDO::FETCH_ASSOC);	
}
$title = $a["title"];
$description = $a["description"];
} elseif ($_GET["page"] == "category"){
$id = $_GET["id"];
$sql = $db->query("SELECT * FROM category WHERE Id = '$id'");
$a = $sql->fetch(PDO::FETCH_ASSOC);	
$title = $a["kategori_adi"]." İlanları";
$description = $a["kategori_adi"]." İlanları";
} elseif ($_GET["page"] == "ilan"){
$id = $_GET["id"];
$sql = $db->query("SELECT * FROM ilanlar WHERE Id = '$id'");
$a = $sql->fetch(PDO::FETCH_ASSOC);	
$title = $a["title"];
$description = $a["title"];
} else {
$sql = $db->query("SELECT * FROM metalar WHERE Id = '12'");
$a = $sql->fetch(PDO::FETCH_ASSOC);	
$title = $a["title"];
$description = $a["description"];
}
?>
<title><? echo $title; ?></title>
<meta name="description" content="<? echo $description; ?>">
<link href="<?php echo $base_url; ?>css/bootstrap.css" rel="stylesheet">
<link href="<?php echo $base_url; ?>css/style.css" rel="stylesheet">
<link href="<?php echo $base_url; ?>css/bootstrap-select.css" rel="stylesheet" >
<link href="<?php echo $base_url; ?>css/jquery.mCustomScrollbar.css" rel="stylesheet" >
<link href="<?php echo $base_url; ?>css/summernote.css" rel="stylesheet">
<link href="<?php echo $base_url; ?>css/checkbox-x.css" media="all" rel="stylesheet" type="text/css"/>
<link href="<?php echo $base_url; ?>css/theme-krajee-flatblue.css" media="all" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://opensource.keycdn.com/fontawesome/4.7.0/font-awesome.min.css" integrity="sha384-dNpIIXE8U05kAbPhy3G1cz+yZmTzA6CY8Vg/u2L9xRnHjJiAK76m2BIEaSEV+/aU" crossorigin="anonymous">
<link rel="stylesheet" href="/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<link rel="stylesheet" href="/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
<link rel="stylesheet" href="/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo $base_url; ?>js/global.js"></script>
<script src="<?php echo $base_url; ?>js/bootstrap.min.js"></script>
<script src="<?php echo $base_url; ?>js/jquery.maskedinput-1.3.min.js"></script>
<script src="<?php echo $base_url; ?>js/enscroll-0.6.0.min.js"></script>
<script src="<?php echo $base_url; ?>js/bootstrap-select.js"></script>
<script src="<?php echo $base_url; ?>js/i18n/defaults-tr_TR.js"></script>
<script src="<?php echo $base_url; ?>js/summernote.js"></script>
<script src="<?php echo $base_url; ?>js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="<?php echo $base_url; ?>js/checkbox-x.js" type="text/javascript"></script>
<script src="<?php echo $base_url; ?>js/jquery.mask.js" type="text/javascript"></script>
<script type="text/javascript" src="/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
<script type="text/javascript" src="/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
<script type="text/javascript" src="/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
<div class="header">
  <div class="container">
    <div class="row no-pad">
      <div class="col-xs-4">
        <div class="logo"><a href="<?php echo $base_url; ?>"><img src="<?php echo $base_url . $logo; ?>" height="85" alt="<?php $SiteName; ?>"/></a></div>
      </div>
      <div class="col-xs-8"><span class="pull-right banner1"><? echo banner(6); ?></span></div>
    </div>
  </div>
</div>
<nav class="navbar navbar-default navbar-static-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li><a href="<?php echo $base_url; ?>">Anasayfa</a></li>
        <li><a href="<?php echo $base_url; ?>acil-ilanlar.html?sayfa=1">Acil İlanlar</a></li>
        <li><a href="<?php echo $base_url; ?>magazalar.html">Magasins</a></li>
      </ul>
      <ul class="nav navbar-nav pull-right">
        <? if ($_SESSION['uye'] == "") { ?>
        <li style="margin-right:5px"><a href="/login/"><i class="fa fa-user" aria-hidden="true"></i> <?php echo $lg[2]; ?></a></li>
        <li style="margin-right:5px"><a href="/register/"><i class="fa fa-user-plus" aria-hidden="true"></i> <?php echo $lg[3]; ?></a></li>
        <? } else { ?>
        <li><a href="#" style="cursor:default; color:#fff"><strong><? echo $lg[9]; ?></strong> <? echo $_SESSION['adsoyad']; ?></a> </li>
        <li class="dropdown"> <a href="#" class="dropdown-toggle btn btn-dafault button2" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Bana Özel <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?
                                                        $uye = $_SESSION["uye"];
                                                        $sql = $db->query("SELECT * FROM mesajlar WHERE gonderilen = '$uye' and okundu = '0'");
                                                        $say = $sql->rowCount();
                                                        ?>
            <li><a href="index.php?page=message">Mesajlar
              <? if ($say != 0) { ?>
              </h4>
              <span class="label label-danger">( <? echo $say; ?> )</span>
              <? } ?>
              </a></li>
            <?
                                                        $uye = $_SESSION["uye"];
                                                        $sql = $db->query("SELECT * FROM ilanlar WHERE confirm = '0' and uyeId = '$uye'");
                                                        $say2 = $sql->rowCount();
                                                        $bugun = date("Y-m-d");
                                                        $sql = $db->query("SELECT * FROM ilanlar WHERE bitis < '$bugun' and uyeId = '$uye'");
                                                        $say = $sql->rowCount() + $say2;
                                                        ?>
            <li><a href="index.php?page=adverts">İlan Yönetimi
              <? if ($say != 0) { ?>
              </h4>
              <span class="label label-danger">( <? echo $say; ?> )</span>
              <? } ?>
              </a></li>
            <?
                                                        $uye = $_SESSION["uye"];
                                                        $sql = $db->query("SELECT * FROM siparisler WHERE satici = '$uye' and durum = '0'");
                                                        $say = $sql->rowCount();
                                                        ?>
            <li><a href="index.php?page=kihale">İhale İşlemlerim</a></li>
            <li><a href="index.php?page=satisislemlerim">Satış İşlemlerim
              <? if ($say != 0) { ?>
              </h4>
              <span class="label label-danger">( <? echo $say; ?> )</span>
              <? } ?>
              </a></li>
            <?
                                                        $uye = $_SESSION["uye"];
                                                        $sql = $db->query("SELECT * FROM siparisler WHERE alici = '$uye' and durum = '1'");
                                                        $say = $sql->rowCount();
                                                        ?>
            <li><a href="index.php?page=alisislemlerim">Alış İşlemlerim
              <? if ($say != 0) { ?>
              </h4>
              <span class="label label-danger">( <? echo $say; ?> )</span>
              <? } ?>
              </a></li>
            <?
                                                        $uye = $_SESSION["uye"];
                                                        $sql = $db->query("SELECT * FROM odemeler WHERE uyeId = '$uye'");
                                                        $say = $sql->rowCount();
                                                        ?>
            <li><a href="index.php?page=odemebildirimi">Ödeme Bildirimi
              <? if ($say != 0) { ?>
              </h4>
              <span class="label label-danger">( <? echo $say; ?> )</span>
              <? } ?>
              </a></li>
            <li><a href="index.php?page=favoriilanlarim">Favori İlanlarım</a></li>
            <?
                                                        $uye = $_SESSION["uye"];
                                                        $sql = $db->query("SELECT * FROM magazalar WHERE uyeId = '$uye'");
                                                        if ($sql->rowCount() > 0) {
                                                            echo '<li><a href="/index.php?page=medit">Mağaza Bilgilerim</a></li>';
                                                        }
                                                        ?>
            <li><a href="/index.php?page=membership">Üyeliğim</a></li>
            <li><a href="/index.php?page=exit">Çıkış</a></li>
          </ul>
        </li>
        <? } ?>
        <?
                                            if ($_SESSION['uye'] == "") {
                                                echo '<li style="margin-right:5px"><a href="/login/" class="btn btn-dafault button1"><i class="fa fa-plus-square" aria-hidden="true"></i> Ücretsiz İlan Ver</a></li>';
                                            } else {
                                                $uye = $_SESSION["uye"];
                                                $sql = $db->query("SELECT * FROM magazalar WHERE uyeId = '$uye'");
                                                if ($sql->rowCount() == 0) {
                                                    echo '<li ><a href="index.php?page=mopen" class="btn btn-dafault"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Mağaza Aç</a></li>';
                                                } else {

                                                }
                                                echo '<li style="margin-right:5px"><a href="index.php?page=add" class="btn btn-dafault button1"><i class="fa fa-plus-square" aria-hidden="true"></i> Ücretsiz İlan Ver</a></li>';
                                            }
                                            ?>
      </ul>
    </div>
    <!--/.nav-collapse --> 
  </div>
</nav>
<? if ($_GET['page'] == "") { ?>
<div class="header-s">
  <div class="container">
    <div class="row">
      <div class="col-xs-9 search-pad">
        <form action="index.php" method="get">
          <input type="hidden" name="page" value="search">
          <h3 class="search-h3"><?php echo $lg[4]; ?></h3>
          <div id="custom-search-input">
            <div class="input-group col-md-12">
              <input name="keyword" type="text" class="form-control" placeholder="Kelime veya ilan no..." required />
              <span class="input-group-btn">
              <button class="btn btn-info" type="submit"> <i class="glyphicon glyphicon-search"></i> </button>
              </span> </div>
          </div>
          <ul class="search-list">
            <?
			$sql = $db->query("SELECT * FROM category WHERE ustkategoriId = '0' LIMIT 8");
			while ($a = $sql->fetch(PDO::FETCH_ASSOC)) {
			echo '<li><a href="c-' . $a["Id"] . '-'.slugify($a["kategori_adi"]).'.html">' . $a["kategori_adi"] . '</a></li>';
			}
			?>
          </ul>
        </form>
      </div>
      <div class="col-xs-3"><img src="../img/header-img.png" height="230" alt="" style="margin-top:19px" class="pull-right"/></div>
    </div>
  </div>
</div>
<? } ?>
<div style="min-height:500px">
<?
                            if (!isset($_GET["page"])) {
                                include 'filesystems/default.php';
                            } elseif ($_GET["page"] == "login") {
                                include 'filesystems/login.php';
                            } elseif ($_GET["page"] == "register") {
                                include 'filesystems/register.php';
                            } elseif ($_GET["page"] == "lostpassword") {
                                include 'filesystems/lostpassword.php';
                            } elseif ($_GET["page"] == "membership") {
                                include 'filesystems/membership.php';
                            } elseif ($_GET["page"] == "changepassword") {
                                include 'filesystems/changepassword.php';
                            } elseif ($_GET["page"] == "add") {
                                include 'filesystems/add.php';
                            } elseif ($_GET["page"] == "add2") {
                                include 'filesystems/add2.php';
                            } elseif ($_GET["page"] == "add3") {
                                include 'filesystems/add3.php';
                            } elseif ($_GET["page"] == "doping") {
                                include 'filesystems/doping.php';
                            } elseif ($_GET["page"] == "dopingodeme") {
                                include 'filesystems/dopingodeme.php';
                            } elseif ($_GET["page"] == "dopingyayinla") {
                                include 'filesystems/dopingyayinla.php';
                            } elseif ($_GET["page"] == "adverts") {
                                include 'filesystems/adverts.php';
                            } elseif ($_GET["page"] == "advertsp") {
                                include 'filesystems/advertsp.php';
                            } elseif ($_GET["page"] == "advertsb") {
                                include 'filesystems/advertsb.php';
							} elseif ($_GET["page"] == "act") {
							$c = $_GET["c"];
							$sql2 = $db->query("SELECT * FROM users WHERE aktivasyonkodu = '$c' and aktivasyon = '0'");
                            if ($sql2->rowCount() == 0){
							$_SESSION['er'] = 0;	
							header("location: login/");
							} else {
							$sqls = $db->prepare("UPDATE users SET aktivasyon=? WHERE aktivasyonkodu = '$c'");
                            $ekle = $sqls->execute(array(1));
							$_SESSION['er'] = 1;
							header("location: login/");
							}
                            } elseif ($_GET["page"] == "advert_del") {
                                $id = $_GET["id"];
                                $uye = $_SESSION['uye'];
                                $sql2 = $db->prepare("DELETE FROM ilanlar WHERE Id = '{$id}' and uyeId = '$uye'");
                                $sql2->execute();
                                $sql2 = $db->prepare("DELETE FROM modul_ilan WHERE ilanId = '{$id}'");
                                $sql2->execute();
                                $sql2 = $db->prepare("DELETE FROM prop_ilan WHERE ilanId = '{$id}'");
                                $sql2->execute();
                                header("location: " . $_SERVER['HTTP_REFERER']);
                            } elseif ($_GET["page"] == "advert_o") {
                                $id = $_GET["id"];
                                $uye = $_SESSION['uye'];
                                $sql = $db->query("SELECT * FROM ilanlar WHERE Id = '$id' and uyeId = '$uye'");
                                $a = $sql->fetch(PDO::FETCH_ASSOC);
                                $bugun = date("Y-m-d");
                                $date = date("Y-m-d", strtotime($bugun . " +$a[yayin] day"));

                                $sqls = $db->prepare("UPDATE ilanlar SET bitis=? WHERE Id = '$id'");
                                $ekle = $sqls->execute(array($date));
                                header("location: " . $_SERVER['HTTP_REFERER']);
                            } elseif ($_GET["page"] == "category") {
                                include 'filesystems/category.php';
                            } elseif ($_GET["page"] == "anasayfa") {
                                include 'filesystems/anasayfa.php';
                            } elseif ($_GET["page"] == "acil") {
                                include 'filesystems/acil.php';
                            } elseif ($_GET["page"] == "ilan") {
                                include 'filesystems/ilan.php';
                            } elseif ($_GET["page"] == "mesajgonder") {
                                include 'filesystems/mesajgonder.php';
                            } elseif ($_GET["page"] == "message") {
                                include 'filesystems/message.php';
                            } elseif ($_GET["page"] == "message2") {
                                include 'filesystems/message2.php';
                            } elseif ($_GET["page"] == "messageread") {
                                include 'filesystems/messageread.php';
                            } elseif ($_GET["page"] == "messageread2") {
                                include 'filesystems/messageread2.php';
                            } elseif ($_GET["page"] == "kullanici") {
                                include 'filesystems/kullanici.php';
                            } elseif ($_GET["page"] == "sikayet") {
                                include 'filesystems/sikayet.php';
                            } elseif ($_GET["page"] == "mopen") {
                                include 'filesystems/mopen.php';
                            } elseif ($_GET["page"] == "magazaodeme") {
                                include 'filesystems/magazaodeme.php';
                            } elseif ($_GET["page"] == "odemebildirimi") {
                                include 'filesystems/odemebildirimi.php';
                            } elseif ($_GET["page"] == "favoriilanlarim") {
                                include 'filesystems/favoriilanlarim.php';
                            } elseif ($_GET["page"] == "medit") {
                                include 'filesystems/medit.php';
                            } elseif ($_GET["page"] == "banka") {
                                include 'filesystems/banka.php';
                            } elseif ($_GET["page"] == "yayin") {
                                include 'filesystems/yayin.php';
                            } elseif ($_GET["page"] == "satinal") {
                                include 'filesystems/satinal.php';
                            } elseif ($_GET["page"] == "adres") {
                                include 'filesystems/adres.php';
                            } elseif ($_GET["page"] == "adres2") {
                                include 'filesystems/adres2.php';
                            } elseif ($_GET["page"] == "ozet") {
                                include 'filesystems/ozet.php';
                            } elseif ($_GET["page"] == "odeme") {
                                include 'filesystems/odeme.php';
                            } elseif ($_GET["page"] == "satisislemlerim") {
                                include 'filesystems/satisislemlerim.php';
                            } elseif ($_GET["page"] == "alisislemlerim") {
                                include 'filesystems/alisislemlerim.php';
                            } elseif ($_GET["page"] == "siparis") {
                                include 'filesystems/siparis.php';
                            } elseif ($_GET["page"] == "kargo") {
                                include 'filesystems/kargo.php';
                            } elseif ($_GET["page"] == "mesajgonder2") {
                                include 'filesystems/mesajgonder2.php';
                            } elseif ($_GET["page"] == "kargolayacaklarim") {
                                include 'filesystems/kargolayacaklarim.php';
                            } elseif ($_GET["page"] == "onaybekleyen") {
                                include 'filesystems/onaybekleyen.php';
                            } elseif ($_GET["page"] == "odemebekleyen") {
                                include 'filesystems/odemebekleyen.php';
                            } elseif ($_GET["page"] == "tamamlanan") {
                                include 'filesystems/tamamlanan.php';
                            } elseif ($_GET["page"] == "kargoonay") {
                                include 'filesystems/kargoonay.php';
                            } elseif ($_GET["page"] == "yorumyap") {
                                include 'filesystems/yorumyap.php';
                            } elseif ($_GET["page"] == "siparis2") {
                                include 'filesystems/siparis2.php';
                            } elseif ($_GET["page"] == "kargobekleyen") {
                                include 'filesystems/kargobekleyen.php';
                            } elseif ($_GET["page"] == "onayimibekleyen") {
                                include 'filesystems/onayimibekleyen.php';
                            } elseif ($_GET["page"] == "profil") {
                                include 'filesystems/profil.php';
                            } elseif ($_GET["page"] == "banaozel") {
                                include 'filesystems/banaozel.php';
                            } elseif ($_GET["page"] == "magazalar") {
                                include 'filesystems/magazalar.php';
                            } elseif ($_GET["page"] == "search") {
                                include 'filesystems/search.php';
							} elseif ($_GET["page"] == "sayfa") {
                                include 'filesystems/sayfa.php';
							} elseif ($_GET["page"] == "iletisim") {
                                include 'filesystems/iletisim.php';
							} elseif ($_GET["page"] == "ihale") {
                                include 'filesystems/ihale.php';
							} elseif ($_GET["page"] == "kihale") {
                                include 'filesystems/kihale.php';
							} elseif ($_GET["page"] == "kbihale") {
                                include 'filesystems/kbihale.php';
							
                            } elseif ($_GET["page"] == "exit") {
                                unset($_SESSION["uye"]);
                                unset($_SESSION["adsoyad"]);
                                header("location: index.php");
                            }
                         ?>
  </div>  
<footer>
<section class="nb-footer">
<div class="container">
<div class="row">
<div class="col-xs-3"><div class="footerlogo"><img src="<? echo $base_url; ?>img/logo.png" width="90%" alt=""/></div></div>
<div class="col-xs-3">
<div class="footer-single useful-links">
<div class="footer-title">
  <h2>Information d'entreprise</h2>
</div>
<ul class="list-unstyled">
<li><a href="index.php">Anasayfa <i class="fa fa-angle-right pull-right"></i></a></li>
<li><a href="hakkimizda.html">Hakkımızda <i class="fa fa-angle-right pull-right"></i></a></li>
<li><a href="iletisim.html">İletişim <i class="fa fa-angle-right pull-right"></i></a></li>
</div>
</div>
<div class="col-xs-3">
<div class="footer-single useful-links">
<div class="footer-title">
  <h2>Nos services</h2>
</div>
<ul class="list-unstyled">
<li><a href="doping.html">Doping <i class="fa fa-angle-right pull-right"></i></a></li>
<li><a href="reklam.html">Reklam <i class="fa fa-angle-right pull-right"></i></a></li>
<li><a href="guvenli-alisveris.html">Güvenli Alışveriş Sistemi <i class="fa fa-angle-right pull-right"></i></a></li>
</div>
</div>
<div class="col-xs-3">
<div class="footer-single useful-links">
<div class="footer-title">
  <h2>Gizlilik & Kullanım</h2>
</div>
<ul class="list-unstyled">
<li><a href="yardim.html">Yardım <i class="fa fa-angle-right pull-right"></i></a></li>
<li><a href="kullanim-sartlari.html">Kullanım Şartları <i class="fa fa-angle-right pull-right"></i></a></li>
<li><a href="gizlilik-politikasi.html">Gizlilik Politikası <i class="fa fa-angle-right pull-right"></i></a></li>
</div>
</div>
</div>
</div>
</section>
<section class="nb-copyright">
  <div class="container">
    <div class="footercop"> <? echo $SiteName; ?> Yer Alan Kullanıcıların Oluşturduğu Tüm İçerik, Görüş Ve Bilgilerin Doğruluğu, Eksiksiz Ve Değişmez Olduğu, Yayınlanması İle İlgili Yasal Yükümlülükler İçeriği Oluşturan Kullanıcıya Aittir.Bu İçeriğin, Görüş Ve Bilgilerin Yanlışlık, Eksiklik Veya Yasalarla Düzenlenmiş Kurallara Aykırılığından Hiçbir Şekilde Sitemiz Sorumlu Değildir.<br>
      Sorularınız İçin İlan Sahibi İle İrtibata Geçebilirsiniz. </div>
  </div>
</section>
</footer>

</body>
</html>
<? ob_end_flush(); ?>