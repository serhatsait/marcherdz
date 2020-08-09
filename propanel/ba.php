<?
$err = "";
if ($_POST['a1'] != ""){
$a1 = $_POST["a1"];
$a4 = $_POST["a4"];
$id = $_GET['id'];
if($a1 == 0){
include('../filesystems/class.upload.php');
$logo = $_FILES['a2'];
$handle = new Upload($logo);
$dir_dest = "../uploads/";
$handle->image_convert	= 'jpg';
$handle->allowed		= array ( 'image/*' );
$handle->Process($dir_dest);
if ($handle->processed) { $resim = $handle->file_dst_name; }
$sql = "UPDATE banner SET tip = '0', kod = '$resim', url = '$a4' WHERE Id = '$id'";
$stmt = $db->prepare($sql);
$stmt->execute();
$err = '<div class="alert alert-success"><strong>Uyarı!</strong> Banner güncellendi</div>';
} else {
$a3 = htmlentities($_POST['a3']);
$sql = "UPDATE banner SET tip = '1', kod = '$a3' WHERE Id = '$id'";
$stmt = $db->prepare($sql);
$stmt->execute();
$err = '<div class="alert alert-success"><strong>Uyarı!</strong> Banner güncellendi</div>';	
}
}
?>

<section class="content-header">
  <h1> Site Ayarları<small>Banner Yönetimi</small> </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
    <li><a href="index.php?page=banka"><i class="fa fa-dashboard"></i> Banner Yönetimi</a></li>
    <li class="active">Banner Düzenle</li>
  </ol>
</section>
<section class="content"> <? echo $err; ?>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Banner Düzenle</h3>
    </div>
    <form role="form" action="index.php?page=ba&id=<? echo $_GET["id"]; ?>" method="post" enctype="multipart/form-data">
      <div class="box-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Tip</label>
          <select name="a1" id="a1" class="form-control" onChange="ch()">
            <option value="0">Resim</option>
            <option value="1">Kod</option>
          </select>
        </div>
        <div class="form-group" id="s1">
          <label>Resim</label>
          <input type="file" name="a2" id="a2" class="form-control">
        </div>
        <div class="form-group" id="s2" style="display:none">
          <label>Kod</label>
          <textarea class="form-control" name="a3" id="a3"></textarea>
        </div>
      
      <div class="form-group" id="s3">
          <label>URL</label>
          <input type="text" name="a4" id="a4" class="form-control">
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