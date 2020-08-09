<?
if ($_GET["id"] != ""){
	if ($_GET["i"] == "onay"){
	$id = $_GET["id"];
	$sql = $db->query("SELECT * FROM ilanlar WHERE Id = '$id'");
	$a = $sql->fetch(PDO::FETCH_ASSOC);
	$tarih = date("Y-m-d");
	$start = date("Y-m-d", strtotime("+$a[yayin] DAYS", strtotime($tarih)));
	$sql = "UPDATE ilanlar SET confirm = '1', bitis = '$start' WHERE Id = '$id'";
	$stmt = $db->prepare($sql);	
	$stmt->execute();
	} elseif ($_GET["i"] == "sil"){
	$id = $_GET["id"];
	$sql = $db->prepare("DELETE FROM ilanlar WHERE Id = '{$id}'");
	$sql->execute();
	$sql = $db->prepare("DELETE FROM modul_ilan WHERE ilanId = '{$id}'");
	$sql->execute();
	$sql = $db->prepare("DELETE FROM prop_ilan WHERE ilanId = '{$id}'");
	$sql->execute();
	$sql = $db->prepare("DELETE FROM images WHERE ilanId = '{$id}'");
	$sql->execute();
	}
}
?>
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<section class="content-header">
<h1> İlan Yönetimi<small>Süresi Bitenler</small> </h1>
<ol class="breadcrumb">
  <li><a href="index.php"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
  <li class="active">İlan Yönetimi</li>
   <li class="active">Süresi Bitenler</li>
</ol>
</section>
<section class="content">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Süresi Bitenler</h3>
    </div>
   
    <form role="form" action="" method="post">
      <div class="box-body">
       
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th width="75">İlan No</th>
              <th>Başlık</th>
              <th width="310"></th>
            </tr>
          </thead>
          <tbody>
            <?
				$bugun = date("Y-m-d");
				$sql = $db->query("SELECT * FROM ilanlar WHERE confirm = '1' and (bitis < '$bugun')");
				while ($a = $sql->fetch(PDO::FETCH_ASSOC)){
				$gor = "../i-".$a["Id"]."-".slugify($a["title"]).".html";
				
				if ($a["firmadi"] != ""){
					$tip = "Firma";	
					$a["title"] = $a["firmadi"];
					$gor = "../firma-".$a["Id"]."-".slugify($a["title"]).".html";
					$gor2 = 'index.php?page=duzenle2&id='.$a["Id"].'&return=onaybekleyen';
				}
				
				
				echo '
				<tr>
                  <td>'.$a["Id"].'</td>
                  <td>'.$a["title"].'</td>
                  <td>
				  <a class="btn btn-default btn-sm" href="'.$gor.'" target="_blank">Görüntüle</a>';
				  if ($a["firmadi"] == ""){
				  echo '
				  <a class="btn btn-default btn-sm " href="index.php?page=duzenle&id='.$a["Id"].'&return=suresibitenler">Düzenle</a>
				  <a class="btn btn-default btn-sm " href="index.php?page=vitrin&id='.$a["Id"].'&return=suresibitenler">Vitrin</a>';
				  }
				  if ($a["type"] != 2){
				  echo '
				  <a class="btn btn-success btn-sm" href="index.php?page=suresibitenler&id='.$a["Id"].'&i=onay" onclick="return onayla()">Tekrar Yayınla</a>';
				  }
				  echo '
				  <a class="btn btn-danger btn-sm" href="index.php?page=suresibitenler&id='.$a["Id"].'&i=sil" onclick="return sor()">Sil</a></td>
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
      </div>
    </form>
  </div>
</section>
<script>
function sor()
{
	if (confirm("İlanı silmek istediğinize eminmisiniz?")){
	return true;	
	} else {
	return false	
	}
}
function onayla()
{
	if (confirm("İlanı tekrar yayınlamak istediğinize eminmisiniz?")){
	return true;	
	} else {
	return false	
	}
}
</script>