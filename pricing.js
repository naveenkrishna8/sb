 // Recurly configuration
 recurly.configure({
    publicKey: 'ewr1-Av43hbhS0Jky7BGksuoFSk',
    style: {
        all: {
            fontSize: '16px',
            lineHeight: '1em',
        },
        number: {
            placeholder: 'Number'
        },
        month: {
            placeholder: 'MM'
        },
        year: {
            placeholder: 'YYYY'
        },
        cvv: {
            placeholder: 'CVV'
        }
    }
});
$('form').on('submit', function (event) {
  var form = this;
  event.preventDefault();
  recurly.token(form, function (err, token) {
    if (err) {
      // handle error using err.code and err.fields
    } else {
      // recurly.js has filled in the 'token' field, so now we can submit the
      // form to your server; alternatively, you can access token.id and do
      // any processing you wish
      form.submit();
    }
  });
});
jQuery('#payment-form').on('submit', function (event) {
    var btn = jQuery('#cc-form-submit');
    var form = this;
    var email = jQuery("#Email").val();
    event.preventDefault();
    console.log(form);
    recurly.token(form, function (err, token) {
    if (err) {
      // handle error using err.code and err.fields
    } else {
        $("#RecurlyToken").attr('value', token.id);
        $("#TimeZoneOffset").val(((new Date()).getTimezoneOffset() * -100) / 60);
        form.submit();
        btn.attr('disabled', true);
        btn.find('img').show();
    }
  });

/*
    // check user/email availability
    $.ajax({
        type: "POST",
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        url: "/Api/Users/CheckForExistingAccount?email=" + email,
        success: function (data) {
            if (data) { // return true (user does not exist)
                submitToRecurly()
            } else {
                alert("This user already exists!\n Please select another email and try again.")
            }
        },
        error: function (data) {
            alert("Sorry, there was a communication problem.\nPlease refresh the page and try again.");
        }
    });
    function submitToRecurly() {
        recurly.token(form, function (err, token) {
            if (err) {
                alert(err.message);
            } else {
                $("#RecurlyToken").attr('value', token.id);
                $("#TimeZoneOffset").val(((new Date()).getTimezoneOffset() * -100) / 60);
                form.submit();
                btn.attr('disabled', true);
                btn.find('img').show();
            }
        });
    }*/
})