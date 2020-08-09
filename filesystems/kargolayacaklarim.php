<?
if ($_SESSION["uye"] == ""){ header("location: /login/"); }
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
                <div class="panel-heading">Kargolayacaklarım</div>
                <div class="panel-body">
                    <?
                    $uye = $_SESSION["uye"];
                    $sql = $db->query("SELECT * FROM siparisler WHERE satici = '$uye' and durum = '0' ORDER BY Id DESC");
                    if ($sql->rowCount() == 0){
                    echo '<div class="alert alert-danger" style="margin-bottom:0px !important"><strong>Uyarı:</strong> Kargolanacak satışınız bulunmamaktadır</div>';
                    } else {
                    ?>
                    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" style="font-size:12px">
                        <thead>
                            <tr>
                                <th class="hidden-xs" width="100" style="text-align:center !important">Tarih</th>
                                <th width="150" style="text-align:center !important">Alıcı</th>
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
                            $durum = "Kargo Bilgisi Girmeniz Bekleniyor";
                            } elseif ($a["durum"] == 1){
                            $durum = "Alıcının Kargoya Onay Vermesi Bekleniyor";
                            } elseif ($a["durum"] == 2){
                            $durum = "Alıcı Kargoya Onay Verdi. Ödemeniz Hesabınıza Aktarılacaktır";
                            } elseif ($a["durum"] == 3){
                            $durum = "Ödemeniz Hesabınıza Gönderildi";
                            }
                            $sql2 = $db->query("SELECT * FROM users WHERE Id = '{$a['alici']}'");
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
                            <li><a href="index.php?page=siparis&id='.$a["Id"].'">Siparişi Görüntüle</a></li>';
                            if ($a["durum"] == 0){
                            echo '<li><a href="index.php?page=kargo&id='.$a["Id"].'">Kargo Bilgisi Gir</a></li>';
                            }
                            echo '
                            <li><a href="index.php?page=mesajgonder2&lock=1&id='.$a["ilanId"].'">Alıcıya Mesaj Gönder</a></li>
                            </ul>
                            </div>
                            </td>
                            </tr>
                            ';
                            }
                            ?>
                        </tbody></table>
                    <? } ?>
                </div>
            </div>
        </div>
    </div>
</div>
