<?php
include 'functions2.php';

$id = $_GET["id"];
$uye = $_SESSION['uye'];
$sql34 = $db->query("SELECT * FROM ilanlar WHERE Id = '$id'");
if ($sql34->rowCount() != ""){

$aa1 = $sql34->fetch(PDO::FETCH_ASSOC);
if($_SESSION['uye']!=$aa1['uyeId']){
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> <script> alert("Farklı Bir Kullanıcının İlanına Erişiminiz Yoktur");window.location.href="/index.php"; </script>';
}
}


if(!isset($_SESSION)) { session_start(); }
$_SESSION["resimklasoru"] = $_GET["id"];
$klasor_adi = "files/".$_SESSION["resimklasoru"];
if(file_exists($klasor_adi)){} else {
	$olustur = mkdir($klasor_adi, 0755); if($olustur){}
	$olustur = mkdir($klasor_adi."/thumbnail", 0755); if($olustur){}
}
if ($handle = opendir('files/'.$_SESSION["resimklasoru"])) {
    $blacklist = array('.', '..', 'thumbnail');
    while (false !== ($file = readdir($handle))) {
        if (!in_array($file, $blacklist)) {
            $resimler[] = $file;
        }
    }
    closedir($handle);
}
?>

<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<link type="text/css" href="orakuploader/orakuploader.css" rel="stylesheet"/>
<script type="text/javascript" src="orakuploader/jquery.min.js"></script>
<script type="text/javascript" src="orakuploader/jquery-ui.min.js"></script>
<script type="text/javascript" src="orakuploader/orakuploader.js"></script>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="bootstrap/css/jumbotron-narrow.css" rel="stylesheet">
</head>
<body>
<div class="alert alert-success">
<? if ($_GET["tip"] == "1"){ ?>
  <strong>İpucu</strong> 1 adet logo yükleyebilirsiniz.
  <? } else { ?>
  <strong>İpucu</strong> Fotoğraflarınızı toplu halde yükleyebilir, sürükle bırak yöntemi ile görünümlerini sıralayabilirsiniz...
  <? } ?>
</div>

<script>
$(document).ready(function(){
	$('#imagesex').orakuploader({
		orakuploader : true,
		orakuploader_path  		         : 'orakuploader/',
		orakuploader_main_path           : 'files/<?php echo $_SESSION["resimklasoru"]; ?>',
		orakuploader_thumbnail_path      : 'files/<?php echo $_SESSION["resimklasoru"]; ?>/thumbnail',
		orakuploader_use_main : true,
		orakuploader_use_sortable : true,
		orakuploader_use_dragndrop : true,
		orakuploader_use_rotation: true,
		orakuploader_add_image : 'orakuploader/images/add.png',
		orakuploader_add_label : 'Resim Seç Yükle',
		<? if ($_GET["tip"] == "1"){ ?>
		orakuploader_maximum_uploads : 1,
		<? } else { ?>
		orakuploader_maximum_uploads : <?php echo $MaksimumResimUpload; ?>,
		<? } ?>
		orakuploader_resize_to	     : 800,
		orakuploader_crop_thumb_to_width: 150,
		orakuploader_crop_thumb_to_height: 113,
		orakuploader_hide_in_progress: true,
		orakuploader_attach_images: [
		<?php 
		$idddd = $_GET["id"];
		$sql = $db->query("SELECT * FROM images WHERE ilanId = '$idddd' ORDER BY s ASC");
		while ($re = $sql->fetch(PDO::FETCH_ASSOC)){
			 echo "'$re[name]',";
		}
		?>],

		orakuploader_main_changed    : function (filename) {
		var images = $('.file').find('img').map(function() { return this.src; }).get();
		
			$("#mainlabel-images").remove();
			$("div").find("[filename='" + filename + "']").append("<div id='mainlabel-images' class='maintext'>Varsayılan Resim</div>");
			$.post( "sirala.php", { name: images}, function( data ) { });
		},

	});
});
</script>
 <div id="imagesex" orakuploader="on"></div>
</div>
</body>
</html>