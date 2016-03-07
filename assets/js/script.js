/**
 * Created by Arnaud on 04/03/2016.
 */
$(document).ready(function() {

    $(".searchWell").hide();

    $("[data-toggle=popover]").popover({
        html: true,
        content: function() {
            return $('#popover-content').html();
        }
    });

    $('body').on('click', function (e) {
        $('[data-toggle="popover"]').each(function () {
            if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                $(this).popover('hide');
            }
        });
    });

    $("#searchLink").click(function() {
        if ($(".searchWell").css('display') == 'none') {
            $(".searchWell").slideDown();
        }
        else $(".searchWell").slideUp();
    });

});