<script>
function locality() {
    var e = $(".ilce").val();
    $.post('../filesystems/mahalle.php', {mahalle: e}, function (output) {
        $(".mahalle option").remove();
        $(".mahalle").append(output);
    });
}
function localitys() {
    var e = $(".ilce").val();
	var f = $("#ilanId").val();
    $.post('../filesystems/mahalle.php', {mahalle: e,ilanId:f}, function (output) {
        $(".mahalle option").remove();
        $(".mahalle").append(output);
    });
}
</script>
<link href="../css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="../js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<?
$_GET["ilanId"] = $_GET["id"];
$ilanId = $_GET["id"];

$sql = $db->query("SELECT * FROM ilanlar WHERE Id = '$ilanId'");
$v = $sql->fetch(PDO::FETCH_OBJ);
$id = $v->category1;

$sql = $db->query("SELECT * FROM category WHERE Id = '$id'");
$a = $sql->fetch(PDO::FETCH_OBJ);
$modul = $a->modul;
$sql = $db->query("SELECT * FROM modulitems WHERE modulsId = '$modul'");
$moduller = "";
while ($mm = $sql->fetch(PDO::FETCH_OBJ)){
if ($mm->classx == 1 || $mm->classx == 0) {
if ($_GET['ilanId'] == ""){
$moduller.= '<div class="col-xs-3"><div class="form-group"><label class="qlabel">' . $mm->name . '</label><div class="form-group"><input type="number" name="field_' . $mm->Id . '" class="form-control" required="required"></div></div></div>';
} else {
$ilanId = $_GET['ilanId'];
$itemId = $mm->Id;
$md = $db->query("SELECT * FROM modul_ilan WHERE ilanId = '$ilanId' and itemId = '$itemId'");
$mdd = $md->fetch(PDO::FETCH_OBJ);
$moduller.= '<div class="col-xs-3"><div class="form-group"><label class="qlabel">' . $mm->name . '</label><div class="form-group"><input type="number" name="field_' . $mm->Id . '" value="'.$mdd->selects.'" class="form-control" required="required"></div></div></div>';
}
} else {

$moduller.= '
<div class="col-xs-3">
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
<div class="panel panel-default box box-primary"><div class="box-header with-border">
        <h3 class="box-title">'.$z->name.'</h3>
      </div><div class="panel-body"><div class="row">';
$g = $z->Id;
$sql2 = $db->query("SELECT * FROM prop WHERE modulId = '$modul' and groupId = '$g'");
while ($x2 = $sql2->fetch(PDO::FETCH_OBJ)){
if ($_GET['ilanId'] == ""){
$ozellikler.= '
<div class="col-xs-3">
<div class="form-group">
<label style="font-weight:normal !important"><input type="checkbox" name="prop_' . $x2->Id . '" value="1"> ' . $x2->name . '	 </label></div></div>';
} else {
$ilanId = $_GET['ilanId'];
$md = $db->query("SELECT * FROM prop_ilan WHERE (ilanId = '$ilanId' and propId = '$x2->Id')");
$mdd = $md->fetch(PDO::FETCH_ASSOC);

$ozellikler.= '
<div class="col-xs-3">
<div class="form-group">
<label style="font-weight:normal !important"><input type="checkbox" name="prop_' . $x2->Id . '" value="1"'; if ($mdd["val"] == 1){ $ozellikler.= ' checked'; } $ozellikler.= '> ' . $x2->name . '</label></div></div>';
}
}
$ozellikler.=  '</div></div></div>';
}
?>

<section class="content-header">
  <h1> İlan Yönetimi<small>İlan Düzenle</small> </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Page d'accueil</a></li>
    <li><a href="index.php?page=banka"><i class="fa fa-dashboard"></i> İlan Yönetimi</a></li>
    <li class="active">İlan Düzenle</li>
  </ol>
</section>
<section class="content"> <? echo $err; ?>
  <form action="index.php?page=add3&id=<?php
echo $id;
if ($_GET["ilanId"] != "") {
    echo '&ilanId=' . $_GET["ilanId"] . '';
}
?>&uye=<? echo $v->uyeId; ?>&return=<? echo $_GET["return"]; ?>&u=<? echo $_GET["u"]; ?>" method="post">
    <div class="panel panel-default box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">İlan Detayları</h3>
      </div>
      <div class="panel-body">
        <div class="form-group">
          <label>İlan Başlığı</label>
          <input type="text" name="data1" class="form-control" value="<?php echo $v->title; ?>" required="required">
        </div>
        <div class="form-group">
          <label>İlan Açıklaması</label>
          <textarea name="data2" id="data2" class="summernote" style="width:100%"><?php echo html_entity_decode($v->content); ?></textarea>
        </div>
      </div>
    </div>
    <div class="panel panel-default box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Satış Fiyat Yayın</h3>
      </div>
      <div class="panel-body">
        <div class="form-group">
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
          <div class="col-xs-3">
            <div class="form-group">
              <label>Satış Türü</label>
              <select name="data3" id="data3" class="form-control" onchange="kargo()" readonly>
                <option value="0"<?php
                                if ($v->type == 0) {
                                    echo ' selected="selected"';
                                }
                                ?>>Normal</option>
                <?
								if ($gdurum == 1){
								?>
                <option value="1"<?php
                                if ($v->type == 1) {
                                    echo ' selected="selected"';
                                }
                                ?>>GET ( Güvenli E-Ticaret )</option>
				<option value="2"<?php
                                if ($v->type == 2) {
                                    echo ' selected="selected"';
                                }
                                ?>>İhale</option>				
                <? } ?>
              </select>
            </div>
          </div>
		  <? if ($v->type == 0 || $v->type == 1){ ?>
          <div class="col-xs-3">
            <div class="row no-gutter">
              <div class="col-xs-7">
                <div class="form-group">
                  <label>Fiyat</label>
                  <input type="text" name="data4" id="data4" placeholder="0" class="form-control money" value="<?php echo $v->price; ?>" onKeyUp="hesapla()" autocomplete="off">
                </div>
              </div>
              <div class="col-xs-5">
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
		  <? } else { ?>
	
                            <div class="col-xs-2">
                                <div class="form-group">
                                    <label>Hemen Al Fiyatı</label>
                                    <input type="text" name="xx1" id="xx1" placeholder="0 TL" class="form-control money" value="<?php echo $v->price; ?>"  autocomplete="off">
                                </div>
                            </div>
							<div class="col-xs-2">
                                <div class="form-group">
                                    <label>Başlangıç Fiyatı</label>
                                    <input type="text" name="xx4" id="xx4" placeholder="0 TL" class="form-control money"  value="<?php echo $v->fiyat2; ?>"  autocomplete="off">
                                </div>
                            </div>
                            <div class="col-xs-2">
                                 <label>Min. Artış</label>
                                    <input type="text" name="xx2" id="xx2" placeholder="0 TL" class="form-control money"  value="<?php echo $v->fiyat3; ?>" autocomplete="off">
                               
                            </div>
						<div class="col-xs-2">
							<div class="form-group">
						<label>Bitiş Zamanı</label>
						<input name="xx3" id="xx3" size="16" type="text" value="<?php echo $v->bitiszamani; ?>" readonly class="form_datetime form-control">
					</div>
					</div>
		  
		  <? } ?>
          <div class="col-xs-3 <?php
                    if ($v->type == 0){
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
          <div class="col-xs-3 <?php
                    if ($v->type == 0) {
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
                if ($v->type == 0) {
                    echo 'hidden';
                } else {

                }
                $cargo = explode("-", $v->cargo);
                ?>">
          
		  <br><div class="alert alert-warning hidden"> Satış sonrasında hesabınıza aktarılacak tutar <strong id="tutar">0.00 TL</strong> </div>
          <div class="form-group">
            <label>Gönderi Yapabileceğiniz Kargo Şirketleri</label>
            <div class="row">
              <div class="col-xs-2">
                <label style="font-weight:normal !important">
                  <input type="checkbox" name="kargo1" id="kargo1" value="Aras Kargo" <? if(array_search('Aras Kargo', $cargo) != ""){ echo ' checked'; } ?>>
                  Aras Kargo</label>
              </div>
              <div class="col-xs-2">
                <label style="font-weight:normal !important">
                  <input type="checkbox" name="kargo2" id="kargo1" value="DHL" <? if(array_search('DHL', $cargo) != ""){ echo ' checked'; } ?>>
                  DHL</label>
              </div>
              <div class="col-xs-2">
                <label style="font-weight:normal !important">
                  <input type="checkbox" name="kargo3" id="kargo1" value="Express Kargo"<? if(array_search('Express Kargo', $cargo) != ""){ echo ' checked'; } ?>>
                  Express Kargo</label>
              </div>
              <div class="col-xs-2">
                <label style="font-weight:normal !important">
                  <input type="checkbox" name="kargo4" id="kargo1" value="MNG Kargo"<? if(array_search('MNG Kargo', $cargo) != ""){ echo ' checked'; } ?>>
                  MNG Kargo</label>
              </div>
              <div class="col-xs-2">
                <label style="font-weight:normal !important">
                  <input type="checkbox" name="kargo5" id="kargo1" value="PTT Kargo"<? if(array_search('PTT Kargo', $cargo) != ""){ echo ' checked'; } ?>>
                  PTT Kargo</label>
              </div>
              <div class="col-xs-2">
                <label style="font-weight:normal !important">
                  <input type="checkbox" name="kargo6" id="kargo1" value="Sürat Kargo"<? if(array_search('Sürat Kargo', $cargo) != ""){ echo ' checked'; } ?>>
                  Sürat Kargo</label>
              </div>
              <div class="col-xs-2">
                <label style="font-weight:normal !important">
                  <input type="checkbox" name="kargo7" id="kargo1" value="UPS"<? if(array_search('UPS', $cargo) != ""){ echo ' checked'; } ?>>
                  UPS</label>
              </div>
              <div class="col-xs-2">
                <label style="font-weight:normal !important">
                  <input type="checkbox" name="kargo8" id="kargo1" value="Varan Kargo"<? if(array_search('Varan Kargo', $cargo) != ""){ echo ' checked'; } ?>>
                  Varan Kargo</label>
              </div>
              <div class="col-xs-2">
                <label style="font-weight:normal !important">
                  <input type="checkbox" name="kargo9" id="kargo1" value="Yurtiçi Kargo"<? if(array_search('Yurtiçi Kargo', $cargo) != ""){ echo ' checked'; } ?>>
                  Yurtiçi Kargo</label>
              </div>
              <div class="col-xs-2">
                <label style="font-weight:normal !important">
                  <input type="checkbox" name="kargo10" id="kargo1" value="Diğer Firmalar"<? if(array_search('Diğer Firmalar', $cargo) != ""){ echo ' checked'; } ?>>
                  Diğer Firmalar</label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="panel panel-default box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Detaylı Bilgi</h3>
      </div>
      <div class="panel-body">
        <div class="row">
          <?= $moduller; ?>
        </div>
      </div>
    </div>
    <?= $ozellikler; ?>
    <div class="panel panel-default box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Fotoğraf</h3>
      </div>
      <div class="panel-body">
        <?php
                if ($_GET["ilanId"] != "") {
                    $ses = $_GET["ilanId"];
                } else {
                    $ses = "9999999" . $_SESSION["uye"];
                }
                ?>
        <iframe src="../fileserver/?id=<?php echo $ses; ?>" width="100%" height="300" frameboder="0" style="border:none !important"></iframe>
      </div>
    </div>
    <div class="panel panel-default box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Adres</h3>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-xs-3">
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
            <div class="form-group">
              <label>Mahalle :</label>
              <select name="data10" id="locality" class="form-control mahalle" onchange="maps()" >
              </select>
            </div>
          </div>
          
        </div>
      </div>
    </div>
    <div class="panel panel-default box box-primary">
      <div class="box-header with-border">
	  <h3 class="box-title">Konum</h3>
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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCr9njM4-rnW3pjh-_v-v9JFLydqFxSgbg&callback=initMap"></script>
                    
				</div>
                        </div>	
                    

	</div>
	<input size="20" type="hidden" id="lat" name="lat" value="<? echo $v->lat; ?>">
        <input size="20" type="hidden" id="lng" name="lng" value="<? echo $v->lng; ?>">
            <input size="20" type="hidden" id="zoom" name="zoom" value="<? echo $v->zoom; ?>" >
    
    <button type="submit" class="btn btn-primary">Kaydet</button>
  </form>
</section>
<script> 
var e = $(".ilce").val();
var f = $("#ilanId").val();
$.post('../filesystems/mahalle.php', {mahalle: e,ilanId:f}, function (output) {
        $(".mahalle option").remove();
        $(".mahalle").append(output);
    });
</script> 
<script type="text/javascript">
$( document ).ready(function() {
$(".form_datetime").datetimepicker({format: 'dd-mm-yyyy hh:ii'});
});
</script>
