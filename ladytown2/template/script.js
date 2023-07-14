$(function (){
	var header = $("#header"),
		headerH = $("#header").innerHeight() - 20,
		scrollOffset = $(window).scrollTop(),
		loc = window.location.pathname.split("/"),
    	checkSession = $('#session').attr('data-session');
	/* Check session */
  	if(checkSession == 'form_auth') {
	   	$('#session_service_mob').css("display","none");
	   	$('#session_service').css("display","none");
 	}
 	else {
 		$('#session_basket').css("display","none");
 		$('#session_basket_mob').css("display","none");
 	}
	/* Fixed Header */
	checkScroll(scrollOffset);
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
	/* Check page for nav active */
	$('.nav .nav--li').each(function () {
		if($(this).attr('data-href') === loc[2]) {
			$(".nav--li").removeClass("active");
			$(this).addClass("active");
		}
	});
	$('.ul--li').each(function () {
		if($(this).attr('data-href') === loc[2]) {
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
	/* Details */
	/* Toggle for details */
	/* Function for Details */
	function checkColor() {
		var color_radio = $(".color-radio.active").attr('data-color'),
		switchers = $("[data-color-id]");
		switchers.hide();
		$("[data-color-id='" + color_radio + "']").show();
	}
	function checkSize() {
		if ($(".size-radio.active")) {
			$(".add-basket").show();
			$('#add-basket').prop("disabled", false);
			$("[data-price]").show();
		}
		else {
			$(".add-basket").hide();
			$('#add-basket').prop("disabled", true);
			$("[data-price]").hide();
		}
	}
	$(".color-radio").on("click", function(event) {
		event.preventDefault();
		var sr_id = $(this).attr('id');
		if ($(this).hasClass("active")) {
			
		} else {
			$(".size-radio").removeClass("active");
			$(".add-basket").hide();
			$('#add-basket').prop("disabled", true);
			$("[data-price-id='" + sr_id + "']").hide();
			$(".color-radio").removeClass("active");
			$(this).addClass("active");
		}
		checkColor();
	});
	$(".size-radio").on("click", function(event) {
		event.preventDefault();
		var sr_id = $(this).attr('id');
		checkSize();

		$('#add-basket').show();
		$("[data-price]").hide();
		$("[data-price-id]").hide();
		$("[data-price-id='" + sr_id + "']").show();

		$(".size-radio").removeClass("active");
		$(this).addClass("active");
	});
	if ($(".details").length > 0) {
		checkColor();
		$('#add-basket').hide();
		$("[data-price-id]").hide();
	}
	$('#add-basket').on("click", function(event) {
		event.preventDefault();
		var id_varprodt = $(".size-radio.active").attr('id');
		$.ajax(
		{
			type: "POST",
			url: "/ladytown/shop/basketadd.php",
			data: {id_varprodt}
		});
		setTimeout(function(){
			location.reload();
		}, 1000);
	});
	// Basket
	// Удаляем item
	$('.btn-del').click(function() {
		var varprodt_id = $(this).attr('id');
		console.log($(this).attr('id'));
		$.ajax(
		{
			type: "POST",
			url: "/ladytown/shop/delitem.php",
			data: {varprodt_id}
		});
		setTimeout(function(){
			location.reload();
		}, 1000);
	});
	// Меняем count
	$('.input-qty.qty-basket').on('change, input', function() {
		var maxitemCount = Number($(this).attr('max')),
		    currentitemCount = Number($(this).val()),
		    currentDataAttr = $(this).attr('data-td-basket');
		if (currentitemCount > maxitemCount) {
			$(this).val(maxitemCount); 
		}
		if (currentitemCount < 1) {
			$(this).val(1);
		}
		let price = $('.product-price[data-td-basket="'+ currentDataAttr +'"]').text();
		let priceToNum = price.replace(/[^+\d]/g, '') * currentitemCount;
		$('.product-subtotal[data-td-basket="'+ currentDataAttr +'"]').html('₽' + priceToNum);
		updateSum();
	});
	function updateSum() {
		let sum = 0,
			p = 0;
		$('.basket-card').each(function() {
			let idData = $(this).attr('data-tr-basket');
			p = $('.product-subtotal[data-td-basket="'+ idData +'"]').text().replace(/[^+\d]/g, '');
			sum += p*1;
		});
		$('.sum-result').html('₽' + sum);
	}
	// Обновляем табл корзины
	$('.go-order').click(function(event) {
		event.preventDefault();
		var arrBasket = {}, i= 0;
		$('.basket-card').each(function() {
			let idObj = $(this).attr('data-tr-basket'),
				countObj = $('.input-qty.qty-basket[data-td-basket="'+ idObj +'"]').val();
			arrBasket[idObj] = countObj;
		});
		$.ajax(
		{
			type: "POST",
			url: "/ladytown/shop/basketupdate.php",
			data: {arrBasket}
		});
		location.replace("/ladytown/shop/order.php");
	});
	// Order
	function checkNotNull() {
		let arr = []; 
		$('.customer-field').find('input').each(function(){
			let x = true; 
			if (!$(this).val() || $(this).val() == '') {
				x = false;
			} else {}
			arr.push(x);
		});
		let found = arr.some(falseel => arr.indexOf(false) >= 0);
		if (found == false) {	
			$('.make-offer').prop("disabled", false);
		} else {
			$('.make-offer').prop("disabled", true);
		}
	}
	$('.customer-input:input').on('change, input', function() {
		checkNotNull();
	});
	// Добавляем оффер
	$('.make-offer').click(function(event) {
		event.preventDefault();
		let name = $('input[name="Name"]').val(),
			email = $('input[name="Email"]').val(),
			phone = $('input[name="Phone"]').val(),
			index = $('input[name="Index"]').val(),
			country = $('input[name="Country"]').val(),
			city = $('input[name="City"]').val(),
			street = $('input[name="Street"]').val(),
			house = $('input[name="House"]').val(),
			flat = $('input[name="Flat"]').val(),
			address = "";
		address = index + ', ' + country + ', ' + city + ', ' + street + ' ' + house + ', ' + flat;
		$.ajax(
		{
			type: "POST",
			url: "/ladytown/shop/orderadd.php",
			data: {name,email,phone,address}
		});
		location.replace("/ladytown/shop/success.php");
	});
	// Админка
	$(".circle-took").on("click", function(event) {
		event.preventDefault();
		let click = $(this).attr('data-td-basket'),
			status = $(this).attr('data-status');
		$.ajax(
		{
			type: "POST",
			url: "/ladytown/shop/orderedit.php",
			data: {click, status}
		});
		setTimeout(function(){
			location.reload();
		}, 500);
	});
	/* Scroll down */
	$("#scroll__down").on("click", function(event) {
		event.preventDefault();
		var blockNewColOffset = $("#newcol").offset().top - 120;

		$("html, body").animate({
			scrollTop: blockNewColOffset
		}, 700);
	});
	/* Shop categories */
	$(".prod-count-info .pcf-value").html($('.prod-area .row').find("[data-category]:visible").length);
	$('.shop-category').on("click", function(event) {
		event.preventDefault();
		var filterValue = $(this).attr('data-filter'),
				classItems = $('.prod-area');
				allItems = $('[data-category]');

		$('.shop-category').removeClass("active");
		$(this).addClass("active");
	    allItems.hide().removeClass("active");
	    if (filterValue === '0') {
	    	allItems.show();
	    }
	    classItems.find("[data-category='" + filterValue + "']").show();
	    $(".prod-count-info .pcf-value").html($('.prod-area .row').find("[data-category]:visible").length);
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