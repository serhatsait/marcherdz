<?
if ($_POST['facebook'] != ""){
$facebook1 = $_POST["facebook"];
$twitter1 = $_POST["twitter"];
$google1 = $_POST["google"];
$youtube1 = $_POST["youtube"];
$instagram1 = $_POST["instagram"];

$sql = "UPDATE sosyalmedya SET facebook = '$facebook1', twitter = '$twitter1', google = '$google1', youtube = '$youtube1', instagram = '$instagram1'";
$stmt = $db->prepare($sql);
$stmt->execute();

echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> <script> alert("Sosyal Medya Linkleriniz Güncellendi..!"); window.history.go(-1); </script>';
}
$sql = $db->query("SELECT * FROM sosyalmedya");
$a = $sql->fetch(PDO::FETCH_ASSOC);
?>
<section class="content-header">
  <h1> Sosyal Medya Ayarları</h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Page d'accueil</a></li>
    <li class="active">Sosyal Medya Ayarları</li>
  </ol>
</section>
<section class="content">

  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Sosyal Medya Ayarları ( Footer )</h3>
    </div>
    <form name="form" action="" method="post">
      <div class="box-body"> 
       
		
		
        <div class="form-group">
          <label for="exampleInputEmail1">Facebook Footer Link :</label>
          <input type="text" class="form-control"  name="facebook" placeholder="http://" value="<? echo $a["facebook"]; ?>">
        </div>
       <div class="form-group">
          <label for="exampleInputEmail1">Twitter Footer Link :</label>
          <input type="text" class="form-control"  name="twitter" placeholder="http://" value="<? echo $a["twitter"]; ?>">
        </div>
		<div class="form-group">
          <label for="exampleInputEmail1">Google+ Footer Link :</label>
          <input type="text" class="form-control"  name="google" placeholder="http://" value="<? echo $a["google"]; ?>">
        </div>
		<div class="form-group">
          <label for="exampleInputEmail1">Youtube Footer Link :</label>
          <input type="text" class="form-control" name="youtube" placeholder="http://" value="<? echo $a["youtube"]; ?>">
        </div>
		
		<div class="form-group">
          <label for="exampleInputEmail1">Instagram Footer Link :</label>
          <input type="text" class="form-control" name="instagram" placeholder="http://" value="<? echo $a["instagram"]; ?>">
        </div>
		
      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Kaydet</button>
      </div>
    </form>
  </div>
</section>
