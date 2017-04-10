(function() {
  $(function() {});

  $('#add-admins').click(function(e) {
    var domainCheck, emailRegex, emails, token, verified_emails;
    e.preventDefault();
    $('#error-box-users').addClass('hidden');
    token = $('[name="_token"]').val();
    emails = $('#emails').val().split("\n");
    verified_emails = "";
    emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    domainCheck = /@funkycitizens.org\s*$/;
    $.each(emails, function(k) {
      if (!emailRegex.test(emails[k]) || !domainCheck.test(emails[k])) {
        toastr.error("Adresa de email " + emails[k] + " nu este validă!");
        return;
      }
      return verified_emails = verified_emails + "\n" + emails[k];
    });
    $.post('/add-funky', {
      _token: token,
      emails: verified_emails
    }, function(json) {
      if (!json.success) {
        toastr.error(json.message);
        return;
      } else {
        toastr.success(json.message);
      }
    });
  });

}).call(this);

//# sourceMappingURL=add-funky.js.map
