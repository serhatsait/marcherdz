<?
$uye = $_SESSION['uye'];
$sql = $db->query("SELECT * FROM users WHERE Id = '$uye'");
$uyebilgileri = $sql->fetch(PDO::FETCH_ASSOC);
if ($uyebilgileri["gsm"] == ""){
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> <script> alert("Sistemde Kayıtlı Telefon Numaranız Bulunmuyor.Lütfen Banaözel / Üyeliğim Bölümünden İletişim Bilgilerinizi Güncelleyiniz");window.location.href="index.php?page=membership"; </script>';
exit;
}	


$uye = $_SESSION["uye"];
if ($_SESSION["uye"] == ""){ header("location: /login"); }
$id = $_GET["id"];

$sql = $db->query("SELECT * FROM category WHERE Id = '$id'");
$a = $sql->fetch(PDO::FETCH_OBJ);
if ($a->tip == 1){
	header("location: index.php?page=add5&id=$id");
}



$sql22 = $db->query("SELECT * FROM ilanlar WHERE uyeId = '$uye'");
$sql36 = $db->query("SELECT * FROM magazalar WHERE uyeId = '$uye'");
$aa1 = $sql36->fetch(PDO::FETCH_ASSOC);
$magazakota = $aa1["magazakota"];
if ($magazakota <= $sql22->RowCount() && $sql36->rowCount() != 0){
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> <script> alert("Mağaza İlan Kotasını Doldurdunuz. Mağaza Sınırınız : '.$magazakota.' Adettir."); window.history.go(-1); </script>';
		

}



$sql = $db->query("SELECT * FROM ilanlar WHERE uyeId = '$uye'");
if ($MagazaSinir <= $sql->RowCount()){
$sql = $db->query("SELECT * FROM magazalar WHERE uyeId = '$uye'");
$a = $sql->fetch(PDO::FETCH_ASSOC);
if ($sql->rowCount() == 0){
header("location: index.php?page=add&err=1");
}
}
if ($_GET['ilanId'] == ""){
$id = $_GET["id"];
} else {
$ilanId = $_GET['ilanId'];
$sql = $db->query("SELECT * FROM ilanlar WHERE Id = '$ilanId' and uyeId = '$uye'");
$v = $sql->fetch(PDO::FETCH_OBJ);
$id = $v->category1;
}
$sql = $db->query("SELECT * FROM category WHERE Id = '$id'");
$a = $sql->fetch(PDO::FETCH_OBJ);
$modul = $a->modul;
$sql = $db->query("SELECT * FROM modulitems WHERE modulsId = '$modul'");
$moduller = "";
while ($mm = $sql->fetch(PDO::FETCH_OBJ)){
if ($mm->classx == 1 || $mm->classx == 0) {
if ($_GET['ilanId'] == ""){
$moduller.= '<div class="col-xs-12 col-sm-3"><div class="form-group"><label class="qlabel">' . $mm->name . '</label><div class="form-group"><input type="number" name="field_' . $mm->Id . '" class="form-control" required="required"></div></div></div>';
} else {
$ilanId = $_GET['ilanId'];
$itemId = $mm->Id;
$md = $db->query("SELECT * FROM modul_ilan WHERE ilanId = '$ilanId' and itemId = '$itemId'");
$mdd = $md->fetch(PDO::FETCH_OBJ);
$moduller.= '<div class="col-xs-12 col-sm-3"><div class="form-group"><label class="qlabel">' . $mm->name . '</label><div class="form-group"><input type="number" name="field_' . $mm->Id . '" value="'.$mdd->selects.'" class="form-control" required="required"></div></div></div>';
}
} else {

$moduller.= '
<div class="col-xs-12 col-sm-3">
<div class="form-group"><label class="qlabel">' . $mm->name . '</label>
<select class="form-control se" name="field_' . $mm->Id . '" data-style="btn-primary" data-live-search="true" title="Tümü" data-selected-text-format="count" required="required">';
$sql2 = $db->query("SELECT * FROM modulitemsselect WHERE itemId = '$mm->Id' ORDER BY Id ASC");
while ($s = $sql2->fetch(PDO::FETCH_OBJ)){
if ($_GET['ilanId'] == ""){
$moduller.= '<option value="' . $s->Id . '">' . $s->name . '</option>';
} else {
$ilanId = $_GET['ilanId'];
$itemId = $mm->Id;
$md = $db->query("SELECT * FROM modul_ilan WHERE (ilanId = '$ilanId' and itemId = '$itemId')");
$mdd = $md->fetch(PDO::FETCH_ASSOC);

$moduller.= '<option value="'.$s->Id.'" '; if ($s->Id == $mdd["selects"]){ $moduller.= ' selected'; } $moduller.= '>' . $s->name . '</option>';
}
}
$moduller.= '</select></div></div>';
}
}
$ozellikler = "";
$sql = $db->query("SELECT * FROM groups WHERE modulId = '$modul'");
while ($z = $sql->fetch(PDO::FETCH_OBJ)){
$ozellikler.=  '
<div class="panel panel-default"><div class="panel-heading">'.$z->name.'</div><div class="panel-body"><div class="row">';
$g = $z->Id;
$sql2 = $db->query("SELECT * FROM prop WHERE modulId = '$modul' and groupId = '$g'");
while ($x2 = $sql2->fetch(PDO::FETCH_OBJ)){
if ($_GET['ilanId'] == ""){
$ozellikler.= '
<div class="col-xs-12 col-sm-3">
<div class="form-group">
<label style="font-weight:normal !important"><input type="checkbox" name="prop_' . $x2->Id . '" value="1"> ' . $x2->name . '	 </label></div></div>';
} else {
$ilanId = $_GET['ilanId'];
$md = $db->query("SELECT * FROM prop_ilan WHERE (ilanId = '$ilanId' and propId = '$x2->Id')");
$mdd = $md->fetch(PDO::FETCH_ASSOC);

$ozellikler.= '
<div class="col-xs-12 col-sm-3">
<div class="form-group">
<label style="font-weight:normal !important"><input type="checkbox" name="prop_' . $x2->Id . '" value="1"'; if ($mdd["val"] == 1){ $ozellikler.= ' checked'; } $ozellikler.= '> ' . $x2->name . '</label></div></div>';
}
}
$ozellikler.=  '</div></div></div>';
}
?>
<link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<form action="index.php?page=guncelleok&id=<?php
echo $id;
if ($_GET["ilanId"] != "") {
    echo '&ilanId=' . $_GET["ilanId"] . '';
}
?>" method="post">
    <div class="container top15">
        <div class="panel panel-default">
            <div class="panel-heading">İletişim Bilgileri</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <label class="ilandetay1">
                            <input type="radio" name="telefon" value="1" checked>
                                   İlanda telefon numaram yayınlansın</label>
                        <br>
                        <label class="ilandetay1">
                            <input type="radio" name="telefon" value="0" >
                                   İlanda telefon numaramın yayınlanmasını istemiyorum</label>
                    </div>
                    <?
                    $uye = $_SESSION['uye'];
                    $sql = $db->query("SELECT * FROM users WHERE Id = '$uye'");
                    $uyebilgileri = $sql->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group">
                            <div class="row no-gutter ilandetay1 margin5">
                                <div class="col-xs-4 ">
                                    <label><b>Adı Soyadı</b></label>
                                </div>
                                <div class="col-xs-8">:
                                    <?= $uyebilgileri["ad_soyad"]; ?>
                                </div>
                            </div>
                            <div class = "row no-gutter  ilandetay1 margin5">
                                <div class = "col-xs-4">
                                    <label><b>Sabit Telefon</b></label>
                                </div>
                                <div class = "col-xs-8">:
                                    <?= $uyebilgileri["telefon"]; ?>
                                </div>
                            </div>
                            <div class = "row no-gutter  ilandetay1 margin5">
                                <div class = "col-xs-4">
                                    <label><b>Cep Telefonu</b></label>
                                </div>
                                <div class = "col-xs-8">:
                                    <?= $uyebilgileri["gsm"]; ?>
                                </div>
                            </div>
                            <div style="margin-right:15px !important; padding-right: 0px !important;"><a href="index.php?page=membership" class="btn btn-primary btn-block margin52">İletişim Bilgilerimi Değiştir</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="panel panel-default">
            <div class="panel-heading">İlan Detayları</div>
            <div class="panel-body">
                <div class="form-group">
                    <label>İlan Başlığı</label>
                    <input type="text" name="data1" class="form-control" value="<?php echo $v->title; ?>" required="required">
                </div>
                <div class="form-group">
                    <label>İlan Açıklaması</label>
                    <textarea name="data2" class="summernote" style="width:100%"><?php echo html_entity_decode($v->content); ?></textarea>
                </div>
            </div>
        </div>
        <br>
        <div class="panel panel-default">
            <div class="panel-heading">Satış & Fiyat & Yayın</div>
            <div class="panel-body">
                <div class="form-group" id="iz5">
                    <label>Yayın Süresi</label>
                    <select name="yayintarihi" id="yayintarihi" class="form-control" >
                        <option value="15" <?php
                        if ($v->yayin == 15) {
                            echo ' selected="selected"';
                        }
                        ?>>15 Gün</option>
                        <option value="30" <?php
                        if ($v->yayin == 30) {
                            echo ' selected="selected"';
                        }
                        ?>>30 Gün</option>
                        <option value="60" <?php
                        if ($v->yayin == 60) {
                            echo ' selected="selected"';
                        }
                        ?>>60 Gün</option>
                        <option value="90" <?php
                        if ($v->yayin == 90) {
                            echo ' selected="selected"';
                        }
                        ?>>90 Gün</option>
                        <option value="365" <?php
                        if ($v->yayin == 365) {
                            echo ' selected="selected"';
                        }
                        ?>>1 Yıl</option>
                    </select>
                </div>
                <div class="row no-gutter">
                    <div class="col-xs-12 col-sm-2">
                        <div class="form-group">
                            <label>Satış Türü</label>
                            <select name="data3" id="data3" class="form-control" onchange="kargo()">
                                <option value="0"<?php
                                if ($v->type == 0) {
                                    echo ' selected="selected"';
                                }
                                ?>>Sabit Fiyat</option>
                                <?
								if ($gdurum == 1){
								?>
                                <option value="1"<?php
                                if ($v->type == 1) {
                                    echo ' selected="selected"';
                                }
                                ?>>GET ( Güvenli E-Ticaret )</option>
								
                                <? } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3" id="iz1">
                        <div class="row no-gutter">
                            <div class="col-xs-8 col-sm-7">
                                <div class="form-group">
                                    <label>Fiyat</label>
                                    <input type="text" name="data4" id="data4" placeholder="0" class="form-control money"  required="required" value="<?php echo $v->price; ?>" onKeyUp="hesapla()" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-5">
                                <label>Kur</label>
                                <select name="data5" id="data5" class="form-control">
                                    <option value="TL"<?php
                                    if ($v->exchange == "TL") {
                                        echo ' selected="selected"';
                                    }
                                    ?>>TL</option>
                                    <option value="USD"<?php
                                    if ($v->exchange == "USD") {
                                        echo ' selected="selected"';
                                    }
                                    ?>>USD</option>
                                    <option value="EUR"<?php
                                    if ($v->exchange == "EUR") {
                                        echo ' selected="selected"';
                                    }
                                    ?>>EUR</option>
                                </select>
                            </div>
                        </div>
                    </div>
					
					
					
					<div class="col-xs-12 col-sm-8 hidden" id="iz2">
                        <div class="row no-gutter">
                            <div class="col-xs-12 col-sm-4">
                                <div class="form-group">
                                    <label>Fiyat</label>
                                    <input type="text" disabled name="xx1" id="xx1" placeholder="0 TL" class="form-control money" value=""  autocomplete="off">
                                </div>
                            </div>
							<div class="col-xs-12 col-sm-4">
                                <div class="form-group">
                                    <label>Başlangıç Fiyatı</label>
                                    <input type="text" name="xx4" id="xx4" placeholder="0 TL" class="form-control money"  value="<?php echo $v->fiyat2; ?>"  autocomplete="off">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4">
                                 <label>Min. Artış</label>
                                    <input type="text" name="xx2" id="xx2" placeholder="0 TL" class="form-control money"  value="<?php echo $v->fiyat3; ?>" autocomplete="off">
                               
                            </div>
                        </div>
						
                    </div>
					<div class="col-xs-12 col-sm-2 hidden" id="iz4">
					 <div class="form-group">
						<label>Bitiş Zamanı</label>
						<input name="xx3" id="xx3" size="16" type="text" value="<? if ($_GET["ilanId"] == ""){ echo date("d-m-Y").' 23:00'; } else { echo $v->bitiszamani; } ?>"  class="form_datetime form-control">
					</div>
					</div>
                    <div class="col-xs-12 col-sm-2 <?php
                    if ($v->type != 1) {
                        echo 'hidden';
                    }
                    ?>" id="get1">
                        <label>Kargo Ücreti</label>
                        <select name="data6" id="data6" class="form-control">
                            <option value="0"<?php
                            if ($v->cargoprice == "0") {
                                echo ' selected="selected"';
                            }
                            ?>>Ücretsiz Kargo</option>
                            <option value="1"<?php
                            if ($v->cargoprice == "1") {
                                echo ' selected="selected"';
                            }
                            ?>>Alıcı Öder</option>
                        </select>
                    </div>
                    <div class="col-xs-12 col-sm-2 <?php
                    if ($v->type != 1) {
                        echo 'hidden';
                    }
                    ?>" id="get2">
                        <label>Varış Süresi</label>
                        <select name="data7" id="data7" class="form-control">
                            <option value="3"<?php
                            if ($v->cargoarrive == "3") {
                                echo ' selected="selected"';
                            }
                            ?>>3 İş Günü</option>
                            <option value="5"<?php
                            if ($v->cargoarrive == "5") {
                                echo ' selected="selected"';
                            }
                            ?>>5 İş Günü</option>
                            <option value="7"<?php
                            if ($v->cargoarrive == "7") {
                                echo ' selected="selected"';
                            }
                            ?>>7 İş Günü</option>
                        </select>
                    </div>
                </div>
                <div id="get3" class=" <?php
                if ($v->type != 1) {
                    echo 'hidden';
                } else {

                }
                $cargo = explode("-", $v->cargo);
                ?>"><br>
                    <div class="alert alert-warning" id="iz3">
                        Satış sonrasında hesabınıza aktarılacak tutar <strong id="tutar">0.00 TL</strong>
                    </div>
                    <div class="form-group">
                        <label>Gönderi Yapabileceğiniz Kargo Şirketleri</label>
                        <div class="row">
                            <div class="col-xs-12 col-sm-2">
                                <label style="font-weight:normal !important">
                                    <input type="checkbox" name="kargo1" id="kargo1" value="Aras Kargo" <? if(array_search('Aras Kargo', $cargo) != ""){ echo ' checked'; } ?>>
                                           Aras Kargo</label>
                            </div>
                            <div class="col-xs-12 col-sm-2">
                                <label style="font-weight:normal !important">
                                    <input type="checkbox" name="kargo2" id="kargo1" value="DHL" <? if(array_search('DHL', $cargo) != ""){ echo ' checked'; } ?>>
                                           DHL</label>
                            </div>
                            <div class="col-xs-12 col-sm-2">
                                <label style="font-weight:normal !important">
                                    <input type="checkbox" name="kargo3" id="kargo1" value="Express Kargo"<? if(array_search('Express Kargo', $cargo) != ""){ echo ' checked'; } ?>>
                                           Express Kargo</label>
                            </div>
                            <div class="col-xs-12 col-sm-2">
                                <label style="font-weight:normal !important">
                                    <input type="checkbox" name="kargo4" id="kargo1" value="MNG Kargo"<? if(array_search('MNG Kargo', $cargo) != ""){ echo ' checked'; } ?>>
                                           MNG Kargo</label>
                            </div>
                            <div class="col-xs-12 col-sm-2">
                                <label style="font-weight:normal !important">
                                    <input type="checkbox" name="kargo5" id="kargo1" value="PTT Kargo"<? if(array_search('PTT Kargo', $cargo) != ""){ echo ' checked'; } ?>>
                                           PTT Kargo</label>
                            </div>
                            <div class="col-xs-12 col-sm-2">
                                <label style="font-weight:normal !important">
                                    <input type="checkbox" name="kargo6" id="kargo1" value="Sürat Kargo"<? if(array_search('Sürat Kargo', $cargo) != ""){ echo ' checked'; } ?>>
                                           Sürat Kargo</label>
                            </div>
                            <div class="col-xs-12 col-sm-2">
                                <label style="font-weight:normal !important">
                                    <input type="checkbox" name="kargo7" id="kargo1" value="UPS"<? if(array_search('UPS', $cargo) != ""){ echo ' checked'; } ?>>
                                           UPS</label>
                            </div>
                            <div class="col-xs-12 col-sm-2">
                                <label style="font-weight:normal !important">
                                    <input type="checkbox" name="kargo8" id="kargo1" value="Varan Kargo"<? if(array_search('Varan Kargo', $cargo) != ""){ echo ' checked'; } ?>>
                                           Varan Kargo</label>
                            </div>
                            <div class="col-xs-12 col-sm-2">
                                <label style="font-weight:normal !important">
                                    <input type="checkbox" name="kargo9" id="kargo1" value="Yurtiçi Kargo"<? if(array_search('Yurtiçi Kargo', $cargo) != ""){ echo ' checked'; } ?>>
                                           Yurtiçi Kargo</label>
                            </div>
                            <div class="col-xs-12 col-sm-2">
                                <label style="font-weight:normal !important">
                                    <input type="checkbox" name="kargo10" id="kargo1" value="Diğer Firmalar"<? if(array_search('Diğer Firmalar', $cargo) != ""){ echo ' checked'; } ?>>
                                           Diğer Firmalar</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <?
								if ($moduller != ""){
								 echo '<div class="panel panel-default">
            <div class="panel-heading">Detaylı Bilgi</div>
            <div class="panel-body">
                <div class="row">'.$moduller.'</div>
            </div>
        </div>';
                                }
								?>
		
        <?= $ozellikler; ?>
        <br>
        <div class="panel panel-default">
            <div class="panel-heading">Fotoğraf</div>
            <div class="panel-body">
                <?php
                if ($_GET["ilanId"] != "") {
                    $ses = $_GET["ilanId"];
                } else {
                    $ses = "9999999" . $_SESSION["uye"];
                }
                ?>
                <iframe src="fileserver/?id=<?php echo $ses; ?>" width="100%" height="300" frameboder="0" style="border:none !important"></iframe>
            </div>
        </div>
        <br>
        <div class="panel panel-default">
            <div class="panel-heading">Adres</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-3">
                        <div class="form-group">
                            <label>Wilaya :</label>
                            <select name="data8" id="data8" class="form-control il" onchange="districts()" required>
                                <option value="">Seçiniz</option>
                                <?php
                                $sql2 = $db->query("SELECT * FROM city ORDER BY il_adi ASC");
                                while ($i = $sql2->fetch(PDO::FETCH_OBJ)) {
                                    echo '<option value="' . $i->id . '"';
                                    if ($v->city == $i->id) {
                                        echo ' selected="select"';
                                    }
                                    echo '>' . $i->il_adi . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <input type="hidden" name="ilanId" id="ilanId" value="<? echo $v->locality; ?>">
                            <div class="form-group">
                                <label>Municipalité :</label>
                                <select name="data9" id="data9" class="form-control ilce"  onchange="localitys()" required>
                                    <option value="">Seçiniz</option>
									<?php
                                    $il = $v->city;
                                    $sql2 = $db->query("SELECT * FROM county WHERE il_id = '$il' ORDER BY county_adi ASC");
                                    while ($ix = $sql2->fetch(PDO::FETCH_OBJ)) {
                                        echo '<option value="' . $ix->id . '"';
                                        if ($v->districts == $ix->id) {
                                            echo ' selected="select"';
                                        }
                                        echo '>' . $ix->county_adi . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <script> localitys();</script>
<!--                            <div class="form-group">-->
<!--                                <label>Mahalle :</label>-->
<!--                                <select name="data10" id="locality" class="form-control mahalle" onchange="maps()" required>-->
<!--                                </select>-->
<!--                            </div>-->
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
	<div class="container top15">
	<div class="panel panel-default">
    <div class="panel-heading">Konum </div>
	<div class="panel-body">
   <style> #map { height: 400px; width: 100%; } </style>
<div id="map"></div>
    <script>
      function initMap() {
        var uluru = {lat: <? echo $v->lat; ?>, lng: <? echo $v->lng; ?>};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: <? echo $v->zoom; ?>,
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
	<input size="20" type="hidden" id="lat" name="lat" value="<? echo $v->lat; ?>">
        <input size="20" type="hidden" id="lng" name="lng" value="<? echo $v->lng; ?>">
            <input size="20" type="hidden" id="zoom" name="zoom" value="<? echo $v->zoom; ?>" >
                    <div class="container top15">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>
                                        <input type="checkbox" required></label>
                                    <a  href="#" data-toggle="modal" data-target="#myModal">İlan verme kurallarını okudum kabul ediyorum</a>
                                </div>
                                <input type="submit" class="btn btn-primary" value="Kaydet ve Devam Et ">
                            </div>
                        </div>
                    </div>
                    </form>
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">İlan Kuralları</h4>
                                </div>
                                <div class="modal-body">
                                    <? include 'ilan_kurallari.php'; ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
                                </div>
                            </div>
                        </div>
                    </div>
					<script> 
var e = $(".ilce").val();
var f = $("#ilanId").val();
$.post('../filesystems/mahalle.php', {mahalle: e,ilanId:f}, function (output) {
        $(".mahalle option").remove();
        $(".mahalle").append(output);
    });
</script> 
                    <script>
                        function hesapla()
                        {
                            var e = $("#data4").val();
                            $.post("filesystems/hesapla.php", {fiyat: e}, function (result) {
                                $("#tutar").html(result);
                            });
                        }
                    </script>
<script type="text/javascript">
$( document ).ready(function() {
$(".form_datetime").datetimepicker({format: 'dd-mm-yyyy hh:ii'});
});
<?
if($_GET["ilanId"] != ""){
echo 'kargo();';	
}
?>
</script>