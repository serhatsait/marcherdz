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
$sql = $db->prepare('INSERT INTO yetkililer (Id, kadi, pass, siteayarlari, ilanyonetimi, kategoriyonetimi, magazayonetimi, getislemleri, odemeislemleri, uyeislemleri, blog, sayfa) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)');
$sql->execute(array(null,$a1,$a2,$a3,$a4,$a5,$a6,$a7,$a8,$a9,$a10,$a11));
echo '<script> window.location.href = "index.php?page=kullanicilar"; </script>';
}
?>
<section class="content-header">
  <h1> Site Ayarları<small>Kullanıcı Yönetimi</small> </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Page d'accueil</a></li>
    <li><a href="index.php?page=banka"><i class="fa fa-dashboard"></i> Kullanıcı Yönetimi</a></li>
    <li class="active">Yeni Kayıt Ekle</li>
  </ol>
</section>
<section class="content">
<? echo $err; ?>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Yeni Kayıt Ekle</h3>
    </div>
    <form role="form" action="" method="post">
      <div class="box-body"> 
       <div class="form-group">
          <label for="exampleInputEmail1">Kullanıcı Adı</label>
          <input type="text" class="form-control" id="a1" name="a1" placeholder="Kullanıcı Adı" value="" required>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Parola</label>
          <input type="text" class="form-control" id="a2" name="a2" placeholder="Parola" value="" required>
        </div>
      <div class="row">
		
		<div class="col-xs-3">
		<div class="form-group">
          <label for="exampleInputEmail1">Site Ayarları</label>
          <select name="a3" id="a3" class="form-control">
		  <option value="0">Hayır</option>
		  <option value="1">Evet</option>
		  </select>
        </div>
		</div>
		
		<div class="col-xs-3">
		  <div class="form-group">
          <label for="exampleInputEmail1">İlan Yönetimi</label>
          <select name="a4" id="a4" class="form-control">
		  <option value="0">Hayır</option>
		  <option value="1">Evet</option>
		  </select>
        </div>
		</div>
		<div class="col-xs-3">
		<div class="form-group">
          <label for="exampleInputEmail1">Kategori Yönetimi</label>
          <select name="a5" id="a5" class="form-control">
		  <option value="0">Hayır</option>
		  <option value="1">Evet</option>
		  </select>
        </div>
		</div>
		
		<div class="col-xs-3">
		<div class="form-group">
          <label for="exampleInputEmail1">Mağaza Yönetimi</label>
          <select name="a6" id="a6" class="form-control">
		  <option value="0">Hayır</option>
		  <option value="1">Evet</option>
		  </select>
        </div>
		</div>
		<div class="col-xs-3">
		<div class="form-group">
          <label for="exampleInputEmail1">GET İşlemleri</label>
          <select name="a7" id="a7" class="form-control">
		  <option value="0">Hayır</option>
		  <option value="1">Evet</option>
		  </select>
        </div>
		</div>
		<div class="col-xs-3">
		<div class="form-group">
          <label for="exampleInputEmail1">Ödeme İşlemleri</label>
          <select name="a8" id="a8" class="form-control">
		  <option value="0">Hayır</option>
		  <option value="1">Evet</option>
		  </select>
        </div>
		</div>
		<div class="col-xs-3">
		<div class="form-group">
          <label for="exampleInputEmail1">Üye İşlemleri</label>
          <select name="a9" id="a9" class="form-control">
		  <option value="0">Hayır</option>
		  <option value="1">Evet</option>
		  </select>
        </div>
		</div>
		<div class="col-xs-3">
		<div class="form-group">
          <label for="exampleInputEmail1">Blog Yönetimi</label>
          <select name="a10" id="a10" class="form-control">
		  <option value="0">Hayır</option>
		  <option value="1">Evet</option>
		  </select>
        </div>
		</div>
		<div class="col-xs-3">
		<div class="form-group">
          <label for="exampleInputEmail1">Sayfa Yönetimi</label>
          <select name="a11" id="a11" class="form-control">
		  <option value="0">Hayır</option>
		  <option value="1">Evet</option>
		  </select>
        </div>
		</div>
		</div>
       
      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Kaydet</button>
      </div>
    </form>
  </div>
</section>
