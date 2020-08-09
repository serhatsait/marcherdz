<?
if ($_SESSION["uye"] == ""){ header("location: /login/"); }
$id = $_GET["id"];
$uye = $_SESSION['uye'];
$sql = $db->query("SELECT * FROM yorumlar WHERE siparisId = '$id'");
if ($sql->rowCount() > 0){ header("location: index.php?page=alisislemlerim"); }
$sql = $db->query("SELECT * FROM siparisler WHERE (alici = '$uye' or satici = '$uye') and Id = '$id'");
$a = $sql->fetch(PDO::FETCH_ASSOC);
$sql2 = $db->query("SELECT * FROM users WHERE Id = '{$a['satici']}'");
$b = $sql2->fetch(PDO::FETCH_ASSOC);
if ($_POST['a1'] != ""){
$a1 = $_POST["a1"];
$a2 = $_POST["a2"];
$a3 = $_POST["a3"];
$id = $_GET['id'];
$sql = $db->prepare('INSERT INTO yorumlar (Id, siparisId, alici, puan, sonuc, yorum) VALUES (?,?,?,?,?,?)');
$sql->execute(array(null, $id, $uye, $a1, $a2, $a3));
header("location: index.php?page=alisislemlerim&s=1");
}
?>
<div class="container top15">
    <div class="row no-gutter">
        <div class="col-xs-3">
            <div class="panel panel-default">
                <div class="panel-heading">Alış İşlemleri</div>
                <div class="panel-body">
                    <?php include 'alis_menu.php'; ?>
                </div>
            </div>
        </div>
        <div class="col-xs-9">
            <div class="panel panel-default">
                <div class="panel-heading">Sipariş Bilgileri</div>
                <div class="panel-body">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td width="175">Tarih</td>
                                <td>: <? echo $a["tarih"]; ?></td>
                            </tr>
                            <tr>
                                <td width="175">Satıcı</td>
                                <td>: <? echo $b["ad_soyad"]; ?></td>
                            </tr>
                            <tr>
                                <td width="175">Tutar</td>
                                <td>: <? echo $a["fiyat"]; ?> TL</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Ürün</div>
                <div class="panel-body">
                    <?
                    $sql2 = $db->query("SELECT * FROM ilanlar WHERE Id = '{$a['ilanId']}'");
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
                    <div class="adv' . $class . '">
                    <div class="row no-gutter">
                    <div class="col-xs-1"><a href="i-'.$row["Id"].'-'.slugify($row["title"]).'.html"><img src="' . $src . '" class="img-thumbnail" width="100" /></a></div>
                    <div class="col-xs-9"><strong style="font-size:14px">' . $row["title"] . '</strong>
                    <br><span style="font-size:12px"><i class="fa fa-clock-o" aria-hidden="true"></i> ' . $e[2] . '-' . $e[1] . '-' . $e[0] . ' <br><i class="fa fa-map-marker" aria-hidden="true"></i> ' . $ilyaz["il_adi"] . ' / ' . $ilceyaz["county_adi"] . ' / ' . $mahalleyaz["districtname"] . '</span>
                    </div>
                    <div class="col-xs-2" style="text-align:center; padding:5px"><a href="javascript:void(0)" class="btn btn-danger btn-block price">' . str_replace(",", ".", number_format($row["price"])) . ' ' . $row["exchange"] . '</a></div>
                    </div>
                    </div>';
                    ?>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Puan & Yorum</div>
                <div class="panel-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label>Puan :</label>
                            <select name="a1" id="a1" class="form-control" required>
                                <option value="">Seçiniz</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Alışverişinizden memnun kaldınız mı? :</label>
                            <select name="a2" id="a2" class="form-control" required>
                                <option value="">Seçiniz</option>
                                <option value="0">Hayır</option>
                                <option value="1">Evet</option>
                                <option value="2">Kararsızım</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Yorumunuz :</label>
                            <textarea name="a3" id="a3" class="form-control" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Gönder</button>
                    </form>
                </div></div>
        </div>
    </div>
</div>
<script>
    function kr()
    {
        if (confirm("Kargoyu onaylamak istediğinize eminmisiniz ?")) {
            return true;
        } else {
            return false;
        }
    }
</script>