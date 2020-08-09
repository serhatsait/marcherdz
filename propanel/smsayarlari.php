<?
$err = "";
if ($_POST['a1'] != ""){
$a1 = $_POST["a1"];
$a2 = $_POST["a2"];
$a3 = $_POST["a3"];
$a4 = $_POST["a4"];
$a5 = $_POST["a5"];
$sql = "UPDATE sms SET aktiflik = '$a1', firma = '$a2', kullaniciadi = '$a3', parola = '$a4', baslik = '$a5'";
$stmt = $db->prepare($sql);
$stmt->execute();
$err = '<div class="alert alert-success"><strong>Uyarı!</strong> Sms güncellendi</div>';
}
$sql = $db->query("SELECT * FROM sms");
$a = $sql->fetch(PDO::FETCH_ASSOC);
?>
<section class="content-header">
  <h1> Site Ayarları<small>Sms Ayarları</small> </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
    <li class="active">Sms Ayarları</li>
  </ol>
</section>

<section class="content">
<? echo $err; ?>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Sms Ayarları</h3>
    </div>
    
    <form role="form" action="" method="post">
      <div class="box-body">
      
      <div class="form-group">
          <label for="exampleInputEmail1">Aktiflik</label>
          <select name="a1" id="a1" class="form-control">
          <option value="0" <? if ($a["aktiflik"] == "0"){ echo ' selected'; } ?>>Pasif</option>
          <option value="1" <? if ($a["aktiflik"] == "1"){ echo ' selected'; } ?>>Aktif</option>
          </select>
        </div>
        
        <div class="form-group">
          <label for="exampleInputEmail1">Firma</label>
          <select name="a2" id="a2" class="form-control">
          <option value="0" <? if ($a["firma"] == "0"){ echo ' selected'; } ?>>Mutlucell</option>
		  <option value="1" <? if ($a["firma"] == "1"){ echo ' selected'; } ?>>İleti Merkezi</option>
		  <option value="2" <? if ($a["firma"] == "2"){ echo ' selected'; } ?>>CemreSMS / Dakiksms</option>
		  <option value="3" <? if ($a["firma"] == "3"){ echo ' selected'; } ?>>NetGSM</option>
		  <option value="4" <? if ($a["firma"] == "4"){ echo ' selected'; } ?>>Sms Vitrini</option>
          </select>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Kullanıcı Adı</label>
          <input type="text" class="form-control" id="a3" name="a3" placeholder="Kullanıcı Adı" value="<? echo $a["kullaniciadi"]; ?>" required>
        </div>
       <div class="form-group">
          <label for="exampleInputEmail1">Parola</label>
          <input type="password" class="form-control" id="a4" name="a4" placeholder="Parola" value="" required>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Başlık</label>
          <input type="text" class="form-control" id="a5" name="a5" placeholder="Başlık" value="<? echo $a["baslik"]; ?>" required>
        </div>
      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Kaydet</button>
      </div>
    </form>
  </div>
</section>
