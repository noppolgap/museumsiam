$(document).ready(function (){
	
 // if($('.mytextarea').length > 0){
        // tinymce.init({
            // selector: ".mytextarea",
		    // theme: "modern",
  			// image_advtab: true
	  // });
	 // }
	
	$('#btnSubmit').bind('click' , function (e){
		e.preventDefault(); 
		
		 var ret = true;

		$('#nameThError').hide();
		$('#nameEnError').hide();
		$('#briefThError').hide();
		$('#briefEnError').hide();
		$('#detailThError').hide();
		$('#detailEnError').hide();
		if ($('#txtDescLoc').val() == '') {
			ret = false;
			$('#nameThError').show();
		}
		if ($('#txtDescEng').val() == '') {
			ret = false;
			$('#nameEnError').show();
		}

			if ($('#txtDetailLoc').val() == '') {
		//if (tinyMCE.get('txtDetailLoc').getContent() == '') {
			ret = false;
			$('#detailThError').show();
		}
		
			if ($('#txtDetailEng').val() == '') {
		//if (tinyMCE.get('txtDetailEng').getContent() == '') {
			ret = false;
			$('#detailEnError').show();
		}
		if (ret) {
			document.getElementById("frmcms").submit();
		} else
			return false;
			
	});
	
});
