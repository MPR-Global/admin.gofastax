@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
<h1>
Users
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
					<a href="{{route('users.add')}}" class="btn btn-primary">Add User</a>
					</div>
					@if(count($data) > 0)
					 <table id="example1" class="table table-bordered table-striped">
						<thead>
						  <tr>
							<th>Uname</th>
							<th>Email</th>
							<th>Name</th>
							<th>Edit</th>
							<th>Delete</th>
						  </tr>
						</thead>
						<tbody>
							@foreach($data as $item)
							<tr>
                              <td>{{$item->user_name}}</td>
                              <td>{{$item->email}}</td>
                              <td>{{$item->name}}</td>
					         <td><a href="edit_user/{{$item->id}}"> <i class="fa fa-fw fa-edit"></i></a></td>
							<td><a href="delete_user/{{$item->id}}" onclick="javascript:return confirm('Are you sure! You want to delete');"><i class="fa fa-fw fa-trash"></i> </a></td>
						  </tr>
							</tr>
							@endforeach
						</tbody>
					 </table>
					 @else
						No	agent found...
					@endif
				</div>
				<div class="box-footer">
                   <a href="{{route('users.add')}}" class="btn btn-primary">Add User</a>
                </div>
				</form>
			</div>
		</div>
	</div>
</section>
@stop

