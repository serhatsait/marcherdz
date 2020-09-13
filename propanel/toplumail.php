<?
error_reporting(0);
if ($_SESSION["siteayarlari"] == 1){?>

<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<section class="content-header">
<h1> Üyelere Toplu Mail Gönder </h1>
<ol class="breadcrumb">
  <li><a href="index.php"><i class="fa fa-dashboard"></i> Page d'accueil</a></li>
  <li class="active">Toplu Mail</li>
</ol>
</section>
<section class="content">


  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Toplu Mail Gönder</h3>
    </div>
   					
<form name="feedback" action="gonder.php" method="post" class="form-horizontal">
<fieldset>

<div class="control-group">
							  
							</div>
							<div class="control-group">
							  <label class="control-label" for="textarea2">Mail Konusu</label>
							  <div class="controls">
								<input name="name" type="text" style="width:300px;" value=""> * Site Adı Mesajın Konusuna Otomatik Olarak Eklenecektir.
								</div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="textarea2">Mail İçeriği</label>
							  <div class="controls">
								<textarea name="feedback" class="ckeditor"></textarea>
								</div>
							</div>
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Maili Gönder</button>
							</div>
</fieldset>
</form>							
					</div>
				</div>
  
</section>
<?}?>
Erişim İzni Yok..!