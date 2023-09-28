@extends('adminlte::page')

@section('title', 'Business Rules')

@section('content_header')
<h1>Business Rules</h1>
@stop

@section('content')
<section class="content-header">
  <h1>
    Online Schedule Business Rules
  </h1>
</section>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-body">
          <div class="box-footer">
            <a href="{{route('airductRules.add')}}" class="btn btn-primary">Add Air Duct Cleaning Rule</a>
          </div>

          <div class="table-responsive">
            <table id="airDuctCleaning" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No Of Furnace(s)</th>
                  <th>Sqft Min</th>
                  <th>Sqft max</th>
                  <th>Furnace Location (Side by Side)</th>
                  <th>Furnace Location (Different Floor)</th>
                  <th>Price When Not Furnace Location</th>
                  <th>updated_by</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($airDuct as $item)
                <tr>
                  <td>{{$item->num_furnace}}</td>
                  <td>{{$item->square_footage_min}}</td>
                  <td>{{$item->square_footage_max}}</td>
                  <td>${{$item->furnace_loc_sidebyside}}</td>
                  <td>${{$item->furnace_loc_different}}</td>
                  <td>${{$item->final_price}}</td>
                  <td>{{$item->updated_by}}</td>
                  <td><a href="editairductRule/{{$item->id}}"> <i class="fa fa-fw fa-edit"></i></a></td>
                  <td><a href="deleteairductRule/{{$item->id}}" onclick="javascript:return confirm('Are you sure! You want to delete');"><i class="fa fa-fw fa-trash-o"></i> </a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-body">
          <div class="box-footer">
            <a href="{{route('dryerventRules.add')}}" class="btn btn-primary">Add Dryer Vent Cleaning Rule</a>
          </div>

          <div class="table-responsive">
            <table id="dryerVentCleaning" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Exit Point Of The Dryer Vent</th>
                  <th>Price</th>
                  <th>updated_by</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($dryerVent as $item)
                <tr>
                  <td>{{$item->dryer_vent_exit_point}}</td>
                  <td>${{$item->price}}</td>
                  <td>{{$item->updated_by}}</td>
                  <td><a href="editdryerventRule/{{$item->id}}"> <i class="fa fa-fw fa-edit"></i></a></td>
                  <td><a href="deletedryerventRule/{{$item->id}}" onclick="javascript:return confirm('Are you sure! You want to delete');"><i class="fa fa-fw fa-trash-o"></i> </a></td>
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