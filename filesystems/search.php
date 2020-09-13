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
                <div class="panel-heading"><i class="fa fa-list" aria-hidden="true"></i>Catégories</div>
                <div class="panel-body">
				<b><div class="subcat_special">
	<i class="fa fa-bell-o" style="color: #20568a;" aria-hidden="true"></i> <a href="<?php echo $base_url; ?>acil-ilanlar.html?sayfa=1" style="color:#545454" class="cat_text">Dernières publications</a><div style="clear:both"></div></div>
	<div class="subcat_special">
	<i class="fa fa-thumbs-down" style="color: #20568a;" aria-hidden="true"></i> <a href="<?php echo $base_url; ?>fiyati-dusenler.html" style="color:#545454" class="cat_text">Prix ​​réduit</a><div style="clear:both"></div></div>
<div class="subcat_special">
	<i class="fa fa-shopping-cart" style="color: #20568a;" aria-hidden="true"></i> <a href="<?php echo $base_url; ?>get-ilanlar.html"  style="color:#545454" class="cat_text">Annonces e-commerce sécurisées</a><div style="clear:both"></div></div>
	<div class="subcat_special">
	<i class="fa fa-globe"  style="color: #20568a;" aria-hidden="true"></i> <a href="<?php echo $base_url; ?>haritali-ilanlar.html" style="color:#545454" class="cat_text">Annonces avec carte</a><div style="clear:both"></div></div>
	<div class="subcat_special">
	<i class="fa fa-building" style="color: #20568a;" aria-hidden="true"></i> <a href="<?php echo $base_url; ?>rehber.html?sayfa=1" style="color:#545454" class="cat_text">Annuaire de l'entreprise</a><div style="clear:both"></div></div>
	<div class="subcat_special">
	<i class="fa fa-clock-o" style="color: #20568a;" aria-hidden="true"></i> <a href="<?php echo $base_url; ?>son-48-saat.html" style="color:#545454" class="cat_text">Dernières 48 heures</a> / <a href="/son-1-hafta.html"  style="color:#545454" class="cat_text">1 semaine</a> / <a href="/son-1-ay.html" style="color:#545454" class="cat_text">1 mois</a><div style="clear:both"></div></div>
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
                <div class="panel-heading"><i class="fa fa-search" aria-hidden="true"></i> Arama Sonuçları</div>
                <div class="panel-body">
                    <div class="row no-gutter">
                        <?
                        $keyword = $_GET["keyword"];
                        if(is_numeric($keyword))  {
                        $sql = $db->query("SELECT * FROM ilanlar WHERE (Id = '$keyword' and confirm = '1') and (bitis >= '$bugun')");
                        if ($sql->rowCount() > 0){
                        $a = $sql->fetch(PDO::FETCH_ASSOC);
                        $l = "i-$a[Id]-".slugify($a["title"]).".html";
                        header("location: $l");
                        }
                        }

                        $bugun = date("Y-m-d");
                        $sayfada = 48;
                        $sayfa = $_GET["sayfa"];
                        $say = $db->query("SELECT * FROM ilanlar WHERE (confirm = '1' and bitis >= '$bugun') and title LIKE '%$keyword%'");
                        $toplam = $say->rowCount();
                        $toplam_sayfa = ceil($toplam / $sayfada);
                        if($sayfa < 1) $sayfa = 1;
                        if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa;
                        $limit = ($sayfa - 1) * $sayfada;
                        $sql = $db->query("SELECT * FROM ilanlar WHERE (confirm = '1' and bitis >= '$bugun') and title LIKE '%$keyword%' LIMIT $limit,$sayfada");
                        if ($toplam == 0){
                        echo 'Arama kriterlerinize ait sonuç bulunamadı';
                        }
                        while ($a = $sql->fetch(PDO::FETCH_ASSOC)){
                        $resim = $db->query("SELECT * FROM images WHERE ilanId = '{$a['Id']}' ORDER BY s ASC LIMIT 1");
                        if ($resim->rowCount() == 0) {
                        $src = "img/no.png";
                        } else {
                        $r   = $resim->fetch(PDO::FETCH_ASSOC);
                        $src = $base_url . "fileserver/files/" . $a["Id"] . "/thumbnail/" . $r["name"];
                        }
                        echo '
                        <div class="col-xs-6 col-sm-3 col-md-2">
                        <div class="adv2">
                        <div class="image1"><a href="i-'.$a["Id"].'-'.slugify($a["title"]).'.html" alt="'.$a["title"].'" title="'.$a["title"].'"><img src="' . $src . '" alt="'.$a["title"].'" width="93" height="75"/></a></div>
						<div class="box_type" style="position: absolute;top: 2px;right:11px;background: rgba(0,0,0,0.5);color: #fff;border-radius: 4px;font-weight:600;font-size: 12px;-webkit-border-bottom-left-radius: 3px;-moz-border-radius-bottomleft: 3px;border-bottom-left-radius: 3px;">'.number_format($a[price]).' '.$a[exchange].'</div>
                        <div class="adv2-title" style="font-size:11px;margin-top:-10px;"><a href="i-'.$a["Id"].'-'.slugify($a["title"]).'.html" alt="'.$a["title"].'" title="'.$a["title"].'">' . ucfirst(mb_substr($a["title"],0,12)) . '..</a></div></div>
                        </div>';
                        }
                        ?>
                    </div>
                    <?
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

                    if($sayfa != 1) echo '<li><a href="index.php?page=search&keyword=$keyword&sayfa='.($sayfa-1).'">&lt; Önceki</a></li>';

                    for($s = $sol_sayfalar; $s <= $sag_sayfalar; $s++) {
                    if($sayfa == $s) {
                    echo '<li class="active"><a href="index.php?page=search&keyword='.$keyword.'&sayfa='.$s.'">' . $s . '</a></li>';
                    } else {
                    echo '<li><a href="index.php?page=search&keyword='.$keyword.'&sayfa='.$s.'">'.$s.'</a><li>';
                    }
                    }

                    if($sayfa != $toplam_sayfa) echo '<li><a href="index.php?page=search&keyword='.$keyword.'&sayfa='.($sayfa+1).'">Sonraki &gt;</a></li>';
                    echo '</ul>';
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