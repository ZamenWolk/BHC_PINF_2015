/**
 * Created by Arnaud on 04/03/2016.
 */
$(document).ready(function() {

    $(".searchWell").hide();

    $('li.dropdown a').on('click', function (event) {
        $(this).parent().toggleClass('open');
    });

    $('body').on('click', function (e) {
        if (!$('li.dropdown').is(e.target)
            && $('li.dropdown').has(e.target).length === 0
            && $('.open').has(e.target).length === 0
        ) {
            $('li.dropdown').removeClass('open');
        }
    });


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