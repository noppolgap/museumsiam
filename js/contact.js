$(document).ready(function() {
	$('#positionTxt').change(function() {
  		$('.box-select span').text($("#positionTxt option:selected").text());
	});



	$('.btnSubmit').click(function(e) {

		$('#myform').submit();

		e.preventDefault();
		e.stopPropagation();
	});

	$('.btnReset').click(function(e) {

		$('#myform')[0].reset();

		e.preventDefault();
		e.stopPropagation();
	});
	$("#myform").on('submit',function(){

		var Enquiry = $('#positionTxt').val();
		var name = $('#txtName').val();
		var address = $('#txtAddress').val();
		var Email = $('#txtMail').val();
		var Tel = $('#txtTel').val();
		var msg = $('#txtText').val();

		if(Enquiry == 0){
			alert('Plase select Enquiry');
		    return false;
		}else if(name == ''){
			alert('Plase insert Name');
		    return false;
		}else if(address == ''){
			alert('Plase insert Address');
		    return false;
		}else if(Email == ''){
			alert('Plase insert Email');
		    return false;
		}else if(!isEmailAddress(Email)){
			alert('Email Incorrect');
		    return false;
		}else if(Tel == ''){
			alert('Plase insert Telephone');
		    return false;
		}else if(msg == ''){
			alert('Plase insert Message');
		    return false;
		}else{
		    if(grecaptcha.getResponse() == '') {
				alert("Please fill the captcha!");
				return false;
		    } else {
		        return true;
		    }
		}
	});

});
function isEmailAddress(email) {
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
}