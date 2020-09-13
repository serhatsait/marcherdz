<?
$id = $_GET["id"];
$sql = $db->query("SELECT * FROM ilanlar WHERE Id = '$id'");
$a = $sql->fetch(PDO::FETCH_ASSOC);
if ($_POST["id"] != ""){
$id = $_POST["id"];
$anasayfa = $_POST["anasayfa"];	
$kategori = $_POST["kategori"];	
$acil = $_POST["acil"];	
$kalin = $_POST["kalin"];
$sql = $db->query("SELECT * FROM ilanlar WHERE Id = '$id'");
$a = $sql->fetch(PDO::FETCH_ASSOC);

if ($anasayfa != ""){
	$sql = $db->prepare("DELETE FROM doping WHERE ilanId = '{$id}' and name = 'anasayfa'");
	$sql->execute();	

	$anasayfa = explode("/",$anasayfa);
	$anasayfa = "$anasayfa[2]-$anasayfa[1]-$anasayfa[0]";
	
	$sql = $db->prepare('INSERT INTO doping (Id, ilanId,name, val, selec, category1, category2, category3, category4, category5, category6, category7, category8,category9,category10,odeme,onay,tutar) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
	
    $sql->execute(array(null,$id,"anasayfa",$anasayfa,0,$a["category1"],$a["category2"],$a["category3"],$a["category4"],$a["category5"],$a["category6"],$a["category7"],$a["category8"],$a["category9"],$a["category10"],1,1,0));
	
}

if ($kategori != ""){
	$sql = $db->prepare("DELETE FROM doping WHERE ilanId = '{$id}' and name = 'kategori'");
	$sql->execute();	
	$kategori = explode("/",$kategori);
	$kategori = "$kategori[2]-$kategori[1]-$kategori[0]";
	$sql = $db->prepare('INSERT INTO doping (Id, ilanId,name, val, selec, category1, category2, category3, category4, category5, category6, category7, category8,category9,category10,odeme,onay,tutar) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
    $sql->execute(array(null,$id,"kategori",$kategori,0,$a["category1"],$a["category2"],$a["category3"],$a["category4"],$a["category5"],$a["category6"],$a["category7"],$a["category8"],$a["category9"],$a["category10"],1,1,0));
}

if ($acil != ""){
	$sql = $db->prepare("DELETE FROM doping WHERE ilanId = '{$id}' and name = 'acil'");
	$sql->execute();	
	$acil = explode("/",$acil);
	$acil = "$acil[2]-$acil[1]-$acil[0]";
	$sql = $db->prepare('INSERT INTO doping (Id, ilanId,name, val, selec, category1, category2, category3, category4, category5, category6, category7, category8,category9,category10,odeme,onay,tutar) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
    $sql->execute(array(null,$id,"acil",$acil,0,$a["category1"],$a["category2"],$a["category3"],$a["category4"],$a["category5"],$a["category6"],$a["category7"],$a["category8"],$a["category9"],$a["category10"],1,1,0));
}

if ($kalin != ""){
	$sql = $db->prepare("DELETE FROM doping WHERE ilanId = '{$id}' and name = 'kalin'");
	$sql->execute();	
	$kalin = explode("/",$kalin);
	$kalin = "$kalin[2]-$kalin[1]-$kalin[0]";
	$sql = $db->prepare('INSERT INTO doping (Id, ilanId,name, val, selec, category1, category2, category3, category4, category5, category6, category7, category8,category9,category10,odeme,onay,tutar) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
    $sql->execute(array(null,$id,"kalin",$kalin,0,$a["category1"],$a["category2"],$a["category3"],$a["category4"],$a["category5"],$a["category6"],$a["category7"],$a["category8"],$a["category9"],$a["category10"],1,1,0));
}
$return = $_POST['return'];
echo '<script> window.location.href = "index.php?page='.$return.''; if ($return == "uye"){ echo '&id='.$_GET["u"].''; } echo '"; </script>';
}
?>

<section class="content-header">
  <h1> İlan Yönetimi<small>Vitrin</small> </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Page d'accueil</a></li>
    <li><a href="index.php?page=banka"><i class="fa fa-dashboard"></i> İlan Yönetimi</a></li>
    <li class="active">Vitrin</li>
  </ol>
</section>
<section class="content"> <? echo $err; ?>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Vitrin</h3>
    </div>
    <form role="form" action="" method="post">
    <input type="hidden" name="id" value="<? echo $_GET["id"]; ?>">
    <input type="hidden" name="return" value="<? echo $_GET["return"]; ?>">
      <div class="box-body">
        <div class="alert alert-primary" style="background-color:#eee"><strong>Bu işlem manuel yapıldığı taktirde, mevcut dopingler otomatik silinir ve verilen tarih baz alınır.</strong><br>
          - İlanı vitrine çıkartmak için bugünün tarihinden ileri bir tarihe almanız gerekmektedir.<br>
          - İlanı vitrinden çıkartmak için bugünün tarihinden geri bir tarihe almanız gerekmektedir</div>
        <div class="row">
          <div class="col-md-6">
            <label>Vitrine</label>
            <div class="input-group">
              <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
              <input class="form-control" name="anasayfa" id="anasayfa" placeholder="Gün/Ay/Yıl" type="text" data-mask="" data-inputmask="'alias': 'dd/mm/yyyy'">
            </div>
          </div>
          <div class="col-md-6">
            <label>Kategori Vitrini</label>
            <div class="input-group">
              <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
              <input class="form-control" name="kategori" id="kategori" placeholder="Gün/Ay/Yıl" type="text" data-mask="" data-inputmask="'alias': 'dd/mm/yyyy'">
            </div>
          </div>
           <div class="col-md-6">
            <label>Acil İlanlar</label>
            <div class="input-group">
              <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
              <input class="form-control" name="acil" id="acil" placeholder="Gün/Ay/Yıl" type="text" data-mask="" data-inputmask="'alias': 'dd/mm/yyyy'">
            </div>
          </div>
          <div class="col-md-6">
            <label>Kalın & Renkli</label>
            <div class="input-group">
              <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
              <input class="form-control" name="kalin" id="kalin" placeholder="Gün/Ay/Yıl" type="text" data-mask="" data-inputmask="'alias': 'dd/mm/yyyy'">
            </div>
          </div>
        </div>
      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Kaydet</button>
      </div>
    </form>
  </div>
</section>
<script src="plugins/input-mask/jquery.inputmask.js"></script> 
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script> 
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script> 
<script>
  $(function () {
    $("#anasayfa").inputmask("dd/mm/yyyy");
	$("#kategori").inputmask("dd/mm/yyyy");
	$("#acil").inputmask("dd/mm/yyyy");
	$("#kalin").inputmask("dd/mm/yyyy");
  });
</script>