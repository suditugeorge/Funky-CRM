data = {_token:$('[name="_token"]').val()}

$ ->

$('#add-citizen').click (e) ->
	e.preventDefault();

	#Date de contact
	prenume = $('#prenume')
	nume = $('#nume')
	site = $('#site')
	email = $('#email')
	email2 = $('#email2')
	telefon = $('#telefon')
	facebook_profil = $('#facebook_profil')
	facebook_pagina = $('#facebook_pagina')
	observatii = $('#observatii')

	data.nume = prenume.val()
	data.prenume = nume.val()
	data.site = site.val()
	data.email = email.val()
	data.email2 = email2.val()
	data.telefon = telefon.val()
	data.facebook_profil = facebook_profil.val()
	data.facebook_pagina = facebook_pagina.val()
	data.observatii = observatii.val()

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
	$.post '/add-citizen', data , (json) ->
		window.location.href = json.url
		return
	return
