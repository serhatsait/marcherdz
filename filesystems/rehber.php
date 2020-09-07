<?php
if (!defined('access')) {
    exit;
}
$id = $_GET["id"];
if ($id == ""){ $id = 0; }
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
$sayfada = 24;
$sayfa = $_GET["sayfa"];
?>

<div class="container top15">
    <div class="row no-gutter">
        <div class="hidden-xs col-xs-12 col-sm-3" id="lef">
            <div class="panel panel-default">
                <div class="panel-heading">Kategoriler</div>
                <div class="panel-body">
                    <div style="max-height:400px; overflow-y:auto; ">
                        <ul class="category">
                            <?
                            function sayac($id)
                            {
                            global $db;
                            $bugun = date("Y-m-d");
                            if ($_GET["daralt"] == ""){
                            $sql   = $db->query("SELECT Id FROM ilanlar WHERE (category1 = '$id' or category2 = '$id' or category3 = '$id' or category4 = '$id' or category5 = '$id' or category6 = '$id' or category7 = '$id' or category8 = '$id' or category9 = '$id' or category10 = '$id') and confirm = '1'");
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
                            $sqlsor = $db->query("SELECT Id FROM ilanlar WHERE (category1 = '$id' or category2 = '$id' or category3 = '$id' or category4 = '$id' or category5 = '$id' or category6 = '$id' or category7 = '$id' or category8 = '$id' or category9 = '$id' or category10 = '$id') and (confirm = '1') and firmadi IS NOT NULL $ek ");


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
							if ($id != 0){
                            echo '<li class="sub1"><a href="rehber.html">»  Toutes catégories</span></a></li>';
							}
                            if ($_GET['daralt'] != ""){
                            $urlek = preg_replace("/\/c-(.*?)-(.*?).html/", "", $_SERVER['REQUEST_URI']);
                            $urlek = str_replace("?","",$urlek);
                            $urlek = preg_replace("/&sayfa=([0-9])/", "&sayfa=1", $urlek);
                            }
							
                            $sql = $db->query("SELECT * FROM category WHERE Id = '$id' and tip = '1'");
                            $a   = $sql->fetch(PDO::FETCH_OBJ);
                            if ($a->ustkategoriId == 0) {
                            if (sayac($a->Id) != 0){
							if ($id != 0){
                            echo '<li class="sub1"><a href="rehber-' . $a->Id . '-' . slugify($a->kategori_adi) . '.html">» ' . $a->kategori_adi . ' <span>( ' . sayac($a->Id) . ' )</span></a></li>';
                            }
							}
                            $sub = 2;
                            } else {
                            $u    = $a->ustkategoriId;
                            $sql2 = $db->query("SELECT * FROM category WHERE Id = '$u' and tip = '1'");
                            $b    = $sql2->fetch(PDO::FETCH_OBJ);
                            if ($b->ustkategoriId == 0) {
                            echo '<li class="sub1"><a href="rehber-' . $b->Id . '-' . slugify($b->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $b->kategori_adi . ' <span>( ' . sayac($b->Id) . ' )</span></a></li>';
                            echo '<li class="sub2"><a href="rehber-' . $a->Id . '-' . slugify($a->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $a->kategori_adi . ' <span>( ' . sayac($a->Id) . ' )</span></a></li>';
                            $sub = 3;
                            } else {
                            $u    = $b->ustkategoriId;
                            $sql3 = $db->query("SELECT * FROM category WHERE Id = '$u' and tip = '1'");
                            $c    = $sql3->fetch(PDO::FETCH_OBJ);
                            if ($c->ustkategoriId == 0) {
                            echo '<li class="sub1"><a href="rehber-' . $c->Id . '-' . slugify($c->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $c->kategori_adi . ' <span>( ' . sayac($c->Id) . ' )</span></a></li>';
                            echo '<li class="sub2"><a href="rehber-' . $b->Id . '-' . slugify($b->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $b->kategori_adi . ' <span>( ' . sayac($b->Id) . ' )</span></a></li>';
                            echo '<li class="sub3"><a href="rehber-' . $a->Id . '-' . slugify($a->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $a->kategori_adi . ' <span>( ' . sayac($a->Id) . ' )</span></a></li>';
                            $sub = 4;
                            } else {
                            $u    = $c->ustkategoriId;
                            $sql4 = $db->query("SELECT * FROM category WHERE Id = '$u' and tip = '1'");
                            $d    = $sql4->fetch(PDO::FETCH_OBJ);
                            if ($d->ustkategoriId == 0) {
                            echo '<li class="sub1"><a href="rehber-' . $d->Id . '-' . slugify($d->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $d->kategori_adi . ' <span>( ' . sayac($d->Id) . ' )</span></a></li>';
                            echo '<li class="sub2"><a href="rehber-' . $c->Id . '-' . slugify($c->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $c->kategori_adi . ' <span>( ' . sayac($c->Id) . ' )</span></a></li>';
                            echo '<li class="sub3"><a href="rehber-' . $b->Id . '-' . slugify($b->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $b->kategori_adi . ' <span>( ' . sayac($b->Id) . ' )</span></a></li>';
                            echo '<li class="sub4"><a href="rehber-' . $a->Id . '-' . slugify($a->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $a->kategori_adi . ' <span>( ' . sayac($a->Id) . ' )</span></a></li>';
                            $sub = 5;
                            } else {
                            $u    = $d->ustkategoriId;
                            $sql5 = $db->query("SELECT * FROM category WHERE Id = '$u' and tip = '1'");
                            $e    = $sql5->fetch(PDO::FETCH_OBJ);
                            if ($e->ustkategoriId == 0) {
                            echo '<li class="sub1"><a href="rehber-' . $e->Id . '-' . slugify($e->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $e->kategori_adi . ' <span>( ' . sayac($e->Id) . ' )</span></a></li>';
                            echo '<li class="sub2"><a href="rehber-' . $d->Id . '-' . slugify($d->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $d->kategori_adi . ' <span>( ' . sayac($d->Id) . ' )</span></a></li>';
                            echo '<li class="sub3"><a href="rehber-' . $c->Id . '-' . slugify($c->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $c->kategori_adi . ' <span>( ' . sayac($c->Id) . ' )</span></a></li>';
                            echo '<li class="sub4"><a href="rehber-' . $b->Id . '-' . slugify($b->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $b->kategori_adi . ' <span>( ' . sayac($b->Id) . ' )</span></a></li>';
                            echo '<li class="sub5"><a href="rehber-' . $a->Id . '-' . slugify($a->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $a->kategori_adi . ' <span>( ' . sayac($a->Id) . ' )</span></a></li>';
                            $sub = 6;
                            } else {
                            $u    = $e->ustkategoriId;
                            $sql6 = $db->query("SELECT * FROM category WHERE Id = '$u' and tip = '1'");
                            $f    = $sql6->fetch(PDO::FETCH_OBJ);
                            if ($f->ustkategoriId == 0) {
                            echo '<li class="sub1"><a href="rehber-' . $f->Id . '-' . slugify($f->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $f->kategori_adi . ' <span>( ' . sayac($f->Id) . ' )</span></a></li>';
                            echo '<li class="sub2"><a href="rehber-' . $e->Id . '-' . slugify($e->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $e->kategori_adi . ' <span>( ' . sayac($e->Id) . ' )</span></a></li>';
                            echo '<li class="sub3"><a href="rehber-' . $d->Id . '-' . slugify($d->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $d->kategori_adi . ' <span>( ' . sayac($d->Id) . ' )</span></a></li>';
                            echo '<li class="sub4"><a href="rehber-' . $c->Id . '-' . slugify($c->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $c->kategori_adi . ' <span>( ' . sayac($c->Id) . ' )</span></a></li>';
                            echo '<li class="sub5"><a href="rehber-' . $b->Id . '-' . slugify($b->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $b->kategori_adi . ' <span>( ' . sayac($b->Id) . ' )</span></a></li>';
                            echo '<li class="sub6"><a href="rehber-' . $a->Id . '-' . slugify($a->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $a->kategori_adi . ' <span>( ' . sayac($a->Id) . ' )</span></a></li>';
                            $sub = 7;
                            } else {
                            $u    = $f->ustkategoriId;
                            $sql7 = $db->query("SELECT * FROM category WHERE Id = '$u' and tip = '1'");
                            $g    = $sql7->fetch(PDO::FETCH_OBJ);
                            echo '<li class="sub1"><a href="rehber-' . $g->Id . '-' . slugify($g->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $g->kategori_adi . ' <span>( ' . sayac($g->Id) . ' )</span></a></li>';
                            echo '<li class="sub2"><a href="rehber-' . $f->Id . '-' . slugify($f->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $f->kategori_adi . ' <span>( ' . sayac($f->Id) . ' )</span></a></li>';
                            echo '<li class="sub3"><a href="rehber-' . $e->Id . '-' . slugify($e->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $e->kategori_adi . ' <span>( ' . sayac($e->Id) . ' )</span></a></li>';
                            echo '<li class="sub4"><a href="rehber-' . $d->Id . '-' . slugify($d->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $d->kategori_adi . ' <span>( ' . sayac($d->Id) . ' )</span></a></li>';
                            echo '<li class="sub5"><a href="rehber-' . $c->Id . '-' . slugify($c->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $c->kategori_adi . ' <span>( ' . sayac($c->Id) . ' )</span></a></li>';
                            echo '<li class="sub6"><a href="rehber-' . $b->Id . '-' . slugify($b->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $b->kategori_adi . ' <span>( ' . sayac($b->Id) . ' )</span></a></li>';
                            echo '<li class="sub7"><a href="rehber-' . $a->Id . '-' . slugify($a->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $a->kategori_adi . ' <span>( ' . sayac($a->Id) . ' )</span></a></li>';
                            $sub = 8;
                            }
                            }
                            }
                            }
                            }
                            }
                            $sql = $db->query("SELECT * FROM category WHERE ustkategoriId = '$id' and tip = '1' ORDER BY Id ASC");
                            while ($a = $sql->fetch(PDO::FETCH_OBJ)) {
                            echo '<li class="sub' . $sub . '"><a href="rehber-' . $a->Id . '-' . slugify($a->kategori_adi) . '.html'; if ($_GET['daralt'] != ""){ echo '?'.$urlek.''; } echo '">» ' . $a->kategori_adi . ' <span>( ' . sayac($a->Id) . ' )</span></a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Arama Daraltma</div>
                <div class="panel-body">
                    <?
                    $sql = $db->query("SELECT * FROM category WHERE Id = '$id'");
                    $z = $sql->fetch(PDO::FETCH_OBJ);
                    ?>
                    <form action="rehber-<? echo $id; ?>-<? echo slugify($z->kategori_adi); ?>.html" method="get">
                        <div class="form-group">
                            <label>İl :</label>
                            <select name="il" id="il" class="form-control il" onchange="districts2()" >
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
                            <select name="ilce[]" id="ilce" class="form-control ilce se" data-show-subtext="true" data-live-search="true" multiple>
                                <option value="">Tümü</option>
                                <?php
                                $il = $_GET['il'];
                                $sql2 = $db->query("SELECT * FROM county WHERE il_id = '$il' ORDER BY county_adi ASC");
                                while ($ix = $sql2->fetch(PDO::FETCH_OBJ)) {
                                    echo '<option value="' . $ix->id . '"';
                                    foreach ($_GET["ilce"] as $ilx){
									if ($ilx == $ix->id) {
                                        echo ' selected="select"';
                                    }	
									}
									
                                    echo '>' . $ix->county_adi . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group ">
                            <label>Mahalle :</label>
                            <select name="mahalle[]" id="locality" class="form-control mahalle se" data-show-subtext="true" data-live-search="true" multiple >
                                <option value="">Tümü</option>
                                <?php
                                $ilce = $_GET['ilce'];
								if (count($_GET["ilce"]) > 0){
								if (count($_GET["ilce"]) == 1){
								$v = $_GET["ilce"];	
								$ek .= " countyId = '$v[0]'";
								} else {
								$vv = "";
								foreach ($_GET["ilce"] as $ils){
								$vv .= " or countyId = '$ils'";	
								}
								$vv = substr($vv, 4,100);
								$ek .= " $vv ";	
								}
								}
								
								if ($ek != ""){
                                $sql2 = $db->query("SELECT * FROM locality WHERE $ek ORDER BY countyId ASC");
                                while ($ix = $sql2->fetch(PDO::FETCH_OBJ)) {
                                    echo '<option value="' . $ix->id . '"';
                                    if ($_GET['mahalle'] == $ix->id) {
                                        echo ' selected="select"';
                                    }
                                    echo '>' . $ix->districtname . '</option>';
                                }
								}
								$ek = "";
                                ?>
                            </select>
                        </div>
                       
                <?
                $sqlm     = $db->query("SELECT * FROM category WHERE Id = '$id' and tip = '1'");
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
$say = $db->query("SELECT * FROM ilanlar WHERE (category1 = '$id' or category2 = '$id' or category3 = '$id' or category4 = '$id' or category5 = '$id' or category6 = '$id' or category7 = '$id' or category8 = '$id' or category9 = '$id' or category10 = '$id') and (confirm = '1') AND firmadi IS NOT NULL ORDER BY $order1 $order2");
$toplam = $say->rowCount();
$toplam_sayfa = ceil($toplam / $sayfada);
if($sayfa < 1) $sayfa = 1;
if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa;
$limit = ($sayfa - 1) * $sayfada;

$sqlsor = $db->query("SELECT * FROM ilanlar WHERE (category1 = '$id' or category2 = '$id' or category3 = '$id' or category4 = '$id' or category5 = '$id' or category6 = '$id' or category7 = '$id' or category8 = '$id' or category9 = '$id' or category10 = '$id') and (confirm = '1') AND firmadi IS NOT NULL ORDER BY $order1 $order2");
echo '<script> sonuc('.$toplam.'); </script>';
} else {
#################################################################################################################
$ek = "";
if ($_GET['il'] != "" || $_GET['il'] != 0) {
$v = $_GET["il"];
$ek .= " and (city = '$v')";
}
if (count($_GET["ilce"]) > 0){
if (count($_GET["ilce"]) == 1){
$v = $_GET["ilce"];	
$ek .= " and (districts = '$v[0]') ";
} else {
$vv = "";
foreach ($_GET["ilce"] as $ils){
$vv .= " or districts = '$ils'";	
}
$vv = substr($vv, 3,100);
$ek .= " and ($vv) ";	
}
}


if (count($_GET["mahalle"]) > 0){
if (count($_GET["mahalle"]) == 1){
$vx = $_GET["mahalle"];	
$ek .= " and (locality = '$vx[0]') ";
} else {
$vvx = "";
foreach ($_GET["mahalle"] as $ilsx){
$vvx .= " or locality = '$ilsx'";	
}
$vvx = substr($vvx, 3,100);
$ek .= " and ($vvx) ";	
}
}




if ($_GET['fiyat1'] != "") {
if ($_GET['fiyat2'] != "") {
$v  = str_replace(".", "", $_GET["fiyat1"]);
$v2 = str_replace(".", "", $_GET["fiyat2"]);
$ek .= " and (price BETWEEN '$v' AND '$v2') ";
}
}
#################################################################################################################


$sqlsor = $db->query("SELECT Id FROM ilanlar WHERE (category1 = '$id' or category2 = '$id' or category3 = '$id' or category4 = '$id' or category5 = '$id' or category6 = '$id' or category7 = '$id' or category8 = '$id' or category9 = '$id' or category10 = '$id') and (confirm = '1') AND firmadi IS NOT NULL $ek ORDER BY $order1 $order2");


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
$say = $db->query("SELECT * FROM ilanlar WHERE Id IN($idler) AND firmadi IS NOT NULL ORDER BY $order1 $order2");
$toplam = $say->rowCount();
$toplam_sayfa = ceil($toplam / $sayfada);
if($sayfa < 1) $sayfa = 1;
if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa;
$limit = ($sayfa - 1) * $sayfada;

$sqlsor = $db->query("SELECT * FROM ilanlar WHERE Id IN($idler) AND firmadi IS NOT NULL ORDER BY $order1 $order2");
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
<a href="javascript:ackapat()" class="btn btn-danger btn-block visible-xs">Kategori ve Filtreleme</a><br class="visible-xs">

		<?
        ####################################################################################
    
        if ($_GET['daralt'] == "") {
        $bugun  = date("Y-m-d");
        $say = $db->query("SELECT * FROM ilanlar WHERE (category1 = '$id' or category2 = '$id' or category3 = '$id' or category4 = '$id' or category5 = '$id' or category6 = '$id' or category7 = '$id' or category8 = '$id' or category9 = '$id' or category10 = '$id') and (confirm = '1')  AND firmadi IS NOT NULL ORDER BY $order1 $order2");
        $toplam = $say->rowCount();
        $toplam_sayfa = ceil($toplam / $sayfada);
        if($sayfa < 1) $sayfa = 1;
        if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa;
        $limit = ($sayfa - 1) * $sayfada;
    
        $sqlsor = $db->query("SELECT * FROM ilanlar WHERE (category1 = '$id' or category2 = '$id' or category3 = '$id' or category4 = '$id' or category5 = '$id' or category6 = '$id' or category7 = '$id' or category8 = '$id' or category9 = '$id' or category10 = '$id') and (confirm = '1') AND firmadi IS NOT NULL ORDER BY $order1 $order2 LIMIT $limit,$sayfada");
        echo '<script> sonuc('.$toplam.'); </script>';
        } else {
        #################################################################################################################
        $ek = "";
        if ($_GET['il'] != "" || $_GET['il'] != 0) {
        $v = $_GET["il"];
        $ek .= " and (city = '$v')";
        }
        if (count($_GET["ilce"]) > 0){
if (count($_GET["ilce"]) == 1){
$v = $_GET["ilce"];	
$ek .= " and (districts = '$v[0]') ";
} else {
$vv = "";
foreach ($_GET["ilce"] as $ils){
$vv .= " or districts = '$ils'";	
}
$vv = substr($vv, 3,100);
$ek .= " and ($vv) ";	
}
}
if (count($_GET["mahalle"]) > 0){
if (count($_GET["mahalle"]) == 1){
$vx = $_GET["mahalle"];	
$ek .= " and (locality = '$vx[0]') ";
} else {
$vvx = "";
foreach ($_GET["mahalle"] as $ilsx){
$vvx .= " or locality = '$ilsx'";	
}
$vvx = substr($vvx, 3,100);
$ek .= " and ($vvx) ";	
}
}
        if ($_GET['fiyat1'] != "") {
        if ($_GET['fiyat2'] != "") {
        $v  = str_replace(".", "", $_GET["fiyat1"]);
        $v2 = str_replace(".", "", $_GET["fiyat2"]);
        $ek .= " and (price BETWEEN '$v' AND '$v2') ";
        }
        }
        #################################################################################################################
    
    
        $sqlsor = $db->query("SELECT Id FROM ilanlar WHERE (category1 = '$id' or category2 = '$id' or category3 = '$id' or category4 = '$id' or category5 = '$id' or category6 = '$id' or category7 = '$id' or category8 = '$id' or category9 = '$id' or category10 = '$id') and (confirm = '1') $ek ORDER BY $order1 $order2");
    
    
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
        $say = $db->query("SELECT * FROM ilanlar WHERE Id IN($idler) AND firmadi IS NOT NULL ORDER BY $order1 $order2");
        $toplam = $say->rowCount();
        $toplam_sayfa = ceil($toplam / $sayfada);
        if($sayfa < 1) $sayfa = 1;
        if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa;
        $limit = ($sayfa - 1) * $sayfada;
    
        $sqlsor = $db->query("SELECT * FROM ilanlar WHERE Id IN($idler) AND firmadi IS NOT NULL ORDER BY $order1 $order2 LIMIT $limit,$sayfada");
        }
        }
    
        ####################################################################################
        ?>
		<style type="text/css">
@media (max-width:768px){
.col-sm-6{
margin-left:50px;
}
}
</style>
    <div class="panel panel-default">
        <div class="panel-heading">Firma Rehberi / <? echo $z->kategori_adi; ?></div>
        <div class="panel-body">
           
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
			
            echo '
            <div class="adv' . $class . '" onclick="window.location.href=\'firma-'.$row["Id"].'-'.slugify($row["firmadi"]).'.html\'" style="cursor:pointer">
            <div class="row no-gutter">
            <div class="col-xs-3 col-sm-2"><a href="firma-'.$row["Id"].'-'.slugify($row["firmadi"]).'.html"><img src="' . $src . '" class="img-thumbnail" width="100" /></a></div>
            <div class="col-xs-7 col-sm-6"><strong style="font-size:14px">' . $row["firmadi"] . '</strong>
            <br><span style="font-size:12px">'.substr($row["hakkinda"],0,190).'</span>
            <br><div style="font-size:11px">';
			$msl = $db->query("SELECT * FROM modulitems WHERE modulsId = '$modul' and goster = '1'");
			while ($mnb = $msl->fetch(PDO::FETCH_ASSOC)){
	
			$sql5 = $db->query("SELECT * FROM modul_ilan WHERE itemId = '{$mnb['Id']}' and ilanId = '{$row['Id']}'");
			$row5 = $sql5->fetch(PDO::FETCH_ASSOC);
			
			
			if ($row5["type"] != 1){
			$sql7 = $db->query("SELECT * FROM  modulitemsselect WHERE Id = '{$row5['selects']}'");
			$row7 = $sql7->fetch(PDO::FETCH_ASSOC);	
			echo '
            <b>'.$mnb["name"].':</b>'.$row7["name"].'	&nbsp;	&nbsp; <i class="fa fa-ellipsis-v" aria-hidden="true"></i>	&nbsp;	&nbsp;';
			} else {
			echo '
            <b>'.$mnb["name"].':</b>'.$row5["selects"].' 	&nbsp;	&nbsp; <i class="fa fa-ellipsis-v" aria-hidden="true"></i>	&nbsp;	&nbsp;';

			}	
			}
			echo '</div></div>
            <div class="hidden-xs col-sm-4" style="text-align:center; padding:5px; font-size:12px !important; border-left:solid 1px #eee">
			'.$row["fadres"].'<br>' . $ilyaz["il_adi"] . ' / ' . $ilceyaz["county_adi"] . ' / ' . $mahalleyaz["districtname"] . '<br> <b>'.$row["telefon"].'</b>
			</div>
            </div>
            </div>
            ';
            
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
