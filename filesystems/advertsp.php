<?
if ($_GET["err"] == ""){ $err = ""; } else {
$err = '<div class="alert alert-success"><strong>Uyarı!</strong> İlan güncellendi</div>';	
}
?>
<div class="container top15">
<? echo $err; ?>
    <div class="row no-gutter">
        <div class="col-xs-12 col-sm-3"><div class="panel panel-default">
                <div class="panel-heading">İlanlar</div>
                <div class="panel-body">
                    <?php include 'adverts_menu.php'; ?>
                </div></div></div>

        <div class="col-xs-12 col-sm-9">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-hand-paper-o" aria-hidden="true"></i> Onay Bekleyen İlanlar</div>
                <div class="panel-body">
                    <?php

                    function fark_bul($tarih1, $tarih2, $ayrac) {
                        list($y1, $a1, $g1) = explode($ayrac, $tarih1);
                        list($y2, $a2, $g2) = explode($ayrac, $tarih2);
                        $t1_timestamp = mktime('0', '0', '0', $a1, $g1, $y1);
                        $t2_timestamp = mktime('0', '0', '0', $a2, $g2, $y2);
                        if ($t1_timestamp > $t2_timestamp) {
                            $result = ($t1_timestamp - $t2_timestamp) / 86400;
                        } else if ($t2_timestamp > $t1_timestamp) {
                            $result = ($t2_timestamp - $t1_timestamp) / 86400;
                        }
                        return $result;
                    }

                    $uye = $_SESSION["uye"];
                    $bugun = date("Y-m-d");
                    $sql = $db->query("SELECT * FROM ilanlar WHERE (uyeId = '$uye' and confirm = '0') ORDER BY Id DESC");
                    if ($sql->rowCount() == 0) {
                        echo '<div class="alert alert-danger" style="margin-bottom:0px !important"><strong>Uyarı:</strong> Onay Bekleyen ilanınız bulunmamaktadır</div>';
                    }
                    while ($a = $sql->fetch(PDO::FETCH_ASSOC)) {
                        $sql2 = $db->query("SELECT * FROM images WHERE ilanId = '{$a[Id]}' ORDER BY s ASC LIMIT 1");
                        $b = $sql2->fetch(PDO::FETCH_ASSOC);
                        if ($sql2->rowCount() == 0) {
                            $b["name"] = "no.png";
                        }
						if ($a["firmadi"] != ""){
						$a["title"] = $a["firmadi"];
						}
                        $yayin = explode("-", $a["dates"]);
                        $gun = fark_bul($bugun, $a["bitis"], '-');
                        echo '
                        <div class = "row" >
                        <div class = "hidden-xs col-sm-2"><img src = "' . $base_url . 'fileserver/files/' . $a["Id"] . '/thumbnail/' . $b["name"] . '" width = "100%" style="padding:5px; border:solid 1px #ededed" /></div>
                        <div class = "col-xs-12 col-sm-10">
						<b>' . $a["title"] . '</b><br><span style="font-size:11px"><b>Eklenme Tarihi :</b> ' . $yayin[2] . '-' . $yayin[1] . '-' . $yayin[0] . ' <b>Kalan Süre :</b> Onay Bekliyor</span><div style = "padding-top:5px"><a href = "'; if ($a["firmadi"] != ""){ echo 'firma'; } else { echo 'i'; } echo '-' . $a["Id"] . '-' . slugify($a["title"]) . '.html" class = "btn btn-success btn-xs">İlana Git</a> '; if ($a["firmadi"] != ""){ echo '<a href = "index.php?page=add5&id=' . $a["category1"] . '&ilanId=' . $a["Id"] . '" class = "btn btn-success btn-xs" style = "background-color:#337ab7 !important; border-color:#337ab7 !important">Güncelle</a>'; } else { echo '<a href = "index.php?page=guncelle&id=' . $a["category1"] . '&ilanId=' . $a["Id"] . '" class = "btn btn-success btn-xs" style = "background-color:#337ab7 !important; border-color:#337ab7 !important">Güncelle</a>'; } if ($a["firmadi"] == ""){echo ' <a href = "index.php?page=doping&id=' . $a["Id"] . '" class = "btn btn-success btn-xs" style = "background-color:#337ab7 !important; border-color:#337ab7 !important">Doping Yap</a> ';} echo ' <a href = "javascript:void(0)" onclick = "ilansil(' . $a["Id"] . ')" class = "btn btn-success btn-xs" style = "background-color:red!important;
                    border-color:red!important">Sil</a></div></div>

                        </div>
                        <hr>';
                    }
                    ?>
                </div></div>
        </div></div>
</div>