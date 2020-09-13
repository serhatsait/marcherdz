<?
if ($_GET['i'] == "iptal"){
$idd = $_GET["İdd"];	
$sql = $db->query("SELECT * FROM siparisler WHERE Id = '$idd'");
$a = $sql->fetch(PDO::FETCH_ASSOC);

$sql = $db->prepare('INSERT INTO gonderilecek (Id, uyeId, aciklama, durum, gonderim_tarihi,tutar) VALUES (?,?,?,?,?,?)');
$sql->execute(array(null, $a["alici"], "Sipariş iptal bedeli", 0, "0000-00-00", $a["fiyat"]));

$sql = $db->prepare("DELETE FROM siparisler WHERE Id = '{$id}'");
$sql->execute();	

}
$id = $_GET["id"];
$sql = $db->query("SELECT * FROM users WHERE Id = '$id'");
$a = $sql->fetch(PDO::FETCH_ASSOC);

$sql2 = $db->query("SELECT * FROM city WHERE Id = '{$a['il']}'");
$b = $sql2->fetch(PDO::FETCH_ASSOC);

$sql3 = $db->query("SELECT * FROM county WHERE Id = '{$a['ilce']}'");
$c = $sql3->fetch(PDO::FETCH_ASSOC);
?>
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<section class="content-header">

<h1> Üye Yönetimi<small>Üye Bilgileri</small> </h1>
<ol class="breadcrumb">
  <li><a href="index.php"><i class="fa fa-dashboard"></i> Page d'accueil</a></li>
  <li>Üye Yönetimi</li>
  <li class="active">Üye Bilgileri</li>
</ol>
</section>
<section class="content">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Üye Bilgileri</h3>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-md-3">
          <div class="form-group">
            <label>Ad Soyad</label>
            <? echo $a["ad_soyad"]; ?> </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label>Doğum Tarihi</label>
            <? echo $a["dogum_tarihi"]; ?> </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label>Cinsiyet</label>
            <? echo $a["cinsiyet"]; ?> </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label>E-Posta</label>
            <? echo $a["eposta"]; ?> </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label>Telefon</label>
            <? echo $a["telefon"]; ?> </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label>GSM</label>
            <? echo $a["gsm"]; ?> </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label>İl</label>
            <? echo $b["il_adi"]; ?> </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label>İlçe</label>
            <? echo $c["county_adi"]; ?> </div>
        </div>
      </div>
    </div>
  </div>
  
   <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Üyeye Ait İlanlar</h3>
    </div>
    <div class="box-body">
     <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th width="75">İlan No</th>
              <th>Başlık</th>
              <th width="180"></th>
            </tr>
          </thead>
          <tbody>
            <?
				$bugun = date("Y-m-d");
				$sql = $db->query("SELECT * FROM ilanlar WHERE uyeId = '$id'");
				while ($a = $sql->fetch(PDO::FETCH_ASSOC)){
				$gor = "../i-".$a["Id"]."-".slugify($a["title"]).".html";
				echo '
				<tr>
                  <td>'.$a["Id"].'</td>
                  <td>'.$a["title"].'</td>
                  <td>
				  <a class="btn btn-default btn-sm" href="'.$gor.'" target="_blank">Görüntüle</a>
				  <a class="btn btn-default btn-sm " href="index.php?page=duzenle&id='.$a["Id"].'&return=uye&u='.$id.'">Düzenle</a>
				  <a class="btn btn-default btn-sm " href="index.php?page=vitrin&id='.$a["Id"].'&return=uye&u='.$id.'">Vitrin</a>
				  </td>
                </tr>
				';	
				}
				?>
          </tbody>
          <tfoot>
            <tr>
              <th>İlan No</th>
              <th>Başlık</th>
              <th></th>
            </tr>
          </tfoot>
        </table>
    </div></div>
    
    
    <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Üyeye Ait GET İşlemleri</h3>
    </div>
    <div class="box-body">
     <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th width="125">Alıcı</th>
              <th width="125">Satıcı</th>
              <th>İlan</th>
              <th width="100">Tarih</th>
              <th width="145"></th>
            </tr>
          </thead>
          <tbody>
            <?
				$bugun = date("Y-m-d");
				$sql5 = $db->query("SELECT * FROM siparisler WHERE alici = '$id' or satici = '$id'");
				while ($c = $sql5->fetch(PDO::FETCH_ASSOC)){
				$gor = "../i-".$a["Id"]."-".slugify($a["title"]).".html";
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
				  <a class="btn btn-default btn-sm" href="index.php?page=siparis&id='.$c["Id"].'" target="_blank">Görüntüle</a> 
				  <a class="btn btn-danger btn-sm" href="index.php?page=uye&id='.$id.'&i=iptal&idd='.$c["Id"].'" onclick="return sor()">İptal</a></td>
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
    </div></div>
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