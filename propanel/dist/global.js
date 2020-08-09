
function districts() {
    $(".mahalle option").remove();
    var e = $(".il").val();
    $.post('../filesystems/ilce.php', {il: e}, function (output) {
        $(".ilce option").remove();
        $(".ilce").append(output);
    });
}

function districts2() {
    $(".mahalle option").remove();
    var e = $(".il").val();
    $.post('../filesystems/ilce.php', {il: e}, function (output) {
        $("#ilce")
       .html(output)
       .selectpicker('refresh');
    });
}


function locality() {
    var e = $(".ilce").val();
    $.post('../filesystems/mahalle.php', {mahalle: e}, function (output) {
        $(".mahalle option").remove();
        $(".mahalle").append(output);
    });
}
function localitys() {
    var e = $(".ilce").val();
	var f = $("#ilanId").val();
    $.post('../filesystems/mahalle.php', {mahalle: e,ilanId:f}, function (output) {
        $(".mahalle option").remove();
        $(".mahalle").append(output);
    });
}
function maps()
{
    var z = $(".il option:selected").text();
    var zz = $(".ilce option:selected").text();
    $("#address").val(z + " " + zz);
    codeAddress();
}