<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<section class="content-header">
<h1> Site Ayarları<small>S.S.S.</small> </h1>
<ol class="breadcrumb">
  <li><a href="index.php"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
  <li class="active">S.S.S.</li>
</ol>
</section>
<section class="content">
<a href="index.php?page=sssekle" class="btn btn-primary">Yeni Kayıt Ekle</a><br><br>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">S.S.S.</h3>
    </div>
   
    <form role="form" action="" method="post">
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Soru</th>
              <th width="100"></th>
            </tr>
          </thead>
          <tbody>
            <?
				$sql = $db->query("SELECT * FROM sss");
				while ($a = $sql->fetch(PDO::FETCH_ASSOC)){
				echo '
				<tr>
                  <td>'.$a["soru"].'</td>
                  <td><a class="btn btn-default btn-sm" href="index.php?page=sssduzenle&id='.$a["Id"].'">Düzenle</a> <a class="btn btn-danger btn-sm" href="ssssil.php?id='.$a["Id"].'" onclick="return sor()">Sil</a></td>
                </tr>
				';	
				}
				?>
          </tbody>
          <tfoot>
            <tr>
              <th>Soru</th>
              <th width="100"></th>
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