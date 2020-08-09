<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<section class="content-header">
<h1> Site Ayarları<small>Slider Yönetimi</small> </h1>
<ol class="breadcrumb">
  <li><a href="index.php"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
  <li class="active">Slider Yönetimi</li>
</ol>
</section>
<section class="content">
<a href="index.php?page=sliderekle" class="btn btn-primary">Yeni Kayıt Ekle</a><br><br>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Slider Yönetimi</h3>
    </div>
   
    <form role="form" action="" method="post">
      <div class="box-body">
       
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Resim</th>
              <th>Url</th>
              <th width="30"></th>
            </tr>
          </thead>
          <tbody>
            <?
				$sql = $db->query("SELECT * FROM slider");
				while ($a = $sql->fetch(PDO::FETCH_ASSOC)){
				echo '
				<tr>
                  <td>'.$a["adi"].'</td>
                  <td>'.$a["url"].'</td>
                  <td><a class="btn btn-danger btn-sm btn-block" href="slidersil.php?id='.$a["Id"].'" onclick="return sor()">Sil</a></td>
                </tr>
				';	
				}
				?>
          </tbody>
          <tfoot>
            <tr>
              <th>Resim</th>
              <th>Url</th>
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
	if (confirm("Slider'ı silmek istediğinize eminmisiniz?")){
	return true;	
	} else {
	return false	
	}
}
</script>