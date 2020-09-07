<?
$id = $_GET["id"];
$sql = $db->query("SELECT * FROM byazilar WHERE id = '$id'");
$az = $sql->fetch(PDO::FETCH_ASSOC);
?>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/tr_TR/sdk.js#xfbml=1&version=v2.8";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="container top15">
    <div class="row no-gutter">
        <div class="col-xs-3">
            <div class="panel panel-default">
                <div class="panel-heading">Kategoriler</div>
                <div class="panel-body">
                    <ul class="notranslate category">
                            <?
							$sql = $db->query("SELECT * FROM bkategoriler ORDER BY kategoriadi ASC");
							while ($a = $sql->fetch(PDO::FETCH_ASSOC)) {
							$sql2 = $db->query("SELECT * FROM byazilar WHERE kategoriId = '{$a['Id']}'");
							$say = $sql2->rowCount();
							echo '<li class="sub1"><a href="b-'.$a["Id"].'-'.slugify($a["kategoriadi"]).'.html">» ' . $a["kategoriadi"] . ' <span>( '.$say.' )</span></a></li>';
							}							 
							?>
                        </ul>
                </div>
            </div>
        </div>
        <div class="col-xs-9" style="padding-left:5px;">
            <div class="panel panel-default">
                <div class="panel-heading"><? echo $az["baslik"]; ?></div>
                <div class="panel-body">
				 <p style="font-size:12px !important"><span style="color:green"><i class="fa fa-clock-o"></i> <? echo $az["tarih"]; ?></span> <span class="pull-right"><script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-58400d4ed706c4e5"></script>
          <div class="addthis_inline_share_toolbox"></div>
          </span></p>
				<img src="uploads/<? echo $az["resim"]; ?>" width="200" style="padding:5px; border:solid 1px #eee; margin-right:15px; margin-bottom:15px" align="left"><? echo html_entity_decode($az["icerik"]); ?>
                </div></div>
				
				 <div class="panel panel-default">
                <div class="panel-heading">Yorumlar</div>
                <div class="panel-body"><div class="fb-comments" data-width="100%" data-href="<? echo $base_url; ?>blog-<? echo $id; ?>-<? echo slugify($az["title"]); ?>.html" data-numposts="5"></div></div>
				</div>
        </div>
    </div>
</div>
