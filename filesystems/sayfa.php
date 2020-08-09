<?
function sayac($id)
{
global $db;
$bugun = date("Y-m-d");
$sql   = $db->query("SELECT Id FROM ilanlar WHERE (category1 = '$id' or category2 = '$id' or category3 = '$id' or category4 = '$id' or category5 = '$id' or category6 = '$id' or category7 = '$id' or category8 = '$id' or category9 = '$id' or category10 = '$id') and (bitis >= '$bugun') and (confirm = '1')");
return $sql->rowCount();
}
$id = $_GET["id"];
$sql = $db->query("SELECT * FROM sayfalar WHERE slug = '$id'");
$az = $sql->fetch(PDO::FETCH_ASSOC);
?>

<div class="container top15">
   

       
            <div class="panel panel-default">
                <div class="panel-heading"><? echo $az["sayfaadi"]; ?></div>
                <div class="panel-body">
				<? echo html_entity_decode($az["icerik"]); ?>
                </div></div>
        </div>
   
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Detaylı Arama</h4>
      </div>
      <div class="modal-body">

	
		

	<form action="index.php" method="get">
	<input type="hidden" name="page" value="category">
	<input type="hidden" name="sayfa" value="1">
	<input type="hidden" name="daralt" value="1">
      <div class="row no-pad">
	  <div class="col-xs-6" style="width: 50%;">
	  <div class="form-group">
		<label>Kategori</label>
		<select class="form-control" name="id">
		<?
			$sql = $db->query("SELECT * FROM category WHERE ustkategoriId = '0'");
			while ($a = $sql->fetch(PDO::FETCH_ASSOC)) {
			echo '<option value="'.$a["Id"].'">' . $a["kategori_adi"] . '</option>';
			}
		?>
		</select>
	  </div>
	  </div>
	  <div class="col-xs-6" style="width: 50%;">
	 <div class="form-group">
                            <label>İl :</label>
                            <select name="il" id="il" class="form-control il" onchange="districts()" data-role="none" >
                                <option value="">Tümü</option>
                                <?php
                                $sql2 = $db->query("SELECT * FROM city ORDER BY il_adi ASC");
                                while ($i = $sql2->fetch(PDO::FETCH_OBJ)) {
                                    echo '<option value="' . $i->id . '"';
                                    if ($_GET['il'] == $i->id) {
                                        echo ' selected="select"';
                                    }
                                    echo '>' . $i->il_adi . '</option>';
                                }
                                ?>
                            </select>
                        </div>
	  </div>
	  <div class="col-xs-6" style="width: 50%;">
	  <div class="form-group">
                            <label>İlçe :</label>
                           <select name="ilce" id="ilce" class="form-control ilce" onchange="localitys()" data-role="none">
                                <option value="">Tümü</option>
                                <?php
                                $il = $_GET['il'];
                                $sql2 = $db->query("SELECT * FROM county WHERE il_id = '$il' ORDER BY county_adi ASC");
                                while ($ix = $sql2->fetch(PDO::FETCH_OBJ)) {
                                    echo '<option value="' . $ix->id . '"';
                                    if ($_GET['ilce'] == $ix->id) {
                                        echo ' selected="select"';
                                    }
                                    echo '>' . $ix->county_adi . '</option>';
                                }
                                ?>
                            </select>
                        </div>
	  </div>

	  <div class="col-xs-6" style="width: 50%;">
	  <label class="">Fiyat</label>
	   <div class="row no-gutter">
                                <div class="col-xs-6" style="width: 50%;">
                                    <div class="form-group">
                                        <input type="text" name="fiyat1" value="<? echo $_GET["fiyat1"]; ?>" class="form-control money" placeholder="minimum">
                                </div>
                            </div>
                            <div class="col-xs-6" style="width: 50%;">
                                <div class="form-group">
                                    <input type="text" name="fiyat2" class="form-control money" placeholder="maksimum" value="<? echo $_GET["fiyat2"]; ?>">
                            </div>
                        </div>
                    </div>
	  </div>
	  <div class="col-xs-1"><input type="submit" style="width:565px;margin-bottom:7px;" class="btn btn-danger" value="Aramaya Başla"></div>
	  </div>
	</div>
	</form>
  </div>
        </div>
    </div>
