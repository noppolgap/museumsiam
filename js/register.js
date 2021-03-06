var mailStaus = 0;
$( document ).ready(function() {
	$(document).on('change', 'select[name="province"]', function() {	
		$.getJSON( "register-action.php", { type: "province", id: $(this).val() } )
		  	.done(function( json ) {
		    	$( ".province_box span" ).text( $( 'select[name="province"] option:selected' ).text() );
		    	$( 'select[name="district"]').html('<option value="0">'+$( ".district_box span" ).attr('title')+'</option>');
		    	$( 'select[name="sub_district"]').html('<option value="0">'+$( ".sub_district_box span" ).attr('title')+'</option>');
				$.each( json, function( i, item ) {
					$( 'select[name="district"]').append( '<option value="'+i+'">'+item+'</option>' );
		      	});
		      	$( ".district_box span" ).text( $( ".district_box span" ).attr('title') );
		      	$( ".sub_district_box span" ).text( $( ".sub_district_box span" ).attr('title') );
		  	})	  	    
	});
	$(document).on('change', 'select[name="district"]', function() {	
		$.getJSON( "register-action.php", { type: "district", id: $(this).val() } )
		  	.done(function( json ) {
		    	$( ".district_box span" ).text( $( 'select[name="district"] option:selected' ).text() );
		    	$( 'select[name="sub_district"]').html('<option value="0">'+$( ".sub_district_box span" ).attr('title')+'</option>');
				$.each( json, function( i, item ) {
					$( 'select[name="sub_district"]').append( '<option value="'+i+'">'+item+'</option>' );
		      	});
		      	$( ".sub_district_box span" ).text( $( ".sub_district_box span" ).attr('title') );
		  	})	  	    
	});
	$(document).on('change', 'select[name="sub_district"]', function() {
		$( ".sub_district_box span" ).text( $( 'select[name="sub_district"] option:selected' ).text() );
	});	
		
	$('.btnSubmit').click(function(e) {
		$("#myform").submit();
		
        e.preventDefault();
        e.stopPropagation();
    });
	  
	$('.btnReset').click(function(e) {
		$('#myform')[0].reset();
		
		$( ".province_box span" ).text( $( ".province_box span" ).attr('title') );
		$( ".district_box span" ).text( $( ".district_box span" ).attr('title') );
		$( ".sub_district_box span" ).text( $( ".sub_district_box span" ).attr('title') );
		
		$( 'select[name="district"]').html('<option value="0">'+$( ".district_box span" ).attr('title')+'</option>');
		$( 'select[name="sub_district"]').html('<option value="0">'+$( ".sub_district_box span" ).attr('title')+'</option>');
		
        e.preventDefault();
        e.stopPropagation();
    });	 
	
	$('.checkIDCard').click(function(e) {
		
		var idcard 	= $('input[name="idcard"]').val();
		if(idcard == ''){
			alert(mytext['warning1']+" "+mytext['idcard']);
		}else if(!validatePID(idcard)){
			alert(mytext['idcard']+" "+mytext['warning5']);
		}else{
			alert(mytext['warning6']);
		}
		
        e.preventDefault();
        e.stopPropagation();
    });	
    
    $('.checkEmail').click(function(e) { 
	    
	    var email 	= $('input[name="email"]').val();
		if(email == ''){
			alert(mytext['warning1']+" "+mytext['email']);
		}else if(!isEmailAddress(email)){
			alert(mytext['warning3']);
		}else{
			$.post( "register-action.php", { type: "email", email: email })
			  .done(function( data ) {
				  if(data == 0){
					  alert(mytext['warning6']);
				  }else{
					  alert(mytext['warning7']);
				  }
			  });
		}		
		  
        e.preventDefault();
        e.stopPropagation();
    });
    
    $('input[name="email"]').on('blur',function(){
	    var email 	= $('input[name="email"]').val();
		if(email == ''){
			mailStaus = 2;
		}else if(!isEmailAddress(email)){
			mailStaus = 2;
		}else{
			$.post( "register-action.php", { type: "email", email: email })
			  .done(function( data ) {
				  if(data == 0){
				  	mailStaus = 0;
				  }else{
				  	mailStaus = 1;
				  }
			  });
		}	    
	});	

    if($('.DatePicker').length > 0){	
		$('.DatePicker').datepicker({
	      dateFormat: 'd MM yy',
	      changeMonth: true,
          changeYear: true,
          yearRange: "-80:+0"
          
	    });	
    }
    
	$("#myform").on('submit',function(){

		var error = false;
		var msg = mytext['warning0'];
		var name 		= $('input[name="name"]').val();
		var surname 	= $('input[name="surname"]').val();
		var sex 		= $('input[name="sex"]').val();
		var birthday 	= $('input[name="birthday"]').val();
		var email 		= $('input[name="email"]').val();
		var password1 	= $('input[name="password1"]').val();
		var password2 	= $('input[name="password2"]').val();
		var idcard 		= $('input[name="idcard"]').val();
		var telephone 	= $('input[name="telephone"]').val();
		var mobile 		= $('input[name="mobile"]').val();
		var fax 		= $('input[name="fax"]').val();
		var postcode	= $('input[name="postcode"]').val();

		if(name == ''){
			msg += "\n - "+mytext['warning1']+" "+mytext['name'];
			error = true;
		}
		if(surname == ''){
			msg += "\n - "+mytext['warning1']+" "+mytext['surname'];
			error = true;
		}
		if(birthday == ''){
			msg += "\n - "+mytext['warning1']+" "+mytext['birthday'];
			error = true;
		}	
		if(email == ''){
			msg += "\n - "+mytext['warning1']+" "+mytext['email'];
			error = true;
		}else if(!isEmailAddress(email)){
			msg += "\n - "+mytext['warning3'];
			error = true;
		}else if(mailStaus == 1){
			msg += "\n - "+mytext['warning7'];
			error = true;
		}	
		if(password1 == ''){
			msg += "\n - "+mytext['warning1']+" "+mytext['password1'];
			error = true;
		}else if(password1.length < 6){
			msg += "\n - "+mytext['warning4'];
			error = true;
		}	
		if(password2 == ''){
			msg += "\n - "+mytext['warning1']+" "+mytext['password2'];
			error = true;
		}else if(password1 != password2){
			msg += "\n - "+mytext['warning2'];
			error = true;
		}
		if((!validatePID(idcard)) && (idcard != '')){
			msg += "\n - "+mytext['idcard']+" "+mytext['warning5'];
			error = true;
		}	
		if(grecaptcha.getResponse() == '') {
			msg += "\n - "+mytext['warning1']+" "+mytext['captcha'];
			error = true;
		}
			
		if(error){
			alert(msg);
			return false;
		}else{
		    return true;
		}		

	});	    
     
});  
function isEmailAddress(email) {
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);   
}
function validatePID(pid){
    pid = pid.toString().replace(/\D/g,'');
    if(pid.length == 13){
        var sum = 0;
        for(var i = 0; i < pid.length-1; i++){
            sum += Number(pid.charAt(i))*(pid.length-i);
        }
        var last_digit = (11 - sum % 11) % 10;
        return pid.charAt(12) == last_digit;
    }else{
        return false;
    }
}