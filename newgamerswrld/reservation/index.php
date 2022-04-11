<?php
    session_start();
	$userid = $_SESSION['id'];
    ?>
	
<?
include( $_SERVER[ "DOCUMENT_ROOT" ] . "/newgamerswrld/template/header.php" );
?>
<section id="reservation">
<div class="container">
<?
function timeTable($i)
{
	?>
					<div class="timeTable">
						<div class="main-table">№<?=$i?></div>
						<hr class="table-hr">
						
						<?
	$timeID = 0;
	for($t = 0; $t <= 23; $t++)
	{
	if ($t<10) { $tT = '0'.$t; /* str_pad($t, 2, '0', STR_PAD_LEFT); */ }
	$tT = $t<10 ? '0'.$t : $t;
	?>
						<div class="timeSelect" data-id="<?=$i.$tT?>" data-timeid = "<?=$timeID?>" data-timetable="<?=$tT?>" data-time="<?=$tT?>:00"><?=$tT?>:00 - <?=$tT + 1?>:00</div><?
		$timeID++;
	}
	?>
					</div><?
}
function numTable($i, $image, $info)
{
				?>
			<div class="flexBlock" data-table="<?=$i?>">
				<div class="tableFlex">

					<img src="/newgamerswrld/reservation/images/<?=$image?>">
					<h5 class="reserve-text"><?=$info?></h5>
					<?
					timeTable($i);
	?>
				</div>
			</div><?
}
		?>
	<div class="row text-center dateBlock">
		<div class="col-xs-12" style="text-align: center;"><h3 class="reserve-text">Выберите дату:</h3></div>
		<input type="text" class="form-control" id="datetimepicker" value="" autocomplete="off">
	</div>
	<div class="row blockTable">
		<div class="flex roomTable"><?
			for($i = 1; $i <= 5; $i++)
			{
				numTable($i, 'desktop-pc.png', 'VIP пк');
			}
			for($i = 6; $i <= 18; $i++)
			{
				numTable($i, 'desktop-pc.png', 'Обычный пк');
			}
			for($i = 19; $i <= 20; $i++)
			{
				numTable($i, 'playstation.png', 'Консоль');
			}
			?>
		</div>
	</div>
	
	<div class="row nonTable">
		<div class="flex"><h3>На этот день резервирования нет.</h3></div>
	</div>


	<form class="form-inline col-xs-12" id="orderTable">
		<div class="hidden-inputs row">
			<input name="dataTime" value="" type="hidden">
			<input name="id" value="" type="hidden">
			<input id="checkuserid" value="<?=$_SESSION['id']?>" type="hidden">
			<input name="name" value="<?=$_SESSION['name']?>" type="hidden">
			<input name="phone" value="<?=$_SESSION['phone']?>" type="hidden">
		</div>
		<div class="reserve-button col-xs-12" style="text-align:center;">
			<button id="reserve" type="submit" class="btn btn-primary btn-reserve" disabled>Забронировать</button>
		</div>
	</form>
	
	<script>
		// обработка выбранной даты для запроса из базы
		function checkDate(){
					var date = $("#datetimepicker").val();
					var datesp = date.split('.');
					var newdate = 'db' + datesp[2] + datesp[1] + datesp[0];
					console.log(newdate);
			$('input[name=dataTime]').val(newdate);
					var dataPost = {'tableName':newdate}
					var test = {'test':'test2'};
					readymysql (dataPost);
		}
		// получение данных из базы по выбранной дате
function readymysql (dataPost)
		{
			console.log(dataPost);
			$.ajax(
			{
				type: "POST",
				url: "/newgamerswrld/db/readmysql.php",
				data: dataPost,
				success: function(data)
				{
					var dataLog = $.parseJSON(data);
					if(dataLog.error)
					{
						$(document).find('.blockTable').slideUp();
						$(document).find('.nonTable').slideDown();
					}
					else
					{
						$(document).find('.blockTable .active').slideDown().removeClass('active');
						$(document).find('.blockTable .selected').slideDown().removeClass('selected');
						tableSelect(dataLog);
						$(document).find('.blockTable').slideDown();
						$(document).find('.nonTable').slideUp();
					}
				}
			});
		}
		// вывод данных полученных из базы по выбранной дате
		function tableSelect(dataTable)
		{
			var colorTable;
			$.each(dataTable, function(index, value)
			{
				colorTable = false;
				$.each(value, function(indexTime, valueTime)
				{
					if(valueTime === 'y')
					{
						$(document).find('.flexBlock[data-table="' + index + '"] .timeSelect[data-timeid="' + indexTime + '"]').addClass('active').removeClass('selected');
						colorTable = true;
					}
				});
				if(colorTable)
				{
					$(document).find('.flexBlock[data-table="' + index + '"]').addClass('active');
				}
			});
		}
		// отобразить/скрыть форму
		function formOpen()
		{
			var userId = document.getElementById("checkuserid").value;
			
			if (userId.length >= 1){
				var activeTable = false;
				$(document).find('.roomTable .flexBlock').each(function(index, value)
				{
					if($(value).hasClass('selected'))
					{
						activeTable = true;
					}
					if(activeTable)
					{
						$('.form-inline').css({'opacity':1});
						document.getElementById('reserve').removeAttribute('disabled');
					}
					else
					{
						$('.form-inline').css({'opacity':0});
						document.getElementById('reserve').setAttribute('disabled', true);
						//$('form button[type=submit]').setAttribute('disabled', true);
					} 
				});
			}
		}	
		// сбор выбранных столов в строку
		function tableStroke ()
		{
			var idTable = '';
			$('.roomTable .timeSelect.selected').each(function(index, value)
			{
				var x = index > 0 ? ', ' + $(value).attr('data-id') : $(value).attr('data-id');
				idTable = idTable + x;
			});
			$('input[name=id]').val(idTable);			
		}
$(function()
{
	'use strict';
		$("#datetimepicker").datetimepicker(
		{
			timepicker: false,
			format:'d.m.Y',
			minDate: '-1970/01/02', //yesterday is minimum date(for today use 0 or -1970/01/01)
			maxDate: '+2021/10/10', //tomorrow is maximum date calendar
			onSelectDate: function () { checkDate();},
		});
	// выбор времени
	$('.flex').on('click', '.timeTable .timeSelect', function()
	{
		var timeSelect = $(this).attr('data-timetable');
		var tableSelect = $(this).parents('.flexBlock').attr('data-table');
		var dataOrder = tableSelect + timeSelect;
		tableStroke ();
		var dataForm = $('#orderTable').serializeArray();
		console.log(dataForm);
	});
	// клик по столу
	$('.timeSelect').on('click', function () {
		var forTable = $(this).parents('.flexBlock').attr('data-table');
		var forTableBlock = $(this).parent('.timeTable');
		var selectTime = false;
		if(!$(this).hasClass('active'))
		{
			$(this).toggleClass('selected').parents('.tableFlex').addClass('selected').parent().addClass('selected');
		}
		forTableBlock.find('.timeSelect').each(function(index1, value1)
		{
			if($(this).hasClass('selected'))
				selectTime = true;
		});
		selectTime ? '' : $(this).parents('.tableFlex').removeClass('selected').parent().removeClass('selected');
		formOpen();
	});
	// отправка данных в базу
	$(document).on('click', 'form button[type=submit]', function(e)
	{	
		
		e.preventDefault();
		var dataForm = $('#orderTable').serializeArray();
		console.log(dataForm);
		alert('Бронирование прошло успешно, ждем вас в клубе! Оплата брони на месте');
		$.ajax(
		{
			type: "POST",
			url: "/newgamerswrld/db/editsql.php",
			data: dataForm,
			success: function(data)
			{
				console.log(data);
			}
		});
		location.reload();
	});
});
	</script>

</div>
</section>
<? include($_SERVER["DOCUMENT_ROOT"]."/newgamerswrld/template/footer.php");?>