@extends('adminlte::page')

@section('title', 'Edit Zipcode')

@section('content_header')
<h1>
Edit Zipcode
</h1>
@stop

@section('content')
<section class="content">
<a href="{{route('zipcodes')}}" class="btn btn-link"><i class="fa fa-arrow-left" aria-hidden="true"></i> Zipcode List</a>
<div class="clearfix"></div>
			<!-- general form elements -->
			<!----------------------- Message ------------------------------->
			@if($errors->any())
			  <div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				{{ $errors->first() }}
			  </div>
			@endif

              <div class="box box-primary">
                <form class="form-horizontal" method="POST" name="form1" id="form1" action="{{route('zipcodes.update',[$data->id])}}">
                @csrf

                <div class="box-body">
		                <div class="col-md-6">
                            <div class="form-group col-md-12">
                            <label for="zipcode" class="control-label">Zipcode</label>
                                <input type="number" id="zipcode" name="zipcode"  value="{{$data->zipcode}}" class="form-control" placeholder="zipcode">
                            </div>
                            <div class="form-group col-md-12">
                            <label for="county" class="control-label">County</label>
                                <input type="text" id="county" name="county"  value="{{$data->county}}" class="form-control" placeholder="county">
                            </div>
                            <div class="form-group col-md-12">
                            <label for="additional_price" class="control-label">Addition Price</label>
                            <input type="number" id="additional_price" name="additional_price"  value="{{$data->additional_price}}" class="form-control" placeholder="Additional price">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group col-md-12">
                            <label for="city" class="control-label">City</label>
                                <input type="text" id="city" name="city"  value="{{$data->city}}" class="form-control" placeholder="city">
                            </div>
                            <div class="form-group col-md-12">
                            <label for="coverage" class="control-label">Coverage</label>
                            <div class="radio">
                            <label class="radio-inline">
                              <input type="radio" name="coverage" id="coverage" value="Y" {{($data->coverage == 'Y')? "checked" : ""}}> Yes
                            </label>
                            </div>
                            <div class="radio">
                            <label class="radio-inline">
                              <input type="radio" name="coverage" id="coverage" value="N"  {{($data->coverage == 'N')? "checked" : ""}}> No
                            </label>
                            </div>
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
