<?
if ($_GET['id'] != ""){
	$id = $_GET['id'];
	if ($_GET['i'] == "onay"){
	$sql = $db->query("SELECT * FROM magazalar WHERE Id = '$id'");
	$a = $sql->fetch(PDO::FETCH_ASSOC);
	$tarih = date("Y-m-d");
	$start = date("Y-m-d", strtotime("+$a[sure] month", strtotime($tarih)));
	
	if($a["sure"] == 3) $kota = $kota1;
	if($a["sure"] == 6) $kota = $kota2;
	if($a["sure"] == 12) $kota = $kota3;
	
	$sql2 = "UPDATE magazalar SET onay = '1', bitis = '$start', magazakota = '$kota' WHERE Id = '$id'";
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
<h1> Mağaza Yönetimi<small>Onay Bekleyen</small> </h1>
<ol class="breadcrumb">
  <li><a href="index.php"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
  <li>Mağaza Yönetimi</li>
  <li class="active">	Onay Bekleyen</li>
</ol>
</section>
<section class="content">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Onay Bekleyen</h3>
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
				$say = $db->query("SELECT * FROM magazalar WHERE onay = '0' ORDER BY Id DESC");
				$toplam = $say->rowCount();
				$toplam_sayfa = ceil($toplam / $sayfada);
				if($sayfa < 1) $sayfa = 1;
				if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa;
				$limit = ($sayfa - 1) * $sayfada;
				if ($limit < 0){ $limit = 100; }
				$sql = $db->query("SELECT * FROM magazalar WHERE onay = '0' ORDER BY Id DESC LIMIT $limit,$sayfada");
				if ($toplam == 0){
				echo '<tr class="odd"><td valign="top" colspan="4" class="dataTables_empty">Onay bekleyen mağaza bulunmamaktadır</td></tr>';
				}
			    while ($a = $sql->fetch(PDO::FETCH_ASSOC)){
				$sql2 = $db->query("SELECT * FROM users WHERE Id = '{$a['uyeId']}'");
				$b = $sql2->fetch(PDO::FETCH_ASSOC);
				$b33 = "ilanpro.net";
				$base = str_replace("http://","",$base_url);
				$base =substr_replace($base, '', -1);
				echo '
				<tr>
                  <td>'.$a["magazaadi"].'</td>
                  <td>'.$b["ad_soyad"].'</td>
                  <td><a href="http://'.$a["adres"].'.'.$base.'" target="_blank">http://'.$a["adres"].'.'.$base.'</a></td>
                  <td><a class="btn btn-default btn-sm" href="index.php?page=mduzenle&id='.$a["Id"].'&return=monaybekleyen">Düzenle</a> <a class="btn btn-success btn-sm" href="index.php?page=monaybekleyen&id='.$a["Id"].'&i=onay" onclick="return onay()">Onayla</a> <a class="btn btn-danger btn-sm" href="index.php?page=monaybekleyen&id='.$a["Id"].'&i=sil" onclick="return sor()">Sil</a></td>
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
	if (confirm("Mağazayı onaylamak istediğinize eminmisiniz? \n Mağaza Süresi yeniden başlatılacaktır")){
	return true;	
	} else {
	return false	
	}
}
$('#myTable').DataTable( {
    paging: false
} );
</script>