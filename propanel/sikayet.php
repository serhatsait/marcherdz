<?
$id = $_GET["id"];
$sql = $db->query("SELECT * FROM sikayet WHERE Id = '$id'");
$a = $sql->fetch(PDO::FETCH_ASSOC);
$sql2 = $db->query("SELECT * FROM users WHERE Id = '{$a['uyeId']}'");
$b = $sql2->fetch(PDO::FETCH_ASSOC);
$sql3 = $db->query("SELECT * FROM ilanlar WHERE Id = '{$a['ilanId']}'");
$c = $sql3->fetch(PDO::FETCH_ASSOC);
$sql4 = $db->query("SELECT * FROM users WHERE Id = '{$c['uyeId']}'");
$d = $sql4->fetch(PDO::FETCH_ASSOC);
$gor = "../i-".$c["Id"]."-".slugify($c["title"]).".html";
?>
<section class="content-header">
  <h1>İlan Yönetimi<small>Şikayetler</small> </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Page d'accueil</a></li>
    <li>İlan Yönetimi</li>
    <li class="active"><a href="index.php?page=sikayetler">Şikayetler</a></li>
  </ol>
</section>
<section class="content">
<? echo $err; ?>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Şikayet</h3>
    </div>
    <form role="form" action="" method="post">
      <div class="box-body"> 
       <div class="form-group">
          <label>İlan</label><br>
          <? echo '<a href="'.$gor.'" target="_blank">'.$c["title"].'</a>'; ?>
        </div>
        <div class="form-group">
          <label>Şikayet Eden</label><br>
          <? echo '<a href="index.php?page=uye&id='.$a["uyeId"].'">'.$b["ad_soyad"].'</a>'; ?>
        </div>
        <div class="form-group">
          <label>İlan Sahibi</label><br>
          <? echo '<a href="index.php?page=uye&id='.$d["Id"].'">'.$d["ad_soyad"].'</a>'; ?>
        </div>
        <div class="form-group">
          <label>Mesaj</label><br>
          <? echo ''.$a["mesaj"].''; ?>
        </div>
      </div>
   
    </form>
  </div>
</section>
