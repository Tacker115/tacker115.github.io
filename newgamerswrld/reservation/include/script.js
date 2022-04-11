$(function () {
	'use strict';
	// клик по стулу
	$('.flexTableMore').on('click', '.place', function () {
		var forTable = $(this).parents('.tableFlex').attr('data-table');
		var forPlace = $(this).text();
		alert('Вы выбрали для брони ' + forPlace + ' место за ' + forTable + ' столиком');
	});
	// клик по столу
	$('.flexTableMore').on('click', '.tableClick', function () {
		var forTable = $(this).parents('.tableFlex').attr('data-table');
		alert('Вы выбрали для брони ' + forTable + ' столик');
	});
	// наведение на стол - смена цвета - аналог hover
	$('.flexTableMore').on('hover', '.tableClick', function () {
		$(this).parents('.tableFlex').find('.tableClick').toggleClass('hoverTable');
	});
});
