/**
 * Created by Arnaud on 04/03/2016.
 */
$(document).ready(function() {
    $("[data-toggle=popover]").popover({
        html: true,
        content: function() {
            return $('#popover-content').html();
        }
    });

});