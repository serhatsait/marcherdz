<?
if ($_SESSION["uye"] == ""){ header("location: /login/"); }
$uye = $_SESSION["uye"];
$sql = $db->query("SELECT * FROM users WHERE Id = '$uye'");
$row = $sql->fetch(PDO::FETCH_OBJ);
if ($_POST["data1"] != ""){
$data1 = $_POST["data1"];
$data2 = $_POST["data2"];
$data3 = $_POST["data3"];
$data4 = $_POST["data4"];
$data5 = $_POST["data5"];
$data6 = $_POST["data6"];
$data7 = $_POST["data7"];
$data8 = $_POST["data8"];
$d = explode("/",$data3);
$data3 = "$d[2]-$d[1]-$d[0]";

$sql = "UPDATE users SET ad_soyad = '$data1', cinsiyet = '$data2', dogum_tarihi = '$data3', telefon = '$data4', gsm = '$data5', il = '$data7', ilce = '$data8' WHERE Id = '$uye'";
$stmt = $db->prepare($sql);
$stmt->execute();
header("location: /index.php?page=membership&success=1");
}
if ($_GET["success"] == 1){
$err = '<div class="alert alert-success"><strong>Uyarı!</strong> Üyelik bilgileriniz güncellendi</div>';
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
      <div class="panel-heading">Kişisel Bilgiler</div>
      <div class="panel-body"><? echo $err; ?>
        <form action="" method="post">
          <?php
                        if ($row->dogum_tarihi === NULL) {
                            $row->dogum_tarihi = "";
                        } else {
                            $e = explode("-", $row->dogum_tarihi);
                            $row->dogum_tarihi = $e[2] . "/" . $e[1] . "/" . $e[0];
                        }
                        ?>
          <div class="row no-gutter">
            <div class="col-xs-12 col-sm-6">
              <div class="form-group">
                <label>Ad Soyad :</label>
                <input type="text" name="data1" class="form-control" placeholder="Ad soyad" value="<?php echo $row->ad_soyad; ?>" required="required">
              </div>
            </div>
            <div class="col-xs-6">
              <div class="form-group">
                <label>Cinsiyet :</label>
                <select name="data2" id="data2" class="form-control">
                  <option value="Erkek" <?php
                                        if ($row->cinsiyet == "Erkek") {
                                            echo ' selected';
                                        }
                                        ?>>Erkek</option>
                  <option value="Kadın" <?php
                                        if ($row->cinsiyet == "Kadın") {
                                            echo ' selected';
                                        }
                                        ?>>Kadın</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row no-gutter">
            <div class="col-xs-12 col-sm-6">
              <div class="form-group">
                <label>Doğum Tarihi :</label>
                <input type="text" name="data3" id="data3" class="form-control birthday" placeholder="Gün / Ay / Yıl" value="<?php echo $row->dogum_tarihi; ?>">
              </div>
            </div>
            <div class="col-xs-12 col-sm-6">
              <div class="form-group">
                <label>Telefon :</label>
                <input type="text" name="data4" id="data4" class="form-control phone" placeholder="Telefon" value="<?php echo $row->telefon; ?>">
              </div>
            </div>
          </div>
          <div class="row no-gutter">
            <div class="col-xs-12 col-sm-6">
              <div class="form-group">
                <label>GSM :</label>
                <input type="text" name="data5" id="data5" class="form-control phone" value="<?php echo $row->gsm; ?>" required="required">
              </div>
            </div>
            <div class="col-xs-12 col-sm-6">
              <div class="form-group">
                <label>E-Posta :</label>
                <input type="email" name="data6" id="data6" class="form-control" placeholder="E-Posta" value="<?php echo $row->eposta; ?>" readonly required="required">
              </div>
            </div>
          </div>
          <div class="row no-gutter">
            <div class="col-xs-12 col-sm-6">
              <div class="form-group">
                <label>İl :</label>
                <select name="data7" id="data7" class="form-control il" onchange="districts()">
                  <option value="">Seçiniz</option>
                  <?php
                                        $sql2 = $db->query("SELECT * FROM city ORDER BY il_adi ASC");
                                        while ($i = $sql2->fetch(PDO::FETCH_OBJ)) {
                                            echo '<option value="' . $i->id . '"';
                                            if ($row->il == $i->id) {
                                                echo ' selected="select"';
                                            }
                                            echo '>' . $i->il_adi . '</option>';
                                        }
                                        ?>
                </select>
              </div>
            </div>
            <div class="col-xs-12 col-sm-6">
              <div class="form-group">
                <label>İlçe :</label>
                <select name="data8" id="data8" class="form-control ilce">
                  <?php
                                        $il = $row->il;
                                        $sql2 = $db->query("SELECT * FROM county WHERE il_id = '$il' ORDER BY county_adi ASC");
                                        while ($ix = $sql2->fetch(PDO::FETCH_OBJ)) {
                                            echo '<option value="' . $ix->id . '"';
                                            if ($row->ilce == $ix->id) {
                                                echo ' selected="select"';
                                            }
                                            echo '>' . $ix->county_adi . '</option>';
                                        }
                                        ?>
                </select>
              </div>
            </div>
          </div>
          <input type = "submit" class = "btn btn-primary" value = "Kaydet">
        </form>
      </div>
    </div>
  </div>
</div>
