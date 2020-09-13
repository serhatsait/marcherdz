<?
if ($_POST['anasayfavitrini'] != ""){
$populerilanlar = $_POST["populerilanlar"];
$anasayfavitrini = $_POST["anasayfavitrini"];
$acilvitrin = $_POST["acilvitrin"];
$soneklenenilanlar = $_POST["soneklenenilanlar"];
$getilanlar = $_POST["getilanlar"];
$firmalar = $_POST["firmalar"];
$magazalar = $_POST["magazalar"];

$sql = "UPDATE vitrinlimitleri SET populerilanlar = '$populerilanlar', anasayfavitrini = '$anasayfavitrini', acilvitrin = '$acilvitrin', soneklenenilanlar = '$soneklenenilanlar', getilanlar = '$getilanlar', firmalar = '$firmalar', magazalar = '$magazalar'";
$stmt = $db->prepare($sql);
$stmt->execute();

echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> <script> alert("Vitrin Limitleriniz Belirlendi..!"); window.history.go(-1); </script>';
}
$sql = $db->query("SELECT * FROM vitrinlimitleri");
$a = $sql->fetch(PDO::FETCH_ASSOC);
?>
<section class="content-header">
  <h1>Vitrin Bölümleri Limit Ayarları</h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Page d'accueil</a></li>
    <li class="active">Vitrin Bölümleri Limit Ayarları</li>
  </ol>
</section>
<section class="content">

  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Vitrin Bölümlerindeki İlan Limitlerini Belirleme</h3>
    </div>
    <form name="form" action="" method="post">
      <div class="box-body"> 
       
		
		<div class="form-group">
          <label for="exampleInputEmail1">Populer İlanlar Vitrini İlan Limiti :</label>
          <input type="text" class="form-control"  name="populerilanlar" value="<? echo $a["populerilanlar"]; ?>">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Anasayfa Vitrini İlan Limiti :</label>
          <input type="text" class="form-control"  name="anasayfavitrini" value="<? echo $a["anasayfavitrini"]; ?>">
        </div>
       <div class="form-group">
          <label for="exampleInputEmail1">Acil İlanlar Vitrin Limiti :</label>
          <input type="text" class="form-control"  name="acilvitrin" value="<? echo $a["acilvitrin"]; ?>">
        </div>
		<div class="form-group">
          <label for="exampleInputEmail1">Son Eklenen İlanlar Vitrin Limiti :</label>
          <input type="text" class="form-control"  name="soneklenenilanlar" value="<? echo $a["soneklenenilanlar"]; ?>">
        </div>
		<div class="form-group">
          <label for="exampleInputEmail1">Son Eklenen Güvenli Ticaret İlanları Vitrin Limiti :</label>
          <input type="text" class="form-control" name="getilanlar" value="<? echo $a["getilanlar"]; ?>">
        </div>
		
		<div class="form-group">
          <label for="exampleInputEmail1">Son Eklenen Firmalar Vitrin Limiti :</label>
          <input type="text" class="form-control" name="firmalar" value="<? echo $a["firmalar"]; ?>">
        </div>
		<div class="form-group">
          <label for="exampleInputEmail1">Son Eklenen Mağazalar Vitrin Limiti :</label>
          <input type="text" class="form-control" name="magazalar" value="<? echo $a["magazalar"]; ?>">
        </div>
		
		
      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Kaydet</button>
      </div>
    </form>
  </div>
</section>
