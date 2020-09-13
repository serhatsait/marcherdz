<?
$err = "";
$id = $_GET["id"];
if ($_POST['a1'] != ""){
$a1 = $_POST["a1"];
$a2 = $_POST["a2"];
$x1 = $_POST["x1"];
$sql = "UPDATE modulitems SET name = '$a2', goster = '$x1' WHERE Id = '$id'";
$stmt = $db->prepare($sql);
$stmt->execute();

if ($a1 == 2){
$sql = $db->prepare("DELETE FROM modulitemsselect WHERE itemId = '{$id}'");
$sql->execute();
foreach ($_POST["secenekler"] as $key => $value){
		
		if ($key == 0){ $kk = null; } else { $kk = $key; }
		foreach ($value as $val){	
		$sql2 = $db->prepare('INSERT INTO modulitemsselect (Id, itemId, name) VALUES (?,?,?)');
		$sql2->execute(array($kk,$id, $val));
		}
}
}
$sql = $db->query("SELECT * FROM modulitems WHERE Id = '$id'");
$a = $sql->fetch(PDO::FETCH_ASSOC);
echo '<script> window.location.href = "index.php?page=modulsecenekleri&id='.$a["modulsId"].'"; </script>';
}
$sql = $db->query("SELECT * FROM modulitems WHERE Id = '$id'");
$a = $sql->fetch(PDO::FETCH_ASSOC);
?>
<section class="content-header">
  <h1> Site Ayarları<small>Modül Yönetimi</small> </h1>
  <ol class="breadcrumb">
  <li><a href="index.php"><i class="fa fa-dashboard"></i> Page d'accueil</a></li>
  <li><a href="index.php?page=moduller"><i class="fa fa-dashboard"></i> Modül Yönetimi</a></li>
  <li><a href="index.php?page=modulsecenekleri&id=<? echo $id; ?>"><i class="fa fa-dashboard"></i> Modül Seçenekleri</a></li>
  <li class="active">Düzenle</li>
</ol>
</section>
<section class="content">
<? echo $err; ?>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Düzenle</h3>
    </div>
    <form role="form" action="" method="post">
      <div class="box-body"> 
	  <div class="form-group">
          <label for="exampleInputEmail1">Kategori Gösterimi</label>
         <select name="x1" id="x1" class="form-control" >
		 <option value="1" <? if ($a["goster"] == 1){ echo ' select'; } ?>>Göster</option>
		 <option value="0" <? if ($a["goster"] == 0){ echo ' select'; } ?>>Gösterme</option>
		 </select>
        </div>
		
		
       <div class="form-group">
          <label for="exampleInputEmail1">Seçenek Tipi</label>
         <select name="a1" id="a1" class="form-control" onchange="degist()" readonly="readonly">
		 <option value="1" <? if ($a["classx"] == 1){ echo ' selected'; } ?>>Sayı</option>
		 <option value="2" <? if ($a["classx"] == 2){ echo ' selected'; } ?>>Seçenek</option>
		 </select>
        </div>
		<div class="form-group">
			<label>Adı</label>
			<input type="text" class="form-control" id="a2" name="a2" placeholder="Adı" value="<? echo $a["name"]; ?>" required>
		</div>
		<div class="input_fields_wrap" <? if ($a["classx"] == "1"){ echo 'style="display:none"'; } ?>>
		<a href="javascript:void(0)" class="btn btn-primary add_field_button">Seçenek Ekle</a><br><br>
		<?
		$sql2 = $db->query("SELECT * FROM modulitemsselect WHERE itemId = '$id'");
		while ($b = $sql2->fetch(PDO::FETCH_ASSOC)){
		echo '<div class="form-group"><input type="text" name="secenekler['.$b["Id"].'][]" class="form-control" value="'.$b["name"].'" required /><a href="#" class="remove_field">Sil</a></div>';
		}
		?>
		</div>
      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Kaydet</button>
      </div>
    </form>
  </div>
</section>
<script>
function degist(){
	if ($("#a1").val() == 2){
		$(".input_fields_wrap").css("display","block");
	} else {
		$(".input_fields_wrap").css("display","none");
	}
}
$(document).ready(function() {
    var max_fields      = 100;
    var wrapper         = $(".input_fields_wrap");
    var add_button      = $(".add_field_button");
    
    var x = 1;
    $(add_button).click(function(e){
        e.preventDefault();
        if(x < max_fields){ 
            x++;
            $(wrapper).append('<div class="form-group"><input type="text" name="secenekler[0][]" class="form-control" required /><a href="#" class="remove_field">Sil</a></div>'); 
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>
