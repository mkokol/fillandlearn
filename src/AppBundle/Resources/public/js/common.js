$(document).ready(function () {
    $('.link-as-form').click(function () {
        var $form = $('<form/>').hide();
        var url = ($(this).data('url')) ? $(this).data('url') : $(this).attr('href');

        $form.attr({'action': url, 'method': 'post'});
        $form.append($('<input/>', {
            type: 'hidden',
            name: '_method'
        }).val($(this).data('method')));

        if ($(this).data('csrf')) {
            var csrf = $(this).data('csrf').split(':');
            $form.append($('<input/>', {
                type: 'hidden',
                name: csrf[0]
            }).val(csrf[1]));
        }

        $(this).parent().append($form);

        $form.submit();

        return false;
    });
    $('.load-modal').click(function () {
        $('body').append('<div id="modal" class="modal fade"/>');
        $('#modal').load($(this).data('url'), function () {
            $('#modal').modal('show');
            $('#modal').bind('hidden.bs.modal', function () {
                $('#modal').remove();

                if (typeof modalRemove !== 'undefined' && $.isFunction(modalRemove)) {
                    modalRemove();
                }
            });

            if (typeof modalInit !== 'undefined' && $.isFunction(modalInit)) {
                modalInit();
            }
        });

        return false;
    });
    $('.link').click(function(){
        document.location.href = $(this).data('url');
    })
});
