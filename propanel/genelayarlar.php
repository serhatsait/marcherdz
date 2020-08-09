<?
$err = "";
if ($_POST['a1'] != ""){
$a1 = $_POST["a1"];
$a2 = $_POST["a2"];
$a3 = $_POST["a3"];
$a4 = $_POST["a4"];
$a5 = $_POST["a5"];
$a6 = $_POST["a6"];
$a7 = $_POST["a7"];
$a8 = $_POST["a8"];
$a9 = $_POST["a9"];
$a10 = $_POST["a10"];
$a11 = $_POST["a11"];
$a12 = $_POST["a12"];
$sql = "UPDATE genel SET base_url = '$a1', SiteName = '$a2', admin_mail = '$a3', MaksimumResimUpload = '$a4', appId = '$a5', appSecret = '$a6', mobil = '$a7', mail = '$a8', sms = '$a9', sssl = '$a10', keywords = '$a11', description = '$a12'";
$stmt = $db->prepare($sql);
$stmt->execute();
$sql = "UPDATE sms SET aktiflik = '$a9'";
$stmt = $db->prepare($sql);
$stmt->execute();

$err = '<div class="alert alert-success"><strong>Uyarı!</strong> Genel ayarlar güncellendi</div>';
}
$sql = $db->query("SELECT * FROM genel");
$a = $sql->fetch(PDO::FETCH_ASSOC);
?>
<section class="content-header">
  <h1> Anlık Site İstatistikleri<small></small> </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
    <li class="active">Genel Ayarlar</li>
  </ol>
</section>
<section class="content">
<div class="row">
            
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-bullhorn"></i></span>
          <? $sql = $db->query("SELECT * FROM ilanlar WHERE confirm = '1' ");
		     $say  = $sql->rowCount();
		  ?>
            <div class="info-box-content">
              <span class="info-box-text">Aktif İlan sayısı</span>
              <span class="info-box-number"><? echo $say; ?></span>
                <a href="index.php?page=onaylanmis" class="small-box-footer">
              Detaylı İncele <i class="fa fa-arrow-circle-right"></i>
            </a>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
            
            
                    <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-bullhorn"></i></span>
          <? $sql = $db->query("SELECT * FROM ilanlar WHERE confirm = '0' ");
		     $say  = $sql->rowCount();
		  ?>
            <div class="info-box-content">
              <span class="info-box-text">Onay bekleyen ilan Sayısı</span>
              <span class="info-box-number"><? echo $say; ?></span>
                <a href="index.php?page=onaybekleyen" class="small-box-footer">
              Detaylı İncele <i class="fa fa-arrow-circle-right"></i>
            </a>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>
          <? $sql = $db->query("SELECT * FROM users WHERE aktivasyon = '1' ");
		     $say  = $sql->rowCount();
		  ?>
            <div class="info-box-content">
              <span class="info-box-text">Toplam Üye Sayısı</span>
              <span class="info-box-number"><? echo $say; ?></span>
			  <a href="index.php?page=aktif" class="small-box-footer">
              Detaylı İncele <i class="fa fa-arrow-circle-right"></i>
            </a>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
<!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-try"></i></span>
          <?
		  $sql = $db->query("SELECT * FROM bildirimler");
		  $say  = $sql->rowCount();
		  ?>
            <div class="info-box-content">
              <span class="info-box-text">Ödeme Bildirimleri</span>
              <span class="info-box-number"><? echo $say; ?></span>
            <a href="index.php?page=odemebildirimi" class="small-box-footer">
              Detaylı İncele <i class="fa fa-arrow-circle-right"></i>
            </a>
			</div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-shopping-bag"></i></span>
          <? $sql = $db->query("SELECT * FROM magazalar WHERE onay = '0' ");
		     $say  = $sql->rowCount();
		  ?>
            <div class="info-box-content">
              <span class="info-box-text">Onay Bekleyen Mağazalar</span>
              <span class="info-box-number"><? echo $say; ?></span>
            <a href="index.php?page=monaybekleyen" class="small-box-footer">
              Detaylı İncele <i class="fa fa-arrow-circle-right"></i>
            </a>
			</div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
		<!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>
          <? $sql = $db->query("SELECT * FROM users WHERE aktivasyon = '0' ");
		     $say  = $sql->rowCount();
		  ?>
            <div class="info-box-content">
              <span class="info-box-text">Onay Bekleyen Üyeler</span>
              <span class="info-box-number"><? echo $say; ?></span>
            <a href="index.php?page=aktivasyonbekleyen" class="small-box-footer">
              Detaylı İncele <i class="fa fa-arrow-circle-right"></i>
            </a>
			</div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
		
		<!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-credit-card"></i></span>
          <?
		  $sql = $db->query("SELECT * FROM siparisler WHERE durum < '4' ");
		  $say  = $sql->rowCount();
		  ?>
            <div class="info-box-content">
              <span class="info-box-text">Siparişler</span>
              <span class="info-box-number"><? echo $say; ?></span>
            <a href="index.php?page=gkargo" class="small-box-footer">
              Detaylı İncele <i class="fa fa-arrow-circle-right"></i>
            </a>
			</div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
		<!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-exclamation-triangle"></i></span>
          <? $sql = $db->query("SELECT * FROM sikayet");
		     $say  = $sql->rowCount();
		  ?>
            <div class="info-box-content">
              <span class="info-box-text">İlan Şikayetleri</span>
              <span class="info-box-number"><? echo $say; ?></span>
            <a href="index.php?page=sikayetler" class="small-box-footer">
              Detaylı İncele <i class="fa fa-arrow-circle-right"></i>
            </a>
			</div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
	  
<div class="row">	
<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue-gradient">
            <div class="inner">
			<?
			$bugun=date("d"); // bugünün tarihi   
			$ay=date("m"); // bu ay  
			$yil=date("Y"); // bu yıl   
			$timeoutseconds = 600; 
			$timestamp = time(); 
			$onlineSuresi = $timestamp-$timeoutseconds;  
			$online=$db->query("SELECT * FROM hit WHERE simdi>='$onlineSuresi'")->rowCount(); // onlnie kişilerimiz
			?>
			
              <h3><? echo $online; ?></h3>
              <p>Çevrimiçi Kullanıcı </p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
          </div>
        </div>  
<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow-gradient">
            <div class="inner">
			<?
			$bugun=date("d"); // bugünün tarihi   
			$ay=date("m"); // bu ay  
			$yil=date("Y"); // bu yıl   
			$bugun_tekil=$db->query("SELECT * FROM hit WHERE gun='$bugun' AND ay='$ay' AND yil='$yil'")->rowCount();
			?>
			
              <h3><? echo $bugun_tekil; ?></h3>
              <p>Bugün Toplam Tekil</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
          </div>
        </div>  
<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
			<?
			$bugun=date("d"); // bugünün tarihi   
			$ay=date("m"); // bu ay  
			$yil=date("Y"); // bu yıl   
			$bugunx=$db->query("SELECT SUM(sayac) FROM hit WHERE gun='$bugun' AND ay='$ay' AND yil='$yil' ORDER BY id desc")->fetch();  
			$bugun_cogul=$bugunx['SUM(sayac)'];
			?>
			
              <h3><? echo $bugun_cogul; ?></h3>
              <p>Bugün Toplam Çoğul</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>    
          </div>
        </div>  
         <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
			<? 
			$toplamx=$db->query("SELECT SUM(sayac) FROM hit ORDER BY id desc")->fetch();  
			$toplam_cogul=$toplamx['SUM(sayac)'];
			?>
			
              <h3><? echo $toplam_cogul; ?></h3>
              <p>Genel Toplam</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
          </div>
        </div>
         <!-- emd row -->  
		 </div>   
	  
	  
	  
	  
	  
	  
 
<? echo $err; ?>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Genel Ayarlar</h3>
    </div>
    <form role="form" action="" method="post" enctype="multipart/form-data">
      <div class="box-body"> 
       <div class="form-group">
          <label for="exampleInputEmail1">Base Url</label>
          <input type="text" class="form-control" id="a1" name="a1" placeholder="Base Url" value="<? echo $a["base_url"]; ?>" required>
		  Örnek : http://siteadi.com/
        </div>
		<div class="form-group">
          <label for="exampleInputEmail1">Mobil</label>
          <select name="a7" id="a7" class="form-control">
		  <option value="0" <? if ($a["mobil"] == "0"){ echo ' selected'; } ?>>Mobil Sistem</option>
		  <option value="1" <? if ($a["mobil"] == "1"){ echo ' selected'; } ?>>Responsive</option>
		  </select>
        </div>
		
		<div class="form-group">
          <label for="exampleInputEmail1">Mail Aktivasyon</label>
          <select name="a8" id="a8" class="form-control">
		  <option value="0" <? if ($a["mail"] == "0"){ echo ' selected'; } ?>>Kapalı</option>
		  <option value="1" <? if ($a["mail"] == "1"){ echo ' selected'; } ?>>Açık</option>
		  </select>
        </div>
		
		<div class="form-group">
          <label for="exampleInputEmail1">SMS Aktivasyon</label>
          <select name="a9" id="a9" class="form-control">
		  <option value="0" <? if ($a["sms"] == "0"){ echo ' selected'; } ?>>Kapalı</option>
		  <option value="1" <? if ($a["sms"] == "1"){ echo ' selected'; } ?>>Açık</option>
		  </select>
        </div>
		
		<div class="form-group">
          <label for="exampleInputEmail1">SSL</label>
          <select name="a10" id="a10" class="form-control">
		  <option value="0" <? if ($a["sssl"] == "0"){ echo ' selected'; } ?>>Kapalı</option>
		  <option value="1" <? if ($a["sssl"] == "1"){ echo ' selected'; } ?>>Açık</option>
		  </select>
        </div>
		
		
        <div class="form-group">
          <label for="exampleInputEmail1">Site Adı</label>
          <input type="text" class="form-control" id="a2" name="a2" placeholder="Site Adı" value="<? echo $a["SiteName"]; ?>" required>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Admin Mail</label>
          <input type="email" class="form-control" id="a3" name="a3" placeholder="Admin Mail" value="<? echo $a["admin_mail"]; ?>" required>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Maksimum Resim Yükleme</label>
          <input type="number" class="form-control" id="a4" name="a4" placeholder="Maksimum Resim Yükleme" value="<? echo $a["MaksimumResimUpload"]; ?>" required>
        </div>
		<div class="form-group">
          <label for="exampleInputEmail1">Facebook AppId</label>
          <input type="text" class="form-control" id="a5" name="a5" placeholder="Facebook AppId" value="<? echo $a["appId"]; ?>" required>
        </div>
		<div class="form-group">
          <label for="exampleInputEmail1">Facebook AppSecret</label>
          <input type="text" class="form-control" id="a6" name="a6" placeholder="Facebook AppSecret" value="<? echo $a["appSecret"]; ?>" required>
        </div>
		
		<div class="form-group">
          <label for="exampleInputEmail1">Keywords ( Anahtar Kelimeler )</label>
          <textarea name="a11" id="a11" class="form-control"><? echo $a["keywords"]; ?></textarea>
        </div>
		<div class="form-group">
          <label for="exampleInputEmail1">Description ( Site Tanımı )</label>
          <textarea name="a12" id="a12" class="form-control"><? echo $a["description"]; ?></textarea>
        </div>

      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Kaydet</button>
      </div>
    </form>
  </div>
</section>
