<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<section class="content-header">
<h1> Site Ayarları<small>Modül Yönetimi</small> </h1>
<ol class="breadcrumb">
  <li><a href="index.php"><i class="fa fa-dashboard"></i> Page d'accueil</a></li>
  <li class="active">Modül Yönetimi</li>
</ol>
</section>
<section class="content">
<a href="index.php?page=modulekle" class="btn btn-primary">Yeni Kayıt Ekle</a><br><br>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Modül Yönetimi</h3>
    </div>
   
    <form role="form" action="" method="post">
      <div class="box-body">
       
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Modul Adı</th>
              <th width="170"></th>
            </tr>
          </thead>
          <tbody>
            <?
				$sql = $db->query("SELECT * FROM moduls");
				while ($a = $sql->fetch(PDO::FETCH_ASSOC)){
				echo '
				<tr>
                  <td>'.$a["name"].'</td>
				<td>
				<a class="btn btn-default btn-sm" href="index.php?page=modulsecenekleri&id='.$a["Id"].'">Seçenekler</a> 
				<a class="btn btn-default btn-sm" href="index.php?page=modulozellikleri&id='.$a["Id"].'">Özellikler</a> 
				<a class="btn btn-danger btn-sm" href="modulsil.php?id='.$a["Id"].'" onclick="return sor()">Sil</a></td>
                </tr>
				';	
				}
				?>
          </tbody>
          <tfoot>
            <tr>
              <th>Modül Adı</th>
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
	if (confirm("Modülü silmek istediğinize eminmisiniz?")){
	return true;	
	} else {
	return false	
	}
}
</script>