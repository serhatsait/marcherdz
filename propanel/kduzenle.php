<?
$err = "";
if ($_POST['a1'] != ""){
$id = $_GET["id"];
$a1 = $_POST["a1"];
$a2 = $_POST["a2"];
$a3 = $_POST["a3"];
$a4 = $_POST["a4"];
$sira = $_POST["sira"];
$sql2 = "UPDATE category SET kategori_adi = '$a1', modul = '$a2', title = '$a3', sira = '$sira', description = '$a4' WHERE Id = '$id'";

$stmt = $db->prepare($sql2);
$stmt->execute();
$err = '<div class="alert alert-success"><strong>Uyarı!</strong> Kategori güncellendi</div>';
}
$id = $_GET["id"];
$sql = $db->query("SELECT * FROM category WHERE Id = '$id'");
$n =  $sql->fetch(PDO::FETCH_ASSOC);
?>

<section class="content-header">
  <h1> Kategori Yönetimi<small>Kategori Düzenle</small> </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Page d'accueil</a></li>
    <li><i class="fa fa-dashboard"></i> Kategori Yönetimi</li>
    <li class="active">Kategori Düzenle</li>
  </ol>
</section>
<section class="content"> <? echo $err; ?>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Kategori Düzenle</h3>
    </div>
    <form role="form" action="" method="post">
      <div class="box-body">
      
        <div class="form-group">
          <label for="exampleInputEmail1">Kategori Adı</label>
          <input type="text" class="form-control" id="a1" name="a1" placeholder="Kategori Adı" value="<? echo $n["kategori_adi"]; ?>" required>
        </div>
        <div class="form-group" <? if ($n["tip"] == 1){ echo ' style="display:none"'; } ?>>
          <label for="exampleInputEmail1">Modül</label>
          <select name="a2" id="a2" class="form-control">
            <option value="0">Modülsüz</option>
            <?
		  $sql = $db->query("SELECT * FROM moduls");
		  while ($a = $sql->fetch(PDO::FETCH_ASSOC)){
		  echo '<option value="'.$a["Id"].'"'; if ($n["modul"] == $a["Id"]){ echo ' selected'; } echo '>'.$a["name"].'</option>';  
		  }
		  ?>
          </select>
        </div>
		<div class="form-group">
          <label for="exampleInputEmail1">Sıra</label>
          <input type="text" class="form-control" id="sira" name="sira" placeholder="Sıralama Numarası" value="<? echo $n["sira"]; ?>" required>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Title</label>
          <input type="text" class="form-control" id="a3" name="a3" placeholder="Title" value="<? echo $n["title"]; ?>" required>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Description</label>
          <input type="text" class="form-control" id="a4" name="a4" placeholder="Description" value="<? echo $n["description"]; ?>" required>
        </div>
      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Düzenle</button>
      </div>
    </form>
  </div>
</section>
