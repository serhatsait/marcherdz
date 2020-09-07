<?php
if (!defined('access')) {
    exit;
}
$id = $_GET["id"];
$si_url_query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
parse_str($si_url_query, $_GET);
if ($_GET['sayfa'] == "") {
    if ($_GET["daralt"] == 1) {
        $l = $_SERVER[REQUEST_URI] . "&sayfa=1";
    } else {
        $l = $_SERVER[REQUEST_URI] . "?sayfa=1";
    }
    header("location: $l");
}
if ($_GET["order"] == 1) {
    $order1 = "dates";
    $order2 = "DESC";
} elseif ($_GET["order"] == 2) {
    $order1 = "dates";
    $order2 = "ASC";
} elseif ($_GET["order"] == 3) {
    $order1 = "price";
    $order2 = "DESC";
} elseif ($_GET["order"] == 4) {
    $order1 = "price";
    $order2 = "ASC";
} else {
    $order1 = "dates";
    $order2 = "DESC";
}
$sayfada = 24;
$sayfa = $_GET["sayfa"];
?>

<div class="container top15">
    <div class="row no-gutter">
        <div class="col-xs-12 col-sm-3">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-bars" aria-hidden="true"></i> Kategoriler</div>
                <div class="panel-body">
                    <div style="max-height:400px; overflow-y:auto; ">
                        <ul class="notranslate category">
                            <?
                            function sayac($id)
                            {
                            global $db;
                            $bugun = date("Y-m-d");
                            if ($_GET["daralt"] == ""){
                            $sql   = $db->query("SELECT Id FROM ilanlar WHERE (category1 = '$id' or category2 = '$id' or category3 = '$id' or category4 = '$id' or category5 = '$id' or category6 = '$id' or category7 = '$id' or category8 = '$id' or category9 = '$id' or category10 = '$id') and (bitis >= '$bugun') and confirm = '1'");
                            return $sql->rowCount();
                            } else {
                            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                            $ek = "";
                            if ($_GET['il'] != "" || $_GET['il'] != 0) {
                            $v = $_GET["il"];
                            $ek .= " and (city = '$v')";
                            }
                            if ($_GET['ilce'] != "" || $_GET['ilce'] != 0) {
                            $v = $_GET["ilce"];
                            $ek .= " and (districts = '$v') ";
                            }
                            if ($_GET['mahalle'] != "" || $_GET['mahalle'] != 0) {
                            $v = $_GET["mahalle"];
                            $ek .= " and (locality = '$v') ";
                            }
                            if ($_GET['fiyat1'] != "") {
                            if ($_GET['fiyat2'] != "") {
                            $v  = str_replace(".", "", $_GET["fiyat1"]);
                            $v2 = str_replace(".", "", $_GET["fiyat2"]);
                            $ek .= " and (price BETWEEN '$v' AND '$v2') ";
                            }
                            }
                            #################################################################################################################

                            $bugun = date("Y-m-d");
                            $sqlsor = $db->query("SELECT Id FROM ilanlar WHERE (category1 = '$id' or category2 = '$id' or category3 = '$id' or category4 = '$id' or category5 = '$id' or category6 = '$id' or category7 = '$id' or category8 = '$id' or category9 = '$id' or category10 = '$id') and (bitis >= '$bugun') and (confirm = '1') $ek ");


                            $zid   = $z->modul;
                            $i     = 0;
                            $idler = array();
                            while ($sq = $sqlsor->fetch(PDO::FETCH_ASSOC)) {
                            $devam   = "";
                            $sqlsor2 = $db->query("SELECT * FROM modul_ilan WHERE ilanId = '{$sq['Id']}'");
                            $kacitem = $sqlsor2->rowCount();
                            while ($sq2 = $sqlsor2->fetch(PDO::FETCH_ASSOC)) {
                            $itemId  = $sq2["itemId"];
                            $sqlsor3 = $db->query("SELECT * FROM modulitems WHERE Id = '$itemId'");
                            $sq3     = $sqlsor3->fetch(PDO::FETCH_ASSOC);

                            if ($sq3["classx"] == 1) {
                            if ($_GET['field' . $sq3['Id'] . ''] != "" && $_GET['field' . $sq3['Id'] . '_2'] != "") {
                            if ($sq2["selects"] >= $_GET['field' . $sq3['Id'] . ''] && $sq2["selects"] <= $_GET['field' . $sq3['Id'] . '_2']) {
                            $devam .= 1;
                            } else {
                            $devam .= 0;
                            }
                            } else {
                            $devam .= 1;
                            }

                            } else {
                            if ($_GET['field_' . $sq3['Id'] . ''] != "") {
                            if ($sq2["selects"] == $_GET['field_' . $sq3['Id'] . '']) {
                            $devam .= 1;
                            } else {
                            $devam .= 0;
                            }
                            }
                            }
                            }
                            $konum = strpos($devam, "0");
                            if ($konum === false) {
                            $idler[] = $sq["Id"];
                            }
                            }

                            return count($idler);
                            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                            }

                            }
                            echo '<li class="sub1"><a href="index.php">»  Toutes catégories</span></a></li>';
                            if ($_GET['daralt'] != ""){
                            $urlek = preg_replace("/\/kategori-(.*?)-(.*?).html/", "", $_SERVER['REQUEST_URI']);
                            $urlek = str_replace("?","",$urlek);
                            $urlek = preg_replace("/&sayfa=([0-9])/", "&sayfa=1", $urlek);
                            }
                            $sql = $db->query("SELECT * FROM category WHERE Id = '$id'");
                            $a   = $sql->fetch(PDO::FETCH_OBJ);
                            if ($a->ustkategoriId == 0) {
                            if (sayac($a->Id) != 0){
                            echo '<li class="sub1"><a href="kategori-' . $a->Id . '-' . slugify($a->kategori_adi) . '.html">» ' . $a->kategori_adi . ' <span>( ' . sayac($a->Id) . ' )</span></a></li>';
                            }
                            $sub = 2;
                            } else {
                            $u    = $a->ustkategoriId;
                            $sql2 = $db->query("SELECT * FROM category WHERE Id = '$u'");
                            $b    = $sql2->fetch(PDO::FETCH_OBJ);
                            if ($b->ustkategoriId == 0) {
                            echo '<li class="sub1"><a href="kategori-' . $b->Id . '-' . slugify($b->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $b->kategori_adi . ' <span>( ' . sayac($b->Id) . ' )</span></a></li>';
                            echo '<li class="sub2"><a href="kategori-' . $a->Id . '-' . slugify($a->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $a->kategori_adi . ' <span>( ' . sayac($a->Id) . ' )</span></a></li>';
                            $sub = 3;
                            } else {
                            $u    = $b->ustkategoriId;
                            $sql3 = $db->query("SELECT * FROM category WHERE Id = '$u'");
                            $c    = $sql3->fetch(PDO::FETCH_OBJ);
                            if ($c->ustkategoriId == 0) {
                            echo '<li class="sub1"><a href="kategori-' . $c->Id . '-' . slugify($c->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $c->kategori_adi . ' <span>( ' . sayac($c->Id) . ' )</span></a></li>';
                            echo '<li class="sub2"><a href="kategori-' . $b->Id . '-' . slugify($b->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $b->kategori_adi . ' <span>( ' . sayac($b->Id) . ' )</span></a></li>';
                            echo '<li class="sub3"><a href="kategori-' . $a->Id . '-' . slugify($a->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $a->kategori_adi . ' <span>( ' . sayac($a->Id) . ' )</span></a></li>';
                            $sub = 4;
                            } else {
                            $u    = $c->ustkategoriId;
                            $sql4 = $db->query("SELECT * FROM category WHERE Id = '$u'");
                            $d    = $sql4->fetch(PDO::FETCH_OBJ);
                            if ($d->ustkategoriId == 0) {
                            echo '<li class="sub1"><a href="kategori-' . $d->Id . '-' . slugify($d->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $d->kategori_adi . ' <span>( ' . sayac($d->Id) . ' )</span></a></li>';
                            echo '<li class="sub2"><a href="kategori-' . $c->Id . '-' . slugify($c->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $c->kategori_adi . ' <span>( ' . sayac($c->Id) . ' )</span></a></li>';
                            echo '<li class="sub3"><a href="kategori-' . $b->Id . '-' . slugify($b->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $b->kategori_adi . ' <span>( ' . sayac($b->Id) . ' )</span></a></li>';
                            echo '<li class="sub4"><a href="kategori-' . $a->Id . '-' . slugify($a->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $a->kategori_adi . ' <span>( ' . sayac($a->Id) . ' )</span></a></li>';
                            $sub = 5;
                            } else {
                            $u    = $d->ustkategoriId;
                            $sql5 = $db->query("SELECT * FROM category WHERE Id = '$u'");
                            $e    = $sql5->fetch(PDO::FETCH_OBJ);
                            if ($e->ustkategoriId == 0) {
                            echo '<li class="sub1"><a href="kategori-' . $e->Id . '-' . slugify($e->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $e->kategori_adi . ' <span>( ' . sayac($e->Id) . ' )</span></a></li>';
                            echo '<li class="sub2"><a href="kategori-' . $d->Id . '-' . slugify($d->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $d->kategori_adi . ' <span>( ' . sayac($d->Id) . ' )</span></a></li>';
                            echo '<li class="sub3"><a href="kategori-' . $c->Id . '-' . slugify($c->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $c->kategori_adi . ' <span>( ' . sayac($c->Id) . ' )</span></a></li>';
                            echo '<li class="sub4"><a href="kategori-' . $b->Id . '-' . slugify($b->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $b->kategori_adi . ' <span>( ' . sayac($b->Id) . ' )</span></a></li>';
                            echo '<li class="sub5"><a href="kategori-' . $a->Id . '-' . slugify($a->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $a->kategori_adi . ' <span>( ' . sayac($a->Id) . ' )</span></a></li>';
                            $sub = 6;
                            } else {
                            $u    = $e->ustkategoriId;
                            $sql6 = $db->query("SELECT * FROM category WHERE Id = '$u'");
                            $f    = $sql6->fetch(PDO::FETCH_OBJ);
                            if ($f->ustkategoriId == 0) {
                            echo '<li class="sub1"><a href="kategori-' . $f->Id . '-' . slugify($f->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $f->kategori_adi . ' <span>( ' . sayac($f->Id) . ' )</span></a></li>';
                            echo '<li class="sub2"><a href="kategori-' . $e->Id . '-' . slugify($e->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $e->kategori_adi . ' <span>( ' . sayac($e->Id) . ' )</span></a></li>';
                            echo '<li class="sub3"><a href="kategori-' . $d->Id . '-' . slugify($d->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $d->kategori_adi . ' <span>( ' . sayac($d->Id) . ' )</span></a></li>';
                            echo '<li class="sub4"><a href="kategori-' . $c->Id . '-' . slugify($c->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $c->kategori_adi . ' <span>( ' . sayac($c->Id) . ' )</span></a></li>';
                            echo '<li class="sub5"><a href="kategori-' . $b->Id . '-' . slugify($b->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $b->kategori_adi . ' <span>( ' . sayac($b->Id) . ' )</span></a></li>';
                            echo '<li class="sub6"><a href="kategori-' . $a->Id . '-' . slugify($a->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $a->kategori_adi . ' <span>( ' . sayac($a->Id) . ' )</span></a></li>';
                            $sub = 7;
                            } else {
                            $u    = $f->ustkategoriId;
                            $sql7 = $db->query("SELECT * FROM category WHERE Id = '$u'");
                            $g    = $sql7->fetch(PDO::FETCH_OBJ);
                            echo '<li class="sub1"><a href="kategori-' . $g->Id . '-' . slugify($g->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $g->kategori_adi . ' <span>( ' . sayac($g->Id) . ' )</span></a></li>';
                            echo '<li class="sub2"><a href="kategori-' . $f->Id . '-' . slugify($f->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $f->kategori_adi . ' <span>( ' . sayac($f->Id) . ' )</span></a></li>';
                            echo '<li class="sub3"><a href="kategori-' . $e->Id . '-' . slugify($e->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $e->kategori_adi . ' <span>( ' . sayac($e->Id) . ' )</span></a></li>';
                            echo '<li class="sub4"><a href="kategori-' . $d->Id . '-' . slugify($d->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $d->kategori_adi . ' <span>( ' . sayac($d->Id) . ' )</span></a></li>';
                            echo '<li class="sub5"><a href="kategori-' . $c->Id . '-' . slugify($c->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $c->kategori_adi . ' <span>( ' . sayac($c->Id) . ' )</span></a></li>';
                            echo '<li class="sub6"><a href="kategori-' . $b->Id . '-' . slugify($b->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $b->kategori_adi . ' <span>( ' . sayac($b->Id) . ' )</span></a></li>';
                            echo '<li class="sub7"><a href="kategori-' . $a->Id . '-' . slugify($a->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $a->kategori_adi . ' <span>( ' . sayac($a->Id) . ' )</span></a></li>';
                            $sub = 8;
                            }
                            }
                            }
                            }
                            }
                            }
                            $sql = $db->query("SELECT * FROM category WHERE ustkategoriId = '$id' ORDER BY Id ASC");
                            while ($a = $sql->fetch(PDO::FETCH_OBJ)) {
                            echo '<li class="sub' . $sub . '"><a href="kategori-' . $a->Id . '-' . slugify($a->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $a->kategori_adi . ' <span>( ' . sayac($a->Id) . ' )</span></a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="hidden-xs panel panel-default" id="lef">
                <div class="panel-heading"><i class="fa fa-filter" aria-hidden="true"></i> Arama Daraltma</div>
                <div class="panel-body">
                    <?
                    $sql = $db->query("SELECT * FROM category WHERE Id = '$id'");
                    $z = $sql->fetch(PDO::FETCH_OBJ);
                    ?>
                    <form action="kategori-<? echo $id; ?>-<? echo slugify($z->kategori_adi); ?>.html" method="get">
                        <div class="form-group">
                            <label>İl :</label>
                            <select name="il" id="il" class="form-control il" onchange="districts()" data-role="none" >
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
                        <div class="form-group">
                            <label>İlçe :</label>
                            <select name="ilce" id="ilce" class="form-control ilce" onchange="localitys()" data-role="none">
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
                        <div class="form-group">
                            <label>Mahalle :</label>
                            <select name="mahalle" id="locality" class="form-control mahalle"  data-role="none" >
                                <option value="">Tümü</option>
                                <?php
                                $ilce = $_GET['ilce'];
                                $sql2 = $db->query("SELECT * FROM locality WHERE countyId = '$ilce' ORDER BY districtname ASC");
                                while ($ix = $sql2->fetch(PDO::FETCH_OBJ)) {
                                    echo '<option value="' . $ix->id . '"';
                                    if ($_GET['mahalle'] == $ix->id) {
                                        echo ' selected="select"';
                                    }
                                    echo '>' . $ix->districtname . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="select">
                            <label class="qlabel">Fiyat</label>
                            <div class="row no-gutter">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <input type="text" name="fiyat1" value="<? echo $_GET["fiyat1"]; ?>" class="form-control money" placeholder="minimum">
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <input type="text" name="fiyat2" class="form-control money" placeholder="maksimum" value="<? echo $_GET["fiyat2"]; ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <?
                $sqlm     = $db->query("SELECT * FROM category WHERE Id = '$id'");
                $m        = $sqlm->fetch(PDO::FETCH_ASSOC);
                $modul    = $m["modul"];
                $moduller = "";
                $sqls     = $db->query("SELECT * FROM modulitems WHERE modulsId = '$modul'");
                while ($mm = $sqls->fetch(PDO::FETCH_OBJ)) {
                if ($mm->classx == 1) {
                echo '<div class="select"><label class="qlabel">' . $mm->name . '</label><div class="row no-gutter"><div class="col-xs-6"><div class="form-group"><input type="number" name="field' . $mm->Id . '" value="' . $_GET['field' . $mm->Id . ''] . '" class="form-control" placeholder="minimum"></div></div><div class="col-xs-6"><div class="form-group"><input type="number" name="field' . $mm->Id . '_2" class="form-control" placeholder="maksimum" value="' . $_GET['field' . $mm->Id . '_2'] . '"></div></div></div></div>';
                } else {
                echo '<div class="select"><label class="qlabel">' . $mm->name . '</label>
                <select class="form-control se" name="field_' . $mm->Id . '" data-style="btn-primary" data-live-search="true" title="Tümü" data-selected-text-format="count">';
                $k     = $mm->Id;
                $sqlsx = $db->query("SELECT * FROM modulitemsselect WHERE itemId = '$k'");
                while ($s = $sqlsx->fetch(PDO::FETCH_OBJ)) {
                echo '<option value="' . $s->Id . '" ';
                if ($_GET['field_' . $mm->Id . ''] == $s->Id) {
                echo ' selected';
                }
                echo '>' . $s->name . '</option>';
                }

                echo '</select></div>';
                }

                }
                ?>
                <input type="hidden" name="daralt" id="daralt" value="1">
                    <button type="submit" class="btn btn-default btn-block button1" style="margin-left:0px !important; margin-top:10px">Aramayı Daralt</button>
            </form>
        </div>
    </div>
</div>
<?
####################################################################################

if ($_GET['daralt'] == "") {
echo "";
$bugun  = date("Y-m-d");
$say = $db->query("SELECT * FROM ilanlar WHERE (category1 = '$id' or category2 = '$id' or category3 = '$id' or category4 = '$id' or category5 = '$id' or category6 = '$id' or category7 = '$id' or category8 = '$id' or category9 = '$id' or category10 = '$id') and (bitis >= '$bugun') and confirm = '1' ORDER BY $order1 $order2");
$toplam = $say->rowCount();
$toplam_sayfa = ceil($toplam / $sayfada);
if($sayfa < 1) $sayfa = 1;
if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa;
$limit = ($sayfa - 1) * $sayfada;

$sqlsor = $db->query("SELECT * FROM ilanlar WHERE (category1 = '$id' or category2 = '$id' or category3 = '$id' or category4 = '$id' or category5 = '$id' or category6 = '$id' or category7 = '$id' or category8 = '$id' or category9 = '$id' or category10 = '$id') and (bitis >= '$bugun') and confirm = '1' ORDER BY $order1 $order2");
echo '<script> sonuc('.$toplam.'); </script>';
} else {
#################################################################################################################
$ek = "";
if ($_GET['il'] != "" || $_GET['il'] != 0) {
$v = $_GET["il"];
$ek .= " and (city = '$v')";
}
if ($_GET['ilce'] != "" || $_GET['ilce'] != 0) {
$v = $_GET["ilce"];
$ek .= " and (districts = '$v') ";
}
if ($_GET['mahalle'] != "" || $_GET['mahalle'] != 0) {
$v = $_GET["mahalle"];
$ek .= " and (locality = '$v') ";
}
if ($_GET['fiyat1'] != "") {
if ($_GET['fiyat2'] != "") {
$v  = str_replace(".", "", $_GET["fiyat1"]);
$v2 = str_replace(".", "", $_GET["fiyat2"]);
$ek .= " and (price BETWEEN '$v' AND '$v2') ";
}
}
#################################################################################################################


$sqlsor = $db->query("SELECT Id FROM ilanlar WHERE (category1 = '$id' or category2 = '$id' or category3 = '$id' or category4 = '$id' or category5 = '$id' or category6 = '$id' or category7 = '$id' or category8 = '$id' or category9 = '$id' or category10 = '$id') and (bitis >= '$bugun') and (confirm = '1') $ek ORDER BY $order1 $order2");


$zid   = $z->modul;
$i     = 0;
$idler = array();
while ($sq = $sqlsor->fetch(PDO::FETCH_ASSOC)) {
$devam   = "";
$sqlsor2 = $db->query("SELECT * FROM modul_ilan WHERE ilanId = '{$sq['Id']}'");
$kacitem = $sqlsor2->rowCount();
while ($sq2 = $sqlsor2->fetch(PDO::FETCH_ASSOC)) {
$itemId  = $sq2["itemId"];
$sqlsor3 = $db->query("SELECT * FROM modulitems WHERE Id = '$itemId'");
$sq3     = $sqlsor3->fetch(PDO::FETCH_ASSOC);

if ($sq3["classx"] == 1) {
if ($_GET['field' . $sq3['Id'] . ''] != "" && $_GET['field' . $sq3['Id'] . '_2'] != "") {
if ($sq2["selects"] >= $_GET['field' . $sq3['Id'] . ''] && $sq2["selects"] <= $_GET['field' . $sq3['Id'] . '_2']) {
$devam .= 1;
} else {
$devam .= 0;
}
} else {
$devam .= 1;
}

} else {
if ($_GET['field_' . $sq3['Id'] . ''] != "") {
if ($sq2["selects"] == $_GET['field_' . $sq3['Id'] . '']) {
$devam .= 1;
} else {
$devam .= 0;
}
}
}
}
$konum = strpos($devam, "0");
if ($konum === false) {
$idler[] = $sq["Id"];
}
}




$idler2 = $idler;
if (count($idler) == 0) {
echo '<script> sonuc(0); </script>';
} else {
echo '<script> sonuc(' . count($idler) . '); </script>';
$idler  = implode(",", $idler);
$say = $db->query("SELECT * FROM ilanlar WHERE Id IN($idler) ORDER BY $order1 $order2");
$toplam = $say->rowCount();
$toplam_sayfa = ceil($toplam / $sayfada);
if($sayfa < 1) $sayfa = 1;
if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa;
$limit = ($sayfa - 1) * $sayfada;

$sqlsor = $db->query("SELECT * FROM ilanlar WHERE Id IN($idler) ORDER BY $order1 $order2");
}
}

####################################################################################
?>
<script>
function ackapat()
{
	if($("#lef").hasClass("hidden-xs")){
		$("#lef").removeClass("hidden-xs");
	} else {
		$("#lef").addClass("hidden-xs");
	}
}
</script>
<div class="col-xs-12 col-sm-9" style="padding-left:5px;">
<a href="javascript:ackapat()" style="margin-bottom:2px;" class="btn btn-danger btn-block visible-xs"><i class="fa fa-filter" aria-hidden="true"></i> Aramayı Filtrele</a>
    <div class="panel panel-default">
        <div class="panel-heading"><i class="fa fa-star-o" aria-hidden="true"></i> Kategori Vitrini</div>
        <div class="panel-body">
            <?
            echo '<div class="row no-gutter">';
            while ($row = $sqlsor->fetch(PDO::FETCH_ASSOC)) {
            $bugun = date("Y-m-d");
            $dp = $db->query("SELECT * FROM doping WHERE (ilanId = '{$row['Id']}') and (val >= '$bugun') and (name='kategori') and (onay = '1')");
            if ($dp->rowCount() > 0){
            $resim = $db->query("SELECT * FROM images WHERE ilanId = '{$row['Id']}'");
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

            echo '
            <div class="col-xs-6 col-sm-3 col-md-2">
            <div class="adv2">
            <div class="image1"><a href="i-'.$row["Id"].'-'.slugify($row["title"]).'.html" alt="'.$row["title"].'" title="'.$row["title"].'"><img src="' . $src . '" alt="'.$row["title"].'" width="93" height="75"/></a></div>
			<div class="box_type" style="position: absolute;top: 2px;right:11px;background: rgba(0,0,0,0.5);color: #fff;border-radius: 4px;font-weight:600;font-size: 12px;-webkit-border-bottom-left-radius: 3px;-moz-border-radius-bottomleft: 3px;border-bottom-left-radius: 3px;">'.number_format($row[price]).' '.$row[exchange].'</div>
            <div class="adv2-title" style="font-size:11px;margin-top:-10px;"><a href="i-'.$row["Id"].'-'.slugify($row["title"]).'.html" alt="'.$row["title"].'" title="'.$row["title"].'">' . mb_substr($row["title"],0,11) . '..</a></div>
            </div>
            </div>';
            }
            }
            echo '</div>';
            ?>
        </div></div>

				<?
        ####################################################################################
    
        if ($_GET['daralt'] == "") {
        $bugun  = date("Y-m-d");
        $say = $db->query("SELECT * FROM ilanlar WHERE (category1 = '$id' or category2 = '$id' or category3 = '$id' or category4 = '$id' or category5 = '$id' or category6 = '$id' or category7 = '$id' or category8 = '$id' or category9 = '$id' or category10 = '$id') and (bitis >= '$bugun') and confirm = '1' ORDER BY $order1 $order2");
        $toplam = $say->rowCount();
        $toplam_sayfa = ceil($toplam / $sayfada);
        if($sayfa < 1) $sayfa = 1;
        if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa;
        $limit = ($sayfa - 1) * $sayfada;
    
        $sqlsor = $db->query("SELECT * FROM ilanlar WHERE (category1 = '$id' or category2 = '$id' or category3 = '$id' or category4 = '$id' or category5 = '$id' or category6 = '$id' or category7 = '$id' or category8 = '$id' or category9 = '$id' or category10 = '$id') and (bitis >= '$bugun') and confirm = '1' ORDER BY $order1 $order2 LIMIT $limit,$sayfada");
        echo '<script> sonuc('.$toplam.'); </script>';
        } else {
        #################################################################################################################
        $ek = "";
        if ($_GET['il'] != "" || $_GET['il'] != 0) {
        $v = $_GET["il"];
        $ek .= " and (city = '$v')";
        }
        if ($_GET['ilce'] != "" || $_GET['ilce'] != 0) {
        $v = $_GET["ilce"];
        $ek .= " and (districts = '$v') ";
        }
        if ($_GET['mahalle'] != "" || $_GET['mahalle'] != 0) {
        $v = $_GET["mahalle"];
        $ek .= " and (locality = '$v') ";
        }
        if ($_GET['fiyat1'] != "") {
        if ($_GET['fiyat2'] != "") {
        $v  = str_replace(".", "", $_GET["fiyat1"]);
        $v2 = str_replace(".", "", $_GET["fiyat2"]);
        $ek .= " and (price BETWEEN '$v' AND '$v2') ";
        }
        }
        #################################################################################################################
    
    
        $sqlsor = $db->query("SELECT Id FROM ilanlar WHERE (category1 = '$id' or category2 = '$id' or category3 = '$id' or category4 = '$id' or category5 = '$id' or category6 = '$id' or category7 = '$id' or category8 = '$id' or category9 = '$id' or category10 = '$id') and (bitis >= '$bugun') and (confirm = '1') $ek ORDER BY $order1 $order2");
    
    
        $zid   = $z->modul;
        $i     = 0;
        $idler = array();
        while ($sq = $sqlsor->fetch(PDO::FETCH_ASSOC)) {
        $devam   = "";
        $sqlsor2 = $db->query("SELECT * FROM modul_ilan WHERE ilanId = '{$sq['Id']}'");
        $kacitem = $sqlsor2->rowCount();
        while ($sq2 = $sqlsor2->fetch(PDO::FETCH_ASSOC)) {
        $itemId  = $sq2["itemId"];
        $sqlsor3 = $db->query("SELECT * FROM modulitems WHERE Id = '$itemId'");
        $sq3     = $sqlsor3->fetch(PDO::FETCH_ASSOC);
    
        if ($sq3["classx"] == 1) {
        if ($_GET['field' . $sq3['Id'] . ''] != "" && $_GET['field' . $sq3['Id'] . '_2'] != "") {
        if ($sq2["selects"] >= $_GET['field' . $sq3['Id'] . ''] && $sq2["selects"] <= $_GET['field' . $sq3['Id'] . '_2']) {
        $devam .= 1;
        } else {
        $devam .= 0;
        }
        } else {
        $devam .= 1;
        }
    
        } else {
        if ($_GET['field_' . $sq3['Id'] . ''] != "") {
        if ($sq2["selects"] == $_GET['field_' . $sq3['Id'] . '']) {
        $devam .= 1;
        } else {
        $devam .= 0;
        }
        }
        }
        }
        $konum = strpos($devam, "0");
        if ($konum === false) {
        $idler[] = $sq["Id"];
        }
        }
    
    
    
    
        $idler2 = $idler;
        if (count($idler) == 0) {
        echo '<script> sonuc(0); </script>';
        } else {
        echo '<script> sonuc(' . count($idler) . '); </script>';
        $idler  = implode(",", $idler);
        $say = $db->query("SELECT * FROM ilanlar WHERE Id IN($idler) ORDER BY $order1 $order2");
        $toplam = $say->rowCount();
        $toplam_sayfa = ceil($toplam / $sayfada);
        if($sayfa < 1) $sayfa = 1;
        if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa;
        $limit = ($sayfa - 1) * $sayfada;
    
        $sqlsor = $db->query("SELECT * FROM ilanlar WHERE Id IN($idler) ORDER BY $order1 $order2 LIMIT $limit,$sayfada");
        }
        }
    
        ####################################################################################
        ?>
		<style type="text/css">
@media (max-width:768px){
.col-xs-9{
margin-left:15px;
}
.img-thumbnail {
    display: inline-block;
    width: 55px;
    height: auto;
    padding: 2px;
    line-height: 1.42857143;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 4px;
    -webkit-transition: all .2s ease-in-out;
    -o-transition: all .2s ease-in-out;
    transition: all .2s ease-in-out;

}
} 
.halilliste{
display:none;
}
@media (max-width:768px){
.halilliste{
display:block;
}
} 
</style>
    <div class="panel panel-default">
        <div class="panel-heading"><i class="fa fa-list" aria-hidden="true"></i> Kategoriler / <? echo $z->kategori_adi; ?></div>
        <div class="panel-body">
            <div class="row no-gutter">
                <div class="col-xs-8">
                    <div class="btn-group" role="group" aria-label="..."> <a href="filesystems/list.php?id=1" class="btn btn-default"><i class="glyphicon glyphicon-th-list"></i> Liste</a> <a href="filesystems/list.php?id=2" class="btn btn-default"><i class="glyphicon glyphicon-th"></i> Galeri</a> </div>
                </div>
                <div class="col-xs-4">
                    <select class="form-control" name="order" id="order" onChange="orders()">
                        <option value="<? echo $_SERVER[REQUEST_URI]; ?>&order=1" <? if ($_GET['order'] == 1 && $_GET["order"] == ""){ echo ' selected';} ?>>Tarihe göre ( Önce en yeni)</option>
                        <option value="<? echo $_SERVER[REQUEST_URI]; ?>&order=2" <? if ($_GET['order'] == 2){ echo ' selected';} ?>>Tarihe göre ( Önce en eski)</option>
                        <option value="<? echo $_SERVER[REQUEST_URI]; ?>&order=3" <? if ($_GET['order'] == 3){ echo ' selected';} ?>>Fiyata göre ( Önce en yüksek)</option>
                        <option value="<? echo $_SERVER[REQUEST_URI]; ?>&order=4" <? if ($_GET['order'] == 4){ echo ' selected';} ?>>Fiyata göre ( Önce en düşük)</option>
                    </select>
                </div>
            </div>
            
			<?
			$say22 = $db->query("SELECT * FROM ilanlar WHERE (category1 = '$id' or category2 = '$id' or category3 = '$id' or category4 = '$id' or category5 = '$id' or category6 = '$id' or category7 = '$id' or category8 = '$id' or category9 = '$id' or category10 = '$id') and (bitis >= '$bugun') and confirm = '1' ORDER BY $order1 $order2");
			$toplam22 = $say22->rowCount();
			?>
            <div style="padding:5px;"><center><strong>"<? echo $z->kategori_adi; ?>"</strong> listelemesinde toplam <span><strong><? echo $toplam22; ?></strong></span> adet ilan bulundu<br></center></div>
            <?
				$sqls     = $db->query("SELECT * FROM modulitems WHERE modulsId = '$modul'");
				$mld = 0;
                while ($mm = $sqls->fetch(PDO::FETCH_OBJ)) {
					if ($mm->name == "Kimden" || $mm->name == "kimden"){
						$mld = $mm->Id;
					}
				}
			?>
			<script>
			function sel(e)
			{
				$("#field_<? echo $mld; ?>").val(e);
				$('select[name=field_<? echo $mld; ?>]').val(e).selectpicker('refresh');;
				$( ".button1" ).trigger( "click" );
			}
			</script>
			<?			
			if ($mld > 0){
				echo '<ul class="nav nav-tabs">';
				$k     = $mld;
                $sqlsx = $db->query("SELECT * FROM modulitemsselect WHERE itemId = '$k'");
                while ($s = $sqlsx->fetch(PDO::FETCH_OBJ)) {	
				echo '<li role="presentation" '; if ($_GET['field_'.$k.''] == $s->Id){ echo ' class="active"'; } echo '><a href="#" onclick="sel('.$s->Id.')">'.$s->name.'</a></li>';	
				}
				echo '</ul><br>';
			}
		
            if (count($idler2) == 0) {
            echo '<script> sonuc(0); </script>';
            } else {
            echo '<script> sonuc(' . count($idler2) . '); </script>';
            }

			
            if ($_SESSION["list"] == 2){ echo '<div class="row no-gutter">'; }
			if ($sqlsor == ""){
			$sqlsor = $db->query("SELECT * FROM ilanlar WHERE Id = '88888888888888'");
			}
            while ($row = $sqlsor->fetch(PDO::FETCH_ASSOC)) {
            $resim = $db->query("SELECT * FROM images WHERE ilanId = '{$row['Id']}'");
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
            <div class="col-xs-3 col-sm-2"><a href="i-'.$row["Id"].'-'.slugify($row["title"]).'.html"><img src="' . $src . '" class="img-thumbnail" width="100" /></a></div>
            <div class="col-xs-9 col-sm-8" style="width: 76.66666667%;"><strong style="font-size:13px">' . mb_substr($row["title"],0,40) . '..</strong>&nbsp;&nbsp;&nbsp;<img class="hidden-xs" src="img/maps_icon.png" title="Haritalı İlan"/>&nbsp;&nbsp;<img class="hidden-xs" src="img/streetv.png" title="Sokak Görünümü"/>
			<br><span style="font-size:11px"><i class="fa fa-clock-o" aria-hidden="true"></i> ' . $e[2] . '-' . $e[1] . '-' . $e[0] . ' / <i class="fa fa-map-marker" aria-hidden="true"></i> ' . $ilyaz["il_adi"] . ' / ' . $ilceyaz["county_adi"] . '</span>
			<br><span class="halilliste" style="font-size:11px"><b>Fiyat:</b> <font color="red"><strong>'.number_format($row["price"]).' ' . $row["exchange"] . '</strong></font></span>
			<div class="hidden-xs" style="font-size:12px;margin-top: 2px;">';
			
			$msl = $db->query("SELECT * FROM modulitems WHERE modulsId = '$modul' and goster = '1'");
			while ($mnb = $msl->fetch(PDO::FETCH_ASSOC)){
	
			$sql5 = $db->query("SELECT * FROM modul_ilan WHERE itemId = '{$mnb['Id']}' and ilanId = '{$row['Id']}'");
			$row5 = $sql5->fetch(PDO::FETCH_ASSOC);
			
			
			if ($row5["type"] != 1){
			$sql7 = $db->query("SELECT * FROM  modulitemsselect WHERE Id = '{$row5['selects']}'");
			$row7 = $sql7->fetch(PDO::FETCH_ASSOC);	
			echo '
            <b>'.$mnb["name"].':</b> '.$row7["name"].'&nbsp;<i class="fa fa-ellipsis-v" aria-hidden="true"></i>&nbsp;';
			} else {
			echo '
            <b>'.$mnb["name"].':</b> '.$row5["selects"].'&nbsp;<i class="fa fa-ellipsis-v" aria-hidden="true"></i>&nbsp;';
			
			}	
			}
			echo '</div></div>
            <div class="col-xs-6 col-sm-3 col-md-2 hidden-xs" style=""><a href="javascript:void(0)" class="btn btn-danger btn-block price">'; if ($row["type"] == 1 || $row["type"] == 2){ echo 'Get İlan';} else { echo '' . str_replace(",", ".", number_format($row["price"])) . ' ' . $row["exchange"] . ''; }echo '</a></div>
            
			</div>
            </div>
            ';
            } else {

            echo '
            <div class="col-xs-6 col-sm-3 col-md-2">
            <div class="adv2">
            <div class="image1"><a href="i-'.$row["Id"].'-'.slugify($row["title"]).'.html" alt="'.$row["title"].'" title="'.$row["title"].'"><img src="' . $src . '" width="93" height="75"/></a></div>
			<div class="box_type" style="position: absolute;top: 2px;right:11px;background: rgba(0,0,0,0.5);color: #fff;border-radius: 4px;font-weight:600;font-size: 12px;-webkit-border-bottom-left-radius: 3px;-moz-border-radius-bottomleft: 3px;border-bottom-left-radius: 3px;">'.number_format($row[price]).' '.$row[exchange].'</div>
            <div class="adv2-title" style="font-size:11px;margin-top:-10px;"><a href="i-'.$row["Id"].'-'.slugify($row["title"]).'.html" alt="'.$row["title"].'" title="'.$row["title"].'">' . ucfirst(mb_substr($row["title"],0,12)) . '..</a></div>
            
			</div>
            </div>';
            }
            }
            if ($_SESSION["list"] == 2){ echo '</div>'; }
			if ($toplam != 0){
            echo '<ul class="pagination">';
            $goruntulenen = $_SERVER[REQUEST_URI];
            $sayfa_goster = 11;
            $en_az_orta = ceil($sayfa_goster/2);
            $en_fazla_orta = ($toplam_sayfa+1) - $en_az_orta;
            $sayfa_orta = $sayfa;
            if($sayfa_orta < $en_az_orta) $sayfa_orta = $en_az_orta;
            if($sayfa_orta > $en_fazla_orta) $sayfa_orta = $en_fazla_orta;
            $sol_sayfalar = round($sayfa_orta - (($sayfa_goster-1) / 2));
            $sag_sayfalar = round((($sayfa_goster-1) / 2) + $sayfa_orta);
            if($sol_sayfalar < 1) $sol_sayfalar = 1;
            if($sag_sayfalar > $toplam_sayfa) $sag_sayfalar = $toplam_sayfa;

            if($sayfa != 1) echo '<li><a href="'.$goruntulenen.'&sayfa='.($sayfa-1).'">&lt; Önceki</a></li>';

            for($s = $sol_sayfalar; $s <= $sag_sayfalar; $s++) {
            if($sayfa == $s) {
            echo '<li class="active"><a href="'.$goruntulenen.'&sayfa='.$s.'">' . $s . '</a></li>';
            } else {
            echo '<li><a href="'.$goruntulenen.'&sayfa='.$s.'">'.$s.'</a><li>';
            }
            }

            if($sayfa != $toplam_sayfa) echo '<li><a href="'.$goruntulenen.'&sayfa='.($sayfa+1).'">Sonraki &gt;</a></li>';
            echo '</ul>';
			}
            ?>
        </div>
    </div>
    <div style="margin-top:10px; margin-bottom:10px"><? echo banner(4); ?></div>
</div>
</div>
</div>