    (function($) {
 
    $.fn.extend({
 
        leanModal: function(options) {
 
            var defaults = {
                top: 100,
                overlay: 0.5
            }
 
            options = $.extend(defaults, options);
 
            return this.each(function() {
 
                var o = options;
 
                $(this).click(function(e) {
 
                    var overlay = $("<div id="lean_overlay"></div>");
 
                    var modal_id = $(this).attr("href");
 
                    $("body").append(overlay);
 
                    $("#lean_overlay").click(function() {
                        close_modal(modal_id);
                    });
 
                    var modal_height = $(modal_id).outerHeight();
                    var modal_width = $(modal_id).outerWidth();
 
                    $('#lean_overlay').css({
                        'display': 'block',
                        opacity: 0
                    });
 
                    $('#lean_overlay').fadeTo(200, o.overlay);
 
                    $(modal_id).css({
 
                        'display': 'block',
                        'position': 'fixed',
                        'opacity': 0,
                        'z-index': 11000,
                        'left': 50 + '%',
                        'margin-left': -(modal_width / 2) + "px",
                        'top': o.top + "px"
 
                    });
 
                    $("<img>").css({
                        'position': 'fixed',
                        'top': o.top +10+ 'px',
                        'left': '50%'
                    }).click(function() {
                        close_modal(modal_id);
                        // icon Url
                    }).attr('src', 'http://emreceyhan.net/upload/emreceyhan_55299912f3104.png').appendTo($(modal_id));
 
                    $(modal_id).fadeTo(200, 1);
 
                    e.preventDefault();
 
                });
 
            });
 
            function close_modal(modal_id) {
 
                $("#lean_overlay").fadeOut(200);
 
                $(modal_id).css({
                    'display': 'none'
                });
 
            }
 
        }
    });
 
})(jQuery);
 
$("a#go").leanModal();