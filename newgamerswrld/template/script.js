$(document).ready(function(){
	"use strict";
//================ Проверка длины пароля авторизация ==================
	var password = $('input[name=password]');	 
	password.blur(function(){
		if(password.val() != ''){	 
			//Если длина введенного пароля меньше шести символов, то выводим сообщение об ошибке
			if(password.val().length < 6){
				//Выводим сообщение об ошибке
				$('#valid_password_message').text('Минимальная длина пароля 6 символов');	 
				//Дезактивируем кнопку отправки
				$('input[type=submit]').attr('disabled', true);	 
			}
			else {
				//Убираем сообщение об ошибке
				$('#valid_password_message').text('');
				//Активируем кнопку отправки
				$('input[type=submit]').attr('disabled', false);
			}
		}
		else 
		{
			$('#valid_password_message').text('Введите пароль');
		}
	});
	
//================ Для header.php ==================
	switchClass();
	
		
	function switchClass() {
		if(window.outerWidth  < 1200) {
			$('.details-img').addClass('none');
			$('.details-img-mobile.none').removeClass('none');
		}
		else {
			$('.details-img-mobile').addClass('none');
			$('.details-img.none').removeClass('none');
		} 
	}

//================ Для слайдера на главной ==================
	$('.interior').slick({
		centerMode: true,
		centerPadding: '460px',
		slidesToShow: 1,
		infinite: true,
		prevArrow: '<i id="fa-left2" class="fa fa-chevron-left sl-scnd prev" aria-hidden="true"></i>',
		nextArrow: '<i id="fa-right2" class="fa fa-chevron-right sl-scnd next" aria-hidden="true"></i>',
		responsive: [
			{
			breakpoint: 1601,
			settings: {				
				centerMode: true,
				centerPadding: '360px',
				slidesToShow: 1
				}
			},
			{
			breakpoint: 1401,
			settings: {
				centerMode: true,
				centerPadding: '280px',
				slidesToShow: 1
				}
			},
			{
			breakpoint: 1201,
			settings: {
				centerMode: true,
				centerPadding: '180px',
				slidesToShow: 1
				}
			},
			{
			breakpoint: 992,
			settings: {
				centerMode: true,
				centerPadding: '120px',
				slidesToShow: 1
				}
			},
			{
			breakpoint: 771,
			settings: {
				arrows: false,
				centerMode: true,
				centerPadding: '80px',
				slidesToShow: 1
				}
			},
			{
			breakpoint: 575,
			settings: {
				arrows: false,
				centerMode: true,
				centerPadding: '50px',
				slidesToShow: 1
				}
			},
			{
			breakpoint: 425,
			settings: {
				arrows: false,
				centerMode: true,
				centerPadding: '30px',
				slidesToShow: 1
				}
			}]				
	});

});