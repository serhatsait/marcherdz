<?
if ($_SESSION["uye"] == ""){ header("location: /login"); }
$uye = $_SESSION["uye"];
$sql = $db->query("SELECT * FROM ilanlar WHERE uyeId = '$uye'");
if ($MagazaSinir != $sql->RowCount()){
?>
<style>
select {
	margin-right: 10px;
}
</style>
<div class="container top15">
  <div class="panel panel-default">
    <div class="panel-heading">İlan Ver / Kategori Seç</div>
    <div class="panel-body"> Aşağıdaki kategorilerden ilanınız için en uygun kategoriyi seçiniz.<br>
      <br>
      <select id="cat1" name="cat1" class="form-control" style="max-width: 180px; float:left; font-size:12px" onchange="cat1()" size="10">
      <option value="">Seçiniz</option>
        <?php
                $sql = $db->query("SELECT * FROM category WHERE ustkategoriId = '0' ORDER BY sira ASC");
                while ($k = $sql->fetch(PDO::FETCH_OBJ)) {
                    echo '<option value="' . $k->Id . '">' . $k->kategori_adi . '</option>';
                }
                ?>
      </select>
      <span id="sn"></span> <span id="sn2"></span> <span id="sn3"></span> <span id="sn4"></span> <span id="sn5"></span> <span id="sn6"></span> </div>
    <div class="panel-body"> <span id="bt"></span> </div>
  </div>
</div>
<input type="hidden" name="kategori" id="kategori" value="">
<? } else {
    $sql = $db->query("SELECT * FROM magazalar WHERE uyeId = '$uye'");
    $a = $sql->fetch(PDO::FETCH_ASSOC);
    if ($sql->rowCount() == 0){
    ?>
<div class="container top15">
  <div class="panel panel-default">
    <div class="panel-heading">İlan Ver / Kategori Seç</div>
    <div class="panel-body">
      <div class="alert alert-danger"><strong>Uyarı!</strong> Maksimum ilan sınırını aştınız daha fazla ilan eklemek için mağaza açmanız gerekmektedir.</div>
    </div>
  </div>
</div>
<? } else { ?>
<style>
        select { margin-right:10px; }
    </style>
<div class="container top15">
  <div class="panel panel-default">
    <div class="panel-heading">İlan Ver / Kategori Seç</div>
    <div class="panel-body"> Aşağıdaki kategorilerden ilanınız için en uygun kategoriyi seçiniz.<br>
      <br>
      <select id="cat1" name="cat1" class="form-control" size="10" style="max-width: 180px; float:left; font-size:12px" onchange="cat1()">
        <?php
                    $sql = $db->query("SELECT * FROM category WHERE ustkategoriId = '0' ORDER BY sira ASC");
                    while ($k = $sql->fetch(PDO::FETCH_OBJ)) {
                        echo '<option value="' . $k->Id . '">' . $k->kategori_adi . '</option>';
                    }
                    ?>
      </select>
      <span id="sn"></span> <span id="sn2"></span> <span id="sn3"></span> <span id="sn4"></span> <span id="sn5"></span> <span id="sn6"></span> </div>
    <div class="panel-body"> <span id="bt"></span> </div>
  </div>
</div>
<input type="hidden" name="kategori" id="kategori" value="">
<? } } ?>
<script>
setInterval(function(){
	ekran();
});
function ekran(){
	var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE ");

    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))  // If Internet Explorer, return version number
    { 
	} else {
		  if ($(window).width() >= 767) {
	$("#cat1").attr("size","10");
	$("#cat2").attr("size","10");
	$("#cat3").attr("size","10");
	$("#cat4").attr("size","10");
	$("#cat5").attr("size","10");
	$("#cat6").attr("size","10");
	$("#cat7").attr("size","10");
	$("#cat8").attr("size","10");
	$("#cat9").attr("size","10");
	$("#cat10").attr("size","10");
	$("#cat1").css("max-width","180px");
	$("#cat1").css("float","left");
	$("#cat1").css("font-size","12px");
	$("#cat2").css("max-width","180px");
	$("#cat2").css("float","left");
	$("#cat2").css("font-size","12px");
	$("#cat3").css("max-width","180px");
	$("#cat3").css("float","left");
	$("#cat3").css("font-size","12px");
	$("#cat4").css("max-width","180px");
	$("#cat4").css("float","left");
	$("#cat4").css("font-size","12px");
	$("#cat5").css("max-width","180px");
	$("#cat5").css("float","left");
	$("#cat5").css("font-size","12px");
	$("#cat6").css("max-width","180px");
	$("#cat6").css("float","left");
	$("#cat6").css("font-size","12px");
	$("#cat7").css("max-width","180px");
	$("#cat7").css("float","left");
	$("#cat7").css("font-size","12px");
	$("#cat8").css("max-width","180px");
	$("#cat8").css("float","left");
	$("#cat8").css("font-size","12px");
	$("#cat9").css("max-width","180px");
	$("#cat9").css("float","left");
	$("#cat9").css("font-size","12px");
	$("#cat10").css("max-width","180px");
	$("#cat10").css("float","left");
	$("#cat10").css("font-size","12px");
  }
  else if ($(window).width() < 767 && $(window).width()>= 0) {
  $("#cat1").attr("size","0");
	$("#cat2").attr("size","0");
	$("#cat3").attr("size","0");
	$("#cat4").attr("size","0");
	$("#cat5").attr("size","0");
	$("#cat6").attr("size","0");
	$("#cat7").attr("size","0");
	$("#cat8").attr("size","0");
	$("#cat9").attr("size","0");
	$("#cat10").attr("size","0");
	$("#cat1").removeAttr("style");
	$("#cat2").removeAttr("style");
	$("#cat3").removeAttr("style");
	$("#cat4").removeAttr("style");
	$("#cat5").removeAttr("style");
	$("#cat6").removeAttr("style");
	$("#cat7").removeAttr("style");
	$("#cat8").removeAttr("style");
	$("#cat9").removeAttr("style");
	$("#cat10").removeAttr("style");
	$(".form-control").css("margin-bottom","10px");

  }
	}
}</script> 
