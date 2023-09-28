@extends('adminlte::page')

@section('title', 'Business Rules')

@section('content_header')
<h1>
Add New User
</h1>
@stop

@section('content')
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<!-- general form elements -->
              <div class="box box-primary">

			<!----------------------- Message ------------------------------->
			@if($errors->any())
			  <div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				{{ $errors->first() }}
			  </div>
			@endif

                <form class="form-horizontal" method="post" name="form1" id="form1" action="/saveUser">
				@csrf
                  <div class="box-body">
                    <div class="form-group">
                      <label for="Uname" class="col-sm-2 control-label">User name</label>
                      <div class="col-sm-10">
                        <input type="text" id="uname" name="user_name" value="" class="form-control" placeholder="User name">
						<span style="inline:block;color:red;display:none;" id="uname_validate"></span>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="Password" class="col-sm-2 control-label">Password</label>
                      <div class="col-sm-10">
                        <input type="password" id="password" name="password" value="" class="form-control" placeholder="Password">
                      </div>
                    </div>
					<div class="form-group">
                      <label for="Email" class="col-sm-2 control-label">Email</label>
                      <div class="col-sm-10">
                        <input type="text" id="email" name="email" value="" class="form-control" placeholder="Email">
						<span style="inline:block;color:red;display:none;" id="email_validate"></span>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="Name" class="col-sm-2 control-label">Name</label>
                      <div class="col-sm-10">
                        <input type="text" id="name" name="name" value="" class="form-control" placeholder="Name">
                      </div>
                    </div>
					<div class="form-group">
                      <label for="Designation" class="col-sm-2 control-label">Designation</label>
                      <div class="col-sm-10">
                        <input type="text" id="designation" name="designation" value="" class="form-control" placeholder="Designation">
                      </div>
                    </div>
					<div class="form-group">
                      <label for="Phone" class="col-sm-2 control-label">Contact</label>
                      <div class="col-sm-10">
                        <input type="text" id="phone" name="phone" value="" class="form-control" placeholder="Contact">
                      </div>
                    </div>
					<div class="form-group">
                      <label for="Active" class="col-sm-2 control-label">Active</label>
                      <div class="col-sm-10">
                        <input class="flat-red" type="checkbox" id="is_active" name="is_active">
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
                </form>
              </div><!-- /.box -->
		</div>
	</div>
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
