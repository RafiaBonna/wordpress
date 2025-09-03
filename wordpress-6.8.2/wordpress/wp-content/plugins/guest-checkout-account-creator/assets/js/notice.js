jQuery(function ($) {
  "use strict";
        jQuery(document).ready(function($) {
        // Handle dismissible notices
        $(document).on('click', '.notice[data-dismissible="gueschac-activated"] .notice-dismiss', function() {
            $.ajax({
                url: gueschac_admin_notice.ajax_url,
                type: 'POST',
                data: {
                    action: 'gueschac_dismiss_notice',
                    notice: 'activation',
                    nonce: gueschac_admin_notice.nonce
                }
            });
        });
    });

  });
