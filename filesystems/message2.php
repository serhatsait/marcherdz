<?
if ($_SESSION["uye"] == ""){ header("location: /login/"); }
?>
<style> td a { color:#000 } </style>
<link href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css" type="text/css">
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
    <div class="container top15">
        <div class="row no-gutter">
            <div class="col-sm-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Mesajlar</div>
                    <div class="panel-body">
                        <?php include 'message_menu.php'; ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Gönderilen Mesajlar</div>
                    <div class="panel-body">
                        <?
                        $uye = $_SESSION["uye"];
                        $sql = $db->query("SELECT * FROM mesajlar WHERE gonderen = '$uye' and gonderensil = '0' ORDER BY Id DESC");
                        if ($sql->rowCount() == 0){
                        echo '<div class="alert alert-danger"><strong>Uyarı !</strong> Gönderilen mesajınız bulunmamaktadır.</div>';
                        } else {
                        ?>
                        Okunmamış <strong><? echo $sql->rowCount(); ?></strong> adet mesajınız bulunmaktadır.<br><br>
                        <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" style="font-size:12px">
                            <thead>
                                <tr>
                                    <th width="32"></th>
                                    <th>Konu</th>
                                    <th class="hidden-xs" width="150" style="text-align:center !important">Gönderen</th>
                                    <th class="hidden-xs" width="150" style="text-align:center !important">Tarih</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?
                                while ($row = $sql->fetch(PDO::FETCH_ASSOC)){
                                //$row["tarih"] = str_replace(" ","<br>",$row["tarih"]);
                                $sql2 = $db->query("SELECT * FROM users WHERE Id = '{$row['gonderen']}'");
                                $b = $sql2->fetch(PDO::FETCH_ASSOC);
                                if ($row["okundu"] == "0"){
                                $ikon = '<i class="fa fa-envelope-o" aria-hidden="true"></i>';
                                $stil = "";
                                } else {
                                $ikon = '<i class="fa fa-envelope-o" aria-hidden="true"></i>';
                                $stil = "";
                                }
                                $sql3 = $db->query("SELECT * FROM ilanlar WHERE Id = '{$row['konu']}'");
                                $c = $sql3->fetch(PDO::FETCH_ASSOC);
                                echo '
                                <tr>
                                <td>'.$ikon.'</td>
                                <td'.$stil.'><a href="index.php?page=messageread2&id='.$row["Id"].'">'.tr_ucwords($c["title"]).'</a></td>
                                <td'.$stil.' class="hidden-xs" align="center"><a href="index.php?page=messageread2&id='.$row["Id"].'">'.$b["ad_soyad"].'</a></td>
                                <td'.$stil.' class="hidden-xs" align="center"><a href="index.php?page=messageread2&id='.$row["Id"].'">'.$row["tarih"].'</a></td>
                                </tr>
                                ';
                                }
                                ?>
                            </tbody>
                        </table>
                        <? } ?>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function () {
                $('#myTable').DataTable();
            });
        </script>