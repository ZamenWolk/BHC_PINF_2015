/**
 * Created by Arnaud on 04/03/2016.
 */

function navResize() {
    var win = $(this); //this = window
    if (win.width() <= 800) {
        $('#navHeader').removeClass("navbar-fixed-top").addClass("navbar-static-top");
        $("body").css({"padding-top" : "0px"});
        return true;
    } else $("body").css({"padding-top" : "70px"});
    return false;
}

function searchHide() {
    $(".searchForm").hide();
    var pathname = window.location.pathname; // Returns path only
    var lastpath = pathname.substr(pathname.lastIndexOf("/")+1);
    if(lastpath == "recherche") {
        $("body").css({paddingTop: "+=169px"});
        $(".searchForm").show();
    }
}

$(document).ready(function() {

    navResize();
    searchHide();

    $("[data-toggle=popover]").popover({
        html: true,
        content: function() {
            return $('#popover-content').html();
        }
    });

    $("#subLink").on("click", function () {
        $("#popover-content").css({display: "none"});
    });

    $("body").on('click', function (e) {
        $('[data-toggle="popover"]').each(function () {
            if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                $(this).popover('hide');
            }
        });
    });

    $("#searchLink").click(function() {
        if($(".searchForm").is(":visible")) {
            $(".searchForm").slideUp();
            $("body").animate({paddingTop: "-=169px"});
            $(".dropdown-menu").css({top: "+=12px"});
        } else {
            $(".searchForm").slideDown();
            $("body").animate({paddingTop: "+=169px"});
            $(".dropdown-menu").css({top: "-=12px"});
        }
    });

    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').focus()
    });

    $(window).on('resize', function(){
        if(!navResize()) {
            $('#navHeader').removeClass("navbar-static-top").addClass("navbar-fixed-top");
            $("body").css({"top" : "70px"});
        }
    });

});