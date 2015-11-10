var str;
$(document).ready(function(){
	if($('.mytextarea').length > 0){
        tinymce.init({
            selector: ".mytextarea",
		    theme: "modern",
		    plugins: [
		        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
		        "searchreplace wordcount visualblocks visualchars code fullscreen",
		        "insertdatetime media nonbreaking save table contextmenu directionality",
		        "emoticons template paste textcolor colorpicker textpattern imagetools"
		    ],
		    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
		    toolbar2: "link image | print preview media | forecolor backcolor emoticons",
		    image_advtab: true
		});
	}

	$("#formcms").submit(function(e) {
		var error = false;
		var input1 = $('#input_content').val();
		var input2 = tinyMCE.activeEditor.getContent();
		var msg = str[0];

		if(input1 == ''){
			error = true;
			msg += str[1];
		}
		if(input2 == ''){
			error = true;
			msg += str[2];
		}

		if(error){
			e.preventDefault();
			alert(msg);
		}
	});
	$("#replyTopic").submit(function(e) {
		var error = false;
		var input1 = tinyMCE.activeEditor.getContent();
		var msg = str[0];

		if(input1 == ''){
			error = true;
			msg += str[1];
		}

		if(error){
			e.preventDefault();
			alert(msg);
		}
	});

	if($('.reportBtn').length > 0){
		$('.reportBtn').colorbox({
			iframe:true,
			width:"400px",
			height:"250px",
			onClosed:function(){
				alert('Save Complete');
			}
		});
	}
});
function editAccout(){
	if(confirm(card)){
		window.location.href = 'account-edit.php';
	}
}