(function() {
  var data, getInfo;

  data = {
    _token: $('[name="_token"]').val()
  };

  getInfo = function() {
    var contact_id, email, email2, facebook_pagina, facebook_profil, nume, observatii, prenume, site, telefon;
    prenume = $('#prenume');
    nume = $('#nume');
    site = $('#site');
    email = $('#email');
    email2 = $('#email2');
    telefon = $('#telefon');
    facebook_profil = $('#facebook_profil');
    facebook_pagina = $('#facebook_pagina');
    observatii = $('#observatii');
    contact_id = $('#citizen_id');
    data.nume = nume.val();
    data.prenume = prenume.val();
    data.site = site.val();
    data.email = email.val();
    data.email2 = email2.val();
    data.telefon = telefon.val();
    data.facebook_profil = facebook_profil.val();
    data.facebook_pagina = facebook_pagina.val();
    data.observatii = observatii.val();
    data.contact_id = contact_id.val();
    return false;
  };

  $(function() {});

  $('#edit-citizen').click(function(e) {
    var email, emailRegex, nume, prenume;
    e.preventDefault();
    prenume = $('#prenume');
    nume = $('#nume');
    email = $('#email');
    getInfo();
    emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if (!emailRegex.test(data.email)) {
      toastr.error("Adresa de email nu este validă!");
      email.addClass('invalid');
      return;
    }
    if (data.nume.trim() === "") {
      toastr.error("Câmpul nume nu este valid");
      nume.addClass('invalid');
      return;
    }
    if (data.prenume.trim() === "") {
      toastr.error("Câmpul prenume nu este valid");
      prenume.addClass('invalid');
      return;
    }
    data.basic = true;
    console.log(data);
    $.post('/edit-citizen', data, function(json) {
      console.log(json);
      if (json.success) {
        location.reload();
      }
    });
  });

  $('#adauga-categorie').on('change', function() {
    var categorie;
    categorie = $('#adauga-categorie').val();
    if (categorie === 'voluntar') {
      $('#new-volunteer').removeClass('hidden');
    }
  });

  $('#add-volunteer').click(function(e) {
    var availability, detalii_eveniment, domenii_de_interes, nume_eveniment, rating, skills;
    e.preventDefault();
    domenii_de_interes = $('#new-volunteer-domains');
    skills = $('#new-volunteer-skills');
    nume_eveniment = $('#volunteer-event-name');
    detalii_eveniment = $('#volunteer-event-details');
    rating = $('#volunteer-rating');
    availability = $('#volunteer-event-availability');
    getInfo();
    data.new_volunteer = true;
    data.domains_of_interest = domenii_de_interes.val();
    data.skills = skills.val();
    data.event_name = nume_eveniment.val();
    data.event_details = detalii_eveniment.val();
    data.rating = rating.val();
    data.availability = availability.val();
    $.post('/edit-citizen', data, function(json) {
      if (json.success) {
        location.reload();
      }
    });
  });

  $('#new-volunteer-skills').select2({
    tags: true
  });

  $('#volunteer-rating').barrating({
    theme: 'fontawesome-stars'
  });

}).call(this);

//# sourceMappingURL=edit-citizen.js.map
