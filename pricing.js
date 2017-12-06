 // Recurly configuration
 recurly.configure({
    publicKey: public_key,
    style: {
        all: {
            fontSize: '14px',
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

jQuery('#payment-form').on('submit', function (event) {
    var btn = jQuery('#cc-form-submit');
    var form = this;
    var email = jQuery("#Email").val();
    event.preventDefault();
    recurly.token(form, function (err, token) {
    if (err) {
      // handle error using err.code and err.fields
      console.log(err);
    } else {
        jQuery("#RecurlyToken").attr('value', token.id);
        jQuery("#TimeZoneOffset").val(((new Date()).getTimezoneOffset() * -100) / 60);
        form.submit();
        btn.attr('disabled', true);
        btn.find('img').show();
    }
  });
});