<?
$err = "";
if ($_POST['a1'] != ""){
$a1 = $_POST["a1"];
$a2 = $_POST["a2"];
$a3 = $_POST["a3"];
$a4 = $_POST["a4"];
$sql = "UPDATE mail_ayarlari SET host = '$a1', kullaniciadi = '$a2', parola = '$a3', baslik = '$a4'";
$stmt = $db->prepare($sql);
$stmt->execute();
$err = '<div class="alert alert-success"><strong>Uyarı!</strong> Mail ayarları güncellendi</div>';
}
$sql = $db->query("SELECT * FROM mail_ayarlari");
$a = $sql->fetch(PDO::FETCH_ASSOC);
?>
<section class="content-header">
  <h1> Site Ayarları<small>Mail Ayarları</small> </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Page d'accueil</a></li>
    <li class="active">Mail Ayarları</li>
  </ol>
</section>

<section class="content">
<? echo $err; ?>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Mail Ayarları</h3>
    </div>
    
    <form role="form" action="" method="post">
      <div class="box-body">
      
      
        <div class="form-group">
          <label for="exampleInputEmail1">Başlık</label>
          <input type="text" class="form-control" id="a4" name="a4" placeholder="Başlık" value="<? echo $a["baslik"]; ?>" required>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Host</label>
          <input type="text" class="form-control" id="a1" name="a1" placeholder="Mail Host" value="<? echo $a["host"]; ?>" required>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Kullanıcı Adı</label>
          <input type="email" class="form-control" id="a2" name="a2" placeholder="Mail Kullanıcı Adı" value="<? echo $a["kullaniciadi"]; ?>" required>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Parola</label>
          <input type="password" class="form-control" id="a3" name="a3" placeholder="" value="" required>
        </div>
      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Kaydet</button>
      </div>
    </form>
  </div>
</section>
