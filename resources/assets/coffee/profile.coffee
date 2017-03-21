$ ->

$('#change-user-profile').click (e) ->
	e.preventDefault();
	$('.fa-spinner').removeClass 'hidden'
	$('#change-user-profile').addClass 'hidden'
	email = $('#email').val()
	token = $('[name="_token"]').val()
	name = $('#name').val()
	phone = $('#phone').val()

	if name.trim() == ""
		$('#name').addClass 'invalid'
		return
	$.post '/change-user-profile', {
		_token: token, 
		email: email, 
		name: name, 
		phone:phone
		} , (json) ->
		if !json.success
			toastr.error(json.message)
			$('.fa-spinner').addClass 'hidden'
			$('#change-user-profile').removeClass 'hidden'
			return
		else
			location.reload()
		return
	return
