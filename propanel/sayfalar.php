<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<section class="content-header">
<h1> Sayfa Yönetimi</h1>
<ol class="breadcrumb">
  <li><a href="index.php"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
  <li class="active">Sayfa Yönetimi</li>
</ol>
</section>
<section class="content">
<a href="index.php?page=sayfaekle" class="btn btn-primary">Yeni Kayıt Ekle</a><br><br>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Sayfa Yönetimi</h3>
    </div>
   
    <form role="form" action="" method="post">
      <div class="box-body">
       
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
			<th>Konum</th>
			<th>Link</th>
			<th>Sayfa Adı</th>
			<th width="30"></th>
            </tr>
          </thead>
          <tbody>
            <?
				$sql = $db->query("SELECT * FROM sayfalar");
				while ($a = $sql->fetch(PDO::FETCH_ASSOC)){
				if ($a["yer"] == 0){
					$yer = "Sabit Link";
				} elseif ($a["yer"] == 1){
					$yer = "Footer Kurumsal Bilgiler";
				} elseif ($a["yer"] == 2){
					$yer = "Footer Hizmetlerimiz";
				} elseif ($a["yer"] == 3){
					$yer = "Footer Gizlilik & Kullanım";	
				}
				echo '
				<tr>
				<td>'.$yer.'</td>
				<td>'.$a["slug"].'.html</td>
                  <td>'.$a["sayfaadi"].'</td>
                  <td><a class="btn btn-default btn-sm btn-block" href="index.php?page=sayfa&id='.$a["Id"].'">Düzenle</a></td>
                </tr>
				';	
				}
				?>
          </tbody>
          <tfoot>
            <tr>
              <th>Sayfa Adı</th>
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
	if (confirm("Bankayı silmek istediğinize eminmisiniz?")){
	return true;	
	} else {
	return false	
	}
}
</script>