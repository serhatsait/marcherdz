<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<section class="content-header">
<h1> Site Ayarları<small>Banka Bilgileri</small> </h1>
<ol class="breadcrumb">
  <li><a href="index.php"><i class="fa fa-dashboard"></i> Page d'accueil</a></li>
  <li class="active">Banka Bilgileri</li>
</ol>
</section>
<section class="content">
<a href="index.php?page=bankaekle" class="btn btn-primary">Yeni Kayıt Ekle</a><br><br>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Banka Bilgileri</h3>
    </div>
   
    <form role="form" action="" method="post">
      <div class="box-body">
       
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Banka Adı</th>
              <th>Şube Kodu</th>
              <th>Hesap No</th>
              <th>IBAN</th>
              <th width="30"></th>
            </tr>
          </thead>
          <tbody>
            <?
				$sql = $db->query("SELECT * FROM bank");
				while ($a = $sql->fetch(PDO::FETCH_ASSOC)){
				echo '
				<tr>
                  <td>'.$a["bankaadi"].'</td>
                  <td>'.$a["sube"].'</td>
                  <td>'.$a["hesap"].'</td>
                  <td>'.$a["iban"].'</td>
                  <td><a class="btn btn-danger btn-sm btn-block" href="bankasil.php?id='.$a["Id"].'" onclick="return sor()">Sil</a></td>
                </tr>
				';	
				}
				?>
          </tbody>
          <tfoot>
            <tr>
              <th>Banka Adı</th>
              <th>Şube Kodu</th>
              <th>Hesap No</th>
              <th>IBAN</th>
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