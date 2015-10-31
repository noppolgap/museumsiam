var checkMouse = true;

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