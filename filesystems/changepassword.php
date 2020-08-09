<?
if ($_SESSION["uye"] == ""){ header("location: /login"); }
if ($_POST["data1"] != ""){
$uye = $_SESSION["uye"];
$sql = $db->query("SELECT * FROM users WHERE Id = '$uye'");
$row = $sql->fetch(PDO::FETCH_OBJ);
$data1 = $_POST["data1"];
$data2 = $_POST["data2"];
if ($data1 != $row->parola){
header("location: index.php?page=changepassword&success=2");
} else {
$sql = "UPDATE users SET parola = '$data2' WHERE Id = '$uye'";
$stmt = $db->prepare($sql);
$stmt->execute();
header("location: index.php?page=changepassword&success=1");
}
}
if ($_GET["success"] == 1){
$err = '<div class="alert alert-success"><strong>Uyarı!</strong> Parola güncellendi</div>';
}

if ($_GET["success"] == 2){
$err = '<div class="alert alert-danger"><strong>Uyarı!</strong> Eski parola hatalı</div>';
}
?>

<div class="container top15">
  <div class="row no-gutter">
    <div class="col-xs-12 col-sm-3">
      <div class="panel panel-default">
        <div class="panel-heading">Üyelik Bilgilerim</div>
        <div class="panel-body">
          <?php include 'member_menu.php'; ?>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-9">
      <div class="panel panel-default">
        <div class="panel-heading">Parola Değişikliği</div>
        <div class="panel-body"><? echo $err; ?>
          <form action="" method="post">
            <div class="form-group">
              <label>Mevcut Parolanız :</label>
              <input type="password" name="data1" class="form-control" placeholder="Mevcut parola" required="required">
            </div>
            <div class="row no-gutter">
              <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                  <label>Yeni Parolanız :</label>
                  <input type="password" name="data2" id="data2" class="form-control" placeholder="Mevcut parola" required="required">
                </div>
              </div>
              <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                  <label>Yeni Parola Tekrar:</label>
                  <input type="password" name="data2_repeat" id="data2_repeat" class="form-control" placeholder="Yeni parola tekrar" required="required" oninput="repeat(this)">
                </div>
              </div>
            </div>
            <input type="submit" class="btn btn-primary" value="Parolamı Değişir">
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
