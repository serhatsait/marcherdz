<?
if ($_SESSION["uye"] == ""){ header("location: /login/"); }
$id = $_GET["id"];
$uye = $_SESSION['uye'];
if ($_POST["a1"] != ""){
$a1 = $_POST["a1"];
$sql = $db->prepare('INSERT INTO sikayet (Id, uyeId, ilanId, mesaj) VALUES (?,?,?,?)');
$sql->execute(array(null,$uye,$id,$a1));
$sql = $db->query("SELECT * FROM ilanlar WHERE Id = '$id'");
$a = $sql->fetch(PDO::FETCH_ASSOC);
$link = "i-".$a["Id"]."-".slugify($a["title"]).".html";
echo '<script> alert("Şikayetiniz gönderildi"); window.location.href="'.$link.'"; </script>';
}
?>

<div class="container top15">
    <div class="panel panel-default">
        <div class="panel-heading">Şikayet</div>
        <div class="panel-body">
            <?
            $id = $_GET["id"];
            $uye = $_SESSION["uye"];
            $sql2 = $db->query("SELECT * FROM ilanlar WHERE Id = '{$id}'");
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
            <div class="col-xs-2"><a href="i-'.$row["Id"].'-'.slugify($row["title"]).'.html"><img src="' . $src . '" class="img-thumbnail" width="100" /></a></div>
            <div class="col-xs-8"><strong style="font-size:14px">' . $row["title"] . '</strong>
            <br><span style="font-size:12px"><i class="fa fa-clock-o" aria-hidden="true"></i> ' . $e[2] . '-' . $e[1] . '-' . $e[0] . ' <br><i class="fa fa-map-marker" aria-hidden="true"></i> ' . $ilyaz["il_adi"] . ' / ' . $ilceyaz["county_adi"] . ' / ' . $mahalleyaz["districtname"] . '</span>
            </div>
            <div class="col-xs-2" style="text-align:center; padding:5px"><a href="javascript:void(0)" class="btn btn-danger btn-block price">' . str_replace(",", ".", number_format($row["price"])) . ' ' . $row["exchange"] . '</a></div>
            </div>
            </div>';
            ?>
            <form action="index.php?page=sikayet&id=<? echo $id; ?>" method="post">
                <div class="form-group">
                    <label>Şikayetiniz</label>
                    <textarea name="a1" id="a1" class="form-control" style="height:150px"></textarea>
                </div>
                <input type="submit" value="Şikayeti Gönder" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>