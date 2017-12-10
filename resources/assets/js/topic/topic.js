$(function () {
    $('.topic-body img:not(.emoji)').each(function() {
        $(this).wrap("<a href='"+ $(this).attr('src') +"' class='fluidbox'></a>");
    }).promise().done(function () {
        $('a.fluidbox').fluidbox();
    });

    $("#toc").tocify({
        context: '.topic-body',
        selectors: "h2,h3,h4"
    });
})