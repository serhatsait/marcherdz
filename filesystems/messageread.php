<?
if ($_SESSION["uye"] == ""){ header("location: /login/"); }
$id = $_GET["id"];
$uye = $_SESSION['uye'];
if ($_GET["delete"] == 1){
$ilanId = $_GET["ilanId"];
$sql = $db->query("SELECT * FROM ilanlar WHERE Id = '$ilanId'");
if($uye == $a["gonderen"]){
$sql = "UPDATE mesajlar SET gonderensil = '1' WHERE Id = '$id'";
$stmt = $db->prepare($sql);
$stmt->execute();
} else {
$sql = "UPDATE mesajlar SET gonderilensil = '1' WHERE Id = '$id'";
$stmt = $db->prepare($sql);
$stmt->execute();
}
echo '<script> window.location.href="index.php?page=message"; </script>';

}





if ($_POST["a1"] != ""){
$ilanId = $_GET["ilanId"];
$sql = $db->query("SELECT * FROM ilanlar WHERE Id = '$ilanId'");
$a = $sql->fetch(PDO::FETCH_ASSOC);
$gonderen = $_SESSION['uye'];
$gonderilen = $_GET["gonderilecek"];
$konu = $_GET["ilanId"];
$tarih = date("d-m-Y H:i:s");
$mesaj = $_POST["a1"];

$sql444 = $db->query("SELECT * FROM engel WHERE engellenen = '$gonderen' and engelleyen = '$gonderilen'");
$a221 = $sql444->fetch(PDO::FETCH_ASSOC);
if ($a221 > 0){
	echo '<script> alert("Bu Üyeye Mesaj Gönderemezsiniz..!"); window.location.href="index.php?page=message"; </script>';
    exit;
	}

$sql = $db->prepare('INSERT INTO mesajlar (Id, gonderen,gonderilen, konu, mesaj, tarih, okundu, gonderensil, gonderilensil) VALUES (?,?,?,?,?,?,?,?,?)');
$sql->execute(array(null,$gonderen,$gonderilen,$konu, $mesaj, $tarih, 0, 0, 0));

$sql2 = $db->query("SELECT * FROM users WHERE Id = '{$gonderilen}'");
$b = $sql2->fetch(PDO::FETCH_ASSOC);
require 'PHPMailer-master/PHPMailerAutoload.php';
try {
$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host = $MailHost;
$mail->SMTPAuth = true;
$mail->Username = $MailUsername;
$mail->Password = $MailPassword;
$mail->Port = 587;
$mail->addAddress($b["eposta"]);
$mail->setFrom($MailUsername, $MailTitleName);
$mail->isHTML(true);
$mail->CharSet  ="utf-8";
$mail->Subject = 'Mesajınız Var';
$mail->Body    = 'Sayın '.$b["ad_soyad"].' <strong>'.$a["title"].'</strong> adlı ilan hakkında mesaj aldınız.<br>
Mesajınızı okumak için lütfen <a href="'.$base_url.'index.php">tıklayınız</a>';
$mail->send();
} catch (phpmailerException $e) {
echo $e->errorMessage();
} catch (Exception $e) {
echo $e->getMessage();
}

echo '<script> alert("Mesajınız gönderildi"); window.location.href="index.php?page=message"; </script>';
}
if ($_GET["engel"] == 1){
$id = $_GET["id"];
$engelleyen = $_SESSION["uye"];
$sql = $db->query("SELECT * FROM mesajlar WHERE (Id = '$id') and (gonderen = '$uye' or gonderilen = '$uye')");
$a = $sql->fetch(PDO::FETCH_ASSOC);
$engellenen = $a["gonderen"];
$sql21 = $db->query("SELECT * FROM users WHERE Id = '{$a['gonderen']}'");
$b1 = $sql21->fetch(PDO::FETCH_ASSOC);

$sql44 = $db->query("SELECT * FROM engel WHERE engellenen = '$engellenen' and engelleyen = '$engelleyen'");
$a22 = $sql44->fetch(PDO::FETCH_ASSOC);
if ($a22 > 0){
	echo '<script> alert("Bu Üyeyi Daha Önce Engellemişsiniz..!"); window.location.href="index.php?page=message"; </script>';
    exit;
	}

$sql19 = $db->prepare('INSERT INTO engel (Id, engellenen,engelleyen) VALUES (?,?,?)');
$sql19->execute(array(null,$engellenen,$engelleyen));

echo '<script> alert("'.$b1['ad_soyad'].' Engellendi. Artık Mesaj Alamıycaksınız"); window.location.href="index.php?page=message"; </script>';
}
?>
<style>
    td a {
        color: #000
    }
    hr {
        margin-top: 10px;
        margin-bottom: 10px;
        border: 0;
        border-top: 1px solid #eee;
    }
</style>
<link href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css" type="text/css">
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
    <div class="container top15">
        <div class="row no-gutter">
            <div class="col-xs-12 col-sm-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Mesajlar</div>
                    <div class="panel-body">
                        <?php include 'message_menu.php'; ?>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Mesaj</div>
                    <div class="panel-body">
                        <?
                        $id = $_GET["id"];
                        $uye = $_SESSION["uye"];
                        $sql = $db->query("SELECT * FROM mesajlar WHERE (Id = '$id') and (gonderen = '$uye' or gonderilen = '$uye')");
                        $a = $sql->fetch(PDO::FETCH_ASSOC);
                        if($uye == $a["gonderilen"]){
                        $sql = "UPDATE mesajlar SET okundu = '1' WHERE Id = '$id'";
                        $stmt = $db->prepare($sql);
                        $stmt->execute();
                        }
                        $sql2 = $db->query("SELECT * FROM users WHERE Id = '{$a['gonderen']}'");
                        $b = $sql2->fetch(PDO::FETCH_ASSOC);

                        $sql2 = $db->query("SELECT * FROM ilanlar WHERE Id = '{$a['konu']}'");
                        $row = $sql2->fetch(PDO::FETCH_ASSOC);
                        $resim = $db->query("SELECT * FROM images WHERE ilanId = '{$row['Id']}' ORDER BY s ASC LIMIT 1");
                        if ($resim->rowCount() == 0) {
                        $src = "img/no.png";
                        } else {
                        $r   = $resim->fetch(PDO::FETCH_ASSOC);
                        $src = $base_url . "fileserver/files/" . $row["Id"] . "/thumbnail/" . $r["name"];
                        }
                        $e = explode("-", $row["dates"]);
                        $il    = $db->query("SELECT * FROM city WHERE id = '{$row['city']}'");
                        $ilyaz = $il->fetch(PDO::FETCH_ASSOC);
                        $ilce    = $db->query("SELECT * FROM county WHERE id = '{$row['districts']}'");
                        $ilceyaz = $ilce->fetch(PDO::FETCH_ASSOC);

                        $mahalle    = $db->query("SELECT * FROM locality WHERE id = '{$row['locality']}'");
                        $mahalleyaz = $mahalle->fetch(PDO::FETCH_ASSOC);
                        echo '
                        <div class="adv' . $class . '" onclick="window.location.href=\'i-'.$row["Id"].'-'.slugify($row["title"]).'.html\'" style="cursor:pointer">
                        <div class="row no-gutter">
                        <div class="hidden-xs col-sm-2"><a href="i-'.$row["Id"].'-'.slugify($row["title"]).'.html"><img src="' . $src . '" class="img-thumbnail" width="100" /></a></div>
                        <div class="col-xs-12 col-sm-8"><strong style="font-size:14px">' . $row["title"] . '</strong>
                        <br><span style="font-size:12px"><i class="fa fa-clock-o" aria-hidden="true"></i> ' . $e[2] . '-' . $e[1] . '-' . $e[0] . ' <br><i class="fa fa-map-marker" aria-hidden="true"></i> ' . $ilyaz["il_adi"] . ' / ' . $ilceyaz["county_adi"] . ' / ' . $mahalleyaz["districtname"] . '</span>
                        </div>
                        <div class="hidden-xs col-sm-2" style="text-align:center; padding:5px"><a href="javascript:void(0)" class="btn btn-danger btn-block price">' . str_replace(",", ".", number_format($row["price"])) . ' ' . $row["exchange"] . '</a></div>
                        </div>
                        </div>
                        ';
                        ?>
                        <div class="panel panel-default">
                            <div class="panel-body"><? echo $b["ad_soyad"]; ?> <span class="badge"><? echo $b["telefon"]; ?></span> <span class="badge"><? echo $b["gsm"]; ?></span> <span class="pull-right"><a href="#" onClick="mengel()" class="btn btn-danger" style="padding:5px !important; font-size:12px">Üyeyi Engelle</a></span><span class="pull-right"><a href="#" onClick="msil()" class="btn btn-danger" style="padding:5px !important; font-size:12px">Mesajı Sil</a>&nbsp;&nbsp;</span></div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <strong><? echo $b["ad_soyad"]; ?></strong><span class="pull-right"><? echo $a["tarih"]; ?></span>
                                <hr>
                                <span style="font-size:12px"><? echo $a["mesaj"]; ?></span>
                            </div>
                        </div>
                        <div class="alert alert-danger">
                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Satıcıyla yüz yüze görüşmeden ve alacağınız ürünü görmeden kapora ödemeyin, para göndermeyin.
                        </div>
                        <form action="index.php?page=messageread&ilanId=<? echo $row["Id"]; ?>&gonderilecek=<? echo $a["gonderen"]; ?>" method="post">
                              <div class="form-group">
                                <label>Mesajınız</label>
                                <textarea name="a1" id="a1" class="form-control" style="height:150px"></textarea>
                            </div>
                            <input type="submit" value="Mesajı Gönder" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <p>&nbsp; </p>
        <script>
            $(document).ready(function () {
                $('#myTable').DataTable();
            });
            function msil() {
                var e = confirm("Mesajı silmek istediğinize eminmisiniz ?");
                if (e) {
                    window.location.href = "index.php?page=messageread&id=<? echo $id; ?>&delete=1";
                } else {

                }
            }
        </script>
<script>
            $(document).ready(function () {
                $('#myTable').DataTable();
            });
            function mengel() {
                var e = confirm("Artık Bu Kişiden Mesaj Almanız Engellenecek. Onaylıyormusunuz ?");
                if (e) {
                    window.location.href = "index.php?page=messageread&id=<? echo $id; ?>&engel=1";
                } else {

                }
            }
        </script>