<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<section class="content-header">
<h1> Site Ayarları<small>Banner Yönetimi</small> </h1>
<ol class="breadcrumb">
  <li><a href="index.php"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
  <li class="active">Banner Yönetimi</li>
</ol>
</section>
<section class="content">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Banner Yönetimi</h3>
    </div>
   
    <form role="form" action="" method="post">
      <div class="box-body">
       
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
			<th width="250">Önizleme</th>
              <th>Adı</th>
              <th>Tip</th>
              <th width="30"></th>
            </tr>
          </thead>
          <tbody>
            <?
				$sql = $db->query("SELECT * FROM banner");
				while ($a = $sql->fetch(PDO::FETCH_ASSOC)){
				if ($a["tip"] == 0){
				$tip = "Resim";	
				} else {
				$tip = "Kod";	
				}
				echo '
				<tr>
				  <td><img src="../../uploads/'.$a["kod"].'" width="250" height="50"></td>
                  <td>'.$a["banneradi"].'</td>
                  <td>'.$tip.'</td>
                  <td><a class="btn btn-default btn-sm btn-block" href="index.php?page=ba&id='.$a["Id"].'">Düzenle</a></td>
                </tr>
				';	
				}
				?>
          </tbody>
          <tfoot>
            <tr>
             <th>Adı</th>
              <th>Tip</th>
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