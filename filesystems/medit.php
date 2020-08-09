<?
if ($_SESSION["uye"] == ""){ header("location: /login/"); }
function sayac($id)
{
global $db;
$bugun = date("Y-m-d");
$sql   = $db->query("SELECT Id FROM ilanlar WHERE (category1 = '$id' or category2 = '$id' or category3 = '$id' or category4 = '$id' or category5 = '$id' or category6 = '$id' or category7 = '$id' or category8 = '$id' or category9 = '$id' or category10 = '$id') and (bitis >= '$bugun') and (confirm = '1')");
return $sql->rowCount();
}
$err = "";
if ($_POST["a1"] != ""){
$a1 = $_POST["a1"];
$a2 = $_POST["a2"];
$uye = $_SESSION["uye"];
$sql = "UPDATE magazalar SET magazaadi = '$a1', aciklama = '$a2' WHERE uyeId = '$uye'";
$stmt = $db->prepare($sql);
$stmt->execute();
include('class.upload.php');
$logo = $_FILES['logo'];
$handle = new Upload($logo);
$dir_dest = "uploads/";
$handle->image_convert	= 'jpg';
$handle->allowed		= array ( 'image/*' );
$handle->Process($dir_dest);
if ($handle->processed) { $resim = $handle->file_dst_name;
$sql = "UPDATE magazalar SET logo = '$resim' WHERE uyeId = '$uye'";
$stmt = $db->prepare($sql);
$stmt->execute();
}

$mslider = $_FILES['mslider'];
$handle = new Upload($mslider);
$dir_dest = "uploads/";
$handle->image_convert	= 'jpg';
$handle->allowed		= array ( 'image/*' );
$handle->Process($dir_dest);
if ($handle->processed) { $mslider2 = $handle->file_dst_name;
$sql = "UPDATE magazalar SET magazaslider = '$mslider2' WHERE uyeId = '$uye'";
$stmt = $db->prepare($sql);
$stmt->execute();
}

$err = '<div class="alert alert-success"><strong>Uyarı!</strong> Mağaza bilgileriniz güncellendi</div>';

}
$uye = $_SESSION['uye'];
$sql = $db->query("SELECT * FROM magazalar WHERE uyeId = '$uye'");
$row = $sql->fetch(PDO::FETCH_ASSOC);
?>
<div class="container top15">
    <div class="row no-gutter">
        <div class="hidden-xs col-sm-3">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-list" aria-hidden="true"></i> Kategoriler</div>
                <div class="panel-body">
				<b><div class="subcat_special">
	<i class="fa fa-bell-o" style="color: #20568a;" aria-hidden="true"></i> <a href="<?php echo $base_url; ?>acil-ilanlar.html?sayfa=1" style="color:#545454" class="cat_text">Acil Acil İlanları</a><div style="clear:both"></div></div>
	<div class="subcat_special">
	<i class="fa fa-thumbs-down" style="color: #20568a;" aria-hidden="true"></i> <a href="<?php echo $base_url; ?>fiyati-dusenler.html" style="color:#545454" class="cat_text">Fiyatı Düşenler</a><div style="clear:both"></div></div>
<div class="subcat_special">
	<i class="fa fa-shopping-cart" style="color: #20568a;" aria-hidden="true"></i> <a href="<?php echo $base_url; ?>get-ilanlar.html"  style="color:#545454" class="cat_text">Güvenli e-Ticaret İlanları</a><div style="clear:both"></div></div>
	<div class="subcat_special">
	<i class="fa fa-globe"  style="color: #20568a;" aria-hidden="true"></i> <a href="<?php echo $base_url; ?>haritali-ilanlar.html" style="color:#545454" class="cat_text">Haritali İlanlar</a><div style="clear:both"></div></div>
	<div class="subcat_special">
	<i class="fa fa-building" style="color: #20568a;" aria-hidden="true"></i> <a href="<?php echo $base_url; ?>rehber.html?sayfa=1" style="color:#545454" class="cat_text">Firma Rehberi</a><div style="clear:both"></div></div>
	<div class="subcat_special">
	<i class="fa fa-clock-o" style="color: #20568a;" aria-hidden="true"></i> <a href="<?php echo $base_url; ?>son-48-saat.html" style="color:#545454" class="cat_text">Son 48 Saat</a> / <a href="/son-1-hafta.html"  style="color:#545454" class="cat_text">1 Hafta</a> / <a href="/son-1-ay.html" style="color:#545454" class="cat_text">1 Ay</a><div style="clear:both"></div></div>
<div class="subcat_special">
	<i class="fa fa-briefcase" style="color: #20568a;" aria-hidden="true"></i> <a href="<?php echo $base_url; ?>magazalar.html" style="color:#545454" class="cat_text">Mağazalar</a><div style="clear:both"></div></div></b>

				<br>
                    <ul class="category">
                        <?

                        $sql = $db->query("SELECT * FROM category WHERE ustkategoriId = '0' and tip = '0' ORDER BY sira ASC");
                        while ($a = $sql->fetch(PDO::FETCH_OBJ)){
                        
						echo '<li class="maincat"><img src="'.$base_url.'ikonlar/'.$a->ikon.'" alt="'.$a->kategori_adi.'" width="20" height="20" class="absmiddle" /> <b>'.$a->kategori_adi.'</b></li>';
                        $ust = $a->Id;
                        $sql2 = $db->query("SELECT * FROM category WHERE ustkategoriId = '$ust'");
                        while ($b = $sql2 ->fetch(PDO::FETCH_OBJ)){
                        echo '<li><a href="kategori-'.$b->Id.'-'.slugify($b->kategori_adi).'.html">'.$b->kategori_adi.' <span>( ' . sayac($b->Id) . ' )</span></a></li>';
                        }
						
                        }
                        ?>
                    </ul>
					
                </div>
            </div></div>
        <?
        $m = str_replace("http://","",$base_url);
        $m = rtrim($m,"/");
        $murl = $SiteName;
		$sql22 = $db->query("SELECT * FROM ilanlar WHERE uyeId = '$uye' and firmadi IS NULL");
		$say21 = $sql22->rowCount();
		$sql36 = $db->query("SELECT * FROM magazalar WHERE uyeId = '$uye'");
		$aa1 = $sql36->fetch(PDO::FETCH_ASSOC);
		$magazakota = $aa1["magazakota"];
		$fark = $magazakota - $say21;
		?>
        <div class="col-xs-12 col-sm-9" style="padding-left:5px;">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-repeat" aria-hidden="true"></i> Mağaza Kullanım Bilgileri</div>
                <div class="panel-body">
                    <? echo $err; ?>
                     
					  <div class="form-group">
                            <label>İlan Ekleme Kotanız :</label>
                            <input name="xx" id="xx" class="form-control" placeholder="" readonly value="<? echo $magazakota; ?>">
					 </div>
					 <div class="form-group">
                            <label>Aktif İlan Sayınız :</label>
                            <input name="xx" id="xx" class="form-control" placeholder="" readonly value="<? echo $say21; ?>">
					 </div>
					 <div class="form-group">
                            <label>Kalan Kotanız :</label>
                            <input name="xx" id="xx" class="form-control" placeholder="" readonly value="<? echo $fark; ?>">
					 </div>
					 <div class="form-group">
                            <label>Mağaza Süresi :</label>
                            <input name="xx" id="xx" class="form-control" placeholder="" readonly value="<? echo $aa1["sure"]; ?> Aylık <? if ($aa1["sure"] == "12") echo "Gold Mağaza";?><? if ($aa1["sure"] == "6") echo "Süper Mağaza";?><? if ($aa1["sure"] == "3") echo "Normal Mağaza";?>">
					 </div>
					 
					  <div class="form-group">
                            <label>Bitiş Tarihi :</label>
                            <input name="xx" id="xx" class="form-control" placeholder="" readonly value="<? echo $aa1["bitis"]; ?>">
					 </div>
					 
					 <hr>
					 <div class="panel panel-default">
					 <div class="panel-heading"><i class="fa fa-wrench" aria-hidden="true"></i> Mağaza Güncelleme</div>
					 </div>
					<form action="index.php?page=medit" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Mağaza Adı :</label>
                            <input name="a1" id="a1" class="form-control" placeholder="Mağaza adınız" value="<? echo $row["magazaadi"]; ?>">
                    </div>
                    <div class="form-group">
                        <label>Mağaza Adresi :</label>
                        <div class="input-group">
                            <input  type="text" class="form-control" placeholder="Mağaza Adı" aria-describedby="basic-addon2" onkeypress="return restrictCharacters(this, event, alphaOnly);" onpaste="return false;" autocomplete="off" onChange="kontrol()" readonly value="<? echo $row["adres"]; ?>">
                                    <span class="input-group-addon" id="basic-addon2">.<? echo $murl; ?></span> </div>
                    </div>
                    <div class="form-group">
                        <label>Mağaza Açıklaması :</label>
                        <textarea class="form-control" placeholder="Mağaza hakkında bilgi" style="height:100px" name="a2" id="a2"  required><? echo $row["aciklama"]; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Mağaza Logo ( Tavsiye Edilen Ölçü 200x110 ) :</label>
                        <input type="file" class="form-control" name="logo" id="logo">
                    </div>
					<div class="form-group">
                        <label>Mağaza Slider ( Tavsiye Edilen Ölçü 1200x250 ) :</label>
                        <input type="file" class="form-control" name="mslider" id="mslider">
                    </div>
                    <input type="submit" class="btn btn-primary" value="Mağazamı Güncelle" name="sub" id="sub" >
                </form>
            </div>
        </div>
    </div>
</div>
</div>
