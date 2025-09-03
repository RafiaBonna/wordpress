/**
 * Admin scripts for Guest Checkout Account Creator
 */
jQuery(function ($) {
  "use strict";

  // Add placeholder info below email content field
  var placeholderInfo =
    '<div class="gueschac-placeholder-list">' +
    "<strong>" + gueschac_params.i18n.available_placeholders + "</strong><br>" +
    "<code>{site_name}</code> - " + gueschac_params.i18n.site_name + "<br>" +
    "<code>{customer_name}</code> - " + gueschac_params.i18n.customer_name + "<br>" +
    "<code>{customer_email}</code> - " + gueschac_params.i18n.customer_email + "<br>" +
    "<code>{customer_password}</code> - " + gueschac_params.i18n.customer_password + "<br>" +
    "<code>{my_account_url}</code> - " + gueschac_params.i18n.my_account_url + "<br>" +
    "<code>{order_number}</code> - " + gueschac_params.i18n.order_number + "</div>";

  $("#gueschac_settings\\[email_content\\]").after(placeholderInfo);

  // Confirm reset to default email template
  $(".gueschac-reset-template").on("click", function (e) {
    if (
      !confirm(
        gueschac_params.i18n.confirm_reset_template
      )
    ) {
      e.preventDefault();
    }
  });

  // Toggle minimum order value field
  $("#gueschac_settings\\[enabled\\]")
    .on("change", function () {
      var $minOrderField = $("#gueschac_settings\\[minimum_order\\]").closest("tr");
      $(this).is(":checked") ? $minOrderField.show() : $minOrderField.hide();
    })
    .trigger("change");

  // Initialize tooltips
  $(".tips").tipTip({
    attribute: "data-tip",
    fadeIn: 50,
    fadeOut: 50,
    delay: 200,
  });

});
