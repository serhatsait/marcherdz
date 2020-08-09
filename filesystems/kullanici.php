<?
function sayac($id)
{
global $db;
$bugun = date("Y-m-d");
$sql   = $db->query("SELECT Id FROM ilanlar WHERE (category1 = '$id' or category2 = '$id' or category3 = '$id' or category4 = '$id' or category5 = '$id' or category6 = '$id' or category7 = '$id' or category8 = '$id' or category9 = '$id' or category10 = '$id') and (bitis >= '$bugun') and (confirm = '1')");
return $sql->rowCount();
}
?>
<style type="text/css">
@media (max-width:768px){
.col-xs-8{
margin-left: 35px;
}
.price{
margin-left: 35px;
}
}
</style>
<div class="container top15">
    <div class="row no-gutter">
        <?
        $id = $_GET["id"];
        $sql = $db->query("SELECT * FROM users WHERE Id = '$id'");
        $a = $sql->fetch(PDO::FETCH_ASSOC);
        ?>
        
            <div class="panel panel-default">
                <div class="panel-heading"><? echo $a["ad_soyad"]; ?> Kullanıcının İlanları</div>
                <div class="panel-body">
                    <div class="row no-gutter">
                        <div class="col-xs-8">
                            <div class="btn-group" role="group" aria-label="..."> <a href="filesystems/list.php?id=1" class="btn btn-default"><i class="glyphicon glyphicon-th-list"></i> Liste</a> <a href="filesystems/list.php?id=2" class="btn btn-default"><i class="glyphicon glyphicon-th"></i> Galeri</a> </div>
                        </div>
                    </div>
                    <hr>
                    <?

                    $si_url_query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
                    parse_str($si_url_query, $_GET);
                    if ($_GET["order"] == 1) {
                    $order1 = "Id";
                    $order2 = "DESC";
                    } elseif ($_GET["order"] == 2) {
                    $order1 = "Id";
                    $order2 = "ASC";
                    } elseif ($_GET["order"] == 3) {
                    $order1 = "price";
                    $order2 = "DESC";
                    } elseif ($_GET["order"] == 4) {
                    $order1 = "price";
                    $order2 = "ASC";
                    } else {
                    $order1 = "Id";
                    $order2 = "DESC";
                    }
                    $bugun = date("Y-m-d");
                    $sqlsor = $db->query("SELECT * FROM ilanlar WHERE (confirm = '1') and (bitis >= '$bugun') and (uyeId = '$id') and firmadi IS NULL  ORDER BY $order1 $order2 ");
                    echo $a["ad_soyad"] ." ait <strong>".$sqlsor->rowCount()."</strong> adet ilan bulundu<br><br>";
                    if ($_SESSION["list"] == 2){ echo '<div class="row no-gutter">'; }
                    while ($row = $sqlsor->fetch(PDO::FETCH_ASSOC)) {
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
                    $bugun      = date("Y-m-d");
                    $doping     = $db->query("SELECT * FROM doping WHERE (ilanId = '{$row['Id']}') and (name = 'kalin') and (onay  = '1') and (val >= '$bugun')");
                    if ($doping->rowCount() == 0) {
                    $class = "";
                    } else {
                    $class = " adv-color";
                    }
                    if ($_SESSION["list"] == "" || $_SESSION["list"] == 1){
                    echo '
                    <div class="adv' . $class . '" onclick="window.location.href=\'i-'.$row["Id"].'-'.slugify($row["title"]).'.html\'" style="cursor:pointer">
                    <div class="row no-gutter">
                    <div class="col-xs-2"><a href="i-'.$row["Id"].'-'.slugify($row["title"]).'.html"><img src="' . $src . '" class="img-thumbnail" width="100" /></a></div>
                    <div class="col-xs-8"><strong style="font-size:14px">' . $row["title"] . '</strong>
                    <br><span style="font-size:12px"><i class="fa fa-clock-o" aria-hidden="true"></i> ' . $e[2] . '-' . $e[1] . '-' . $e[0] . ' <br><i class="fa fa-map-marker" aria-hidden="true"></i> ' . $ilyaz["il_adi"] . ' / ' . $ilceyaz["county_adi"] . ' / ' . $mahalleyaz["districtname"] . '</span>
                    </div>
                    <div class="col-xs-2"><a href="javascript:void(0)" class="btn btn-danger btn-block price">' . str_replace(",", ".", number_format($row["price"])) . ' ' . $row["exchange"] . '</a></div>
                    </div>
                    </div>
                    ';
                    } else {

                    echo '
                    <div class="col-xs-2">
                    <div class="adv2">
                    <div class="image1"><a href="i-'.$row["Id"].'-'.slugify($row["title"]).'.html" alt="'.$row["title"].'" title="'.$row["title"].'"><img src="' . $src . '" height="75"/></a></div>
                    <div class="adv2-title"><a href="i-'.$row["Id"].'-'.slugify($row["title"]).'.html" alt="'.$row["title"].'" title="'.$row["title"].'">' . tr_ucwords(substr($row["title"],0,20)) . '</a></div>
                    </div>
                    </div>';
                    }
                    }
                    if ($_SESSION["list"] == 2){ echo '</div>'; }

                    ?>
                </div></div>
        </div>
    </div>
