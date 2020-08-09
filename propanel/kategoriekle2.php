
<section class="content-header">
  <h1> Kategori Yönetimi<small>Kategori Ekle</small> </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
    <li><i class="fa fa-dashboard"></i> Kategori Yönetimi</li>
    <li class="active">Kategori Ekle</li>
  </ol>
</section>
<section class="content"> <? echo $err; ?>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Kategori Ekle</h3>
    </div>
    <form role="form" action="" method="post">
	<? if ($_GET["tip"] == ""){ ?>
	  <div class="box-body">
	  <div class="form-group">
	  <label>Kategori Tipi</label>
	  <select onchange="location = this.options[this.selectedIndex].value;" class="form-control">
		 <option value="#">Seçiniz</option>
		 <option value="index.php?page=kategoriekle2&tip=0">İlan</option>
		 <option value="index.php?page=kategoriekle2&tip=1">Rehber</option>
		</select>
	  </div>
	  </div>
	<?
	} else {
	?>
      <div class="box-body">
      <strong>Eklenecek üst kategori :</strong> <span id="sec">Kategori seçilmedi.</span> <br><br>
        <select id="cat1" name="cat1" class="form-control" size="10" style="max-width: 180px; float:left; font-size:12px" onchange="cats1()">
          <?php
				$tip = $_GET["tip"];
                $sql = $db->query("SELECT * FROM category WHERE ustkategoriId = '0' and tip = '$tip' ORDER BY sira ASC");
                while ($k = $sql->fetch(PDO::FETCH_OBJ)) {
                    echo '<option value="' . $k->Id . '">' . $k->kategori_adi . '</option>';
                }
                ?>
        </select>
        <span id="sn"></span> <span id="sn2"></span> <span id="sn3"></span> <span id="sn4"></span> <span id="sn5"></span> <span id="sn6"></span> <span id="bt"></span>
        <input type="hidden" name="kategori" id="kategori" value="" >
      </div>
      <div class="box-footer">
        <button type="button" class="btn btn-primary" onClick="ekle()">Kategori Ekle</button>
      </div>
	<? } ?>
    </form>
  </div>
</section>
<script >
 (function($) {
 $("#cat1").click(function () {
        $("#bt").html('');
        var e = $("#cat1").val();
        $("#kategori").val(e);
		yaz();
        var b = 2;
		var c = <? echo $_GET["tip"]; ?>;
        if (e != null && e !== undefined) {
            $.post('kategorigetir.php', {data1: e, data2: b, data3: c}, function (output) {
                if (output != 1) {
                    $("#sn").html(output);
                } else {
                }
            });
        }
    });	
 })(jQuery);
function cats1() {
    $("#sn2").html("");
    $("#sn3").html("");
    $("#sn4").html("");
    $("#sn5").html("");
    $("#sn6").html("");
}
function cats2() {
    $("#sn3").html("");
    $("#sn4").html("");
    $("#sn5").html("");
    $("#sn6").html("");

    $("#bt").html('');
    var e = $("#cat2").val();
    $("#kategori").val(e);
	yaz();
    var b = 3;
	var c = <? echo $_GET["tip"]; ?>;
    if (e != null && e !== undefined) {
        $.post('kategorigetir.php', {data1: e, data2: b, data3: c}, function (output) {
            if (output != 1) {
                $("#sn2").html(output);
            } else {
                $("#sn2").html("");
            }
        });
    }
}
function cats3() {
    $("#sn4").html("");
    $("#sn5").html("");
    $("#sn6").html("");
    $("#bt").html('');
    var e = $("#cat3").val();
    $("#kategori").val(e);
    var b = 4;
	var c = <? echo $_GET["tip"]; ?>;
    if (e != null && e !== undefined) {
        $.post('kategorigetir.php', {data1: e, data2: b, data3: c}, function (output) {
            if (output != 1) {
                $("#sn3").html(output);
            } else {
            }
        });
    }
}
function cats4() {
    $("#sn5").html("");
    $("#sn6").html("");
    $("#bt").html('');
    var e = $("#cat4").val();
    $("#kategori").val(e);
	yaz();
    var b = 5;
	var c = <? echo $_GET["tip"]; ?>;
    if (e != null && e !== undefined) {
        $.post('kategorigetir.php', {data1: e, data2: b, data3: c}, function (output) {
            if (output != 1) {
                $("#sn4").html(output);

            } else {
            }
        });
    }
}
function cats5() {
    $("#sn6").html("");
    $("#bt").html('');
    var e = $("#cat5").val();
    $("#kategori").val(e);
	yaz();
    var b = 6;
	var c = <? echo $_GET["tip"]; ?>;
    if (e != null && e !== undefined) {
        $.post('kategorigetir.php', {data1: e, data2: b, data3: c}, function (output) {
            if (output != 1) {
                $("#sn5").html(output);

            } else {
            }
        });
    }
}
function cats6() {

    $("#bt").html('');
    var e = $("#cat6").val();
    $("#kategori").val(e);
	yaz();
    var b = 7;
	var c = <? echo $_GET["tip"]; ?>;
    if (e != null && e !== undefined) {
        $.post('kategorigetir.php', {data1: e, data2: b, data3: c}, function (output) {
            if (output != 1) {
                $("#sn6").html(output);

            } else {
            }
        });
    }
}
function ilanverbutton() {
    var e = $("#kategori").val();
    $("#bt").html('<a href="/index.php?page=add2&id=' + e + '" class="btn btn-primary">Devam >></a>');
	$("#bt").focus();
}
function yaz()
{
	var e = document.getElementById('kategori').value;
	 $.post('yaz.php', {data1: e}, function (output) {
     $("#sec").html(output);
    });
}

function ekle()
{
	if (document.getElementById('kategori').value == ""){
		alert("Üst kategori seçiniz");	
	} else {
		var e = document.getElementById('kategori').value;
		window.location.href = "index.php?page=kategoriekle3&id="+e;	
	}
	
}
</script>