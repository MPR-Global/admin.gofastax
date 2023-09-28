@extends('adminlte::page')

@section('title', 'Add Zip Code')

@section('content_header')
<h1>
Add New Zipcode
</h1>
@stop

@section('content')

<section class="content">
<a href="{{route('zipcodes')}}" class="btn btn-link"><i class="fa fa-arrow-left" aria-hidden="true"></i> Zipcode List</a>
			<!-- general form elements -->
              <div class="box box-primary">

			<!----------------------- Message ------------------------------->
			@if($errors->any())
			  <div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				{{ $errors->first() }}
			  </div>
			@endif

                <form class="form-horizontal" method="post" name="form1" id="form1" action="/savezipcode">
				@csrf
                  <div class="box-body">
		                <div class="col-md-6">
							<div class="form-group col-md-12">
                            <label for="zipcode" class="control-label">Zipcode</label>
                                <input type="number" id="zipcode" name="zipcode"  value="" class="form-control" placeholder="zipcode">
                            </div>
                            <div class="form-group col-md-12">
                            <label for="county" class="control-label">County</label>
                                <input type="text" id="county" name="county"  value="" class="form-control" placeholder="county">
                            </div>
                            <div class="form-group col-md-12">
                            <label for="additional_price" class="control-label">Addition Price</label>
                            <input type="number" id="additional_price" name="additional_price"  value="0" class="form-control" placeholder="Additional price">
                            </div>
                        </div>
                        <div class="col-md-6">
						<div class="form-group col-md-12">
                            <label for="city" class="control-label">City</label>
                                <input type="text" id="city" name="city" class="form-control" placeholder="city">
                            </div>
                            <div class="form-group col-md-12">
                            <label for="coverage" class="control-label">Coverage</label>
                            <div class="radio">
                            <label class="radio-inline">
                              <input type="radio" name="coverage" id="coverage" value="Y"> Yes
                            </label>
                            </div>
                            <div class="radio">
                            <label class="radio-inline">
                              <input type="radio" name="coverage" id="coverage" value="N"> No
                            </label>
                            </div>
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
@section('scripts')
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
