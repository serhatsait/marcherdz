<?
if ($_GET['id'] != ""){
	$id = $_GET['id'];
	if ($_GET['i'] == "onay"){
	$id = $_GET["id"];
	$tarih = date("Y-m-d");
	$sql = $db->query("SELECT * FROM gonderilecek WHERE Id = '$id'");
	$a = $sql->fetch(PDO::FETCH_ASSOC);
	$e = explode(" ",$a["aciklama"]);
	$idd = $e[0];
	$sql2 = "UPDATE siparisler SET durum = '3' WHERE Id = '{$idd}'";
	$stmt = $db->prepare($sql2);
	$stmt->execute();
	
	$sql2 = "UPDATE gonderilecek SET durum = '1', gonderim_tarihi = '$tarih' WHERE Id = '{$id}'";
	$stmt = $db->prepare($sql2);
	$stmt->execute();
	} else {
	$sql = $db->prepare("DELETE FROM gonderilecek WHERE Id = '{$id}'");
	$sql->execute();
	}
}
?>
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<section class="content-header">
<h1> Ödeme İşlemleri<small>Gönderilecek Ödemeler</small> </h1>
<ol class="breadcrumb">
  <li><a href="index.php"><i class="fa fa-dashboard"></i> Page d'accueil</a></li>
  <li class="">Ödeme İşlemleri</li>
  <li class="active">Gönderilecek Ödemeler</li>
</ol>
</section>
<section class="content">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Gönderilecek Ödemeler</h3>
    </div>
   
    <form role="form" action="" method="post">
      <div class="box-body">
       
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th width="125">Üye</th>
              <th>Açıklama</th>
              <th width="100">Tutar</th>
              <th width="125">Durum</th>
              <th width="75"></th>
            </tr>
          </thead>
          <tbody>
            <?
				$sql = $db->query("SELECT * FROM gonderilecek");
				while ($a = $sql->fetch(PDO::FETCH_ASSOC)){
				$sql2 = $db->query("SELECT * FROM users WHERE Id = '{$a['uyeId']}'");
				$b = $sql2->fetch(PDO::FETCH_ASSOC);
				if ($a["durum"] == "0"){ $durum = "<span style=\"color:red\">Beklemede</span>"; } else { $durum = "Gönderildi - $a[gonderim_tarihi]"; }
				echo '
				<tr>
                  <td><a href="index.php?page=uye&id='.$b['Id'].'">'.$b["ad_soyad"].'</a></td>
                  <td>'.$a["aciklama"].'</td>
                  <td>'.$a["tutar"].' TL</td>
				  <td>'.$durum.'</td>
                  <td><a class="btn btn-success btn-sm" href="index.php?page=godemeler&id='.$a["Id"].'&i=onay" onclick="return sor()">Onayla</a> <a class="btn btn-danger btn-sm" href="index.php?page=godemeler&id='.$a["Id"].'&i=sil" onclick="return sor()">Sil</a></td>
                </tr>
				';	
				}
				?>
          </tbody>
          <tfoot>
            <tr>
               <th width="125">Üye</th>
              <th>Açıklama</th>
              <th width="100">Tutar</th>
              <th width="125">Durum</th>
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
	if (confirm("Ödemeyi silmek istediğinize eminmisiniz?")){
	return true;	
	} else {
	return false	
	}
}
function sor()
{
	if (confirm("Ödemeyi onaylamak istediğinize eminmisiniz?")){
	return true;	
	} else {
	return false	
	}
}
</script>