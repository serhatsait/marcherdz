<?
if ($_SESSION["uye"] == ""){ header("location: /login/"); }
?>
<div class="container top15">
    <div class="row no-gutter">
        <div class="col-xs-12 col-sm-3">
            <div class="panel panel-default">
                <div class="panel-heading">İhale İşlemleri</div>
                <div class="panel-body">
                    <?php include 'ihale_menu.php'; ?>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-9">
            <div class="panel panel-default">
                <div class="panel-heading">Kaybettiğim İhaleler</div>
                <div class="panel-body">
                    <?
                    $uye = $_SESSION["uye"];
                    $sql = $db->query("SELECT * FROM ihaleler WHERE uyeId = '$uye' and kazandi = '0' ORDER BY Id DESC");
                    if ($sql->rowCount() == 0){
                    echo '<div class="alert alert-danger" style="margin-bottom:0px !important"><strong>Uyarı:</strong> Kaybettiğiniz ihale  bulunmamaktadır</div>';
                    } else {
                    ?>
                    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" style="font-size:12px">
                        <thead>
                            <tr>
                                <th width="100" style="text-align:center !important">Tarih</th>
                                <th style="text-align:center !important">İlan</th>
                                <th width="100"  style="text-align:center !important">Durum</th>
                                <th width="125" style="text-align:center !important"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?
                            while ($a = $sql->fetch(PDO::FETCH_ASSOC)){
                            
                            $sql2 = $db->query("SELECT * FROM ilanlar WHERE Id = '{$a['ilanId']}'");
                            $b = $sql2->fetch(PDO::FETCH_ASSOC);
							$t = explode("-",$a["tarih"]);
							$sql3 = $db->query("SELECT * FROM users WHERE Id = '{$b['uyeId']}'");
							$c = $sql3->fetch(PDO::FETCH_ASSOC);
                            echo '
                            <input type="hidden" name="m'.$a["Id"].'" id="m'.$a["Id"].'" value="<strong>Adı Soyad</strong> : '.$c["ad_soyad"].'<br><strong>Telefon</strong> : '.$c["telefon"].'<br><strong>GSM</strong> : '.$c["gsm"].'<br>">
							<tr>
                            <td><center>'.$t[2].'-'.$t[1].'-'.$t[0].'</center></td>
                            <td><center>'.$b["title"].'</center></td>
                            <td><center>Kaybettiniz</center></td>
                            <td>
                            <div class="dropdown">
                            <button class="btn btn-danger btn-block" style="padding:5px !important; font-size:12px !important" type="button" onclick="ih('.$a["Id"].')">İlan Sahibinin İletişim Bilgileri</button>
                            
                            </div>
                            </td>
                            </tr>
                            ';
                            }
                            ?>
                        </tbody></table>
                    <? } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function ih(e)
{
	var icerik = $("#m"+e).val();
	$("#error").html(icerik);
	$('#myModal').modal("show");	
}
</script>
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content panel-warning">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">İlan Sahibi Bilgileri</h4>
      </div>
      <div class="modal-body">
        <p id="error"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
      </div>
    </div>
  </div>
</div>

