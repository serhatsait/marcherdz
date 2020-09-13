<?
if ($_GET['id'] != ""){
	$id = $_GET['id'];
	if ($_GET['i'] == "onay"){
	$id = $_GET["id"];
	$sql = $db->query("SELECT * FROM odemeler WHERE Id = '$id'");
	$x = $sql->fetch(PDO::FETCH_ASSOC);
	if ($x["tip"] == "Mağaza Ödemesi"){
	##
	$sql = $db->query("SELECT * FROM magazalar WHERE Id = '{$x['magazaId']}'");
	$a = $sql->fetch(PDO::FETCH_ASSOC);
	$tarih = date("Y-m-d");
	$start = date("Y-m-d", strtotime("+$a[sure] month", strtotime($tarih)));
	$sql2 = "UPDATE magazalar SET onay = '1', bitis = '$start' WHERE Id = '{$x['magazaId']}'";
	$stmt = $db->prepare($sql2);
	$stmt->execute();
	$sql = $db->prepare("DELETE FROM odemeler WHERE Id = '{$id}'");
	$sql->execute();
	$sql = $db->prepare("DELETE FROM bildirimler WHERE odemeId = '{$id}'");
	$sql->execute();
	##	
	} else {
	#######
	$sqlxx = $db->query("SELECT * FROM doping WHERE ilanId = '{$x['ilanId']}'");
	while ($f = $sqlxx->fetch(PDO::FETCH_ASSOC)){
	$tarih = date("Y-m-d");
	$gun = 7 * $f[selec];
	$start = date("Y-m-d", strtotime("+$gun days", strtotime($tarih)));
	$sql2 = "UPDATE doping SET onay = '1', val = '$start' WHERE Id = '{$f['Id']}'";
	$stmt = $db->prepare($sql2);
	$stmt->execute();	
	$sql = $db->prepare("DELETE FROM odemeler WHERE Id = '{$id}'");
	$sql->execute();
	$sql = $db->prepare("DELETE FROM bildirimler WHERE odemeId = '{$id}'");
	$sql->execute();
	}
	######	
	}
	} elseif ($_GET["i"] == "sil"){
	$id = $_GET['id'];
	$sql = $db->prepare("DELETE FROM odemeler WHERE Id = '{$id}'");
	$sql->execute();
	$sql = $db->prepare("DELETE FROM bildirimler WHERE odemeId = '{$id}'");
	$sql->execute();
	}
}
?>
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<section class="content-header">
<h1> Ödeme İşlemleri<small>Bekleyen Ödemeler</small> </h1>
<ol class="breadcrumb">
  <li><a href="index.php"><i class="fa fa-dashboard"></i> Page d'accueil</a></li>
  <li class="">Ödeme İşlemleri</li>
  <li class="active">Bekleyen Ödemeler</li>
</ol>
</section>
<section class="content">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Bekleyen Ödemeler</h3>
    </div>
   
    <form role="form" action="" method="post">
      <div class="box-body">
       
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th width="125">Üye</th>
              <th>Açıklama</th>
              <th width="100">Tutar</th>
              <th width="75"></th>
            </tr>
          </thead>
          <tbody>
            <?
				$sql = $db->query("SELECT * FROM odemeler");
				while ($a = $sql->fetch(PDO::FETCH_ASSOC)){
				$sql2 = $db->query("SELECT * FROM users WHERE Id = '{$a['uyeId']}'");
				$b = $sql2->fetch(PDO::FETCH_ASSOC);
				echo '
				<tr>
                  <td><a href="index.php?page=uye&id='.$b['Id'].'">'.$b["ad_soyad"].'</a></td>
                  <td>'.$a["aciklama"].'</td>
                  <td>'.$a["tutar"].' TL</td>
                  <td><a class="btn btn-success btn-sm" href="index.php?page=bekleyenodemeler&id='.$a["Id"].'&i=onay" onclick="return sor()">Onayla</a> <a class="btn btn-danger btn-sm" href="index.php?page=bekleyenodemeler&id='.$a["Id"].'&i=sil" onclick="return sor()">Sil</a></td>
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