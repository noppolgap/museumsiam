var owl;
$(document).ready(function(){

	(function(e){e.fn.visible=function(t,n,r){var i=e(this).eq(0),s=i.get(0),o=e(window),u=o.scrollTop(),a=u+o.height(),f=o.scrollLeft(),l=f+o.width(),c=i.offset().top,h=c+i.height(),p=i.offset().left,d=p+i.width(),v=t===true?h:c,m=t===true?c:h,g=t===true?d:p,y=t===true?p:d,b=n===true?s.offsetWidth*s.offsetHeight:true,r=r?r:"both";if(r==="both")return!!b&&m<=a&&v>=u&&y<=l&&g>=f;else if(r==="vertical")return!!b&&m<=a&&v>=u;else if(r==="horizontal")return!!b&&y<=l&&g>=f}})(jQuery)

	var isiDevice = /ipad|iphone|ipod/i.test(navigator.userAgent.toLowerCase());
	var isAndroid = /android/i.test(navigator.userAgent.toLowerCase());
	var isWindowsPhone = /windows phone/i.test(navigator.userAgent.toLowerCase());

	if (isiDevice){
// 		alert("IOS");

	}else if (isAndroid){
// 			alert("Android");

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

	$(".slide-herobanner").owlCarousel({
		autoPlay: 5000,
		paginationSpeed : 500,
		slideSpeed : 500,
		singleItem : true,
		navigation : false,
		pagination : true,
		rewindNav : true,
		scrollPerPage :true,
		responsive : true,
		mouseDrag : false,
		stopOnHover : true
	});
	$(".slide-network").owlCarousel({
		autoPlay: 5000,
		paginationSpeed : 500,
		slideSpeed : 500,
		navigation : false,
		pagination : false,
		rewindNav : true,
		scrollPerPage :true,
		responsive : true,
		mouseDrag : false,
		items : 4,
		stopOnHover : true
	});
	$(".slide-exhibition,.slide-archive").owlCarousel({
		autoPlay: 5000,
		paginationSpeed : 500,
		slideSpeed : 500,
		singleItem : true,
		navigation : false,
		pagination : true,
		rewindNav : true,
		scrollPerPage :true,
		responsive : true,
		mouseDrag : false,
		stopOnHover : true
	});

// 		Slide Event
	owl = $(".slide-event"),
	status = $(".box-number");
	owl.owlCarousel({
		slideSpeed : 500,
		navigation : false,
		singleItem : true,
		pagination : false,
		stopOnHover : true,
		afterAction : afterAction
	});
	function updateResult(pos,value){
		status.find(pos).find(".result").text(value);
	}
	function afterAction(){
		updateResult(".owlItems", this.owl.owlItems.length);
		updateResult(".currentItem", this.owl.currentItem+1);
	}
	$(".box-slideevent-main .btn-arrow.left").click(function(){
		$(".slide-event").data('owlCarousel').prev()
	});
	$(".box-slideevent-main .btn-arrow.right").click(function(){
		$(".slide-event").data('owlCarousel').next()
	});
	$(".box-slide-network-main .btn-arrow.left").click(function(){
		$(".slide-network").data('owlCarousel').prev()
	});
	$(".box-slide-network-main .btn-arrow.right").click(function(){
		$(".slide-network").data('owlCarousel').next()
	});


});

function loadEvent(date){
	$.post( "index-ajax.php", { date: date })
	  .done(function( data ) {

	  	$('#eventBox').html(data);
    	owl.owlCarousel();

	  });
}