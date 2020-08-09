<?
$err = "";
$id = $_GET["id"];
if ($_POST['a1'] != ""){
$a1 = $_POST['a1'];
$a2 = $_POST['a2'];
$sql = "UPDATE metalar SET title = '$a1', description = '$a2' WHERE Id = '$id'";
$stmt = $db->prepare($sql);
$stmt->execute();
$err = '<div class="alert alert-success"><strong>Uyarı!</strong> Meta bilgileri güncellendi</div>';	
}
$sql = $db->query("SELECT * FROM metalar WHERE Id = '$id'");
$a = $sql->fetch(PDO::FETCH_ASSOC);
?>
<section class="content-header">
  <h1> Site Ayarları<small>Meta Yönetimi</small> </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
    <li><a href="index.php?page=metayonetimi"><i class="fa fa-dashboard"></i> Meta Yönetimi</a></li>
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
          <label for="exampleInputEmail1">Title</label>
          <input type="text" class="form-control" id="a1" name="a1" placeholder="Title" value="<? echo $a["title"]; ?>" required>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Description</label>
          <input type="text" class="form-control" id="a2" name="a2" placeholder="Description" value="<? echo $a["description"]; ?>" required>
        </div>
      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Kaydet</button>
      </div>
    </form>
  </div>
</section>
