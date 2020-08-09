<?
if ($_SESSION["uye"] == ""){ header("location: /login/"); }
if ($_GET['id'] != ""){
$id = $_GET["id"];
$uye = $_SESSION["uye"];
$sql2 = $db->query("SELECT * FROM bildirimler WHERE uyeId = '$uye' and odemeId = '{$id}'");
if ($sql2->rowCount() == 0){
$sql = $db->prepare('INSERT INTO bildirimler (Id, uyeId, odemeId) VALUES (?,?,?)');
$sql->execute(array(null, $uye, $id));
bildirimgonder($admin_mail, 2);
}
}
?>
<div class="container top15">
    <div class="panel panel-default">
        <div class="panel-heading">Ödeme Bildirimi</div>
        <div class="panel-body">
            <table class="table table-bordered">
                <thead>
                    <tr style="font-size:14px !important">
                        <td><b>Açıklama</b></td>
                        <td width="125" class="hidden-xs"><b>Tutar</b></td>
                        <td width="125"><b></b></td>
                    </tr>
                </thead>
                <tbody style="font-size:12px !important">
                    <?
                    $uye = $_SESSION['uye'];
                    $sql = $db->query("SELECT * FROM odemeler WHERE uyeId = '$uye' ORDER BY Id DESC");
                    while ($a = $sql->fetch(PDO::FETCH_ASSOC)){
                    $sql2 = $db->query("SELECT * FROM bildirimler WHERE uyeId = '$uye' and odemeId = '{$a['Id']}'");
                    if ($sql2->rowCount() == 0){
                    echo '
                    <tr >
                    <td style="padding-top:13px">'.$a["aciklama"].' <span class="visible-xs"><strong>'.$a["tutar"].' TL</strong></span></td>
                    <td class="hidden-xs" style="padding-top:13px">'.$a["tutar"].' TL</td>
                    <td><a href="index.php?page=odemebildirimi&id='.$a["Id"].'" onclick="return k()" class="btn btn-danger btn-sm" style=" font-size:12px; padding:5px 10px !important">Ödeme Bildirimi Yap</a></td>
                    </tr>
                    ';
                    } else {
                    echo '
                    <tr >
                    <td style="padding-top:13px">'.$a["aciklama"].' <span class="visible-xs"><strong>'.$a["tutar"].' TL</strong></span></td>
                    <td class="hidden-xs" style="padding-top:13px">'.$a["tutar"].' TL</td>
                    <td><a href="#" class="btn btn-success btn-sm" style=" font-size:12px; padding:5px 10px !important; cursor:default">Onay Bekliyor</a></td>
                    </tr>
                    ';
                    }
                    }
                    ?>

                </tbody>
            </table>
        </div></div></div>
<script>
    function k()
    {
        if (confirm("Bildirim yapmak istediğinize eminmisiniz ?")) {
            return true;
        } else {
            return false;
        }
    }
</script>