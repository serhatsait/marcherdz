<?
$err = "";
if ($_POST['a1'] != ""){
$id = $_GET["id"];
$a1 = $_POST["a1"];
$a2 = $_POST["a2"];
$a3 = $_POST["a3"];
$a4 = $_POST["a4"];

$sql2 = "UPDATE odemesistemleri SET havale = '$a1', iyzico = '$a2', paytr = '$a3', payu = '$a4'";
$stmt = $db->prepare($sql2);
$stmt->execute();
$err = '<div class="alert alert-success"><strong>Uyarı!</strong> Ödeme Sistemleri Güncellendi</div>';
}
$id = $_GET["id"];
$sql = $db->query("SELECT * FROM odemesistemleri");
$n =  $sql->fetch(PDO::FETCH_ASSOC);
?>

<section class="content-header">
  <h1> Site Ayarları<small>Ödeme Sistemleri</small> </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Page d'accueil</a></li>
    <li><i class="active"></i> Ödeme Sistemleri</li>
  </ol>
</section>
<section class="content"> <? echo $err; ?>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Ödeme Sistemleri</h3>
    </div>
    <form role="form" action="" method="post">
      <div class="box-body">
      
        <img border="0" src="http://www.ilankobi.com/propanel/odemeimg/havale.png" width="120" height="48">
        <div class="form-group">
          <label for="exampleInputEmail1">Havale / EFT</label>
          <select name="a1" id="a1" class="form-control">
            <option value="0"<? if ($n["havale"] == 0){ echo ' selected'; } ?>>Kapalı</option>
			<option value="1"<? if ($n["havale"] == 1){ echo ' selected'; } ?>>Açık</option>
		  </select>
        </div>
       
	   <img border="0" src="http://www.ilankobi.com/propanel/odemeimg/iyzico.png" width="120" height="48">
	   <div class="form-group">
          <label for="exampleInputEmail1">Iyzico Api Bilgileri - Aktif - Pasif</label></br>
          <select name="a2" id="a2" class="form-control">
            <option value="0"<? if ($n["iyzico"] == 0){ echo ' selected'; } ?>>Kapalı</option>
			<option value="1"<? if ($n["iyzico"] == 1){ echo ' selected'; } ?>>Açık</option>
		  </select>
		  <label for="exampleInputEmail1">İyzico Apikey</label>
		  <input type="text" value="AIzaSyBjRM36tGgsjooprSapBlzjbSGr9nlOpjE" name="iyziapikey" class="form-control">
		  <label for="exampleInputEmail1">İyzico SecretKey</label>
		  <input type="text" value="AIzaSyBjRM36tGgsjooprSapBlzjbSGr9nlOpjE" name="iyzisecretkey" class="form-control">
        </div>
	   
	   <img border="0" src="http://www.ilankobi.com/propanel/odemeimg/paytr.png" width="120" height="48">
	   <div class="form-group">
          <label for="exampleInputEmail1">PayTR Api Bilgileri - Aktif - Pasif</label>
          <select name="a3" id="a3" class="form-control">
            <option value="0"<? if ($n["paytr"] == 0){ echo ' selected'; } ?>>Kapalı</option>
			<option value="1"<? if ($n["paytr"] == 1){ echo ' selected'; } ?>>Açık</option>
		  </select>
		  <label for="exampleInputEmail1">PayTR Apikey</label>
		  <input type="text" value="AIzaSyBjRM36tGgsjooprSapBlzjbSGr9nlOpjE" name="paytrapikey" class="form-control">
		  <label for="exampleInputEmail1">PayTR SecretKey</label>
		  <input type="text" value="AIzaSyBjRM36tGgsjooprSapBlzjbSGr9nlOpjE" name="paytrsecretkey" class="form-control">
        </div>
		
	   <img border="0" src="http://www.ilankobi.com/propanel/odemeimg/payu.png" width="120" height="48">
		<div class="form-group">
          <label for="exampleInputEmail1">Payu Api Bilgileri - Aktif - Pasif</label>
          <select name="a4" id="a4" class="form-control">
            <option value="0"<? if ($n["payu"] == 0){ echo ' selected'; } ?>>Kapalı</option>
			<option value="1"<? if ($n["payu"] == 1){ echo ' selected'; } ?>>Açık</option>
		  </select>
		  <label for="exampleInputEmail1">Payu Apikey</label>
		  <input type="text" value="AIzaSyBjRM36tGgsjooprSapBlzjbSGr9nlOpjE" name="payuapikey" class="form-control">
		  <label for="exampleInputEmail1">Payu SecretKey</label>
		  <input type="text" value="AIzaSyBjRM36tGgsjooprSapBlzjbSGr9nlOpjE" name="payusecretkey" class="form-control">
        </div>
		
		
		
		
      
      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Kaydet</button>
      </div>
    </form>
  </div>
</section>
