<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<section class="content-header">
<h1> Site Ayarları<small>Kullanıcı Yönetimi</small> </h1>
<ol class="breadcrumb">
  <li><a href="index.php"><i class="fa fa-dashboard"></i> Page d'accueil</a></li>
  <li class="active">Kullanıcı Yönetimi</li>
</ol>
</section>
<section class="content">
<a href="index.php?page=kullaniciekle" class="btn btn-primary">Yeni Kayıt Ekle</a><br><br>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Kullanıcılar</h3>
    </div>
   
    <form role="form" action="" method="post">
      <div class="box-body">
       
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Kullanıcı Adı</th>
              <th width="110"></th>
            </tr>
          </thead>
          <tbody>
            <?
				$sql = $db->query("SELECT * FROM yetkililer");
				while ($a = $sql->fetch(PDO::FETCH_ASSOC)){
				echo '
				<tr>
                  <td>'.$a["kadi"].'</td>
                  <td><a class="btn btn-default btn-sm" href="index.php?page=kullaniciduzenle&id='.$a["Id"].'">Düzenle</a>'; if ($a["Id"] != 1){ echo '<a class="btn btn-danger btn-sm" href="kullanicisil.php?id='.$a["Id"].'" onclick="return sor()">Sil</a>'; } echo ' </td>
                </tr>
				';	
				}
				?>
          </tbody>
          <tfoot>
            <tr>
              <th>Kullanıcı Adı</th>
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
	if (confirm("Kullanıcıyı silmek istediğinize eminmisiniz?")){
	return true;	
	} else {
	return false	
	}
}
</script>