<?
$err = "";
if ($_POST['a1'] != ""){
$id = $_GET["id"];
$a1 = $_POST["a1"];
$a2 = $_POST["a2"];
$a3 = $_POST["a3"];
$a4 = $_POST["a4"];
$a5 = $_POST["a5"];

$sql2 = "UPDATE magazalar SET magazaadi = '$a1', adres = '$a2', aciklama = '$a3', sure = '$a4', magazakota = '$a5' WHERE Id = '$id'";
$stmt = $db->prepare($sql2);
$stmt->execute();
$err = '<div class="alert alert-success"><strong>Uyarı!</strong> Mağaza güncellendi</div>';
}
$id = $_GET["id"];
$sql = $db->query("SELECT * FROM magazalar WHERE Id = '$id'");
$n =  $sql->fetch(PDO::FETCH_ASSOC);

$sql2 = $db->query("SELECT * FROM users WHERE Id = '{$n['uyeId']}'");
$b =  $sql2->fetch(PDO::FETCH_ASSOC);

$base = str_replace("http://","",$base_url);
$base =substr_replace($base, '', -1);
?>
<script>
    var digitsOnly = /[1234567890]/g;
    var integerOnly = /[0-9\.]/g;
    var alphaOnly = /[A-Za-z1234567890]/g;
    function restrictCharacters(myfield, e, restrictionType) {
        if (!e)
            var e = window.event
        if (e.keyCode)
            code = e.keyCode;
        else if (e.which)
            code = e.which;
        var character = String.fromCharCode(code);
        if (code == 27) {
            this.blur();
            return false;
        }
        if (!e.ctrlKey && code != 9 && code != 8 && code != 36 && code != 37 && code != 38 && (code != 39 || (code == 39 && character == "'")) && code != 40) {
            if (character.match(restrictionType)) {
                return true;
            } else {
                return false;
            }
        }
}
function kontrol() {
        $.post("../filesystems/kontrol.php", {
            name: $("#a2").val()
        },
                function (data) {
                    if (data > 0) {
                        alert("Belirtilen mağaza adresi kullanımda");
                        $("#a2").val("");
                        $("#sub").attr("disabled", true);
                    } else {
                        $("#sub").attr("disabled", false);
                    }
                });
}
</script>

<section class="content-header">
  <h1> Mağaza Yönetimi<small>Mağaza Düzenle</small> </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Page d'accueil</a></li>
    <li><i class="fa fa-dashboard"></i> Mağaza Yönetimi</li>
    <li class="active">Mağaza Düzenle</li>
  </ol>
</section>
<section class="content"> <? echo $err; ?>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Mağaza Düzenle</h3>
    </div>
    <form role="form" action="" method="post">
      <div class="box-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Mağaza Sahibi</label>
           <a href="index.php?page=uye&id=<? echo $b["Id"]; ?>" class="btn btn-default" target="_blank"><? echo $b["ad_soyad"]; ?></a></div>
        <div class="form-group">
          <label for="exampleInputEmail1">Ödeme Türü</label>
          Havale / EFT </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Tutar</label>
          <? echo $n["fiyat"]; ?> TL </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Mağaza Adı</label>
          <input type="text" class="form-control" id="a1" name="a1" placeholder="Mağaza Adı" value="<? echo $n["magazaadi"]; ?>" required>
        </div>
        <label for="exampleInputEmail1">Url</label>
        <div class="input-group">
          <input type="text" class="form-control" id="a2" name="a2" placeholder="" value="<? echo $n["adres"]; ?>" onkeypress="return restrictCharacters(this, event, alphaOnly);" onpaste="return false;" autocomplete="off" onChange="kontrol()" required>
          <span class="input-group-addon"><? echo $base; ?></span> </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Açıklama</label>
          <textarea class="form-control" id="a3" name="a3" required><? echo $n["aciklama"]; ?></textarea>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Süre (AY)</label>
          <input type="number" class="form-control" id="a4" name="a4" placeholder="Süre ( Ay )" value="<? echo $n["sure"]; ?>" required>
        </div>
		<div class="form-group">
          <label for="exampleInputEmail1">Üyenin Mağaza İlan Sınırı</label>
          <input type="number" class="form-control" id="a5" name="a5" placeholder="Mağaza Kotası" value="<? echo $n["magazakota"]; ?>" required>
        </div>
      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-primary" id="sub" name="sub">Kaydet</button>
      </div>
    </form>
  </div>
</section>
