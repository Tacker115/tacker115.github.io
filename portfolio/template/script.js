$(function (){
	
	var header = $("#header"),
		headerH = $("#header").innerHeight(),
		scrollOffset = $(window).scrollTop();
	
	/* Fixed Header */
	checkScroll(scrollOffset);
	fixScroll(scrollOffset);
	
	$(window).resize(function() {
        let windowW = window.innerWidth;
		if (windowW >= 771) {
			header.removeClass("active");
			$("#nav").removeClass("active");
			$(".nav-toggle").removeClass("active");
		}
    });
	
	$(window).on("scroll", function() {
		
		scrollOffset = $(this).scrollTop();
		checkScroll(scrollOffset);
		fixScroll(scrollOffset);
	});
	
	function checkScroll(scrollOffset) {
		
		if (scrollOffset >= headerH) {
			header.addClass("fixed");
		} else {
			header.removeClass("fixed");
		}
	}
	
	function fixScroll(scrollOffset) {

	var	workHC = document.getElementById('work').getBoundingClientRect().top, 
		contactHC = document.getElementById('contacts').getBoundingClientRect().top,
		bodyHC = document.querySelector('body').getBoundingClientRect().bottom;
			
		if (contactHC < 1 || bodyHC < window.innerHeight + 1) {
			$("#nav a").removeClass("active");
			$('#nav a[data-scroll="#contacts"]').addClass("active");
		}
				
		else if (workHC < 1) {
			$("#nav a").removeClass("active");
			$('#nav a[data-scroll="#work"]').addClass("active");
		}
			
		
		else {			
			$("#nav a").removeClass("active");
			$('#nav a[data-scroll="#home"]').addClass("active");
		}
	}
	
	/* Fixed Header */
	$("[data-scroll]").on("click", function(event) {
		event.preventDefault();
		
		var blockId = $(this).data('scroll'),
			blockOffset = $(blockId).offset().top;
			
		$("#nav a").removeClass("active");
		$(this).addClass("active");
		
		$("html, body").animate({
			scrollTop: blockOffset
		}, 700);

	});
	
	/* Nav toggle */
	$("#nav_toggle").on("click", function(event) {
		event.preventDefault();
		
		$("#header").toggleClass("active");
		$("#nav").toggleClass("active");
		$(this).toggleClass("active");
	});
	
	$("#scroll__down").on("click", function(event) {
		event.preventDefault();
		var blockAboutOffset = $("#home").offset().top;
		
		$("html, body").animate({
			scrollTop: blockAboutOffset
		}, 700);
	});

	$("[data-slider1]").slick({
		infinite: true,
		fade: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		prevArrow: '<button class="slick-prev slick-arrow" aria-label="Prev" type="button"></button>',
		nextArrow: '<button class="slick-next slick-arrow" aria-label="Next" type="button"></button>'
	});

});
