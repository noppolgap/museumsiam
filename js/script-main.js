$(document).ready(function(){


	(function(e){e.fn.visible=function(t,n,r){var i=e(this).eq(0),s=i.get(0),o=e(window),u=o.scrollTop(),a=u+o.height(),f=o.scrollLeft(),l=f+o.width(),c=i.offset().top,h=c+i.height(),p=i.offset().left,d=p+i.width(),v=t===true?h:c,m=t===true?c:h,g=t===true?d:p,y=t===true?p:d,b=n===true?s.offsetWidth*s.offsetHeight:true,r=r?r:"both";if(r==="both")return!!b&&m<=a&&v>=u&&y<=l&&g>=f;else if(r==="vertical")return!!b&&m<=a&&v>=u;else if(r==="horizontal")return!!b&&y<=l&&g>=f}})(jQuery)

	var isiDevice = /ipad|iphone|ipod/i.test(navigator.userAgent.toLowerCase());
	var isAndroid = /android/i.test(navigator.userAgent.toLowerCase());
	var isWindowsPhone = /windows phone/i.test(navigator.userAgent.toLowerCase());

	if (isiDevice){
// 		alert("IOS");
		$(".part-top-bar").addClass("notFix");
		$("body").addClass("notFix");

		jQuery(window).scroll(function(event) {

			jQuery("#firstbox").each(function() {
				if ($("#firstbox").visible(true)) {
					$(".btn-top").fadeOut();
				} else {
					$(".btn-top").fadeIn();
				}
			});
		});

	}else if (isAndroid){
// 			alert("Android");
		$(".part-top-bar").addClass("notFix");
		$("body").addClass("notFix");

		jQuery(window).scroll(function(event) {

			jQuery("#firstbox").each(function() {
				if ($("#firstbox").visible(true)) {
					$(".btn-top").fadeOut();
				} else {
					$(".btn-top").fadeIn();
				}
			});
		});

	}else {
// 				alert("PC");
		jQuery(window).scroll(function(event) {

			jQuery("#menu").each(function() {
				if ($("#menu").visible(true)) {
					$(".part-menu").removeClass("snapmenu");
				} else {
					$(".part-menu").addClass("snapmenu");
				}
			});
			jQuery("#firstbox").each(function() {
				if ($("#firstbox").visible(true)) {
					$(".part-menu").removeClass("snapmenu");
					$(".btn-top").fadeOut();
				} else {
					$(".part-menu").addClass("snapmenu");
					$(".btn-top").fadeIn();
				}
			});
		});
	}

	$('.btn-top').click(function(){
		$("html, body").animate({ scrollTop: 0 }, 600);
		return false;
	});


	$('.menutop .sub').mouseenter(function(){
		if ($(this).hasClass("opened")) {
			$(this).children(".submenu-top").stop().slideUp();
			$(this).removeClass("rotate");
			$(this).removeClass("opened");
		}else{
			$(this).children(".submenu-top").stop().slideDown();
			$(this).addClass("rotate");
			$(this).addClass("opened");
		}
	});
	$('.menutop .sub').mouseleave(function(){
		if ($(this).hasClass("opened")) {
			$(this).children(".submenu-top").stop().slideUp();
			$(this).removeClass("rotate");
			$(this).removeClass("opened");
		}else{
			$(this).children(".submenu-top").stop().slideDown();
			$(this).addClass("rotate");
			$(this).addClass("opened");
		}
	});


	$('.menu-left .sub').mouseenter(function(){
		if ($(this).hasClass("open")) {
			$(this).children(".submenu-left").stop().slideUp();
			$(this).removeClass("open");
		}else if($(this).hasClass("active")){
			$(this).children(".submenu-left").css("display","block");
		}else{
			$(this).children(".submenu-left").stop().slideDown();
			$(this).addClass("open");
		}
	});
	$('.menu-left .sub').mouseleave(function(){
		if ($(this).hasClass("open")) {
			$(this).children(".submenu-left").stop().slideUp();
			$(this).removeClass("open");
		}else if($(this).hasClass("active")){
			$(this).children(".submenu-left").css("display","block");
		}else{
			$(this).children(".submenu-left").stop().slideDown();
			$(this).addClass("open");
		}
	});


	$('.lightbox').magnificPopup({type:'image'});
	$(".slide-other").owlCarousel({
		autoPlay: 5000,
		paginationSpeed : 500,
		slideSpeed : 500,
		navigation : false,
		pagination : false,
		rewindNav : true,
		scrollPerPage :true,
		responsive : true,
		mouseDrag : false,
		items : 5
	});

	$(".box-other-main .btn-arrow.left").click(function(){
		$(".slide-other").data('owlCarousel').prev()
	});
	$(".box-other-main .btn-arrow.right").click(function(){
		$(".slide-other").data('owlCarousel').next()
	});

	if($('#searchResultBlock').length > 0){
		$.each( $('#searchResultBlock > div'), function( key, value ) {
		  	var pid = $(this).attr('data-ID');
		  	var cid = $(this).attr('data-cID');
		  	var url = $(this).attr('data-share');

			$.post( "system-search-ajax.php", { pid: pid, cid: cid })
			  .done(function( data ) {

		  			if(data != ''){
		  				$('#searchResultBlock > div[data-ID="'+pid+'"] .Search_image_thumb').css({'background-image':'url('+data+')','background-size':'auto 100%'});
		  				//urlShortener(pid,url);
		  			}
			  });
		});
	}

});
function popup(url,name,windowWidth,windowHeight){
	myleft=(screen.width)?(screen.width-windowWidth)/2:100;
	mytop=(screen.height)?(screen.height-windowHeight)/2:100;
	properties = "width="+windowWidth+",height="+windowHeight;
	properties +=",scrollbars=yes, top="+mytop+",left="+myleft;
	return window.open(url,name,properties);
}
function shareFB(id,path){
	popup(path,'fb_box_'+id,640,580);
}
function sharegp(id,path){
	popup(path,'gp_box_'+id,540,620);
}
function shareTW(id,title,path){
	//var path = 'https://twitter.com/intent/tweet?text='+title+'&url='+path;
	/*
	var data_path = $('#searchResultBlock > div[data-ID="'+id+'"] .tw').attr('data-href');
	if(data_path == undefined){
		var w1 = popup('','tw_box_'+id,640,580);
	    jQuery.urlShortener({
	        longUrl: path,
	        success: function (shortUrl) {
				w1.location.href = 'https://twitter.com/intent/tweet?text='+title+'&url='+shortUrl;
				$('#searchResultBlock > div[data-ID="'+id+'"] .tw').attr('data-href',shortUrl);
	        }
	    });
	}else{
		var path = 'https://twitter.com/intent/tweet?text='+title+'&url='+data_path;
		var w1 = popup(path,'tw_box_'+id,640,580);
	}*/
	var path = 'https://twitter.com/intent/tweet?text='+title+'&url='+path;
	popup(path,'tw_box_'+id,640,580);
}
function urlShortener(id,longUrlLink){
    jQuery.urlShortener({
        longUrl: longUrlLink,
        success: function (shortUrl) {
        	$('#searchResultBlock > div[data-ID="'+id+'"] .tw').attr('href',shortUrl);
        }
    });
}