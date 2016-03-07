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

    $("#searchLink").click(function() {
        if ($(".searchWell").css('display') == 'none') {
            $(".searchWell").show();
        }
        else $(".searchWell").hide();
    });

});