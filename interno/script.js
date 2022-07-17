$(function (){
    var header = $("#header"),
        headerH = $("#header").innerHeight() - 20,
        scrollOffset = $(window).scrollTop();

    /* Fixed Header */
    checkScroll(scrollOffset);

    $(window).on("scroll", function() {
        scrollOffset = $(this).scrollTop();
        checkScroll(scrollOffset);
    });

    function checkScroll(scrollOffset) {
        if (scrollOffset >= headerH) {
            header.addClass("fixed");
        } else {
            header.removeClass("fixed");
        }
    }

    /* Nav toggle */
    $("#nav_toggle").on("click", function(event) {
        event.preventDefault();

        $("#body").toggleClass("hidden");
        $("#header").toggleClass("active");
        $("#nav").toggleClass("active");
        $(this).toggleClass("active");
    });
});