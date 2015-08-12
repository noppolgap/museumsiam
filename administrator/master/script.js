$( document ).ready(function() {
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
	if($('.fileupload').length > 0){
	    $('.fileupload').fileupload({
	        dataType: 'json',
	        done: function (e, data) {
		        var name = $(this).attr('data-name');
	            $.each(data.result.files, function (index, file) {
	                var boxID = thumbBox(name,file.thumbnailUrl);
	                $('.image_Data').find('#input_'+boxID).val(file.url);
	            });
	            console.log(name);
	        },
		    progressall: function (e, data) {
		        var progress = parseInt(data.loaded / data.total * 100, 10);
		        $('#progress .upload_bar').show().css(
		            'width',
		            progress + '%'
		        );
		    },
	        stop: function (e, data) {
	           $('#progress .upload_bar').hide();
	           $('.imageBox').show();
	        }
	    });			
	}	
	if($('.orderContent').length > 0){
		
	    $( "#sortable" ).sortable({			
		    placeholder: "ui-state-highlight",
			update: function(event, ui) {
	            $("#sortable").children().each(function(i) {
	                var li = $(this);
	                var point = countList - i;
	                listOrder[point] = new Array(parseInt(li.attr("data-order")), parseInt(li.attr("data-id")),point);
	            });
	        }    
	    });
	    $( "#sortable" ).disableSelection();
	}	
	
});
function thumbBox(path,file){
	var res = file.split("/");
	var num = res.length;
	var point = num-1;
	var name = res[point];
		res = res[point].split(".");
		res = res[0];
		
	
	var box  = '<div class="thumbBoxEdit floatL p-Relative" id="img_'+res+'">';	
		box += '<div class="thumbBoxImage">';
		box += '<a href="#" onclick="popupImage(\''+(file.replace("/thumbnail/", "/"))+'\'); return false;">';
		box += '<img alt="" src="'+file+'">';
		box += '</a>';
		box += '</div>';
		box += '<div class="thumbBoxAction dNone p-Absolute">';
		box += '<a href="#" onclick="delImage(\''+name+'\'); return false;">';
		box += '<img alt="" src="../images/small-n-flat/sign-ban.svg" />';
		box += '</a>';
		box += '</div>';
		box += '</div>';
    $('.image_'+path+'_Box').prepend(box).show();
    $('.image_'+path+'_data').append('<input type="hidden" name="'+path+'_file[]" id="input_'+res+'">');
    
    return res;
}
function delImage(id){
	$.post( "../master/delete_image.php", { pid: id })
		.done(function( data ) {
			var res = id.split(".");
				res = res[0];
		    $('#img_'+res).hide("scale" , function() {
				$(this).remove();
			});	
			$('#input_'+res).remove();
	});		

}
function popupImage(href){
	try{
		$.colorbox({
			transition: 'fade',
			height:"75%",
			href: href
		});	
	} catch(err) {
		window.open(href,'_blank');
	}
}
function orderPage(id){
	var href = 'order.php';
	try{
		$.colorbox({
			transition: 'fade',
			height:"75%",
			width:600,
			href: href,
			iframe:true,
			onClosed:function(){ window.location.reload(); }
		});	
	} catch(err) {
		window.open(href,'_blank');
	}	
}
function updateOreder(){
	
	var order_data = new Array();
	var index = 0;
	
	$.each( listOrder, function( key, value ) {
	  if(value != undefined){
		if(listOrder[key][0] != listOrder[key][2]){
	  		order_data[index] = new Array(listOrder[key][1],listOrder[key][2]);
	  		index++;
	  	}
	  }
	});	
	console.log(order_data);
	$.post( "order.php", { update: true, order_data: order_data })
	  .done(function( data ) {
	    alert('Update Complete');
	 });
}