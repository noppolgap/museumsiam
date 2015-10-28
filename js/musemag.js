$(document).ready(function() {
	$('#btnMuseMag').bind('click', function(e) {
		e.preventDefault();
		if ($('#txtEmailMuseMag').val() == '') {
			alert(please_fill_email);
			return;
		} else if (!isEmailAddress($('#txtEmailMuseMag').val())) {
			alert( email_invalid);
			return;
		}
		$.post('musemag_action.php', {
			REGIS : $('#txtEmailMuseMag').val()
		}).done(function(data) {
			alert(regis_complete);
			$('#txtEmailMuseMag').val('');
			//console.log(data);
		});
	});

});

function isEmailAddress(email) {
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
}