<?
if ($_GET['id'] != ""){
$uye = $_SESSION["uye"];
$id = $_GET["id"];
$id = $_GET['id'];
$sql2 = $db->prepare("DELETE FROM favori WHERE ilanId = '{$id}' and uyeId = '$uye'");
$sql2->execute();
}
?>
<div class="container top15">
    <div class="row no-gutter">

        <div class="col-xs-12 col-sm-3"><div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-list" aria-hidden="true"></i> İlanlar</div>
                <div class="panel-body">
                    <?php include 'adverts_menu.php'; ?>
                </div></div></div>

        <div class="col-xs-12 col-sm-9">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-heart" aria-hidden="true"></i> Favori İlanlarım</div>
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
                    $idler = array();
                    $sql = $db->query("SELECT * FROM favori WHERE uyeId = '$uye'");
                    while ($a = $sql->fetch(PDO::FETCH_ASSOC)) {
                        $idler[] = $a["ilanId"];
                    }
                    if (count($idler) > 0) {
                        $idler = implode(",", $idler);
                    } else {
                        $idler = "999999999999999999999999999999";
                    }
                    $sql = $db->query("SELECT * FROM ilanlar WHERE (Id IN($idler) and confirm = '1') and (bitis >= '$bugun') AND firmadi IS NULL");
                    if ($sql->rowCount() == 0) {
                        echo '<div class="alert alert-danger" style="margin-bottom:0px !important"><strong>Uyarı:</strong> Favori ilanınız bulunmamaktadır</div>';
                    }
                    while ($a = $sql->fetch(PDO::FETCH_ASSOC)) {
                        $sql2 = $db->query("SELECT * FROM images WHERE ilanId = '{$a[Id]}' ORDER BY s ASC LIMIT 1");
                        $b = $sql2->fetch(PDO::FETCH_ASSOC);
                        if ($sql2->rowCount() == 0) {
                            $b["name"] = "no.png";
                        }
                        $yayin = explode("-", $a["dates"]);
                        $gun = fark_bul($bugun, $a["bitis"], '-');
                        echo '
                        <div class = "row" >
                        <div class = "hidden-xs col-sm-2"><img src = "' . $base_url . 'fileserver/files/' . $a["Id"] . '/thumbnail/' . $b["name"] . '" width = "100%" style="padding:5px; border:solid 1px #ededed" /></div>
                        <div class = "col-xs-12 col-sm-10">
						<b>' . $a["title"] . '</b><br><span style="font-size:11px"><b>Eklenme Tarihi :</b> ' . $yayin[2] . '-' . $yayin[1] . '-' . $yayin[0] . ' <b>Kalan Süre :</b> ' . $gun . ' Gün</span><div style = "padding-top:5px"><a href = "i-' . $a["Id"] . '-' . slugify($a["title"]) . '.html" class = "btn btn-success btn-xs">İlana Git</a> <a href = "index.php?page=favoriilanlarim&id=' . $a["Id"] . '" onclick = "return favorisil(' . $a["Id"] . ')" class = "btn btn-success btn-xs" style = "background-color:red!important;
                    border-color:red!important">Sil</a></div></div>

                        </div>
                        <hr>';
                    }
                    ?>
                </div></div>
        </div></div>
</div>
<script>
    function favorisil() {
        if (confirm("İlanı favorilerinizden kaldırmak istediğinize eminmisiniz ?")) {
            return true;
        } else {
            return false;
        }
    }
</script>