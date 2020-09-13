<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<section class="content-header">
<h1> Blog Yönetimi<small>Kategoriler</small> </h1>
<ol class="breadcrumb">
  <li><a href="index.php"><i class="fa fa-dashboard"></i> Page d'accueil</a></li>
  <li class="active">Kategoriler</li>
</ol>
</section>
<section class="content">
<a href="index.php?page=bkategoriekle" class="btn btn-primary">Yeni Kayıt Ekle</a><br><br>

  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Kategoriler</h3>
    </div>
   
    <form role="form" action="" method="post">
      <div class="box-body">
      <form role="form" action="" method="post">
      <div class="box-body">
       
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Kategori Adı</th>
              <th width="90"></th>
            </tr>
          </thead>
          <tbody>
            <?
				$sql = $db->query("SELECT * FROM bkategoriler");
				while ($a = $sql->fetch(PDO::FETCH_ASSOC)){
				echo '
				<tr>
                  <td>'.$a["kategoriadi"].'</td>
                  <td>
				  <a class="btn btn-default btn-sm" href="index.php?page=bkategoriduzenle&id='.$a["Id"].'">Düzenle</a>
				  <a class="btn btn-danger btn-sm" href="bkategorisil.php?id='.$a["Id"].'" onclick="return sor()">Sil</a></td>
                </tr>
				';	
				}
				?>
          </tbody>
          <tfoot>
            <tr>
              <th>Kategori Adı</th>
              <th></th>
            </tr>
          </tfoot>
        </table>
      </div>
    </form>
  </div>
</section>
<script>
function sor()
{
	if (confirm("Kategoriyi silmek istediğinize eminmisiniz?")){
	return true;	
	} else {
	return false	
	}
}
$('#myTable').DataTable( {
    paging: false
} );
</script>