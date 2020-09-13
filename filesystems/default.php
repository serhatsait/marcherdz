<? if (!defined('access')) {
    exit;
}
function sayac($id)
{
    global $db;
    $bugun = date("Y-m-d");
    $sql = $db->query("SELECT Id FROM ilanlar WHERE (category1 = '$id' or category2 = '$id' or category3 = '$id' or category4 = '$id' or category5 = '$id' or category6 = '$id' or category7 = '$id' or category8 = '$id' or category9 = '$id' or category10 = '$id') and (bitis >= '$bugun') and confirm = '1'");
    return $sql->rowCount();
}

$sql = $db->query("SELECT * FROM vitrinlimitleri");
$a32 = $sql->fetch(PDO::FETCH_ASSOC);
$populerilanlar = $a32["populerilanlar"];
$anasayfavitrini = $a32["anasayfavitrini"];
$acilvitrin = $a32["acilvitrin"];
$soneklenenilanlar = $a32["soneklenenilanlar"];
$getilanlar = $a32["getilanlar"];
$firmalar = $a32["firmalar"];
$magazalar = $a32["magazalar"];
function TeknodizaynSayac()
{
    include 'config.php';
    try {
        $db = new PDO('mysql:host=localhost;dbname=' . $MysqlDbName, $MysqlDbUserName, $MysqlDbUserPass);
    } catch (PDOException $v) {
        echo 'Bağlantı Başarısız: ' . $v->getMessage();
    }
    // Veri tabanı bağlantımızı yaptık
    $bugun = date("d"); // bugünün tarihi
    $ay = date("m"); // bu ay
    $yil = date("Y"); // bu yıl
    $timeoutseconds = 2000;
    $timestamp = time();
    $onlineSuresi = $timestamp - $timeoutseconds;
    $ip = $_SERVER['REMOTE_ADDR']; // ziyaretçinin ip si
    $bugunGiris = $db->query("SELECT * FROM hit WHERE ip='$ip' AND gun='$bugun'")->rowCount(); // bugün o ip ile girilmişmi
    if ($bugunGiris != 0) { // yani bugün girilmişse
        $al = $db->query("SELECT * FROM hit WHERE ip='" . $ip . "' AND gun='" . $bugun . "'")->fetch();
        $guncelle = $db->query("UPDATE hit SET sayac='" . ($al['sayac'] + 1) . "', simdi='" . time() . "' WHERE id='" . $al['id'] . "'"); // çoğulu 1 artırdık
    } else { // griş yapılmamışsa kaydettirelim
        $db->query("INSERT INTO hit SET gun='$bugun', ay='$ay', yil='$yil', simdi='" . time() . "', sayac='1',ip='$ip'");
    }
    // evet sıra geldi online, tekil ve çoğulu Göstermeye
    // online Kişi
    $online = $db->query("SELECT * FROM hit WHERE simdi>='$onlineSuresi'")->rowCount(); // onlnie kişilerimiz
    // çoğul hitler
    $bugunx = $db->query("SELECT SUM(sayac) FROM hit WHERE gun='$bugun' AND ay='$ay' AND yil='$yil' ORDER BY id desc")->fetch();
    $bugun_cogul = $bugunx['SUM(sayac)']; // bugün çoğul
    $dunx = $db->query("SELECT SUM(sayac) FROM hit WHERE gun='" . ($bugun - 1) . "' AND ay='$ay' AND yil='$yil' ORDER BY id desc")->fetch();
    $dun_cogul = $dunx['SUM(sayac)']; // dün Çoğul
    $ayx = $db->query("SELECT SUM(sayac) FROM hit WHERE ay='$ay' AND yil='$yil' ORDER BY id desc")->fetch();
    $buay_cogul = $ayx['SUM(sayac)']; // bu ay çoğul
    $toplamx = $db->query("SELECT SUM(sayac) FROM hit ORDER BY id desc")->fetch();
    $toplam_cogul = $toplamx['SUM(sayac)']; // toplam çoğulumuz
    // tekil hitler
    $bugun_tekil = $db->query("SELECT * FROM hit WHERE gun='$bugun' AND ay='$ay' AND yil='$yil'")->rowCount(); // bugün tekil
    $dun_tekil = $db->query("SELECT * FROM hit WHERE gun='" . ($bugun - 1) . "' AND ay='$ay' AND yil='$yil'")->rowCount(); // dün tekil
    $buay_tekil = $db->query("SELECT * FROM hit WHERE ay='$ay' AND yil='$yil'")->rowCount(); // dün tekil
    $toplam_tekil = $db->query("SELECT * FROM hit")->rowCount(); // dün tekil

}

TeknodizaynSayac();
?>

<div class="container top15">
    <div class="row">
        <div class="col-sm-3 hidden-xs">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-list" aria-hidden="true"></i>Catégories</div>
                <div class="panel-body">
                    <b>
                        <div class="subcat_special">
                            <i class="fa fa-bell-o" style="color: #20568a;" aria-hidden="true"></i> <a
                                    href="<?php echo $base_url; ?>acil-ilanlar.html?sayfa=1" style="color:#545454"
                                    class="cat_text">Dernières publications</a>
                            <div style="clear:both"></div>
                        </div>
                        <div class="subcat_special">
                            <i class="fa fa-thumbs-down" style="color: #20568a;" aria-hidden="true"></i> <a
                                    href="<?php echo $base_url; ?>fiyati-dusenler.html" style="color:#545454"
                                    class="cat_text">Prix ​​réduit</a>
                            <div style="clear:both"></div>
                        </div>
                        <div class="subcat_special">
                            <i class="fa fa-shopping-cart" style="color: #20568a;" aria-hidden="true"></i> <a
                                    href="<?php echo $base_url; ?>get-ilanlar.html" style="color:#545454"
                                    class="cat_text">Annonces e-commerce sécurisées</a>
                            <div style="clear:both"></div>
                        </div>
                        <div class="subcat_special">
                            <i class="fa fa-globe" style="color: #20568a;" aria-hidden="true"></i> <a
                                    href="<?php echo $base_url; ?>haritali-ilanlar.html" style="color:#545454"
                                    class="cat_text">Annonces avec carte</a>
                            <div style="clear:both"></div>
                        </div>
                        <div class="subcat_special">
                            <i class="fa fa-building" style="color: #20568a;" aria-hidden="true"></i> <a
                                    href="<?php echo $base_url; ?>rehber.html?sayfa=1" style="color:#545454"
                                    class="cat_text">Annuaire de l'entreprise</a>
                            <div style="clear:both"></div>
                        </div>
                        <div class="subcat_special">
                            <i class="fa fa-clock-o" style="color: #20568a;" aria-hidden="true"></i> <a
                                    href="<?php echo $base_url; ?>son-48-saat.html" style="color:#545454"
                                    class="cat_text">Son 48 Saat</a> / <a href="/son-1-hafta.html" style="color:#545454"
                                                                          class="cat_text">1 Hafta</a> / <a
                                    href="/son-1-ay.html" style="color:#545454" class="cat_text">1 Ay</a>
                            <div style="clear:both"></div>
                        </div>
                        <div class="subcat_special">
                            <i class="fa fa-briefcase" style="color: #20568a;" aria-hidden="true"></i> <a
                                    href="<?php echo $base_url; ?>magazalar.html" style="color:#545454"
                                    class="cat_text">Mağazalar</a>
                            <div style="clear:both"></div>
                        </div>
                    </b>

                    <br>
                    <ul class="notranslate category">
                        <?

                        $sql = $db->query("SELECT * FROM category WHERE ustkategoriId = '0' and tip = '0' ORDER BY sira ASC");
                        while ($a = $sql->fetch(PDO::FETCH_OBJ)) {

                            echo '<li class="maincat"><img src="' . $base_url . 'ikonlar/' . $a->ikon . '" alt="' . $a->kategori_adi . '" width="20" height="20" class="absmiddle" /> <b>' . $a->kategori_adi . '</b></li>';
                            $ust = $a->Id;
                            $sql2 = $db->query("SELECT * FROM category WHERE ustkategoriId = '$ust'");
                            while ($b = $sql2->fetch(PDO::FETCH_OBJ)) {
                                echo '<li><a href="kategori-' . $b->Id . '-' . slugify($b->kategori_adi) . '.html">' . $b->kategori_adi . ' <span>( ' . sayac($b->Id) . ' )</span></a></li>';
                            }

                        }
                        ?>
                    </ul>

                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-9" style="padding-left:5px;">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->


                <div class="carousel-inner">
                    <?
                    $sql = $db->query("SELECT * FROM slider ORDER BY Id DESC");
                    $i = 0;
                    while ($a = $sql->fetch(PDO::FETCH_ASSOC)) {
                        if ($i == 0) {
                            $c = "active";
                        } else {
                            $c = "";
                        }
                        echo '
	  <div class="item ' . $c . '"> <a href="' . $a["url"] . '"><img src="' . $base_url . '/uploads/' . $a["adi"] . '" alt="' . $a["adi"] . '"></a></div>
	  ';
                        $i++;
                    }
                    ?>
                </div>
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>


            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-star" aria-hidden="true"></i> Vitrine<span
                            class="pull-right"><a href="anasayfa-ilanlari.html">Voir tout</a></span></div>
                <div class="panel-body">
                    <div class="row no-gutter son-eklenen">
                        <?
                        $bugun = date("Y-m-d");
                        $doping = $db->query("SELECT * FROM doping WHERE (name = 'anasayfa') and (onay  = '1') and (val >= '$bugun')");
                        while ($a = $doping->fetch(PDO::FETCH_ASSOC)) {
                            $idler [] = $a["ilanId"];
                        }
                        if (count($idler) > 0) {
                            $idler = implode(",", $idler);
                            $sqlsor = $db->query("SELECT * FROM ilanlar WHERE Id IN($idler) and (bitis >= '$bugun') and confirm = '1' ORDER BY Id DESC LIMIT $anasayfavitrini");
                            while ($row = $sqlsor->fetch(PDO::FETCH_ASSOC)) {
                                $resim = $db->query("SELECT * FROM images WHERE ilanId = '{$row['Id']}' ORDER BY s ASC LIMIT 1");
                                if ($resim->rowCount() == 0) {
                                    $src = "img/no.png";
                                } else {
                                    $r = $resim->fetch(PDO::FETCH_ASSOC);
                                    $src = $base_url . "fileserver/files/" . $row["Id"] . "/thumbnail/" . $r["name"];
                                }
                                if ($row["price"] == "0") {

                                    echo '
                        <div class="col-xs-6 col-sm-3 col-md-2">
                        <div class="adv2">
                                    <div class="image1">
                                    <a href="i-' . $row["Id"] . '-' . slugify($row["title"]) . '.html" alt="' . $row["title"] . '" title="' . $row["title"] . '"> 
                                    <div class="acil-box">
                                    <img src="' . $src . '" width="93" height="75" alt="' . $row["title"] . '"/>
                                    <div class="box_type" style="position: absolute;top: 2px;right:11px;background: rgba(0,0,0,0.5);color: #fff;border-radius: 4px;font-weight:600;font-size: 12px;-webkit-border-bottom-left-radius: 3px;-moz-border-radius-bottomleft: 3px;border-bottom-left-radius: 3px;">' . number_format($row[price]) . ' ' . $row[exchange] . '</div>
                                    </div>
                                    </a>
                                    </div>

                        <div class="adv2-title" style="font-size:11px;margin-top:-10px;"><a href="i-' . $row["Id"] . '-' . slugify($row["title"]) . '.html" alt="' . $row["title"] . '" title="' . $row["title"] . '">' . ucfirst(mb_substr($row["title"], 0, 12)) . '</a></div>
                        </div>
                        </div>';

                                } else {


                                    echo '
                        <div class="col-xs-6 col-sm-3 col-md-2">
                        <div class="adv2">
                                    <div class="image1">
                                    <a href="i-' . $row["Id"] . '-' . slugify($row["title"]) . '.html" alt="' . $row["title"] . '" title="' . $row["title"] . '"> <div class="acil-box"><img src="' . $src . '" width="93" height="75" alt=""/><div class="box_type" style="position: absolute;top: 2px;right:11px;background: rgba(0,0,0,0.5);color: #fff;border-radius: 4px;font-weight:600;font-size: 12px;-webkit-border-bottom-left-radius: 3px;-moz-border-radius-bottomleft: 3px;border-bottom-left-radius: 3px;">' . number_format($row[price]) . ' ' . $row[exchange] . '</div></div></a></div>

                        <div class="adv2-title" style="font-size:11px;margin-top:-10px;"><a href="i-' . $row["Id"] . '-' . slugify($row["title"]) . '.html" alt="' . $row["title"] . '" title="' . $row["title"] . '">' . ucfirst(mb_substr($row["title"], 0, 12)) . '..</a></div>
                        </div>
                        </div>';
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div style="margin-top:10px; margin-bottom:10px"><? echo banner(1); ?></div>

            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-clock-o" aria-hidden="true"></i> Dernières annonces ajoutées</div>
                <div class="panel-body">
                    <div class="row no-gutter">
                        <?
                        $bugun = date("Y-m-d");
                        $sqlsor = $db->query("SELECT * FROM ilanlar WHERE (bitis >= '$bugun') and confirm = '1' and firmadi IS NULL ORDER BY Id DESC LIMIT $soneklenenilanlar");
                        while ($row = $sqlsor->fetch(PDO::FETCH_ASSOC)) {
                            $resim = $db->query("SELECT * FROM images WHERE ilanId = '{$row['Id']}' ORDER BY s ASC LIMIT 1");
                            if ($resim->rowCount() == 0) {
                                $src = "img/no.png";
                            } else {
                                $r = $resim->fetch(PDO::FETCH_ASSOC);
                                $src = $base_url . "fileserver/files/" . $row["Id"] . "/thumbnail/" . $r["name"];
                            }
                            if ($row["price"] == "0") {

                                echo '
                        <div class="col-xs-6 col-sm-3 col-md-2">
                        <div class="adv2">
                                    <div class="image1">
                                    <a href="i-' . $row["Id"] . '-' . slugify($row["title"]) . '.html" alt="' . $row["title"] . '" title="' . $row["title"] . '"> 
                                    <div class="acil-box">
                                    <div class="son-eklenen-imgs">
                                    <img src="' . $src . '" width="100" height="80" alt=""/>
                                    <div class="box_type" style="position: absolute;top: 2px;right:11px;background: rgba(0,0,0,0.5);color: #fff;border-radius: 4px;font-weight:600;font-size: 12px;-webkit-border-bottom-left-radius: 3px;-moz-border-radius-bottomleft: 3px;border-bottom-left-radius: 3px;">' . number_format($row[price]) . ' ' . $row[exchange] . '</div>
                                    </div>
                                    </div>
                                    </a>
                                    </div>

                        <div class="adv2-title" style="font-size:11px;margin-top:-10px;><a href="i-' . $row["Id"] . '-' . slugify($row["title"]) . '.html" alt="' . $row["title"] . '" title="' . $row["title"] . '">' . ucfirst(mb_substr($row["title"], 0, 12)) . '</a></div>
                        </div>
                        </div>';

                            } else {
                                echo '
                        <div class="col-xs-6 col-sm-3 col-md-2">
                        <div class="adv2">
                                    <div class="image1">
                                    <a href="i-' . $row["Id"] . '-' . slugify($row["title"]) . '.html" alt="' . $row["title"] . '" title="' . $row["title"] . '"> 
                                    <div class="acil-box">
                                    <img src="' . $src . '" width="100" height="80" alt=""/>
                                    <div class="box_type" style="position: absolute;top: 2px;right:11px;background: rgba(0,0,0,0.5);color: #fff;border-radius: 4px;font-weight:600;font-size: 12px;-webkit-border-bottom-left-radius: 3px;-moz-border-radius-bottomleft: 3px;border-bottom-left-radius: 3px;">' . number_format($row[price]) . ' ' . $row[exchange] . '</div>
                                    </div>
                                    </a>
                                    </div>

                        <div class="adv2-title" style="font-size:11px;margin-top:-10px;"><a href="i-' . $row["Id"] . '-' . slugify($row["title"]) . '.html" alt="' . $row["title"] . '" title="' . $row["title"] . '">' . ucfirst(mb_substr($row["title"], 0, 12)) . '..</a></div>
                        </div>
                        </div>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div style="margin-top:10px; margin-bottom:10px"><? echo banner(2); ?></div>


            <style type="text/css">
                @media (max-width: 768px) {
                    .col-sm-6 {
                        margin-left: 50px;
                    }
                }
            </style>

            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-briefcase" aria-hidden="true"></i> Dernières entreprises ajoutées<span
                            class="pull-right"><a href="rehber.html" class="hidden-xs">Voir tout</a></span></div>
                <div class="panel-body">
                    <div class="row no-pad">
                        <?
                        $bugun = date("Y-m-d");
                        $sqlsor = $db->query("SELECT * FROM ilanlar WHERE (confirm = '1')  and firmadi IS NOT NULL ORDER BY Id DESC LIMIT $firmalar");
                        while ($row = $sqlsor->fetch(PDO::FETCH_ASSOC)) {
                            $resim = $db->query("SELECT * FROM images WHERE ilanId = '{$row['Id']}' ORDER BY s ASC LIMIT 1");
                            if ($resim->rowCount() == 0) {
                                $src = "img/no.png";
                            } else {
                                $r = $resim->fetch(PDO::FETCH_ASSOC);
                                $src = $base_url . "fileserver/files/" . $row["Id"] . "/thumbnail/" . $r["name"];
                            }
                            $il = $db->query("SELECT * FROM city WHERE id = '{$row['city']}'");
                            $ilyaz = $il->fetch(PDO::FETCH_ASSOC);
                            $ilce = $db->query("SELECT * FROM county WHERE id = '{$row['districts']}'");
                            $ilceyaz = $ilce->fetch(PDO::FETCH_ASSOC);

                            $mahalle = $db->query("SELECT * FROM locality WHERE id = '{$row['locality']}'");
                            $mahalleyaz = $mahalle->fetch(PDO::FETCH_ASSOC);
                            $e = explode("-", $row["dates"]);
                            echo '
            <div class="adv' . $class . '" onclick="window.location.href=\'firma-' . $row["Id"] . '-' . slugify($row["firmadi"]) . '.html\'" style="cursor:pointer">
            <div class="row no-gutter">
            <div class="col-xs-3 col-sm-2"><a href="firma-' . $row["Id"] . '-' . slugify($row["firmadi"]) . '.html"><img src="' . $src . '" class="img-thumbnail" width="100" alt="' . $row["firmadi"] . '" /></a></div>
            <div class="col-xs-7 col-sm-6"><strong style="font-size:14px">' . $row["firmadi"] . '</strong>
            <br><span style="font-size:12px">' . substr($row["hakkinda"], 0, 190) . '</span>
            <br><div style="font-size:11px">';
                            $msl = $db->query("SELECT * FROM modulitems WHERE modulsId = '$modul' and goster = '1'");
                            while ($mnb = $msl->fetch(PDO::FETCH_ASSOC)) {

                                $sql5 = $db->query("SELECT * FROM modul_ilan WHERE itemId = '{$mnb['Id']}' and ilanId = '{$row['Id']}'");
                                $row5 = $sql5->fetch(PDO::FETCH_ASSOC);


                                if ($row5["type"] != 1) {
                                    $sql7 = $db->query("SELECT * FROM  modulitemsselect WHERE Id = '{$row5['selects']}'");
                                    $row7 = $sql7->fetch(PDO::FETCH_ASSOC);
                                    echo '
            <b>' . $mnb["name"] . ':</b>' . $row7["name"] . '	&nbsp;	&nbsp; <i class="fa fa-ellipsis-v" aria-hidden="true"></i>	&nbsp;	&nbsp;';
                                } else {
                                    echo '
            <b>' . $mnb["name"] . ':</b>' . $row5["selects"] . ' 	&nbsp;	&nbsp; <i class="fa fa-ellipsis-v" aria-hidden="true"></i>	&nbsp;	&nbsp;';

                                }
                            }
                            echo '</div></div>
            <div class="hidden-xs col-sm-4" style="text-align:center; padding:5px; font-size:12px !important; border-left:solid 1px #eee">
			' . $row["fadres"] . '<br>' . $ilyaz["il_adi"] . ' / ' . $ilceyaz["county_adi"] . ' / ' . $mahalleyaz["districtname"] . '<br> <b>' . $row["telefon"] . '</b>
			</div>
            </div>
            </div>
            ';
                        }
                        ?>
                    </div>
                </div>
            </div>


            <div style="margin-top:10px; margin-bottom:10px"><? echo banner(3); ?></div>

            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Magasins récemment ajoutés<span class="pull-right"><a href="magazalar.html"
                                                         class="hidden-xs">Voir tout</a></span></div>
                <div class="panel-body">
                    <div class="row no-gutter">
                        <?
                        $b = str_replace("http://", "", $base_url);
                        $b = rtrim($b, "/");
                        $murl = $SiteName;
                        $bugun = date("Y-m-d");
                        $sql = $db->query("SELECT * FROM magazalar WHERE onay = '1' and bitis >= '$bugun' ORDER BY Id DESC LIMIT $magazalar");
                        while ($a = $sql->fetch(PDO::FETCH_ASSOC)) {
                            if ($a["logo"] == "") {
                                $src = "img/no.png";
                            } else {
                                $src = "uploads/$a[logo]";
                            }
                            echo '
                        <div class="col-xs-6 col-sm-3 col-md-2">
                        <div class="adv2">
                        <div class="image1"><a href="http://' . $a["adres"] . '.' . $murl . '" alt="' . $a["magazaadi"] . '" title="' . $a["magazaadi"] . '"><img src="' . $src . '" alt="' . $a["magazaadi"] . '" width="93" height="75"/></a></div>
						<div class="box_type" style="min-width:60px;text-align: center;bottom: 0;padding: 1px 13px;z-index: 2;color: #000;font-size:12px;">' . tr_ucwords(mb_substr($a["magazaadi"], 0, 9)) . '..</div>
                        </div></div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div style="margin-top:10px; margin-bottom:10px"><? echo banner(4); ?></div>
        </div>
    </div>
</div>


<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Detaylı Arama</h4>
            </div>
            <div class="modal-body">


                <form action="index.php" method="get">
                    <input type="hidden" name="page" value="category">
                    <input type="hidden" name="sayfa" value="1">
                    <input type="hidden" name="daralt" value="1">
                    <div class="row no-pad">
                        <div class="col-xs-6" style="width: 50%;">
                            <div class="form-group">
                                <label>Kategori</label>
                                <select class="form-control" name="id">
                                    <?
                                    $sql = $db->query("SELECT * FROM category WHERE ustkategoriId = '0'");
                                    while ($a = $sql->fetch(PDO::FETCH_ASSOC)) {
                                        echo '<option value="' . $a["Id"] . '">' . $a["kategori_adi"] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-6" style="width: 50%;">
                            <div class="form-group">
                                <label>İl :</label>
                                <select name="il" id="il" class="form-control il" onchange="districts()"
                                        data-role="none">
                                    <option value="">Tümü</option>
                                    <?php
                                    $sql2 = $db->query("SELECT * FROM city ORDER BY il_adi ASC");
                                    while ($i = $sql2->fetch(PDO::FETCH_OBJ)) {
                                        echo '<option value="' . $i->id . '"';
                                        if ($_GET['il'] == $i->id) {
                                            echo ' selected="select"';
                                        }
                                        echo '>' . $i->il_adi . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-6" style="width: 50%;">
                            <div class="form-group">
                                <label>İlçe :</label>
                                <select name="ilce" id="ilce" class="form-control ilce" onchange="localitys()"
                                        data-role="none">
                                    <option value="">Tümü</option>
                                    <?php
                                    $il = $_GET['il'];
                                    $sql2 = $db->query("SELECT * FROM county WHERE il_id = '$il' ORDER BY county_adi ASC");
                                    while ($ix = $sql2->fetch(PDO::FETCH_OBJ)) {
                                        echo '<option value="' . $ix->id . '"';
                                        if ($_GET['ilce'] == $ix->id) {
                                            echo ' selected="select"';
                                        }
                                        echo '>' . $ix->county_adi . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-xs-6" style="width: 50%;">
                            <label class="">Fiyat</label>
                            <div class="row no-gutter">
                                <div class="col-xs-6" style="width: 50%;">
                                    <div class="form-group">
                                        <input type="text" name="fiyat1" value="<? echo $_GET["fiyat1"]; ?>"
                                               class="form-control money" placeholder="minimum">
                                    </div>
                                </div>
                                <div class="col-xs-6" style="width: 50%;">
                                    <div class="form-group">
                                        <input type="text" name="fiyat2" class="form-control money"
                                               placeholder="maksimum" value="<? echo $_GET["fiyat2"]; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-1"><input type="submit" style="width:565px;margin-bottom:7px;"
                                                     class="btn btn-danger" value="Aramaya Başla"></div>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>