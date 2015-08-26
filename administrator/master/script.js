var temp1;
var temp2;

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
	           $('.imageBox , .OrderImageBtn').show();
	        }
	    });			
	}
	if($('.image_Box').length > 0){
		$('.OrderImageBtn').click(function(e) {
			orderImagePage();
		
			e.preventDefault();
			e.stopPropagation();
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

    if($('.DatePicker').length > 0){	
		$('.DatePicker').datepicker({
	      showOn: "button",
	      buttonImage: "../images/small-n-flat/calendar.svg",
	      buttonImageOnly: true,
	      buttonText: "Select date",
	      dateFormat: 'd MM yy'
	    });	
    }
    if($('.DatetimePicker').length > 0){	
		$('.DatetimePicker').datetimepicker({
	      showOn: "button",
	      buttonImage: "../images/small-n-flat/calendar.svg",
	      buttonImageOnly: true,
	      buttonText: "Select date",
	      dateFormat: 'd MM yy'
	    });	
    }
    if($( "input[name='checkall']" ).length > 0){
	    temp1 = $( "input[data-pageDelete]" ).attr('data-pageDelete');

	    $("input[name='checkall']").on('change', function () {
		 	if($("input[name='checkall']").is(':checked')){
			    $(".checkboxContent input[type='checkbox']").prop('checked',true);
			}else{
			    $(".checkboxContent input[type='checkbox']").prop('checked',false);
			} 
		});
		
		$('.DeleteContentBtn').click(function(e) {
			var ID = $(this).attr('data-id');
			var title = $('.Main_Content[data-id="'+ID+'"] > .nameContent > div > a').text();
			
			if (confirm("ยืนยันการลบ "+title)) {
				deleteData(ID);  
			}	
		
			e.preventDefault();
			e.stopPropagation();
		});   
	}
    
    if($( ".OrderingImage" ).length > 0){
	    if(pop == true){
	    	var imageBox = window.opener.CallParentImage();
	    }else{
		    var imageBox = parent.CallParentImage();
	    }
	    
	    $.each( imageBox[0], function( key, value ) {
		    $('.sortableBox').append( '<li class="ui-state-default" data-id="'+imageBox[1][key]+'" style="background-image:url(\''+value+'\');">'+(key+1)+'</li>');
		});
	    
	    var start = 0;
	    var stop = 0;
	    var imageDataID = 0;
    	$( "#sortable" ).sortable({			
		    placeholder: "ui-state-highlight",
			update: function(event, ui) {
	            $("#sortable").children().each(function(i) {
	                var li = $(this);
	                li.text(i+1);
	            });
	        },
	        start: function( event, ui ) {
			    start = ui.item.index();
	        },  
	        stop: function( event, ui ) {
			    stop = ui.item.index();
			    imageDataID = $(this).attr('data-id');
			    
			    if(pop == true){
			    	window.opener.SwapParentImage(start,stop);
			    }else{
				    parent.SwapParentImage(start,stop);
			    }			    
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
	var index = $('.image_'+path+'_data input[type="hidden"]').length;
		index++;
	
	var box  = '<div class="thumbBoxEdit floatL p-Relative" id="img_'+res+'" data-id="'+index+'">';	
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
    $('.image_'+path+'_Box').append(box).show();
    $('.image_'+path+'_data').append('<input type="hidden" name="'+path+'_file[]" id="input_'+res+'">');
    
    return res;
}
function delImage(id){
	$.post( "../master/delete_image.php", { pid: id , type: 1})
		.done(function( data ) {
			var res = id.split(".");
				res = res[0];
		    $('#img_'+res).hide("scale" , function() {
				$(this).remove();
			});	
			$('#input_'+res).remove();
	});		

}
function delImageEdit(id , path){
	if (confirm("คุณแน่ใจที่จะลบรูปภาพนี้")){
		$.post( "../master/delete_image.php", { pid: id , type: 2 , pname: path})
			.done(function( data ) {
			    $('#img_edit_'+id).hide("scale" , function() {
					$(this).remove();
				});	
		});
	}
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
function orderPage(path){
	var href = path;
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
function updateOreder(path){
	
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
	$.post( path, { update: true, order_data: order_data })
	  .done(function( data ) {
	    alert('Update Complete');
	 });
}
function deleteCheck(){
	if (confirm("ยืนยันการลบทุกหัวข้อที่ได้เลือก")){
		$('.checkboxContent input:checkbox:checked').map(function() {
		    deleteData(this.value);
		});	
		
		$("input[name='checkall']").prop('checked',false);
	}
}
function deleteData(id){
$.post( temp1, { id: id })
  .done(function( data ) {
	$('.Main_Content[data-id="'+id+'"]').hide("blind" , function() {
		$(this).remove();
		var num_rows = $('.Main_Content').length;
		if(num_rows == 0){
			window.location.reload();
		}else{
			$('.RowCount').text(parseInt($('.RowCount').text())-1);
		}	
	});
  });	

}
function orderImagePage(){
	var imageCount = $('.thumbBoxEdit').length;
	if(imageCount == 0){
		alert('คุณต้องมีรูปมากกว่า 1 รูป ถึงจะสามารถใช้ความสามารถนี้ได้');
	}else{
		/*
		try{
			$.colorbox({
				transition: 'fade',
				height:"85%",
				width:700,
				href: '../master/thumb_order.php',
				iframe:true,
				onClosed:function(){ }
			});	
		} catch(err) {
			popup('../master/thumb_order.php?pop','orderImagePage',720,600);
		}	
		*/
		popup('../master/thumb_order.php?pop','orderImagePage',720,600);
	}
		
}
function popup(url,name,windowWidth,windowHeight){    
	myleft=(screen.width)?(screen.width-windowWidth)/2:100;	
	mytop=(screen.height)?(screen.height-windowHeight)/2:100;	
	properties = "width="+windowWidth+",height="+windowHeight;
	properties +=",scrollbars=yes, top="+mytop+",left="+myleft;   
	window.open(url,name,properties);
}
function CallParentImage(){
	var MyImage = new Array();
		MyImage[0] = new Array();
		MyImage[1] = new Array();
	var i = 0;
	$.each( $('.thumbBoxEdit'), function( key, value ) {
		MyImage[0][i] = $(this).find('.thumbBoxImage > a > img').attr('src'); 
		MyImage[1][i] = $(this).attr('data-id'); 
		i++; 
	});
	return MyImage;
}
function SwapParentImage(start,stop){
	console.log(start+' '+stop);
	
	swapElements($('.thumbBoxEdit'),stop,start);
	swapElements($('.image_Data input[type="hidden"]'),stop,start);
}
function swapElements(siblings, subjectIndex, objectIndex) {
    var subject = $(siblings.get(subjectIndex));
    var object = siblings.get(objectIndex);
    subject.insertAfter(object);
}
