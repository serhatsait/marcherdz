<?
if ($_GET['id'] != ""){
$id = $_GET["id"];
$sql = $db->query("SELECT * FROM siparisler WHERE Id = '$id'");
$a = $sql->fetch(PDO::FETCH_ASSOC);

$sql = $db->prepare('INSERT INTO gonderilecek (Id, uyeId, aciklama, durum, gonderim_tarihi,tutar) VALUES (?,?,?,?,?,?)');
$sql->execute(array(null, $a["alici"], "Sipariş iptal bedeli", 0, "0000-00-00", $a["fiyat"]));

$sql = $db->prepare("DELETE FROM siparisler WHERE Id = '{$id}'");
$sql->execute();	

}
?>
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<section class="content-header">
<h1> GET İşlemleri<small>Kargo Bekleyen</small> </h1>
<ol class="breadcrumb">
  <li><a href="index.php"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
  <li class="">GET İşlemleri</li>
  <li class="active">Kargo Bekleyen</li>
</ol>
</section>
<section class="content">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Kargo Bekleyen</h3>
    </div>
   
    <form role="form" action="" method="post">
      <div class="box-body">
       
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th width="125">Alıcı</th>
              <th width="125">Satıcı</th>
              <th>İlan</th>
              <th width="75">Tarih</th>
              <th width="100"></th>
            </tr>
          </thead>
          <tbody>
            <?
				$sql3 = $db->query("SELECT * FROM siparisler WHERE durum = '0'");
				while ($c = $sql3->fetch(PDO::FETCH_ASSOC)){
				$sql = $db->query("SELECT * FROM users WHERE Id = '{$c['alici']}'");
				$a = $sql->fetch(PDO::FETCH_ASSOC);
				$sql2 = $db->query("SELECT * FROM users WHERE Id = '{$c['satici']}'");
				$b = $sql2->fetch(PDO::FETCH_ASSOC);
				$sql4 = $db->query("SELECT * FROM satilanlar WHERE ilanId = '{$c['ilanId']}' and uyeId = '{$c['satici']}'");
				$d = $sql4->fetch(PDO::FETCH_ASSOC);
				$e = explode("-",$c["tarih"]);
				echo '
				<tr>
                  <td><a href="index.php?page=uye&id='.$b['Id'].'">'.$a["ad_soyad"].'</a></td>
				  <td><a href="index.php?page=uye&id='.$b['Id'].'">'.$b["ad_soyad"].'</a></td>
                  <td>'.$d["title"].'</td>
				  <td>'.$e[2].'-'.$e[1].'-'.$e[0].'</td>
                  <td>
				  <a class="btn btn-default btn-sm" href="index.php?page=siparis&id='.$c["Id"].'">Görüntüle</a> 
				  <a class="btn btn-danger btn-sm" href="index.php?page=gkargo&id='.$c["Id"].'&i=iptal" onclick="return sor()">İptal</a></td>
                </tr>
				';	
				}
				?>
          </tbody>
          <tfoot>
            <tr>
            <th width="125">Alıcı</th>
              <th width="125">Satıcı</th>
              <th>İlan</th>
              <th width="75">Tarih</th>
              <th width="75"></th>
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
	if (confirm("Siparişi iptal etmek istediğinize eminmisiniz?")){
	return true;	
	} else {
	return false	
	}
}
</script>