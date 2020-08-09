<?php
$id = $_GET["id"];
$si_url_query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
parse_str($si_url_query, $_GET);
$sayfada = 5;
$sayfa = $_GET["sayfa"];

if ($sayfa == ""){ $sayfa = 1; }
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
							$sql = $db->query("SELECT * FROM bkategoriler ORDER BY kategoriadi ASC");
							while ($a = $sql->fetch(PDO::FETCH_ASSOC)) {
							$sql2 = $db->query("SELECT * FROM byazilar WHERE kategoriId = '{$a['Id']}'");
							$say = $sql2->rowCount();
							echo '<li class="sub1"><a href="b-'.$a["Id"].'-'.slugify($a["kategoriadi"]).'.html">» ' . $a["kategoriadi"] . ' <span>( '.$say.' )</span></a></li>';
							}							 
							?>
                        </ul>
                    </div>
                </div>
            </div>
</div>

<div class="col-xs-12 col-sm-9" style="padding-left:5px;">
<div class="panel panel-default">
<?
if ($id != ""){
		$sqlz = $db->query("SELECT * FROM bkategoriler ORDER BY kategoriadi ASC");
		$z = $sqlz->fetch(PDO::FETCH_ASSOC);
		$kat = " / ".$z["kategoriadi"];
}
?>
<div class="panel-heading">Blog<? echo $kat; ?></div>
<div class="panel-body">
<?
if ($id != ""){
$ek = " WHERE kategoriId = '$id'";	
} else {
$ek = "";
}

$say = $db->query("SELECT * FROM byazilar$ek ORDER BY Id DESC");
$toplam = $say->rowCount();
$toplam_sayfa = ceil($toplam / $sayfada);
if ($toplam_sayfa == 0){
echo '<div class="alert alert-danger">Kategoriye ait yazı bulunamadı</div>';	
} else {
echo 'Toplam <strong>'.$toplam_sayfa.'</strong> Sayfa / Görüntülenen sayfa : <strong>'.$sayfa.'</strong>';
}
if($sayfa < 1) $sayfa = 1;
if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa;
$limit = ($sayfa - 1) * $sayfada;
$sql = $db->query("SELECT * FROM byazilar$ek ORDER BY Id DESC  LIMIT $limit,$sayfada");
while ($a = $sql->fetch(PDO::FETCH_ASSOC)){

echo '
<div class="media" style="margin-bottom:0px !important">
  <div class="media-left media-top">
    <a href="'.$base_url.'blog-'.$a["Id"].'-'.slugify($a["baslik"]).'.html"><img src="uploads/'.$a["resim"].'" class="media-object" style="width:100px; height:75px; padding:5px; border:solid 1px #eee"></a>
  </div>
  <div class="media-body">
    <h4 class="media-heading" style="font-size:14px !important; font-weight:bold"><a href="'.$base_url.'blog-'.$a["Id"].'-'.slugify($a["baslik"]).'.html" style="color:#000 !important">'.$a["baslik"].'</a></h4>
    <p style="font-size:12px !important"><span style="color:green"><i class="fa fa-clock-o"></i> '.$a["tarih"].'</span> <br>
	<a href="'.$base_url.'blog-'.$a["Id"].'-'.slugify($a["baslik"]).'.html" style="color:#000 !important">'.$a["kisa"].'</a></p>
  </div>
</div>
<hr style="margin-top:10px !important; margin-bottom:10px !important">';
}
if ($toplam != 0){
            echo '<ul class="pagination">';
			if ($id != ""){
			$goruntulenen = 'b-'.$id.'-'.slugify($z["kategoriadi"]).'.html';	
			} else {
            $goruntulenen = "blog.html";
			}
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

            if($sayfa != 1) echo '<li><a href="'.$goruntulenen.'?sayfa='.($sayfa-1).'">&lt; Önceki</a></li>';

            for($s = $sol_sayfalar; $s <= $sag_sayfalar; $s++) {
            if($sayfa == $s) {
            echo '<li class="active"><a href="'.$goruntulenen.'?sayfa='.$s.'">' . $s . '</a></li>';
            } else {
            echo '<li><a href="'.$goruntulenen.'?sayfa='.$s.'">'.$s.'</a><li>';
            }
            }

            if($sayfa != $toplam_sayfa) echo '<li><a href="'.$goruntulenen.'?sayfa='.($sayfa+1).'">Sonraki &gt;</a></li>';
            echo '</ul>';
			}
?>
</div>
</div>
</div>
 </div>
 </div><br><br>
