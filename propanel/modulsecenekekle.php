<?
$err = "";
$id = $_GET["id"];
if ($_POST['a1'] != ""){
$a1 = $_POST["a1"];
$a2 = $_POST["a2"];
$x1 = $_POST["x1"];
if ($a1 == 1){
	$sql = $db->prepare('INSERT INTO modulitems (Id, name, classx, modulsId, s, goster) VALUES (?,?,?,?,?,?)');
	$sql->execute(array(null,$a2,$a1, $id, null, $x1));
} else {
	$sql = $db->prepare('INSERT INTO modulitems (Id, name, classx, modulsId, s, goster) VALUES (?,?,?,?,?,?)');
	$sql->execute(array(null,$a2,$a1, $id, null, $x1));
	$eklenen = $db->lastInsertId();
	foreach ($_POST["secenekler"] as $s){
	$sql2 = $db->prepare('INSERT INTO modulitemsselect (Id, itemId, name) VALUES (?,?,?)');
	$sql2->execute(array(null,$eklenen, $s));	
	}
}
echo '<script> window.location.href = "index.php?page=modulsecenekleri&id='.$id.'"; </script>';
}
?>
<section class="content-header">
  <h1> Site Ayarları<small>Modül Yönetimi</small> </h1>
  <ol class="breadcrumb">
  <li><a href="index.php"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
  <li><a href="index.php?page=moduller"><i class="fa fa-dashboard"></i> Modül Yönetimi</a></li>
  <li><a href="index.php?page=modulsecenekleri&id=<? echo $id; ?>"><i class="fa fa-dashboard"></i> Modül Seçenekleri</a></li>
  <li class="active">Yeni Kayıt Ekle</li>
</ol>
</section>
<section class="content">
<? echo $err; ?>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Yeni Kayıt Ekle</h3>
    </div>
    <form role="form" action="" method="post">
      <div class="box-body"> 
	   <div class="form-group">
          <label for="exampleInputEmail1">Kategori Gösterimi</label>
         <select name="x1" id="x1" class="form-control" >
		 <option value="1">Göster</option>
		 <option value="0">Gösterme</option>
		 </select>
        </div>
		
       <div class="form-group">
          <label for="exampleInputEmail1">Seçenek Tipi</label>
         <select name="a1" id="a1" class="form-control" onchange="degist()">
		 <option value="1">Sayı</option>
		 <option value="2">Seçenek</option>
		 </select>
        </div>
		<div class="form-group">
			<label>Adı</label>
			<input type="text" class="form-control" id="a2" name="a2" placeholder="Adı" value="" required>
		</div>
		<div class="input_fields_wrap" style="display:none">
		<a href="javascript:void(0)" class="btn btn-primary add_field_button">Seçenek Ekle</a><br><br>
		
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
            $(wrapper).append('<div class="form-group"><input type="text" name="secenekler[]" class="form-control" required /><a href="#" class="remove_field">Sil</a></div>'); 
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>
