<?
$uye = $_SESSION["uye"];
if ($_SESSION["uye"] == ""){ header("location: /login"); }

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
<form action="index.php?page=add6&id=<?php
echo $id;
if ($_GET["ilanId"] != "") {
    echo '&ilanId=' . $_GET["ilanId"] . '';
}
?>" method="post">
    <div class="container top15">
        <div class="panel panel-default">
            <div class="panel-heading">Firma Bilgileri</div>
            <div class="panel-body">
                <div class="form-group">
                    <label>Firma Adı</label>
                    <input type="text" name="f1" class="form-control" value="<?php echo $v->firmadi; ?>" required>
                </div>
                <div class="row no-gutter">
					<div class="col-md-4">
					 <div class="form-group">
						<label>Telefon :</label>
						<input type="text" name="f2" id="f2" placeholder="Telefon No" value="<?php echo $v->telefon; ?>" class="form-control phone" required>
					</div>
					</div>
					<div class="col-md-4">
					 <div class="form-group">
						<label>Fax :</label>
						<input type="text" name="f3" id="f3" placeholder="Fax" value="<?php echo $v->fax; ?>" class="form-control phone" required>
					</div>
					</div>
					<div class="col-md-4">
					 <div class="form-group">
						<label>Gsm :</label>
						<input type="text" name="f4" id="f4" placeholder="GSM No" value="<?php echo $v->gsm; ?>" class="form-control phone" required>
					</div>
					</div>
					
				</div>
				<div class="row no-gutter">
				<div class="col-md-4">
					 <div class="form-group">
						<label>Web :</label>
						<input type="text" name="f5" id="f5" placeholder="Web Site Adresi" value="<?php echo $v->web; ?>" class="form-control web">
					</div>
					</div>
					<div class="col-md-4">
				<div class="form-group">
                    <label>Vergi Dairesi</label>
                    <input type="text" name="f6" class="form-control" value="<?php echo $v->vergidairesi; ?>" required>
                </div>
				</div>
				<div class="col-md-4">
				<div class="form-group">
                    <label>Vergi No</label>
                    <input type="number" name="f7" class="form-control" value="<?php echo $v->vergino; ?>" required>
                </div>
				 </div> </div>
				
            </div>
        </div>

  <div class="panel panel-default">
            <div class="panel-heading">Information d'entreprise</div>
            <div class="panel-body">

                <div class="row no-gutter">
					<div class="col-md-4">
					 <div class="form-group">
						<label>Kuruluş Yılı :</label>
						<select name="f8" id="f8" class="form-control" required>
                                <option value="">Seçiniz</option>
                                <?php
                                for ($i = 1912; $i <= date("Y"); $i++){
									echo '<option value="'.$i.'"'; if ($v->kurulusyili == $i){ echo ' selected'; } echo '>'.$i.'</option>';
								}
                                ?>
                            </select>
					</div>
					</div>
					<div class="col-md-4">
					 <div class="form-group">
						<label>İşletme Türü :</label>
						<select name="f9" id="f9" class="form-control" required>
						<option value="">Seçiniz</option>
						<option value="Şahıs Firması" <? if ($v->isletmeturu == "Şahıs Firması"){ echo ' selected'; } ?>>Şahıs Firması</option>
						<option value="Limited Şirketi" <? if ($v->isletmeturu == "Limited Şirketi"){ echo ' selected'; } ?>>Limited Şirketi</option>
						<option value="Anonim Şirketi" <? if ($v->isletmeturu == "Anonim Şirketi"){ echo ' selected'; } ?>>Anonim Şirketi</option>
						<option value="Komandit Şirketler" <? if ($v->isletmeturu == "Komandit Şirketler"){ echo ' selected'; } ?>>Komandit Şirketler</option>
						<option value="Kolektif Şirketler" <? if ($v->isletmeturu == "Kolektif Şirketler"){ echo ' selected'; } ?>>Kolektif Şirketler</option>
					</select>
					</div>
					</div>
					<div class="col-md-4">
					 <div class="form-group">
						<label>Yetkili Ad Soyad :</label>
						<input type="text" name="f10" id="f10" placeholder="Yetkili Ad Soyad" value="<?php echo $v->yetkili; ?>" class="form-control" required>
					</div>
					</div>
					
				</div>
				<div class="row no-gutter">
				<div class="col-md-4">
					 <div class="form-group">
						<label>Yıllık Ciro :</label>
						<select name="f11" id="f11" class="form-control" required>
						<option value="">Seçiniz</option>
						<option value="250,000 TL ve altı" <? if ($v->ciro == "250,000 TL ve altı"){ echo ' selected'; } ?>>250,000 TL ve altı</option>
						<option value="250,000 TL - 500,000 TL" <? if ($v->ciro == "250,000 TL - 500,000 TL"){ echo ' selected'; } ?>>250,000 TL - 500,000 TL</option>
						<option value="500,000 TL - 1 Milyon TL" <? if ($v->ciro == "500,000 TL - 1 Milyon TL"){ echo ' selected'; } ?>>500,000 TL - 1 Milyon TL</option>
						<option value="1 Milyon TL - 2,5 Milyon TL" <? if ($v->ciro == "1 Milyon TL - 2,5 Milyon TL"){ echo ' selected'; } ?>>1 Milyon TL - 2,5 Milyon TL</option>
						<option value="2,5 Milyon TL - 5 Milyon TL" <? if ($v->ciro == "2,5 Milyon TL - 5 Milyon TL"){ echo ' selected'; } ?>>2,5 Milyon TL - 5 Milyon TL</option>
						<option value="5 Milyon TL - 10 Milyon TL" <? if ($v->ciro == "5 Milyon TL - 10 Milyon TL"){ echo ' selected'; } ?>>5 Milyon TL - 10 Milyon TL</option>
						<option value="10 Milyon TL - 50 Milyon TL" <? if ($v->ciro == "10 Milyon TL - 50 Milyon TL"){ echo ' selected'; } ?>>10 Milyon TL - 50 Milyon TL</option>
						<option value="50 Milyon TL - 100 Milyon TL" <? if ($v->ciro == "50 Milyon TL - 100 Milyon TL"){ echo ' selected'; } ?>>50 Milyon TL - 100 Milyon TL</option>
						<option value="100 Milyon TL ve üstü" <? if ($v->ciro == "100 Milyon TL ve üstü"){ echo ' selected'; } ?>>100 Milyon TL ve üstü</option>
					</select>
					</div>
					</div>
					<div class="col-md-4">
				<div class="form-group">
                    <label>Çalışan Sayısı</label>
                    <select name="f12" id="f12" class="form-control" required>
						<option value="">Seçiniz</option>
						<option value="5 Kişi ve altı" <? if ($v->calisansayisi == "5 Kişi ve altı"){ echo ' selected'; } ?>>5 Kişi ve altı</option>
						<option value="5 - 10 Kişi" <? if ($v->calisansayisi == "5 - 10 Kişi"){ echo ' selected'; } ?>>5 - 10 Kişi</option>
						<option value="11 - 50 Kişi" <? if ($v->calisansayisi == "11 - 50 Kişi"){ echo ' selected'; } ?>>11 - 50 Kişi</option>
						<option value="51 - 100 Kişi" <? if ($v->calisansayisi == "51 - 100 Kişi"){ echo ' selected'; } ?>>51 - 100 Kişi</option>
						<option value="51 - 100 Kişi" <? if ($v->calisansayisi == "51 - 100 Kişi"){ echo ' selected'; } ?>>100 Kişiden fazla</option>
					</select>
                </div>
				</div>
				</div>
				
            </div>
        </div>
	<div class="panel panel-default">
            <div class="panel-heading">Firma Hakkında</div>
            <div class="panel-body">
			<textarea name="f13" class="form-control" required><?php echo $v->hakkinda; ?></textarea>
            </div>
        </div>	
		

     
        <div class="panel panel-default">
            <div class="panel-heading">Logo</div>
            <div class="panel-body">
                <?php
                if ($_GET["ilanId"] != "") {
                    $ses = $_GET["ilanId"];
                } else {
                    $ses = "9999999" . $_SESSION["uye"];
                }
                ?>
                <iframe src="fileserver/?id=<?php echo $ses; ?>&tip=1" width="100%" height="300" frameboder="0" style="border:none !important"></iframe>
            </div>
        </div>
        <br>
        <div class="panel panel-default">
            <div class="panel-heading">İletişim Bilgileri</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-3">
                        <div class="form-group">
                            <label>İl :</label>
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
                                <label>İlçe :</label>
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
                            <script> localitys();</script>
                            <div class="form-group">
                                <label>Mahalle :</label>
                                <select name="data10" id="locality" class="form-control mahalle" onchange="maps()" required>
                                </select>
                            </div>
                    </div>
                    <div class="col-xs-12">
                        <div id="map_canvas" style="width:100%; height:350px; padding:5px; border:solid 1px #ddd"></div>
                    </div>
                </div>
				<div class="form-group">
				<label>Adres</label>
				<textarea name="f14" id="f14" class="form-control" required><? echo $v->fadres; ?></textarea>
				</div>
            </div>
        </div>
    </div>
    <input size="20" type="hidden" id="latbox" name="lat" >
        <input size="20" type="hidden" id="lngbox" name="lng" >
            <input size="20" type="hidden" id="zoom" name="zoom" >
                <input size="20" type="hidden" id="address" name="address" >
                    <cfoutput>
                        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCpxv2EoVBP72pIqOHnzehHqTkWRWCw1Nc&sensor=false"></script>
                    </cfoutput>
                    <script type="text/javascript" src="<?php echo $base_url; ?>/js/map.js"></script>
                    <script> initialize()</script>
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
