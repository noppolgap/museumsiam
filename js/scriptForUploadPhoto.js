var temp1;
var temp2;
var temp3 = true;

$( document ).ready(function() {
	if($('.fileupload').length > 0){
	    $('.fileupload').fileupload({
	        dataType: 'json',
	        done: function (e, data) {
		        temp2 = $(this).attr('data-name');
	            $.each(data.result.files, function (index, file) {
	                var boxID = thumbBox(temp2,file.thumbnailUrl);
	                $('.image_Data').find('#input_'+boxID).val(file.url);
	            });
	        },
		    progressall: function (e, data) {
		        temp2 = $(this).attr('data-name');
		        var progress = parseInt(data.loaded / data.total * 100, 10);
		        $('#progress_'+temp2+' .upload_bar').show().css(
		            'width',
		            progress + '%'
		        );
		    },
	        stop: function (e, data) {
	           $('#progress_'+temp2+' .upload_bar').hide();
	           $('.imageBox , .OrderImageBtn').show();
	        }
	    });
	}
	
	if($('.image_Box').length > 0){
		$('.OrderImageBtn').click(function(e) {

			orderImagePage($(this).attr('data-name'));

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

    
    if($( ".OrderingImage" ).length > 0){
	    if(pop == true){
		    var pop_location = window.opener;
		}else{
			var pop_location = parent;
		}

		var imageBox = pop_location.CallParentImage(box);

	    $.each( imageBox[0], function( key, value ) {
		    $('.sortableBox').append( '<li class="ui-state-default" data-id="'+imageBox[1][key]+'" style="background-image:url(\''+value+'\');">'+(key+1)+'</li>');
		});

	    var start = 0;
	    var stop = 0;

    	$( "#sortable" ).sortable({
		    placeholder: "ui-state-highlight",
			update: function(event, ui) {
	            $("#sortable").children().each(function(i) {
	                var li = $(this);
	                li.text(i+1);

					pop_location.updateOrderImageFile(box,$(this).attr('data-id'),(i+1));

	            });
	        },
	        start: function( event, ui ) {
			    start = ui.item.index();
	        },
	        stop: function( event, ui ) {
			    stop = ui.item.index();

				pop_location.SwapParentImage(box,start,stop);

	        }
	    });
		$( "#sortable" ).disableSelection();
	}

	if($( ".sortableFile" ).length > 0){
	    if(pop == true){
		    var pop_location = window.opener;
		}else{
			var pop_location = parent;
		}
	    var start = 0;
	    var stop = 0;

    	$( "#sortable" ).sortable({
		    placeholder: "ui-state-highlight",
			update: function(event, ui) {
	            $("#sortable").children().each(function(i) {
	                /*var li = $(this);
	                li.text(i+1);*/

	                pop_location.orderFileAdd(box,$(this).attr('data-id'),(i+1));
	            });
	        },
	        start: function( event, ui ) {
	        	start = ui.item.index();
	        },
	        stop: function( event, ui ) {
			    stop = ui.item.index();

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
	var index = $('.box-tumb').length;
		index++;

	var box  = '<div class="box-tumb" id="img_'+res+'" data-id="'+index+'">';
		box += '<div class="box-pic">';
		box += '<a href="#" onclick="popupImage(\''+(file.replace("/thumbnail/", "/"))+'\'); return false;">';
		box += '<img alt="" src="'+file+'">';
		box += '</a>';
		box += '</div>';
		 
		box += '<a href="#" class="btn-delete" onclick="delImage(\''+name+'\'); return false;">';
	 
		box += '</a>';
	 
		box += '</div>';
    $('.image_'+path+'_Box').append(box).show();
    $('.image_'+path+'_data').append('<input type="hidden" name="'+path+'_file[]" id="input_'+res+'">');

    return res;
}
function delImage(id){
	$.post( "administrator/master/delete_image.php", { pid: id , type: 1})
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
		$.post( "administrator/master/delete_image.php", { pid: id , type: 2 , pname: path})
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
function orderImagePage(name){
	var imageCount = $('.box-tumb').length;
	var dataCount = $('.image_Data input').length;
	 	temp1 = $('.image_Box_add').length;
	 	temp2 = name;

	if(imageCount == 0){
		alert('คุณต้องมีรูปมากกว่า 1 รูป ถึงจะสามารถใช้ความสามารถนี้ได้');
	}else if((dataCount > 0) && (temp1 == 0)){
		alert('ขออภัย คุณไม่สามารถจัดเรียงรูปภาพได้ถ้ามีการเพิ่มรูปภาพ กรุณาบันทึก ก่อน แล้วจึงเรียกใช้ ความสามารถ นี้ใหม่');
	}else{

		try{
			$.colorbox({
				transition: 'fade',
				height:"85%",
				width:700,
				href: '../master/thumb_order.php?box='+name,
				iframe:true,
				onClosed:function(){ }
			});
		} catch(err) {
			popup('../master/thumb_order.php?pop&box='+name,'orderImagePage',720,600);
		}
	}

}
function popup(url,name,windowWidth,windowHeight){
	myleft=(screen.width)?(screen.width-windowWidth)/2:100;
	mytop=(screen.height)?(screen.height-windowHeight)/2:100;
	properties = "width="+windowWidth+",height="+windowHeight;
	properties +=",scrollbars=yes, top="+mytop+",left="+myleft;
	window.open(url,name,properties);
}
function CallParentImage(name){
	var MyImage = new Array();
		MyImage[0] = new Array();
		MyImage[1] = new Array();
	var i = 0;
	$.each( $('.image_'+name+'_Box .thumbBoxEdit'), function( key, value ) {
		MyImage[0][i] = $(this).find('.thumbBoxImage > a > img').attr('src');
		MyImage[1][i] = $(this).attr('data-id');
		i++;
	});
	return MyImage;
}
function SwapParentImage(name,start,stop){
	swapElements($('.image_'+name+'_Box .thumbBoxEdit'),start,stop);
	if(temp1 > 0){
		swapElements($('.image_'+name+'_data input[type="hidden"]'),start,stop);
	}
}
function swapElements(siblings, subjectIndex, objectIndex) {

    var subject = $(siblings.get(subjectIndex));
    var object = siblings.get(objectIndex);
    if(subjectIndex < objectIndex){
    	subject.insertAfter(object);
    }else{
    	subject.insertBefore(object);
    }
}
function updateOrderImageFile(name,id,position){
	if(temp1 == 0){
		var Count_input = $('.image_'+name+'_data input[name="order_position['+id+']"]').length;
		if(Count_input == 0){
			$('.image_'+name+'_data').append('<input type="hidden" name="order_position['+id+']" value="'+position+'">');
		}else{
			$('.image_'+name+'_data input[name="order_position['+id+']"]').val(position);
		}
	}
}

function delIconImageEdit(id  , iconT , path){
	if (confirm("คุณแน่ใจที่จะลบรูปภาพนี้")){
		$.post( "../master/delete_icon_image.php", { bannerid: id , iconType: iconT ,  pname: path})
			.done(function( data ) {
			    $('#img_edit_'+iconT+'_'+id).hide("scale" , function() {
					$(this).remove();
				});
		});
	}
}


function popupUpload(file){
	var href = '../master/video_preview.php?p='+file;

	try{
		$.colorbox({
			transition: 'fade',
			iframe:true,
			innerWidth:640,
			innerHeight:400,
			href: href
		});
	} catch(err) {
		popup(href,'popupVideo',640,400);
	}
}
function delUpload(file,name){
	if (confirm("คุณแน่ใจที่จะลบวีดีโอนี้นี้")){
		$.post( "../master/delete_video.php", { pname: file})
			.done(function( data ) {
				$('#tabs_'+name+'_1 > .DataBlock div[data-value="'+file+'"]').remove();
				$('#DataBlock_'+name+' input[data-value="'+file+'"]').remove();
		});
	}
}
 
function youtube_parser(url){
    var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
    var match = url.match(regExp);
    if (match&&match[7].length==11){
        return match[7];
    }else{
        return false;
    }
}
function popupLink(file){

	try{
		$.colorbox({
			transition: 'fade',
			iframe:true,
			innerWidth:640,
			innerHeight:400,
			href: file
		});
	} catch(err) {
		var href = '../master/video_preview.php?Link&p='+file;
		popup(href,'popupVideo',640,400);
	}
}
function delLink(file,name){
	if (confirm("คุณแน่ใจที่จะลบวีดีโอนี้นี้")){
		$('#tabs_'+name+'_3> .DataBlock div[data-value="'+file+'"]').remove();
		$('#DataBlock_'+name+' input[data-value="'+file+'"]').remove();
	}
}
function editVideoName(file,name,position){
	if(position == 1){
		var myname = 'upload|@|'+file;
	}else if(position == 2){
		var myname = 'embed|@|'+file;
	}else if(position == 3){
		var myname = 'link|@|'+file;
	}
	var str = $('#tabs_'+name+'_'+position+'> .DataBlock div[data-value="'+file+'"] .video_edit_name').val();

		myname += '|@|'+str;

	$('#DataBlock_'+name+' input[data-value="'+file+'"]').val(myname);
}
function editVideoName2(file,name,id,position){
	var str = $('#tabs_'+name+'_'+position+'> .DataBlock div[data-value="'+file+'"] .video_edit_name').val();
	var myname = id+'|@|'+str;

	$('#DataBlock_'+name).append('<input type="hidden" data-value="'+file+'" name="video_rename_'+name+'[]" value="'+myname+'">');
}
function delEditVideo(file,name,id,position){
	if (confirm("คุณแน่ใจที่จะลบวีดีโอนี้นี้")){
		if(position == 1){
			$('#tabs_'+name+'_1 > .DataBlock div[data-value="'+file+'"]').remove();
			var delValue = 'upload|@|'+id+'|@|'+file;
		}else if(position == 2){
			$('#tabs_'+name+'_2 > .DataBlock div[data-value="'+file+'"]').remove();
			var delValue = 'embed|@|'+id+'|@|'+file;
		}else if(position == 3){
			$('#tabs_'+name+'_3 > .DataBlock div[data-value="'+file+'"]').remove();
			var delValue = 'link|@|'+id+'|@|'+file;
		}

		$('#DataBlock_'+name).append('<input type="hidden" data-value="'+file+'" name="video_delete_'+name+'[]" value="'+delValue+'">');
	}
}
function returnFileExtensions(path){
	var my_array = path.split(".");
	var last_element = my_array[my_array.length - 1];
		last_element = last_element.toLowerCase();
	var image;

	switch (last_element) {
		case "mp4":
		case "webm":
		case "ogv":
		case "wmv":
		case "flv":
		case "mpg":
		case "avi":
					image = '../images/video2.svg'; break;
		case "mp3":
		case "wav":
		case "ogg":
		case "m4a":
		case "wma":
					image = '../images/sound.svg'; break;
		case "swf": image = '../images/flash.svg'; break;
		case "docx":
		case "doc":
					image = '../images/word.svg'; break;
		case "xlsx":
		case "xls":
					image = '../images/excel.svg'; break;
		case "pptx":
		case "ppt":
					image = '../images/powerpoint.svg'; break;
		case "rar":
		case "zip":
		case "7z":
					image = '../images/zip.svg'; break;
		case "pdf": image = '../images/pdf.svg'; break;
		case "txt": image = '../images/txt.svg'; break;
		case "png":
		case "jpg":
		case "jpeg":
		case "gip":
		case "bmp":
					image = '../images/picture.svg'; break;
		default   : image = '../images/file.svg'; break;

	}

	return image;
}
function orderVideoPage(page,cat,id){
	var dataCount = $('#DataBlock_'+page+' input').length;
	if(dataCount > 0){
		alert('ขออภัย คุณไม่สามารถจัดเรียงรูปไฟล์ได้ถ้ามีการเพิ่มไฟล์ใหม่ กรุณาบันทึก ก่อน แล้วจึงเรียกใช้ ความสามารถ นี้ใหม่');
	}else{
		try{
			$.colorbox({
				transition: 'fade',
				iframe:true,
				innerWidth:500,
				innerHeight:650,
				href: '../master/file_order.php?page='+page+'&cat='+cat+'&cID='+id
			});
		} catch(err) {
			popup('../master/file_order.php?pop&page='+page+'&cat='+cat+'&cID='+id,'orderFile',500,650);
		}
	}
}
