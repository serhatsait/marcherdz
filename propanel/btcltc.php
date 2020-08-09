<?
$err = "";
$id = $_GET["id"];
if ($_POST['a1'] != ""){
$a1 = $_POST['a1'];
$a2 = $_POST['a2'];
$sql = "UPDATE cuzdanlar SET bitcoin = '$a1', letcoin = '$a2'";
$stmt = $db->prepare($sql);
$stmt->execute();
$err = '<div class="alert alert-success"><strong>Uyarı!</strong> Bilgiler güncellendi</div>';	
}
$sql = $db->query("SELECT * FROM cuzdanlar");
$a = $sql->fetch(PDO::FETCH_ASSOC);
?>
<section class="content-header">
  <h1> Site Ayarları<small>Bitcoin / Letcoin Bilgileri</small> </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
    <li class="active">Düzenle</li>
  </ol>
</section>
<section class="content">
<? echo $err; ?>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Bitcoin / Letcoin Bilgileri</h3>
    </div>
    <form role="form" action="" method="post">
      <div class="box-body"> 
       <div class="form-group">
          <label for="exampleInputEmail1">Bitcoin</label>
          <input type="text" class="form-control" id="a1" name="a1" placeholder="Bitcoin" value="<? echo $a["bitcoin"]; ?>" required>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Letcoin</label>
          <input type="text" class="form-control" id="a2" name="a2" placeholder="Letcoin" value="<? echo $a["letcoin"]; ?>" required>
        </div>
      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Kaydet</button>
      </div>
    </form>
  </div>
</section>
