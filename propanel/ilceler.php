<?

$id = $_GET["id"];


?>
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<section class="content-header">
<h1> Bölge Yönetimi<small>Bölge Yönetimi</small> </h1>
<ol class="breadcrumb">
  <li><a href="index.php"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
  <li class="active">Bölge Yönetimi</li>
</ol>
</section>
<section class="content">
<a href="index.php?page=ilceekle&id=<?echo $id;?>" class="btn btn-primary">Bu Bölüme İlçe Ekle</a><br><br>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">İLÇELER</h3>
    </div>
   
    <form role="form" action="" method="post">
      <div class="box-body">
      <form role="form" action="" method="post">
      <div class="box-body">
       
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th width="30">Plaka</th>
			  <th>İlçe Adı</th>
              <th width="200"></th>
            </tr>
          </thead>
          <tbody>
            <?
				$sql = $db->query("SELECT * FROM county WHERE il_id = '$id'");
				while ($a = $sql->fetch(PDO::FETCH_ASSOC)){
				echo '
				<tr>
				  <td>'.$a["il_id"].'</td>
                  <td>'.$a["county_adi"].'</td>
                  <td>
				  <a class="btn btn-default btn-sm" href="index.php?page=mahalleler&id='.$a["id"].'">Mahalleleri Göster</a>
				  <a class="btn btn-default btn-sm" href="index.php?page=ilceduzenle&id='.$a["id"].'">Düzenle</a>
				  <a class="btn btn-danger btn-sm" href="ilcesil.php?id='.$a["id"].'" onclick="return sor()">Sil</a></td>
                </tr>
				';	
				}
				?>
          </tbody>
          <tfoot>
            
          </tfoot>
        </table>
      </div>
    </form>
  </div>
</section>
<script>
function sor()
{
	if (confirm("Bölge Silmek İstediğinize Eminmisiniz?")){
	return true;	
	} else {
	return false	
	}
}
$('#myTable').DataTable( {
    paging: false
} );
</script>