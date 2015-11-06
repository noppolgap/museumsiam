$(document).ready(function() {
		$('.DatePicker').datepicker({
	      dateFormat: 'd MM yy',
	      changeMonth: true,
          changeYear: true,
          yearRange: "-80:+0"

	    });
});
function checkForm(){
		var jobname = $('#jobname').val();
		var name_th = $('#name_th').val();
		var name_eng = $('#name_eng').val();
		var birthdate = $('#birthdate').val();
		var telephone = $('#telephone').val();
		var Email = $('#email').val();
		var mobile = $('#mobile').val();
		var address = $('#address').val();
		var salary = $('#salary').val();


		if(jobname == 0){
			alert('Plase select Enquiry');
		    return false;
		}else if(name_th == ''){
			alert('Plase insert Name');
		    return false;
		}else if(name_eng == ''){
			alert('Plase insert Name');
		    return false;
		}else if(birthdate == ''){
			alert('Plase insert Birth Date');
		    return false;
		}else if(telephone == ''){
			alert('Plase insert Telephone');
		    return false;
		}else if(Email == ''){
			alert('Plase insert Email');
		    return false;
		}else if(!isEmailAddress(Email)){
			alert('Email Incorrect');
		    return false;
		}else if(mobile == ''){
			alert('Plase insert Mobile');
		    return false;
		}else if(address == ''){
			alert('Plase insert Address');
		    return false;
		}else if(salary == ''){
			alert('Plase insert Salary');
		    return false;
		}else{
		    if(grecaptcha.getResponse() == '') {
				alert("Please fill the captcha!");
				return false;
		    } else {
		        $('#myform').submit();
		    }
		}
}
function isEmailAddress(email) {
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
}