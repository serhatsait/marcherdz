<?php
ob_start();
include 'functions.php';
include 'language/' . $lang . '.php';
define('access', true);
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?
        if ($_GET['page'] == ""){
            $sql = $db->query("SELECT * FROM metalar WHERE Id = '1'");
            $a = $sql->fetch(PDO::FETCH_ASSOC);
            $title = $a["title"];
            $description = $a["description"];
        } elseif ($_GET["page"] == "acil"){
            $sql = $db->query("SELECT * FROM metalar WHERE Id = '2'");
            $a = $sql->fetch(PDO::FETCH_ASSOC);
            $title = $a["title"];
            $description = $a["description"];
        } elseif ($_GET["page"] == "magazalar"){
            $sql = $db->query("SELECT * FROM metalar WHERE Id = '3'");
            $a = $sql->fetch(PDO::FETCH_ASSOC);
            $title = $a["title"];
            $description = $a["description"];
        } elseif ($_GET["page"] == "sayfa"){
            if ($_GET["id"] == "1"){
                $sql = $db->query("SELECT * FROM metalar WHERE Id = '4'");
                $a = $sql->fetch(PDO::FETCH_ASSOC);
            } elseif ($_GET["id"] == 2){
                $sql = $db->query("SELECT * FROM metalar WHERE Id = '6'");
                $a = $sql->fetch(PDO::FETCH_ASSOC);
            } elseif ($_GET["id"] == 3){
                $sql = $db->query("SELECT * FROM metalar WHERE Id = '7'");
                $a = $sql->fetch(PDO::FETCH_ASSOC);
            } elseif ($_GET["id"] == 4){
                $sql = $db->query("SELECT * FROM metalar WHERE Id = '8'");
                $a = $sql->fetch(PDO::FETCH_ASSOC);
            } elseif ($_GET["id"] == 5){
                $sql = $db->query("SELECT * FROM metalar WHERE Id = '9'");
                $a = $sql->fetch(PDO::FETCH_ASSOC);
            } elseif ($_GET["id"] == 6){
                $sql = $db->query("SELECT * FROM metalar WHERE Id = '10'");
                $a = $sql->fetch(PDO::FETCH_ASSOC);
            } elseif ($_GET["id"] == 7){
                $sql = $db->query("SELECT * FROM metalar WHERE Id = '11'");
                $a = $sql->fetch(PDO::FETCH_ASSOC);
            }
            $title = $a["title"];
            $description = $a["description"];
        } elseif ($_GET["page"] == "category"){
            $id = $_GET["id"];
            $sql = $db->query("SELECT * FROM category WHERE Id = '$id'");
            $a = $sql->fetch(PDO::FETCH_ASSOC);
            $title = $a["kategori_adi"]." İlanları";
            $description = $a["kategori_adi"]." İlanları";
        } elseif ($_GET["page"] == "blog"){
            $id = $_GET["id"];
            $sql = $db->query("SELECT * FROM bkategoriler WHERE Id = '$id'");
            $a = $sql->fetch(PDO::FETCH_ASSOC);
            $title = $a["title"];
            $description = $a["title"];
            if ($id == ""){
                $title = "Blog";
                $description = "Blog";
            }
        } elseif ($_GET["page"] == "yazi"){
            $id = $_GET["id"];
            $sql = $db->query("SELECT * FROM byazilar WHERE Id = '$id'");
            $a = $sql->fetch(PDO::FETCH_ASSOC);
            $title = $a["title"];
            $description = $a["title"];
        } elseif ($_GET["page"] == "ilan"){
            $id = $_GET["id"];
            $sql = $db->query("SELECT * FROM ilanlar WHERE Id = '$id'");
            $a = $sql->fetch(PDO::FETCH_ASSOC);
            $title = $a["title"];
            $description = $a["title"];
        } else {
            $sql = $db->query("SELECT * FROM metalar WHERE Id = '12'");
            $a = $sql->fetch(PDO::FETCH_ASSOC);
            $title = $a["title"];
            $description = $a["description"];
        }
        $sql = $db->query("SELECT * FROM genel");
        $a22 = $sql->fetch(PDO::FETCH_ASSOC);
        $keywords2 = $a22["keywords"];
        $description2 = $a22["description"];
        ?>
        <title><? echo $title; ?></title>
        <?
        if ($_GET["page"] == "ilan"){
            $id = $_GET["id"];
            $sql = $db->query("SELECT * FROM ilanlar WHERE Id = '$id'");
            $a = $sql->fetch(PDO::FETCH_ASSOC);
            $title = $a["title"];
            $description = $a["title"];

            $resim = $db->query("SELECT * FROM images WHERE ilanId = '{$id}' ORDER BY s ASC LIMIT 1");
            $r   = $resim->fetch(PDO::FETCH_ASSOC);
            $src = $base_url . "fileserver/files/" . $a["Id"] . "/" . $r["name"];
            echo '	
<meta property="og:url" content="'.$base_url.'i-'.$a["Id"].'-'.slugify($a["title"]).'.html" />
<meta property="og:title" content="'.$title.'" />
<meta property="og:description" content="'.$title.'" />
<meta property="og:image" content="'.$src.'" />
<meta property="og:type" content="website" />
';
        }
        ?>
        <meta name="description" content="<? echo $description2; ?>">
        <meta name="keywords" content="<? echo $keywords2; ?>">

        <link href="<?php echo $base_url; ?>css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo $base_url; ?>css/style.css" rel="stylesheet">
        <link href="<?php echo $base_url; ?>css/bootstrap-select.css" rel="stylesheet" >
        <link href="<?php echo $base_url; ?>css/jquery.mCustomScrollbar.css" rel="stylesheet" >
        <link href="<?php echo $base_url; ?>css/summernote.css" rel="stylesheet">
        <link href="<?php echo $base_url; ?>css/checkbox-x.css" media="all" rel="stylesheet" type="text/css"/>
        <link href="<?php echo $base_url; ?>css/theme-krajee-flatblue.css" media="all" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
        <link rel="stylesheet" href="/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
        <link rel="stylesheet" href="/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
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
        <script type="text/javascript" src="/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
        <script type="text/javascript" src="/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
        <script type="text/javascript" src="/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
        <script type="text/javascript" src="/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
        <script type="text/javascript" src="/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

    <div class="header-s">

        <div class="container">
            <div class="hidden-xs" id="getFixed" style="position:absolute; top: 10px;">
                <div class="top-line hidden-xs">
                    <div class="container">
                        <div class="row ">
                            <div class="col-lg-12 col-sm-12 ">
                                <div>
                                    <ul class="nav navbar-nav pull-right hidden-xs">
                                        <? if ($_SESSION['uye'] == "") { ?>


                                            <li style="margin-right:20px;margin-top:-19px;font-size:12px;font-weight:600;"><a href="/register/"><i class="fa fa-user-plus" aria-hidden="true"></i> S'inscrire</a></li>
                                            <li style="margin-right:25px;margin-top:-19px;font-size:12px;font-weight:600;"><a href="/login/"><i class="fa fa-sign-in" aria-hidden="true"></i>S'identifier</a></li>
                                        <? } else { ?>
                                            <li class="dropdown"> <a href="#" class="dropdown-toggle btn btn-dafault button2" style="margin-right: 25px;margin-top:-20px;z-index:1000;font-size:12px;font-weight:600;color: white;" data-toggle="dropdown" role="button"  aria-haspopup="true" aria-expanded="false"><? echo $_SESSION['adsoyad']; ?>&nbsp;&nbsp;<span class="caret"></span></a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="index.php?page=add">» Ücretsiz İlan Ekle</a></li>
                                                    <li><a href="index.php?page=add4">» Firma Ekle</a></li>
                                                    <?
                                                    $uye = $_SESSION["uye"];
                                                    $sql = $db->query("SELECT * FROM mesajlar WHERE gonderilen = '$uye' and okundu = '0'");
                                                    $say = $sql->rowCount();
                                                    ?>
                                                    <li><a href="index.php?page=message">» Mesajlar
                                                            <? if ($say != 0) { ?>
                                                                </h4>
                                                                <span class="label label-danger">( <? echo $say; ?> )</span>
                                                            <? } ?>
                                                        </a></li>

                                                    <?
                                                    $uye = $_SESSION["uye"];
                                                    $sql = $db->query("SELECT * FROM magazalar WHERE uyeId = '$uye'");
                                                    if ($sql->rowCount() > 0) {
                                                        echo '<li><a href="/index.php?page=medit">» Mağaza Bilgilerim</a></li>';
                                                    }else{echo '<li><a href="/index.php?page=mopen">» Mağaza Aç</a></li>';}

                                                    ?>



                                                    <?
                                                    $uye = $_SESSION["uye"];
                                                    $sql = $db->query("SELECT * FROM ilanlar WHERE confirm = '0' and uyeId = '$uye'");
                                                    $say2 = $sql->rowCount();
                                                    $bugun = date("Y-m-d");
                                                    $sql = $db->query("SELECT * FROM ilanlar WHERE bitis < '$bugun' and uyeId = '$uye'");
                                                    $say = $sql->rowCount() + $say2;
                                                    ?>
                                                    <li><a href="index.php?page=adverts">» İlan Yönetimi
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
                                                    <li><a href="index.php?page=kihale">» İhale İşlemlerim</a></li>
                                                    <li><a href="index.php?page=satisislemlerim">» Satış İşlemlerim
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
                                                    <li><a href="index.php?page=alisislemlerim">» Alış İşlemlerim
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
                                                    <li><a href="index.php?page=odemebildirimi">» Ödeme Bildirimi
                                                            <? if ($say != 0) { ?>
                                                                </h4>
                                                                <span class="label label-danger">( <? echo $say; ?> )</span>
                                                            <? } ?>
                                                        </a></li>
                                                    <li><a href="index.php?page=favoriilanlarim">» Favori İlanlarım</a></li>

                                                    <li><a href="/index.php?page=membership">» Üyeliğim</a></li>
                                                    <li><a href="/index.php?page=exit">» Çıkış</a></li>
                                                </ul>
                                            </li>
                                            <li style="margin-right:10px;margin-top:-23px;font-size:12px;font-weight:600;"><a href="index.php?page=message"><i title="Mesajlarım" class="fa fa-envelope fa-2x" aria-hidden="true"></i></a></li>
                                            <li style="margin-right:10px;margin-top:-23px;font-size:12px;font-weight:600;"><a href="index.php?page=favoriilanlarim"><i title="Favori İlanlarım" class="fa fa-star-o fa-2x" aria-hidden="true"></i></a></li>
                                            <li style="margin-right:15px;margin-top:-23px;font-size:12px;font-weight:600;"><a href="index.php?page=exit"><i title="<? echo $_SESSION['adsoyad']; ?> Oturumunu Kapat" class="fa fa-sign-out fa-2x" aria-hidden="true"></i></a></li>
                                        <? } ?>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form action="<?php echo $base_url; ?>index.php" method="get">
                <div class="logo hidden-xs" style="margin-top:12px;"><? echo banner(6); ?></div>

                <div class="row">

                    <div class="col-md-9 col-sm-12 col-xs-12 search-list hidden-xs">


                        <input type="hidden" name="page" value="search">
                        <h3 class="search-h3"></h3>
                        <div id="custom-search-input">

                            <div class="input-group col-md-12">
                                <b><input name="keyword" type="text" class="form-control" placeholder="Recherchez par mot ou numéro de l'annonce ..." required /></b>
                                <span class="input-group-btn">
              <button class="btn btn-info" type="submit"> <i class="glyphicon glyphicon-search"></i> </button>
              </span></div>
                        </div>
            </form>
            <a href="<?php echo $base_url; ?>index.php?page=add" class="btn btn-dafault button20"><i class="fa fa-plus-square" aria-hidden="true"></i> ÜCRETSİZ İLAN VER</a>
            <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal" class="btn btn-dafault button328"> Recherche rapide</a>
        </div>

    </div>
    </div>

    <div class="container">
        <div class="navbar-header">

            <? if ($_SESSION['uye'] == "") { ?>
                <i class="ac-kapasag fa fa-user fa-2x"><font style="font-size:18px;font-family:arial;text-align: center;font-weight:600;"></font></i>
                <div class="mobil-menuqq">
                    <li><a href="<?php echo $base_url; ?>facebook.php"><i style="margin:5px;color:#fff;" class="fa fa-facebook-square" aria-hidden="true"></i><font style="color:#fff;font-size:14px;font-family:arial;text-align: center;">Facebook İle Bağlan</font></a></li>
                    <li><a href="<?php echo $base_url; ?>login/"><i style="margin:5px;color:#fff;" class="fa fa-sign-in" aria-hidden="true"></i><font style="color:#fff;font-size:14px;font-family:arial;text-align: center;">S'identifier</font></a></li>
                    <li><a href="<?php echo $base_url; ?>register/"><i style="margin:5px;color:#fff;" class="fa fa-user-plus" aria-hidden="true"></i><font style="color:#fff;font-size:14px;font-family:arial;text-align: center;">S'inscrire</font></a></li>
                    <li><a href="<?php echo $base_url; ?>index.php?page=add"><i style="margin:5px;color:#fff;" class="fa fa-plus-square" aria-hidden="true"></i><font style="color:#fff;font-size:14px;font-family:arial;text-align: center;">Ücretsiz İlan Ver</font></a></li>
                </div>

                <i class="ac-kapa fa fa-bars fa-2x"><font style="font-size:18px;font-family:arial;text-align: center;font-weight:600;"></font></i>
                <div class="visible-xs" style="color: #fff;font-weight:600;margin-top:-38px;text-align:center;margin-left:30px;"><a href="<?php echo $base_url; ?>"><? echo banner(6); ?></a></div>

                <div class="mobil-menu">



                    <?
                    $sql = $db->query("SELECT * FROM category WHERE ustkategoriId = '0' and tip = '0' ORDER BY sira ASC");
                    while ($a = $sql->fetch(PDO::FETCH_OBJ)){
                        echo '<li><a href="kategori-'.$a->Id.'-'.slugify($a->kategori_adi).'.html"><img src="'.$base_url.'ikonlar/'.$a->ikon.'" alt="'.$a->kategori_adi.'" width="20" height="20" class="absmiddle" /> '.$a->kategori_adi.'</span></a></li>';

                    }
                    ?>


                    <br>
                    <li><i class="fa fa-bell-o"  aria-hidden="true"></i> <a href="<?php echo $base_url; ?>acil-ilanlar.html?sayfa=1" style="color:#fff;font-size:14px;font-family:arial;text-align: center;" class="cat_text">Dernières publications</a></li>
                    <li><i class="fa fa-thumbs-down"  aria-hidden="true"></i> <a href="<?php echo $base_url; ?>fiyati-dusenler.html" style="color:#fff;font-size:14px;font-family:arial;text-align: center;" class="cat_text">Prix ​​réduit</a></li>
                    <li><i class="fa fa-shopping-cart" aria-hidden="true"></i> <a href="<?php echo $base_url; ?>get-ilanlar.html" style="color:#fff;font-size:14px;font-family:arial;text-align: center;" class="cat_text">GET İlanlar</a></li>
                    <li><i class="fa fa-building" aria-hidden="true"></i> <a href="<?php echo $base_url; ?>rehber.html?sayfa=1" style="color:#fff;font-size:14px;font-family:arial;text-align: center;" class="cat_text">Annuaire de l'entreprise</a></li>
                    <li><i class="fa fa-briefcase" aria-hidden="true"></i> <a href="<?php echo $base_url; ?>magazalar.html" style="color:#fff;font-size:14px;font-family:arial;text-align: center;" class="cat_text">Magasins</a></li>
                </div>
            <? } else { ?>
                <i class="ac-kapasag fa fa-user fa-2x"><font style="font-size:18px;font-family:arial;text-align: center;font-weight:600;"></font></i>
                <div class="mobil-menuqq">
                    <center><b><font size="1" color="#fff"><? echo $_SESSION['adsoyad']; ?></font>&nbsp;<a href="<?php echo $base_url; ?>index.php?page=exit"><font size="1" color="#fff">[ Çıkış ]</font></a></b></center><br>
                    <li><a href="index.php?page=add">» İlan Ekle</a></li>
                    <li><a href="index.php?page=add4">» Firma Ekle</a></li>
                    <?
                    $uye = $_SESSION["uye"];
                    $sql = $db->query("SELECT * FROM mesajlar WHERE gonderilen = '$uye' and okundu = '0'");
                    $say = $sql->rowCount();
                    ?>
                    <li><a href="index.php?page=message">» Mesajlar
                            <? if ($say != 0) { ?>
                                </h4>
                                <span class="label label-danger">( <? echo $say; ?> )</span>
                            <? } ?>
                        </a></li>

                    <?
                    $uye = $_SESSION["uye"];
                    $sql = $db->query("SELECT * FROM magazalar WHERE uyeId = '$uye'");
                    if ($sql->rowCount() > 0) {
                        echo '<li><a href="/index.php?page=medit">» Mağaza Bilgilerim</a></li>';
                    }else{echo '<li><a href="/index.php?page=mopen">» Mağaza Aç</a></li>';}

                    ?>



                    <?
                    $uye = $_SESSION["uye"];
                    $sql = $db->query("SELECT * FROM ilanlar WHERE confirm = '0' and uyeId = '$uye'");
                    $say2 = $sql->rowCount();
                    $bugun = date("Y-m-d");
                    $sql = $db->query("SELECT * FROM ilanlar WHERE bitis < '$bugun' and uyeId = '$uye'");
                    $say = $sql->rowCount() + $say2;
                    ?>
                    <li><a href="index.php?page=adverts">» İlan Yönetimi
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
                    <li><a href="index.php?page=kihale">» İhale İşlemlerim</a></li>
                    <li><a href="index.php?page=satisislemlerim">» Satış İşlemlerim
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
                    <li><a href="index.php?page=alisislemlerim">» Alış İşlemlerim
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
                    <li><a href="index.php?page=odemebildirimi">» Ödeme Bildirimi
                            <? if ($say != 0) { ?>
                                </h4>
                                <span class="label label-danger">( <? echo $say; ?> )</span>
                            <? } ?>
                        </a></li>
                    <li><a href="index.php?page=favoriilanlarim">» Favori İlanlarım</a></li>

                    <li><a href="/index.php?page=membership">» Üyeliğim</a></li>
                    <li><a href="/index.php?page=exit">» Çıkış</a></li>


                </div>
                <i class="ac-kapa fa fa-bars fa-2x"><font style="font-size:18px;font-family:arial;text-align: center;font-weight:600;"></font></i>
                <div class="visible-xs" style="color: #fff;font-weight:600;margin-top:-38px;text-align:center;margin-left:30px;"><a href="<?php echo $base_url; ?>"><img border="0" src="../../img/mobillogo.png" width="160" height="34"></a></div>

                <div class="mobil-menu">
                    <?
                    $sql = $db->query("SELECT * FROM category WHERE ustkategoriId = '0' and tip = '0' ORDER BY sira ASC");
                    while ($a = $sql->fetch(PDO::FETCH_OBJ)){
                        echo '<li><a href="kategori-'.$a->Id.'-'.slugify($a->kategori_adi).'.html"><img src="'.$base_url.'ikonlar/'.$a->ikon.'" alt="'.$a->kategori_adi.'" width="20" height="20" class="absmiddle" /> '.$a->kategori_adi.'</span></a></li>';

                    }
                    ?>
                    <br>
                    <li><i class="fa fa-bell-o"  aria-hidden="true"></i> <a href="<?php echo $base_url; ?>acil-ilanlar.html?sayfa=1" style="color:#fff;font-size:14px;font-family:arial;text-align: center;" class="cat_text">Dernières publications</a></li>
                    <li><i class="fa fa-thumbs-down"  aria-hidden="true"></i> <a href="<?php echo $base_url; ?>fiyati-dusenler.html" style="color:#fff;font-size:14px;font-family:arial;text-align: center;" class="cat_text">Prix ​​réduit</a></li>
                    <li><i class="fa fa-shopping-cart" aria-hidden="true"></i> <a href="<?php echo $base_url; ?>get-ilanlar.html" style="color:#fff;font-size:14px;font-family:arial;text-align: center;" class="cat_text">GET İlanlar</a></li>
                    <li><i class="fa fa-building" aria-hidden="true"></i> <a href="<?php echo $base_url; ?>rehber.html?sayfa=1" style="color:#fff;font-size:14px;font-family:arial;text-align: center;" class="cat_text">Annuaire de l'entreprise</a></li>
                    <li><i class="fa fa-briefcase" aria-hidden="true"></i> <a href="<?php echo $base_url; ?>magazalar.html" style="color:#fff;font-size:14px;font-family:arial;text-align: center;" class="cat_text">Magasins</a></li>
                </div>

            <? }?>
        </div>


    </div>




    <form action="index.php" style="margin-top: 45px;margin-bottom:2px;" class="visible-xs" method="get">
        <input type="hidden" name="page" value="search">
        <input type="text" name="keyword" id="keyword" class="form-control" value="" placeholder="Kelime yada ilan numarasına göre ara..." style="min-height: 2em;"  />
        <input  name="submit" value="" type="submit" style="margin-top:-30px;background-image:url(<?php echo $base_url; ?>icon_search.png);background-repeat: repeat-y;width:24px;height:24px;background-color:white;border:0px;float:right;margin-right: 5px;">



    </form>


    <? if ($_GET['page'] == "") { ?>

    <? } ?>
    <div style="min-height:500px">
        <?
        if (!isset($_GET["page"])) {
            include 'filesystems/default.php';
        } elseif ($_GET["page"] == "login") {
            include 'filesystems/login.php';
        } elseif ($_GET["page"] == "register") {
            include 'filesystems/register.php';
        } elseif ($_GET["page"] == "lostpassword") {
            include 'filesystems/lostpassword.php';
        } elseif ($_GET["page"] == "membership") {
            include 'filesystems/membership.php';
        } elseif ($_GET["page"] == "changepassword") {
            include 'filesystems/changepassword.php';
        } elseif ($_GET["page"] == "add") {
            include 'filesystems/add.php';
        } elseif ($_GET["page"] == "add2") {
            include 'filesystems/add2.php';
        } elseif ($_GET["page"] == "fiyatdusur") {
            include 'filesystems/fiyatdusur.php';
        } elseif ($_GET["page"] == "fiyatok") {
            include 'filesystems/fiyatok.php';
        } elseif ($_GET["page"] == "guncelle") {
            include 'filesystems/guncelle.php';
        } elseif ($_GET["page"] == "guncelleok") {
            include 'filesystems/guncelleok.php';
        } elseif ($_GET["page"] == "add3") {
            include 'filesystems/add3.php';
        } elseif ($_GET["page"] == "add4") {
            include 'filesystems/add4.php';
        } elseif ($_GET["page"] == "add5") {
            include 'filesystems/add5.php';
        } elseif ($_GET["page"] == "add6") {
            include 'filesystems/add6.php';
        } elseif ($_GET["page"] == "doping") {
            include 'filesystems/doping.php';
        } elseif ($_GET["page"] == "dopingodeme") {
            include 'filesystems/dopingodeme.php';
        } elseif ($_GET["page"] == "dopingyayinla") {
            include 'filesystems/dopingyayinla.php';
        } elseif ($_GET["page"] == "adverts") {
            include 'filesystems/adverts.php';
        } elseif ($_GET["page"] == "advertsp") {
            include 'filesystems/advertsp.php';
        } elseif ($_GET["page"] == "advertsb") {
            include 'filesystems/advertsb.php';
        } elseif ($_GET["page"] == "getilanlar") {
            include 'filesystems/getilanlar.php';
        } elseif ($_GET["page"] == "son48saat") {
            include 'filesystems/son48.php';
        } elseif ($_GET["page"] == "son1hafta") {
            include 'filesystems/son1hafta.php';
        } elseif ($_GET["page"] == "son1ay") {
            include 'filesystems/son1ay.php';
        } elseif ($_GET["page"] == "fiyatidusenler") {
            include 'filesystems/fiyatidusenler.php';
        } elseif ($_GET["page"] == "harita") {
            include 'filesystems/harita.php';
        } elseif ($_GET["page"] == "act") {
            $c = $_GET["c"];
            $sql2 = $db->query("SELECT * FROM users WHERE aktivasyonkodu = '$c' and aktivasyon = '0'");
            if ($sql2->rowCount() == 0){
                $_SESSION['er'] = 0;
                header("location: login/");
            } else {
                $sqls = $db->prepare("UPDATE users SET aktivasyon=? WHERE aktivasyonkodu = '$c'");
                $ekle = $sqls->execute(array(1));
                $_SESSION['er'] = 1;
                header("location: login/");
            }
        } elseif ($_GET["page"] == "advert_del") {
            $id = $_GET["id"];
            $uye = $_SESSION['uye'];
            $sql2 = $db->prepare("DELETE FROM ilanlar WHERE Id = '{$id}' and uyeId = '$uye'");
            $sql2->execute();
            $sql2 = $db->prepare("DELETE FROM modul_ilan WHERE ilanId = '{$id}'");
            $sql2->execute();
            $sql2 = $db->prepare("DELETE FROM prop_ilan WHERE ilanId = '{$id}'");
            $sql2->execute();

            $dizinyolu = $_SERVER['DOCUMENT_ROOT'];
            $klasor = $dizinyolu . "/fileserver/files/" . $id;
            function rmdirr($klasor) {
                if($objs = glob($klasor."/*")){
                    foreach($objs as $obj) {
                        is_dir($obj)? rmdirr($obj) : unlink($obj);
                    }
                }
                rmdir($klasor);
            }
            rmdirr($klasor);
            header("location: " . $_SERVER['HTTP_REFERER']);
        } elseif ($_GET["page"] == "advert_o") {
            $id = $_GET["id"];
            $uye = $_SESSION['uye'];
            $sql = $db->query("SELECT * FROM ilanlar WHERE Id = '$id' and uyeId = '$uye'");
            $a = $sql->fetch(PDO::FETCH_ASSOC);
            $bugun = date("Y-m-d");
            $date = date("Y-m-d", strtotime($bugun . " +$a[yayin] day"));

            $sqls = $db->prepare("UPDATE ilanlar SET bitis=? WHERE Id = '$id'");
            $ekle = $sqls->execute(array($date));
            header("location: " . $_SERVER['HTTP_REFERER']);
        } elseif ($_GET["page"] == "category") {
            include 'filesystems/category.php';
        } elseif ($_GET["page"] == "hizliarama") {
            include 'filesystems/hizliarama.php';
        } elseif ($_GET["page"] == "anasayfa") {
            include 'filesystems/anasayfa.php';
        } elseif ($_GET["page"] == "acil") {
            include 'filesystems/acil.php';
        } elseif ($_GET["page"] == "ilan") {
            include 'filesystems/ilan.php';
        } elseif ($_GET["page"] == "mesajgonder") {
            include 'filesystems/mesajgonder.php';
        } elseif ($_GET["page"] == "message") {
            include 'filesystems/message.php';
        } elseif ($_GET["page"] == "message2") {
            include 'filesystems/message2.php';
        } elseif ($_GET["page"] == "messageread") {
            include 'filesystems/messageread.php';
        } elseif ($_GET["page"] == "messageread2") {
            include 'filesystems/messageread2.php';
        } elseif ($_GET["page"] == "kullanici") {
            include 'filesystems/kullanici.php';
        } elseif ($_GET["page"] == "sikayet") {
            include 'filesystems/sikayet.php';
        } elseif ($_GET["page"] == "mopen") {
            include 'filesystems/mopen.php';
        } elseif ($_GET["page"] == "magazaodeme") {
            include 'filesystems/magazaodeme.php';
        } elseif ($_GET["page"] == "odemebildirimi") {
            include 'filesystems/odemebildirimi.php';
        } elseif ($_GET["page"] == "favoriilanlarim") {
            include 'filesystems/favoriilanlarim.php';
        } elseif ($_GET["page"] == "medit") {
            include 'filesystems/medit.php';
        } elseif ($_GET["page"] == "banka") {
            include 'filesystems/banka.php';
        } elseif ($_GET["page"] == "yayin") {
            include 'filesystems/yayin.php';
        } elseif ($_GET["page"] == "satinal") {
            include 'filesystems/satinal.php';
        } elseif ($_GET["page"] == "adres") {
            include 'filesystems/adres.php';
        } elseif ($_GET["page"] == "adres2") {
            include 'filesystems/adres2.php';
        } elseif ($_GET["page"] == "ozet") {
            include 'filesystems/ozet.php';
        } elseif ($_GET["page"] == "odeme") {
            include 'filesystems/odeme.php';
        } elseif ($_GET["page"] == "satisislemlerim") {
            include 'filesystems/satisislemlerim.php';
        } elseif ($_GET["page"] == "alisislemlerim") {
            include 'filesystems/alisislemlerim.php';
        } elseif ($_GET["page"] == "siparis") {
            include 'filesystems/siparis.php';
        } elseif ($_GET["page"] == "kargo") {
            include 'filesystems/kargo.php';
        } elseif ($_GET["page"] == "mesajgonder2") {
            include 'filesystems/mesajgonder2.php';
        } elseif ($_GET["page"] == "kargolayacaklarim") {
            include 'filesystems/kargolayacaklarim.php';
        } elseif ($_GET["page"] == "onaybekleyen") {
            include 'filesystems/onaybekleyen.php';
        } elseif ($_GET["page"] == "odemebekleyen") {
            include 'filesystems/odemebekleyen.php';
        } elseif ($_GET["page"] == "tamamlanan") {
            include 'filesystems/tamamlanan.php';
        } elseif ($_GET["page"] == "kargoonay") {
            include 'filesystems/kargoonay.php';
        } elseif ($_GET["page"] == "yorumyap") {
            include 'filesystems/yorumyap.php';
        } elseif ($_GET["page"] == "siparis2") {
            include 'filesystems/siparis2.php';
        } elseif ($_GET["page"] == "kargobekleyen") {
            include 'filesystems/kargobekleyen.php';
        } elseif ($_GET["page"] == "onayimibekleyen") {
            include 'filesystems/onayimibekleyen.php';
        } elseif ($_GET["page"] == "profil") {
            include 'filesystems/profil.php';
        } elseif ($_GET["page"] == "banaozel") {
            include 'filesystems/banaozel.php';
        } elseif ($_GET["page"] == "magazalar") {
            include 'filesystems/magazalar.php';
        } elseif ($_GET["page"] == "getilanlar") {
            include 'filesystems/getilanlar.php';
        } elseif ($_GET["page"] == "search") {
            include 'filesystems/search.php';
        } elseif ($_GET["page"] == "sayfa") {
            include 'filesystems/sayfa.php';
        } elseif ($_GET["page"] == "iletisim") {
            include 'filesystems/iletisim.php';
        } elseif ($_GET["page"] == "ihale") {
            include 'filesystems/ihale.php';
        } elseif ($_GET["page"] == "kihale") {
            include 'filesystems/kihale.php';
        } elseif ($_GET["page"] == "kbihale") {
            include 'filesystems/kbihale.php';
        } elseif ($_GET["page"] == "sss") {
            include 'filesystems/sss.php';
        } elseif ($_GET["page"] == "blog") {
            include 'filesystems/blog.php';
        } elseif ($_GET["page"] == "yazi") {
            include 'filesystems/yazi.php';
        } elseif ($_GET["page"] == "blog") {
            include 'filesystems/blog.php';
        } elseif ($_GET["page"] == "yazi") {
            include 'filesystems/yazi.php';
        } elseif ($_GET["page"] == "rehber") {
            include 'filesystems/rehber.php';
        } elseif ($_GET["page"] == "firma") {
            include 'filesystems/firma.php';
        } elseif ($_GET["page"] == "exit") {
            unset($_SESSION["uye"]);
            unset($_SESSION["adsoyad"]);
            header("location: index.php");
        }
        ?>
    </div>
    <footer>
        <section class="nb-footer">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="footerlogo hidden-xs"><? echo banner(6); ?></div>
                        <center><div style="margin-top:15px;"><img border="0" src="<? echo $base_url; ?>/mobilapps.png" alt="logo" width="235" height="42"></div></center>
                    </div>
                    <div class="col-xs-12 col-sm-3 hidden-xs">
                        <div class="footer-single useful-links">
                            <div class="footer-title">
                                <h2>Information d'entreprise</h2>
                            </div>
                            <ul class="list-unstyled">
                                <li><a href="index.php">Anasayfa <i class="fa fa-angle-right pull-right"></i></a></li>
                                <?
                                $sql = $db->query("SELECT * FROM sayfalar WHERE yer = '1' order by Id ASC");
                                while ($a = $sql->fetch(PDO::FETCH_ASSOC)){
                                    echo '<li><a href="'.$base_url.''.$a["slug"].'.html">'.$a["sayfaadi"].' <i class="fa fa-angle-right pull-right"></i></a></li>';
                                }
                                ?>
                                <li><a href="iletisim.html">İletişim <i class="fa fa-angle-right pull-right"></i></a></li>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3 hidden-xs">
                        <div class="footer-single useful-links">
                            <div class="footer-title">
                                <h2>Nos services</h2>
                            </div>
                            <ul class="list-unstyled">
                                <?
                                $sql = $db->query("SELECT * FROM sayfalar WHERE yer = '2' order by Id ASC");
                                while ($a = $sql->fetch(PDO::FETCH_ASSOC)){
                                    echo '<li><a href="'.$base_url.''.$a["slug"].'.html">'.$a["sayfaadi"].' <i class="fa fa-angle-right pull-right"></i></a></li>';
                                }
                                ?>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3 hidden-xs">
                        <div class="footer-single useful-links">
                            <div class="footer-title">
                                <h2>Gizlilik & Kullanım</h2>
                            </div>
                            <ul class="list-unstyled">
                                <?
                                $sql = $db->query("SELECT * FROM sayfalar WHERE yer = '3' order by Id ASC");
                                while ($a = $sql->fetch(PDO::FETCH_ASSOC)){
                                    echo '<li><a href="'.$base_url.''.$a["slug"].'.html">'.$a["sayfaadi"].' <i class="fa fa-angle-right pull-right"></i></a></li>';
                                }
                                ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="nb-copyright">
            <div class="container">
                <?
                $sql = $db->query("SELECT * FROM sosyalmedya");
                $a12 = $sql->fetch(PDO::FETCH_ASSOC);
                ?>
                <br>
                <center><img class="hidden-xs" border="0" src="<? echo $base_url; ?>bank.png" width="617" height="35"></center>
                <center><!-- GTranslate: https://gtranslate.io/ -->
                    <a href="#" onclick="doGTranslate('tr|ar');return false;" title="Arabic" class="gflag nturl" style="background-position:-100px -0px;"><img src="//gtranslate.net/flags/blank.png" height="32" width="32" alt="Arabic" /></a><a href="#" onclick="doGTranslate('tr|en');return false;" title="English" class="gflag nturl" style="background-position:-0px -0px;"><img src="//gtranslate.net/flags/blank.png" height="32" width="32" alt="English" /></a><a href="#" onclick="doGTranslate('tr|fr');return false;" title="French" class="gflag nturl" style="background-position:-200px -100px;"><img src="//gtranslate.net/flags/blank.png" height="32" width="32" alt="French" /></a><a href="#" onclick="doGTranslate('tr|tr');return false;" title="Turkish" class="gflag nturl" style="background-position:-100px -500px;"><img src="//gtranslate.net/flags/blank.png" height="32" width="32" alt="Turkish" /></a>

                    <style type="text/css">
                        <!--
                        a.gflag {vertical-align:middle;font-size:32px;padding:1px 0;background-repeat:no-repeat;background-image:url(//gtranslate.net/flags/32.png);}
                        a.gflag img {border:0;}
                        a.gflag:hover {background-image:url(//gtranslate.net/flags/32a.png);}
                        #goog-gt-tt {display:none !important;}
                        .goog-te-banner-frame {display:none !important;}
                        .goog-te-menu-value:hover {text-decoration:none !important;}
                        body {top:0 !important;}
                        #google_translate_element2 {display:none!important;}
                        -->
                    </style>

                    <div id="google_translate_element2"></div>
                    <script type="text/javascript">
                        function googleTranslateElementInit2() {new google.translate.TranslateElement({pageLanguage: 'tr',autoDisplay: false}, 'google_translate_element2');}
                    </script><script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit2"></script>


                    <script type="text/javascript">
                        /* <![CDATA[ */
                        eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('6 7(a,b){n{4(2.9){3 c=2.9("o");c.p(b,f,f);a.q(c)}g{3 c=2.r();a.s(\'t\'+b,c)}}u(e){}}6 h(a){4(a.8)a=a.8;4(a==\'\')v;3 b=a.w(\'|\')[1];3 c;3 d=2.x(\'y\');z(3 i=0;i<d.5;i++)4(d[i].A==\'B-C-D\')c=d[i];4(2.j(\'k\')==E||2.j(\'k\').l.5==0||c.5==0||c.l.5==0){F(6(){h(a)},G)}g{c.8=b;7(c,\'m\');7(c,\'m\')}}',43,43,'||document|var|if|length|function|GTranslateFireEvent|value|createEvent||||||true|else|doGTranslate||getElementById|google_translate_element2|innerHTML|change|try|HTMLEvents|initEvent|dispatchEvent|createEventObject|fireEvent|on|catch|return|split|getElementsByTagName|select|for|className|goog|te|combo|null|setTimeout|500'.split('|'),0,{}))
                        /* ]]> */
                    </script>
                </center>
                <center><div style="font-weight:600;padding: 5px;">Bizi Takip Edin ;</div>

                    <a href="<? echo $a12["facebook"];?>" target="blank"><i class="fa fa-facebook-square fa-2x" style="color:#000"></i></a>
                    <a href="<? echo $a12["twitter"];?>" target="blank"><i class="fa fa-twitter-square fa-2x" style="color:#000"></i></a>
                    <a href="<? echo $a12["google"];?>" target="blank"><i class="fa fa-google-plus-square fa-2x" style="color:#000"></i></a>
                    <a href="<? echo $a12["youtube"];?>" target="blank"><i class="fa fa-youtube-square fa-2x" style="color:#000"></i></a>
                    <a href="<? echo $a12["instagram"];?>" target="blank"><i class="fa fa-instagram fa-2x" style="color:#000"></i></a></center>
                <div class="footercop"> <? echo $SiteName; ?> Yer Alan Kullanıcıların Oluşturduğu Tüm İçerik, Görüş Ve Bilgilerin Doğruluğu, Eksiksiz Ve Değişmez Olduğu, Yayınlanması İle İlgili Yasal Yükümlülükler İçeriği Oluşturan Kullanıcıya Aittir.Bu İçeriğin, Görüş Ve Bilgilerin Yanlışlık, Eksiklik Veya Yasalarla Düzenlenmiş Kurallara Aykırılığından Hiçbir Şekilde Sitemiz Sorumlu Değildir.<br>
                    Sorularınız İçin İlan Sahibi İle İrtibata Geçebilirsiniz. </div>

            </div>

        </section>
    </footer>
    <script>
        var acikmi4 = 1;
        $(".ac-kapasag").click(function(){
            if ( acikmi4 == 1 ) {
                $('.mobil-menuqq').animate({right: '-250px'}, 600);
                $('body').animate({right: '250px'}, 800);
                acikmi4 = 2;
            } else {
                $('.mobil-menuqq').animate({right: '0px'},600);
                $('body').animate({right: '-250px'}, 800);
                acikmi4 = 1;
            }
        });
    </script>
    <script>
        var acikmi = 1;
        $(".ac-kapa").click(function(){
            if ( acikmi == 1 ) {
                $('.mobil-menu').animate({left: '0px'}, 600);
                $('body').animate({left: '250px'}, 800);
                acikmi = 2;
            } else {
                $('.mobil-menu').animate({left: '-250px'},600);
                $('body').animate({left: '0px'}, 800);
                acikmi = 1;
            }
        });
    </script>

    </body>
    </html>
<? ob_end_flush(); ?>