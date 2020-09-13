<?
$err = "";
if ($_POST['a1'] != ""){
$a1 = $_POST["a1"];
$a2 = $_POST["a2"];
$a3 = $_POST["a3"];
$a4 = $_POST["a4"];
$sira = $_POST["sira"];
$tip = $_POST["tip"];
if ($tip == 1){
	$a2 = "9999";
}
include('../filesystems/class.upload.php');
$logo = $_FILES['ikon'];
$handle = new Upload($logo);
$dir_dest = "../ikonlar/";
$handle->image_convert	= 'jpg';
$handle->allowed		= array ( 'image/*' );
$handle->Process($dir_dest);
if ($handle->processed) { $resim = $handle->file_dst_name; }

$sql = $db->prepare('INSERT INTO category (Id, kategori_adi, ustkategoriId, modul, ikon, title, description, sira, slink, moduller, durum, fiyat1, fiyat2, fiyat3,tip) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
$sql->execute(array(null,$a1,0,$a2, $resim, $a3, $a4, $sira, " ", " ", 0, 0,0,0,$tip));
echo '<script> window.location.href = "index.php?page=kategoriler"; </script>';
}
?>
<script>
function tpx(){
	if ($("#tip").val() == 0){
		$("#tp").css("display","block");
	} else {
		$("#tp").css("display","none");
	}
}
</script>
<section class="content-header">
  <h1> Kategori Yönetimi<small>Kategori Ekle</small> </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Page d'accueil</a></li>
    <li><i class="fa fa-dashboard"></i> Kategori Yönetimi</li>
    <li class="active">Kategori Ekle</li>
  </ol>
</section>
<section class="content"> <? echo $err; ?>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Kategori Ekle</h3>
    </div>
    <form role="form" action="" method="post" enctype="multipart/form-data">
      <div class="box-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Kategori Tipi</label>
          <select name="tip" id="tip" class="form-control" onchange="tpx()">
            <option value="0">İlan</option>
			<option value="1">Rehber</option>
		  </select>
        </div>
		
		<div class="form-group">
          <label for="exampleInputEmail1">Kategori Adı</label>
          <input type="text" class="form-control" id="a1" name="a1" placeholder="Kategori Adı" value="" required>
        </div>
		<div class="form-group">
          <label for="exampleInputEmail1">Sıra</label>
          <input type="text" class="form-control" id="sira" name="sira" placeholder="Sıralama Numarası" value="" required>
        </div>
        <div class="form-group" id="tp">
          <label for="exampleInputEmail1">Modül</label>
          <select name="a2" id="a2" class="form-control">
            <option value="0">Modülsüz</option>
            <?
		  $sql = $db->query("SELECT * FROM moduls");
		  while ($a = $sql->fetch(PDO::FETCH_ASSOC)){
		  echo '<option value="'.$a["Id"].'">'.$a["name"].'</option>';  
		  }
		  ?>
          </select>
        </div>
		 <div class="form-group">
          <label>Kategori İkonu</label>
          <input type="file" name="ikon" id="ikon" class="form-control">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Title</label>
          <input type="text" class="form-control" id="a3" name="a3" placeholder="Title" value="" required>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Description</label>
          <input type="text" class="form-control" id="a4" name="a4" placeholder="Description" value="" required>
        </div>
      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Kategori Ekle</button>
      </div>
    </form>
  </div>
</section>
