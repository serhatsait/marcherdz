<?
$err = "";
$id = $_GET["id"];
if ($_POST['a1'] != ""){
$a1 = $_POST['a1'];
$a2 = $_POST['a2'];
$sql = "UPDATE sinir SET sinir = '$a1'";
$stmt = $db->prepare($sql);
$stmt->execute();
$err = '<div class="alert alert-success"><strong>Uyarı!</strong> Sınır güncellendi</div>';	
}
$sql = $db->query("SELECT * FROM sinir ");
$a = $sql->fetch(PDO::FETCH_ASSOC);
?>
<section class="content-header">
  <h1> Site Ayarları<small>Kullanıcı İlan Sınırı</small> </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
    <li class="active">Kullanıcı İlan Sınırı</li>
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
          <label for="exampleInputEmail1">Sınır</label>
          <input type="number" class="form-control" id="a1" name="a1" placeholder="Sınır" value="<? echo $a["sinir"]; ?>" required>
        </div>

      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Kaydet</button>
      </div>
    </form>
  </div>
</section>
