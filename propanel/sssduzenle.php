<?
$err = "";
$id = $_GET["id"];
if ($_POST["a1"] != ""){
$a1 = $_POST["a1"];	
$data2 = htmlentities($_POST["data2"]);
$sql = "UPDATE sss SET soru = '$a1', cevap = '$data2' WHERE Id = '$id'";
$stmt = $db->prepare($sql);
$stmt->execute();
echo '<script> window.location.href = "index.php?page=sss"; </script>';
}
$sql = $db->query("SELECT * FROM sss WHERE Id = '$id'");
$a = $sql->fetch(PDO::FETCH_ASSOC);
?>
<section class="content-header">
  <h1> S.S.S.<small>Düzenle</small> </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
    <li><a href="index.php?page=sss"><i class="fa fa-dashboard"></i> S.S.S.</a></li>
    <li class="active">Düzenle</li>
  </ol>
</section>
<section class="content"> <? echo $err; ?>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Düzenle</h3>
    </div>
    <form role="form" action="" method="post" enctype="multipart/form-data">
      <div class="box-body">
       
        <div class="form-group" id="s1">
          <label>Soru</label>
         <input type="text" class="form-control" id="a1" name="a1" placeholder="Soru" value="<? echo $a["soru"]; ?>" required>
        </div>
       
      <div class="form-group">
          <label>Cevap</label>
          <textarea name="data2" id="data2" class="summernote" style="width:100%"><? echo html_entity_decode($a["cevap"]); ?></textarea>
        </div>
    
        </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Kaydet</button>
      </div>
    </form>
  </div>
</section>