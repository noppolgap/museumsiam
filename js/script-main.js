$(document).ready(function(){


	(function(e){e.fn.visible=function(t,n,r){var i=e(this).eq(0),s=i.get(0),o=e(window),u=o.scrollTop(),a=u+o.height(),f=o.scrollLeft(),l=f+o.width(),c=i.offset().top,h=c+i.height(),p=i.offset().left,d=p+i.width(),v=t===true?h:c,m=t===true?c:h,g=t===true?d:p,y=t===true?p:d,b=n===true?s.offsetWidth*s.offsetHeight:true,r=r?r:"both";if(r==="both")return!!b&&m<=a&&v>=u&&y<=l&&g>=f;else if(r==="vertical")return!!b&&m<=a&&v>=u;else if(r==="horizontal")return!!b&&y<=l&&g>=f}})(jQuery)
		
	var isiDevice = /ipad|iphone|ipod/i.test(navigator.userAgent.toLowerCase());
	var isAndroid = /android/i.test(navigator.userAgent.toLowerCase());
	var isWindowsPhone = /windows phone/i.test(navigator.userAgent.toLowerCase());
	
	if (isiDevice){
// 		alert("IOS");
		$(".part-top-bar").addClass("notFix");
		$("body").addClass("notFix");

	}else if (isAndroid){
// 			alert("Android");
		$(".part-top-bar").addClass("notFix");
		$("body").addClass("notFix");
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
				} else {
					$(".part-menu").addClass("snapmenu");
				}
			});
		});
	}
	$('.sub').mouseenter(function(){
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
	$('.sub').mouseleave(function(){
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
	
	
}); 