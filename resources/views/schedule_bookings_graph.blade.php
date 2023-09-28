@extends('adminlte::page')

@section('title', 'Schedule Bookings Graph')
@section('css')
<link rel="stylesheet" href="{{asset('css/fullcalendar.min.css')}}">
<style type="text/css">
	.event-full{
		padding-top:2rem;
		opacity: 1 !important;
	}
	.event-full .fc-event-title{
		font-weight: 700;
		color:#000000;
	}
	.bg1{
		padding: 20px;
		background-color: #e4f4e1;
	}
	.bg2{
		padding: 20px;
		background-color: #cae9c3;
	}
	.bg3{
		padding: 20px;
		background-color: #a3da99;
	}
	.bg4{
		padding: 20px;
		background-color: #01dd23;
	}
</style>
@stop
@section('content')

<section class="content-header">
<h1>
Appointments Schedule booking detail.
</h1>
</section>

<section class="content">
	<div class="box">
		<div class="box-body">
			@csrf
			<div class="row">
			<div class="col-md-3">
			<label>Start Date</label>
			<input type="date" class="form-control text_box_area hasDatepicker" name="startDate" onchange="setMinEndDate(event);" value="{{ date('Y-m-d') }}" min='{{ date("Y-m-d") }}' id="startDate" placeholder="Start Date" style='width: 300px;' >
			</div>
			<div class="col-md-3">
			<label>End Date</label>
			<input type="date" class="form-control text_box_area hasDatepicker" name="endDate" value="{{ date('Y-m-d', strtotime('+6 month')) }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}" max="{{ date('Y-m-d', strtotime('+12 month')) }}" id="endDate" placeholder="End Date" style='width: 300px;' >
			</div>
			<div class="col-md-2">
			<input type="submit" value="Submit Form" class="btn btn-success"> <i class="fa fa-refresh fa-spin" style="display:none;" id="page_load_div"></i>
			</div>
			</div>
			<div class="row">
			</div>
			<div class="row">

			<div class="col-md-6">
			<div id='calendar'></div>
			</div>
			<div class="col-md-6" style="margin-top: 10rem;">
					<span class="bg1">1 Bookings</span>
					<span class="bg2">2 Bookings</span>
					<span class="bg3">3+ Bookings</span>
				</div>
			</div>

		</div>
	</div>
</section>
@stop

@section('js')
<script src="{{asset('js/fullcalendar.min.js')}}"></script>
<script type="text/javascript">

function setMinEndDate(e){
	document.getElementById("endDate").value = '';
	var startDate = e.target.value;
	document.getElementById("endDate").setAttribute("min", startDate);
}
	function loadGraph(){
				var startDate = $('#startDate').val();
				var endDate = $('#endDate').val();
				$("#heatmaprange").html("from "+startDate + " to "+endDate);
				$.ajax({
					type: 'get',
					url: "/bookings_count",
					data: {'startDate': startDate, 'endDate': endDate},
					success: function(response) {
						heatmap(response.data, startDate, endDate);
						$('#page_load_div').hide();
						$('.btn-success').show();
						const uniqueResult = Object.values(response.data.reduce((r, { booking_date, count }) => {
							r[booking_date] ??= { booking_date, appointments: 0 };
							r[booking_date].appointments += count;
							return r;
						}, {}));
						const calendarData =[];
						for (const item of uniqueResult){
							if(isToday(item.booking_date)){
								calendarData.push({
									allDay: true,
									title: item.appointments + ' Bookings',
									start: item.booking_date,
									end: item.booking_date,
									className: 'event-full',
									display: 'background',
									color: '#01dd23'
								});
							}else if(item.appointments===1){
								calendarData.push({
									allDay: true,
									title: item.appointments + ' Bookings',
									start: item.booking_date,
									end: item.booking_date,
									className: 'event-full',
									display: 'background',
									color: '#e4f4e1'
								});
							}else if(item.appointments===2){
								calendarData.push({
									allDay: true,
									title: item.appointments + ' Bookings',
									start: item.booking_date,
									end: item.booking_date,
									className: 'event-full',
									display: 'background',
									color: '#cae9c3'
								});
							}else if(item.appointments>2){
								calendarData.push({
									allDay: true,
									title: item.appointments + ' Bookings',
									start: item.booking_date,
									end: item.booking_date,
									className: 'event-full',
									display: 'background',
									color: '#a3da99'
								});
							}
						}
						heatmap(calendarData, startDate);
						$(".btn-success").attr("disabled", false);

					},
					error: function(error) {
						$('#errorMessage').html(error);
						console.log(error)
						$('#page_load_div').hide();
						$('.btn-success').show();
						$(".btn-success").attr("disabled", false);
					}
			});
	}


	const isToday = (someDate) => {
		const today = new Date()
		someDate = new Date(someDate);
		return someDate.getDate() == today.getDate() &&
			someDate.getMonth() == today.getMonth() &&
			someDate.getFullYear() == today.getFullYear()
	}
	$(function(){
		$('.btn-success').click(function(e){
					e.preventDefault();
				$(".btn-success").attr("disabled", true);
				$('#page_load_div').show();
				loadGraph();
		});
		loadGraph();
	});


	function heatmap(apiData, startDate) {
		var calendarEl = document.getElementById('calendar');

			var calendar = new FullCalendar.Calendar(calendarEl, {
			headerToolbar: {
			  left: 'prev',
				center: 'title',
			  right: 'next'
			},
			initialDate: startDate,
			events: apiData
			});

			calendar.render();
	}

	document.addEventListener('DOMContentLoaded', function() {
});
</script>
@stop
