<div class="container top15">
   

       
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-map-marker" aria-hidden="true"></i> Haritalı İlanlar</div>
                <div class="panel-body">
				<?php
include '../../functions.php';

$locations=array();
    $query =  $db->query('SELECT * FROM ilanlar WHERE firmadi IS NULL');
        while( $row = $query->fetch() ){

            $nama_kabkot = $row['title'];
            $longitude = $row['lng'];                              
            $latitude = $row['lat'];
			$fiyat = $row["price"];
			$Id = $row["Id"];
            /* Each row is added as a new array */
            $locations[]=array( 'Id'=>$Id, 'price'=>$fiyat, 'title'=>$nama_kabkot, 'lat'=>$latitude, 'lng'=>$longitude );
        }
        /* Convert data to json */
        
		
    ?>
 <!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCpxv2EoVBP72pIqOHnzehHqTkWRWCw1Nc"></script> 
	<title></title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 400px;
		width: 100%;
      }
      
    </style>
  </head>

  <body>
    <div id="map"></div>
	   
    <script type="text/javascript">
    var map;
    var Markers = {};
    var infowindow;
    var locations = [
        <?php for($i=0;$i<sizeof($locations);$i++){ $j=$i+1;?>
        [
            'Premium İlan Harita İlanları',
            '<a href="i-<?php echo $locations[$i]['Id'];?>-<?php echo slugify($locations[$i]['title']);?>.html"><?php echo $locations[$i]['title'];?></a><br><center><strong><?php echo number_format($locations[$i]['price']);?> TL</strong><center>',
            <?php echo $locations[$i]['lat'];?>,
            <?php echo $locations[$i]['lng'];?>,0
			]
			<?php if($j!=sizeof($locations))echo ","; }?>
    ];
    var origin = new google.maps.LatLng(locations[0][2], locations[0][3]);

    function initialize() {
      var mapOptions = {
        zoom: 6,
        center: origin
      };

      map = new google.maps.Map(document.getElementById('map'), mapOptions);

        infowindow = new google.maps.InfoWindow();

        for(i=0; i<locations.length; i++) {
            var position = new google.maps.LatLng(locations[i][2], locations[i][3]);
            var marker = new google.maps.Marker({
                position: position,
                map: map,
            });
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent(locations[i][1]);
                    infowindow.setOptions({maxWidth: 200});
                    infowindow.open(map, marker);
                }
            }) (marker, i));
            Markers[locations[i][4]] = marker;
        }

        locate(0);

    }

    function locate(marker_id) {
        var myMarker = Markers[marker_id];
        var markerPosition = myMarker.getPosition();
        map.setCenter(markerPosition);
        google.maps.event.trigger(myMarker, 'click');
    }

    google.maps.event.addDomListener(window, 'load', initialize);

    </script>
    
    </body>
</html>
                </div></div>
        </div>
		<script>
function cat(){
	var e = $("#zx1").val();
	$.post('filesystems/cat.php',{id:e},function(output){
		$("#zx2 option").remove();
		$("#zx2").append(output);
	});	
}
</script>		
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Detaylı Arama</h4>
      </div>
      <div class="modal-body">

	
		

	<form action="index.php" method="get">
	<input type="hidden" name="page" value="category">
	<input type="hidden" name="sayfa" value="1">
	<input type="hidden" name="daralt" value="1">
      <div class="row no-pad">
	  <div class="col-xs-6" style="width: 50%;">
	  <div class="form-group">
		<label>Kategori</label>
		<select class="form-control" name="id">
		<?
			$sql = $db->query("SELECT * FROM category WHERE ustkategoriId = '0'");
			while ($a = $sql->fetch(PDO::FETCH_ASSOC)) {
			echo '<option value="'.$a["Id"].'">' . $a["kategori_adi"] . '</option>';
			}
		?>
		</select>
	  </div>
	  </div>
	  <div class="col-xs-6" style="width: 50%;">
	 <div class="form-group">
                            <label>İl :</label>
                            <select name="il" id="il" class="form-control il" onchange="districts()" data-role="none" >
                                <option value="">Tümü</option>
                                <?php
                                $sql2 = $db->query("SELECT * FROM city ORDER BY il_adi ASC");
                                while ($i = $sql2->fetch(PDO::FETCH_OBJ)) {
                                    echo '<option value="' . $i->id . '"';
                                    if ($_GET['il'] == $i->id) {
                                        echo ' selected="select"';
                                    }
                                    echo '>' . $i->il_adi . '</option>';
                                }
                                ?>
                            </select>
                        </div>
	  </div>
	  <div class="col-xs-6" style="width: 50%;">
	  <div class="form-group">
                            <label>İlçe :</label>
                           <select name="ilce" id="ilce" class="form-control ilce" onchange="localitys()" data-role="none">
                                <option value="">Tümü</option>
                                <?php
                                $il = $_GET['il'];
                                $sql2 = $db->query("SELECT * FROM county WHERE il_id = '$il' ORDER BY county_adi ASC");
                                while ($ix = $sql2->fetch(PDO::FETCH_OBJ)) {
                                    echo '<option value="' . $ix->id . '"';
                                    if ($_GET['ilce'] == $ix->id) {
                                        echo ' selected="select"';
                                    }
                                    echo '>' . $ix->county_adi . '</option>';
                                }
                                ?>
                            </select>
                        </div>
	  </div>

	  <div class="col-xs-6" style="width: 50%;">
	  <label class="">Fiyat</label>
	   <div class="row no-gutter">
                                <div class="col-xs-6" style="width: 50%;">
                                    <div class="form-group">
                                        <input type="text" name="fiyat1" value="<? echo $_GET["fiyat1"]; ?>" class="form-control money" placeholder="minimum">
                                </div>
                            </div>
                            <div class="col-xs-6" style="width: 50%;">
                                <div class="form-group">
                                    <input type="text" name="fiyat2" class="form-control money" placeholder="maksimum" value="<? echo $_GET["fiyat2"]; ?>">
                            </div>
                        </div>
                    </div>
	  </div>
	  <div class="col-xs-1"><input type="submit" style="width:565px;margin-bottom:7px;" class="btn btn-danger" value="Aramaya Başla"></div>
	  </div>
	</div>
	</form>
  </div>
        </div>
    </div>