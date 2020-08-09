<?
$err = "";
$id = $_GET["id"];
if ($_POST['a1'] != ""){
$a1 = $_POST["a1"];

$sql = "UPDATE locality SET districtname = '$a1' WHERE id = '$id'";
$stmt = $db->prepare($sql);
$stmt->execute();

echo '<script> window.location.href="index.php?page=bolgeler"; </script>';
}
$sql = $db->query("SELECT * FROM locality WHERE id = '$id'");
$a = $sql->fetch(PDO::FETCH_ASSOC);
?>

<section class="content">
<? echo $err; ?>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Düzenle</h3>
    </div>
    <form role="form" action="" method="post">
      <div class="box-body"> 
       <div class="form-group">
          <label for="exampleInputEmail1">Mahalle Adı</label>
          <input type="text" class="form-control" id="a1" name="a1" placeholder="Mahalle Adı" value="<? echo $a["districtname"]; ?>" required>
        </div>
      
   
      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Kaydet</button>
      </div>
    </form>
  </div>
</section>
