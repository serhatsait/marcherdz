<?
$err = "";
if ($_POST['a1'] != ""){
$a1 = $_POST["a1"];
$a2 = $_POST["a2"];
$a3 = $_POST["a3"];
$a4 = $_POST["a4"];
$a5 = $_POST["a5"];
$a6 = $_POST["a6"];
$a7 = $_POST["a7"];
$a8 = $_POST["a8"];
$a9 = $_POST["a9"];
$a10 = $_POST["a10"];
$a11 = $_POST["a11"];
$a12 = $_POST["a12"];
$sql = "UPDATE doping_ayarlari SET a1 = '$a1', a2 = '$a2', a3 = '$a3', a4 = '$a4', a5 = '$a5', a6 = '$a6', a7 = '$a7', a8 = '$a8', a9 = '$a9', a10 = '$a10', a11 = '$a11', a12 = '$a12' ";
$stmt = $db->prepare($sql);
$stmt->execute();
$err = '<div class="alert alert-success"><strong>Uyarı!</strong> Doping ücretleri güncellendi</div>';
}
$sql = $db->query("SELECT * FROM doping_ayarlari");
$a = $sql->fetch(PDO::FETCH_ASSOC);
?>

<section class="content-header">
  <h1> Site Ayarları<small>Doping Ücretleri</small> </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
    <li class="active">Doping Ücretleri</li>
  </ol>
</section>
<section class="content"> <? echo $err; ?>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Doping Ücretleri</h3>
    </div>
    <div class="box-body">
      <form role="form" action="" method="post">
        <div class="row">
          <div class="col-md-6">
            <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title">Anasayfa</h3>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-4">
                    <label for="exampleInputEmail1">1 Hafta</label>
                    <div class="input-group">
                      <input type="number" class="form-control" id="a1" name="a1" placeholder="0" value="<? echo $a["a1"]; ?>" required>
                      <span class="input-group-addon">.00</span> </div>
                  </div>
                  <div class="col-md-4">
                    <label for="exampleInputEmail1">2 Hafta</label>
                    <div class="input-group">
                      <input type="number" class="form-control" id="a2" name="a2" placeholder="0" value="<? echo $a["a2"]; ?>" required>
                      <span class="input-group-addon">.00</span> </div>
                  </div>
                  <div class="col-md-4">
                    <label for="exampleInputEmail1">4 Hafta</label>
                    <div class="input-group">
                      <input type="number" class="form-control" id="a3" name="a3" placeholder="0" value="<? echo $a["a3"]; ?>" required>
                      <span class="input-group-addon">.00</span> </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title">Kategori Vitrini</h3>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-4">
                    <label for="exampleInputEmail1">1 Hafta</label>
                    <div class="input-group">
                      <input type="number" class="form-control" id="a4" name="a4" placeholder="0" value="<? echo $a["a4"]; ?>" required>
                      <span class="input-group-addon">.00</span> </div>
                  </div>
                  <div class="col-md-4">
                    <label for="exampleInputEmail1">2 Hafta</label>
                    <div class="input-group">
                      <input type="number" class="form-control" id="a5" name="a5" placeholder="0" value="<? echo $a["a5"]; ?>" required>
                      <span class="input-group-addon">.00</span> </div>
                  </div>
                  <div class="col-md-4">
                    <label for="exampleInputEmail1">4 Hafta</label>
                    <div class="input-group">
                      <input type="number" class="form-control" id="a6" name="a6" placeholder="0" value="<? echo $a["a6"]; ?>" required>
                      <span class="input-group-addon">.00</span> </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title">Acil İlanlar</h3>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-4">
                    <label for="exampleInputEmail1">1 Hafta</label>
                    <div class="input-group">
                      <input type="number" class="form-control" id="a7" name="a7" placeholder="0" value="<? echo $a["a7"]; ?>" required>
                      <span class="input-group-addon">.00</span> </div>
                  </div>
                  <div class="col-md-4">
                    <label for="exampleInputEmail1">2 Hafta</label>
                    <div class="input-group">
                      <input type="number" class="form-control" id="a8" name="a8" placeholder="0" value="<? echo $a["a8"]; ?>" required>
                      <span class="input-group-addon">.00</span> </div>
                  </div>
                  <div class="col-md-4">
                    <label for="exampleInputEmail1">4 Hafta</label>
                    <div class="input-group">
                      <input type="number" class="form-control" id="a9" name="a9" placeholder="0" value="<? echo $a["a9"]; ?>" required>
                      <span class="input-group-addon">.00</span> </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title">Renkli ve Kalın</h3>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-4">
                    <label for="exampleInputEmail1">1 Hafta</label>
                    <div class="input-group">
                      <input type="number" class="form-control" id="a10" name="a10" placeholder="0" value="<? echo $a["a10"]; ?>" required>
                      <span class="input-group-addon">.00</span> </div>
                  </div>
                  <div class="col-md-4">
                    <label for="exampleInputEmail1">2 Hafta</label>
                    <div class="input-group">
                      <input type="number" class="form-control" id="a11" name="a11" placeholder="0" value="<? echo $a["a11"]; ?>" required>
                      <span class="input-group-addon">.00</span> </div>
                  </div>
                  <div class="col-md-4">
                    <label for="exampleInputEmail1">4 Hafta</label>
                    <div class="input-group">
                      <input type="number" class="form-control" id="a12" name="a12" placeholder="0" value="<? echo $a["a12"]; ?>" required>
                      <span class="input-group-addon">.00</span> </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div>
          <button type="submit" class="btn btn-primary">Kaydet</button>
        </div>
      </form>
    </div>
  </div>
</section>
