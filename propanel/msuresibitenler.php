<?
if ($_GET['id'] != ""){
	$id = $_GET['id'];
	if ($_GET['i'] == "yayin"){
	$sql = $db->query("SELECT * FROM magazalar WHERE Id = '$id'");
	$a = $sql->fetch(PDO::FETCH_ASSOC);
	$tarih = date("Y-m-d");
	$start = date("Y-m-d", strtotime("+$a[sure] month", strtotime($tarih)));
	
	$sql2 = "UPDATE magazalar SET onay = '1', bitis = '$start' WHERE Id = '$id'";
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

<h1> Mağaza Yönetimi<small>Süresi Bitenler</small> </h1>
<ol class="breadcrumb">
  <li><a href="index.php"><i class="fa fa-dashboard"></i> Page d'accueil</a></li>
  <li class="active">Mağaza Yönetimi</li>
  <li>Süresi Bitenler</li>
</ol>
</section>
<section class="content">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Süresi Bitenler</h3>
    </div>
    <table id="myTable" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Mağaza Adı</th>
          <th>Sahibi</th>
          <th>Url</th>
          <th width="180"></th>
        </tr>
      </thead>
      <tbody>
        <?
			 	$sayfada = 100;
				$sayfa = $_GET["sayfa"];
				$bugun = date("Y-m-d");
				$say = $db->query("SELECT * FROM magazalar WHERE onay = '1' and bitis < '$bugun' ORDER BY Id DESC");
				$toplam = $say->rowCount();
				$toplam_sayfa = ceil($toplam / $sayfada);
				if($sayfa < 1) $sayfa = 1;
				if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa;
				$limit = ($sayfa - 1) * $sayfada;
				if ($limit < 0){ $limit = 100; }
				$sql = $db->query("SELECT * FROM magazalar WHERE onay = '1' and bitis < '$bugun' ORDER BY Id DESC LIMIT $limit,$sayfada");
				if ($toplam == 0){
				echo '<tr class="odd"><td valign="top" colspan="4" class="dataTables_empty">Onaylanan mağaza bulunmamaktadır</td></tr>';
				}
			    while ($a = $sql->fetch(PDO::FETCH_ASSOC)){
				$sql2 = $db->query("SELECT * FROM users WHERE Id = '{$a['uyeId']}'");
				$b = $sql2->fetch(PDO::FETCH_ASSOC);
				$base = str_replace("http://","",$base_url);
				$base =substr_replace($base, '', -1);
				$b23 = "ilanpro.net";
				echo '
				<tr>
                  <td>'.$a["magazaadi"].'</td>
                  <td>'.$b["ad_soyad"].'</td>
                  <td><a href="http://'.$a["adres"].'.'.$b23.'" target="_blank">http://'.$a["adres"].'.'.$b23.'</a></td>
                  <td><a class="btn btn-default btn-sm" href="index.php?page=mduzenle&id='.$a["Id"].'&return=msuresibitenler">Düzenle</a> <a class="btn btn-success btn-sm" href="index.php?page=msuresibitenler&id='.$a["Id"].'&i=yayin" onclick="return onay()">Yayınla</a> <a class="btn btn-danger btn-sm" href="index.php?page=msuresibitenler&id='.$a["Id"].'&i=sil" onclick="return sor()">Sil</a></td>
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
		?>
    </div>
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