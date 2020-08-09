<?
header("Pragma: no-cache");
$id = $_GET['id'];
$sql = $db->query("SELECT * FROM ilanlar WHERE Id = '$id'");
$row = $sql->fetch(PDO::FETCH_ASSOC);
$il    = $db->query("SELECT * FROM city WHERE id = '{$row['city']}'");
$ilyaz = $il->fetch(PDO::FETCH_ASSOC);
$ilce    = $db->query("SELECT * FROM county WHERE id = '{$row['districts']}'");
$ilceyaz = $ilce->fetch(PDO::FETCH_ASSOC);
$mahalle    = $db->query("SELECT * FROM locality WHERE id = '{$row['locality']}'");
$mahalleyaz = $mahalle->fetch(PDO::FETCH_ASSOC);

$sql2 = $db->query("SELECT * FROM images WHERE ilanId = '$id' ORDER BY s ASC LIMIT 1");
if ($sql2->rowCount() == 0) {
$src = "img/no.png";
} else {
$row2 = $sql2->fetch(PDO::FETCH_ASSOC);
$src = $base_url . "fileserver/files/" . $row["Id"] . "/" . $row2["name"];
}
?>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/tr_TR/sdk.js#xfbml=1&version=v2.8";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="container top15">
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
        <div class="col-md-9 col-sm-12 col-xs12">
          <h3 class="ilan-title"><? echo $row["firmadi"]; ?></h3>
        </div>
        <div class="hidden-xs hidden-sm col-md-3"> <span class="pull-right"><script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-58400d4ed706c4e5"></script>
          <div class="addthis_inline_share_toolbox"></div>
          </span> </div>
      </div>
      <hr style="margin-top:10px; margin-bottom:10px">

  <link  href="assets/js/fotorama.css" rel="stylesheet">
<script src="assets/js/fotorama.js"></script>
<link  href="assets/css/nivo-lightbox.css" rel="stylesheet">
<link  href="assets/css/themes/default/default.css" rel="stylesheet">
<script src="assets/css/nivo-lightbox.js"></script>

<script>
$(document).ready(function(){
    $('a').nivoLightbox();
});
</script>
 


 <center><div class="fotorama" data-nav="thumbs">
   <?
    $sql12 = $db->query("SELECT * FROM images WHERE ilanId = '$id'");
    $ks = 1;
    $kac = $sql12->rowCount();
    $i = 0;
    while ($l = $sql12->fetch(PDO::FETCH_ASSOC)){
    echo '
        <a href="'.$base_url.'fileserver/files/'.$id.'/'.$l["name"].'" id="img_'.$l[Id].'"><img src="'.$base_url.'fileserver/files/'.$id.'/'.$l["name"].'" id="img_'.$l[Id].'" ></a>
    ';
    $i++;
  }
    ?>
 
</div> </center>
<?
    $sql12 = $db->query("SELECT * FROM images WHERE ilanId = '$id'");
    $ks = 1;
    $kac = $sql12->rowCount();
    $i = 0;
    while ($l = $sql12->fetch(PDO::FETCH_ASSOC)){
  if ($a[ae_xml_id] == 0){
    echo '
   
    ';
  } else {
    
  }
    $i++;
    }
    ?>
			

    </div>
  </div>
  

  

 <div class="panel panel-default">
    <div class="panel-heading">Firma Bilgileri</div>
    <div class="panel-body">
			<div class="row font12">
			<div class="col-lg-6"><b>Telefon</b> : </div>
			<div class="col-lg-6"><? echo $row["telefon"]; ?></div><br>
			<div class="col-lg-6"><b>Fax</b> : </div>
			<div class="col-lg-6"><? echo $row["fax"]; ?></div><br>
			<div class="col-lg-6"><b>GSM</b> : </div>
			<div class="col-lg-6"><? echo $row["gsm"]; ?></div><br>
			<div class="col-lg-6"><b>Web</b> : </div>
			<div class="col-lg-6"><? echo $row["web"]; ?></div><br>
			<div class="col-lg-6"><b>Vergi Dairesi</b> : </div>
			<div class="col-lg-6"><? echo $row["vergidairesi"]; ?></div><br>
			<div class="col-lg-6"><b>Vergi Numarası</b> : </div>
			<div class="col-lg-6"><? echo $row["vergino"]; ?></div><br>
			<div class="col-lg-6"><b>Kuruluş Yılı</b> : </div>
			<div class="col-lg-6"><? echo $row["kurulusyili"]; ?></div><br>
			<div class="col-lg-6"><b>İşletme Türü</b> : </div>
			<div class="col-lg-6"><? echo $row["isletmeturu"]; ?></div><br>
			<div class="col-lg-6"><b>Yetkili</b> : </div>
			<div class="col-lg-6"><? echo $row["yetkili"]; ?></div><br>
			<div class="col-lg-6"><b>Yıllık Ciro</b> : </div>
			<div class="col-lg-6"><? echo $row["ciro"]; ?></div><br>
			<div class="col-lg-6"><b>Çalışan Sayısı</b> : </div>
			<div class="col-lg-6"><? echo $row["calisansayisi"]; ?></div><br>
			</div>
	
	</div>
  </div>

 <div class="panel panel-default">
    <div class="panel-heading">Firma Hakkında</div>
    <div class="panel-body"><? echo $row["hakkinda"]; ?></div>
  </div>

 
  


<div class="panel panel-default">
    <div class="panel-heading">Konum</div>
    <div class="panel-body">
<style> #map { height: 400px; width: 100%; } </style>
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

<div class="panel panel-default">
    <div class="panel-heading">Bu Kategorideki Diğer Firmalar</div>
    <div class="panel-body">
	 <div class="row no-gutter">
	 <style> .image1 { height: 102px } </style>
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
						category10 = '{$row['category10']}' and confirm = '1' ORDER BY Id DESC LIMIT 24");
						
                        while ($row = $sqlsor->fetch(PDO::FETCH_ASSOC)) {
                        $resim = $db->query("SELECT * FROM images WHERE ilanId = '{$row['Id']}' ORDER BY s ASC LIMIT 1");
                        if ($resim->rowCount() == 0) {
                        $src = "img/no.png";
                        } else {
                        $r   = $resim->fetch(PDO::FETCH_ASSOC);
                        $src = $base_url . "fileserver/files/" . $row["Id"] . "/thumbnail/" . $r["name"];
                        }
                        echo '
            <div class="adv' . $class . '" onclick="window.location.href=\'firma-'.$row["Id"].'-'.slugify($row["firmadi"]).'.html\'" style="cursor:pointer">
            <div class="row no-gutter">
            <div class="col-xs-3 col-sm-2"><a href="firma-'.$row["Id"].'-'.slugify($row["firmadi"]).'.html"><img src="' . $src . '" class="img-thumbnail" width="100" /></a></div>
            <div class="col-xs-7 col-sm-6"><strong style="font-size:14px">' . $row["firmadi"] . '</strong>
            <br><span style="font-size:12px">'.substr($row["hakkinda"],0,190).'</span>
            <br><div style="font-size:11px">';
			$msl = $db->query("SELECT * FROM modulitems WHERE modulsId = '$modul' and goster = '1'");
			while ($mnb = $msl->fetch(PDO::FETCH_ASSOC)){
	
			$sql5 = $db->query("SELECT * FROM modul_ilan WHERE itemId = '{$mnb['Id']}' and ilanId = '{$row['Id']}'");
			$row5 = $sql5->fetch(PDO::FETCH_ASSOC);
			
			
			if ($row5["type"] != 1){
			$sql7 = $db->query("SELECT * FROM  modulitemsselect WHERE Id = '{$row5['selects']}'");
			$row7 = $sql7->fetch(PDO::FETCH_ASSOC);	
			echo '
            <b>'.$mnb["name"].':</b>'.$row7["name"].'	&nbsp;	&nbsp; <i class="fa fa-ellipsis-v" aria-hidden="true"></i>	&nbsp;	&nbsp;';
			} else {
			echo '
            <b>'.$mnb["name"].':</b>'.$row5["selects"].' 	&nbsp;	&nbsp; <i class="fa fa-ellipsis-v" aria-hidden="true"></i>	&nbsp;	&nbsp;';

			}	
			}
			echo '</div></div>
            <div class="hidden-xs col-sm-4" style="text-align:center; padding:5px; font-size:12px !important; border-left:solid 1px #eee">
			'.$row["fadres"].'<br>' . $ilyaz["il_adi"] . ' / ' . $ilceyaz["county_adi"] . ' / ' . $mahalleyaz["districtname"] . '<br> <b>'.$row["telefon"].'</b>
			</div>
            </div>
            </div>
            ';
                        }
                        ?>
	</div>
	</div>
  </div>
  
  
</div>

<script>
    function fav()
    {
    <? if ($_SESSION['uye'] == ""){ ?>
            alert("İlanı favorilerinize eklemek için üye girişi yapınız");
    <? } else { ?>
            if (confirm("İlanı favorilerinize eklemek istediğinize eminmisiniz ?")){
    $.post("favori.php", { id: "<? echo $_GET["id"]; ?>"});
    alert("İlan favorilerinize eklendi");
    }
    <? } ?>
    }
    function sikayet()
    {
    <? if ($_SESSION['uye'] == ""){ ?>
            alert("İlanı şikayet etmek için üye girişi yapınız");
    return false;
    <? } else { ?>
            return true;
    <? } ?>
    }
function teklif()
{
	<? if ($_SESSION['uye']  == ""){ ?>
	$("#error").html("Teklif verebilmeniz için üye girişi yapmanız gerekmektedir.");
	$('#myModal').modal("show");
	<? } else { ?>
	var e = $("#tt").val();
	var f = "<? echo $id; ?>";
	if (e == ""){
		$("#error").html("Teklif tutarını belirtmediniz");
		$('#myModal').modal("show");
	} else {
		$.post('filesystems/teklif.php', {tutar: e, id: f}, function (output) {
			if (output == 0){
				$("#error").html("Teklif tutarı son verilen tekliften büyük olmalıdır");
      			$('#myModal').modal("show");
			}else if (output == 1){
				$("#error").html("Teklif tutarı minimum artış tutarından büyük olmalıdır");
      			$('#myModal').modal("show");
			}else if (output == 2){
				$("#error").html("Teklifiniz başarıyla alındı");
      			$('#myModal').modal("show");
				window.location.reload();
			}else if (output == 3){
				$("#error").html("Teklif tutarı başlangıç fiyatından büyük olmalıdır");
      			$('#myModal').modal("show");
			}else if (output == 5){
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
