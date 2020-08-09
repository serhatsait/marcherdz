<?
$err = "";
if ($_POST['a1'] != ""){
$a1 = $_POST["a1"];
$a2 = $_POST["a2"];
$a3 = $_POST["a3"];
$kota1 = $_POST["kota1"];
$kota2 = $_POST["kota2"];
$kota3 = $_POST["kota3"];
$sql = "UPDATE magaza_ucretleri SET a1 = '$a1', a2 = '$a2', a3 = '$a3', kota1 = '$kota1', kota2 = '$kota2', kota3 = '$kota3'";
$stmt = $db->prepare($sql);
$stmt->execute();
$err = '<div class="alert alert-success"><strong>Uyarı!</strong> Mağaza ücretleri ve Kotaları güncellendi</div>';
}
$sql = $db->query("SELECT * FROM magaza_ucretleri");
$a = $sql->fetch(PDO::FETCH_ASSOC);
?>

<section class="content-header">
  <h1> Site Ayarları<small>Mağaza Ücretleri</small> </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
    <li class="active">Mağaza Ücretleri</li>
  </ol>
</section>
<section class="content"> <? echo $err; ?>
  <form role="form" action="" method="post">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Mağaza Ücretleri ve Kotaları</h3>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-4">
            <label for="exampleInputEmail1">Normal Mağaza 3 Aylık Ücret</label>
            <div class="input-group">
              <input type="number" class="form-control" id="a1" name="a1" placeholder="0" value="<? echo $a["a1"]; ?>" required>
              <span class="input-group-addon">.00 TL</span> </div>
          </div>
		  
          <div class="col-md-4">
            <label for="exampleInputEmail1">Süper Mağaza 6 Aylık Ücret</label>
            <div class="input-group">
              <input type="number" class="form-control" id="a2" name="a2" placeholder="0" value="<? echo $a["a2"]; ?>" required>
              <span class="input-group-addon">.00 TL</span> </div>
          </div>
          <div class="col-md-4">
            <label for="exampleInputEmail1">Gold Mağaza 1 Yıllık Ücret</label>
            <div class="input-group">
              <input type="number" class="form-control" id="a3" name="a3" placeholder="0" value="<? echo $a["a3"]; ?>" required>
              <span class="input-group-addon">.00 TL</span> </div>
          </div>
		  <div class="col-md-4">
            <label for="exampleInputEmail1">Normal Mağaza 3 Aylık İlan Kotası</label>
            <div class="input-group">
              <input type="number" class="form-control" id="kota1" name="kota1" placeholder="0" value="<? echo $a["kota1"]; ?>" required>
              <span class="input-group-addon">+ Adet</span></div>
          </div>
		  <div class="col-md-4">
            <label for="exampleInputEmail1">Süper Mağaza 6 Aylık İlan Kotası</label>
            <div class="input-group">
              <input type="number" class="form-control" id="kota2" name="kota2" placeholder="0" value="<? echo $a["kota2"]; ?>" required>
               <span class="input-group-addon">+ Adet</span></div>
          </div>
		  <div class="col-md-4">
            <label for="exampleInputEmail1">Gold Mağaza 1 Yıllık İlan Kotası</label>
            <div class="input-group">
              <input type="number" class="form-control" id="kota3" name="kota3" placeholder="0" value="<? echo $a["kota3"]; ?>" required>
              <span class="input-group-addon">+ Adet</span></div>
          </div>
        </div>
      </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Kaydet</button>
    </div>
    </div>
  
  </form>
</section>
