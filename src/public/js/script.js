$(document).ready(function() {

    $("#message").hide();
    
    var $success = 'Die Daten wurde erfolgreich gespeichert!';
    
    $('#coupon_capture_submit').on('click', function() {

        $.ajax({
            type: "POST",
            url: "coupon.php",
            data: $('#coupon_capture').serialize(),
            success: function(msg)
            {
                if (msg == 'SEND') {
                    $('#message').html($success);
                    $('#message').fadeIn().delay(3000).fadeOut();
                    $('#couch_call_form input').val('');
                }
                
                else {
                    $('#message').html('<div class="redColor">' + msg + '</div>');
                    $('#message').fadeIn().delay(3000).fadeOut();
                }
            }
        });

    });

});


