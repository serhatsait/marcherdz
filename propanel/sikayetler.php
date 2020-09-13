<?
if ($_GET["id"] != ""){
	if ($_GET["i"] == "sil"){
	$id = $_GET["id"];
	$sql = $db->prepare("DELETE FROM sikayet WHERE Id = '{$id}'");
	$sql->execute();
	}
}
?>
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<section class="content-header">
<h1> İlan Yönetimi<small>Şikayetler</small> </h1>
<ol class="breadcrumb">
  <li><a href="index.php"><i class="fa fa-dashboard"></i> Page d'accueil</a></li>
  <li>İlan Yönetimi</li>
   <li class="active">Şikayetler</li>
</ol>
</section>
<section class="content">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Şikayetler</h3>
    </div>
   
    <form role="form" action="" method="post">
      <div class="box-body">
       
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>İlan</th>
              <th width="125">Şikayet Eden</th>
              <th width="125">İlan Sahibi</th>
              <th width="90"></th>
            </tr>
          </thead>
          <tbody>
            <?
				$bugun = date("Y-m-d");
				$sql = $db->query("SELECT * FROM sikayet");
				while ($a = $sql->fetch(PDO::FETCH_ASSOC)){
				
				$sql2 = $db->query("SELECT * FROM users WHERE Id = '{$a['uyeId']}'");
				$b = $sql2->fetch(PDO::FETCH_ASSOC);
				$sql3 = $db->query("SELECT * FROM ilanlar WHERE Id = '{$a['ilanId']}'");
				$c = $sql3->fetch(PDO::FETCH_ASSOC);
				$sql4 = $db->query("SELECT * FROM users WHERE Id = '{$c['uyeId']}'");
				$d = $sql4->fetch(PDO::FETCH_ASSOC);
				$gor = "../i-".$c["Id"]."-".slugify($c["title"]).".html";
				
				echo '
				<tr>
                  <td><a href="'.$gor.'" target="_blank">'.$c["title"].'</a></td>
                  <td><a href="index.php?page=uye&id='.$a["uyeId"].'">'.$b["ad_soyad"].'</a></td>
				  <td><a href="index.php?page=uye&id='.$d["Id"].'">'.$d["ad_soyad"].'</a></td>
                  <td>
				  <a class="btn btn-default btn-sm" href="index.php?page=sikayet&id='.$a["Id"].'">Görüntüle</a>
				  <a class="btn btn-danger btn-sm" href="index.php?page=sikayetler&id='.$a["Id"].'&i=sil" onclick="return sor()">Sil</a></td>
                </tr>
				';	
				}
				?>
          </tbody>
          <tfoot>
            <tr>
              <th>İlan</th>
              <th width="125">Şikayet Eden</th>
              <th width="125">İlan Sahibi</th>
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
	if (confirm("Şikayeti silmek istediğinize eminmisiniz?")){
	return true;	
	} else {
	return false	
	}
}

</script>