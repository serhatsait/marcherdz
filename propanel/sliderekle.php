<?
$err = "";
if ($_POST['a2'] != ""){
$a2 = $_POST["a2"];
include('../filesystems/class.upload.php');
$logo = $_FILES['a1'];
$handle = new Upload($logo);
$dir_dest = "../uploads/";
$handle->image_convert	= 'jpg';
$handle->allowed		= array ( 'image/*' );
$handle->Process($dir_dest);
if ($handle->processed) { $resim = $handle->file_dst_name; }

if ($resim != ""){
$sql = $db->prepare('INSERT INTO slider (Id, adi, url) VALUES (?,?,?)');
$sql->execute(array(null,$resim,$a2));
}
echo '<script> window.location.href = "index.php?page=slider"; </script>';
}
?>

<section class="content-header">
  <h1> Site Ayarları<small>Slider Yönetimi</small> </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
    <li><a href="index.php?page=slider"><i class="fa fa-dashboard"></i> Slider Yönetimi</a></li>
    <li class="active">Yeni Kayıt Ekle</li>
  </ol>
</section>
<section class="content"> <? echo $err; ?>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Yeni Kayıt Ekle</h3>
    </div>
    <form role="form" action="" method="post" enctype="multipart/form-data">
      <div class="box-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Url</label>
          <input type="text" class="form-control" id="a2" name="a2" placeholder="Url" value="#" required>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Resim</label>
          <input type="file" name="a1" id="a1" class="form-control" required>
        </div>
      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Kaydet</button>
      </div>
    </form>
  </div>
</section>
