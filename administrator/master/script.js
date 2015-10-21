var temp1;
var temp2;
var temp3 = true;

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
	if($('.fileupload360').length > 0){
	    $('.fileupload360').fileupload({
	        dataType: 'json',
	        done: function (e, data) {
		        temp2 = $(this).attr('data-name');
	            $.each(data.result.files, function (index, file) {
    				$('.image360_'+temp2+'_data').append('<input type="hidden" name="'+temp2+'_file360[]" value="'+file.url+'">');

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

	        	var html  = '';
	        		html += '<span class="p-Relative" id="preview360Box'+temp2+'">';
	        		html += '<a href="#" onclick="preview360(\''+temp2+'\','+false+',\'\',\'\'); return false;" >';
	        		html += '<img class="dBlock image360thumb" src="'+$('input[name="'+temp2+'_file360[]"]').val()+'">';
	        		html += '</a>';
	        		html += '<img alt="" src="../images/small-n-flat/sign-ban.svg" class="p-Absolute image360thumbDel" onclick="deleteTemp360(\''+temp2+'\');" />';
	        		html += '</span>';

	           $('#progress_'+temp2+' .upload_bar').hide();
	           $('.image360_'+temp2+'_Box').html(html).show();
	           $('#fileupload360_'+temp2).hide();
	           $('#preview360Box'+temp2+' .image360thumb').load(function() {
        			pic_real_width = this.width;
        			pic_real_width = pic_real_width - 5;
        			$('#preview360Box'+temp2+' .image360thumbDel').css('left',pic_real_width);
    		   });


	           /*
	           var d = new Date();
			   var patten = d.getTime();
			   	   patten += '_'+Math.floor((Math.random() * 1000) + 1);
			   $('#fileupload360_'+temp2).attr('data-url','../../assets/plugin/upload/three_hundred_and_sixty/?n='+patten);
	           $('input[name="box_image360_'+temp2+'"]').val(patten);
	           */
	        }
	    });
	}
	if($('.VideoUpload').length > 0){
		$('.VideoUpload').click(function() {
			if(temp3){
				var name = $(this).attr('data-name');
		    	$('form[name="form_' + name + '"] input[type="file"]').click();
		    }else{
		    	alert('คุณสามารถอัพโหลดได้ทีล่ะ 1 ไฟล์');
		    }
		});
	    $(".inputUploadVideo").change(function() {
	    	var name = $(this).attr('data-name');

			if($('iframe[name=iframeTarget]').length<1){
				var iframe=document.createElement('iframe');
				$(iframe).css('display','none');
				$(iframe).attr('src','#');
				$(iframe).attr('name','iframeTarget');
				$('body').append(iframe);
			}
			$('form[name="form_' + name + '"]').submit();
	        $('#VideoUpload_loading_' + name).fadeIn();
	        temp3 = false;
	    });

	    $('.EmbedUpload').click(function() {
	    	var name = $(this).attr('data-name');
			var Myvalue = $('input[name="Embed_input_' + name + '"]').val();
			if(Myvalue == ''){
				alert('กรุณากรอกข้อมูล');
			}else{
				Myvalue = youtube_parser(Myvalue);
				if(!Myvalue){
					alert('ข้อมูลไม่ถูกต้อง');
				}else{
					var countEmbed = $('#tabs_'+name+'_2 > .DataBlock div[data-value="'+Myvalue+'"]').length;
					if(countEmbed > 0){
						alert('ข้อมูลนี้ได้เพิ่มไปแล้ว');
					}else{
						var	msg  = '<div class="Embed_tab" data-value="'+Myvalue+'">';
							msg += '<a href="#" onclick="popupEmbed(\''+Myvalue+'\'); return false;">';
							msg += '<span data-Name="'+Myvalue+'"></span>';
							msg += '</a>';
							msg += '<input name="video_name" class="video_edit_name" disabled data-value="'+Myvalue+'" value="https://youtu.be/'+Myvalue+'" onblur="editVideoName(\''+Myvalue+'\',\''+name+'\', 2)" />';
							msg += '<a href="#" onclick="popupEmbed(\''+Myvalue+'\'); return false;">';
							msg += '<span class="EmbedAction viewEmbed"></span>';
							msg += '</a>';
							msg += '<a href="#" onclick="delEmbed(\''+Myvalue+'\',\''+name+'\'); return false;">';
							msg += '<span class="EmbedAction delEmbed"></span>';
							msg += '</a>';
							msg += '</div>';

							$('#tabs_'+name+'_2 .DataBlock').append(msg).show().find('span[data-Name="'+Myvalue+'"]').css('background-image','url(http://img.youtube.com/vi/'+Myvalue+'/maxresdefault.jpg)');

							$('#DataBlock_'+name).append('<input type="hidden" data-value="'+Myvalue+'" name="video_'+name+'[]" value="embed|@|'+Myvalue+'|@|'+Myvalue+'">');
					}
				}
			}
			$('input[name="Embed_input_' + name + '"]').val('');
	    });
	    $('.LinkUpload').click(function() {
	    	var name = $(this).attr('data-name');
			var Myvalue = $('input[name="Link_input_' + name + '"]').val();
			if(Myvalue == ''){
				alert('กรุณากรอกข้อมูล');
			}else{
				var countEmbed = $('#tabs_'+name+'_3 > .DataBlock div[data-value="'+Myvalue+'"]').length;
				if(countEmbed > 0){
					alert('ข้อมูลนี้ได้เพิ่มไปแล้ว');
				}else{
					var	msg  = '<div class="Link_tab" data-value="'+Myvalue+'">';
						msg += '<a href="#" onclick="popupLink(\''+Myvalue+'\'); return false;">';
						msg += '<span class="LinkVideoBox" data-Name="'+Myvalue+'"></span>';
						msg += '</a>';
						msg += '<input name="video_name" class="video_edit_name" data-value="'+Myvalue+'" value="'+Myvalue+'" onblur="editVideoName(\''+Myvalue+'\',\''+name+'\', 3)" />';
						msg += '<a href="#" onclick="popupLink(\''+Myvalue+'\'); return false;">';
						msg += '<span class="LinkAction viewLink"></span>';
						msg += '</a>';
						msg += '<a href="#" onclick="delLink(\''+Myvalue+'\',\''+name+'\'); return false;">';
						msg += '<span class="LinkAction delLink"></span>';
						msg += '</a>';
						msg += '</div>';

						$('#tabs_'+name+'_3 .DataBlock').append(msg).show().find('span[data-Name="'+Myvalue+'"]').css('background-image','url('+returnFileExtensions(Myvalue)+')');

						$('#DataBlock_'+name).append('<input type="hidden" data-value="'+Myvalue+'" name="video_'+name+'[]" value="link|@|'+Myvalue+'|@|'+Myvalue+'">');



				}
			}
			$('input[name="Link_input_' + name + '"]').val('');
	    });
	}
	if($('.OrderVideoBtn').length > 0){
		$('.OrderVideoBtn').click(function(e) {

			orderVideoPage($(this).attr('data-name') , $(this).attr('data-cat') , $(this).attr('data-cID'));

			e.preventDefault();
			e.stopPropagation();
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
	      dateFormat: 'd MM yy',
	      setDate : new Date()
	    });

	    if ($('.DatetimePicker').val() == '' )
	    	$('.DatetimePicker').val($.datepicker.formatDate( "d MM yy", new Date()));

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
    if($( ".tabs" ).length > 0){
		$( ".tabs" ).tabs();
	}
});
function thumbBox(path,file){
	var res = file.split("/");
	var num = res.length;
	var point = num-1;
	var name = res[point];
		res = res[point].split(".");
		res = res[0];
	var index = $('.thumbBoxEdit').length;
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
function orderImagePage(name){
	var imageCount = $('.thumbBoxEdit').length;
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
function videoCallBack(name,file,original){
	$('#VideoUpload_loading_' + name).hide();

	var	msg  = '<div class="Upload_tab" data-value="'+file+'">';
		msg += '<a href="#" onclick="popupUpload(\''+file+'\'); return false;">';
		msg += '<span class="UploadVideoBox" data-Name="'+file+'"></span>';
		msg += '</a>';
		msg += '<input name="video_name" class="video_edit_name" data-value="'+file+'" value="'+original+'" onblur="editVideoName(\''+file+'\',\''+name+'\', 1)" />';
		msg += '<a href="#" onclick="popupUpload(\''+file+'\'); return false;">';
		msg += '<span class="UploadAction viewUpload"></span>';
		msg += '</a>';
		msg += '<a href="#" onclick="delUpload(\''+file+'\',\''+name+'\'); return false;">';
		msg += '<span class="UploadAction delUpload"></span>';
		msg += '</a>';
		msg += '</div>';

    $('#tabs_' +name+'_1 .DataBlock').append(msg).show().find('span[data-Name="'+file+'"]').css('background-image','url('+returnFileExtensions(file)+')');

	$('#DataBlock_'+name).append('<input type="hidden" data-value="'+file+'" name="video_'+name+'[]" value="upload|@|'+file+'|@|'+original+'">');

	temp3 = true;
}
function videoAlert(name){
	if(name == ''){
		$('.VideoUpload_loading').hide();
	}else{
		$('#VideoUpload_loading_' + name).hide();
	}
	temp3 = true;

	alert('Upload Error');
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
function popupEmbed(file){
	try{
		$.colorbox({
			transition: 'fade',
			iframe:true,
			innerWidth:640,
			innerHeight:400,
			href: 'http://www.youtube.com/embed/'+file+'?rel=0&amp;wmode=transparent'
		});
	} catch(err) {
		var href = '../master/video_preview.php?Embed&p='+file;
		popup(href,'popupVideo',640,400);
	}
}
function delEmbed(file,name){
	if (confirm("คุณแน่ใจที่จะลบวีดีโอนี้นี้")){
		$('#tabs_'+name+'_2 > .DataBlock div[data-value="'+file+'"]').remove();
		$('#DataBlock_'+name+' input[data-value="'+file+'"]').remove();
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
function orderFileAdd(page,id,position){
		var Count_input = $('#DataBlock_'+page+' input[name="order_position['+id+']"]').length;
		if(Count_input == 0){
			$('#DataBlock_'+page).append('<input type="hidden" name="order_'+page+'_position['+id+']" value="'+position+'">');
		}else{
			$('#DataBlock_'+page+' input[name="order_'+page+'_position['+id+']"]').val(position);
		}
}
function preview360(page,database,cat,id){
	if(database){
		var path = '../master/preview360.php?page='+page+'&cat='+cat+'&cID='+id;
	}else{
		var box = $('.image360_' + page + '_data input[name="box_image360_'+ page + '"]').val();
		var path = '../master/preview360.php?box='+box;
	}
		try{
			$.colorbox({
				transition: 'fade',
				iframe:true,
				innerWidth:650,
				innerHeight:695,
				href: path
			});
		} catch(err) {
			popup(path,'preview360',650,695);
		}
}
function deleteTemp360(name){
	if (confirm("คุณแน่ใจที่จะลบภาพนี้")){
		var obj = $('.image360_'+temp2+'_data input[name="'+temp2+'_file360[]"]');
		$.each( obj, function( key, value ) {
			$.post( "../master/del360.php", { name: this.value });
		});
		$('.image360_'+temp2+'_data input[name="'+temp2+'_file360[]"]').remove();
	    $('.image360_'+temp2+'_Box').html('').hide();
	    $('#fileupload360_'+temp2).show();
	}
}
function deletePreview360(name,file){
	if (confirm("คุณแน่ใจที่จะลบภาพนี้")){
		$('.image360_'+name+'_data').append('<input type="hidden" name="'+name+'_Del360" value="'+file+'">');

		var obj = $('.image360_'+name+'_data input[name="'+name+'_file360[]"]');
		$.each( obj, function( key, value ) {
			$.post( "../master/del360.php", { name: this.value });
		});
		$('.image360_'+name+'_data input[name="'+name+'_file360[]"]').remove();
	    $('.image360_'+name+'_Box').html('').hide();
	    $('#fileupload360_'+name).show();
	}
	/*
	if (confirm("คุณแน่ใจที่จะลบภาพนี้")){
		var obj = $('.image360_'+name+'_data input[name="'+name+'_file360[]"]');
		$.each( obj, function( key, value ) {
			//$.post( "../master/del360.php", { name: this.value });
			//$('.image360_'+temp2+'_data').append('<input type="hidden" name="'+temp2+'_file360[]" value="'+file.url+'">');
		});

		//$('.image360_'+name+'_data input[name="'+name+'_file360[]"]').remove();
	    $('.image360_'+name+'_Box').html('').hide();
	    $('#fileupload360_'+name).show();
	}
	*/
}