<?
$id = $_GET["id"];
$err = "";
if ($_POST['a1'] != ""){
$a1 = $_POST["a1"];
$sql = $db->prepare('INSERT INTO county (id, il_id, county_adi) VALUES (?,?,?)');
$sql->execute(array(null,$id,$a1));
echo '<script> window.location.href = "index.php?page=bolgeler"; </script>';
}
?>

<section class="content">
<? echo $err; ?>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Yeni İlçe Ekle</h3>
    </div>
    <form role="form" action="" method="post">
      <div class="box-body"> 
       <div class="form-group">
          <label for="exampleInputEmail1">İlçe Adı</label>
          <input type="text" class="form-control" id="a1" name="a1" placeholder="İlçe Adı" value="" required>
        </div>
      
        
      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Kaydet</button>
      </div>
    </form>
  </div>
</section>
