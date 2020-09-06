<? if(!defined('access')){ exit; }
function sayac($id)
{
global $db;
$bugun = date("Y-m-d");
$sql   = $db->query("SELECT Id FROM ilanlar WHERE (category1 = '$id' or category2 = '$id' or category3 = '$id' or category4 = '$id' or category5 = '$id' or category6 = '$id' or category7 = '$id' or category8 = '$id' or category9 = '$id' or category10 = '$id') and (bitis >= '$bugun') and confirm = '1'");
return $sql->rowCount();
}
?>

<div class="container top15">
  <div class="panel panel-default">
    <div class="panel-heading">Vitrine<span class="pull-right"><a href="anasayfa-ilanlari.html" >Tümünü Görüntüle</a></span></div>
    <div class="panel-body">
      <div class="row no-pad">
        <?
                        $bugun = date("Y-m-d");
                        $doping = $db->query("SELECT * FROM doping WHERE (name = 'anasayfa') and (onay  = '1') and (val >= '$bugun')");
                        while ($a = $doping->fetch(PDO::FETCH_ASSOC)){
                        $idler [] = $a["ilanId"];
                        }
                        if (count($idler) > 0){
                        $idler = implode(",",$idler);
                        $sqlsor = $db->query("SELECT * FROM ilanlar WHERE Id IN($idler) and (bitis >= '$bugun') and confirm = '1' ORDER BY rand() DESC LIMIT 18 ");
                        while ($row = $sqlsor->fetch(PDO::FETCH_ASSOC)) {
                        $resim = $db->query("SELECT * FROM images WHERE ilanId = '{$row['Id']}' ORDER BY s ASC LIMIT 1");
                        if ($resim->rowCount() == 0) {
                        $src = "img/no.png";
                        } else {
                        $r   = $resim->fetch(PDO::FETCH_ASSOC);
                        $src = $base_url . "fileserver/files/" . $row["Id"] . "/thumbnail/" . $r["name"];
                        }
						$il    = $db->query("SELECT * FROM city WHERE id = '{$row['city']}'");
						$ilyaz = $il->fetch(PDO::FETCH_ASSOC);
                        echo '
						<div class="col-xs-2">
						<div class="thumbnail">
               			<a href="i-'.$row["Id"].'-'.slugify($row["title"]).'.html" alt="'.$row["title"].'" title="'.$row["title"].'"><img src="' . $src . '"></a>
                		<div class="caption">
                  		<a href="i-'.$row["Id"].'-'.slugify($row["title"]).'.html" alt="'.$row["title"].'" title="'.$row["title"].'">' . tr_ucwords(substr($row["title"],0,15)) . '</a>
                 		<br><span>'; if ($row["type"] == 2){ echo 'ihale';} else { echo '' . str_replace(",", ".", number_format($row["price"])) . ' ' . $row["exchange"] . ''; }echo '</span><br>
						<span class="loc"><i class="fa fa-map-marker" aria-hidden="true"></i> ' . $ilyaz["il_adi"] . '</span>
                		</div>
              			</div>
                        </div>';
                        }
                        }
                        ?>
      </div>
    </div>
  </div>
  <div style="margin-bottom:10px; margin-top:10px"><? echo banner(1); ?></div>
  
      <div class="panel panel-default">
        <div class="panel-heading">Son Eklenen İlanlar</div>
        <div class="panel-body">
          <div class="row no-pad">
            <?
                        $bugun = date("Y-m-d");
                        $sqlsor = $db->query("SELECT * FROM ilanlar WHERE (bitis >= '$bugun') and confirm = '1' ORDER BY Id DESC LIMIT 10");
                        while ($row = $sqlsor->fetch(PDO::FETCH_ASSOC)) {
                        $resim = $db->query("SELECT * FROM images WHERE ilanId = '{$row['Id']}' ORDER BY s ASC LIMIT 1");
                        if ($resim->rowCount() == 0) {
                        $src = "img/no.png";
                        } else {
                        $r   = $resim->fetch(PDO::FETCH_ASSOC);
                        $src = $base_url . "fileserver/files/" . $row["Id"] . "/thumbnail/" . $r["name"];
                        }
			$il    = $db->query("SELECT * FROM city WHERE id = '{$row['city']}'");
            $ilyaz = $il->fetch(PDO::FETCH_ASSOC);
            $ilce    = $db->query("SELECT * FROM county WHERE id = '{$row['districts']}'");
            $ilceyaz = $ilce->fetch(PDO::FETCH_ASSOC);

            $mahalle    = $db->query("SELECT * FROM locality WHERE id = '{$row['locality']}'");
            $mahalleyaz = $mahalle->fetch(PDO::FETCH_ASSOC);
						$e = explode("-", $row["dates"]);	
			echo '
			<div class="col-xs-6">
            <div class="adv' . $class . '" onclick="window.location.href=\'i-'.$row["Id"].'-'.slugify($row["title"]).'.html\'" style="cursor:pointer">
            <div class="row no-pad">
            <div class="col-xs-3"><a href="i-'.$row["Id"].'-'.slugify($row["title"]).'.html"><img src="' . $src . '" class="img-thumbnail" /></a></div>
            <div class="col-xs-9"><strong style="font-size:14px">' . tr_ucwords(substr($row["title"],0,100))  . '</strong>
            <br><span style="font-size:12px"><i class="fa fa-clock-o" aria-hidden="true"></i> ' . $e[2] . '-' . $e[1] . '-' . $e[0] . ' <br>
			<span class="loc"><i class="fa fa-map-marker" aria-hidden="true"></i> ' . $ilyaz["il_adi"] . ' / ' . $ilceyaz["county_adi"] . ' / ' . $mahalleyaz["districtname"] . '</span></span>
            </div>
            </div>
            </div></div>
            ';
			}
			?>
          </div>
        </div>
      </div>
 <div style="margin-bottom:10px; margin-top:10px"><? echo banner(2); ?></div>
      <div class="panel panel-default">
        <div class="panel-heading">Son Eklenen Acil İlanlar<span class="pull-right"><a href="acil-ilanlar.html" >Tümünü Görüntüle</a></span></div>
        <div class="panel-body">
          <div class="row no-pad">
            <?
                        $bugun = date("Y-m-d");
                        $idler = array();
                        $doping = $db->query("SELECT * FROM doping WHERE (name = 'acil') and (onay  = '1') and (val >= '$bugun')");
                        while ($a = $doping->fetch(PDO::FETCH_ASSOC)){
                        $idler [] = $a["ilanId"];
                        }
                        if (count($idler) > 0){
                        $idler = implode(",",$idler);
                        $sqlsor = $db->query("SELECT * FROM ilanlar WHERE Id IN($idler) and (bitis >= '$bugun') and confirm = '1' ORDER BY Id DESC LIMIT 10");
                        while ($row = $sqlsor->fetch(PDO::FETCH_ASSOC)) {
                        $resim = $db->query("SELECT * FROM images WHERE ilanId = '{$row['Id']}' ORDER BY s ASC LIMIT 1");
                        if ($resim->rowCount() == 0) {
                        $src = "img/no.png";
                        } else {
                        $r   = $resim->fetch(PDO::FETCH_ASSOC);
                        $src = $base_url . "fileserver/files/" . $row["Id"] . "/thumbnail/" . $r["name"];
                        }
                       $il    = $db->query("SELECT * FROM city WHERE id = '{$row['city']}'");
            $ilyaz = $il->fetch(PDO::FETCH_ASSOC);
            $ilce    = $db->query("SELECT * FROM county WHERE id = '{$row['districts']}'");
            $ilceyaz = $ilce->fetch(PDO::FETCH_ASSOC);

            $mahalle    = $db->query("SELECT * FROM locality WHERE id = '{$row['locality']}'");
            $mahalleyaz = $mahalle->fetch(PDO::FETCH_ASSOC);
						$e = explode("-", $row["dates"]);	
			echo '
			<div class="col-xs-6">
            <div class="adv' . $class . '" onclick="window.location.href=\'i-'.$row["Id"].'-'.slugify($row["title"]).'.html\'" style="cursor:pointer">
            <div class="row no-pad">
            <div class="col-xs-3"><a href="i-'.$row["Id"].'-'.slugify($row["title"]).'.html"><img src="' . $src . '" class="img-thumbnail" /></a></div>
            <div class="col-xs-9"><strong style="font-size:14px">' . $row["title"] . '</strong>
            <br><span style="font-size:12px"><i class="fa fa-clock-o" aria-hidden="true"></i> ' . $e[2] . '-' . $e[1] . '-' . $e[0] . ' <br>
			<span class="loc"><i class="fa fa-map-marker" aria-hidden="true"></i> ' . $ilyaz["il_adi"] . ' / ' . $ilceyaz["county_adi"] . ' / ' . $mahalleyaz["districtname"] . '</span></span>
            </div>
            </div>
            </div></div>
            ';
                        }
                        }
                        ?>

      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">Son Eklenen Mağazalar<span class="pull-right"><a href="magazalar.html" >Tümünü Görüntüle</a></span></div>
    <div class="panel-body">
      <div class="row no-pad">
        <?
                        $b = str_replace("http://","",$base_url);
                        $b = rtrim($b,"/");
                        $bugun = date("Y-m-d");
                        $sql = $db->query("SELECT * FROM magazalar WHERE onay = '1' and bitis >= '$bugun' ORDER BY Id DESC LIMIT 18");
                        while ($a = $sql->fetch(PDO::FETCH_ASSOC)){
                        if ($a["logo"] == ""){
                        $src = "img/no.png";
                        } else {
                        $src = "uploads/$a[logo]";
                        }
                        echo '
                        <div class="col-xs-2">
                        <div class="adv2">
                        <div class="image1"><a href="http://'.$a["adres"].'.'.$b.'" alt="'.$a["magazaadi"].'" title="'.$a["magazaadi"].'"><img src="' . $src . '" style="width:100px !important; height:auto !important; max-height:75px !important"/></a></div>
                        <div class="adv2-title"><a href="http://'.$a["adres"].'.'.$b.'" alt="'.$a["magazaadi"].'" title="'.$a["magazaadi"].'">' . tr_ucwords(substr($a["magazaadi"],0,20)) . '</a></div>
                        </div></div>';
                        }
                        ?>
      </div>
    </div>
  </div>
  <div style="margin-top:10px; margin-bottom:10px" ><? echo banner(4); ?></div>
</div>
