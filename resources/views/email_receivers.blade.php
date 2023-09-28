@extends('adminlte::page')

@section('title', 'Edit Zipcode')

@section('content_header')
<h1>
Email Receivers Settings
</h1>
@stop

@section('content')


<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
			<!----------------------- Message ------------------------------->
			@if($errors->any())
			  <div class="alert alert-info alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				{{ $errors->first() }}
			  </div>
			@endif
			<!----------------------- End Message ------------------------------->
				<div class="box-body">
				<!-- search form -->
				<!-- /.search form -->
					<div class="box-footer">

                    <form class="form-horizontal" method="post" name="form1" id="form1" action="/saveemailreceiver">
				@csrf
					<div class="form-group">
                      <label for="Email" class="col-sm-2 control-label">Email</label>
                      <div class="col-sm-10">
                        <input type="text" id="email" name="email" value="" class="form-control" placeholder="Email">
						<span style="inline:block;color:red;display:none;" id="email_validate"></span>
                      </div>
                    </div>
					<div class="col-sm-offset-2">
					<button type="submit" id="submit" name="submit" value="" class="btn btn-primary">Submit
					<i class="fa fa-refresh fa-spin" style="display:none;" id="page_load_div"></i>
					</button>
					</div>
                    </form>
					</div>
					@if(count($emails) > 0)
					 <table id="example1" class="table table-bordered table-striped">
						<thead>
						  <tr>
							<th>Id</th>
							<th>Email</th>
							<th>Delete</th>
						  </tr>
						</thead>
						<tbody>
							@foreach($emails as $item)
							<tr>
                              <td>{{$item->id}}</td>
                              <td>{{$item->email}}</td>
							<td><a href="delete_email_receiver/{{$item->id}}" onclick="javascript:return confirm('Are you sure! You want to delete');"><i class="fa fa-fw fa-trash-o"></i> </a></td>
						  </tr>
							</tr>
							@endforeach
						</tbody>
					 </table>
					 @else
						No	emails found...
					@endif
				</div>
			</div>
		</div>
	</div>
</section>
@stop

