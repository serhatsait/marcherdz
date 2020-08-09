
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<section class="content-header">
<h1> Üye Yönetimi<small>Aktivasyon Bekleyen</small> </h1>
<ol class="breadcrumb">
  <li><a href="index.php"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
  <li>Üye Yönetimi</li>
  <li class="active">Aktivasyon Bekleyen</li>
</ol>
</section>
<section class="content">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Aktivasyon Bekleyen</h3>
    </div>
   
    <form role="form" action="" method="post">
      <div class="box-body">
      <form action="" method="post">
       <div class="row"><div class="col-sm-6"></div><div class="col-sm-6"><div id="example1_filter" class="dataTables_filter"><label>Ara:<input type="text" name="s" id="s" class="form-control input-sm" placeholder="" aria-controls="example1" required></label> <input type="submit" class="btn btn-primary" value="ara"></div></div></div></form><br>
        <table id="myTable" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Ad Soyad</th>
              <th>E-Posta</th>
              <th>GSM</th>
              <th width="100">K.Tarihi</th>
              <th width="260"></th>
            </tr>
          </thead>
          <tbody>
  			 <?
			 if ($_GET["sayfa"] == ""){ $_GET["sayfa"] = 1; }
			 	if ($_POST["s"] == ""){
			 	$sayfada = 100;
				$sayfa = $_GET["sayfa"];
				$say = $db->query("SELECT * FROM users WHERE aktivasyon = '0' ORDER BY Id DESC");
				$toplam = $say->rowCount();
				$toplam_sayfa = ceil($toplam / $sayfada);
				if($sayfa < 1) $sayfa = 1;
				
				if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa;
				$limit = ($sayfa - 1) * $sayfada;
				if ($limit < 0){ $limit = 0; }
				$sql = $db->query("SELECT * FROM users WHERE aktivasyon = '0' ORDER BY Id DESC LIMIT $limit,$sayfada");
				} else {
				$s = $_POST['s'];
				$sql = $db->query("SELECT * FROM users WHERE (ad_soyad LIKE '%$s%' or eposta LIKE '%$s%') and aktivasyon = '0' ORDER BY Id DESC");				}
				
				while ($a = $sql->fetch(PDO::FETCH_ASSOC)){
				echo '
				<tr>
                  <td>'.$a["ad_soyad"].'</td>
                  <td>'.$a["eposta"].'</td>
				  <td>'.$a["gsm"].'</td>
                  <td>'.$a["kayit_tarihi"].'</td>
                  <td>
				  <a class="btn btn-default btn-sm" href="index.php?page=uye&id='.$a["Id"].'">Görüntüle</a>
				  <a class="btn btn-default btn-sm" href="index.php?page=uyeduzenle&id='.$a["Id"].'">Düzenle</a> <a class="btn btn-success btn-sm" href="uyeonayla.php?id='.$a["Id"].'" onclick="return sor2()">Onayla</a> <a class="btn btn-danger btn-sm" href="uyesil.php?id='.$a["Id"].'" onclick="return sor()">Sil</a> </td>
                </tr>
				';	
				}
			?>
          </tbody>
         
        </table>
        <br>

        <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
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
		?></div>
      </div>
    </form>
  </div>
</section>
<script>
function sor()
{
	if (confirm("Üyeyi silmek istediğinize eminmisiniz?")){
	return true;	
	} else {
	return false	
	}
}
function sor2()
{
	if (confirm("Üyeyi onaylamak istediğinize eminmisiniz?")){
	return true;	
	} else {
	return false	
	}
}
$('#myTable').DataTable( {
    paging: false
} );
</script>