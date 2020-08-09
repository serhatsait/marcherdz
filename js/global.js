function repeat(input) {
    var n = input.name;
    var n = n.replace("_repeat", "");
    if (input.value != document.getElementById(n).value) {
        input.setCustomValidity('Tekrar hatalı');
    } else {
        input.setCustomValidity('');
    }
}
function error() {
    $("#errors").modal()
}
	
$(document).ready(function () {
	$(".fancybox").fancybox({
		openEffect	: 'none',
		closeEffect	: 'none'
	});
	$( "#buyuk" ).click(function() {
	$( "#resim0" ).trigger( "click" );
	});
	
	$( ".kucuk" ).click(function() {
	var e = $(this).attr("src");
	var e = e.replace("thumbnail/", "");
	$("#main_src").attr("src",e);
	});
	
    
	$(".kartno").mask("9999-9999-9999-9999");
    $('.money').mask('000.000.000.000.000', {reverse: true});
    $(".phone").on("blur", function () {
        var last = $(this).val().substr($(this).val().indexOf("-") + 1);
        if (last.length == 3) {
            var move = $(this).val().substr($(this).val().indexOf("-") - 1, 1);
            var lastfour = move + last;
            var first = $(this).val().substr(0, 9);

            $(this).val(first + '-' + lastfour);
        }
    });

    $(".birthday").mask("99/99/9999", {clearIfNotMatch: true});
 	$(".kartno").mask("9999-9999-9999-9999",{clearIfNotMatch: true});
	$(".skt").mask("99/99", {clearIfNotMatch: true});
    $(".cvc").mask("999", {clearIfNotMatch: true});
	$(".phone").mask("(0999) 999 9999", {clearIfNotMatch: true});
    $('.se').selectpicker({
        style: 'btn-info',
        size: 4

    });
	$("#cat1").on('change',function() {
        $("#bt").html('');
        var e = $("#cat1").val();
		if (e != ""){
        $("#kategori").val(e);
        var b = 2;
        if (e != null && e !== undefined) {
            $.post('filesystems/kategorigetir.php', {data1: e, data2: b}, function (output) {
                if (output != 1) {
                    $("#sn").html(output);
                } else {
                    ilanverbutton();
                }
            });
        }
		}
    });
	
$('.carousel').carousel({
 		interval: 4000
 	});
    $('.summernote').summernote({
        height: 300,
        minHeight: 200,
        maxHeight: 200,
        focus: false,
        lang: 'tr-TR',
        toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'italic', 'underline', 'clear']],
        ['fontname', ['fontname']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'hr']],
        ['view', ['fullscreen', 'codeview']],
        ['help', ['help']]
        ],
    });
});
function cat1() {
    $("#sn2").html("");
    $("#sn3").html("");
    $("#sn4").html("");
    $("#sn5").html("");
    $("#sn6").html("");
}
function cat2() {
    $("#sn3").html("");
    $("#sn4").html("");
    $("#sn5").html("");
    $("#sn6").html("");

    $("#bt").html('');
    var e = $("#cat2").val();
    $("#kategori").val(e);
    var b = 3;
    if (e != null && e !== undefined) {
        $.post('filesystems/kategorigetir.php', {data1: e, data2: b}, function (output) {
            if (output != 1) {
                $("#sn2").html(output);
            } else {
                $("#sn2").html("");
                ilanverbutton();
            }
        });
    }
}
function cat3() {
    $("#sn4").html("");
    $("#sn5").html("");
    $("#sn6").html("");
    $("#bt").html('');
    var e = $("#cat3").val();
    $("#kategori").val(e);
    var b = 4;
    if (e != null && e !== undefined) {
        $.post('filesystems/kategorigetir.php', {data1: e, data2: b}, function (output) {
            if (output != 1) {
                $("#sn3").html(output);
            } else {
                ilanverbutton();
            }
        });
    }
}
function cat4() {
    $("#sn5").html("");
    $("#sn6").html("");
    $("#bt").html('');
    var e = $("#cat4").val();
    $("#kategori").val(e);
    var b = 5;
    if (e != null && e !== undefined) {
        $.post('filesystems/kategorigetir.php', {data1: e, data2: b}, function (output) {
            if (output != 1) {
                $("#sn4").html(output);

            } else {
                ilanverbutton();
            }
        });
    }
}
function cat5() {
    $("#sn6").html("");
    $("#bt").html('');
    var e = $("#cat5").val();
    $("#kategori").val(e);
    var b = 6;
    if (e != null && e !== undefined) {
        $.post('filesystems/kategorigetir.php', {data1: e, data2: b}, function (output) {
            if (output != 1) {
                $("#sn5").html(output);

            } else {
                ilanverbutton();
            }
        });
    }
}
function cat6() {

    $("#bt").html('');
    var e = $("#cat6").val();
    $("#kategori").val(e);
    var b = 7;
    if (e != null && e !== undefined) {
        $.post('filesystems/kategorigetir.php', {data1: e, data2: b}, function (output) {
            if (output != 1) {
                $("#sn6").html(output);

            } else {
                ilanverbutton();
            }
        });
    }
}

function ilanverbutton() {
    var e = $("#kategori").val();
    $("#bt").html('<button class="ui-btn ui-corner-all" style="width: 100%;padding: 5px;font-weight: 600;" onclick="window.location.href=\'index.php?page=add2&id=' + e + '\'">İlan Ekleme Sayfasına Devam Et</button>');
	$("#bt").focus();
}
function districts() {
    $(".mahalle option").remove();
    var e = $(".il").val();
    $.post('filesystems/ilce.php', {il: e}, function (output) {
        $(".ilce option").remove();
        $(".ilce").append(output);
    });
}

function districts2() {
    $(".mahalle option").remove();
    var e = $(".il").val();
    $.post('filesystems/ilce.php', {il: e}, function (output) {
        $("#ilce")
       .html(output)
       .selectpicker('refresh');
    });
}


function locality() {
   var e = $(".ilce option:selected").val();
    $.post('filesystems/mahalle.php', {mahalle: e}, function (output) {
        $(".mahalle option").remove();
        $(".mahalle").append(output);
    });
}
function localitys() {
   var e = $(".ilce option:selected").val();
	var f = $("#ilanId").val();
    $.post('filesystems/mahalle.php', {mahalle: e,ilanId:f}, function (output) {
        $(".mahalle option").remove();
        $(".mahalle").append(output);
    });
}
function kargo()
{
    if ($("#data3").val() == 0) {
        $("#get1").addClass("hidden");
        $("#get2").addClass("hidden");
        $("#get3").addClass("hidden");
    } else {
		$("#get1").removeClass("hidden");
        $("#get2").removeClass("hidden");
        $("#get3").removeClass("hidden");
		
    }
	
	if ($("#data3").val() == 2){

		$("#iz1").removeClass("show");
		$("#iz1").addClass("hidden");
		
		$("#iz2").removeClass("hidden");
		$("#iz2").addClass("show");
		
		$("#iz4").removeClass("hidden");
		$("#iz4").addClass("show");
		
		$("#iz5").removeClass("show");
		$("#iz5").addClass("hidden");
		
		
		$("#iz3").html("Satış sonrasında hesabınıza aktarılacak tutar açık arttırma sonucunda belli olacaktır");
		$("#data4").prop( "disabled", true );
		
		$("xx1").prop('required',true);
		$("xx2").prop('required',true);
		$("xx3").prop('required',true);
		$("xx4").prop('required',true);
		
	} else {
		$("xx1").prop('required',false);
		$("xx2").prop('required',false);
		$("xx3").prop('required',false);
		$("xx4").prop('required',false);
		
		$("#iz1").removeClass("hidden");
		$("#iz1").addClass("show");
		
		$("#iz2").removeClass("show");
		$("#iz2").addClass("hidden");	
		
		$("#iz4").removeClass("show");
		$("#iz4").addClass("hidden");	
		
		$("#iz5").removeClass("hidden");
		$("#iz5").addClass("show");
		
		
		$("#iz3").html("Satış sonrasında hesabınıza aktarılacak tutar <strong id=\"tutar\">0.00 TL</strong>");
		$("#data4").prop( "disabled", false );
		hesapla();
	}
}
function maps()
{
    var z = $(".il option:selected").text();
    var zz = $(".ilce option:selected").text();
	var zzz = $(".mahalle option:selected").text();
    $("#address").val(z + " " + zzz);
    codeAddress();
}
function ilansil(e)
{
    var f = confirm("İlanı silmek istediğinize eminmisiniz?");
    if (f) {
        window.location.href = "index.php?page=advert_del&id=" + e;
    } else {

    }
}

function ilanyayinla(e)
{
    var f = confirm("İlanı tekrar yayınlamak istediğinize eminmisiniz?");
    if (f) {
        window.location.href = "index.php?page=advert_o&id=" + e;
    } else {

    }
}
function sonuc(e){
	if (e == 0){
	$("#sonuc").html("<b>ilan bulunamadı</b>");
	} else {
	$("#sonuc").html("<b>"+e+" adet</b> ilan bulundu");
	}
}
function orders(){
	var e = document.getElementById('order').value;
	window.location.href = e;	
}