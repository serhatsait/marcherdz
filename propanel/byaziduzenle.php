<?
$id = $_GET["id"];
$err = "";
if ($_POST['a1'] != ""){
$a1 = $_POST["a1"];
$a2 = $_POST["a2"];
$a4 = $_POST["data2"];
$a5 = date("d-m-Y H:i:s");
$a6 = $_POST["a6"];
$a7 = $_POST["a7"];
$a8 = $_POST["a8"];
$slug = slugify($a2);
include('class.upload.php');
$logo = $_FILES['a3'];
$handle = new Upload($logo);
$dir_dest = "../uploads/";
$handle->image_convert	= 'jpg';
$handle->allowed		= array ( 'image/*' );
$handle->Process($dir_dest);
if ($handle->processed) { $resim = $handle->file_dst_name; }

$sql = "UPDATE byazilar SET kategoriId = '$a1', baslik = '$a2', icerik = '$a4', title = '$a6', description = '$a7', slug = '$slug', kisa = '$a8' WHERE Id = '$id'";
$stmt = $db->prepare($sql);
$stmt->execute();
if ($resim != ""){
$sql = "UPDATE byazilar SET resim = '$resim' WHERE Id = '$id'";
$stmt = $db->prepare($sql);
$stmt->execute();
}

$err = '<div class="alert alert-success"><strong>Uyarı!</strong> Yazı güncellendi</div>';
}
$sql = $db->query("SELECT * FROM byazilar WHERE Id = '$id'");
$a = $sql->fetch(PDO::FETCH_ASSOC);
?>
<section class="content-header">
  <h1> Blog Yönetimi<small>Yazı Yönetimi</small> </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
    <li><a href="index.php?page=bkategoriler"><i class="fa fa-dashboard"></i> Yazı Yönetimi</a></li>
    <li class="active">Düzenle</li>
  </ol>
</section>
<section class="content">
<? echo $err; ?>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Düzenle</h3>
    </div>
    <form role="form" action="" method="post" enctype="multipart/form-data">
      <div class="box-body"> 
       <div class="form-group">
          <label for="exampleInputEmail1">Başlık</label>
          <input type="text" class="form-control" id="a2" name="a2" placeholder="Başlık" value="<? echo $a["baslik"]; ?>" required>
        </div>
      <div class="form-group">
          <label for="exampleInputEmail1">Kategori</label>
          <select name="a1" class="form-control">
		  <?
		  $sql2 = $db->query("SELECT * FROM bkategoriler ORDER BY kategoriadi ASC");
		  while ($b = $sql2->fetch(PDO::FETCH_ASSOC)){
		  echo '<option value="'.$b["Id"].'"'; if ($a["kategoriId"] == $b["Id"]){ echo 'selected'; }echo '>'.$b["kategoriadi"].'</option>';
		  }
		  ?>
		  </select>
        </div>
		<div class="form-group">
          <label for="exampleInputEmail1">Resim</label>
          <input type="file" class="form-control" id="a3" name="a3" >
        </div>
			
        <div class="form-group">
          <label for="exampleInputEmail1">Title</label>
          <textarea class="form-control" name="a6" placeholder="Title" required><? echo $a["title"]; ?></textarea>
        </div>
		<div class="form-group">
          <label for="exampleInputEmail1">Description</label>
          <textarea class="form-control" name="a7" placeholder="Description" required><? echo $a["title"]; ?></textarea>
        </div>
		<div class="form-group">
          <label for="exampleInputEmail1">Kısa Açıklama</label>
          <textarea class="form-control" name="a8" placeholder="Description" required><? echo $a["kisa"]; ?></textarea>
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
