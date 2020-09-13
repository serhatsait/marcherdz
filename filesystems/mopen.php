<?
if ($_SESSION["uye"] == ""){ header("location: /login/"); }
function sayac($id)
{
global $db;
$bugun = date("Y-m-d");
$sql   = $db->query("SELECT Id FROM ilanlar WHERE (category1 = '$id' or category2 = '$id' or category3 = '$id' or category4 = '$id' or category5 = '$id' or category6 = '$id' or category7 = '$id' or category8 = '$id' or category9 = '$id' or category10 = '$id') and (bitis >= '$bugun') and (confirm = '1')");
return $sql->rowCount();
}
?>
<script>
    var digitsOnly = /[1234567890]/g;
    var integerOnly = /[0-9\.]/g;
    var alphaOnly = /[A-Za-z1234567890]/g;
    function restrictCharacters(myfield, e, restrictionType) {
        if (!e)
            var e = window.event
        if (e.keyCode)
            code = e.keyCode;
        else if (e.which)
            code = e.which;
        var character = String.fromCharCode(code);
        if (code == 27) {
            this.blur();
            return false;
        }
        if (!e.ctrlKey && code != 9 && code != 8 && code != 36 && code != 37 && code != 38 && (code != 39 || (code == 39 && character == "'")) && code != 40) {
            if (character.match(restrictionType)) {
                return true;
            } else {
                return false;
            }
        }
    }
    function kontrol() {
        $.post("filesystems/kontrol.php", {
            name: $("#a2").val()
        },
                function (data) {
                    if (data > 0) {
                        alert("Belirtilen mağaza adresi kullanımda");
                        $("#a2").val("");
                        $("#sub").attr("disabled", true);
                    } else {
                        $("#sub").attr("disabled", false);
                    }
                });
    }
    function magaza()
    {
        $.post("filesystems/fiyat.php", {
            name: $("#a4").val()
        },
                function (data) {
                    var r = data.split("-");
                    $("#a5 option[value='3']").remove();
                    $("#a5 option[value='6']").remove();
                    $("#a5 option[value='12']").remove();
                    $("#a5").append('<option value="3">3 AY ( ' + r[0] + ' TL )</option>');
                    $("#a5").append('<option value="6">6 AY ( ' + r[1] + ' TL )</option>');
                    $("#a5").append('<option value="12">12 AY ( ' + r[2] + ' TL )</option>');
                });
    }
</script>

<div class="container top15">
    <div class="row no-gutter">
        <div class="hidden-xs col-sm-3">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-list" aria-hidden="true"></i>Catégories</div>
                <div class="panel-body">
				<b><div class="subcat_special">
	<i class="fa fa-bell-o" style="color: #20568a;" aria-hidden="true"></i> <a href="<?php echo $base_url; ?>acil-ilanlar.html?sayfa=1" style="color:#545454" class="cat_text">Dernières publications</a><div style="clear:both"></div></div>
	<div class="subcat_special">
	<i class="fa fa-thumbs-down" style="color: #20568a;" aria-hidden="true"></i> <a href="<?php echo $base_url; ?>fiyati-dusenler.html" style="color:#545454" class="cat_text">Prix ​​réduit</a><div style="clear:both"></div></div>
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
                    <ul class="notranslate category">
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
		?>
        <div class="col-xs-12 col-sm-9" style="padding-left:5px;">
            <div class="panel panel-default">
                <div class="panel-heading">Mağaza Aç</div>
                <div class="panel-body">
                    
<p align="center">
<img border="0" src="img/kurumsalmagaza.png" width="320" height="210"></p>
<table class="tbl" width="100%" cellspacing="0" cellpadding="0" id="table2">
	<tr>
		<td style="background: #F8F8F8" width="160" align="center">
		<font face="Arial" size="2"><b>Mağaza Ayrıcalıklarınız</b></font></td>
		<td style="background: #F8F8F8" width="126" align="center">
		<font face="Arial" size="2"><b>Normal Mağaza</b></font></td>
		<td style="background: #F8F8F8" width="111" align="center">
		<font face="Arial" size="2"><b>Süper Mağaza</b></font></td>
		<td style="background: #F8F8F8" width="114" align="center">
		<font face="Arial" size="2"><b>Gold Mağaza</b></font></td>
	</tr>
	<tr>
		<td><font face="Arial" size="2">Limitlere takılmadan ve onay beklemeden 
		ilan yayınlama</font></td>
		<td align="center"><font face="Arial" size="2">
		<img src="img/apply.png" alt="" title height="16" width="16" border="0"></font></td>
		<td align="center"><font face="Arial" size="2">
		<img src="img/apply.png" alt="" title height="16" width="16" border="0"></font></td>
		<td align="center"><font face="Arial" size="2">
		<img src="img/apply.png" alt="" title height="16" width="16" border="0"></font></td>
	</tr>
	<tr>
		<td><font face="Arial" size="2">Mağaza Süresi</font></td>
		<td align="center"><font face="Arial" size="2">3 Aylık</font></td>
		<td align="center"><font face="Arial" size="2">6 Aylık </font></td>
		<td align="center"><font face="Arial" size="2">1 Yıllık</font></td>
	</tr>
	<tr>
		<td><font face="Arial" size="2">Mağaza İlan Ekleme Limiti</font></td>
		<td align="center"><font face="Arial" size="2"><? echo $kota1; ?></font></td>
		<td align="center"><font face="Arial" size="2"><? echo $kota2; ?></font></td>
		<td align="center"><font face="Arial" size="2"><? echo $kota3; ?></font></td>
	</tr>
	<tr>
		<td><font face="Arial" size="2">İnternet tarayıcısı başlığında 
		mağazanızın adı</font></td>
		<td align="center"><font face="Arial" size="2">
		<img src="img/apply.png" alt="" title height="16" width="16" border="0"></font></td>
		<td align="center"><font face="Arial" size="2">
		<img src="img/apply.png" alt="" title height="16" width="16" border="0"></font></td>
		<td align="center"><font face="Arial" size="2">
		<img src="img/apply.png" alt="" title height="16" width="16" border="0"></font></td>
	</tr>
	<tr>
		<td><font face="Arial" size="2">Mağaza sayfanıza ve fotoğraflarınıza 
		logo ekleyebilme</font></td>
		<td align="center"><font face="Arial" size="2">
		<img src="img/apply.png" alt="" title height="16" width="16" border="0"></font></td>
		<td align="center"><font face="Arial" size="2">
		<img src="img/apply.png" alt="" title height="16" width="16" border="0"></font></td>
		<td align="center"><font face="Arial" size="2">
		<img src="img/apply.png" alt="" title height="16" width="16" border="0"></font></td>
	</tr>
</table>

<br><hr>
					
					
					
					<form action="index.php?page=magazaodeme" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Mağaza Adı :</label>
                            <input name="a1" id="a1" class="form-control" placeholder="Mağaza adınız" required>
                        </div>
                        <div class="form-group">
                            <label>Mağaza Adresi :</label>
                            <div class="input-group">
                                <input name="a2" id="a2" type="text" class="form-control" placeholder="Mağaza Adı" aria-describedby="basic-addon2" onkeypress="return restrictCharacters(this, event, alphaOnly);" onpaste="return false;" autocomplete="off" onChange="kontrol()" required>
                                    <span class="input-group-addon" id="basic-addon2">.<? echo $murl; ?></span> </div>
                            <div style="padding-top:5px; color:red; font-size:12px">Türkçe karakter, büyük harf ve noktalama işaretleri kullanmayınız</div>
                        </div>
                        <div class="form-group">
                            <label>Mağaza Açıklaması :</label>
                            <textarea class="form-control" placeholder="Mağaza hakkında bilgi" style="height:100px" name="a3" id="a3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Mağaza Logo ( Tavsiye Edilen Ölçü 200x110 ) :</label>
                            <input type="file" class="form-control" name="logo" id="logo" required>
                        </div>
						<div class="form-group">
                            <label>Mağaza Slider ( Tavsiye Edilen Ölçü 1200x250 ) :</label>
                            <input type="file" class="form-control" name="mslider" id="mslider" required>
                        </div>
                        <div class="form-group">
                            <label>Mağaza Tipi ve Süresi :</label>
                            <select class="form-control" name="a5" id="a5" required>
                                <option value="3">Normal Mağaza 3 AY ( <? echo $magaza1; ?> TL ) + <? echo $kota1; ?> İlan Ekleme Kotası</option>
                                <option value="6">Süper Mağaza 6 AY ( <? echo $magaza2; ?> TL ) + <? echo $kota2; ?> İlan Ekleme Kotası</option>
                                <option value="12">Gold Mağaza 12 AY ( <? echo $magaza3; ?> TL ) + <? echo $kota3; ?> İlan Ekleme Kotası</option>
                            </select>
							<div style="padding-top:5px; color:red; font-size:12px">Mağazanız Onaylandıktan Sonra Banaözel / Mağaza Bilgilerim Bölümünden Anlık Kalan Kotalarınızı Takip Edebilirsiniz</div>
                        </div>
                        <div class="form-group">
                            <label>Ödeme :</label>
                            <select class="form-control" name="a6" id="a6" required>
								<?
								$odemesistemleri = $db->query("SELECT * FROM odemesistemleri");
								$odm = $odemesistemleri->fetch(PDO::FETCH_ASSOC);
								?>
								<? if ($odm["havale"] == 1){ ?>
                                <option value="0">Havale / EFT</option>
								<? } ?>
								
                               
                                <option value="3" >Kredi Kartı İle Öde ( İyzico )</option>
                            </select>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Devam" name="sub" id="sub">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
