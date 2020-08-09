<?
if ($_SESSION["uye"] == ""){ header("location: /login/"); }
$uye = $_SESSION["uye"];
$err = "";
if ($_SESSION["uye"] == ""){ header("location: /login"); }
if ($_POST["a1"] != ""){
$a1 = $_POST["a1"];
$a2 = $_POST["a2"];
$a3 = $_POST["a3"];
$sql = $db->query("SELECT * FROM banka WHERE uyeId = '$uye'");
if ($sql->rowCount() == 0){
$sql = $db->prepare('INSERT INTO banka (Id, uyeId, bankaadi, iban, alici) VALUES (?,?,?,?,?)');
$sql->execute(array(null, $uye, $a1, $a2, $a3));
} else {
$sql = "UPDATE banka SET bankaadi = '$a1', iban = '$a2', alici = '$a3' WHERE uyeId = '$uye'";
$stmt = $db->prepare($sql);
$stmt->execute();
}
$err = '<div class="alert alert-success"><strong>Uyarı!</strong> Banka bilgileriniz güncellendi</div>';
}
$sql = $db->query("SELECT * FROM banka WHERE uyeId = '$uye'");
$row = $sql->fetch(PDO::FETCH_ASSOC);
?>


<div class="container top15">
    <div class="row no-gutter">
        <div class="col-xs-3">
            <div class="panel panel-default">
                <div class="panel-heading">Üyelik Bilgilerim</div>
                <div class="panel-body">
                    <?php include 'member_menu.php'; ?>
                </div>
            </div>
        </div>
        <div class="col-xs-9">
            <div class="panel panel-default">
                <div class="panel-heading">Banka Bilgilerim</div>
                <div class="panel-body"><? echo $err; ?>
                    <form action="" method="post" onSubmit="return k()">
                        <div class="form-group">
                            <label>Banka Adı :</label>
                            <input type="text" name="a1" class="form-control" placeholder="Bankanızın Adı" required="required" value="<? echo $row["bankaadi"]; ?>">
                    </div>
                    <div class="form-group">
                        <label>IBAN :</label>
                        <input type="text" name="a2" id="a2" class="form-control" placeholder="IBAN no" required="required" onKeyUp="er()" value="<? echo $row["iban"]; ?>">
                </div>
                <div class="form-group">
                    <label>Alıcı Ad Soyad:</label>
                    <input type="text" name="a3" id="a3" class="form-control" placeholder="Alıcı Ad Soyad" required="required" value="<? echo $row["alici"]; ?>" >
            </div>
            <input type="submit" class="btn btn-primary" value="Kaydet">
        </form>
    </div>
</div>
</div>
</div>
</div>
<script>
    $(document).ready(function () {
        $('#a2').mask('SS00 0000 0000 0000 0000 00', {
            placeholder: '____ ____ ____ ____ ____ __'
        });
    });
    function k()
    {
        if ($("#a2").val().length != 27) {
            document.getElementById("a2").setCustomValidity("Geçersiz IBAN");
            return false;
        } else {
            document.getElementById("a2").setCustomValidity('');
            return true;
        }
    }
    function er()
    {
        document.getElementById("a2").setCustomValidity('');
    }
</script>