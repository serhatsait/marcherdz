<? if ($_SESSION["uye"] == ""){ header("location: /login/"); } ?>
<div class="container top15">
    <div class="panel panel-default">
        <div class="panel-heading">Teslimat Adresi</div>
        <div class="panel-body">
            <form action="index.php?page=ozet" method="post">
                <div class="row">
                    <div class="col-xs-6" style="width: 100%;">
                       
                        <div class="form-group" id="x1">
                            <label>Ad Soyad</label>
                            <input type="text" name="a2" id="a2" class="form-control" required="required">
                        </div>
                        <div class="form-group" id="x2" class="form-control">
                            <label>Firma Adı</label>
                            <input type="text" placeholder="Firma Değilseniz Boş Bırakınız" name="a3" id="a3" class="form-control">
                        </div>
                        <div class="form-group" id="x3">
                            <label>T.C. Kimlik No</label>
                            <input type="number" placeholder="Tc Kimlik Numaranız" name="tcc" id="tcc" class="form-control" required="required">
                        </div>
                        <div class="form-group" id="x4" class="form-control">
                            <label>Vergi Dairesi</label>
                            <input type="text" placeholder="Firma Değilseniz Boş Bırakınız" name="a5" id="a5" class="form-control">
                        </div>
                        <div class="form-group" id="x5" class="form-control">
                            <label>Vergi No</label>
                            <input type="number" placeholder="Firma Değilseniz Boş Bırakınız" name="a6" id="a6" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Telefon :</label>
                            <input type="text" name="a11" id="a11" class="form-control phone" placeholder="Telefon" value="" required="required">
                        </div>
                    </div>
                    <div class="col-xs-6" style="width: 100%;">
                        <div class="form-group">
                            <label>İl :</label>
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
                            <label>İlçe :</label>
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
                            <label>Adres</label>
                            <input type="text" name="a10" id="a10" class="form-control" placeholder="Açık Adresiniz" required>
                        </div>
                    </div>
                </div>

                <hr style="margin-top:0px !important; margin-bottom:5px !important">
                <label><input type="checkbox" id="fatura" name="fatura" value="1" checked> Fatura adresim teslimat adresimle aynı olsun</label>
                <br><br>
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