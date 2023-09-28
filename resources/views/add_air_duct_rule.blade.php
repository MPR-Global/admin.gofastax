@extends('adminlte::page')

@section('title', 'Add New Business Rule')

@section('content_header')
<h1>
Add New Business Rule
</h1>

@stop
@section('content')
<section class="content">
<a href="{{route('business_rules')}}" class="btn btn-link"><i class="fa fa-arrow-left" aria-hidden="true"></i> Business Rules</a>

			<!-- general form elements -->
              <div class="box box-primary">

			<!----------------------- Message ------------------------------->
			@if($errors->any())
			  <div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				{{ $errors->first() }}
			  </div>
			@endif

                <form class="form-horizontal" method="post" name="form1" id="form1" action="/saveairductRule">
				@csrf
                  <div class="box-body">
		                <div class="col-md-6">
                            <div class="form-group col-md-12">
                            <label for="num_furnace" class="control-label">Number Of Furnace</label>
                                <select name="num_furnace" id="num_furnace" class="form-control">
								<option>Select Number Of Furnace</option>
								@foreach ($number_of_furnace as $item)
									<option value="{{ $item }}">{{ $item }}</option>
								@endforeach
                                </select>
                                <span style="inline:block;color:red;display:none;" id="uname_validate"></span>
                            </div>
                            <div class="form-group col-md-12">
                            <label for="furnace_loc_sidebyside" class="control-label">Price when Furnace Location Side by Side</label>
                                <input type="number" id="furnace_loc_sidebyside" name="furnace_loc_sidebyside" value="" class="form-control" placeholder="Price for Side by Side Furnace Location">
                            </div>
                            <div class="form-group col-md-12">
                            <label for="square_footage_min" class="control-label">Min Square Footage</label>
                                <input type="number" id="square_footage_min" name="square_footage_min" value="" class="form-control" placeholder="square footage">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group col-md-12">
                            <label for="final_price" class="control-label">Price When No Furnace Location</label>
                                <input type="number" id="final_price" name="final_price" value="" class="form-control" placeholder="Price When No Furnace Location">
                            </div>
                            <div class="form-group col-md-12">
                            <label for="furnace_loc_different" class="control-label">Price when Diffrent Furnace Location and/or Floor</label>
                                <input type="number" id="furnace_loc_different" name="furnace_loc_different" value="" class="form-control" placeholder="Price for Dfifferent Furnace Location">
                            </div>
                            <div class="form-group col-md-12">
                            <label for="square_footage_max" class="control-label">Max Square Footage</label>
                            <input type="number" id="square_footage_max" name="square_footage_max" value="" class="form-control" placeholder="square footage">
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
$("#delete_image").click(function(){
	if(confirm("Are you sure! You want to delete the picture?")){
		var new_url = window.location+'&delete_image=1';
		$(location).attr('href', new_url);
		return false;
	}else{
		return false;
	}
});
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
		var uname = $("#uname").val();
		var email = $("#email").val();
		if(uname.match(' ')){
			alert('Spaces are not allowed in username!');
			$('#uname').focus();
			return false;
		}else if(email.match(' ')){
			alert('Spaces are not allowed in email!');
			$('#email').focus();
			return false;
		}else{
			$("#submit").attr("disabled", true);
			$('#page_load_div').show();
			return true;
		}
	});
});
</script>
@stop
