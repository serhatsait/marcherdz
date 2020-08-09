<?php
if ($_SESSION["uye"] == "") {
    header("location: /login/");
}
$id = $_GET["id"];
$sql = "UPDATE doping SET odeme = '1' WHERE ilanId = '$id'";
$stmt = $db->prepare($sql);
$stmt->execute();

$o = $_GET["odeme"];
?>
<?php 
if ($o == "debit"){ ?>
<div class="container top15">
    <div class="panel panel-default">
        <div class="panel-heading">Doping / Kredi Kartı İle Ödeme Sonucu</div>
        <div class="panel-body">
            <div class="alert alert-success">
                <h4 style="margin-bottom:0px !important; padding-bottom: 5px !important">İşlem Tamamlandı</h4>
                İlanınız editörlerimiz tarafından incelendikten sonra yayınlanacaktır, doping ödemeleriniz kredi kartınızdan tahsil edilmiştir.</div>
				

        </div>
    </div>
</div>
<?php } ?>
<? if ($o == 0){ ?>
<div class="container top15">
    <div class="panel panel-default">
        <div class="panel-heading">Doping / Havale - EFT Sonucu</div>
        <div class="panel-body">
            <div class="alert alert-success">
                <h4 style="margin-bottom:0px !important; padding-bottom: 5px !important">İşlem Tamamlandı</h4>
                İlanınız editörlerimiz tarafından incelendikten sonra yayınlanacaktır ödemenizi aşağıdaki hesap numaralarımıza yapabilirsiniz. Lütfen Ödemenizi Görebilmemiz İçin Banaözel / Ödeme Bildirimi Bölümünden Bildirim Gönderiniz.</div>
				
            <div style="padding:10px; border:solid 1px #d8d8d8">
                <table class="table table-striped">
                    <thead>
                        <tr style="font-size:14px !important">
                            <td><b>Banka Adı</b></td>
                            <td><b>Şube Kodu</b></td>
                            <td><b>Hesap No</b></td>
                            <td><b>IBAN</b></td>
                        </tr>
                    </thead>
                    <tbody style="font-size:12px !important">
                        <?php
                        $sql = $db->query("SELECT * FROM bank");

                        while ($b = $sql->fetch(PDO::FETCH_OBJ)) {
                            echo '
                         <tr style="font-size:12px !important">
                            <td>' . $b->bankaadi . '</td>
                            <td>' . $b->sube . '</td>
                            <td>' . $b->hesap . '</td>
                            <td>' . $b->iban . '</td>
                        </tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<? } ?>
