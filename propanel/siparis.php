<?
$id = $_GET["id"];
$sql = $db->query("SELECT * FROM siparisler WHERE Id = '$id'");
$a = $sql->fetch(PDO::FETCH_ASSOC);

$sql2 = $db->query("SELECT * FROM users WHERE Id = '{$a['alici']}'");
$b = $sql2->fetch(PDO::FETCH_ASSOC);
$sql3 = $db->query("SELECT * FROM users WHERE Id = '{$a['satici']}'");
$c = $sql3->fetch(PDO::FETCH_ASSOC);
?>
<section class="content-header">
  <h1> GET İşlemleri<small>Sipariş Bilgileri</small> </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Page d'accueil</a></li>
    <li>GET İşlemleri</li>
    <li class="active">Sipariş Bilgileri</li>
  </ol>
</section>
<section class="content">
  <div class="panel panel-default box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Sipariş Bilgileri</h3>
    </div>
    <div class="panel-body">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
            <td width="175">Tarih</td>
            <td>: <? echo $a["tarih"]; ?></td>
          </tr>
          <?
                            echo '
                            <tr>
                            <td width="175">Alıcı</td>
                            <td>: <a href="index.php?page=uye&id='.$b['Id'].'">'.$b["ad_soyad"].'</a></td>
                            </tr>
                            ';
                            echo '
                            <tr>
                            <td width="175">Satıcı</td>
                            <td>: <a href="index.php?page=uye&id='.$c['Id'].'">'.$c["ad_soyad"].'</a></td>
                            </tr>
                            ';
		?>
          <tr>
            <td width="175">Tutar</td>
            <td>: <? echo $a["fiyat"]; ?> TL</td>
          </tr>
          <?
                            $uye = $_SESSION['uye'];
                            if ($a["satici"] == $uye){
                            echo '
                            <tr>
                            <td width="175">Hesaba Aktarılacak Tutar</td>
                            <td>: '.$a["aktarilacaktutar"].' TL</td>
                            </tr>';
                            }
                            if ($a["satici"] == $uye){
                            if ($a["durum"] == 0){
                            $durum = "Kargo Bilgisi Bekleniyor";
                            } elseif ($a["durum"] == 1){
                            $durum = "Alıcının Kargoya Onay Vermesi Bekleniyor";
                            } elseif ($a["durum"] == 2){
                            $durum = "Ödeme Bekliyor";
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
  <? if ($a["durum"] > 0){ ?>
  <div class="panel panel-default box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Kargo Bilgileri</h3>
    </div>
    <div class="panel-body">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
            <td width="175">Kargo Tarihi</td>
            <td>: <? echo $a["kargotarihi"]; ?></td>
          </tr>
          <tr>
            <td width="175">Kargo Adı</td>
            <td>: <? echo $a["kargoadi"]; ?></td>
          </tr>
          <tr>
            <td width="175">Kargo Takip No</td>
            <td>: <? echo $a["takipno"]; ?></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <? } ?>
  <div class="panel panel-default box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Ürün</h3>
    </div>
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
                    <div class="col-xs-1"><img src="' . $src . '" class="img-thumbnail" width="100" /></div>
                    <div class="col-xs-9"><strong style="font-size:14px">' . $row["title"] . '</strong>
                    <br><span style="font-size:12px"><i class="fa fa-clock-o" aria-hidden="true"></i> ' . $e[2] . '-' . $e[1] . '-' . $e[0] . ' <br><i class="fa fa-map-marker" aria-hidden="true"></i> ' . $ilyaz["il_adi"] . ' / ' . $ilceyaz["county_adi"] . ' / ' . $mahalleyaz["districtname"] . '</span>
                    </div>
                    <div class="col-xs-2" style="text-align:center; padding:5px"><a href="javascript:void(0)" class="btn btn-danger btn-block price">' . str_replace(",", ".", number_format($row["price"])) . ' ' . $row["exchange"] . '</a></div>
                    </div>
                    </div>';
                    ?>
    </div>
  </div>
  <div class="panel panel-default box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Teslimat ve Fatura</h3>
    </div>
    <div class="panel-body">
      <div class="row">
        <div class="col-xs-6">
          <div class="panel panel-default">
            <div class="panel-body" style="height:170px">
              <h3 style="padding:0px !important; margin:0px; font-size:16px; font-weight:bold; border-bottom:solid 1px #ededed; padding-bottom:10px !important; margin-bottom:5px">Teslimat Adresi</h3>
              <?
                                    $uye = $_SESSION["uye"];
                                    $sql = $db->query("SELECT * FROM teslimat WHERE siparisId = '$id' ORDER BY Id DESC LIMIT 1");
                                    $a = $sql->fetch(PDO::FETCH_ASSOC);
                                   
                                    echo '<b>'.$a["adsoyad"].' / TC No: '.$a["tc"].'</b>';
                                   
                                    
                                   
                                    $il    = $db->query("SELECT * FROM city WHERE id = '{$a['il']}'");
                                    $ilyaz = $il->fetch(PDO::FETCH_ASSOC);
                                    $ilce    = $db->query("SELECT * FROM county WHERE id = '{$a['ilce']}'");
                                    $ilceyaz = $ilce->fetch(PDO::FETCH_ASSOC);

                                    $mahalle    = $db->query("SELECT * FROM locality WHERE id = '{$a['mahalle']}'");
                                    $mahalleyaz = $mahalle->fetch(PDO::FETCH_ASSOC);

                                    echo '<br>Adres: '.$a["adres"].'<br> ' . $ilyaz["il_adi"] . ' / ' . $ilceyaz["county_adi"] . ' / ' . $mahalleyaz["districtname"] . '<br>'.$a["telefon"].'';
                                    ?>
            </div>
          </div>
        </div>
        <div class="col-xs-6">
          <div class="panel panel-default">
            <div class="panel-body" style="height:170px">
              <h3 style="padding:0px !important; margin:0px; font-size:16px; font-weight:bold; border-bottom:solid 1px #ededed; padding-bottom:10px !important; margin-bottom:5px">Fatura Adresi</h3>
              <?
                                    $uye = $_SESSION["uye"];
                                    $sql = $db->query("SELECT * FROM fatura WHERE siparisId = '$id' ORDER BY Id DESC LIMIT 1");
                                    $a = $sql->fetch(PDO::FETCH_ASSOC);
                                    
                                    echo '<b>'.$a["adsoyad"].' / TC No: '.$a["tc"].'</b>';
                                   
                                    echo '<br><b>'.$a["firmaadi"].'</b><br>'.$a["vergidairesi"].' / '.$a["vergino"].'';
                                    
                                    $il    = $db->query("SELECT * FROM city WHERE id = '{$a['il']}'");
                                    $ilyaz = $il->fetch(PDO::FETCH_ASSOC);
                                    $ilce    = $db->query("SELECT * FROM county WHERE id = '{$a['ilce']}'");
                                    $ilceyaz = $ilce->fetch(PDO::FETCH_ASSOC);

                                    $mahalle    = $db->query("SELECT * FROM locality WHERE id = '{$a['mahalle']}'");
                                    $mahalleyaz = $mahalle->fetch(PDO::FETCH_ASSOC);

                                    echo '<br>Adres: '.$a["adres"].'<br> ' . $ilyaz["il_adi"] . ' / ' . $ilceyaz["county_adi"] . ' / ' . $mahalleyaz["districtname"] . '<br>'.$a["telefon"].'';
                                    ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
