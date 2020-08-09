<?
error_reporting(0);
session_start();
function rand_string( $length ) {
	$chars = "0123456789";	

	$size = strlen( $chars );
	for( $i = 0; $i < $length; $i++ ) {
		$str .= $chars[ rand( 0, $size - 1 ) ];
	}

	return $str;
}
$kod = rand_string(4);


$font="arial.ttf";
$_SESSION["kod"]=$kod;
$rsm=imagecreate(100,40);
$beyaz=ImageColorAllocate($rsm,rand(100,101),rand(100,101),rand(100,101));
$mavi=ImageColorAllocate($rsm,rand(0,1),rand(0,1),rand(0,1));
imagefill($rsm,4,5,$mavi);
imagettftext($rsm,20,0,20,30,$beyaz,$font,$kod);
header("Content-type: image/png");
ImagePNG($rsm);
?>