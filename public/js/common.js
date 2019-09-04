jQuery(function ($) {

    $(".remove.allow").click(function (event) {
        if (!confirm('Bạn có muốn xóa không?')) {
            event.preventDefault();
        }
    });

    $body = $("body");
    $(document).on({
        ajaxStart: function () {
            $body.addClass("loading");
        },
        ajaxStop: function () {
            $body.removeClass("loading");
        }
    });

});