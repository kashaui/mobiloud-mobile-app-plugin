// Generated by CoffeeScript 1.6.3
(function() {
  jQuery(document).ready(function($) {
    var $license_div, $license_page;
    $license_div = $('#ml_admin_license');
    $license_page = $('#ml_admin_license_page');
    return $license_div.find("input[type='submit']").click(function() {
      var $input_api_key, $input_secret_key, data, saving_label,
        _this = this;
      saving_label = $(this).data('saving-label');
      $(this).val(saving_label).attr('disabled', true);
      $license_page.css('opacity', '0.5');
      $input_app_id = $license_div.find("input[name='app_id']").first();
      $input_secret_key = $license_div.find("input[name='secret_key']").first();
      data = {
        action: 'ml_admin_license_keys',
        ml_pb_app_id: $input_app_id.val(),
        ml_pb_secret_key: $input_secret_key.val()
      };
      return $.post(ajaxurl, data, function(response) {
        var apply_label;
        apply_label = $(_this).data('apply-label');
        $license_page.html(response).fadeIn();
        $(_this).attr('disabled', false);
        $(_this).val(apply_label);
        location.reload();
        return $license_page.css("opacity", "1.0");
      });
    });
  });

}).call(this);
