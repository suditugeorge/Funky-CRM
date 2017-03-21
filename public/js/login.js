(function() {
  $(function() {});

  $(document).keypress(function(e) {
    if (e.which === 13) {
      $('#login').click();
    }
  });

  $('#login').click(function(e) {
    var domainCheck, email, emailRegex, password, remember, token;
    $('.fa-spinner').removeClass('hidden');
    $('#login').addClass('hidden');
    $('#email').removeClass('invalid');
    $('#password').removeClass('invalid');
    email = $('#email').val();
    token = $('[name="_token"]').val();
    remember = $('#remember').is(':checked');
    if (email.trim() === "") {
      $('#email').addClass('invalid');
      toastr.error("Te rugăm să introduci o adresă de email");
      return;
    }
    emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if (!emailRegex.test(email)) {
      $('#email').addClass('invalid');
      toastr.error("Adresa de email este invalidă");
      return;
    }
    domainCheck = /@funkycitizens.org\s*$/;
    if (!domainCheck.test(email)) {
      $('#email').addClass('invalid');
      toastr.error("Adresa de email este invalidă");
      return;
    }
    password = $('#password').val();
    if (password.trim() === "") {
      $('#password').addClass('invalid');
      toastr.error("Unul sau mai multe câmpuri sunt goale sau conțin erori!");
      return;
    }
    $.post('/', {
      _token: token,
      email: email,
      password: password,
      remember: remember
    }, function(json) {
      if (!json.success) {
        if (typeof json.field !== 'undefined') {
          $('#' + json.field).addClass('invalid');
        }
        toastr.error(json.message);
        $('.fa-spinner').addClass('hidden');
        $('#login').removeClass('hidden');
        return;
      } else {
        window.location.href = "/dashboard";
      }
    });
  });

}).call(this);

//# sourceMappingURL=login.js.map
