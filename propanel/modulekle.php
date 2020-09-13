<?
$err = "";
if ($_POST['a1'] != ""){
$a1 = $_POST["a1"];
$sql = $db->prepare('INSERT INTO moduls (Id, name, durum) VALUES (?,?,?)');
$sql->execute(array(null,$a1,0));
echo '<script> window.location.href = "index.php?page=moduller"; </script>';
}
?>
<section class="content-header">
  <h1> Site Ayarları<small>Modül Yönetimi</small> </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Page d'accueil</a></li>
    <li><a href="index.php?page=moduller"><i class="fa fa-dashboard"></i> Modül Yönetimi</a></li>
    <li class="active">Yeni Kayıt Ekle</li>
  </ol>
</section>
<section class="content">
<? echo $err; ?>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Yeni Kayıt Ekle</h3>
    </div>
    <form role="form" action="" method="post">
      <div class="box-body"> 
       <div class="form-group">
          <label for="exampleInputEmail1">Modül Adı</label>
          <input type="text" class="form-control" id="a1" name="a1" placeholder="Modül Adı" value="" required>
        </div>
      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Kaydet</button>
      </div>
    </form>
  </div>
</section>
