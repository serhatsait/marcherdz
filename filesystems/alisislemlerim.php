<?
if ($_SESSION["uye"] == ""){ header("location: /login/"); }
?>

<div class="container top15">
  <div class="row no-gutter">
    <div class="col-xs-12 col-sm-3">
      <div class="panel panel-default">
        <div class="panel-heading">Alış İşlemleri</div>
        <div class="panel-body">
          <?php include 'alis_menu.php'; ?>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-md-9">
      <div class="panel panel-default">
        <div class="panel-heading">Alış İşlemlerim</div>
        <div class="panel-body">
          <?
                    if ($_GET['s'] == 1){
                    echo '<div class="alert alert-success" style="margin-bottom:0px !important"><strong>Uyarı:</strong> Yorumunuz Kaydedildi</div><br>';
                    }
                    $uye = $_SESSION["uye"];
                    $sql = $db->query("SELECT * FROM siparisler WHERE alici = '$uye' ORDER BY Id DESC");
                    if ($sql->rowCount() == 0){
                    echo '<div class="alert alert-danger" style="margin-bottom:0px !important"><strong>Uyarı:</strong> Alış işleminiz bulunmamaktadır</div>';
                    } else {
                    ?>
          <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" style="font-size:12px">
            <thead>
              <tr>
                <th class="hidden-xs" width="100" style="text-align:center !important">Tarih</th>
                <th width="150" style="text-align:center !important">Satıcı</th>
                <th class="hidden-xs" width="125" style="text-align:center !important">Tutar</th>
                <th style="text-align:center !important">Durum</th>
                <th width="125" style="text-align:center !important"></th>
              </tr>
            </thead>
            <tbody>
              <?
                            while ($a = $sql->fetch(PDO::FETCH_ASSOC)){
                            $t = explode("-",$a["tarih"]);
                            if ($a["durum"] == 0){
                            $durum = "Satıcının kargolaması bekleniyor";
                            } elseif ($a["durum"] == 1){
                            $durum = "Kargoya onay vermeniz bekleniyor";
                            } elseif ($a["durum"] == 2){
                            $durum = "Alım işlemi tamamlandı satıcıya yorum yapabilirsiniz";
                            } elseif ($a["durum"] == 3){
                            $durum = "Alım işlemi tamamlandı satıcıya yorum yapabilirsiniz";
                            }
                            $sql2 = $db->query("SELECT * FROM users WHERE Id = '{$a['satici']}'");
                            $b = $sql2->fetch(PDO::FETCH_ASSOC);
                            echo '
                            <tr>
                            <td class="hidden-xs"><center>'.$t[2].'-'.$t[1].'-'.$t[0].'</center></td>
                            <td><center>'.$b["ad_soyad"].'</center></td>
                            <td class="hidden-xs"><center>'.$a["fiyat"].' TL</center></td>
                            <td><center>'.$durum.'</center></td>
                            <td>
                            <div class="dropdown">
                            <button class="btn btn-danger btn-block dropdown-toggle" style="padding:5px !important; font-size:12px !important" type="button" data-toggle="dropdown">İşlemler <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                            <li><a href="index.php?page=siparis2&id='.$a["Id"].'">Siparişi Görüntüle</a></li>';
                            if ($a["durum"] == 1){
                            echo '<li><a href="index.php?page=kargoonay&id='.$a["Id"].'" onclick="return kr()">Kargoyu Onayla</a></li>';
                            } elseif ($a["durum"] == 2){
                            $sql8 = $db->query("SELECT * FROM yorumlar WHERE siparisId = '{$a['Id']}'");
                            if ($sql8->rowCount() == 0){
                            echo '<li><a href="index.php?page=yorumyap&id='.$a["Id"].'">Satıcıya Yorum Yap</a></li>';
                            }
                            } elseif ($a["durum"] == 3){
                            $sql8 = $db->query("SELECT * FROM yorumlar WHERE siparisId = '{$a['Id']}'");
                            if ($sql8->rowCount() == 0){
                            echo '<li><a href="index.php?page=yorumyap&id='.$a["Id"].'">Satıcıya Yorum Yap</a></li>';
                            }
                            }
                            echo '
                            <li><a href="index.php?page=mesajgonder2&lock=1&id='.$a["ilanId"].'">Satıcıya Mesaj Gönder</a></li>
                            </ul>
                            </div>
                            </td>
                            </tr>
                            ';
                            }
                            ?>
            </tbody>
          </table>
          <? } ?>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
    function kr()
    {
        if (confirm("Kargoyu onaylamak istediğinize eminmisiniz ?")) {
            return true;
        } else {
            return false;
        }
    }
</script>