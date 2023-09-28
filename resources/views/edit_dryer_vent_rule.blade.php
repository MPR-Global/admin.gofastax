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
                <form class="form-horizontal" method="POST" name="form1" id="form1" action="{{route('dryerventRules.update',[$data->id])}}">
                @csrf

                <div class="box-body">
		                <div class="col-md-6">
                            <div class="form-group col-md-12">
                            <label for="dryer_vent_exit_point" class="control-label">Exit Point Of The Dryer Vent</label>
                                <select name="dryer_vent_exit_point" id="dryer_vent_exit_point" class="form-control">
                                <option>Select Exit Point Of The Dryer Vent</option>
                                  @foreach ($dryerVentExitPoints as $item)
                                    <option value="{{ $item }}"{{ ( $data->dryer_vent_exit_point == $item ) ? 'selected' : '' }}>{{ $item }}</option>
                                  @endforeach
                                </select>
                                <span style="inline:block;color:red;display:none;" id="uname_validate"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group col-md-12">
                            <label for="price" class="control-label">Price</label>
                                <input type="number" id="price" name="price" value="{{$data->price}}" class="form-control" placeholder="price">
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <input type="hidden" id="id" name="id" value="">
                            <input type="hidden" id="query_string" name="query_string" value="">
                            <button type="submit" id="submit" name="submit" value="" class="btn btn-primary">Submit
                                <i class="fa fa-refresh fa-spin" style="display:none;" id="page_load_div"></i>
                            </button>
                        </div>
                </div>
                </form>
              </div><!-- /.box -->
</section>
@stop
@section('js')
<script type="text/javascript">
$(document).ready(function() {
	$("#form1").submit(function() {
		var is_error =false;
		$("#form1 .required").each(function(index) {
			if($(this).val() == ''){
				var field_name = $(this).attr("id");
				alert("Please enter "+field_name);
				$(this).focus();
				is_error = true;
				return false;
			}
		});
		if(is_error){
			return false;
		}
	});
});
</script>
@stop
