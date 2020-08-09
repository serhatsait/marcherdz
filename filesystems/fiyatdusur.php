<?
$uye = $_SESSION['uye'];
$sql = $db->query("SELECT * FROM users WHERE Id = '$uye'");
$uyebilgileri = $sql->fetch(PDO::FETCH_ASSOC);
if ($uyebilgileri["gsm"] == ""){
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> <script> alert("Sistemde Kayıtlı Telefon Numaranız Bulunmuyor.Lütfen Banaözel / Üyeliğim Bölümünden İletişim Bilgilerinizi Güncelleyiniz");window.location.href="index.php?page=membership"; </script>';
exit;
}	


$uye = $_SESSION["uye"];
if ($_SESSION["uye"] == ""){ header("location: /login"); }
$id = $_GET["id"];

$sql = $db->query("SELECT * FROM category WHERE Id = '$id'");
$a = $sql->fetch(PDO::FETCH_OBJ);
if ($a->tip == 1){
	header("location: index.php?page=add5&id=$id");
}



$sql22 = $db->query("SELECT * FROM ilanlar WHERE uyeId = '$uye'");
$sql36 = $db->query("SELECT * FROM magazalar WHERE uyeId = '$uye'");
$aa1 = $sql36->fetch(PDO::FETCH_ASSOC);
$magazakota = $aa1["magazakota"];
if ($magazakota <= $sql22->RowCount() && $sql36->rowCount() != 0){
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> <script> alert("Mağaza İlan Kotasını Doldurdunuz. Mağaza Sınırınız : '.$magazakota.' Adettir."); window.history.go(-1); </script>';
		

}



$sql = $db->query("SELECT * FROM ilanlar WHERE uyeId = '$uye'");
if ($MagazaSinir <= $sql->RowCount()){
$sql = $db->query("SELECT * FROM magazalar WHERE uyeId = '$uye'");
$a = $sql->fetch(PDO::FETCH_ASSOC);
if ($sql->rowCount() == 0){
header("location: index.php?page=add&err=1");
}
}
if ($_GET['ilanId'] == ""){
$id = $_GET["id"];
} else {
$ilanId = $_GET['ilanId'];
$sql = $db->query("SELECT * FROM ilanlar WHERE Id = '$ilanId' and uyeId = '$uye'");
$v = $sql->fetch(PDO::FETCH_OBJ);
$id = $v->category1;
}
$sql = $db->query("SELECT * FROM category WHERE Id = '$id'");
$a = $sql->fetch(PDO::FETCH_OBJ);
$modul = $a->modul;
$sql = $db->query("SELECT * FROM modulitems WHERE modulsId = '$modul'");
$moduller = "";
while ($mm = $sql->fetch(PDO::FETCH_OBJ)){
if ($mm->classx == 1 || $mm->classx == 0) {
if ($_GET['ilanId'] == ""){
$moduller.= '<div class="col-xs-12 col-sm-3"><div class="form-group"><label class="qlabel">' . $mm->name . '</label><div class="form-group"><input type="number" name="field_' . $mm->Id . '" class="form-control" required="required"></div></div></div>';
} else {
$ilanId = $_GET['ilanId'];
$itemId = $mm->Id;
$md = $db->query("SELECT * FROM modul_ilan WHERE ilanId = '$ilanId' and itemId = '$itemId'");
$mdd = $md->fetch(PDO::FETCH_OBJ);
$moduller.= '<div class="col-xs-12 col-sm-3"><div class="form-group"><label class="qlabel">' . $mm->name . '</label><div class="form-group"><input type="number" name="field_' . $mm->Id . '" value="'.$mdd->selects.'" class="form-control" required="required"></div></div></div>';
}
} else {

$moduller.= '
<div class="col-xs-12 col-sm-3">
<div class="form-group"><label class="qlabel">' . $mm->name . '</label>
<select class="form-control se" name="field_' . $mm->Id . '" data-style="btn-primary" data-live-search="true" title="Tümü" data-selected-text-format="count" required="required">';
$sql2 = $db->query("SELECT * FROM modulitemsselect WHERE itemId = '$mm->Id' ORDER BY Id ASC");
while ($s = $sql2->fetch(PDO::FETCH_OBJ)){
if ($_GET['ilanId'] == ""){
$moduller.= '<option value="' . $s->Id . '">' . $s->name . '</option>';
} else {
$ilanId = $_GET['ilanId'];
$itemId = $mm->Id;
$md = $db->query("SELECT * FROM modul_ilan WHERE (ilanId = '$ilanId' and itemId = '$itemId')");
$mdd = $md->fetch(PDO::FETCH_ASSOC);

$moduller.= '<option value="'.$s->Id.'" '; if ($s->Id == $mdd["selects"]){ $moduller.= ' selected'; } $moduller.= '>' . $s->name . '</option>';
}
}
$moduller.= '</select></div></div>';
}
}
$ozellikler = "";
$sql = $db->query("SELECT * FROM groups WHERE modulId = '$modul'");
while ($z = $sql->fetch(PDO::FETCH_OBJ)){
$ozellikler.=  '
<div class="panel panel-default"><div class="panel-heading">'.$z->name.'</div><div class="panel-body"><div class="row">';
$g = $z->Id;
$sql2 = $db->query("SELECT * FROM prop WHERE modulId = '$modul' and groupId = '$g'");
while ($x2 = $sql2->fetch(PDO::FETCH_OBJ)){
if ($_GET['ilanId'] == ""){
$ozellikler.= '
<div class="col-xs-12 col-sm-3">
<div class="form-group">
<label style="font-weight:normal !important"><input type="checkbox" name="prop_' . $x2->Id . '" value="1"> ' . $x2->name . '	 </label></div></div>';
} else {
$ilanId = $_GET['ilanId'];
$md = $db->query("SELECT * FROM prop_ilan WHERE (ilanId = '$ilanId' and propId = '$x2->Id')");
$mdd = $md->fetch(PDO::FETCH_ASSOC);

$ozellikler.= '
<div class="col-xs-12 col-sm-3">
<div class="form-group">
<label style="font-weight:normal !important"><input type="checkbox" name="prop_' . $x2->Id . '" value="1"'; if ($mdd["val"] == 1){ $ozellikler.= ' checked'; } $ozellikler.= '> ' . $x2->name . '</label></div></div>';
}
}
$ozellikler.=  '</div></div></div>';
}
?>
<link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<form action="index.php?page=fiyatok&id=<?php
echo $id;
if ($_GET["ilanId"] != "") {
    echo '&ilanId=' . $_GET["ilanId"] . '';
}
?>" method="post">
    <div class="container top15">
        
        <br>
        <div class="panel panel-default"><div class="panel-heading">Fiyatı Düşen İlan - Uyarı !</div><br>
		<center><font size="5" color="#7a7a7a">İlanın Fiyatını Düşürdüğünüzde Fiyatı Düşenler Vitrininde Yer Alıcak ve Aynı Zamanda İlanınızı Favorilere Ekleyen Kullanıcılara Mail İle Bildirim Yapılacaktır.</font><center>
		<br>
       </div>
        <div class="panel panel-default">
            <div class="panel-heading">Satış & Fiyat & Yayın</div>
            <div class="panel-body">
                
                
                                <div class="form-group">
                                    <label>Fiyat</label>
                                    <input type="text" name="data4" id="data4" placeholder="0" class="form-control money"  required="required" value="<?php echo $v->price; ?>" onKeyUp="hesapla()" autocomplete="off">
                                </div>
                            </div>
                            
                        </div>
                </div>
					
					
					
					
					
                    
      
        
   
                    <div class="container top15">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>
                                        <input type="checkbox" required></label>
                                    <a  href="#" data-toggle="modal" data-target="#myModal">İlan verme kurallarını okudum kabul ediyorum</a>
                                </div>
                                <input type="submit" class="btn btn-primary" value="Kaydet ve Devam Et ">
                            </div>
                        </div>
                    </div>
                    </form>
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">İlan Kuralları</h4>
                                </div>
                                <div class="modal-body">
                                    <? include 'ilan_kurallari.php'; ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
                                </div>
                            </div>
                        </div>
                    </div>
					<script> 
var e = $(".ilce").val();
var f = $("#ilanId").val();
$.post('../filesystems/mahalle.php', {mahalle: e,ilanId:f}, function (output) {
        $(".mahalle option").remove();
        $(".mahalle").append(output);
    });
</script> 
                    <script>
                        function hesapla()
                        {
                            var e = $("#data4").val();
                            $.post("filesystems/hesapla.php", {fiyat: e}, function (result) {
                                $("#tutar").html(result);
                            });
                        }
                    </script>
<script type="text/javascript">
$( document ).ready(function() {
$(".form_datetime").datetimepicker({format: 'dd-mm-yyyy hh:ii'});
});
<?
if($_GET["ilanId"] != ""){
echo 'kargo();';	
}
?>
</script>