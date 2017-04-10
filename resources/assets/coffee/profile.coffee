$ ->

$('#change-user-profile').click (e) ->
	e.preventDefault();
	$('.fa-spinner').removeClass 'hidden'
	$('#change-user-profile').addClass 'hidden'
	$('#password').removeClass 'invalid'
	$('#password_repeat').removeClass 'invalid'
	$('#name').removeClass 'invalid'

	email = $('#email').val()
	token = $('[name="_token"]').val()
	name = $('#name').val()
	phone = $('#phone').val()

	data = {_token:token}
	data.email = email
	data.name = name
	data.phone = phone

	if name.trim() == ""
		$('#name').addClass 'invalid'
		$('.fa-spinner').addClass 'hidden'
		$('#change-user-profile').removeClass 'hidden'
		return
	password = $('#password').val()
	password_repeat = $('#password_repeat').val()
	if password.trim() != "" && password_repeat.trim() != password.trim()
		toastr.error('Parolele trebuie să coincidă')
		$('#password').addClass 'invalid'
		$('#password_repeat').addClass 'invalid'
		$('.fa-spinner').addClass 'hidden'
		$('#change-user-profile').removeClass 'hidden'
		return
	data.password = password
	$.post '/change-user-profile', data , (json) ->
		if !json.success
			toastr.error(json.message)
			$('.fa-spinner').addClass 'hidden'
			$('#change-user-profile').removeClass 'hidden'
			return
		else
			location.reload()
		return
	return