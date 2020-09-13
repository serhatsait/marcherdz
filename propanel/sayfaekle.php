<?
$err = "";
if ($_POST['a1'] != ""){
$a1 = $_POST["a1"];
$a2 = $_POST["a2"];
$slug  = slugify($a1);
$sql = $db->prepare('INSERT INTO sayfalar (Id, sayfaadi, icerik, yer, slug) VALUES (?,?,?,?,?)');
$sql->execute(array(null,$a1,null,$a2,$slug));
echo '<script> window.location.href = "index.php?page=sayfalar"; </script>';
}
?>
<section class="content-header">
  <h1>Sayfa Yönetimi<small>Sayfa Ekle</small> </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
    <li><a href="index.php?page=banka"><i class="fa fa-dashboard"></i> Sayfa Yönetimi</a></li>
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
          <label for="exampleInputEmail1">Sayfa Adı</label>
          <input type="text" class="form-control" id="a1" name="a1" placeholder="Sayfa Adı" value="" required>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Konum</label>
          <select name="a2" id="a2" class="form-control">
		  <option value="0">Sabit Link</option>
		  <option value="1">Footer Kurumsal Bilgiler</option>
		  <option value="2">Nos services</option>
		  <option value="3">Gizlilik & Kullanım</option>
		  </select>
        </div>
      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Kaydet</button>
      </div>
    </form>
  </div>
</section>
