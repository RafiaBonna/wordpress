jQuery(document).ready(function($) {
    $('.notice[data-notice="get_started"]').on('click', '.notice-dismiss', function() {
        $.ajax({
            type: 'POST',
            data: {
                action: 'jewellery_boutique_dismiss_notice',
            },
            url: ajaxurl,
        });
    });
});