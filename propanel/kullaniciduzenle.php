<?
$err = "";
$id = $_GET["id"];
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

$sql = "UPDATE yetkililer SET kadi= '$a1', pass= '$a2', siteayarlari= '$a3', ilanyonetimi= '$a4', kategoriyonetimi= '$a5', magazayonetimi= '$a6', getislemleri= '$a7', odemeislemleri= '$a8', uyeislemleri= '$a9', blog= '$a10', sayfa= '$a11' WHERE Id = '$id'";
$stmt = $db->prepare($sql);
$stmt->execute();
echo '<script> window.location.href = "index.php?page=kullanicilar"; </script>';
}
$sql = $db->query("SELECT * FROM yetkililer WHERE Id = '$id'");
$a = $sql->fetch(PDO::FETCH_ASSOC);
?>
<section class="content-header">
  <h1> Site Ayarları<small>Kullanıcı Yönetimi</small> </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
    <li><a href="index.php?page=kullanicilar"><i class="fa fa-dashboard"></i> Kullanıcı Yönetimi</a></li>
    <li class="active">Düzenle</li>
  </ol>
</section>
<section class="content">
<? echo $err; ?>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Düzenle</h3>
    </div>
    <form role="form" action="" method="post">
      <div class="box-body"> 
       <div class="form-group">
          <label for="exampleInputEmail1">Kullanıcı Adı</label>
          <input type="text" class="form-control" id="a1" name="a1" placeholder="Kullanıcı Adı" value="<? echo $a["kadi"]; ?>" required>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Parola</label>
          <input type="text" class="form-control" id="a2" name="a2" placeholder="Parola" value="<? echo $a["pass"]; ?>" required>
        </div>
      <div class="row">
		
		<div class="col-xs-3">
		<div class="form-group">
          <label for="exampleInputEmail1">Site Ayarları</label>
          <select name="a3" id="a3" class="form-control" <? if ($a["Id"] == 1){ echo ' readonly="readonly"'; } ?>>
		  <option value="0"<? if ($a["siteayarlari"] == 0){ echo ' selected'; } ?>>Hayır</option>
		  <option value="1"<? if ($a["siteayarlari"] == 1){ echo ' selected'; } ?>>Evet</option>
		  </select>
        </div>
		</div>
		
		<div class="col-xs-3">
		  <div class="form-group">
          <label for="exampleInputEmail1">İlan Yönetimi</label>
          <select name="a4" id="a4" class="form-control"<? if ($a["Id"] == 1){ echo ' readonly="readonly"'; } ?>>
		  <option value="0"<? if ($a["ilanyonetimi"] == 0){ echo ' selected'; } ?>>Hayır</option>
		  <option value="1"<? if ($a["ilanyonetimi"] == 1){ echo ' selected'; } ?>>Evet</option>
		  </select>
        </div>
		</div>
		<div class="col-xs-3">
		<div class="form-group">
          <label for="exampleInputEmail1">Kategori Yönetimi</label>
          <select name="a5" id="a5" class="form-control"<? if ($a["Id"] == 1){ echo ' readonly="readonly"'; } ?>>
		  <option value="0"<? if ($a["kategoriyonetimi"] == 0){ echo ' selected'; } ?>>Hayır</option>
		  <option value="1"<? if ($a["kategoriyonetimi"] == 1){ echo ' selected'; } ?>>Evet</option>
		  </select>
        </div>
		</div>
		
		<div class="col-xs-3">
		<div class="form-group">
          <label for="exampleInputEmail1">Mağaza Yönetimi</label>
          <select name="a6" id="a6" class="form-control"<? if ($a["Id"] == 1){ echo ' readonly="readonly"'; } ?>>
		  <option value="0"<? if ($a["magazayonetimi"] == 0){ echo ' selected'; } ?>>Hayır</option>
		  <option value="1"<? if ($a["magazayonetimi"] == 1){ echo ' selected'; } ?>>Evet</option>
		  </select>
        </div>
		</div>
		<div class="col-xs-3">
		<div class="form-group">
          <label for="exampleInputEmail1">GET İşlemleri</label>
          <select name="a7" id="a7" class="form-control"<? if ($a["Id"] == 1){ echo ' readonly="readonly"'; } ?>>
		  <option value="0"<? if ($a["getislemleri"] == 0){ echo ' selected'; } ?>>Hayır</option>
		  <option value="1"<? if ($a["getislemleri"] == 1){ echo ' selected'; } ?>>Evet</option>
		  </select>
        </div>
		</div>
		<div class="col-xs-3">
		<div class="form-group">
          <label for="exampleInputEmail1">Ödeme İşlemleri</label>
          <select name="a8" id="a8" class="form-control"<? if ($a["Id"] == 1){ echo ' readonly="readonly"'; } ?>>
		  <option value="0"<? if ($a["odemeislemleri"] == 0){ echo ' selected'; } ?>>Hayır</option>
		  <option value="1"<? if ($a["odemeislemleri"] == 1){ echo ' selected'; } ?>>Evet</option>
		  </select>
        </div>
		</div>
		<div class="col-xs-3">
		<div class="form-group">
          <label for="exampleInputEmail1">Üye İşlemleri</label>
          <select name="a9" id="a9" class="form-control"<? if ($a["Id"] == 1){ echo ' readonly="readonly"'; } ?>>
		  <option value="0"<? if ($a["uyeislemleri"] == 0){ echo ' selected'; } ?>>Hayır</option>
		  <option value="1"<? if ($a["uyeislemleri"] == 1){ echo ' selected'; } ?>>Evet</option>
		  </select>
        </div>
		</div>
		<div class="col-xs-3">
		<div class="form-group">
          <label for="exampleInputEmail1">Blog Yönetimi</label>
          <select name="a10" id="a10" class="form-control"<? if ($a["Id"] == 1){ echo ' readonly="readonly"'; } ?>>
		  <option value="0"<? if ($a["blog"] == 0){ echo ' selected'; } ?>>Hayır</option>
		  <option value="1"<? if ($a["blog"] == 1){ echo ' selected'; } ?>>Evet</option>
		  </select>
        </div>
		</div>
		<div class="col-xs-3">
		<div class="form-group">
          <label for="exampleInputEmail1">Sayfa Yönetimi</label>
          <select name="a11" id="a11" class="form-control"<? if ($a["Id"] == 1){ echo ' readonly="readonly"'; } ?>>
		  <option value="0"<? if ($a["sayfa"] == 0){ echo ' selected'; } ?>>Hayır</option>
		  <option value="1"<? if ($a["sayfa"] == 1){ echo ' selected'; } ?>>Evet</option>
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
