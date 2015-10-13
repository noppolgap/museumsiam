	$(document).ready(function() {
		$(".menutop li.menu6,.menu-left li.menu4").addClass("active");

		var sync1 = $("#sync1");
		var sync2 = $("#sync2");

		sync1.owlCarousel({
			singleItem : true,
			paginationSpeed : 500,
			rewindSpeed : 1000,
			navigation : false,
			pagination : false,
			afterAction : syncPosition,
			responsiveRefreshRate : 200,
			mouseDrag : false,
			rewindNav : true
		});

		sync2.owlCarousel({
			paginationSpeed : 500,
			rewindSpeed : 1000,
			items : 5,
			itemsMobile : [320, 5],
			itemsTablet : [768, 5],
			itemsDesktop : [1024, 5],
			navigation : false,
			pagination : true,
			responsiveRefreshRate : 100,
			mouseDrag : false,
			afterInit : function(el) {
				el.find(".owl-item").eq(0).addClass("synced");
			},
			rewindNav : false
		});

		function syncPosition(el) {
			var current = this.currentItem;
			$("#sync2").find(".owl-item").removeClass("synced").eq(current).addClass("synced")
			if ($("#sync2").data("owlCarousel") !== undefined) {
				center(current)
			}
		}


		$("#sync2").on("click", ".owl-item", function(e) {
			e.preventDefault();
			var number = $(this).data("owlItem");
			sync1.trigger("owl.goTo", number);
		});

		function center(number) {
			var sync2visible = sync2.data("owlCarousel").owl.visibleItems;

			var num = number;
			var found = false;
			for (var i in sync2visible) {
				if (num === sync2visible[i]) {
					var found = true;
				}
			}

			if (found === false) {
				if (num > sync2visible[sync2visible.length - 1]) {
					sync2.trigger("owl.goTo", num - sync2visible.length + 2)
				} else {
					if (num - 1 === -1) {
						num = 0;
					}
					sync2.trigger("owl.goTo", num);
				}
			} else if (num === sync2visible[sync2visible.length - 1]) {
				sync2.trigger("owl.goTo", sync2visible[1])
			} else if (num === sync2visible[0]) {
				sync2.trigger("owl.goTo", num - 1)
			}
		}


		$(".box-slide-big a.pev").click(function() {
			$("#sync1").data('owlCarousel').prev();
		});
		$(".box-slide-big a.next").click(function() {
			$("#sync1").data('owlCarousel').next();
		});

		$(".img-slide-show").each(function() {

			if ($(this).width() > $(this).height()) {
				$(this).width(754);
$(this).css('height' , 'auto');
				//($('.owl-wrapper-outer').height() - $('.img-slide-show').height())/2

				$(this).css('margin-top', (($('.owl-wrapper-outer').height() - $(this).height()) / 2));

			}

		});
	});