$(document).ready (function (){
	
	$('#btnLogin').bind( 'click' , function (){
	//	alert ('Mail : ' + $('#txtEmail').val() + ' Pwd:' + $('#txtPwd').val() +  ' Login Click') ; 
		$.post('login-action.php', {
					UID : $('#txtEmail').val()  , 
					PWD : $('#txtPwd').val()
				}).done(function(data) {
					 
					console.log('done : ' + data) ;
				});
	
	});
	
});
