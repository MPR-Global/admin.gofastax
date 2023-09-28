@extends('adminlte::page')

@section('title', 'Business Rules')

@section('content_header')
  <h1>
	Change Password
  </h1>
  @stop

@section('content')
<section class="content">
	<div class="row">
		<!----------------------- Message ------------------------------->
			@if($errors->any())
			  <div class="alert alert-danger alert-dismissible" style="width:96%;margin-left:2%;">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				{{$errors->first() }}
			  </div>
			@endif
			<!----------------------- End Message ------------------------------->
		<div class="col-xs-12">
			<!-- general form elements -->
              <div class="box box-primary">
                <form class="form-horizontal" method="get" name="form1" id="form1" action="{{route('change_pass')}}" onSubmit="javascript:return check_form();">
					@csrf
                  <div class="box-body">
                    <div class="form-group">
                      <label for="Current Password" class="col-sm-2 control-label">Current Password</label>
                      <div class="col-sm-10">
                        <input type="password" id="current_password" name="current_password" class="form-control" placeholder="Current Password" onFocus="select_box1()">
                      </div>
                    </div>
					<div class="form-group">
                      <label for="New Password" class="col-sm-2 control-label">New Password</label>
                      <div class="col-sm-10">
                        <input type="password" id="new_password" name="new_password" class="form-control" placeholder="New Password" onFocus="select_box2()">
                      </div>
                    </div>
					<div class="form-group">
                      <label for="Confirm Password" class="col-sm-2 control-label">Confirm Password</label>
                      <div class="col-sm-10">
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirm Password" onFocus="select_box3()">
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" id="submit" name="submit"  class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div><!-- /.box -->
		</div>
	</div>
</section>
@stop
@section('js')
<script language="javascript">
function check_form()
{
   	var doc=document.form1;
	if(doc.current_password.value=="")
	{
		alert("Please enter current password .");
		doc.current_password.focus();
		return false;
	}
	if(doc.new_password.value=="")
	{
		alert("Please enter new password .");
		doc.new_password.focus();
		return false;
	}
	if(doc.confirm_password.value=="")
	{
		alert("Please enter confirm password .");
		doc.confirm_password.focus();
		return false;
	}
	if(doc.confirm_password.value!=doc.new_password.value)
	{
		alert("New password and confirm password does not match.");
		doc.confirm_password.focus();
		return false;
	}

}

function select_box1(){
	//var box_name	=	box_name;

   	//alert(document.form1.box_name.value);
	var len=document.form1.current_password.value.length;
	document.form1.current_password.select(0,len-1);
}
function select_box2(){
	//var box_name	=	box_name;
	//alert(box_name);
   	//alert(document.form1.box_name.value);
	var len=document.form1.new_password.value.length;
	document.form1.new_password.select(0,len-1);
}
function select_box3(){
	//var box_name	=	box_name;
	//alert(box_name);
   	//alert(document.form1.box_name.value);
	var len=document.form1.confirm_password.value.length;
	document.form1.confirm_password.select(0,len-1);
}

function set_focus()
{
var len=document.form1.current_password.focus();
}

</script>
@stop
