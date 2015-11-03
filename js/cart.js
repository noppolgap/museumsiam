var checkMouse = true;


$( document ).ready(function() {
	if($('select[name="province"]').length > 0 ){
		$(document).on('change', 'select[name="province"]', function() {
			$.getJSON( "register-action.php", { type: "province", id: $(this).val() } )
			  	.done(function( json ) {
			    	$( ".province_box strong" ).text( $( 'select[name="province"] option:selected' ).text() );
			    	$( 'select[name="district"]').html('<option value="0">'+$( ".district_box strong" ).attr('title')+'</option>');
			    	$( 'select[name="sub_district"]').html('<option value="0">'+$( ".sub_district_box strong" ).attr('title')+'</option>');
					$.each( json, function( i, item ) {
						$( 'select[name="district"]').append( '<option value="'+i+'">'+item+'</option>' );
			      	});
			      	$( ".district_box strong" ).text( $( ".district_box strong" ).attr('title') );
			      	$( ".sub_district_box strong" ).text( $( ".sub_district_box strong" ).attr('title') );
			  	})
		});
		$(document).on('change', 'select[name="district"]', function() {
			$.getJSON( "register-action.php", { type: "district", id: $(this).val() } )
			  	.done(function( json ) {
			    	$( ".district_box strong" ).text( $( 'select[name="district"] option:selected' ).text() );
			    	$( 'select[name="sub_district"]').html('<option value="0">'+$( ".sub_district_box strong" ).attr('title')+'</option>');
					$.each( json, function( i, item ) {
						$( 'select[name="sub_district"]').append( '<option value="'+i+'">'+item+'</option>' );
			      	});
			      	$( ".sub_district_box strong" ).text( $( ".sub_district_box strong" ).attr('title') );
			  	})
		});
		$(document).on('change', 'select[name="sub_district"]', function() {
			$( ".sub_district_box strong" ).text( $( 'select[name="sub_district"] option:selected' ).text() );
		});
	}
});
function addtocart(id){
	if(checkMouse){
		checkMouse = false;
		$.post( "shopping-cart-ajax.php", { id: id })
		  .done(function( data ) {
		  	$('.btn-cart span').text(data);
			checkMouse = true;
			alert('add to cart');
		  });
	}
}
function saveFormCart(str){
	$('#hidden_action').val(str);
	$('#cart_form').submit();
}
function checkForm(){
	if(($('input[name="address"]:checked').length) == 0){
		alert('Plase Select Address');
	}else{
		var radio = $('input[name="address"]:checked').val();
		if(radio == 0){
			var error = false;
			var msg = 'ไม่สามารถบันทึกได้';
			var name = $('input[name="name"]').val();
			var adds = $('textarea[name="adds"]').val();
			var province = $('select[name="province"]').val();
			var district = $('select[name="district"]').val();
			var sub_district = $('select[name="sub_district"]').val();
			var postcode = $('input[name="postcode"]').val();


			if(name == ''){
				error = true;
				msg += "\n\tกรุณาระบุชื่อ";
			}
			if(adds == ''){
				error = true;
				msg += "\n\tกรุณาระบที่อยู่";
			}
			if(province == 0){
				error = true;
				msg += "\n\tกรุณาระบุจังหวัด";
			}
			if(district == 0){
				error = true;
				msg += "\n\tกรุณาระบุ อำเภอ/เขต";
			}
			if(sub_district == 0){
				error = true;
				msg += "\n\tกรุณาระบุ ตำบล/แขวง";
			}
			if(postcode == ''){
				error = true;
				msg += "\n\tกรุณาระบุ รหัสไปรษณีย์";
			}

			if(error){
				alert(msg);
			}else{
				$('#form_action').submit();
			}
		}else{
			$('#form_action').submit();
		}
	}
}