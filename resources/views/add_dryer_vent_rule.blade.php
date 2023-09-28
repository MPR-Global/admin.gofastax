@extends('adminlte::page')

@section('title', 'Add New Dryer Vent Rules')

@section('content_header')
<h1>
Add New Dryer Vent Business Rule
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

                <form class="form-horizontal" method="post" name="form1" id="form1" action="/savedryerventRule">
				@csrf
                  <div class="box-body">
		                <div class="col-md-6">
                            <div class="form-group col-md-12">
                            <label for="dryer_vent_exit_point" class="control-label">Exit Point Of The Dryer Vent</label>
                                <select name="dryer_vent_exit_point" id="dryer_vent_exit_point" class="form-control">
                                <option>Select Exit Point Of The Dryer Vent</option>
                                  @foreach ($dryerVentExitPoints as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                  @endforeach
                                </select>
                                <span style="inline:block;color:red;display:none;" id="uname_validate"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group col-md-12">
                            <label for="price" class="control-label">Price</label>
                                <input type="number" id="price" name="price" value="" class="form-control" placeholder="price">
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
