<?
$err = "";
if ($_POST['a1'] != ""){
$a1 = $_POST["a1"];
$a2 = $_POST["a2"];
$a3 = $_POST["a3"];
$sql = $db->prepare('INSERT INTO bkategoriler (Id, kategoriadi, title, description) VALUES (?,?,?,?)');
$sql->execute(array(null,$a1,$a2,$a3));
echo '<script> window.location.href = "index.php?page=bkategoriler"; </script>';
}
?>
<section class="content-header">
  <h1> Blog Yönetimi<small>Kategoriler</small> </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Page d'accueil</a></li>
    <li><a href="index.php?page=bkategoriler"><i class="fa fa-dashboard"></i> Blog Kategoriler</a></li>
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
          <label for="exampleInputEmail1">Kategori Adı</label>
          <input type="text" class="form-control" id="a1" name="a1" placeholder="Kategori Adı" value="" required>
        </div>
      
        <div class="form-group">
          <label for="exampleInputEmail1">Title</label>
          <textarea class="form-control" name="a2" placeholder="Title" required></textarea>
        </div>
		<div class="form-group">
          <label for="exampleInputEmail1">Description</label>
          <textarea class="form-control" name="a3" placeholder="Description" required></textarea>
        </div>
      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Kaydet</button>
      </div>
    </form>
  </div>
</section>
