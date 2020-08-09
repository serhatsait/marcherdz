<? $id = $_GET["id"]; ?>
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<section class="content-header">
<h1> Site Ayarları<small>Modül Yönetimi</small> </h1>
<ol class="breadcrumb">
  <li><a href="index.php"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
  <li><a href="index.php?page=moduller"><i class="fa fa-dashboard"></i> Modül Yönetimi</a></li>
  <li class="active">Modül Seçenekleri</li>
</ol>
</section>
<section class="content">
<a href="index.php?page=modulsecenekekle&id=<? echo $id; ?>" class="btn btn-primary">Yeni Kayıt Ekle</a><br><br>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Modül Seçenekleri</h3>
    </div>
   
    <form role="form" action="" method="post">
      <div class="box-body">
       
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
			  <th width="100">Seçenek Tipi</th>
              <th>Seçenek Adı</th>
			  <th>Kategori Gösterimi</th>
              <th width="85"></th>
            </tr>
          </thead>
          <tbody>
            <?
				
				$sql = $db->query("SELECT * FROM modulitems WHERE modulsId = '$id'");
				while ($a = $sql->fetch(PDO::FETCH_ASSOC)){
				if ($a["classx"] == "1"){
					$tipi = "Sayı";
				} elseif ($a["classx"] == 2){
					$tipi = "Seçenek";
				}
				if ($a["goster"] == 0){
				$g = "Gösterme";	
				} else {
				$g = "Göster";
				}
				echo '
				<tr>
				<td>'.$tipi.'</td>
				<td>'.$a["name"].'</td>
				<td>'.$g.'</td>
				<td>
				<a class="btn btn-default btn-sm" href="index.php?page=modulsecenekduzenle&id='.$a["Id"].'">Düzenle</a> 
				<a class="btn btn-danger btn-sm" href="modulseceneksil.php?id='.$a["Id"].'" onclick="return sor()">Sil</a></td>
                </tr>
				';	
				}
				?>
          </tbody>
          <tfoot>
            <tr>
			  <th>Seçenek Tipi</th>
              <th>Seçenek Adı</th>
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
	if (confirm("Modül seçeneğini silmek istediğinize eminmisiniz?")){
	return true;	
	} else {
	return false	
	}
}
</script>