<?
$err = "";
$id = $_GET["id"];
if ($_POST["data2"] != ""){
$data1 = $_POST["data1"];
$data2 = htmlentities($_POST["data2"]);
$sql = "UPDATE sayfalar SET sayfaadi = '$data1', icerik = '$data2' WHERE Id = '$id'";
$stmt = $db->prepare($sql);
$stmt->execute();	
}
$sql = $db->query("SELECT * FROM sayfalar WHERE Id = '$id'");
$a = $sql->fetch(PDO::FETCH_ASSOC);
?>

<section class="content-header">
  <h1> Sayfa Yönetimi<small>Sayfa Düzenle</small> </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Page d'accueil</a></li>
    <li><a href="index.php?page=sayfalar"><i class="fa fa-dashboard"></i> Sayfa Yönetimi</a></li>
    <li class="active">Sayfa Düzenle</li>
  </ol>
</section>
<section class="content"> <? echo $err; ?>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Sayfa Düzenle</h3>
    </div>
    <form role="form" action="index.php?page=sayfa&id=<? echo $_GET["id"]; ?>" method="post" enctype="multipart/form-data">
      <div class="box-body">
       
        <div class="form-group" id="s1">
          <label>Sayfa Adı</label>
          <input type="text" class="form-control" id="data1" name="data1" placeholder="Sayfa Adı" value="<? echo $a["sayfaadi"]; ?>" required>
        </div>
       
      <div class="form-group">
          <label>İçerik</label>
          <textarea name="data2" id="data2" class="summernote" style="width:100%"><? echo html_entity_decode($a["icerik"]); ?></textarea>
        </div>
    
        </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Kaydet</button>
      </div>
    </form>
  </div>
</section>
<script>
function ch(){
	if (document.getElementById('a1').value == 0){
	$("#s1").css("display","block");
	$("#s3").css("display","block");
	$("#s2").css("display","none");
	} else {
	$("#s1").css("display","none");
	$("#s2").css("display","block");
	$("#s3").css("display","none");
	}
}
</script>