<?php
ob_start();
include '../functions.php';
if (isset($_GET['sess_id']) && $_GET['sess_id'] != "") {
    session_id($_GET['sess_id']);
}
include '../language/' . $lang . '.php';
define('access', true);
$l = $_SERVER['HTTP_HOST'];
$l = str_replace("http://", "", $l);
$l = str_replace("www.", "", $l);
$l = explode(".", $l);
$l = $l[0];
$sql = $db->query("SELECT * FROM magazalar WHERE adres = '$l'");
$si = $sql->fetch(PDO::FETCH_ASSOC);
$title = $si["magazaadi"];
$description = $si["aciklama"];
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><? echo $title; ?> - <? echo $description; ?></title>
        <meta name="description" content="<? echo $description; ?>">
        <link href="<?php echo $base_url; ?>css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo $base_url; ?>css/style.css" rel="stylesheet">
        <link href="<?php echo $base_url; ?>css/bootstrap-select.css" rel="stylesheet">
        <link href="<?php echo $base_url; ?>css/jquery.mCustomScrollbar.css" rel="stylesheet">
        <link href="<?php echo $base_url; ?>css/summernote.css" rel="stylesheet">
        <link href="<?php echo $base_url; ?>css/checkbox-x.css" media="all" rel="stylesheet" type="text/css"/>
        <link href="<?php echo $base_url; ?>css/theme-krajee-flatblue.css" media="all" rel="stylesheet"
              type="text/css"/>
        <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen"/>
        <link rel="stylesheet" href="/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css"
              media="screen"/>
        <link rel="stylesheet" href="/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css"
              media="screen"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="<?php echo $base_url; ?>js/global.js"></script>
        <script src="<?php echo $base_url; ?>js/bootstrap.min.js"></script>
        <script src="<?php echo $base_url; ?>js/jquery.maskedinput-1.3.min.js"></script>
        <script src="<?php echo $base_url; ?>js/enscroll-0.6.0.min.js"></script>
        <script src="<?php echo $base_url; ?>js/bootstrap-select.js"></script>
        <script src="<?php echo $base_url; ?>js/i18n/defaults-tr_TR.js"></script>
        <script src="<?php echo $base_url; ?>js/summernote.js"></script>
        <script src="<?php echo $base_url; ?>js/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="<?php echo $base_url; ?>js/checkbox-x.js" type="text/javascript"></script>
        <script src="<?php echo $base_url; ?>js/jquery.mask.js" type="text/javascript"></script>
        <script type="text/javascript"
                src="<?php echo $base_url; ?>fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
        <script type="text/javascript"
                src="<?php echo $base_url; ?>fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
        <script type="text/javascript"
                src="<?php echo $base_url; ?>fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
        <script type="text/javascript"
                src="<?php echo $base_url; ?>fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
        <script type="text/javascript"
                src="<?php echo $base_url; ?>fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar"><span class="icon-bar"></span> <span
                            class="icon-bar"></span> <span class="icon-bar"></span></button>
                <div class="visible-xs"
                     style="color: #fff;font-weight:600;margin-top:9px;text-align:center;margin-left:30px;"><? echo banner(6); ?></div>
            </div>
            <div id="navbar" class="navbar-collapse collapse">

                <ul class="nav navbar-nav">
                    <li><a href="<?php echo $base_url; ?>"><i class="fa fa-home" aria-hidden="true"></i> Anasayfa</a>
                    </li>
                    <li class="dropdown visible-xs"><a href="#" class="dropdown-toggle res1" data-toggle="dropdown"
                                                       role="button" aria-haspopup="true" aria-expanded="false"><i
                                    class="glyphicon glyphicon-th-list"></i> Kategoriler <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?
                            $sql = $db->query("SELECT * FROM category WHERE ustkategoriId = '0' and tip = '0' ORDER BY sira ASC");
                            while ($a = $sql->fetch(PDO::FETCH_OBJ)) {
                                echo '<li><a href="c-' . $a->Id . '-' . slugify($a->kategori_adi) . '.html"><img src="' . $base_url . 'ikonlar/' . $a->ikon . '" alt="' . $a->kategori_adi . '" width="20" height="20" class="absmiddle" /> ' . $a->kategori_adi . '</span></a></li>';

                            }
                            ?>
                        </ul>
                    </li>

                    <li class="hidden-xs"><a href="<?php echo $base_url; ?>acil-ilanlar.html?sayfa=1"><i
                                    class="fa fa-bell-o" aria-hidden="true"></i> Acil İlanlar</a></li>
                    <li class="hidden-xs"><a href="<?php echo $base_url; ?>magazalar.html"><i class="fa fa-shopping-bag"
                                                                                              aria-hidden="true"></i>
                            Mağazalar</a></li>
                    <li class="hidden-xs"><a href="<?php echo $base_url; ?>rehber.html?sayfa=1"><i
                                    class="fa fa-building" aria-hidden="true"></i> Firma Rehberi</a></li>
                    <? if ($_SESSION['uye'] == "") { ?>
                        <li class="visible-xs"><a href="<? echo $base_url; ?>login/"><i class="fa fa-user"
                                                                                        aria-hidden="true"></i> <?php echo $lg[2]; ?>
                            </a></li>
                        <li class="visible-xs"><a href="<? echo $base_url; ?>register/"><i class="fa fa-user-plus"
                                                                                           aria-hidden="true"></i> <?php echo $lg[3]; ?>
                            </a></li>
                    <? } else { ?>
                        <li class="dropdown visible-xs"><a href="#" class="dropdown-toggle res1" data-toggle="dropdown"
                                                           role="button" aria-haspopup="true" aria-expanded="false"><i
                                        class="fa fa-user" aria-hidden="true"></i> Bana Özel <span class="caret"></span></a>
                            <ul class="dropdown-menu ">
                                <?
                                $uye = $_SESSION["uye"];
                                $sql = $db->query("SELECT * FROM mesajlar WHERE gonderilen = '$uye' and okundu = '0'");
                                $say = $sql->rowCount();
                                ?>
                                <li><a href="<? echo $base_url; ?>index.php?page=message">Mesajlar
                                        <? if ($say != 0) { ?>
                                            </h4>
                                            <span class="label label-danger">( <? echo $say; ?> )</span>
                                        <? } ?>
                                    </a></li>
                                <?
                                $uye = $_SESSION["uye"];
                                $sql = $db->query("SELECT * FROM ilanlar WHERE confirm = '0' and uyeId = '$uye'");
                                $say2 = $sql->rowCount();
                                $bugun = date("Y-m-d");
                                $sql = $db->query("SELECT * FROM ilanlar WHERE bitis < '$bugun' and uyeId = '$uye'");
                                $say = $sql->rowCount() + $say2;
                                ?>
                                <li><a href="<? echo $base_url; ?>index.php?page=adverts">İlan Yönetimi
                                        <? if ($say != 0) { ?>
                                            </h4>
                                            <span class="label label-danger">( <? echo $say; ?> )</span>
                                        <? } ?>
                                    </a></li>
                                <?
                                $uye = $_SESSION["uye"];
                                $sql = $db->query("SELECT * FROM siparisler WHERE satici = '$uye' and durum = '0'");
                                $say = $sql->rowCount();
                                ?>
                                <li><a href="<? echo $base_url; ?>index.php?page=kihale">İhale İşlemlerim</a></li>
                                <li><a href="<? echo $base_url; ?>index.php?page=satisislemlerim">Satış İşlemlerim
                                        <? if ($say != 0) { ?>
                                            </h4>
                                            <span class="label label-danger">( <? echo $say; ?> )</span>
                                        <? } ?>
                                    </a></li>
                                <?
                                $uye = $_SESSION["uye"];
                                $sql = $db->query("SELECT * FROM siparisler WHERE alici = '$uye' and durum = '1'");
                                $say = $sql->rowCount();
                                ?>
                                <li><a href="<? echo $base_url; ?>index.php?page=alisislemlerim">Alış İşlemlerim
                                        <? if ($say != 0) { ?>
                                            </h4>
                                            <span class="label label-danger">( <? echo $say; ?> )</span>
                                        <? } ?>
                                    </a></li>
                                <?
                                $uye = $_SESSION["uye"];
                                $sql = $db->query("SELECT * FROM odemeler WHERE uyeId = '$uye'");
                                $say = $sql->rowCount();
                                ?>
                                <li><a href="<? echo $base_url; ?>index.php?page=odemebildirimi">Ödeme Bildirimi
                                        <? if ($say != 0) { ?>
                                            </h4>
                                            <span class="label label-danger">( <? echo $say; ?> )</span>
                                        <? } ?>
                                    </a></li>
                                <li><a href="<? echo $base_url; ?>index.php?page=favoriilanlarim">Favori İlanlarım</a>
                                </li>
                                <?
                                $uye = $_SESSION["uye"];
                                $sql = $db->query("SELECT * FROM magazalar WHERE uyeId = '$uye'");
                                if ($sql->rowCount() > 0) {
                                    echo '<li><a href="' . $base_url . 'index.php?page=medit">Mağaza Bilgilerim</a></li>';
                                }
                                ?>
                                <li><a href="<? echo $base_url; ?>index.php?page=membership">Üyeliğim</a></li>
                                <li><a href="<? echo $base_url; ?>index.php?page=exit">Çıkış</a></li>
                            </ul>
                        </li>
                    <? } ?>
                    <?
                    if ($_SESSION['uye'] == "") {
                        echo '<li class="visible-xs"><a href="' . $base_url . 'login/" class="btn btn-dafault button1"><i class="fa fa-plus-square" aria-hidden="true"></i> Ücretsiz İlan Ver</a></li>';
                    } else {
                        $uye = $_SESSION["uye"];
                        $sql = $db->query("SELECT * FROM magazalar WHERE uyeId = '$uye'");
                        if ($sql->rowCount() == 0) {
                            echo '<li  class="visible-xs"><a href="' . $base_url . 'index.php?page=mopen" class="btn btn-dafault"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Mağaza Aç</a></li>';
                        } else {

                        }
                        echo '<li  class="visible-xs"><a href="' . $base_url . 'index.php?page=add" class="btn btn-dafault button1"><i class="fa fa-plus-square" aria-hidden="true"></i> Ücretsiz İlan Ver</a></li>';
                    }
                    ?>
                </ul>
                <ul class="nav navbar-nav hidden-xs" style="margin-left:380px;">
                    <? if ($_SESSION['uye'] == "") { ?>
                        <li style="margin-right:5px"><a href="<? echo $base_url; ?>login/"><i class="fa fa-user"
                                                                                              aria-hidden="true"></i> <?php echo $lg[2]; ?>
                            </a></li>
                        <li style="margin-right:5px"><a href="<? echo $base_url; ?>register/"><i class="fa fa-user-plus"
                                                                                                 aria-hidden="true"></i> <?php echo $lg[3]; ?>
                            </a></li>
                    <? } else { ?>
                        <li><a href="#" style="cursor:default; color:#fff"><strong><? echo $lg[9]; ?>
                                    ;</strong> <? echo $_SESSION['adsoyad']; ?></a></li>
                        <li class="dropdown"><a href="#" class="dropdown-toggle btn btn-dafault button2"
                                                data-toggle="dropdown" role="button" aria-haspopup="true"
                                                aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i> Bana
                                Özel <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <?
                                $uye = $_SESSION["uye"];
                                $sql = $db->query("SELECT * FROM mesajlar WHERE gonderilen = '$uye' and okundu = '0'");
                                $say = $sql->rowCount();
                                ?>
                                <li><a href="<? echo $base_url; ?>index.php?page=message">Mesajlar
                                        <? if ($say != 0) { ?>
                                            </h4>
                                            <span class="label label-danger">( <? echo $say; ?> )</span>
                                        <? } ?>
                                    </a></li>
                                <?
                                $uye = $_SESSION["uye"];
                                $sql = $db->query("SELECT * FROM ilanlar WHERE confirm = '0' and uyeId = '$uye'");
                                $say2 = $sql->rowCount();
                                $bugun = date("Y-m-d");
                                $sql = $db->query("SELECT * FROM ilanlar WHERE bitis < '$bugun' and uyeId = '$uye'");
                                $say = $sql->rowCount() + $say2;
                                ?>
                                <li><a href="<? echo $base_url; ?>index.php?page=adverts">İlan Yönetimi
                                        <? if ($say != 0) { ?>
                                            </h4>
                                            <span class="label label-danger">( <? echo $say; ?> )</span>
                                        <? } ?>
                                    </a></li>
                                <?
                                $uye = $_SESSION["uye"];
                                $sql = $db->query("SELECT * FROM siparisler WHERE satici = '$uye' and durum = '0'");
                                $say = $sql->rowCount();
                                ?>
                                <li><a href="<? echo $base_url; ?>index.php?page=kihale">İhale İşlemlerim</a></li>
                                <li><a href="<? echo $base_url; ?>index.php?page=satisislemlerim">Satış İşlemlerim
                                        <? if ($say != 0) { ?>
                                            </h4>
                                            <span class="label label-danger">( <? echo $say; ?> )</span>
                                        <? } ?>
                                    </a></li>
                                <?
                                $uye = $_SESSION["uye"];
                                $sql = $db->query("SELECT * FROM siparisler WHERE alici = '$uye' and durum = '1'");
                                $say = $sql->rowCount();
                                ?>
                                <li><a href="<? echo $base_url; ?>index.php?page=alisislemlerim">Alış İşlemlerim
                                        <? if ($say != 0) { ?>
                                            </h4>
                                            <span class="label label-danger">( <? echo $say; ?> )</span>
                                        <? } ?>
                                    </a></li>
                                <?
                                $uye = $_SESSION["uye"];
                                $sql = $db->query("SELECT * FROM odemeler WHERE uyeId = '$uye'");
                                $say = $sql->rowCount();
                                ?>
                                <li><a href="<? echo $base_url; ?>index.php?page=odemebildirimi">Ödeme Bildirimi
                                        <? if ($say != 0) { ?>
                                            </h4>
                                            <span class="label label-danger">( <? echo $say; ?> )</span>
                                        <? } ?>
                                    </a></li>
                                <li><a href="<? echo $base_url; ?>index.php?page=favoriilanlarim">Favori İlanlarım</a>
                                </li>
                                <?
                                $uye = $_SESSION["uye"];
                                $sql = $db->query("SELECT * FROM magazalar WHERE uyeId = '$uye'");
                                if ($sql->rowCount() > 0) {
                                    echo '<li><a href="' . $base_url . 'index.php?page=medit">Mağaza Bilgilerim</a></li>';
                                }
                                ?>
                                <li><a href="<? echo $base_url; ?>index.php?page=membership">Üyeliğim</a></li>
                                <li><a href="<? echo $base_url; ?>index.php?page=exit">Çıkış</a></li>
                            </ul>
                        </li>
                    <? } ?>
                    <?
                    if ($_SESSION['uye'] == "") {
                        echo '<li style="margin-right:5px"><a href="' . $base_url . 'login/" class="btn btn-dafault button1"><i class="fa fa-plus-square" aria-hidden="true"></i> Ücretsiz İlan Ver</a></li>';
                    } else {
                        $uye = $_SESSION["uye"];
                        $sql = $db->query("SELECT * FROM magazalar WHERE uyeId = '$uye'");
                        if ($sql->rowCount() == 0) {
                            echo '<li ><a href="' . $base_url . 'index.php?page=mopen" class="btn btn-dafault"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Mağaza Aç</a></li>';
                        } else {

                        }
                        echo '<li style="margin-right:5px"><a href="' . $base_url . 'index.php?page=add" class="btn btn-dafault button1"><i class="fa fa-plus-square" aria-hidden="true"></i> Ücretsiz İlan Ver</a></li>';
                    }
                    ?>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </nav>
    <? if (!defined('access')) {
        exit;
    }
    function sayac($id)
    {
        global $db;
        $bugun = date("Y-m-d");
        $sql = $db->query("SELECT Id FROM ilanlar WHERE (category1 = '$id' or category2 = '$id' or category3 = '$id' or category4 = '$id' or category5 = '$id' or category6 = '$id' or category7 = '$id' or category8 = '$id' or category9 = '$id' or category10 = '$id') and (bitis >= '$bugun') and confirm = '1' and firmadi IS NULL ORDER BY Id DESC");
        return $sql->rowCount();
    }

    ?>
    <?

    $sqlsor36 = $db->query("SELECT * FROM ilanlar WHERE (uyeId = '{$si['uyeId']}') and (bitis >= '$bugun') and (confirm = '1') and (category1 = '$id' or category2 = '$id' or category3 = '$id' or category4 = '$id' or category5 = '$id' or category6 = '$id' or category7 = '$id' or category8 = '$id' or category9 = '$id' or category10 = '$id') and firmadi IS NULL ORDER BY Id DESC");
    $say = $sqlsor36->rowCount();

    ?>
    <div class="container top15">
        <div class="panel panel-default hidden-xs" style="margin-top:5px;border: solid 5px #dadada;">
            <? echo '<img src="' . $base_url . 'uploads/' . $si["magazaslider"] . '" width="100%" height="250"/>'; ?>
        </div>
        <div class="row">
            <div class="col-sm-3">

                <div class="panel panel-default">
                    <div class="panel panel-default">
                        <div class="panel-heading"><i class="fa fa-file-text-o" aria-hidden="true"></i> Mağaza Bilgileri
                        </div>
                        <div class="panel-body">
                            <center><? echo '<img src="' . $base_url . 'uploads/' . $si["logo"] . '" width="180" height="110"/>'; ?></center>
                        </div>
                        <center><b>Toplam İlan Adeti : </b> <font color="red"><b><? echo $say; ?></b></font></center>
                        <center><b>Mağaza Hakkında</b></center>
                        <div class="panel-body">
                            <center><? echo $si["aciklama"]; ?></center>
                        </div>
                        <div class="userbox2">
                            <div class="row">
                                <?

                                $sql85 = $db->query("SELECT * FROM users WHERE Id = '{$si['uyeId']}'");
                                $row86 = $sql85->fetch(PDO::FETCH_ASSOC);


                                ?>
                                <div class="col-xs-4 glyphicon glyphicon-phone-alt"><strong><font size="2"
                                                                                                  face="Verdana">
                                            Tel</font></strong></div>
                                <div class="col-xs-8"><a href="tel:<? echo $row86["telefon"]; ?>"><font size="2"
                                                                                                        face="Verdana">
                                            +9<? echo $row86["telefon"]; ?></font></a></div>
                            </div>
                            <hr class="hr">
                            <div class="row">
                                <div class="col-xs-4 glyphicon glyphicon-phone"><strong><font size="2" face="Verdana">
                                            Cep</font></strong></div>
                                <div class="col-xs-8"><a href="tel:<? echo $row86["gsm"]; ?>"><font size="2"
                                                                                                    face="Verdana">
                                            +9<? echo $row86["gsm"]; ?></font></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-heading hidden-xs"><i class="fa fa-list" aria-hidden="true"></i> Kategoriler</div>
                    <div class="panel-body hidden-xs">
                        <ul class="category hidden-xs">
                            <?
                            $kat = array();
                            $sql = $db->query("SELECT * FROM ilanlar WHERE uyeId = '{$si['uyeId']}'");
                            while ($kl = $sql->fetch(PDO::FETCH_ASSOC)) {
                                $kat[] = $kl["category1"];
                                $kat[] = $kl["category2"];
                                $kat[] = $kl["category3"];
                                $kat[] = $kl["category4"];
                                $kat[] = $kl["category5"];
                                $kat[] = $kl["category6"];
                                $kat[] = $kl["category7"];
                                $kat[] = $kl["category8"];
                                $kat[] = $kl["category9"];
                                $kat[] = $kl["category10"];
                            }
                            $kat = array_unique($kat);
                            if ($_GET["page"] == "") {
                                $sql = $db->query("SELECT * FROM category WHERE ustkategoriId = '0' and tip = '0'");

                                while ($a = $sql->fetch(PDO::FETCH_OBJ)) {
                                    if (in_array($a->Id, $kat)) {
                                        echo '<li class="maincat"><b><img src="' . $base_url . 'ikonlar/' . $a->ikon . '" alt="' . $a->kategori_adi . '" width="18" height="18" class="absmiddle" /> ' . $a->kategori_adi . '</b></li>';

                                        $ust = $a->Id;
                                        $sql2 = $db->query("SELECT * FROM category WHERE ustkategoriId = '$ust'");
                                        while ($b = $sql2->fetch(PDO::FETCH_OBJ)) {
                                            if (in_array($b->Id, $kat)) {
                                                echo '<li><a href="c-' . $b->Id . '-' . slugify($b->kategori_adi) . '.html">» ' . $b->kategori_adi . ' <span></span></a></li>';
                                            }
                                        }
                                    }
                                }
                            } else {
                                $id = $_GET["id"];
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
                                        echo '<li class="sub1"><a href="c-' . $a->Id . '-' . slugify($a->kategori_adi) . '.html">» ' . $a->kategori_adi . ' <span></span></a></li>';
                                    }
                                    $sub = 2;
                                } else {
                                    $u = $a->ustkategoriId;
                                    $sql2 = $db->query("SELECT * FROM category WHERE Id = '$u'");
                                    $b = $sql2->fetch(PDO::FETCH_OBJ);
                                    if ($b->ustkategoriId == 0) {
                                        echo '<li class="sub1"><a href="c-' . $b->Id . '-' . slugify($b->kategori_adi) . '.html';
                                        if ($_GET['daralt'] != "") {
                                            echo '?' . $urlek . '';
                                        }
                                        echo '">» ' . $b->kategori_adi . ' <span></span></a></li>';
                                        echo '<li class="sub2"><a href="c-' . $a->Id . '-' . slugify($a->kategori_adi) . '.html';
                                        if ($_GET['daralt'] != "") {
                                            echo '?' . $urlek . '';
                                        }
                                        echo '">» ' . $a->kategori_adi . ' <span></span></a></li>';
                                        $sub = 3;
                                    } else {
                                        $u = $b->ustkategoriId;
                                        $sql3 = $db->query("SELECT * FROM category WHERE Id = '$u'");
                                        $c = $sql3->fetch(PDO::FETCH_OBJ);
                                        if ($c->ustkategoriId == 0) {
                                            echo '<li class="sub1"><a href="c-' . $c->Id . '-' . slugify($c->kategori_adi) . '.html';
                                            if ($_GET['daralt'] != "") {
                                                echo '?' . $urlek . '';
                                            }
                                            echo '">» ' . $c->kategori_adi . ' <span></span></a></li>';
                                            echo '<li class="sub2"><a href="c-' . $b->Id . '-' . slugify($b->kategori_adi) . '.html';
                                            if ($_GET['daralt'] != "") {
                                                echo '?' . $urlek . '';
                                            }
                                            echo '">» ' . $b->kategori_adi . ' <span></span></a></li>';
                                            echo '<li class="sub3"><a href="c-' . $a->Id . '-' . slugify($a->kategori_adi) . '.html';
                                            if ($_GET['daralt'] != "") {
                                                echo '?' . $urlek . '';
                                            }
                                            echo '">» ' . $a->kategori_adi . ' <span></span></a></li>';
                                            $sub = 4;
                                        } else {
                                            $u = $c->ustkategoriId;
                                            $sql4 = $db->query("SELECT * FROM category WHERE Id = '$u'");
                                            $d = $sql4->fetch(PDO::FETCH_OBJ);
                                            if ($d->ustkategoriId == 0) {
                                                echo '<li class="sub1"><a href="c-' . $d->Id . '-' . slugify($d->kategori_adi) . '.html';
                                                if ($_GET['daralt'] != "") {
                                                    echo '?' . $urlek . '';
                                                }
                                                echo '">» ' . $d->kategori_adi . ' <span></span></a></li>';
                                                echo '<li class="sub2"><a href="c-' . $c->Id . '-' . slugify($c->kategori_adi) . '.html';
                                                if ($_GET['daralt'] != "") {
                                                    echo '?' . $urlek . '';
                                                }
                                                echo '">» ' . $c->kategori_adi . ' <span></span></a></li>';
                                                echo '<li class="sub3"><a href="c-' . $b->Id . '-' . slugify($b->kategori_adi) . '.html';
                                                if ($_GET['daralt'] != "") {
                                                    echo '?' . $urlek . '';
                                                }
                                                echo '">» ' . $b->kategori_adi . ' <span></span></a></li>';
                                                echo '<li class="sub4"><a href="c-' . $a->Id . '-' . slugify($a->kategori_adi) . '.html';
                                                if ($_GET['daralt'] != "") {
                                                    echo '?' . $urlek . '';
                                                }
                                                echo '">» ' . $a->kategori_adi . ' <span></span></a></li>';
                                                $sub = 5;
                                            } else {
                                                $u = $d->ustkategoriId;
                                                $sql5 = $db->query("SELECT * FROM category WHERE Id = '$u'");
                                                $e = $sql5->fetch(PDO::FETCH_OBJ);
                                                if ($e->ustkategoriId == 0) {
                                                    echo '<li class="sub1"><a href="c-' . $e->Id . '-' . slugify($e->kategori_adi) . '.html';
                                                    if ($_GET['daralt'] != "") {
                                                        echo '?' . $urlek . '';
                                                    }
                                                    echo '">» ' . $e->kategori_adi . ' <span></span></a></li>';
                                                    echo '<li class="sub2"><a href="c-' . $d->Id . '-' . slugify($d->kategori_adi) . '.html';
                                                    if ($_GET['daralt'] != "") {
                                                        echo '?' . $urlek . '';
                                                    }
                                                    echo '">» ' . $d->kategori_adi . ' <span></span></a></li>';
                                                    echo '<li class="sub3"><a href="c-' . $c->Id . '-' . slugify($c->kategori_adi) . '.html';
                                                    if ($_GET['daralt'] != "") {
                                                        echo '?' . $urlek . '';
                                                    }
                                                    echo '">» ' . $c->kategori_adi . ' <span></span></a></li>';
                                                    echo '<li class="sub4"><a href="c-' . $b->Id . '-' . slugify($b->kategori_adi) . '.html';
                                                    if ($_GET['daralt'] != "") {
                                                        echo '?' . $urlek . '';
                                                    }
                                                    echo '">» ' . $b->kategori_adi . ' <span></span></a></li>';
                                                    echo '<li class="sub5"><a href="c-' . $a->Id . '-' . slugify($a->kategori_adi) . '.html';
                                                    if ($_GET['daralt'] != "") {
                                                        echo '?' . $urlek . '';
                                                    }
                                                    echo '">» ' . $a->kategori_adi . ' <span></span></a></li>';
                                                    $sub = 6;
                                                } else {
                                                    $u = $e->ustkategoriId;
                                                    $sql6 = $db->query("SELECT * FROM category WHERE Id = '$u'");
                                                    $f = $sql6->fetch(PDO::FETCH_OBJ);
                                                    if ($f->ustkategoriId == 0) {
                                                        echo '<li class="sub1"><a href="c-' . $f->Id . '-' . slugify($f->kategori_adi) . '.html';
                                                        if ($_GET['daralt'] != "") {
                                                            echo '?' . $urlek . '';
                                                        }
                                                        echo '">» ' . $f->kategori_adi . ' <span></span></a></li>';
                                                        echo '<li class="sub2"><a href="c-' . $e->Id . '-' . slugify($e->kategori_adi) . '.html';
                                                        if ($_GET['daralt'] != "") {
                                                            echo '?' . $urlek . '';
                                                        }
                                                        echo '">» ' . $e->kategori_adi . ' <span></span></a></li>';
                                                        echo '<li class="sub3"><a href="c-' . $d->Id . '-' . slugify($d->kategori_adi) . '.html';
                                                        if ($_GET['daralt'] != "") {
                                                            echo '?' . $urlek . '';
                                                        }
                                                        echo '">» ' . $d->kategori_adi . ' <span></span></a></li>';
                                                        echo '<li class="sub4"><a href="c-' . $c->Id . '-' . slugify($c->kategori_adi) . '.html';
                                                        if ($_GET['daralt'] != "") {
                                                            echo '?' . $urlek . '';
                                                        }
                                                        echo '">» ' . $c->kategori_adi . ' <span></span></a></li>';
                                                        echo '<li class="sub5"><a href="c-' . $b->Id . '-' . slugify($b->kategori_adi) . '.html';
                                                        if ($_GET['daralt'] != "") {
                                                            echo '?' . $urlek . '';
                                                        }
                                                        echo '">» ' . $b->kategori_adi . ' <span></span></a></li>';
                                                        echo '<li class="sub6"><a href="c-' . $a->Id . '-' . slugify($a->kategori_adi) . '.html';
                                                        if ($_GET['daralt'] != "") {
                                                            echo '?' . $urlek . '';
                                                        }
                                                        echo '">» ' . $a->kategori_adi . ' <span></span></a></li>';
                                                        $sub = 7;
                                                    } else {
                                                        $u = $f->ustkategoriId;
                                                        $sql7 = $db->query("SELECT * FROM category WHERE Id = '$u'");
                                                        $g = $sql7->fetch(PDO::FETCH_OBJ);
                                                        echo '<li class="sub1"><a href="c-' . $g->Id . '-' . slugify($g->kategori_adi) . '.html';
                                                        if ($_GET['daralt'] != "") {
                                                            echo '?' . $urlek . '';
                                                        }
                                                        echo '">» ' . $g->kategori_adi . ' <span></span></a></li>';
                                                        echo '<li class="sub2"><a href="c-' . $f->Id . '-' . slugify($f->kategori_adi) . '.html';
                                                        if ($_GET['daralt'] != "") {
                                                            echo '?' . $urlek . '';
                                                        }
                                                        echo '">» ' . $f->kategori_adi . ' <span></span></a></li>';
                                                        echo '<li class="sub3"><a href="c-' . $e->Id . '-' . slugify($e->kategori_adi) . '.html';
                                                        if ($_GET['daralt'] != "") {
                                                            echo '?' . $urlek . '';
                                                        }
                                                        echo '">» ' . $e->kategori_adi . ' <span></span></a></li>';
                                                        echo '<li class="sub4"><a href="c-' . $d->Id . '-' . slugify($d->kategori_adi) . '.html';
                                                        if ($_GET['daralt'] != "") {
                                                            echo '?' . $urlek . '';
                                                        }
                                                        echo '">» ' . $d->kategori_adi . ' <span></span></a></li>';
                                                        echo '<li class="sub5"><a href="c-' . $c->Id . '-' . slugify($c->kategori_adi) . '.html';
                                                        if ($_GET['daralt'] != "") {
                                                            echo '?' . $urlek . '';
                                                        }
                                                        echo '">» ' . $c->kategori_adi . ' <span></span></a></li>';
                                                        echo '<li class="sub6"><a href="c-' . $b->Id . '-' . slugify($b->kategori_adi) . '.html';
                                                        if ($_GET['daralt'] != "") {
                                                            echo '?' . $urlek . '';
                                                        }
                                                        echo '">» ' . $b->kategori_adi . ' <span></span></a></li>';
                                                        echo '<li class="sub7"><a href="c-' . $a->Id . '-' . slugify($a->kategori_adi) . '.html';
                                                        if ($_GET['daralt'] != "") {
                                                            echo '?' . $urlek . '';
                                                        }
                                                        echo '">» ' . $a->kategori_adi . ' <span></span></a></li>';
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
                                        echo '<li class="sub' . $sub . '"><a href="c-' . $a->Id . '-' . slugify($a->kategori_adi) . '.html';
                                        if ($_GET['daralt'] != "") {
                                            echo '?' . $urlek . '';
                                        }
                                        echo '">» ' . $a->kategori_adi . ' <span></span></a></li>';
                                    }
                                }

                            }
                            ?>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="col-xs-12 col-sm-9" style="padding-left:5px;">
                <div class="panel panel-default">
                    <? if ($_GET['page'] == "") { ?>
                        <div class="panel-heading"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Mağaza
                            İlanları
                        </div>
                    <? } else {
                        $sql10 = $db->query("SELECT * FROM category WHERE Id = '$id'");
                        $a10 = $sql10->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <div class="panel-heading"><? echo $a10["kategori_adi"]; ?></div>
                    <? } ?>
                    <div class="panel-body">
                        <div class="row no-gutter">
                            <?
                            $bugun = date("Y-m-d");
                            if ($_GET['page'] == "") {
                                $sqlsor = $db->query("SELECT * FROM ilanlar WHERE uyeId = '{$si['uyeId']}' and (bitis >= '$bugun') and confirm = '1' and firmadi IS NULL ORDER BY Id DESC");
                            } else {
                                $sqlsor = $db->query("SELECT * FROM ilanlar WHERE (uyeId = '{$si['uyeId']}') and (bitis >= '$bugun') and (confirm = '1') and (category1 = '$id' or category2 = '$id' or category3 = '$id' or category4 = '$id' or category5 = '$id' or category6 = '$id' or category7 = '$id' or category8 = '$id' or category9 = '$id' or category10 = '$id') ORDER BY Id DESC");
                            }
                            while ($row = $sqlsor->fetch(PDO::FETCH_ASSOC)) {
                                $resim = $db->query("SELECT * FROM images WHERE ilanId = '{$row['Id']}' ORDER BY s ASC LIMIT 1");
                                if ($resim->rowCount() == 0) {
                                    $src = $base_url . "img/no.png";
                                } else {
                                    $r = $resim->fetch(PDO::FETCH_ASSOC);
                                    $src = $base_url . "fileserver/files/" . $row["Id"] . "/thumbnail/" . $r["name"];
                                }
                                echo '
                        <div class="col-xs-6 col-sm-3 col-md-2">
                        <div class="adv2">
                        <div class="image1"><a href="' . $base_url . 'i-' . $row["Id"] . '-' . slugify($row["title"]) . '.html" alt="' . $row["title"] . '" title="' . $row["title"] . '"><img src="' . $src . '" width="93" height="75"/></a></div>
						<div class="box_type" style="margin-top:5px;background: rgba(0,0,0,0.5);color: #fff;border-radius: 4px;font-weight:600;font-size: 12px;-webkit-border-bottom-left-radius: 3px;-moz-border-radius-bottomleft: 3px;border-bottom-left-radius: 3px;">' . number_format($row[price]) . ' ' . $row[exchange] . '</div>
						<div class="adv2-title" style="font-size:11px;margin-top:-10px;"><a href="' . $base_url . 'i-' . $row["Id"] . '-' . slugify($row["title"]) . '.html" alt="' . $row["title"] . '" title="' . $row["title"] . '">' . ucfirst(mb_substr($row["title"], 0, 11)) . '..</a></div>
                        </div>
                        </div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <section class="nb-footer">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="footerlogo"><? echo banner(6); ?></div>
                        <center>
                            <div style="margin-top:15px;"><img border="0" src="<? echo $base_url; ?>mobilapps.png"
                                                               alt="logo" width="235" height="42"></div>
                        </center>
                    </div>
                    <div class="col-xs-12 col-sm-3 hidden-xs">
                        <div class="footer-single useful-links hidden-xs">
                            <div class="footer-title hidden-xs">
                                <h2>Kurumsal Bilgiler</h2>
                            </div>
                            <ul class="list-unstyled">
                                <li><a href="<? echo $base_url; ?>index.php">Anasayfa <i
                                                class="fa fa-angle-right pull-right"></i></a></li>
                                <li><a href="<? echo $base_url; ?>hakkimizda.html">Hakkımızda <i
                                                class="fa fa-angle-right pull-right"></i></a></li>
                                <li><a href="<? echo $base_url; ?>iletisim.html">İletişim <i
                                                class="fa fa-angle-right pull-right"></i></a></li>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3 hidden-xs">
                        <div class="footer-single useful-links hidden-xs">
                            <div class="footer-title hidden-xs">
                                <h2>Hizmetlerimiz</h2>
                            </div>
                            <ul class="list-unstyled">
                                <li><a href="<? echo $base_url; ?>doping.html">Doping <i
                                                class="fa fa-angle-right pull-right"></i></a></li>
                                <li><a href="<? echo $base_url; ?>reklam.html">Reklam <i
                                                class="fa fa-angle-right pull-right"></i></a></li>
                                <li><a href="<? echo $base_url; ?>guvenli-alisveris.html">Güvenli Alışveriş Sistemi <i
                                                class="fa fa-angle-right pull-right"></i></a></li>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3 hidden-xs">
                        <div class="footer-single useful-links hidden-xs">
                            <div class="footer-title hidden-xs">
                                <h2>Gizlilik & Kullanım</h2>
                            </div>
                            <ul class="list-unstyled">
                                <li><a href="<? echo $base_url; ?>yardim.html">Yardım <i
                                                class="fa fa-angle-right pull-right"></i></a></li>
                                <li><a href="<? echo $base_url; ?>kullanim-sartlari.html">Kullanım Şartları <i
                                                class="fa fa-angle-right pull-right"></i></a></li>
                                <li><a href="<? echo $base_url; ?>gizlilik-politikasi.html">Gizlilik Politikası <i
                                                class="fa fa-angle-right pull-right"></i></a></li>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="nb-copyright">
            <div class="container">
                <div class="footercop"> <? echo $SiteName; ?> Yer Alan Kullanıcıların Oluşturduğu Tüm İçerik, Görüş Ve
                    Bilgilerin Doğruluğu, Eksiksiz Ve Değişmez Olduğu, Yayınlanması İle İlgili Yasal Yükümlülükler
                    İçeriği Oluşturan Kullanıcıya Aittir.Bu İçeriğin, Görüş Ve Bilgilerin Yanlışlık, Eksiklik Veya
                    Yasalarla Düzenlenmiş Kurallara Aykırılığından Hiçbir Şekilde Sitemiz Sorumlu Değildir.<br>
                    Sorularınız İçin İlan Sahibi İle İrtibata Geçebilirsiniz.
                </div>
            </div>
        </section>
    </footer>

    </body>
    </html>
<? ob_end_flush(); ?>