<?
if ($_GET['id'] != ""){
	$id = $_GET['id'];
	if ($_GET['i'] == "onay"){
	$sql2 = "UPDATE magazalar SET onay = '0' WHERE Id = '$id'";
	$stmt = $db->prepare($sql2);
	$stmt->execute();
	} elseif ($_GET["i"] == "sil"){
	$sql = $db->prepare("DELETE FROM magazalar WHERE Id = '{$id}'");
	$sql->execute();	
	}
}
?>
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<section class="content-header">
<h1> Mağaza Yönetimi<small>Onaylanan</small> </h1>
<ol class="breadcrumb">
  <li><a href="index.php"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
  <li class="active">Mağaza Yönetimi</li>
    <li>Onaylanan</li>

</ol>
</section>
<section class="content">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Onaylanan</h3>
    </div>

        <table id="myTable" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Mağaza Adı</th>
              <th>Sahibi</th>
			  <th>Mağaza Süresi</th>
			   <th>Mağaza Bitiş</th>
			   <th>Toplam İlan Kotası</th>
              <th>Url</th>
              <th width="180"></th>
            </tr>
          </thead>
          <tbody>
  			 <?
		function farkbul($tarih1,$tarih2,$ayrac){
        list($g1,$a1,$y1) = explode($ayrac,$tarih1);
        list($g2,$a2,$y2) = explode($ayrac,$tarih2);
        $t1_timestamp = mktime('0','0','0',$a1,$g1,$y1);
        $t2_timestamp = mktime('0','0','0',$a2,$g2,$y2);
        if ($t1_timestamp > $t2_timestamp)
        {
                $result = floor(($t1_timestamp - $t2_timestamp) / 86400);
        }
        else if ($t2_timestamp > $t1_timestamp)
        {
                $result = floor(($t1_timestamp - $t2_timestamp) / 86400);
        }
 
        return $result;
		}
	
			 	$sayfada = 100;
				$sayfa = $_GET["sayfa"];
				$bugun = date("Y-m-d");
				$say = $db->query("SELECT * FROM magazalar WHERE onay = '1' and bitis >= '$bugun' ORDER BY Id DESC");
				$toplam = $say->rowCount();
				$toplam_sayfa = ceil($toplam / $sayfada);
				if($sayfa < 1) $sayfa = 1;
				if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa;
				$limit = ($sayfa - 1) * $sayfada;
				if ($limit < 0){ $limit = 100; }
				$sql = $db->query("SELECT * FROM magazalar WHERE onay = '1' and bitis >= '$bugun' ORDER BY Id DESC LIMIT $limit,$sayfada");
				if ($toplam == 0){
				echo '<tr class="odd"><td valign="top" colspan="4" class="dataTables_empty">Onaylanan mağaza bulunmamaktadır</td></tr>';
				}
			    while ($a = $sql->fetch(PDO::FETCH_ASSOC)){
				$sql2 = $db->query("SELECT * FROM users WHERE Id = '{$a['uyeId']}'");
				$b = $sql2->fetch(PDO::FETCH_ASSOC);
				$b33 = "ilanpro.net";
				$base = str_replace("http://","",$base_url);
				$base =substr_replace($base, '', -1);
				$fark = farkbul($a["bitis"],$bugun,"-");
				echo '
				<tr>
                  <td>'.$a["magazaadi"].'</td>
                  <td>'.$b["ad_soyad"].'</td>
				  <td>'.$a["sure"].' AY</td>
				  <td>'.$a["bitis"].'</td>
				  <td><b><font color="red">'.$a["magazakota"].'</font> Adet</b></td>
                  <td><a href="http://'.$a["adres"].'.'.$base.'" target="_blank">http://'.$a["adres"].'.'.$base.'</a></td>
                  <td><a class="btn btn-default btn-sm" href="index.php?page=mduzenle&id='.$a["Id"].'&return=monaylanan">Düzenle</a> <a class="btn btn-success btn-sm" href="index.php?page=monaylanan&id='.$a["Id"].'&i=onay" onclick="return onay()">Askı</a> <a class="btn btn-danger btn-sm" href="index.php?page=monaylanan&id='.$a["Id"].'&i=sil" onclick="return sor()">Sil</a></td>
                </tr>
				';	
				}
			?>
          </tbody>
          <tfoot>
            <tr>
              <th>Mağaza Adı</th>
              <th>Sahibi</th>
              <th>Url</th>
              <th></th>
            </tr>
          </tfoot>
        </table>
        <br>

        <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
        <?
		if ($toplam > 0){
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

            if($sayfa != 1) echo '<li><a href="'.$goruntulenen.'&sayfa='.($sayfa-1).'">&lt; Önceki</a></li>';

            for($s = $sol_sayfalar; $s <= $sag_sayfalar; $s++) {
            if($sayfa == $s) {
            echo '<li class="active"><a href="'.$goruntulenen.'&sayfa='.$s.'">' . $s . '</a></li>';
            } else {
            echo '<li><a href="'.$goruntulenen.'&sayfa='.$s.'">'.$s.'</a><li>';
            }
            }

            if($sayfa != $toplam_sayfa) echo '<li><a href="'.$goruntulenen.'&sayfa='.($sayfa+1).'">Sonraki &gt;</a></li>';
            echo '</ul>';
		}
		?></div>
      </div>
    </form>
  </div>
</section>
<script>
function sor()
{
	if (confirm("Mağazayı silmek istediğinize eminmisiniz?")){
	return true;	
	} else {
	return false	
	}
}

function onay()
{
	if (confirm("Mağazayı askıya almak istediğinize eminmisiniz? ")){
	return true;	
	} else {
	return false	
	}
}
$('#myTable').DataTable( {
    paging: false
} );
</script>