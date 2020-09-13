<?
$err = "";
if ($_POST['a1'] != ""){
$a1 = $_POST["a1"];
$a2 = $_POST["a2"];
$a3 = $_POST["a3"];
$a4 = $_POST["a4"];
$sql = "UPDATE get_ayarlari SET a1 = '$a1', a2 = '$a2', a3 = '$a3'";
$stmt = $db->prepare($sql);
$stmt->execute();
$err = '<div class="alert alert-success"><strong>Uyarı!</strong> GET ayarları güncellendi</div>';
}
$sql = $db->query("SELECT * FROM get_ayarlari");
$a = $sql->fetch(PDO::FETCH_ASSOC);
?>

<section class="content-header">
  <h1> Site Ayarları<small>GET Ayarları</small> </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Page d'accueil</a></li>
    <li class="active">GET Ayarları</li>
  </ol>
</section>
<section class="content">
<? echo $err; ?>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">GET Ayarları</h3>
    </div>
    <form role="form" action="" method="post">
      <div class="box-body"> 
        <div class="form-group">
          <label for="exampleInputEmail1">GET Satışı</label>
          <select name="a1" class="form-control">
            <option value="0" <? if ($a["a1"] == 0){ echo ' selected'; } ?>>Pasif</option>
            <option value="1" <? if ($a["a1"] == 1){ echo ' selected'; } ?>>Aktif</option>
          </select>
        </div>
        <label for="exampleInputEmail1">Komisyon Oranı</label>
        <div class="input-group">
          <input type="number" class="form-control" id="a2" name="a2" placeholder="0" value="<? echo $a["a2"]; ?>" required>
          <span class="input-group-addon">%</span> </div><br>
		  <label for="exampleInputEmail1">İhale - Açık Artırma İlan Ücreti</label>
        <div class="input-group">
          <input type="number" class="form-control" id="a3" name="a3" placeholder="0" value="<? echo $a["a3"]; ?>" required>
          <span class="input-group-addon"></span> 
		  </div>
      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Kaydet</button>
      </div>
    </form>
  </div>
</section>
