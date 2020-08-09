<?
$uye = $_SESSION["uye"];
if ($_SESSION["uye"] == ""){ header("location: /login"); }
?>
 <div class="container top15">
        <div class="panel panel-default">
            <div class="panel-heading">Ödeme</div>
            <div class="panel-body">
			<h4 style="margin-bottom:0px !important; padding-bottom: 5px !important">İlanınız Kaydedildi</h4>
			İlanınız ödemeniz yapıldıktan sonra editörlerimiz tarafından incelenip yayınlanacaktır. Ödemenizi aşağıdaki hesap numaralarımıza yaptıktan sonra bana özel bölümünde bulunan <b>ödeme bildirimi</b> menüsünden <b>ödeme bildirimi</b> yapmanız gerekmektedir. 
			<br><br>
			Ödeme Yapmanız Gereken Tutar : <b><? echo $ihalebedeli; ?></b> TL 'dir.<br><br>
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
            </div><br>
			<a href="index.php" class="btn btn-success">Anasayfaya Dönmek İçin Tıklayınız</a>
			</div>
		</div>
</div>