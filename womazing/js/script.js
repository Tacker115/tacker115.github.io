$(function (){
	var header = $("#header"),
		headerH = $("#header").innerHeight() - 20,
		scrollOffset = $(window).scrollTop(),

		loc = window.location.href,
		url = loc.substring(loc.lastIndexOf('/')+1, loc.lastIndexOf('.')),
		url2 = loc.substring(loc.lastIndexOf('/')+1);

	/* Fixed Header */
	checkScroll(scrollOffset);
	introCheck();

	$(window).on("scroll", function() {
		scrollOffset = $(this).scrollTop();
		checkScroll(scrollOffset);
	});

	function checkScroll(scrollOffset) {
		if (scrollOffset >= headerH) {
			header.addClass("fixed");
		} else {
			header.removeClass("fixed");
		}
	}

	/* Intro */
	function introCheck() {
		if (url === "index" || url2 === "") {
			intro();
		}
	}
	function intro() {
		var c = document.getElementById("container"),
			rs = document.getElementById("rs"),
			el = document.getElementById("bcg"),
			vid = document.getElementById("vid"),
			p = getComputedStyle(c).marginRight,
			b = getComputedStyle(rs).width,
			h = getComputedStyle(rs).height;

		k = parseInt(b) + parseInt(p);
		el.style.width = k + 'px';
		el.style.height = h + 'px';
		el.style.marginRight = '-' + p;
	}

	/* Check page for nav active */
	$('.nav .nav--li').each(function () {
		if($(this).attr('data-href') === url) {
			$(".nav--li").removeClass("active");
			$(this).addClass("active");
		}
	});

	$('.ul--li').each(function () {
		if($(this).attr('data-href') === url) {
			$(".ul--li").removeClass("active");
			$(this).addClass("active");
		}
	});

	/* Nav toggle */
	$("#nav_toggle").on("click", function(event) {
		event.preventDefault();

		$("#body").toggleClass("hidden");
		$("#header").toggleClass("active");
		$("#nav").toggleClass("active");
		$(this).toggleClass("active");
	});

	/* Toggle for details */
	$(".color-radio").on("click", function(event) {
		event.preventDefault();

		$(".color-radio").removeClass("active");
		$(this).addClass("active");
	});

	$(".size-radio").on("click", function(event) {
		event.preventDefault();

		$(".size-radio").removeClass("active");
		$(this).addClass("active");
	});

	/* Scroll down */
	$("#scroll__down").on("click", function(event) {
		event.preventDefault();
		var blockNewColOffset = $("#newcol").offset().top - 120;

		$("html, body").animate({
			scrollTop: blockNewColOffset
		}, 700);
	});

	/* Sliders */
	$("[data-slider1]").slick({
		infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows : false,
		autoplay: true,
		autoplaySpeed: 3000,
		dots: true,
		asNavFor: $('[data-slider1], [data-slider2]')
	});

	$("[data-slider2]").slick({
		infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows : false,
		fade : true,
		autoplay: true,
		autoplaySpeed: 3000,
		asNavFor: $('[data-slider2], [data-slider1]')
	});

	$("[data-slider3]").slick({
		infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		dots: true,
		prevArrow: '<button class="slick-prev slick-arrow" aria-label="Prev" type="button"></button>',
		nextArrow: '<button class="slick-next slick-arrow" aria-label="Next" type="button"></button>'
	});

});