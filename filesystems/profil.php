<?
$id = $_GET["id"];
$sql8 = $db->query("SELECT * FROM users WHERE Id = '{$id}'");
$row8 = $sql8->fetch(PDO::FETCH_ASSOC);
$sql2 = $db->query("SELECT * FROM siparisler WHERE satici = '$id' and (durum = '2' or durum = '3')");
$toplam = $sql2->rowCount();
$olumsuz = 0;
$olumlu = 0;
$kararsiz = 0;
while ($b = $sql2->fetch(PDO::FETCH_ASSOC)){
$sql3 = $db->query("SELECT * FROM yorumlar WHERE siparisId = '{$b['Id']}'");
$c = $sql3->fetch(PDO::FETCH_ASSOC);
if ($c["sonuc"] == "0"){
$olumsuz++;
} elseif ($c["sonuc"] == "1"){
$olumlu++;
} elseif ($c["sonuc"] == "2"){
$kararsiz++;
}
}
?>

<div class="container top15">
    <div class="row no-gutter">
        <div class="col-xs-12 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-user" aria-hidden="true"></i> Kullanıcı Profili</div>
                <div class="panel-body"><strong><? echo $row8["ad_soyad"]; ?></strong> adlı kullanıcı gerçekleştirdiği <? echo $toplam; ?> adet işlem içerisinde;
                    <hr style="margin-top:5px !important; margin-bottom:5px !important">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td width="30" height="40"  style="border:solid 1px #ededed; padding:5px"><img src="img/yorum_pozitif.gif" width="24" height="24" alt=""/></td>
                        <td width="140" height="40"  style="border:solid 1px #ededed; padding:5px">Olumlu Yorumlar</td>
                        <td  style="border:solid 1px #ededed; padding:5px"><? echo $olumlu; ?></td>
                        </tr>
                        <tr>
                            <td width="30" height="40"  style="border:solid 1px #ededed; padding:5px"><img src="img/yorum_notr.gif" width="24" height="24" alt=""/></td>
                        <td height="40"  style="border:solid 1px #ededed; padding:5px">Kararsız Yorumlar</td>
                        <td  style="border:solid 1px #ededed; padding:5px"><? echo $kararsiz; ?></td>
                        </tr>
                        <tr>
                            <td width="30" height="40"  style="border:solid 1px #ededed; padding:5px"><img src="img/yorum_negatif.gif" width="24" height="24" alt=""/></td>
                        <td height="40"  style="border:solid 1px #ededed; padding:5px">Olumsuz Yorumlar</td>
                        <td  style="border:solid 1px #ededed; padding:5px"><? echo $olumsuz; ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-comments-o" aria-hidden="true"></i> Aldığı Yorumlar</div>
                <div class="panel-body">
                    <?
                    $sql2 = $db->query("SELECT * FROM siparisler WHERE satici = '$id' and (durum = '2' or durum = '3')");
                    while ($b = $sql2->fetch(PDO::FETCH_ASSOC)){
                    $sql3 = $db->query("SELECT * FROM yorumlar WHERE siparisId = '{$b['Id']}'");
                    $c = $sql3->fetch(PDO::FETCH_ASSOC);
                    $sql4 = $db->query("SELECT * FROM users WHERE Id = '{$c['alici']}'");
                    $d = $sql4->fetch(PDO::FETCH_ASSOC);
                    echo '<strong>'.$d["ad_soyad"].'</strong><hr style="margin-bottom:5px; margin-top:5px">'.$c["yorum"].'';
                    }
                    ?>
                </div>
            </div>
        </div>
        <?

        $sql9 = $db->query("SELECT * FROM magazalar WHERE uyeId = '{$id}'");
        $a9 = $sql9->fetch(PDO::FETCH_ASSOC);
        $b = str_replace("http://","",$base_url);
        $b = rtrim($b,"/");
		$murl = $SiteName;
        ?>
        <div class="col-xs-12 col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-user" aria-hidden="true"></i> Kullanıcı Profili</div>
                <div class="panel-body">
                    <div class="userbox"><strong style="font-size:16px"><? echo $row8["ad_soyad"]; ?></strong> <br>
                        <?
                        if ($sql9->rowCount() > 0){
                        if ($a9["logo"] == ""){
                        } else {
                        echo '<br><a href="http://'.$a9["adres"].'.'.$murl.'"><img src="uploads/'.$a9["logo"].'" width="100%"></a><br>';
                        }
                        }
                        ?>
                        <br>
                        <? if ($sql9->rowCount() > 0){ ?>
                        <a href="http://<? echo $a9["adres"]; ?>.<? echo $murl; ?>" class="btn btn-default btn-block" style="border-color:#ededed !important; text-align:left !important"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Mağazaya Git</a>
                        <? } ?>
                        <a href="index.php?page=profil&id=<? echo $row8["Id"]; ?>" class="btn btn-default btn-block" style="border-color:#ededed !important; text-align:left !important"><i class="fa fa-balance-scale" aria-hidden="true"></i> Kullanıcının Profili</a></div>
                    <br>
                    </div>
            </div>
        </div>
    </div>
</div>
