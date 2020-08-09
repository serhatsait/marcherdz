<?
$err = "";
$id = $_GET["id"];
$sql = $db->query("SELECT * FROM groups WHERE Id = '$id'");
$a = $sql->fetch(PDO::FETCH_ASSOC);
$ll = $a["modulId"];
if ($_POST['secenekler'] != ""){

$sql = $db->prepare("DELETE FROM prop WHERE groupId = '{$id}'");
$sql->execute();


foreach ($_POST["secenekler"] as $key => $value){
		if ($key == 0){ $kk = null; } else { $kk = $key; }
		foreach ($value as $val){	
		$sql2 = $db->prepare('INSERT INTO prop (Id, modulId, name, groupId) VALUES (?,?,?,?)');
		$sql2->execute(array($kk, $ll, $val, $id));
		
		}
}

// echo '<script> window.location.href = "index.php?page=modulozellikleri&id='.$ll.'"; </script>';
}
?>
<section class="content-header">
  <h1> Site Ayarları<small>Modül Yönetimi</small> </h1>
  <ol class="breadcrumb">
  <li><a href="index.php"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
  <li><a href="index.php?page=moduller"><i class="fa fa-dashboard"></i> Modül Yönetimi</a></li>
  <li><a href="index.php?page=modulozellikleri&id=<? echo $ll; ?>"><i class="fa fa-dashboard"></i> Gruplar</a></li>
  <li class="active">Grup Özellikleri</li>
</ol>
</section>
<section class="content">
<? echo $err; ?>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Grup Özellikleri</h3>
    </div>
    <form role="form" action="" method="post">
      <div class="box-body"> 
    
		<div class="input_fields_wrap">
		<a href="javascript:void(0)" class="btn btn-primary add_field_button">Seçenek Ekle</a><br><br>
		<?
		$sql2 = $db->query("SELECT * FROM prop WHERE groupId = '$id'");
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
