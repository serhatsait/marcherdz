<?
$err = "";
if ($_POST['a1'] != ""){
$a1 = $_POST["a1"];
$sql = $db->prepare('INSERT INTO city (id, il_adi) VALUES (?,?)');
$sql->execute(array(null,$a1));
echo '<script> window.location.href = "index.php?page=bolgeler"; </script>';
}
?>

<section class="content">
<? echo $err; ?>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Yeni il Ekle</h3>
    </div>
    <form role="form" action="" method="post">
      <div class="box-body"> 
       <div class="form-group">
          <label for="exampleInputEmail1">İl Adı</label>
          <input type="text" class="form-control" id="a1" name="a1" placeholder="İl Adı" value="" required>
        </div>
      
        
      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Kaydet</button>
      </div>
    </form>
  </div>
</section>
