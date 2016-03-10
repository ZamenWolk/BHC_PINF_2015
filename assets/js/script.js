/**
 * Created by Arnaud on 04/03/2016.
 */

function navResize() {
    var win = $(this); //this = window
    if (win.width() <= 800) {
        $('#navHeader').removeClass("navbar-fixed-top").addClass("navbar-static-top");
        $("body").css({"padding-top" : "0px"});
        return true;
    }
    return false;
}

function searchHide() {
    var pathname = window.location.pathname; // Returns path only
    var lastpath = pathname.substr(pathname.lastIndexOf("/")+1);
    if(!(lastpath == "recherche")) {
        $(".searchForm").hide();
    }
}


$(document).ready(function() {

    navResize();
    searchHide();

    $('li.dropdown a').on('click', function (event) {
        $(this).parent().toggleClass('open');
    });

    $("body").on('click', function (e) {
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

    $("body").on('click', function (e) {
        $('[data-toggle="popover"]').each(function () {
            if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                $(this).popover('hide');
            }
        });
    });

    $("#searchLink").click(function() {
        $(".searchForm").slideToggle();
    });

    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').focus()
    })

    $(window).on('resize', function(){
        if(!navResize()) {
            $('#navHeader').removeClass("navbar-static-top").addClass("navbar-fixed-top");
            $("body").css({"top" : "70px"});
        }
    });

});