@extends('adminlte::page')

@section('title', 'Edit Business Rule')

@section('content_header')
<h1>
Edit Business Rule
</h1>
@stop

@section('content')

<section class="content">
<a href="{{route('business_rules')}}" class="btn btn-link"><i class="fa fa-arrow-left" aria-hidden="true"></i> Business Rules</a>

			<!-- general form elements -->
			<!----------------------- Message ------------------------------->
			@if($errors->any())
			  <div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				{{ $errors->first() }}
			  </div>
			@endif

              <div class="box box-primary">
                <form class="form-horizontal" method="POST" name="form1" id="form1" action="{{route('airductRules.update',[$data->id])}}">
                @csrf

                <div class="box-body">
		                <div class="col-md-6">
                            <div class="form-group col-md-12">
                            <label for="num_furnace" class="control-label">Number Of Furnace</label>
                                <select name="num_furnace" id="num_furnace" class="form-control">
                                <option>Select Number Of Furnace</option>
                                  @foreach ($number_of_furnace as $item)
                                    <option value="{{ $item }}"{{ ( $data->num_furnace == $item ) ? 'selected' : '' }}>{{ $item }}</option>
                                  @endforeach
                                </select>
                                <span style="inline:block;color:red;display:none;" id="uname_validate"></span>
                            </div>
                            <div class="form-group col-md-12">
                            <label for="furnace_loc_sidebyside" class="control-label">Price when Furnace Location Side by Side</label>
                                <input type="number" id="furnace_loc_sidebyside" name="furnace_loc_sidebyside"  value="{{$data->furnace_loc_sidebyside}}" class="form-control" placeholder="Price for Side by Side Furnace Location">
                            </div>
                            <div class="form-group col-md-12">
                            <label for="square_footage_min" class="control-label">Min Square Footage</label>
                                <input type="number" id="square_footage_min" name="square_footage_min"  value="{{$data->square_footage_min}}" class="form-control" placeholder="square footage">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group col-md-12">
                            <label for="final_price" class="control-label">Price When No Furnace Location</label>
                                <input type="number" id="final_price" name="final_price"  value="{{$data->final_price}}" class="form-control" placeholder="Price When No Furnace Location">
                            </div>
                            <div class="form-group col-md-12">
                            <label for="furnace_loc_different" class="control-label">Price when Diffrent Furnace Location and/or Floor</label>
                                <input type="number" id="furnace_loc_different" name="furnace_loc_different"  value="{{$data->furnace_loc_different}}" class="form-control" placeholder="Price for Dfifferent Furnace Location">
                            </div>
                            <div class="form-group col-md-12">
                            <label for="square_footage_max" class="control-label">Max Square Footage</label>
                            <input type="number" id="square_footage_max" name="square_footage_max"  value="{{$data->square_footage_max}}" class="form-control" placeholder="square footage">
                            </div>
                        </div><!-- /.box-body -->
                </div>
                  <div class="box-footer">
					<input type="hidden" id="id" name="id" value="">
					<input type="hidden" id="query_string" name="query_string" value="">
                    <button type="submit" id="submit" name="submit" value="" class="btn btn-primary">Submit
						<i class="fa fa-refresh fa-spin" style="display:none;" id="page_load_div"></i>
					</button>
                  </div>
                </form>
              </div><!-- /.box -->
		</div>
	</div>
</section>
@stop
@section('js')
<script type="text/javascript">
$(document).ready(function() {
	
});
</script>
@stop
