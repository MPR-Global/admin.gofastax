@extends('adminlte::page')

@section('title', 'Zipcodes')

@section('content_header')
<section class="content-header">
<h1>
Zipcodes
</h1>
@stop

@section('content')
<h5>Below you'll find Zip List where Amistee Provide Air Duct Cleaning Service ( Where Coverage is 'Y' with Addtional Charge based on Area).</h5>
</section>
<section class="content">
<div class="row">
  <div class="col-xs-12">
      <div class="box">
          <div class="box-body">
            <div class="box-footer">
            <a href="{{route('zipcodes.add')}}" class="btn btn-primary">Add Zipcode</a>
            </div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Zipcode</th>
                            <th>City</th>
                            <th>County</th>
                            <th>Coverage</th>
                            <th>Additional Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($zipcodes as $item)
                    <tr>
                        <td>{{$item->zipcode}}</td>
                        <td>{{$item->city}}</td>
                        <td>{{$item->county}}</td>
                        <td>{{$item->coverage}}</td>
                        <td>{{$item->additional_price}}</td>
                        <td>
                        <a href="editzipcode/{{$item->id}}"> <i class="fa fa-fw fa-edit"></i></a>
                            <a href="deletezipcode/{{$item->id}}" onclick="javascript:return confirm('Are you sure! You want to delete');"><i class="fa fa-fw fa-trash"></i> </a>
                        </td>
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
