<?
require( $_SERVER[ "DOCUMENT_ROOT" ] . "/futbar/template/header.php" );
?>
<div class="container">
<?
function timeTable($i)
{
	?>
					<div class="timeTable">
						<div>№<?=$i?></div><?
	for($t = 18; $t <= 22; $t++)
	{
	?>
						<div class="timeSelect" data-timetable="<?=$t?>" data-time="<?=$t?>:00"><?=$t?>:00 - <?=$t + 1?>:00</div><?
	}
	?>
					</div><?
}
function numTable($i, $image)
{
				?>
			<div class="flexBlock" data-table="<?=$i?>">
				<div class="tableFlex">
					<div class="numberTable"><?=$i?></div>
					<img src="/futbar/reservation/images/<?=$image?>"><?
					timeTable($i);
	?>
				</div>
			</div><?
}
		?>
	<div class="row bgWhite text-center dateBlock">
		<div>Выберите дату:</div>
		<input type="text" class="form-control" id="datetimepicker"/>
	</div>
	<div class="row">
		<div class="flex"><?
			for($i = 1; $i <= 6; $i++)
			{
				numTable($i, 'dual-place.png');
			}
			for($i = 7; $i <= 12; $i++)
			{
				numTable($i, 'four-place.png');
			}
			for($i = 13; $i <= 16; $i++)
			{
				numTable($i, 'vip-place.png');
			}
			?>
		</div>
	</div>
	<script>
		$("#datetimepicker").datetimepicker(
		{
			timepicker: false,
			format:'d.m.Y',
			//format: 'Y.m.d',
			minDate: '-1970/01/02', //yesterday is minimum date(for today use 0 or -1970/01/01)
			maxDate: '+2020/01/02' //tomorrow is maximum date calendar
		});
$(function () {
	'use strict';
	// выбор времени
	$('.flex').on('click', '.timeTable .timeSelect', function()
	{
		var timeSelect = $(this).attr('data-timetable');
		var tableSelect = $(this).parents('.flexBlock').attr('data-table');
		var dataOrder = tableSelect + '_' + timeSelect;
		console.log('select time');
		console.log(dataOrder);
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

	</script>
</div>
<br>
<?
	echo "<pre>"; print_r($resReservation); echo "</pre>";
	
require($_SERVER["DOCUMENT_ROOT"]."/futbar/template/footer.php");?>