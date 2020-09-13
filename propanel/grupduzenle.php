<?
$err = "";
$id = $_GET["id"];
if ($_POST['a1'] != ""){
$a1 = $_POST["a1"];
$sql = "UPDATE groups SET name = '$a1' WHERE Id = '$id'";
$stmt = $db->prepare($sql);
$stmt->execute();

$sql = $db->query("SELECT * FROM groups WHERE Id = '$id'");
$a = $sql->fetch(PDO::FETCH_ASSOC);
echo '<script> window.location.href = "index.php?page=modulozellikleri&id='.$a["modulId"].'"; </script>';
}
$sql = $db->query("SELECT * FROM groups WHERE Id = '$id'");
$a = $sql->fetch(PDO::FETCH_ASSOC);
?>
<section class="content-header">
  <h1> Site Ayarları<small>Modul Yönetimi</small> </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Page d'accueil</a></li>
    <li><a href="index.php?page=moduller"><i class="fa fa-dashboard"></i> Modül Yönetimi</a></li>
	<li><a href="index.php?page=modulozellikleri&id=<? echo $a["modulId"]; ?>"><i class="fa fa-dashboard"></i> Gruplar</a></li>
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
          <label for="exampleInputEmail1">Grup Adı</label>
          <input type="text" class="form-control" id="a1" name="a1" placeholder="Grup Adı" value="<? echo $a["name"]; ?>" required>
        </div>
      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Kaydet</button>
      </div>
    </form>
  </div>
</section>
