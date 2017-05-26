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
    $.post('/edit-citizen', data, function(json) {
      if (json.success) {
        location.reload();
      }
    });
  });

  $('#adauga-categorie').on('change', function() {
    var categorie;
    categorie = $('#adauga-categorie').val();
    if (categorie === 'pick') {
      $('#new-media').addClass('hidden');
      $('#new-donor').addClass('hidden');
      $('#new-volunteer').addClass('hidden');
      $('#new-politician').addClass('hidden');
      $('#new-colaborator').addClass('hidden');
      $('#new-employee').addClass('hidden');
    } else if (categorie === 'voluntar') {
      $('#new-volunteer').removeClass('hidden');
      $('#new-media').addClass('hidden');
      $('#new-donor').addClass('hidden');
      $('#new-politician').addClass('hidden');
      $('#new-colaborator').addClass('hidden');
      $('#new-employee').addClass('hidden');
    } else if (categorie === 'media') {
      $('#new-media').removeClass('hidden');
      $('#new-volunteer').addClass('hidden');
      $('#new-donor').addClass('hidden');
      $('#new-politician').addClass('hidden');
      $('#new-colaborator').addClass('hidden');
      $('#new-employee').addClass('hidden');
    } else if (categorie === 'donator') {
      $('#new-donor').removeClass('hidden');
      $('#new-volunteer').addClass('hidden');
      $('#new-media').addClass('hidden');
      $('#new-politician').addClass('hidden');
      $('#new-colaborator').addClass('hidden');
      $('#new-employee').addClass('hidden');
    } else if (categorie === 'politician') {
      $('#new-politician').removeClass('hidden');
      $('#new-donor').addClass('hidden');
      $('#new-volunteer').addClass('hidden');
      $('#new-media').addClass('hidden');
      $('#new-colaborator').addClass('hidden');
      $('#new-employee').addClass('hidden');
    } else if (categorie === 'colaborator') {
      $('#new-colaborator').removeClass('hidden');
      $('#new-politician').addClass('hidden');
      $('#new-donor').addClass('hidden');
      $('#new-volunteer').addClass('hidden');
      $('#new-media').addClass('hidden');
      $('#new-employee').addClass('hidden');
    } else if (categorie === 'functionar') {
      $('#new-employee').removeClass('hidden');
      $('#new-politician').addClass('hidden');
      $('#new-donor').addClass('hidden');
      $('#new-volunteer').addClass('hidden');
      $('#new-media').addClass('hidden');
      $('#new-colaborator').addClass('hidden');
    }
  });

  $('#add-volunteer').click(function(e) {
    var availability, detalii_eveniment, domenii_de_interes, nume_eveniment, rating, skills;
    e.preventDefault();
    $('#add-volunteer-spinner').removeClass('hidden');
    $('#add-volunteer').addClass('hidden');
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
      } else {
        toastr.error(json.message);
        $('#add-volunteer-spinner').addClass('hidden');
        $('#add-volunteer').removeClass('hidden');
      }
    });
  });

  $('#add-employee').click(function(e) {
    var keyword;
    e.preventDefault();
    $('#add-employee-spinner').removeClass('hidden');
    $('#add-employee').addClass('hidden');
    keyword = $('#new-employee-keyword');
    getInfo();
    data.new_employee = true;
    data.keyword = keyword.val();
    $.post('/edit-citizen', data, function(json) {
      if (json.success) {
        location.reload();
      } else {
        toastr.error(json.message);
        $('#add-employee-spinner').addClass('hidden');
        $('#add-employee').removeClass('hidden');
      }
    });
  });

  $('#add-colaborator').click(function(e) {
    var detalii, domenii_de_interes, keyword, skills;
    e.preventDefault();
    $('#add-colaborator-spinner').removeClass('hidden');
    $('#add-colaborator').addClass('hidden');
    domenii_de_interes = $('#new-colaborator-domains');
    skills = $('#new-colaborator-skills');
    keyword = $('#new-colaborator-keyword');
    detalii = $('#new-colaborator-availability');
    getInfo();
    data.new_colaborator = true;
    data.domains_of_interest = domenii_de_interes.val();
    data.skills = skills.val();
    data.keyword = keyword.val();
    data.availability = detalii.val();
    $.post('/edit-citizen', data, function(json) {
      if (json.success) {
        location.reload();
      } else {
        toastr.error(json.message);
        $('#add-colaborator-spinner').addClass('hidden');
        $('#add-colaborator').removeClass('hidden');
      }
    });
  });

  $('#add-politician').click(function(e) {
    var actual_position, domenii_de_interes, intersections_at_events, known_for, liason, link, openness_rating, reasonability_rating;
    e.preventDefault();
    $('#add-politician-spinner').removeClass('hidden');
    $('#add-politician').addClass('hidden');
    actual_position = $('#new-politician-position');
    liason = $('#new-politician-liason');
    domenii_de_interes = $('#new-politician-domains');
    link = $('#new-politician-link');
    intersections_at_events = $('#new-politician-intersections_at_events');
    known_for = $('#new-politician-known_for');
    reasonability_rating = $('#new-politician-reasonability_rating');
    openness_rating = $('#new-politician-openness_rating');
    getInfo();
    data.new_politician = true;
    data.updates = {};
    data.updates.position = actual_position.val();
    data.updates.domains_of_interest = domenii_de_interes.val();
    data.updates.link = link.val();
    data.updates.liason = liason.val();
    data.updates.intersections_at_events = intersections_at_events.val();
    data.updates.known_for = known_for.val();
    data.updates.reasonability_rating = reasonability_rating.val();
    data.updates.openness_rating = openness_rating.val();
    $.post('/edit-citizen', data, function(json) {
      if (json.success) {
        location.reload();
      } else {
        toastr.error(json.message);
        $('#add-volunteer-spinner').addClass('hidden');
        $('#add-volunteer').removeClass('hidden');
      }
    });
  });

  $('#add-donor').click(function(e) {
    var legal_form, recurring_donations;
    e.preventDefault();
    recurring_donations = $('#new-donor-recurring_donations');
    legal_form = $('#new-donor-legal_form');
    getInfo();
    data.new_donor = true;
    data.legal_form = legal_form.val();
    data.recurring_donations = recurring_donations.val();
    $.post('/edit-citizen', data, function(json) {
      if (json.success) {
        location.reload();
      } else {
        toastr.error(json.message);
      }
    });
  });

  $('#add-media').click(function(e) {
    var afiliere, canale, check_in, domenii_de_interes, liasons, link, rating;
    e.preventDefault();
    domenii_de_interes = $('#new-media-domains');
    canale = $('#new-media-channel');
    liasons = $('#new-media-liason');
    afiliere = $('#affliation');
    check_in = $('#new-media-check-in');
    rating = $('#new-media-rating');
    link = $('#new-media-link');
    getInfo();
    data.new_media = true;
    data.domains_of_interest = domenii_de_interes.val();
    data.channels = canale.val();
    data.liasons = liasons.val();
    data.affliation = afiliere.val();
    data.check_in = check_in.is(':checked');
    data.rating = rating.val();
    data.link = link.val();
    $.post('/edit-citizen', data, function(json) {
      if (json.success) {
        location.reload();
      } else {
        toastr.error(json.message);
        $('#add-volunteer-spinner').addClass('hidden');
        $('#add-volunteer').removeClass('hidden');
      }
    });
  });

  $('.edit-volunteer').click(function(e) {
    var availability, detalii_eveniment, domenii_de_interes, id, nume_eveniment, rating, skills;
    e.preventDefault();
    id = $(this).data('id');
    $('#edit-volunteer-spinner-' + id).removeClass('hidden');
    $('.edit-volunteer').addClass('hidden');
    $('.delete-volunteer').addClass('hidden');
    getInfo();
    data.modify_volunteer = true;
    data.updates = {};
    domenii_de_interes = $('#volunteer-domains-' + id);
    skills = $('#volunteer-skills-' + id);
    nume_eveniment = $('#volunteer-event-name-' + id);
    detalii_eveniment = $('#volunteer-event-details-' + id);
    rating = $('#volunteer-rating-' + id);
    availability = $('#volunteer-event-availability-' + id);
    data.updates.id = id;
    data.updates.domains_of_interest = domenii_de_interes.val();
    data.updates.skills = skills.val();
    data.updates.event_name = nume_eveniment.val();
    data.updates.event_details = detalii_eveniment.val();
    data.updates.rating = rating.val();
    data.updates.availability = availability.val();
    $.post('/edit-citizen', data, function(json) {
      if (json.success) {
        location.reload();
      } else {
        toastr.error(json.message);
        $('#edit-volunteer-spinner-' + id).addClass('hidden');
        $('.edit-volunteer').removeClass('hidden');
        $('.delete-volunteer').removeClass('hidden');
      }
    });
  });

  $('.edit-politician').click(function(e) {
    var actual_position, domenii_de_interes, end_date, html_links, id, intersections_at_events, known_for, liason, links, new_date, new_link, new_partie_name, openness_rating, reasonability_rating;
    e.preventDefault();
    id = $(this).data('id');
    $('#edit-politician-spinner-' + id).removeClass('hidden');
    $('#edit-politician-' + id).addClass('hidden');
    actual_position = $('#politician-position-' + id);
    liason = $('#politician-liason-' + id);
    domenii_de_interes = $('#politician-domains-' + id);
    new_link = $('#politician-link-' + id + '-new');
    intersections_at_events = $('#politician-intersections_at_events-' + id);
    known_for = $('#politician-known_for-' + id);
    reasonability_rating = $('#politician-reasonability_rating-' + id);
    openness_rating = $('#politician-openness_rating-' + id);
    getInfo();
    data.modify_politician = true;
    data.updates = {};
    data.updates.id = id;
    data.updates.position = actual_position.val();
    data.updates.liason = liason.val();
    data.updates.domains_of_interest = domenii_de_interes.val();
    data.updates.new_link = new_link.val();
    data.updates.intersections_at_events = intersections_at_events.val();
    data.updates.known_for = known_for.val();
    data.updates.reasonability_rating = reasonability_rating.val();
    data.updates.openness_rating = openness_rating.val();
    data.updates.links = [];
    new_partie_name = $('#new_partie_name-' + id);
    data.updates.new_partie_name = new_partie_name.val();
    new_date = new Date($('#new_partie_start_date-' + id).val());
    data.updates.new_partie_start_date = {};
    data.updates.new_partie_start_date.day = new_date.getDate();
    data.updates.new_partie_start_date.month = new_date.getMonth();
    data.updates.new_partie_start_date.year = new_date.getFullYear();
    end_date = new Date($('#new_partie_end_date-' + id).val());
    data.updates.new_partie_end_date = {};
    data.updates.new_partie_end_date.day = end_date.getDate();
    data.updates.new_partie_end_date.month = end_date.getMonth();
    data.updates.new_partie_end_date.year = end_date.getFullYear();
    html_links = $('.politician-link-' + id);
    links = [];
    $.each(html_links, function(k) {
      var pos, to_add;
      pos = $(html_links[k]).data('link_id');
      to_add = {
        id: pos,
        link: $(html_links[k]).val()
      };
      return data.updates.links.push(to_add);
    });
    $.post('/edit-citizen', data, function(json) {
      if (json.success) {
        location.reload();
      } else {
        toastr.error(json.message);
        $('#edit-politician-spinner-' + id).addClass('hidden');
        $('#edit-politician-' + id).removeClass('hidden');
      }
    });
  });

  $('.edit-employee').click(function(e) {
    var end_date, id, keyword, new_date, new_institution_job_description, new_institution_job_title, new_institution_name;
    e.preventDefault();
    id = $(this).data('id');
    keyword = $('#employee-keyword-' + id);
    getInfo();
    data.modify_employee = true;
    data.updates = {};
    data.updates.id = id;
    data.updates.keyword = keyword.val();
    new_institution_name = $('#new-institution-name-' + id);
    data.updates.new_institution_name = new_institution_name.val();
    new_institution_job_title = $('#new-institution-job_title-' + id);
    data.updates.new_institution_job_title = new_institution_job_title.val();
    new_institution_job_description = $('#new-institution-job_description-' + id);
    data.updates.new_institution_job_description = new_institution_job_description.val();
    new_date = new Date($('#new-institution_start_date-' + id).val());
    data.updates.new_institution_start_date = {};
    data.updates.new_institution_start_date.day = new_date.getDate();
    data.updates.new_institution_start_date.month = new_date.getMonth();
    data.updates.new_institution_start_date.year = new_date.getFullYear();
    end_date = new Date($('#new-institution_end_date-' + id).val());
    data.updates.new_institution_end_date = {};
    data.updates.new_institution_end_date.day = end_date.getDate();
    data.updates.new_institution_end_date.month = end_date.getMonth();
    data.updates.new_institution_end_date.year = end_date.getFullYear();
    $.post('/edit-citizen', data, function(json) {
      if (json.success) {
        location.reload();
      } else {
        toastr.error(json.message);
        $('#edit-politician-spinner-' + id).addClass('hidden');
        $('#edit-politician-' + id).removeClass('hidden');
      }
    });
  });

  $('.edit-institution').click(function(e) {
    var end_date, id, institution_job_description, institution_job_title, institution_name, new_date;
    e.preventDefault();
    id = $(this).data('id');
    $('#edit-institution-spinner-' + id).removeClass('hidden');
    $('#edit-institution-' + id).addClass('hidden');
    $('#delete-institution-' + id).addClass('hidden');
    getInfo();
    data.modify_institution = true;
    data.updates = {};
    data.updates.id = id;
    institution_name = $('#institution-name-' + id);
    data.updates.institution_name = institution_name.val();
    institution_job_title = $('#institution-job_title-' + id);
    data.updates.institution_job_title = institution_job_title.val();
    institution_job_description = $('#institution-job_description-' + id);
    data.updates.institution_job_description = institution_job_description.val();
    new_date = new Date($('#institution_start_date-' + id).val());
    data.updates.institution_start_date = {};
    data.updates.institution_start_date.day = new_date.getDate();
    data.updates.institution_start_date.month = new_date.getMonth();
    data.updates.institution_start_date.year = new_date.getFullYear();
    end_date = new Date($('#institution_end_date-' + id).val());
    data.updates.institution_end_date = {};
    data.updates.institution_end_date.day = end_date.getDate();
    data.updates.institution_end_date.month = end_date.getMonth();
    data.updates.institution_end_date.year = end_date.getFullYear();
    $.post('/edit-citizen', data, function(json) {
      if (json.success) {
        location.reload();
      } else {
        toastr.error(json.message);
        $('#edit-institution-spinner-' + id).addClass('hidden');
        $('#edit-institution-' + id).removeClass('hidden');
      }
    });
  });

  $('.edit-partie').click(function(e) {
    var date, end_date, id, partie_name;
    e.preventDefault();
    id = $(this).data('id');
    $('#edit-partie-spinner-' + id).removeClass('hidden');
    $('#edit-partie-' + id).addClass('hidden');
    $('#delete-partie-' + id).addClass('hidden');
    getInfo();
    data.modify_partie = true;
    data.updates = {};
    data.updates.id = id;
    partie_name = $('#partie_name-' + id);
    data.updates.partie_name = partie_name.val();
    date = new Date($('#partie_start_date-' + id).val());
    data.updates.partie_start_date = {};
    data.updates.partie_start_date.day = date.getDate();
    data.updates.partie_start_date.month = date.getMonth();
    data.updates.partie_start_date.year = date.getFullYear();
    end_date = new Date($('#partie_end_date-' + id).val());
    data.updates.partie_end_date = {};
    data.updates.partie_end_date.day = end_date.getDate();
    data.updates.partie_end_date.month = end_date.getMonth();
    data.updates.partie_end_date.year = end_date.getFullYear();
    $.post('/edit-citizen', data, function(json) {
      if (json.success) {
        location.reload();
      } else {
        toastr.error(json.message);
        $('#edit-donation-spinner-' + id).addClass('hidden');
        $('#edit-donation-' + id).removeClass('hidden');
        $('#delete-donation-' + id).removeClass('hidden');
      }
    });
  });

  $('.edit-colaborator').click(function(e) {
    var availability, domains_of_interest, id, keyword, skills;
    e.preventDefault();
    id = $(this).data('id');
    $('#edit-colaborator-spinner-' + id).removeClass('hidden');
    $('#edit-colaborator-' + id).addClass('hidden');
    $('#delete-colaborator-' + id).addClass('hidden');
    getInfo();
    data.modify_colaborator = true;
    data.updates = {};
    data.updates.id = id;
    domains_of_interest = $('#colaborator-domains-' + id);
    skills = $('#colaborator-skills-' + id);
    availability = $('#colaborator-availability-' + id);
    keyword = $('#colaborator-keyword-' + id);
    data.updates.domains_of_interest = domains_of_interest.val();
    data.updates.skills = skills.val();
    data.updates.availability = availability.val();
    data.updates.keyword = keyword.val();
    $.post('/edit-citizen', data, function(json) {
      if (json.success) {
        location.reload();
      } else {
        toastr.error(json.message);
        $('#edit-colaborator-spinner-' + id).addClass('hidden');
        $('#edit-colaborator-' + id).removeClass('hidden');
        $('#delete-colaborator-' + id).removeClass('hidden');
      }
    });
  });

  $('.edit-donor').click(function(e) {
    var id, legal_form, new_donation_after_campaign, new_donation_comment, new_donation_reward, new_donation_sum, recurring_donations;
    e.preventDefault();
    id = $(this).data('id');
    $('#edit-donor-spinner-' + id).removeClass('hidden');
    $('#edit-donor-' + id).addClass('hidden');
    $('#delete-donor-' + id).addClass('hidden');
    getInfo();
    data.modify_donor = true;
    data.updates = {};
    recurring_donations = $('#edit-donor-recurring_donations-' + id);
    legal_form = $('#edit-donor-legal_form-' + id);
    new_donation_sum = $('#new-donation-sum-' + id);
    new_donation_reward = $('#new-donation-reward-' + id);
    new_donation_after_campaign = $('#new-donation-after_campaign-' + id);
    new_donation_comment = $('#new-donation-comment-' + id);
    data.updates.recurring_donations = recurring_donations.val();
    data.updates.legal_form = legal_form.val();
    data.updates.donor_id = id;
    if (new_donation_sum !== "" && parseFloat(new_donation_sum.val()) !== 0 && !isNaN(parseFloat(new_donation_sum.val()))) {
      data.updates.new_donation = true;
      data.updates.new_donation_sum = parseFloat(new_donation_sum.val());
      data.updates.new_donation_reward = new_donation_reward.val();
      data.updates.new_donation_after_campaign = new_donation_after_campaign.val();
      data.updates.new_donation_comment = new_donation_comment.val();
    }
    $.post('/edit-citizen', data, function(json) {
      if (json.success) {
        location.reload();
      } else {
        toastr.error(json.message);
        $('#edit-donor-spinner-' + id).addClass('hidden');
        $('#edit-donor-' + id).removeClass('hidden');
        $('#delete-donor-' + id).removeClass('hidden');
      }
    });
  });

  $('.edit-donation').click(function(e) {
    var donation_after_campaign, donation_comment, donation_reward, donation_sum, id;
    e.preventDefault();
    id = $(this).data('id');
    $('#edit-donation-spinner-' + id).removeClass('hidden');
    $('#edit-donation-' + id).addClass('hidden');
    $('#delete-donation-' + id).addClass('hidden');
    getInfo();
    data.modify_donation = true;
    data.updates = {};
    donation_sum = $('#donation-sum-' + id);
    donation_reward = $('#donation-reward-' + id);
    donation_after_campaign = $('#donation-after_campaign-' + id);
    donation_comment = $('#donation-comment-' + id);
    if (donation_sum !== "" && parseFloat(donation_sum.val()) !== 0 && !isNaN(parseFloat(donation_sum.val()))) {
      data.updates.id = id;
      data.updates.donation_sum = parseFloat(donation_sum.val());
      data.updates.donation_reward = donation_reward.val();
      data.updates.donation_after_campaign = donation_after_campaign.val();
      data.updates.donation_comment = donation_comment.val();
      $.post('/edit-citizen', data, function(json) {
        if (json.success) {
          location.reload();
        } else {
          toastr.error(json.message);
          $('#edit-donation-spinner-' + id).addClass('hidden');
          $('#edit-donation-' + id).removeClass('hidden');
          $('#delete-donation-' + id).removeClass('hidden');
        }
      });
    }
  });

  $('.edit-media').click(function(e) {
    var affiliation, channels, check_in, domenii_de_interes, html_links, id, liasons, links, new_link, rating;
    e.preventDefault();
    id = $(this).data('id');
    $('#edit-media-spinner-' + id).removeClass('hidden');
    $('#edit-media-' + id).addClass('hidden');
    $('#delete-media-' + id).addClass('hidden');
    getInfo();
    data.modify_media = true;
    data.updates = {};
    domenii_de_interes = $('#media-domains-' + id);
    channels = $('#media-channels-' + id);
    liasons = $('#media-liason-' + id);
    affiliation = $('#media-affliation-' + id);
    check_in = $('#media-check-in-' + id);
    rating = $('#media-rating-' + id);
    new_link = $('#media-link-' + id + '-new');
    data.updates.id = id;
    data.updates.domains_of_interest = domenii_de_interes.val();
    data.updates.channels = channels.val();
    data.updates.liasons = liasons.val();
    data.updates.affiliation = affiliation.val();
    data.updates.check_in = check_in.is(':checked');
    data.updates.rating = rating.val();
    data.updates.new_link_value = new_link.val();
    data.updates.links = [];
    html_links = $('.media-link-' + id);
    links = [];
    $.each(html_links, function(k) {
      var pos, to_add;
      pos = $(html_links[k]).data('link_id');
      to_add = {
        id: pos,
        link: $(html_links[k]).val()
      };
      return data.updates.links.push(to_add);
    });
    $.post('/edit-citizen', data, function(json) {
      if (json.success) {
        location.reload();
      } else {
        toastr.error(json.message);
        $('#edit-media-spinner-' + id).addClass('hidden');
        $('#edit-media-' + id).removeClass('hidden');
        $('#delete-media-' + id).removeClass('hidden');
      }
    });
  });

  $('.delete-donation').click(function(e) {
    var id;
    e.preventDefault();
    id = $(this).data('id');
    $('#edit-donation-spinner-' + id).removeClass('hidden');
    $('#edit-donation-' + id).addClass('hidden');
    $('#delete-donation-' + id).addClass('hidden');
    getInfo();
    data.donation_id = id;
    data.delete_donation = true;
    $.post('/edit-citizen', data, function(json) {
      if (json.success) {
        location.reload();
      } else {
        toastr.error(json.message);
        $('#edit-donation-spinner-' + id).addClass('hidden');
        $('#edit-donation-' + id).removeClass('hidden');
        $('#delete-donation-' + id).removeClass('hidden');
      }
    });
  });

  $('.delete-institution').click(function(e) {
    var id;
    e.preventDefault();
    id = $(this).data('id');
    $('#edit-institution-spinner-' + id).removeClass('hidden');
    $('#edit-institution-' + id).addClass('hidden');
    $('#delete-institution-' + id).addClass('hidden');
    getInfo();
    data.institution_id = id;
    data.delete_institution = true;
    $.post('/edit-citizen', data, function(json) {
      if (json.success) {
        location.reload();
      } else {
        toastr.error(json.message);
        $('#edit-institution-spinner-' + id).addClass('hidden');
        $('#edit-institution-' + id).removeClass('hidden');
        $('#delete-institution-' + id).removeClass('hidden');
      }
    });
  });

  $('.delete-employee').click(function(e) {
    var id;
    e.preventDefault();
    id = $(this).data('id');
    $('#edit-employee-spinner-' + id).removeClass('hidden');
    $('#edit-employee-' + id).addClass('hidden');
    $('#delete-employee-' + id).addClass('hidden');
    getInfo();
    data.employee_id = id;
    data.delete_employee = true;
    $.post('/edit-citizen', data, function(json) {
      if (json.success) {
        location.reload();
      } else {
        toastr.error(json.message);
        $('#edit-employee-spinner-' + id).addClass('hidden');
        $('#edit-employee-' + id).removeClass('hidden');
        $('#delete-employee-' + id).removeClass('hidden');
      }
    });
  });

  $('.delete-colaborator').click(function(e) {
    var id;
    e.preventDefault();
    id = $(this).data('id');
    $('#edit-colaborator-spinner-' + id).removeClass('hidden');
    $('#edit-colaborator-' + id).addClass('hidden');
    $('#delete-colaborator-' + id).addClass('hidden');
    getInfo();
    data.colaborator_id = id;
    data.delete_colaborator = true;
    $.post('/edit-citizen', data, function(json) {
      if (json.success) {
        location.reload();
      } else {
        toastr.error(json.message);
        $('#edit-colaborator-spinner-' + id).addClass('hidden');
        $('#edit-colaborator-' + id).removeClass('hidden');
        $('#delete-colaborator-' + id).removeClass('hidden');
      }
    });
  });

  $('.delete-partie').click(function(e) {
    var id;
    e.preventDefault();
    id = $(this).data('id');
    $('#edit-partie-spinner-' + id).removeClass('hidden');
    $('#edit-partie-' + id).addClass('hidden');
    $('#delete-partie-' + id).addClass('hidden');
    getInfo();
    data.partie_id = id;
    data.delete_partie = true;
    $.post('/edit-citizen', data, function(json) {
      if (json.success) {
        location.reload();
      } else {
        toastr.error(json.message);
        $('#edit-partie-spinner-' + id).addClass('hidden');
        $('#edit-partie-' + id).removeClass('hidden');
        $('#delete-partie-' + id).removeClass('hidden');
      }
    });
  });

  $('.delete-politician').click(function(e) {
    var id;
    e.preventDefault();
    id = $(this).data('id');
    $('#edit-politician-spinner-' + id).removeClass('hidden');
    $('#edit-politician-' + id).addClass('hidden');
    $('#delete-politician-' + id).addClass('hidden');
    getInfo();
    data.politician_id = id;
    data.delete_politician = true;
    $.post('/edit-citizen', data, function(json) {
      if (json.success) {
        location.reload();
      } else {
        toastr.error(json.message);
        $('#edit-politician-spinner-' + id).addClass('hidden');
        $('#edit-politician-' + id).removeClass('hidden');
        $('#delete-politician-' + id).removeClass('hidden');
      }
    });
  });

  $('.delete-donor').click(function(e) {
    var id;
    e.preventDefault();
    id = $(this).data('id');
    $('#edit-donor-spinner-' + id).removeClass('hidden');
    $('#edit-donor-' + id).addClass('hidden');
    $('#delete-donor-' + id).addClass('hidden');
    getInfo();
    data.donor_id = id;
    data.delete_donor = true;
    $.post('/edit-citizen', data, function(json) {
      if (json.success) {
        location.reload();
      } else {
        toastr.error(json.message);
        $('#edit-donor-spinner-' + id).addClass('hidden');
        $('#edit-donor-' + id).removeClass('hidden');
        $('#delete-donor-' + id).removeClass('hidden');
      }
    });
  });

  $('.delete-volunteer').click(function(e) {
    var id;
    e.preventDefault();
    id = $(this).data('id');
    $('#edit-volunteer-spinner-' + id).removeClass('hidden');
    $('#edit-volunteer-' + id).addClass('hidden');
    $('#delete-volunteer-' + id).addClass('hidden');
    getInfo();
    data.id = id;
    data.delete_volunteer = true;
    $.post('/edit-citizen', data, function(json) {
      if (json.success) {
        location.reload();
      } else {
        toastr.error(json.message);
        $('#edit-volunteer-spinner-' + id).addClass('hidden');
        $('#edit-volunteer-' + id).removeClass('hidden');
        $('#delete-volunteer-' + id).removeClass('hidden');
      }
    });
  });

  $('.delete-media').click(function(e) {
    var id;
    e.preventDefault();
    id = $(this).data('id');
    $('#edit-media-spinner-' + id).removeClass('hidden');
    $('#edit-media-' + id).addClass('hidden');
    $('#delete-media-' + id).addClass('hidden');
    getInfo();
    data.id = id;
    data.delete_media = true;
    $.post('/edit-citizen', data, function(json) {
      if (json.success) {
        location.reload();
      } else {
        toastr.error(json.message);
        $('#edit-media-spinner-' + id).addClass('hidden');
        $('#edit-media-' + id).removeClass('hidden');
        $('#delete-media-' + id).removeClass('hidden');
      }
    });
  });

  $('#new-volunteer-skills').select2({
    tags: true
  });

  $('#new-colaborator-skills').select2({
    tags: true
  });

  $('#volunteer-rating').barrating({
    theme: 'fontawesome-stars'
  });

  $('#new-media-rating').barrating({
    theme: 'fontawesome-stars'
  });

  $('.volunteer-rating').barrating({
    theme: 'fontawesome-stars'
  });

  $('.media-rating').barrating({
    theme: 'fontawesome-stars'
  });

  $('.volunteer-skills').select2({
    tags: true
  });

  $('.colaborator-skills').select2({
    tags: true
  });

  $('#new-politician-reasonability_rating').barrating({
    theme: 'fontawesome-stars'
  });

  $('#new-politician-openness_rating').barrating({
    theme: 'fontawesome-stars'
  });

  $('.politician-reasonability_rating').barrating({
    theme: 'fontawesome-stars'
  });

  $('.politician-openness_rating').barrating({
    theme: 'fontawesome-stars'
  });

  $('.datepicker').pickadate({
    selectMonths: true,
    selectYears: 15,
    formatSubmit: 'yyyy-mm-dd'
  });

}).call(this);

//# sourceMappingURL=edit-citizen.js.map
