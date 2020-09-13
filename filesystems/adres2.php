<?
if ($_SESSION["uye"] == ""){ header("location: /login/"); }
$a1 = $_POST['a1'];
$a2 = $_POST['a2'];
$a3 = $_POST['a3'];
$a4 = $_POST['a4'];
$a5 = $_POST['a5'];
$a6 = $_POST['a6'];
$a7 = $_POST['a7'];
$a8 = $_POST['a8'];
$a9 = $_POST['a9'];
$a10 = $_POST['a10'];
$a11 = $_POST['a11'];
$fatura = $_POST['fatura'];
$uye = $_SESSION['uye'];
if ($a1 == 0){
$sql = $db->prepare('INSERT INTO teslimat (Id, tip, adsoyad, tc, firmaadi, vergidairesi, vergino, telefon, il, ilce, mahalle, adres, uyeId, siparisId	) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
$sql->execute(array(null,$a1, $a2, $a4, "", "", "", $a11, $a7, $a8, $a9, $a10, $uye, ""));
} else {
$sql = $db->prepare('INSERT INTO teslimat (Id, tip, adsoyad, tc, firmaadi, vergidairesi, vergino, telefon, il, ilce, mahalle, adres, uyeId, siparisId	) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
$sql->execute(array(null,$a1, "", "", $a3, $a5, $a6, $a11, $a7, $a8, $a9, $a10, $uye, ""));
}

if ($fatura == 1){
if ($a1 == 0){
$sql = $db->prepare('INSERT INTO fatura (Id, tip, adsoyad, tc, firmaadi, vergidairesi, vergino, telefon, il, ilce, mahalle, adres, uyeId, siparisId	) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
$sql->execute(array(null,$a1, $a2, $a4, "", "", "", $a11, $a7, $a8, $a9, $a10, $uye, ""));
} else {
$sql = $db->prepare('INSERT INTO fatura (Id, tip, adsoyad, tc, firmaadi, vergidairesi, vergino, telefon, il, ilce, mahalle, adres, uyeId, siparisId	) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
$sql->execute(array(null,$a1, "", "", $a3, $a5, $a6, $a11, $a7, $a8, $a9, $a10, $uye, ""));
}
header("location: index.php?page=ozet");
} else {
?>
<div class="container top15">
    <div class="panel panel-default">
        <div class="panel-heading">Fatura Adresi</div>
        <div class="panel-body">
            <form action="index.php?page=ozet" method="post">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>Fatura Tipi</label>
                            <select name="a1" id="a1" class="form-control" onChange="adres()">
                                <option value="0">Bireysel</option>
                                <option value="1">Kurumsal</option>
                            </select>
                        </div>
                        <div class="form-group" id="x1">
                            <label>Ad Soyad</label>
                            <input type="text" name="a2" id="a2" class="form-control" required="required">
                        </div>
                        <div class="form-group" id="x2" style="display:none">
                            <label>Firma Adı</label>
                            <input type="text" name="a3" id="a3" class="form-control">
                        </div>
                        <div class="form-group" id="x3">
                            <label>T.C. Kimlik No</label>
                            <input type="number" name="a4" id="a4" class="form-control" required="required">
                        </div>
                        <div class="form-group" id="x4" style="display:none">
                            <label>Vergi Dairesi</label>
                            <input type="text" name="a5" id="a5" class="form-control">
                        </div>
                        <div class="form-group" id="x5" style="display:none">
                            <label>Vergi No</label>
                            <input type="number" name="a6" id="a6" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Telefon :</label>
                            <input type="text" name="a11" id="a11" class="form-control phone" placeholder="Telefon" value="" required="required">
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>Wilaya :</label>
                            <select name="a7" id="a7" class="form-control il" onchange="districts()" required>
                                <option value="">Seçiniz</option>
                                <?php
                                $sql2 = $db->query("SELECT * FROM city ORDER BY il_adi ASC");
                                while ($i = $sql2->fetch(PDO::FETCH_OBJ)) {
                                    echo '<option value="' . $i->id . '"';
                                    if ($v->city == $i->id) {
                                        echo ' selected="select"';
                                    }
                                    echo '>' . $i->il_adi . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Municipalité :</label>
                            <select name="a8" id="a8" class="form-control ilce"  onchange="localitys()" required>
                                <?php
                                $il = $v->city;
                                $sql2 = $db->query("SELECT * FROM county WHERE il_id = '$il' ORDER BY county_adi ASC");
                                while ($ix = $sql2->fetch(PDO::FETCH_OBJ)) {
                                    echo '<option value="' . $ix->id . '"';
                                    if ($v->districts == $ix->id) {
                                        echo ' selected="select"';
                                    }
                                    echo '>' . $ix->county_adi . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <script> localitys();</script>
                        <div class="form-group">
                            <label>Mahalle :</label>
                            <select name="a9" id="locality" class="form-control mahalle" >
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Adres</label>
                            <input type="text" name="a10" id="a10" class="form-control" placeholder="Açık Adresiniz" required>
                        </div>
                    </div>
                </div>

                <hr style="margin-top:0px !important; margin-bottom:5px !important">
                <input type="submit" class="btn btn-danger" value="Devam">
            </form>
        </div>
    </div>
</div>
<script>
    function adres()
    {
        if (document.getElementById('a1').value == 0) {
            $("#x1").css("display", "block");
            $("#x2").css("display", "none");
            $("#x3").css("display", "block");
            $("#x4").css("display", "none");
            $("#x5").css("display", "none");
            $("#a3").prop('required', false);
            $("#a4").prop('required', true);
            $("#a5").prop('required', false);
            $("#a6").prop('required', false);
        } else {
            $("#x1").css("display", "none");
            $("#x2").css("display", "block");
            $("#x3").css("display", "none");
            $("#x4").css("display", "block");
            $("#x5").css("display", "block");
            $("#a4").prop('required', false);
            $("#a3").prop('required', true);
            $("#a5").prop('required', true);
            $("#a6").prop('required', true);
        }
    }
</script>

<? } ?>