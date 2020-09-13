<?
ob_start();
if (@$_GET["page"] == "genelayarlar"){
include 'functions2.php';	
} else  {
include '../functions.php';	
}
if ($_SESSION['giris'] != 1){
	header("location: login.php");
}

$Id=$_GET['id'];
$sql = $db->query("SELECT * FROM users WHERE Id = '$Id'");
$a46 = $sql->fetch(PDO::FETCH_ASSOC);
$girisyap=$_GET['girisyap'];
$redirect=base64_decode($_GET['redirect']);
if($girisyap=='basarili'){
$_SESSION['adsoyad'] = $a46["ad_soyad"];
$_SESSION['uye'] = $Id;	
header("location:".$redirect);
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Yönetim Paneli</title>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
<link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
<link rel="stylesheet" href="plugins/morris/morris.css">
<link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
<link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
<link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
<link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="dist/global.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <header class="main-header"><a href="index.php" class="logo"><span class="logo-mini"><b>Y</b>NT</span><span class="logo-lg"><b>Yönetim</b>Paneli</span> </a>
    <nav class="navbar navbar-static-top"><a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"> <span class="sr-only">Toggle navigation</span> </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <?
		  $sql = $db->query("SELECT * FROM users WHERE aktivasyon = '0'");
		  $say  = $sql->rowCount();
		  ?>
          <li> <a alt="Akyivasyon bekleyen üye" title="Aktivasyon bekleyen üye" href="index.php?page=aktivasyonbekleyen"><i class="fa fa-user"></i> <span class="label label-danger"><? echo $say; ?></span></a> </li>
          <?
		  $sql = $db->query("SELECT * FROM bildirimler");
		  $say  = $sql->rowCount();
		  ?>
          <li> <a alt="Ödeme Bildirimi" title="Ödeme Bildirimi" href="index.php?page=odemebildirimi"><i class="fa fa-usd"></i> <span class="label label-danger"><? echo $say; ?></span></a> </li>
          <?
		  $sql = $db->query("SELECT * FROM siparisler WHERE durum < '4' ");
		  $say  = $sql->rowCount();
		  ?>
          <li> <a alt="Sipariş" title="Sipariş" href="index.php?page=gkargo"><i class="fa fa-lock"></i> <span class="label label-danger"><? echo $say; ?></span></a> </li>
          <?
		  $sql = $db->query("SELECT * FROM magazalar WHERE onay = '0' ");
		  $say  = $sql->rowCount();
		  ?>
          <li> <a alt="Onay Bekleyen Mağaza" title="Onay Bekleyen Mağaza" href="index.php?page=monaybekleyen"><i class="fa fa-shopping-bag"></i> <span class="label label-danger"><? echo $say; ?></span></a> </li>
          <?
		  $sql = $db->query("SELECT * FROM ilanlar WHERE confirm = '0' ");
		  $say  = $sql->rowCount();
		  ?>
          <li> <a alt="Onay Bekleyen İlanlar" title="Onay Bekleyen İlanlar" href="index.php?page=onaybekleyen"><i class="fa fa-picture-o"></i> <span class="label label-danger"><? echo $say; ?></span></a> </li>
          <li> <a alt="Güveli Çıkış" title="Güvenli Çıkış" href="index.php?page=cikis" alt="Çıkış" title="Çıkış"><i class="fa fa-sign-out" aria-hidden="true"></i></a> </li>
        </ul>
      </div>
    </nav>
  </header>
  <aside class="main-sidebar">
    <section class="sidebar">
      <ul class="sidebar-menu">
	  <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/admins.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Administrator</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Çevrimiçi</a>
        </div>
      </div>
        <li class="header">İşlem Menüsü</li>
        <li> <a href="index.php" > <i class="fa fa-home"></i> <span>Page d'accueil</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a></li>
        <? if ($_SESSION["siteayarlari"] == 1){ ?>
		<li class="treeview
		<?
		if ($_GET["page"] == ""){
			echo " active";
		} elseif ($_GET["page"] == "odemesistemleri"){
			echo " active";
		} elseif ($_GET["page"] == "mailayarlari"){
			echo " active";	
		} elseif ($_GET["page"] == "smsayarlari"){
			echo " active";	
		} elseif ($_GET["page"] == "dopingucretleri"){
			echo " active";	
		} elseif ($_GET["page"] == "magazaucretleri"){
			echo " active";	
		} elseif ($_GET["page"] == "get"){
			echo " active";
		} elseif ($_GET["page"] == "banka"){
			echo " active";
		} elseif ($_GET["page"] == "bankaekle"){
			echo " active";	
		} elseif ($_GET["page"] == "btcltc"){
			echo " active";
		} elseif ($_GET["page"] == "banner"){
			echo " active";
		} elseif ($_GET["page"] == "ba"){
			echo " active";
		} elseif ($_GET["page"] == "slider"){
			echo " active";
		} elseif ($_GET["page"] == "sliderekle"){
			echo " active";
		} elseif ($_GET["page"] == "metayonetimi"){
			echo " active";
		} elseif ($_GET["page"] == "meta"){
			echo " active";
		} elseif ($_GET["page"] == "moduller"){
			echo " active";	
		} elseif ($_GET["page"] == "modulekle"){
			echo " active";	
		} elseif ($_GET["page"] == "modulsecenekleri"){
			echo " active";	
		} elseif ($_GET["page"] == "modulsecenekekle"){
			echo " active";	
		} elseif ($_GET["page"] == "modulsecenekduzenle"){
			echo " active";	
		} elseif ($_GET["page"] == "modulozellikleri"){
			echo " active";	
		} elseif ($_GET["page"] == "grupekle"){
			echo " active";	
		} elseif ($_GET["page"] == "grupduzenle"){
			echo " active";	
		} elseif ($_GET["page"] == "grupozellikleri"){
			echo " active";	
		} elseif ($_GET["page"] == "sinir"){
			echo " active";	
		} elseif ($_GET["page"] == "panel"){
			echo " active";	
		} elseif ($_GET["page"] == "sss"){
			echo " active";	
		} elseif ($_GET["page"] == "bolgeler"){
			echo " active";	
		} elseif ($_GET["page"] == "sssekle"){
			echo " active";	
		} elseif ($_GET["page"] == "sssduzenle"){
			echo " active";	
		} elseif ($_GET["page"] == "kullanicilar"){
			echo " active";	
		} elseif ($_GET["page"] == "kullaniciekle"){
			echo " active";		
		} elseif ($_GET["page"] == "kullaniciduzenle"){
			echo " active";	
		} elseif ($_GET["page"] == "genelayarlar"){
			echo " active";	
		}
		?>
		"> <a href="#"> <i class="fa fa-gears"></i> <span>Site Ayarları</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">
		  <li><a href="index.php?page=genelayarlar"><i class="fa fa-circle-o"></i> Genel Ayarlar</a></li>
		  <li><a href="index.php?page=kullanicilar"><i class="fa fa-circle-o"></i> Panel Yetki Yönetimi</a></li>
		   <li><a href="index.php?page=odemesistemleri"><i class="fa fa-circle-o"></i> Ödeme Sistemleri</a></li>
		   <li><a href="index.php?page=vitrinlimit"><i class="fa fa-circle-o"></i> Vitrin Limit Ayarları</a></li>
            <li><a href="index.php?page=mailayarlari"><i class="fa fa-circle-o"></i> Mail Ayarları</a></li>
            <li><a href="index.php?page=smsayarlari"><i class="fa fa-circle-o"></i> Sms Ayarları</a></li>
            <li><a href="index.php?page=dopingucretleri"><i class="fa fa-circle-o"></i> Doping Ücretleri</a></li>
            <li><a href="index.php?page=magazaucretleri"><i class="fa fa-circle-o"></i> Mağaza Ücretleri</a></li>
            <li><a href="index.php?page=get"><i class="fa fa-circle-o"></i> GET Ayarları</a></li>
            <li><a href="index.php?page=banka"><i class="fa fa-circle-o"></i> Banka Bilgileri</a></li>
            <li><a href="index.php?page=banner"><i class="fa fa-circle-o"></i> Banner Yönetimi</a></li>
			<li><a href="index.php?page=slider"><i class="fa fa-circle-o"></i> Slider Yönetimi</a></li>
            <li><a href="index.php?page=metayonetimi"><i class="fa fa-circle-o"></i> Meta Yönetimi</a></li>
			<li><a href="index.php?page=moduller"><i class="fa fa-circle-o"></i> Modül Yönetimi</a></li>
			<li><a href="index.php?page=sinir"><i class="fa fa-circle-o"></i> Kullanıcı İlan Sınırı</a></li>
			<li><a href="index.php?page=bolgeler"><i class="fa fa-circle-o"></i> Bölge Yönetimi</a></li>
	        <li><a href="index.php?page=toplumail"><i class="fa fa-circle-o"></i> Toplu Mail Gönder</a></li>
			<li><a href="index.php?page=sosyalmedya"><i class="fa fa-circle-o"></i> Sosyal Medya Ayarları</a></li>
			<li> <a href="index.php?page=sss"> <i class="fa fa-circle-o"></i> <span>S.S.S.</span> <span class="pull-right-container">  </a></li>
          </ul>
        </li>
		<? } ?>
		<? if ($_SESSION["ilanyonetimi"] == 1){ ?>
        <li class="treeview
		<?
		if ($_GET["page"] == "onaybekleyen"){
			echo " active";
		} elseif ($_GET["page"] == "duzenle"){
			echo " active";
		} elseif ($_GET["page"] == "vitrin"){
			echo " active";	
		} elseif ($_GET["page"] == "onaylanmis"){
			echo " active";	
		} elseif ($_GET["page"] == "suresibitenler"){
			echo " active";	
		} elseif ($_GET["page"] == "sikayetler"){
			echo " active";	
		} elseif ($_GET["page"] == "sikayet"){
			echo " active";		
		}
		?>"> 
		<a href="#"> <i class="fa fa-picture-o"></i> <span>İlan Yönetimi</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">
            <li><a href="index.php?page=onaybekleyen"><i class="fa fa-circle-o"></i> Onay Bekleyen</a></li>
            <li><a href="index.php?page=onaylanmis"><i class="fa fa-circle-o"></i> Onaylanmış</a></li>
            <li><a href="index.php?page=suresibitenler"><i class="fa fa-circle-o"></i> Süresi Bitenler</a></li>
            <li><a href="index.php?page=sikayetler"><i class="fa fa-circle-o"></i> Şikayetler</a></li>
          </ul>
        </li>
		<? } ?>
		<? if ($_SESSION["ilanyonetimi"] == 1){ ?>
        <li class="treeview
		<?
		if ($_GET["page"] == "vitrinilanlari"){
			echo " active";
		} elseif ($_GET["page"] == "acilacililanlari"){
			echo " active";
		} elseif ($_GET["page"] == "katvitrinilanlari"){
			echo " active";	
		} elseif ($_GET["page"] == "renklivekalin"){
			echo " active";	
		}
		?>"> 
		<a href="#"> <i class="fa fa-picture-o"></i> <span>Doping Yönetimi</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">
            <li><a href="index.php?page=vitrinilanlari"><i class="fa fa-circle-o"></i> Anasayfa Vitrin İlanları</a></li>
            <li><a href="index.php?page=acilacililanlari"><i class="fa fa-circle-o"></i> Acil Acil Vitrin İlanları</a></li>
            <li><a href="index.php?page=katvitrinilanlari"><i class="fa fa-circle-o"></i> Kategori Vitrin İlanları</a></li>
            <li><a href="index.php?page=renklivekalin"><i class="fa fa-circle-o"></i> Kalın Yazı Doping İlanları</a></li>
          </ul>
        </li>
		<? } ?>
		<? if ($_SESSION["kategoriyonetimi"] == 1){ ?>
        <li class="treeview
		<?
		if ($_GET["page"] == "kategoriekle"){
			echo " active";
		} elseif ($_GET["page"] == "kategoriekle2"){
			echo " active";
		} elseif ($_GET["page"] == "kategoriler"){
			echo " active";	
		} elseif ($_GET["page"] == "kduzenle"){
			echo " active";		
		}
		?>
		"> <a href="#"> <i class="fa fa-server"></i> <span>Kategori Yönetimi</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">
            <li><a href="index.php?page=kategoriekle"><i class="fa fa-circle-o"></i> Anakategori Ekle</a></li>
            <li><a href="index.php?page=kategoriekle2"><i class="fa fa-circle-o"></i> Altkategori Ekle</a></li>
            <li><a href="index.php?page=kategoriler"><i class="fa fa-circle-o"></i>Catégories</a></li>
          </ul>
        </li>
		<? } ?>
		
		<? if ($_SESSION["magazayonetimi"] == 1){ ?>
        <li class="treeview
		<?
		if ($_GET["page"] == "monaybekleyen"){
			echo " active";
		} elseif ($_GET["page"] == "monaylanan"){
			echo " active";
		} elseif ($_GET["page"] == "mduzenle"){
			echo " active";	
		} elseif ($_GET["page"] == "msuresibitenler"){
			echo " active";		
		}
		?>"> <a href="#"> <i class="fa fa-shopping-bag"></i> <span>Mağaza Yönetimi</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">
            <li><a href="index.php?page=monaybekleyen"><i class="fa fa-circle-o"></i> Onay Bekleyen</a></li>
            <li><a href="index.php?page=monaylanan"><i class="fa fa-circle-o"></i> Onaylanmış</a></li>
            <li><a href="index.php?page=msuresibitenler"><i class="fa fa-circle-o"></i> Süresi Bitenler</a></li>
          </ul>
        </li>
		<? } ?>
		
		<? if ($_SESSION["getislemleri"] == 1){ ?>
        <li class="treeview
		<?
		if ($_GET["page"] == "gkargo"){
			echo " active";
		} elseif ($_GET["page"] == "gonaybekleyen"){
			echo " active";
		} elseif ($_GET["page"] == "godemebekleyen"){
			echo " active";	
		} elseif ($_GET["page"] == "siparis"){
			echo " active";
		} elseif ($_GET["page"] == "gtamamlanan"){
			echo " active";
		}
		?>
		"> <a href="#"> <i class="fa fa-lock"></i> <span>GET İşlemleri</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">
            <li><a href="index.php?page=gkargo"><i class="fa fa-circle-o"></i> Kargo Bekleyen</a></li>
            <li><a href="index.php?page=gonaybekleyen"><i class="fa fa-circle-o"></i> Alıcı Onay Bekleyen</a></li>
            <li><a href="index.php?page=godemebekleyen"><i class="fa fa-circle-o"></i> Ödeme Bekleyen</a></li>
            <li><a href="index.php?page=gtamamlanan"><i class="fa fa-circle-o"></i> Tamamlanan</a></li>
          </ul>
        </li>
		<? } ?>
		
		<? if ($_SESSION["odemeislemleri"] == 1){ ?>
        <li class="treeview
		<?
		if ($_GET["page"] == "bekleyenodemeler"){
			echo " active";
		} elseif ($_GET["page"] == "odemebildirimi"){
			echo " active";	
		} elseif ($_GET["page"] == "godemeler"){
			echo " active";
		}
		?>
		"> <a href="#"> <i class="fa fa-usd"></i> <span>Ödeme İşlemleri</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">
            <li><a href="index.php?page=bekleyenodemeler"><i class="fa fa-circle-o"></i> Bekleyen Ödemeler</a></li>
            <li><a href="index.php?page=odemebildirimi"><i class="fa fa-circle-o"></i> Ödeme Bildirimleri</a></li>
            <li><a href="index.php?page=godemeler"><i class="fa fa-circle-o"></i> Gönderilecek Ödemeler</a></li>
          </ul>
        </li>
		<? } ?>
		
		<? if ($_SESSION["uyeislemleri"] == 1){ ?>
        <li class="treeview
		<?
		if ($_GET["page"] == "aktif"){
			echo " active";
		} elseif ($_GET["page"] == "aktivasyonbekleyen"){
			echo " active";
		} elseif ($_GET["page"] == "uye"){
			echo " active";	
		} elseif ($_GET["page"] == "uyeduzenle"){
			echo " active";
		}
		?>"> <a href="#"> <i class="fa fa-user"></i> <span>Üye İşlemleri</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">
            <li><a href="index.php?page=aktif"><i class="fa fa-circle-o"></i> Aktif</a></li>
            <li><a href="index.php?page=aktivasyonbekleyen"><i class="fa fa-circle-o"></i>Aktivasyon Bekleyen</a></li>
          </ul>
        </li>
		<? } ?>
		
		<? if ($_SESSION["blog"] == 1){ ?>
		<li class="treeview
		<?
		if ($_GET["page"] == "bkategoriler"){
			echo " active";
		} elseif ($_GET["page"] == "byazilar"){
			echo " active";
		} elseif ($_GET["page"] == "bkategoriekle"){
			echo " active";	
		} elseif ($_GET["page"] == "bkategoriduzenle"){
			echo " active";
		} elseif ($_GET["page"] == "byaziduzenle"){
			echo " active";
		} elseif ($_GET["page"] == "byaziekle"){
			echo " active";
		}
		?>"> 
		<a href="#"> <i class="fa fa-user"></i> <span>Blog Yönetimi</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">
            <li><a href="index.php?page=bkategoriler"><i class="fa fa-circle-o"></i> Kategori Yönetimi</a></li>
            <li><a href="index.php?page=byazilar"><i class="fa fa-circle-o"></i>Yazı Yönetimi</a></li>
          </ul>
        </li>
		<? } ?>
		<? if ($_SESSION["sayfa"] == 1){ ?>
		
         <li> <a href="index.php?page=sayfalar"> <i class="fa fa-file-text"></i> <span>Sayfa Yönetimi</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a></li>
		 <? } ?>
		 <li> <a href="index.php?page=sikayetler" > <i class="fa fa-file-text"></i> <span>İlan Şikayetleri</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a></li>
         <li> <a href="index.php?page=cikis" > <i class="fa fa-sign-out"></i> <span>Güvenli Çıkış</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a></li>
      </ul>
    </section>
  </aside>
  <div class="content-wrapper">
    <?
$page = $_GET["page"];
if ($page == ""){
	if ($_SESSION["siteayarlari"] == 1){
	include 'genelayarlar.php';
	}
} elseif ($page == "mailayarlari"){
	if ($_SESSION["siteayarlari"] == 1){
	include 'mailayarlari.php';
	}
} elseif ($page == "dopingucretleri"){
	if ($_SESSION["siteayarlari"] == 1){
	include 'dopingucretleri.php';
	}
} elseif ($page == "magazaucretleri"){
	if ($_SESSION["siteayarlari"] == 1){
	include 'magazaucretleri.php';	
	}
} elseif ($page == "get"){
	if ($_SESSION["siteayarlari"] == 1){
	include 'get.php';	
	}
} elseif ($page == "banka"){
	if ($_SESSION["siteayarlari"] == 1){
	include 'banka.php';
	}
} elseif ($page == "bankaekle"){
	if ($_SESSION["siteayarlari"] == 1){
	include 'bankaekle.php';
	}
} elseif ($page == "onaybekleyen"){
	if ($_SESSION["ilanyonetimi"] == 1){
	include 'onaybekleyen.php';	
	}
} elseif ($page == "onaylanmis"){
	if ($_SESSION["ilanyonetimi"] == 1){
	include 'onaylanmis.php';	
	}
} elseif ($page == "suresibitenler"){
	if ($_SESSION["ilanyonetimi"] == 1){
	include 'suresibitenler.php';		
	}
} elseif ($page == "duzenle"){
	if ($_SESSION["ilanyonetimi"] == 1){
	include 'duzenle.php';	
	}
} elseif ($page == "add3"){
	if ($_SESSION["ilanyonetimi"] == 1){
	include 'add3.php';	
	}
} elseif ($page == "vitrin"){
	if ($_SESSION["ilanyonetimi"] == 1){
	include 'vitrin.php';	
	}
} elseif ($page == "kategoriekle"){
	if ($_SESSION["kategoriyonetimi"] == 1){
	include 'kategoriekle.php';	
	}
} elseif ($page == "kategoriekle2"){
	if ($_SESSION["kategoriyonetimi"] == 1){
	include 'kategoriekle2.php';	
	}
} elseif ($page == "kategoriekle3"){
	if ($_SESSION["kategoriyonetimi"] == 1){
	include 'kategoriekle3.php';
	}
} elseif ($page == "kategoriler"){
	if ($_SESSION["kategoriyonetimi"] == 1){
	include 'kategoriler.php';
	}
} elseif ($page == "kduzenle"){
	if ($_SESSION["kategoriyonetimi"] == 1){
	include 'kduzenle.php';	
	}
} elseif ($page == "monaybekleyen"){
	if ($_SESSION["magazayonetimi"] == 1){
	include 'monaybekleyen.php';
	}
} elseif ($page == "mduzenle"){
	if ($_SESSION["magazayonetimi"] == 1){
	include 'mduzenle.php';	
	}
} elseif ($page == "monaylanan"){
	if ($_SESSION["magazayonetimi"] == 1){
	include 'monaylanan.php';
	}
} elseif ($page == "msuresibitenler"){
	if ($_SESSION["magazayonetimi"] == 1){
	include 'msuresibitenler.php';
	}
} elseif ($page == "sikayetler"){
	if ($_SESSION["ilanyonetimi"] == 1){
	include 'sikayetler.php';	
	}
} elseif ($page == "sikayet"){
	if ($_SESSION["ilanyonetimi"] == 1){
	include 'sikayet.php';
	}
} elseif ($page == "bekleyenodemeler"){
	if ($_SESSION["odemeislemleri"] == 1){
	include 'bekleyenodemeler.php';		
	}
} elseif ($page == "odemebildirimi"){
	if ($_SESSION["odemeislemleri"] == 1){
	include 'odemebildirimi.php';	
	}
} elseif ($page == "gkargo"){
	if ($_SESSION["getislemleri"] == 1){
	include 'gkargo.php';
	}
} elseif ($page == "siparis"){
	if ($_SESSION["getislemleri"] == 1){
	include 'siparis.php';
	}
} elseif ($page == "gonaybekleyen"){
	if ($_SESSION["getislemleri"] == 1){
	include 'gonaybekleyen.php';
	}
} elseif ($page == "godemebekleyen"){
	if ($_SESSION["getislemleri"] == 1){
	include 'godemebekleyen.php';
	}
} elseif ($page == "gtamamlanan"){
	if ($_SESSION["getislemleri"] == 1){
	include 'gtamamlanan.php';
	}
} elseif ($page == "godemeler"){
	if ($_SESSION["getislemleri"] == 1){
	include 'godemeler.php';
	}
} elseif ($page == "aktif"){
	if ($_SESSION["uyeislemleri"] == 1){
	include 'aktif.php';
	}
} elseif ($page == "sinir"){
	if ($_SESSION["siteayarlari"] == 1){
	include 'sinir.php';
	}	
} elseif ($page == "uye"){
	if ($_SESSION["uyeislemleri"] == 1){
	include 'uye.php';
	}
} elseif ($page == "uyeduzenle"){
	if ($_SESSION["uyeislemleri"] == 1){
	include 'uyeduzenle.php';
	}
} elseif ($page == "aktivasyonbekleyen"){
	if ($_SESSION["uyeislemleri"] == 1){
	include 'aktivasyonbekleyen.php';
	}
} elseif ($page == "banner"){
	if ($_SESSION["siteayarlari"] == 1){
	include 'banner.php';	
	}
} elseif ($page == "ba"){
	if ($_SESSION["siteayarlari"] == 1){
	include 'ba.php';	
	}
} elseif ($page == "toplumail"){
	if ($_SESSION["siteayarlari"] == 1){
	include 'toplumail.php';	
	}
} elseif ($page == "sosyalmedya"){
	if ($_SESSION["siteayarlari"] == 1){
	include 'sosyalmedya.php';	
	}
} elseif ($page == "vitrinlimit"){
	if ($_SESSION["siteayarlari"] == 1){
	include 'vitrinlimit.php';	
	}
} elseif ($page == "bolgeler"){
	if ($_SESSION["siteayarlari"] == 1){
	include 'bolgeler.php';	
	}

} elseif ($page == "ilekle"){
	if ($_SESSION["siteayarlari"] == 1){
	include 'ilekle.php';	
	}	
} elseif ($page == "ilsil"){
	if ($_SESSION["siteayarlari"] == 1){
	include 'ilsil.php';	
	}		
	} elseif ($page == "ilduzenle"){
	if ($_SESSION["siteayarlari"] == 1){
	include 'ilduzenle.php';	
	}		
} elseif ($page == "ilceler"){
	if ($_SESSION["siteayarlari"] == 1){
	include 'ilceler.php';	
	}
} elseif ($page == "mahalleler"){
	if ($_SESSION["siteayarlari"] == 1){
	include 'mahalleler.php';	
	}	
} elseif ($page == "ilceduzenle"){
	if ($_SESSION["siteayarlari"] == 1){
	include 'ilceduzenle.php';	
	}	
} elseif ($page == "ilcesil"){
	if ($_SESSION["siteayarlari"] == 1){
	include 'ilcesil.php';	
	}		
} elseif ($page == "mahalleduzenle"){
	if ($_SESSION["siteayarlari"] == 1){
	include 'mahalleduzenle.php';	
	}	
} elseif ($page == "mahallesil"){
	if ($_SESSION["siteayarlari"] == 1){
	include 'mahallesil.php';	
	}	
} elseif ($page == "sayfalar"){
	if ($_SESSION["sayfa"] == 1){
	include 'sayfalar.php';	
	}
} elseif ($page == "ilceekle"){
	if ($_SESSION["sayfa"] == 1){
	include 'ilceekle.php';	
	}
} elseif ($page == "mahalleekle"){
	if ($_SESSION["sayfa"] == 1){
	include 'mahalleekle.php';	
	}
} elseif ($page == "sayfa"){
	if ($_SESSION["sayfa"] == 1){
	include 'sayfa.php';
	}
} elseif ($page == "metayonetimi"){
	if ($_SESSION["siteayarlari"] == 1){
	include 'metayonetimi.php';	
	}
} elseif ($page == "meta"){
	if ($_SESSION["siteayarlari"] == 1){
	include 'meta.php';	
	}
} elseif ($page == "panel"){
	if ($_SESSION["siteayarlari"] == 1){
	include 'panel.php';
	}
} elseif ($page == "smsayarlari"){
	if ($_SESSION["siteayarlari"] == 1){
	include 'smsayarlari.php';	
	}
} elseif ($page == "odemesistemleri"){
	if ($_SESSION["siteayarlari"] == 1){
	include 'odemesistemleri.php';
	}
} elseif ($page == "btcltc"){
	if ($_SESSION["siteayarlari"] == 1){
	include 'btcltc.php';
	}
} elseif ($page == "sss"){
	if ($_SESSION["siteayarlari"] == 1){
	include 'sss.php';	
	}
} elseif ($page == "sssekle"){
	if ($_SESSION["siteayarlari"] == 1){
	include 'sssekle.php';	
	}
} elseif ($page == "sssduzenle"){
	if ($_SESSION["siteayarlari"] == 1){
	include 'sssduzenle.php';
	}
} elseif ($page == "sayfaekle"){
	if ($_SESSION["sayfa"] == 1){
	include 'sayfaekle.php';
	}
} elseif ($page == "moduller"){
	if ($_SESSION["siteayarlari"] == 1){
	include 'moduller.php';	
	}
} elseif ($page == "modulekle"){
	if ($_SESSION["siteayarlari"] == 1){
	include 'modulekle.php';	
	}
} elseif ($page == "modulsecenekleri"){
	if ($_SESSION["siteayarlari"] == 1){
	include 'modulsecenekleri.php';	
	}
} elseif ($page == "modulsecenekekle"){
	if ($_SESSION["siteayarlari"] == 1){
	include 'modulsecenekekle.php';	
	}
} elseif ($page == "modulsecenekduzenle"){
	if ($_SESSION["siteayarlari"] == 1){
	include 'modulsecenekduzenle.php';	
	}
} elseif ($page == "modulozellikleri"){
	if ($_SESSION["siteayarlari"] == 1){
	include 'modulozellikleri.php';	
	}
} elseif ($page == "grupekle"){
	if ($_SESSION["siteayarlari"] == 1){
	include 'grupekle.php';	
	}
} elseif ($page == "grupduzenle"){
	if ($_SESSION["siteayarlari"] == 1){
	include 'grupduzenle.php';	
	}
} elseif ($page == "grupozellikleri"){
	if ($_SESSION["siteayarlari"] == 1){
	include 'grupozellikleri.php';
	}
} elseif ($page == "slider"){
	if ($_SESSION["siteayarlari"] == 1){
	include 'slider.php';
	}
} elseif ($page == "sliderekle"){
	if ($_SESSION["siteayarlari"] == 1){
	include 'sliderekle.php';
	}
} elseif ($page == "bkategoriler"){
	if ($_SESSION["blog"] == 1){
	include 'bkategoriler.php';	
	}
} elseif ($page == "bkategoriekle"){
	if ($_SESSION["blog"] == 1){
	include 'bkategoriekle.php';
	}
} elseif ($page == "bkategoriduzenle"){
	if ($_SESSION["blog"] == 1){
	include 'bkategoriduzenle.php';
	}
} elseif ($page == "byazilar"){
	if ($_SESSION["blog"] == 1){
	include 'byazilar.php';	
	}
} elseif ($page == "byaziekle"){
	if ($_SESSION["blog"] == 1){
	include 'byaziekle.php';
	}
} elseif ($page == "byaziduzenle"){
	if ($_SESSION["blog"] == 1){
	include 'byaziduzenle.php';	
	}
} elseif ($page == "kullanicilar"){
	if ($_SESSION["siteayarlari"] == 1){
	include 'kullanicilar.php';
	}	
} elseif ($page == "kullaniciekle"){
	if ($_SESSION["siteayarlari"] == 1){
	include 'kullaniciekle.php';
	}	
} elseif ($page == "kullaniciduzenle"){
	if ($_SESSION["siteayarlari"] == 1){
	include 'kullaniciduzenle.php';
	}	
} elseif ($page == "genelayarlar"){
	if ($_SESSION["siteayarlari"] == 1){
	include 'genelayarlar.php';
	}	
} elseif ($page == "vitrinilanlari"){
	if ($_SESSION["ilanyonetimi"] == 1){
	include 'vitrinilanlari.php';
	}
} elseif ($page == "acilacililanlari"){
	if ($_SESSION["ilanyonetimi"] == 1){
	include 'acilacililanlari.php';
	}	
} elseif ($page == "katvitrinilanlari"){
	if ($_SESSION["ilanyonetimi"] == 1){
	include 'katvitrinilanlari.php';
	}
} elseif ($page == "renklivekalin"){
	if ($_SESSION["ilanyonetimi"] == 1){
	include 'renklivekalin.php';
	}
} elseif ($page == "vitrinsil"){
	if ($_SESSION["ilanyonetimi"] == 1){
	include 'vitrinsil.php';
	}
} elseif ($page == "acilacilsil"){
	if ($_SESSION["ilanyonetimi"] == 1){
	include 'acilacilsil.php';
	}
} elseif ($page == "katvitrinsil"){
	if ($_SESSION["ilanyonetimi"] == 1){
	include 'katvitrinsil.php';
	}
} elseif ($page == "renklivekalinsil"){
	if ($_SESSION["ilanyonetimi"] == 1){
	include 'renklivekalinsil.php';
	}
} elseif ($page == "cikis"){
	unset($_SESSION["giris"]);	
	unset($_SESSION['siteayarlari']);
	unset($_SESSION['ilanyonetimi']);
	unset($_SESSION['kategoriyonetimi']);
	unset($_SESSION['magazayonetimi']);
	unset($_SESSION['getislemleri']);
	unset($_SESSION['odemeislemleri']);
	unset($_SESSION['uyeislemleri']);
	unset($_SESSION['blog']);
	unset($_SESSION['sayfa']);
	header("location: login.php");			
}
?>
  </div>
  <footer class="main-footer">
    <div class="pull-right hidden-xs"> <b>Version</b> 1.0.1 </div>
    Yönetim Paneli</footer>
  <div class="control-sidebar-bg"></div>
</div>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script> 
<script src="bootstrap/js/bootstrap.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script> 
<script src="plugins/sparkline/jquery.sparkline.min.js"></script> 
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script> 
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script> 
<script src="plugins/knob/jquery.knob.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script> 
<script src="plugins/daterangepicker/daterangepicker.js"></script> 
<script src="plugins/datepicker/bootstrap-datepicker.js"></script> 
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script> 
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script> 
<script src="plugins/fastclick/fastclick.js"></script> 
<script src="dist/js/app.min.js"></script> 
<script src="dist/js/demo.js"></script> 
<script src="plugins/datatables/jquery.dataTables.min.js"></script> 
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script> 
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script> 
<script>
  $(function () {
    $("#example1").DataTable({
		"language": {
                "url": "dist/dil.json"
	  }});
     });
<? if ($page == "duzenle"){ ?>	 
$(function () {
    CKEDITOR.replace('data2');
});
<? } ?>
<? if ($page == "sayfa"){ ?>	 
$(function () {
    CKEDITOR.replace('data2');
});
<? } ?>
<? if ($page == "byaziekle"){ ?>	 
$(function () {
    CKEDITOR.replace('data2');
});
<? } ?>
<? if ($page == "byaziduzenle"){ ?>	 
$(function () {
    CKEDITOR.replace('data2');
});
<? } ?>
</script>
</body>
</html>
<? ob_end_flush(); ?>
