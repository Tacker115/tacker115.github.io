$(function (){
	
	var header = $("#header"),
		headerH = $("#header").innerHeight(),
		scrollOffset = $(window).scrollTop();
	
	/* Fixed Header */
	checkScroll(scrollOffset);
	fixScroll(scrollOffset);
	
	$(window).on("scroll", function() {
		
		scrollOffset = $(this).scrollTop();
		checkScroll(scrollOffset);
		fixScroll(scrollOffset);
	});
	
	$(window).resize(function() {
        let windowW = window.innerWidth;
		if (windowW >= 771) {
			$(".mask").removeClass("active");
			header.removeClass("active");
			$("#nav").removeClass("active");
			$(".nav-toggle").removeClass("active");
		}
    });
	
	function checkScroll(scrollOffset) {
		
		if (scrollOffset >= headerH) {
			header.addClass("fixed");
		} else {
			header.removeClass("fixed");
		}
	}
	
	function fixScroll(scrollOffset) {

	var	aboutHC = document.getElementById('about').getBoundingClientRect().top, 
		servicesHC = document.getElementById('services').getBoundingClientRect().top, 
		workHC = document.getElementById('work').getBoundingClientRect().top, 
		priceHC = document.getElementById('price').getBoundingClientRect().top;
			
		if (priceHC < 1) {
			$("#nav a").removeClass("active");
			$('#nav a[data-scroll="#price"]').addClass("active");
		}
			
		else if (servicesHC < 1) {
			$("#nav a").removeClass("active");
			$('#nav a[data-scroll="#services"]').addClass("active");
		}
					
		else if (workHC < 1) {
			$("#nav a").removeClass("active");
			$('#nav a[data-scroll="#work"]').addClass("active");
		}
			
		else if (aboutHC < 1) {
			$("#nav a").removeClass("active");
			$('#nav a[data-scroll="#about"]').addClass("active");
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
		$(".mask").toggleClass("active");
	});
	
	$("#scroll__down").on("click", function(event) {
		event.preventDefault();
		var blockAboutOffset = $("#about").offset().top;
		
		$("html, body").animate({
			scrollTop: blockAboutOffset
		}, 700);
	});
		
	/* Sliders */
	$("[data-slider1]").slick({
		infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		dots: true
	});
	
	$("[data-slider2]").slick({
		infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		dots: true
	});
});