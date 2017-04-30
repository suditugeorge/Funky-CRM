data = {_token:$('[name="_token"]').val()}

getInfo = ->
	prenume = $('#prenume')
	nume = $('#nume')
	site = $('#site')
	email = $('#email')
	email2 = $('#email2')
	telefon = $('#telefon')
	facebook_profil = $('#facebook_profil')
	facebook_pagina = $('#facebook_pagina')
	observatii = $('#observatii')
	contact_id = $('#citizen_id')

	data.nume = nume.val()
	data.prenume = prenume.val()
	data.site = site.val()
	data.email = email.val()
	data.email2 = email2.val()
	data.telefon = telefon.val()
	data.facebook_profil = facebook_profil.val()
	data.facebook_pagina = facebook_pagina.val()
	data.observatii = observatii.val()
	data.contact_id = contact_id.val()

	false

$ ->

$('#edit-citizen').click (e) ->
	e.preventDefault();
	prenume = $('#prenume')
	nume = $('#nume')
	email = $('#email')
	#Date de contact
	getInfo()

	emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/

	if !emailRegex.test(data.email)
		toastr.error("Adresa de email nu este validă!")
		email.addClass 'invalid'
		return
	if data.nume.trim() == ""
		toastr.error("Câmpul nume nu este valid")
		nume.addClass 'invalid'
		return
	if data.prenume.trim() == ""
		toastr.error("Câmpul prenume nu este valid")
		prenume.addClass 'invalid'
		return

	data.basic = true

	$.post '/edit-citizen', data , (json) ->
		if json.success
			location.reload()
		return

	return
$('#adauga-categorie').on 'change', ->
	categorie = $('#adauga-categorie').val()
	if categorie == 'pick'
		$('#new-media').addClass 'hidden'
		$('#new-donor').addClass 'hidden'
		$('#new-volunteer').addClass 'hidden'
	else if categorie == 'voluntar'
		$('#new-volunteer').removeClass 'hidden'
		$('#new-media').addClass 'hidden'
		$('#new-donor').addClass 'hidden'
	else if categorie == 'media'
		$('#new-media').removeClass 'hidden'
		$('#new-volunteer').addClass 'hidden'
		$('#new-donor').addClass 'hidden'
	else if categorie == 'donator'
		$('#new-donor').removeClass 'hidden'
		$('#new-volunteer').addClass 'hidden'
		$('#new-media').addClass 'hidden'
	return

$('#add-volunteer').click (e) ->
	e.preventDefault();
	$('#add-volunteer-spinner').removeClass 'hidden'
	$('#add-volunteer').addClass 'hidden'

	domenii_de_interes = $('#new-volunteer-domains')
	skills = $('#new-volunteer-skills')
	nume_eveniment = $('#volunteer-event-name')
	detalii_eveniment = $('#volunteer-event-details')
	rating = $('#volunteer-rating')
	availability = $('#volunteer-event-availability')
	#iau toate detaliile personale
	getInfo()
	data.new_volunteer = true
	data.domains_of_interest = domenii_de_interes.val()
	data.skills = skills.val()
	data.event_name = nume_eveniment.val()
	data.event_details = detalii_eveniment.val()
	data.rating = rating.val()
	data.availability = availability.val()

	$.post '/edit-citizen', data , (json) ->
		if json.success
			location.reload()
		else
			toastr.error(json.message)
			$('#add-volunteer-spinner').addClass 'hidden'
			$('#add-volunteer').removeClass 'hidden'
		return

	return

$('#add-donor').click (e) ->
	e.preventDefault();

	recurring_donations = $('#new-donor-recurring_donations')
	legal_form = $('#new-donor-legal_form')
	getInfo()

	data.new_donor = true
	data.legal_form = legal_form.val()
	data.recurring_donations = recurring_donations.val()

	$.post '/edit-citizen', data , (json) ->
		if json.success
			location.reload()
		else
			toastr.error(json.message)
		return	
	return

$('#add-media').click (e) ->
	e.preventDefault();
	#$('#add-media-spinner').removeClass 'hidden'
	#$('#add-media').addClass 'hidden'
	domenii_de_interes = $('#new-media-domains')
	canale = $('#new-media-channel')
	liasons = $('#new-media-liason')
	afiliere = $('#affliation')
	check_in = $('#new-media-check-in')
	rating = $('#new-media-rating')
	link = $('#new-media-link')
	getInfo()

	data.new_media = true
	data.domains_of_interest = domenii_de_interes.val()
	data.channels = canale.val()
	data.liasons = liasons.val()
	data.affliation = afiliere.val()
	data.check_in = check_in.is(':checked')
	data.rating = rating.val()
	data.link = link.val()

	$.post '/edit-citizen', data , (json) ->
		if json.success
			location.reload()
		else
			toastr.error(json.message)
			$('#add-volunteer-spinner').addClass 'hidden'
			$('#add-volunteer').removeClass 'hidden'
		return
	return

$('.edit-volunteer').click (e) ->
	e.preventDefault();
	id = $(this).data('id')
	$('#edit-volunteer-spinner-'+id).removeClass 'hidden'
	$('.edit-volunteer').addClass 'hidden'
	$('.delete-volunteer').addClass 'hidden'
	getInfo()
	
	data.modify_volunteer = true
	data.updates = {}
	domenii_de_interes = $('#volunteer-domains-'+id)
	skills = $('#volunteer-skills-'+id)
	nume_eveniment = $('#volunteer-event-name-'+id)
	detalii_eveniment = $('#volunteer-event-details-'+id)
	rating = $('#volunteer-rating-'+id)
	availability = $('#volunteer-event-availability-'+id)

	data.updates.id = id
	data.updates.domains_of_interest = domenii_de_interes.val()
	data.updates.skills = skills.val()
	data.updates.event_name = nume_eveniment.val()
	data.updates.event_details = detalii_eveniment.val()
	data.updates.rating = rating.val()
	data.updates.availability = availability.val()

	$.post '/edit-citizen', data , (json) ->
		if json.success
			location.reload()
		else
			toastr.error(json.message)
			$('#edit-volunteer-spinner-'+id).addClass 'hidden'
			$('.edit-volunteer').removeClass 'hidden'
			$('.delete-volunteer').removeClass 'hidden'
		return

	return


$('.edit-donor').click (e) ->
	e.preventDefault();	
	id = $(this).data('id')
	$('#edit-donor-spinner-'+id).removeClass 'hidden'
	$('#edit-donor-'+id).addClass 'hidden'
	$('#delete-donor-'+id).addClass 'hidden'	
	getInfo()
	data.modify_donor = true
	data.updates = {}

	recurring_donations = $('#edit-donor-recurring_donations-'+id)
	legal_form = $('#edit-donor-legal_form-'+id)
	new_donation_sum = $('#new-donation-sum-'+id)
	new_donation_reward = $('#new-donation-reward-'+id)
	new_donation_after_campaign = $('#new-donation-after_campaign-'+id)
	new_donation_comment = $('#new-donation-comment-'+id)	

	data.updates.recurring_donations = recurring_donations.val()
	data.updates.legal_form = legal_form.val()
	data.updates.donor_id = id
	if new_donation_sum != "" && parseFloat(new_donation_sum.val()) != 0 && !isNaN(parseFloat(new_donation_sum.val()))
		data.updates.new_donation = true
		data.updates.new_donation_sum = parseFloat(new_donation_sum.val())
		data.updates.new_donation_reward = new_donation_reward.val()
		data.updates.new_donation_after_campaign = new_donation_after_campaign.val()
		data.updates.new_donation_comment = new_donation_comment.val()

	$.post '/edit-citizen', data , (json) ->
		if json.success
			location.reload()
		else
			toastr.error(json.message)
			$('#edit-donor-spinner-'+id).addClass 'hidden'
			$('#edit-donor-'+id).removeClass 'hidden'
			$('#delete-donor-'+id).removeClass 'hidden'
		return
		
	return

$('.edit-donation').click (e) ->	
	e.preventDefault();
	id = $(this).data('id')
	$('#edit-donation-spinner-'+id).removeClass 'hidden'
	$('#edit-donation-'+id).addClass 'hidden'
	$('#delete-donation-'+id).addClass 'hidden'	

	getInfo()
	data.modify_donation = true
	data.updates = {}		

	donation_sum = $('#donation-sum-'+id)
	donation_reward = $('#donation-reward-'+id)
	donation_after_campaign = $('#donation-after_campaign-'+id)
	donation_comment = $('#donation-comment-'+id)
	if donation_sum != "" && parseFloat(donation_sum.val()) != 0 && !isNaN(parseFloat(donation_sum.val()))
		data.updates.id = id
		data.updates.donation_sum = parseFloat(donation_sum.val())
		data.updates.donation_reward = donation_reward.val()
		data.updates.donation_after_campaign = donation_after_campaign.val()
		data.updates.donation_comment = donation_comment.val()	

		$.post '/edit-citizen', data , (json) ->
			if json.success
				location.reload()
			else
				toastr.error(json.message)
				$('#edit-donation-spinner-'+id).addClass 'hidden'
				$('#edit-donation-'+id).removeClass 'hidden'
				$('#delete-donation-'+id).removeClass 'hidden'
			return		

	return
$('.edit-media').click (e) ->
	e.preventDefault();
	id = $(this).data('id')

	$('#edit-media-spinner-'+id).removeClass 'hidden'
	$('#edit-media-'+id).addClass 'hidden'
	$('#delete-media-'+id).addClass 'hidden'	

	getInfo()
	data.modify_media = true
	data.updates = {}
	domenii_de_interes = $('#media-domains-'+id)
	channels = $('#media-channels-'+id)
	liasons = $('#media-liason-'+id)
	affiliation = $('#media-affliation-'+id)
	check_in = $('#media-check-in-'+id)
	rating = $('#media-rating-'+id)
	new_link = $('#media-link-'+id+'-new')

	data.updates.id = id
	data.updates.domains_of_interest = domenii_de_interes.val()
	data.updates.channels = channels.val()
	data.updates.liasons = liasons.val()
	data.updates.affiliation = affiliation.val()
	data.updates.check_in = check_in.is(':checked')
	data.updates.rating = rating.val()
	data.updates.new_link_value = new_link.val()
	data.updates.links = []

	html_links = $('.media-link-'+id)
	links = []
	$.each html_links, (k) ->
		pos = $(html_links[k]).data('link_id')
		to_add = {id:pos, link:$(html_links[k]).val()}
		data.updates.links.push(to_add)

	$.post '/edit-citizen', data , (json) ->
		if json.success
			location.reload()
		else
			toastr.error(json.message)
			$('#edit-media-spinner-'+id).addClass 'hidden'
			$('#edit-media-'+id).removeClass 'hidden'
			$('#delete-media-'+id).removeClass 'hidden'
		return

	return

$('.delete-donation').click (e) ->
	e.preventDefault();
	id = $(this).data('id')
	$('#edit-donation-spinner-'+id).removeClass 'hidden'
	$('#edit-donation-'+id).addClass 'hidden'
	$('#delete-donation-'+id).addClass 'hidden'
	getInfo()

	data.donation_id = id
	data.delete_donation = true

	$.post '/edit-citizen', data , (json) ->
		if json.success
			location.reload()
		else
			toastr.error(json.message)
			$('#edit-donation-spinner-'+id).addClass 'hidden'
			$('#edit-donation-'+id).removeClass 'hidden'
			$('#delete-donation-'+id).removeClass 'hidden'
		return
	return	

$('.delete-donor').click (e) ->
	e.preventDefault();
	id = $(this).data('id')
	$('#edit-donor-spinner-'+id).removeClass 'hidden'
	$('#edit-donor-'+id).addClass 'hidden'
	$('#delete-donor-'+id).addClass 'hidden'
	getInfo()

	data.donor_id = id
	data.delete_donor = true

	$.post '/edit-citizen', data , (json) ->
		if json.success
			location.reload()
		else
			toastr.error(json.message)
			$('#edit-donor-spinner-'+id).addClass 'hidden'
			$('#edit-donor-'+id).removeClass 'hidden'
			$('#delete-donor-'+id).removeClass 'hidden'
		return
	return		

$('.delete-volunteer').click (e) ->
	e.preventDefault();
	id = $(this).data('id')
	$('#edit-volunteer-spinner-'+id).removeClass 'hidden'
	$('#edit-volunteer-'+id).addClass 'hidden'
	$('#delete-volunteer-'+id).addClass 'hidden'
	getInfo()

	data.id = id
	data.delete_volunteer = true

	$.post '/edit-citizen', data , (json) ->
		if json.success
			location.reload()
		else
			toastr.error(json.message)
			$('#edit-volunteer-spinner-'+id).addClass 'hidden'
			$('#edit-volunteer-'+id).removeClass 'hidden'
			$('#delete-volunteer-'+id).removeClass 'hidden'
		return
	return	

$('.delete-media').click (e) ->
	e.preventDefault();
	id = $(this).data('id')	
	$('#edit-media-spinner-'+id).removeClass 'hidden'
	$('#edit-media-'+id).addClass 'hidden'
	$('#delete-media-'+id).addClass 'hidden'
	getInfo()

	data.id = id
	data.delete_media = true

	$.post '/edit-citizen', data , (json) ->
		if json.success
			location.reload()
		else
			toastr.error(json.message)
			$('#edit-media-spinner-'+id).addClass 'hidden'
			$('#edit-media-'+id).removeClass 'hidden'
			$('#delete-media-'+id).removeClass 'hidden'
		return	
	return

$('#new-volunteer-skills').select2({
  tags: true
})
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
})
