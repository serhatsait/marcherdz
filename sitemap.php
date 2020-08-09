<?
include 'functions.php';
header('Content-type: text/xml');
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
$bugun = date("Y-m-d");
$sqlsor = $db->query("SELECT * FROM ilanlar WHERE (bitis >= '$bugun') and confirm = '1' ORDER BY Id DESC LIMIT 10");
while ($row = $sqlsor->fetch(PDO::FETCH_ASSOC)) {
echo '
<url>
	<loc>'.$base_url.'i-'.$row["Id"].'-'.slugify($row["title"]).'.html</loc>
	<lastmod>'.date("Y").'-'.date("m").'-'.date("d").'T'.date("H:i:s").'+00:00</lastmod>
	<changefreq>daily</changefreq>
	<priority>0.5000</priority>
</url>';
}
$sql = $db->query("SELECT * FROM magazalar WHERE onay = '1' and bitis >= '$bugun' ORDER BY Id DESC LIMIT 18");
while ($a = $sql->fetch(PDO::FETCH_ASSOC)){
$b = str_replace("http://","",$base_url);
$b = rtrim($b,"/");	
echo '
<url>
	<loc>http://'.$a["adres"].'.'.$b.'</loc>
	<lastmod>'.date("Y").'-'.date("m").'-'.date("d").'T'.date("H:i:s").'+00:00</lastmod>
	<changefreq>daily</changefreq>
	<priority>0.5000</priority>
</url>';	
}
echo '</urlset>';
?>