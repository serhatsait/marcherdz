<?
$err = "";
$id = $_GET["id"];
if ($_POST['a1'] != ""){
$a1 = $_POST["a1"];
$a2 = $_POST["a2"];
$a3 = $_POST["a3"];
$sql = "UPDATE bkategoriler SET kategoriadi = '$a1', title = '$a2', description = '$a3' WHERE Id = '$id'";
$stmt = $db->prepare($sql);
$stmt->execute();
$err = '<div class="alert alert-success"><strong>Uyarı!</strong> Kategori güncellendi</div>';
}
$sql = $db->query("SELECT * FROM bkategoriler WHERE Id = '$id'");
$a = $sql->fetch(PDO::FETCH_ASSOC);
?>
<section class="content-header">
  <h1> Blog Yönetimi<small>Kategoriler</small> </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Page d'accueil</a></li>
    <li><a href="index.php?page=bkategoriler"><i class="fa fa-dashboard"></i> Blog Kategoriler</a></li>
    <li class="active">Düzenle</li>
  </ol>
</section>
<section class="content">
<? echo $err; ?>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Düzenle</h3>
    </div>
    <form role="form" action="" method="post">
      <div class="box-body"> 
       <div class="form-group">
          <label for="exampleInputEmail1">Kategori Adı</label>
          <input type="text" class="form-control" id="a1" name="a1" placeholder="Kategori Adı" value="<? echo $a["kategoriadi"]; ?>" required>
        </div>
      
        <div class="form-group">
          <label for="exampleInputEmail1">Title</label>
          <textarea class="form-control" name="a2" placeholder="Title" required><? echo $a["title"]; ?></textarea>
        </div>
		<div class="form-group">
          <label for="exampleInputEmail1">Description</label>
          <textarea class="form-control" name="a3" placeholder="Description" required><? echo $a["description"]; ?></textarea>
        </div>
      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Kaydet</button>
      </div>
    </form>
  </div>
</section>
