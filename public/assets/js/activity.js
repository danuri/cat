(function($) {
  $.fn.userActivityTracker = function(options) {
    const settings = $.extend({
      url: '',                        // URL to send activity data
      timeout: 60000,                 // Inactivity timeout in ms (default: 1 min)
      extraData: {},                  // Optional extra data to include in requests
      onSend: null                    // Optional callback after sending data
    }, options);

    let inactivityTimer = null;
    let isInactive = false;

    function sendActivity(status, reason) {
      const data = {
        timestamp: new Date().toISOString(),
        status: status,
        reason: reason,
        ...settings.extraData
      };

      $.ajax({
        type: 'POST',
        url: settings.url,
        contentType: 'application/json',
        data: JSON.stringify(data),
        success: function(response) {
          if (typeof settings.onSend === 'function') {
            settings.onSend(response, data);
          }
        },
        error: function(err) {
          console.error('User activity send error:', err);
        }
      });
    }

    function resetInactivityTimer() {
      if (isInactive) {
        isInactive = false;
        sendActivity('active', 'user-action');
      }
      clearTimeout(inactivityTimer);
      inactivityTimer = setTimeout(() => {
        isInactive = true;
        sendActivity('inactive', 'timeout');
      }, settings.timeout);
    }

    // Bind user interaction events
    this.on('mousemove keydown mousedown touchstart', resetInactivityTimer);

    // Visibility change (tab switching)
    $(document).on('visibilitychange', function() {
      if (document.visibilityState === 'hidden') {
        sendActivity('hidden', 'visibilitychange');
      } else {
        sendActivity('visible', 'visibilitychange');
      }
    });

    // Start initial inactivity timer
    resetInactivityTimer();

    return this;
  };
})(jQuery);
