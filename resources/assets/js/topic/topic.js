$(function () {
    $('.topic-body img:not(.emoji)').each(function() {
        $(this).wrap("<a href='"+ $(this).attr('src') +"' class='fluidbox'></a>");
    }).promise().done(function () {
        $('a.fluidbox').fluidbox();
    });

    /* 删除确认框 */
    $('.btn-del-topic').on('click', function () {
        swal({
            title: "确定删除吗？",
            text: "你将无法恢复该话题！",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "确定删除！",
            closeOnConfirm: false,
        }).then((result) => {
            if (result.value) {
                $('.delete-form').submit();
                swal(
                    '已删除！',
                    '话题已被删除',
                    'success'
                )
            }
        })
    });

    $("#toc").tocify({
        context: '.topic-body',
        selectors: "h2,h3,h4"
    });
})