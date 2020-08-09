<?
$sql = $db->query("SELECT * FROM sss");
while ($az = $sql->fetch(PDO::FETCH_ASSOC)){
echo '
<div class="container top15">
<div class="panel panel-default">
	<div class="panel-heading">'.$az["soru"].'</div>
	<div class="panel-body">
	'.$az["cevap"].'
	</div></div>
</div>';
}
?>