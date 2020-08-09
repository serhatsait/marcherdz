<?
$err = "";
if ($_POST['a1'] != ""){
$a1 = $_POST["a1"];
$a2 = htmlentities($_POST["data2"]);
$sql = $db->prepare('INSERT INTO sss (Id, soru, cevap) VALUES (?,?,?)');
$sql->execute(array(null,$a1,$a2));
echo '<script> window.location.href = "index.php?page=sss"; </script>';
}
?>
<section class="content-header">
  <h1> S.S.S.<small>Yeni Kayıt</small> </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
    <li><a href="index.php?page=sss"><i class="fa fa-dashboard"></i> S.S.S.</a></li>
    <li class="active">Yeni Kayıt</li>
  </ol>
</section>
<section class="content"> <? echo $err; ?>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Yeni Kayıt</h3>
    </div>
    <form role="form" action="" method="post" enctype="multipart/form-data">
      <div class="box-body">
       
        <div class="form-group" id="s1">
          <label>Soru</label>
         <input type="text" class="form-control" id="a1" name="a1" placeholder="Soru" value="" required>
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