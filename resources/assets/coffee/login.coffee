$ ->
#On enter login
$(document).keypress (e) ->
  if e.which == 13
    $('#login').click()
  return

$('#login').click (e) ->
	$('#email').removeClass 'invalid'
	$('#password').removeClass 'invalid'
	email = $('#email').val()
	token = $('[name="_token"]').val()
	remember = $('#remember').is(':checked')

	if email.trim() == ""
		$('#email').addClass 'invalid'
		toastr.error("Te rugăm să introduci o adresă de email")
		return

	emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
	if !emailRegex.test(email)
		$('#email').addClass 'invalid'
		toastr.error("Adresa de email este invalidă")
		return

	domainCheck = /@funkycitizens.org\s*$/
	if !domainCheck.test(email)
		$('#email').addClass 'invalid'
		toastr.error("Adresa de email este invalidă")
		return

	password = $('#password').val()
	if password.trim() == ""
		$('#password').addClass 'invalid'
		toastr.error("Unul sau mai multe câmpuri sunt goale sau conțin erori!")
		return

	return
