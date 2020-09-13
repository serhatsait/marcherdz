<?
$err = "";
if ($_POST['a1'] != ""){
$a1 = $_POST["a1"];
$a2 = $_POST["a2"];
$a3 = $_POST["a3"];
$a4 = $_POST["a4"];
$sql = $db->prepare('INSERT INTO bank (Id, bankaadi, sube, hesap, iban) VALUES (?,?,?,?,?)');
$sql->execute(array(null,$a1,$a2,$a3,$a4));
echo '<script> window.location.href = "index.php?page=banka"; </script>';
}
?>
<section class="content-header">
  <h1> Site Ayarları<small>Banka Bilgileri</small> </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Page d'accueil</a></li>
    <li><a href="index.php?page=banka"><i class="fa fa-dashboard"></i> Banka Bilgileri</a></li>
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
          <label for="exampleInputEmail1">Banka Adı</label>
          <input type="text" class="form-control" id="a1" name="a1" placeholder="Banka Adı" value="" required>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Şube Kodu</label>
          <input type="number" class="form-control" id="a2" name="a2" placeholder="Şube Kodu" value="" required>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Hesap No</label>
          <input type="number" class="form-control" id="a3" name="a3" placeholder="Hesap No" value="" required>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">IBAN</label>
          <input type="text" class="form-control" id="a4" name="a4" placeholder="IBAN" value="" required>
        </div>
      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Kaydet</button>
      </div>
    </form>
  </div>
</section>
