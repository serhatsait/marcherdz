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
        <div class="hidden-xs col-sm-3">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-list" aria-hidden="true"></i>Catégories</div>
                <div class="panel-body">

                    <?
                    $bugun = date("Y-m-d");
                    $dp = $db->query("SELECT * FROM doping WHERE  (category1 = '$id' or category2 = '$id' or category3 = '$id' or category4 = '$id' or category5 = '$id' or category6 = '$id' or category7 = '$id' or category8 = '$id' or category9 = '$id' or category10 = '$id') and ( name='acil') and (onay = '1') and val >= '$bugun'");
                    while ($dpp = $dp->fetch(PDO::FETCH_ASSOC)) {
                        $lid [] = $dpp["ilanId"];
                    }
                    if (count($lid) > 0) {
                        $ex = implode(",", $lid);
                        $ek2 = " and Id IN($ex)";
                    }

                    function sayac($id)
                    {
                        global $db;
                        global $ek2;
                        $bugun = date("Y-m-d");
                        if ($_GET["daralt"] == "") {
                            $sql = $db->query("SELECT Id FROM ilanlar WHERE (category1 = '$id' or category2 = '$id' or category3 = '$id' or category4 = '$id' or category5 = '$id' or category6 = '$id' or category7 = '$id' or category8 = '$id' or category9 = '$id' or category10 = '$id') and (bitis >= '$bugun') and (confirm = '1') $ek2");
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
                                    $v = str_replace(".", "", $_GET["fiyat1"]);
                                    $v2 = str_replace(".", "", $_GET["fiyat2"]);
                                    $ek .= " and (price BETWEEN '$v' AND '$v2') ";
                                }
                            }
                            #################################################################################################################

                            $bugun = date("Y-m-d");
                            $sqlsor = $db->query("SELECT Id FROM ilanlar WHERE (category1 = '$id' or category2 = '$id' or category3 = '$id' or category4 = '$id' or category5 = '$id' or category6 = '$id' or category7 = '$id' or category8 = '$id' or category9 = '$id' or category10 = '$id') and (bitis >= '$bugun') and (confirm = '1') $ek  $ek2 ");


                            $zid = $z->modul;
                            $i = 0;
                            $idler = array();
                            while ($sq = $sqlsor->fetch(PDO::FETCH_ASSOC)) {
                                $devam = "";
                                $sqlsor2 = $db->query("SELECT * FROM modul_ilan WHERE ilanId = '{$sq['Id']}'");
                                $kacitem = $sqlsor2->rowCount();
                                while ($sq2 = $sqlsor2->fetch(PDO::FETCH_ASSOC)) {
                                    $itemId = $sq2["itemId"];
                                    $sqlsor3 = $db->query("SELECT * FROM modulitems WHERE Id = '$itemId'");
                                    $sq3 = $sqlsor3->fetch(PDO::FETCH_ASSOC);

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

                    if ($id == "") {
                        echo '<ul class=" category">';
                        $sql = $db->query("SELECT * FROM category WHERE ustkategoriId = '0'");
                        while ($a = $sql->fetch(PDO::FETCH_OBJ)) {
                            if (sayac($a->Id) > 0) {
                                echo '<li class="maincat">' . $a->kategori_adi . '</li>';
                            }
                            $ust = $a->Id;
                            $sql2 = $db->query("SELECT * FROM category WHERE ustkategoriId = '$ust'");
                            while ($b = $sql2->fetch(PDO::FETCH_OBJ)) {
                                if (sayac($b->Id) > 0) {
                                    echo '<li><a href="acil-ilanlar-' . $b->Id . '-' . slugify($b->kategori_adi) . '.html">» ' . $b->kategori_adi . ' <span>( ' . sayac($b->Id) . ' )</span></a></li>';
                                }
                            }

                        }
                        echo '</ul>';
                    } else {
                        echo '<div style="max-height:400px; overflow-y:auto; ">
                    <ul class=" category">';
                        echo '<li class="sub1"><a href="index.php">»  Toutes catégories</span></a></li>';
                        if ($_GET['daralt'] != "") {
                            $urlek = preg_replace("/\/c-(.*?)-(.*?).html/", "", $_SERVER['REQUEST_URI']);
                            $urlek = str_replace("?", "", $urlek);
                            $urlek = preg_replace("/&sayfa=([0-9])/", "&sayfa=1", $urlek);
                        }
                        $sql = $db->query("SELECT * FROM category WHERE Id = '$id'");
                        $a = $sql->fetch(PDO::FETCH_OBJ);
                        if ($a->ustkategoriId == 0) {
                            if (sayac($a->Id) != 0) {
                                echo '<li class="sub1"><a href="c-' . $a->Id . '-' . slugify($a->kategori_adi) . '.html">» ' . $a->kategori_adi . ' <span>( ' . sayac($a->Id) . ' )</span></a></li>';
                            }
                            $sub = 2;
                        } else {
                            $u = $a->ustkategoriId;
                            $sql2 = $db->query("SELECT * FROM category WHERE Id = '$u'");
                            $b = $sql2->fetch(PDO::FETCH_OBJ);
                            if ($b->ustkategoriId == 0) {
                                if (sayac($b->Id) != 0) {
                                    echo '<li class="sub1"><a href="acil-ilanlar-' . $b->Id . '-' . slugify($b->kategori_adi) . '.html';
                                    if ($_GET['daralt'] != "") {
                                        echo '?' . $urlek . '';
                                    }
                                    echo '">» ' . $b->kategori_adi . ' <span>( ' . sayac($b->Id) . ' )</span></a></li>';
                                }
                                if (sayac($a->Id) != 0) {
                                    echo '<li class="sub2"><a href="acil-ilanlar-' . $a->Id . '-' . slugify($a->kategori_adi) . '.html';
                                    if ($_GET['daralt'] != "") {
                                        echo '?' . $urlek . '';
                                    }
                                    echo '">» ' . $a->kategori_adi . ' <span>( ' . sayac($a->Id) . ' )</span></a></li>';
                                }
                                $sub = 3;
                            } else {
                                $u = $b->ustkategoriId;
                                $sql3 = $db->query("SELECT * FROM category WHERE Id = '$u'");
                                $c = $sql3->fetch(PDO::FETCH_OBJ);
                                if ($c->ustkategoriId == 0) {
                                    if (sayac($c->Id) != 0) {
                                        echo '<li class="sub1"><a href="acil-ilanlar-' . $c->Id . '-' . slugify($c->kategori_adi) . '.html';
                                        if ($_GET['daralt'] != "") {
                                            echo '?' . $urlek . '';
                                        }
                                        echo '">» ' . $c->kategori_adi . ' <span>( ' . sayac($c->Id) . ' )</span></a></li>';
                                    }
                                    if (sayac($b->Id) != 0) {
                                        echo '<li class="sub2"><a href="acil-ilanlar-' . $b->Id . '-' . slugify($b->kategori_adi) . '.html';
                                        if ($_GET['daralt'] != "") {
                                            echo '?' . $urlek . '';
                                        }
                                        echo '">» ' . $b->kategori_adi . ' <span>( ' . sayac($b->Id) . ' )</span></a></li>';
                                    }
                                    if (sayac($a->Id) != 0) {
                                        echo '<li class="sub3"><a href="acil-ilanlar-' . $a->Id . '-' . slugify($a->kategori_adi) . '.html';
                                        if ($_GET['daralt'] != "") {
                                            echo '?' . $urlek . '';
                                        }
                                        echo '">» ' . $a->kategori_adi . ' <span>( ' . sayac($a->Id) . ' )</span></a></li>';
                                    }
                                    $sub = 4;
                                } else {
                                    $u = $c->ustkategoriId;
                                    $sql4 = $db->query("SELECT * FROM category WHERE Id = '$u'");
                                    $d = $sql4->fetch(PDO::FETCH_OBJ);
                                    if ($d->ustkategoriId == 0) {
                                        if (sayac($d->Id) != 0) {
                                            echo '<li class="sub1"><a href="acil-ilanlar-' . $d->Id . '-' . slugify($d->kategori_adi) . '.html';
                                            if ($_GET['daralt'] != "") {
                                                echo '?' . $urlek . '';
                                            }
                                            echo '">» ' . $d->kategori_adi . ' <span>( ' . sayac($d->Id) . ' )</span></a></li>';
                                        }
                                        if (sayac($c->Id) != 0) {
                                            echo '<li class="sub2"><a href="acil-ilanlar-' . $c->Id . '-' . slugify($c->kategori_adi) . '.html';
                                            if ($_GET['daralt'] != "") {
                                                echo '?' . $urlek . '';
                                            }
                                            echo '">» ' . $c->kategori_adi . ' <span>( ' . sayac($c->Id) . ' )</span></a></li>';
                                        }
                                        if (sayac($b->Id) != 0) {
                                            echo '<li class="sub3"><a href="acil-ilanlar-' . $b->Id . '-' . slugify($b->kategori_adi) . '.html';
                                            if ($_GET['daralt'] != "") {
                                                echo '?' . $urlek . '';
                                            }
                                            echo '">» ' . $b->kategori_adi . ' <span>( ' . sayac($b->Id) . ' )</span></a></li>';
                                        }
                                        if (sayac($a->Id) != 0) {
                                            echo '<li class="sub4"><a href="acil-ilanlar-' . $a->Id . '-' . slugify($a->kategori_adi) . '.html';
                                            if ($_GET['daralt'] != "") {
                                                echo '?' . $urlek . '';
                                            }
                                            echo '">» ' . $a->kategori_adi . ' <span>( ' . sayac($a->Id) . ' )</span></a></li>';
                                        }
                                        $sub = 5;
                                    } else {
                                        $u = $d->ustkategoriId;
                                        $sql5 = $db->query("SELECT * FROM category WHERE Id = '$u'");
                                        $e = $sql5->fetch(PDO::FETCH_OBJ);
                                        if ($e->ustkategoriId == 0) {
                                            if (sayac($e->Id) != 0) {
                                                echo '<li class="sub1"><a href="acil-ilanlar-' . $e->Id . '-' . slugify($e->kategori_adi) . '.html';
                                                if ($_GET['daralt'] != "") {
                                                    echo '?' . $urlek . '';
                                                }
                                                echo '">» ' . $e->kategori_adi . ' <span>( ' . sayac($e->Id) . ' )</span></a></li>';
                                            }
                                            if (sayac($d->Id) != 0) {
                                                echo '<li class="sub2"><a href="acil-ilanlar-' . $d->Id . '-' . slugify($d->kategori_adi) . '.html';
                                                if ($_GET['daralt'] != "") {
                                                    echo '?' . $urlek . '';
                                                }
                                                echo '">» ' . $d->kategori_adi . ' <span>( ' . sayac($d->Id) . ' )</span></a></li>';
                                            }
                                            if (sayac($c->Id) != 0) {
                                                echo '<li class="sub3"><a href="acil-ilanlar-' . $c->Id . '-' . slugify($c->kategori_adi) . '.html';
                                                if ($_GET['daralt'] != "") {
                                                    echo '?' . $urlek . '';
                                                }
                                                echo '">» ' . $c->kategori_adi . ' <span>( ' . sayac($c->Id) . ' )</span></a></li>';
                                            }
                                            if (sayac($b->Id) != 0) {
                                                echo '<li class="sub4"><a href="acil-ilanlar-' . $b->Id . '-' . slugify($b->kategori_adi) . '.html';
                                                if ($_GET['daralt'] != "") {
                                                    echo '?' . $urlek . '';
                                                }
                                                echo '">» ' . $b->kategori_adi . ' <span>( ' . sayac($b->Id) . ' )</span></a></li>';
                                            }
                                            if (sayac($a->Id) != 0) {
                                                echo '<li class="sub5"><a href="acil-ilanlar-' . $a->Id . '-' . slugify($a->kategori_adi) . '.html';
                                                if ($_GET['daralt'] != "") {
                                                    echo '?' . $urlek . '';
                                                }
                                                echo '">» ' . $a->kategori_adi . ' <span>( ' . sayac($a->Id) . ' )</span></a></li>';
                                            }
                                            $sub = 6;
                                        } else {
                                            $u = $e->ustkategoriId;
                                            $sql6 = $db->query("SELECT * FROM category WHERE Id = '$u'");
                                            $f = $sql6->fetch(PDO::FETCH_OBJ);
                                            if ($f->ustkategoriId == 0) {
                                                if (sayac($f->Id) != 0) {
                                                    echo '<li class="sub1"><a href="acil-ilanlar-' . $f->Id . '-' . slugify($f->kategori_adi) . '.html';
                                                    if ($_GET['daralt'] != "") {
                                                        echo '?' . $urlek . '';
                                                    }
                                                    echo '">» ' . $f->kategori_adi . ' <span>( ' . sayac($f->Id) . ' )</span></a></li>';
                                                }
                                                if (sayac($e->Id) != 0) {
                                                    echo '<li class="sub2"><a href="acil-ilanlar-' . $e->Id . '-' . slugify($e->kategori_adi) . '.html';
                                                    if ($_GET['daralt'] != "") {
                                                        echo '?' . $urlek . '';
                                                    }
                                                    echo '">» ' . $e->kategori_adi . ' <span>( ' . sayac($e->Id) . ' )</span></a></li>';
                                                }
                                                if (sayac($d->Id) != 0) {
                                                    echo '<li class="sub3"><a href="acil-ilanlar-' . $d->Id . '-' . slugify($d->kategori_adi) . '.html';
                                                    if ($_GET['daralt'] != "") {
                                                        echo '?' . $urlek . '';
                                                    }
                                                    echo '">» ' . $d->kategori_adi . ' <span>( ' . sayac($d->Id) . ' )</span></a></li>';
                                                }
                                                if (sayac($c->Id) != 0) {
                                                    echo '<li class="sub4"><a href="acil-ilanlar-' . $c->Id . '-' . slugify($c->kategori_adi) . '.html';
                                                    if ($_GET['daralt'] != "") {
                                                        echo '?' . $urlek . '';
                                                    }
                                                    echo '">» ' . $c->kategori_adi . ' <span>( ' . sayac($c->Id) . ' )</span></a></li>';
                                                }
                                                if (sayac($b->Id) != 0) {
                                                    echo '<li class="sub5"><a href="acil-ilanlar-' . $b->Id . '-' . slugify($b->kategori_adi) . '.html';
                                                    if ($_GET['daralt'] != "") {
                                                        echo '?' . $urlek . '';
                                                    }
                                                    echo '">» ' . $b->kategori_adi . ' <span>( ' . sayac($b->Id) . ' )</span></a></li>';
                                                }
                                                if (sayac($a->Id) != 0) {
                                                    echo '<li class="sub6"><a href="acil-ilanlar-' . $a->Id . '-' . slugify($a->kategori_adi) . '.html';
                                                    if ($_GET['daralt'] != "") {
                                                        echo '?' . $urlek . '';
                                                    }
                                                    echo '">» ' . $a->kategori_adi . ' <span>( ' . sayac($a->Id) . ' )</span></a></li>';
                                                }
                                                $sub = 7;
                                            } else {
                                                $u = $f->ustkategoriId;
                                                $sql7 = $db->query("SELECT * FROM category WHERE Id = '$u'");
                                                $g = $sql7->fetch(PDO::FETCH_OBJ);
                                                if (sayac($g->Id) != 0) {
                                                    echo '<li class="sub1"><a href="acil-ilanlar-' . $g->Id . '-' . slugify($g->kategori_adi) . '.html';
                                                    if ($_GET['daralt'] != "") {
                                                        echo '?' . $urlek . '';
                                                    }
                                                    echo '">» ' . $g->kategori_adi . ' <span>( ' . sayac($g->Id) . ' )</span></a></li>';
                                                }
                                                if (sayac($f->Id) != 0) {
                                                    echo '<li class="sub2"><a href="acil-ilanlar-' . $f->Id . '-' . slugify($f->kategori_adi) . '.html';
                                                    if ($_GET['daralt'] != "") {
                                                        echo '?' . $urlek . '';
                                                    }
                                                    echo '">» ' . $f->kategori_adi . ' <span>( ' . sayac($f->Id) . ' )</span></a></li>';
                                                }
                                                if (sayac($e->Id) != 0) {
                                                    echo '<li class="sub3"><a href="acil-ilanlar-' . $e->Id . '-' . slugify($e->kategori_adi) . '.html';
                                                    if ($_GET['daralt'] != "") {
                                                        echo '?' . $urlek . '';
                                                    }
                                                    echo '">» ' . $e->kategori_adi . ' <span>( ' . sayac($e->Id) . ' )</span></a></li>';
                                                }
                                                if (sayac($d->Id) != 0) {
                                                    echo '<li class="sub4"><a href="acil-ilanlar-' . $d->Id . '-' . slugify($d->kategori_adi) . '.html';
                                                    if ($_GET['daralt'] != "") {
                                                        echo '?' . $urlek . '';
                                                    }
                                                    echo '">» ' . $d->kategori_adi . ' <span>( ' . sayac($d->Id) . ' )</span></a></li>';
                                                }
                                                if (sayac($c->Id) != 0) {
                                                    echo '<li class="sub5"><a href="acil-ilanlar-' . $c->Id . '-' . slugify($c->kategori_adi) . '.html';
                                                    if ($_GET['daralt'] != "") {
                                                        echo '?' . $urlek . '';
                                                    }
                                                    echo '">» ' . $c->kategori_adi . ' <span>( ' . sayac($c->Id) . ' )</span></a></li>';
                                                }
                                                if (sayac($b->Id) != 0) {
                                                    echo '<li class="sub6"><a href="acil-ilanlar-' . $b->Id . '-' . slugify($b->kategori_adi) . '.html';
                                                    if ($_GET['daralt'] != "") {
                                                        echo '?' . $urlek . '';
                                                    }
                                                    echo '">» ' . $b->kategori_adi . ' <span>( ' . sayac($b->Id) . ' )</span></a></li>';
                                                }
                                                if (sayac($a->Id) != 0) {
                                                    echo '<li class="sub7"><a href="acil-ilanlar-' . $a->Id . '-' . slugify($a->kategori_adi) . '.html';
                                                    if ($_GET['daralt'] != "") {
                                                        echo '?' . $urlek . '';
                                                    }
                                                    echo '">» ' . $a->kategori_adi . ' <span>( ' . sayac($a->Id) . ' )</span></a></li>';
                                                }
                                                $sub = 8;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        $sql = $db->query("SELECT * FROM category WHERE ustkategoriId = '$id' ORDER BY Id ASC");
                        while ($a = $sql->fetch(PDO::FETCH_OBJ)) {
                            if (sayac($a->Id) != 0) {
                                if (sayac($a->Id) != 0) {
                                    echo '<li class="sub' . $sub . '"><a href="acil-ilanlar-' . $a->Id . '-' . slugify($a->kategori_adi) . '.html';
                                    if ($_GET['daralt'] != "") {
                                        echo '?' . $urlek . '';
                                    }
                                    echo '">» ' . $a->kategori_adi . ' <span>( ' . sayac($a->Id) . ' )</span></a></li>';
                                }
                            }
                        }
                        echo ' </ul></div>';
                    }
                    ?>


                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-filter" aria-hidden="true"></i>Recherche restreinte</div>
                <div class="panel-body">
                    <?
                    $sql = $db->query("SELECT * FROM category WHERE Id = '$id'");
                    $z = $sql->fetch(PDO::FETCH_OBJ);
                    if ($id == "") {
                        echo '<form action="acil-ilanlar.html" method="get">';
                    } else {
                        echo ' <form action="acil-ilanlar-' . $id . '-' . slugify($z->kategori_adi) . '.html" method="get">';
                    }
                    ?>

                    <div class="form-group">
                        <label>Wilaya :</label>
                        <select name="il" id="il" class="form-control il" onchange="districts()">
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
                        <label>Municipalité :</label>
                        <select name="ilce" id="ilce" class="form-control ilce" onchange="localitys()">
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
<!--                    <div class="form-group">-->
<!--                        <label>Mahalle :</label>-->
<!--                        <select name="mahalle" id="locality" class="form-control mahalle">-->
<!--                            <option value="">Tümü</option>-->
<!--                            --><?php
//                            $ilce = $_GET['ilce'];
//                            $sql2 = $db->query("SELECT * FROM locality WHERE countyId = '$ilce' ORDER BY districtname ASC");
//                            while ($ix = $sql2->fetch(PDO::FETCH_OBJ)) {
//                                echo '<option value="' . $ix->id . '"';
//                                if ($_GET['mahalle'] == $ix->id) {
//                                    echo ' selected="select"';
//                                }
//                                echo '>' . $ix->districtname . '</option>';
//                            }
//                            ?>
<!--                        </select>-->
<!--                    </div>-->
                    <div class="select">
                        <label class="qlabel">Fiyat</label>
                        <div class="row no-gutter">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <input type="text" name="fiyat1" value="<? echo $_GET["fiyat1"]; ?>"
                                           class="form-control money" placeholder="minimum">
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <input type="text" name="fiyat2" class="form-control money" placeholder="maksimum"
                                           value="<? echo $_GET["fiyat2"]; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <?
                    $sqlm = $db->query("SELECT * FROM category WHERE Id = '$id'");
                    $m = $sqlm->fetch(PDO::FETCH_ASSOC);
                    $modul = $m["modul"];
                    $moduller = "";
                    $sqls = $db->query("SELECT * FROM modulitems WHERE modulsId = '$modul'");
                    while ($mm = $sqls->fetch(PDO::FETCH_OBJ)) {
                        if ($mm->classx == 1) {
                            echo '<div class="select"><label class="qlabel">' . $mm->name . '</label><div class="row no-gutter"><div class="col-xs-6"><div class="form-group"><input type="number" name="field' . $mm->Id . '" value="' . $_GET['field' . $mm->Id . ''] . '" class="form-control" placeholder="minimum"></div></div><div class="col-xs-6"><div class="form-group"><input type="number" name="field' . $mm->Id . '_2" class="form-control" placeholder="maksimum" value="' . $_GET['field' . $mm->Id . '_2'] . '"></div></div></div></div>';
                        } else {
                            echo '<div class="select"><label class="qlabel">' . $mm->name . '</label>
            <select class="form-control se" name="field_' . $mm->Id . '" data-style="btn-primary" data-live-search="true" title="Tümü" data-selected-text-format="count">';
                            $k = $mm->Id;
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
                    <button type="submit" class="btn btn-default btn-block button1"
                            style="margin-left:0px !important; margin-top:10px">Aramayı Daralt
                    </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-9" style="padding-left:5px;">
            <?
            ####################################################################################

            if ($_GET['daralt'] == "") {
                echo "";
                $bugun = date("Y-m-d");
                $say = $db->query("SELECT * FROM ilanlar WHERE (category1 = '$id' or category2 = '$id' or category3 = '$id' or category4 = '$id' or category5 = '$id' or category6 = '$id' or category7 = '$id' or category8 = '$id' or category9 = '$id' or category10 = '$id') and (bitis >= '$bugun') and (confirm = '1')$ek2 ORDER BY $order1 $order2");
                $toplam = $say->rowCount();
                $toplam_sayfa = ceil($toplam / $sayfada);
                if ($sayfa < 1) $sayfa = 1;
                if ($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa;
                $limit = ($sayfa - 1) * $sayfada;
                if ($limit < 0) {
                    $limit = 0;
                }
                $sqlsor = $db->query("SELECT * FROM ilanlar WHERE (category1 = '$id' or category2 = '$id' or category3 = '$id' or category4 = '$id' or category5 = '$id' or category6 = '$id' or category7 = '$id' or category8 = '$id' or category9 = '$id' or category10 = '$id') and (bitis >= '$bugun') and (confirm = '1')$ek2 ORDER BY $order1 $order2 LIMIT $limit,$sayfada");
                echo '<script> sonuc(' . $toplam . '); </script>';
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
                        $v = str_replace(".", "", $_GET["fiyat1"]);
                        $v2 = str_replace(".", "", $_GET["fiyat2"]);
                        $ek .= " and (price BETWEEN '$v' AND '$v2') ";
                    }
                }
                #################################################################################################################


                $sqlsor = $db->query("SELECT Id FROM ilanlar WHERE (category1 = '$id' or category2 = '$id' or category3 = '$id' or category4 = '$id' or category5 = '$id' or category6 = '$id' or category7 = '$id' or category8 = '$id' or category9 = '$id' or category10 = '$id') and (bitis >= '$bugun') and (confirm = '1') $ek  $ek2 ORDER BY $order1 $order2");


                $zid = $z->modul;
                $i = 0;
                $idler = array();
                while ($sq = $sqlsor->fetch(PDO::FETCH_ASSOC)) {
                    $devam = "";
                    $sqlsor2 = $db->query("SELECT * FROM modul_ilan WHERE ilanId = '{$sq['Id']}'");
                    $kacitem = $sqlsor2->rowCount();
                    while ($sq2 = $sqlsor2->fetch(PDO::FETCH_ASSOC)) {
                        $itemId = $sq2["itemId"];
                        $sqlsor3 = $db->query("SELECT * FROM modulitems WHERE Id = '$itemId'");
                        $sq3 = $sqlsor3->fetch(PDO::FETCH_ASSOC);

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
                    $idler = implode(",", $idler);
                    $say = $db->query("SELECT * FROM ilanlar WHERE Id IN($idler) $ek2 ORDER BY $order1 $order2");
                    $toplam = $say->rowCount();
                    $toplam_sayfa = ceil($toplam / $sayfada);
                    if ($sayfa < 1) $sayfa = 1;
                    if ($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa;
                    $limit = ($sayfa - 1) * $sayfada;

                    $sqlsor = $db->query("SELECT * FROM ilanlar WHERE Id IN($idler) $ek2 ORDER BY $order1 $order2 LIMIT $limit,$sayfada");
                }
            }

            ####################################################################################
            ?>
            <style type="text/css">
                @media (max-width: 768px) {
                    .col-sm-8 {
                        margin-left: 50px;
                    }

                    .col-xs-9 {
                        width: 60%;
                    }
                }
            </style>
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-bell-o" aria-hidden="true"></i> Acil İlanlar</div>
                <div class="panel-body">
                    <div class="row no-gutter">
                        <div class="col-xs-8">
                            <div class="btn-group" role="group" aria-label="..."><a href="filesystems/list.php?id=1"
                                                                                    class="btn btn-default"><i
                                            class="glyphicon glyphicon-th-list"></i> Liste</a> <a
                                        href="filesystems/list.php?id=2" class="btn btn-default"><i
                                            class="glyphicon glyphicon-th"></i> Galeri</a></div>
                        </div>
                        <div class="col-xs-4">
                            <select class="form-control" name="order" id="order" onChange="orders()">
                                <option value="<? echo $_SERVER[REQUEST_URI]; ?>&order=1" <? if ($_GET['order'] == 1 && $_GET["order"] == "") {
                                    echo ' selected';
                                } ?>>Tarihe göre ( Önce en yeni)
                                </option>
                                <option value="<? echo $_SERVER[REQUEST_URI]; ?>&order=2" <? if ($_GET['order'] == 2) {
                                    echo ' selected';
                                } ?>>Tarihe göre ( Önce en eski)
                                </option>
                                <option value="<? echo $_SERVER[REQUEST_URI]; ?>&order=3" <? if ($_GET['order'] == 3) {
                                    echo ' selected';
                                } ?>>Fiyata göre ( Önce en yüksek)
                                </option>
                                <option value="<? echo $_SERVER[REQUEST_URI]; ?>&order=4" <? if ($_GET['order'] == 4) {
                                    echo ' selected';
                                } ?>>Fiyata göre ( Önce en düşük)
                                </option>
                            </select>
                        </div>
                    </div>
                    <?

                    $say45 = $db->query("SELECT * FROM ilanlar WHERE (category1 = '$id' or category2 = '$id' or category3 = '$id' or category4 = '$id' or category5 = '$id' or category6 = '$id' or category7 = '$id' or category8 = '$id' or category9 = '$id' or category10 = '$id') and (bitis >= '$bugun') and (confirm = '1')$ek2 ORDER BY $order1 $order2");
                    $toplam45 = $say45->rowCount();
                    echo '<div style="padding:5px;"><center><strong>Acil İlanlar</strong> Aramanızda Toplam <strong>' . $toplam45 . '</strong> Sonuç Bulundu</center></div>';

                    if ($_SESSION["list"] == 2) {
                        echo '<div class="row no-gutter">';
                    }
                    while ($row = $sqlsor->fetch(PDO::FETCH_ASSOC)) {
                        $resim = $db->query("SELECT * FROM images WHERE ilanId = '{$row['Id']}' ORDER BY s ASC LIMIT 1");
                        if ($resim->rowCount() == 0) {
                            $src = "img/no.png";
                        } else {
                            $r = $resim->fetch(PDO::FETCH_ASSOC);
                            $src = $base_url . "fileserver/files/" . $row["Id"] . "/thumbnail/" . $r["name"];
                        }
                        $e = explode("-", $row["dates"]);
                        $il = $db->query("SELECT * FROM city WHERE id = '{$row['city']}'");
                        $ilyaz = $il->fetch(PDO::FETCH_ASSOC);
                        $ilce = $db->query("SELECT * FROM county WHERE id = '{$row['districts']}'");
                        $ilceyaz = $ilce->fetch(PDO::FETCH_ASSOC);

                        $mahalle = $db->query("SELECT * FROM locality WHERE id = '{$row['locality']}'");
                        $mahalleyaz = $mahalle->fetch(PDO::FETCH_ASSOC);
                        $bugun = date("Y-m-d");
                        $doping = $db->query("SELECT * FROM doping WHERE (ilanId = '{$row['Id']}') and (name = 'kalin') and (onay  = '1') and (val >= '$bugun')");
                        if ($doping->rowCount() == 0) {
                            $class = "";
                        } else {
                            $class = " adv-color";
                        }
                        if ($_SESSION["list"] == "" || $_SESSION["list"] == 1) {
                            echo '
            <div class="adv' . $class . '" onclick="window.location.href=\'i-' . $row["Id"] . '-' . slugify($row["title"]) . '.html\'" style="cursor:pointer">
            <div class="row no-gutter">
            <div class="col-xs-3 col-sm-2"><a href="i-' . $row["Id"] . '-' . slugify($row["title"]) . '.html"><img src="' . $src . '" class="img-thumbnail" width="100" /></a></div>
            <div class="col-sm-1">&nbsp;</div>
            <div class="col-xs-9 col-sm-8"><strong style="font-size:12px">' . $row["title"] . '</strong>
            <br><span style="font-size:11px;font-weight:600;"><i class="fa fa-clock-o" aria-hidden="true"></i> ' . $e[2] . '-' . $e[1] . '-' . $e[0] . ' <br><i class="fa fa-map-marker" aria-hidden="true"></i> ' . $ilyaz["il_adi"] . ' / ' . $ilceyaz["county_adi"] . '</span>
            </div>
            </div>
            </div>
            ';
                        } else {

                            echo '
            <div class="col-xs-6 col-sm-3 col-md-2">
            <div class="adv2">
            <div class="image1"><a href="i-' . $row["Id"] . '-' . slugify($row["title"]) . '.html" alt="' . $row["title"] . '" title="' . $row["title"] . '"> <div class="acil-box"><img src="' . $src . '" width="93" height="75" alt=""/><div class="box_type" style="position: absolute;top: 2px;right:11px;background: rgba(0,0,0,0.5);color: #fff;border-radius: 4px;font-weight:600;font-size: 12px;-webkit-border-bottom-left-radius: 3px;-moz-border-radius-bottomleft: 3px;border-bottom-left-radius: 3px;">'.number_format($row[price]).' '.$row[exchange].'</div></div></a></div>
            
			<div class="adv2-title" style="font-size:11px;margin-top:-10px;"><a href="i-' . $row["Id"] . '-' . slugify($row["title"]) . '.html" alt="' . $row["title"] . '" title="' . $row["title"] . '">' . ucfirst(mb_substr($row["title"], 0, 12)) . '..</a></div>
            </div>
            </div>';
                        }
                    }
                    if ($_SESSION["list"] == 2) {
                        echo '</div>';
                    }
                    if ($toplam_sayfa > 0) {
                        echo '<ul class="pagination">';
                        $goruntulenen = $_SERVER[REQUEST_URI];
                        $sayfa_goster = 11;
                        $en_az_orta = ceil($sayfa_goster / 2);
                        $en_fazla_orta = ($toplam_sayfa + 1) - $en_az_orta;
                        $sayfa_orta = $sayfa;
                        if ($sayfa_orta < $en_az_orta) $sayfa_orta = $en_az_orta;
                        if ($sayfa_orta > $en_fazla_orta) $sayfa_orta = $en_fazla_orta;
                        $sol_sayfalar = round($sayfa_orta - (($sayfa_goster - 1) / 2));
                        $sag_sayfalar = round((($sayfa_goster - 1) / 2) + $sayfa_orta);
                        if ($sol_sayfalar < 1) $sol_sayfalar = 1;
                        if ($sag_sayfalar > $toplam_sayfa) $sag_sayfalar = $toplam_sayfa;

                        if ($sayfa != 1) echo '<li><a href="' . $goruntulenen . '&sayfa=' . ($sayfa - 1) . '">&lt; Önceki</a></li>';

                        for ($s = $sol_sayfalar; $s <= $sag_sayfalar; $s++) {
                            if ($sayfa == $s) {
                                echo '<li class="active"><a href="' . $goruntulenen . '&sayfa=' . $s . '">' . $s . '</a></li>';
                            } else {
                                echo '<li><a href="' . $goruntulenen . '&sayfa=' . $s . '">' . $s . '</a><li>';
                            }
                        }

                        if ($sayfa != $toplam_sayfa) echo '<li><a href="' . $goruntulenen . '&sayfa=' . ($sayfa + 1) . '">Sonraki &gt;</a></li>';
                        echo '</ul>';
                    }
                    ?>
                </div>
            </div>
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
                        <div class="col-xs-6">
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
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label>Wilaya :</label>
                                <select name="il" id="il" class="form-control il" onchange="districts2()">
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
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label>Municipalité :</label>
                                <select name="ilce[]" id="ilce" class="form-control ilce se" data-show-subtext="true"
                                        data-live-search="true" multiple>
                                    <option value="">Tümü</option>
                                    <?php
                                    $il = $_GET['il'];
                                    $sql2 = $db->query("SELECT * FROM county WHERE il_id = '$il' ORDER BY county_adi ASC");
                                    while ($ix = $sql2->fetch(PDO::FETCH_OBJ)) {
                                        echo '<option value="' . $ix->id . '"';
                                        foreach ($_GET["ilce"] as $ilx) {
                                            if ($ilx == $ix->id) {
                                                echo ' selected="select"';
                                            }
                                        }

                                        echo '>' . $ix->county_adi . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-xs-6">
                            <label class="">Fiyat</label>
                            <div class="row no-gutter">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <input type="text" name="fiyat1" value="<? echo $_GET["fiyat1"]; ?>"
                                               class="form-control money" placeholder="minimum">
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <input type="text" name="fiyat2" class="form-control money"
                                               placeholder="maksimum" value="<? echo $_GET["fiyat2"]; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-1"><input type="submit" class="btn btn-danger" value="Aramaya Başla"></div>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>