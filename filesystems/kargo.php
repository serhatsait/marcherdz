<?
if ($_SESSION["uye"] == ""){ header("location: /login/"); }
$id = $_GET["id"];
$uye = $_SESSION['uye'];
if ($_POST['a1'] != ""){
$a1 = $_POST["a1"];
$a2 = $_POST["a2"];
$a3 = $_POST["a3"];
$sql = "UPDATE siparisler SET kargotarihi = '$a1', kargoadi = '$a2', takipno = '$a3', durum = '1'  WHERE Id = '$id' and (satici = '$uye')";
$stmt = $db->prepare($sql);
$stmt->execute();
}

$sql = $db->query("SELECT * FROM siparisler WHERE (alici = '$uye' or satici = '$uye') and Id = '$id'");
$a = $sql->fetch(PDO::FETCH_ASSOC);
$sql2 = $db->query("SELECT * FROM users WHERE Id = '{$a['alici']}'");
$b = $sql2->fetch(PDO::FETCH_ASSOC);

?>

<div class="container top15">
  <div class="row no-gutter">
    <div class="col-xs-12 col-sm-3">
      <div class="panel panel-default">
        <div class="panel-heading">Satış İşlemleri</div>
        <div class="panel-body">
          <?php include 'satis_menu.php'; ?>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-9">
      <div class="panel panel-default">
        <div class="panel-heading">Sipariş Bilgileri</div>
        <div class="panel-body">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tbody>
              <tr>
                <td width="175">Tarih</td>
                <td>: <? echo $a["tarih"]; ?></td>
              </tr>
              <tr>
                <td width="175">Alıcı</td>
                <td>: <? echo $b["ad_soyad"]; ?></td>
              </tr>
              <tr>
                <td width="175">Tutar</td>
                <td>: <? echo $a["fiyat"]; ?> TL</td>
              </tr>
              <tr>
                <td width="175">Hesaba Aktarılacak Tutar</td>
                <td>: <? echo $a["aktarilacaktutar"]; ?> TL</td>
              </tr>
              <?
                            $uye = $_SESSION['uye'];
                            if ($a["satici"] == $uye){
                            if ($a["durum"] == 0){
                            $durum = "Kargo Bilgisi Girmeniz Bekleniyor";
                            } elseif ($a["durum"] == 1){
                            $durum = "Alıcının Kargoya Onay Vermesi Bekleniyor";
                            } elseif ($a["durum"] == 2){
                            $durum = "Alıcı Kargoya Onay Verdi. Ödemeniz Hesabınıza Aktarılacaktır";
                            } elseif ($a["durum"] == 3){
                            $durum = "Ödemeniz Hesabınıza Gönderildi";
                            }
                            ?>
              <tr>
                <td width="175">Durum</td>
                <td>: <? echo $durum; ?></td>
              </tr>
              <? } else {
                            if ($a["durum"] == 0){
                            $durum = "Satıcının kargo bilgisi girmesi bekleniyor";
                            } elseif ($a["durum"] == 1){
                            $durum = "Kargoya onay vermeniz bekleniyor";
                            } elseif ($a["durum"] == 2){
                            $durum = "Kargoya onay verdiniz. Satıcı hakkında yorum yapabilirsiniz";
                            } elseif ($a["durum"] == 3){
                            $durum = "Sipariş Tamamlandı";
                            }
                            ?>
              <tr>
                <td width="175">Durum</td>
                <td>: <? echo $durum; ?></td>
              </tr>
              <? } ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">Kargo Bilgileri</div>
        <div class="panel-body">
          <form action="index.php?page=kargo&id=<? echo $id; ?>" method="post" onSubmit="return sor()">
            <div class="form-group">
              <label>Kargo Tarihi</label>
              <input type="text" class="form-control birthday" name="a1" id="a1" value="<? echo $a["kargotarihi"]; ?>" required>
            </div>
            <div class="form-group">
              <label>Kargo Adı</label>
              <input type="text" class="form-control" name="a2" id="a2" value="<? echo $a["kargoadi"]; ?>" required>
            </div>
            <div class="form-group">
              <label>Kargo Takip No</label>
              <input type="text" class="form-control" name="a3" id="a3" value="<? echo $a["takipno"]; ?>" required>
            </div>
            <input type="submit" value="Kaydet" class="btn btn-primary">
          </form>
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">Ürün</div>
        <div class="panel-body">
          <?
        $sql2 = $db->query("SELECT * FROM ilanlar WHERE Id = '{$a['ilanId']}'");
        $row = $sql2->fetch(PDO::FETCH_ASSOC);
        $resim = $db->query("SELECT * FROM images WHERE ilanId = '{$row['Id']}' ORDER BY s ASC LIMIT 1");
        if ($resim->rowCount() == 0) {
        $src = "img/no.png";
        } else {
        $r   = $resim->fetch(PDO::FETCH_ASSOC);
        $src = $base_url . "fileserver/files/" . $row["Id"] . "/thumbnail/" . $r["name"];
        }
        $e = explode("-", $row["dates"]);
        $il    = $db->query("SELECT * FROM city WHERE id = '{$row['city']}'");
        $ilyaz = $il->fetch(PDO::FETCH_ASSOC);
        $ilce    = $db->query("SELECT * FROM county WHERE id = '{$row['districts']}'");
        $ilceyaz = $ilce->fetch(PDO::FETCH_ASSOC);

        $mahalle    = $db->query("SELECT * FROM locality WHERE id = '{$row['locality']}'");
        $mahalleyaz = $mahalle->fetch(PDO::FETCH_ASSOC);
        echo '
        <div class="adv' . $class . '">
        <div class="row no-gutter">
        <div class="col-sm-1 hidden-xs"><a href="i-'.$row["Id"].'-'.slugify($row["title"]).'.html"><img src="' . $src . '" class="img-thumbnail" width="100" /></a></div>
        <div class="col-sm-9 col-xs-10"><strong style="font-size:14px">' . $row["title"] . '</strong>
        <br><span style="font-size:12px"><i class="fa fa-clock-o" aria-hidden="true"></i> ' . $e[2] . '-' . $e[1] . '-' . $e[0] . ' <br><i class="fa fa-map-marker" aria-hidden="true"></i> ' . $ilyaz["il_adi"] . ' / ' . $ilceyaz["county_adi"] . ' / ' . $mahalleyaz["districtname"] . '</span>
        </div>
        <div class="col-xs-2" style="text-align:center; padding:5px"><a href="javascript:void(0)" class="btn btn-danger btn-block price">' . str_replace(",", ".", number_format($row["price"])) . ' ' . $row["exchange"] . '</a></div>
        </div>
        </div>';
        ?>
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">Teslimat ve Fatura</div>
        <div class="panel-body">
          <div class="row">
            <div class="col-xs-12 col-sm-6">
              <div class="panel panel-default">
                <div class="panel-body" style="height:170px">
                  <h3 style="padding:0px !important; margin:0px; font-size:16px; font-weight:bold; border-bottom:solid 1px #ededed; padding-bottom:10px !important; margin-bottom:5px">Teslimat Adresi</h3>
                  <?
                        $uye = $_SESSION["uye"];
                        $sql = $db->query("SELECT * FROM teslimat WHERE siparisId = '$id' ORDER BY Id DESC LIMIT 1");
                        $a = $sql->fetch(PDO::FETCH_ASSOC);
                        if ($a["tip"] == 0){
                        echo '<b>'.$a["adsoyad"].' ( '.$a["tc"].' )</b>';
                        } else {
                        echo '<b>'.$a["firmaadi"].'</b><br>'.$a["vergidairesi"].' / '.$a["vergino"].'';
                        }
                        $il    = $db->query("SELECT * FROM city WHERE id = '{$a['il']}'");
                        $ilyaz = $il->fetch(PDO::FETCH_ASSOC);
                        $ilce    = $db->query("SELECT * FROM county WHERE id = '{$a['ilce']}'");
                        $ilceyaz = $ilce->fetch(PDO::FETCH_ASSOC);

                        $mahalle    = $db->query("SELECT * FROM locality WHERE id = '{$a['mahalle']}'");
                        $mahalleyaz = $mahalle->fetch(PDO::FETCH_ASSOC);

                        echo '<br>'.$a["adres"].'<br> ' . $ilyaz["il_adi"] . ' / ' . $ilceyaz["county_adi"] . ' / ' . $mahalleyaz["districtname"] . '<br>'.$a["telefon"].'';
                        ?>
                </div>
              </div>
            </div>
            <div class="col-xs-12 col-sm-6">
              <div class="panel panel-default">
                <div class="panel-body" style="height:170px">
                  <h3 style="padding:0px !important; margin:0px; font-size:16px; font-weight:bold; border-bottom:solid 1px #ededed; padding-bottom:10px !important; margin-bottom:5px">Fatura Adresi</h3>
                  <?
                        $uye = $_SESSION["uye"];
                        $sql = $db->query("SELECT * FROM fatura WHERE siparisId = '$id' ORDER BY Id DESC LIMIT 1");
                        $a = $sql->fetch(PDO::FETCH_ASSOC);
                        if ($a["tip"] == 0){
                        echo '<b>'.$a["adsoyad"].' ( '.$a["tc"].' )</b>';
                        } else {
                        echo '<b>'.$a["firmaadi"].'</b><br>'.$a["vergidairesi"].' / '.$a["vergino"].'';
                        }
                        $il    = $db->query("SELECT * FROM city WHERE id = '{$a['il']}'");
                        $ilyaz = $il->fetch(PDO::FETCH_ASSOC);
                        $ilce    = $db->query("SELECT * FROM county WHERE id = '{$a['ilce']}'");
                        $ilceyaz = $ilce->fetch(PDO::FETCH_ASSOC);

                        $mahalle    = $db->query("SELECT * FROM locality WHERE id = '{$a['mahalle']}'");
                        $mahalleyaz = $mahalle->fetch(PDO::FETCH_ASSOC);

                        echo '<br>'.$a["adres"].'<br> ' . $ilyaz["il_adi"] . ' / ' . $ilceyaz["county_adi"] . ' / ' . $mahalleyaz["districtname"] . '<br>'.$a["telefon"].'';
                        ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
    function sor()
    {
        if (confirm("Kargo bilgisi girmek istediğinize eminmisiniz ?")) {
            return true;
        } else {
            return false;
        }
    }
</script>