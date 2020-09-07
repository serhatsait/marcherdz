<?
header("Pragma: no-cache");
$id = $_GET['id'];
$sql = $db->query("SELECT * FROM ilanlar WHERE Id = '$id'");
$row = $sql->fetch(PDO::FETCH_ASSOC);
$il = $db->query("SELECT * FROM city WHERE id = '{$row['city']}'");
$ilyaz = $il->fetch(PDO::FETCH_ASSOC);
$ilce = $db->query("SELECT * FROM county WHERE id = '{$row['districts']}'");
$ilceyaz = $ilce->fetch(PDO::FETCH_ASSOC);
$mahalle = $db->query("SELECT * FROM locality WHERE id = '{$row['locality']}'");
$mahalleyaz = $mahalle->fetch(PDO::FETCH_ASSOC);


$gosterim = $row["gosterim"] + 1;
$guncelle = $db->prepare("UPDATE ilanlar SET gosterim=? WHERE Id = '$id'");
$gg = $guncelle->execute(array($gosterim));

function ay2($tarih)
{
    $tarih = preg_split("/[-\\:\\/ ]/", $tarih);
    $gun = $tarih[2];
    $ay = $tarih[1];
    $yil = $tarih[0];
    $ayadlari = array("01" => "Ocak", "02" => "Şubat", "03" => "Mart", "04" => "Nisan", "05" => "Mayıs", "06" => "Haziran", "07" => "Temmuz", "08" => "Ağustos", "09" => "Eylül", "10" => "Ekim", "11" => "Kasım", "12" => "Aralık");
    $tarih = $gun . " " . $ayadlari[$ay] . " " . $yil;
    return $tarih;
}


$sql2 = $db->query("SELECT * FROM images WHERE ilanId = '$id' ORDER BY s ASC LIMIT 1");
if ($sql2->rowCount() == 0) {
    $src = "img/no.png";
} else {
    $row2 = $sql2->fetch(PDO::FETCH_ASSOC);
    $src = $base_url . "fileserver/files/" . $row["Id"] . "/" . $row2["name"];
}
?>
    <script>(function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/tr_TR/sdk.js#xfbml=1&version=v2.8";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
    <SCRIPT LANGUAGE="JavaScript">
        function print_current_page() {
            window.print();
        }
    </script>
    <script>
        $(document).ready(function () {
            $(".tab-menu a").click(function (event) {
                event.preventDefault();
                $(this).parent().addClass("current");
                $(this).parent().siblings().removeClass("current");
                var tab = $(this).attr("href");
                $(".tab-content").not(tab).css("display", "none");
                $(tab).fadeIn();
            });
        });
    </script>
    <div class="container top15">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-9 col-sm-12 col-xs12">
                        <h3 class="ilan-title"><i class="fa fa-caret-right"
                                                  aria-hidden="true"></i> <? echo $row["title"]; ?></h3>
                    </div>
                    <div class="hidden-xs hidden-sm"><span class="pull-right"
                                                           style="margin-right:15px;margin-top: 5px;"><a
                                    href="javascript:void(0)" onClick="fav()" style="font-size:12px;"><i
                                        class="fa fa-star" aria-hidden="true"></i> Favorilerime Ekle</a> <a
                                    href="index.php?page=sikayet&id=<? echo $id; ?>" onClick="return sikayet()"
                                    style="font-size:12px;"><i class="fa fa-ban" aria-hidden="true"></i> Şikayet Et</a> <a
                                    href="javascript:window.print()" style="font-size:12px;"><i class="fa fa-print"
                                                                                                aria-hidden="true"></i> Yazdır</a>
                    </div>
                    </span></div>
                <hr style="margin-top:10px; margin-bottom:10px">
                <?
                $kategoriler = "";
                if ($row["category10"] != 0) {
                    $cat = $db->query("SELECT * FROM category WHERE Id = '{$row['category10']}'");
                    $c = $cat->fetch(PDO::FETCH_ASSOC);
                    $kategoriler .= ' » <a href="kategori-' . $c["Id"] . '-' . slugify($c["kategori_adi"]) . '.html">' . $c["kategori_adi"] . '</a>';
                }
                if ($row["category9"] != 0) {
                    $cat = $db->query("SELECT * FROM category WHERE Id = '{$row['category9']}'");
                    $c = $cat->fetch(PDO::FETCH_ASSOC);
                    $kategoriler .= ' » <a href="kategori-' . $c["Id"] . '-' . slugify($c["kategori_adi"]) . '.html">' . $c["kategori_adi"] . '</a>';
                }
                if ($row["category8"] != 0) {
                    $cat = $db->query("SELECT * FROM category WHERE Id = '{$row['category8']}'");
                    $c = $cat->fetch(PDO::FETCH_ASSOC);
                    $kategoriler .= ' » <a href="kategori-' . $c["Id"] . '-' . slugify($c["kategori_adi"]) . '.html">' . $c["kategori_adi"] . '</a>';
                }
                if ($row["category7"] != 0) {
                    $cat = $db->query("SELECT * FROM category WHERE Id = '{$row['category7']}'");
                    $c = $cat->fetch(PDO::FETCH_ASSOC);
                    $kategoriler .= ' » <a href="kategori-' . $c["Id"] . '-' . slugify($c["kategori_adi"]) . '.html">' . $c["kategori_adi"] . '</a>';
                }
                if ($row["category6"] != 0) {
                    $cat = $db->query("SELECT * FROM category WHERE Id = '{$row['category6']}'");
                    $c = $cat->fetch(PDO::FETCH_ASSOC);
                    $kategoriler .= ' » <a href="kategori-' . $c["Id"] . '-' . slugify($c["kategori_adi"]) . '.html">' . $c["kategori_adi"] . '</a>';
                }
                if ($row["category5"] != 0) {
                    $cat = $db->query("SELECT * FROM category WHERE Id = '{$row['category5']}'");
                    $c = $cat->fetch(PDO::FETCH_ASSOC);
                    $kategoriler .= ' » <a href="kategori-' . $c["Id"] . '-' . slugify($c["kategori_adi"]) . '.html">' . $c["kategori_adi"] . '</a>';
                }
                if ($row["category4"] != 0) {
                    $cat = $db->query("SELECT * FROM category WHERE Id = '{$row['category4']}'");
                    $c = $cat->fetch(PDO::FETCH_ASSOC);
                    $kategoriler .= ' » <a href="kategori-' . $c["Id"] . '-' . slugify($c["kategori_adi"]) . '.html">' . $c["kategori_adi"] . '</a>';
                }
                if ($row["category3"] != 0) {
                    $cat = $db->query("SELECT * FROM category WHERE Id = '{$row['category3']}'");
                    $c = $cat->fetch(PDO::FETCH_ASSOC);
                    $kategoriler .= ' » <a href="kategori-' . $c["Id"] . '-' . slugify($c["kategori_adi"]) . '.html">' . $c["kategori_adi"] . '</a>';
                }
                if ($row["category2"] != 0) {
                    $cat = $db->query("SELECT * FROM category WHERE Id = '{$row['category2']}'");
                    $c = $cat->fetch(PDO::FETCH_ASSOC);
                    $kategoriler .= ' » <a href="kategori-' . $c["Id"] . '-' . slugify($c["kategori_adi"]) . '.html">' . $c["kategori_adi"] . '</a>';
                }
                if ($row["category1"] != 0) {
                    $cat = $db->query("SELECT * FROM category WHERE Id = '{$row['category1']}'");
                    $c = $cat->fetch(PDO::FETCH_ASSOC);
                    $kategoriler .= ' » <a href="kategori-' . $c["Id"] . '-' . slugify($c["kategori_adi"]) . '.html">' . $c["kategori_adi"] . '</a>';
                }

                $ct = explode("»", $kategoriler);
                $kac = count($ct) - 1;
                $son = $ct[$kac];
                preg_match('|<a href="(.*?)"|', $son, $lin);
                ?>
                <link href="assets/js/fotorama.css" rel="stylesheet">
                <script src="assets/js/fotorama.js"></script>
                <link href="assets/css/nivo-lightbox.css" rel="stylesheet">
                <link href="assets/css/themes/default/default.css" rel="stylesheet">
                <script src="assets/css/nivo-lightbox.js"></script>

                <script>
                    $(document).ready(function () {
                        $('a').nivoLightbox();
                    });
                </script>

                <!-- 2. Add images to <div class="fotorama"></div>. -->

                <div class="ilan-kategori-link"><a href="index.php">Anasayfa</a> <? echo $kategoriler; ?> </div>
                <div class="row">
                    <div class="col-md-8 col-sm-12 col-xs-12">
                        <div class="row ">
                            <div class="col-xs-12 col-sm-6">
                                <div class="fotorama" data-nav="thumbs" data-allowfullscreen="true" data-keyboard="true"
                                     data-thumbheight="75px" data-thumbwidth="100px">
                                    <?
                                    $resim = $db->query("SELECT * FROM images WHERE ilanId = '$id' ORDER BY s ASC LIMIT 1");
                                    if ($resim->rowCount() == 0) {
                                        $src = "img/no.png";

                                        echo '<img src="' . $src . '" >';

                                    }

                                    $sql12 = $db->query("SELECT * FROM images WHERE ilanId = '$id' ORDER BY s ASC LIMIT 20");

                                    $ks = 1;
                                    $kac = $sql12->rowCount();
                                    $i = 0;
                                    while ($l = $sql12->fetch(PDO::FETCH_ASSOC)) {
                                        echo '
        <a href="' . $base_url . 'fileserver/files/' . $id . '/' . $l["name"] . '" id="img_' . $l[Id] . '"><img src="' . $base_url . 'fileserver/files/' . $id . '/' . $l["name"] . '" id="img_' . $l[Id] . '" ></a>
    ';
                                        $i++;
                                    }
                                    ?>

                                </div>

                            </div>
                            <div class="col-sm-1">&nbsp;</div>
                            <div class="col-xs-12 col-sm-5">
                                <? if ($row["price"] != 0) { ?>
                                    <center><strong
                                                style="font-size:26px;font-family:Verdana;"><? echo number_format($row["price"]) . " " . $row["exchange"]; ?></strong>
                                    </center><br>
                                <? } ?>
                                <center><span style="font-size:12px;font-weight:600;"><i class="fa fa-map-marker"
                                                                                         aria-hidden="true"></i> <? echo '<a href="' . $lin[1] . '?il=' . $ilyaz["id"] . '&daralt=1&sayfa=1">' . $ilyaz["il_adi"] . '</a> / <a href="' . $lin[1] . '?il=' . $ilyaz["id"] . '&ilce[]=' . $ilceyaz["id"] . '&daralt=1&sayfa=1">' . $ilceyaz["county_adi"] . '</a> / <a href="' . $lin[1] . '?il=' . $ilyaz["id"] . '&ilce[]=' . $ilceyaz["id"] . '&mahalle[]=' . $mahalleyaz["id"] . '&daralt=1&sayfa=1">' . $mahalleyaz["districtname"] . '</a>'; ?> </span>
                                </center>
                                <hr style="margin-top:7px; margin-bottom:7px">
                                <div class="row font12">
                                    <div class="col-xs-5 st">İlan No</div>
                                    <div class="col-xs-7"><? echo $id; ?></div>
                                </div>
                                <hr class="hr">
                                <div class="row font12">
                                    <div class="col-xs-5 st">İlan Tarihi</div>
                                    <div class="col-xs-7">
                                        <? $e = explode("-", $row["dates"]);
                                        echo "$e[2]-$e[1]-$e[0]"; ?>
                                    </div>
                                </div>
                                <hr class="hr">
                                <?
                                $sql4 = $db->query("SELECT * FROM category WHERE Id = '{$row['category1']}'");
                                $row4 = $sql4->fetch(PDO::FETCH_ASSOC);
                                $sql5 = $db->query("SELECT * FROM modul_ilan WHERE ilanId = '{$id}'");
                                while ($row5 = $sql5->fetch(PDO::FETCH_ASSOC)) {

                                    $sql6 = $db->query("SELECT * FROM  modulitems WHERE Id = '{$row5['itemId']}'");
                                    $row6 = $sql6->fetch(PDO::FETCH_ASSOC);
                                    $sql7 = $db->query("SELECT * FROM  modulitemsselect WHERE Id = '{$row5['selects']}'");
                                    $row7 = $sql7->fetch(PDO::FETCH_ASSOC);
                                    if ($row5["type"] != 1) {
                                        echo '
                            <div class="row font12">
                            <div class="col-xs-5 st">' . $row6["name"] . '</div>
                            <div class="col-xs-7">' . $row7["name"] . '</div>
                            </div>
                            <hr class="hr">
                            ';
                                    } else {
                                        echo '
                            <div class="row font12">
                            <div class="col-xs-5 st">' . $row6["name"] . '</div>
                            <div class="col-xs-7">' . $row5["selects"] . '</div>
                            </div>
                            <hr class="hr">
                            ';

                                    }
                                }
                                if ($row["type"] == 1) {
                                    echo '
                            <div class="row font12">
                            <div class="col-xs-5 st">Kargo Ücreti</div>
                            <div class="col-xs-7">';
                                    if ($row["cargoprice"] == 0) {
                                        echo 'Ücretsiz Kargo';
                                    } else {
                                        echo 'Alıcı Öder';
                                    }
                                    echo '</div>
                            </div>
                            <hr class="hr">
                            ';
                                    echo '
                            <div class="row font12">
                            <div class="col-xs-5 st">Kargo Süresi</div>
                            <div class="col-xs-7">' . $row["cargoarrive"] . ' İş Günü</div>
                            </div>
                            <hr class="hr">
							
                            ';

                                    echo '<a href="index.php?page=satinal&id=' . $id . '" class="btn btn-danger btn-block" style="margin-top:10px">Hemen Satın Al</a>';
                                }

                                if ($row["type"] == 2) {
                                    if ($row["price"] != 0) {
                                        echo '
                            <div class="row font12">
                            <div class="col-xs-5 st">Kargo Ücreti</div>
                            <div class="col-xs-7">';
                                        if ($row["cargoprice"] == 0) {
                                            echo 'Ücretsiz Kargo';
                                        } else {
                                            echo 'Alıcı Öder';
                                        }
                                        echo '</div>
                            </div>
                            <hr class="hr">
                            ';
                                        echo '
                            <div class="row font12">
                            <div class="col-xs-5 st">Kargo Süresi</div>
                            <div class="col-xs-7">' . $row["cargoarrive"] . ' İş Günü</div>
                            </div>
                            <hr class="hr">
                            ';
                                        echo '';
                                    }
                                }
                                ?>
                                <? if ($row["type"] == 2) { ?>
                                    <script src="js/jquery.countdown.js"></script>
                                    <div class="panel panel-default"
                                         style="margin-top:10px !important; border-radius:0px !important">
                                        <div class="panel-heading"
                                             style="font-size:12px; background-color:#ffab00 !important"> Kalan Süre :
                                            <b><span id="getting-started"></span></b>
                                            <?
                                            $tm = str_replace("-", "/", $row["bitiszamani"]);
                                            $ee = explode(" ", $tm);
                                            $ll = explode("/", $ee[0]);
                                            $tm = $ll[2] . "/" . $ll[1] . "/" . $ll[0] . " " . $ee[1];
                                            ?>
                                            <script type="text/javascript">
                                                $("#getting-started").countdown("<? echo $tm; ?>:00", function (event) {
                                                    $(this).text(event.strftime('%D Gün %H:%M:%S'));
                                                });
                                            </script>
                                        </div>
                                        <div class="panel-body">
                                            <div style="font-size:12px; color:red; padding-bottom:5px">İhale Bitiş
                                                Tarihi : <? echo $ee[0]; ?></div>
                                            <div style="font-size:14px; font-weight:bold; padding-bottom:8px">
                                                Başlangıç: <? echo number_format($row["fiyat2"]); ?> TL
                                            </div>
                                            <div class="input-group">
                                                <input type="text" name="tt" id="tt" class="form-control money"
                                                       placeholder="0.00 TL" style="font-size:12px">
                                                <span class="input-group-btn">
                    <button class="btn btn-danger" type="button"
                            style="font-size: 12px !important;padding: 8px !important;border-bottom: solid 1px #d9534f !important;"
                            onClick="teklif()">Teklif Ver</button>
                    </span></div>
                                            <hr style="margin-top:12px; margin-bottom:0px">
                                            <div style="font-size:12px; padding-top:8px">Minimum Artış :
                                                <b><? echo number_format($row["fiyat3"]); ?> TL</b></div>
                                            <?
                                            $sql1 = $db->query("SELECT * FROM teklifler WHERE ilanId = '$id' ORDER BY Id DESC LIMIT 1");
                                            $ax1 = $sql1->fetch(PDO::FETCH_ASSOC);
                                            ?>
                                            <div style="font-size:12px; padding-top:8px">Son Teklif :
                                                <b><? echo number_format($ax1["tutar"]); ?> TL</b></div>
                                        </div>
                                    </div>
                                <? } ?>
                            </div>
                        </div>
                    </div>
                    <?
                    $sql8 = $db->query("SELECT * FROM users WHERE Id = '{$row['uyeId']}'");
                    $row8 = $sql8->fetch(PDO::FETCH_ASSOC);
                    $sql9 = $db->query("SELECT * FROM magazalar WHERE uyeId = '{$row8['Id']}'");
                    $a9 = $sql9->fetch(PDO::FETCH_ASSOC);
                    $b = str_replace("http://", "", $base_url);
                    $b = rtrim($b, "/");
                    $murl = $SiteName;
                    ?>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="userbox"><strong style="font-size:16px">
                                <center><i class="fa fa-check" style="color: green;"
                                           aria-hidden="true"></i> <? echo $row8["ad_soyad"]; ?></center>
                            </strong>
                            <center><strong style="font-size:12px">Üyelik Tarihi : <font
                                            color="#636363"><? echo ay2($row8["kayit_tarihi"]); ?></font></strong>
                            </center>

                            <center>
                                <div style="padding-top:5px; color: #113998; font-size:12px; font-weight:600;"><a
                                            href="index.php?page=mesajgonder&id=<? echo $id; ?>"
                                            style="color: #113998;"><i class="fa fa-envelope" aria-hidden="true"></i>
                                        Mesaj Gönder</a> |
                                    <? if ($sql9->rowCount() > 0) { ?>
                                        <a href="http://<? echo $a9["adres"]; ?>.<? echo $murl; ?>"
                                           style="color: #113998;"><i class="fa fa-shopping-cart"
                                                                      aria-hidden="true"></i> Mağazaya Git</a> | <a
                                                href="index.php?page=profil&id=<? echo $row8["Id"]; ?>"
                                                style="padding-top:5px; color: #113998; font-size:12px; font-weight:600;"><i
                                                    class="fa fa-balance-scale" aria-hidden="true"></i> Profil</a>
                                    <? } else { ?>
                                        <a href="<? echo $row8["Id"]; ?>-kullanici-ilanlari.html"
                                           style="color: #113998;"><i class="fa fa-user-o" aria-hidden="true"></i> Tüm
                                            İlanları</a>
                                    <? } ?>
                                </div>
                            </center>


                            <?
                            if ($sql9->rowCount() > 0) {
                                if ($a9["logo"] == "") {
                                } else {
                                    echo '<a href="http://' . $a9["adres"] . '.' . $murl . '" class="btn btn-default btn-block" style="border-color:#d2cfcf !important; margin-bottom: 10px; text-align:center !important; margin-top:10px !important"><i class="fa fa-star" aria-hidden="true"></i> Kullanıcı Mağazası<br><a href="http://' . $a9["adres"] . '.' . $murl . '"><center><img src="uploads/' . $a9["logo"] . '" width="70%"></center></a></a>';


                                }
                            }
                            ?>

                            <? if ($row["phone"] == 1) { ?>
                                <div class="userbox2">
                                    <div class="row">

                                        <div class="col-xs-4 glyphicon glyphicon-phone-alt"><strong><font size="2"
                                                                                                          face="Verdana">
                                                    Tel :</font></strong></div>
                                        <div class="col-xs-8"><a href="tel:<? echo $row8["telefon"]; ?>"><font size="2"
                                                                                                               face="Verdana"><? echo $row8["telefon"]; ?></font></a>
                                        </div>
                                    </div>
                                    <hr class="hr">
                                    <div class="row">
                                        <div class="col-xs-4 glyphicon glyphicon-phone"><strong><font size="2"
                                                                                                      face="Verdana">
                                                    Gsm :</font></strong></div>
                                        <div class="col-xs-8"><a href="tel:<? echo $row8["gsm"]; ?>"><font size="2"
                                                                                                           face="Verdana"><? echo $row8["gsm"]; ?></font></a>
                                        </div>
                                    </div>
                                </div>
                            <? } ?>
                            <style type="text/css">

                                #lean_overlay {
                                    position: fixed;
                                    z-index: 10000;
                                    top: 0px;
                                    left: 0px;
                                    height: 100%;
                                    width: 100%;
                                    background: #000;
                                    display: none;
                                }

                                #test {
                                    width: 800px;
                                    padding: 30px;
                                    display: none;

                                    background: #FFF;
                                    border-radius: 5px;
                                    -moz-border-radius: 5px;
                                    -webkit-border-radius: 5px;
                                    box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.7);
                                    -webkit-box-shadow: 0 0 4px rgba(0, 0, 0, 0.7);
                                    -moz-box-shadow: 0 0px 4px rgba(0, 0, 0, 0.7);

                                }

                                #test p {
                                    color: #666;
                                    text-shadow: none;
                                }

                            </style>


                            <script type="text/javascript">
                                function fbs_click(width, height) {
                                    var leftPosition, topPosition;
                                    //Allow for borders.
                                    leftPosition = (window.screen.width / 2) - ((width / 2) + 10);
                                    //Allow for title and status bars.
                                    topPosition = (window.screen.height / 2) - ((height / 2) + 50);
                                    var windowFeatures = "status=no,height=" + height + ",width=" + width + ",resizable=yes,left=" + leftPosition + ",top=" + topPosition + ",screenX=" + leftPosition + ",screenY=" + topPosition + ",toolbar=no,menubar=no,scrollbars=no,location=no,directories=no";
                                    u = location.href;
                                    t = document.title;
                                    window.open('http://www.facebook.com/sharer.php?u=' + encodeURIComponent(u) + '&t=' + encodeURIComponent(t), 'sharer', windowFeatures);
                                    return false;
                                }
                            </script>
                            <a href="http://www.facebook.com/share.php?u=<? echo $fbadres; ?>"
                               onClick="return fbs_click(650, 450)" target="_blank" title="">
                                <button style="width:100%; margin-top:10px;" type="button" class="btn btn-facebook "><i
                                            class="fa fa-facebook fa-2"></i> Facebook'ta Paylaş
                                </button>
                            </a>
                            <style>
                                .btn-facebook {
                                    color: #fff;
                                    background-color: #4C67A1;
                                }

                                .btn-facebook:hover {
                                    color: #fff;
                                    background-color: #405D9B;
                                }

                                .btn-facebook:focus {
                                    color: #fff;
                                }
                            </style>

                            <center><h6 class="trustSafetyTitle"><font size="2" face="Arial"><img border="0"
                                                                                                  src="../../img/guvenlik.png"
                                                                                                  width="24"
                                                                                                  height="26"><b>
                                            Güvenlik İpuçları</b></font></h6>
                                <p><font size="2" face="Arial">İlgilendiğiniz aracı veya emlak ilanını görmeden kapora
                                        olarak bir ödeme yapmayın, para göndermeyin.</font></p>
                                <center>
                                    <center>
                                        <script type="text/javascript"
                                                src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ad1a9551d131728"></script>
                                        <div class="addthis_inline_share_toolbox"></div>
                                    </center>
                        </div>
                        <div style="margin-top:10px"><? echo banner(7); ?></div>
                    </div>
                </div>
            </div>
        </div>
        <? if ($row["type"] == 2) { ?>
            <div class="panel panel-default">
                <div class="panel-heading">Teklifler</div>
                <div class="panel-body">
                    <?
                    $sqlxx = $db->query("SELECT * FROM teklifler WHERE ilanId = '$id' ORDER BY Id DESC");
                    if ($sqlxx->rowCount() > 0) { ?>
                        <table id="example" class="table table-striped table-bordered dt-responsive nowrap"
                               cellspacing="0" width="100%" style="font-size:12px">
                            <thead>
                            <tr>
                                <th width="25%">Üye</th>
                                <th width="25%" style="text-align:center !important">Tarih</th>
                                <th width="25%" style="text-align:center !important">Tutar</th>
                                <th width="25%" style="text-align:center !important">Şehir</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?

                            while ($xx = $sqlxx->fetch(PDO::FETCH_ASSOC)) {
                                $sqlx2 = $db->query("SELECT * FROM users WHERE Id = '{$xx['uyeId']}'");
                                $x2 = $sqlx2->fetch(PDO::FETCH_ASSOC);

                                $sqlx4 = $db->query("SELECT * FROM city WHERE Id = '{$x2['il']}'");
                                $x4 = $sqlx4->fetch(PDO::FETCH_ASSOC);
                                if ($x4["il_adi"] == "") {
                                    $x4["il_adi"] = "Belirtilmemiş";
                                }
                                echo '
		<tr>
            <td width="25%">' . $x2["ad_soyad"] . '</td>
            <td width="25%" style="text-align:center !important">' . $xx["tarih"] . '</td>
            <td width="25%" style="text-align:center !important">' . $xx["tutar"] . ' TL</td>
			<td width="25%" style="text-align:center !important">' . $x4["il_adi"] . '</td>
	    </tr>
		';
                            }
                            ?>
                            </tbody>
                        </table>
                    <? } else { ?>
                        İlana henüz teklif verilmedi...
                    <? } ?>
                </div>
            </div>
        <? } ?>


        <ul class="tab-menu">
            <li class="current"><a href="#tab1"><i class="fa fa-info" aria-hidden="true"></i> İlan Detayları</a></li>
            <li><a href="#tab2"><i class="fa fa-map-marker" aria-hidden="true"></i> İlan Konumu</a></li>
            <li class="hidden-xs"><a href="#tab3"><i class="fa fa-street-view" aria-hidden="true"></i> Sokak
                    Görünümü</a></li>
            <li class="hidden-xs"><a href="#tab4"><i class="fa fa-clone" aria-hidden="true"></i> Benzer İlanlar</a></li>
        </ul>
        <div class="tab-container">
            <div id="tab1" class="tab-content">
                <div class="panel panel-default">
                    <div class="panel-heading"><i class="fa fa-align-right" aria-hidden="true"></i> İlan Açıklaması
                    </div>
                </div>
                <div class="panel-body"><? echo html_entity_decode($row["content"]); ?></div>
                <br>
                <center>
                    <div class="hit" style="font-size:12px"><strong><i class="fa fa-eye"></i> <? echo $gosterim; ?>
                        </strong> Kişi Tarafından Görüntülendi.
                    </div>
                </center>
                <? $sql5 = $db->query("SELECT * FROM groups WHERE modulId = '{$row4['modul']}'");
                if ($sql5->rowCount() != 0) { ?>
                    <div class="panel panel-default">
                        <div class="panel-heading"><i class="fa fa-check-square-o" aria-hidden="true"></i> Özellikler
                        </div>
                        <div class="panel-body">
                            <br>
                            <style>
                                @media (max-width: 768px) {
                                    .col-xs-6 {
                                        width: 80.3%;
                                    }
                                }
                            </style>
                            <?
                            while ($row5 = $sql5->fetch(PDO::FETCH_ASSOC)) {
                                echo '<h4 style="font-size:14px; margin:0px; padding:0px; font-weight:bold; padding-bottom:10px; border-bottom:solid 1px #ededed; margin-bottom:10px">' . $row5["name"] . '</h4>';
                                echo '<div class="row" style="font-size:12px; margin-bottom:15px; color:#999;border: 1px solid #ffeaa5;background: #fffced;">';
                                $sql6 = $db->query("SELECT * FROM prop WHERE modulId = '{$row4['modul']}' and groupId = '{$row5['Id']}'");
                                while ($row6 = $sql6->fetch(PDO::FETCH_ASSOC)) {
                                    $sor = $db->query("SELECT * FROM prop_ilan WHERE ilanId = '$id' and propId = '{$row6['Id']}'");
                                    $sor = $sor->fetch(PDO::FETCH_ASSOC);
                                    if ($sor["val"] == 1) {
                                        echo '<div class="col-xs-6 col-sm-3" style="color:#000; font-weight:bold;padding: 5px;"><img src="img/tick.png" height="15" width="15"> ' . $row6["name"] . '</div>';
                                    } else {
                                        echo '<div class="col-xs-6 col-sm-3" style="padding: 5px;"><img src="img/noapp.png" width="15"> ' . $row6["name"] . '</div>';
                                    }
                                }
                                echo '</div>';
                            }
                            ?>
                        </div>
                    </div>
                <? } ?>
            </div>
            <div id="tab2" class="tab-content">
                <div class="panel panel-default">
                    <div class="panel-heading">Konum</div>
                    <div class="panel-body">
                        <style> #map {
                                height: 400px;
                                width: 100%;
                            } </style>
                        <div id="map"></div>
                        <script>
                            function initMap() {
                                var uluru = {lat: <? echo $row["lat"]; ?>, lng: <? echo $row["lng"]; ?>};
                                var map = new google.maps.Map(document.getElementById('map'), {
                                    zoom: <? echo $row["zoom"]; ?>,
                                    center: uluru
                                });
                                var marker = new google.maps.Marker({
                                    position: uluru,
                                    map: map
                                });
                            }
                        </script>
                        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCpxv2EoVBP72pIqOHnzehHqTkWRWCw1Nc&callback=initMap"></script>


                    </div>
                </div>
            </div>
            <div id="tab3" class="tab-content">
                <div class="panel panel-default">
                    <div class="panel-heading">Sokak Görünümü</div>


                    <iframe class="map-top" width="100%" height="420"
                            src="https://www.google.com/maps/embed/v1/streetview?key=AIzaSyCpxv2EoVBP72pIqOHnzehHqTkWRWCw1Nc&location=<? echo $row["lat"]; ?>, <? echo $row["lng"]; ?>&pitch=5&heading=180&fov=75"
                            allowfullscreen></iframe>

                </div>
            </div>
            <div id="tab4" class="tab-content">
                <div class="panel panel-default">
                    <div class="panel-heading">Benzer İlanlar</div>
                    <div class="panel-body">
                        <div class="row no-gutter">

                            <?
                            $bugun = date("Y-m-d");
                            $sqlsor = $db->query("SELECT * FROM ilanlar WHERE 
						category1 = '{$row['category1']}' and  
						category2 = '{$row['category2']}' and 
						category3 = '{$row['category3']}' and 
						category4 = '{$row['category4']}' and 
						category5 = '{$row['category5']}' and 
						category6 = '{$row['category6']}' and 
						category7 = '{$row['category7']}' and 
						category8 = '{$row['category8']}' and 
						category9 = '{$row['category9']}' and 
						category10 = '{$row['category10']}' and (bitis >= '$bugun') and confirm = '1' ORDER BY Id DESC LIMIT 24");

                            while ($row = $sqlsor->fetch(PDO::FETCH_ASSOC)) {
                                $resim = $db->query("SELECT * FROM images WHERE ilanId = '{$row['Id']}' ORDER BY s ASC LIMIT 1");
                                if ($resim->rowCount() == 0) {
                                    $src = "img/no.png";
                                } else {
                                    $r = $resim->fetch(PDO::FETCH_ASSOC);
                                    $src = $base_url . "fileserver/files/" . $row["Id"] . "/thumbnail/" . $r["name"];
                                }
                                echo '
                        <div class="col-xs-6 col-sm-3 col-md-2">
                        <div class="adv2">
                        <div class="image1"><a href="  i-' . $row["Id"] . '-' . slugify($row["title"]) . '.html" alt="' . $row["title"] . '" title="' . $row["title"] . '"><img src="' . $src . '" alt="' . $row["title"] . '" width="93" height="75"/></a></div>
						<div class="box_type" style="position: absolute;top: 2px;right:28px;background: rgba(0,0,0,0.5);color: #fff;border-radius: 4px;font-weight:600;font-size: 12px;-webkit-border-bottom-left-radius: 3px;-moz-border-radius-bottomleft: 3px;border-bottom-left-radius: 3px;">' . number_format($row[price]) . ' ' . $row[exchange] . '</div>
                        <div class="adv2-title" style="font-size:11px;margin-top:-10px;"><a href="i-' . $row["Id"] . '-' . slugify($row["title"]) . '.html" alt="' . $row["title"] . '" title="' . $row["title"] . '">' . ucfirst(mb_substr($row["title"], 0, 12)) . '..</a></div>
                        </div>
                        </div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div style="margin-top:10px; margin-bottom:10px"><? echo banner(3); ?></div>
    </div>


    <script>
        function fav() {
            <? if ($_SESSION['uye'] == ""){ ?>
            alert("İlanı favorilerinize eklemek için üye girişi yapınız");
            <? } else { ?>
            if (confirm("İlanı favorilerinize eklemek istediğinize eminmisiniz ?")) {
                $.post("favori.php", {id: "<? echo $_GET["id"]; ?>"});
                alert("İlan favorilerinize eklendi");
            }
            <? } ?>
        }

        function sikayet() {
            <? if ($_SESSION['uye'] == ""){ ?>
            alert("İlanı şikayet etmek için üye girişi yapınız");
            return false;
            <? } else { ?>
            return true;
            <? } ?>
        }

        function teklif() {
            <? if ($_SESSION['uye'] == ""){ ?>
            $("#error").html("Teklif verebilmeniz için üye girişi yapmanız gerekmektedir.");
            $('#myModal').modal("show");
            <? } else { ?>
            var e = $("#tt").val();
            var f = "<? echo $id; ?>";
            if (e == "") {
                $("#error").html("Teklif tutarını belirtmediniz");
                $('#myModal').modal("show");
            } else {
                $.post('filesystems/teklif.php', {tutar: e, id: f}, function (output) {
                    if (output == 0) {
                        $("#error").html("Teklif tutarı son verilen tekliften büyük olmalıdır");
                        $('#myModal').modal("show");
                    } else if (output == 1) {
                        $("#error").html("Teklif tutarı minimum artış tutarından büyük olmalıdır");
                        $('#myModal').modal("show");
                    } else if (output == 2) {
                        $("#error").html("Teklifiniz başarıyla alındı");
                        $('#myModal').modal("show");
                        window.location.reload();
                    } else if (output == 3) {
                        $("#error").html("Teklif tutarı başlangıç fiyatından büyük olmalıdır");
                        $('#myModal').modal("show");
                    } else if (output == 5) {
                        $("#error").html("İhale süresi sona erdi teklif veremezsiniz");
                        $('#myModal').modal("show");
                    } else {
                        alert("Sistemde hata oluştu");
                    }
                });
            }
            <? } ?>
        }
    </script>
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content panel-warning">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Uyarı</h4>
                </div>
                <div class="modal-body">
                    <p id="error"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        (function ($) {

            $.fn.extend({

                leanModal: function (options) {

                    var defaults = {
                        top: 100,
                        overlay: 0.5
                    }

                    options = $.extend(defaults, options);

                    return this.each(function () {

                        var o = options;

                        $(this).click(function (e) {

                            var overlay = $("<div id='lean_overlay'></div>");

                            var modal_id = $(this).attr("href");

                            $("body").append(overlay);

                            $("#lean_overlay").click(function () {
                                close_modal(modal_id);
                            });

                            var modal_height = $(modal_id).outerHeight();
                            var modal_width = $(modal_id).outerWidth();

                            $('#lean_overlay').css({
                                'display': 'block',
                                opacity: 0
                            });

                            $('#lean_overlay').fadeTo(200, o.overlay);

                            $(modal_id).css({

                                'display': 'block',
                                'position': 'fixed',
                                'opacity': 0,
                                'z-index': 11000,
                                'left': 50 + '%',
                                'margin-left': -(modal_width / 2) + "px",
                                'top': o.top + "px"

                            });

                            $("<img />").css({
                                'position': 'fixed',
                                'top': o.top + 10 + 'px',
                                'left': '50%'
                            }).click(function () {
                                // onclick behaviour - just close it
                                close_modal(modal_id);
                                // icon URL
                            }).attr('src', '../close.png').appendTo($(modal_id));

                            $(modal_id).fadeTo(200, 1);

                            e.preventDefault();

                        });

                    });

                    function close_modal(modal_id) {

                        $("#lean_overlay").fadeOut(200);

                        $(modal_id).css({
                            'display': 'none'
                        });

                    }

                }
            });

        })(jQuery);

        $("a#go").leanModal();
    </script>

<?
$id = $_GET['id'];
$sql21 = $db->query("SELECT * FROM ilanlar WHERE Id = '$id'");
$row21 = $sql21->fetch(PDO::FETCH_ASSOC);
?>
<? if ($row21["phone"] == 1) { ?>
    <style type="text/css">
        #altfooter {
            position: fixed;
            bottom: 0;
            width: 100%;
            height: 50px; /* footer yüksekliği */
            background: #f5f5f5;
            border: 1px solid #ccc;
            text-align: center;
            z-index: 1000;
        }

        .button50 {
            background-color: #50c200;
            border-color: #6f6f6f;
            color: #fff;
            font-weight: 600;

            margin-top: 5px;
        }

        .button51 {
            background-color: #0093ff;
            border-color: #6f6f6f;
            color: #fff;
            font-weight: 600;

            margin-top: 5px;
        }

        .halil {
            display: none
        }

        @media (max-width: 768px) {
            .halil {
                display: block
            }
        }
    </style>
    <div class="halil">
        <div id="altfooter">
            <center>

                <a href="whatsapp://send?text=Merhaba <? echo $row21["title"]; ?>, Başlıklı İlanınız Hakkında Bilgi Alabilirmiyim?&amp;phone=9<? echo $row8["gsm"]; ?>"
                   class="btn btn-dafault button50"><i class="fa fa-whatsapp fa-1x" aria-hidden="true"></i> Whatsapp
                    Mesaj</a>

                <a href="tel:<? echo $row8["gsm"]; ?>" class="btn btn-dafault button51"><i class="fa fa-phone fa-1x"
                                                                                           aria-hidden="true"></i> İlan
                    Sahibini Ara</a>


            </center>
        </div>
    </div>
<? } ?>