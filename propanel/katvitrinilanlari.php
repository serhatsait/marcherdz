<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<section class="content-header">
<h1>Doping Yönetimi<small>Kategori Vitrin Doping İlanları</small> </h1>
<ol class="breadcrumb">
  <li><a href="index.php"><i class="fa fa-dashboard"></i> Page d'accueil</a></li>
  <li class="active">Kategori Vitrin Doping İlanları</li>
   <li class="active">Kategori Vitrin Doping İlanları</li>
</ol>
</section>
<section class="content">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Kategori Vitrin Doping İlanları</h3>
    </div>
   
    <form role="form" action="" method="post">
      <div class="box-body">
       
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th width="45">İlan No</th>
			  
              <th>Başlık</th>
			  <th>İlan Bitiş Tarihi</th>
              <th width="170"></th>
            </tr>
          </thead>
          <tbody>
            <?
				$bugun = date("Y-m-d");
                        $idler = array();
                        $doping = $db->query("SELECT * FROM doping WHERE (name = 'kategori') and (onay  = '1') and (val >= '$bugun')");
                        while ($a = $doping->fetch(PDO::FETCH_ASSOC)){
                        $idler [] = $a["ilanId"];
                        }
                        if (count($idler) > 0){
                        $idler = implode(",",$idler);
                        $sqlsor = $db->query("SELECT * FROM ilanlar WHERE Id IN($idler) and (bitis >= '$bugun') and confirm = '1' ORDER BY Id DESC LIMIT 24");
                        while ($row = $sqlsor->fetch(PDO::FETCH_ASSOC)) {
                        $gor = "../i-".$row["Id"]."-".slugify($row["title"]).".html";
                       
                        
				echo '
				<tr>
                  <td>'.$row["Id"].'</td>
				  
                  <td>'.$row["title"].'</td>
				  <td>'.$row["bitis"].'</td>
                  <td><a class="btn btn-default btn-sm" href="'.$gor.'" target="_blank">Görüntüle</a>&nbsp;&nbsp;<a class="btn btn-danger btn-sm" href="katvitrinsil.php?id='.$row["Id"].'" target="_blank">Vitrinden Kaldır</a></td>
				  
				  ';
				}
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
	if (confirm("İlanı askıya almak istediğinize eminmisiniz?")){
	return true;	
	} else {
	return false	
	}
}
</script>