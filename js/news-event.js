	$(document).ready(function(){
		$(".menutop li.menu5,.menu-left li.menu1").addClass("active");
		if ($('.menu-left li.menu1').hasClass("active")){
			$('.menu-left li.menu1').children(".submenu-left").css("display","block");
		}
	});