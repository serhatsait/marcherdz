<?
$err = "";
if ($_POST['a1'] != ""){
$a1 = $_POST["a1"];
$a2 = $_POST["a2"];
$sql = "UPDATE panel SET kadi = '$a1', parola = '$a2'";
$stmt = $db->prepare($sql);
$stmt->execute();
$err = '<div class="alert alert-success"><strong>Uyarı!</strong> Panel bilgileri güncellendi</div>';
}
?>
<section class="content-header">
  <h1> Site Ayarları<small>Panel Bilgileri</small> </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Page d'accueil</a></li>
    <li class="active">Panel Bilgileri</li>
  </ol>
</section>
<section class="content">
<? echo $err; ?>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Panel Bilgileri</h3>
    </div>
    <form role="form" action="" method="post">
      <div class="box-body"> 
       <div class="form-group">
          <label for="exampleInputEmail1">Kullanıcı Adı</label>
          <input type="text" class="form-control" id="a1" name="a1" placeholder="" value="" required>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Parola</label>
          <input type="password" class="form-control" id="a2" name="a2" placeholder="" value="" required>
        </div>
      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Kaydet</button>
      </div>
    </form>
  </div>
</section>
