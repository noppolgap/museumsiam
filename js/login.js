$(document).ready(function() {

	$('#btnLogin').bind('click', function() {

		if ($('#txtEmail').val() == '')
			alert('กรุณาระบุชื่อผู้ใช้งาน');
		else if ($('#txtPwd').val() == '')
			alert('กรุณาระบุรหัสผ่าน');
			
		$.post('login-action.php', {
			UID : $('#txtEmail').val(),
			PWD : $('#txtPwd').val()
		}).done(function(data) {

			console.log('done : ' + data);
		});

	});

});
