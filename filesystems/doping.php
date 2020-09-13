<? if ($_SESSION["uye"] == ""){ header("location: /login/"); } 
$id = $_GET['id']; 

?>

<div class="container top15">
<style>
.button27 {
    background-color: #ffd10a;
    border-color: #6f6f6f;
    color: #4d4d4d;
    font-weight: 600;
    
    width: 200px;
}
.button28 {
    background-color: #ffd10a;
    border-color: #6f6f6f;
    color: #4d4d4d;
    font-weight: 600;
    
    
    width: 200px;
}
</style>
<div class="panel panel-default"><br>
<center><font size="5">Aşağıdaki Butonlar İle İlanınızı Önizleyin; Bir Hata Olduğunu Düşünüyorsanız Bir Geri Gidip İlanınızı Güncelleyebilirsiniz.</font></center><br>
<center><a target="blank" href="index.php?page=ilan&id=<?= $id; ?>" class="btn btn-dafault button27"><i class="fa fa-plus-square" aria-hidden="true"></i> İlanı Önizle</a> <a href="index.php?page=guncelle&ilanId=<?= $id; ?>" class="btn btn-dafault button28"><i class="fa fa-plus-square" aria-hidden="true"></i> İlanı Düzenle</a></center>
<br>
</div>
<br>
    <form action="index.php?page=dopingodeme&id=<?= $id; ?>" method="post">
        <div class="panel panel-default">
            <div class="panel-heading">Doping</div>
            <div class="panel-body">
                <div class="alert alert-danger">
                    <h4 style="margin-bottom:0px !important; padding-bottom: 5px !important">Daha fazla alıcıya ulaşmak ister misiniz?</h4>
                    Doping alın, ilanınızın 251* kata kadar daha fazla görüntülenmesini sağlayın. </div>
                <hr>
                <div class="row no-gutter">
                    <div class="col-xs-12 col-sm-6">
                        <div class="box ">
                            <h5>Vitrine</h5>
                            İlanınız her gün “milyonlarca kişinin ziyaret ettiği” sitemizin ana sayfasında yer alsın.
                            <select class="form-control" name="dp1">
                                <option value="0">İstemiyorum</option>
                                <option value="1">1 semaine - <? echo $doping_anasayfa_1; ?> TL</option>
                                <option value="2">2 Hafta - <? echo $doping_anasayfa_2; ?> TL</option>
                                <option value="4">4 Hafta - <? echo $doping_anasayfa_4; ?> TL</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="box">
                            <h5>Kategori Vitrini</h5>
                            İlanınız her gün ait olduğu kategori ve alt kategori sayfalarında görüntülensin istiyorsanız hemen alın!
                            <select class="form-control" name="dp2">
                                <option value="0">İstemiyorum</option>
                                <option value="1">1 semaine - <? echo $doping_kategori_1; ?> TL</option>
                                <option value="2">2 Hafta - <? echo $doping_kategori_2; ?> TL</option>
                                <option value="4">4 Hafta - <? echo $doping_kategori_4; ?> TL</option>
                            </select>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row no-gutter">
                    <div class="col-xs-12 col-sm-6">
                        <div class="box">
                            <h5>Acil İlanlar</h5>
                            "Hemen satmam lazım" diyorsanız Acil ilanlar dopingini alın, ilanınız ana sayfa sol menüde yer alan Acil ilanlar kategorisinde yer alsın.
                            <select class="form-control" name="dp3">
                                <option value="0">İstemiyorum</option>
                                <option value="1">1 semaine - <? echo $doping_acil_1; ?> TL</option>
                                <option value="2">2 Hafta - <? echo $doping_acil_2; ?> TL</option>
                                <option value="4">4 Hafta - <? echo $doping_acil_4; ?> TL</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="box">
                            <h5>Kalın Yazı & Renkli Çerçeve</h5>
                            İlanınız arama sonuç listelerinde kalın yazı ve renkli çerçevesiyle görüntülensin, benzerlerinden ayırt edilsin istiyorsanız hemen alın!
                            <select class="form-control" name="dp4">
                                <option value="0">İstemiyorum</option>
                                <option value="1">1 semaine - <? echo $doping_kalin_1; ?> TL</option>
                                <option value="2">2 Hafta - <? echo $doping_kalin_2; ?> TL</option>
                                <option value="4">4 Hafta - <? echo $doping_kalin_4; ?> TL</option>
                            </select>
                        </div>
                    </div>
                </div>
                <br>
                <input type="submit" class="btn btn-primary" value="Kaydet ve İlerle">
            </div>
        </div>
    </form>
</div>
