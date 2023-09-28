@extends('adminlte::page')

@section('title', 'Schedule Bookings')

@section('content_header')
<h1>
Schedule Bookings
</h1>
@stop
@section('content')
<section class="content">
<div class="row">
  <div class="col-xs-12">
      <div class="box">
          <div class="box-body">
            <div class="box-footer">
            <a  href="deleteTestBookings"  class="btn btn-primary" onclick="javascript:return confirm('Are you sure! You want to clear the test bookings');"><i class="fa fa-fw fa-trash-o"></i>Clear Test Booking Data</a>
            </div>
          <div class="table-responsive">
            <table id="myTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Booking Date</th>
                    <th>Time Slot</th>
                    <th>Email</th>
                    <th>Creation Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($bookings as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->booking_date}}</td>
                <td>{{$item->time_slot}}</td>
                <td>{{$item->email}}</td>
                <td>{{$item->created_date}}</td>
                <td><a href="deleteBooking/{{$item->id}}" onclick="javascript:return confirm('Are you sure! You want to delete');"><i class="fa fa-fw fa-trash-o"></i> </a></td>
            </tr>
            @endforeach
            </tbody>
            </table>
          </div>
        </div>
          </div>
      </div>
    </div>
    </section>

    @stop

@section('js')
<script>
$('#myTable').DataTable({
    "order": [[ 0, "desc" ]]
});
</script>
@stop
