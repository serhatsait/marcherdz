<?
function sayac($id)
{
global $db;
$bugun = date("Y-m-d");
$sql   = $db->query("SELECT Id FROM ilanlar WHERE (category1 = '$id' or category2 = '$id' or category3 = '$id' or category4 = '$id' or category5 = '$id' or category6 = '$id' or category7 = '$id' or category8 = '$id' or category9 = '$id' or category10 = '$id') and (bitis >= '$bugun') and confirm = '1'");
return $sql->rowCount();
}
?>

<div class="container top15">
    <div class="row">
        <div class="hidden-xs col-sm-3">
           <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-list" aria-hidden="true"></i> Kategoriler</div>
                <div class="panel-body">
				<b><div class="subcat_special">
	<i class="fa fa-bell-o" style="color: #20568a;" aria-hidden="true"></i> <a href="<?php echo $base_url; ?>acil-ilanlar.html?sayfa=1" style="color:#545454" class="cat_text">Acil İlanları</a><div style="clear:both"></div></div>
	<div class="subcat_special">
	<i class="fa fa-thumbs-down" style="color: #20568a;" aria-hidden="true"></i> <a href="<?php echo $base_url; ?>fiyati-dusenler.html" style="color:#545454" class="cat_text">Fiyatı Düşenler</a><div style="clear:both"></div></div>
<div class="subcat_special">
	<i class="fa fa-shopping-cart" style="color: #20568a;" aria-hidden="true"></i> <a href="<?php echo $base_url; ?>get-ilanlar.html"  style="color:#545454" class="cat_text">Güvenli e-Ticaret İlanları</a><div style="clear:both"></div></div>
	<div class="subcat_special">
	<i class="fa fa-globe"  style="color: #20568a;" aria-hidden="true"></i> <a href="<?php echo $base_url; ?>haritali-ilanlar.html" style="color:#545454" class="cat_text">Haritali İlanlar</a><div style="clear:both"></div></div>
	<div class="subcat_special">
	<i class="fa fa-building" style="color: #20568a;" aria-hidden="true"></i> <a href="<?php echo $base_url; ?>rehber.html?sayfa=1" style="color:#545454" class="cat_text">Firma Rehberi</a><div style="clear:both"></div></div>
	<div class="subcat_special">
	<i class="fa fa-clock-o" style="color: #20568a;" aria-hidden="true"></i> <a href="<?php echo $base_url; ?>son-48-saat.html" style="color:#545454" class="cat_text">Son 48 Saat</a> / <a href="/son-1-hafta.html"  style="color:#545454" class="cat_text">1 Hafta</a> / <a href="/son-1-ay.html" style="color:#545454" class="cat_text">1 Ay</a><div style="clear:both"></div></div>
<div class="subcat_special">
	<i class="fa fa-briefcase" style="color: #20568a;" aria-hidden="true"></i> <a href="<?php echo $base_url; ?>magazalar.html" style="color:#545454" class="cat_text">Mağazalar</a><div style="clear:both"></div></div></b>

				<br>
                    <ul class="notranslate category">
                        <?

                        $sql = $db->query("SELECT * FROM category WHERE ustkategoriId = '0' and tip = '0' ORDER BY sira ASC");
                        while ($a = $sql->fetch(PDO::FETCH_OBJ)){
                        
						echo '<li class="maincat"><img src="'.$base_url.'ikonlar/'.$a->ikon.'" alt="'.$a->kategori_adi.'" width="20" height="20" class="absmiddle" /> <b>'.$a->kategori_adi.'</b></li>';
                        $ust = $a->Id;
                        $sql2 = $db->query("SELECT * FROM category WHERE ustkategoriId = '$ust'");
                        while ($b = $sql2 ->fetch(PDO::FETCH_OBJ)){
                        echo '<li><a href="kategori-'.$b->Id.'-'.slugify($b->kategori_adi).'.html">'.$b->kategori_adi.' <span>( ' . sayac($b->Id) . ' )</span></a></li>';
                        }
						
                        }
                        ?>
                    </ul>
					
                </div>
            </div></div>
        <div class="col-xs-12 col-sm-9" style="padding-left:5px;">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Mağazalar</div>
                <div class="panel-body">
                    <div class="row no-gutter">
                        <?
                        $b = str_replace("http://","",$base_url);
                        $b = rtrim($b,"/");
                        $murl = $SiteName;
						$bugun = date("Y-m-d");
                        $sayfada = 24;
                        $sayfa = $_GET["sayfa"];
                        $say = $db->query("SELECT * FROM magazalar WHERE onay = '1' and bitis >= '$bugun'");
                        $toplam = $say->rowCount();
                        $toplam_sayfa = ceil($toplam / $sayfada);
                        if($sayfa < 1) $sayfa = 1;
                        if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa;
                        $limit = ($sayfa - 1) * $sayfada;
						if ($limit < 0){ $limit = 0; }
                        $sql = $db->query("SELECT * FROM magazalar WHERE onay = '1' and bitis >= '$bugun'");
                        while ($a = $sql->fetch(PDO::FETCH_ASSOC)){
                        if ($a["logo"] == ""){ $src = "img/no.png"; } else { $src = "uploads/$a[logo]"; }
                        echo '
                        <div class="col-xs-6 col-sm-3 col-md-2">
                        <div class="adv2">
                        <div class="image1"><a href="http://'.$a["adres"].'.'.$murl.'" alt="'.$a["magazaadi"].'" title="'.$a["magazaadi"].'"><img src="' . $src . '" alt="'.$a["magazaadi"].'" width="93" height="65"/></a></div>
						<div class="box_type" style="min-width:60px;text-align: center;bottom: 0;padding: 1px 13px;z-index: 2;color: #000;font-size:12px;">' . tr_ucwords(substr($a["magazaadi"],0,9)) . '..</div>
                        </div></div>';
                        }
                        ?>
                    </div>
                    <?
					if ($limit < 0){
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

                    if($sayfa != 1) echo '<li><a href="magazalar-'.($sayfa-1).'.html">&lt; Önceki</a></li>';

                    for($s = $sol_sayfalar; $s <= $sag_sayfalar; $s++) {
                    if($sayfa == $s) {
                    echo '<li class="active"><a href="magazalar-'.$s.'.html">' . $s . '</a></li>';
                    } else {
                    echo '<li><a href="magazalar-'.$s.'.html">'.$s.'</a><li>';
                    }
                    }

                    if($sayfa != $toplam_sayfa) echo '<li><a href="magazalar-'.($sayfa+1).'.html">Sonraki &gt;</a></li>';
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
	  <div class="col-xs-6" style="width: 50%;">
	  <div class="form-group">
		<label>Kategori</label>
		<select class="form-control" name="id">
		<?
			$sql = $db->query("SELECT * FROM category WHERE ustkategoriId = '0'");
			while ($a = $sql->fetch(PDO::FETCH_ASSOC)) {
			echo '<option value="'.$a["Id"].'">' . $a["kategori_adi"] . '</option>';
			}
		?>
		</select>
	  </div>
	  </div>
	  <div class="col-xs-6" style="width: 50%;">
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
	  </div>
	  <div class="col-xs-6" style="width: 50%;">
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
	  </div>

	  <div class="col-xs-6" style="width: 50%;">
	  <label class="">Fiyat</label>
	   <div class="row no-gutter">
                                <div class="col-xs-6" style="width: 50%;">
                                    <div class="form-group">
                                        <input type="text" name="fiyat1" value="<? echo $_GET["fiyat1"]; ?>" class="form-control money" placeholder="minimum">
                                </div>
                            </div>
                            <div class="col-xs-6" style="width: 50%;">
                                <div class="form-group">
                                    <input type="text" name="fiyat2" class="form-control money" placeholder="maksimum" value="<? echo $_GET["fiyat2"]; ?>">
                            </div>
                        </div>
                    </div>
	  </div>
	  <div class="col-xs-1"><input type="submit" style="width:565px;margin-bottom:7px;" class="btn btn-danger" value="Aramaya Başla"></div>
	  </div>
	</div>
	</form>
  </div>
        </div>
    </div>