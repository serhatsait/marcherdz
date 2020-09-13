<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<section class="content-header">
<h1> Blog Yönetimi<small>Yazılar</small> </h1>
<ol class="breadcrumb">
  <li><a href="index.php"><i class="fa fa-dashboard"></i> Page d'accueil</a></li>
  <li class="active">Yazılar</li>
</ol>
</section>
<section class="content">

<a href="index.php?page=byaziekle" class="btn btn-primary">Yeni Kayıt Ekle</a><br><br>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Yazılar</h3>
    </div>
   
    <form role="form" action="" method="post">
      <div class="box-body">
      <form action="" method="post">
       <div class="row"><div class="col-sm-6"></div><div class="col-sm-6"><div id="example1_filter" class="dataTables_filter"><label>Ara:<input type="text" name="s" id="s" class="form-control input-sm" placeholder="" aria-controls="example1" required></label> <input type="submit" class="btn btn-primary" value="ara"></div></div></div></form><br>
        <table id="myTable" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Başlık</th>
              <th width="200">Kategori</th>
              <th width="175">E.Tarihi</th>
              <th width="120"></th>
            </tr>
          </thead>
          <tbody>
  			 <?
			 	if ($_POST["s"] == ""){
			 	$sayfada = 100;
				$sayfa = $_GET["sayfa"];
				$say = $db->query("SELECT * FROM  byazilar ORDER BY Id DESC");
				$toplam = $say->rowCount();
				$toplam_sayfa = ceil($toplam / $sayfada);
				if($sayfa < 1) $sayfa = 1;
				if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa;
				$limit = ($sayfa - 1) * $sayfada;
				if ($limit == "-100"){ $limit = 0; }
				$sql = $db->query("SELECT * FROM  byazilar ORDER BY Id DESC LIMIT $limit,$sayfada");
				
				} else {
				$s = $_POST['s'];
				$sql = $db->query("SELECT * FROM  byazilar WHERE kategori_adi LIKE '%$s%' ORDER BY Id DESC");	
				}
				
				while ($a = $sql->fetch(PDO::FETCH_ASSOC)){
				$sql2 = $db->query("SELECT * FROM bkategoriler WHERE Id = '{$a['kategoriId']}'");
				$b = $sql2->fetch(PDO::FETCH_ASSOC);
				
				echo '
				<tr>
                  <td>'.$a["baslik"].'</td>
                  <td>'.$b["kategoriadi"].'</td>
                  <td>'.$a["tarih"].'</td>
                  <td><a class="btn btn-default btn-sm" href="index.php?page=byaziduzenle&id='.$a["Id"].'">Düzenle</a> <a class="btn btn-danger btn-sm" href="byazisil.php?id='.$a["Id"].'" onclick="return sor()">Sil</a></td>
                </tr>
				';	
				}
			?>
          </tbody>
          <tfoot>
            <tr>
              <th>Başlık</th>
              <th>Kategori</th>
              <th>E.Tarihi</th>

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
	if (confirm("Yazıyı silmek istediğinize eminmisiniz?")){
	return true;	
	} else {
	return false	
	}
}
$('#myTable').DataTable( {
    paging: false
} );
</script>