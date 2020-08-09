<?php

include '../functions.php';
$id = $_POST["id"];
$uye = $_SESSION["uye"];
$sql = $db->query("SELECT * FROM favori WHERE uyeId = '$uye' and ilanId = '$id'");
if ($sql->rowCount() == 0) {
    $sql = $db->prepare('INSERT INTO favori (Id, uyeId, ilanId) VALUES (?,?,?)');
    $sql->execute(array(null, $uye, $id));
}
?>