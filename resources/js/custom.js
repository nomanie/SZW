$(document).on('click', 'a', function (e) {
    if ($(this).data('redirect-to')) window.location.href = $(this).data('redirect-to');
    if ($(this).data('redirect')) {
        e.preventDefault();
        // init();
        changeUrl($(this).attr('href'), $(this));
        if ($(this).data('reload')) {
            document.location.reload(true);
        }

    }
});

function changeUrl(url, selector) {
    $.ajax({
        url: url,
        type: 'GET',
        data: null,
        cache: false,
        success: function (data) {

            $('div#content').html(data);
            if (selector.data('reload')) location.reload();
            if (typeof (history.pushState) != "undefined") {
                let obj = {Page: window.location.pathname, Url: url};
                history.pushState(obj, obj.Page, obj.Url);
            } else {
                window.location.href = url;
            }

        }
    });
}
